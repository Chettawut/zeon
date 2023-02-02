<script type="text/javascript">
$(function() {

    $("#sideEngineer").show()

    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {
            // alert(result)
            for (count = 0; count < result.stcodemain.length; count++) {


                $('#tableStock').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .stcodemain[
                        count] + '" data-whatever="' + result.stcodemain[
                        count] + '">.<td>' + result.stcodemain[count] + '</td><td>' +
                    result.stname1[count] + '</td></tr>');
            }

            var table = $('#tableStock').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });

            $(".dataTables_filter input[type='search']").attr({
                size: 30,
                maxlength: 30
            });



        }
    });


})


$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);
    $("#tableSO tbody").empty();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_stock.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #stcode').val(result.stcode[0]);
            modal.find('.modal-body #stname1').val(result.stname1[0]);
            modal.find('.modal-body #unit').val(result.unit[0]);


            for (count = 0; count < result.stcodemain.length; count++) {


                $('#tableSO').append(
                    '<tr ><td>' + result.stcode[count] + '</td><td>' +
                    result.stname1[count] + '</td><td>' + result.amount[count] + '</td><td>' +
                    result.unit[count] + '</td></tr>');
            }


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
$("#frmAddStock").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_stock.php",
        data: $("#frmAddStock").serialize(),
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

$("#frmEditStock").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
    $.ajax({
        type: "POST",
        url: "ajax/edit_stock.php",
        data: $("#frmEditStock").serialize(),
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