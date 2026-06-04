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
            @if($blogs->count() > 0)

                @php
                    $featuredMain = $blogs->first();

                    $featuredSide = $blogs->slice(1, 3);

                    $normalBlogs = $blogs->slice(4);
                @endphp

                {{-- FEATURED MAIN --}}
                <a href="{{ route('viewer.blogs.show', $featuredMain->slug) }}" class="featured-blog">

                    <div class="featured-image">
                        <img src="{{ asset('images/hero3.jpg') }}" alt="{{ $featuredMain->thumbnail_alt }}"> /*featuredMain->thumbnail*/
                    </div>

                    <div class="featured-content">

                        <span class="featured-badge">
                            Featured Article
                        </span>

                        <h2>
                            {{ $featuredMain->title }}
                        </h2>

                        <p>
                            {{ Str::limit($featuredMain->excerpt, 100) }}
                        </p>

                        <div class="blog-read-more">
                            Read Article
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </div>

                </a>

                {{-- SECONDARY FEATURED --}}
                @if($featuredSide->count() >= 3)

                    <div class="featured-secondary-grid">

                        <div class="featured-secondary-left">

                            @foreach($blogs->skip(1)->take(2) as $blog)
                                @include('viewer.blog.partials.featured-horizontal')
                            @endforeach

                        </div>

                        <div class="featured-secondary-right">

                            @php
                                $verticalBlog = $blogs->skip(3)->first();
                            @endphp

                            @if($verticalBlog)
                                @include('viewer.blog.partials.featured-vertical', ['blog' => $verticalBlog])
                            @endif
                        </div>

                    </div>

                @endif

            @endif

            <div class="blog-grid-wrapper">
                <div class="blog-grid-label">
                    <span>
                        Latest Articles
                    </span>
                </div>

                <!-- BLOG GRID -->
                <div class="blog-grid">

                    @foreach ($normalBlogs as $blog)
                        @include('viewer.blog.partials.card')
                    @endforeach

                </div>
            </div>

        </div>

    </section>

@endsection
