<?php

namespace App\Http\Controllers;

use App\Const\StatusSurat;
use App\Models\Mail;
use App\Models\MailReceiver;
use App\Models\MailReviewer;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Illuminate\Support\Str;

class MailEditController extends Component
{

  public $id;
  public $code = "ESDX-2406";
  public $title = "Surat Pemecatan Ojan";
  public $description = "Cape ngetik lah";
  public $created_by;
  public $status;
  public $document = "H";
  public $user;

  public $mail_reviewers = [
    [
      'reviewer_id' => ''
    ]
  ];

  public $reviewers = [];

  public $select_receivers = [];

  public $receivers_not_id = [];

  public $receivers_id = [];
  public $receivers = [];

  public function mount(Mail $mail)
  {
    $this->id          = $mail->id;
    $this->code        = $mail->code;
    $this->title       = $mail->title ;
    $this->created_by  = $mail->created_by;
    $this->status      = $mail->status;
    $this->description = $mail->description;
    $this->document    = $mail->document;
    $this->user        = $mail->user;

    if ($mail->mail_reviewers) {
      $this->mail_reviewers = $mail->mail_reviewers->toArray();

      $jangan_kirim_ke[] = strval($this->user->id);
      $jangan_kirim_ke = array_merge(array_column($this->mail_reviewers, 'reviewer_id'), $jangan_kirim_ke);

      $this->select_receivers = User::whereNotIn('id', $jangan_kirim_ke)->get();
    }
  }

  public function render()
  {
    $this->reviewers = User::where('role', 'Peninjau')->get();
    $this->receivers = User::whereIn('id', $this->receivers_id)->get();

    return view('mail.request.edit');
  }

  // Jang admin tukang ngarobah surat ngajukeun pengesahan
  public function update(Mail $mail)
  {
    $mail->code        = $this->code;
    $mail->title       = $this->title;
    $mail->created_by  = $this->created_by;
    $mail->status      = $this->status;
    $mail->description = $this->description;
    $mail->document    = $this->document;
    $mail->save();

    session()->flash('message', 'Surat diperbarui');
  }

  // Jang admin tukang nyieun surat ngajukeun pengesahan
  public function pengajuanPengesahan(Mail $mail)
  {
    $mail->status = StatusSurat::PENDING;
    foreach ($this->mail_reviewers as $key => $value) {
      $mail_reviewer = new MailReviewer();
      $mail_reviewer->reviewer_id = $value['reviewer_id'];
      $mail->mail_reviewers()->save($mail_reviewer);
    }
    $mail->save();

    return redirect()->route('mail.request.edit', $mail->id)->with('message', 'Surat telah diajukan, kalem dagoan heula');
  }

  // Anjing jang reviweer
  public function konfirmasiPengesahan(Mail $mail)
  {
    // $mail->status = 'Surat Telah Diajukan, Menunggu Konfirmasi';

    MailReviewer::where('mail_id', $mail->id)->where('reviewer_id', auth()->user()->id)->update([
      'verified' => true
    ]);

    $this->mail_reviewers = $mail->mail_reviewers->toArray();

    foreach ($this->mail_reviewers as $key => $value) {
      if ($value['verified'] != true) {
        $mail->status = StatusSurat::HALF_DONE;
        $mail->save();
        return redirect()->route('mail.request.edit', $mail->id)->with('message', 'Surat telah dikonfirmasi');
      }
    }

    $mail->status = StatusSurat::DONE;
    $mail->save();

    return redirect()->route('mail.request.edit', $mail->id)->with('message', 'Surat telah dikonfirmasi');
  }

  public function kirim_surat(Mail $mail)
  {
    foreach ($this->receivers as $receiver) {
      $mail_receiver = new MailReceiver();
      $mail_receiver->mail_id = $mail->id;
      $mail_receiver->receiver_id = $receiver->id;
      $mail_receiver->sender_id = $mail->user->id;
      $mail_receiver->save();
    }
    return redirect()->route('mail.request.edit', $mail->id)->with('message', 'Surat telah terkirim');
  }
}
