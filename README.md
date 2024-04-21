## Steps to run the application

1. composer install
2. php artisan key:generate --ansi
3. php artisan migrate --seed (Change the mysql database credentials in the .env file)
4. php artisan serve

## API Endpoint

Use curl or postman to request to the API endpoint

1. Transaction Insert (POST) - http://127.0.0.1:8000/api/v1/transactions/insert <br/>
   curl -i -X POST -H "Content-Type: application/json" -d "{\"first_name\": \"test\", \"last_name\": \"test\",\"balance\":100}" http://127.0.0.1:8000/api/v1/transactions/insert

2. Transaction Rollback (POST) - http://127.0.0.1:8000/api/v1/transactions/rollback <br/>
   curl -i -X POST -H "Content-Type: application/json" -d "{\"account\":1}" http://127.0.0.1:8000/api/v1/transactions/rollback
