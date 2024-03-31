1) `php artisan key:generate --ansi` <br><br>

2) Make directory for docker: <br>
   `mkdir ./storage/docker` <br>

3) Copy .env.example <br>
   `cp .env.example .env` <br>

4) Add host user to .env <br>
   `echo UID=$(id -u) >> .env` <br>
   `echo GID=$(id -g) >> .env` <br>

5) Run services docker <br>
   `docker-compose up -d --build` <br>

6) Install eslint, prettier <br>
    `npm install --save-dev @rushstack/eslint-patch` <br>
    `npm install --save-dev @vue/eslint-config-prettier` <br>
    `npm install --save-dev eslint` <br>
    `npm install --save-dev eslint-plugin-vue` <br>
    `npm install --save-dev prettier` <br>

7) `npm run lint` <br>

8) Install npm dependencies <br>
    `npm install` <br>
    `npm run dev` <br>
    `vite build` <br>
    `vite` <br>

9) Create link Storage
    `docker exec php-app php artisan storage:link`<br> 

10) Install spatie <br>
    `composer require spatie/laravel-permission` <br>
    `docker exec php-app php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"` <br>
    `docker exec php-app php artisan optimize:clear` <br>
    `docker exec php-app php artisan migrate`<br>
    `docker exec php-app php artisan migrate:rollback`<br>
    `docker exec php-app php artisan migrate` <br>
    `// The User model requires this trait
    use HasRoles;`<br>

11) create seeders <br>
    `docker exec php-app php artisan make:seeder RoleSeeder` <br>

12) Create resource UserResource, RoleResource, PermissionResource <br>
    `docker exec php-app php artisan make:resource Admin/User/UserResource` <br>
    `docker exec php-app php artisan make:resource Admin/Role/RoleResource` <br>
    `docker exec php-app php artisan make:resource Admin/Permission/PermissionResource` <br>

13) Create resource controllers UserController,RoleController,PermissionController <br>
    `docker exec php-app php artisan make:controller Admin/User/UserController --resource` <br>
    `docker exec php-app php artisan make:controller Admin/Role/RoleController --resource` <br>
    `docker exec php-app php artisan make:controller Admin/Permission/PermissionController --resource` <br>
