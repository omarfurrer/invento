@extends('layouts.main')


@section('content')

<!-- Content Header (Page header) -->


<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
  </ol>
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
              <th>Min</th>
              <th class="tblActionCol"></th>
            </tr>

            @for ($i = 0; $i < count($items); $i++)

            <tr>
              <td>{{$items[$i]->description}}</td>
              <td>{{$items[$i]->current_quantity}}/{{ $items[$i]->measurementUnit->name }}</td>
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