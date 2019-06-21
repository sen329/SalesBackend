<?php

namespace App\Exports;

use App\report;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return report::all()->except(['sales_id'],['order_id']);
    }
}
