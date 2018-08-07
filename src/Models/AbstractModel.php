<?php

namespace ByTIC\Omnipay\Librapay\Models;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class AbstractModel
 * @package ByTIC\Omnipay\Librapay\Models
 */
abstract class AbstractModel
{

    /**
     * @param $params
     */
    public function initParams($params)
    {
        foreach ($params as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @throws InvalidRequestException
     */
    protected function validateData()
    {
        $fields = null;
        if (method_exists($this, 'validateDataFields')) {
            $fields = $this->validateDataFields();
        }

        if (is_array($fields) && count($fields)) {
            /** @noinspection PhpMethodParametersCountMismatchInspection */
            $this->validate(...$fields);
        }
    }

    /**
     * @throws InvalidRequestException
     */
    public function validate()
    {
        foreach (func_get_args() as $key) {
            $value = $this->{$key};
            if (!isset($value)) {
                throw new InvalidRequestException(
                    "The $key parameter is required for model "
                    .'['.get_class($this).']'
                    .'['.print_r($this, true).']'
                );
            }
        }
    }
}