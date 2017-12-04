@extends($template)

@section('content')
    <div class="container" style="margin-top: 80px;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <h1>My Posts</h1>
            </div>

            <table class="table table-hover" style="margin-top: 15px">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
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
                            <td style="color: {{ $post['status'] == 'approved' ? 'green' : 'blue' }}">{{ $post['status'] }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('view_post', ['id' => $post['id'] ]) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Read</a>
                                @if($post['status'] == 'pending')
                                    <a href="{{ route('edit_post_form', [ 'id' => $post['id'] ]) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true">Edit</a>
                                @endif
                                <a href="{{ route('delete_post', ['id' => $post['id']]) }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr style="text-align: center;">
                        <td colspan="5"> <strong>You haven't written any posts so far</strong> </td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
        <!-- /.row -->

    </div>
@endsection