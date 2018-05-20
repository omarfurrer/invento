

<form action="{{ isset($supplier)? '/suppliers/'.$supplier->id : '/suppliers' }}" method="POST">

    <div class="box-body">

        {{ csrf_field() }}

        @if(isset($supplier))
        {{ method_field('PATCH') }}
        @endif

        <div class="form-group required{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">Name</label>
            <input type="text" class="form-control" required name="name" id="name" placeholder="Name" value="{{ old('name',isset($supplier)? $supplier->name : '') }}">
            @if($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <label for="contacts-1">Contact Numbers</label>

        <div class="form-group{{ $errors->has('contacts.0.contact') ? ' has-error' : '' }}">
            <input 
                type="text"
                class="form-control"
                name="contacts[0][contact]"
                id="contacts-1"
                placeholder="Contact number 1"
                value="{{ old('contacts.0.contact',isset($supplier)? (isset($supplier->contacts[0]) ? $supplier->contacts[0]->contact : '') : '') }}">
            @if($errors->has('contacts.0.contact'))
            <p class="text-danger">{{ $errors->first('contacts.0.contact') }}</p>
            @endif
        </div>
        
        <div class="form-group{{ $errors->has('contacts.1.contact') ? ' has-error' : '' }}">
            <input 
                type="text"
                class="form-control"
                name="contacts[1][contact]"
                id="contacts-2"
                placeholder="Contact number 2"
                value="{{ old('contacts.1.contact',isset($supplier)? (isset($supplier->contacts[1]) ? $supplier->contacts[1]->contact : '') : '') }}">
            @if($errors->has('contacts.1.contact'))
            <p class="text-danger">{{ $errors->first('contacts.1.contact') }}</p>
            @endif
        </div>
        
        <div class="form-group{{ $errors->has('contacts.2.contact') ? ' has-error' : '' }}">
            <input 
                type="text"
                class="form-control"
                name="contacts[2][contact]"
                id="contacts-3"
                placeholder="Contact number 3"
                value="{{ old('contacts.2.contact',isset($supplier)? (isset($supplier->contacts[2]) ? $supplier->contacts[2]->contact : '') : '') }}">
            @if($errors->has('contacts.2.contact'))
            <p class="text-danger">{{ $errors->first('contacts.2.contact') }}</p>
            @endif
        </div>

    </div>



    <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right">Save</button>
    </div>
</form>
