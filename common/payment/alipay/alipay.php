<?php
class alipay{
    /*
     * 配置
     */
    protected $config = array('charset' => "UTF-8",);
    /*
     * 订单名称
     */
    protected $subject = 'goodspay';
    /*
     * 商品描述
     */
    protected $body = '';
    /*
     * 超时时间
     */
    protected $timeout_express = '1m';
    /*
     * code描述
     */
    protected $code_msg = array(
        '10000' => '业务处理成功',
        '20000' => '服务不可用',
        '20001' => '授权权限不足',
        '40001' => '缺少必选参数',
        '40002' => '非法的参数',
        '40004' => '业务处理失败',
        '40006' => '权限不足',
    );
    /*
     * 入口
     */
    public function __construct(){
        require dirname ( __FILE__ ).'/config.php';
        require_once dirname ( __FILE__ ).'/wappay/service/AlipayTradeService.php';
        if( !empty($config) ){
            foreach($config as $k=>$v){
                $this->config[$k] = $v['value'];
            }
        }
    }
    /*
     * 支付
     */
    public function pay( $data ){
        require_once dirname ( __FILE__ ).'/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php';
        if ( !empty($data['order_no']) && !empty($data['money_end'])){
            $this->subject = $data['order_no'];
            $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($this->body);
            $payRequestBuilder->setSubject($this->subject);
            $payRequestBuilder->setTimeExpress($this->timeout_express);
            $payRequestBuilder->setOutTradeNo($data['order_no']);
            $payRequestBuilder->setTotalAmount($data['money_end']);
            $payResponse = new AlipayTradeService($this->config);
            $result=$payResponse->wapPay($payRequestBuilder,$this->config['return_url'],$this->config['notify_url']);
            return $result;
        }
    }
    /*
     * 查询
     */
    public function query( $order_no ){
        if( empty($order_no) ){
            return false;
        }
        require_once dirname ( __FILE__ ).'/wappay/buildermodel/AlipayTradeQueryContentBuilder.php';
        if ( !empty($order_no) ){
            $RequestBuilder = new AlipayTradeQueryContentBuilder();
            $RequestBuilder->setTradeNo('');
            $RequestBuilder->setOutTradeNo($order_no);

            $Response = new AlipayTradeService($this->config);
            $result=$Response->Query($RequestBuilder);
            if( !empty($result->code) && $result->code == '10000' ){
                return true;
            }
            return false;
        }
    }
    /*
     * 同步通知
     */
    public function result_return(){
        $arr=$_GET;
        $alipaySevice = new AlipayTradeService($this->config);
        $result = $alipaySevice->check($arr);
        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        return $result;
    }
    /*
     * 异步通知
     */
    public function result_notify(){
        $arr=$_POST;
        $alipaySevice = new AlipayTradeService($this->config);
        $result = $alipaySevice->check($arr);
        return $result;
    }
}