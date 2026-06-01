@props(['role'])

@if($role === 'superAdmin')
    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
        Super Admin
    </span>

@elseif($role === 'admin')
    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
        Admin
    </span>

@else
    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
        Editor
    </span>
@endif