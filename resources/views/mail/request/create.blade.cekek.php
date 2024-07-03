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
                @foreach ($signatures as $key => $value)
                    <div class="flex items-center gap-3">
                        <x-select label="Tanda Tangan {{ $loop->iteration }}"
                            placeholder="Tanda Tangan {{ $loop->iteration }}"
                            wire:model="signatures.{{ $key }}.value">
                            <x-select.option label="Kepala " value="1" />
                            <x-select.option label="Pundak" value="2" />
                            <x-select.option label="Tangan" value="3" />
                            <x-select.option label="Lutut" value="4" />
                        </x-select>
                        @if ($key != 0)
                            <button class="mt-6"
                                x-on:click="() => { 
                                const signatures = $wire.get('signatures');
                                signatures.splice({{ $key }}, 1);
                                $wire.set('signatures', signatures);
                                console.log(signatures) 
                                }">Hapus</button>
                        @endif
                    </div>
                @endforeach

                {{ json_encode($signatures) }}
                <div>
                    <x-button info xs label="Tambah Tanda Tangan"
                        x-on:click="() => { 
                        const signatures = $wire.get('signatures');
                        signatures.push({value: ''});
                        $wire.set('signatures', signatures);
                        console.log(signatures) 
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
                    <div class="document-editor__toolbar"></div>
                </div>
                <div class="row row-editor">
                    <div class="editor-container">
                        <div class="editor">
                            {!! $this->document !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script>
        DecoupledEditor
            .create(document.querySelector('.editor'), {
                // Editor configuration.
                // plugin: [
                //     LineHeight,
                // ]
                // lineHeight: { // specify your otions in the lineHeight config object. Default values are [ 0, 0.5, 1, 1.5, 2 ]
                //     options: [
                //         1.2,
                //         1.5,
                //         'default',
                //         '14px',
                //         '16px',
                //         '18px',
                //         {
                //             title: 'Normal',
                //             model: '1',
                //         },
                //         {
                //             title: 'Huge',
                //             model: '36px'
                //         },
                //     ],
                // },
                // toolbar: [
                //     /* ..., */
                //     'lineHeight', // add the button to your toolbar
                // ],

            })
            .then(editor => {
                window.editor = editor;

                editor.model.document.on('change:data', () => {
                    @this.set('document', editor.getData());
                })

                // Set a custom container for the toolbar.
                document.querySelector('.document-editor__toolbar').appendChild(editor.ui.view.toolbar.element);
                document.querySelector('.ck-toolbar').classList.add('ck-reset_all');
            })
            .catch(handleSampleError);

        function handleSampleError(error) {
            const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';

            const message = [
                'Oops, something went wrong!',
                `Please, report the following error on ${ issueUrl } with the build id "w7ttptbe319z-u9490jx48w7r" and the error stack trace:`
            ].join('\n');

            console.error(message);
            console.error(error);
        }
    </script>
</div>
