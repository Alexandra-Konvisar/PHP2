$(document).ready(function () {

   $(document).on('click', '#login-btn', function () {
       let login = $('#login').val();
       let password = $('#password').val();

       $.ajax({
           url: "/user/login/",
           type: "POST",
           dataType: "text",
           cache: false,
           data: {
               login: login,
               password: password
           },

           success: function(data) {

               alert(data);
           },

           error: function (error) {
               console.log(error);
           }

       });

       console.log(login);
       console.log(password);

   });


});