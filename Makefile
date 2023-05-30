run-app-dev:
	cp ./src/server/.env.example ./src/server/.env
	docker-compose -f docker-compose-dev.yml up --build -d
	docker exec api /bin/sh -c "composer install && chmod -R 777 storage"
	docker exec api /bin/sh -c "php artisan migrate"
	docker exec api /bin/sh -c "php artisan db:seed"