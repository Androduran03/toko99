<?php

namespace App\Imports;

use App\Models\Datatraining;
use App\Models\knn;
use Maatwebsite\Excel\Concerns\ToModel;

class TrainingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Datatraining([
            'produk_id'=>$row[0],
            'keterangan'=>$row[1],
            'bulan'=>$row[2],
            'jml_penjualan'=>$row[3],
        
        ]);
       

    }
}
