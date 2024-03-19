<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevModel;
use Laravel\Ui\Presets\React;

class LevController extends Controller
{
    /**
     * Create a new controller instance.
     *

     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->LevModel = new LevModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Level',
            'level' => $this->LevModel->AllData(),
        ];
        return view('admin.level.index', $data);
    }

    // tambah data level
    public function create()
    {
        $data = [
            'title' => 'Tambah Data level',
            'level' => $this->LevModel->AllData(),
        ];
        return view('admin.level.create', $data);
    }

    // validasi dan simpan
    public function input(Request $request)
    {
        // return $request->file('icon')->store('icon');
        Request()->validate(
            [
                'level' => 'required',
                'icon' => 'required|image|file|max:1024',
                'warna' => 'required',
            ],
            [
                'level.required' => 'Nama level Wajib Diisi!!!',
                'icon.required' => 'icon level Wajib Diisi!!!',
                'warna.required' => 'Warna Area level Wajib Diisi!!!',
            ]
        );

        // ambil file
        // $file = Request()->icon;
        // $filename = $file->getClientOriginalName();
        // $file->move(public_path('icon'), $filename);

        // $filename = $request->file('icon')->store('icon');

        // jika lolos validasi maka simpan database 
        // jika
        $data = [
            'nama_level' => Request()->level,
            'icon' => $request->file('icon')->store('icon'),
            'warna' => Request()->warna,
        ];
        // maka

        $this->LevModel->InsertData($data);
        return redirect()->route('level')->with('pesan', 'Data Berhasil Ditambahkan!!!');
    }

    // edit data level
    public function edit($id_level)
    {
        $data = [
            'title' => 'Edit Data level',
            'level' => $this->LevModel->DetailData($id_level),
        ];
        return view('admin.level.edit', $data);
    }

    // validasi dan update
    public function update(Request $request, $id_level)
    {
        Request()->validate(
            [
                'level' => 'required',
                'icon' => 'image|file|max:1024',
                'warna' => 'required',

            ],
            [
                'level.required' => 'Nama level Wajib Diisi!!!',
                'warna.required' => 'Warna Area level Wajib Diisi!!!',
                'icon.required' => 'Icon Area level Wajib Diisi!!!'
            ]
        );

        if (Request()->icon <> "") {
            // hapus ikon lama
            $level = $this->LevModel->DetailData($id_level);
            if ($level->icon <> "") {
                unlink(public_path('storage') . '/' . $level->icon);
            }

            // ambil file jika icon tidak kosong
            // $file = Request()->icon;
            // $filename = $file->getClientOriginalName();
            // $file->move(public_path('icon'), $filename);

            // $filename = $request->file('icon')->store('icon');

            // jika lolos validasi maka simpan database 
            // jika ganti icon
            $data = [
                'nama_level' => Request()->level,
                'icon' => $request->file('icon')->store('icon'),
                'warna' => Request()->warna,
            ];
            // maka
            $this->LevModel->UpdateData($id_level, $data);
        } else {
            // jika lolos validasi maka simpan database 
            // jika tidak ganti icon
            $data = [
                'nama_level' => Request()->level,
                'warna' => Request()->warna,
            ];
            // maka
            $this->LevModel->UpdateData($id_level, $data);
        }
        return redirect()->route('level')->with('pesan', 'Data Berhasil Diperbarui!!!');
    }

    public function delete($id_level)
    {
        $level = $this->LevModel->DetailData($id_level);
        if ($level->icon <> "") {
            unlink(public_path('storage') . '/' . $level->icon);
            $this->LevModel->DeleteData($id_level);
        }
        return redirect()->route('level')->with('pesan', 'Data Berhasil Dihapus!!!');
    }
}
