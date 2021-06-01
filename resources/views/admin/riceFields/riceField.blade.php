<x-app-layout title="Sawah">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Sawah
        </h2>

        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Pemilik</th>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Luas</th>
                            <th class="px-4 py-3">Alamat</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Sertifikasi</th>
                            <th class="px-4 py-3">Tipe</th>
                            <th class="px-4 py-3">Dibuat</th>
                            <th class="px-4 py-3">Bekas</th>
                            <th class="px-4 py-3">Irigasi</th>
                            <th class="px-4 py-3">Daerah</th>
                            <th class="px-4 py-3">Verifikasi</th>
                            <th class="px-4 py-3" colspan="2">Menu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($riceFields as $riceField)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                {{ $riceField->id }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->user->name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->title }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->harga }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->luas }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->alamat }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->deskripsi }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->sertifikasi }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->tipe }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->created_at }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->vestige }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->irrigation }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->region }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $riceField->verification }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <form action="{{ route('admin.riceFields.delete', $riceField) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.riceFields.put', $riceField) }}">
                                    
                                    <button type="submit"
                                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                        Edit
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>

            {{ $riceFields->links('admin.pagination') }}


        </div>

        <div class="mt-6">
            <a href="{{ route('admin.riceFields.add') }}">
                <button
                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Tambah Sawah
                </button>
            </a>
        </div>

    </div>

</x-app-layout>