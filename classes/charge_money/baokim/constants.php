<?php

//CẤU HÌNH TÀI KHOẢN (Configure account)
if ($_SERVER['SERVER_NAME'] == 'localhost')
{
	define('EMAIL_BUSINESS', 'dev.baokim@bk.vn'); //Email Bảo kim
	define('MERCHANT_ID', '955'); // Mã website tích hợp
	define('SECURE_PASS', '43284c9d2ed45ff1'); // Mật khẩu

	// Cấu hình tài khoản tích hợp
	define('API_USER', 'merchant'); //API USER
	define('API_PWD', '1234'); //API PASSWORD

	define('PRIVATE_KEY_BAOKIM', '-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDZZBAIQz1UZtVm
p0Jwv0SnoIkGYdHUs7vzdfXYBs1wvznuLp/SfC/MHzHVQw7urN8qv+ZDxzTMgu2Q
3FhMOQ+LIoqYNnklm+5EFsE8hz01sZzg+uRBbyNEdcTa39I4X88OFr13KoJC6sBE
397+5HG1HPjip8a83v8G4/IPcna5/3ydVbJ9ZeMSUXP6ZyKAKay4M22/Wli7PLrm
1XNR9JgIuQLma74yCGkaXtCJQswjyYAmwDPpz4ZknSGuBYUmwaHMgrDOQsOXFW7/
7M2KbjenwggAW98f0f97AR2DEq9Eb5r8vzyHURnHGD3/noZxl993lM2foPI3SKBO
1KpSeXRzAgMBAAECggEANMINBgRTgQVH6xbSkAxLPCdAufTJeMZ56bcKB/h2qVMv
Wvejv/B1pSM489nHaPM5YeWam35f+PYZc5uWLkF23TxvyEsIEbGLHKktEmR73WkS
eqNI+/xd4cJ3GOtS2G2gEXpBVwdQ/657JPvz4YZNdjfmyxMOr02rNN/jIg6Uc8Tz
vbpGdtP49nhqcOUpbKEyUxdDo6TgLVgmLAKkGJVW40kwvU9hTTo6GXledLNtL2kD
l6gpVWAiT6xlTsD5m74YzsxCSjkh60NdYeUDYwMbv0WWH3kJq6qD063ac3i/i8H+
B5nGf4KbKg1bBjPLNymUj7RRnKjHr301i2u8LUQYuQKBgQD15YCoa5uHd6DHUXEK
kejU34Axznr3Gs6LqcisE7t0oQ9hB4s16U9f4DBHDOvnkLb0zkadwdEmwo/D/Tdf
5c/JEk8q/aO9Wk8uV4Bswnx1OV9uKMzMOZbv/So1DQg1aW1MgvRnj3SiKpDUkNwr
en4NT9tbH21SmVIO9Da5KpiFRwKBgQDiUrg1hp8EDaeZFTG9DvcwyTTrpD/YT9Wr
s/NtEnPMjy0NXWcEXwGzx90P+qjJ+J29Hk89QHON6S7o0X2lUIer3uXokc86ce76
5UIbR6u7R1T6TUNfwqwwNfIbgtFN4+7ybodPNZ5DWslKLqMr5wpwIOr7/U5ih7BH
JK0cSriddQKBgGXzNZiepOlRrBN3rMqZHFPGJrx/w3PYZXJ6fnz54WrFrD6qhglg
Jky2As4yiUyFL5XoQFcAGNtdJ4Y24lKcUb4oHTLR3qWPX+zy0ohFSpy/oNVnjSHP
bskpyeoc8R5UC8EBOpwFWnIx+8JmHSLZspGKXoQ1T3pDn0Yb8uRqyLnZAoGBAKdk
NwqfvwzobIU0v8ztPLbAmnuOyAndQlP0jJ6nfy5U1yWDZ6Y7/q5RrJcc9aosT76I
pGLRQKY9SYy5JQ0YOsBL5A/XiEXZ7r9ywSocIFAruhZG/wXcni4qOB9Q6i2J4Dk+
tqVHKv72LtrHE7hs8bNtJV+rQkZtxVtZLRA308PhAoGBALVEaYMRm97V+Tnsej6q
fuT/6oKHPqZpur2rNfEKVn5Aq2kmFrvyUhvXi0IAWQ/XS3XJ7faQnprrWT6pYiSy
2YQuaghlNG1SATVd5eUadq2pA8DuSzqWFa0Ac1IAyliBO2uLPL7LzuEKmmuQk0vI
TU2Q8idAb77K7mvVguA3LDhN
-----END PRIVATE KEY-----');


	define('BAOKIM_URL', 'http://kiemthu.baokim.vn');
} else
{
	define('EMAIL_BUSINESS', 'phuongttx@webbnc.vn'); //Email Bảo kim
	//define('MERCHANT_ID', '17035'); // Mã website tích hợp
	//define('SECURE_PASS', 'a607bf937eba8a2a'); // Mật khẩu

	define('MERCHANT_ID', '17209'); // Mã website tích hợp
	define('SECURE_PASS', '1b17953a3bb8f0c9'); // Mật khẩu

	define('API_USER', 'ntdinh1987'); //API USER
	define('API_PWD', 'nmHej13Mo0GcL21QB54KwZAxs4UTv'); //API PASSWORD

	define('PRIVATE_KEY_BAOKIM', '-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDZR9aYnIa7suHG
wkAlF693OHVxRGUoq3gwQgAl6e/D0msAfMoaBRuiFLBtJ1DxWAKO4GPXcVMIX8sm
kTZg6NYPsdsuRg8ArKz5JefDayJNuwDdu84VauTQbOnGOaYYPBx1yK/MVYQwqGxN
scmuX3rCr/6aQnVMP89bFTG7bs0VsSYLFUsPoMM9YWaxlNWydDYEZokX7kOT01qb
o1gdfAu+3vOEyPAlzc5UsQ/F571wBLrrPNySMw0TGD+Exhd1Kuis2Mz8WFg+zG49
UhTzkbBA4kkPKcMJxpPudjHny6YfH7MBDnBNSTDB+asXugPq9+WJ2CK3FEANtjjL
ox3TLeCRAgMBAAECggEAf77HwXQNlt9F9LiSQ/yX8g0kp1Jh8zZU9HJpaeEPUV8t
/9xeakvkgjeNvq8l3K802dG9gZYkDkFbzDIF+ZYK/LFBvwP7oBbln5oUmAUt5uty
R+s578en/Y57J0sPhyIYTXuPOCBzFrR+8HL9s2J5Z2tX0lQOaKT/gXqFgcBUHVKy
5hz5U5TvSO7yKPfS2BWk9KP2eTruiKQfbexfEOlcj2fYLpcoCrIMu3PG2GUVCksB
1ieJ28u4fRxyD1499Y+/WFaL4eWmqSDZs/M9l2HSqmROUJNBVx8o0qbTxqq2T0Ut
c72Xj0hWSBjTPbFx+enGKcStzYxBG5XNgjPOmHQcAQKBgQD4vqQR9FTjIjAVDL8D
qteIS9xcaWUll/mnsgHvL4q4RUZsHN130dlwxllrEEd9lqMjW7U6BozFsXWqMVSZ
LrdDMJ+LWr65+/Dd8ocKkhpRUAeCwHuxL5DS9ukUe1IJU5940EKlorCghFMnJrPc
tN69x67t15PvDVazDE9G9A9iUQKBgQDfnkHhs3ttaxk4c03nxP77o8qDqDibT/qg
RqC+3HCFt+1ZVxaa9s/LRY+CxVHQaCWupcIWuhgJGFGogifBhu8IZNgZhLp0rzl9
smnQtps902HKEZJAejvrdpmi00mn/zAfV74uySHpP2P1z0Expz9MSkp7h86DDvUS
V06SbhLKQQKBgQDVwBUDbL+pcw54eDyIrT2LXQ0eyF7nwEID7f6liGgfU0Bh1Sgn
N8gvlfLvAs08Sb8kukDwfQJpO8bOGpgFDlTjQxxGxxMQhUSFpUyQM96zsx7RKBDi
wOolr5G5TQPBCgAG9IfhB/3Z4fwGr8ZtyWuDD93teowgJ4kyUUiqwz2ZEQKBgFPb
5HcAuPvKmxWpYADXxouV2/9NmZTdBG8QrX2F64ip9g938llAz6I6PtxapRjTxbXe
IZAmT5cxkIXx8XjI4mEyeDvxo37Yq2Ww/6+umz8vQ0/lEQSvEkN2IZ2HQOsIbwKC
BCdFdDslc5YeGCPHxZwVjCMRReeuN0eeiC+vqcpBAoGAXgUXkjOHqtkwB1h0bnq/
VdmtCw2sjp/F51gPGOD7O/m5U6bLsB/QCxI6+CS3UjoIOJm+dLRKrUAJjwjbwHvo
QOQcofAUV8TGc8nb6Ck0KLF0EN/8BnijWaWkTaCQ8WULJi6EeDzMT5ZUWlSgX/Wi
3OKoZ4MRKlSrvI+eu7CIDYc=
-----END PRIVATE KEY-----');

	define('BAOKIM_URL', 'https://www.baokim.vn');
}


define('BAOKIM_API_SELLER_INFO', '/payment/rest/payment_pro_api/get_seller_info');
define('BAOKIM_API_PAY_BY_CARD', '/payment/rest/payment_pro_api/pay_by_card');
define('BAOKIM_API_PAYMENT', '/payment/order/version11');


//Phương thức thanh toán bằng thẻ nội địa
define('PAYMENT_METHOD_TYPE_LOCAL_CARD', 1);
//Phương thức thanh toán bằng thẻ tín dụng quốc tế
define('PAYMENT_METHOD_TYPE_CREDIT_CARD', 2);
//Dịch vụ chuyển khoản online của các ngân hàng
define('PAYMENT_METHOD_TYPE_INTERNET_BANKING', 3);
//Dịch vụ chuyển khoản ATM
define('PAYMENT_METHOD_TYPE_ATM_TRANSFER', 4);
//Dịch vụ chuyển khoản truyền thống giữa các ngân hàng
define('PAYMENT_METHOD_TYPE_BANK_TRANSFER', 5);
//Phương thức thanh toán qua vatgia
define('PAYMENT_METHOD_TYPE_VATGIA', 6);
//Phương thức thanh toán qua Bao kim
define('PAYMENT_METHOD_TYPE_BAOKIM', 7);

?>