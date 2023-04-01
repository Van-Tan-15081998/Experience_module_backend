<?php

namespace App\Lib\Business\Authentication\StaffAccount\Models;
use Illuminate\Foundation\Auth\User;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthUser extends User
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'staff_accounts';

    protected $fillable = [
        'staff_account_id',
        'login_id',
        'password',
        'email_address',
        'first_name',
        'last_name',
        'sex_type_code',
        'birthday',
        'staff_account_type_code',
        'employment_type_code',
        'staff_account_status_code',
        'password_reset_datetime',
        'is_account_lock',
        'last_login_datetime',
        'created_account_id',
        'created_account_login_id',
        'created_account_name',
        'created_datetime',
        'updated_account_id',
        'updated_account_login_id',
        'updated_account_name',
        'updated_datetime',
        'record_version',
        'is_deleted'
    ];

    protected $primaryKey = 'staff_account_id';

    public $timestamps = false;

    protected $hidden = [
        'password',
        'email_address',
        'sex_type_code',
        'birthday',
        'staff_account_type_code',
        'employment_type_code',
        'staff_account_status_code',
        'password_reset_datetime',
        'is_account_lock',
        'last_login_datetime',
        'created_account_id',
        'created_account_login_id',
        'created_account_name',
        'created_datetime',
        'updated_account_id',
        'updated_account_login_id',
        'updated_account_name',
        'updated_datetime',
        'record_version',
        'is_deleted'
    ];


    private string $accountIdKey = 'staff_account_id';

    private string $loginIdKey = 'login_id';

    private string $lastNameKey = 'last_name';

    private string $firstNameKey = 'first_name';

    public function getAccountId(): int
    {
        return $this->getAttribute($this->accountIdKey);
    }

    public function getLoginId(): string
    {
        return $this->getAttribute($this->loginIdKey);
    }

    public function getStaffName(): string
    {
//        return BusinessCommonUtil::toName(  $this->getAttribute($this->lastNameKey),
//            $this->getAttribute($this->firstNameKey)
//        );
        return 'Continue...';
    }

    public function setAccountId(int $id): void
    {
        $this->setAttribute($this->accountIdKey, $id);
    }

    public function setLoginId(string $loginId): void
    {
        $this->setAttribute($this->loginIdKey, $loginId);
    }

    public function setLastName(string $lastName): void
    {
        $this->setAttribute($this->lastNameKey, $lastName);
    }

    public function setFirstName(string $firstName): void
    {
        $this->setAttribute($this->firstNameKey, $firstName);
    }

    public function deleteMyAccessToken(): void
    {
//        $this->tokens()->where('tokenable_id', $this->getAccountId())->delete();
    }
}
