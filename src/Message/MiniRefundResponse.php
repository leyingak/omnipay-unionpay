<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\RefundResponseContract;

class MiniRefundResponse extends MiniResponse implements RefundResponseContract
{
    protected $success = 'SUCCESS';

    public function isRefund(): bool
    {
        return $this->getResponse('refundStatus') === $this->success;
    }

}