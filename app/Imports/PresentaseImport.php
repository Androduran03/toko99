<?php

namespace App\Imports;


use App\Models\presentase;
use Maatwebsite\Excel\Concerns\ToModel;

class PresentaseImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new presentase([
            'keterangan'=>$row[1],
            'X'=>$row[2],
            'Y'=>$row[3],

        ]);
       

    }
}
