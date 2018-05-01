@extends('layouts.main')

@section('title', 'Create New User')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary boxMargin" id="formBox">
				<div class="box-header">
					<h3 class="box-title">Create new user</h3>
				</div>

				@include('admin.users._form')


			</div>
		</div>
	</div>
</div>

@endsection
