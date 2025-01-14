<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end">
                        <a href="{{ route('tasks.create') }}">
                            <button class="button bg-blue-500 py-1 px-2 rounded-lg">Create Task</button>
                        </a>
                    </div>
                    <hr class="mt-2">
                    @if (session('success'))
                        <p class="text-green-600">{{ session('success') }}</p>
                    @endif
                    <table class="mt-3 table-fixed w-full">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Date Limit</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ Str::limit($task->description, 40, '...') }}</td>
                                    <td>{{ $task->is_completed }}</td>
                                    <td>{{ date_format($task->date_limit, "d/m/Y") }}</td>
                                    <td>
                                        <a href="{{ route('tasks.show', $task) }}">Show</a>
                                        <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit">Delete</button>
                                        </form>
                                        <form action="{{ route('tasks.complete', $task) }}" method="POST">
                                            @csrf
                                            <button type="submit">{{ $task->is_completed ? 'Marcar como pendente' : 'Marcar como concluída' }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Nenhuma task encontrada. Para adicionar uma task <a href="{{ route('tasks.create') }}" class="text-blue-500">clique aqui</a></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
