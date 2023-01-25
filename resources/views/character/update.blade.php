<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<form  action="{{ route('update-character')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Character Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Character Name">
                        </div>
                        <div class="form-group">
                            <label for="newname">New Name</label>
                            <input type="text" class="form-control" id="newname" name="newname" placeholder="Enter new Name">
                        </div>
                <button>submit</button>
</form>