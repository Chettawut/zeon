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
        $("#frmList").addClass("col-md-4");

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
    } else {
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
    $("#menuName").text('จัดการเวลาทำงาน');

    $.ajax({
        type: "POST",
        url: "ajax/get_Employee.php",
        data: {
            empCode: empcode
        },
        success: function(result) {
            $("#txtCode").val(result.empcode);
            $("#txtEditCode").val(result.empcode);
            $("#EmpName").val(result.EmpName);
            $("#LastName").val(result.LastName);
            $("#ETitleName").val(result.ETitleName);
            $("#EmpNameEN").val(result.EmpNameEN);
            $("#LastNameEN").val(result.LastNameEN);
            $("#ETitleNameEN").val(result.ETitleNameEN);
            $("#SECODE").val(result.SECODE);
            $("#EmpPosition").val(result.EmpPosition);
            $("#DepCode").val(result.DepCode);
            $("#WorkAt").val(result.WorkAt.replace(/^\s+|\s+$/gm, ''));
            $("#EmpTestDate").val(result.EmpTestDate);
            $("#EmpNickName").val(result.EmpNickName);
            $("#EmpBirth").val(result.EmpBirth);
            $("#Weight").val(result.Weight);
            $("#Height").val(result.Height);
            $("#TaxCode").val(result.TaxCode);
            $("#EmpBirthPlace").val(result.EmpBirthPlace);
            $("#SocialCode").val(result.SocialCode);
            $("#EmpPublicCode").val(result.EmpPublicCode);
            $("#HospitalCode").val(result.HospitalCode);
            $("#Citizen").val(result.Citizen);
            $("#Nationality").val(result.Nationality);
            $("#Religion").val(result.Religion);
            $("#Blood").val(result.Blood);
            $("#EmpStatus").val(result.EmpStatus.replace(/^\s+|\s+$/gm, ''));
            $("#Mobile").val(result.Mobile);
            $("#Conscripted").val(result.Conscripted);
            $("#Ability").val(result.Ability);
            $("#AbilityComputer").val(result.AbilityComputer);
            $("#Hobbies").val(result.Hobbies);
            $("#Sports").val(result.Sports);
            $("#TypingTH").val(result.TypingTH);
            $("#TypingEN").val(result.TypingEN);



        }
    });


    let time = ['08:17', '17:00','07:38', '17:01','07:52', '17:23','07:39', '17:06']
    let date = ['10/01/2023', '10/01/2023','11/01/2023', '11/01/2023','12/01/2023', '12/01/2023','13/01/2023', '13/01/2023']
    
    for (count = 0; count < time.length; count++) {
        $("#tabletime").append('<tr><td>' + date[count] + '</td><td>610718001</td><td></td><td>' + time[count] + '</td><td></td><td>เครื่องรูดบัตร</td><td></td><td>' + date[count] + '</td><td><button type="button" onClick="onApprove(\'' +
                    [count] +
                    '\')"; class="btn btn-primary form-control"><i class="fas fa-edit"></i></button></td></tr>')
    }

    $("#frmMenu").show();
    $("#frmList").removeClass();
    $("#frmList").addClass("col-md-3");

    // $("#frmList").removeClass();
    // $("#frmList").addClass("col-md-3");
    // $("#btnReset").show()
    // $("#frmMenu").show()
    window.scrollTo(0, 0);
    $("#txtCode").prop('disabled', true);

}
</script>