{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

<style>
    .fade-in {
      opacity: 0;                    /* Start invisible */
      animation: fadeIn 1.5s ease-in forwards;  /* Apply the fadeIn animation */
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
    .carousel-fade .carousel-item {
 opacity: 0;
 transition-duration: .6s;
 transition-property: opacity;
}

.carousel-fade  .carousel-item.active,
.carousel-fade  .carousel-item-next.carousel-item-left,
.carousel-fade  .carousel-item-prev.carousel-item-right {
  opacity: 1;
}

.carousel-fade .active.carousel-item-left,
.carousel-fade  .active.carousel-item-right {
 opacity: 0;
}

.carousel-fade  .carousel-item-next,
.carousel-fade .carousel-item-prev,
.carousel-fade .carousel-item.active,
.carousel-fade .active.carousel-item-left,
.carousel-fade  .active.carousel-item-prev {
 transform: translateX(0);
 transform: translate3d(0, 0, 0);
}
.carousel-item{

    width: 97% !important;

}
.carousel_video{
    border-top-right-radius: 12px !important;
    border-bottom-right-radius: 12px !important;

}
  </style>
<div id="carouselExampleIndicators" class="centerSliderr carousel slide  fade_in_dev {{$rest->animation_type=="fade-in"?'carousel-fade':''}}" data-ride="carousel" data-interval="{{(int)$rest->animation_duration*1000}}">

    <div class="carousel-inner">
<?php
$number_of_posts = isset($number_of_posts) ? $number_of_posts : null;
?>
      @foreach (instagram_stories_for_store($number_of_posts) as $item)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
         @if($item->payload['media_type']=="IMAGE")

          <a href="{{$item->payload['media_url']}}" target="_blank"><img src="{{$item->payload['media_url']}}" class="d-block w-100 {{$rest->animation_type=="fade-in"?'fade-in':''}}"  alt="{{$item->id}} slide"></a>
          @elseif ($item->payload['media_type']=="VIDEO")
          @if(isset($item->payload['media_url']))

          <a href="{{$item->payload['media_url']}}" target="_blank">
            <video class="d-block w-100 carousel_video fade_in_dev {{$rest->animation_type=="fade-in"?'fade-in':''}}"  autoplay muted  loop >
                <source src="{{ $item->payload['media_url'] }}" type="video/mp4">
                Your browser does not support the video tag.
              </video>
          </a>

          @elseif(isset($item->payload['thumbnail_url']))
          <a><img src="{{$item->payload['thumbnail_url']}}" class="d-block w-100 fade_in_dev {{$rest->animation_type=="fade-in"?'fade-in':''}}"  alt="{{$item->id}} slide"></a>
          @endif
          @else
          @endif
        </div>
      @endforeach

    </div>
    {{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a> --}}
  </div>




@if (url()->current() == url('/'))
<!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
<script>
    $(document).ready(function () {
        let currentStoriesCount = 0;
        
        // Function to check if a URL is valid and accessible
        async function checkMediaUrl(url) {
            try {
                const response = await fetch(url, { method: 'HEAD' });
                return response.ok;
            } catch (error) {
                return false;
            }
        }

        // Function to update slider content
        async function updateSliderContent(stories, restaurant) {
            let carouselInner = $('.carousel-inner');
            carouselInner.empty();
            
            let validStories = [];
            
            // Check all media URLs first
            for (const item of stories) {
                const payload = typeof item.payload === 'string' ? JSON.parse(item.payload) : item.payload;
                let isValid = false;
                
                if (payload.media_type === "IMAGE" && payload.media_url) {
                    isValid = await checkMediaUrl(payload.media_url);
                } else if (payload.media_type === "VIDEO") {
                    if (payload.media_url) {
                        isValid = await checkMediaUrl(payload.media_url);
                    } else if (payload.thumbnail_url) {
                        isValid = await checkMediaUrl(payload.thumbnail_url);
                    }
                }
                
                if (isValid) {
                    validStories.push(item);
                }
            }
            
            // Only proceed if we have valid stories
            if (validStories.length === 0) {
                $('#carouselExampleIndicators').hide();
                return;
            }
            
            // Show the carousel if it was hidden
            $('#carouselExampleIndicators').show();
            
            // Display valid stories
            validStories.forEach((item, index) => {
                let isActive = index === 0 ? 'active' : '';
                let mediaHtml = '';
                
                const payload = typeof item.payload === 'string' ? JSON.parse(item.payload) : item.payload;
                
                if (payload.media_type === "IMAGE") {
                    mediaHtml = `
                        <a href="${payload.media_url}" target="_blank">
                            <img src="${payload.media_url}" class="d-block w-100 ${$('#carouselExampleIndicators').hasClass('carousel-fade') ? 'fade-in' : ''}" alt="${item.id} slide">
                        </a>
                    `;
                } else if (payload.media_type === "VIDEO") {
                    if (payload.media_url) {
                        mediaHtml = `
                            <a href="${payload.media_url}" target="_blank">
                                <video class="d-block w-100 carousel_video fade_in_dev ${$('#carouselExampleIndicators').hasClass('carousel-fade') ? 'fade-in' : ''}" autoplay muted loop>
                                    <source src="${payload.media_url}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        `;
                    } else if (payload.thumbnail_url) {
                        mediaHtml = `
                            <a>
                                <img src="${payload.thumbnail_url}" class="d-block w-100 fade_in_dev ${$('#carouselExampleIndicators').hasClass('carousel-fade') ? 'fade-in' : ''}" alt="${item.id} slide">
                            </a>
                        `;
                    }
                }
                
                carouselInner.append(`
                    <div class="carousel-item ${isActive}">
                        ${mediaHtml}
                    </div>
                `);
            });
            
            // Reinitialize carousel
            let carouselElement = $('#carouselExampleIndicators');
            carouselElement.carousel('dispose');
            carouselElement.carousel({ interval: restaurant.animation_duration * 1000 });
            carouselElement.carousel(0);
            carouselElement.carousel('cycle');
        }

        // Check for updates every second
        setInterval(async function () {
            $.ajax({
                url: '/instagram/sliderAjax'+window.location.search,
                type: 'GET',
                success: async function (response) {
                    // Update animation settings if changed
                    let dta_interval = $('#carouselExampleIndicators').attr('data-interval');
                    if (dta_interval != response.restaurant.animation_duration + '000') {
                        $('#carouselExampleIndicators').attr('data-interval', response.restaurant.animation_duration + '000');
                        let carouselElement = $('#carouselExampleIndicators');
                        carouselElement.carousel('dispose');
                        carouselElement.carousel({ interval: response.restaurant.animation_duration * 1000 });
                        carouselElement.carousel(0);
                        carouselElement.carousel('cycle');
                    }

                    // Update animation type
                    if (response.restaurant.animation_type == 'slide-in-right') {
                        if ($('#carouselExampleIndicators').hasClass('carousel-fade')) {
                            $('#carouselExampleIndicators').removeClass('carousel-fade');
                            $('#carouselExampleIndicators').carousel('cycle');
                        }
                    } else if (response.restaurant.animation_type == 'fade-in') {
                        if (!$('#carouselExampleIndicators').hasClass('carousel-fade')) {
                            $('#carouselExampleIndicators').addClass('carousel-fade');
                            $('#carouselExampleIndicators').carousel('cycle');
                        }
                    }

                    // Check if stories have been updated
                    if (currentStoriesCount !== response.stories_count) {
                        currentStoriesCount = response.stories_count;
                        await updateSliderContent(response.stories, response.restaurant);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }, 1000);
        
        // Initial load
        $.ajax({
            url: '/instagram/sliderAjax'+window.location.search,
            type: 'GET',
            success: async function (response) {
                currentStoriesCount = response.stories_count;
                await updateSliderContent(response.stories, response.restaurant);
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
</script>
@endif