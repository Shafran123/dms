@extends('templates.public_template')

@section('content')
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Contact
            <small>Subheading</small>
        </h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active">Contact</li>
        </ol>

        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
            <div class="col-lg-8 mb-4">
                <!-- Embedded Google Map -->
                {{--<iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>--}}
                {{--https://www.google.com/maps/embed/v1/place?q=place_id:ChIJLTCg0kha4joR25UFnHFmtN0&key=AIzaSyAsoHeV2i2jQVnEgzqJIEkR_7uvKcAxn_8--}}
                <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJLTCg0kha4joR25UFnHFmtN0&key=AIzaSyAsoHeV2i2jQVnEgzqJIEkR_7uvKcAxn_8"></iframe>
            </div>
            <!-- Contact Details Column -->
            <div class="col-lg-4 mb-4">
                <h3>Contact Details</h3>
                <p>
                    3481 Melrose Place
                    <br>Beverly Hills, CA 90210
                    <br>
                </p>
                <p>
                    <i class="fa fa-phone" aria-hidden="true"></i> (123) 456-7890
                </p>
                <p>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <a href="mailto:name@example.com">name@example.com
                    </a>
                </p>
                <p>
                    <i class="fa fa-clock-o" aria-hidden="true"></i> Monday - Friday: 9:00 AM to 5:00 PM
                </p>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection