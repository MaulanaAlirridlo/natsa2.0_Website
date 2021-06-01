<x-app-layout title="Regions">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Regions
        </h2>

        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Region Add
            </h4>
            <form action="{{ route('admin.regions') }}" method="POST" id="regionAdd">
                @csrf
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Provinsi</span>
                        <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Jane Doe" name="provinsi" />
                    </label>
                    
                    <div class="mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                        Kabupaten
                    </span>
                    <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Kabupaten" name="kabupaten" />
                </div>
            </form>
            
        </div>
            

        <div class="">
            <a href="{{ route('admin.regions') }}">
                <button
                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Batal
                </button>
            </a>

            <button type="submit" form="regionAdd"
                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Tambah Daerah
            </button>

            
        </div>

    </div>

</x-app-layout>