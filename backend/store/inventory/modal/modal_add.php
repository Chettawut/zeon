<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">Add Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmAddStock" id="frmAddStock" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">ProductCode</label>
                            <input type="text" class="form-control" name="add_stcode" id="add_stcode" minlength="6"
                                maxlength="9" required>
                        </div>
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">Unit</label>
                            <select class="form-control" name="add_unit" id="add_unit">
                                <?php 
                                            
                                        	$sql = "SELECT * FROM `unit` where status = 'Y' ";
                                            $query = mysqli_query($conn,$sql);
                                        
                                            while($row = $query->fetch_assoc()) {
                                                echo '<option value="'.$row["unit"].'">'.$row["unit"].'</option>';
                                            }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label class="col-form-label">ProductName</label>
                            <input type="text" class="form-control" name="add_stname1" id="add_stname1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">Min ขั้นต่ำ</label>
                            <input type="number" class="form-control" name="add_stmin1" id="add_stmin1" >
                        </div>
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">Min ขีดแดง</label>
                            <input type="number" class="form-control" name="add_stmin2" id="add_stmin2" >
                        </div>
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">Max</label>
                            <input type="number" class="form-control" name="add_stmax" id="add_stmax" >
                        </div>
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">ProductType</label>
                            <select class="form-control" name="add_type" id="add_type">
                                <option value="FG">Finish Goods</option>
                                <option value="SFG">Semi Finish Goods</option>
                                <option value="MAT">Material</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddSo" form="frmAddStock" class="btn btn-primary">Add</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>