<div class="main_width_control">

    <!-- start left-side -->
    <div class="left-side">
        <div class="menushowhide">
            <span></span>
            <span></span>
        </div>
        <div class="left-side-content">
            <div class="items">

            </div>
        </div>
    </div>
    <div class="center-side" style="height: 100%">
        <div class="story-img" style="height: 75% !important">
            @if($stories_count > 0)
                @include('/instagram/story/slider')
            @endif
        </div>

    </div>

    <!-- start right-side -->
    <div class="right-side">
        <div class="logo" id="the_logo" style="height: 33%">
            <img src="" alt="" />
        </div>


        <div class="countdown-container" id="countdown" style="height: 33%; display:flex;">
            {{-- <div class="countdown-timer" id="demo101"></div>
            <div class="expired-message" id="demo"></div> --}}
            <div class="clock2 w-100"></div>



            {{-- <div id="countdown" style="margin: auto">
                <div id='tiles' style="display: flex">
                    <div style="display: flex; flex-direction:column" class="main">
                        <span id="days"></span>
                        <div class="label">Days</div>
                    </div>
                    <div style="display: flex; flex-direction:column" class="main">
                        <span id="hours"></span>
                        <div class="label">Hours</div>
                    </div>
                    <div style="display: flex; flex-direction:column" class="main">
                        <span id="minutes"></span>
                        <div class="label">Minutes</div>
                    </div>
                    <div style="display: flex; flex-direction:column" class="main">
                        <span id="seconds"></span>
                        <div class="label">Seconds</div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="clock-wrap">
                <p class="expired" id="expired"><strong>Countdown expired!</strong></p>

                <div class="clock" id="clock">
                    <div class="time-block">
                        <span class="time" id="days">00</span>
                        <p class="label">Days</p>
                    </div>
                    <div class="time-block">
                        <span class="time" id="hours">00</span>
                        <p class="label">Hours</p>
                    </div>
                    <div class="time-block">
                        <span class="time" id="minutes">00</span>
                        <p class="label">Minutes</p>
                    </div>
                    <div class="time-block">
                        <span class="time" id="seconds">00</span>
                        <p class="label">Seconds</p>
                    </div>
                </div>
            </div> --}}
        </div>

        {{-- <div class="video-container" style="height: 45%"> --}}

 <div class="video-container" id="ajax-video-slider-container" style="height: 42%">
            <!-- Sequential Video Element -->
            <video id="horizontal-sequential-video" autoplay muted loop style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px; display: none;">
                <source src="" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <!-- Fallback content when no videos -->
            <div id="horizontal-video-fallback" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #4a7c59 0%, #2d5a4a 100%); border-radius: 15px;">
                <div style="text-align: center; color: white;">
                    <i class="fas fa-video" style="font-size: 3rem; margin-bottom: 10px; opacity: 0.7;"></i>
                    <p style="margin: 0; opacity: 0.8;">Video Content</p>
                </div>
            </div>
        </div>

        <div class="time-elem" style="height: 25%">
            <div class="date" style="
        ">
                <div class="date_width_control">
                    <div class="live_date_and_time">
                        <div id="live_datetime" class="text-center" style="display: block"></div>
                        <div id="live_time"></div>
                    </div>
                </div>
            </div>

            <div class="logo-wasla">
                <img style="width: 100%" src="" alt="" />
            </div>
        </div>
    </div>
    <!-- end right-side -->
</div>

<!-- Video Loading Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('qcslider.jquery.js') }}"></script>
<link href="{{ asset('qc.slider.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
.video-container {
    min-height: 200px !important;
    position: relative !important;
}

.video-container video,
.video-container > div {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
}

#horizontal-video-fallback,
#vertical-video-fallback {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-height: 200px !important;
    /* background: linear-gradient(135deg, #4a7c59 0%, #2d5a4a 100%) !important; */
    border-radius: 15px !important;
    color: white !important;
}

#horizontal-sequential-video,
#vertical-sequential-video {
    display: none !important;
}
</style>

<script>
// Sequential Video System for Horizontal
var video_count = 0;
var videos = [];
var sequentialVideo = document.getElementById("Horizontal-sequential-video");
var videoFallback = document.getElementById("Horizontal-video-fallback");

// Initialize fallback display
if (videoFallback) {
    videoFallback.style.display = 'flex';
    console.log('Horizontal video fallback initialized');
}
if (sequentialVideo) {
    sequentialVideo.style.display = 'none';
    console.log('Horizontal sequential video hidden initially');
}

async function fetchVideos1() {
    try {
        const response = await $.ajax({
            url: "{{ url('get_video_urls') }}?uuid={{ $rest->uuid }}",
            type: "get",
            data: {},
        });

        if (response && Array.isArray(response)) {
            videos = [];
            response.forEach((video) => {
                videos.push('/storage/' + video.file);
            });

            console.log('Horizontal Videos loaded:', videos.length);

            if (videos.length > 0 && sequentialVideo) {
                sequentialVideo.style.display = 'block';
                videoFallback.style.display = 'none';
                playNextVideo();
            } else {
                if (sequentialVideo) sequentialVideo.style.display = 'none';
                videoFallback.style.display = 'flex';
                loadVideoSlider();
            }
        } else {
            console.log('Horizontal No video data received');
            if (sequentialVideo) sequentialVideo.style.display = 'none';
            videoFallback.style.display = 'flex';
            loadVideoSlider();
        }
    } catch (error) {
        console.error("Horizontal Error fetching videos:", error);
        if (sequentialVideo) sequentialVideo.style.display = 'none';
        videoFallback.style.display = 'flex';
        loadVideoSlider();
    }
}

function playNextVideo() {
    if (!sequentialVideo || videos.length === 0) return;

    if (video_count < videos.length) {
        sequentialVideo.src = videos[video_count];
        sequentialVideo.play().catch(e => console.log('Video play failed:', e));
    } else {
        video_count = 0;
        sequentialVideo.src = videos[video_count];
        sequentialVideo.play().catch(e => console.log('Video play failed:', e));
    }
}

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

let initialData = null;

async function loadVideoSlider() {
    try {
        const response = await fetch("{{ route('loadVideoSlider') }}?uuid={{ $rest->uuid }}");
        const data = await response.text();

        if (initialData === null || initialData !== data) {
            if (!sequentialVideo || videos.length === 0) {
                $("#ajax-video-slider-container").html(data);
                if ($("#slider").length) {
                    $("#slider").QCslider({
                        duration: 7000,
                    });
                }
            }
            initialData = data;
        }
    } catch (error) {
        console.error('Error loading video slider:', error);
    }
}

$(document).ready(function() {
    fetchVideos1();
    setInterval(fetchVideos1, 20 * 1000);
    setInterval(loadVideoSlider, 6 * 1000);
});
</script>
