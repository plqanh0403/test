@props([
    'id',
    'title',
    'size' => 'lg'
])

<div
    class="modal fade"
    id="{{ $id }}"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-{{ $size }}">

        <div class="modal-content border-0 rounded-4 shadow-lg">

            <div class="modal-header">

                <h4 class="modal-title">
                    {{ $title }}
                </h4>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                {{ $slot }}

            </div>

        </div>

    </div>

</div>