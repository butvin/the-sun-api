# Sun REST API

sent Env & install dependencies:
> cp .env.example .env

> composer install

Start serving the Application:
> php -S localhost:8080 -t public

Create migrations and DB mock:
>php artisan migrate:fresh --seed

## Available routes:

### GET /
Start point the App. Redirect to `/api/v1`

### GET /api/v1
API information

### GET /api/v1/users
Get users resources collections.

### POST /api/v1/users
Save a new user resource.

### GET /api/v1/users/{id}
Get the specific user resource. `({id:[0-9]+} param)`

### PUT /api/v1/users/{id}
Update the user resource. `({id:[0-9]+} param)`

### DELETE /api/v1/users/{id}
Destroy user resource. `(soft delete, {id:[0-9]+} param)`
