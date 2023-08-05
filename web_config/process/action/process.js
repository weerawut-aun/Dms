$(document).ready(function(){

    load_agenda();

    function load_agenda(){
        var action = 'fetch_agenda';

        $.ajax({
            url:'action/action.php',
            method:"POST",
            data:{
                action:action
            },
            success:function(data){
                $('#list_agenda').html(data);
                $("#tb_agenda").DataTable();
            }
        });
    }

    load_project();

    function load_project() {
        var action = 'fetch_project';
        $.ajax({
            url: "action/action.php",
            method: "POST",
            data: {
                action:action
            },
            success: function (data) {
               
                $('#list_project').html(data);
                $('#tb_project').DataTable();
            }
        });
    }

    

});