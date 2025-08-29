чтобы запустить проект необходимо выполнить

git clone https://github.com/ivanisenko1/test.git
скопировать .env.example в .env
выполнить `copmoser install`
выполнить `npm i`
создать БД `laravel`
проверить юзера и пароль для БД
выполнить `php artisan key:generate`
выполнить `php artisan migrate`

ендпоит для загрузки результатов 
`GET /api/save-results/9939` 
или 
выполнить `php artisan app:update-race-result-command 9939`
ключ сессии можно менять

для получения результатов ендпоит 
`GET /api/get-results` с параметрами
`driverNumbers` - массив с номарами водителей
`lapRange` - диапазон кругов в виде "3-33"
`duration` - типу данных '1','2','3' сектора и без параметра время полного круга

примеры параметров
`{
    "driverNumbers": [1],
    "lapRange": "2-3",
    "duration": null
}`
`{
    "driverNumbers": [1,4],
    "lapRange": "2-33",
    "duration": "1"
}`

для обновления данных сделана команда которая принимает ключ сессии и выполняется каждые 2 часа если запустить Scheduler 