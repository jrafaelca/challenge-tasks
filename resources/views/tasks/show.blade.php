@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    {{ __('Task details') }}
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tbody>
                        <tr>
                            <td>{{ __('#') }}</td>
                            <td>{{ $task->id }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Maximum execution date') }}</td>
                            <td>{{ $task->maximum_execution_date }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Responsible') }}</td>
                            <td>{{ $task->responsible->name }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">{{ __('Description') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">{{ $task->description }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Logs') }}
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>{{ __('Comment') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($task->logs->isEmpty())
                            <tr class="text-center">
                                <td colspan="3">{{ __('No comments yet.') }}</td>
                            </tr>
                        @endif

                        @foreach($task->logs as $log )
                            <tr>
                                <td>{{ $log->body }}</td>
                                <td>{{ $log->user->name }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <form method="POST" action="{{ route('tasks.logs.store', $task) }}">
                        @csrf

                        <input type="hidden" name="task_id" value="{{ $task->id }}">

                        <div class="form-group">
                            <label for="body">
                                {{ __('Body message') }}
                            </label>
                            <textarea
                                id="body"
                                name="body"
                                rows="6"
                                value="{{ old('body') }}"
                                class="form-control @error('body') is-invalid @enderror"
                                aria-describedby="body-feedback"
                                autofocus
                            ></textarea>

                            @error('body')
                            <span id="body-feedback" class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Add log') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
