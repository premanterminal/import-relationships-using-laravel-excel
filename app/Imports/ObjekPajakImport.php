<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\ObjekPajak;
use App\Models\User;

//KITA GUNAKAN toModel KARENA PROSES QUERYNYA VIA ELOQUENT
//WithHeadingRow KARENA STRUKTUR YANG ADA PADA FILE CSV TERDAPAT HEADER
class ObjekPajakImport implements ToModel, WithHeadingRow
{
    use Importable;

    protected $users;
    public function __construct()
    {
        //QUERY UNTUK MENGAMBIL SELURUH DATA USER
        $this->users = User::select('id', 'nik')->get();
    }

    public function model(array $row)
    {
        //KEMUDIAN KITA FILTER MELALUI COLLECTION AGAR TIDAK BANYAK QUERY YANG DIJALANKAN
        //DATA YANG DICARI ADALAH DATA USER BERDASARKAN NIK KARENA YANG MENJADI FOREIGN KEY PADA SISTEM YANG LAMA ADALAH NIK DAN SISTEM BARU ADALAH ID, MAKA KEDUA DATA INI AKAN KITA KONVERSI
        $user = $this->users->where('nik', $row['nik'])->first();
        return new ObjekPajak([
            'user_id' => $user->id ?? NULL,
            'nopd' => $row['nopd'],
            'nama_usaha' => $row['nama_usaha'],
            'alamat' => $row['alamat'],
            'rt_rw' => $row['rt_rw'],
            'status' => $row['status']
        ]);
    }
}
