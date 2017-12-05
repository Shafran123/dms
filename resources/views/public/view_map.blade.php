@extends($template)

@section('content')
    <style>
        html, body {
            height: 100%;
            margin-top: 0;
        }

    </style>
    <div class="container" style="margin-top: 50px; height: 100%;">

        <div class="row" style="height: 100%">

            <!-- Post Content Column -->
            <div class="col-lg-12">

                <!-- Title -->
                <h1 class="mt-4">View Map</h1>
                <div class="form-group" style="height: 100%">
                    <div id="map" style="height: 100%; width: 99%;"></div>
                </div>






                {{--<hr>--}}

            </div>

        </div>
        <!-- /.row -->

    </div>
    <script>
        var map;
        function initAutocomplete(){
            console.log(document.getElementById('map'));
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 7.800650,
                    lng: 80.706366
                },
                draggable: true,
                zoom: 8
            });

            function getMap()
            {
                return this.map;
            }

            var westernProvinceCoords = [
                { lat: 7.273474, lng: 79.842114 },
                { lat: 7.312296, lng: 80.013775 },
                { lat: 7.289821, lng: 80.070767 },
                { lat: 7.327279, lng: 80.142864 },
                { lat: 7.253040, lng: 80.208782 },
                { lat: 7.169251, lng: 80.173763 },
                { lat: 7.121559, lng: 80.180630 },
                { lat: 7.106569, lng: 80.201229 },
                { lat: 7.020027, lng: 80.178570 },
                { lat: 6.981861, lng: 80.197796 },
                { lat: 6.979817, lng: 80.216335 },
                { lat: 6.938922, lng: 80.234875 },
                { lat: 6.854394, lng: 80.193676 },
                { lat: 6.819624, lng: 80.207409 },
                { lat: 6.797124, lng: 80.196423 },
                { lat: 6.675745, lng: 80.249981 },
                { lat: 6.620501, lng: 80.269207 },
                { lat: 6.577529, lng: 80.314526 },
                { lat: 6.541375, lng: 80.317959 },
                { lat: 6.453366, lng: 80.377010 },
                { lat: 6.429486, lng: 80.380444 },
                { lat: 6.386497, lng: 80.298733 },
                { lat: 6.342140, lng: 80.303539 },
                { lat: 6.337363, lng: 80.295300 },
                { lat: 6.363978, lng: 80.214276 },
                { lat: 6.426756, lng: 80.000729 },
                { lat: 6.943693, lng: 79.832501 },
                { lat: 6.985269, lng: 79.872326 },
                { lat: 7.205357, lng: 79.816708 },
                { lat: 7.208763, lng: 79.833187 },
                { lat: 7.273474, lng: 79.842114 }
            ];

            var westernProvince = new google.maps.Polygon({
                paths: westernProvinceCoords,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 3,
                fillColor: '#FC9E9E',
                fillOpacity: 0.35
            });

            westernProvince.setMap(map);
            var markers = [], infoWindows = [];
            var details = [];
            var i = 0;
            @if(isset($incidents))
                    @foreach($incidents as $incident)

                        details.push(
                            [new google.maps.LatLng({{ $incident['latitude'].','. $incident['longitude']}}), '<a href="{{ route('view_post', ['id' => $incident['id']]) }}" target="_blank">{{ $incident['title'] }}</a>', '{{ $incident['type_icon'] }}']
                        );

                    @endforeach
                var infowindow = new google.maps.InfoWindow();
                for (i = 0; i < details.length; i++)
                {
                    var marker = new google.maps.Marker({
                        position: details[i][0],
                        map: map,
                        icon: details[i][2]
                    });

                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(details[i][1]);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }
            @endif


        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRTORue7jdYHni5zzlQEZdayfmxLA5alc&libraries=places&callback=initAutocomplete"
            async defer></script>
@endsection