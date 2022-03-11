<?php

if (!class_exists("PaymentMethod")) {
/**
 * PaymentMethod
 */
class PaymentMethod {
	/**
	 * @access public
	 * @var string
	 */
	public $id;
	/**
	 * @access public
	 * @var string
	 */
	public $name;
	/**
	 * @access public
	 * @var string
	 */
	public $logo_url;
	/**
	 * @access public
	 * @var string
	 */
	public $fix_fee;
	/**
	 * @access public
	 * @var string
	 */
	public $percent_fee;
	/**
	 * @access public
	 * @var string
	 */
	public $fee_currency_code;
	/**
	 * @access public
	 * @var string
	 */
	public $complete_time;
	/**
	 * @access public
	 * @var string
	 */
	public $payment_method_type;
	/**
	 * @access public
	 * @var string
	 */
	public $extra_fields;
}}

if (!class_exists("AccountInfo")) {
/**
 * AccountInfo
 */
class AccountInfo {
	/**
	 * @access public
	 * @var string
	 */
	public $name;
	/**
	 * @access public
	 * @var string
	 */
	public $email;
	/**
	 * @access public
	 * @var string
	 */
	public $status;
	/**
	 * @access public
	 * @var string
	 */
	public $address;
	/**
	 * @access public
	 * @var string
	 */
	public $phone_no;
	/**
	 * @access public
	 * @var string
	 */
	public $allowed_payment_modes;
	/**
	 * @access public
	 * @var PaymentMethod[]
	 */
	public $payment_methods;
}}

if (!class_exists("AccountInfoRequest")) {
/**
 * AccountInfoRequest
 */
class AccountInfoRequest {
	/**
	 * @access public
	 * @var string
	 */
	public $merchant_id;
	/**
	 * @access public
	 * @var string
	 */
	public $api_username;
	/**
	 * @access public
	 * @var string
	 */
	public $api_password;
}}

if (!class_exists("AccountInfoResponse")) {
/**
 * AccountInfoResponse
 */
class AccountInfoResponse {
	/**
	 * @access public
	 * @var string
	 */
	public $error_code;
	/**
	 * @access public
	 * @var string
	 */
	public $error_message;
	/**
	 * @access public
	 * @var AccountInfo
	 */
	public $account_info;
}}

if (!class_exists("PaymentInfoRequest")) {
/**
 * PaymentInfoRequest
 */
class PaymentInfoRequest {
	/**
	 * @access public
	 * @var string
	 */
	public $api_username;
	/**
	 * @access public
	 * @var string
	 */
	public $api_password;
	/**
	 * @access public
	 * @var string
	 */
	public $merchant_id;
	/**
	 * @access public
	 * @var string
	 */
	public $bk_seller_email;
	/**
	 * @access public
	 * @var string
	 */
	public $order_id;
	/**
	 * @access public
	 * @var string
	 */
	public $total_amount;
	/**
	 * @access public
	 * @var string
	 */
	public $tax_fee;
	/**
	 * @access public
	 * @var string
	 */
	public $shipping_fee;
	/**
	 * @access public
	 * @var string
	 */
	public $order_description;
	/**
	 * @access public
	 * @var string
	 */
	public $currency_code;
	/**
	 * @access public
	 * @var string
	 */
	public $bank_payment_method_id;
	/**
	 * @access public
	 * @var string
	 */
	public $payment_mode;
	/**
	 * @access public
	 * @var string
	 */
	public $escrow_timeout;
	/**
	 * @access public
	 * @var string
	 */
	public $payer_name;
	/**
	 * @access public
	 * @var string
	 */
	public $payer_email;
	/**
	 * @access public
	 * @var string
	 */
	public $payer_phone_no;
	/**
	 * @access public
	 * @var string
	 */
	public $shipping_address;
	/**
	 * @access public
	 * @var string
	 */
	public $payer_message;
	/**
	 * @access public
	 * @var string
	 */
	public $extra_fields_value;
	/**
	 * @access public
	 * @var string
	 */
	public $url_return;
}}

if (!class_exists("PaymentInfoResponse")) {
/**
 * PaymentInfoResponse
 */
class PaymentInfoResponse {
	/**
	 * @access public
	 * @var string
	 */
	public $error_code;
	/**
	 * @access public
	 * @var string
	 */
	public $error_message;
	/**
	 * @access public
	 * @var string
	 */
	public $url_redirect;
}}

if (!class_exists("PayerInfo")) {
/**
 * PayerInfo
 */
class PayerInfo {
	/**
	 * @access public
	 * @var string
	 */
	public $payer_name;
	/**
	 * @access public
	 * @var string
	 */
	public $payer_email;
	/**
	 * @access public
	 * @var string
	 */
	public $payer_phone_no;
	/**
	 * @access public
	 * @var string
	 */
	public $shipping_address;
	/**
	 * @access public
	 * @var string
	 */
	public $payer_message;
}}

