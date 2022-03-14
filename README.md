# mayinhoadon
Máy in hóa đơn
Sau khi down or pull code về , import database.
Config connect database :
+ function db_init()
 - set : // Khai bao Server localhost day
          $this->server = 'localhost'; --Tên server
          $this->username = 'root';    --Username
          $this->database = 'mayin';   -- Tên database
          $this->passworddb = '';       -- Password(nếu có)
