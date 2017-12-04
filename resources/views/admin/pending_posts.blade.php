@extends('templates.admin_template')

@section('content')
    <div class="container" style="margin-top: 80px;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <h1>Pending Posts</h1>
            </div>

                <table class="table table-hover" style="margin-top: 15px">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Type</th>
                            <th scope="col">Poster</th>
                            <th scope="col" style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($postCount > 0)
                        @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{ $post['id'] }}</th>
                                <td>{{ $post['title'] }}</td>
                                <td>{{ $post['type'] }}</td>
                                <td>{{ $post['username'] }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('view_post', ['id' => $post['id'] ]) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Read</a>
                                    <a href="{{ route('delete_post', ['id' => $post['id']]) }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr style="text-align: center;">
                            <td colspan="5"> <strong>No Posts are Pending approval!</strong> </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
        </div>
        <!-- /.row -->

    </div>
@endsection