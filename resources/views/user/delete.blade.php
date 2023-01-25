<h3>What role do you want to Delete?</h3>

@foreach ($users as $user){
    <button>{{$user->name}}</button>
}
@endforeach
<br>
<br>
<form action="{{route('delete-user')}}" method = "POST">
@csrf
    <div class="form-group">
        <label for="name">User Name</label>

            <input type="text" class="form-control" id="name" name="name" placeholder="Enter a User Name">
        </div>
        <br>
    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Delete User</button>
</form>
