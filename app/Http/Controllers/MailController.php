<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Illuminate\Support\Str;

class MailController extends Component
{
    public function render()
    {
        $mails = Mail::where('created_by', auth()->user()->id)->orderByDesc('created_at')->get();
        if (auth()->user()->role == "Peninjau") {
            $mails = Mail::whereHas('mail_reviewers', function ($reviewer) {
                return $reviewer->where('reviewer_id', auth()->user()->id);
            })->get();
        }

        return view('mail.request.index', compact('mails'));
    }
}
