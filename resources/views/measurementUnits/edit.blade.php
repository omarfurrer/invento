@extends('layouts.main')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary" id="formBox">
				<div class="box-header">
					<h3 class="box-title">Editing - {{($measurementUnit->name)}}</h3>
				</div>

				@include('measurementUnits._form',['measurementUnit'=>$measurementUnit])

			</div>
		</div>
	</div>
</div>

@endsection