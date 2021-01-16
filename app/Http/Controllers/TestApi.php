<?php

namespace App\Http\Controllers;

use App\Allowance;
use App\Attendance;
use App\Company;
use App\Employee;
use App\Nationality;
use App\Role;
use App\Scopes\ParentScope;
use App\WorkShift;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestApi extends Controller
{
    public function getData()
    {

        $employees = Employee::withoutGlobalScope(new ParentScope())->get();
//        $oldEmployees = $this->callAPI('GET', 'https://cashuce.com/public/api/employees');
        foreach ($employees as $employee){
            if($employee->nationality_id == 1){
                $employee->nationality_id = 3;
                $employee->save();
            }elseif($employee->nationality_id == 1){
                $employee->nationality_id = 4;
                $employee->save();
            }
        }
        dd('done');

    }

    function callAPI($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
}
//        foreach (json_decode($oldEmployees) as $oldEmployee) {
//            $newEmployees = Employee::withoutGlobalScope(new ParentScope())->get();
//            foreach ($newEmployees as $newEmployee) {
//                if($newEmployee->job_number == $oldEmployee->job_number){
//                    foreach ($oldEmployee->attendances as $attendance) {
//                        Attendance::create([
//                            'employee_id' => $newEmployee->id,
//                            'company_id' => $newEmployee->company_id,
//                            'time_in' => $attendance->time_in,
//                            'time_out' => $attendance->time_out,
//                            'time_in2' => $attendance->time_in2,
//                            'time_out2' => $attendance->time_out2,
//                            'total_working_hours' => $attendance->total_working_hours,
//                            'date' => $attendance->date,
//                            'day_off' => $attendance->day_off,
//                        ]);
//                    }
//                }
//            }
//
//        }