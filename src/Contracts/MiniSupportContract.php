<?php

namespace Omnipay\UnionPay\Contracts;

interface MiniSupportContract
{

    public function getConfig(array $config = []): array;

    /**
     * lifecycle: 支付前整理数据(发送给第三方的数据[代理转换方法])
     */
    public function getPurchaseRequestData(array $params = []): array;

    /**
     * lifecycle: 支付后处理响应的数据
     */
    public function getPurchaseData(MiniPayResponseContract $response);

    /**
     * lifecycle: 退款前处理请求参数
     */
    public function getRefundRequestData(array $params): array;

    /**
     * lifecycle: 退款后处理响应数据
     */
    public function getRefundData(RefundResponseContract $response);

    /**
     * lifecycle: 收到支付回调通知(组装数据给依赖)
     */
    public function getCompletePurchaseRequestData(array $params = []): array;

    /**
     * lifecycle: 验签完毕后返回响应数据
     */
    public function getCompletePurchaseData(NotifyResponseContract $response);

    /**
     * lifecycle: 响应数据(响应给支付平台的数据)
     */
    public function getCompletePurchaseResponse(NotifyResponseContract $response);

    /**
     * 获取商户订单号
     */
    public function getNotifyOrderNum(array $params): string;

    /**
     * 获取支付平台订单号
     */
    public function getNotifyT3dOrderNum(array $params): string;

}