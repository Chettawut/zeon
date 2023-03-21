<div class="modal fade bd-example-modal-xl" id="modal_add" tabindex="-1" role="dialog" aria-labelledby=""
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title"><i class="fa fa-users" aria-hidden="true"></i> เพิ่มผู้ใช้งาน</h5>
            </div>
            <form name="frmAddUser" id="frmAddUser" action="" method="post">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="col-form-label">Username</label>
                            <input type="text" class="form-control" name="userusername" id="userusername" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" name="userpassword" id="userpassword" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">

                            <label class="col-form-label">ชื่อจริง</label>
                            <input type="text" class="form-control" name="userfirstname" id="userfirstname" required>
                        </div>

                        <div class="col-md-6">
                            <label class="col-form-label">นามสกุล</label>
                            <input type="text" class="form-control" name="userlastname" id="userlastname" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="col-form-label">ประเภท</label>
                            <select class="form-control" name="usertype" id="usertype">
                                <option value="ฝ่ายขาย">ฝ่ายขาย</option>
                                <option value="คนจัดเก็บข้อมูล">คนจัดเก็บข้อมูล</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="usertel" id="usertel">
                        </div>

                    </div>


                    <div class="form-row">
                        <div class="col-md-12">
                            <label class="col-form-label">Email</label>
                            <input type="email" class="form-control" name="useremail" id="useremail">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>

        </div>
    </div>
</div>