$(document).ready(function() {

    load_data_oject();

    function load_data_oject() {
        var action = 'fetch';

        $.ajax({
            url: 'info/action_object.php',
            method: "POST",
            data: {
                action: action
            },
            success: function(data) {
                $('#data_oject').html(data);
            }
        });
    }
    
    $('#frm_new_object').on('submit', function (event) {
        event.preventDefault();
        var new_object = $('#new_object').val();
        var action = 'insert_data';
        if (new_object == false) {
            alert('กรุณากรอกข้อมูล ก่อนทำรายการ');
        } else {
            $.ajax({
                url: "info/action_object.php",
                method: "POST",
                data: {
                    new_object: new_object,
                    action:action
                },
                success: function (data) {
                    $('#frm_new_object')[0].reset();
                    $('#modal-newobject').modal('hide');
                    $('#message_object').html(data);
                    load_data_oject();
                }
            });
        }
    });


    $(document).on('click', '.list_iof', function () {
        var action = 'fetch_modal';

        $.ajax({
            url: 'info/action_object.php',
            method: "POST",
            data: {
                action: action
            },
            success: function (data) {
                $('#oject-reloaded').html(data);
            }
        });
    });

});