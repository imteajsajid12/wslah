<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2d5a4a 0%, #1a3d32 100%);
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
            padding: 20px;
            margin: 0;
            overflow: hidden;
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
            /* height: 100%; */
        }

        .header-card {
            background: linear-gradient(135deg, #4a7c59 0%, #2d5a4a 100%);
            color: white;
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
            height: 370px;
            position: relative;
        }

        .content-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 15px;
            margin-top: 15px;
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
            color: #4a7c59;
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Custom background support */
        .custom-background {
            background-image: url('{{ $rest->custom_background ? asset("storage/" . $rest->custom_background) : "" }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .video-container {
            height: 370px;
        }

        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }

        /* Sequential Video Styles */
        #sequential-video {
            transition: opacity 1s ease-in-out;
        }

        #sequential-video.fading {
            opacity: 0.3;
        }

        #video-fallback {
            transition: opacity 0.5s ease;
        }

        /* Dynamic Product Display Styles - Full Width */
        .product-items-container {
            grid-column: 1 / -1; /* Span full width across both columns */
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 columns for products */
            gap: 15px;
            width: 100%;
        }

        .product-item {
            background: #f8f9fa;
            border-radius: 15px;
            overflow: hidden;
            height: 250px;
            position: relative;
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        .product-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-item .card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 15px;
        }

        .product-item .product-name {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-item .product-price {
            font-size: 0.9rem;
            color: #ffd700;
            font-weight: 600;
        }

        /* No image fallback */
        .product-item.no-image {
            background: linear-gradient(135deg, #4a7c59 0%, #2d5a4a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .product-item.no-image .card-overlay {
            position: static;
            background: none;
            padding: 20px;
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

        .animate__slideInLeft {
            animation-name: slideInLeft;
        }

        .animate__slideInRight {
            animation-name: slideInRight;
        }

        .animate__rotateIn {
            animation-name: rotateIn;
        }

        .animate__flipInX {
            animation-name: flipInX;
        }

        .animate__flipInY {
            animation-name: flipInY;
        }

        .animate__zoomInLeft {
            animation-name: zoomInLeft;
        }

        /* Animation Keyframes */
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

        @keyframes slideInLeft {
            from {
                transform: translate3d(-100%, 0, 0);
                visibility: visible;
            }
            to {
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes slideInRight {
            from {
                transform: translate3d(100%, 0, 0);
                visibility: visible;
            }
            to {
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes rotateIn {
            from {
                transform-origin: center;
                transform: rotate3d(0, 0, 1, -200deg);
                opacity: 0;
            }
            to {
                transform-origin: center;
                transform: translate3d(0, 0, 0);
                opacity: 1;
            }
        }

        @keyframes flipInX {
            from {
                transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
                animation-timing-function: ease-in;
                opacity: 0;
            }
            40% {
                transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
                animation-timing-function: ease-in;
            }
            60% {
                transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
                opacity: 1;
            }
            80% {
                transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
            }
            to {
                transform: perspective(400px);
            }
        }

        @keyframes flipInY {
            from {
                transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
                animation-timing-function: ease-in;
                opacity: 0;
            }
            40% {
                transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
                animation-timing-function: ease-in;
            }
            60% {
                transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
                opacity: 1;
            }
            80% {
                transform: perspective(400px) rotate3d(0, 1, 0, -5deg);
            }
            to {
                transform: perspective(400px);
            }
        }

        @keyframes zoomInLeft {
            from {
                opacity: 0;
                transform: scale3d(0.1, 0.1, 0.1) translate3d(-1000px, 0, 0);
                animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
            }
            60% {
                opacity: 1;
                transform: scale3d(0.475, 0.475, 0.475) translate3d(10px, 0, 0);
                animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
            }
            to {
                opacity: 1;
                transform: scale3d(1, 1, 1) translate3d(0, 0, 0);
            }
        }
    </style>
</head>
<body class="{{ $rest->custom_background ? 'custom-background' : '' }}">
    <div class="layout-container">
        <div class="card-container">
            <!-- Header -->
            <div class="header-card">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="brand-logo">{{ strtolower($rest->name) }}</div>
                        <div class="brand-subtitle">- café -</div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="font-size: 1.2rem; margin-bottom: 5px;">{{ $rest->menu_title_ar }}</div>
                        <div>{{ $rest->menu_title_en }}</div>
                        <div class="website-info justify-content-center">
                            <i class="fas fa-link"></i>
                            <span>{{ request()->getHost() }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="time-info">
                            <div id="live_datetime"><i class="fas fa-calendar"></i> </div>
                            <div id="live_time" style="font-size: 1.5rem; font-weight: bold;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">

                <!-- Instagram Stories -->
                <div class="content-card">
                    @if($stories_count > 0)
                        @include('instagram.story.slider')
                    @else
                        <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400&h=300&fit=crop" alt="Coffee Cup">
                    @endif
                    <div class="large-logo">{{ strtolower(substr($rest->name, 0, 2)) }}</div>
                    <div class="card-overlay">
                        {{-- <small>@{{ $rest->instagram_url ? str_replace(['https://instagram.com/', 'https://www.instagram.com/', '@'], '', $rest->instagram_url) : 'restaurant' }}</small> --}}
                    </div>
                </div>

                <!-- Video Content - Sequential Video System -->
                <div class="content-card video-container" id="ajax-video-slider-container">
                    <!-- Sequential Video Element -->
                    <video id="sequential-video" autoplay muted style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px; display: none;" class="transition">
                        <source src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <!-- Fallback content when no videos -->
                    <div id="video-fallback" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #4a7c59 0%, #2d5a4a 100%); border-radius: 15px;">
                        <div style="text-align: center; color: white;">
                            <i class="fas fa-video" style="font-size: 3rem; margin-bottom: 10px; opacity: 0.7;"></i>
                            <p style="margin: 0; opacity: 0.8;">{{ $rest->caption_en ?? 'Video Content' }}</p>
                        </div>
                    </div>

                    <div class="card-overlay">
                        <div>{{ $rest->caption_en ?? 'Cold Coffee' }}</div>

                    </div>
                </div>

                <!-- Dynamic Product Display Cards -->
                <div class="product-items-container" id="product-items-container">
                    <!-- Products will be dynamically loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="{{ asset('qcslider.jquery.js') }}"></script>

    <!-- Hidden input for animation timer -->
    <input type="hidden" id="animation_timer" value="{{ $animation_timer ?? 10000 }}">

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

            document.getElementById('live_datetime').innerHTML = '<i class="fas fa-calendar"></i> ' + dateString;
            document.getElementById('live_time').textContent = timeString;
        }

        // Sequential Video System
        var video_count = 0;
        var videos = [];
        var sequentialVideo = document.getElementById("sequential-video");
        var videoFallback = document.getElementById("video-fallback");

        async function fetchVideos1() {
            try {
                const response = await $.ajax({
                    url: "{{ url('get_video_urls') }}?uuid={{ $rest->uuid }}",
                    type: "get",
                    data: {},
                });

                if (response && Array.isArray(response)) {
                    // Clear existing videos
                    videos = [];

                    // Process video data
                    response.forEach((video) => {
                        videos.push('/storage/' + video.file);
                    });

                    console.log('Videos loaded:', videos.length);

                    // Show/hide elements based on video availability
                    if (videos.length > 0 && sequentialVideo) {
                        sequentialVideo.style.display = 'block';
                        videoFallback.style.display = 'none';
                        playNextVideo();
                    } else {
                        if (sequentialVideo) sequentialVideo.style.display = 'none';
                        videoFallback.style.display = 'flex';
                    }
                } else {
                    console.log('No video data received or invalid format');
                    if (sequentialVideo) sequentialVideo.style.display = 'none';
                    videoFallback.style.display = 'flex';
                }
            } catch (error) {
                console.error("Error fetching videos:", error);
                if (sequentialVideo) sequentialVideo.style.display = 'none';
                videoFallback.style.display = 'flex';
            }
        }

        function playNextVideo() {
            if (!sequentialVideo || videos.length === 0) return;

            if (video_count < videos.length) {
                sequentialVideo.src = videos[video_count];
                sequentialVideo.play().catch(e => console.log('Video play failed:', e));
            } else {
                // All videos have played, reset and play first video
                video_count = 0;
                sequentialVideo.src = videos[video_count];
                sequentialVideo.play().catch(e => console.log('Video play failed:', e));
            }
        }

        // Video ended event listener
        if (sequentialVideo) {
            sequentialVideo.addEventListener("ended", function() {
                video_count++;
                playNextVideo();
            });

            sequentialVideo.addEventListener("error", function(e) {
                console.log('Video error:', e);
                video_count++;
                playNextVideo();
            });
        }

        function refreshVideo() {
            setInterval(function() {
                if (sequentialVideo && videos.length > 0) {
                    sequentialVideo.load();
                    playNextVideo();
                    video_count++;

                    sequentialVideo.classList.remove('fading');
                    setTimeout(() => {
                        sequentialVideo.classList.add('fading');
                    }, (9 * 1000));
                }
            }, 30 * 1000);
        }

        // Product Animation System
        let products = [];
        let rest = {};
        let currentIndex = 0;
        let intervalId;
        let animation_time = {{ $animation_timer ?? 10000 }};
        let currentAnimation = '{{ $rest->animation ?? "fadeInUp" }}';

        // Animation classes array
        const animationClasses = [
            'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'zoomIn', 'bounceIn',
            'slideInLeft', 'slideInRight', 'rotateIn', 'flipInX', 'flipInY', 'zoomInLeft'
        ];

        // Fetch products from server
        async function fetchProducts() {
            try {
                const response = await fetch("/get_foods_data?uuid={{ $rest->uuid }}");

                if (!response.ok) {
                    throw new Error(`Failed to fetch products (${response.status}): ${response.statusText}`);
                }

                const data = await response.json();
                products = data.foods;
                rest = data.rest;

                console.log('Products loaded:', products.length);
            } catch (error) {
                console.error("Error fetching products:", error);
            }
        }

        // Display products in 4-column grid with animation (full width)
        function animateBatch(startIndex, endIndex) {
            const itemsContainer = document.getElementById('product-items-container');
            itemsContainer.innerHTML = '';

            for (let i = startIndex; i <= endIndex && i < products.length; i++) {
                const product = products[i];
                const animationClass = currentAnimation || animationClasses[Math.floor(Math.random() * animationClasses.length)];

                if (product) {
                    const {
                        id,
                        name,
                        price,
                        food_image,
                        is_display
                    } = product;

                    const currencySymbol = '{{ config('app.currency_symbol') ?? '$' }}';
                    const imgSrc = food_image ? `/storage/${food_image}` : '';

                    const priceHTML = is_display === 1 && price ?
                        `<div class="product-price">${price} ${currencySymbol}</div>` : '';
                    const nameHTML = is_display === 1 && name ?
                        `<div class="product-name">${name}</div>` : '';

                    const itemHTML = `
                        <div id="productitem-${id}" class="product-item animate__animated animate__${animationClass} ${!food_image ? 'no-image' : ''}">
                            ${food_image ? `<img src="${imgSrc}" alt="${name || 'Product'}" />` : ''}
                            <div class="card-overlay">
                                ${nameHTML}
                                ${priceHTML}
                            </div>
                        </div>
                    `;

                    itemsContainer.insertAdjacentHTML('beforeend', itemHTML);
                }
            }
        }

        // Animate products in batches of 4 (1 row x 4 columns - full width)
        function animateProducts() {
            if (products.length === 0) return;

            const batchSize = 4;
            const endIndex = currentIndex + batchSize - 1;

            animateBatch(currentIndex, endIndex);

            currentIndex += batchSize;
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

        // Update animation interval with dynamic timing
        function updateAnimationInterval(newAnimationTime) {
            clearInterval(intervalId);
            animation_time = newAnimationTime;

            // Restart animation cycle with new timing
            if (products.length > 0) {
                startProductAnimation();
            }

            console.log('Animation interval updated to:', animation_time, 'ms');
        }

        // Dynamic data fetching with animation support
        let animationTime = parseInt($('#animation_timer').val());

        async function fetchDynamicData() {
            try {
                const response = await fetch("/get_dynamic_data?uuid={{ $rest->uuid }}");
                const data = await response.json();

                // Update animation timing
                const newAnimationTime = data.animation_timer;
                animationTime = parseInt($('#animation_timer').val());
                if (newAnimationTime !== animationTime) {
                    $('#animation_timer').val(newAnimationTime);
                    updateAnimationInterval(newAnimationTime);
                    console.log('Animation timer updated to:', newAnimationTime);
                }

                // Update animation type
                if (data.animation && data.animation !== currentAnimation) {
                    currentAnimation = data.animation;
                    console.log('Animation type updated to:', currentAnimation);
                }

            } catch (error) {
                console.error("Error fetching dynamic data:", error);
            }
        }

        // Initialize everything when DOM is ready
        $(document).ready(function() {
            // Start time updates
            updateDateTime();
            setInterval(updateDateTime, 1000);

            // Initialize sequential video system
            fetchVideos1();
            refreshVideo();

            // Refresh video data periodically
            setInterval(fetchVideos1, 20 * 1000);

            // Initialize products
            fetchProducts().then(() => {
                if (products.length > 0) {
                    startProductAnimation();
                }
            });

            // Refresh products periodically
            setInterval(fetchProducts, 1860 * 1000);

            // Fetch dynamic data
            fetchDynamicData();
            setInterval(fetchDynamicData, animationTime);

            // Auto-play first video if available
            setTimeout(() => {
                if (sequentialVideo && videos.length > 0) {
                    sequentialVideo.play().catch(e => console.log('Auto-play failed:', e));
                }
            }, 1000);
        });

        // Auto-refresh functionality
        @if($rest->animation_timer)
            // setTimeout(function() {
            //     location.reload();
            // }, {{ $animation_timer }});
        @endif
    </script>
</body>
</html>
