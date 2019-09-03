<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link  href="{{ asset('/viewerjs/dist/viewer.min.css') }}" rel="stylesheet">
<style>
  ul { list-style-type: none; }
  li { display: inline-block; }
  .viewer-button {
    position: absolute;
    overflow: hidden;
    cursor: pointer;
    background-color: #000;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0);
  }
  .viewer-canvas, .viewer-footer {
    z-index: 2000;
  }
  .viewer-container {
    background-color: rgba(0, 0, 0, .9);
  }
</style>
</head>
<body>
  <ul class="grid" id="images">
    @foreach($medias as $media)
      <li class="grid__item"><img src="{{ asset( $media->path ) }}" alt="{{$media->filename}}" width="300" height=auto></li>
    @endforeach
        <!-- <li class="grid__item"><img src="http://placehold.jp/300x300.png" alt="" width="300" height="300"></li>
        <li class="grid__item"><img src="http://placehold.jp/300x320.png" alt="" width="300" height="320"></li>
        <li class="grid__item"><img src="http://placehold.jp/300x360.png" alt="" width="300" height="360"></li> -->
  </ul>
  {{-- $medias->links() --}}
</body>
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="{{ asset('/viewerjs/dist/viewer.min.js') }}"></script>
<script src="{{ asset('/js/scroll.js') }}"></script>
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script>
  var viewer = new Viewer(document.getElementById('images'), {
    navbar: 0,
  });
</script>
</html>