<script type="text/javascript">
$(function() {

    $("#sideProduct").show()

    getPR();

    $.ajax({
        type: "POST",
        url: "ajax/get_supplier.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_id tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .supcode[count] + '" onClick="onClick_tr(this.id,\'' + result.supname[
                        count] + '\',\'' + result.address[count] + '\');"><td>' + result.code[
                        count] + '</td><td>' +
                    result.supcode[count] + '</td><td>' +
                    result.supname[count] + '</td></tr>');


            }

            $('#table_id').DataTable({
                "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
                "ordering": true
            });


            $(".dataTables_filter input[type='search']").attr({
                size: 40,
                maxlength: 40
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_stock tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .stcode[count] + '" );"><td>' + result.code[count] + '</td><td>' +
                    result.stcode[count] + '</td><td>' +
                    result.stname1[count] + '</td></tr>');


            }

            $('#table_stock').DataTable({
                "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
                "ordering": true
            });


            $(".dataTables_filter input[type='search']").attr({
                size: 40,
                maxlength: 40
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "ajax/get_unit.php",

        success: function(result) {

            for (count = 0; count < result.unitcode.length; count++) {

                $('#table_unit tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal" onClick="onClick_unit(\'' +
                    result.unit[count] + '\');"  id="' +
                    result
                    .unitcode[count] + '" );"><td>' + result.unitcode[count] +
                    '</td><td>' +
                    result.unit[count] + '</td></tr>');


            }

            $('#table_unit').DataTable({
                "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
                "ordering": true
            });


            $(".dataTables_filter input[type='search']").attr({
                size: 40,
                maxlength: 40
            });
        }
    });
});

$('#modal_unit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('whatever')
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/get_unit.php",

        success: function(result) {
            $('#table_unit tbody').empty();
            for (count = 0; count < result.unitcode.length; count++) {

                $('#table_unit tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal" onClick="onClick_unit(\'' +
                    result.unit[count] + '\',\'' + recipient + '\');"  id="' +
                    result
                    .unitcode[count] + '" );"><td>' + result.unitcode[count] +
                    '</td><td>' +
                    result.unit[count] + '</td></tr>');


            }


        }
    });
})

function onClick_tr(id, supname, address) {
    $('#supcode').val(id);
    $('#tdname').val(supname);
    $('#address').val(address);
}

function onClick_unit(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    var stcode = target.split(',')[2];

    // alert(target + ' ' + stcode);

    $.ajax({
        type: "POST",
        url: "ajax/cal_stock.php",
        data: "idcode=" + stcode,
        success: function(result) {

            $('#unit' + row).val(unit);
            if (unit == 'ลัง')
                $('#price' + row).val(result.ratio * result.sellprice);
            else
                $('#price' + row).val(result.sellprice);

        }
    });

}

function previewPOcode() {
    $.ajax({
        type: "POST",
        url: "ajax/get_pocode.php",
        success: function(result) {

            $("#pocode").val(result.pocode);

        }
    });

}

function onDeleteDetail() {
    $("#tablePoDetail tbody").empty();
    $('#btnClearPOdetail').hide();

}

function getTotal(row) {
    $('#total' + row).html(formatMoney(($('#amount' + row).val() *
        $('#price' +
            row).val()) - ((($('#amount' + row).val() *
        $(
            '#price' + row).val()) * $(
        '#discount' +
        row).val()) / 100), 2));

}


$('#modal_add').on('show.bs.modal', function(event) {
    previewPOcode();
})

