<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\NotifyResponseContract;

class MiniNotifyResponse extends MiniResponse implements NotifyResponseContract
{
    protected $success = 'TRADE_SUCCESS';

    protected $refundSuccess = 'TRADE_REFUND';

    public function isPaid()
    {
        if (!empty($this->getResponse('refundOrderId'))) {
            return $this->getResponse('status') === $this->refundSuccess;
        }

        return $this->getResponse('status') === $this->success;
    }

    public function isSignMatch()
    {
        return $this->getResponse('signature');
    }

}