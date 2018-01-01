@extends('templates.public_template')

@section('content')
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-lg-12">

                <h1 class="my-4">Posts
                    {{--<small>Secondary Text</small>--}}
                </h1>

                <!-- Blog Post -->
                @if(isset($posts))
                    @foreach($posts as $post)
                        <div class="card mb-4">

                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h2 class="card-title">{{ $post->title }}</h2>
                                </div>
                                <div class="d-inline-block float-right">
                                    <span class="badge badge-warning">Threat Level: {{ $post->threat_level }}</span>
                                </div>
                                <p class="card-text">{{ str_limit($post->description, 200) }}</p>
                                <a href="{{ route('view_post', ['id' => $post->id ]) }}" class="btn btn-primary float-right">Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <div class="card-footer text-muted">
                                Posted on {{ date("d M Y", strtotime($post->created_at)) }}
                            </div>

                        </div>
                    @endforeach
                @else
                    <p style="margin-top: 70px;">No one seems to have written any posts at the moment. Check back later</p>
                @endif

                <!-- Pagination -->
                {{ $posts->links('paginator', [
                    'nextPageUrl' => $posts->nextPageUrl(),
                    'previousPageUrl' => $posts->previousPageUrl(),
                ]) }}

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Search Widget -->
                {{--<div class="card my-4">--}}
                    {{--<h5 class="card-header">Search</h5>--}}
                    {{--<div class="card-body">--}}
                        {{--<div class="input-group">--}}
                            {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                            {{--<span class="input-group-btn">--}}
                  {{--<button class="btn btn-secondary" type="button">Go!</button>--}}
                {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <!-- Categories Widget -->
                {{--<div class="card my-4">--}}
                    {{--<h5 class="card-header">Categories</h5>--}}
                    {{--<div class="card-body">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-lg-6">--}}
                                {{--<ul class="list-unstyled mb-0">--}}
                                    {{--<li>--}}
                                        {{--<a href="#">Web Design</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">HTML</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">Freebies</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-6">--}}
                                {{--<ul class="list-unstyled mb-0">--}}
                                    {{--<li>--}}
                                        {{--<a href="#">JavaScript</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">CSS</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">Tutorials</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<!-- Side Widget -->--}}
                {{--<div class="card my-4">--}}
                    {{--<h5 class="card-header">Side Widget</h5>--}}
                    {{--<div class="card-body">--}}
                        {{--You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div>

        </div>
        <!-- /.row -->

    </div>
@endsection