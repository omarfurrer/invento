@extends('layouts.main')

@section('title', 'Users')


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <a id="addUserBtn" class="btn btn-primary" href="{{ url('/admin/users/create') }}">Add New user<i class="fa fa-plus"  aria-hidden="true">  </i></a>
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
          <h3 class="box-title"><small>Showing: <b>{{count($users)}} Users</b></small></h3>

          <div class="box-tools">
            <div id="Serchinput" class="input-group input-group-sm">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search" id="search" onkeyup="myFunction()">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>

        <!-- /.box-header -->

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover" id="userTbl">
            <tbody><tr id="theaderRow">
              <th>ID</th>
              <th>User</th>
              <th>E-mail</th>
              <th>Role</th>
              <th></th>
            </tr>

            @for ($i = 0; $i < count($users); $i++)

            <tr>
              <td>{{$users[$i]->id}}</td>
              <td>{{ $users[$i]->name }}</td>
              <td>{{ $users[$i]->email }}</td>
              <td>{{ $users[$i]->roles()->first()->name }}</td>
              <td><ul class="list-inline">
                <li><a href="#" 
                 onclick="return deleteModel(event,'delete-form-{{$users[$i]->id}}', 'Are you sure you want to delete this user ? All related data will be lost');"
                 ><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                 <form id="delete-form-{{$users[$i]->id}}" action="{{ url("admin/users/". $users[$i]->id ) }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                </form>
                <li><a href="{{ url("admin/users/". $users[$i]->id ."/edit") }}"><i class="fa fa-pencil" aria-hidden="true"> </i> Edit</a></li>    
              </ul></td>

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

  function myFunction() {

    var input, filter, table, tr, td, i;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("userTbl");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
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