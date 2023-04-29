## TZ

This is a Laravel project that allows you to synchronize product and category data from https://fakestoreapi.com/products and access it through a REST API. The project includes a console command that retrieves data from the API and saves it to a database. It also includes a simple filter on product names that is case-insensitive.

## Installation

To install the required packages, run the following command: composer install

Next, run the migrations to set up the database schema: php artisan migrate

## Synchronization

To synchronize the product and category data, you need to add a command to your system's task scheduler. The command can be run using the following command: php artisan sync:products



### Postman Collection

A Postman collection is included in the project root directory. It contains examples of how to use the API endpoints. You can import the collection into Postman to try out the API.

To import the collection into Postman, follow these steps:

- **Open Postman and click the Import button.**
- **Select the postman_collection.json file from the project root directory.**
- **The collection will be imported into Postman.**
