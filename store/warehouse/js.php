<script type="text/javascript">
$(function() {

    $("#sideStore").show()
    
    $.ajax({
        type: "POST",
        url: "ajax/get_places.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.placescode.length; count++) {

                let status
                if(result.status[count]=='Y')
                status = 'เปิดใช้งาน'
                else
                status = 'ปิดใช้งาน'
                $('#tablePlaces').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .placescode[
                        count] + '" data-whatever="' + result.placescode[
                        count] + '">.<td>' + result.places[count] + '</td><td  style="text-align:center">' + status + '</td></tr>');
            }

            var table = $('#tablePlaces').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });

            $(".dataTables_filter input[type='search']").attr({
                size: 60,
                maxlength: 60
            });



        }
    });


})


$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/getsup_places.php",
        data: "idcode=" + recipient,
        success: function(result) {            
            modal.find('.modal-body #placescode').val(result.placescode);
            modal.find('.modal-body #places').val(result.places);
            modal.find('.modal-body #status').val(result.status);


        }
    });
});

$('#modelEdit').on('hidden.bs.modal', function() {
    $("#frmEditInventory *").prop('disabled', true);
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//เพิ่มวัสดุ
$("#frmAddPlaces").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_places.php",
        data: $("#frmAddPlaces").serialize(),
        success: function(result) {
            if (result.status == 1) // Success
            {
                alert(result.message);
                window.location.reload();
                // console.log(result.message);
            } else {
                alert('รหัสซ้ำ');
            }
        }
    });


});

$("#frmEditPlaces").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
    $.ajax({
        type: "POST",
        url: "ajax/edit_places.php",
        data: $("#frmEditPlaces").serialize(),
        success: function(result) {

            if (result.status == 1) // Success
            {
                alert(result.message);
                window.location.reload();
                // console.log(result.message);
            }
        }
    });

});
</script>