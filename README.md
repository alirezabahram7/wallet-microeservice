
## Wallet Microservice


This is a microservice for managing user wallets, implemented using PHP/Laravel and MySQL.

1) Clone this repository to your local machine

2) Build and start the Docker containers:
 `docker-compose up -d --build`

3) Run the database migrations and seeders: `docker-compose exec app php artisan migrate --seed`

4) The available API endpoints are:

   - `GET /api/balance?user_id={user_id}`: Returns the current balance of a user's wallet.

   - `POST /api/add-money`: Adds money to a user's wallet and returns the transaction reference number.

5) To run the test cases for this microservice, run the following command:
`docker-compose exec app php artisan test`

6) To run the daily job that calculates the total amount of transactions, run the following command:
`docker-compose exec app php artisan calculate-total-amount`


