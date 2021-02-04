# WEB IPA TOWER
## IPA TOWER

### init
``` 
    composer install 
 ```
### symlink storage
``` 
    php artisan storage:link
 ```
  ### start supervisor with scheduler
``` 
   php artisan schedule:run
 ```
or
``` 
  php artisan queue:work --queue=ipa
 ```