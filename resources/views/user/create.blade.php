<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>


<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Create New User</h4>
                    
                    <form  action="{{ route('create-user') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter a Name">
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" class="form-control" id="pasword" name="password" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="api_tokern">api token</label>
                            <input type="api_token" class="form-control" id="api_token" name="api_token" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="name">Permissions</label>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                                <label class="form-check-label" for="checkPermissionAll">All</label>
                            </div>
                            <hr>
                            @php $i = 1; @endphp
                            <!-- //pass this from controller -->
                            @foreach ($roles as $role)
                                <div class="row">
                                    

                                    <div class="col-9 role-{{ $i }}-management-checkbox">
                                       
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="roles[]" id="checkRole{{ $role->id }}" value="{{ $role->name }}">
                                                <label class="form-check-label" for="checkRole{{ $role->id }}">{{ $role->name }}</label>
                                            </div>
                                          
                                        <br>
                                    </div>

                                </div>
                                @php  $i++; @endphp
                            @endforeach

                            
                        </div>
                       
                        
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Role</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>



