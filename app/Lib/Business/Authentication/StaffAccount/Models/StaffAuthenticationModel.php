<?php

namespace App\Lib\Business\Authentication\StaffAccount\Models;

use App\Lib\Business\Specific\Staff\Account\Constants\AccountStatus;

class StaffAuthenticationModel
{
    private int $staffAccountId;

    private string $lastName;

    private string $firstName;

    private string $loginId;

    private string $password;

    private int $accountStatusCode;

    private string $accountStatus;

    private string $accountStatusProcessingKey;

    /**
     * @return int
     */
    public function getStaffAccountId(): int
    {
        return $this->staffAccountId;
    }

    /**
     * @param int $staffAccountId
     */
    public function setStaffAccountId(int $staffAccountId): void
    {
        $this->staffAccountId = $staffAccountId;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLoginId(): string
    {
        return $this->loginId;
    }

    /**
     * @param string $loginId
     */
    public function setLoginId(string $loginId): void
    {
        $this->loginId = $loginId;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getAccountStatusCode(): int
    {
        return $this->accountStatusCode;
    }

    /**
     * @param int $accountStatusCode
     */
    public function setAccountStatusCode(int $accountStatusCode): void
    {
        $this->accountStatusCode = $accountStatusCode;
    }

    /**
     * @return string
     */
    public function getAccountStatus(): string
    {
        return $this->accountStatus;
    }

    /**
     * @param string $accountStatus
     */
    public function setAccountStatus(string $accountStatus): void
    {
        $this->accountStatus = $accountStatus;
    }

    /**
     * @return string
     */
    public function getAccountStatusProcessingKey(): string
    {
        return $this->accountStatusProcessingKey;
    }

    /**
     * @param string $accountStatusProcessingKey
     */
    public function setAccountStatusProcessingKey(string $accountStatusProcessingKey): void
    {
        $this->accountStatusProcessingKey = $accountStatusProcessingKey;
    }

    public static function createFromRecord($record): StaffAuthenticationModel
    {
        $model = new StaffAuthenticationModel();

        $model->staffAccountId = $record->staff_account_id;
        $model->lastName = $record->last_name;
        $model->firstName = $record->first_name;
        $model->loginId = $record->login_id;
        $model->password = $record->password;
        $model->accountStatusCode = $record->staff_account_status_code;
        $model->accountStatus = $record->staff_account_status;
        $model->accountStatusProcessingKey = $record->staff_account_status_processing_key;

        return $model;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}
