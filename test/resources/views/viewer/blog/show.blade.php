@extends('viewer.layout')

@section('title', $blog->seo_title ?? $blog->title)
@section('description', $blog->seo_description ?? $blog->excerpt)

@section('content')

<section class="blog-detail-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="blog-detail-header">

            <h1>
                {{ $blog->title }}
            </h1>

            <p class="blog-detail-excerpt">
                {{ $blog->excerpt }}
            </p>

            <div class="blog-detail-meta">

                <span>
                    <i class="bi bi-calendar3"></i>
                    {{ date('d M Y', strtotime($blog->published_at)) }}
                </span>

                <span>
                    <i class="bi bi-person-circle"></i>
                    {{ $blog->user->name ?? 'EGEAD Team' }}
                </span>

                <span>
                    <i class="bi bi-clock"></i>
                    {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }}
                    min read
                </span>

                @if($blog->category)
                    <span class="blog-detail-category">
                        {{ $blog->category->name }}
                    </span>
                @endif

            </div>

        </div>

        {{-- COVER --}}
        @if($blog->thumbnail)
            <div class="blog-detail-cover">

                <img src="{{ asset('images/hero1.jpg') }}" {{-- $blog->thumbnail --}}
                     alt="{{ $blog->thumbnail_alt ?? $blog->title }}">

            </div>
        @endif

        {{-- BODY --}}
        <div class="blog-detail-layout">

            {{-- CONTENT --}}
            <div class="blog-detail-content">

                {!! $blog->content !!}

                {{-- SHARE --}}
                <div class="blog-share">

                    <h5>Share Article</h5>

                    <div class="blog-share-buttons">

                        <a href="#">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-linkedin"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-twitter-x"></i>
                        </a>

                    </div>

                </div>

            </div>

            {{-- SIDEBAR --}}
            <aside class="blog-sidebar">

                <div class="blog-sidebar-card">

                    <h4>
                        Related Articles
                    </h4>

                    @foreach($relatedBlogs as $item)

                        <a href="{{ route('viewer.blogs.show',$item->slug) }}" class="related-blog-item">

                            <div class="related-blog-image">

                                <img src="{{ asset('images/hero3.jpg') }}" {{-- $item->thumbnail --}}
                                     alt="{{ $item->thumbnail_alt ?? $item->title }}">

                            </div>

                            <div class="related-blog-content">

                                <span>
                                    {{ date('d M Y', strtotime($item->published_at)) }}
                                </span>

                                <h5>
                                    {{ Str::limit($item->title,70) }}
                                </h5>

                            </div>

                        </a>

                    @endforeach

                </div>

            </aside>

        </div>

    </div>

</section>

@endsection
