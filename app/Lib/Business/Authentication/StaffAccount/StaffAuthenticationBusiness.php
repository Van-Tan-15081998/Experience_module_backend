<?php

namespace App\Lib\Business\Authentication\StaffAccount;

use App\Lib\Business\Authentication\Exception\AuthIdManyExistsException;
use App\Lib\Business\Authentication\Exception\AuthIdNotFoundException;
use App\Lib\Business\Authentication\Exception\AuthMissPasswordException;
use App\Lib\Business\Authentication\Exception\AuthUnUsableException;
use App\Lib\Business\Authentication\StaffAccount\Entities\StaffAuthenticationEntity;
use App\Lib\Business\Authentication\StaffAccount\Models\StaffAuthenticationModel;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use App\Lib\Business\Specific\Staff\Account\Constants\AccountStatus;
use Illuminate\Support\Facades\Hash;

class StaffAuthenticationBusiness extends ExperienceBaseBusiness
{
    private StaffAuthenticationEntity $staffAuthenticationEntity;

    public function __construct()
    {
        parent::__construct();
        $this->staffAuthenticationEntity = new StaffAuthenticationEntity();
    }

    public function authenticate(string $loginId, string $password): StaffAuthenticationModel
    {
        $account = $this->getAccountByLoginId($loginId);

        if(!Hash::check($password, $account->getPassword())) {
            throw new AuthMissPasswordException();
        }

        // TODO
        if(!$this->authorizeAccount($account)) {
            $this->updateLoginAuthenticationResult($account, false);
            throw new AuthUnUsableException();
        }

        $this->updateLoginAuthenticationResult($account, true);

        return $account;
    }

    public function authorize(int $staffAccountId): bool
    {
        $account = $this->getAccountById($staffAccountId);

        return $this->authorizeAccount($account);
    }

    public function getAccountByLoginId(string $loginId): ?StaffAuthenticationModel {

        $account = null;

        try {
            $accountList = $this->staffAuthenticationEntity->selectByLoginId($loginId);
            if(isset($accountList)) {
                $count = count($accountList);

                if($count > 1) {
                    throw new AuthIdManyExistsException();
                }

                if($count > 0) {
                    $account = $accountList[0];
                }
             }
        } catch (\Exception $e) {
            // TODO
        }

        if($account === null) {
            throw new AuthIdNotFoundException();
        }

        return $account;
    }

    public function getAccountById(int $staffAccountId): ?StaffAuthenticationModel {
        $account = null;

        try {
            $account = $this->staffAuthenticationEntity->selectById($staffAccountId);
        } catch (\Exception $e) {
            // TODO
        }

        if($account === null) {
            throw new AuthIdNotFoundException();
        }

        return $account;
    }

    public function authorizeAccount(StaffAuthenticationModel $account): bool
    {
        $accountStatus = $account->getAccountStatusProcessingKey();
        if($accountStatus !== AccountStatus::VALID()->getProcessingKey()) {
            return false;
        }

        return true;
    }

    public function updateLoginAuthenticationResult() {
        // TODO
        return null;
    }
}
