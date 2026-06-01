@props(['active'])

@if($active)
    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
        Active
    </span>
@else
    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
        Inactive
    </span>
@endif