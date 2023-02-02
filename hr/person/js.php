<script>
//modal เปิดซ้อนกันได้
$(document).on('show.bs.modal', '.modal', function() {
    const zIndex = 1040 + 10 * $('.modal:visible').length;
    $(this).css('z-index', zIndex);
    setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
        'modal-stack'));
});

$(function() {

    $("#sideHR").show()

    // $.ajax({
    //     type: "POST",
    //     url: "ajax/getDepartment.php",
    //     success: function(result) {
    //         let depid=''
    //         let html=''

    //         for (count = 0; count < result.empcode.length; count++) {

    //             if (depid != result.depid[count] && count!=0) 
    //             html +='</tbody></table></div></td></tr>';

    //             if (depid != result.depid[count]) {
    //                 html +='<tr data-widget="expandable-table" aria-expanded="false"><td><i class = "expandable-table-caret fas fa-caret-right fa-fw"></i>' +
    //                     result.depname[count]+
    //                     '</td></tr> <tr class="expandable-body"><td><div class="p-0"><table class="table"><tbody>';
    //             }
    //             depid = result.depid[count]
    //             html +='<tr><td>'+result.empname[count]+' '+depid+'</td></tr>';




    //         }
    //         $("#listperson #tlist").append(html)

    //         // setTimeout(function() {
    //         //     $('#expandable-table-header-row').ExpandableTable('toggleRow')
    //         // }, 1000);



    //         // console.log(html)


    //     }
    // });



});

$("#btnAdd").click(function() {
    $("#txtCode").prop('disabled', false);
    $("#CancleEmp").hide();
    $("#txtCode").val();
    $('#frmEmployee')[0].reset();
    $("#spanCode").show();
    $("#btnMenu").show();
    $("#spanEditCode").hide();
    $("#btnSubmit").show();
    $("#btnEdit").hide();
    $("#lbCheck").hide();



    $("#frmMenu").fadeIn(10, function() {
        $("#menuName").text('Human Resources (HR) เพิ่มพนักงาน');
        $("#frmList").removeClass();
        $("#frmList").addClass("col-sm-6 col-md-4 col-sm-6 col-md-4");

    });


});

$("#frmEmployee").submit(function() {

    // alert($("#frmEmployee").serialize())
    if ($("#lbCheck").text() == 'สามารถใช้รหัสพนักงานนี้ได้') {
        
        $.ajax({
            type: "POST",
            url: "ajax/addEmployee.php",
            data: $("#frmEmployee").serialize(),
            success: function(result) {
                if (result.status == 1) // Success
                {
                    alert('เพิ่มพนักงานรหัส ' + result.message + ' เรียบร้อยแล้ว');
                    clickRefresh();
                } else // Err
                {
                    alert(result.message);
                }
                // alert(result);
            }
        });
    }
    else
    {
        alert('รหัสพนักงานซ้ำ!!');
        $("#txtCode").focus();
    }
});

$("#btnEdit").click(function() {
    $(':disabled').each(function(event) {
        $(this).removeAttr('disabled');
    });
    // alert($("#EmpEnd").val())
    // alert($("#frmEmployee").serialize())
    $.ajax({
        type: "POST",
        url: "ajax/editEmployee.php",
        data: $("#frmEmployee").serialize(),
        success: function(result) {
            // alert(result)
            if (result.status == 1) // Success
            {
                alert('แก้ไขพนักงานรหัส ' + result.message + ' เรียบร้อยแล้ว');
                clickRefresh();
            } else // Err
            {
                alert(result.message);
            }
            // alert(result);
        }
    });

});

