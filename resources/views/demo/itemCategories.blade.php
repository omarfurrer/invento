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
									<button class="btn" data-toggle="collapse" data-target=".multi-collapse" >ORTHO
										<a><i class="fa fa-chevron-down pull-right"></i></a>
									</button>
									
								</td>
							</tr>

							<tr class="collapse multi-collapse">
								<td><img src="https://placeholdit.co//i/50x50?"></td>
								<td>Temporary Cement</td>
								<td class="stockQuantity">3</td>
								<td data-maxNumber="30" class="remaining">20</td>
								<td>
									<ul class="list-inline">
										<li class="list-inline-item"><button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

										<li class="list-inline-item">
											<button class="btn btn-sm btn-default inputBtn"><i class="fa fa-pencil"></i></button>
										</li>
										<li class="list-inline-item"><input placeholder="Set Amount" class="customInput collapseX" type="number"></li>

										<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
									</ul>
								</td>
							</tr>

							<tr class="collapse multi-collapse">
								<td><img src="https://placeholdit.co//i/50x50?"></td>
								<td>Suction</td>
								<td class="stockQuantity">5</td>
								<td data-maxNumber="30" class="remaining">10</td>
								<td>

									<ul class="list-inline">
										<li class="list-inline-item"><button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

										<li class="list-inline-item">
											<button class="btn btn-sm btn-default inputBtn"><i class="fa fa-pencil"></i></button>
										</li>
										<li class="list-inline-item"><input placeholder="Set Amount" value="" class="customInput collapseX" type="number"></li>

										<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
									</ul>

								</td>
							</tr>

							<tr class="collapse multi-collapse">
								<td><img src="https://placeholdit.co//i/50x50?"></td>
								<td>Matrix Band Small</td>
								<td class="stockQuantity">4</td>
								<td data-maxNumber="30" class="remaining">9</td>
								<td>

									<ul class="list-inline">
										<li class="list-inline-item"><button class="btn btn-default btn-sm minusOneBtn"><i class="fa fa-chevron-down fa-sm"></i> -1</button></li>

										<li class="list-inline-item">
											<button class="btn btn-sm btn-default inputBtn"><i class="fa fa-pencil"></i></button>
										</li>
										<li class="list-inline-item"><input placeholder="Set Amount"class="customInput collapseX" type="number" ></li>

										<li class="list-inline-item"><a href="#" class="collapseX submitNum"><i class="fa fa-check fa-lg"></i></a> <a href="#" class="collapseX"><i class="fa fa-close fa-lg"></i></a></li>
									</ul>
									
								</td>
							</tr>

							<tr class="collapse multi-collapse">
								<td><img src="https://placeholdit.co//i/50x50?"></td>
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
												<input placeholder="Set Amount" class="customInput collapseX" type="number">
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

		});


		$(".minusOneBtn").click(function() {
  //Declare Variables
  var $remaining = $(this).closest('tr').find(".remaining");
  var $qty = $(this).closest('tr').find(".stockQuantity");

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

			
			var $remaining = $(this).closest('tr').find(".remaining");
			var $qty = $(this).closest('tr').find(".stockQuantity");
			var $numToSubmit = $(this).closest('tr').find(".customInput");

  //Get current values
  var batchSize = +$remaining.attr("data-maxNumber");
  var currentRemaining = +$remaining.text();
  var currentQty = +$qty.text();
  var currentInputValue = $numToSubmit.val(); 
  var difference = currentRemaining - currentInputValue;
  //Subtract values
   if (currentRemaining == 0 && currentQty == 0) {
  	alert('No units in stock');
  }
  else if (difference < 0) {
  	currentRemaining = difference + batchSize;
  	currentQty = currentQty -1;
  } else if (difference > 0) {
  	currentRemaining = difference;
  }  

  //Update text
  $remaining.text(currentRemaining);
  $qty.text(currentQty);

  $(this).closest('tr').find(".collapseX").hide(); 
  $(this).closest('tr').find(".inputBtn").show();
});









		$(".inputBtn").click(function() {

			$(this).closest('tr').find(".inputBtn").hide();
			$(this).closest('tr').find(".collapseX").show(); 		

		});



		$(".fa-close").click(function() {

			$(this).closest('tr').find(".inputBtn").show();
			$(this).closest('tr').find(".collapseX").hide();

		});

	</script>

	@endpush