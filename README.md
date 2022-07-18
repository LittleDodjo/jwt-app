###LARAVEL JWT-APP

###Приложение API RESTFul


1) Создать аутентификацию пользователя JWT
2) Регистрация пользователя ( Почта, Имя, Фамилия, Пароль )
3) Аутентификация пользователя при помощи JWT
4) Обновление ключа аутентификации
5) Выход пользователя


1) Номера отеля
2) Посмотреть все номера отеля (Номер, номер этажа, краткое описание, статус брони [не забронирован, забронирован]
3) Посмотреть все забронированные номера
4) Посмотреть все не забронированные номера
5) Посмотреть номер

1) Удалить бронь
2) Забронировать номер
3) Изменить статус бронирования
4) Изменить дату заезда

1) Пользователи
2) Посмотреть пользователя
3) Отобразить список бронированных номеров пользователя
4) Показать всех пользователей

Список конечных точек

[GET|HEAD   api/users  -- Показать всех пользователей]
[GET|HEAD   api/user/{id}/rooms -- Показать забронированые номера пользователя]
[ET|HEAD   api/user/{id} -- Показать данные пользователя]
[GET|HEAD   api/rooms -- Посмотреть список всех комнат
(?page=1) - Пагинация & (book={0, 1}) -- Фильтрация по статусу]
[PATCH      api/room/{id}/update/status -- Обновить данные забронированной комнаты (Статус подтверждения брони)]
[PATCH      api/room/{id}/update/date -- Обновить данные забронированной комнаты (Дата прибытия)]
[DELETE     api/room/{id}/unbook -- Снять бронирование]
[POST       api/room/{id}/book  -- Забронировать номер]
[GET|HEAD   api/room/{id} -- Получить комнату по ID]
[POST       api/register  -- Регистрация пользователя]
[POST       api/refresh  -- Обновление JWT токена]
[POST       api/logout -- Разлогиниться]
[POST       api/login -- Залогиниться]
