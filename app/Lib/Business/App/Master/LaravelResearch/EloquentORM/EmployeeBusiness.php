<?php

namespace App\Lib\Business\App\Master\LaravelResearch\EloquentORM;

use App\Lib\Business\App\Master\LaravelResearch\EloquentORM\Entities\EmployeeEntity;
use App\Lib\Business\App\Master\LaravelResearch\EloquentORM\Models\EmployeeModel;
use App\Lib\Business\Base\ExperienceBaseBusiness;

class EmployeeBusiness extends ExperienceBaseBusiness
{
    private EmployeeEntity $employeeEntity;

    public function __construct()
    {
        parent::__construct();
        $this->employeeEntity = new EmployeeEntity();
    }

    public function getById(int $employeeId) : EmployeeModel {
        return $this->employeeEntity->getById($employeeId);
    }
}
