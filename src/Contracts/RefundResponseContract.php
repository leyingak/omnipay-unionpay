<?php

namespace Omnipay\UnionPay\Contracts;

interface RefundResponseContract extends ResponseContract
{

    public function isSuccessful(): bool;

    public function isRefund(): bool;


}