if (!class_exists("ProductInfo")) {
/**
 * ProductInfo
 */
class ProductInfo {
	/**
	 * @access public
	 * @var string
	 */
	public $product_name;
	/**
	 * @access public
	 * @var string
	 */
	public $product_description;
	/**
	 * @access public
	 * @var integer
	 */
	public $product_quantity;
	/**
	 * @access public
	 * @var string
	 */
	public $product_price;
	/**
	 * @access public
	 * @var string
	 */
	public $product_url_detail;
}}

if (!class_exists("OrderInfo")) {
/**
 * OrderInfo
 */
class OrderInfo {
	/**
	 * @access public
	 * @var string
	 */
	public $order_id;
	/**
	 * @access public
	 * @var string
	 */
	public $order_description;
	/**
	 * @access public
	 * @var string
	 */
	public $order_amount;
	/**
	 * @access public
	 * @var string
	 */
	public $order_url_detail;
}}

if (!class_exists("PayWithBaokimAccountRequest")) {
/**
 * PayWithBaokimAccountRequest
 */
class PayWithBaokimAccountRequest {
	/**
	 * @access public
	 * @var string
	 */
	public $api_username;
	/**
	 * @access public
	 * @var string
	 */
	public $api_password;
	/**
	 * @access public
	 * @var string
	 */
	public $merchant_id;
	/**
	 * @access public
	 * @var string
	 */
	public $baokim_seller_account_email;
	/**
	 * @access public
	 * @var string
	 */
	public $baokim_buyer_account_email;
	/**
	 * @access public
	 * @var string
	 */
	public $total_amount;
	/**
	 * @access public
	 * @var string
	 */
	public $currency_code;
	/**
	 * @access public
	 * @var string
	 */
	public $payment_mode;
	/**
	 * @access public
	 * @var string
	 */
	public $escrow_timeout;
	/**
	 * @access public
	 * @var string
	 */
	public $tax_fee;
	/**
	 * @access public
	 * @var string
	 */
	public $shipping_fee;
	/**
	 * @access public
	 * @var string
	 */
	public $affiliate_id;
	/**
	 * @access public
	 * @var string
	 */
	public $affiliate_site_id;
	/**
	 * @access public
	 * @var string
	 */
	public $business_line_id;
	/**
	 * @access public
	 * @var PayerInfo
	 */
	public $payer_info;
	/**
	 * @access public
	 * @var OrderInfo
	 */
	public $order_info;
	/**
	 * @access public
	 * @var ProductInfo
	 */
	public $product_info;
}}

if (!class_exists("PayWithBaokimAccountResponse")) {
/**
 * PayWithBaokimAccountResponse
 */
class PayWithBaokimAccountResponse {
	/**
	 * @access public
	 * @var string
	 */
	public $response_code;
	/**
	 * @access public
	 * @var string
	 */
	public $response_message;
	/**
	 * @access public
	 * @var string
	 */
	public $transaction_id;
}}

if (!class_exists("VerifyTransactionOTPRequest")) {
/**
 * VerifyTransactionOTPRequest
 */
class VerifyTransactionOTPRequest {
	/**
	 * @access public
	 * @var string
	 */
	public $api_username;
	/**
	 * @access public
	 * @var string
	 */
	public $api_password;
	/**
	 * @access public
	 * @var string
	 */
	public $merchant_id;
	/**
	 * @access public
	 * @var string
	 */
	public $transaction_id;
	/**
	 * @access public
	 * @var string
	 */
	public $sms_otp;
	/**
	 * @access public
	 * @var string
	 */
	public $baokim_buyer_account_email;
}}

if (!class_exists("VerifyTransactionOTPResponse")) {
/**
 * VerifyTransactionOTPResponse
 */
class VerifyTransactionOTPResponse {
	/**
	 * @access public
	 * @var string
	 */
	public $response_code;
	/**
	 * @access public
	 * @var string
	 */
	public $response_message;
}}

if (!class_exists("RequestChargeForPayment")) {
/**
 * RequestChargeForPayment
 */
class RequestChargeForPayment {
	/**
	 * @access public
	 * @var string
	 */
	public $baokim_buyer_account_email;
	/**
	 * @access public
	 * @var string
	 */
	public $bank_payment_method_id;
	/**
	 * @access public
	 * @var string
	 */
	public $seri_field;
	/**
	 * @access public
	 * @var string
	 */
	public $pin_field;
	/**
	 * @access public
	 * @var string
	 */
	public $total_amount;
}}

if (!class_exists("ResponseChargeForPayment")) {
/**
 * ResponseChargeForPayment
 */
class ResponseChargeForPayment {
	/**
	 * @access public
	 * @var string
	 */
	public $error_code;
	/**
	 * @access public
	 * @var string
	 */
	public $error_message;
	/**
	 * @access public
	 * @var string
	 */
	public $amount_card;
	/**
	 * @access public
	 * @var string
	 */
	public $is_payment;
}}

