<?php

namespace App\Imports;

use App\Models\Datatraining;
use App\Models\prediksi;
use Maatwebsite\Excel\Concerns\ToModel;

class PrediksiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new prediksi([
            'keterangan'=>$row[0],
            'bulan'=>$row[1],
            'jml_penjualan'=>$row[2],

        ]);
       

    }
}
