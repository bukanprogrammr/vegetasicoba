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
      <form action="/kecamatan/input" method="POST">
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
              <label>Kecamatan</label>
              <input name="kecamatan" type="text" class="form-control" placeholder="Nama Kecamatan ..." required>
              @error('kecamatan') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
            <label>Warna</label>
            <div class="input-group my-colorpicker2">
                <input name="warna" type="text" class="form-control" required>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square"></i></span>
                </div>
              </div>
              @error('warna') <small class="text-danger">{{ $message }}</small>@enderror
              <!-- /.input group -->
             </div>      
            </div>
          </div>
        <div class="row">
          <div class="col-sm-12">
            <!-- textarea -->
            <div class="form-group">
              <label>Geojson</label>
              <textarea name="geojson" rows="6" class="form-control" rows="3" placeholder="Script Geojson ..." required></textarea>
              @error('geojson') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
              <!-- textarea -->

            {{-- <button href="/kecamatan" class="btn btn-danger float-right">Batal</button> --}}
            <button type="submit" class="btn btn-primary float-right mr-4"><i class="fa fa-save"></i> Simpan</button>

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
  </script>

@endsection

