@extends($template)

@section('content')

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

                <h1 class="my-4">Report Incident
                </h1>

                <form action="{{ route('add_post') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Title" value="{{ old('title') }}" required>
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date">Date of incident</label>
                        <input type="date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" id="date" name="date" required value="{{ old('date') }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    </div>
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
{{--                            {{ $errors->first('type') }}--}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="images">Upload images (if any)</label>
                        <input type="file" class="form-control-file {{ $errors->has('images') ? ' is-invalid' : '' }}" id="images" name="images[]" value="{{ old('images') }}" accept=".jpg, .png" multiple>
                        <div class="invalid-feedback">
                            {{--{{ $errors->first('images') }}--}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="province">Select Province</label>
                        <select class="form-control {{ $errors->has('province') ? ' is-invalid' : '' }}" id="province" name="province">
                            @foreach($provinces as $province)
                                @if($province == old('$province'))
                                    <option value="{{ $province }}" selected>{{ $province }}</option>
                                @else
                                    <option value="{{ $province }}">{{ $province }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{--{{ $errors->first('province') }}--}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pac-input">Please type in a location</label>
                        <input type="text" class="form-control {{ $errors->has('pac-input') ? ' is-invalid' : '' }}" id="pac-input" name="pac-input" placeholder="Location" value="{{ old('pac-input') }}" required>
                        <div class="invalid-feedback">
                            {{ $errors->first('pac-input') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Please select an approximate location from the map</label>
                        <div id="map" style="height: 500px; width: 100%;"></div>
                    </div>
                    <div class="d-inline-block">
                        <label for="lat">Latitude</label>
                        <input type="text" name="lat" id="lat" class="form-control" value="{{ old('lat') }}" readonly>
                    </div>
                    <div class="d-inline-block">
                        <label for="lng" style="margin-top: 10px;">Longitude</label>
                        <input type="text" name="lng" id="lng" class="form-control" value="{{ old('lng') }}" readonly>
                    </div>
                    <div class="form-group col-6 col-md-4">


                    </div>
                    <div class="form-group">
                        <br><br><input type="submit" class="btn btn-lg btn-block btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>
        <!-- /.row -->

    </div>


    <script>
        var map;
        function initAutocomplete(){
            console.log(document.getElementById('map'));
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 6.870066, lng: 79.879710},
                zoom: 15
            });
            var marker = new google.maps.Marker({
                position: {
                    lat: 6.870066,
                    lng: 79.879710
                },
                map: map,
                draggable: true
            });

//            document.getElementById('lat').value = marker.getPosition().lat();
//            document.getElementById('lng').value = marker.getPosition().lng();

            var input = document.getElementById('pac-input');

            var searchBox = new google.maps.places.SearchBox(input);

            google.maps.event.addListener(searchBox, 'places_changed',function(){
                var places = searchBox.getPlaces();
                var bounds = new google.maps.LatLngBounds();
                var i, place;

                for (i=0; place=places[i]; i++) {
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location);
                }

                map.fitBounds(bounds);
                map.setZoom(15);
            });

            google.maps.event.addListener(marker, 'position_changed', function(){
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();

                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRTORue7jdYHni5zzlQEZdayfmxLA5alc&libraries=places&callback=initAutocomplete"
            async defer></script>

@endsection