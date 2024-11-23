<?php

namespace App\Api\Exchange;

class Exchange
{
    private $exchangeName;

    public function __constructor($exchangeName, $exchangeAPIKey, $exchangeAPISecret)
    {

    }

    /**
     * @return mixed
     */
    private function getExchangeName()
    {
        return $this->exchangeName;
    }

    /**
     * @param mixed $exchangeName
     */
    private function setExchangeName($exchangeName): void
    {
        $this->exchangeName = $exchangeName;
    }
}