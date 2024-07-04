<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\MailReceiver;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class IncomingMailController extends Component
{
    public function render()
    {
        $mails = MailReceiver::with('detail')->where('receiver_id', auth()->user()->id)->get();
        return view('mail.incoming.index', compact('mails'));
    }

    public function generate_surat(Mail $mail)
    {

        return view('mail.incoming.mail');
        $pdf = Pdf::loadView('mail.incoming.mail')->stream();

        return $pdf;
        // return response()->streamDownload(
        //     fn () => print($pdf),
        //     "filename.pdf"
        // );
    }
}
