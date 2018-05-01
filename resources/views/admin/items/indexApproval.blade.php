@extends('layouts.main')

@section('title', 'New Items')

@section('content')

<!-- Content Header (Page header) -->


<section class="content-header">
  
</section>

<!-- Main content -->

<section class="content container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">New Items</h3>
          </div>
        
        <!-- /.box-header -->

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover" id="itemsTbl">
            <tbody><tr id="tHeaderRow">
              <th>Item</th>
              <th>Quantity</th>
              <th>Min <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="If Item quantity is less than min an alert will be displayed"></i></th>
              <th class="tblActionCol"></th>
            </tr>

            @for ($i = 0; $i < count($items); $i++)

            <tr>
              <td>{{$items[$i]->description}}</td>
              <td>{{$items[$i]->current_quantity}} x ({{ $items[$i]->measurementUnit->name }})</td>
              <td>{{ isset($items[$i]->minimum_quantity) ? $items[$i]->minimum_quantity : 'N/A' }}</td>
              <td>
                <ul class="list-inline">

                  <li>
                    <a href="{{ url('/admin/items/'.$items[$i]->id.'/approval/initial') }}"><i class="fa fa-check btn btn-xs btn-success" aria-hidden="true"> Approve</i>
                    </a>
                  </li> 

                  </ul>
                </td>

              </tr>

            </tbody>
            @endfor
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

</section>
@endsection


@push('scripts')
<script>
  
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});


</script>

@endpush