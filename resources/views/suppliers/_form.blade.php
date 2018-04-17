

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

        <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
            <label for="contact_number">Contact Number</label>
            <input type="text" class="form-control"  name="contact_number" id="contact_number" placeholder="Contact number" value="{{ old('contact_number',isset($supplier)? $supplier->contact_number : '') }}">
            @if($errors->has('contact_number'))
            <p class="text-danger">{{ $errors->first('contact_number') }}</p>
            @endif
        </div>

    </div>



    <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right">Save</button>
    </div>
</form>
