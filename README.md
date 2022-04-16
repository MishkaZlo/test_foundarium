Реализованы методы 
- просмотр списка автомобилей
- замена (назначение) водителя для автомобиля
- отмена автомобиля

Документация swagger прописана толлько для метода замены водителя

swagger doc просмотреть через web-сервер: *SITE_URI*/api/documentation#/

Project Init steps:

1) npm i

2) composer install

3) php artisan l5-swagger:generate
 
4) php artisan migrate:fresh --seed 
 
если используем встроенный серв:
5) php artisan serve
