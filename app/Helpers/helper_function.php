<?php

use Illuminate\Support\Collection;

if(!function_exists('posting_types')){
    function posting_types(): Collection
    {
        $types = [
            'joined' => 'Joined',
            'administrative_transfer' => 'Administrative Transfer',
            'transfer' => 'Transfer',
            'promotion' => 'Promotion',
            'both' => 'Transfer & Promotion',
            'end_of_service' => 'End of Service',
            'attachment' => 'Attachment',
        ];

        return collect($types);
    }
}

if(!function_exists('financialPunishmentType')){
    function financialPunishmentType(): Collection
    {
        $types = [
            1 => 'Cash fine',
            2 => 'Promotion Hold',
            3 => 'Confirmation Hold'
        ];

        return collect($types);
    }
}