
# Connecting two Laravel Projects built in two Docker-Compose Environments
## Instructions -
https://medium.com/@murilolivorato/connecting-two-laravel-projects-built-in-two-docker-compose-environments-1a979e64f332

## Access project_one and run those commands  
- docker-compose up -d --build
- docker-compose run --rm composer install
- docker-compose run --rm artisan key:generate

## Access project_two and run those commands
- docker-compose up -d --build
- docker-compose run --rm composer install
- docker-compose run --rm artisan key:generate
