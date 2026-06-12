@extends('viewer.layout')

@section('title', $serviceCategory->seo_title ?? $serviceCategory->name)
@section('description', $serviceCategory->seo_description)

@section('content')

<section class="services-page">

    <div class="container">

        <section class="service-category-hero">

            <div class="hero-image">

                <img src="{{ Storage::url($serviceCategory->banner_image) }}" alt="{{ $serviceCategory->name }}">

            </div>

            <div class="service-category-hero-content">

                <span class="section-badge">
                    Service Category
                </span>

                <h1>
                    {{ $serviceCategory->name }}
                </h1>

                <p>
                    {{ $serviceCategory->description }}
                </p>

                <div class="hero-stat">

                    <strong>
                        {{ $services->count() }}
                    </strong>

                    <span>
                        Services Available
                    </span>

                </div>

            </div>

        </section>

        <section class="why-section">

            <div class="row align-items-center">

                <!-- LEFT -->
                <div class="col-lg-6 mb-4">

                    <span class="section-badge">
                        Why Choose E-GEAD
                    </span>

                    <h2 class="why-title">
                        Technology That Drives Business Growth
                    </h2>

                    <p class="why-desc">
                        E-GEAD delivers modern technology solutions that empower organizations to automate processes,
                        improve operational efficiency, and build a scalable digital foundation for long-term growth.
                        Our services are designed to integrate seamlessly with existing systems while providing the flexibility required for future expansion.
                    </p>

                    <a href="#list" class="why-btn down-btn">
                        Learn More
                        <i class="bi bi-arrow-down"></i>
                    </a>

                </div>

                <!-- RIGHT -->
                <div class="col-lg-6">

                    <div class="why-list">

                        <div class="why-item">
                            <i class="bi bi-lightning-charge"></i>
                            <div>
                                <h4>Unified Operations Management</h4>
                                <p>Centralize business processes, data, and workflows into a single platform for better control and decision-making.</p>
                            </div>
                        </div>

                        <div class="why-item">
                            <i class="bi bi-shield-check"></i>
                            <div>
                                <h4>Real-Time Visibility</h4>
                                <p>Monitor critical business activities with up-to-date information, automated updates, and transparent reporting.</p>
                            </div>
                        </div>

                        <div class="why-item">
                            <i class="bi bi-bar-chart"></i>
                            <div>
                                <h4>Intelligent Process Automation</h4>
                                <p>Reduce manual effort and minimize operational risks through automated workflows and smart synchronization.</p>
                            </div>
                        </div>

                        <div class="why-item">
                            <i class="bi bi-people"></i>
                            <div>
                                <h4>Performance Insights</h4>
                                <p>Gain actionable analytics to improve efficiency, identify bottlenecks, and support strategic planning.</p>
                            </div>
                        </div>

                        <div class="why-item">
                            <i class="bi bi-people"></i>
                            <div>
                                <h4>Enterprise Integration</h4>
                                <p>Seamlessly connect existing systems, third-party services, and business applications through secure APIs.</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="service-value-section">

            <div class="service-value-left">

                <div class="capability-card">

                    <div class="capability-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                    <div>
                        <h4>Real-Time Synchronization</h4>

                        <p>
                            Keep information consistent across all systems
                            without manual intervention.
                        </p>
                    </div>

                </div>

                <div class="capability-card">

                    <div class="capability-icon">
                        <i class="bi bi-eye"></i>
                    </div>

                    <div>
                        <h4>Operational Visibility</h4>

                        <p>
                            Access live insights and monitor performance
                            from a centralized dashboard.
                        </p>
                    </div>

                </div>

                <div class="capability-card">

                    <div class="capability-icon">
                        <i class="bi bi-cpu"></i>
                    </div>

                    <div>
                        <h4>Intelligent Automation</h4>

                        <p>
                            Reduce repetitive tasks through automation
                            and standardized workflows.
                        </p>
                    </div>

                </div>

                <div class="capability-card">

                    <div class="capability-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                    <div>
                        <h4>Scalable Growth</h4>

                        <p>
                            Infrastructure and processes designed to
                            support business expansion.
                        </p>
                    </div>

                </div>

            </div>

            <div class="service-value-right">

                <span class="section-badge">
                    Business Value
                </span>

                <h2>
                    Technology That Creates Measurable Results
                </h2>

                <p>
                    Our solutions are designed to simplify operations,
                    improve visibility, and help businesses scale with confidence.
                </p>

                <div class="service-overview-grid">

                    <div class="overview-box box-1">
                        
                        <div>

                            <h4>E-Commerce Platform</h4>

                            <p>
                                Build and manage online stores with flexible customization,
                                centralized management, and streamlined operations.
                            </p>

                        </div>

                    </div>

                    <div class="overview-box box-2">
                        
                        <div>

                            <h4>Website & Hosting</h4>

                            <p>
                                Deliver fast, secure, and scalable web experiences with
                                professional hosting and infrastructure support.
                            </p>

                        </div>

                    </div>

                    <div class="overview-box box-3">
                     
                        <div>

                            <h4>Sales Automation</h4>

                            <p>
                                Automate business processes, order handling,
                                customer interactions, and data synchronization.
                            </p>

                        </div>

                    </div>

                    <div class="overview-box box-4">
                    
                        <div>

                            <h4>Fulfillment Automation</h4>

                            <p>
                                Streamline logistics workflows, shipment tracking,
                                inventory updates, and operational visibility.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <div class="section-heading" id="list">

            <h2>
                Our Solutions
            </h2>

        </div>

        <!-- SERVICE GRID -->
        <div class="service-grid-wrapper" id="service-list">

            <div class="service-grid-label">
                <span>
                    Expertise
                </span>
            </div>

            <div class="service-grid">

                @foreach($services as $service)

                    <a href="{{ route('viewer.services.show',$service->slug) }}" class="service-card-v3">

                        <div class="service-thumb">

                            <img src="{{ Storage::url($service->thumbnail) }}" alt="{{ $service->thumbnail_alt }}">

                        </div>

                        <div class="service-body">

                            <h4>
                                {{ $service->name }}
                            </h4>

                            <p>
                                {{ Str::limit($service->overview,120) }}
                            </p>

                            <span class="explore-btn">

                                Explore Service

                                <i class="bi bi-arrow-right"></i>

                            </span>

                        </div>

                    </a>

                @endforeach

            </div>

        </div>

        <div class="service-pagination-center">
            {{ $services->fragment('service-list')->links() }}
        </div>

    </div>

</section>

@endsection
