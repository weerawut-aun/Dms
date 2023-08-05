$(document).ready(function () {

    $('#edit_admit').on('submit', function (event) {
        event.preventDefault();

        var prefix = $('#prefix').val();
        var usr_firstname = $('#usr_firstname').val();
        var usr_lastname = $('#usr_lastname').val();

        if (prefix == '' || usr_firstname == '' || usr_lastname == '') {
            alert('กรุณาข้อมูลส่วนตัวให้ครบ');
        } else {
            //   alert('ครบ');
            $.ajax({
                url: 'edit_admin.php',
                method: 'POST',
                data: {
                    prefix: prefix,
                    usr_firstname: usr_firstname,
                    usr_lastname: usr_lastname
                },
                success: function (data) {
                    $('#edit_admit')[0].reset();
                    $('#data_show').html(data);
                }
            });
        }

    });
});