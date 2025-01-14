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
                    <div>
                        <form action="{{ route('tasks.index') }}" method="GET">
                            <div>
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" class="block text-black rounded px-1 py-2 w-40" value="{{ $request->title }}">
                            </div>

                            <div>
                                <label for="statusTask">Status:</label>
                                <select name="statusTask" id="statusTask" class="block text-black rounded px-1 py-2 w-40">
                                    <option value="1" {{ $request->statusTask == 1 ? 'selected' : ''}}>All Status</option>
                                    <option value="2" {{ $request->statusTask == 2 ? 'selected' : ''}}>Completed Tasks</option>
                                    <option value="3" {{ $request->statusTask == 3 ? 'selected' : ''}}>Pending Tasks</option>
                                </select>
                            </div>

                            <div class="flex gap-4">
                                <div>
                                    <label for="initialPeriod">Initial Period (Date Limit)</label>
                                    <input type="date" name="initialPeriod" id="initialPeriod" class="block text-black rounded px-1 py-2 w-40" value="{{ $request->initialPeriod }}">
                                </div>
                                <div>
                                    <label for="finalPeriod">Final Period (Date Limit)</label>
                                    <input type="date" name="finalPeriod" id="finalPeriod" class="block text-black rounded px-1 py-2 w-40" value="{{ $request->finalPeriod }}">
                                </div>
                            </div>

                            <div>
                                <input type="submit" value="Search" class="button bg-blue-500 py-1 px-2 rounded-lg mt-4">
                            </div>
                        </form>
                    </div>
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
                                <tr class="hover:bg-gray-600">
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
                                            <button type="submit">{{ $task->is_completed ? 'Mark as pending' : 'Mark as completed' }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Nenhuma task encontrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
