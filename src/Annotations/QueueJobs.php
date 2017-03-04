<?php

namespace Enimiste\LaravelWebApp\Core\Annotations;

/**
 * Class FiresEvents
 * @package Org\Asso\Annotations
 *
 * @Annotation
 */
class QueueJobs extends BaseAnnotation
{

    /** @var  array of @Job */
    public $always;
    /** @var  array of @Job */
    public $sometimes;

}