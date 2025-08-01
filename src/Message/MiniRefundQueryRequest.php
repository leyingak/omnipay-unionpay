<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\RefundResponseContract;
use Omnipay\UnionPay\Contracts\ResponseContract;

class MiniRefundQueryRequest extends AbstractMiniRequest
{

    public function getUriPath()
    {
        return '/v1/netpay/refund-query';
    }

    public function validateFields()
    {
        return [];
    }

    /**
     * @return RefundResponseContract
     */
    public function handleResponse($response)
    {
        return new MiniRefundResponse($response);
    }

}