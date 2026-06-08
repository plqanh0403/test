@extends('admin.layout.layoutAdmin1')

@section('content')

<x-admin.page-header
    title="EGEAD Headquarters"
    description="Everything about your company in one place — branding, contacts, HR information, social media and SEO settings.">

    <x-slot:action>

        @if(!$about_us)
            <a href="#" class="btn btn-create"> {{-- {{ route('admin.about_us.create') }} --}}

                <i class="bi bi-plus-lg"></i>
                Create Profile

            </a>

        @else

            <a href="#" class="btn btn-edit"> {{--{{ route('admin.about_us.edit', $about_us) }}--}}

                <i class="bi bi-pencil-fill"></i>
                Edit Profile

            </a>

            <form action="{{ route('admin.about_us.destroy', $about_us) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <button class="btn btn-delete">

                    <i class="bi bi-trash-fill"></i>
                    Delete

                </button>

            </form>

        @endif

    </x-slot:action>

</x-admin.page-header>

@if($about_us)

<div class="about-container">

    <div class="about-header">

        <div class="logo-box">

            @if($about_us->light_logo)
                <img src="{{ asset($about_us->light_logo) }}">
            @endif

        </div>

        <div>

            <h2>{{ $about_us->name }}</h2>

            <p>{{ $about_us->slogan }}</p>

        </div>

        <div class="action-group">

            <a href="{{ route('admin.about_us.update',$about_us) }}"
               class="btn-edit">

                <i class="bi bi-pencil-fill"></i>

                Edit

            </a>

            <form method="POST" action="{{ route('admin.about_us.destroy', $about_us) }}">

                @csrf
                @method('DELETE')

                <button class="btn-delete">

                    <i class="bi bi-trash-fill"></i>

                    Delete

                </button>

            </form>

        </div>

    </div>


    <div class="info-grid">

        <div class="card">
            <h4>Company</h4>

            <p><b>Email:</b> {{ $about_us->email }}</p>

            <p><b>Phone:</b> {{ $about_us->phone }}</p>

            <p><b>Address:</b> {{ $about_us->address }}</p>

        </div>


        <div class="card">

            <h4>HR Contact</h4>

            <p><b>Email:</b> {{ $about_us->hr_email }}</p>

            <p><b>Phone:</b> {{ $about_us->hr_phone }}</p>

        </div>


        <div class="card">

            <h4>Social Media</h4>

            <div class="social">

                <a href="{{ $about_us->facebook }}">
                    <i class="bi bi-facebook"></i>
                </a>

                <a href="{{ $about_us->youtube }}">
                    <i class="bi bi-youtube"></i>
                </a>

                <a href="{{ $about_us->linkedin }}">
                    <i class="bi bi-linkedin"></i>
                </a>

                <a href="{{ $about_us->tiktok }}">
                    <i class="bi bi-tiktok"></i>
                </a>

            </div>

        </div>


        <div class="card">

            <h4>SEO Information</h4>

            <p>{{ $about_us->seo_title }}</p>

            <p>{{ $about_us->canonical_url }}</p>

        </div>

    </div>

</div>

@endif

@endsection