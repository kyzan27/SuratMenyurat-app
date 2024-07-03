<div class="block p-6 bg-white border border-gray-200 rounded-lg shadow  dark:border-gray-700 dark:hover:bg-gray-700">
    <div>
        <!-- Modal toggle -->
        <button data-modal-target="create-mail-modal" data-modal-toggle="create-mail-modal"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Buat Surat
        </button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg scroll-my-px my-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nomor Surat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Judul Surat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Dibuat Oleh
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Dibuat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Keterangan
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mails as $mail)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $mail->code }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $mail->title }}
                        </td>
                        <td class="px-6 py-4">
                            Sutisno
                        </td>
                        <td class="px-6 py-4">
                            {{ $mail->created_at }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $mail->status }}
                        </td>

                        <td class="px-6 py-4">
                            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                href="{{ route('mail.edit', $mail->id) }}">Edit</a>
                        </td>
                    </tr>
                @empty
                @endforelse



            </tbody>
        </table>
    </div>

    <!-- Main modal -->
    <div id="create-mail-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Buat Surat
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="create-mail-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">

                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        With less than a month to go before the European Union enacts new consumer privacy laws for its
                        citizens, companies around the world are updating their terms of service agreements to comply.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25
                        and is meant to ensure a common set of data rights in the European Union. It requires
                        organizations to notify users as soon as possible of high-risk data breaches that could
                        personally affect them.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="create-mail-modal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                        accept</button>
                    <button data-modal-hide="create-mail-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{ document: @entangle('document') }">
        <script src="https://cdn.tiny.cloud/1/p804o88945yrug6ccy4fws1gwki3o79jtfdiumucs5xexfec/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>

        <script>
            tinymce.init({
                selector: '#editor',
                plugins: 'image | lists | table | preview',
                toolbar: 'undo redo | blocks fontfamily fontsize | forecolor bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat ',

                forced_root_block: false,
                image_uploadtab: true,
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        @this.set('document', editor.getContent());
                    });
                }
            });
        </script>


        <div wire:ignore>
            <textarea id="editor" x-model="document"></textarea>
        </div>


        <div class="mt-6 flex justify-end">
            <button type="submit" wire:click="store"
                class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                </svg>
                Simpan
            </button>

            @if ($this->id)
                <button type="submit" wire:click="update({{ $this->id }})"
                    class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                    </svg>
                    Update
                </button>
            @endif
        </div>

        <iframe
            srcdoc="
        <!DOCTYPE html>
        <html>
            <head>
                <base href=&quot;http://127.0.0.1:8000/&quot;>
                <link type=&quot;text/css&quot; rel=&quot;stylesheet&quot; href=&quot;https://cdn.tiny.cloud/1/p804o88945yrug6ccy4fws1gwki3o79jtfdiumucs5xexfec/tinymce/7.1.1-60/skins/ui/oxide/content.min.css&quot; crossorigin=&quot;anonymous&quot;>
                <link type=&quot;text/css&quot; rel=&quot;stylesheet&quot; href=&quot;https://cdn.tiny.cloud/1/p804o88945yrug6ccy4fws1gwki3o79jtfdiumucs5xexfec/tinymce/7.1.1-60/skins/content/default/content.min.css&quot; crossorigin=&quot;anonymous&quot;>
            </head>
            <body id=&quot;tinymce&quot; class=&quot;mce-content-body &quot;>
            {{ $document }}
                
                <script>
                    document.addEventListener & amp; & amp;
                    document.addEventListener( & quot; click & quot;, function(e) {
                        for (var elm = e.target; elm; elm = elm.parentNode) {
                            if (elm.nodeName === & quot; A & quot; & amp; & amp; !(e.ctrlKey & amp; & amp; !e.altKey)) {
                                e.preventDefault();
                            }
                        }
                    }, false);
                </script> 
            </body>
            </html>"
            sandbox="allow-scripts allow-same-origin" data-alloy-tabstop="true" tabindex="-1" class="w-full"
            onload="this.style.height=(this.contentDocument.body.scrollHeight+45) +'px';">
        </iframe>
        <div>
            @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>

</div>
