<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailReceiver extends Model
{
    use HasFactory;

    protected $casts = [
        'reviewer_id' => 'string',
    ];

    public function detail()
    {
        return $this->hasOne(Mail::class, 'id', 'mail_id');
    }

    public function receiver()
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
