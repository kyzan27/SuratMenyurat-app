<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function mail_reviewers()
    {
        return $this->hasMany(MailReviewer::class, 'mail_id', 'id');
    }
}
