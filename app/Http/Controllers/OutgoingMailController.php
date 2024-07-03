<?php

namespace App\Http\Controllers;

use App\Models\MailReceiver;
use Livewire\Component;

class OutgoingMailController extends Component
{
    public $modal_kirim_surat = false;

    public function render()
    {
        $mails = MailReceiver::with('detail')->where('receiver_id', auth()->user()->id)->get();
        return view('mail.outgoing.index', compact('mails'));
    }

    public function buka_modal_kirim_surat()
    {
        $this->modal_kirim_surat = true;
    }
}
