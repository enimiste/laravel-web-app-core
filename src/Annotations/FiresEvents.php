<?php

namespace Enimiste\LaravelWebApp\Core\Annotations;

/**
 * Class FiresEvents
 * @package Org\Asso\Annotations
 *
 * @Annotation
 */
class FiresEvents extends BaseAnnotation
{

    /** @var  array */
    public $always;
    /** @var  array */
    public $sometimes;
    /**
     * Specify the extension points when the Event is
     * sometimes fired
     *
     * @var  array
     */
    public $whens;

}