@extends('layouts.frontend')
@section('content')
 
<div class="card">
<div class="card-header bg-dark text-light">
    {{ $title }}
</div>
<div class="card-body">
        <div id="map" style="width: 100%; height: 600px;"></div>
</div>
</div>
<br>
<div class="text-center"><h2><b>Data Vegetasi {{ $title }}</b></h2>
        <table id="tabel1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="30px">No</th>
                    <th>Vegetasi</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th width="100px">Foto</th>
                    <th width="116px" >Aksi</th>
                   </tr>
            </thead>
            <tbody>
              <?php $no=1; ?>
              @foreach ($vegetasi as $data)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nama_vegetasi }}</td>
                    <td>{{ $data->nama_level }}</td>
                    <td>{{ $data->status }}</td>
                    <td><img src="{{ asset('storage/' . $data->foto) }}" class="img-fluid"></td>
                    <td class="text-center">
                      <a href="/vegetasi/edit/{{ $data->id_vegetasi }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                      <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_vegetasi }}"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- kolom pencarian --}}
<script>
    $(function () {
      $("#tabel1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
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

            var data{{ $kec->id_kec }} = L.layerGroup();

            @foreach ($level as $data)
            var level{{ $data->id_level }} = L.layerGroup();
            @endforeach

            var map = L.map('map', {
                center: [0.5322674414836351, 123.05802287121205],
                zoom: 13,
                layers: [peta1,data{{ $kec->id_kec }},
                @foreach ($level as $data)
                level{{ $data->id_level }},
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
                "{{ $kec->nama_kec }}" : data{{ $kec->id_kec }},
                @foreach ($level as $data)
                "{{ $data->nama_level }}" : level{{ $data->id_level }},
                @endforeach
            };
            
            L.control.layers(baseMaps, overlayer).addTo(map);
            
            // tampil area kecamatan
            var kec = L.geoJSON(<?= $kec->geojson ?>,{
                style : {
                    color : 'black',
                    fillColor : '{{ $kec->warna }}',
                    fillOpacity : 0.7
                }
            }).addTo(data{{ $kec->id_kec }}).bindPopup("{{ $kec->nama_kec }}");

            map.fitBounds(kec.getBounds());

            // tampil koordinat sekolah
            @foreach ($vegetasi as $data)
            // icon
            var myIcon = L.icon({
            iconUrl: '{{ asset('storage/' . $data->icon) }}',
            iconSize: [38, 38],
            });

            var popup = '<table class="table table-bordered" style="border-collapse:collapse;border-spacing:0"><thead><tr><th font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;text-align:left;vertical-align: colspan="2"><img width="150" src="{{ asset('storage/' . $data->foto) }}"</th></tr></thead><tbody><tr><td font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:>Nama</td><td font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:>{{ $data->nama_vegetasi }}</td></tr><tr><td font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:>Level</td><td font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:>{{ $data->nama_level }}</td></tr><tr><td font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:>Status</td><td font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:>{{ $data->status }}</td></tr><tr><td align="center" colspan="2"><a href="/detail/{{ $data->id_vegetasi }}" class="btn-xs btn-success text-light">Detail</a></td></tr></tbody></table>';
            L.marker ([<?= $data->koordinat ?>],{icon: myIcon}).addTo(level{{ $data->id_level }})
            .bindPopup(popup);
            @endforeach
                        </script>

                   



@endsection