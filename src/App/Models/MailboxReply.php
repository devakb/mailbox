<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MailboxReply extends Model
{
    use HasFactory;

    public $with = [
        'respondent',
    ];

    protected $fillable = [
        'mailbox_id',
        'respondent_id',
        'message',
    ];


    public function respondent(){
        return $this->belongsTo(User::class, 'respondent_id');
    }

    public function mailbox(){
        return $this->belongsTo(MailBox::class, 'mailbox_id');
    }

}
