@extends('layouts.default')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Task list') }}
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                <div></div>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                    {{ __('New') }}
                </a>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('#') }}</th>
                    <th>{{ __('Maximum execution date') }}</th>
                    <th>{{ __('User') }}</th>
                    <th>{{ __('Responsible') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr class="@if($task->expired) table-danger @endif">
                        <th>{{ $task->id }}</th>
                        <td>{{ $task->maximum_execution_date }}</td>
                        <td>{{ $task->user->name }}</td>
                        <td>{{ $task->responsible->name }}</td>
                        <td class="text-right">
                            <a href="{{ route('tasks.show', $task) }}">
                                {{ __('Details') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $tasks->links() }}
        </div>
    </div>
@endsection
