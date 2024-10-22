start:
	php artisan serve --host 0.0.0.0

start-frontend:
	npm run dev

install:
	composer install && npm install

database:
	touch database/database.sqlite

migrate:
	php artisan migrate

seed:
	php artisan db:seed

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

lint:
	composer exec --verbose phpcs

lint-fix:
	composer exec --verbose phpcbf

phpstan:
	vendor/bin/phpstan analyse -c phpstan.neon
