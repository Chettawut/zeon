<script type="text/javascript">
//modal เปิดซ้อนกันได้
$(document).on('show.bs.modal', '.modal', function() {
    const zIndex = 1040 + 10 * $('.modal:visible').length;
    $(this).css('z-index', zIndex);
    setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
        'modal-stack'));
});

$(function() {

    $("#sideEngineer").show()

    $.ajax({
        type: "POST",
        url: "ajax/get_bom.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {
            // alert(result)
            for (count = 0; count < result.stcodemain.length; count++) {


                $('#tableBom').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .stcodemain[
                        count] + '" data-whatever="' + result.stcodemain[
                        count] + '"><td>' + result.stcodemain[count] + '</td><td>' +
                    result.stname1[count] + '</td></tr>');
            }

            var table = $('#tableBom').DataTable({
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


$.ajax({
    type: "POST",
    url: "ajax/get_stock.php",
    success: function(result) {

        for (count = 0; count < result.stcode.length; count++) {


            $('#table_addstock').append(
                '<tr data-toggle="modal" data-dismiss="modal" onClick="onSelect_addstock(\'' +
                result.stcode[count] + '\',\'' +
                result.stname1[count] + '\',\'' +
                result.unit[count] + '\');" ><td>' + result.stcode[count] + '</td><td>' +
                result.stname1[count] + '</td><td>' +
                result.unit[count] + '</td></tr>');
        }

        $('#table_addstock').DataTable({
            "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
            "ordering": true
        });


        $(".dataTables_filter input[type='search']").attr({
            size: 60,
            maxlength: 60
        });


    }
});

function onSelect_addstock(stcode, stname1, unit) {


    let stcodemain = $('#stcode').val()

    if (confirm("Press a button!")) {
        $.ajax({
            type: "POST",
            url: "ajax/add_bom.php",
            data: "stcode=" + stcode + "&stcodemain=" + stcodemain+ "&unit=" + unit,
            success: function(result) {

                $('#tableBomDetail').append(
                    '<tr ><td>' + stcode + '</td><td>' +
                    stname1 + '</td><td>1</td><td>' +
                    unit + '</td></tr>');

            }
        });
    }



}

$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);
    $("#tableBomDetail tbody").empty();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_bom.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #stcode').val(result.stcodemain[0]);
            modal.find('.modal-body #stname1').val(result.stnamemain[0]);
            modal.find('.modal-body #unit').val(result.unitmain[0]);

            for (count = 0; count < result.stcode.length; count++) {


                $('#tableBomDetail').append(
                    '<tr ><td>' + result.stcode[count] + '</td><td>' +
                    result.stname1[count] +
                    '</td><td><input type="number" id="quantity" name="quantity" class="form-control" value="' +
                    result.amount[count] + '" ></td><td>' +
                    result.unit[count] + '</td></tr>');
            }


        }
    });
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//เพิ่มวัสดุ
$("#frmAddBom").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_bom.php",
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

$("#frmEditBom").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
    $.ajax({
        type: "POST",
        url: "ajax/edit_bom.php",
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