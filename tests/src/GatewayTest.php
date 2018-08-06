<?php

namespace ByTIC\Omnipay\Librapay\Tests;

use ByTIC\Omnipay\Librapay\Gateway;

class GatewayTest extends AbstractTest
{
    public function testPurchase()
    {
        $gateway = new Gateway();

        $parameters = require TEST_FIXTURE_PATH . 'simpleOrderParams.php';

        foreach (['merchant', 'merchantName', 'merchantEmail', 'merchantUrl', 'terminal', 'key'] as $field) {
            $parameters[$field] = $_ENV['LIBRAPAY_' . strtoupper($field)];
        }

        $request = $gateway->purchase($parameters);
        $response = $request->send();

// Send the Symfony HttpRedirectResponse
        $response->send();

    }
}