<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">เพิ่มใบสั่งขาย</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmAddSO" id="frmAddSO" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-2">
                            <label class="col-form-label">เลขที่ใบสั่งขาย</label>
                            <input type="text" class="form-control" name="socode" id="socode" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">รหัสลูกค้า</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="cuscode" id="cuscode" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" data-toggle="modal" data-target="#modal_customer"
                                        type="button"><span class="fa fa-search"></span></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">ชื่อลูกค้า</label>
                            <input type="text" class="form-control" name="tdname" id="tdname" disabled>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <label class="col-form-label">เบอร์ลูกค้า</label>
                            <input type="text" class="form-control" size="4" name="tel" id="tel" disabled>
                        </div>
                        <div class="col-md-9">
                            <label class="col-form-label">ที่อยู่ลูกค้า</label>
                            <input type="text" class="form-control" size="4" name="address" id="address" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3">
                            <label class="col-form-label">วันที่สั่งขาย</label>
                            <input type="date" class="form-control" size="4" name="sodate" id="sodate">
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">วันที่นัดส่งของ</label>
                            <input type="date" class="form-control" name="deldate" id="deldate">
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">วันที่กำหนดชำระเงินงวดที่
                                1</label>
                            <input type="date" class="form-control" name="paydate" id="paydate">
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">วันที่กำหนดชำระเงินงวดที่
                                2</label>
                            <input type="date" class="form-control" name="paydate2" id="paydate2">
                        </div>



                    </div>

                    <div class="form-row">

                        <div class="col-md-3">
                            <label class="col-form-label">การชำระเงิน</label>
                            <select class="form-control" name="payment" id="payment">
                                <option value="เงินสด" selected>เงินสด</option>
                                <option value="เครดิต">เครดิต</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="col-form-label">สกุลเงิน</label>
                            <select class="form-control" name="currency" id="currency">
                                <option value="บาท" selected>บาท</option>
                                <option value="ดอลล่า">ดอลล่า</option>
                                <option value="เยน">เยน</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="col-form-label">ภาษี </label>
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="vat" value="Y" required> มี
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="vat" value="N"> ไม่มี
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="comment">หมายเหตุ:</label>
                            <textarea class="form-control" rows="2" name="remark" id="remark"></textarea>
                        </div>                        




                    </div>


                    <br>
                    <div class="form-group col-md-12">
                        <button type="button" id="btnAddSOdetail" class="btn btn-success" data-toggle="modal"
                            data-target="#modal_stock"><i class="fa fa fa-tags" aria-hidden="true"></i>
                            เพิ่มรายการ</button>

                        <!-- <button type="button" id="btnAddSOGiveaway" class="btn btn-info" data-toggle="modal"
                            data-target="#modal_giveaway"><i class="fa fa fa-gift" aria-hidden="true"></i>
                            เพิ่มของแถม</button> -->

                    </div>


                    <table name="tableSODetail" id="tableSODetail" class="table table-bordered table-striped">
                        <thead style="background-color:#D6EAF8;">
                            <tr>
                                <th style="width:5%;text-align:center">ลำดับ</th>
                                <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                <th style="width:25%;text-align:center">รายการสินค้า</th>
                                <th style="width:10%;text-align:center">จำนวน</th>
                                <th style="width:15%;text-align:center">หน่วย</th>
                                <th style="width:10%;text-align:center">ราคาขาย</th>
                                <th style="width:10%;text-align:center">ส่วนลด</th>
                                <th style="width:10%;text-align:center">จำนวนเงิน</th>
                                <th style="width:5%;text-align:center"></th>

                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" form="frmAddSO" class="btn btn-primary">ยืนยัน</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>