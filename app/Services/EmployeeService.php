<?php


namespace App\Services;


use App\Models\Department;
use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmployeeService
{
    public static function getEmployees($department, $perPage): LengthAwarePaginator
    {
        $query = $department
            ? $department->employees()
            : Employee::with('department:id,name');

        return $query->paginate($perPage)->withQueryString();
    }

    public static function importEmployees($data)
    {
        foreach ($data as $department)
        {
            $newDepartment = Department::create(['name' => $department['department']]);

            $employees = [];

            foreach ($department['employees'] as $employee)
            {
                $employees[] = [
                    'first_name' =>   $employee['firstName'],
                    'last_name' =>   $employee['lastName'],
                    'birth_date' =>   $employee['birthDate'],
                    'position' =>   $employee['position'],
                    'payment_type' =>   $employee['paymentType'],
                    'payment_amount' =>   $employee['paymentAmount'],
                ];
            }

            $newDepartment->employees()->createMany($employees);
        }
    }


//    public static function getEmployees($department, $perPage): LengthAwarePaginator
//    {
//        $hourSelect = WorkHour::select(DB::raw('employee_id, SUM(hours) as hours'))->groupBy('employee_id');
//
//        $query = $department
//            ? $department->employees()
//            : Employee::with('department:id,name');
//
//        return $query
//            ->leftJoinSub($hourSelect, 'whs', function ($join) {
//                $join->on('employees.id', '=', 'whs.employee_id');
//            })
//            ->paginate($perPage)->withQueryString();
//
//    }
}
