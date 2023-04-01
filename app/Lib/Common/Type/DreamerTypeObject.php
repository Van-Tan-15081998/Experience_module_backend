<?php

namespace App\Lib\Common\Type;

abstract class DreamerTypeObject
{
    public function __construct()
    {
    }

    abstract public function toArray(): array;

    public function toString(): string
    {
        return '';
    }

    protected function toArrayFromModel(array $property, array $unset = []): array
    {
        foreach ($unset as $value) {
            unset($property[$value]);
        }

        return $this->toArrayRecursive($property);
    }

    private function toArrayRecursive($property)
    {
        if (is_array($property)) {
            $array = [];
            foreach ($property as $key => $value) {
                $array[$key] = $this->toArrayRecursive($value);
            }
            return $array;
        }

        if (is_object($property)) {
            return $property->toArray();
        }

        if (is_null($property)) {
            $property = "";
        }

        return $property;
    }
}
