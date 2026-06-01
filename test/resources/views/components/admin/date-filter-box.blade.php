@props(['date_name',
        'input_name',
        'request_name'
])

<div class="col-lg-2">
    <label class="form-label fw-semibold text-secondary mb-2">
        <i class="bi bi-calendar-event me-1 "></i>
        {{ $date_name }}
    </label>

    <input type="date" name="{{ $input_name }}" class="form-control filter-select p-2 text-secondary" value="{{ request($request_name) }}">
</div>
