<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link  href="{{ asset('/viewerjs/dist/viewer.min.css') }}" rel="stylesheet">
<style>
  ul { list-style-type: none; }
  li { display: inline-block; }
</style>
</head>
<body>
  <section class="scroll_area"
    data-infinite-scroll='{
      "path": ".pagination a[rel=next]",
      "append": ".post"
    }'
  >
    @foreach($medias as $media)
      <div class="post">
        <h3>{{ $media->media_id_str }}</h3>
        <p>{{ $media->user_name }}</p>
      </div>
    @endforeach
  </section>
  {{ $medias->links() }}
</body>
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="{{ asset('/viewerjs/dist/viewer.min.js') }}"></script>
<!-- <script src="{{ asset('/js/scroll.js') }}"></script> -->
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script>
  var infScroll = new InfiniteScroll( '.scroll_area', {
    path : ".pagination a[rel=next]",
    append : ".post"
  });
</script>
<script>
  var viewer = new Viewer(document.getElementById('images'));
</script>
</html>