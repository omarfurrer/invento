@extends('layouts.main')


@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-primary boxMargin" id="formBox">
				<div class="box-header">
					<h3 class="box-title">Add Item in log</h3>
				</div>

				@include('log._formIn')


			</div>
		</div>
	</div>
</div>
@endsection