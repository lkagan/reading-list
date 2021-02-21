# Reading List
An example Laravel & Vue application allowing users to search books and create reading lists.

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
sail up -d
```

Laravel Sail currently requires a restart at this point to avoid crashing during migration. Anyone know why?
```bash
sail restart
```

Run the DB migrations
```bash
sail artisan migrate
```

Access the application at http://localhost. Provide the port number if you changed `APP_PORT` to anything other than 80.

### Subsequent Runs
```bash
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
