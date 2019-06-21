<?php

namespace App\Imports;

use App\product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new product([
            'ProductNumber'=> $row[0],
            'Productname'=> $row[1],
            'COGS'=> $row[2],
            'LKPP'=>$row[3],
        ]);
    }
}
