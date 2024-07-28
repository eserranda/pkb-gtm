<?php

namespace App\Imports;

use App\Models\AnggotaJemaat;
use Maatwebsite\Excel\Concerns\ToModel;

class AnggotaJemaatImport2 implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AnggotaJemaat([
            //
        ]);
    }
}
