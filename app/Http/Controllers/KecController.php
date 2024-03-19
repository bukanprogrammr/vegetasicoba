<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KecModel;
use Laravel\Ui\Presets\React;

class KecController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->KecModel = new KecModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kecamatan',
            'kecamatan' => $this->KecModel->AllData(),
        ];
        return view('admin.kecamatan.index', $data);
    }

    // tambah data kecamatan
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kecamatan',
            'kecamatan' => $this->KecModel->AllData(),
        ];
        return view('admin.kecamatan.create', $data);
    }

    // validasi dan simpan
    public function input()
    {
        Request()->validate(
            [
                'kecamatan' => 'required',
                'warna' => 'required',
                'geojson' => 'required',
            ],
            [
                'kecamatan.required' => 'Nama Kecamatan Wajib Diisi!!!',
                'warna.required' => 'Warna Area Kecamatan Wajib Diisi!!!',
                'geojson.required' => 'Geojson Kecamatan Wajib Diisi!!!'
            ]
        );

        // jika lolos validasi maka simpan database 
        // jika
        $data = [
            'nama_kec' => Request()->kecamatan,
            'warna' => Request()->warna,
            'geojson' => Request()->geojson,
        ];
        // maka
        $this->KecModel->InsertData($data);
        return redirect()->route('kecamatan')->with('pesan', 'Data Berhasil Ditambahkan!!!');
    }

    // edit data kecamatan
    public function edit($id_kec)
    {
        $data = [
            'title' => 'Edit Data Kecamatan',
            'kecamatan' => $this->KecModel->DetailData($id_kec),
        ];
        return view('admin.kecamatan.edit', $data);
    }

    // validasi dan update
    public function update($id_kec)
    {
        Request()->validate(
            [
                'kecamatan' => 'required',
                'warna' => 'required',
                'geojson' => 'required',
            ],
            [
                'kecamatan.required' => 'Nama Kecamatan Wajib Diisi!!!',
                'warna.required' => 'Warna Area Kecamatan Wajib Diisi!!!',
                'geojson.required' => 'Geojson Kecamatan Wajib Diisi!!!'
            ]
        );

        // jika lolos validasi maka update database 
        // jika
        $data = [
            'nama_kec' => Request()->kecamatan,
            'warna' => Request()->warna,
            'geojson' => Request()->geojson,
        ];
        // maka
        $this->KecModel->UpdateData($id_kec, $data);
        return redirect()->route('kecamatan')->with('pesan', 'Data Berhasil Diperbarui!!!');
    }

    public function delete($id_kec)
    {
        $this->KecModel->DeleteData($id_kec);
        return redirect()->route('kecamatan')->with('pesan', 'Data Berhasil Dihapus!!!');
    }
}
