<?
function CreateSendMail($toFrom, $toAddress, $ccAddress, $bccAddress, $subject, $body, $type)
{
   $type = strtoupper($type);
   $int_type = $type;

   $MailContent = $body;
   $SendFrom = $toFrom;
   $SendTo = $toAddress;
   $Status = 0;
   $Subject = $subject;
   $Type = $type;
   $timesend = date("Y-m-d H:i:s", time());
   //send mail to hunghabay
   SendmailHunghapay("D66", "C97A94C1A7992D87B0B141170DBBAB7A", $toAddress, $subject, $body, $int_type);
   //$type
   // 10 xác thực đăng ký ứng viên
   // 11 xác thực đăng ký ntd
   // 12 gửi lại mail xác thực cho ntd và uv
   // 13 gửi thông báo có ứng viên nộp hồ sơ ứng tuyển cho NTD
   // 14 gửi thông báo cho ứng viên khi ứng viên nộp hồ sơ ứng tuyển
   // 15 quên mật khẩu ntd và uv
}
function SendmailHunghapay($partner, $pass, $toAddress, $subject, $body, $int_type)
{
   $soapUrl = "http://quanlymails.timviec365.vn/SendMail.asmx?op=CreateMail"; // asmx URL of WSDL
   // xml post structure
   $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
   <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
     <soap:Body>
       <CreateMail xmlns="http://tempuri.org/">
         <partner>' . $partner . '</partner>
         <pass>' . $pass . '</pass>
         <fromAddress>admin@timviec365.com</fromAddress>
         <toAddress>' . $toAddress . '</toAddress>
         <subject>' . $subject . '</subject>
         <body>' . $body . '</body>
         <type>' . $int_type . '</type>
       </CreateMail>
     </soap:Body>
   </soap:Envelope>';   // data from the form, e.g. some ID number
   $headers = array(
      "Content-Type: text/xml; charset=utf-8",
      "Accept: text/xml",
      "Cache-Control: no-cache",
      "Pragma: no-cache",
      "Content-length: " . strlen($xml_post_string),
   ); //SOAPAction: your op URL
   $url = $soapUrl;
   // PHP cURL  for https connection with auth
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
   curl_setopt($ch, CURLOPT_TIMEOUT, 10);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   // converting
   $response = curl_exec($ch);
   curl_close($ch);
}
function SendMailAmazon($title, $name, $email, $body)
{
   // $usernameSmtp = 'AKIASP3FAETF6HX7PXQE';
   // $passwordSmtp = 'BF7UhBI+t7u29TA7Rn5NH0Kg1XbR9zLbMHSjPYag7uDu';  
   $usernameSmtp = 'AKIASP3FAETFWQKSULUF';
   $passwordSmtp = 'BCOYT02e1Y2OKZCwQAj5nV4HaNsijyt0e8SaB/Vl0nI9';
   $host = 'email-smtp.ap-south-1.amazonaws.com';
   $port = 587;
   // $sender = 'admin@timviec365.com';
   $sender = 'no-reply@timviec365.com.vn';
   $senderName = 'Timviec365.com';

   $mail             = new PHPMailer(true);

   $mail->IsSMTP();
   $mail->SetFrom($sender, $senderName);
   $mail->Username   = $usernameSmtp;  // khai bao dia chi email
   $mail->Password   = $passwordSmtp;              // khai bao mat khau   
   $mail->Host       = $host;    // sever gui mail.
   $mail->Port       = $port;         // cong gui mail de nguyen 
   $mail->SMTPAuth   = true;    // enable SMTP authentication
   $mail->SMTPSecure = "tls";   // sets the prefix to the servier        
   $mail->CharSet  = "utf-8";
   $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
   // xong phan cau hinh bat dau phan gui mail
   $mail->isHTML(true);
   $mail->Subject    = $title; // tieu de email 
   $mail->Body       = $body;
   $mail->addAddress($email, $name);


   if (!$mail->Send()) {
      echo $mail->ErrorInfo;
   }
}
function SendBuyCard($mailto, $fullname, $mailBody)
{
   $body = '<!DOCTYPE html>
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>[doithe66.com] - Email thông tin mua mã thẻ</title>
   </head><body><div style="width: 800px; margin: 0 auto;font-size:14px; background-color: #fff; border: 1px solid #cccccc;">
   <div style="padding:7px 15px;"><div style="padding: 5px 0px 7px 0px; border-bottom: 5px solid #d3e2ff;margin-bottom:25px;">
   DOITHE66.COM</div><b>Dịch mua mã thẻ trên Doithe66.com</b><br><br>
   <p>Xin chào <b>' . $fullname . '</b>,</p><br>Bạn vừa sử dụng dịch vụ mua mã thẻ trên doithe66.com, sau đây là thông tin mã thẻ của bạn:
   <p><span>Thông tin giao dịch: </span></p><div><p>' . $mailBody . '</p></div>
   </div><div style="padding:7px 15px;"><p><b>Cảm ơn bạn đã sử dụng dịch vụ của Chúng tôi</b></p>
   <p style="line-height:25px;">Để biết thêm chi tiết về dịch vụ hoặc đóng góp ý kiến cho Chúng tôi, Quý khách vui lòng liên hệ qua số điện thoại: 0981.744.861 - 02466.557.198 hoặc Email: support@doithe66.com</p>
   <p>Trân trọng,</p><p><b>doithe66.com</b></p></div></div></body></html>';
   $message = "";

   $body = base64_encode($body);
   CreateSendMail($mailto, $mailto, "", "", "[doithe66.com] - Mua mã thẻ", $body, 1);
}
function SendRegisterUV($email, $lastname, $link)
{
   $body = '<body style="width: 100%;text-align: center;background-color: #eeeeee;padding: 0;margin: 0;font-family: Arial,sans-serif;padding-top: 20px;padding-bottom: 20px;">
      <table style="width: 600px;background: #fff;margin: 0 auto;border-collapse: collapse;">
         <tr style="background: #3a4c56;border-bottom: 5px solid #2befca;height: 81px;">
            <td style="width: 218px;padding-left: 33px;text-align: left;">
            <a href="https://timviec365.com" title="Tìm việc làm nhanh, việc làm thêm" style="text-decoration: none;">
               <img src="https://timviec365.vn/images/logo_email.png" alt="Tìm việc làm nhanh, việc làm thêm" title="Tìm việc làm nhanh, việc làm thêm" />
            </a>
            <a style="text-decoration: none;color:#dfdfdf;color:#dfdfdf;font-size:14px;float:right;padding-top:25px;padding-right:34px;" href="https://timviec365.com" title="Tìm việc làm nhanh, việc làm thêm">Timviec365.com</a>
            </td>
         </tr>
         <tbody >
         <tr>
            <td style="width: 100%;padding: 0 33px;">
               <h1 style="color: #3a4c56;font-size: 16px;padding-top: 10px;text-align: left;margin: 15px 0 10px 0;">Xin chào <span style="color:#269b91;">' . $lastname . '!</span></h1>
               <p style="margin: 0;font-size: 14px;text-align: left;color: #3a4c56;line-height: 20px;margin-bottom: 10px;">Chúc mừng bạn đã hoàn thành thông tin đăng ký tài khoản Người tìm việc tại <a style="color: #269b91;font-size: 14px;font-weight: 600;" href="https://timviec365.com" title="Tìm việc 365" >Timviec365.com</a></p>
               <p style="margin: 0;font-size: 14px;text-align: left;color: #3a4c56;line-height: 20px;margin-bottom: 10px;">Dưới đây là thông tin tài khoản đã tạo:</p>
               <p style="margin: 0;font-size: 14px;text-align: left;color: #3a4c56;line-height: 20px;margin-bottom: 10px;">- Tài khoản: ' . $email . '</p>
               <p style="margin: 0;font-size: 14px;text-align: left;color: #3a4c56;line-height: 20px;margin-bottom: 10px;">- Mật khẩu: *************</p>
               <p style="margin: 0;font-size: 14px;text-align: left;color: #3a4c56;line-height: 20px;margin-bottom: 10px;">Vui lòng xác thực tài khoản để tạo hồ sơ trực tuyến và được tìm kiếm bởi 250.000 Nhà tuyển dụng hàng đầu bằng cách bấm vào link dưới đây:</p>
               <p style="height:50px;text-align: center;background: #269b91;color: #fff;line-height: 52px;font-size: 14px;font-weight: 500;margin: 30px auto; width:170px"><a style="color:#fff;font-size: 14px;font-weight: 600" target="_blank" href="' . $link . '">XÁC THỰC EMAIL</a></p>
            </td>
         </tr>
         <tr>
            <td style="background: #f7f7f7;display: block;padding: 10px 0;font-size: 14px;color: #3a4c56;margin-left: 30px;margin-right: 30px;border: 1px solid #b1d8d5;">
               <p style="font-weight: bold;margin-bottom: 10px;">Chúc bạn sớm tìm được một công việc phù hợp!</p>
               <p style="font-weight: bold;margin-bottom: 10px;">Hoặc gọi số hotline: <span style="color:#f05e5e;">1900 633 682</span> để được hỗ trợ</p>
            </td>
         </tr>
         <tr>
            <td style="margin-top: 10px;;margin-bottom: 10px;display: block;padding: 10px 0;font-size: 14px;color: #3a4c56">
               <p style="font-weight: bold;margin-bottom: 10px;"><span style="color:#269b91;">Timviec365.com </span>- Cầu nối giữa ứng viên và nhà tuyển dụng</p>
               <p style="margin-top: 0;margin-bottom: 10px;">Tầng 4, B50,<span style="color:#269b91;"><u>Lô 6, KĐT Định Công - Hoàng Mai - Hà Nội</u></span></p>
            </td>
         </tr>
         </tbody>
      </table>
      </body>';
   $message = "";

   $body = base64_encode($body);


   CreateSendMail($email, $email, "", "", "Đăng ký tài khoản ứng viên -" . time(), $body, 10);
}

