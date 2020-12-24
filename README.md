# Sun REST API
Start serving the Application:
> php -S localhost:8080 -t public

Create migrations and DB mock:
>php artisan migrate:fresh --seed

## Available routes:

### GET /
Start point the App. Redirect to /api/v1

### GET /api/v1
API service information

### GET /api/v1/users
Get users resources collections

### POST /api/v1/users
Create and store a new user resource

### GET /api/v1/users/{id}
Find users resource by `integer` **id** parameter

### PUT /api/v1/users/{id}
Update users resource by `integer` **id** parameter

### DELETE /api/v1/users/{id}
Destroy users resource by `integer` **id** parameter
