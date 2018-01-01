@extends($template)

@section('content')

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

                <h1 class="my-4">Edit Post {{$picCount}}
                </h1>

                <form action="{{ route('edit_post', ['id' => $post['id']]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        @if( $errors->has('title') || $errors->has('date') || $errors->has('type') || $errors->has('description') || $errors->has('pac-input') )
                            <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Title" value="{{ old('title') }}" required>
                        @else
                            <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Title" value="{{ $post['title'] }}" required>
                        @endif
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date">Date of incident</label>
                        @if($errors->has('title') || $errors->has('date') || $errors->has('type') || $errors->has('description') || $errors->has('pac-input'))
                            <input type="date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" id="date" name="date" required value="{{ old('date') }}">
                        @else
                            <input type="date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" id="date" name="date" required value="{{ $post['date'] }}">
                        @endif
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date">Incident Type</label>
                        <select class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type">
                            @foreach($types as $type => $icon)

                                @if($errors->has('title') || $errors->has('date') || $errors->has('type') || $errors->has('description') || $errors->has('pac-input'))
                                    @if( $type == old('type') )
                                        <option value="{{ $type }}" selected>{{ $type }}</option>
                                    @else
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endif

                                @else
                                    @if($type == $post['type'])
                                        <option value="{{ $type }}" selected>{{ $type }}</option>
                                    @else
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endif
                                @endif

                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>

                        @if($errors->has('title') || $errors->has('date') || $errors->has('type') || $errors->has('description') || $errors->has('pac-input'))
                            <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" rows="10" required>{{ old('description') }}</textarea>
                        @else
                            <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" rows="10" required>{{ $post['description'] }}</textarea>
                        @endif

                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    </div>

                    @if($user_type == 'admin')
                        <div class="form-group">
                            <label for="threat_level">Assign Threat Level</label>

                            @if($errors->has('title') || $errors->has('date') || $errors->has('type') || $errors->has('description') || $errors->has('pac-input'))
                                <input type="number" name="threat_level" id="threat_level" value="{{ old('threat_level') }}" class="form-control col-sm-3" min="1" max="10" required>
                            @else
                                <input type="number" name="threat_level" id="threat_level" value="{{ $post['threat_level'] }}" class="form-control col-sm-3" min="1" max="10" required>
                            @endif


                            <div class="invalid-feedback">
                                {{ $errors->first('threat_level') }}
                            </div>
                        </div>
                    @endif


                    <div class="form-group">
                        @if(isset($picCount) && $picCount > 0)
                            <h5>Post Images ({{ $picCount }})</h5>
                            @foreach($pictures as $picture)
                                <div class="d-inline-block" style="width: 20rem;">
                                    <img class="card-img-top" src="{{ asset("images/".$picture['original_filename']) }}" alt="Card image cap">
                                    <div class="card-body">
                                        <a href="{{ route('delete_picture', ['id' => $picture['id']] ) }}" class="btn btn-danger float-right" style="margin-bottom: 15px">Delete</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span style="color: red; font-weight: bolder;">No images uploaded for this post</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="images">Add More Pictures (if needed)</label>
                        <input type="file" class="form-control-file {{ $errors->has('images') ? ' is-invalid' : '' }}" id="images" name="images[]" accept=".jpg, .png" multiple>
                        <div class="invalid-feedback">
                            {{ $errors->first('images') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city">Select City/Town</label>
                        <select class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" id="city" name="city">
                            @foreach($cities as $city)

                                @if($errors->has('title') || $errors->has('date') || $errors->has('type') || $errors->has('description'))
                                    @if( $city == old('city') )
                                        <option value="{{ $city }}" selected>{{ $city }}</option>
                                    @else
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endif

                                @else
                                    @if($city == $post['city'])
                                        <option value="{{ $city }}" selected>{{ $city }}</option>
                                    @else
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endif
                                @endif

                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{--{{ $errors->first('province') }}--}}
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="pac-input">Please type in a location</label>

                        @if($errors->has('title') || $errors->has('date') || $errors->has('type') || $errors->has('description') || $errors->has('pac-input'))
                            <input type="text" class="form-control {{ $errors->has('pac-input') ? ' is-invalid' : '' }}" id="pac-input" name="pac-input" placeholder="Location" value="{{ old('pac-input') }}" required>
                        @else
                            <input type="text" class="form-control {{ $errors->has('pac-input') ? ' is-invalid' : '' }}" id="pac-input" name="pac-input" placeholder="Location" value="{{ $post['city'] }}" required>
                        @endif

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

                        @if($errors->has('title') || $errors->has('date') || $errors->has('type') || $errors->has('description') || $errors->has('pac-input'))
                            <input type="text" name="lat" id="lat" class="form-control" readonly value="{{ old('lat') }}">
                        @else
                            <input type="text" name="lat" id="lat" class="form-control" readonly value="{{ $post['latitude'] }}">
                        @endif

                    </div>
                    <div class="d-inline-block">
                        <label for="lng" style="margin-top: 10px;">Longitude</label>

                        @if($errors->has('title') || $errors->has('date') || $errors->has('type') || $errors->has('description') || $errors->has('pac-input'))
                            <input type="text" name="lng" id="lng" class="form-control" readonly value="{{ old('lng') }}">
                        @else
                            <input type="text" name="lng" id="lng" class="form-control" readonly value="{{ $post['longitude'] }}">
                        @endif

                    </div>
                    <div class="form-group col-6 col-md-4">

                    <input type="hidden" value="{{ $post['user_id'] }}" name="user_id" id="user_id">

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
                center: new google.maps.LatLng(document.getElementById('lat').value, document.getElementById('lng').value),
                zoom: 15
            });
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(document.getElementById('lat').value, document.getElementById('lng').value),
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