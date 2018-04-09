@extends('layouts.main')

@section('content')

@include('admin.users._form',['user'=>$user])

@endsection
