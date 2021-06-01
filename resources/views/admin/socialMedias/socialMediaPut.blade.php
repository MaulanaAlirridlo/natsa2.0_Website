<x-app-layout title="Social Media">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Social Media
        </h2>

        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Sociall Media Edit
            </h4>
            <form action="{{ route('admin.socialMedias.update', $socialMedia) }}" method="POST" id="socialMediaPut" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Social Media</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Social Media" name="sosmed" value="{{ $socialMedia->sosmed }}"/>
                    </label>

                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ '/storage/'.$socialMedia->icon_path }}" class="object-cover w-20 h-20 rounded-full">
                    </div>

                    <div class="mt-4">
                        <x-label for="icon" :value="__('Choose Icon')" />
                        <x-input id="icon" class="block mt-1 w-full" type="file" name="icon" id="icon"/>
                    </div>
                </div>
            </form>
            
        </div>
            

        <div class="">
            <a href="{{ route('admin.socialMedias') }}">
                <button
                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Batal
                </button>
            </a>

            <button type="submit" form="socialMediaPut"
                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Update Social MEdia
            </button>

        </div>

    </div>

</x-app-layout>