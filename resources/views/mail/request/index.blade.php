<div>

    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:hover:bg-gray-700">
        <div>
            <x-button info label="Buat Baru" href="{{ route('mail.request.create') }}" />
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
                                {{ $mail->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $mail->created_at }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $mail->status }}
                            </td>

                            <td class="px-6 py-4">
                                <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    href="{{ route('mail.request.edit', $mail->id) }}">Edit</a>
                            </td>
                        </tr>
                    @empty
                    @endforelse



                </tbody>
            </table>
        </div>
    </div>


</div>
