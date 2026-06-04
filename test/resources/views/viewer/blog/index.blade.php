@extends('viewer.layout')

@section('title', 'Blogs - EGEAD')
@section('description', 'Technology insights and EGEAD activities.')

@section('content')

    <section class="blog-page">

        <div class="container">

            <div class="section-heading text-center">

                <span class="section-badge">
                    EGEAD BLOG
                </span>

                <h2>
                    Insights, Technology & Activities
                </h2>

                <p>
                    Explore the latest technology trends, digital transformation
                    strategies, and company activities from EGEAD.
                </p>

            </div>

            <!-- BLOG TABS -->
            <div class="blog-tabs-viewer">

                <a href="{{ route('viewer.blogs.index', ['type' => 'tech-service']) }}" class="blog-tab-viewer {{ $type == 'tech-service' ? 'active' : '' }}">

                    <div class="blog-tab-icon">
                        <i class="bi bi-cpu-fill"></i>
                    </div>

                    <div class="blog-tab-content">
                        <h5>Technology Services</h5>
                        <small>Insights & Digital Solutions</small>
                    </div>

                    <span>{{ $servicesCount }}</span>

                </a>

                <a href="{{ route('viewer.blogs.index', ['type' => 'EGEAD-activity']) }}" class="blog-tab-viewer {{ $type == 'EGEAD-activity' ? 'active' : '' }}">

                    <div class="blog-tab-icon">
                        <i class="bi bi-calendar-event-fill"></i>
                    </div>

                    <div class="blog-tab-content">
                        <h5>EGEAD Activities</h5>
                        <small>Events & Company Updates</small>
                    </div>

                    <span>{{ $activitiesCount }}</span>

                </a>

            </div>

            <!-- FEATURED BLOG -->
            @if ($blogs->count())
                @php
                    $featured = $blogs->first();
                @endphp

                <a href="{{ route('viewer.blogs.show', $featured->slug) }}" class="featured-blog">

                    <div class="featured-image">

                        <img src="{{ asset('images/hero1.jpg') }}" alt="{{ $featured->thumbnail_alt ?? $featured->title }}"> /*asset($featured->thumbnail)*/

                    </div>

                    <div class="featured-content">

                        <span class="featured-badge">
                            Featured Article
                        </span>

                        <h2>
                            {{ $featured->title }}
                        </h2>

                        <p>
                            {{ Str::limit($featured->excerpt, 250) }}
                        </p>

                        <div class="featured-read">
                            Read Full Article
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </div>

                </a>
            @endif

            <!-- BLOG GRID -->
            <div class="blog-grid">

                @foreach ($blogs->skip(1) as $blog)
                    @include('viewer.blog.partials.card')
                @endforeach

            </div>

        </div>

    </section>

@endsection