$("#txtCode").change(function() {
    if ($('#txtCode').val() != '') {
        $.ajax({
            url: "ajax/checkempcode.php",
            type: "POST",
            data: {
                checkEmpCode: $('#txtCode').val()
            },
            success: function(data) {
                if (data == 1) {
                    $('#lbCheck').html('สามารถใช้รหัสพนักงานนี้ได้');
                    $('#lbCheck').css({
                        "color": "green",
                        "font-size": "150%"
                    });
                    $('#lbCheck').show();
                    $('#btnSubmit').removeClass('btn btn-primary disabled');
                    $('#btnSubmit').addClass('btn btn-primary active');

                    // alert("Data: " + data + "\nStatus: ");
                } else {
                    $('#lbCheck').html('รหัสพนักงานซ้ำ!!');
                    $('#lbCheck').css({
                        "color": "red",
                        "font-size": "150%"
                    });
                    $('#lbCheck').show();
                    $('#btnSubmit').removeClass('btn btn-primary active');
                    $('#btnSubmit').addClass('btn btn-primary disabled');
                    // alert("Data: " + data + "\nStatus: ");
                }

            },
            error: function() {
                alert("There was an error. Try again please!");
            }
        });
    } else {
        $('#lbCheck').html('กรุณาใส่รหัสพนักงาน!!');
        $('#lbCheck').css({
            "color": "red",
            "font-size": "150%"
        });
        $('#lbCheck').show();
        $('#btnSubmit').removeClass('btn btn-primary active');
        $('#btnSubmit').addClass('btn btn-primary disabled');
    }
});

$("#btnReset").click(function() {
    $("#frmList").removeClass();
    $("#frmList").addClass("col-md-12");
    // $("#btnReset").hide()
    $("#frmMenu").hide()
});

function onclickEditEmployee(empcode) {
    // alert(empcode);
    $("#CancleEmp").show();
    $("#spanCode").hide();
    $("#spanEditCode").show();
    $("#btnSubmit").hide();
    $("#btnEdit").show();
    $("#btnMenu").show();
    $("#menuName").text('Human Resources (HR) แก้ไขพนักงาน');

    $.ajax({
        type: "POST",
        url: "ajax/getsup_emp.php",
        data: {
            empcode: empcode
        },
        success: function(result) {
            // alert(result)
            $("#txtCode").val(result.empcode);
            $("#txtEditCode").val(result.empcode);
            $("#EmpName").val(result.firstname);
            $("#LastName").val(result.lastname);
            $("#ETitleName").val(result.etitlename);
            // $("#EmpNameEN").val(result.EmpNameEN);
            // $("#LastNameEN").val(result.LastNameEN);
            // $("#ETitleNameEN").val(result.ETitleNameEN);
            // $("#SECODE").val(result.SECODE);
            // $("#EmpPosition").val(result.EmpPosition);
            $("#DepCode").val(result.depid);
            
            // $("#EmpTestDate").val(result.EmpTestDate);
            setEmpFirstDate();
            



            // alert(result.empcode);

        }
    });

    $("#frmMenu").show();
    $("#frmList").removeClass();
    $("#frmList").addClass("col-sm-6 col-md-4 col-sm-6 col-md-4");

    // $("#frmList").removeClass();
    // $("#frmList").addClass("col-md-3");
    // $("#btnReset").show()
    // $("#frmMenu").show()
    window.scrollTo(0,0);
    $("#txtCode").prop('disabled', true);
    
}

$("#EmpTestDate").change(function() {
    setEmpFirstDate();
});

function setEmpFirstDate() {
    var EmpTestDate = new Date(document.getElementById("EmpTestDate").value);
    EmpTestDate.setDate(EmpTestDate.getDate() + 119);
    let formatted_date;
    if (EmpTestDate.getMonth() < 9) {
        if (EmpTestDate.getDate() < 10)
            formatted_date = EmpTestDate.getFullYear() + "-0" + (EmpTestDate.getMonth() + 1) + "-0" +
            EmpTestDate
            .getDate();
        else
            formatted_date = EmpTestDate.getFullYear() + "-0" + (EmpTestDate.getMonth() + 1) + "-" + EmpTestDate
            .getDate();
    } else {
        if (EmpTestDate.getDate() < 10)
            formatted_date = EmpTestDate.getFullYear() + "-" + (EmpTestDate.getMonth() + 1) + "-0" + EmpTestDate
            .getDate();
        else
            formatted_date = EmpTestDate.getFullYear() + "-" + (EmpTestDate.getMonth() + 1) + "-" + EmpTestDate
            .getDate();
    }

    $("#EmpFirstDate").val(formatted_date);
}
</script>