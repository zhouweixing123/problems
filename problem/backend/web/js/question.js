$(function () {
    // 审核
    $(".status").click(function () {
        var obj = $(this);
        var id = obj.data('id');
        var url = obj.data("url");
        $.ajax({
            type:'post',
            url:url,
            data:{
                id:id
            },
            dataType:"json",
            success:function (data) {
                if (data.code == 1){
                    obj.parent().html("<i class='fa fa-check-square-o mouse'>已审核</i>");
                    alert("审核通过");
                }else {
                    alert("审核失败");
                }
            }
        });
    });
    // 删除
    $(".del").click(function () {
        var obj = $(this);
        var id = obj.data('id');
        var url = obj.data("url");
        var _url = obj.data("success");
        $.ajax({
            type:'post',
            url:url,
            data:{
                id:id
            },
            dataType:"json",
            success:function (data) {
                if (data.code == 1){
                    alert("删除成功");
                    $(window).attr("location",_url);
                }else {
                    alert("删除失败");
                }
            }
        });
    });
});