@inject('controller','App\Http\Controllers\PagesController')
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
  <link href="{{ asset('/viewerjs/dist/viewer.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />

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
  <!-- <div class="container"> -->
  @include("search")
    <div class="text-center">
      {{ $medias->appends(request()->query())->links() }}
    </div>
    <ul class="grid" id="images">
      @foreach($medias as $media)
        <li class="grid__item">
          <img class="tweetImages" src="{{ asset( $media->path ) }}" alt="{{$media->filename}}" data-id="{{$media->media_id_str}}" data-status="{{$media->status}}" data-idx="{{$loop->index}}" width="300" height=auto style="border-style: solid; border-width: 4px ; border-color: {{ $media->status==null || $media->status==0 ? 'transparent' : $statusToColor[$media->status]}};">
        </li>
      @endforeach
    </ul>
    <div class="text-center">
      {{ $medias->appends(request()->query())->links() }}
    </div>
  <!-- </div> -->
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
<script src="{{ asset('/viewerjs/dist/viewer.js') }}"></script>
<script src="{{ asset('/js/scroll.js') }}"></script>
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
  var viewer = new Viewer(document.getElementById('images'), {
    navbar: 0,
    loop: false,
    isSafari: true,
  });

  var statusToColor = {!!json_encode($statusToColor)!!};
  $(function(){
    $('.datetimepicker').datetimepicker({
      format: "YYYY-MM-DD HH:mm",
      stepping: 5,
    });

    $.ajaxSetup({
      type: "POST",
      timeout: 10000,
    });

    let selectAll = 0;

    $(window).keydown(function(e){
      if(selectAll == 0){
        if(e.keyCode==49 || e.keyCode==50 || e.keyCode==51){
          var $element;
          var key = e.keyCode-48;
          if(viewer!=null&&viewer.isShown){
            $element = $('#viewer').get(0);
          }
          else{
            var $elements = $(":hover");
            $element = $elements[$elements.length-1];
          }
          if($($element).prop('tagName')=="IMG"){
            var id = $($element).data('id');
            var idx = $($element).data('idx');
            var index = $($element).data('index');
            var status = $($element).data('status');
            var newStatus = status==key ? 0 : key;
            var borderColor = (newStatus==null || newStatus==0) ? 'transparent' : statusToColor[newStatus];
            $.ajax({
              type: "POST",
              url: "/view/status",
              data: {
                id: id,
                status: newStatus,
                _token: "{{ csrf_token() }}"
              }
            }).done(function (results) {
              console.log(idx);
              console.log("OK");
              console.log("id:"+id+", status:"+newStatus+", index:"+(index==null?"null":index));
              if(index!=null){
                $(viewer.items[index].querySelector('img')).css('border-color', borderColor);
                $($($($($($('#images').get(0)).children('li')).get(index)).children('img')).get(0)).css('border-color', borderColor);
                // $(viewer.items[index].querySelector('img')).data('status', newStatus);
                viewer.items[index].querySelector('img').setAttribute("data-status",newStatus);
                $($($($($($('#images').get(0)).children('li')).get(index)).children('img')).get(0)).data('status', newStatus);
              }
              else if(viewer.initFlag==true){
                $(viewer.items[idx].querySelector('img')).css('border-color', borderColor);
                viewer.items[idx].querySelector('img').setAttribute("data-status",newStatus);
              }
              $($element).data('status', newStatus);
              $($element).css('border-color', borderColor);
              return false;
            }).fail(function (err) {
              console.log("NG");
              return false;
            });
          }
          else{
            return true;
          }
        }
        else if(e.shiftKey && e.keyCode == 37){        
          window.location.href = "{!! $medias->previousPageUrl() !!}";
          return false;
        }
        else if(e.shiftKey && e.keyCode == 39){
          window.location.href = "{!! $medias->nextPageUrl() !!}";
          return false;
        }
      }
      else{
        if(e.keyCode==48 || e.keyCode==49 || e.keyCode==50 || e.keyCode==51){
          let newStatus = e.keyCode - 48;
          for(let val of $($($('#images').get(0)).children('li'))){
            let $element=$(val).children('img');
            let id = $($element).data('id');
            var idx = $($element).data('idx');
            let index = $($element).data('index');
            let status = $($element).data('status');
            if(status==null || status==0 || newStatus==0){
              let borderColor = (newStatus==null || newStatus==0) ? 'transparent' : statusToColor[newStatus];
              $.ajax({
                type: "POST",
                url: "/view/status",
                data: {
                  id: id,
                  status: newStatus,
                  _token: "{{ csrf_token() }}"
                }
              }).done(function (results) {
                console.log("OK");
                console.log("id:"+id+", status:"+newStatus+", index:"+(index==null?"null":index));
                if(index!=null){
                  $(viewer.items[index].querySelector('img')).css('border-color', borderColor);
                  $($($($($($('#images').get(0)).children('li')).get(index)).children('img')).get(0)).css('border-color', borderColor);
                  // $(viewer.items[index].querySelector('img')).data('status', newStatus);
                  viewer.items[index].querySelector('img').setAttribute("data-status",newStatus);
                  $($($($($($('#images').get(0)).children('li')).get(index)).children('img')).get(0)).data('status', newStatus);
                }
                else if(viewer.initFlag==true){
                  $(viewer.items[idx].querySelector('img')).css('border-color', borderColor);
                  viewer.items[idx].querySelector('img').setAttribute("data-status",newStatus);
                }
                $($element).data('status', newStatus);
                $($element).css('border-color', borderColor);
              }).fail(function (err) {
                console.log("NG");
              });
            }
          }
          selectAll ^= 1;
          $('#selectAll').button('toggle');
        }
      }
    });

    $("#status").val("{{isset($request['status'])?$request['status']:null}}");
    $("#type").val("{{isset($request['type'])?$request['type']:null}}");
    $('#reset').on('click', function() {
      window.location.href = "{{url('/view')}}";
    });
    $('#trash').on('click', function() {
      window.location.href = "{{url('/view/find?_token=')}}"+"{{ csrf_token() }}"+'&userName=&screenName=&fabMin=&fabMax=&rtMin=&rtMax=&savedAtSince=&savedAtMax=&updatedAtSince=&updatedAtMax=&status=1&type=';
    });
    $('#selectAll').on('click', function() {
      selectAll ^= 1;
      $(this).button('toggle');
    });
    $('#allDelete').on('click', function() {
      if(selectAll == 1){
        selectAll = 0;
        window.location.href = "{{url('/view/delete')}}";
      }
    });
    $('#delete').on('click', function() {
      for(let val of $($($('#images').get(0)).children('li'))){
        let $element=$(val).children('img');
        let id = $($element).data('id');
        let index = $($element).data('idx');
        let status = $($element).data('status');
        if(status==1){
          let newStatus = -1;
          let borderColor = (newStatus==null || newStatus==0) ? 'transparent' : statusToColor[newStatus];
          $.ajax({
            type: "POST",
            url: "/view/status",
            data: {
              id: id,
              status: newStatus,
              _token: "{{ csrf_token() }}"
            }
          }).done(function (results) {
            console.log("OK");
            console.log("id:"+id+", status:"+newStatus+", index:"+(index==null?"null":index));
            if(index!=null){
              $(viewer.items[index].querySelector('img')).css('border-color', borderColor);
              $($($($($($('#images').get(0)).children('li')).get(index)).children('img')).get(0)).css('border-color', borderColor);
              // $(viewer.items[index].querySelector('img')).data('status', newStatus);
              viewer.items[index].querySelector('img').setAttribute("data-status",newStatus);
              $($($($($($('#images').get(0)).children('li')).get(index)).children('img')).get(0)).data('status', newStatus);
            }
            else if(viewer.initFlag==true){
              index = $($($('#images').get(0)).children('li')).index($($($elements[$elements.length-2]).get(0)));
              $(viewer.items[index].querySelector('img')).css('border-color', borderColor);
              $($($($($($('#images').get(0)).children('li')).get(index)).children('img')).get(0)).css('border-color', borderColor);
            }
            $($element).data('status', newStatus);
            $($element).css('border-color', borderColor);
          }).fail(function (err) {
            console.log("NG");
          });
        }
      }
    });
  });
</script>
</html>