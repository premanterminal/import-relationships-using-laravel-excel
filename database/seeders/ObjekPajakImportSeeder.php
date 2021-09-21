<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Imports\ObjekPajakImport;

class ObjekPajakImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //IMPORT DATA DARI FILE CSV YANG DISIMPAN DI DALAM FOLDER DATABASE/SEEDERS
        (new ObjekPajakImport)->import(base_path('database/seeders/objek_pajak.csv'));
    }
}
