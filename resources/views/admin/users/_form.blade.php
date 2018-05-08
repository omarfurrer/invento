



<form action="{{ isset($user)? '/admin/users/'.$user->id : '/admin/users' }}" method="POST">

    <div class="box-body">

        {{ csrf_field() }}

        @if(isset($user))
        {{ method_field('PATCH') }}
        @endif

        <div class="form-group required{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name',isset($user)? $user->name : '') }}" required>
            @if($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="form-group required{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email',isset($user)? $user->email : '') }}" required>
            @if($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="form-group required{{ $errors->has('role_id') ? ' has-error' : '' }}">
            <label for="role_id" class="control-label">Role</label>
            <select id="role_id" name="role_id" class="form-control" required>
                <option value="">Choose Role</option>
                @foreach($roles as $key => $name)
                <option value="{{ $key }}" {{  old('role_id') != NULL ? (old('role_id') == $key ? 'selected' : '' ) : (isset($user)? ($user->roles()->first()->id == $key ? 'selected' : '') :'')   }}>{{ $name }}</option>
                @endforeach
            </select>
            @if($errors->has('role_id'))
            <p class="text-danger">{{ $errors->first('role_id') }}</p>
            @endif
        </div>
    </div>



    <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right">Save</button>
    </div>
</form>