$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var pocode = button.data('whatever')

    $("#editpocode").val(pocode);
    $("#printpocode").val(pocode);
    $('#tableEditPoDetail tbody').empty();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_po.php",
        data: "idcode=" + pocode,
        success: function(result) {

            $("#editpocode").val(result.pocode);
            $("#editsupcode").val(result.supcode);
            $("#edittdname").val(result.supname);
            $("#editaddress").val(result.address);
            $("#editpodate").val(result.podate);
            $("#editdeldate").val(result.deldate);
            $("#editpayment").val(result.payment);
            $("#editpoqua").val(result.poqua);
            $("#editcurrency").val(result.currency);
            $("input[name=editvat][value=" + result.vat + "]").prop('checked', true);


            $.ajax({
                type: "POST",
                url: "ajax/getsup_podetail.php",
                data: "idcode=" + pocode,
                success: function(result) {
                    for (count = 0; count < result.stcode.length; count++) {

                        $('#tableEditPoDetail').append(
                            '<tr id="' + result.stcode[count] +
                            '" ><td name="pono" id="pono" ><p class="form-control-static" style="text-align:center">' +
                            result.pono[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result
                            .pono[count] + ');" name="amount"  id="amount' +
                            result.pono[count] +
                            '"  value="' +
                            result.amount[count] +
                            '"></td><td><div class="input-group"><input type="text" class="form-control" name="unit" id="unit' +
                            result.pono[count] + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            result.pono[count] +
                            ',tableEditPoDetail,' +
                            result
                            .stcode[count] +
                            '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result.pono[count] + ');" name="price" id="price' +
                            result.pono[count] + '" value="' +
                            result.price[count] +
                            '"></td><td><div class="input-group"><input type="text" class="form-control" onChange="getTotal(' +
                            result.pono[count] +
                            ');" name="discount" id="discount' +
                            result.pono[count] +
                            '" value="' +
                            result.discount[count] +
                            '"><div class="input-group-addon">%</div></div></td><td ><p name="total" id="total' +
                            result.pono[count] +
                            '" class="form-control-static" style="text-align:right">0</p></td><td><button type="button" onClick="onDelete_MainTable(\'' +
                            $(
                                '#tablePoDetail tr').length +
                            '\',\'edit\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=></button></td></tr>'
                        );
                        getTotal(result.pono[count]);

                        // $disable = '';
                        if (result.supstatus[count] == '03' || result.supstatus[
                            count] == 'C') {

                            $("#frmEditPO input").prop("disabled", true);
                            $("#frmEditPO select").prop("disabled", true);
                            $("#tableEditPoDetail tbody input").prop("disabled", true);
                            // $disable = 'disabled';
                        } else {
                            $("#frmEditPO input").prop("disabled", false);
                            $("#frmEditPO select").prop("disabled", false);
                            $("#tableEditPoDetail tbody input").prop("disabled", false);
                            $('#editpocode').prop("disabled", true);
                            $('#editsupcode').prop("disabled", true);
                            $('#edittdname').prop("disabled", true);
                            $('#editaddress').prop("disabled", true);
                            $('#editpocode').prop("disabled", true);
                            $("#tableEditPoDetail tbody input[name*='unit']").prop(
                                "disabled",
                                true);
                        }

                    }

                }
            });
        }
    });

})

function getPR() {
    $.ajax({
        type: "POST",
        url: "ajax/get_pr.php",
        success: function(result) {
            var supstatus, suptitle;

            for (count = 0; count < result.prcode.length; count++) {

                if (result.supstatus[count] == '01') {
                    supstatus = 'รออนุมัติ'
                    suptitle = 'รออนุมัติ'
                } else if (result.supstatus[count] == 'APO') {
                    supstatus = 'รอออก PO'
                    suptitle = 'รอออก PO'
                } else if (result.supstatus[count] == 'R') {
                    supstatus = 'รอรับของ'
                    suptitle = 'รอรับของ'
                } else if (result.supstatus[count] == 'Y') {
                    supstatus = 'รอของแล้ว'
                    suptitle = 'รอของแล้ว'
                } else if (result.supstatus[count] == 'C') {
                    supstatus = 'ยกเลิกการใช้งาน'
                    suptitle = 'ยกเลิกการใช้งาน'
                }

                // $('#tablePR').append(
                //     '<tr id="' + result.prcode[
                //         count] + '" data-toggle="modal" data-target="#modal_edit" id="' + result
                //     .prcode[
                //         count] + '" data-whatever="' + result.prcode[
                //         count] + '" ><td>' + result.prcode[count] +
                //     '</td><td>' + result
                //     .prdate[count] + '</td><td>' + result
                //     .stcode[count] + '</td><td>' + result.stname1[count] + '</td><td>' + result
                //     .amount[count] + '</td><td><span title="' + suptitle + '">' + supstatus +
                //     '</span></td></tr>');
            }

            var table = $('#tableWD').DataTable({
                "dom": '<"pull-right"f>rt<"bottom"p><"clear">',
                "order": [],
                "pageLength": 20
            })

            $(".dataTables_filter input[type='search']").attr({
                size: 60,
                maxlength: 60
            });

        }
    });
}





