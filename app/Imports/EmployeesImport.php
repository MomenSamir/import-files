<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EmployeesImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'emp_id'        => is_int($row['emp_id']) ? $row['emp_id'] : 0,
            'prefix_name'   => $row['name_prefix'], 
            'first_name'    => $row['first_name'], 
            'middle_name'   => $row['middle_initial'],
            'last_name'     => $row['last_name'],
            'gender'        => $row['gender'],
            'email'         => $row['e_mail'],
            'date_of_birth' => date('Y-m-d',strtotime($row['date_of_birth'])),
            'time_of_birth' => date('H:i:s', strtotime($row['time_of_birth'])),
            'age_in_yrs'    => is_float($row['age_in_yrs']) ? $row['age_in_yrs'] : null,
            'date_of_join'  => date('Y-m-d',strtotime($row['date_of_joining'])),
            'age_in_company'=> is_float($row['age_in_company_years']) ? $row['age_in_company_years'] : null,
            'phone'         => $row['phone_no'],
            'place'         => $row['place_name'],
            'country'       => $row['county'],
            'city'          => $row['city'],
            'zip'           => $row['zip'],
            'region'        => $row['region'],
            'user_name'     => $row['user_name'],
        ]);
    }


    public function chunkSize(): int
    {
        return 10000;
    }
}
