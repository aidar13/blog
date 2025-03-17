1. clone project ```git clone git@github.com:aidar13/blog.git```
2. Up containers ```docker-compose up -d```
3. Create database: ```create database blog```
4. Run migrations: ```php artisan migrate```
5. Create roles and permissions: ```php artisan db:seed --class=InitAppSeeder```
6. Check tests: ```php artisan test --parallel```
7. Generate swagger: ```php artisan l5-swagger:generate```
