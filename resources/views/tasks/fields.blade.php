<div class="form-group">
    <label for="description">
        {{ __('Description') }}
    </label>
    <textarea
        id="description"
        name="description"
        rows="4"
        class="form-control @error('description') is-invalid @enderror"
        aria-describedby="description-feedback"
        autofocus
    >{{ old('description', isset($task) ? $task->description : '') }}</textarea>

    @error('description')
    <span id="description-feedback" class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="maximum_execution_date">
        {{ __('Maximum execution date') }}
    </label>

    <input
        id="maximum_execution_date"
        name="maximum_execution_date"
        type="datetime-local"
        value="{{ old('maximum_execution_date', isset($task) ? $task->maximum_execution_date->format('Y-m-d\TH:i') : '') }}"
        class="form-control @error('maximum_execution_date') is-invalid @enderror"
        aria-describedby="maximum-execution-date-feedback">

    @error('maximum_execution_date')
    <span id="maximum-execution-date-feedback" class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@php
    $selected = old('responsible_id');

    if (!old('responsible_id') && isset($task)){
        $selected = $task->responsible_id;
    }
@endphp

<div class="form-group">
    <label for="responsible_id">
        {{ __('Responsible') }}
    </label>
    <select
        id="responsible_id"
        name="responsible_id"
        class="form-control @error('responsible_id') is-invalid @enderror"
        aria-describedby="responsible-id-feedback"
    >
        <option value="">{{ __('Select a responsible') }}</option>
        @foreach($responsibles as $key => $responsible)
            <option value="{{ $key }}" @if($selected == $key) selected @endif>{{ $responsible }}</option>
        @endforeach
    </select>

    @error('responsible_id')
    <span id="responsible-id-feedback" class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
