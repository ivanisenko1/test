чтобы запустить проект необходимо выполнить

git clone 

скопировать .env.example в .env
php artisan generate key
php artisan migrate

сделать GET запрос /api/save-results/9939 или выполнить php artisan app:update-race-result-command 9939

для получения результатов сделать GET запрос /api/get-results с параметрами
driverNumbers - массив с номарами водителей
lapRange - диапазон кругов в виде "3-33"
duration - типу данных '1','2','3' сектора и без параметра время полного круга

для обновления данных сделана команда которая принимает ключ сессии и выполняется каждые 2 часа если запустить Scheduler 