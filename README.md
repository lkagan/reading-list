# Reading List
An example Laravel & Vue application allowing users to search books and create reading lists.

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
```apacheconf
APP_PORT=80
FORWARD_DB_PORT=3306
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
