@extends('layouts.web')

@section('title','Profile')

@section('body')

<div class="container mx-auto px-6">

    <h3 class="text-gray-700 text-2xl font-medium">Profile</h3>
    <div class="flex flex-col md:flex-row mt-8">

        <div class="w-full md:w-1/3 order-1 flex flex-none md:flex-col md:justtify-end ">

            @include("user.partials.navbarProfile")

        </div>

        <div class="w-full mb-8 flex-shrink-0 order-2 md:w-2/3 md:mb-0 md:order-2 ">

            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Profile
            </h4>
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="{{ route('user.profile.update') }}" method="POST">

                    @csrf
                    @method("PUT")

                    {{-- Pesan berhasil atau tidak --}}
                    @if (session()->has('success'))
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-green-800 border border-green-600">
                        <p class="text-sm text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </p>
                    </div>
                    @endif

                    @if (session()->has('error'))
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-red-800 border border-red-600">
                        <p class="text-sm text-red-600 dark:text-red-400">
                            {{ session('error') }}
                        </p>
                    </div>
                    @endif


                    <div class="">

                        <input class="w-1/3" name="photo[]" id="photo" type="file" data-max-file-size="512KB"
                            data-max-files="1" accept="image/png, image/jpeg, image/gif" required />
                    </div>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nama</span>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" required
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                        @error('name')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </label>

                    <div class="mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Username</span>
                        <input type="text" name="username" value="{{ auth()->user()->username }}" required
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                        @error('username')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Email</span>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" required
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="" />
                        @error('email')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">KTP</span>
                        <input type="text" name="ktp" value="{{ auth()->user()->ktp }}" required maxlength="16"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="" />
                        @error('ktp')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">No HP</span>
                        <input type="text" name="nohp" value="{{ auth()->user()->no_hp }}" maxlength="13"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="" />
                        @error('nohp')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-4 w-full justify-items-start">
                        <button type="submit"
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>

            <x-section-border />

            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Password
            </h4>
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="{{ route('user.profile.update.password') }}" method="POST">

                    @csrf
                    @method("PUT")

                    {{-- Pesan berhasil atau tidak --}}
                    @if (session()->has('success'))
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-green-800 border border-green-600">
                        <p class="text-sm text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </p>
                    </div>
                    @endif

                    @if (session()->has('error'))
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-red-800 border border-red-600">
                        <p class="text-sm text-red-600 dark:text-red-400">
                            {{ session('error') }}
                        </p>
                    </div>
                    @endif

                    {{-- Bagion form --}}
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Password lama</span>
                        <input type="password" name="current_password" required maxlength="13"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                        @error('current_password')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </label>

                    <div class="mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Password baru</span>
                        <input type="password" name="password" required maxlength="13"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                        @error('password')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Confirmasi Password Baru</span>
                        <input type="password" name="password_confirmation" required maxlength="13"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </div>

                    <div class="mt-4 w-full justify-items-start">
                        <button type="submit"
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>

            <x-section-border />

            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Social Media
            </h4>

            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                Anda dapat menambahkan social media anda disini
                sebagai tambahan kontak yang anda miliki

                {{-- Pesan berhasil atau tidak --}}
                @if (session()->has('success'))
                <div class="px-4 py-3 my-8 bg-white rounded-lg shadow-md dark:bg-green-800 border border-green-600">
                    <p class="text-sm text-green-600 dark:text-green-400">
                        {{ session('success') }}
                    </p>
                </div>
                @endif

                @if (session()->has('error'))
                <div class="px-4 py-3 my-8 bg-white rounded-lg shadow-md dark:bg-red-800 border border-red-600">
                    <p class="text-sm text-red-600 dark:text-red-400">
                        {{ session('error') }}
                    </p>
                </div>
                @endif

                <form action="{{ route('user.sosmed.add') }}" method="POST">

                    <div class="grid grid-cols-3 gap-4 mt-4 ">
                        @csrf

                        <div class="mb-4 text-sm ">
                            <span class="text-gray-700 dark:text-gray-400">
                                Social Media
                            </span>
                            <select required name="sosmedId"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                <option>-----</option>
                                @foreach ($socialMedias as $socialMedia)
                                <option value="{{ $socialMedia->id }}">{{ $socialMedia->sosmed }}</option>
                                @endforeach
                            </select>
                            @error('sosmedId')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Link Social Media</span>
                            <input type="url" name="sosmedLink" required
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                            @error('sosmedLink')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <span>&nbsp;</span>
                            <button type="submit"
                                class="block px-3 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>

                    </div>
                </form>

                <div class="w-full overflow-hidden rounded-lg shadow-xs my-4">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Sosmed</th>
                                    <th class="px-4 py-3">Link</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($userSocialMedias as $userSocialMedia)

                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <!-- Avatar with inset shadow -->
                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="{{ '/storage/'.$userSocialMedia->socialMedia->icon_path }}"
                                                    alt="" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner"
                                                    aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold">{{  $userSocialMedia->socialMedia->sosmed }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm hover:underline">
                                        <form action="{{ route('user.sosmed.update', $userSocialMedia) }}" method="POST" id="formUpdateLinkSosmed">
                                            @csrf
                                            @method("PUT")
                                            <div class="mb-4 text-sm">
                                                <input type="url" name="updateLink" value="{{ $userSocialMedia->link }}"
                                                    required
                                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                                @error('updateLink')
                                                <span class="text-xs text-red-600 dark:text-red-400">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </form>
                                        {{-- <a href="{{  $userSocialMedia->link }}" target="_blank" rel="noopener
                                        noreferrer">{{  $userSocialMedia->link }}</a> --}}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm">

                                            <button type="submit" form="formUpdateLinkSosmed"
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Edit">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <form action="{{ route('user.sosmed.delete', $userSocialMedia) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin akan menghapus ini?')"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Delete">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <x-section-border />

            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Hapus akun
            </h4>

            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                Jika melakukan ini semua data akan dihapus tanpa tersisa dari sistem,
                harap simpan semua data yang ingin anda tetap simpan di tempat penyimpanan lainnya

                <form action="{{ route('user.profile.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mt-4 w-full justify-items-start">
                        <button type="submit" onclick="return confirm('Yakin akan melakukan tindakan ini?')"
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            Hapus Akun
                        </button>
                    </div>
                </form>

            </div>


        </div>

    </div>
</div>

@endsection

@section('script')

<script>
    FilePond.registerPlugin(
        // encodes the file as base64 data
        FilePondPluginFileEncode,
        
        // validates the size of the file
        FilePondPluginFileValidateSize,
        
        // corrects mobile image orientation
        FilePondPluginImageExifOrientation,
        
        // previews dropped images
        FilePondPluginImagePreview,

        // validatae type
        FilePondPluginFileValidateType,

        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        FilePondPluginImageTransform,
        FilePondPluginFilePoster,

    );

    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="photo"]');
    // Create a FilePond instance
    const pond = FilePond.create(inputElement, 
    {
        labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
        imagePreviewHeight: 170,
        imageCropAspectRatio: '1:1',
        imageResizeTargetWidth: 200,
        imageResizeTargetHeight: 200,
        stylePanelLayout: 'compact circle',
        styleLoadIndicatorPosition: 'center bottom',
        styleProgressIndicatorPosition: 'right bottom',
        styleButtonRemoveItemPosition: 'left bottom',
        styleButtonProcessItemPosition: 'right bottom',
        files: [
            {
                    // the server file reference
                    source: '1234',

                    // set type to local to indicate an already uploaded file
                    options: {
                        // type: 'local',

                        // optional stub file information
                        file: {
                            name: 'my-file.png',
                            size: 3001025,
                            type: 'image/png',
                        },

                        // pass poster property
                        metadata: {poster: '{{ auth()->user()->profile_photo_url }}',},
                    },

            },
        ],
    });
    //setup upload file
    FilePond.setOptions({
        server: {
            url: '/riceField/upload',
            process: '/add',
            revert: '/delete',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>

@endsection