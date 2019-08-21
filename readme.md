About:
This is a basic TOOL MANAGEMENT crud application with laravel based backed api.




Setup Guide:

1.  Take a git clone of this project 
    git clone https://github.com/KhatanaVikas/tool-management.git
2. Composer install
3. php artisan config:cache
4. add credentials of mysql in .env file
5. create database tool_manager;
5. php artisan migrate (to create tables)
6. Insert some tool groups in tools table.
    insert into tool_groups (name) values ('Measuring Tools');
    insert into tool_groups (name) values ('Cutting Tools');
    insert into tool_groups (name) values ('Power Tools');
    insert into tool_groups (name) values ('Air Presure Tools');
7. add project to sites_enabled and domain name to hosts.
8. Good to go!!!
