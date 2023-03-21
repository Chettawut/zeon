<script type="text/javascript">
$(function() {

    // $("#sideStore").show()
    $("#sfdate").val(new Date().toISOString().substring(0, 7));
    // alert($("#sfdate").val())

    getList($("#sfdate").val())

})

$("#sfdate").change(function() {
    getList($("#sfdate").val())
});

function getList(sfdate) {

    let table = $('#tableStock').DataTable();

    table.clear().draw().destroy();

    $.ajax({
        type: "POST",
        url: "ajax/get_sf.php",
        data: "sfdate=" + sfdate,
        success: function(result) {

            let stcode = new Array();
            let amount = new Array();
            let stname1 = new Array();
            let unit = new Array();

            for (count = 0; count < result.stcode.length; count++) {

                if (arraySearch(stcode, result.stcode[count]) == false) {
                    stcode.push(result.stcode[count]);
                    amount.push(result.amount[count]);
                    stname1.push(result.stname1[count]);
                    unit.push(result.unit[count]);
                } else {
                    amount[arraySearch(stcode, result.stcode[count])] += result.amount[count];
                }

                // $('#tableStock').append(
                // '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                // .stcode[
                //     count] + '" data-whatever="' + result.stcode[
                //     count] + '">.<td>' + result.stcode[count] + '</td><td>' +
                // result.stname1[count] + '</td><td style="text-align:right">' +
                // result.amount[count] + '</td><td  style="text-align:center">' + result
                // .unit[count] + '</td></tr>');

            }

            for (count = 0; count < stcode.length; count++) {
                $('#tableStock tbody').append(
                    '<tr ><td>' + stcode[count] + '</td><td>' +
                    stname1[count] + '</td><td style="text-align:right">' +
                    amount[count] + '</td><td  style="text-align:center">' + unit[count] + '</td></tr>');
            }
                var table = $('#tableStock').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": false,
                    "autoWidth": false,
                    "responsive": true
                });

                $(".dataTables_filter input[type='search']").attr({
                    size: 60,
                    maxlength: 60
                });



        }
    });
}


// $('#modal_edit').on('show.bs.modal', function(event) {
//     var button = $(event.relatedTarget);
//     var recipient = button.data('whatever');
//     var modal = $(this);

//     $.ajax({
//         type: "POST",
//         url: "ajax/getsup_stock.php",
//         data: "idcode=" + recipient,
//         success: function(result) {



//             modal.find('.modal-body #code').val(result.code);
//             modal.find('.modal-body #stcode').val(result.stcode);
//             modal.find('.modal-body #stname1').val(result.stname1);
//             modal.find('.modal-body #unit').val(result.unit);
//             modal.find('.modal-body #stmin1').val(result.stmin1);
//             modal.find('.modal-body #stmin2').val(result.stmin2);
//             modal.find('.modal-body #stmax').val(result.stmax);
//             modal.find('.modal-body #type').val(result.type);
//             modal.find('.modal-body #status').val(result.status);


//         }
//     });
// });


$("#btnRefresh").click(function() {
    window.location.reload();
});
</script>