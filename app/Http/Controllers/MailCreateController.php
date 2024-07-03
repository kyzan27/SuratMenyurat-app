<?php

namespace App\Http\Controllers;

use App\Const\StatusSurat;
use App\Models\Mail;
use App\Models\MailReviewer;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Illuminate\Support\Str;

class MailCreateController extends Component
{

  public $id;
  public $code = "ESDX-2406";
  public $title = "Surat Pemecatan Ojan";
  public $description = "Cape ngetik lah";
  public $document = "";

  public $mail_reviewers = [
    [
      'reviewer_id' => ''
    ]
  ];

  public $reviewers = [];

  public function render()
  {
    $this->reviewers =  User::where('role', 'Peninjau')->get();
    return view('mail.request.create');
  }

  public function store()
  {
    // dd($this->document);

    $mail = new Mail();
    $mail->code        = $this->code;
    $mail->title       = $this->title;
    $mail->created_by  = auth()->user()->id;
    $mail->status      = StatusSurat::BARU;
    $mail->description = $this->description;
    $mail->document    = $this->document;
    $mail->save();

    foreach ($this->mail_reviewers as $key => $value) {
      $mail_reviewer = new MailReviewer();
      $mail_reviewer->reviewer_id = $value['reviewer_id'];
      $mail->mail_reviewers()->save($mail_reviewer);
    }


    session()->flash('message', 'Surat dibuat');
  }

  public function edit(Mail $mail)
  {
    $this->document = $mail->document;
  }

  public function update(Mail $mail)
  {
    $mail->document = $this->document;
    $mail->save();

    return redirect()->route('mail.edit', $this->id);
  }
}
