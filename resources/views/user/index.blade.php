<div>
    <div
        class="block p-6 bg-white border border-gray-200 rounded-lg shadow  dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="mb-3">
            <x-button info icon="plus" label="Tambah Baru" onclick="$openModal('myModal')" />
        </div>
        <x-modal name="myModal" x-on:close-user-modal.window="close">
            <x-card title="Tambah Pengguna">
                <div class="flex flex-col gap-3">
                    <div>
                        <x-input label="Nama" placeholder="Nama" wire:model="name" />
                    </div>
                    <div>
                        <x-input label="Surel" placeholder="Surel" wire:model="email" />
                    </div>
                    <div>
                        <x-input label="No Telepon" placeholder="No Telepon" wire:model="phone" />
                    </div>
                    <div>
                        <x-select label="Jabatan" placeholder="Jabatan" wire:model="role">
                            @foreach ($roles as $role)
                                <x-select.option label="{{ $role }}" value="{{ $role }}" />
                            @endforeach
                        </x-select>
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button info label="Tambah" wire:click="store" />
                    </div>
                </x-slot>
            </x-card>
        </x-modal>
        <div class=" relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Surat Elektronik
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Telefon
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
