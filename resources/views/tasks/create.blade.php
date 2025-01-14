<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="rounded block text-black w-full">
                        </div>
                        @error('title')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <div>
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" class="rounded block text-black w-full" rows="4"></textarea>
                        </div>
                        @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <div>
                            <label for="date_limit">Date Limit:</label>
                            <input type="date" name="date_limit" id="date_limit" class="rounded block text-black">
                        </div>
                        @error('date_limit')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <div>
                            <input type="submit" value="Create Task" class="button bg-blue-500 py-1 px-2 rounded-lg mt-4">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
