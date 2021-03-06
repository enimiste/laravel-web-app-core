<?php

namespace Enimiste\LaravelWebApp\Core\Contracts\Serialization;


use Illuminate\Database\Eloquent\Model;

interface SerializerInterface
{

    /**
     * @param Model $model
     * @param bool $isForList
     *
     * @return array
     */
    function serialize($model, $isForList);
}