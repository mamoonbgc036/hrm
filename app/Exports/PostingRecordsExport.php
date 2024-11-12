<?php

namespace App\Exports;

use App\Models\PostingRecord;
use DateTime;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PostingRecordsExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function collection()
    {
        return PostingRecord::with(['employee','grade','designation','station'])->get();
    }

    public function headings(): array
    {
        return [
            'Employee Name', 'Old PIN', 'New PIN', 'Office/Station', 'Designation', 'From Date', 'To Date', 'Duration', 'Type'
        ];
    }

    public function map($row): array
    {
        $type = '-';
        if($row->type == 'transfer')
            $type = 'TRANSFER';
        elseif($row->type == 'promotion'){
            $type = 'PROMOTION';
        }
        elseif($row->type == 'both'){
            $type = 'PROMOTION & TRANSFER';
        }
        elseif($row->type == 'joined'){
            $type = 'JOINED';
        }
        elseif($row->type == 'administrative_transfer'){
            $type = 'Administrative Transfer';
        }
        elseif($row->type == 'end_of_service'){
            $type = 'End of Service';
        }
        elseif($row->type == 'attachment'){
            $type = 'Attachment';
        }

        $duration = '';
        $origin = new DateTime($row->from_date);
        $target = new DateTime($row->to_date);
        $interval = $origin->diff($target);

        if ($interval->y < 2){
            $year = $interval->y.' Year';
        } else {
            $year = $interval->y.' Years';
        }

        if ($interval->m < 2){
            $month = $interval->m.' Month';
        } else {
            $month = $interval->m.' Months';
        }

        $interval->d = $interval->d+1;
        if ($interval->d < 2){
            $day = $interval->d.' Day';
        } else {
            $day = $interval->d.' Days';
        }

        if($interval->y == 0 && $interval->m == 0){
            $duration = $day;
        } else if($interval->y == 0){
            $duration = $month.', '.$day;
        }else {
            $duration = $year.', '.$month.', '.$day;
        }

        $rows = [
            @$row->employee->name,
            @$row->employee->pin_no,
            @$row->employee->new_pin,
            @$row->station->name.' ['.@$row->station->code.']',
            @$row->designation->bn_name,
            @$row->from_date ? date('d-m-Y', strtotime($row->from_date)) : '',
            @$row->to_date ? date('d-m-Y', strtotime($row->to_date)) : '',
            $duration,
            $type,
        ];

        return $rows;
    }
}
