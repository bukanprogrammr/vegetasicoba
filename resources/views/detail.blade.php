@extends('layouts.frontend')
@section('content')

<div class="text-center">
    <h1>
        {{ $title }}
    </h1>
</div>
<div class="row mt-4">
    <div class="col-lg-5">
    <div class="card" >
<div class="card-header bg-dark text-light">
    Lokasi
    <div class="card-tools">
        <button type="button" class="btn btn-dark btn-sm" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
        </button>
        </div>
</div>
<div class="card-body">
        <div id="map" style="width: 100%; height: 500px;"></div>
    </div>
</div>
</div>

<div class="col-lg-7 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-description font-weight-bold">
          Basic table with card
        </p>
          <img src="{{ asset('storage/' . $vege->foto) }}" class=" rounded" >
      </div>
    </div>

    <div class="card" >
      <div class="card-body">
        <p class="card-description font-weight-bold">
          Basic table with card
        </p>

          <table class="table" >
              <tr>
                <th>Nama</th>
                <th>:</th>
                <th>{{ $vege->nama_vegetasi }}</th>
              </tr>
              <tr>
                <th>Nama</th>
                <th>:</th>
                <th>{{ $vege->nama_level }}</th>
              </tr>
              <tr>
                <th>Status</th>
                <th>:</th>
                <th>{{ $vege->status }}</th>
              </tr>
              <tr>
                <th>Alamat</th>
                <th>:</th>
                <th>{{ $vege->alamat }}</th>
              </tr>
          </table>
        </div>
      </div>
  </div>

</div>
<div class="row">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Deskripsi
                
            </div>
            <div class="card-body" style="width: 100%; height: 100%;">
                {{ $vege->deskripsi }}
                </div>
                
            </div>
        </div>
</div>
    <script>
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
        
        // var peta5 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //     maxZoom: 19,
            //     attribution: '© OpenStreetMap'
            // });

            @foreach ($kecamatan as $data)
            var data{{ $data->id_kec }} = L.layerGroup();
            @endforeach


            var map = L.map('map', {
                center: [0.5322674414836351, 123.05802287121205],
                zoom: 13,
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
            
            var overlayer = {
                @foreach ($kecamatan as $data)
                "{{ $data->nama_kec }}" : data{{ $data->id_kec }},
                @endforeach
            };
            
            L.control.layers(baseMaps, overlayer).addTo(map);
            
            // tampil area kecamatan
            @foreach ($kecamatan as $data)
            var lpp = L.geoJSON(<?= $data->geojson ?>,{
                style : {
                    color : 'black',
                    fillColor : '{{ $data->warna }}',
                    fillOpacity : 0.7
                }
            }).addTo(data{{ $data->id_kec }}).bindPopup("{{ $data->nama_kec }}");
            @endforeach

            // tampil koordinat sekolah
            // icon
            var myIcon = L.icon({
            iconUrl: '{{ asset('storage/' . $vege->icon) }}',
            iconSize: [38, 38],
            });

            var popup = '{{ $vege->nama_vegetasi }}'
            L.marker ([<?= $vege->koordinat ?>],{icon: myIcon}).addTo(map)
            .bindPopup(popup);
            map.setView([{{ $vege->koordinat }}], 15);

            
                        </script>


@endsection
