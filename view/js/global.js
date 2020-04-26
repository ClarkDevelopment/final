$(window).load(function () {
    var admin = $("#admin").val();
    $("#logout").on("click keypress", function () {
        if (!admin) {
            $("#general_content").html("<strong>You are not currently logged in</strong>")
            $("#general_modal").modal();
        } else {
            var formData = [{}];
            formData.push({name: "action", value: "logout"});
            formData.push({name: "username", value: admin});
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
                    $("#error_messages").html("");
                    $.each(items['error_messages'], function (key, value) {
                        $("#error_messages").append(value.message + "<BR>");
                    });
                    $("#response_errors_modal").modal();
                } else {
                    $("#general_content").html("<strong>Hi, " + admin + ". You have successfully been logged out.</strong>");
                    $("#general_modal").modal();
                    window.setTimeout(function () {
                        window.location = "index.php";
                    }, 2000);
                }
            });
            ajax_call.fail(function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            });
        }
    });
});