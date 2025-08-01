<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\NotifyResponseContract;

class MiniNotifyResponse extends MiniResponse implements NotifyResponseContract
{
    protected $success = 'TRADE_SUCCESS';

    public function isPaid()
    {
        return $this->getResponse('status') === $this->success;
    }

    public function isSignMatch()
    {
        return $this->getResponse('signature');
    }

}