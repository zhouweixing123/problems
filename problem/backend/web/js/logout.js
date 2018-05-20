$(function () {
    /*
    *   退出系统
    * */
   $("#logout").click(function () {
       var url = $(this).data('url');
      $.ajax({
          type:'post',
          url:url,
      });
   });
});