# SMS GATEWAY
simple sms gateway with supporting multiple driver
## supported drivers are:
1. Ghasedak
2. Kavenegar

>well coded,and you can easily add other driver by implementing SMSInterface

### how to run project:
first fill .env file with correct values and set your **SMS_DRIVER** and **SMS_TOKEN_API**
then for  running project you have two options:
1. running with docker
run command blew in terminal:
> docker-compose build

> docker-compose up

then for running migration you need to enter to the sms_gateway_back_end container and run command below
>php artisan migrate

after all you have to start the queue in sms_gateway_back_end
>php artisan queue:work --queue='sms'
3. running without docker
run command below for installing dependencies
>composer install

then running migrations
>php artisan migrate

and also start the sms queue 
>php artisan queue:work --queue='sms'

then serve the application by 
>php artisan serve
