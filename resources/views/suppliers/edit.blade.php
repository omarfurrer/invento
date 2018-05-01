@extends('layouts.main')

@section('title', 'Edit Supplier')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary boxMargin" id="formBox">
				<div class="box-header">
					<h3 class="box-title">Editing - {{($supplier->name)}}</h3>
				</div>

				@include('suppliers._form',['supplier'=>$supplier])

			</div>
		</div>
	</div>
</div>

@endsection