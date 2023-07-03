$(".change-status").on("change", function () {
    let select = $(this);
    $.ajax({
        url: select.closest("form").attr("action") + "?status=" + select.val(),
        method: "GET",
    });
});

$("#reload").click(function () {
    $.ajax({
        type: "GET",
        url: "reload-captcha",
        success: function (data) {
            $(".captcha span").html(data.captcha);
        },
    });
});
