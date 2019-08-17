$(document).ready(function() {
        $(".signUp").hide();
        $(".btnLogin").hide();
        $(".loginNow").hide();

        $(".login").click(function() {

            $(".login").hide();
            $(".signUp").show();
            $(".btnLogin").show();
            $(".btnSingUp").hide();
            $(".loginNow").show();
            $(".signUpNow").hide();


        });

          $(".signUp").click(function() {

            $(".login").show();
            $(".signUp").hide();
            $(".btnLogin").hide();
            $(".btnSingUp").show();
            $(".loginNow").hide();
            $(".signUpNow").show();
            
        });
});
