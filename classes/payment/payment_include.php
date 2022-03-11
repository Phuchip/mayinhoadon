<?php
require_once dirname(__FILE__).'/BKPaymentProService2.php';
require_once dirname(__FILE__).'/BaoKimPayment.php';
require_once dirname(__FILE__).'/payment_lang.php';
//require_once dirname(__FILE__).'/client_function.php';
require_once dirname(__FILE__).'/BKTransactionAPI.php';
require_once dirname(__FILE__).'/BaokimAdaptiveAccountsAPI.php';

//Fix varible
$merchant_id    =   "835";
$secure_pass    =   "f37e306f900848c6";

$api_username   =   "myadvn";
$api_password   =   "myadvn";
$secure_secret  =   "myadvn";
$bk_seller_email=   "ntdinh1987@gmail.com";  //$bussiness
$baokim_buyer_account_email = 'vuquangthanh90@gmail.com';

$baokim_buyer_account_email = 'huynq2207@gmail.com';
$baokim_seller_account_email= $bk_seller_email;
$payment_define = array(
    1 =>"Các loại thẻ ATM trong nước",
    2 =>"Các loại thẻ Tín dụng quốc tế",
    3 =>"Chuyển khoản bằng Internet Banking",
    4 =>"Chuyển khoản bằng máy ATM",
    5 =>"Chuyển khoản tiền mặt tại quầy giao dịch"
);
$payment_show   = array(
    1 =>"1",
    2 =>"1",
    3 =>"0",
    4 =>"0",
    5 =>"0"
);                    
                    
$arr_code       =   array(
    1   =>"VND",
    2   =>"USD"
);

$order_id           =   strval(time());
$tax_fee            =   "0";
$shipping_fee       =   "0";
$order_description  =   "Note order";

//$location = 'https://www.baokim.vn';
//$location = 'http://localhost:8888';
$location = 'http://sandbox.baokim.vn';

$bk                  = new BKPaymentProService2($location."/services/payment_pro_2/init?wsdl");
$pay_via_bk          = new BaoKimPayment($location."/payment/customize_payment/order",$merchant_id,$secure_pass);
$topup				 = new BKTransactionAPI($location."/services/transaction_api/init?wsdl");
$domain_pay_bk       = $location;

$accountInfoRequest = new AccountInfoRequest();
$accountInfoRequest->merchant_id  = $merchant_id;
$accountInfoRequest->api_username = $api_username;
$accountInfoRequest->api_password = $api_password;
try{
	$accountInfoResponse = $bk->GetAccountInfo($accountInfoRequest);
}catch(Exception $e){
    echo 'Caught exception: ',  $e->getMessage(), "\n";
    var_dump($e);
}

?>