<?php

namespace App\Http\Controllers\Mailbox;

use App\Models\User;
use App\Models\Mailbox;
use App\Models\MailboxReply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailboxController extends Controller
{
    public function inbox(){


        $inbox_messages = Mailbox::where('recipient_id', auth()->id())->orderby('created_at', 'desc')->paginate(30);

        return view('mailbox.inbox',compact('inbox_messages'));
    }

    public function sentbox(){

        $sentbox_messages = Mailbox::where('sender_id', auth()->id())->orderby('created_at', 'desc')->paginate(30);

        return view('mailbox.sentbox',compact('sentbox_messages'));
    }

    public function show(Mailbox $mailbox){

        abort_unless($mailbox->sender_id == auth()->id() || $mailbox->recipient_id == auth()->id(), 403);

        return view('mailbox.show')->with(['message' => $mailbox]);
    }

    public function new(){

        $users = User::query()
                 ->where('id', '<>', auth()->id())
                 ->selectRaw("CONCAT(name , ' ( ', email , ' )') as name_email , id")
                 ->pluck('name_email', 'id');

        return view('mailbox.new', compact('users'));
    }

    public function send(Request $request){

        $valid_users = User::where('id', '<>', auth()->id())->pluck('id')->toarray();

        $request->validate([
            'user' => [
                'required',
                'in:'.implode(',', $valid_users),
            ],
            'subject' => [
                'nullable',
                'max:200',
            ],
            'message' => [
                'required'
            ]

        ]);

        Mailbox::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $request->user,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('mailbox.sentbox');
    }

    public function reply(Mailbox $mailbox, Request $request){

        abort_unless($mailbox->sender_id == auth()->id() || $mailbox->recipient_id == auth()->id(), 403);

        $request->validate([
            'message' => [
                'required'
            ]
        ]);

        MailboxReply::create([
            'mailbox_id'        =>  $mailbox->id,
            'respondent_id'     =>  auth()->id(),
            'message'           =>  $request->message,
        ]);

        return back();
    }
}
