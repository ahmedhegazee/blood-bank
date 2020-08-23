<div class="form-group">
    <label for="name">Name</label>
    {!!Form::text('name',null,[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="email">Email</label>
    {!!Form::email('email',null,[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="password">Password</label>
    {!!Form::password('password',[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="password_confirmation">Confirm Password</label>
    {!!Form::password('password_confirmation',[
    'class'=>'form-control'
    ])!!}
</div>
{{-- <div class="form-group">
    <label for="permissions">Roles</label>
    <div class="row">
        @foreach ($rol->all() as $role)
        <div class="col-3-sm">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" name="roles_list[]" value="{{$role->id}}"
@if($model->hasRole($role->name))
checked
@endif
>
</div>
</div>
<input type="text" class="form-control" value="{{$role->display_name}}" disabled>
</div>
</div>
@endforeach
</div>
</div> --}}

<div class="form-group">
    <label for="roles_list">Roles</label>
    {!!Form::select('roles_list',$roles,null,array('multiple'=>'multiple','name'=>'roles_list[]','class'=>'form-control'))!!}
</div>
<div class="form-group ">
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
