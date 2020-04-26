$(window).load(function () {
    $("#logout").hide();

    $("#login").on("click keypress", function () {
        $("#login_modal").modal();
    });

    $("#rr_modal_login").on("click keypress", function () {
        let username = $("#loginUsername").val();
        let password1 = $("#loginPassword1").val();
        var formData = [{}];
        formData.push({name: "action", value: "login"});
        formData.push({name: "username", value: username});
        formData.push({name: "password1", value: password1});
        var ajax_call = $.ajax({
            datatype: "json",
            method: "POST",
            url: "ajax/user_actions.php",
            data: formData,
            timeout: 15000,
            async: true
        });
        ajax_call.done(function (data, textStatus, jqXHR) {
            var items = JSON.parse(data);
            if (!items.success) {
                //$("#register_modal").modal("hide");
                $("#error_messages").html("");
                $.each(items['error_messages'], function (key, value) {
                    $("#error_messages").append(value + "<BR>");
                });
                $("#response_errors_modal").modal();
            } else {
                $("#general_content").html("<strong>Welcome Back, " + items['username'] + "! You have successfully logged in!</strong>");
                $("#general_modal").modal();
                window.setTimeout(function () {
                    window.location = "admin.php";
                }, 2000);
            }
        });
        ajax_call.fail(function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        });
    });

    $("#requestQuote").on("click keypress", function () {
        $("#request_quote_modal").modal();
    });

    $("#rr_modal_request_quote").on("click keypress", function () {
        let category = $("#category").val();
        let author = $("#author").val();
        let text = $("#text").val();

        if (!category || !author || !text) {
            alert("Please fully complete the form before adding");
        } else {
            $("#requestQuoteAdd").submit();
        }
    });
});