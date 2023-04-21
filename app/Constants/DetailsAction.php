<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class DetailsAction extends Enum
{
    public const NONE = ['none'];
    public const NEW = ['new'];
    public const EDIT = ['edit'];
    public const VIEW = ['view'];
    public const CONFIRM = ['confirm'];
    public const COPY = ['copy'];
    public const DELETE = ['delete'];

    public function getMode(): string
    {
        return $this->value[0];
    }

    public function isSame(string $mode): bool
    {
        return ($this->getMode() === $mode);
    }

    public static function fromKey(mixed $fromKey): ?self
    {
        $array = parent::toArray();
        if(isset($array)) {
            foreach($array as $key => $value) {
                if($fromKey == $value[0]) {
                    return parent::__callStatic($key, []);
                }
            }
        }

        return null;
    }
}
