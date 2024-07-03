<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailReviewer extends Model
{
    use HasFactory;

    protected $casts = [
        'reviewer_id' => 'string',
    ];


    public function reviewer()
    {
        return $this->hasOne(User::class, 'id', 'reviewer_id');
    }
}
