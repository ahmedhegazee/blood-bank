@inject('perm','App\Models\Permission')
<div class="form-group">
    <label for="name"> Name</label>
    {!!Form::text('name',null,[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="display_name"> Display Name</label>
    {!!Form::text('display_name',null,[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="description">Description</label>
    {!!Form::textarea('description',null,[
    'class'=>'form-control'
    ])!!}
</div>
<div class="form-group">
    <label for="permissions">Permissions</label>
    @foreach ($perm->all()->groupBy('group')->keys() as $group)
    {{-- <h4>{{$group}}</h4> --}}
    <div class="row mb-2 p-1" style="border: 1px solid #ccc; border-radius:10px;">
        @foreach ($perm->all()->groupBy('group')->get($group) as $permission)
        <div class="col-3-sm mr-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" name="permissions_list[]" value="{{$permission->id}}"
                            @if($model->hasPermission($permission->name))
                        checked
                        @endif
                        >
                    </div>
                </div>
                <input type="text" class="form-control" value="{{$permission->display_name}}" disabled>
            </div>
        </div>
        @endforeach

    </div>
    @endforeach
</div>
<div class="form-group ">
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
