<div id="carouselExampleIndicators" data-interval="3000" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    @foreach ($sliders as $slider )
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" 
        @if ($loop->index == 0)
            class="active"
        @endif></li>
    @endforeach
  </ol>

  <div class="carousel-inner">
      @foreach ($sliders as $slider )
      <div class="carousel-item 
      @if ($loop->index == 0)
          active
      @endif">
        <a href="{{ url($slider->url) }}">
            <img src="/storage/{{ $slider->media->path }}" class="d-block w-100" alt="Produ t Picture" style="height: 400px; width: 100%; object-fit: cover ;">
        </a>
      </div>          
      @endforeach
  </div>

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
   
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>