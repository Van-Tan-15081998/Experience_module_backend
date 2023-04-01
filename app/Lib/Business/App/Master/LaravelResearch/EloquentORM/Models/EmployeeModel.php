<?php

namespace App\Lib\Business\App\Master\LaravelResearch\EloquentORM\Models;

class EmployeeModel
{
    private int $employeeId;

    private string $fullName;

    private string $birthday;

    private int $genderCode;

    private string $emailAddress;

    private string $phoneNumber;

    private int $departmentCode;

    private string $departmentName;

    public function init(): void
    {
        $this->employeeId = 0;
        $this->fullName = '';
        $this->birthday = '';
        $this->genderCode = 0;
        $this->emailAddress = '';
        $this->phoneNumber = '';
        $this->departmentCode = 0;
        $this->departmentName = '';
    }

    /**
     * @return int
     */
    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    /**
     * @param int $employeeId
     */
    public function setEmployeeId(int $employeeId): void
    {
        $this->employeeId = $employeeId;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return int
     */
    public function getGenderCode(): int
    {
        return $this->genderCode;
    }

    /**
     * @param int $genderCode
     */
    public function setGenderCode(int $genderCode): void
    {
        $this->genderCode = $genderCode;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress(string $emailAddress): void
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return int
     */
    public function getDepartmentCode(): int
    {
        return $this->departmentCode;
    }

    /**
     * @param int $departmentCode
     */
    public function setDepartmentCode(int $departmentCode): void
    {
        $this->departmentCode = $departmentCode;
    }

    /**
     * @return string
     */
    public function getDepartmentName(): string
    {
        return $this->departmentName;
    }

    /**
     * @param string $departmentName
     */
    public function setDepartmentName(string $departmentName): void
    {
        $this->departmentName = $departmentName;
    }

    public static function createFromRecord($record): EmployeeModel {
        $model = new EmployeeModel();

        $model->employeeId = $record->employee_id;
        $model->fullName = $record->full_name;
        $model->birthday = $record->birthday;
        $model->genderCode = $record->gender_code;
        $model->emailAddress = $record->email_address;
        $model->phoneNumber = $record->phone_number;
        $model->departmentCode = $record->department_code;
        $model->departmentName = $record->department_name;

        return $model;
    }
}
