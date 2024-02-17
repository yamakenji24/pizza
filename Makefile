compose-build:
	docker compose up --build
down:
	docker compose down
test:
	docker compose exec -T pizza-php composer test