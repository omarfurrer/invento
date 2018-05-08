@extends('layouts.main')


@section('content')

<!-- Content Header (Page header) -->


<!-- Main content -->

<section class="content container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><b>Items Log</b></h3>
                </div>

                <!-- /.box-header -->

                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="text-center">
                                <th>In/Out</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Remaining</th>
                                <th>User</th>
                                <th>Date</th>
                                <th class="tblActionCol"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @for ($i = 0; $i < count($log); $i++)

                            <tr>
                                <td class="text-center">
                                    @if($log[$i]->in)
                                    <i class="fa fa-lg fa-sort-down text-success"></i>           
                                    @else
                                    <i class="fa fa-lg fa-sort-up text-danger"></i>           
                                    @endif
                                </td>
                                <td>{{$log[$i]->item->description}}</td>

 
                                <td>
                                   @if($log[$i]->in)	
                               <p> + {{$log[$i]->quantity}} {{$log[$i]-> item->measurementUnit->name }}</p>
                                   @else
                                <p> - {{$log[$i]->quantity}} {{$log[$i]-> item->measurementUnit->name }}</p>
                                @endif
                                </td>
                                <td>{{$log[$i]->item_current_quantity}} {{$log[$i]-> item->measurementUnit->name }}</td>
                                <td>{{$log[$i]->user->name}}</td>
                                <td>{{$log[$i]->created_at->format('d-m-Y')}}</td>
                                <td>
                                    <ul class="list-inline">
                                        <li>
                                            <a href="#" 
                                               onclick="return deleteModel(event,'delete-form-{{$log[$i]->id}}', 'Are you sure you want to delete this log ? All related data will be lost');"
                                               ><i class="fa fa-trash btn btn-xs btn-danger" aria-hidden="true"> Delete</i></a></li>
                                        <form id="delete-form-{{$log[$i]->id}}" action="{{ url("admin/log/". $log[$i]->id ) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </ul>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>


@endsection