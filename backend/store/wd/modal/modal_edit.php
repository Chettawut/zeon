<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">แก้ไขข้อมูลใบเบิก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 700px;">
                <form name="frmEditWD" id="frmEditWD" onkeydown="return event.key != 'Enter';">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>เลขที่ใบเบิก</label>
                            <input type="text" class="form-control" name="wdcode" id="wdcode" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>วันที่เบิก</label>
                            <input type="date" class="form-control" size="4" name="wddate" id="wddate" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>เวลาเบิก</label>
                            <input type="time" class="form-control" size="4" name="wdtime" id="wdtime" required>
                        </div>


                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-8">
                            <label>Cost Project</label>
                            <select class="form-control" name="project" id="project">
                                <?php 
                                            
                                        	$sql = "SELECT * FROM `project` where status = 'Y' ";
                                            $query = mysqli_query($conn,$sql);
                                        
                                            while($row = $query->fetch_assoc()) {
                                                echo '<option value="'.$row["projectcode"].'">'.$row["projectname"].'</option>';
                                            }
                            ?>
                            </select>
                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>หมายเหตุ</label>
                            <textarea id="remark" name="remark" class="form-control">
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="button" id="btnEditWDdetail" style="display:none;" class="btn btn-success" data-toggle="modal"
                            data-target="#modal_stock"><i class="fa fa fa-tags" aria-hidden="true"></i>
                            เพิ่มรายการ</button>
                    </div>



                    <table name="tableEditwdDetail" id="tableEditwdDetail" class="table table-bordered table-striped">
                        <thead style="background-color:#D6EAF8;">
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th width="10%">รหัสสินค้า</th>
                                <th width="45%">ชื่อพัสดุ</th>
                                <th width="15%">จำนวนเบิก</th>
                                <th width="15%">หน่วย</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" id="btnEditWD" form="frmEditWD" class="btn btn-primary">แก้ไข</button>
                </div>
            </div>

        </div>
    </div>
</div>