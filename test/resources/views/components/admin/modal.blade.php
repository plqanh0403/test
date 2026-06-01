@props([
'id',
'size' => 'lg'
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-{{ $size }}">

        <div class="modal-content border-0 rounded-4 shadow-lg">

            <div class="modal-header d-flex justify-content-between align-items-start">

                {{ $title }}

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body px-4 pb-4">

                {{ $slot }}

            </div>

            @isset($footer)
                <div class="modal-footer d-flex justify-content-end gap-1 mt-6">
                    {{ $footer }}
                </div>
            @endisset

        </div>

    </div>

</div>