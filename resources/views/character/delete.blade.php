
<form action="{{route('delete-character')}}" method = "POST">
@csrf
    <div class="form-group">
        <label for="name"> Character Name</label>

            <input type="text" class="form-control" id="name" name="name" placeholder="Enter a Character Name">
        </div>
        <br>
    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Delete Character</button>
</form>
