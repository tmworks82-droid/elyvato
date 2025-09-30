<?php

namespace App\Http\Controllers\Front;

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

class TicketConversationController extends Controller
{
    
    public function uploadAttachmentTicket(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_attachment_' . $file->getClientOriginalName();
            $uploadPath = public_path('upload/ticket/');
            $file->move($uploadPath, $filename);

            return response()->json([
                'status' => true,
                'filepath' => 'upload/ticket/' . $filename
            ]);
        }

        return response()->json(['status' => false, 'message' => 'No file uploaded'], 400);
    }



    public function storeTicket(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'department' => 'required|exists:departments,id',
            'issue' => 'required|string',
            'attachment' => 'required',
        ]);

          $ticketUid = 'TCK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

        $ticket = new Ticket();
        $ticket->ticket_id=$ticketUid;
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->department_id = $request->department;
        $ticket->describe_issue = $request->issue;


            $attachments = json_decode($request->input('attachment'), true);
            $ticket->image = json_encode($attachments); // Save as JSON string
            $user=Admin::where('id',Auth::user()->id)->first();
        if($ticket->save()){

           $res= sendEmail(
                $user->email,
                'ELYVATO | Support Ticket Raised',
                'emails.ticketraised',
                [
                    'user'   => $user,
                    'ticket' => $ticket,
                ]
            );
           $mobile=$user->mobile;
        //    $mobile='+919956398635';

            $ticketTemplateData = [
                'name' => 'raise_ticket',
                'language' => ['code' => 'en'],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            ['type' => 'text', 'text' => $user->username],     // {{1}}
                            ['type' => 'text', 'text' => $ticket->ticket_id],     // {{2}}
                            ['type' => 'text', 'text' => $ticket->created_at],    // {{3}}
                        ]
                    ]
                ]
            ];

           $ress= sendWhatsAppTemplate($mobile, $ticketTemplateData);
            // dd($ress);


            return response()->json([
                'success' => true,
                'ticket_id' => $ticket->id,
                'department_name' => $ticket->department->name ?? 'Support'
            ]);
        }


    }


    // Store user reply
public function storeReply(Request $request)
{
    // dd($request->all());

    $request->validate([
        'message' => 'required|string',
    ]);

    // Find the ticket
    $ticket = Ticket::where('user_id',Auth::user()->id)->first();

    // Determine if the message is from the user or admin
    $sender = 'user';

    // Store the message
    $message = new TicketMessage();
    $message->ticket_id = $ticket->id;
    $message->user_id = $ticket->user_id; // Only set for user messages
    $message->message = $request->message;
    $message->sender = $sender;
  
    $msg=false;

    if ($request->hasFile('attachment')) {
        $msg=true;
            $file = $request->file('attachment');
            $filename = time() . '_ratecard_' . $file->getClientOriginalName();
            $uploadPath = public_path('upload/ticket/');
            $file->move($uploadPath, $filename);
            $message->image = 'upload/ticket/' . $filename;
        }

    $message->save();

    // Optionally, you can simulate an admin reply here if you want to automatically respond

    return response()->json([
        'success' => true,
        'message' => $message,
        'type'=>'user',
        'img'=>$msg,
        
    ]);
}


public function closeTicketByUser(Request $request)
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
    
    $ticket->closed_by    =Auth::user()->id; 
    $ticket->closed_at    = now();    
    
  $ok=false;
  $msg='';
  
    if($ticket->save()){
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
