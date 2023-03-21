<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">แก้ไขสูตรการผลิต</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmEditBom" id="frmEditBom" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">รหัสสินค้า</label>
                            <input type="text" class="form-control" name="stcode" id="stcode" minlength="6"
                                maxlength="9" disabled>
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label for="recipient-name" class="col-form-label">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="stname1" id="stname1" minlength="6"
                                maxlength="9" disabled>
                        </div>
                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">หน่วยสินค้า</label>
                            <select class="form-control" name="unit" id="unit" disabled>
                                <?php 
                                            
                                        	$sql = "SELECT * FROM `unit` where status = 'Y' ";
                                            $query = mysqli_query($conn,$sql);
                                        
                                            while($row = $query->fetch_assoc()) {
                                                echo '<option value="'.$row["unit"].'">'.$row["unit"].'</option>';
                                            }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="btn-group" id="btnAddSO" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#modal_add"><i class="fa fa fa-tags" aria-hidden="true"></i>
                                เพิ่มสูตรการผลิต</button>
                        </div>
                    </div>
                    <br>
                    <table name="tableBomDetail" id="tableBomDetail" class="table table-bordered table-striped">
                        <thead>
                            <tr style=" background-color:#D6EAF8;">
                                <th width="10%">No.</th>
                                <th width="45%">ชื่อวัตุดิบ</th>
                                <th width="18%">จำนวน</th>
                                <th width="17%">หน่วย</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <input type="hidden" id="code" name="code">
                    <div class="modal-footer">
                        <div class="col text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <!-- <button type="submit" id="btnEditBOM" form="frmEditBom" class="btn btn-primary">แก้ไข</button> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>