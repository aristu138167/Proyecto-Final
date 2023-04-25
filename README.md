Laravel docker

The project must be mounted using docker:

- Start docker daemon
- Run your docker machine: docker-compose up -d


- Go inside the machine:
  - docker exec -it laravel-php /bin/zsh
  

- From inside the machine:
  - Run: composer install
  - Copy the .env.example to .env
  - Run: php artisan key:generate
  

- Web running on http://localhost:8088


- Api status check running on GET request: http://localhost:8088/api/status


- Swagger running on http://localhost:8082/


- Postman base collection file can be found on src/postman


- To stop de container:
  docker-compose stop

:)
