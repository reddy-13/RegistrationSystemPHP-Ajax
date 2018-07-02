$(document).ready(function(){
    function verify_email(email){
        $(".e_error").hide();
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{check_email:1,email:email},
            success: function(data){
                $(".e_error").show();
                if(data == "already_exists"){
                    $(".e_error").html("Email Already Exists");
                }else if(data == "invalid_email"){
                    $(".e_error").html("Invalid Email Address");
                }else if(data == "ok"){
                    $(".e_error").html("ok");
                }
            }
        })
    }
    $("#u_email").focusout(function(){
        var email = $("#u_email").val();
        verify_email(email);
    })
    //register user
    $("#register_form").on("submit",function(){
        $.ajax({
            url:"action.php",
            method:"POST",
            data : $("#register_form").serialize(),
            success : function(data){
                alert(data);
            }
        })
    })
});