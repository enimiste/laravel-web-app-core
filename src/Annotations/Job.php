<?php

namespace Enimiste\LaravelWebApp\Core\Annotations;

/**
 * Class FiresEvents
 * @package Enimiste\LaravelWebApp\Core\Annotations
 *
 * @Annotation
 */
class Job extends BaseAnnotation
{
    /** @var  string */
    public $name;
    /** @var  string */
    public $queue;
    /** @var  int|string */
    public $delay;
    /**
     * Specify the extension points when the Job is
     * sometimes dispatched
     *
     * @var  array
     */
    public $whens;
}