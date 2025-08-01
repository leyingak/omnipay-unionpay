<?php

namespace Omnipay\UnionPay\Contracts;

interface RefundResponseContract extends ResponseContract
{

    public function isSuccessful();

    public function isRefund();


}