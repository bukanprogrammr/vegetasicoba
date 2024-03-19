<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MapModel;
use App\Models\KecModel;
use App\Models\VegeModel;

class WebController extends Controller
{

    public function __construct()
    {
        $this->MapModel = new MapModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pemetaan',
            'kecamatan' => $this->MapModel->Data1(),
            'vegetasi' => $this->MapModel->AllData1(),
            'level' => $this->MapModel->Data3(),
        ];
        return view('main', $data);
    }

    public function main2($id_kec)
    {
        $kec = $this->MapModel->Detail1($id_kec);
        $data = [
            'title' => 'Kecamatan ' . $kec->nama_kec,
            'kecamatan' => $this->MapModel->Data1(),
            'vegetasi' => $this->MapModel->Data2($id_kec),
            'level' => $this->MapModel->Data3(),
            'kec' => $kec,
        ];
        return view('main2', $data);
    }

    public function detail($id_vegetasi)
    {
        $vege = $this->MapModel->Data5($id_vegetasi);
        $data = [
            'title' => 'Detail ' . $vege->nama_vegetasi,
            'kecamatan' => $this->MapModel->Data1(),
            'level' => $this->MapModel->Data3(),
            'vege' => $vege,
        ];
        return view('detail', $data);
    }

    public function main3($id_level)
    {
        $lev = $this->MapModel->Detail2($id_level);
        $data = [
            'title' => 'Level ' . $lev->nama_level,
            'kecamatan' => $this->MapModel->Data1(),
            'vegetasi' => $this->MapModel->Data4($id_level),
            'level' => $this->MapModel->Data3(),
        ];
        return view('main3', $data);
    }
}