function SendRegisterTVC($email, $company_name, $link)
{
   $body = file_get_contents('../EmailTemplate/01mailxacthucdangkyungvien.htm');
   $body = str_replace('<%name%>', $company_name, $body);
   $body = str_replace('<%link%>', $link, $body);
   $title = " Email xác thực thông tin tài khoản ứng viên ";

   $message = "";
   SendMailAmazon($title, $company_name, $email, $body);
}
function SendRegisterOTPUV($email, $company_name, $otp)
{
   $body = file_get_contents('../EmailTemplate/27mailxacthucdangkyungvien.htm');
   $body = str_replace('<%name%>', $company_name, $body);
   $body = str_replace('<%otp%>', $otp, $body);
   $title = " Email xác thực thông tin tài khoản ứng viên ";

   $message = "";
   SendMailAmazon($title, $company_name, $email, $body);
}

function SendRegisterNTD($email, $company_name, $link)
{
   $body = file_get_contents('../EmailTemplate/02mailxacthucdangkynhatuyendung.htm');
   $body = str_replace('<%company%>', $company_name, $body);
   $body = str_replace('<%link%>', $link, $body);
   $title = "Email xác thực thông tin tài khoản nhà tuyển dụng";
   $message = "";
   SendMailAmazon($title, $company_name, $email, $body);
}
function SendMailOTP($email, $company_name, $otp){
   $body = file_get_contents('../EmailTemplate/24mailxacthucdangkynhatuyendung.htm');
   $body = str_replace('<%company%>', $company_name, $body);
   $body = str_replace('<%otp%>', $otp, $body);
   $title = "Email xác thực thông tin tài khoản nhà tuyển dụng";
   $message = "";
   SendMailAmazon($title, $company_name, $email, $body);
}
function SendMailOTPQMK($email, $company_name, $otp){
   $body = file_get_contents('../EmailTemplate/25maillaylaimatkhauntd.htm');
   $body = str_replace('<%company%>', $company_name, $body);
   $body = str_replace('<%otp%>', $otp, $body);
   $title = "Email lấy lại mật khẩu tài khoản nhà tuyển dụng ";
   $message = "";
   SendMailAmazon($title, $company_name, $email, $body);
}

