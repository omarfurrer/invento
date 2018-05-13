@extends('layouts.main')

@section('title', 'Log')

@section('content')

<!-- Content Header (Page header) -->
<!-- Main content -->

<section class="content container-fluid">
   <div class="row">
       <div class="col-md-10 col-md-offset-1">

        <button type="button" class="navbar-toggle collapsed btn btn-primary btn-xs" data-toggle="collapse" data-target="#form-collapse"> Filter Item
            <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="form-collapse">

         <form class="form-inline" action="/log" method="GET">

           <div class="form-group{{ $errors->has('item_id') ? ' has-error' : '' }}">
            <select id="item" name="item_id" class="form-control">
                <option value="">All Items</option>
                @foreach($filtersData['items'] as $id => $description)
                <option value="{{ $id }}" {{ $itemID != null ? ($itemID == $id ? 'selected' : '') : ''  }}>{{$description}}</option>                      
                @endforeach

            </select>
            @if($errors->has('item_id'))
            <p class="text-danger">{{ $errors->first('item_id') }}</p>
            @endif
        </div>




        <div class="form-group{{ $errors->has('from_date') ? ' has-error' : '' }}"  id="fromDate">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text"
                class="form-control date-picker" 
                name="from_date" 
                id="fromDate"
                value="{{ $fromDate == null ? '':$fromDate }}"
                placeholder="Filter date from" 
                >
            </div>
            @if($errors->has('from_date'))
            <p class="text-danger">{{ $errors->first('from_date') }}</p>
            @endif
        </div>



        <div class="form-group{{ $errors->has('to_date') ? ' has-error' : '' }}"  id="toDate">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text"
                class="form-control date-picker" 
                name="to_date" 
                id="toDate"
                value="{{ $toDate == null ? '':$toDate }}"
                placeholder="Filter date to"
                >
            </div>
            @if($errors->has('to_date'))
            <p class="text-danger">{{ $errors->first('to_date') }}</p>
            @endif
        </div>




        <button type="submit" class="btn btn-primary pull-right">Show</button>

    </form>

</div>


</div>
</div>


<!-- /.box-header -->
<div class="row" style="margin-top: 20px">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><b>Items Log</b></h3>
            </div>

            <div class="box-body no-padding table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">In/Out</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Remaining</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th class="tblActionCol"></th>
                        </tr>
                        <tr id="new-row" class="hide">
                            <td class="text-center">#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>
                                <ul class="list-inline">
                                    <li>
                                        <a href="#" 
                                        onclick="return deleteModel(event, 'delete-form-{log_id}', 'Are you sure you want to delete this log ? All related data will be lost');"
                                        ><i class="fa fa-trash btn btn-xs btn-danger" aria-hidden="true"> Delete</i></a></li>
                                        <form id="delete-form-{log_id}" action="/admin/log/{log_id}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </ul>
                                </td>
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
                                <td><img 
                                    src="{{ $log[$i]->item->image_path == null ? 'http://via.placeholder.com/150x150' : asset('storage/'.$log[$i]->item->image_path) }}"
                                    width="75px"
                                    height="75px"></td>
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