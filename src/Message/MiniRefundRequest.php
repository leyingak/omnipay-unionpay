<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\RefundResponseContract;
use Omnipay\UnionPay\Contracts\ResponseContract;

class MiniRefundRequest extends AbstractMiniRequest
{

    public function getUriPath()
    {
        return '/v1/netpay/refund';
    }

    public function validateFields()
    {
        return [
            'refundAmount'
        ];
    }

    /**
     * @return RefundResponseContract
     */
    public function handleResponse($response)
    {
        return new MiniRefundResponse($response, $this);
    }

}