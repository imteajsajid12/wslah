<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('qc.slider.css') }}" rel="stylesheet">
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
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            min-height: 120px;
            /* display: flex; */
            align-items: center;
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
            gap: 8px;
            margin-top: 10px;
            font-weight: 500;
        }

        .time-info {
            text-align: right;
            font-size: 0.9rem;
        }

        .qr-badge {
            background: rgba(255,255,255,0.2);
            padding: 8px 12px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
        }
         .insta-logo {
            width: 35px;
            height: auto;
        }


        .arabic-date {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
        }

        .english-time {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            letter-spacing: 0.5px;
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

            .header-card {
                padding: 15px;
                margin-bottom: 10px;
                min-height: 100px;
            }



            .header-card .col-4 {
                width: 100%;
                text-align: center !important;
            }

            .brand-logo {
                font-size: 1.5rem !important;
            }

            .qr-badge {
                justify-self: center;
                margin: 0 auto;
            }

            .product-items-container {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .layout-container{
                padding: 0px;
            }
        }

        @media (max-width: 840px) {
            .product-items-container {
                grid-template-columns: repeat(2, 1fr) !important;
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

        /* QCSlider Integration Styles */
        #ajax-video-slider-container .slider-wrapper {
            border-radius: 15px;
            overflow: hidden;
        }

        #ajax-video-slider-container .include {
            width: 100%;
            height: 100%;
            border-radius: 15px;
            overflow: hidden;
        }

        #ajax-video-slider-container .include video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }

        #ajax-video-slider-container ul#slider {
            list-style: none;
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            position: relative;
            border-radius: 15px;
            overflow: hidden;
        }

        #ajax-video-slider-container ul#slider li {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            overflow: hidden;
        }

        #ajax-video-slider-container video {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            border-radius: 15px !important;
        }

        #ajax-video-slider-container ul#slider li video {
            display: block !important;
            opacity: 1 !important;
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
            /* object-fit: cover; */
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

        .animate__flash {
            animation-name: flash;
        }

        .animate__pulse {
            animation-name: pulse;
        }

        .animate__shake {
            animation-name: shake;
        }

        .animate__swing {
            animation-name: swing;
        }

        .animate__tada {
            animation-name: tada;
        }

        .animate__wobble {
            animation-name: wobble;
        }

        .animate__jello {
            animation-name: jello;
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

        /* Flash Animation */
        @keyframes flash {
            from, 50%, to {
                opacity: 1;
            }
            25%, 75% {
                opacity: 0;
            }
        }

        /* Pulse Animation */
        @keyframes pulse {
            from {
                transform: scale3d(1, 1, 1);
            }
            50% {
                transform: scale3d(1.05, 1.05, 1.05);
            }
            to {
                transform: scale3d(1, 1, 1);
            }
        }

        /* Shake Animation */
        @keyframes shake {
            from, to {
                transform: translate3d(0, 0, 0);
            }
            10%, 30%, 50%, 70%, 90% {
                transform: translate3d(-10px, 0, 0);
            }
            20%, 40%, 60%, 80% {
                transform: translate3d(10px, 0, 0);
            }
        }

        /* Swing Animation */
        @keyframes swing {
            20% {
                transform: rotate3d(0, 0, 1, 15deg);
            }
            40% {
                transform: rotate3d(0, 0, 1, -10deg);
            }
            60% {
                transform: rotate3d(0, 0, 1, 5deg);
            }
            80% {
                transform: rotate3d(0, 0, 1, -5deg);
            }
            to {
                transform: rotate3d(0, 0, 1, 0deg);
            }
        }

        /* Tada Animation */
        @keyframes tada {
            from {
                transform: scale3d(1, 1, 1);
            }
            10%, 20% {
                transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
            }
            30%, 50%, 70%, 90% {
                transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
            }
            40%, 60%, 80% {
                transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
            }
            to {
                transform: scale3d(1, 1, 1);
            }
        }

        /* Wobble Animation */
        @keyframes wobble {
            from {
                transform: translate3d(0, 0, 0);
            }
            15% {
                transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
            }
            30% {
                transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
            }
            45% {
                transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
            }
            60% {
                transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
            }
            75% {
                transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
            }
            to {
                transform: translate3d(0, 0, 0);
            }
        }

        /* Jello Animation */
        @keyframes jello {
            from, 11.1%, to {
                transform: translate3d(0, 0, 0);
            }
            22.2% {
                transform: skewX(-12.5deg) skewY(-12.5deg);
            }
            33.3% {
                transform: skewX(6.25deg) skewY(6.25deg);
            }
            44.4% {
                transform: skewX(-3.125deg) skewY(-3.125deg);
            }
            55.5% {
                transform: skewX(1.5625deg) skewY(1.5625deg);
            }
            66.6% {
                transform: skewX(-0.78125deg) skewY(-0.78125deg);
            }
            77.7% {
                transform: skewX(0.390625deg) skewY(0.390625deg);
            }
            88.8% {
                transform: skewX(-0.1953125deg) skewY(-0.1953125deg);
            }
        }
    </style>
</head>
<body class="{{ $rest->custom_background ? 'custom-background' : '' }}">
    <div class="layout-container">
        <div class="card-container">
            <!-- Header -->
            <div class="header-card">
                <div class="row align-items-center  h-100">
                    <!-- Left Section - Logo and Brand -->
                    <div class="col-4 text-center">


                        <!-- Restaurant Name -->
                        {{-- <div class="brand-logo" style="font-size: 2rem; margin-bottom: 5px;">{{ strtolower($rest->name) }}</div>
                        <div class="brand-subtitle" style="font-size: 0.8rem;">- café -</div> --}}
                        <div class="logo" id="the_logo" style="margin-bottom: 10px;">
                            @if($rest->logo)
                                <img src="{{ $rest->logo }}" alt="{{ $rest->name }}" style="max-height: 60px; max-width: 150px; object-fit: contain;" />
                            {{-- @elseif($rest->logo)
                                <img src="{{ asset('storage/' . $rest->logo) }}" alt="{{ $rest->name }}" style="max-height: 60px; max-width: 150px; object-fit: contain;" /> --}}
                            @endif
                        </div>
                    </div>

                    <!-- Center Section - Menu Titles and Website -->
                    <div class="col-4 text-center">
                        <!-- Arabic Menu Title -->
                        <div style="font-size: 1.4rem; font-weight: bold; margin-bottom: 8px; direction: rtl;">
                            {{ $rest->menu_title_ar ?? 'معاك للأبد' }}
                        </div>

                        <!-- English Menu Title -->
                        <div style="font-size: 1.1rem; margin-bottom: 12px;">
                            {{ $rest->caption_en ?? 'With You For Ever' }}
                        </div>

                        <!-- Website Info with Icon -->
                        <div class="website-info justify-content-center" style="font-size: 0.9rem;">
                            {{-- <i class="fas fa-link" style="margin-right: 8px;"></i> --}}
                            <img class="insta-logo" src="{{ asset($rest->logo) }}" alt="">
                            <span>{{ $rest ->instagram_url ?? "instagram.com" }}</span>
                        </div>
                    </div>

                    <!-- Right Section - Date, Time and QR -->
                    <div class="col-4 wslah-inner text-center">
                        <div class="wslah-parent">
                            <i class="fas fa-link" style="margin-right: 8px;"></i>
                            <span>أغسطس</span>
                            <p>Wslah Platform</p>
                        </div>
                            <div class="cone-desc" style="height: 24% !important; margin-top:auto">
                            <div>
                                <p></p>
                                <p class="en_caption"></p>
                                <hr />
                                <p class="it">

                                </p>
                            </div>
                        </div>
                        <!-- Date in Arabic -->
                        <div class="arabic-date text-center" style="font-size: 0.9rem; margin-bottom: 5px;" id="live_datetime_ar">
                            السبت ٩ أغسطس ٢٠٢٤
                        </div>

                        <!-- Time in English -->
                        <div class="english-time" style="font-size: 1.3rem; margin-bottom: 10px;" id="live_time">
                            09:24 PM
                        </div>

                        <!-- QR Code Icon -->
                        {{-- <div style="display: flex; justify-content: flex-end; align-items: center;">
                            <div class="qr-badge">
                                <i class="fas fa-qrcode" style="font-size: 1.2rem;"></i>
                                <span>منصة رقمية</span>
                            </div>
                        </div> --}}
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

                <!-- Video Content - QCSlider + Sequential Video System -->
                <div class="content-card">
                    <div class="video-container" id="ajax-video-slider-container" style="width: 100%; height: 100%; position: relative; border-radius: 15px; overflow: hidden;">
                        <!-- Sequential Video Element (Fallback) -->
                        <video id="sequential-video" autoplay muted style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px; display: none; position: absolute; top: 0; left: 0; z-index: 1;" class="transition">
                            <source src="" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        <!-- Default Fallback content when no videos -->
                        <div id="video-fallback" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--primary-color, #4a7c59) 0%, var(--background-color, #2d5a4a) 100%); border-radius: 15px; position: absolute; top: 0; left: 0; z-index: 0;">
                            <div style="text-align: center; color: white; padding: 20px;">
                                <div style="animation: pulse 2s infinite;">
                                    <i class="fas fa-video" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.8;"></i>
                                </div>
                                <h3 style="margin: 0 0 10px 0; font-size: 1.5rem; font-weight: bold;">{{ $rest->name ?? 'Restaurant' }}</h3>
                                <p style="margin: 0; opacity: 0.9; font-size: 1.2rem;">{{ $rest->caption_en ?? 'Loading Videos...' }}</p>
                                <div style="margin-top: 15px; font-size: 0.9rem; opacity: 0.7;">
                                    <span id="fallback-status">Connecting to video service...</span>
                                </div>
                                @if(config('app.debug'))
                                <div style="margin-top: 10px;">
                                    <button onclick="loadVideoSlider(); console.log('Manual video reload triggered');" style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3); color: white; padding: 5px 10px; border-radius: 5px; cursor: pointer; font-size: 0.8rem;">
                                        Reload Videos
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- QCSlider videos will be dynamically loaded here -->
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
        // Debug: Check script availability
        console.log('jQuery available:', typeof $ !== 'undefined');
        console.log('QCSlider available:', typeof $.fn.QCslider === 'function');

        // Ensure QCSlider is loaded
        function ensureQCSliderLoaded(callback) {
            if (typeof $.fn.QCslider === 'function') {
                callback();
                return;
            }

            console.log('QCSlider not found, attempting to load...');

            // Try to load the script
            const script = document.createElement('script');
            script.src = "{{ asset('qcslider.jquery.js') }}?v=" + Date.now();
            script.onload = function() {
                console.log('QCSlider script loaded successfully');
                if (typeof $.fn.QCslider === 'function') {
                    callback();
                } else {
                    console.error('QCSlider still not available after loading script');
                    callback(); // Call anyway to trigger fallback
                }
            };
            script.onerror = function() {
                console.error('Failed to load QCSlider script');
                callback(); // Call anyway to trigger fallback
            };
            document.head.appendChild(script);
        }

        // Robust QCSlider initialization with retry logic and fallback
        function initQCSlider(element, retryCount = 0) {
            const maxRetries = 5;

            if (typeof $.fn.QCslider === 'function') {
                try {
                    element.QCslider({
                        duration: 7000,
                    });
                    console.log('QCSlider initialized successfully');
                    return true;
                } catch (error) {
                    console.error('Error initializing QCSlider:', error);
                    return initSimpleVideoSlider(element);
                }
            } else if (retryCount < maxRetries) {
                console.log(`QCSlider not ready, retry ${retryCount + 1}/${maxRetries}`);
                setTimeout(() => initQCSlider(element, retryCount + 1), 300);
                return false;
            } else {
                console.error('QCSlider failed to load after', maxRetries, 'attempts');
                console.log('Falling back to simple video slider...');
                return initSimpleVideoSlider(element);
            }
        }

        // Simple video slider fallback when QCSlider fails
        function initSimpleVideoSlider(element) {
            try {
                const videos = element.find('li[data-video]');
                if (videos.length === 0) {
                    console.warn('No videos found for simple slider');
                    return false;
                }

                let currentVideo = 0;
                const duration = 7000;

                // Hide all videos initially
                videos.hide();

                function showNextVideo() {
                    videos.hide();
                    const videoLi = videos.eq(currentVideo);
                    const videoUrl = videoLi.data('video');

                    // Create or update video element
                    let videoElement = videoLi.find('video');
                    if (videoElement.length === 0) {
                        videoElement = $(`<video autoplay muted loop style="width: 100%; height: 100%; object-fit: cover;">
                            <source src="${videoUrl}" type="video/mp4">
                        </video>`);
                        videoLi.html(videoElement);
                    }

                    videoLi.show();
                    console.log('Simple slider showing video:', currentVideo + 1, 'of', videos.length);

                    currentVideo = (currentVideo + 1) % videos.length;
                }

                // Start the simple slider
                showNextVideo();
                setInterval(showNextVideo, duration);

                $('#fallback-status').text('Videos playing (simple mode)');
                console.log('Simple video slider initialized with', videos.length, 'videos');
                return true;
            } catch (error) {
                console.error('Simple video slider failed:', error);
                $('#fallback-status').text('All video players failed');
                return false;
            }
        }

        // Live date and time update
        function updateDateTime() {
            const now = new Date();

            // Arabic date formatting
            const arabicOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const arabicDateString = now.toLocaleDateString('ar-SA', arabicOptions);

            // English time formatting
            const timeString = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });

            // Update Arabic date
            const arabicDateElement = document.getElementById('live_datetime_ar');
            if (arabicDateElement) {
                arabicDateElement.textContent = arabicDateString;
            }

            // Update English time
            const timeElement = document.getElementById('live_time');
            if (timeElement) {
                timeElement.textContent = timeString;
            }
        }

        // QCSlider Video Slider functionality - Enhanced Implementation
        let initialData = null;

        function loadVideoSlider() {
            $.ajax({
                url: "{{ route('loadVideoSlider') }}?uuid={{ $rest->uuid }}",
                type: 'GET',
                dataType: 'html', // Explicitly request HTML
                headers: {
                    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'
                },
                success: function(data) {
                    console.log('Video slider data received:', data ? 'Yes' : 'No');
                    console.log('Data type:', typeof data);
                    console.log('Data content preview:', typeof data === 'string' ? data.substring(0, 200) + '...' : data);
                    // console.log('Data changed:', initialData !== data);

                    if (initialData === null) {
                        // Store the initial data and load slider for first time
                        initialData = data;

                        // Update fallback status
                        $('#fallback-status').text('Processing video data...');

                        // Check if we have actual video data
                        if (data && data.trim() !== '') {
                            console.log('Video data received, length:', data.length);
                            $('#ajax-video-slider-container').html(data);

                            // Hide fallback content and show video content
                            $('#video-fallback').hide();
                            $('#sequential-video').hide();

                            // Initialize QCSlider with robust loading
                            setTimeout(function() {
                                if ($("#slider").length) {
                                    ensureQCSliderLoaded(function() {
                                        if (initQCSlider($("#slider"))) {
                                            console.log('QCSlider initialized on first load with', $("#slider li").length, 'videos');
                                            $('#fallback-status').text('Videos playing successfully');
                                        } else {
                                            console.log('Using fallback video player');
                                            $('#fallback-status').text('Videos playing (fallback mode)');
                                        }
                                    });
                                } else {
                                    console.warn('No #slider element found in loaded data');
                                    $('#fallback-status').text('Video player not found');
                                }
                            }, 100);
                        } else {
                            // No video data, show fallback
                            $('#video-fallback').show();
                            $('#fallback-status').text('No videos available');
                            console.log('No video data received, showing fallback');
                        }
                    } else if (initialData !== data) {
                        // Update the view only if the data has changed
                        console.log('Video slider data changed, updating...');

                        if (data && data.trim() !== '') {
                            $('#ajax-video-slider-container').html(data);

                            // Hide fallback content
                            $('#video-fallback').hide();
                            $('#sequential-video').hide();

                            // Reinitialize QCSlider with new data using robust loading
                            setTimeout(function() {
                                if ($("#slider").length) {
                                    ensureQCSliderLoaded(function() {
                                        if (initQCSlider($("#slider"))) {
                                            console.log('QCSlider reinitialized with new data');
                                        } else {
                                            console.log('Using fallback video player for new data');
                                        }
                                    });
                                }
                            }, 100);
                        } else {
                            // No video data, show fallback
                            $('#video-fallback').show();
                        }

                        // Update the initial data for subsequent comparisons
                        initialData = data;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading video slider:', {
                        status: status,
                        error: error,
                        response: xhr.responseText,
                        url: "{{ route('loadVideoSlider') }}?uuid={{ $rest->uuid }}"
                    });

                    // Show fallback content on error
                    $('#video-fallback').show();
                    $('#sequential-video').hide();

                    // Update fallback message based on error type
                    if (status === 'timeout') {
                        $('#fallback-status').text('Connection timeout. Retrying...');
                    } else if (status === 'error') {
                        $('#fallback-status').text('Network error. Please check connection.');
                    } else {
                        $('#fallback-status').text('Error loading videos. Retrying in 6 seconds...');
                    }
                }
            });
        }

        // Sequential Video System (Fallback)
        var video_count = 0;
        var videos = [];
        var sequentialVideo = document.getElementById("sequential-video");
        var videoFallback = document.getElementById("video-fallback");

        async function fetchVideos1() {
            try {
                const response = await $.ajax({
                    url: "{{ url('get_video_urls') }}?uuid={{ $rest->uuid }}&json=1",
                    type: "get",
                    data: {},
                });

                if (response && response.videos && Array.isArray(response.videos)) {
                    // Clear existing videos
                    videos = [];

                    // Process video data
                    response.videos.forEach((video) => {
                        videos.push('/storage/' + video.file);
                    });

                    console.log('Sequential videos loaded:', videos.length);

                    // Only use sequential video if QCSlider is not working
                    if (videos.length > 0 && sequentialVideo && !$("#slider").length) {
                        sequentialVideo.style.display = 'block';
                        videoFallback.style.display = 'none';
                        playNextVideo();
                    } else {
                        // QCSlider is working or no videos, hide sequential
                        if (sequentialVideo) sequentialVideo.style.display = 'none';
                    }
                } else if (response && Array.isArray(response)) {
                    // Handle old format for backward compatibility
                    videos = [];
                    response.forEach((video) => {
                        videos.push('/storage/' + video.file);
                    });

                    console.log('Sequential videos loaded (old format):', videos.length);

                    // Only use sequential video if QCSlider is not working
                    if (videos.length > 0 && sequentialVideo && !$("#slider").length) {
                        sequentialVideo.style.display = 'block';
                        videoFallback.style.display = 'none';
                        playNextVideo();
                    }
                } else {
                    console.log('No video data received or invalid format for sequential video');
                    if (sequentialVideo) sequentialVideo.style.display = 'none';
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

        // Animation classes array - Enhanced with more animation types
        const animationClasses = [
            'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'zoomIn', 'bounceIn',
            'slideInLeft', 'slideInRight', 'rotateIn', 'flipInX', 'flipInY', 'zoomInLeft',
            'flash', 'pulse', 'shake', 'swing', 'tada', 'wobble', 'jello'
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
                // Use current animation from API or fallback to random
                const animationClass = currentAnimation || animationClasses[Math.floor(Math.random() * animationClasses.length)];

                if (product) {
                    const {
                        id,
                        name,
                        price,
                        food_image,
                        is_display
                    } = product;

                    const currencySymbol = rest.currency || '{{ config('app.currency_symbol') ?? '$' }}';
                    const imgSrc = food_image ? `/storage/${food_image}` : '';

                    const priceHTML = is_display === 1 && price ?
                        `<div class="product-price">${price} ${currencySymbol}</div>` : '';
                    const nameHTML = is_display === 1 && name ?
                        `<div class="product-name">${name}</div>` : '';

                    const itemHTML = `
                        <div id="productitem-${id}" class="product-item animate__animated animate__${animationClass} ${!food_image ? 'no-image' : ''}"
                             data-animation="${animationClass}" data-product-id="${id}">
                            ${food_image ? `<img src="${imgSrc}" alt="${name || 'Product'}" onerror="this.parentElement.classList.add('no-image')" />` : ''}
                            <div class="card-overlay">
                                ${nameHTML}
                                ${priceHTML}
                            </div>
                        </div>
                    `;

                    itemsContainer.insertAdjacentHTML('beforeend', itemHTML);

                    // Remove animation class after animation completes to allow re-animation
                    setTimeout(() => {
                        const productElement = document.getElementById(`productitem-${id}`);
                        if (productElement) {
                            productElement.classList.remove('animate__animated', `animate__${animationClass}`);
                        }
                    }, 1000);
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

        // Apply immediate animation change to current products
        function applyImmediateAnimationChange() {
            const productItems = document.querySelectorAll('.product-item');
            productItems.forEach((item, index) => {
                // Remove existing animation classes
                item.className = item.className.replace(/animate__\w+/g, '');

                // Add new animation class with staggered delay for smooth transition
                setTimeout(() => {
                    item.classList.add('animate__animated', `animate__${currentAnimation}`);

                    // Remove animation class after animation completes
                    setTimeout(() => {
                        item.classList.remove('animate__animated', `animate__${currentAnimation}`);
                    }, 1000);
                }, index * 100); // Stagger animations by 100ms
            });
        }

        // Update animation interval with dynamic timing
        function updateAnimationInterval(newAnimationTime) {
            clearInterval(intervalId);
            animation_time = newAnimationTime;

            // Update CSS animation duration variable based on animation timing
            const animationDuration = Math.min(Math.max(newAnimationTime / 10, 500), 2000); // Between 0.5s and 2s
            document.documentElement.style.setProperty('--animation-duration', `${animationDuration}ms`);

            // Restart animation cycle with new timing
            if (products.length > 0) {
                startProductAnimation();
            }

            console.log('Animation interval updated to:', animation_time, 'ms');
            console.log('Animation duration set to:', animationDuration, 'ms');
        }

        // Dynamic data fetching with animation support
        let animationTime = parseInt($('#animation_timer').val());
        let lastAnimationUpdate = Date.now();

        async function fetchDynamicData() {
            try {
                const response = await fetch("/get_dynamic_data?uuid={{ $rest->uuid }}");
                const data = await response.json();

                // Update animation timing with validation
                const newAnimationTime = data.animation_timer;
                const currentAnimationTime = parseInt($('#animation_timer').val());

                if (newAnimationTime && newAnimationTime !== currentAnimationTime && newAnimationTime >= 1000) {
                    $('#animation_timer').val(newAnimationTime);
                    animationTime = newAnimationTime;
                    updateAnimationInterval(newAnimationTime);
                    console.log('Animation timer updated to:', newAnimationTime, 'ms');
                }

                // Update animation type with validation
                if (data.animation && data.animation !== currentAnimation) {
                    // Validate animation type exists in our classes array
                    if (animationClasses.includes(data.animation)) {
                        currentAnimation = data.animation;
                        lastAnimationUpdate = Date.now();
                        console.log('Animation type updated to:', currentAnimation);

                        // Apply immediate animation change if products are being displayed
                        if (products.length > 0) {
                            applyImmediateAnimationChange();
                        }
                    } else {
                        console.warn('Unknown animation type received:', data.animation);
                    }
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

            // Load video slider with enhanced functionality (Primary)
            console.log('Initializing video slider...');
            loadVideoSlider(); // Initial load

            // Auto-refresh video slider content every 6 seconds
            setInterval(function() {
                loadVideoSlider();
            }, 6 * 1000);

            // Debug: Check if video container exists
            if ($('#ajax-video-slider-container').length) {
                console.log('Video container found in DOM');
            } else {
                console.error('Video container NOT found in DOM');
            }

            // Initialize sequential video system (Fallback)
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

            // Debug: Log animation system status
            console.log('Animation System Initialized:');
            console.log('- Current Animation:', currentAnimation);
            console.log('- Animation Timer:', animationTime, 'ms');
            console.log('- Available Animations:', animationClasses);

            // Test animation validation
            console.log('- Flash Animation Available:', animationClasses.includes('flash'));
            console.log('- Animation Classes Count:', animationClasses.length);

            // Expose test functions to global scope for debugging
            window.testAnimation = function(animationType, duration = 10000) {
                if (animationClasses.includes(animationType)) {
                    console.log(`Testing animation: ${animationType} with duration: ${duration}ms`);
                    currentAnimation = animationType;
                    updateAnimationInterval(duration);
                    return `Animation test started: ${animationType}`;
                } else {
                    console.error(`Animation type "${animationType}" not available. Available types:`, animationClasses);
                    return `Error: Animation type "${animationType}" not found`;
                }
            };

            window.testFlashAnimation = function() {
                return window.testAnimation('flash', 5000);
            };

            window.getAnimationStatus = function() {
                return {
                    currentAnimation,
                    animationTime,
                    availableAnimations: animationClasses,
                    productsCount: products.length
                };
            };

            console.log('Test functions available: testAnimation(type, duration), testFlashAnimation(), getAnimationStatus()');

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
