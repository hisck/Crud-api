init:
	docker-compose build --force-rm --no-cache
	make up

up:
	docker-compose up -d
	echo "A aplicação esta rodando em http://127.0.0.1:8030"