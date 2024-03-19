@extends('layouts.backend')

@section('content')

<!-- right column -->
<div class="col-md-12">
  <!-- general form elements disabled -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Form {{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="/vegetasi/input" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Nama vegetasi</label>
              <input name="nama_vegetasi" type="text" class="form-control" placeholder="Nama vegetasi ..." value="{{ old('nama_vegetasi') }}" required>
              @error('nama_vegetasi') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Level</label>
              <select name="id_level" class="form-control" required>
                <option value="">-- Pilih Level --</option>
                @foreach ($level as $data)
                <option value="{{ $data->id_level }}" {{ old('id_level') == $data->id_level ? 'selected' : null }}>{{ $data->nama_level }}</option>
                @endforeach
              </select>
              @error('id_level') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <option value="Milik Umum" {{ old('status') == "Milik Umum" ? 'selected' : null }}>-- Milik Umum --</option>
                <option value="Milik Pribadi" {{ old('status') == "Milik Pribadi" ? 'selected' : null }}>-- Milik Pribadi --</option>
              </select>
              @error('id_level') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Kecamatan</label>
              <select name="id_kec" id="mySelect" class="form-control" required>
                <option value="">-- Pilih Kecamatan --</option>
                @foreach ($kecamatan as $data)
                <option value="{{ $data->id_kec }}" {{ old('id_kec') == $data->id_kec ? 'selected' : null }}>{{ $data->nama_kec }}</option>
                @endforeach
              </select>
              @error('id_level') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Alamat</label>
              <input name="alamat" type="text" class="form-control" placeholder="Alamat ..." value="{{ old('alamat') }}" required>
              @error('alamat') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Koordinat</label>
              <input name="koordinat" id="koordinat" type="text" class="form-control" placeholder="Latitude, Longitude ..." value="{{ old('koordinat') }}" required readonly>
              @error('koordinat') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="foto">Foto</label>
              <input name="foto" type="file" id="foto" class="form-control" onchange="previewImage()" accept="image/jpeg,image/png" value="{{ old('foto') ?? old('foto') }}" required>
              <img class="img-preview img-fluid mb-3 col-sm-5" value="{{ old('foto') ?? "foto" }}">
              @error('foto') <small class="text-danger">{{ $message }}</small>@enderror
              <!-- /.input group -->
            </div>      
          </div>
        </div>
        <div class="col-sm-10 mx-auto">
        <div class="card">
          <div class="card-body">
            <div class="mx-auto" id="map" style="width: 100%; height: 350px;"></div>
             </div>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="5" placeholder="Deskripsi ..." required></textarea>
              @error('deskripsi') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>

        
        <div class="row">
          <div class="col-sm-12">
              <!-- textarea -->

              <button type="submit" class="btn btn-primary float-right mr-4"><i class="fa fa-save"></i> Simpan</button>
              {{-- <button href="/vegetasi" class="btn btn-danger float-right">Batal</button> --}}

        </div>
        </form>
      </div>
    </div>
</div>
</div>

<!-- /.card -->

{{-- custom warna --}}
<script>
  //color picker with addon
  $('.my-colorpicker2').colorpicker();
  $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    // preview foto
    function previewImage(){
          const foto = document.querySelector('#foto');
          const imgPreview = document.querySelector('.img-preview');

          imgPreview.style.dispaly = 'block';

          const oFReader = new FileReader();
          oFReader.readAsDataURL(foto.files[0]);
          
          oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
          }
        }

    // map
    var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={{env("MAPBOX_KEY") }}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
        });

        var peta3 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={{env("MAPBOX_KEY") }}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/satellite-v9'
        });


        var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={{env("MAPBOX_KEY") }}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/dark-v10'
        });

        @foreach ($kecamatan as $data)
            var data{{ $data->id_kec }} = L.layerGroup();
            @endforeach

        
        var map = L.map('map', {
                center: [0.5322674414836351, 123.05802287121205],
                zoom: 12,
                layers: [peta1, 
                @foreach ($kecamatan as $data)
                data{{ $data->id_kec }},
                @endforeach
            ]
            });

        // opsi ceklis map
        var baseMaps = {
                "Streets": peta1, 
                "Graycale": peta2,
                "Satelite": peta3,
                "Dark": peta4,
            };
            
        
        // mengambil koordinat (latitude, longitude)
        var curLocation = [0.5322674414836351, 123.05802287121205];
        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation,{
          draggable : 'true',
        });
        map.addLayer(marker);

        // drag and drop marker
        marker.on('dragend', function(event){
          var position = marker.getLatLng();
          marker.setLatLng(position, {
            draggable : 'true',
          }).bindPopup(position).update();
          // console.log(position.lat + "," + position.lng);
          $("#koordinat").val(position.lat + ", " + position.lng).keyup();  
        });

        // klik marker
        var koordinat = document.querySelector("[name=koordinat]");
        map.on("click", function(event){
          var lat = event.latlng.lat;
          var lng = event.latlng.lng;
          
          if(!marker){
          marker = L.marker(event.latlng).addTo(map);
        }
        else{
          marker.setLatLng(event.latlng);
        }

        koordinat.value = lat + ", " + lng;
        });


        
        
        var overlayer = {
          @foreach ($kecamatan as $data)
          "{{ $data->nama_kec }}" : data{{ $data->id_kec }},
          @endforeach
        };
        
        L.control.layers(baseMaps, overlayer).addTo(map);
        

        
        var e = document.getElementById("mySelect");
        function onChange() {
          var value = e.value;
          console.log(value);
        }
        e.onchange = onChange;
        onChange()

        
        // tampil area kecamatan
        @foreach ($kecamatan as $data)
            L.geoJSON(<?= $data->geojson ?>,{
                style : {
                    color : 'black',
                    fillColor : '{{ $data->warna }}',
                    fillOpacity : 0.7
                }
            }).addTo(data{{ $data->id_kec }})
            // .bindPopup("{{ $data->nama_kec }}");
            @endforeach

            
  </script>


@endsection

