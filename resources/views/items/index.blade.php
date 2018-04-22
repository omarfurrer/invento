@extends('layouts.main')


@section('content')


<!-- Content Header (Page header) -->


<section class="content-header">
  <h1>
    <a class="btn btn-primary addBtn" href="{{ url('items/create') }}">Add New Item   <i class="fa fa-plus"  aria-hidden="true"></i>
    </a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
  </ol>
</section>

<!-- Main content -->

<section class="content container-fluid">
  <div class="row">
    <div class="col-sm-12">
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
              <th>Description</th>
              <th>Initial Quantity</th>
              <th>Unit ID</th>
              <th>Supplier ID</th>
              <th>Price</th>
              <th>Minimum quantity</th>
              <th>Expiry Date</th>
              <th>Notes</th>
              <th class="tblActionCol"></th>
            </tr>

            @for ($i = 0; $i < count($items); $i++)

            <tr>
              <td>{{$items[$i]->description}}</td>
              <td>{{ $items[$i]->initial_quantity }}</td>
              <td>{{ $items[$i]->unit_id }}</td>
              <td>{{ $items[$i]->supplier_id }}</td>
              <td>{{ $items[$i]->price }}</td>
              <td>{{ $items[$i]->minimum_quantity }}</td>
              <td>{{ $items[$i]->expiry_date }}</td>
              <td>{{ $items[$i]->notes }}</td>
              <td>
                <ul class="list-inline">
                  <li>
                    <a href="{{ url("items". $items[$i]->id ."/edit") }}"><i class="fa fa-pencil btn btn-xs btn-primary" aria-hidden="true"> Edit</i>
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

</script>

@endpush