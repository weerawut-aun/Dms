
function active_inactive_pty(val, pty_id) {
    // alert(pty_id);
    $.ajax({
        type: 'POST',
        url:'./setting/change_pty_status.php',
        data: {val:val,pty_id:pty_id},
        success: function(result){
            $('#project_type').html(result);
        }
    });
}

// function modal_change_pty(val,pty_id){
//     //   alert(pty_id);
//     $.ajax({
//         type: 'POST',
//         url:'../setting/change_pty_status.php',
//         data: {val:val,pty_id:pty_id},
//         success: function(result){
//         //    alert(result);
//         $('#frm_insert_type')[0].reset();
//         $('#modal-pty').modal('hide');
//          $('#list_pty').html(result);
//         }
//     });
// }

// function modal_change_rpt(val,rpt_id){
//     $.ajax({
//         type: 'POST',
//         url: './setting/change_rpt_status.php',
//         data: {val:val,rpt_id:rpt_id},
//         success: function(result){
//             // console.log(result);
//             $('#modal_insert_rpt')[0].reset();
//             $('#modal-rpt').modal('hide');
//             $('#select_person').html(result);
//         }
//     });
// }



function active_inactive_rpt(val,rpt_id){
    $.ajax({
        type: 'POST',
        url: './setting/change_rpt_status.php',
        data: {val:val,rpt_id:rpt_id},
        success: function(result){
            // console.log(result);
            $('#list_person').html(result);
        }
    });
}

function active_inactive_pla(val, pla_id) {

    $.ajax({
        type: 'POST',
        url: './../setting/change_pla_status.php',
        data: {val: val, pla_id: pla_id},
        success: function (result) {
          
            $('#liest_place').html(result);
        }
    });
}

function modal_change_pla(val,pla_id) {
    // alert(pla_id);
    $.ajax({
        type: 'POST',
        url: './../setting/change_pla_status.php',
        data: { val: val, pla_id: pla_id },
        success: function (result) {
            $('#modal_insert_pla')[0].reset();
            $('#modal-pla').modal('hide');
            $('#selecet_place').html(result);
        }
    });
}

function demo() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true              //Set เป็นปี พ.ศ.
    }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
  }

