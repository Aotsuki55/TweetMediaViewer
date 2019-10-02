$(function(){
  var $grid = $('.grid');
  // $grid.masonry({
  //     itemSelector: 'none',
  //     columnWidth: '.grid__item',
  //     gutter: 20,
  //     stagger: 30,
  //     percentPosition: true,
  //     visibleStyle: { transform: 'translateY(0)', opacity: 1 },
  //     hiddenStyle: { transform: 'translateY(100px)', opacity: 0 },
  // });

  // var msnry = $grid.data('masonry');

  // $grid.imagesLoaded(function() {
  //     $grid.masonry( 'option', { itemSelector: '.grid__item' });
  //     var $items = $grid.find('.grid__item');
  //     $grid.masonry( 'appended', $items );
  // });

  // $grid.infiniteScroll({
  //     path: '.pagination a[rel=next]',
  //     append: '.grid__item',
  //     outlayer: msnry,
  //     scrollThreshold: 40,
  //     // hideNav: '.pagination',
  //     // status: '.page-load-status',
  // });




  $grid.imagesLoaded(function(){
    $grid.masonry({
          itemSelector: '.grid__item',    // Masonryで並び替える要素
          isAnimated: true,            // アニメーションにするかどうか
          isFitWidth: true,            // 横幅に自動的に合わせるかどうか
          isResizable: true            // リサイズ時に並び替えるかどうか
      });
  });

  $('.tweetVideo').on('loadedmetadata', function(){
    $grid.masonry({
          itemSelector: '.grid__item',    // Masonryで並び替える要素
          isAnimated: true,            // アニメーションにするかどうか
          isFitWidth: true,            // 横幅に自動的に合わせるかどうか
          isResizable: true            // リサイズ時に並び替えるかどうか
      });
  });
      
  // $grid.infinitescroll({
  //   path: '.pagination a[rel=next]',
  //   append: '.grid__item',
  //   // outlayer: msnry,
  //   scrollThreshold: 40,
  // },
  // function( newElements ) {
  //     var $newElems = $( newElements );
  //     $newElems.imagesLoaded(function(){
  //       $grid.masonry( 'appended', $newElems, true ); 
  //     });
  // });
});