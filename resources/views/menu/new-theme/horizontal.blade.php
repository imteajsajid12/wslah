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
            height: 100vh;
            font-family: 'Arial', sans-serif;
            padding: 10px;
            margin: 0;
            overflow: hidden;
            color: var(--font-color);
            box-sizing: border-box;
        }

        .layout-container {
            width: 100%;
            height: calc(100vh - 20px);
            margin: 0 auto;
            padding: 0;
            box-sizing: border-box;
        }

        .card-container {
            background: white;
            border-radius: 20px;
            padding: 17px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            height: 98%;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .header-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--background-color) 100%);
            color: var(--font-color);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            min-height: 120px;
            display: flex;
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
            flex: 1;
            min-height: 0;
            overflow: hidden;
        }

        .left-section,
        .right-section {
            display: flex;
            flex-direction: column;
            min-height: 0;
            overflow: hidden;
        }

        .left-section .content-card,
        .right-section .content-card {
            height: 100%;
            min-height: 0;
        }

        .center-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
            min-height: 0;
            overflow: hidden;
        }

        .center-section .header-card {
            margin-bottom: 0;
            flex-shrink: 0;
            justify-content: center;
        }
        .wslah-parent i{
            font-size: 30px;
        }

        .center-section .content-card {
            flex: 1;
            min-height: 0;
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
            body {
                padding: 5px;
            }

            .layout-container {
                height: calc(100vh - 10px);
            }

            .card-container {
                padding: 10px;
            }

            .main-grid {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto auto;
                gap: 15px;
                overflow-y: auto;
            }

            .left-section .content-card,
            .right-section .content-card {
                height: 250px;
                min-height: 250px;
            }

            .center-section {
                gap: 10px;
            }

            .header-card {
                padding: 15px;
                margin-bottom: 10px;
                min-height: 100px;
            }

            .header-card .row {
                flex-direction: column;
                text-align: center !important;
                gap: 10px;
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
        }

        @media (max-width: 480px) {
            body {
                padding: 2px;
            }

            .layout-container {
                height: calc(100vh - 4px);
            }

            .card-container {
                padding: 8px;
                border-radius: 15px;
            }

            .main-grid {
                gap: 10px;
            }

            .header-card {
                padding: 10px;
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

        /* Product item with image - full section styling */
        .product-item {
            position: relative;
            width: 100%;
            height: 100%;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Full section image styling */
        .product-item img {
            width: 100%;
            height: 100%;
            /* object-fit: cover; */
            border-radius: 15px;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        /* Image overlay for better text visibility */
        .product-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                to bottom,
                rgba(0,0,0,0.3) 0%,
                rgba(0,0,0,0.1) 50%,
                rgba(0,0,0,0.7) 100%
            );
            border-radius: 15px;
            z-index: 2;
            pointer-events: none;
        }

        /* Text overlay positioning */
        .product-item .product-name,
        .product-item .product-price {
            position: relative;
            z-index: 3;
        }

        /* No-image styling - background gradient only */
        .product-item.no-image {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--background-color) 100%);
            padding: 50px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .product-item.no-image::before {
            display: none; /* Remove overlay for no-image items */
        }

        .product-item.no-image .product-name {
            font-size: 2.5rem;
            margin-bottom: 25px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            text-align: center;
            line-height: 1.2;
        }

        .product-item.no-image .product-price {
            font-size: 1.8rem;
            color: #ffd700;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            background: rgba(0,0,0,0.3);
            padding: 12px 24px;
            border-radius: 30px;
            text-align: center;
        }

        /* Dynamic Caption Styles */
        .dynamic-caption-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 3;
            text-align: center;
        }

        .caption-ar {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--accent-color);
            text-shadow: 3px 3px 6px rgba(0,0,0,0.8);
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: center;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .caption-en {
            font-size: 2rem;
            font-weight: 600;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
            margin-bottom: 15px;
            line-height: 1.3;
        }

        /* Animation timing classes */
        .animate__animated {
            animation-duration: var(--animation-duration, 1s);
            animation-fill-mode: both;
        }

        /* Dynamic animation support - zoomInLeft */
        .animate__zoomInLeft {
            animation-name: zoomInLeft;
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

        /* Product text styling for items with images */
        .product-name {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 15px;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.8);
            line-height: 1.3;
            text-align: center;
            background: rgba(0,0,0,0.4);
            padding: 10px 20px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
            margin-top: auto;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.5rem;
            color: #ffd700;
            font-weight: bold;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.8);
            background: rgba(0,0,0,0.6);
            padding: 12px 20px;
            border-radius: 30px;
            display: inline-block;
            text-align: center;
            backdrop-filter: blur(5px);
            border: 2px solid rgba(255,215,0,0.3);
            margin-bottom: 20px;
        }

        .insta-logo {
            width: 35px;
            height: auto;
        }

        .wslah-inner{
            padding: 0px !important;
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
                opacity: 0;
                transform: translate3d(-100%, 0, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translate3d(100%, 0, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes rotateIn {
            from {
                opacity: 0;
                transform: rotate3d(0, 0, 1, -200deg);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes flipInX {
            from {
                opacity: 0;
                transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
            }
            40% {
                transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
            }
            60% {
                transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
            }
            80% {
                transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
            }
            to {
                opacity: 1;
                transform: perspective(400px);
            }
        }

        @keyframes flipInY {
            from {
                opacity: 0;
                transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
            }
            40% {
                transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
            }
            60% {
                transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
            }
            80% {
                transform: perspective(400px) rotate3d(0, 1, 0, -5deg);
            }
            to {
                opacity: 1;
                transform: perspective(400px);
            }
        }

        /* Video Slider Styles */
        .slider-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 15px;
        }

        .slider-wrapper li {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .slider-wrapper li.slide-current {
            opacity: 1;
        }

        .slider-wrapper video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }

        /* Loading states */
        .loading {
            animation: pulse 2s infinite;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Sequential Video Styles */
        #sequential-video {
            transition: opacity 1s ease-in-out;
        }

        #sequential-video.fading {
            /* opacity: 0.3; */
        }

        #video-fallback {
            transition: opacity 0.5s ease;
        }

        /* QCSlider Integration */
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

        /* Override QCSlider default styles for new theme */
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

        /* Ensure videos fill the container properly */
        #ajax-video-slider-container video {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            border-radius: 15px !important;
        }

        /* Video container positioning */
        .right-section .content-card {
            position: relative;
            overflow: hidden;
        }

        /* Video container specific styles */
        .video-container {
            background: #000;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .video-container .video-fallback {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--background-color) 100%);
            border-radius: 15px;
            color: white;
            text-align: center;
        }

        /* Ensure QCSlider videos are properly displayed */
        #ajax-video-slider-container ul#slider li video {
            display: block !important;
            opacity: 1 !important;
        }

        /* Pulse animation for loading state */
        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 0.8; }
        }

        .wslah-parent{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .wslah-parent p{
            margin: 0px;
            padding: 0px;
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
                        <div class="row align-items-center h-100">
                            <!-- Left Section - Logo and Brand -->
                            <div class="col-3">
                                <!-- Logo Section -->
                                <div class="logo" id="the_logo" style="margin-bottom: 10px;">
                                    @if($rest->static_logo)
                                        <img src="{{ $rest->static_logo }}" alt="{{ $rest->name }}" style="max-height: 60px; max-width: 150px; object-fit: contain;" />
                                    @elseif($rest->logo)
                                        <img src="{{ asset('storage/' . $rest->logo) }}" alt="{{ $rest->name }}" style="max-height: 60px; max-width: 150px; object-fit: contain;" />
                                    @endif
                                </div>

                                <!-- Restaurant Name -->
                                {{-- <div class="brand-logo" style="font-size: 2rem; margin-bottom: 5px;">{{ strtolower($rest->name) }}</div>
                                <div class="brand-subtitle" style="font-size: 0.8rem;">{{ $rest->type ?? "- café -" }}</div> --}}
                            </div>

                            <!-- Center Section - Menu Titles and Website -->
                            <div class="col-5 text-center">
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
                                <div class="arabic-date" style="font-size: 0.9rem; margin-bottom: 5px;" id="live_datetime_ar">
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

                    <div class="content-card" id="center-product-display">
                        <!-- Product Display - Full Section with Dynamic Animation -->
                        <div class="product-display active" id="product-overlay-center">
                            <div class="product-item animate__animated" id="dynamic-product-item">
                                <img src="" alt="Product" class="product-image" style="display: none;">

                                <!-- Dynamic Caption Display -->
                                <div class="dynamic-caption-container">
                                    <!-- Arabic Caption -->
                                    {{-- <div class="caption-ar" id="caption-ar">
                                        {{ $rest->caption_ar ?? 'مــعـاك للأبـد' }}
                                    </div>

                                    <!-- English Caption -->
                                    <div class="caption-en" id="caption-en">
                                        {{ $rest->caption_en ?? 'With you forever' }}
                                    </div> --}}

                                    <!-- Restaurant Name -->
                                    @if(!empty($rest->name))
                                        <div class="product-name" id="restaurant-name">{{ $rest->name }}</div>
                                    @endif

                                    <!-- Home Page Text -->
                                    @if(!empty($rest->home_page_text))
                                        <div class="product-price" id="home-page-text">{{ $rest->home_page_text }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section - Video/Product Display -->
                <div class="right-section">
                    <div class="content-card">
                        <!-- Video Slider Container - QCSlider will be loaded here -->
                        <div class="video-container" id="ajax-video-slider-container" style="width: 100%; height: 100%; position: relative; border-radius: 15px; overflow: hidden;">
                            <!-- Sequential Video Element (Fallback) -->
                            <video id="sequential-video" autoplay muted loop style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px; display: none; position: absolute; top: 0; left: 0; z-index: 1;" class="transition">
                                <source src="" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                            <!-- Default Fallback content when no videos -->
                            <div id="video-fallback" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--primary-color) 0%, var(--background-color) 100%); border-radius: 15px; position: absolute; top: 0; left: 0; z-index: 0;">
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

        // Hidden input for animation timer
        $('body').append('<input type="hidden" id="animation_timer" value="{{ $animation_timer ?? 5000 }}">');

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

        // QCSlider Video Slider functionality - Enhanced Implementation
        let initialData = null;

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
                            console.log('Video data contains slider element:', data.includes('id="slider"'));
                            $('#ajax-video-slider-container').html(data);

                            // Hide fallback content and show video content
                            $('#video-fallback').hide();
                            $('#sequential-video').hide();

                            // Initialize QCSlider if slider element exists
                            setTimeout(function() {
                                if ($("#slider").length) {
                                    console.log('Slider element found, video items:', $("#slider li").length);

                                    // Initialize QCSlider with robust retry logic
                                    if (initQCSlider($("#slider"))) {
                                        console.log('QCSlider initialized on first load with', $("#slider li").length, 'videos');
                                        $('#fallback-status').text('Videos playing successfully');
                                    }
                                } else {
                                    console.warn('No #slider element found in loaded data');
                                    console.log('Container content after loading:', $('#ajax-video-slider-container').html().substring(0, 200));
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

                            // Reinitialize QCSlider with new data
                            setTimeout(function() {
                                if ($("#slider").length) {
                                    if (initQCSlider($("#slider"))) {
                                        console.log('QCSlider reinitialized with new data');
                                    }
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

        // Dynamic data fetching with animation support
        let animationTime = parseInt($('#animation_timer').val());
        let currentAnimation = '{{ $rest->animation ?? "fadeInUp" }}';

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

                // Update captions from cone_desc data
                if (data.cone_desc) {
                    if (data.cone_desc.en_caption) {
                        $('#caption-en').text(data.cone_desc.en_caption);
                    }
                    if (data.cone_desc.home_page_text) {
                        $('#home-page-text').text(data.cone_desc.home_page_text);
                    }
                    if (data.cone_desc.name) {
                        $('#restaurant-name').text(data.cone_desc.name);
                    }
                }

                // Update logo
                if (data.logo && $("#the_logo img").length) {
                    $("#the_logo img").attr("src", data.logo);
                }

                // Update menu titles if needed
                if (data.is_on_off == 1) {
                    // Handle menu title updates if needed
                }

            } catch (error) {
                console.error("Error fetching dynamic data:", error);
            }
        }

        // Product Animation System
        let products = [];
        let rest = {};
        let currentIndex = 0;
        let intervalId;
        let animation_time = {{ $animation_timer ?? 5000 }};

        // Animation classes array
        const animationClasses = [
            'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'zoomIn', 'bounceIn',
            'slideInLeft', 'slideInRight', 'rotateIn', 'flipInX', 'flipInY'
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
                // Product has image - show it full section
                productImage.src = `/storage/${product.food_image}`;
                productImage.style.display = 'block';
                productImage.style.position = 'absolute';
                productImage.style.top = '0';
                productImage.style.left = '0';
                productImage.style.width = '100%';
                productImage.style.height = '100%';
                productImage.style.objectFit = 'cover';
                productImage.style.borderRadius = '15px';
                productImage.style.zIndex = '1';

                // Remove no-image class and adjust item for image overlay
                productItem.classList.remove('no-image');
                productItem.style.position = 'relative';
                productItem.style.display = 'flex';
                productItem.style.flexDirection = 'column';
                productItem.style.justifyContent = 'flex-end';
                productItem.style.alignItems = 'center';
                productItem.style.padding = '0';
                productItem.style.background = 'none';
            } else {
                // No product image - hide image, use no-image styling
                productImage.style.display = 'none';

                // Add no-image class for better styling
                productItem.classList.add('no-image');
                productItem.style.position = 'relative';
                productItem.style.display = 'flex';
                productItem.style.flexDirection = 'column';
                productItem.style.justifyContent = 'center';
                productItem.style.alignItems = 'center';
                productItem.style.padding = '50px';
            }

            productName.textContent = product.name || '';
            const currencySymbol = '$'; // Default currency symbol
            productPrice.textContent = product.price ? `${currencySymbol}${product.price}` : '';

            // Apply animation class (preserve no-image class if needed)
            const baseClasses = `product-item animate__animated animate__${animationClass}`;
            const noImageClass = !product.food_image ? ' no-image' : '';
            productItem.className = baseClasses + noImageClass;

            // Product display is always visible now
            productOverlay.classList.add('active');
        }

        // Animate products in center section with dynamic animation
        function animateProducts() {
            if (products.length === 0) {
                // If no products, animate the caption container with dynamic animation
                animateCaptionContainer();
                return;
            }

            // Get current product
            const currentProduct = products[currentIndex % products.length];

            // Use dynamic animation from server or fallback to random
            const animationClass = currentAnimation || animationClasses[Math.floor(Math.random() * animationClasses.length)];

            // Display product with animation in center section only
            if (currentProduct && currentProduct.is_display === 1) {
                displayProduct(currentProduct, animationClass);
            } else {
                // If product not displayable, animate caption container
                animateCaptionContainer();
            }

            // Move to next product
            currentIndex++;
            if (currentIndex >= products.length) {
                currentIndex = 0;
            }
        }

        // Animate caption container when no products or products not displayable
        function animateCaptionContainer() {
            const captionContainer = document.getElementById('dynamic-product-item');
            if (captionContainer) {
                // Remove existing animation classes
                captionContainer.className = captionContainer.className.replace(/animate__\w+/g, '');

                // Add new animation class
                const animationClass = currentAnimation || 'fadeInUp';
                captionContainer.classList.add('animate__animated', `animate__${animationClass}`);

                // Remove animation class after animation completes
                setTimeout(() => {
                    captionContainer.classList.remove('animate__animated', `animate__${animationClass}`);
                }, 1000);
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

            // Update CSS animation duration variable
            document.documentElement.style.setProperty('--animation-duration', '1s');

            // Restart animation cycle with new timing
            if (products.length > 0) {
                startProductAnimation();
            } else {
                // If no products, still animate captions with new timing
                function animateAndSchedule() {
                    animateCaptionContainer();
                    intervalId = setTimeout(animateAndSchedule, animation_time);
                }
                animateAndSchedule();
            }

            console.log('Animation interval updated to:', animation_time, 'ms');
        }

        // Script data fetching for Instagram stories
        function fetchScriptData() {
            $.ajax({
                url: "/get_dynamic_data",
                method: "GET",
                data: {
                    uuid: "{{ $rest->uuid }}"
                },
                dataType: "json",
                success: function(data) {
                    if (data.script_code) {
                        // Update Instagram stories if needed
                        console.log('Script data updated');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log("Error fetching script data: " + textStatus);
                }
            });
        }

        // Style updates
        function fetchAndApplyStyles() {
            $.ajax({
                url: "/?store_id={{ $rest->id }}",
                method: "GET",
                dataType: "json",
                data: {
                    uuid: "{{ $rest->uuid }}"
                },
                success: function(data) {
                    // Apply dynamic styles if needed
                    console.log('Styles updated');
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log("Error fetching styles: " + textStatus);
                }
            });
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

            // Debug: Check if video container exists
            if ($('#ajax-video-slider-container').length) {
                console.log('Video container found in DOM');
            } else {
                console.error('Video container NOT found in DOM');
            }

            // Initialize video slider with proper script loading
            ensureQCSliderLoaded(function() {
                console.log('Starting video slider initialization...');
                loadVideoSlider(); // Initial load

                // Auto-refresh video slider content every 6 seconds
                setInterval(function() {
                    loadVideoSlider();
                }, 6 * 1000);
            });

            // Fetch dynamic data
            fetchDynamicData();
            setInterval(fetchDynamicData, animationTime);

            // Fetch script data
            fetchScriptData();
            setInterval(fetchScriptData, 1860 * 1000);

            // Fetch and apply styles
            fetchAndApplyStyles();
            setInterval(fetchAndApplyStyles, 5 * 10000);

            // Initialize products
            fetchProducts();
            setInterval(fetchProducts, 1860 * 1000);

            // Start product animation
            updateAnimationInterval(animation_time);

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
