<?php

namespace App\Lib\Business\Base;

use App\Lib\Common\Type\TypeEnum;

class ExperienceEnum extends TypeEnum
{
    public function getEnumKey(): int
    {
        return $this->value[0];
    }

    public static function isValidEnumKey(mixed $key): bool
    {
        if(is_null($key)) {
            return false;
        }

        return !is_null(static::fromKey($key));
    }

    public static function fromKey(mixed $fromKey): ?self
    {
        $array = parent::toArray();
        if(isset($array)) {
            foreach($array as $key => $value) {
                // mixedなのであえて==で比較
                if($fromKey == $value[0]) {
                    return parent::__callStatic($key, []);
                }
            }
        }

        return null;
    }

    public static function fromEnumKey(string $fromEnumKey): ?self
    {
        $array = parent::toArray();
        if(isset($array)) {
            foreach($array as $key => $value) {
                // mixedなのであえて==で比較
                if($fromEnumKey == $key) {
                    return parent::__callStatic($key, []);
                }
            }
        }

        return null;
    }
}
