@extends('layouts.main')

@section('title', 'Items')

@section('content')


<!-- Content Header (Page header) -->


<section class="content-header">
    <h1>
        <a class="btn btn-primary addBtn" href="{{ url('items/create') }}">Add New Item   <i class="fa fa-plus"  aria-hidden="true"></i>
        </a>
    </h1>
</section>

<!-- Main content -->

<section class="content container-fluid">
    <div class="row">
        <div class="col-sm-12">
            @if(count($items) != 0)
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Showing: <b>{{count($items)}} Items</b></h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm searchInput">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search" id="search" onkeyup="search()">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->


                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="itemsTbl">
                        <tbody><tr id="tHeaderRow">
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Supplier</th>
                                <th>Minimum Quantity <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="If Item quantity is less than minimum quantity, an alert will be displayed in the dashboard"></i></th>
                                <th>Status</th>
                                <th>Image</th>
                                <th class="tblActionCol"></th>
                            </tr>

                            @for ($i = 0; $i < count($items); $i++)

                            <tr>
                                <td>{{$items[$i]->description}}</td>
                                <td>{{ $items[$i]->current_quantity }}</td>
                                <td>{{ $items[$i]->measurementUnit->name }}</td>
                                <td>{{ isset($items[$i]->supplier) ? $items[$i]->supplier->name : 'N/A' }}</td>
                                <td>{{ $items[$i]->minimum_quantity }}</td>
                                <td>{!! $items[$i]->is_initially_approved ? '<i class="fa fa-check btn btn-xs btn-success" aria-hidden="true"> Approved</i>' : '<i class="fa fa-circle-o-notch btn btn-xs btn-warning" aria-hidden="true"> Needs Approval</i>' !!}</td>
                                <td><img 
                                        src="{{ $items[$i]->image_path == null ? 'http://via.placeholder.com/150x150' : asset('storage/'.$items[$i]->image_path) }}"
                                        height="75px"
                                        width="75px"></td>
                                <td>
                                    <ul class="list-inline">
                                        <li>
                                            <a href="{{ url("items/". $items[$i]->id ."/edit") }}"><i class="fa fa-pencil btn btn-xs btn-primary" aria-hidden="true"> Edit</i>
                                            </a>
                                        </li>    
                                        <li>
                                            <a href="#"><i class="fa fa-trash btn btn-xs btn-danger" aria-hidden="true"> Delete</i></a></li>
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
            @else

            <h4 class="text-center emptyArrayHeader">
                <i class="fa fa-info-circle"></i>  
                There are currently no items to show, please add item first.
            </h4>

            @endif
        </div>
    </div>

</section>
@endsection

@push('scripts')

<script>

    function search() {

        var input, filter, table, tr, td, i;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("itemsTbl");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }




    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });




</script>

@endpush