@extends($template)

@section('content')
    <style>
        html, body {
            height: 100%;
            margin-top: 0;
        }

    </style>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="{{ asset('https://www.gstatic.com/charts/loader.js') }}"></script>
    <script type="text/javascript">
        @if(isset($cities))
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            var chartData = [];
            chartData[0] = ['City', 'Landslide', 'Thunderstorm', 'Flood', 'Fire', 'Other'];

            function drawChart() {

                @foreach($cities as $city => $incident)
                    chartData.push(
                        [
                            '{{ $city }}',
                            parseInt('{{ $incident['Landslide'] ? $incident['Landslide'] : 0}}'),
                            parseInt('{{ $incident['Thunderstorm'] ? $incident['Thunderstorm'] : 0}}'),
                            parseInt('{{ $incident['Flood'] ? $incident['Flood'] : 0}}'),
                            parseInt('{{ $incident['Fire'] ? $incident['Fire'] : 0}}'),
                            parseInt('{{ $incident['Other'] ? $incident['Other'] : 0}}')
                        ]
                    );
                    {{--console.log( ' {{ $city }} ' );--}}
                    {{--console.log( ' Landslide: {{ isset($city['Landslide'] ) ? $city['Landslide'] : 0 }}' );--}}
                    {{--console.log( ' Thunderstorm: {{ isset($city['Thunderstorm'] ) ? $city['Landslide'] : 0 }}' );--}}
                    {{--console.log( ' Flood: {{ isset($city['Flood'] ) ? $city['Flood'] : 0 }}' );--}}
                    {{--console.log( ' Fire: {{ isset($city['Fire'] ) ? $city['Fire'] : 0 }}' );--}}
                    {{--console.log( ' Other: {{ isset($city['Other'] ) ? $city['Other'] : 0 }}' );--}}
                @endforeach

                console.log(chartData);

                var data = google.visualization.arrayToDataTable(chartData);

                var options = {
                    chart: {
                        title: 'Incidents in {{ isset($district) ? $district : 'Not set' }}',
                        subtitle: '{{ isset($subtitle)  ? $subtitle : '' }}'
                    },
                    colors: ['#795548', '#9e9e9e', '#2196f3', '#f44336', '#9c27b0']
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        @endif
    </script>

    <div class="container" style="{{ isset($user_type) ? 'margin-top: 80px;' : 'margin-top: 20px;' }} height: 100%">

        <div class="row" style=" height: 100%;">

            <!-- Blog Entries Column -->
            <div class="col-md-12" style="border: 0px solid red;  height: 100%;">
                @if(isset($cities) && isset($district))
                    <h1>{{ $district }}<small> District</small></h1>

                    <div>
                        <div style="width: 100%;">
                            <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
                        </div>
                        <table class="table table-bordered" style="margin-top: 20px;">
                            <thead>
                            <tr>
                                <th scope="col">City</th>
                                <th scope="col">Number of Landslides</th>
                                <th scope="col">Number of Thunderstorms</th>
                                <th scope="col">Number of Floods</th>
                                <th scope="col">Number of Fires</th>
                                <th scope="col">Number of Other</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city => $incident)
                                <tr>
                                    <th scope="row">{{ $city }}</th>
                                    <td>{{ $incident['Landslide'] ? $incident['Landslide'] : 0}}</td>
                                    <td>{{ $incident['Thunderstorm'] ? $incident['Thunderstorm'] : 0}}</td>
                                    <td>{{ $incident['Flood'] ? $incident['Flood'] : 0}}</td>
                                    <td>{{ $incident['Fire'] ? $incident['Fire'] : 0}}</td>
                                    <td>{{ $incident['Other'] ? $incident['Other'] : 0}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif


            </div>

        </div>
        <!-- /.row -->

    </div>
@endsection