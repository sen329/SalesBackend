<?php

namespace App\Exports;

use App\report;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class reportUsers implements FromQuery
{
    use Exportable;

    public function __construct(int $by_userId)
    {
        $this->by_userId = $by_userId;
    }


    public function query()
    {
        return report::query()->whereBy_userid('by_userId', $this->by_userId);
    }
}
