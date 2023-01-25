@foreach($characters as $character){

<li>{{$character}}</li>

}
@endforeach
<form action="{{route('vote-character')}}" method = "POST">
        <h4>Enter Name of Character to vote</h4>
        <div class="form-group">
        <label for="name">Character Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Character Name">
    </div>
    <button>submit</button>
</form>