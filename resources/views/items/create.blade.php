
@extends('layouts.main')

@section('title', 'Create New Item')

@section('content')


<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-primary boxMargin" id="formBox">
				<div class="box-header">
					<h3 class="box-title">Create new Item</h3>
				</div>

				@include('items._form')


			</div>
		</div>
	</div>
</div>

@endsection
