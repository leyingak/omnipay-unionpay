<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\NotifyResponseContract;
use Omnipay\UnionPay\Contracts\ResponseContract;

class MiniQueryRequest extends AbstractMiniRequest
{

    public function getUriPath(): string
    {
        return '/v1/netpay/query';
    }

    public function validateFields(): array
    {
        return [];
    }

    /**
     * @return NotifyResponseContract
     */
    public function handleResponse($response): ResponseContract
    {
        return new MiniNotifyResponse($response);
    }


}