@extends('layouts.default')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit task') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">

                        @include('tasks.fields')

                        <a href="{{ route('tasks.index') }}" class="btn btn-light">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save changes') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
