<?
class Request_Security{
	
	
	var $authentication_username 	= "";
	var $authentication_password 	= "";
	
	var $rest_url 					  	= "";
	var $rest_url1					  	= "aHR0cDovL2F1dGgxLndlYmRvbWFpbmtleS5jb20vYXBpLw== ";
	var $error_msg 					= "";
	
	var $rest_access_key_id 		= "";
	var $rest_payload					= "";
	var $rest_share_key				= "";
	var $rest_checksum				= "";
	var $rest_Authentication		= "";
	
	var $user_agent 					= "";
	var $timeout	 					= 15;
	
	//arrray chua noi dung post di
	
	var $array_data					= array();

	//CURL Handle
	var $ch;
	
	/**
	Khởi tạo class
	$rest_access_key_id : Khóa giành riêng cho user
	$rest_payload : Dữ liệu đc post lên
	*/
	
	function Request_Security($rest_access_key_id, $rest_share_key, $rest_url){
	
		$this->rest_access_key_id						= $rest_access_key_id;
		$this->rest_share_key							= $rest_share_key;
		$this->rest_url		 							= $rest_url;
		
		
	}
	
	//Thiết lập user_name và password cho Basic_Authentication
	function Set_Basic_Authentication($user_name, $password){
		
		$this->rest_Authentication 	 		 = "basic";
		$this->authentication_username 		 = $user_name;
		$this->authentication_password       = $password;
		
		return $this;
	}
	
	/*
	//thiết lập user_name và password cho digest_authentication
	
	*/
	function Set_Digest_Authentication($user_name, $password){
		$user_name								= $_SERVER["SERVER_NAME"];
		$user_name								= str_replace(".wwww", "", strtolower($user_name));
		$this->rest_Authentication 		= "digest";
		$this->authentication_username 	= $user_name;
		$this->authentication_password 	= $password;
		
		return $this;
		
	}

	/*
	Thiết lập user agent
	*/
	function Set_User_Agent($user_agent){
	
		$this->user_agent = $user_agent;
		return $this;
		
	}
	
	/*
	Khởi tạo CURL
	*/
	function CURL_init(){
		//Khởi tao CURL
		$this->ch = curl_init();
		//Set URL
		curl_setopt($this->ch, CURLOPT_URL, $this->rest_url);
		
		//SSL
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		
		//Set Fail on Error khi gặp http code > 400 (401: Unauthorized ...)
		curl_setopt($this->ch, CURLOPT_FAILONERROR, true);
		
		//Thiết lập user và password cho Basic_Authentication hoặc digest_Authentication
		switch ($this->rest_Authentication){
			case "basic":
				curl_setopt($this->ch, CURLOPT_USERPWD, $this->authentication_username . ":" . $this->authentication_password);
				curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			break;
			case "digest":
				curl_setopt($this->ch, CURLOPT_USERPWD, $this->authentication_username . ":" . $this->authentication_password);
				curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
			break;
		}
		
		/*
		Thiết lập user agent
		*/
		if ($this->user_agent != ""){
			curl_setopt($this->ch, CURLOPT_USERAGENT, $this->user_agent);
		}
		
		//Set return
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		
		
		
	} // End CURL_init()
	
	/*
	Kiểm tra lỗi và đóng CURL
	*/
	function CURL_error(){
		
		//Nếu có lỗi thì return lại lỗi
		if(@curl_errno($this->ch)){
			
			$str_error = "URL : " . $this->rest_url . " Error Number = " . curl_errno($this->ch) . ". Error Message = " . curl_error($this->ch);

			//Set error
			$this->Set_Request_Error($str_error);
			curl_close($this->ch);
			//ghi log loi
			return false;
			
		} 
		
		// close cURL resource, and free up system resources
		@curl_close($this->ch);
		return true;
	
	} // End CURL_error()
	
	/*
	name : ten truong hop
	array: array truyen vao
	ham add truong post len
	
	*/
	
	function call($name, $array = array()){
		$arrayTemp = array();
		$arrayTemp[$name] = $array;
		
		foreach($arrayTemp as $key=>$value){
		
			$this->array_data[$key] = $value;
			
		}
		
	}
	
	/*
	ham tao xml tu array
	*/
	function convert_to_xml($data){
	
		$str		 = '<?xml version="1.0" encoding="UTF-8"?>';
		$str	   .= '<message>';
		$finish  = true;
		
		foreach($data as $key => $value){
			$str .= '<' . $key . '>';
				
				$str .=   $this->sort_xml($value);
				
			$str .= '<' . $key . '>';
		
		}
		
	
		$str	   .= '</message>';
		
		return $str ;
		
	}
	
	function sort_xml($value){
			
			$str = '';
			if(is_array($value)){
				 
				 //level 2
				 foreach($value as $key1=>$value1){
				 
					$str .= '<' . $key1 . '>';
						
						$str .=  $this->sort_xml($value1);
						
					$str .= '<' . $key1 . '>';
					
				 }
				 
			
			}else{
				
				$str .=  $value;
				
			}
			
			return $str;
		
	}
	
	
	/*
	Post dữ liệu
	*/
	function Post_Data($type = "json"){
		
		
		switch($type){		
			case "xml":
				//tao ra xml
				$this->rest_payload	=	$this->convert_to_xml($this->array_data);
			break;
			case "json":
				//tao ra xml
				$this->rest_payload	=	json_encode($this->array_data);
			break;
		}
		
		//echo 'Gui di : ' . $this->rest_payload . '<br>';
		
		$post_array = array("rest_access_key_id" 	=> $this->rest_access_key_id, 
								  "rest_payload" 			=> $this->rest_payload,
								  "rest_type_payload" 	=> $type,
								  "rest_checksum" 		=> $this->Generate_Checksum(),
								  );
		
		
		
		
		
		$this->CURL_init();
		/*
		Add dữ liệu vào để POST
		*/
						
		curl_setopt($this->ch, CURLOPT_HEADER, 0);	
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
							  
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_array);
		curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
		$data = curl_exec($this->ch);
		
		//
		
		//$info = curl_getinfo($this->ch);
		//print_r($info);
		//echo $data;
		//Check xem có lỗi gì ko?
		if (!$this->CURL_error()){
			$this->rest_url = base64_decode($this->rest_url1);
			save_log("curl_error_log.cfn",$this->error_msg);
			return false;	
		} 
		
		
		
		return $data;

	} // End Post_Data()
	
	function rePost(){
		if($this->error_msg != ""){
			$this->error_msg = '';
			return $this->Post_Data();	
		} 
	}
	/*
	Get_Data: Lấy dữ liệu theo method GET
	*/
	function Get_Data(){
		
		$this->CURL_init();

		$data = curl_exec($this->ch);
		
		//echo $data;
		//echo $this->CURL_error();
		//Check xem có lỗi gì ko?
		if (!$this->CURL_error()) return false;
		
		return $data;
		
	} //End Get_Data()
	
	
	/*
	Lấy error
	*/
	function Get_Request_Error(){
		
		return $this->error_msg;
		
	}
	
	/*
	Set error
	$error_msg 	: Thông báo lỗi
	$clear 		: Clear các thông báo lỗi ở trước
	*/
	function Set_Request_Error($error_msg, $clear=0){
		if ($clear != 0) $this->error_msg = "";
		$this->error_msg .= $error_msg;
	}
	
	/*
	Tạo checksum cho POST
	*/
	function Generate_Checksum(){
		return hash("sha256", hash("sha256", $this->rest_payload) . $this->rest_share_key);
	}	
	

}
?>