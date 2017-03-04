<?php

namespace Enimiste\LaravelWebApp\Core\Models\Traits;


use Enimiste\LaravelWebApp\Core\Exception\SequencableModelException;

trait SequencableModelTrait
{
    /**
     * Return the next sequence value from the last one
     *
     * @param string $prefix
     * @param string $lastValue
     *
     * @param bool $forceEmpty if true and the lastValue is empty the sequence will start from beginning
     *
     * @return string
     */
    public static function nextSeq($prefix, $lastValue, $forceEmpty = false)
    {
        $prefix = trim($prefix);
        $lastValue = trim($lastValue);

        if (mb_strlen($lastValue) == 0 && !$forceEmpty) {
            throw new SequencableModelException('Lastvalue can\‘t be empty');
        }

        $seq = str_replace($prefix, '', $lastValue);

        if (mb_strlen($seq) == 0) {
            if ($forceEmpty)
                $seq = '10';
            else
                throw new SequencableModelException('The last seq had\'n the suffix part');
        }

        $seq = intval($seq) + 10;

        return $prefix . $seq;
    }
}