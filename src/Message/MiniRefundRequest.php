<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\RefundResponseContract;
use Omnipay\UnionPay\Contracts\ResponseContract;

class MiniRefundRequest extends AbstractMiniRequest
{

    public function getUriPath(): string
    {
        return '/v1/netpay/refund';
    }

    public function validateFields(): array
    {
        return [
            'refundAmount'
        ];
    }

    /**
     * @return RefundResponseContract
     */
    public function handleResponse($response): ResponseContract
    {
        return new MiniRefundResponse($response);
    }

}