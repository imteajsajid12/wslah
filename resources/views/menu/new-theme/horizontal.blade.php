<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: {{ $rest->theme ?? '#4a7c59' }};
            --background-color: {{ $rest->background_color ?? '#2d5a4a' }};
            --frame-color: {{ $rest->frame_color ?? '#1a3d32' }};
            --font-color: {{ $rest->font_color ?? '#ffffff' }};
        }

        body {
            @if($rest->custom_background)
                background-image: url('{{ asset("storage/" . $rest->custom_background) }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            @else
                background: linear-gradient(135deg, var(--background-color) 0%, var(--frame-color) 100%);
            @endif
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
            padding: 20px;
            margin: 0;
            overflow: hidden;
            color: var(--font-color);
        }

        .layout-container {
            max-width: 100%;
            height: 100vh;
            margin: 0 auto;
            padding: 15px;
        }

        .card-container {
            background: white;
            border-radius: 20px;
            padding: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            height: 100%;
        }

        .header-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--background-color) 100%);
            color: var(--font-color);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .brand-logo {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .brand-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .website-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .time-info {
            text-align: right;
            font-size: 0.9rem;
        }

        .content-card {
            background: #f8f9fa;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
            position: relative;
        }

        .content-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .content-card .default-image {
            transition: opacity 0.5s ease;
        }

        .card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: white;
            padding: 15px;
        }

        .large-logo {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 3rem;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .main-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            height: calc(100vh - 100px);
        }

        .left-section,
        .right-section {
            display: flex;
            flex-direction: column;
        }

        .left-section .content-card,
        .right-section .content-card {
            height: 100%;
        }

        .center-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .center-section .header-card {
            margin-bottom: 0;
        }

        .center-section .content-card {
            flex: 1;
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        /* Loading and default states */
        .product-item.loading {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 0.6;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0.6;
            }
        }

        /* Center section specific styling */
        #center-product-display .product-display {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--background-color) 100%);
        }

        /* Dynamic background overlay */
        .dynamic-background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg,
                rgba(var(--primary-color-rgb, 74, 124, 89), 0.1) 0%,
                rgba(var(--background-color-rgb, 45, 90, 74), 0.1) 100%);
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .main-grid {
                grid-template-columns: 1fr;
                height: auto;
            }

            .left-section .content-card,
            .right-section .content-card {
                height: 250px;
            }
        }

        /* Product Display Styles - Full Section */
        .product-display {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--background-color) 100%);
            opacity: 1;
            transition: all 0.5s ease;
            border-radius: 15px;
        }

        .product-display.active {
            opacity: 1;
        }

        .product-item {
            text-align: center;
            color: white;
            padding: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            max-width: 90%;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        .product-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .product-item.no-image {
            background: rgba(255,255,255,0.15);
            padding: 50px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .product-item.no-image .product-name {
            font-size: 2rem;
            margin-bottom: 20px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .product-item.no-image .product-price {
            font-size: 1.5rem;
            color: #ffd700;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .product-name {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            line-height: 1.3;
        }

        .product-price {
            font-size: 1.3rem;
            color: #ffd700;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            background: rgba(0,0,0,0.3);
            padding: 8px 16px;
            border-radius: 25px;
            display: inline-block;
        }

        /* Animation Classes */
        .animate__animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        .animate__fadeInUp {
            animation-name: fadeInUp;
        }

        .animate__fadeInDown {
            animation-name: fadeInDown;
        }

        .animate__fadeInLeft {
            animation-name: fadeInLeft;
        }

        .animate__fadeInRight {
            animation-name: fadeInRight;
        }

        .animate__zoomIn {
            animation-name: zoomIn;
        }

        .animate__bounceIn {
            animation-name: bounceIn;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 100%, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -100%, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translate3d(-100%, 0, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translate3d(100%, 0, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale3d(0.3, 0.3, 0.3);
            }
            50% {
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            from, 20%, 40%, 60%, 80%, to {
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            }
            0% {
                opacity: 0;
                transform: scale3d(0.3, 0.3, 0.3);
            }
            20% {
                transform: scale3d(1.1, 1.1, 1.1);
            }
            40% {
                transform: scale3d(0.9, 0.9, 0.9);
            }
            60% {
                opacity: 1;
                transform: scale3d(1.03, 1.03, 1.03);
            }
            80% {
                transform: scale3d(0.97, 0.97, 0.97);
            }
            to {
                opacity: 1;
                transform: scale3d(1, 1, 1);
            }
        }
    </style>
</head>
<body>
    <div class="layout-container">
        <div class="card-container">
            <div class="main-grid">
                <!-- Left Section - Instagram Stories -->
                <div class="left-section">
                    <div class="content-card">
                        @if($stories_count > 0)
                            @include('instagram.story.slider')
                        @else
                            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400&h=600&fit=crop" alt="Coffee Cup">
                        @endif
                        <div class="large-logo">{{ strtolower(substr($rest->name, 0, 2)) }}</div>
                        <div class="card-overlay">
                            {{-- <small>@{{ $rest->instagram_url ? str_replace(['https://instagram.com/', 'https://www.instagram.com/', '@'], '', $rest->instagram_url) : 'restaurant' }}</small> --}}
                        </div>
                    </div>
                </div>

                <!-- Center Section - Header and Content -->
                <div class="center-section">
                    <div class="header-card">
                        <div class="text-center">
                            <!-- Logo Section -->
                            <div class="logo" id="the_logo" style="margin-bottom: 15px;">
                                @if($rest->static_logo)
                                    <img src="{{ $rest->static_logo }}" alt="{{ $rest->name }}" style="max-height: 80px; max-width: 200px; object-fit: contain;" />
                                @elseif($rest->logo)
                                    <img src="{{ asset('storage/' . $rest->logo) }}" alt="{{ $rest->name }}" style="max-height: 80px; max-width: 200px; object-fit: contain;" />
                                @endif
                            </div>

                            <!-- Restaurant Name -->
                            <div class="brand-logo">{{ strtolower($rest->name) }}</div>
                            <div class="brand-subtitle">- café -</div>

                            <!-- Menu Titles -->
                            <div style="margin: 10px 0;">{{ $rest->menu_title_ar }}</div>
                            <div>{{ $rest->menu_title_en }}</div>

                            <!-- Website Info with Icon -->
                            <div class="website-info justify-content-center">
                                <i class="fas fa-link"></i>
                                <span>{{ request()->getHost() }}</span>
                            </div>

                            <!-- Social Media Icons -->
                            @if($rest->instagram_url || $rest->twitter_url)
                                <div class="social-icons" style="margin: 10px 0; display: flex; justify-content: center; gap: 15px;">
                                    @if($rest->instagram_url)
                                        <a href="{{ $rest->instagram_url }}" target="_blank" style="color: white; font-size: 1.2rem;">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if($rest->twitter_url)
                                        <a href="{{ $rest->twitter_url }}" target="_blank" style="color: white; font-size: 1.2rem;">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    @endif
                                </div>
                            @endif

                            <!-- Time and Date -->
                            <div class="time-info" style="text-align: center; margin-top: 10px;">
                                <div id="live_datetime"></div>
                                <div id="live_time" style="font-size: 1.2rem; font-weight: bold;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="content-card" id="center-product-display">
                        <!-- Product Display - Full Section -->
                        <div class="product-display active" id="product-overlay-center">
                            <div class="product-item animate__animated no-image">
                                <img src="" alt="Product" class="product-image" style="display: none;">
                                <div class="product-name">{{ $rest->name ?? 'Welcome' }}</div>
                                <div class="product-price">{{ $rest->home_page_text ?? 'Loading Menu...' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section - Video/Product Display -->
                <div class="right-section">
                    <div class="content-card" id="ajax-video-slider-container">
                        @if(filled($intro_video_url))
                            <video autoplay muted loop style="width: 100%; height: 100%; object-fit: cover;">
                                <source src="{{ asset('storage/' . $intro_video_url->first()->file) }}" type="video/mp4">
                            </video>
                        @else
                            <img src="https://images.unsplash.com/photo-1544787219-7f47ccb76574?w=400&h=600&fit=crop" alt="Cold Coffee Bottle" class="default-image">
                        @endif



                        {{-- <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div> --}}
                        <div class="card-overlay">
                            <div>{{ $rest->caption_en ?? 'Cold Coffee' }}</div>
                            <small>250 ml</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

    <script>
        // Live date and time update
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dateString = now.toLocaleDateString('ar-SA', options);
            const timeString = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });

            document.getElementById('live_datetime').textContent = dateString;
            document.getElementById('live_time').textContent = timeString;
        }

        // Update every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call

        // Product Animation System
        let products = [];
        let rest = {};
        let currentIndex = 0;
        let intervalId;
        let animation_time = {{ $animation_timer ?? 5000 }};

        // Animation classes array
        const animationClasses = [
            'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'zoomIn', 'bounceIn'
        ];

        // Fetch products data
        async function fetchProducts() {
            try {
                const response = await fetch("{{ url('get_foods_data') }}?uuid={{ $rest->uuid }}");

                if (!response.ok) {
                    throw new Error(`Failed to fetch products (${response.status}): ${response.statusText}`);
                }

                const data = await response.json();
                products = data.foods || [];
                rest = data.rest || {};

                console.log('Products loaded:', products.length);

                // Start animation if products exist
                if (products.length > 0) {
                    startProductAnimation();
                }

            } catch (error) {
                console.error("Error fetching products:", error);
            }
        }

        // Display product with animation in center section only
        function displayProduct(product, animationClass) {
            const container = document.getElementById('center-product-display');
            const productOverlay = container.querySelector('.product-display');
            const productItem = productOverlay.querySelector('.product-item');
            const productImage = productOverlay.querySelector('.product-image');
            const productName = productOverlay.querySelector('.product-name');
            const productPrice = productOverlay.querySelector('.product-price');

            if (!product || !productOverlay) return;

            // Update product information
            if (product.food_image) {
                // Product has image - show it
                productImage.src = `/storage/${product.food_image}`;
                productImage.style.display = 'block';
                // Remove no-image class
                productItem.classList.remove('no-image');
            } else {
                // No product image - hide image, use no-image styling
                productImage.style.display = 'none';
                // Add no-image class for better styling
                productItem.classList.add('no-image');
            }

            productName.textContent = product.name || '';
            const currencySymbol = '{{ config("app.currency_symbol", "$") }}';
            productPrice.textContent = product.price ? `${currencySymbol}${product.price}` : '';

            // Apply animation class (preserve no-image class if needed)
            const baseClasses = `product-item animate__animated animate__${animationClass}`;
            const noImageClass = !product.food_image ? ' no-image' : '';
            productItem.className = baseClasses + noImageClass;

            // Product display is always visible now
            productOverlay.classList.add('active');
        }

        // Animate products in center section only
        function animateProducts() {
            if (products.length === 0) return;

            // Get current product
            const currentProduct = products[currentIndex % products.length];

            // Get random animation class
            const animationClass = animationClasses[Math.floor(Math.random() * animationClasses.length)];

            // Display product with animation in center section only
            if (currentProduct && currentProduct.is_display === 1) {
                displayProduct(currentProduct, animationClass);
            }

            // Move to next product
            currentIndex++;
            if (currentIndex >= products.length) {
                currentIndex = 0;
            }
        }

        // Start product animation cycle
        function startProductAnimation() {
            clearInterval(intervalId);

            function animateAndSchedule() {
                animateProducts();
                intervalId = setTimeout(animateAndSchedule, animation_time);
            }

            // Initial animation
            animateAndSchedule();
        }

        // Update animation interval
        function updateAnimationInterval(newAnimationTime) {
            clearInterval(intervalId);
            animation_time = newAnimationTime;

            if (products.length > 0) {
                startProductAnimation();
            }
        }

        // Dynamic background update
        function updateDynamicStyles() {
            fetch(`/get_dynamic_data?uuid={{ $rest->uuid }}`)
                .then(response => response.json())
                .then(data => {
                    // Update CSS variables if restaurant data changes
                    if (data.rest) {
                        const root = document.documentElement;
                        if (data.rest.theme) {
                            root.style.setProperty('--primary-color', data.rest.theme);
                        }
                        if (data.rest.background_color) {
                            root.style.setProperty('--background-color', data.rest.background_color);
                        }
                        if (data.rest.frame_color) {
                            root.style.setProperty('--frame-color', data.rest.frame_color);
                        }
                        if (data.rest.font_color) {
                            root.style.setProperty('--font-color', data.rest.font_color);
                        }

                        // Update animation timer if changed
                        if (data.animation_timer && data.animation_timer !== animation_time) {
                            updateAnimationInterval(data.animation_timer);
                        }
                    }
                })
                .catch(error => console.error('Error updating dynamic styles:', error));
        }

        // Initialize
        fetchProducts();

        // Refresh products data periodically
        setInterval(fetchProducts, 60 * 1000); // Every minute

        // Update dynamic styles periodically
        setInterval(updateDynamicStyles, 30 * 1000); // Every 30 seconds

        // Auto-refresh functionality
        @if($rest->animation_timer)
            // setTimeout(function() {
            //     location.reload();
            // }, {{ $animation_timer }});
        @endif
    </script>
</body>
</html>
