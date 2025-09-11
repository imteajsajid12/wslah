<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="project" />
    
    <!-- Favicon -->
    @if(env('APP_FAVICON_ICON'))
        <link rel="icon" type="image/x-icon" href="{{ asset(env('APP_FAVICON_ICON')) }}">
    @endif
    
    <!-- Dynamic background styles -->
    <style>
        :root {
            --primary-color: {{ $rest->theme ?? '#4a7c59' }};
            --background-color: {{ $rest->background_color ?? '#2d5a4a' }};
            --frame-color: {{ $rest->frame_color ?? '#1a3d32' }};
            --font-color: {{ $rest->font_color ?? '#ffffff' }};
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            color: var(--font-color);
            @if($rest->custom_background)
                background-image: url('{{ asset("storage/" . $rest->custom_background) }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            @else
                background: linear-gradient(135deg, var(--background-color) 0%, var(--frame-color) 100%);
            @endif
        }
        
        .theme-container {
            min-height: 100vh;
            width: 100%;
        }
    </style>
</head>

<body>
    <main class="theme-container">
        <input type="hidden" name="" id="theme_style" value="{{ $rest->theme_style ?? 'default' }}">
        <input type="hidden" name="" id="layout_type" value="{{ $rest->layout_type ?? 'horizontal' }}">
        <input type="hidden" id="animation_timer" value="{{ $animation_timer }}">
        
        @if(($rest->layout_type ?? 'horizontal') === 'vertical')
            @include('menu.new-theme.vertical')
        @else
            @include('menu.new-theme.horizontal')
        @endif
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    
    <!-- Custom script code from restaurant settings -->
    @if($rest->script_code)
        {!! $rest->script_code !!}
    @endif
    
    <script>
        // Global variables for theme functionality
        window.themeStyle = '{{ $rest->theme_style ?? "default" }}';
        window.layoutType = '{{ $rest->layout_type ?? "horizontal" }}';
        window.animationTimer = {{ $animation_timer ?? 30000 }};
        
        // Auto-refresh functionality
        if (window.animationTimer > 0) {
            setTimeout(function() {
                location.reload();
            }, window.animationTimer);
        }
        
        // Dynamic data loading
        function loadDynamicData() {
            $.ajax({
                url: '{{ url("get_dynamic_data") }}',
                method: 'GET',
                success: function(response) {
                    // Update dynamic content based on response
                    if (response.logo) {
                        $('.brand-logo').text(response.logo);
                    }
                    if (response.menu_title) {
                        $('.menu-title').text(response.menu_title.en);
                        $('.menu-title-ar').text(response.menu_title.ar);
                    }
                    if (response.date) {
                        $('#live_datetime').text(response.date);
                    }
                    if (response.time) {
                        $('#live_time').text(response.time);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error loading dynamic data:', error);
                }
            });
        }
        
        // Load dynamic data on page load
        $(document).ready(function() {
            loadDynamicData();
            
            // Refresh dynamic data every 30 seconds
            setInterval(loadDynamicData, 30000);
        });
        
        // Video slider functionality
        function loadVideoSlider() {
            $.ajax({
                url: '{{ route("loadVideoSlider") }}',
                method: 'GET',
                success: function(response) {
                    $('#ajax-video-slider-container').html(response);
                },
                error: function(xhr, status, error) {
                    console.log('Error loading video slider:', error);
                }
            });
        }
        
        // Load video slider on page load
        $(document).ready(function() {
            loadVideoSlider();
        });
    </script>
</body>

</html>
