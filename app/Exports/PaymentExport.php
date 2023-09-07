<?php

namespace App\Exports;

use Faker\Core\Number;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PaymentExport implements FromView , WithColumnWidths , WithMapping , WithColumnFormatting
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function view(): View
    {
        return view('dashboard.excel', $this->data);
    }

    public function columnWidths(): array
    {
    return [
        'A' => 15,
        'B' => 20, 
        'C' => 15, 
        'D' => 15, 
        'E' => 15, 
    ];
    }

    public function columnFormats(): array
    {
    return [
        'E' => 'Rp#,##0.00_-',
    ];
    }

    public function map($success): array
    {
        return [
            $success->order_id,
            $success->email,
            $success->no_telp,
            $success->qty . ' Tiket',
            $success->total
        ];
    }
}
