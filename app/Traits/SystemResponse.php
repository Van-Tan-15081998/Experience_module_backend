<?php

namespace App\Traits;

trait SystemResponse {
    private function sentResponse($errorCode, $errorMessage, $data) : array
    {
        return [
            'error_code'    =>  $errorCode,
            'error_msg'     =>  $errorMessage,
            'data'          =>  $data,
        ];
    }

    protected function sentResponseSuccessful($data) {
        return $this->sentResponse(0, 0, $data);
    }

    protected function sentResponseFail($errorCode, $errorMessage, $data) {
        if($errorCode == 0) {
            throw new \Exception('Error format response');
        }

        return $this->sentResponse($errorCode, $errorMessage, $data);
    }
}
