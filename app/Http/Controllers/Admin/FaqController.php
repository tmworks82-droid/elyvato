<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index(){
        $faqs = Faq::paginate(10);
        return view("admin.faq.index", compact("faqs"));
    }

    public function Create(){
        $faqs=null;
        return view("admin.faq.create", compact("faqs"));
    }

    public function Store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'page_name' => 'required|string|max:255',
            'question' => 'required|string|max:500',
            'answer'    => 'required|string',
            'is_active' => 'required|boolean',
        ]);
              $faq= new Faq();
                $msg="FAQ created successfully!";

              if(!empty($request->id)){
                $faq=Faq::where('id', $request->id)->first();
                $msg="FAQ updated successfully";
              }
              $faq->page_name = $request->page_name;
              $faq->question = $request->question;
              $faq->answer = $request->answer;
              $faq->answer = $request->answer;
              $faq->is_active = $request->is_active;

              if($faq->save()){
                    return redirect()->route('index')->with('success',$msg);
              }
              else{
                return redirect()->route('faq.create')->with('error',$msg);
              }

    }

    public function Edit(Request $request, $id){
        $faqs = Faq::findOrFail($id);
        return view("admin.faq.create", compact("faqs"));

    }

    public function Destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ deleted successfully!');
    }


}
