up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

build-clean:
	docker-compose build --no-cache --force-rm --compress

migrate:
	docker exec -it laravel-app php artisan migrate
run:
	docker exec -it laravel-app php artisan $(command)

composer-install:
	docker exec -it laravel-app composer install

composer-update:
	docker exec -it laravel-app composer update

composer-require:
	docker exec -it laravel-app composer require $(lib)

clean-cache:
	docker exec -it laravel-app php artisan cache:clear
	docker exec -it laravel-app php artisan config:clear
	docker exec -it laravel-app composer dump-autoload -o
