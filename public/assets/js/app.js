$(document).ready(function () {
    $(document).on('click', '#login-trigger', function () {
        console.log('OK');
        // $(this).next('#login-content').slideToggle();
        $('#login-content').slideToggle(500);
        $('#login-trigger').toggleClass('active');

        if ($('#login-trigger').hasClass('active')) $('#login-trigger').find('span').html('&#x25B2;');
        else $('#login-trigger').find('span').html('&#x25BC;');
    });

    // $(document).on('click', '#submit', function () {
    //     let $userName = $('#user-login').val();
    //     let $password = $('#user-password').val();
    //     $.ajax({
    //         url: "/user/login/",
    //         type: "POST",
    //         dataType: "json",
    //         cache: false,
    //         data: {
    //             login: $userName,
    //             password: $password
    //         },
    //         success: function(data) {
    //
    //            alert (data);
    //         },
    //         error: function (error) {
    //             console.log(error);
    //         }
    //
    //     });
    // })
});