function SendRegisterRedo($email, $type, $lastname, $tit, $content, $foot, $link)
{
   $body = '<body style="width: 100%;text-align: center;background-color: #eeeeee;padding: 0;margin: 0;font-family: Arial,sans-serif;padding-top: 20px;padding-bottom: 20px;">
      <table style="width: 600px;background: #fff;margin: 0 auto;border-collapse: collapse;">
         <tr style="background: #3a4c56;border-bottom: 5px solid #2befca;height: 81px;">
            <td style="width: 218px;padding-left: 33px;text-align: left;">
            <a href="https://timviec365.com" title="Tìm việc làm nhanh, việc làm thêm" style="text-decoration: none;">
               <img src="https://timviec365.vn/images/logo_email.png" alt="Tìm việc làm nhanh, việc làm thêm" title="Tìm việc làm nhanh, việc làm thêm" />
            </a>
            <a style="text-decoration: none;color:#dfdfdf;color:#dfdfdf;font-size:14px;float:right;padding-top:25px;padding-right:34px;" href="https://timviec365.com" title="Tìm việc làm nhanh, việc làm thêm">Timviec365.com</a>
            </td>
         </tr>
         <tbody >
         <tr>
            <td style="width: 100%;padding: 0 33px;">
               <h1 style="color: #3a4c56;font-size: 16px;padding-top: 10px;text-align: left;margin: 15px 0 10px 0;">Xin chào <span style="color:#269b91;">' . $lastname . '!</span></h1>
               <p style="margin: 0;font-size: 14px;text-align: left;color: #3a4c56;line-height: 20px;margin-bottom: 10px;">' . $tit . ' <a style="color: #269b91;font-size: 14px;font-weight: 600;" href="https://timviec365.com" title="Tìm việc 365" >Timviec365.com</a></p>
               <p style="margin: 0;font-size: 14px;text-align: left;color: #3a4c56;line-height: 20px;margin-bottom: 10px;">Dưới đây là thông tin tài khoản đã tạo:</p>
               <p style="margin: 0;font-size: 14px;text-align: left;color: #3a4c56;line-height: 20px;margin-bottom: 10px;">- Tài khoản: ' . $email . '</p>
               <p style="margin: 0;font-size: 14px;text-align: left;color: #3a4c56;line-height: 20px;margin-bottom: 10px;">- Mật khẩu: *************</p>
               <p style="margin: 0;font-size: 14px;text-align: left;color: #3a4c56;line-height: 20px;margin-bottom: 10px;">' . $content . '</p>
               <p style="height:50px;text-align: center;margin: 0;background: #269b91;color: #fff;line-height: 52px;font-size: 14px;font-weight: 500;margin: 30px auto; width:170px"><a style="color:#fff;font-size: 14px;font-weight: 600" target="_blank" href="' . $link . '">XÁC THỰC EMAIL</a></p>
            </td>
         </tr>
         <tr>
            <td style="background: #f7f7f7;display: block;padding: 10px 0;font-size: 14px;color: #3a4c56;margin-left: 30px;margin-right: 30px;border: 1px solid #b1d8d5;">
               <p style="font-weight: bold;margin-bottom: 10px;">' . $foot . '</p>
               <p style="font-weight: bold;margin-bottom: 10px;">Nếu gặp khó khăn, bạn vui lòng liên hệ qua email: <span style="color:#f05e5e;">Timviec365.com@gmail.com</span></p>
               <p style="font-weight: bold;margin-bottom: 10px;">Hoặc gọi số hotline: <span style="color:#f05e5e;">1900 633 682</span> để được hỗ trợ</p>
            </td>
         </tr>
         <tr>
            <td style="margin-top: 10px;;margin-bottom: 10px;display: block;padding: 10px 0;font-size: 14px;color: #3a4c56">
               <p style="font-weight: bold;margin-bottom: 10px;"><span style="color:#269b91;">Timviec365.com </span>- Cầu nối giữa ứng viên và nhà tuyển dụng</p>
               <p style="margin-top: 0;margin-bottom: 10px;">Tầng 4, B50,<span style="color:#269b91;"><u>Lô 6, KĐT Định Công - Hoàng Mai - Hà Nội</u></span></p>
            </td>
         </tr>
         </tbody>
      </table>
      </body>';
   $message = "";

   $body = base64_encode($body);


   CreateSendMail($email, $email, "", "", $type . " - " . time(), $body, 12);
}


