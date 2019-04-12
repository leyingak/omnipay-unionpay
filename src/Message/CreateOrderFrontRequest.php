<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Common\Helper;

/**
 * Class CreateOrderFrontRequest
 * @package Omnipay\UnionPay\Message
 */
class CreateOrderFrontRequest extends ExpressPurchaseRequest
{
    public function sendData($data)
    {
        $url = $this->getEndpoint('front');
        $content = Helper::createAutoFormHtml($data, $url);
        return $content;
    }
}
