@extends('layouts.main')


@section('content')
<!-- Content Header (Page header) -->


<section class="content-header">
	<h1>
		<a class="btn btn-primary addBtn" href="{{ url('suppliers/create') }}">Add New Supplier   <i class="fa fa-plus"  aria-hidden="true"></i></a>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
		<li class="active">Here</li>
	</ol>
</section>

<!-- Main content -->

<section class="content container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box boxMargin">
				<div class="box-header">
					<h3 class="box-title">Showing: <b>{{count($suppliers)}} Suppliers</b></h3>
					
					<div class="box-tools">
						<div class="input-group input-group-sm searchInput">
							<input type="text" name="table_search" class="form-control pull-right" placeholder="Search" id="search" onkeyup="search()">

							<div class="input-group-btn">
								<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>

				<!-- /.box-header -->

				<div class="box-body table-responsive no-padding">
					<table class="table table-hover" id="suppliersTbl">
						<tbody>
							<tr id="tHeaderRow">
								<th>Name</th>
								<th>Contact Number</th>
								<th class="tblActionCol"></th>
							</tr>

							@for ($i = 0; $i < count($suppliers); $i++)

							<tr>
								<td>{{$suppliers[$i]->name}}</td>
								<td>{{ $suppliers[$i]->contact_number }}</td>
								<td>
									<ul class="list-inline">
										<li><a href="{{ url('suppliers/'.$suppliers[$i]->id.'/edit') }}"><i class="fa fa-pencil btn btn-xs btn-primary" aria-hidden="true"> Edit</i></a></li>  
										<li><a href="#"><i class="fa fa-trash btn btn-xs btn-danger" aria-hidden="true"> Delete</i></a></li>  
									</ul>
								</td>								

							</tr>

						</tbody>
						@endfor
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
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
		table = document.getElementById("suppliersTbl");
		tr = table.getElementsByTagName("tr");

		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			} 
		}
	}

</script>