<?php

namespace App\Lib\WebCommon\Helpers;

use App\Lib\Business\Common\Models\DreamerValidationErrors;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

class ResponseHelper
{
    public static function responseOnSuccessful(?array $htmlHead,
                                                ?array $headers,
                                                ?array $footers,
                                                ?array $contents,
                                                ?array $data,
                                                ?array $statuses = null
    ): Response
    {
        $responseData = [];

        if (isset($htmlHead)) {
            $responseData['htmlhead'] = $htmlHead;
        }

        if (isset($headers)) {
            $responseData['headers'] = $headers;
        }

        if (isset($footers)) {
            $responseData['footers'] = $footers;
        }

        if (isset($contents)) {
            $responseData['contents'] = $contents;

            // TODO: Test Lang
            App::setLocale('vi');
            $responseData['contents'][] = __('experiencelang.experience');
//            $responseData['contents'][] = __('auth.failed');
        }

        if (is_null($data)) {
            $data = [];
        }
        $responseData['contents']['data'] = $data;

        if (isset($statuses)) {
            $responseData['contents']['statuses'] = $statuses;
        }

        return response()->json($responseData);
    }

    public static function responseOnValidationErrorsFromException(ValidationException $exception): Response
    {
        return response()->json([
            'contents' => [
                'errors' => $exception->errors()
            ]
        ], 422);
//        return response()->json([
//            'contents' => [
//                'errors' => $exception->errors()
//            ]
//        ]);
    }

    public static function responseOnValidationErrors(DreamerValidationErrors $errors): Response
    {
        return response()->json([
            'contents' => [
                'errors' => $errors->toArray(),
                'optional' => $errors->getOptional()
            ]
        ], 422);
    }

    public static function responseOnBusinessError(
        ?string  $errCode,
        ?string  $errDescription = null,
        ?string  $errMessage = null,
                 $optional = null                    ): Response
    {
        return ResponseHelper::responseOnError(
            400,
            $errCode,
            $errDescription,
            $errMessage,
            $optional
        );
    }

    public static function responseOnError(
        ?int     $statusCode,
        ?string  $errCode,
        ?string  $errDescription = null,
        ?string  $errMessage = null,
                 $optional = null,
        ?array   $debugInfo = null
    ): Response
    {
        $error = ResponseStatus::createErrorStatus(   $errCode,
            $errDescription,
            $errMessage,
            $optional,
            $debugInfo
        );

        $errors = new DreamerTypeList();
        $errors->add($error);

        return ResponseHelper::responseOnErrors($statusCode, $errors);
    }

    public static function responseOnErrors(int $statusCode, DreamerTypeList $errors): Response
    {
        return response()->json([
            'errors' => $errors->toArray()
        ], $statusCode);
    }

    public static function responseOnBusinessErrorFromStatus(ResponseStatus $status): Response
    {
        return ResponseHelper::responseOnError(
            400,
            $status->getCode(),
            $status->getDescription(),
            $status->getMessage(),
            $status->getOptional(),
            $status->getDebugInfo()
        );
    }
}
