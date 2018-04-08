@extends('layouts.main')

@section('title', 'Users')


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add New user
        <a href="#"><i class="fa fa-plus" aria-hidden="true">  </i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol>
</section>

<!-- Main content -->


<section class="content container-fluid">
    <div class="row">


        <table class="table">


            <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Role</th>
              </tr>
          </thead>
          <tbody>

            @for ($i = 0; $i < count($users); $i++)

            <tr>
              <th scope="row">{{$users[$i]->id}}</th>
              <td>{{ $users[$i]->name }}</td>
              <td>{{ $users[$i]->email }}</td>
              <td>{{ $users[$i]->roles()->first()->name }}</td>

              <td><ol class="list-inline">
                <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                <li><a href="#"><i class="fa fa-pencil" aria-hidden="true"> </i> Edit</a></li>    
            </ol></td>

        </tr>
    </tbody>
    @endfor
</table>


</div>




</section>
@endsection