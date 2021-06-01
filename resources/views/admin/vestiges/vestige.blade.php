<x-app-layout title="Vestiges">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Vestiges
        </h2>

        {{-- filter --}}
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Filter
            </h4>
            <form action="{{ route('admin.vestiges.search') }}" method="GET" id="regionFilter">
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Search</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Search" name="search" type="search"
                            value="@isset($_GET['search']){{ $_GET['search'] }}@endisset" />
                    </label>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Sort By</span>
                                <select name="sort" id="sort"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">

                                    <option value="">---</option>
                                    <option @isset($_GET['sort']) @if ($_GET['sort']=='id' ) selected @endif
                                        @endisset value="id">ID</option>
                                    <option @isset($_GET['sort']) @if ($_GET['sort']=='vestige' ) selected @endif
                                        @endisset value="vestige">Title</option>
                                    <option @isset($_GET['sort']) @if ($_GET['sort']=='created_at' ) selected @endif
                                        @endisset value="created_at">created at</option>

                                </select>
                            </label>
                        </div>
                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Order</span>
                                <select name="order" id="order"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <option value="">---</option>
                                    <option @isset($_GET['order']) @if ($_GET['order']=='asc' ) selected @endif
                                        @endisset value="asc">Asc</option>
                                    <option @isset($_GET['order']) @if ($_GET['order']=='desc' ) selected @endif
                                        @endisset value="desc">Desc</option>

                                </select>
                            </label>
                        </div>
                    </div>


                    <button type="submit"
                        class="px-5 py-3 mt-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Filter
                    </button>
            </form>

        </div>

        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Vestige</th>
                            <th class="px-4 py-3" colspan="2">Menu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($vestiges as $vestige)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                {{ $vestige->id }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $vestige->vestige }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <form action="{{ route('admin.vestiges.delete', $vestige) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.vestiges.put', $vestige) }}">

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

            {{ $vestiges->links('admin.pagination') }}


        </div>

        <div class="mt-6">
            <a href="{{ route('admin.vestiges.add') }}">
                <button
                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Tambah Bekas Sawah
                </button>
            </a>
        </div>

    </div>

</x-app-layout>