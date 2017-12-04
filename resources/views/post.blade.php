@extends($template)

@section('content')
    <div class="container" style="margin-top: 50px;">

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-12">

                <!-- Title -->
                <h1 class="mt-4">{{ isset($post['title']) ? $post['title'] : "Sorry no such post exists" }}</h1>

                <!-- Author -->
                <p class="lead">
                    by
                    <a href="#">{{ isset($poster) ? $poster : "Error" }}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <div class="d-inline-block">Posted on {{ isset($post['created_at']) ? $post['created_at'] : "site error" }}</div>
                @if($type == 'admin')
                    <div class="d-inline-block float-right">
                        @if($post['status'] == 'pending')
                            <a href="{{ route('approve_post', ['id' => $post['id']]) }}" class="btn btn-success btn-sm" role="button" aria-pressed="true">Approve</a>
                            <a href="{{ route('edit_post_form', [ 'id' => $post['id'] ]) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Edit</a>
                        @endif
                        <a href="{{ route('delete_post', ['id' => $post['id']]) }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Delete</a>
                    </div>

                @elseif($type == 'user' && $post['user_id'] == session('id'))
                    <div class="d-inline-block float-right">
                        <a href="{{ route('delete_post', ['id' => $post['id']]) }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Delete</a>
                    </div>
                @endif
                {{--<p>--}}
                    {{--Posted on January 1, 2017 at 12:00 PM--}}
                {{--<div class="float-right">Float right on all viewport sizes</div><br>--}}
                {{--</p>--}}

                <hr>

                @if(isset($pictures))
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                                @foreach($pictures as $picture)
                                    @if(++$firstPic == 1)
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{ asset("images/".$picture['original_filename']) }}" alt="First slide">
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset("images/".$picture['original_filename']) }}" alt="First slide">
                                        </div>
                                    @endif
                                @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                @else
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset("images/no_image.png") }}" alt="First slide">
                            </div>
                        </div>
                    </div>
                @endif

                <hr>

                <div style="margin-bottom: 50px;">
                <!-- Post Content -->
                    {{ isset($post['description']) ? $post['description'] : "site error" }}
                </div>
                <hr>

            </div>

            <!-- Sidebar Widgets Column -->
            {{--<div class="col-md-4">--}}

                {{--<!-- Side Widget -->--}}
                {{--<div class="card my-4">--}}
                    {{--<h5 class="card-header">Side Widget</h5>--}}
                    {{--<div class="card-body">--}}
                        {{--You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}

        </div>
        <!-- /.row -->

    </div>
@endsection