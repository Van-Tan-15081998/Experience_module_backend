<?php

namespace App\Lib\WebCommon\Helpers;

use App\Lib\Common\Type\DreamerTypeObject;

class ResponseArrayModel extends DreamerTypeObject
{
    private array $responseArray = [];

    public function addResponseItem(string $key, $responseItem = null, bool $nullToEmptyArray = true): void
    {
        if (is_null($responseItem) && $nullToEmptyArray) {
            $responseItem = [];
        }
        $this->responseArray[$key] = $responseItem;
    }

    public function addResponseItems(array $responseItems): void
    {
        $this->responseArray = array_merge($this->responseArray, $responseItems);
    }

    public function getResponseArray(): array
    {
        return $this->responseArray;
    }

    public function toArray(): array
    {
        // TODO: Implement toArray() method.
        return parent::toArrayFromModel($this->responseArray);
    }
}
