<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KecModel extends Model
{
    // panggil semua data di database
    public function AllData()
    {
        return DB::table('tbl_kec')
            ->get();
    }

    // simpan ke database
    public function InsertData($data)
    {
        DB::table('tbl_kec')
            ->insert($data);
    }

    // ambil data dari database ke form update
    public  function DetailData($id_kec)
    {
        return DB::table('tbl_kec')
            ->where('id_kec', $id_kec)
            ->first();
    }

    // update ke databse
    public function UpdateData($id_kec, $data)
    {
        DB::table('tbl_kec')
            ->where('id_kec', $id_kec)
            ->update($data);
    }

    // hapus ke databse
    public function DeleteData($id_kec)
    {
        DB::table('tbl_kec')
            ->where('id_kec', $id_kec)
            ->delete();
    }
}
