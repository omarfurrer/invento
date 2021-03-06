@extends('layouts.main')

@section('title', 'Dashboard')


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>

    <b>Important Alerts</b>
     <i class="fa fa-info-circle"></i>
  </h1>

</section>

<!-- Main content -->
<section class="content container-fluid">
<div class="row">
  <div class="col-sm-12">

    @if(!$lowQuantityItems->isEmpty())
       <div class="row">
      <h3 class="dashboardHeaders">Low Quantity Items</h3>
      @foreach($lowQuantityItems as $item)
      <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-blue"><i class="fa fa-exclamation"></i></span>
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

    @if(!$expiringSoonItems->isEmpty())
    <div class="row">
    <h3 class="dashboardHeaders">Expiring Soon Items</h3>
    @foreach($expiringSoonItems as $item)
     <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-orange"><i class="fa fa-exclamation"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">{{ $item->description }}</span>
          <span class="info-box-number">Expires on: {{ $item->expiry_date }}</span>
          <span class="info-box-number smallFontSpan">Remaining: {{ $item->current_quantity }} {{ $item->short_name }}</span>
        </div>
      </div> 
    </div>
    @endforeach

  </div>
   @endif


   @if(!$expiredItems->isEmpty())
   <div class="row">
  <h3 class="dashboardHeaders">Expired Items</h3>
   @foreach($expiredItems as $item)
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{ $item->description }}</span>
        <span class="info-box-number">Expired on: {{ $item->expiry_date }}</span>
        <span class="info-box-number smallFontSpan">Remaining: {{ $item->current_quantity }} {{ $item->short_name }}</span>
      </div>
    </div> 
  </div>
  @endforeach
  
</div>
@endif



</div>
</div>
</section>
@endsection