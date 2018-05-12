<form action="{{ isset($item)? '/items/'.$item->id : '/items' }}" method="POST" enctype="multipart/form-data">

    <div class="box-body">

        {{ csrf_field() }}

        @if(isset($item))
        {{ method_field('PATCH') }}
        @endif

        <div class="row">

          <div class="col-md-8">

            <div class="form-group required{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="control-label">Description</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Enter item's description" value="{{ old('description',isset($item)? $item->description : '') }}" required>
                @if($errors->has('description'))
                <p class="text-danger">{{ $errors->first('description') }}</p>
                @endif
            </div>

            <div class="form-group required{{ $errors->has('unit_id') ? ' has-error' : '' }}">
                <label for="unit_id" class="control-label">Unit</label>
                <select id="unit_id" name="unit_id" class="form-control" required>
                    <option value="">Select Unit</option>
                    @foreach($measurementUnits as $key => $name)
                    <option value="{{ $key }}" {{  old('unit_id') != NULL ? (old('unit_id') == $key ? 'selected' : '' ) : (isset($item)? ($item->measurementUnit->id == $key ? 'selected' : '') :'')   }}>{{ $name }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit_id'))
                <p class="text-danger">{{ $errors->first('unit_id') }}</p>
                @endif
            </div>

            <div class="form-group required{{ $errors->has('expires') ? ' has-error' : '' }}">
                <label class="control-label" for="expires">Expires:</label>
                <select id="expires" name="expires" class="form-control">
                    <option value="0" {{  old('expires') != NULL ? (old('expires') == 0 ? 'selected' : '' ) : (isset($item)? ($item->expires == 0 ? 'selected' : '') :'')   }}>No</option>
                    <option value="1" {{  old('expires') != NULL ? (old('expires') == 1 ? 'selected' : '' ) : (isset($item)? ($item->expires == 1 ? 'selected' : '') :'')   }}>Yes</option>
                </select>
                @if($errors->has('expires'))
                <p class="text-danger">{{ $errors->first('expires') }}</p>
                @endif
            </div>

        </div>

        <div class="col-md-4">

           <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}" id="formImgDiv">

            <img {{(isset($item)? ($item->image_path == null ? "src=http://via.placeholder.com/150x150" :                  'src="$item->image_path"') : "src=http://via.placeholder.com/150x150")}}                
            class="img-thumbnail"
            alt="Item's image"
            id="formImg"
            width="150px"
            height="150px">
            <input type="file" id="formImgInput" accept="image/x-png,image/jpg,image/jpeg" name="name">
            @if($errors->has('image'))
            <p class="text-danger">{{ $errors->first('image') }}</p>
            @endif
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">

        <div class="form-group{{ $errors->has('minimum_quantity') ? ' has-error' : '' }}">
            <label for="minimum_quantity">Minimum Quantity</label>
            <input type="number" class="form-control" name="minimum_quantity" id="minimum_quantity" placeholder="Enter minimum quantity" value="{{ old('minimum_quantity',isset($item)? $item->minimum_quantity : '') }}">
            @if($errors->has('minimum_quantity'))
            <p class="text-danger">{{ $errors->first('minimum_quantity') }}</p>
            @endif
        </div>


    </div>

    <div class="col-md-6">


        <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : '' }}">
            <label for="supplier_id">Supplier</label>
            <select id="supplier_id" name="supplier_id" class="form-control">
                <option value="">Select Supplier</option>
                @foreach($suppliers as $key => $name)
                <option value="{{ $key }}" {{  old('supplier_id') != NULL ? (old('supplier_id') == $key ? 'selected' : '' ) : ( isset($item) ? $item->supplier != null ? ($item->supplier->id == $key ? 'selected' : '') : '' :'' )   }}>{{ $name }}</option>
                @endforeach
            </select>
            @if($errors->has('supplier_id'))
            <p class="text-danger">{{ $errors->first('supplier_id') }}</p>
            @endif
        </div>


    </div>

</div>




<h3><small><b>Initial Batches<b></small></h3>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div 
            class="form-group{{ $errors->has('item_batches.0.quantity') ? ' has-error' : '' }} required">
            <label for="quantity" class="control-label">Quantity</label>
            <input type="number"
            required 
            class="form-control"
            id="quantity" 
            name="item_batches[0][quantity]"
            id="item_batches_quantity"
            placeholder="Enter quantity"
            value="{{ old('item_batches.0.quantity',isset($item)? $item->itemBatches[0]['quantity'] : '') }}"
            {{ isset($item) ? $item->is_initially_approved ? ' readonly' : '' : '' }}>
            @if($errors->has('item_batches.0.quantity'))
            <p class="text-danger">{{ $errors->first('item_batches.0.quantity') }}</p>
            @endif
        </div>
    </div>


    <div class="col-md-4">

        <div class="form-group{{ $errors->has('item_batches.0.expiry_date') ? ' has-error' : '' }}">
         <label for="expiryDate" class="control-label">Expiry Date</label>
         <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input id="expiryDate" type="text" class="form-control pull-right date-picker" name="item_batches[0][expiry_date]" value="{{ old('item_batches.0.expiry_date',isset($item)? ( $item->itemBatches[0]->expiry_date != null ? $item->itemBatches[0]->expiry_date->format('d-m-Y'): '' ) : '') }}" placeholder="Select expiry date">
        </div>
        @if($errors->has('item_batches.0.expiry_date'))
        <p class="text-danger">{{ $errors->first('item_batches.0.expiry_date') }}</p>
        @endif
    </div>

</div>

<div class="col-md-4">

    <div class="form-group{{ $errors->has('item_batches.0.unit_price') ? ' has-error' : '' }}">
     <label for="item_batches_unitPrice" class="control-label">Price / Unit</label>
     <input  type="number" step="0.01" class="form-control" name="item_batches[0][unit_price]" id="item_batches_unitPrice" placeholder="Enter Price / Unit" value="{{ old('item_batches.0.unit_price',isset($item)? $item->itemBatches[0]['unit_price'] : '') }}">
     @if($errors->has('item_batches.0.unit_price'))
     <p class="text-danger">{{ $errors->first('item_batches.0.unit_price') }}</p>
     @endif
 </div>


</div>
@if(isset($item))
<input type="hidden" name="item_batches[0][id]" value="{{ $item->itemBatches[0]['id'] }}">
@endif

</div>
                        <!--                        <hr>
                            <button type="submit" class="btn btn-primary pull-right">Add new batch </button>-->

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </form>

                    @push('scripts')
                    <script>
                        $(document).ready(function(){

                            var expiresVal = $('#expires').val();


                            showAndHideExpiryDate(expiresVal);
                            


                            $("#expires").change(function() {

                                var currentVal = $(this).val();

                                showAndHideExpiryDate(currentVal);

                            });

                            function showAndHideExpiryDate (val) {

                               if(val == 1) {

                                 $('#expiryDate').closest('div[class^="col-md-4"]').show();

                             } else {

                              $('#expiryDate').closest('div[class^="col-md-4"]').hide();
                          }



                      }

                  });
                        function readURL(input) {

                          if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                              $('#formImg').attr('src', e.target.result);
                          }

                          reader.readAsDataURL(input.files[0]);
                      }
                  }

                  $("#formImgInput").change(function() {
                      readURL(this);
                  });

            </script>
            @endpush
