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
            height: 100%;
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
            height: 250px;
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
            height: 250px;
        }

        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
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

                <!-- Video Content -->
                <div class="content-card video-container" id="ajax-video-slider-container">
                    @if(filled($intro_video_url))
                        <video autoplay muted loop>
                            <source src="{{ asset('storage/' . $intro_video_url->first()->file) }}" type="video/mp4">
                        </video>
                    @else
                        <img src="https://images.unsplash.com/photo-1544787219-7f47ccb76574?w=400&h=300&fit=crop" alt="Cold Coffee Bottle">
                    @endif
                    {{-- <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div> --}}
                    <div class="card-overlay">
                        <div>{{ $rest->caption_en ?? 'Cold Coffee' }}</div>
                        <small>250 ml</small>
                    </div>
                </div>

                <!-- Additional Content Cards -->
                <div class="content-card">
                    <img src="https://images.unsplash.com/photo-1571115764595-644a1f56a55c?w=400&h=300&fit=crop" alt="Tea Service">
                    <div class="card-overlay">
                        <div>{{ $rest->home_page_text ?? 'Tea Service' }}</div>
                    </div>
                </div>

                <div class="content-card">
                    <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?w=400&h=300&fit=crop" alt="Dessert">
                    <div class="card-overlay">
                        <div>Dessert Special</div>
                    </div>
                </div>

                <div class="content-card">
                    <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&h=300&fit=crop" alt="Cake Slice">
                    <div class="card-overlay">
                        <div>Fresh Cake</div>
                    </div>
                </div>

                <div class="content-card">
                    <img src="https://images.unsplash.com/photo-1544145945-f90425340c7e?w=400&h=300&fit=crop" alt="Iced Drink">
                    <div class="card-overlay">
                        <div>Iced Beverages</div>
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

            document.getElementById('live_datetime').innerHTML = '<i class="fas fa-calendar"></i> ' + dateString;
            document.getElementById('live_time').textContent = timeString;
        }

        // // Update every second
        // setInterval(updateDateTime, 1000);
        // updateDateTime(); // Initial call

        // Auto-refresh functionality
        @if($rest->animation_timer)
            // setTimeout(function() {
            //     location.reload();
            // }, {{ $animation_timer }});
        @endif
    </script>
</body>
</html>
