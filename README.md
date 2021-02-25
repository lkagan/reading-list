# Reading List
An example Laravel 8 & Vue 3 application with Inertia that allows users to search books and create reading lists.

## Code Review Quick Links
* Laravel routes [web.php](https://github.com/lkagan/reading-list/blob/main/routes/web.php)
* Controller test [BookControllerTest.php](https://github.com/lkagan/reading-list/blob/main/tests/Feature/BookControllerTest.php)
* Controller [BookController.php](https://github.com/lkagan/reading-list/blob/main/app/Http/Controllers/BookController.php)
* Form request [BookAddRequest.php](https://github.com/lkagan/reading-list/blob/main/app/Http/Requests/BookAddRequest.php)  
* Book JSON resource [BookResource.php](https://github.com/lkagan/reading-list/blob/main/app/Http/Resources/BookResource.php)
* Model [Book.php](https://github.com/lkagan/reading-list/blob/main/app/Models/Book.php)
* Factory [BookFactory.php](https://github.com/lkagan/reading-list/blob/main/database/factories/BookFactory.php)
* API client [api.js](https://github.com/lkagan/reading-list/blob/main/resources/js/api.js)
* Vuex store: [store.js](https://github.com/lkagan/reading-list/blob/main/resources/js/store.js)
* Book search  
    * [Search.vue](https://github.com/lkagan/reading-list/blob/main/resources/js/Pages/Search.vue)
    * [SearchBar.vue](https://github.com/lkagan/reading-list/blob/main/resources/js/Components/SearchBar.vue)
    * [SearchResults.vue](https://github.com/lkagan/reading-list/blob/main/resources/js/Components/SearchResults.vue)
    * [SearchResultItem.vue](https://github.com/lkagan/reading-list/blob/main/resources/js/Components/SearchResultItem.vue)
* Reading List    
    * [Books.vue](https://github.com/lkagan/reading-list/blob/main/resources/js/Pages/Books.vue)
    * [MyList.vue](https://github.com/lkagan/reading-list/blob/main/resources/js/Components/MyList.vue)

## Postman
Book data comes from the _Google Books_ API. Below is a link to manually test the API in Postman. 
You'll first need an [API key](https://console.cloud.google.com/apis/credentials) and to enable the Books API for that key.
Once that's done, enter the API key in the collection's *CURRENT_VALUE*  for the for `api_key` variable.

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/4722983e00620764db09)

## Run Locally on Docker

To save keystrokes, create an alias for Laravel sail 
```bash
alias sail=./vendor/bin/sail
```

### First run

Create and customize `.env` as desired.
```bash 
cp .env.example .env
```

If you run a web or MySQL server locally on default ports, update these in `.env` to avoid conflicts.
```dotenv
APP_PORT=80
FORWARD_DB_PORT=3306
```

Add the Google API Key mentioned above to the `.env` file.
```dotenv
MIX_BOOK_API_KEY=
```

Initialize the containers.  First run will take a few minutes.
```bash
sail up 
```

#### Database Migrations

Once the database is up and running, you can run migrations.  Wait until you see a line in the output from the above command with the following content before moving on.
```
mysql_1         | 2021-02-21T23:33:01.752309Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. ...
```

Run the database migrations in another terminal.
```bash
sail artisan migrate
```

Build the front-end assets.
```bash
sail npm run dev
```

This will take a small bit of time.  Wait for the following output before the next step.
```
webpack compiled successfully
```

Access the application at http://localhost. Provide the port number if you changed `APP_PORT` to anything other than 80.

### Subsequent Runs
```bash
# Runs in background
sail up -d
```

### Stop Containers
```bash
sail stop
```

### Remove Containers and Volumes
This is helpful when changing configuration like port mappings in .env.
```bash
sail down -v
```

## Testing
Ensure containers are running first ([see above](#run-locally-on-docker))
```bash
sail test
```
