<!--LOG IN CREATE MODAL-->
<div class="modal fade" id="modal-log-in-create" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add</h4>
                </div>
                <form action="/ajax/log/in/create" method="POST">
                    <div class="modal-body">
                       
                        {{ csrf_field() }}

                        <div class="form-group required">
                            <label for="item" class="control-label">Item</label>
                            <select id="item" name="item_id" class="form-control" required>
                            </select>
                        </div>

             <div class="form-group required">
             <label for="quantity" class="control-label">Quantity <b id="measurementUnit"></b></label>
                            <input 
                            step="0.01" 
                            type="number" 
                            class="form-control" 
                            name="quantity" 
                            id="quantity" 
                            placeholder="Enter quantity added" 
                            required
                            >
                        </div>

                        <div class="form-group required" id="expiryDate_input">
                            <label for="expiryDate" class="control-label">Expiry date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text"
                                class="form-control pull-right date-picker" 
                                name="expiry_date" 
                                placeholder="Select expiry date" 
                                id="expiryDate"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unitPrice">Price / Unit</label> 
                            <input 
                            type="number"
                            step="0.01"
                            class="form-control"
                            name="unit_price"
                            id="unitPrice"
                            placeholder="Enter Price / Unit"
                            >
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    <!-- Log out create modal -->
    <div class="modal fade" id="modal-log-out-create" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Remove</h4>
                    </div>
                    <form action="/ajax/log/out/create" method="POST">
                        <div class="modal-body">

                            <div class="form-group required">
                                <label for="item" class="control-label">Item</label>
                                <select id="item" name="item_id" class="form-control" required>
                                </select>
                            </div> 


                            <div class="form-group required">
                                <label for="quantity" class="control-label">Quantity <b id="measurementUnit"></b></label>
                                <input 
                                step="0.01" 
                                type="number" 
                                class="form-control" 
                                name="quantity" 
                                id="quantity" 
                                placeholder="Enter quantity added" 
                                required 
                                >
                            </div>

                            <div class="form-group required">
                                <label for="batch">Batch</label>
                                <select id="batch" name="item_batch_id" class="form-control" required>
                                    <option value="">Select Batch</option>
                                </select>

                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
