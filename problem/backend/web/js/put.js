$(function () {
    var btn = $("#user_name");
    btn.click(function () {
        var url = $(this).data('url');
        var info = $(this).data('info');
        $.ajax({
            type:'post',
            url: url,
            data:{},
            dataType:"json",
            success:function (msg) {
                if (msg.code == 1){
                    var html = "";
                    html = "<tr><td>"+msg.data.username+"</td><td>"+msg.data.questionName+"</td><td><a href='"+info+msg.data.question_id+"'>查看答案</a></td></tr>";
                    $.each(msg.data,function (k,v) {
                        // console.log(v);return false;

                    });
                    $('#table_name').html(html);
                }else {
                    alert(msg.msg);
                }
            }
        });
    });
});