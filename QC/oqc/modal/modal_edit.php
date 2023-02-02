<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">แก้ไขข้อมูลใบสั่งซื้อ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 700px;">
                <form name="frmEditPO" id="frmEditPO" onkeydown="return event.key != 'Enter';">

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label >เลขที่ใบสั่งซื้อ</label>
                            <input type="text" class="form-control" name="editpocode" id="editpocode" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>รหัสผู้ขาย</label>

                            <input type="text" class="form-control" name="editsupcode" id="editsupcode" disabled>

                        </div>
                        <div class="form-group col-md-6">
                            <label >ชื่อผู้ขาย</label>
                            <input type="text" class="form-control" name="edittdname" id="edittdname" disabled>
                        </div>

                    </div>

                    <div class="form-group col-md-12">
                        <label >ที่อยู่ผู้ขาย</label>
                        <input type="text" class="form-control" size="4" name="editaddress" id="editaddress" disabled>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label >วันที่สั่งซื้อ</label>
                            <input type="date" class="form-control" size="4" name="editpodate" id="editpodate">
                        </div>
                        <div class="form-group col-md-4">
                            <label >วันที่นัดส่งของ</label>
                            <input type="date" class="form-control" name="editdeldate" id="editdeldate">
                        </div>

                        <div class="form-group col-md-4">
                            <label>การชำระเงิน</label>
                            <select class="form-control" name="editpayment" id="editpayment">
                                <option value="เงินสด" selected>เงินสด</option>
                                <option value="30 วัน">30 วัน</option>
                                <option value="45 วัน">45 วัน</option>
                                <option value="60 วัน">60 วัน</option>
                                <option value="90 วัน">90 วัน</option>
                                <option value="120 วัน">120 วัน</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label >ใบเสนอราคา</label>
                            <input type="text" class="form-control" name="editpoqua" id="editpoqua">
                        </div>

                        <div class="form-group col-md-4">
                            <label >สกุลเงิน</label>
                            <select class="form-control" name="editcurrency" id="editcurrency">
                                <option value="บาท" selected>บาท</option>
                                <option value="ดอลล่า">ดอลล่า</option>
                                <option value="เยน">เยน</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label >ภาษี </label>
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="editvat" value="Y" checked> มี
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="editvat" value="N"> ไม่มี
                                </label>
                            </div>
                        </div>

                    </div>

                    <table name="tableEditPoDetail" id="tableEditPoDetail" class="table table-bordered table-striped">
                        <thead style="background-color:#D6EAF8;">
                            <tr>
                                <th>ลำดับ</th>
                                <th>รหัสสินค้า</th>
                                <th>รายการสินค้า</th>
                                <th>จำนวน</th>
                                <th>หน่วย</th>
                                <th>ราคาขาย</th>
                                <th>ส่วนลด</th>
                                <th>จำนวนเงิน (บาท)</th>
                                <th></th>
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