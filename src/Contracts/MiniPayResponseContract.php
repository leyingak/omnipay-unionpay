<?php

namespace Omnipay\UnionPay\Contracts;

interface MiniPayResponseContract extends ResponseContract
{

    public function getMiniPayRequest();

}