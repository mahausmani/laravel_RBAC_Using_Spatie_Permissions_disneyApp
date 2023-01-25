<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}


button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}





.container {
  padding: 16px;
}


/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.password {
     display: block;
     float: none;
  }

}
</style>
</head>
<body>

<h2>Dashboard</h2>


<form action="{{ route('logout') }}" method="post">
    <button type="submit">Logout</button>
</form>

@if(Auth::user()->hasPermissionTo('character.view', 'admin'))
<form action="{{ route('show-characters') }}">
    <button type="submit">Show Characters</button>
</form>
@endif
@if(Auth::user()->hasPermissionTo('character.create','admin'))
<form action="{{ route('create-character') }}" >
    <button type="submit">Create Characters</button>
</form>
@endcan
@if(Auth::user()->hasPermissionTo('character.update','admin'))
<form action="{{ route('update-character') }}">
    <button type="submit">update Characters</button>
</form>
@endcan
@if(Auth::user()->hasPermissionTo('character.delete','admin'))
<form action="{{ route('delete-character') }}" >
    <button type="submit">delete Characters</button>
</form>
@endcan


@if(Auth::user()->hasPermissionTo('user.view','admin'))
<form action="{{ route('show-users') }}">
    <button type="submit">Show Users</button>
</form>
@endcan
@if(Auth::user()->hasPermissionTo('user.view_user','admin'))
<form action="{{ route('get-user') }}" >
    <button type="submit">Get User</button>
</form>
@endcan
@if (Auth::user()->hasPermissionTo('user.create','admin'))
<form action="{{ route('create-user') }}">
    <button type="submit">Create User</button>
</form>
@endcan
@if(Auth::user()->hasPermissionTo('user.update','admin'))
<form action="{{ route('update-user') }}">
    <button type="submit">Update User</button>
</form>
@endcan
@if(Auth::user()->hasPermissionTo('user.delete','admin'))
<form action="{{ route('delete-user') }}" >
    <button type="submit">Delete User</button>
</form>
@endcan


@if(Auth::user()->hasPermissionTo('role.view','admin'))
<form action="{{ route('show-roles') }}">
    <button type="submit">Show Roles</button>
</form>
@endcan

@if(Auth::user()->hasPermissionTo('role.create','admin'))
<form action="{{ route('create-role') }}" >
    <button type="submit">Create Role</button>
</form>
@endcan
@if(Auth::user()->hasPermissionTo('role.update','admin'))
<form action="{{ route('update-role')}}" method="">
    <button type="submit">Update Role</button>
</form>
@endcan
@if(Auth::user()->hasPermissionTo('role.delete','admin'))
<form action="{{ route('delete-role') }}" >
    <button type="submit">Delete Role</button>
@endcan
<br>
@if(Auth::user()->hasPermissionTo('character.vote','admin'))
<form action="{{ route('vote-character') }}" >
    <button type="submit">Vote</button>

@endcan
</body>
</html>
