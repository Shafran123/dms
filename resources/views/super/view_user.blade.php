@extends('templates.super_template')

@section('content')
    <div class="container" style="margin-top: 70px;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <h1>View User: <small>{{ isset($user['username']) ? $user['username'] : 'Username' }}</small></h1>
            </div>

            @if(true)
            <div class="col-md-12" style="margin-top: 25px;">
                <h3>Change Account Type</h3>
                <form method="post" action="{{ route('update_user', ['id' => $user['id'], 'field' => 1]) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" name="type" id="type">
                            <option {{ $user['type'] == 'super' ? 'selected' : '' }}>super</option>
                            <option {{ $user['type'] == 'user' ? 'selected' : '' }}>user</option>
                            <option {{ $user['type'] == 'admin' ? 'selected' : '' }}>admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success float-right" value="Submit">
                    </div>
                </form>
                <h3>Change Email</h3>
                <form method="post" action="{{ route('update_user', ['id' => $user['id'], 'field' => 2]) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ isset($user['email']) ? $user['email'] :  '' }}" required>
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success float-right" value="Submit">
                    </div>
                </form>
                <h3>Change Password</h3>
                <form method="post" action="{{ route('update_user', ['id' => $user['id'], 'field' => 3]) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" required id="password" name="password">
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" class="form-control" required id="confirm-password" name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success float-right" value="Submit">
                    </div>
                </form>
            </div>
            @endif


        </div>
        <!-- /.row -->

    </div>
@endsection