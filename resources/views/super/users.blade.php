@extends('templates.super_template')

@section('content')
    <div class="container" style="margin-top: 70px;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <h1>Users</h1>
            </div>

            @if(isset($users))
                <table class="table" style="margin-top: 10px">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Account Type</th>
                        <th scope="col">Job</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @if($user['username'] != $username)
                            <tr>
                                <th scope="row">{{ $user['id'] }}</th>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['type'] }}</td>
                                <td>{{ $user['job'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user['username'] }}</td>
                                <td style="text-align: center">
                                    <a href="{{ route('view_user', ['id' => $user['id'] ]) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">View</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            @endif

        </div>
        <!-- /.row -->
        <div class="d-inline-block float-right">
            <a href="{{ route('add_user') }}" class="btn btn-success" role="button" aria-pressed="true">Add User</a>
        </div>

    </div>
@endsection