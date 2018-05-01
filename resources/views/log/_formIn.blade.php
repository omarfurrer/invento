
<form action="/log/in/create" method="POST">

    <div class="box-body">

        {{ csrf_field() }}

        @if(isset($log))
        {{ method_field('PATCH') }}
        @endif

        <div class="form-group{{ $errors->has('item') ? ' has-error' : '' }}">
            <label for="item">Item</label>
            <select id="item" name="item" class="form-control">
                <option value="">Select Item</option>
                @foreach($items as $key => $item)
                <option value="{{ $key }}" {{  old('item_id') != NULL ? (old('item_id') == $key ? 'selected' : '' ) : (isset($item)? ($item->id == $key ? 'selected' : '') :'')   }}>{{ $item->description }}</option>                      
                @endforeach
            </select>
            @if($errors->has('item'))
            <p class="text-danger">{{ $errors->first('item') }}</p>
            @endif
        </div>


        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
            <label for="quantity">Quantity</label>
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


        <div class="form-group{{ $errors->has('expiry_date') ? ' has-error' : '' }}">
         <label for="expiryDate">Expiry date</label>
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
    <button style="margin-left: 10px" type="submit" class="btn btn-primary pull-right">Save & Add</button>
    <button type="submit" class="btn btn-primary pull-right">Save</button>
</div>