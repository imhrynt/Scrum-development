<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportsExport implements
    FromArray,
    WithHeadings {
    protected $reports;

    public function __construct(array $reports)
    {
        $this->reports = $reports;
    }

    public function array(): array
    {
        return $this->reports;
    }

    public function headings(): array
    {
        return [
            'id',
            'user_id',
            'latitude',
            'longitude',
            'information',
            'created_at',
            'updated_at',
        ];

    }
}
