<?php

namespace App\Lib\Business\Authentication\StaffAccount\Entities;

use App\Lib\Business\Authentication\StaffAccount\Models\StaffAuthenticationModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StaffAuthenticationEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'staff_account_id',
        'login_id',
        'password',
        'last_name',
        'first_name',
        'staff_account_status_code',
    ];

    protected $table = 'staff_accounts';
    protected $primaryKey = 'staff_account_id';

    protected $hidden = [
        'email_address',
        'sex_type_code',
        'birthday',
        'staff_account_type_code',
        'employment_type_code',
        'password_reset_datetime',
        'is_account_lock',
        'last_login_datetime',
        'created_account_id',
        'created_account_name',
        'created_datetime',
        'updated_account_id',
        'updated_account_name',
        'updated_datetime',
        'record_version',
        'is_deleted'
    ];

    public function selectByLoginId(string $loginId) {
        $result = DB::table('staff_accounts')
            ->where('login_id', $loginId)
            ->select(
                'staff_account_id',
                'login_id',
                'password',
                'last_name',
                'first_name',
                'staff_account_status_code',
                'staff_account_statuses.name as staff_account_status',
                'staff_account_statuses.processing_key as staff_account_status_processing_key'
            )
            ->leftJoin('staff_account_statuses',
                'staff_accounts.staff_account_status_code',
                '=',
                'staff_account_statuses.staff_account_status_id'
            )->get();

        if (empty($result)) {
            return [];
        }

        $accountList = [];

        foreach($result as $record) {
            $accountList[] = StaffAuthenticationModel::createFromRecord($record);
        }

        return $accountList;
    }

    public function selectById(int $accountId) {
        $result = DB::table('staff_accounts')
            ->where('staff_account_id', $accountId)
            ->select(
                'staff_account_id',
                'login_id',
                'password',
                'last_name',
                'first_name',
                'staff_account_status_code'
            )->get()->toArray();

        if (empty($result)) {
            return [];
        }

//        return StaffAuthenticationModel::createFromRecord($result[0])->toArray();
        return StaffAuthenticationModel::createFromRecord($result[0]);
    }

    public function recordLoginSuccess(int $staffAccountId, String $loginDateTime) {

    }

    public function insertLoginHistory(string $loginId, String $loginDateTime, bool $isCertifiedSuccess) {

    }
}
