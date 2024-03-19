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
      <form action="/vegetasi/update/{{ $vegetasi->id_vegetasi }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Nama vegetasi</label>
              <input name="nama_vegetasi" type="text" class="form-control" placeholder="Nama vegetasi ..." required value="{{ $vegetasi->nama_vegetasi }}">
              @error('nama_vegetasi') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Level</label>
              <select name="id_level" class="form-control" required>
                <option value="{{ $vegetasi->id_level }}">{{ $vegetasi->nama_level }}</option>
                @foreach ($level as $data)
                <option value="{{ $data->id_level }}">{{ $data->nama_level }}</option>
                @endforeach
              </select>
              @error('id_level') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control" required value="{{ $vegetasi->status }}">
                <option value="{{ $vegetasi->status }}">{{ $vegetasi->status }}</option>
                <option value="Milik Umum">-- Milik Umum --</option>
                <option value="Milik Pribadi">-- Milik Pribadi --</option>
              </select>
              @error('id_level') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Kecamatan</label>
              <select name="id_kec" class="form-control" required value="{{ $vegetasi->nama_kec }}">
                <option value="{{ $vegetasi->id_kec }}">{{ $vegetasi->nama_kec }}</option>
                @foreach ($kecamatan as $data)
                <option value="{{ $data->id_kec }}">{{ $data->nama_kec }}</option>
                @endforeach
              </select>
              @error('id_level') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Alamat</label>
              <input name="alamat" type="text" class="form-control" placeholder="Alamat ..." required value="{{ $vegetasi->alamat }}">
              @error('alamat') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="text-center col-sm-4 mx-auto">
            <div class="form-group">
              <label>Koordinat</label>
              <input name="koordinat" id="koordinat" type="text" class="text-center form-control" placeholder="Latitude, Longitude ..." required value="{{ $vegetasi->koordinat }}" readonly>
              @error('koordinat') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>  
        <div class="col-sm-10 mx-auto">
        <div class="card">
          <div class="card-body">
            <div class="mx-auto" id="map" style="width: 100%; height: 350px;"></div>
             </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="9" placeholder="Deskripsi ..." required >{{ $vegetasi->deskripsi }}</textarea>
              @error('deskripsi') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="foto">Foto</label>
              <input name="foto" type="file" id="foto" class="form-control" onchange="previewImage()" accept="image/jpeg,image/png" value="{{ asset('storage/' .$vegetasi->foto) }}">
              <img src="{{ asset('storage/' .$vegetasi->foto) }}" class="img-preview img-fluid mb-3 col-sm-4">
              @error('foto') <small class="text-danger">{{ $message }}</small>@enderror
              <!-- /.input group -->
            </div>      
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
        
        var map = L.map('map', {
                center: [0.5322674414836351, 123.05802287121205],
                zoom: 12,
                layers: [peta1]
            });

        // opsi ceklis map
        var baseMaps = {
                "Streets": peta1, 
                "Graycale": peta2,
                "Satelite": peta3,
                "Dark": peta4,
            };
            
        L.control.layers(baseMaps).addTo(map); 
        
        // mengambil koordinat (latitude, longitude)
        var curLocation = [{{ $vegetasi->koordinat }}];
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

        

  </script>


@endsection

