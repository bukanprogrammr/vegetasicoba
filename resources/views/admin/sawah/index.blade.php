@extends('layouts.backend')

@section('content')

<div class="col-md-12">
  @if (session('pesan'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i>{{ session('pesan') }}</h5>
  </div>
  @endif
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Data {{ $title }}</h3>

      <div class="card-tools">
        <a href="/sawah/create" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
          Data
        </a>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <table id="tabel1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="30px">No</th>
            <th>Vegetasi</th>
            <th>Level</th>
            <th>Status</th>
            <th>Kecamatan</th>
            <th width="100px">Foto</th>
            <th width="116px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @foreach ($vegetasi as $data)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nama_vegetasi }}</td>
            <td>{{ $data->nama_level }}</td>
            <td>{{ $data->status }}</td>
            <td>{{ $data->nama_kec }}</td>
            <td><img src="{{ asset('storage/' . $data->foto) }}" class="img-fluid"></td>
            <td class="text-center">
              <a href="/sawah/edit/{{ $data->id_vegetasi }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
              <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_vegetasi }}"><i class="fas fa-trash"></i> Delete</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>

{{-- konfirmasi hapus --}}
@foreach ($vegetasi as $data)
<div class="modal fade" id="delete{{ $data->id_vegetasi }}">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">sawah {{ $data->nama_vegetasi }} akan dihapus</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
        <a href="/sawah/delete/{{ $data->id_vegetasi }}" class="btn btn-outline-light">Ya</a>
      </div>
    </div>

  </div>

</div>
@endforeach

<script>
  $(function() {
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

@endsection