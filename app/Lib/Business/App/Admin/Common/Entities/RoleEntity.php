<?php

namespace App\Lib\Business\App\Admin\Common\Entities;

use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class RoleEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'name',
        'sequence',
        'created_account_id',
        'created_account_login_id',
        'created_account_name',
        'created_datetime',
        'updated_account_id',
        'updated_account_login_id',
        'updated_account_name',
        'updated_datetime',
        'record_version',
        'is_deleted',
    ];

    protected $table = 'roles';
    protected $primaryKey = 'role_id';

    public function selectRoleByAccountId(int $accountId, array $screenIds): ?array {

        $bindingArray = self::parseBindingArrayToString($screenIds);

        $result = DB::select(
            "
            SELECT  *
            FROM    master__staff_account_role_group_allocations
                    INNER JOIN master__role_groups ON master__role_groups.role_group_id = master__staff_account_role_group_allocations.role_group_id
                    INNER JOIN master__role_group_role_allocations ON master__role_group_role_allocations.role_group_id = master__role_groups.role_group_id
                    INNER JOIN master__roles ON master__roles.role_id = master__role_group_role_allocations.role_id
                    INNER JOIN master__role_functions ON master__role_functions.role_id = master__roles.role_id
                    INNER JOIN master__functions ON master__functions.function_id = master__role_functions.function_id
            WHERE   master__staff_account_role_group_allocations.staff_account_id = $accountId
                    AND master__functions.screen_id IN ($bindingArray)
            "
        );

        if(is_null($result)) {
            return null;
        }

        $list = [];

        foreach($result as $record) {
            $list[] = RoleFunctionModel::createFromRecord($record);
        }

        return $list;
    }

    public static function parseBindingArrayToString(array $arrayBinding): string
    {
        return implode(",",$arrayBinding);
    }
}
