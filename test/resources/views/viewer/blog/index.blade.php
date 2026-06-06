@extends('viewer.layout')

@section('title', 'Blogs - EGEAD')
@section('description', 'Technology insights and EGEAD activities.')

@section('content')

    <section class="blog-page">

        <div class="container">

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
            @if($featuredBlogs->count() > 0)

                @php
                    $featuredMain = $featuredBlogs->first();
                    $featuredSide = $featuredBlogs->skip(1)->take(3);
                @endphp

                {{-- FEATURED MAIN --}}
                <a href="{{ route('viewer.blogs.show', $featuredMain->slug) }}" class="featured-blog">

                    <div class="featured-image">
                        <img src="{{ asset($featuredMain->thumbnail) }}" alt="{{ $featuredMain->thumbnail_alt }}">
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

                        <div class="blog-meta-row">

                            <div class="blog-meta">
                                <i class="bi bi-calendar3"></i>
                                {{ date('d M Y', strtotime($featuredMain->published_at)) }}
                            </div>

                            @if($featuredMain->category)
                                <span class="blog-category">
                                    {{ $featuredMain->category->name }}
                                </span>
                            @endif

                        </div>

                        <div class="blog-read-more">
                            Read Article
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </div>

                </a>

                {{-- SECONDARY FEATURED --}}
                @if($featuredSide->count() >= 3)
                    @php
                        $horizontalBlogs = $featuredSide->take(2);
                        $verticalBlog = $featuredSide->slice(2,1)->first();
                    @endphp

                    <div class="featured-secondary-grid">

                        <div class="featured-secondary-left">

                            @foreach($horizontalBlogs as $blog)
                                @include('viewer.blog.partials.featured-horizontal')
                            @endforeach

                        </div>

                        <div class="featured-secondary-right">
                            @if($verticalBlog)
                                @include('viewer.blog.partials.featured-vertical', ['blog' => $verticalBlog])
                            @endif
                        </div>

                    </div>

                @endif

            @endif

            <div class="section-heading text-center">
                <h2>
                    Insights, Technology & Activities
                </h2>
            </div>

            <div class="blog-grid-wrapper" id="blog-list">
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

                <div class="blog-pagination-center">
                    {{ $normalBlogs->fragment('blog-list')->links() }}
                </div>
            </div>

        </div>

    </section>

@endsection
