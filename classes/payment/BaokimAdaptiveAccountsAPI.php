<?php

if (!class_exists("VerifyAccountCredentialRequest")) {
/**
 * VerifyAccountCredentialRequest
 */
class VerifyAccountCredentialRequest {
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
	/**
	 * @access public
	 * @var string
	 */
	public $baokim_account_email;
	/**
	 * @access public
	 * @var string
	 */
	public $baokim_account_phone_no;
	/**
	 * @access public
	 * @var string
	 */
	public $baokim_account_password;
}}

if (!class_exists("VerifyAccountCredentialResponse")) {
/**
 * VerifyAccountCredentialResponse
 */
class VerifyAccountCredentialResponse {
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

if (!class_exists("CheckAccountByEmailRequest")) {
/**
 * CheckAccountByEmailRequest
 */
class CheckAccountByEmailRequest {
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
	/**
	 * @access public
	 * @var string
	 */
	public $baokim_account_email;
}}

if (!class_exists("CheckAccountByEmailResponse")) {
/**
 * CheckAccountByEmailResponse
 */
class CheckAccountByEmailResponse {
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

if (!class_exists("BaokimAdaptiveAccountsAPI")) {
/**
 * BaokimAdaptiveAccountsAPI
 * @author WSDLInterpreter
 */
class BaokimAdaptiveAccountsAPI extends SoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	private static $classmap = array(
		"VerifyAccountCredentialRequest" => "VerifyAccountCredentialRequest",
		"VerifyAccountCredentialResponse" => "VerifyAccountCredentialResponse",
		"CheckAccountByEmailRequest" => "CheckAccountByEmailRequest",
		"CheckAccountByEmailResponse" => "CheckAccountByEmailResponse",
	);

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl="http://sandbox.baokim.vn/services/adaptive_accounts_api/init?wsdl", $options=array()) {
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
	 * Service Call: DoVerifyAccountCredential
	 * Parameter options:
	 * (VerifyAccountCredentialRequest) verify_account_credential_request
	 * @param mixed,... See function description for parameter options
	 * @return VerifyAccountCredentialResponse
	 * @throws Exception invalid function signature message
	 */
	public function DoVerifyAccountCredential($mixed = null) {
		$validParameters = array(
			"(VerifyAccountCredentialRequest)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("DoVerifyAccountCredential", $args);
	}


	/**
	 * Service Call: DoCheckAccountByEmail
	 * Parameter options:
	 * (CheckAccountByEmailRequest) check_account_by_email_request
	 * @param mixed,... See function description for parameter options
	 * @return CheckAccountByEmailResponse
	 * @throws Exception invalid function signature message
	 */
	public function DoCheckAccountByEmail($mixed = null) {
		$validParameters = array(
			"(CheckAccountByEmailRequest)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("DoCheckAccountByEmail", $args);
	}


}}

?>