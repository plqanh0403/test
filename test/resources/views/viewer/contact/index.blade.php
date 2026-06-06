@extends('viewer.layout')

@section('title', 'Contact Us - EGEAD')
@section('description', 'Contact EGEAD for technology solutions, recruitment and consulting services.')

@section('content')

<section class="contact-section">
    <div class="container">

        <!-- HEADER -->
        <div class="section-heading text-center">
            <span class="section-badge">Contact</span>

            <h2>Let’s Talk About Your Project</h2>

            <p>
                Have a question or need a solution? Send us a message and we’ll get back to you shortly.
            </p>
        </div>

        <div class="row g-5 align-items-stretch">

            <!-- LEFT: COMPANY INFO -->
            <div class="col-lg-4 d-flex">

                <div class="contact-info w-100">

                    <div class="contact-info-box h-100">
                        <h2>
                            Let’s Talk With Us
                        </h2>

                        <p>
                            We’re here to help your business grow. Feel free to reach out to us anytime.
                        </p>

                        <div class="contact-list">

                            <div class="contact-item">
                                <div class="icon">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div>
                                    <h5>Phone</h5>
                                    <p>{{ $about_us->phone }}</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div>
                                    <h5>Email</h5>
                                    <p>{{ $about_us->email }}</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div>
                                    <h5>Address</h5>
                                    <p>{{ $about_us->address }}</p>
                                </div>
                            </div>

                        </div>

                        <div class="contact-map position-relative">
                            {!! $about_us->google_map !!}
                        </div>
                    </div>

                </div>

            </div>

            <!-- RIGHT: FORM -->
            <div class="col-lg-8 d-flex">

                <div class="contact-form w-100 h-100">

                    <!-- HEADER -->
                    <div class="contact-form-header">
                        <span class="section-badge">Keep In Touch</span>

                        <h3>Let’s Start Your Project</h3>

                        <p>
                            Whether you're planning a new digital product, modernizing existing systems,
                            or exploring innovative technology solutions, our experts are ready to help.
                            Tell us about your vision, and we'll work with you to create the most effective strategy for your business.
                        </p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('viewer.contact.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">
                                <input type="text" name="name" placeholder="Your Name" required>
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email" placeholder="Your Email" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="phone" placeholder="Phone Number">
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="company" placeholder="Company">
                            </div>

                            <div class="col-12">
                                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="contact-btn">
                                    Send Message
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection
