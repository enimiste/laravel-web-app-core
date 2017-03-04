<?php

namespace Enimiste\LaravelWebApp\Core\Annotations;

/**
 * Class FiresEvents
 * @package Org\Asso\Annotations
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