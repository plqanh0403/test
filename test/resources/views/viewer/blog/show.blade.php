@extends('viewer.layout')

@section('title', $blog->seo_title ?? $blog->title)
@section('description', $blog->seo_description ?? $blog->excerpt)

@section('content')

<section class="blog-detail">

    <div class="container">

        <div class="blog-hero">

            <span class="section-badge">

                {{ $blog->type == 'tech-service'
                    ? 'Tech Service'
                    : 'EGEAD Activity' }}

            </span>

            <h1>
                {{ $blog->title }}
            </h1>

            <div class="blog-detail-meta">

                <span>
                    {{ $blog->user->name }}
                </span>

                <span>
                    {{ optional($blog->published_at)->format('d M Y') }}
                </span>

            </div>

        </div>

        <div class="blog-feature-image">

            <img src="{{ asset($blog->thumbnail) }}"
                 alt="{{ $blog->thumbnail_alt }}">
        </div>

        <div class="blog-content">

            {!! $blog->content !!}

        </div>

    </div>

</section>

@endsection
