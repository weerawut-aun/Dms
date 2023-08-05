$(document).ready(function () {
    $('#frm_insert_faculty').on('submit', function (event) {
        event.preventDefault();
        
        var fct_name = $('#fct_name').val();
        var fct_uploadsize = $('#fct_uploadsize').val();
        var action = 'insert_data';

        if (fct_name == false) {
            alert('กรอกชื่อคณะ');
        } else {
            $.ajax({
                url: "action/fetch_faculty.php",
                method: "POST",
                data: {
                    fct_name: fct_name,
                    fct_uploadsize: fct_uploadsize,
                    action:action
                },
                success: function (data) {
                    $('#frm_insert_faculty')[0].reset();
                    $('#showfct').html(data);
                }
            });
        }
    });

    $('#next-1').click(function(event) {

        event.preventDefault();
        $('#fct_nameError').html('');

        if ($('#fct_name').val() == '') {
            $('#fct_nameError').html('* กรุณากรกอกชื่อคณะ');
            return false;
        } else if (!isNaN(parseFloat($('#fct_name').val()))) {
            $('#fct_nameError').html('* กรุณากรกอกชื่อคณะเป็นตัวอักษร');
            return false;
        } else {
            $('#secound').show();
            $('#first').hide();
            $('#progressBar').css("width", "100%");
            $('#progressText').html("Step - 2/2");
        }

    });

    $('#submit').on('click', function(event) {
        event.preventDefault();
        $('#usr_usernameError').html('');
        $('#usr_passwordError').html('');
        $('#cpassError').html('');

        if ($('#usr_username').val() == '') {
            $('#usr_usernameError').html('* กรุณากรกอกชื่อผู้ใช้งาน');
            return false;
        } else if ($('#usr_password').val() == '') {
            $('#usr_passwordError').html('* กรุณากรกอกรหัสผ่าน');
            return false;
        } else if ($('#cpass').val() == '') {
            $('#cpassError').html('* กรุณากรกอกยืนยันรหัสผ่าน');
            return false;
        } else if ($('#usr_password').val() !== $('#cpass').val()) {
            $('#cpassError').html('* รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน');
            return false;
        } else {
            $.ajax({
                url: 'action/action.php',
                method: 'POST',
                data: $('#insert_faculty').serialize(),
                success: function(data) {
                    if (data == 'ชื่อคณะนี้ซ้ำ') {
                        $('#progressBar').css("width", "50%");
                        $('#progressText').html("Step - 1");
                        $('#secound').hide();
                        $('#first').show();
                        $('#fct_nameError').html(data);
                    } else if (data == 'ชื่อผู้ใช้งานซ้ำ') {
                        $('#secound').show();
                        $('#first').hide();
                        $('#progressBar').css("width", "100%");
                        $('#progressText').html("Step - 2/2");
                        $('#usr_usernameError').html(data);
                        // $('#result').show();
                        // $('#result').html(data);
                    } else {

                        $('#result').show();
                        $('#result').html(data);
                    }

                }
            });
        }

    });

    $('#prev-2').click(function() {
        $('#secound').hide();
        $('#first').show();
        $('#progressBar').css("width", "50%");
        $('#progressText').html("Step - 1/2");
    });
});