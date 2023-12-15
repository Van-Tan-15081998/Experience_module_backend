<?php

namespace App\Http\Controllers\Base\KnowledgeArticleMaster\Tag\Model;

use App\Http\Controllers\Base\Model\ScreenRoleModel;

class TagScreenRoleModel  extends ScreenRoleModel
{
    public function noRole(): void
    {
        parent::noRole();
    }

    public function toArray(): array
    {
        return parent::toArray();
    }

    public static function cast(?ScreenRoleModel $role): self
    {
        if($role !== null) {
            if(($role instanceof self) === false) {
                throw new \Exception("{$role} is not instance of CastObject");
            }
        }

        return $role;
    }
}
