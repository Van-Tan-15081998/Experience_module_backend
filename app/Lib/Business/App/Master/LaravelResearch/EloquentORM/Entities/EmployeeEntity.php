<?php

namespace App\Lib\Business\App\Master\LaravelResearch\EloquentORM\Entities;

use App\Lib\Business\App\Master\LaravelResearch\EloquentORM\Models\EmployeeModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class EmployeeEntity extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'full_name',
        'birthday',
        'gender_code',
        'email_address',
        'phone_number',
        'department_code',
        'department_name'
    ];

    protected $table = 'laravel_research__employees';
    protected $primaryKey = 'employee_id';

    public function getById(int $employeeId) : EmployeeModel {
//        $result = $this->findOrFail($employeeId); // [OK]
        $result = DB::table('laravel_research__employees')
            ->join('laravel_research__departments', 'laravel_research__employees.department_code', '=', 'laravel_research__departments.department_id')
            ->select(
                'laravel_research__employees.employee_id',
                'laravel_research__employees.full_name',
                'laravel_research__employees.birthday',
                'laravel_research__employees.gender_code',
                'laravel_research__employees.email_address',
                'laravel_research__employees.phone_number',
                'laravel_research__employees.department_code',
                DB::raw('laravel_research__departments.name as department_name'))->get();

        dd($result);
//        dd(EmployeeModel::createFromRecord($result));

        return EmployeeModel::createFromRecord($result);
    }
}
