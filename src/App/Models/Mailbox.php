<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Devakb\Mailbox\App\Models\MailboxReply;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mailbox extends Model
{
    use HasFactory;

    protected $with = [
        'sender',
        'recipient',
        'replies',
    ];

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'subject',
        'message'
    ];

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }


    public function recipient(){
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function replies(){
        return $this->hasMany(MailboxReply::class, 'mailbox_id', 'id');
    }


}
