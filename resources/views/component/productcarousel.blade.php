<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

  @if(count($images) > 1)
    <ol class="carousel-indicators">
      @foreach($images as $image)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $image->id }}" class="{{ $image->id == $images->first()->id ? 'active' : '' }}"></li>
      @endforeach
    </ol>
  @endif

  <div class="carousel-inner">
    @foreach($images as $image)
      <div class="carousel-item {{ $image->id == $images->first()->id ? 'active' : '' }}">
        <img class="d-block w-100" src="{{ $image->url }}" alt="First slide" />
      </div>
    @endforeach
  </div>

  @if(count($images) > 1)
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  @endif

</div>