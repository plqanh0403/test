@props(['box_name',
        'select_name'
])

<div class="col-lg-2">
    <label class="form-label fw-semibold text-secondary mb-2">
        {{ $box_name}}
    </label>

    <select name="{{ $select_name}}" class="form-control filter-select p-2 text-secondary">

        {{ $slot  }}

    </select>
</div>
