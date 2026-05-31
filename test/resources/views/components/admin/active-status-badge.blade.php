@props(['active'])

@if($active)
    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full">
        Active
    </span>
@else
    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full">
        Inactive
    </span>
@endif