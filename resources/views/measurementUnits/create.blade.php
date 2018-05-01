@extends('layouts.main')

@section('title', 'Create New Unit')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary boxMargin" id="formBox">
				<div class="box-header">
					<h3 class="box-title">Create new Measurment Unit</h3>
				</div>

				@include('measurementUnits._form')


			</div>
		</div>
	</div>
</div>

@endsection

