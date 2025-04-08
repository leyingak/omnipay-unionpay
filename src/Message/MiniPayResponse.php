<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\MiniPayResponseContract;

class MiniPayResponse extends MiniResponse implements MiniPayResponseContract
{

    public function getMiniPayRequest()
    {
        return $this->getResponse('miniPayRequest');
    }

}