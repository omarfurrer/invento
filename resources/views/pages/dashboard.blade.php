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
            <h3 class="dashboardHeaders"><b>Low Quantity Items</b></h3>
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
     <h3 class="dashboardHeaders"><b>Expiring Soon Items</b></h3>
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
@endif
</div>


@if(!$expiredItems->isEmpty())
       <div class="row">
     <h3 class="dashboardHeaders"><b>Expired Items</b></h3>
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
@endif
</div>
</section>
@endsection