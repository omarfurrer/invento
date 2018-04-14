@extends('layouts.main')


@section('content')
<!-- Content Header (Page header) -->


<section class="content-header">
	<h1>
		<a class="btn btn-primary addUserBtn" href="{{ url('measurement_units/create') }}">Add New unit   <i class="fa fa-plus"  aria-hidden="true"></i></a>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
		<li class="active">Here</li>
	</ol>
</section>

<!-- Main content -->

<section class="content container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><small>Showing: <b>{{count($measurementUnits)}} Units</b></small></h3>
					
					<div class="box-tools">
						<div class="input-group input-group-sm searchInput">
							<input type="text" name="table_search" class="form-control pull-right" placeholder="Search" id="search" onkeyup="myFunction()">

							<div class="input-group-btn">
								<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>

				</div>

				<!-- /.box-header -->

				<div class="box-body table-responsive no-padding">
					<table class="table table-hover" id="mUnitsTbl">
						<tbody>
							<tr id="theaderRow">
								<th>Name</th>
								<th>Short Name</th>
								<th></th>
							</tr>

							@for ($i = 0; $i < count($measurementUnits); $i++)

							<tr>
								<td>{{$measurementUnits[$i]->name}}</td>
								<td>{{ $measurementUnits[$i]->short_name }}</td>
								<td><ul class="list-inline">
									<li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
									<li><a href="{{ url('measurement_units/'.$measurementUnits[$i]->id.'/edit') }}"><i class="fa fa-pencil" aria-hidden="true"> </i> Edit</a></li>    
								</ul></td>

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

	function myFunction() {

		var input, filter, table, tr, td, i;
		input = document.getElementById("search");
		filter = input.value.toUpperCase();
		table = document.getElementById("mUnitsTbl");
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