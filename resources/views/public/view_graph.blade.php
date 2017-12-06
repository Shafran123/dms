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

        @if(isset($incidents))
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
                google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {

                // Create the data table.
                var data = new google.visualization.DataTable();
                var chartData = [];
                @foreach($incidents as $incident)
                    var districtName = '{{ $incident['district'] }}';
                    var numberOfIncidents = parseInt('{{ $incident['number_of_incidents'] }}');
                    chartData.push([districtName, numberOfIncidents]);
                @endforeach
                console.log(chartData);
                data.addColumn('string', 'District');
                data.addColumn('number', 'Number of Incidents');
//                data.addRows([
//                    ['Mushrooms', 3],
//                    ['Onions', 1],
//                    ['Olives', 1],
//                    ['Zucchini', 1],
//                    ['Pepperoni', 2]
//                ]);
                data.addRows(chartData);

                // Set chart options
                var options = {
                    'title': '{{ isset($startDate) && isset($endDate) ? 'Incidents between '.$startDate .' and '.$endDate : '' }}',
                    'width': '100%',
                    'height': 400,
                    'chartArea': {'width': '100%', 'height': '80%'},
                    'legend': {'position': 'bottom'}
                };


                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

                function selectHandler() {
                    var selectedItem = chart.getSelection()[0];
                    if (selectedItem) {
                        var district = data.getValue(selectedItem.row, 0);
                        @if(isset($startDate) && isset($endDate))
                            window.location = "/filter/" + district + "/{{ $startDate }}/{{ $endDate }}";
                        @else
                            window.location = "/filter/" + district;
                        @endif


    //                    window.open('localhost:8000/filter/' + topping, '_blank');
    //                    window.location = 'localhost:8000/filter/' + topping;

    //                    alert('The user selected ' + topping);
                    }
                }

                google.visualization.events.addListener(chart, 'select', selectHandler);

                chart.draw(data, options);
            }
         @endif


    </script>
    <div class="container" style="{{ isset($user_type) ? 'margin-top: 80px;' : 'margin-top: 20px;' }} height: 100%">

        <div class="row" style=" height: 100%;">

            <!-- Blog Entries Column -->
            <div class="col-md-12" style="border: 1px solid red;  height: 100%;">
                <h1>View Graphs</h1>

                <form action="{{ route('filter_posts') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="type">Incident Type</label>
                        <select class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type">
                            @foreach($types as $type => $icon)
                                @if($type == old('type'))
                                    <option value="{{ $type }}" selected>{{ $type }}</option>
                                @else
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{--{{ $errors->first('type') }}--}}
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-legend col-sm-2">Choose Options</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" onclick="myFunction()" name="radioButton" id="radioButton" value="overall" checked>
                                        Overall
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" onclick="myFunction()" name="radioButton" id="radioButton" value="duration">
                                        Between 2 dates
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="startDate">Start Date</label>
                            <input type="date" class="form-control {{ $errors->has('startDate') ? ' is-invalid' : '' }}" id="startDate" name="startDate" required value="{{ old('startDate') }}" readonly>
                            <div class="invalid-feedback">
                                {{ $errors->first('startDate') }}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="endDate">End Date</label>
                            <input type="date" class="form-control {{ $errors->has('endDate') ? ' is-invalid' : '' }}" id="endDate" name="endDate" required value="{{ old('endDate') }}" readonly>
                            <div class="invalid-feedback">
                                {{ $errors->first('endDate') }}
                            </div>
                        </div>
                    </div>
                    <br><input type="submit" class="btn btn-lg btn-block btn-success" value="Submit">
                    {{--<div class="form-group">--}}
                    {{--<label for="date">Date of incident</label>--}}
                    {{--<input type="date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" id="date" name="date" required value="{{ old('date') }}">--}}
                    {{--<div class="invalid-feedback">--}}
                    {{--{{ $errors->first('date') }}--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--</div>--}}
                </form>

                @if(isset($incidents))
                <div>
                    <div style="width: 100%;">
                        <div id="chart_div"></div>
                    </div>
                    <table>
                        <thead>
                        <th>GDGD</th>
                        <th>GDGD</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>DGD</td>
                            <td>DGD</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                @elseif(isset($errorMessage))
                    <div style="color: red;"> {{ $errorMessage }}</div>
                @endif


            </div>

        </div>
        <!-- /.row -->

    </div>
    <script>
//        window.onload = myFunction();
        function myFunction(){
//            document.getElementById('startDate').readOnly = false;
//            console.log(document.getElementById('startDate').disabled);
            if(document.getElementById('startDate').readOnly && document.getElementById('endDate').readOnly){
                document.getElementById('startDate').readOnly = false;
                document.getElementById('endDate').readOnly = false;
            }else{
                document.getElementById('startDate').readOnly = true;
                document.getElementById('endDate').readOnly = true;
            }
        }
    </script>
@endsection