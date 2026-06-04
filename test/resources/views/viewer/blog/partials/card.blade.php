<div class="blog-image">
    <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->thumbnail_alt ?? $blog->title }}">
</div>

<div class="blog-content">
    @if ($blog->category)
        <span class="blog-category"> {{ $blog->category->name }} </span>
    @endif
    <div class="blog-meta">
        <span>
            <i class="bi bi-calendar3"></i> {{ optional($blog->published_at)->format('d M Y') }}
        </span>
    </div>
    <h3> {{ $blog->title }} </h3>

    <p> {{ Str::limit($blog->excerpt, 120) }} </p>

    <div class="blog-read-more">
        Read Article <i class="bi bi-arrow-right"></i>
    </div>
</div>
