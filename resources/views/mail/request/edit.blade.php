<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="flex w-full">
        <div class="flex flex-col gap-3 w-[330px]">
            <x-button label="Kembali" href="{{ route('mail.request.index') }}" />
            <div id="accordion-flush" data-accordion="open"
                data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                data-inactive-classes="text-gray-500 dark:text-gray-400">
                <h2 id="accordion-flush-heading-1">
                    <button type="button"
                        class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3"
                        data-accordion-target="#accordion-flush-body-1"
                        aria-expanded="{{ $status == \App\Const\StatusSurat::DONE ? 'false' : 'true' }}"
                        aria-controls="accordion-flush-body-1">
                        <span>Keterangan Surat</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1"
                    wire:ignore.self>
                    <div class="py-5 border-b border-gray-200 dark:border-gray-700 flex flex-col gap-3">
                        <div>
                            <x-input label="Kode Surat" placeholder="Kode Surat" wire:model="code" :disabled="$status != \App\Const\StatusSurat::BARU ? true : false" />
                        </div>
                        <div>
                            <x-input label="Judul Surat" placeholder="Judul Surat" wire:model="title"
                                :disabled="$status != \App\Const\StatusSurat::BARU ? true : false" />
                        </div>
                        <div>
                            <x-textarea label="Keterangan" placeholder="Keterengan" wire:model="description"
                                :disabled="$status != \App\Const\StatusSurat::BARU ? true : false"></x-textarea>
                        </div>

                        <div class="flex flex-col gap-3" x-data="{}">
                            @foreach ($mail_reviewers as $key => $value)
                                <div class="flex items-center gap-3">
                                    <x-select label="Tanda Tangan {{ $loop->iteration }}"
                                        placeholder="Tanda Tangan {{ $loop->iteration }}"
                                        wire:model.live="mail_reviewers.{{ $key }}.reviewer_id"
                                        :disabled="$status != \App\Const\StatusSurat::BARU ? true : false">
                                        @foreach ($reviewers as $reviewer)
                                            <x-select.option label="{{ $reviewer->name }}"
                                                value="{{ $reviewer->id }}" />
                                        @endforeach
                                    </x-select>
                                    @if ($status == \App\Const\StatusSurat::BARU)
                                        @if ($key != 0)
                                            <button class="mt-6"
                                                x-on:click="() => { 
                                        const mail_reviewers = $wire.get('mail_reviewers');
                                        mail_reviewers.splice({{ $key }}, 1);
                                        $wire.set('mail_reviewers', mail_reviewers);
                                        console.log(mail_reviewers) 
                                        }">Hapus</button>
                                        @endif
                                    @endif

                                </div>
                            @endforeach

                            @if ($status == \App\Const\StatusSurat::BARU)
                                <div>
                                    <x-button info xs label="Tambah Tanda Tangan"
                                        x-on:click="() => { 
                                    const mail_reviewers = $wire.get('mail_reviewers');
                                    mail_reviewers.push({reviewer_id: ''});
                                    $wire.set('mail_reviewers', mail_reviewers);
                                    console.log(mail_reviewers) 
                                    }" />
                                </div>
                            @endif
                        </div>
                        @if ($status == \App\Const\StatusSurat::BARU)
                            <x-button info label="Simpan" wire:click="update({{ $this->id }})" />
                            <x-button info label="Pengajuan Pengesahan"
                                wire:click="pengajuanPengesahan({{ $this->id }})" />
                        @endif

                        <x-button info label="Konfirmasi" wire:click="konfirmasiPengesahan({{ $this->id }})" />
                    </div>
                </div>
                @if ($status == \App\Const\StatusSurat::DONE)
                    <h2 id="accordion-flush-heading-2">
                        <button type="button"
                            class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3"
                            data-accordion-target="#accordion-flush-body-2"
                            aria-expanded="{{ $status == \App\Const\StatusSurat::DONE ? 'true' : 'false' }}"
                            aria-controls="accordion-flush-body-2">
                            <span>Kirim Surat</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2"
                        wire:ignore.self>
                        <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                            <x-select label="Penerima" placeholder="Penerima" wire:model.live="receivers_id"
                                multiselect>
                                @foreach ($select_receivers as $select_receiver)
                                    <x-select.option label="{{ $select_receiver->name }}"
                                        value="{{ $select_receiver->id }}" />
                                @endforeach
                            </x-select>
                        </div>
                        <div>
                            @foreach ($receivers as $receiver)
                                <div>{{ $receiver->name }}</div>
                            @endforeach
                        </div>
                    </div>
                    <x-button info label="Kirim" wire:click="kirim_surat({{ $this->id }})" />
                @endif
            </div>

        </div>
        <div wire:ignore class="w-full pl-3">
            <textarea id="editor" wire:model="document" class="">
            </textarea>
        </div>

    </div>
    <script src="https://cdn.tiny.cloud/1/p804o88945yrug6ccy4fws1gwki3o79jtfdiumucs5xexfec/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        // window.tinyConfig = {
        //     templates: [{
        //         title: "Blog post",
        //         description: "A templated blog post",
        //         content: "<p>Post copyright: 2022.</p>"
        //     }]
        // };
        document.addEventListener('livewire:initialized', () => {
            // Runs immediately after Livewire has finished initializing
            // on the page...

            // console.log(@this.status == 'Surat Telah Diajukan, Menunggu Konfirmasi' ? true : true);
            const mce = tinymce.init({
                selector: '#editor',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
                toolbar: 'undo redo customInsertButton | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                line_height_formats: '0.1 1 1.2 1.4 1.6 2',
                // forced_root_block: false,
                height: 920,
                // menubar: true,
                // toolbar: true,
                // readonly: false,
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        @this.set('document', editor.getContent());
                    });

                    editor.ui.registry.addButton('customInsertButton', {
                        text: 'My Button',
                        onAction: (_) => editor.insertContent(`
                        <table style="border-collapse: collapse; width: 89.6035%; height: 162.694px; border-width: 1px; border-color: #000000; margin-left: auto; margin-right: auto;" border="1"><colgroup><col style="width: 20.1539%;"><col style="width: 65.3297%;"><col style="width: 14.6164%;"></colgroup>
                        <tbody>
                        <tr style="height: 162.694px;">
                        <td style="border-color: #000000; text-align: center;"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Seal_of_Purwakarta_Regency.svg/1559px-Seal_of_Purwakarta_Regency.svg.png" alt="" width="106" height="139"></td>
                        <td style="border-color: #000000;">
                        <p style="text-align: center; line-height: 0.1;"><span lang="EN-US" style="font-size: 16.0pt; mso-bidi-font-size: 11.0pt; line-height: 107%; font-family: 'Calibri',sans-serif; mso-ascii-theme-font: minor-latin; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: 'Times New Roman'; mso-bidi-theme-font: minor-bidi; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;">PEMERINTAH KABUPATEN PURWAKARTA </span></p>
                        <p style="text-align: center; line-height: 0.1;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 20.0pt; mso-bidi-font-size: 11.0pt; line-height: 107%; font-family: 'Arial',sans-serif; mso-fareast-font-family: Arial; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;">DINAS KOMUNIKASI DAN INFORMATIKA </span></strong></p>
                        <p style="text-align: center; line-height: 0.1;"><span lang="EN-US">Jalan Gandanegara Nomor 25, Purwakarta, Purwakarta, Jawa Barat 41111<span style="mso-spacerun: yes;">&nbsp;</span></span></p>
                        <p style="text-align: center; line-height: 0.1;"><span lang="EN-US">Telepon (0264) 210082/210083 Faksimile (0264) 200037 Laman: </span></p>
                        <p style="text-align: center; line-height: 0.1;"><span lang="EN-US">www.diskominfo.purwakartakab.go.id, Pos-el:&nbsp;<u style="text-underline: #0563C1;"><span style="color: #0563c1;">diskominfo@purwakartakab.go.id</span></u></span><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-family: 'Arial',sans-serif; mso-fareast-font-family: Arial;"> </span></strong></p>
                        </td>
                        <td style="border-color: #000000;">
                        <p style="text-align: center; line-height: 0.1;"><span lang="EN-US" style="font-size: 16.0pt; mso-bidi-font-size: 11.0pt; line-height: 107%; font-family: 'Calibri',sans-serif; mso-ascii-theme-font: minor-latin; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: 'Times New Roman'; mso-bidi-theme-font: minor-bidi; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;">&nbsp;</span></p>
                        </td>
                        </tr>
                        </tbody>
                        </table>
                        `),
                    });
                }
            });

            if (@this.status == 'Surat Telah Diajukan, Menunggu Konfirmasi') {
                console.log("OKAOSK");
                tinymce.activeEditor.mode.set("readonly");
            }

            // mce.readonly = true;
        });
    </script>
</div>
