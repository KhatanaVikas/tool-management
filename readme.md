About: This is a basic TOOL MANAGEMENT crud application with laravel based backed api.

Setup Guide:

Take a git clone of this project git clone https://github.com/KhatanaVikas/tool-management.git
Composer install


create db tool_manager
sudo chown -R my-user:www-data /path/to/your/laravel/root/directory
sudo find /path/to/your/laravel/root/directory -type f -exec chmod 664 {} \;    
sudo find /path/to/your/laravel/root/directory -type d -exec chmod 775 {} \;
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache

php artisan config:cache
php artisan migrate:refresh --seed

add credentials of mysql in .env file


Insert some tool groups in tools table. insert into tool_groups (name) values ('Measuring Tools'); insert into tool_groups (name) values ('Cutting Tools'); insert into tool_groups (name) values ('Power Tools'); insert into tool_groups (name) values ('Air Presure Tools');
add project to sites_enabled and domain name to hosts.
Good to go!!!