function Send_HS_NTD($email, $firstna, $addna, $tit, $company, $kinh_nghiem, $subject, $link_uri, $url)
{
   $link = "https://timviec365.com" . $link_uri . "";

   $body = file_get_contents('../EmailTemplate/06mailthongbaoungviennophosontd.htm');
   $body = str_replace('<%company%>', $company, $body);
   $body = str_replace('<%tt%>', $tit, $body);
   $body = str_replace('<%name%>', $firstna, $body);
   $body = str_replace('<%exp%>', $kinh_nghiem, $body);
   $body = str_replace('<%addr%>', $addna, $body);
   $body = str_replace('<%link%>', $link, $body);
   if ($url != '') {
      $body = str_replace('<%url_cv%>', '<tr><td><p style="font-size: 18px;margin: 0"><a href="' . $url . '">CV đính kèm</a></p></td></tr>', $body);
   } else {
      $body = str_replace('<%url_cv%>', $url, $body);
   }
   $message = "";
   SendMailAmazon($subject, $company, $email, $body);
   // $body = base64_encode($body);


   // CreateSendMail($email,$email,"","",$subject, $body,13);
}


function Send_HS_UV($email, $name, $tit, $company, $dmca, $subject)
{
   $body = file_get_contents('../EmailTemplate/07mailungviennophosothanhcong.htm');
   $body = str_replace('<%name%>', $name, $body);
   $body = str_replace('<%tit%>', $tit, $body);
   $body = str_replace('<%company%>', $company, $body);
   $body = str_replace('<%dmca%>', $dmca, $body);
   $message = "";

   SendMailAmazon($subject, $name, $email, $body);
   // $body = base64_encode($body);


   // CreateSendMail($email,$email,"","",$subject, $body,14);
}


