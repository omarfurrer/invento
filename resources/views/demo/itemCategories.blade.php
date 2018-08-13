@extends('layouts.main')

@section('title', 'Items & Categories')

@section('content')

<section class="content container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">

				<!-- BOX HEADER -->

				<div class="box-header">
					<h5 class="box-title">Showing: <b>5 Items</b></h5>

					<div class="box-tools">
						<div class="input-group input-group-sm searchInput">
							<input type="text" name="table_search" class="form-control pull-right" placeholder="Search" id="search" onkeyup="search()">

							<div class="input-group-btn">
								<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>

				<!-- End of BOX HEADER -->

				<!--  BOX BODY -->

				<div class="box-body table-responsive no-padding">
					<table class="table table-hover" id="itemsTbl">

						<tbody>

							<tr id="tHeaderRow">
								<th>Image</th>
								<th>Item</th>
								<th>Quantity</th>
								<th>Remainig Uses</th>
								<th>Withdraw <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="You can choose to withdraw by a single use or by setting a custom amount of uses you want to withdraw"></i></th>

							</tr>

							<tr class="categoryRow">
								<td id="categoryTd" colspan="5">
									<button class="btn rowToggleBtn" data-toggle="collapse" data-target=".collapseMe" aria-controls="collapseMe" aria-expanded="false">ORTHO
										<a><i class="fa fa-chevron-down pull-right"></i><i class="fa fa-chevron-up pull-right"></i></a>
									</button>

								</td>
							</tr>

							

							<tr class="collapseMe collapse">
								<td><img class="categoryTdImg" src="http://nvnto.com/storage/images/items/0tmiP4WOc2GmbiKkfBKXjvxkLD9rLSymMVUfwLIG.jpeg"></td>
								<td>Temporary Cement</td>
								<td class="stockQuantity">3</td>
								<td data-maxNumber="30" class="remaining">20</td>
								<td>
									<ul class="list-inline">
										<li class="list-inline-item"><button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

										<li class="list-inline-item">
											<button class="btn btn-sm btn-default inputBtn"><i class="fa fa-pencil"></i></button>
										</li>
										<li class="list-inline-item"><input placeholder="Set Amount" min="1" class="customInput collapseX form-control" type="number"></li>

										<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
									</ul>
								</td>
							</tr>

							<tr class="collapseMe collapse panel-collapse">
								<td><img class="categoryTdImg" src="http://nvnto.com/storage/images/items/3cfK9jswTwO0Ge6HRkMmcx11qq8Z4vpCPYdj1h3C.jpeg"></td>
								<td>Suction</td>
								<td class="stockQuantity">5</td>
								<td data-maxNumber="30" class="remaining">10</td>
								<td>

									<ul class="list-inline">
										<li class="list-inline-item"><button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

										<li class="list-inline-item">
											<button class="btn btn-sm btn-default inputBtn"><i class="fa fa-pencil"></i></button>
										</li>
										<li class="list-inline-item"><input placeholder="Set Amount" value="" min="1" class="customInput collapseX form-control" type="number"></li>

										<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
									</ul>

								</td>
							</tr>

							<tr class="collapseMe collapse">
								<td><img class="categoryTdImg" src="//cdn.shopify.com/s/files/1/0205/1890/products/tofflemire-matrix-band_large.jpg?v=1363037387"></td>
								<td>Matrix Band Small</td>
								<td class="stockQuantity">4</td>
								<td data-maxNumber="30" class="remaining">9</td>
								<td>

									<ul class="list-inline">
										<li class="list-inline-item"><button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

										<li class="list-inline-item">
											<button class="btn btn-sm btn-default inputBtn"><i class="fa fa-pencil"></i></button>
										</li>
										<li class="list-inline-item"><input placeholder="Set Amount" min="1" class="customInput  collapseX form-control" type="number" ></li>

										<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
									</ul>

								</td>
							</tr>

							<tr class="collapseMe collapse">
								<td><img class="categoryTdImg" src="https://images.yaoota.com/9Px17k_9nY6oADLdcRfVM-kmMHQ=/trim/yaootaweb-production/media/crawledproductimages/eaf198e6051451b3cab781954783587f97452a9c.jpg"></td>
								<td>Hexitol</td>
								<td class="stockQuantity">6</td>
								<td data-maxNumber="30" class="remaining">13</td>
								<td>

									<ul class="list-inline">
										<li class="list-inline-item">
											<button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

											<li class="list-inline-item">
												<button class="btn btn-sm btn-default inputBtn">
													<i class="fa fa-pencil"></i>
												</button>
											</li>

											<li class="list-inline-item">
												<input placeholder="Set Amount" class="customInput form-control collapseX" type="number" min="1">
											</li>

											<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
										</ul>

									</td>
								</tr>
								<tr class="categoryRow">
									<td id="categoryTd" colspan="5">
										<button class="btn rowToggleBtn" data-toggle="collapse" data-target=".collapseMe1" aria-controls="collapseMe1" aria-expanded="false">PEDO
											<a><i class="fa fa-chevron-down pull-right"></i><i class="fa fa-chevron-up pull-right"></i></a>
										</button>

									</td>
								</tr>



								<tr class="collapseMe1 collapse">
									<td><img class="categoryTdImg" src="http://nvnto.com/storage/images/items/h0R1a1bcpNy30fU19IYtkIzQytBT2r5K1TNJIwnM.jpeg"></td>
									<td>Syrnge Long</td>
									<td class="stockQuantity">3</td>
									<td data-maxNumber="30" class="remaining">20</td>
									<td>
										<ul class="list-inline">
											<li class="list-inline-item"><button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

											<li class="list-inline-item">
												<button class="btn btn-sm btn-default inputBtn"><i class="fa fa-pencil"></i></button>
											</li>
											<li class="list-inline-item"><input placeholder="Set Amount" min="1" class="customInput collapseX form-control" type="number"></li>

											<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
										</ul>
									</td>
								</tr>

								<tr class="collapseMe1 collapse panel-collapse">
									<td><img class="categoryTdImg" src="http://nvnto.com/storage/images/items/O82hLRxG2TME7QBrgmhM0k8Gjly3cVvQQcq3ewHM.jpeg"></td>
									<td>Light(Green)</td>
									<td class="stockQuantity">5</td>
									<td data-maxNumber="30" class="remaining">10</td>
									<td>

										<ul class="list-inline">
											<li class="list-inline-item"><button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

											<li class="list-inline-item">
												<button class="btn btn-sm btn-default inputBtn"><i class="fa fa-pencil"></i></button>
											</li>
											<li class="list-inline-item"><input placeholder="Set Amount" value="" min="1" class="customInput collapseX form-control" type="number"></li>

											<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
										</ul>

									</td>
								</tr>

								<tr class="collapseMe1 collapse">
									<td><img class="categoryTdImg" src="http://nvnto.com/storage/images/items/296nhptNSQWv7Y5raGygzQmcOPq3JvomOpEERXLh.jpeg"></td>
									<td>Gloves Medium</td>
									<td class="stockQuantity">4</td>
									<td data-maxNumber="30" class="remaining">9</td>
									<td>

										<ul class="list-inline">
											<li class="list-inline-item"><button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

											<li class="list-inline-item">
												<button class="btn btn-sm btn-default inputBtn"><i class="fa fa-pencil"></i></button>
											</li>
											<li class="list-inline-item"><input placeholder="Set Amount" min="1" class="customInput  collapseX form-control" type="number" ></li>

											<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
										</ul>

									</td>
								</tr>

								<tr class="collapseMe1 collapse">
									<td><img class="categoryTdImg" src="http://nvnto.com/storage/images/items/VuU8sHsdXgVjr357x4ktoiEt0C6JNSDZ8KvIPnEl.jpeg"></td>
									<td>Mask</td>
									<td class="stockQuantity">6</td>
									<td data-maxNumber="30" class="remaining">13</td>
									<td>

										<ul class="list-inline">
											<li class="list-inline-item">
												<button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

												<li class="list-inline-item">
													<button class="btn btn-sm btn-default inputBtn">
														<i class="fa fa-pencil"></i>
													</button>
												</li>

												<li class="list-inline-item">
													<input placeholder="Set Amount" class="customInput form-control collapseX" type="number" min="1">
												</li>

												<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
											</ul>

										</td>
									</tr>





								</tbody>

							</table>


						</div>
						<!-- /.box-body -->


					</div>
				</div>
			</div> 

		</section>

		@endsection

		@push('scripts')

		<script>

			function search() {

				var input, filter, table, tr, td, i;
				input = document.getElementById("search");
				filter = input.value.toUpperCase();
				table = document.getElementById("itemsTbl");
				tr = table.getElementsByTagName("tr");

				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[1];
					if (td) {
						if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						} else {
							tr[i].style.display = "none";
						}
					}
				}
			}




			$(document).ready(function () {
				$('[data-toggle="tooltip"]').tooltip();
				$(".collapseX").hide();
				$(".fa-chevron-up").hide();

			});

			$(".rowToggleBtn").click(function(){
				var $tr = $(this).closest('tr'); 
				$tr.find(".fa-chevron-up").toggle();
                $tr.find(".fa-chevron-down").toggle(); 
			});


			$(".minusOneBtn").click(function() {
  //Declare Variables
  var $tr = $(this).closest('tr'); 
  var $remaining = $tr.find(".remaining");
  var $qty = $tr.find(".stockQuantity");

  //Get current values
  var batchSize = +$remaining.attr("data-maxNumber");
  var currentRemaining = +$remaining.text();
  var currentQty = +$qty.text();

  //Subtract values
  if (currentRemaining <= 1 && currentQty >= 1) {
  	currentRemaining = batchSize;
  	currentQty = currentQty-1;
  } else if (currentRemaining > 0) {
  	currentRemaining = currentRemaining-1;
  } else if (currentRemaining == 0 && currentQty == 0) {
  	alert('No units in stock')
  }

  //Update text
  $remaining.text(currentRemaining);
  $qty.text(currentQty);
});



			$(".submitNum").click(function() {

				var $tr = $(this).closest('tr'); 
				var $remaining = $tr.find(".remaining");
				var $qty = $tr.find(".stockQuantity");
				var $numToSubmit = $tr.find(".customInput");

  //Get current values
  var batchSize = $remaining.attr("data-maxNumber");
  var currentRemaining = $remaining.text();
  var currentQty = $qty.text();
  var currentInputValue = $numToSubmit.val(); 
  //Subtract values

  var totalLeft = Number(currentRemaining) + Number(batchSize) * Number(currentQty);

  if (currentInputValue > totalLeft) {
  // invalid
} else {
  // calculate how many to take from remaining
  var wr = currentInputValue % batchSize;
  // update qty and remaining
  currentQty -= (currentInputValue - wr) / batchSize;
  currentRemaining -= wr;
  if (currentRemaining < 0) {
  	currentRemaining += Number(batchSize);
  	currentQty -= 1;
  } 
}  
  //Update text
  $remaining.text(currentRemaining);
  $qty.text(currentQty);

  $tr.find(".collapseX").hide(); 
  $tr.find(".inputBtn").show();
  $tr.find('.customInput').val('');

});

			$('.customInput').keydown(function(e){
    if (e.keyCode === 13) { // If Enter key pressed
    	$('.submitNum').click();
    }
});









			$(".inputBtn").click(function() {
				var $tr = $(this).closest('tr');  
				$tr.find(".inputBtn").hide();
				$tr.find(".collapseX").show(); 		

			});



			$(".fa-close").click(function() {
				var $tr = $(this).closest('tr');  
				$tr.find(".inputBtn").show();
				$tr.find(".collapseX").hide();
				$tr.find('.customInput').val('');

			});

		</script>

		@endpush