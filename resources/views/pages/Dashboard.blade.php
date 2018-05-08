@extends('layouts.main')

@section('title', 'Dashboard')


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
    </h1>

</section>

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">

        @if(!$lowQuantityItems->isEmpty())

        @foreach($lowQuantityItems as $item)
        <div class="col-md-3 col-sm-6 col-xs-12">
             
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>
              
            

            <div class="info-box-content">
              <span class="info-box-text">{{ $item->description }}</span>
              <span class="info-box-number">Remaining: {{ $item->current_quantity }} {{ $item->measurementUnit->short_name }}</span>
          </div>
          <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
      
  </div>
  @endforeach
  
  
<!-- /.table-responsive -->
</div>

<!-- /.box-body -->

@endif




</section>
@endsection