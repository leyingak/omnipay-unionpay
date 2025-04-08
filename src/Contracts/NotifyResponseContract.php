<?php

namespace Omnipay\UnionPay\Contracts;

interface NotifyResponseContract extends ResponseContract
{

    public function isSuccessful(): bool;

    public function isPaid(): bool;

    public function isSignMatch(): bool;

}