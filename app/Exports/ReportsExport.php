<?php

namespace App\Exports;

use App\report;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportsExport implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents 
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        // return report::all()->except(['sales_id'],['order_id'],['by_userId'],['product_id']);
        return report::query()->select([
            'id',
            'SalesName',
            'branch',
            'nolang',
            'CustomerName',
            'CustomerAddress',
            'ContactPerson',
            'CustomerContact',
            'ProductCode',
            'ProductName',
            'ProductPrice',
            'LKPP',
            'ProposedPrice',
            'Quantity',
            'Margin',
            'Total',
            'Accepted',
            'Status',
            'RecommendedPrice',
            'stock',
            'TotalRecommendedPrice',
            'created_at',
            'updated_at'

        ]);
    }

    public function headings(): array
    {
        return [
            'id',
            'Sales Name',
            'Branch',
            'Nolang',
            'Customer Name',
            'Customer Address',
            'Contact Person',
            'Phone number',
            'Product number',
            'Product name',
            'COGS',
            'LKPP',
            'Proposed Price',
            'Quantity',
            'Margin',
            'Total',
            'Accepted',
            'Status',
            'Recommended Price',
            'Keterangan',
            'Total Recommended Price',
            'Created at',
            'Updated at'

        ];
    }

    public function registerEvents(): array
{
    return [
        AfterSheet::class    => function(AfterSheet $event) {
            // All headers - set font size to 14
            $cellRange = 'A1:Y1'; 
            $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

            
           
            // Set first row to height 20
            $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);
        },
    ];
}

}
