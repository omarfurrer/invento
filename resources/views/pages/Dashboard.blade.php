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
        <div class="col-md-4 col-lg-2">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Running Low On</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin text-center">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Remaining</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowQuantityItems as $item)
                                <tr>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->current_quantity }} {{ $item->measurementUnit->short_name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        @endif
    </div>



</section>
@endsection