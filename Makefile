PROJECT = magic_trip
COMPOSE_FILE = docker-compose.yml

.PHONY: start
start:
	docker-compose -f $(COMPOSE_FILE) -p $(PROJECT) up -d --build

.PHONY: logs
logs:
	docker-compose -f $(COMPOSE_FILE) -p $(PROJECT) logs

.PHONY: exec
exec:
	docker exec -it ${name} /bin/bash

.PHONY: restart
restart:
	docker-compose -f $(COMPOSE_FILE) -p $(PROJECT) kill && \
	docker-compose -f $(COMPOSE_FILE) -p $(PROJECT) rm -f && \
	docker-compose -f $(COMPOSE_FILE) -p $(PROJECT) up -d --build

.PHONY: reset
reset:
	rm -rf infrastructure/postgresql/data/* && \
	docker-compose -f $(COMPOSE_FILE) -p $(PROJECT) kill && \
	docker-compose -f $(COMPOSE_FILE) -p $(PROJECT) rm -f && \
	docker-compose -f $(COMPOSE_FILE) -p $(PROJECT) up -d --build

.PHONY: kill
kill:
	docker-compose -f $(COMPOSE_FILE) -p $(PROJECT) kill

.PHONY: ps
ps:
	docker-compose -f $(COMPOSE_FILE) -p $(PROJECT) ps

.PHONY: laravel
laravel:
	docker exec -it ${PROJECT}_workspace /bin/bash

.PHONY: setup
setup:
	chmod -R 777 storage/ bootstrap/ vendor/ && \
	cp .env.example .env && \
	php artisan key:generate && \
	npm run dev && \
	npm run dev-admin
	sed -i -e 's/DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env
	sed -i -e 's/DB_HOST=.*/DB_HOST=deliveryFood_mysql/' .env
	sed -i -e 's/DB_DATABASE=.*/DB_DATABASE=laravel_app_db/' .env
	sed -i -e 's/DB_USERNAME=.*/DB_USERNAME=laravel_app/' .env
	sed -i -e 's/DB_PASSWORD=.*/DB_PASSWORD=secret/' .env
	php artisan migrate
	php artisan db:seed
	php artisan jwt:secret

.PHONY: install
install:
	composer install && \
	npm install

.PHONY: deploy
deploy:
	docker exec -it ${PROJECT}_workspace cp .env.example .env && \
	docker exec -it ${PROJECT}_workspace sed -i -e 's/DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env && \
	docker exec -it ${PROJECT}_workspace sed -i -e 's/DB_HOST=.*/DB_HOST=deliveryFood_mysql/' .env && \
	docker exec -it ${PROJECT}_workspace sed -i -e 's/DB_DATABASE=.*/DB_DATABASE=laravel_app_db/' .env && \
	docker exec -it ${PROJECT}_workspace sed -i -e 's/DB_USERNAME=.*/DB_USERNAME=laravel_app/' .env && \
	docker exec -it ${PROJECT}_workspace sed -i -e 's/DB_PASSWORD=.*/DB_PASSWORD=secret/' .env && \
	docker exec -it ${PROJECT}_workspace composer install && \
	docker exec -it ${PROJECT}_workspace php artisan key:generate && \
	docker exec -it ${PROJECT}_workspace php artisan migrate && \
	docker exec -it ${PROJECT}_workspace php artisan db:seed && \
	docker exec -it ${PROJECT}_workspace php artisan jwt:secret && \
	docker exec -it ${PROJECT}_workspace chmod -R 777 storage/ bootstrap/ vendor/ && \
	docker exec -it ${PROJECT}_workspace npm install && npm run dev-admin && npm run dev-admin && npm run dev-store

.PHONY: webpack
webpack:
	docker exec -it ${PROJECT}_workspace npm run dev && \
	docker exec -it ${PROJECT}_workspace npm run dev-admin && \
	docker exec -it ${PROJECT}_workspace npm run dev-store