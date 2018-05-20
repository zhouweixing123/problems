$(function () {
   var btn = $("#user_name");
   btn.click(function () {
       var url = $(this).data('url');
       $.ajax({
           type:'post',
           url: url,
           data:{},
           dataType:"json",
           success:function (msg) {
               if (msg.code == 1){
                   var html = "";
                   $.each(msg.data,function (k,v) {
                      html += "<tr><td>"+v.username+"</td></tr>";
                   });
                   $('#table_name').html(html);
               }else {
                   alert(msg.msg);
               }
           }
       });
   });
});