<?php

namespace App\Lib\WebCommon\Helpers;

use App\Lib\Business\Common\Models\ExperienceValidationErrors;
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
    }

    public static function responseOnValidationErrors(ExperienceValidationErrors $errors): Response
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
                 $optional = null                        ): Response
    {
        $error = ResponseStatus::createErrorStatus(   $errCode,
            $errDescription,
            $errMessage,
            $optional,
        );

        $errors = array();
        $errors[] = $error;

        return ResponseHelper::responseOnErrors($statusCode, $errors);
    }

    public static function responseOnErrors(int $statusCode, array $errors): Response
    {
        return response()->json([
            'errors' => $errors
        ], $statusCode);
    }
}
