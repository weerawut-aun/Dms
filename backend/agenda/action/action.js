$(document).ready(function () {

    $('#frm_insert_agenda').on('submit', function (event) {

        event.preventDefault();

        var agd_name = $('#agd_name').val();
        //    alert(agd_name);
        var mtd_day = $('#mtd_day').val();
        // console.log(mtd_day);
        var mtd_detail = $('#mtd_detail').val();

        if (agd_name == '') {
            alert("กรุณากรกอกหัวข้อประชุม");
        } else if (mtd_day == '') {
            alert("กรุณาเลือกกำหนดการ");
        } else {
            // alert("เรียบร้อยแล้ว");
            $.ajax({
                type: "POST",
                url: 'action/insert_agenda.php',
                data: {
                    agd_name: agd_name,
                    mtd_day: mtd_day,
                    mtd_detail: mtd_detail

                },
                success: function (data) {
                    // console.log(data);
                    // alert(data);
                    $('#result_agenda').html(data);

                }

            });
        }
    });

    $('#frm_edit_agenda').on('submit', function (event) {
        event.preventDefault();

        var agd_id = $('#agd_id').val();
        var agd_name = $('#agd_name_new').val();
        var action = 'edit_agd';

        if (agd_name == '') {
            alert("กรุณากรกอกหัวข้อประชุม");
        } else {
           
            $.ajax({
                type: 'POST',
                url: 'action/action.php',
                data: {
                    agd_id:agd_id,
                    agd_name: agd_name,
                    action:action
                },
                success: function (data) {
                    $('#edit_agenda').html(data);
                }
            });
        }

    });

});