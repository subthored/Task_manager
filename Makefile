start:
	php artisan serve --host 0.0.0.0

start-frontend:
	npm run dev

setup:
	composer install

database:
	touch database/database.sqlite

migrate:
	php artisan migrate

seed:
	php ardtisan db:seed

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

lint:
	composer exec --verbose phpcs

lint-fix:
	composer exec --verbose phpcbf
