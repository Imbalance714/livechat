<?php

namespace App\Support;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;

class ResponseHelper
{
    const SUCCESS_GENERAL = 'Success operation';
    const FAIL_GENERAL = 'Operation failed';
    const FAIL_FORBIDDEN = 'Forbidden access';
    const HTTP_ERROR_RESPONSE_CODES = [
        400,
        403,
        404,
        422,
        421,
        500,
    ];

    /**
     * @param Exception $ex
     * @return \Illuminate\Http\JsonResponse
     */
    public static function exceptionResponse(Exception $ex)
    {
        $errorText = config('app.debug', false) ? 'Error ' . $ex->getMessage() . ' in ' . $ex->getFile() . ', line ' . $ex->getLine() : $ex->getMessage();
        $exCode = $ex->getCode();
        $code = in_array($exCode, self::HTTP_ERROR_RESPONSE_CODES, true) ? $exCode : 500;

        return self::negativeSimpleResponse($errorText, null, $code);
    }

    /** @noinspection MoreThanThreeArgumentsInspection */
    /** @noinspection ArrayTypeOfParameterByDefaultValueInspection */
    /**
     * @param array $data
     * @param null $message
     * @param int $code
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public static function positiveResponse($data = [], $message = null, $code = 200, array $headers = [])
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        return Response::json([
            'code' => $code,
            'success' => true,
            'message' => $message ?: self::SUCCESS_GENERAL,
            'data' => (array)$data,
        ], $code, $headers);
    }

    /**
     * @apiDefine NegativeResponse NegativeResponse Шаблон негативного ответа
     * @apiError (4xx,500) {Number} code HTTP код ответа
     * @apiError (4xx,500) {String} message Сообщение
     * @apiError (4xx,500) {String[]} errors Ошибки
     */
    /** @noinspection MoreThanThreeArgumentsInspection */
    /** @noinspection ArrayTypeOfParameterByDefaultValueInspection */
    /**
     * @param array $errors
     * @param null $message
     * @param int $code
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public static function negativeResponse($errors = [], $message = null, $code = 400, array $headers = [])
    {
        empty($errors) && $errors = [];

        return Response::json([
            'code' => $code,
            'success' => false,
            'message' => $message ?: self::FAIL_GENERAL,
            'errors' => $errors,
        ], $code, $headers);
    }

    /**
     * @param      $causeMessage
     * @param null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function negativeSimpleResponse($causeMessage, $message = null, $code = 400)
    {
        return self::negativeResponse([
            'cause' => (string)$causeMessage,
        ], $message, $code);
    }

    /** @noinspection ArrayTypeOfParameterByDefaultValueInspection */
    /**
     * @param mixed $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function jsonSuccess($data = [], $code = 200)
    {
        $response = [
            'success' => true,
            'code' => $code,
            'data' => $data,
        ];

        return Response::json($response);
    }

    /**
     * @apiDefine jsonFailResponse          Структура ответа в случае ошибки выполнения
     *
     * @apiError (200) {Boolean} success    Маркер успешности выполнения
     * @apiError (200) {Number} code        HTTP код ответа
     * @apiError (200) {String[]} [errors]  Ошибки
     */
    /** @noinspection ArrayTypeOfParameterByDefaultValueInspection */
    /**
     * @param array $errors
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function jsonFail($errors = [], $code = 400)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'errors' => (array)$errors,
        ];

        return Response::json($response);
    }

    public static function jsonException(Exception $ex)
    {
        $errorText = config('app.debug', false) ? 'Error ' . $ex->getMessage() . ' in ' . $ex->getFile() . ', line ' . $ex->getLine() : $ex->getMessage();
        $exCode = $ex->getCode();

        $code = in_array($exCode, self::HTTP_ERROR_RESPONSE_CODES, true) ? $exCode : 500;

        return self::jsonFail([$errorText], $code);
    }

    /**
     * @apiDefine jsonValidationFailResponse            Структура ответа в случае ошибки валидации
     *
     * @apiError (200) {boolean}    success             Маркер успешности выполнения
     * @apiError (200) {integer}    code                HTTP код ответа
     * @apiError (200) {object[]}   [errors]            Ошибки
     * @apiError (200) {string}     [errors.field]          Поле, не прошедшее валидацию
     * @apiError (200) {string[]}   [errors.messages]       Сообщения об ошибках валидации
     */
    /**
     * @param $validationErrors
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validationFail($validationErrors)
    {
        $formattedErrors = [];
        /** @noinspection ForeachSourceInspection */
        foreach ($validationErrors as $field => $errors) {
            $formattedErrors[] = [
                'field' => $field,
                'messages' => $errors,
            ];
        }

        return self::jsonFail($formattedErrors);
    }
}

/**
 * @apiDefine jsonSuccessBaseStructure  Структура стандартной части ответа в случае успешного выполнения
 *
 * @apiSuccess {boolean} success    Маркер успешности выполнения
 * @apiSuccess {integer} code       Код ответа
 */

/**
 * @apiDefine jsonSuccessEmptyData  Cтруктура данных в случае успешного выполнения без возвращаемых данных
 *
 * @apiSuccess {Object[]} data
 */

/**
 * @apiDefine jsonSuccessEmptyDataExample   Пример ответа в случае успешного выполнения без возвращаемых данных
 *
 * @apiSuccessExample {json} Success response example
 * HTTP/1.1 200 OK
 * {
 *      "code": 200,
 *      "success": true,
 *      "data": []
 * }
 */

/**
 * @apiDefine publicApiV2Headers    Заголовки для доступа к публичным API методам
 *
 * @apiHeader App-Token             Токен приложения для доступа к API
 */

/**
 * @apiDefine protectedApiV2Headers Заголовки для доступа к закрытым API методам
 *
 * @apiHeader App-Token             Токен приложения для доступа к API
 * @apiHeader User-Token            Токен пользователя для доступа к API
 */