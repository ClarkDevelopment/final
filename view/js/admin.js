$(window).load(function () {
    $("#addCategory").on("click keypress", function () {
        $("#category_modal").modal();
    });

    $("#rr_modal_category").on("click keypress", function () {
        let categoryAdd = $("#category").val();
        if (!categoryAdd) alert("Please enter a valid category value");
        else window.location = "admin.php?action=add_category&category=" + categoryAdd;
    });

    $("#addAuthor").on("click keypress", function () {
        $("#author_modal").modal();
    });

    $("#rr_modal_author").on("click keypress", function () {
        let authorAdd = $("#author").val();
        if (!authorAdd) alert("Please enter a valid author value");
        else window.location = "admin.php?action=add_author&author=" + authorAdd;
    });

    $("#addQuote").on("click keypress", function () {
        $("#quote_modal").modal();
    });

    $("#rr_modal_quote").on("click keypress", function () {
        let category = $("#category").val();
        let author = $("#author").val();
        let text = $("#text").val();

        if (!category || !author || !text) {
            alert("Please fully complete the form before adding");
        } else {
            $("#quoteAdd").submit();
        }
    });

    $("#register").on("click keypress", function () {
        $("#register_modal").modal();
    });

    $("#rr_modal_register").on("click keypress", function () {
        let username = $("#registrationUsername").val();
        let password1 = $("#RegistrationPassword1").val();
        let password2 = $("#RegistrationPassword2").val();
        var formData = [{}];
        formData.push({name: "action", value: "register"});
        formData.push({name: "username", value: username});
        formData.push({name: "password1", value: password1});
        formData.push({name: "password2", value: password2});
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
                $("#general_content").html("<strong>" + items['username'] + " has successfully been registered!</strong>");
                $("#register_modal").modal("hide");
                $("#general_modal").modal();
            }
        });
        ajax_call.fail(function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        });
    });
});