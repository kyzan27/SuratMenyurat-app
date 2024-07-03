<div>
    <link rel="stylesheet" href="{{ asset('ckeditor/ckeditor.css') }}">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="flex">
        <div class="flex flex-col gap-3 min-w-[300px]">
            <div>
                <x-input label="Kode Surat" placeholder="Kode Surat" wire:model="code" />
            </div>
            <div>
                <x-input label="Judul Surat" placeholder="Judul Surat" wire:model="title" />
            </div>
            <div>
                <x-textarea label="Keterangan" placeholder="Keterengan" wire:model="description"></x-textarea>
            </div>

            <div class="flex flex-col gap-3" x-data="{}">
                @foreach ($mail_reviewers as $key => $value)
                    <div class="flex items-center gap-3">
                        <x-select label="Tanda Tangan {{ $loop->iteration }}"
                            placeholder="Tanda Tangan {{ $loop->iteration }}"
                            wire:model.live="mail_reviewers.{{ $key }}.reviewer_id">
                            @foreach ($reviewers as $reviewer)
                                <x-select.option label="{{ $reviewer->name }}" value="{{ $reviewer->id }}" />
                            @endforeach
                        </x-select>
                        @if ($key != 0)
                            <button class="mt-6"
                                x-on:click="() => { 
                                const mail_reviewers = $wire.get('mail_reviewers');
                                mail_reviewers.splice({{ $key }}, 1);
                                $wire.set('mail_reviewers', mail_reviewers);
                                console.log(mail_reviewers) 
                                }">Hapus</button>
                        @endif
                    </div>
                @endforeach

                {{ json_encode($mail_reviewers) }}
                <div>
                    <x-button info xs label="Tambah Tanda Tangan"
                        x-on:click="() => { 
                        const mail_reviewers = $wire.get('mail_reviewers');
                        mail_reviewers.push({reviewer_id: ''});
                        $wire.set('mail_reviewers', mail_reviewers);
                        console.log(mail_reviewers) 
                        }" />
                </div>
            </div>
            <x-button info label="Simpan" wire:click="store" />
            <x-button label="Kembali" href="{{ route('mail.request.index') }}" />
        </div>
        <div wire:ignore class="cke-body" data-editor="DecoupledEditor" data-collaboration="false"
            data-revision-history="false">
            <div class="centered">
                <div class="row">
                    <div id="toolbar"></div>
                </div>
                <div class="row row-editor">
                    <div class="editor-container">
                        {{-- <div class="editor">
                            ddd
                        </div> --}}

                        <textarea id="editor" class="" wire:model="document">
                        </textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.tiny.cloud/1/p804o88945yrug6ccy4fws1gwki3o79jtfdiumucs5xexfec/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#editor',

            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker template',
            toolbar: 'undo redo customInsertButton | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            line_height_formats: '0.1 1 1.2 1.4 1.6 2',
            forced_root_block: false,
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
                        `)
                });
            }
        });

        window.tinyConfig = {
            templates: [{
                title: "Blog post",
                description: "A templated blog post",
                content: "<p>Post copyright: 2022.</p>"
            }]
        };
    </script>
</div>
