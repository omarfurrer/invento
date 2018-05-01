@extends('layouts.main')

@section('title', 'Editing Item')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary boxMargin" id="formBox">
                <div class="box-header">
                    <h3 class="box-title">Editing - {{($item->description)}}</h3>
                </div>

                @include('items._form',['item'=>$item])

            </div>
        </div>
    </div>
</div>

@endsection