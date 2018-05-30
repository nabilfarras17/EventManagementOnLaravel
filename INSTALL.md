Event Management Installation :

Source Code can runs On Linux, Mac And Windows systems.

First Clone my git repository : 
```
   git clone https://github.com/nabilfarras17/EventManagementOnLaravel.git
```

Setting client_id and client_secret twitter :
```
   You can modify your own client_id and client_secret on config/services.php
``` 

To Configure Database Setting : 
```
    change .env :
    DB_CONNECTION= {your driver DB}
    DB_HOST= {your host DB}
    DB_PORT= {your port DB}
    DB_DATABASE= {your name DB}
    DB_USERNAME= {your username DB}
    DB_PASSWORD= {your password DB}
    
    After that; import loket_com.sql 
```

Setting Admin/lte : 
```
    You can change your configuration for Admin/lte on config/adminlte.php
```

To run Webserver : 
```
    php artisan serve
    Now you can run on your favourite browser with : 
    http://127.0.0.1:8000/ 
    Note : Please using 127.0.0.1:8000 ; not localhost because, I already setting twitter callback to 127.0.0.1 
```