if (!class_exists("BKPaymentProService2")) {
/**
 * BKPaymentProService2
 * @author WSDLInterpreter
 */
class BKPaymentProService2 extends SoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	private static $classmap = array(
		"PaymentMethod" => "PaymentMethod",
		"AccountInfo" => "AccountInfo",
		"AccountInfoRequest" => "AccountInfoRequest",
		"AccountInfoResponse" => "AccountInfoResponse",
		"PaymentInfoRequest" => "PaymentInfoRequest",
		"PaymentInfoResponse" => "PaymentInfoResponse",
		"PayerInfo" => "PayerInfo",
		"ProductInfo" => "ProductInfo",
		"OrderInfo" => "OrderInfo",
		"PayWithBaokimAccountRequest" => "PayWithBaokimAccountRequest",
		"PayWithBaokimAccountResponse" => "PayWithBaokimAccountResponse",
		"VerifyTransactionOTPRequest" => "VerifyTransactionOTPRequest",
		"VerifyTransactionOTPResponse" => "VerifyTransactionOTPResponse",
		"RequestChargeForPayment" => "RequestChargeForPayment",
		"ResponseChargeForPayment" => "ResponseChargeForPayment",
	);

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl="http://localhost:8888/services/payment_pro_2/init?wsdl", $options=array()) {
		foreach(self::$classmap as $wsdlClassName => $phpClassName) {
		    if(!isset($options['classmap'][$wsdlClassName])) {
		        $options['classmap'][$wsdlClassName] = $phpClassName;
		    }
		}
		parent::__construct($wsdl, $options);
	}

	/**
	 * Checks if an argument list matches against a valid argument type list
	 * @param array $arguments The argument list to check
	 * @param array $validParameters A list of valid argument types
	 * @return boolean true if arguments match against validParameters
	 * @throws Exception invalid function signature message
	 */
	public function _checkArguments($arguments, $validParameters) {
		$variables = "";
		foreach ($arguments as $arg) {
		    $type = gettype($arg);
		    if ($type == "object") {
		        $type = get_class($arg);
		    }
		    $variables .= "(".$type.")";
		}
		if (!in_array($variables, $validParameters)) {
		    throw new Exception("Invalid parameter types: ".str_replace(")(", ", ", $variables));
		}
		return true;
	}

	/**
	 * Service Call: GetAccountInfo
	 * Parameter options:
	 * (AccountInfoRequest) account_info_request
	 * @param mixed,... See function description for parameter options
	 * @return AccountInfoResponse
	 * @throws Exception invalid function signature message
	 */
	public function GetAccountInfo($mixed = null) {
		$validParameters = array(
			"(AccountInfoRequest)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("GetAccountInfo", $args);
	}


	/**
	 * Service Call: DoPaymentPro
	 * Parameter options:
	 * (PaymentInfoRequest) payment_info_request
	 * @param mixed,... See function description for parameter options
	 * @return PaymentInfoResponse
	 * @throws Exception invalid function signature message
	 */
	public function DoPaymentPro($mixed = null) {
		$validParameters = array(
			"(PaymentInfoRequest)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("DoPaymentPro", $args);
	}


	/**
	 * Service Call: DoPayWithBaokimAccount
	 * Parameter options:
	 * (PayWithBaokimAccountRequest) pay_with_baokim_account_request
	 * @param mixed,... See function description for parameter options
	 * @return PayWithBaokimAccountResponse
	 * @throws Exception invalid function signature message
	 */
	public function DoPayWithBaokimAccount($mixed = null) {
		$validParameters = array(
			"(PayWithBaokimAccountRequest)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("DoPayWithBaokimAccount", $args);
	}


	/**
	 * Service Call: DoVerifyTransactionOTP
	 * Parameter options:
	 * (VerifyTransactionOTPRequest) verify_transaction_otp_request
	 * @param mixed,... See function description for parameter options
	 * @return VerifyTransactionOTPResponse
	 * @throws Exception invalid function signature message
	 */
	public function DoVerifyTransactionOTP($mixed = null) {
		$validParameters = array(
			"(VerifyTransactionOTPRequest)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("DoVerifyTransactionOTP", $args);
	}


	/**
	 * Service Call: ChargeForPaymentByCard
	 * Parameter options:
	 * (RequestChargeForPayment) Request_Charge_For_Payment
	 * @param mixed,... See function description for parameter options
	 * @return ResponseChargeForPayment
	 * @throws Exception invalid function signature message
	 */
	public function ChargeForPaymentByCard($mixed = null) {
		$validParameters = array(
			"(RequestChargeForPayment)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("ChargeForPaymentByCard", $args);
	}


}}

?>