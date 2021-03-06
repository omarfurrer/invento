
<form action="/log/in/create" method="POST">

    <div class="box-body">

        {{ csrf_field() }}

        @if(isset($log))
        {{ method_field('PATCH') }}
        @endif

        <div class="form-group required{{ $errors->has('item_id') ? ' has-error' : '' }}">
            <label for="item" class="control-label">Item</label>
            <select id="item" name="item_id" class="form-control">
                <option value="">Select Item</option>
                @foreach($items as $item)
                <option value="{{ $item->id }}"{{ old('item_id') != NULL ? (old('item_id') == $item->id ? 'selected' : '' ) : (isset($log)? ($item->id == $log->item->id ? 'selected' : '') :'')  }}>{{ $item->description }}</option>                      
                @endforeach

            </select>
            @if($errors->has('item_id'))
            <p class="text-danger">{{ $errors->first('item_id') }}</p>
            @endif
        </div>


        <div class="form-group required{{ $errors->has('quantity') ? ' has-error' : '' }}">
            <label for="quantity" class="control-label">Quantity</label>
            <input 
            step="0.01" 
            type="number" 
            class="form-control" 
            name="quantity" 
            id="quantity" 
            placeholder="Enter quantity added" 
            value="{{ old('quantity',isset($log)? $log->quantity : '') }}">

            @if($errors->has('quantity'))
            <p class="text-danger">{{ $errors->first('quantity') }}</p>
            @endif
        </div>


        <div class="form-group required{{ $errors->has('expiry_date') ? ' has-error' : '' }}" id="expiryDate_input">
            <label for="expiryDate" class="control-label">Expiry date</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text"
                class="form-control pull-right date-picker" 
                name="expiry_date" 
                value="{{ old('expiry_date',isset($item)? ( $item->expiry_date != null ? $item->expiry_date->format('d-m-Y'): '' ) : '') }}" placeholder="Select expiry date" id="expiryDate">
            </div>
            @if($errors->has('expiry_date'))
            <p class="text-danger">{{ $errors->first('expiry_date') }}</p>
            @endif
        </div>


        <div class="form-group{{ $errors->has('unit_price') ? ' has-error' : '' }}">
            <label for="unitPrice">Price / Unit</label> 
            <input type="number" step="0.01" class="form-control" name="unit_price" id="unitPrice" placeholder="Enter Price / Unit" value="{{ old('unit_price',isset($item)? $item->unit_price : '') }}">
            @if($errors->has('unit_price'))
            <p class="text-danger">{{ $errors->first('unit_price') }}</p>
            @endif
        </div>

    </div>

    <div class="box-footer">
        <!--<button style="margin-left: 10px" type="submit" class="btn btn-primary pull-right">Save & Add</button>-->
        <button type="submit" class="btn btn-primary pull-right">Save</button>
    </div>
</form>







@push('scripts')

<script>

$(document).ready(function() {

    $('#expiryDate_input').hide();

        var allItems = {!! json_encode($items->toArray()) !!};
        var arrayItemId = $('#item').val();
        search(arrayItemId);
    
    $("#item").change(function() {

        var currentItemId = $(this).val();
        if (currentItemId == '') {
            $('#expiryDate_input').hide();
        }
        search(currentItemId);
        
    });



     function showHide(item) {
        if(item.expires) {

           $('#expiryDate_input').show();
        }   
        else {
           $('#expiryDate_input').hide();

        }
    }

    function search(id) {

        for (i=0; i < allItems.length; i++)   {
            var arrayItemId = allItems[i].id;
            if (id == arrayItemId){
                showHide( allItems[i]);
            }         
        }
    }

});

</script>

@endpush