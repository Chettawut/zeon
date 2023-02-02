<script type="text/javascript">
$(function() {

    $("#sideStore").show()

    getWD();

    let d = new Date();
    $("#add_wddate").val(d.toISOString().substring(0, 10))
    d.setMinutes(d.getMinutes() - d.getTimezoneOffset());
    $("#add_wdtime").val(d.toISOString().slice(11, 16))

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
    var wdcode = button.data('whatever')

    $('#tableEditwdDetail tbody').empty();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_wd.php",
        data: "idcode=" + wdcode,
        success: function(result) {
            // alert(result)
            $("#wdcode").val(result.wdcode[0]);
            $("#wddate").val(result.wddate[0]);
            $("#wdtime").val(result.wdtime[0]);
            $("#remark").val(result.remark[0]);

            $.ajax({
                type: "POST",
                url: "ajax/getsup_wddetail.php",
                data: "idcode=" + wdcode,
                success: function(result) {
                    // alert(result)
                    for (count = 0; count < result.wdcode.length; count++) {

                        $('#tableEditwdDetail').append(
                            '<tr id="' + result.stcode[count] +
                            '" ><td name="wdno" id="wdno" ><p class="form-control-static" style="text-align:center">' +
                            result.wdno[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result
                            .wdno[count] + ');" name="amount"  id="amount' +
                            result.wdno[count] +
                            '"  value="' +
                            result.amount[count] +
                            '"></td><td><div class="input-group"><input type="text" class="form-control" name="unit" id="unit' +
                            result.wdno[count] + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            result.wdno[count] +
                            ',tableEditPoDetail,' +
                            result
                            .stcode[count] +
                            '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><button type="button" onClick="onDelete_MainTable(\'' +
                            $(
                                '#tableEditwdDetail tr').length +
                            '\',\'edit\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=></button></td></tr>'
                        );

                    }

                }
            });
        }
    });

})

function getWD() {
    $.ajax({
        type: "POST",
        url: "ajax/get_wd.php",
        success: function(result) {
            var supstatus, suptitle;

            for (count = 0; count < result.wdcode.length; count++) {

                if (result.status[count] == '01') {
                    supstatus = 'R'
                    suptitle = 'รอรับของ'
                } else if (result.status[count] == '02') {
                    supstatus = 'N'
                    suptitle = 'ยังรับของไม่ครบ'
                } else if (result.status[count] == '03') {
                    supstatus = 'ตัดเบิกแล้ว'
                    suptitle = 'ตัดเบิกแล้ว'
                } else if (result.status[count] == 'C') {
                    supstatus = 'C'
                    suptitle = 'ยกเลิกการใช้งาน'
                }

                $('#tableWD').append(
                    '<tr id="' + result.wdcode[
                        count] + '" data-toggle="modal" data-target="#modal_edit" id="' + result
                    .wdcode[
                        count] + '" data-whatever="' + result.wdcode[
                        count] + '" ><td>' + result.wdcode[count] +
                    '</td><td>' + result
                    .wddate[count] + '</td><td>' + result
                    .stcode[count] + '</td><td>' + result.stname1[count] + '</td><td>' + result
                    .amount[count] + '</td><td>' + result
                    .name[count] + '</td><td>' + result
                    .projectname[count] + '</td><td><span title="' + suptitle + '">' + supstatus +
                    '</span></td></tr>');
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





// กดยืนยันเพิ่ม WD
$("#frmWD").submit(function(event) {
    event.preventDefault();

    var amount = [];
    var stcode = [];
    var unit = [];
    var cost = [];


    $('#tablewddetail tbody tr').each(function(key) {
        stcode.push($(this).find("td #stcode" + (++key)).text());
    });

    $('#tablewddetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount" + (++key)).val());
    });
    $('#tablewddetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit" + (++key)).val());
    });
    $('#tablewddetail tbody tr').each(function(key) {
        cost.push($(this).find("td #cost" + (++key)).val());
    });


    // alert(cost)
    if (stcode != 0) {
        $(':disabled').each(function(event) {
            $(this).removeAttr('disabled');
        });
        // alert(stcode)
        $.ajax({
            type: "POST",
            url: "ajax/add_wd.php",
            data: $("#frmWD").serialize() + "&amount=" + amount + "&stcode=" + stcode +
                "&unit=" + unit +
                "&cost=" + cost,
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

// กดยืนยันแก้ไข WD
$("#frmEditWD").submit(function(event) {
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

// เพิ่ม wd detail เมื่อเลือกสต๊อก
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

            $('#tablewddetail').append(
                '<tr id="new ' + $('#tablewddetail tr').length +
                '" ><td name="wdno" id="wdno" ><p class="form-control-static" style="text-align:center">' +
                $('#tablewddetail tr').length +
                '</p></td><td><p class="form-control-static" id="stcode' +
                $('#tablewddetail tr').length +
                '" style="text-align:center">' +
                result
                .stcode +
                '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                result.stname1 +
                '</p></td><td><input type="text" class="form-control" name="amount"  id="amount' +
                $('#tablewddetail tr').length +
                '"  value="0"></td><td><div class="input-group"><input type="text" class="form-control" name="unit" id="unit' +
                $('#tablewddetail tr').length + '" value="' +
                result.unit +
                '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                $('#tablewddetail tr').length +
                ',tablewddetail,' +
                result
                .stcode +
                '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="hidden" class="form-control" name="cost" id="cost' +
                $('#tablewddetail tr').length + '" value="' +
                result.sellprice +
                '" disabled><button type="button" onClick="onDelete_MainTable(\'' +
                $(
                    '#tablewddetail tr').length +
                '\',\'add\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=></button></td></tr>'
            );


            var row = $('#tablewdDetail tbody tr').length;

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