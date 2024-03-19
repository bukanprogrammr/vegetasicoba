<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LevModel extends Model
{
    public function AllData()
    {
        return DB::table('tbl_level')
            ->get();
    }

    // simpan ke database
    public function InsertData($data)
    {
        DB::table('tbl_level')
            ->insert($data);
    }

    // ambil data dari database ke form update
    public  function DetailData($id_level)
    {
        return DB::table('tbl_level')
            ->where('id_level', $id_level)
            ->first();
    }

    // update ke databse
    public function UpdateData($id_level, $data)
    {
        DB::table('tbl_level')
            ->where('id_level', $id_level)
            ->update($data);
    }

    // hapus ke databse
    public function DeleteData($id_level)
    {
        DB::table('tbl_level')
            ->where('id_level', $id_level)
            ->delete();
    }
}
