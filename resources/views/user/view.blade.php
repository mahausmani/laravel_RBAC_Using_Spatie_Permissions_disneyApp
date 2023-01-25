<form  action="{{ route('view-user')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="id">User ID</label>
                            <input type="text" class="form-control" id="id" name="id" placeholder="Enter User ID">
                        </div>

</form>