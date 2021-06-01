<x-app-layout title="Users">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Users
        </h2>

        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                User Add
            </h4>
            <form action="{{ route('admin.users.update', $user) }}" method="POST" id="userPut">
                @csrf
                @method('PUT')
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Name</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Name" name="name" type="text" required autofocus value="{{ $user->name }}"/>
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">Email</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Email" name="email" type="email" required value="{{ $user->email }}"/>
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">Role</span>
                        <select name="role" id="role" required
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option @if ($user->role = "") selected @endif value="">---</option>
                            <option @if ($user->role = "dev") selected @endif value="dev">Dev</option>
                            <option @if ($user->role = "admin") selected @endif value="admin">Admin</option>
                            <option @if ($user->role = "user") selected @endif value="user">User</option>
                        </select>

                    </label>

                </div>
            </form>
            
        </div>
            

        <div class="">
            <a href="{{ route('admin.users') }}">
                <button
                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Batal
                </button>
            </a>

            <button type="submit" form="userPut"
                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Update User
            </button>

        </div>

    </div>

</x-app-layout>