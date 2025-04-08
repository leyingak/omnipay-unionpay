<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\ResponseContract;

class UacMiniOrderRequest extends AbstractMiniRequest
{

    public function getUriPath(): string
    {
        return '/v1/netpay/uac/mini-order';
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

        if (!isset($data['expireTime'])) {
            $data['expireTime'] = date('Y-m-d H:i:s', time() + 1200);
        }

        return $data;
    }

    public function validateFields(): array
    {
        return [
            'totalAmount',
            'subAppId',
        ];
    }

    public function handleResponse($response): ResponseContract
    {
        return new MiniPayResponse($response, $this);
    }

}