<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\Department;
use Auth;
use Carbon\Carbon;
use Hash;
use Str; 

class AdminTicketController extends Controller
{
    public function TicketList(){
        $data['tickets']=Ticket::with('user')->orderBy('id','desc')->get();
        return view('admin.ticket.index',$data);
    }

    public function TicketReplyView($id){
       $data['tickets']=Ticket::with(['messages','user'])->where('id',$id)->first();

       return view('admin.ticket.ticket_reply',$data);
    }

    public function AgentReply(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'message' => 'required|string',
        ]);

        
        $ticket = Ticket::where('id',$request->ticket_id)->first();

        $sender = 'admin';

        // Store the message
        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->user_id = Auth::user()->id; 
        $message->message = $request->message;
        $message->sender = $sender;

        $msg=false;

    if ($request->hasFile('attachments')) {
        $msg=true;
            $file = $request->file('attachments');
            $filename = time() . '_ratecard_' . $file->getClientOriginalName();
            $uploadPath = public_path('upload/ticket/');
            $file->move($uploadPath, $filename);
            $message->image = 'upload/ticket/' . $filename;
        }
// dd($msg,$request->all());
    $message->save();

        $user=Admin::where('id',$ticket->user_id)->first();
        $agent=Admin::where('id',Auth::user()->id)->first();

        $mobile=$user->mobile;
        // $mobile='+919956398635';
       $res= sendEmail(
            $user->email,
            'ELYVATO | Support Ticket Reply',
            'emails.ticketreply',
            [
                'user'   => $user,
                'agent'=>$agent,
                'ticket' => $ticket,
                'replyMessage'=>$message->message,
            ]
        );
        
        $ticketReplyTemplateData = [
            'name' => 'support_ticket_reply',
            'language' => ['code' => 'en'],
            'components' => [
                [
                    'type' => 'body',
                    'parameters' => [
                        ['type' => 'text', 'text' => $user->username??$user->name],      // {{1}}
                        ['type' => 'text', 'text' => $agent->name??$agent->username],     // {{2}}
                        ['type' => 'text', 'text' => $ticket->ticket_id],      // {{3}}
                        ['type' => 'text', 'text' => $message->message],  // {{4}}
                    ]
                ]
            ]
        ];

    sendWhatsAppTemplate($mobile, $ticketReplyTemplateData);


        return response()->json([
            'success' => true,
            'message' => $message,
            'type'=>'admin',
            'msg'=>$msg,
        ]);
    }


public function closeTicket(Request $request)
{
    $request->validate([
        'ticket_id' => ['required','integer','exists:tickets,id'],
    ]);

    $ticket =Ticket::findOrFail($request->ticket_id);

   
    if ($ticket->ticket_close === 'close') {
        return response()->json([
            'ok' => false,
            'message' => 'Ticket is already closed.'
        ], 409);
    }

    $ticket->ticket_close = 'close';           
    
    $ticket->closed_by    = Auth::user()->id; 
    $ticket->closed_at    = now();    
    
    $ok=false;
    $msg='';

    if($ticket->save()){

         $user=Admin::where('id',$ticket->user_id)->first();
        $agent=Admin::where('id',Auth::user()->id)->first();

       $res= sendEmail(
            'voyoyof460@bitmens.com',
            'ELYVATO | Ticket Closed',
            'emails.ticketreply',
            [
                'user'   => $user,
                'agent'=>$agent,
                'ticket' => $ticket,
                'replyMessage'=>"Ticket is closed",
            ]
        );

        $msg="Ticket closed successfully";
        $ok=true;
    }
    return response()->json([
        'ok'        => $ok,
        'status'    => $ticket->status,
        'message'=>$msg,
        'closed_at' => optional($ticket->closed_at)->format('Y-m-d H:i:s'),
    ]);
}

}
