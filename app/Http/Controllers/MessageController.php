<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageStore;
use App\Models\User;
use App\Models\Messages;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function display()
    {
        $getMessages = DB::table('messages')->where('user_id',auth()->id())
                ->orWhere('receiver_id',auth()->id())
                ->get(); 
        return view('message', ['messages' => $getMessages, 'my_id' => auth()->id()]);
    }

    public function store(MessageStore $request)
    {
        $validated = $request->validated();

        $getUser = DB::table('users')->where('name',$request['destination'])
                ->get(); 

        $getName = DB::table('users')->where('id',auth()->id())
                ->get(); 
        if($getUser->count()) {
            $message = new Messages();
            $message->user_id = auth()->id();
            $message->receiver_id = $getUser[0]->id;
            $message->sender_name = $getName[0]->name;
            $message->content = $validated['message'];

            $message->save();
            return redirect('message')->with('success', 'Le message a été envoyé !');
        } else {
            return redirect('message')->with('problem', 'Le destinataire entré n\'existe pas !');
        }
    }

    public function delete($id)
    {
        $delete = DB::table('messages')
        ->where('id', $id)
        ->delete();

        return redirect('message')->with('success', 'Le message a bien été supprimée !');
    }
}
