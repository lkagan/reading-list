# Run locally on Docker
* `cp .env.example .env`
* Update `.env` as required.  Specifically these two variables if you're already running local web and MySQL servers.
  * `APP_PORT=80`
  * `FORWARD_DB_PORT=3307`
* `./vendor/bin/sail up`
