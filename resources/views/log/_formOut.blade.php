
<form action="/log/out/create" method="POST">

	<div class="box-body">

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

		<div class="form-group{{ $errors->has('batch') ? ' has-error' : '' }}">
			<label for="batch">Batch</label>
			<select id="batch" name="batch" class="form-control">
				<option value="">Select Item</option>
				@foreach($items as $key => $item)
				<option value="{{ $key }}" {{  old('item_batch_id') != NULL ? (old('item_batch_id') == $key ? 'selected' : '' ) : (isset($item)? ($item->id == $key ? 'selected' : '') :'')   }}>{{ $item->item_batch_id }}</option>                      
				@endforeach
			</select>
			@if($errors->has('batch'))
			<p class="text-danger">{{ $errors->first('batch') }}</p>
			@endif
		</div>

	</div>
	<div class="box-footer">
		<button style="margin-left: 10px" type="submit" class="btn btn-primary pull-right">Save & Add</button>
		<button type="submit" class="btn btn-primary pull-right">Save</button>
	</div>