

<form action="{{ isset($supplier)? '/suppliers/'.$supplier->id : '/suppliers' }}" method="POST">

    <div class="box-body">

        {{ csrf_field() }}

        @if(isset($supplier))
        {{ method_field('PATCH') }}
        @endif

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">Name</label>
            <input type="text" class="form-control" required name="name" id="name" placeholder="Name" value="{{ old('name',isset($supplier)? $supplier->name : '') }}">
            @if($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="form-group{{ $errors->has('short_name') ? ' has-error' : '' }}">
            <label for="short_name">Short Name</label>
            <input type="text" class="form-control" required name="short_name" id="short_name" placeholder="Short Name" value="{{ old('short_name',isset($supplier)? $supplier->short_name : '') }}">
            @if($errors->has('short_name'))
            <p class="text-danger">{{ $errors->first('short_name') }}</p>
            @endif
        </div>

    </div>



    <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right">Save</button>
    </div>
</form>
