<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 16:07
 */

namespace Enimiste\LaravelWebApp\Core\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;

abstract class BaseApiFormRequest extends BaseFormRequest
{

    /**
     * @param Validator $validator
     *
     * @return mixed|void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            new JsonResponse(
                [
                    'data' => [
                        'input_errors' => $this->formatErrors($validator),
                    ],
                ], 400
            )
        );
    }
}