// กดยืนยันเพิ่ม PO
$("#frmPO").submit(function(event) {
    event.preventDefault();

    var id = [];
    var amount = [];
    var stcode = [];
    var unit = [];
    var price = [];
    var discount = [];


    $('#tablePoDetail tbody tr').each(function() {
        id.push($(this).attr("id"));
    });

    $('#tablePoDetail tbody tr').each(function(key) {
        stcode.push($(this).find("td #stcode" + (++key)).text());
    });

    $('#tablePoDetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount" + (++key)).val());
    });
    $('#tablePoDetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit" + (++key)).val());
    });
    $('#tablePoDetail tbody tr').each(function(key) {
        price.push($(this).find("td #price" + (++key)).val());
    });
    $('#tablePoDetail tbody tr').each(function(key) {
        discount.push($(this).find("td #discount" + (++key)).val());
    });
    // alert(stcode)
    if (stcode != 0) {
        $(':disabled').each(function(event) {
            $(this).removeAttr('disabled');
        });
        // alert(stcode)
        $.ajax({
            type: "POST",
            url: "ajax/add_po.php",
            data: $("#frmPO").serialize() + "&amount=" + amount + "&stcode=" + stcode +
                "&unit=" + unit +
                "&price=" + price +
                "&discount=" + discount,
            success: function(result) {
                if (result.status == 1) {
                    alert(result.message);
                    window.location.reload();
                    // console.log(result.sql);
                } else {
                    alert('err');
                    console.log(result.message);
                }
            }
        });
    } else {
        alert('กรุณาเพิ่มรายการ');
    }
});

// กดยืนยันแก้ไข PO
$("#frmEditPO").submit(function(event) {
    event.preventDefault();

    var amount = [];
    var stcode = [];
    var unit = [];
    var price = [];
    var discount = [];

    $(':disabled').each(function(event) {
        $(this).removeAttr('disabled');
    });


    $('#tableEditPoDetail tbody tr').each(function() {
        stcode.push($(this).attr("id"));
    });
    $('#tableEditPoDetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount" + (++key)).val());
    });
    $('#tableEditPoDetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit" + (++key)).val());
    });
    $('#tableEditPoDetail tbody tr').each(function(key) {
        price.push($(this).find("td #price" + (++key)).val());
    });
    $('#tableEditPoDetail tbody tr').each(function(key) {
        discount.push($(this).find("td #discount" + (++key)).val());
    });


    $.ajax({
        type: "POST",
        url: "ajax/edit_po.php",
        data: $("#frmEditPO").serialize() + "&amount=" + amount + "&stcode=" + stcode +
            "&unit=" + unit +
            "&price=" + price +
            "&discount=" + discount,
        success: function(result) {
            if (result.status == 1) {
                alert(result.message);
                window.location.reload();
                // console.log(result.sql);
            } else {
                alert('err');
                console.log(result.message);
            }
        }
    });

});

