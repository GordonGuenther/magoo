<?php

/**
 * This file is part of Pachico/Magoo. (https://github.com/pachico/magoo)
 *
 * @link https://github.com/pachico/magoo for the canonical source repository
 * @copyright Copyright (c) 2015-2016 Mariano F.co Benítez Mulet. (https://github.com/pachico/)
 * @license https://raw.githubusercontent.com/pachico/magoo/master/LICENSE.md MIT
 */

namespace Pachico\Magoo\Mask;

/**
 * Regular expression substitution
 */
class Regex implements MaskInterface
{
    /**
     * @var string
     */
    protected $replacement = '*';

    /**
     * @var string
     */
    protected $regex = '';

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        if (isset($params['replacement']) && is_string($params['replacement'])) {
            $this->replacement = $params['replacement'];
        }

        if (isset($params['regex']) && is_string($params['regex'])) {
            $this->regex = $params['regex'];
        }
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function mask($string)
    {
        $replacements = [];

        preg_replace_callback($this->regex, function ($matches) use (&$replacements) {
            foreach ($matches as $match) {
                $replacements[(string) $match] = str_pad('', mb_strlen($match), $this->replacement);
            }
        }, $string);

        if (empty($replacements)) {
            return $string;
        }

        return str_replace(array_keys($replacements), array_values($replacements), $string);
    }
}
