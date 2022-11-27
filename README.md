## Setup Instructions

### Project versions
```
PHP       8.0.26
Laravel   8.83.26
Node      18.1.0 
npm       8.8.0
Composer  2.4.4
```
### Folow command for clone project and setup env
```bash
##run in terminal
git clone <project_https_url>
cd <project_name>
cp .env.example .env
```
###setup database credentials in env

### Folow command for setup backend
```bash
##run in terminal
composer install 
php artisan key:generate  
php artisan jwt:secret
php artisan migrate
php artisan serve
```

### Folow command for setup frontend
```bash
##run in terminal
npm install
npm run dev
```

### Folow command for config cron job
```bash
##run in terminal
crontab -e

press i

##copy & paste
* * * * * php /path-to-project/artisan schedule:run 1>> /dev/null 2>&1

press :
press w
press q
press Enter

```

##Done !


