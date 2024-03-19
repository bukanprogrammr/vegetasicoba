@extends('layouts.backend')

@section('content')

    <div class="col-md-12">
      @if (session('pesan'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i>{{ session('pesan') }}</h5>
      </div>
      @endif
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Data {{ $title }}</h3>

          <div class="card-tools">
            <a href="/level/create" type="button" class="btn btn-primary btn-sm text-light"><i class="fas fa-plus"></i>
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
                        <th>level</th>
                        <th width="10px">Gambar</th>
                        <th width="10px">Warna</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                  @foreach ($level as $data)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->nama_level }}</td>
                        <td><img src="{{ asset('storage/' . $data->icon) }}" class="img-fluid"></td>
                        <td style="background-color: {{ $data->warna }}" >{{ $data->warna }}</td>
                        <td class="text-center">
                          <a href="/level/edit/{{ $data->id_level }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                          <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_level }}"><i class="fas fa-trash"></i> Delete</button>
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
    @foreach ($level as $data)
      <div class="modal fade" id="delete{{ $data->id_level }}">
        <div class="modal-dialog">
        <div class="modal-content bg-danger">
        <div class="modal-header">
        <h4 class="modal-title">level {{ $data->nama_level }} akan dihapus</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <p>Apakah anda yakin?</p>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
        <a href="/level/delete/{{ $data->id_level }}" class="btn btn-outline-light">Ya</a>
        </div>
        </div>
        
        </div>
        
        </div>
    @endforeach

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

@endsection
