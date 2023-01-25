<h3>What role do you want to Delete?</h3>

@foreach ($roles as $role){
    <button>{{$role->name}}</button>
}
@endforeach
<br>
<br>
<form action="{{route('delete-role')}}" method = "POST">
@csrf
    <div class="form-group">
        <label for="name">Role Name</label>

            <input type="text" class="form-control" id="name" name="name" placeholder="Enter a Role Name">
        </div>
        <br>
    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Delete Role</button>
</form>
