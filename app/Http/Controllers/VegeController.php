<?php

namespace App\Http\Controllers;

use App\Models\VegeModel;
use App\Models\LevModel;
use App\Models\KecModel;

use Illuminate\Http\Request;

class VegeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->VegeModel = new VegeModel();
        $this->LevModel = new LevModel();
        $this->KecModel = new KecModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Vegetasi',
            'vegetasi' => $this->VegeModel->AllData(),
        ];
        return view('admin.sawah.index', $data);
    }

    // tambah data vegetasi
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Vegetasi',
            'vegetasi' => $this->VegeModel->AllData(),
            'level' => $this->LevModel->AllData(),
            'kecamatan' => $this->KecModel->AllData(),
            // 'kecamatan1' => $this->MapModel->Data1(),
        ];
        return view('admin.vegetasi.create', $data);
    }

    // validasi dan simpan
    public function input(Request $request)
    {
        // return $request->file('foto')->store('foto');
        Request()->validate(
            [
                'nama_vegetasi' => 'required',
                'id_level' => 'required',
                'status' => 'required',
                'id_kec' => 'required',
                'alamat' => 'required',
                'koordinat' => 'required',
                'foto' => 'required|image|file|max:1024',
                'deskripsi' => 'required',
            ],
            [
                'nama_vegetasi.required' => 'Nama Vegetasi Wajib Diisi!!!',
                'id_level.required' => 'level Wajib Diisi!!!',
                'status.required' => 'Status Wajib Diisi!!!',
                'id_kec.required' => 'Kecamatan Wajib Diisi!!!',
                'alamat.required' => 'Alamat Wajib Diisi!!!',
                'koordinat.required' => 'Koordinat Wajib Diisi!!!',
                'foto.required' => 'Foto Wajib Diisi!!!',
                'deskripsi.required' => 'Deskripsi Wajib Diisi!!!',
            ]
        );

        // ambil file
        // $file = Request()->foto;
        // $filename = $file->getClientOriginalName();
        // $file->move(public_path('foto'), $filename);

        // $filename = $request->file('foto')->store('foto');

        // jika lolos validasi maka simpan database 
        // jika
        $data = [
            'nama_vegetasi' => Request()->nama_vegetasi,
            'id_level' => Request()->id_level,
            'status' => Request()->status,
            'id_kec' => Request()->id_kec,
            'alamat' => Request()->alamat,
            'koordinat' => Request()->koordinat,
            'foto' => $request->file('foto')->store('foto'),
            'deskripsi' => Request()->deskripsi,
        ];
        // maka

        $this->VegeModel->InsertData($data);
        return redirect()->route('vegetasi')->with('pesan', 'Data Berhasil Ditambahkan!!!');
    }

    public function edit($id_vegetasi)
    {
        $data = [
            'title' => 'Edit Data Vegetasi',
            'vegetasi' => $this->VegeModel->DetailData($id_vegetasi),
            'level' => $this->LevModel->AllData(),
            'kecamatan' => $this->KecModel->AllData(),
        ];
        return view('admin.vegetasi.edit', $data);
    }

    public function update(Request $request, $id_vegetasi)
    {
        Request()->validate(
            [
                'nama_vegetasi' => 'required',
                'id_level' => 'required',
                'status' => 'required',
                'id_kec' => 'required',
                'alamat' => 'required',
                'koordinat' => 'required',
                'foto' => 'image|file|max:1024',
                'deskripsi' => 'required',
            ],
            [
                'nama_vegetasi.required' => 'Nama Vegetasi Wajib Diisi!!!',
                'id_level.required' => 'level Wajib Diisi!!!',
                'status.required' => 'Status Wajib Diisi!!!',
                'id_kec.required' => 'Kecamatan Wajib Diisi!!!',
                'alamat.required' => 'Alamat Wajib Diisi!!!',
                'koordinat.required' => 'Koordinat Wajib Diisi!!!',
                'deskripsi.required' => 'Deskripsi Wajib Diisi!!!',
            ]
        );

        if (Request()->foto <> "") {
            // hapus ikon lama
            $vegetasi = $this->VegeModel->DetailData($id_vegetasi);
            if ($vegetasi->foto <> "") {
                unlink(public_path('storage') . '/' . $vegetasi->foto);
            }

            // ambil file jika foto tidak kosong
            // $file = Request()->foto;
            // $filename = $file->getClientOriginalName();
            // $file->move(public_path('foto'), $filename);

            // $filename = $request->file('foto')->store('foto');

            // jika lolos validasi maka simpan database 
            // jika ganti foto
            $data = [
                'nama_vegetasi' => Request()->nama_vegetasi,
                'id_level' => Request()->id_level,
                'status' => Request()->status,
                'id_kec' => Request()->id_kec,
                'alamat' => Request()->alamat,
                'koordinat' => Request()->koordinat,
                'foto' => $request->file('foto')->store('foto'),
                'deskripsi' => Request()->deskripsi,
            ];
            // maka
            $this->VegeModel->UpdateData($id_vegetasi, $data);
        } else {
            // jika lolos validasi maka simpan database 
            // jika tidak ganti foto
            $data = [
                'nama_vegetasi' => Request()->nama_vegetasi,
                'id_level' => Request()->id_level,
                'status' => Request()->status,
                'id_kec' => Request()->id_kec,
                'alamat' => Request()->alamat,
                'koordinat' => Request()->koordinat,
                'deskripsi' => Request()->deskripsi,
            ];
            // maka
            $this->VegeModel->UpdateData($id_vegetasi, $data);
        }
        return redirect()->route('vegetasi')->with('pesan', 'Data Berhasil Diperbarui!!!');
    }

    public function delete($id_vegetasi)
    {
        $vegetasi = $this->VegeModel->DetailData($id_vegetasi);
        if ($vegetasi->foto <> "") {
            unlink(public_path('storage') . '/' . $vegetasi->foto);
            $this->VegeModel->DeleteData($id_vegetasi);
        }
        return redirect()->route('vegetasi')->with('pesan', 'Data Berhasil Dihapus!!!');
    }
}
