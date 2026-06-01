@props(['route',
        'placeholder'
])

<div class="bg-white rounded-4 shadow-sm p-4 mb-4 border">

    <form action="{{ $route }}" method="GET">

        @if(request('type'))
        <input type="hidden"
               name="type"
               value="{{ request('type') }}">
        @endif

        <div class="row g-3 align-items-end">

            <!-- Search -->
            <div class="col-lg-6">
                <label class="form-label fw-semibold text-secondary mb-2">
                    Search
                </label>

                <div class="input-group search-box">
                    <i class="bi bi-search text-muted p-2"></i>

                    <input type="text" name="search" class="form-control" placeholder="{{ $placeholder}}"
                        value="{{ request('search') }}">
                </div>
            </div>

            {{ $slot }}

            <!-- Buttons -->
            <div class="col-lg-2">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-filter flex-fill">
                        <i class="bi bi-funnel-fill me-1"></i>
                        Filter
                    </button>

                    <a href="{{ $route }}"
                        class="btn btn-outline-secondary btn-reset text-dark d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
