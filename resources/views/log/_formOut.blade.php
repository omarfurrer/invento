
<form action="/log/out/create" method="POST">

	<div class="box-body">

		<div class="form-group required{{ $errors->has('item_id') ? ' has-error' : '' }}">
                    <label for="item" class="control-label">Item</label>
			<select id="item" name="item_id" class="form-control">
				<option value="">Select Item</option>
				@foreach($items as $id => $description)
				<option value="{{ $id }}" {{  old('item_id') != NULL ? (old('item_id') == $id ? 'selected' : '' ) : (isset($item)? ($item->id == $id ? 'selected' : '') :'')   }}>{{ $description }}</option>                      
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

		<div class="form-group{{ $errors->has('batch') ? ' has-error' : '' }}">
			<label for="batch">Batch</label>
			<select id="batch" name="batch" class="form-control">
				<option value="">Select Batch</option>
				
			</select>
			@if($errors->has('batch'))
			<p class="text-danger">{{ $errors->first('batch') }}</p>
			@endif
		</div>

	</div>
	<div class="box-footer">
		<!--<button style="margin-left: 10px" type="submit" class="btn btn-primary pull-right">Save & Add</button>-->
		<button type="submit" class="btn btn-primary pull-right">Save</button>
	</div>
</form>