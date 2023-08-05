$(document).ready(function () {
    
    load_data_place();

    function load_data_place() {
        var action = 'fetch';

        $.ajax({
            url: '../backend/project/info/action_place.php',
            method: "POST",
            data: {
                action:action
            },
            success: function (data) {
                $('#data_place').html(data);
            }
        });
    }

    
    $('#frm_new_place').on('submit', function (event) {
        event.preventDefault();
        var ipe_place = $('#select_ipe_place').val();
        var action = 'insert_data';
        // console.log(ipe_place);
        if (ipe_place == '') {
            alert('กรุณาเลือกข้อมูล ก่อนทำรายการ');
        } else {
            $.ajax({
                url: "../backend/project/info/action_place.php",
                method: "POST",
                data: {
                    ipe_place: ipe_place,
                    action:action
                },
                success: function (data) {
                    $('#frm_new_place')[0].reset();
                    $('#modal-newipe').modal('hide');
                    $('#message_place').html(data);
                    load_data_place();
                }
            });
        }
    });

    $(document).on('click', '.list_ipe',function () {
        var action = 'fetch_modal';

        $.ajax({
            url: '../backend/project/info/action_place.php',
            method: "POST",
            data: {
                action:action
            },
            success: function (data) {
                $('#place-reloaded').html(data);
            }
        });
    });
});