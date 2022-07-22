<p align="center"><img src="https://res.cloudinary.com/dvkfmbfct/image/upload/v1593146311/logo-laramagz-_h3gnfo.svg" width="400"></p>

## About Laramagz (FOR LOCAL)

Laramagz is website based laravel

<p align="center"><img src="https://res.cloudinary.com/dvkfmbfct/image/upload/v1593146282/capture_kwivsb.png"></p>

## Installation

### Server

```
Extract zip
Create database
Impor database laramagz.sql
```

### Local

```
Extract zip
Create database
Edit .env
php artisan migrate --seed
```

## Edit file .env

```
APP_URL=https://domain.com

APP_TIMEZONE=UTC

DB_DATABASE=your_database
DB_USERNAME=your_username_database
DB_PASSWORD=your_password_database

MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=youremail@gmail.com
MAIL_PASSWORD=youremail_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=youremail@gmail.com
MAIL_FROM_NAME=yourname

NOCAPTCHA_SITEKEY=xxxxxxxxxxx
NOCAPTCHA_SECRET=xxxxxxxxxxx

MAILCHIMP_APIKEY=xxxxxxxxxxxxxxx
MAILCHIMP_LIST_ID=xxxxxxxxxxx

ANALYTICS_VIEW_ID=xxxxxxxxx
```

## Google Analytics

Create folder `storage/app/analytics` if not available. 

Insert file `service-account-credetentials.json` to `storage/app/analytics`

Set Google Analytics ID in Settings > Web Config > Google Analytics ID

## Login

**Superadmin**

```
username/email: superadmin / <superadmin@example.com>
password: superadmin123
```

**Admin**

```
username/email: admin / <admin@example.com>
password: admin123
```


**Member**

```
username/email: member / <user@example.com>
password: member123
```

