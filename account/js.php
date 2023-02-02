<script type="text/javascript">
$(function() {

    
    $("#sideAccounting").show()

    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.stcode.length; count++) {


                $('#tableStock').append(
                    '<tr data-toggle="modal" data-target="#modelStockEdit" id="' + result
                    .stcode[
                        count] + '" data-whatever="' + result.code[
                        count] + '">.<td>' + result.stcode[count] + '</td><td>' +
                    result.stname1[count] + '</td><td style="text-align:right">' +
                    result.amount1[count] + '</td><td  style="text-align:center">' + result
                    .unit[count] + '</td></tr>');
            }

            var table = $('#tableStock').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
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


$('#modelStockEdit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/getsup_stock.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #code').val(result.code);
            modal.find('.modal-body #editstcode').val(result.stcode);
            modal.find('.modal-body #editstname1').val(result.stname1);
            modal.find('.modal-body #editstorage_id').val(result.storage_id);
            modal.find('.modal-body #editunit').val(result.unit);
            modal.find('.modal-body #editstmin1').val(result.stmin1);
            modal.find('.modal-body #editstmin2').val(result.stmin2);
            modal.find('.modal-body #editsellprice').val(result.sellprice);
            modal.find('.modal-body #editstatus').val(result.status);


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