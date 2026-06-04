<a href="{{ route('viewer.blogs.show', $blog->slug) }}" class="featured-horizontal-card">

    <div class="blog-image">
        <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->thumbnail_alt ?? $blog->title }}">
    </div>

    <div class="blog-content">

        <h3>{{ $blog->title }}</h3>

        <p>
            {{ Str::limit($blog->excerpt, 100) }}
        </p>

        <div class="blog-meta-row">

            <div class="blog-meta">
                <i class="bi bi-calendar3"></i>
                {{ date('d M Y', strtotime($blog->published_at)) }}
            </div>

            @if($blog->category)
                <span class="blog-category">
                    {{ $blog->category->name }}
                </span>
            @endif
        </div>

        <div class="blog-read-more">
            Read Article
            <i class="bi bi-arrow-right"></i>
        </div>

    </div>

</a>