function Send_QMK($email, $user_name, $token, $id)
{
   $link = "https://timviec365.com/doi-mat-khau.html?reset_token=" . $token . "&id=" . $id . "";

   $body = file_get_contents('../EmailTemplate/03maillaylaimatkhauungvien.htm');
   $body = str_replace('<%name%>', $user_name, $body);
   $body = str_replace('<%link%>', $link, $body);
   $title = "Email lấy lại mật khẩu tài khoản ứng viên ";
   $message = "";
   SendMailAmazon($title, $user_name, $email, $body);
   // $body = base64_encode($body);


   // CreateSendMail($email,$email,"","",$title, $body,15);
}

function Send_QMKNTD($email, $user_name, $token, $id)
{
   $link = "https://timviec365.com/doi-mat-khau-nha-tuyen-dung.html?reset_token=" . $token . "&id=" . $id . "";

   $body = file_get_contents('../EmailTemplate/04maillaylaimatkhauntd.htm');
   $body = str_replace('<%company%>', $user_name, $body);
   $body = str_replace('<%link%>', $link, $body);
   $title = "Email lấy lại mật khẩu tài khoản nhà tuyển dụng ";
   SendMailAmazon($title, $user_name, $email, $body);
   // $body = base64_encode($body);


   // CreateSendMail($email,$email,"","",$title, $body,15);
}
function Send_OTP_QMKNTD($email, $user_name, $otp)
{
   
   $body = file_get_contents('../EmailTemplate/25maillaylaimatkhauntd.htm');
   $body = str_replace('<%company%>', $user_name, $body);
   $body = str_replace('<%otp%>', $otp, $body);
   $title = "Email lấy lại mật khẩu tài khoản nhà tuyển dụng ";
   SendMailAmazon($title, $user_name, $email, $body);
   // $body = base64_encode($body);


   // CreateSendMail($email,$email,"","",$title, $body,15);
}
function Send_OTP_QMKUV($email, $user_name, $otp)
{
   $body = file_get_contents('../EmailTemplate/26maillaylaimatkhauungvien.htm');
   $body = str_replace('<%name%>', $user_name, $body);
   $body = str_replace('<%otp%>', $otp, $body);
   $title = "Email lấy lại mật khẩu tài khoản ứng viên ";
   SendMailAmazon($title, $user_name, $email, $body);
}

function SentMailChat($title_mail, $email_receive, $user_name, $link)
{
   $body = file_get_contents('../../EmailTemplate/mail_chat.htm');
   $body = str_replace('<%name%>', $user_name, $body);
   $body = str_replace('<%link%>', $link, $body);
   SendMailAmazon($title_mail, $user_name, $email_receive, $body);
}
