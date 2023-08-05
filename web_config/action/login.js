$(document).ready(function(){
    $('#login_form').on('submit',function(event){
        event.preventDefault();

        var username = $('#username').val();
        var password = $('#password').val();

        if(username == false || password == false){
            alert('กรุณากรอกชื่อผู้ใช้งานและรหัสผ่านก่อน')
        } else {
            
            $.ajax({
                url:"action/login.php",
                method:"POST",
                data:{
                    username:username,
                    password:password
                },success:function(data){
                  
                    $('#login_form')[0].reset();
                    $('#showlogin').html(data);
                }
            });
        }
    });
  });