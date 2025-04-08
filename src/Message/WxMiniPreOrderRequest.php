<?php

namespace Omnipay\UnionPay\Message;

class WxMiniPreOrderRequest extends AbstractMiniRequest
{

    public function getUriPath(): string
    {
        return '/v1/netpay/wx/mini-pre-order';
    }

    public function getData()
    {
        $data = parent::getData();

        if (!isset($data['invokeScene'])) {
            $data['invokeScene'] = '03';
        }

        if (!isset($data['tradeType'])) {
            $data['tradeType'] = 'UP_WX_MINI';
        }

        return $data;
    }

    public function validateFields(): array
    {
        return [
            'totalAmount',
            'tradeType',
            'invokeScene'
        ];
    }

}