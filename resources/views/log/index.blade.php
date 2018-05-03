@extends('layouts.main')


@section('content')

<!-- Content Header (Page header) -->


<section class="content-header">
	<h1>
		<a class="btn btn-primary addBtn" href="{{ url('log/in/create') }}">Item in   <i class="fa fa-plus"  aria-hidden="true"></i>
		</a>
		<a class="btn btn-danger addBtn" href="{{ url('log/out/create') }}">Item Out   <i class="fa fa-minus"  aria-hidden="true"></i>
		</a>

	</h1>
</section>

<!-- Main content -->

<section class="content container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Items Log</h3>
				</div>

				<!-- /.box-header -->

				<div class="box-body no-padding">
					<table class="table table-condensed">
						<tbody><tr>
							<th>In/Out</th>
							<th>Quantity</th>
							<th>Item</th>
							<th>Remaining</th>
							<th>User</th>
							<th>Date</th>
							<th class="tblActionCol"></th>
						</tr>

						@for ($i = 0; $i < count($log); $i++)

						<tr>
							<td>
                                                            @if($log[$i]->in)
                                                            <i class="fa fa-sort-down text-success"></i>           
                                                            @else
                                                            <i class="fa fa-sort-up text-danger"></i>           
                                                            @endif
							</td>
							<td>{{$log[$i]->quantity}} {{$log[$i]-> item->measurementUnit->name }}</td>
							<td>{{$log[$i]->item->description}}</td>
							<td>{{$log[$i]->item_current_quantity}} {{$log[$i]-> item->measurementUnit->name }}</td>
							<td>{{$log[$i]->user->name}}</td>
							<td>{{$log[$i]->created_at->format('d-m-Y')}}</td>
							<td>
								<ul class="list-inline">
									<li>
										<a href="#"><i class="fa fa-trash btn btn-xs btn-danger" aria-hidden="true"> Delete</i></a></li>
									</ul>
								</td>
									</tr>
								@endfor
								</tbody>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
		</section>


		@endsection