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
    <ul class="grid" id="images">
        <li class="grid__item"><img src="http://placehold.jp/300x300.png" alt="" width="300" height="300"></li>
        <li class="grid__item"><img src="http://placehold.jp/300x320.png" alt="" width="300" height="320"></li>
        <li class="grid__item"><img src="http://placehold.jp/300x360.png" alt="" width="300" height="360"></li>
    </ul>
    <div class="page-load-status">
        <p class="infinite-scroll-request">
            <i class="fa fa-spinner fa-spin"></i>Loading...
        </p>
        <p class="infinite-scroll-last">End of content</p>
        <p class="infinite-scroll-error">No more pages to load</p>
    </div>
    <div class="pagination">
        <a href="page2.html" class="pagination__next">もっと見る</a>
    </div>

  <!-- <ul id="images">
    <li><img src="http://placehold.jp/150x150.png" alt="HTML"></li>
    <li><img src="http://placehold.jp/150x150.png" alt="JavaScript"></li>
    <li><img src="http://placehold.jp/150x150.png" alt="Illustrator"></li>
    <li><img src="http://placehold.jp/150x150.png" alt="Photoshop"></li>
  </ul> -->
</body>
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="{{ asset('/viewerjs/dist/viewer.min.js') }}"></script>
<script src="{{ asset('/js/scroll.js') }}"></script>
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>

<script>
  var viewer = new Viewer(document.getElementById('images'));
</script>
</html>