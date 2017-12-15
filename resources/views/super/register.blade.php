@extends('templates.super_template')

@section('content')

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

                <h1 class="my-4">Register</h1>

                <form class="form-horizontal" method="POST" action="{{ route('save_user') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus style="{{ $errors->has('name') ? ' border: 1px solid red;' : '' }}">
                        @if ($errors->has('name'))
                            <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="type">Account Type</label>
                        <select id="type" class="form-control" name="type" required>
                            <option {{ old('type') == 'user' ? 'selected' : '' }}>user</option>
                            <option {{ old('type') == 'admin' ? 'selected' : '' }}>admin</option>
                            <option {{ old('type') == 'super' ? 'selected' : '' }}>super</option>
                        </select>

                        @if ($errors->has('type'))
                            <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="job">Job</label>
                        <input id="job" type="text" class="form-control" name="job" value="{{ old('job') }}" required style="{{ $errors->has('job') ? ' border: 1px solid red;' : '' }}">

                        @if ($errors->has('job'))
                            <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('job') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">E-Mail Address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required style="{{ $errors->has('email') ? ' border: 1px solid red;' : '' }}">

                        @if ($errors->has('email'))
                            <span class="help-block"  style="color: red;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required style="{{ $errors->has('username') ? ' border: 1px solid red' : '' }}">

                        @if ($errors->has('username'))
                            <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required style="{{ $errors->has('password') ? ' border: 1px solid red;' : '' }}">

                        @if ($errors->has('password'))
                            <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="float-right btn btn-lg btn-primary">
                            Register
                        </button>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.row -->

    </div>

    {{--<div class="container" style="margin-top: 80px;">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-8 col-md-offset-2">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Register</div>--}}

                    {{--<div class="panel-body">--}}
                        {{--<form class="form-horizontal" method="POST" action="{{ route('save_user') }}">--}}
                            {{--{{ csrf_field() }}--}}

                            {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                                {{--<label for="name" class="col-md-4 control-label">Name</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                    {{--@if ($errors->has('name'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">--}}
                                {{--<label for="type" class="col-md-4 control-label">Account Type</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="type" type="text" class="form-control" name="type" value="{{ old('type') }}" required>--}}
                                    {{--<select id="type" class="form-control" name="type" required>--}}
                                        {{--<option {{ old('type') == 'user' ? 'selected' : '' }}>user</option>--}}
                                        {{--<option {{ old('type') == 'admin' ? 'selected' : '' }}>admin</option>--}}
                                        {{--<option {{ old('type') == 'super' ? 'selected' : '' }}>super</option>--}}
                                    {{--</select>--}}

                                    {{--@if ($errors->has('type'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('type') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('job') ? ' has-error' : '' }}">--}}
                                {{--<label for="name" class="col-md-4 control-label">Job</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="job" type="text" class="form-control" name="job" value="{{ old('job') }}" required>--}}

                                    {{--@if ($errors->has('job'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('job') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                                {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

                                    {{--@if ($errors->has('email'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">--}}
                                {{--<label for="name" class="col-md-4 control-label">Username</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>--}}

                                    {{--@if ($errors->has('username'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('username') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                                {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                    {{--@if ($errors->has('password'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-6 col-md-offset-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--Register--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection