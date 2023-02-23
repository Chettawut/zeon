<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">แก้ไขข้อมูลใบรับสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 700px;">
                <form name="frmEditRR" id="frmEditRR" onkeydown="return event.key != 'Enter';">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>เลขที่ใบรับสินค้า</label>
                            <input type="text" class="form-control" name="editrrcode" id="editrrcode" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>วันที่รับสินค้า</label>
                            <input type="date" class="form-control" name="editrrdate" id="editrrdate" disabled>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>รหัสผู้ขาย</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="editsupcode" id="editsupcode" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" data-toggle="modal" data-target="#modal_one"
                                        type="button"><span class="fa fa-search"></span></button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>ชื่อผู้ขาย</label>
                            <input type="text" class="form-control" name="edittdname" id="edittdname" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="recipient-name" class="col-form-label">Invoice No.</label>
                            <input type="text" class="form-control" name="editinvcode" id="editinvcode" disabled>
                        </div>
                        <div class="form-group col-md-6  offset-md-2">
                            <label for="recipient-name" class="col-form-label">วันที่ออก Invoice</label>
                            <input type="date" class="form-control" size="4" name="editinvdate" id="editinvdate"
                                disabled>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-5">
                            <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                            <select class="form-control" name="editpayment" id="editpayment" disabled>
                                <option value="เงินสด" selected>เงินสด</option>
                                <option value="30 วัน">30 วัน</option>
                                <option value="45 วัน">45 วัน</option>
                                <option value="60 วัน">60 วัน</option>
                                <option value="90 วัน">90 วัน</option>
                                <option value="120 วัน">120 วัน</option>
                            </select>
                        </div>
                    </div>

                    <table name="tableEditRRDetail" id="tableEditRRDetail" class="table table-bordered table-striped">
                        <thead style="background-color:#D6EAF8;">
                            <tr>
                                <th style="width:3%;">ลำดับ</th>
                                <th style="width:8%;">ใบสั่งซื้อ</th>
                                <th style="width:9%;">รหัสสินค้า</th>
                                <th>รายการสินค้า</th>                                
                                <th style="width:12%;">หน่วย</th>
                                <th style="width:9%;">จำนวนซื้อ</th>
                                <th style="width:9%;">จำนวนรับ</th>
                                <th style="width:15%;">คลังสินค้า</th>
                                <th>สถานะ</th>
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
                    <button type="submit" id="btnEditPO" form="frmEditPO" class="btn btn-primary">แก้ไข</button>
                </div>
            </div>

        </div>
    </div>
</div>