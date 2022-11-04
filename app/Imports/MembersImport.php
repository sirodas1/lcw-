<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;

class MembersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ((!isset($row[0])) || ($row[0] == 'Firstname')) {
            return null;
        }

        return new Member([
            'firstname' => $row[0], 
            'lastname' => $row[1], 
            'othername' => $row[2], 
            'title' => $row[3], 
            'position' => $row[4], 
            'gender' => $row[5], 
            'dob' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]), 
            'marital_status' => $row[7], 
            'previous_church_bg' => $row[8], 
            'phone_number' => $row[9], 
            'whatsapp_number' => $row[10], 
            'occupation' => $row[11], 
            'location' => $row[12], 
            'invited_by' => $row[13], 
            'any_relations' => $row[14], 
            'baptized' => ($row[15] == 'Yes')? true : false, 
            'foundation_sch_status' => true, 
            'sld_subscription' => ($row[16] == 'Yes')? true : false,
        ]);
    }
}
