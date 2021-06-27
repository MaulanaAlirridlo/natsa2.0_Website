<x-app-layout title="Sawah">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Sawah
        </h2>

        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Sawah Add
            </h4>
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Pemilik</span>
                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        disabled value="{{ $riceField->user->name }}"/>
                </label>

                <label class="block text-sm mt-4">
                    <span class="text-gray-700 dark:text-gray-400">Judul</span>
                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        disabled value="{{ $riceField->title }}" />
                </label>

                <div class="grid grid-cols-2 gap-4 mt-4">

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Harga
                        </span>
                        <div class="relative">
                            <input
                                class="block w-full pl-20 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                                disabled value="{{ $riceField->harga }}" />
                            <button disabled
                                class="absolute inset-y-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-l-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                Rp
                            </button>
                        </div>
                    </label>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Luas
                        </span>
                        <div class="relative">
                            <input
                                class="block w-full pl-20 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                                disabled value="{{ $riceField->luas }}" />
                            <button disabled
                                class="absolute inset-y-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-l-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                m<sup>2</sup>
                            </button>
                        </div>
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                
                
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Alamat</span>
                        <textarea
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            rows="3" disabled">{{ $riceField->alamat }}</textarea>
                    </label>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Deskripsi</span>
                        <textarea
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            rows="3" disabled>{{ $riceField->deskripsi }}</textarea>
                    </label>
                
                </div>

                <div class="grid grid-cols-3 gap-4 mt-4">
                
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Maps</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            type="text" disabled value="{{ $riceField->maps }}" />
                    </label>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Sertifikasi</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            type="text" disabled value="{{ $riceField->sertifikasi }}" />
                    </label>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Tipe</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            type="text" disabled value="{{ $riceField->tipe }}" />
                    </label>

                </div>
                
                <label class="block text-sm mt-4">
                    <span class="text-gray-700 dark:text-gray-400">Daerah</span>
                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        type="text" disabled value="{{ $riceField->region }}" />
                </label>

                <div class="grid grid-cols-3 gap-4 mt-4">

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Bekas Sawah</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            type="text" disabled value="{{ $riceField->vestige }}" />
                    </label>
                
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Irigasi</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            type="text" disabled value="{{ $riceField->irrigation }}" />
                    </label>


                </div>

                <div class="block text-sm my-4">
                    <span class="text-gray-700 dark:text-gray-400">Foto</span>
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                        @foreach ($riceField->photos as $photo)
                        <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                            <div class="flex items-end justify-end h-56 w-full bg-cover"
                            style="background-image: url('{{ '/storage/'.$photo->photo_path }}')">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>


        <div class="">
            <a href="{{ route('admin.riceFields') }}">
                <button
                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Kembali
                </button>
            </a>

        </div>

    </div>

</x-app-layout>