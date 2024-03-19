<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VegeModel extends Model
{
    public function AllData()
    {
        return DB::table('tbl_vegetasi')
            ->join('tbl_level', 'tbl_level.id_level', '=', 'tbl_vegetasi.id_level')
            ->join('tbl_kec', 'tbl_kec.id_kec', '=', 'tbl_vegetasi.id_kec')
            ->get();
    }

    public function Data1()
    {
        return DB::table('tbl_kec')
            ->get();
    }

    // simpan ke database
    public function InsertData($data)
    {
        DB::table('tbl_vegetasi')
            ->insert($data);
    }

    // ambil data dari database ke form update
    public  function DetailData($id_vegetasi)
    {
        return DB::table('tbl_vegetasi')
            ->join('tbl_level', 'tbl_level.id_level', '=', 'tbl_vegetasi.id_level')
            ->join('tbl_kec', 'tbl_kec.id_kec', '=', 'tbl_vegetasi.id_kec')
            ->where('id_vegetasi', $id_vegetasi)
            ->first();
    }

    // update ke databse
    public function UpdateData($id_vegetasi, $data)
    {
        DB::table('tbl_vegetasi')
            ->where('id_vegetasi', $id_vegetasi)
            ->update($data);
    }

    // hapus ke databse
    public function DeleteData($id_vegetasi)
    {
        DB::table('tbl_vegetasi')
            ->where('id_vegetasi', $id_vegetasi)
            ->delete();
    }
}