// เพิ่ม po detail เมื่อเลือกสต๊อก
$("#table_stock").delegate('tr', 'click', function() {
    var id = $(this).attr("id");
    $('#btnClearPOdetail').show();
    $.ajax({
        type: "POST",
        url: "ajax/getsup_stock.php",
        data: "idcode=" + id,
        success: function(result) {

            var today = new Date();
            var dd = today.getDate() + 7;

            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }
            today = yyyy + '-' + mm + '-' + dd;
            // console.log(today);

            $('#tablePoDetail').append(
                '<tr id="new ' + $('#tablePoDetail tr').length +
                '" ><td name="pono" id="pono" ><p class="form-control-static" style="text-align:center">' +
                $('#tablePoDetail tr').length +
                '</p></td><td><p class="form-control-static" id="stcode' +
                $('#tablePoDetail tr').length +
                '" style="text-align:center">' +
                result
                .stcode +
                '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                result.stname1 +
                '</p></td><td><input type="text" class="form-control" name="amount"  id="amount' +
                $('#tablePoDetail tr').length +
                '"  value="0"></td><td><div class="input-group"><input type="text" class="form-control" name="unit" id="unit' +
                $('#tablePoDetail tr').length + '" value="' +
                result.unit +
                '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                $('#tablePoDetail tr').length +
                ',tablePoDetail,' +
                result
                .stcode +
                '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="text" class="form-control" name="price" id="price' +
                $('#tablePoDetail tr').length + '" value="' +
                result.sellprice +
                '"></td><td><div class="input-group"><input type="text" class="form-control" name="discount" id="discount' +
                $(
                    '#tablePoDetail tr').length +
                '" value="0 %"</div></td><td ><p name="total" id="total' +
                $('#tablePoDetail tr')
                .length +
                '" class="form-control-static" style="text-align:right">0.00</p></td><td><button type="button" onClick="onDelete_MainTable(\'' +
                $(
                    '#tablePoDetail tr').length +
                '\',\'add\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=></button></td></tr>'
            );


            var row = $('#tablePoDetail tbody tr').length;

            $('#amount' + row).change(function() {
                $('#total' + row).html(formatMoney(($('#amount' + row).val() *
                    $('#price' +
                        row).val()) - ((($('#amount' + row).val() *
                    $(
                        '#price' + row).val()) * $(
                    '#discount' +
                    row).val()) / 100), 2));
            });

            $('#price' + row).change(function() {
                $('#total' + row).html(formatMoney(($('#amount' + row).val() *
                    $('#price' +
                        row).val()) - ((($('#amount' + row).val() *
                    $(
                        '#price' + row).val()) * $(
                    '#discount' +
                    row).val()) / 100), 2));
            });

            $('#discount' + row).change(function() {
                $('#total' + row).html(formatMoney(($('#amount' + row).val() *
                    $('#price' +
                        row).val()) - ((($('#amount' + row).val() *
                    $(
                        '#price' + row).val()) * $(
                    '#discount' +
                    row).val()) / 100), 2));
            });

            $('input[type=text]').on('keydown', function(e) {
                $('#total' + row).html(formatMoney(($('#amount' + row).val() *
                    $('#price' +
                        row).val()) - ((($('#amount' + row).val() *
                    $(
                        '#price' + row).val()) * $(
                    '#discount' +
                    row).val()) / 100), 2));
            });


        }
    });


});

function onDelete_MainTable(id, type) {

    // alert(id)
    if (confirm("ยืนยันการลบรายการ")) {
        if (type == 'get') {

            // alert(id.replace("detail", ""))
            $.ajax({
                type: "POST",
                url: "ajax/deletesup_so.php",
                data: "id=" + id.replace("detail", ""),
                success: function(result) {
                    if (result.status == 1) // Success
                    {
                        // alert(result.sql);
                        // alert(result.message);
                        $("#" + id).remove();
                    } else // Err
                    {
                        alert(result.message);
                    }
                    // alert(result);
                }
            });

        } else
            $("#new\\ " + id).remove();
    }
}



//Refresh
$("#btnRefresh").click(function() {
    RefreshPage();
});
</script>