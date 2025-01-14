<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task ') }} {{ $task->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <p><span class="font-bold">Title:</span> {{ $task->title }}</p>
                        <p><span class="font-bold">Description:</span> {{ $task->description }}</p>
                        <p><span class="font-bold">Date Limit:</span> {{ date_format($task->date_limit, 'd/m/Y') }}</p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('tasks.index') }}">
                            <button class="bg-red-400 py-1 px-2 rounded-lg">Voltar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
