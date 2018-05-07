
<form action="/log/out/create" method="POST">

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

		<div class="form-group{{ $errors->has('item_batch_id') ? ' has-error' : '' }}">
			<label for="batch">Batch</label>
			<select id="batch" name="item_batch_id" class="form-control">
				<option value="">Select Batch</option>
				
			</select>
			@if($errors->has('item_batch_id'))
			<p class="text-danger">{{ $errors->first('item_batch_id') }}</p>
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


		var currentItemId = $("#item").val();

		searchAndPopulateBatch(currentItemId);

		

		$("#item").change(function() {

			var selectedItemId = $(this).val();
			searchAndPopulateBatch(selectedItemId);


		});

		function searchAndPopulateBatch (id) {

			if (id != '') {
                
                $.ajax ({

				type: 'GET',
				url: '/api/items/'+id+'/batches',
				success: function(data) {


					var itemBatches = data.itemBatches;

					$('#batch').empty();

					for(i=0; i < itemBatches.length; i++) {

						var currentDate = itemBatches[i].expiry_date;
						var formatedCurrentDate = moment(currentDate).format('DD/MM/YYYY');
						var currentQuanrity = itemBatches[i].current_quantity;


						$('#batch').append('<option value="'+itemBatches[i].id+'">'+currentQuanrity+' Remaining - '+ 
							((currentDate==null)? '(Does not expire' :'Expires at: ('+formatedCurrentDate)+

							')</option>');


					}
                                         var oldSelectedItemBatchID = {!! json_encode(old('item_batch_id',null)) !!};
                if (oldSelectedItemBatchID != null) {
                    $('option[value="'+oldSelectedItemBatchID+'"]').prop('selected',true);
                }

				} 
               
               });

			}

		}
	});


</script>

@endpush