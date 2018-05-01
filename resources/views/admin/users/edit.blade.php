@extends('layouts.main')

@section('title', 'Editing User')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary boxMargin" id="formBox">
				<div class="box-header">
					<h3 class="box-title">Editing - {{($user->name)}}</h3>
				</div>

				@include('admin.users._form',['user'=>$user])

			</div>
		</div>
	</div>
</div>

@endsection
