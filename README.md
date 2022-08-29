## Установка и настройка

```bash
$ git clone https://github.com/Scarletfaith/Feedback_test.git
$ cd blog
$ cp .env.example .env
```

Обязательно открываем в редакторе файл .env и настраиваем доступ к базе данных:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1 [Или полный url, если настраиваете на сервере]
DB_PORT=3306 [Не меняете, если не используется другой порт]
DB_DATABASE=laravel [Название БД]
DB_USERNAME=root [Логин к БД]
DB_PASSWORD= [Пароль к БД]
```

Настройка отправки писем (тестовая почта с тестовым доступом):
```bash
MAIL_MAILER=smtp
MAIL_HOST=mx1.mirohost.net
MAIL_PORT=465
MAIL_USERNAME=info@wood-gears.com
MAIL_PASSWORD=V@2SxzUw*E
MAIL_ENCRYPTION=TLS
MAIL_FROM_ADDRESS="info@wood-gears.com"
MAIL_FROM_NAME="${APP_NAME}"
```

Продолжаем настройку

```bash
$ composer install
$ php artisan key:generate
$ php artisan migrate:fresh
$ php artisan storage:link
```

## Добавление Seeds

- Имеется лишь один пользователь в базе с правами "Manager". Login: test_manager@mail.com // Password: F68ef12f68ef12

```bash
$ php artisan db:seed
```
