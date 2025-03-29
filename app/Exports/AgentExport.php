<?php

namespace App\Exports;

use App\Models\UserInformation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AgentExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function query()
    {
        return UserInformation::query()
        ->select([
            'employee_number',
            'first_name',
            'middle_name',
            'last_name',
            'position',
            'station',
            'field_coordinator',
            'address'
        ])
        ->where('is_agent', 1);
    }

    public function headings(): array
    {
        return [
            'ID No.',
            'First Name',
            'Middle Name',
            'Last Name',
            'Position',
            'Station',
            'Field Coordinator',
            'Address'
        ];
    }

    public function map($data): array
    {
        return [
            $data->employee_number,
            $data->first_name,
            $data->middle_name,
            $data->last_name,
            $data->position,
            $data->station,
            $data->field_coordinator,
            $data->address
        ];
    }
}