@extends('layouts.main')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary boxMargin" id="formBox">
				<div class="box-header">
					<h3 class="box-title">Add new Supplier</h3>
				</div>

				@include('suppliers._form')


			</div>
		</div>
	</div>
</div>

@endsection

