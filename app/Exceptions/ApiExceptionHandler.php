<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;
use Throwable;

class ApiExceptionHandler
{
    /**
     * Handles the given exception and returns a JSON response with a custom message and status code.
     *
     * @param  Throwable  $exception  The exception to handle.
     * @param  string|null  $customMessage  [optional] A custom message to include in the response. Defaults to null.
     * @return JsonResponse The JSON response with the custom message and status code.
     */
    public static function handle(Throwable $exception, ?string $customMessage = null): JsonResponse
    {
        self::logException($exception);

        $status = self::getStatusCode($exception);
        $message = $customMessage ?? self::getDefaultMessage($exception);

        return response()->json(
            data: ['message' => $message],
            status: $status
        );
    }

    /**
     * Returns the appropriate HTTP status code based on the type of exception.
     *
     * @param  Throwable  $exception  The exception to handle.
     * @return int The HTTP status code.
     */
    private static function getStatusCode(Throwable $exception): int
    {
        return match (true) {
            $exception instanceof ModelNotFoundException => ResponseStatus::HTTP_NOT_FOUND,
            $exception instanceof AuthorizationException => ResponseStatus::HTTP_FORBIDDEN,
            default => $exception->getCode() ?? ResponseStatus::HTTP_INTERNAL_SERVER_ERROR,
        };
    }

    /**
     * Returns the default error message based on the type of exception.
     *
     * @param  Throwable  $exception  The exception to handle.
     * @return string The default error message.
     */
    private static function getDefaultMessage(Throwable $exception): string
    {
        return match (true) {
            $exception instanceof ModelNotFoundException => 'Resource not found.',
            $exception instanceof AuthorizationException => 'This action is unauthorized.',
            default => $exception->getMessage(),
        };
    }

    /**
     * Logs the given exception by logging the exception message along with the exception object.
     *
     * @param  Throwable  $exception  The exception to be logged.
     */
    private static function logException(Throwable $exception): void
    {
        Log::error('Exception occurred: '.$exception->getMessage(), [
            'exception' => $exception,
        ]);
    }
}
