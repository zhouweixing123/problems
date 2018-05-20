$(function () {
   var url = $("#update_pwd").data('url');
   $("#pwd_up").click(function () {
         $(".content_div").toggle();
   });
   $("#update_pwd").click(function () {
        var oldPwd = $("#focusedinput").val();
        var newPwd = $("#exampleInputEmail1").val();
        var okPwd = $("#exampleInputPassword1").val();
        var id = $("#update_pwd").data('id');
        if (oldPwd === "" || newPwd === "" || okPwd === ""){
            alert("请认真填写信息");
            return false;
        }else {
            if (confirm("确认修改密码")){
                var data = {
                    old:oldPwd,
                    new:newPwd,
                    ok :okPwd,
                    id : id
                };
                $.ajax({
                    type:"post",
                    url : url,
                    data:data,
                    dataType:"json",
                    success:function (msg) {
                        if (msg.code === 1){
                            alert(msg.msg);
                            $(".content_div").toggle();
                        }else {
                            alert(msg.msg);
                        }
                    }
                });
            }
        }
   });
   // 点击取消修改
   $("#cancel").click(function () {
        $(".content_div").toggle();
    });
});