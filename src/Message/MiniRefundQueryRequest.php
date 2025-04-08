<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\RefundResponseContract;
use Omnipay\UnionPay\Contracts\ResponseContract;

class MiniRefundQueryRequest extends AbstractMiniRequest
{

    public function getUriPath(): string
    {
        return '/v1/netpay/refund-query';
    }

    public function validateFields(): array
    {
        return [];
    }

    /**
     * @return RefundResponseContract
     */
    public function handleResponse($response): ResponseContract
    {
        return new MiniRefundResponse($response);
    }

}