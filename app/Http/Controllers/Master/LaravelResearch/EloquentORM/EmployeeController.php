<?php

namespace App\Http\Controllers\Master\LaravelResearch\EloquentORM;

use App\Http\Controllers\Controller;
use App\Lib\Business\App\Master\LaravelResearch\EloquentORM\EmployeeBusiness;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private EmployeeBusiness $employeeBusiness;

    public function __construct()
    {
        $this->employeeBusiness = new EmployeeBusiness();
    }

    public function getById(Request $request) {
        dd($this->employeeBusiness->getById($request->id));
    }
}
