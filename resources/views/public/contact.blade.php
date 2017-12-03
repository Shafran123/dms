@extends($template)

@section('content')
    <div class="container" style="margin-top: 80px;">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Contact
            {{--<small>Subheading</small>--}}
        </h1>

        {{--<ol class="breadcrumb">--}}
            {{--<li class="breadcrumb-item">--}}
                {{--<a href="index.html">Home</a>--}}
            {{--</li>--}}
            {{--<li class="breadcrumb-item active">Contact</li>--}}
        {{--</ol>--}}

        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
            <div class="col-lg-8 mb-4">
                <!-- Embedded Google Map -->
                {{--<iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>--}}
                {{--https://www.google.com/maps/embed/v1/place?q=place_id:ChIJLTCg0kha4joR25UFnHFmtN0&key=AIzaSyAsoHeV2i2jQVnEgzqJIEkR_7uvKcAxn_8--}}
                {{--<iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJLTCg0kha4joR25UFnHFmtN0&key=AIzaSyAsoHeV2i2jQVnEgzqJIEkR_7uvKcAxn_8"></iframe>--}}
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.8709461628578!2d79.8686873152291!3d6.9060319950099265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25978fc3e12ed%3A0xe5601a88169a4bcd!2sMinistry+of+Disaster+Management!5e0!3m2!1sen!2slk!4v1512289285941" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <!-- Contact Details Column -->
            <div class="col-lg-4 mb-4">
                <h3>Contact Details</h3>
                <p>
                    Ministry of Disaster Management
                    <br>Vidya Mawatha, Colombo 00700
                    <br>
                </p>
                <p>
                    <i class="fa fa-phone" aria-hidden="true"></i> (+94) 778 472 9232
                </p>
                <p>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <a href="mailto:name@example.com"> secretarymdm2015@gmail.com
                    </a>
                </p>
                <p>
                    <i class="fa fa-clock-o" aria-hidden="true"></i> Monday - Friday: 8:30 AM to 5:00 PM
                </p>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection