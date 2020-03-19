.PHONY: restart stop start down ssh-php ssh-nginx

restart: stop start ##@docker Restart docker's containers

stop: ##@docker Stop docker's containers
	@echo "$'\e[0;34m Stopping docker's containers... $'\e[0m"
	@$(call run-docker-compose, stop)

start: ##@docker Start docker's containers
	@echo "$'\e[0;34m Starting docker's containers... $'\e[0m"
	@$(call run-docker-compose, up -d --build --remove-orphans || true)
	@echo "$'\e[32m Application should be up and running on $'\e[1;34m http://localhost:8080/ $'\e[0m"

down: stop ##@docker Down docker's containers
	@echo "$'\e[0;34m Down containers... $'\e[0m"
	@$(call run-docker-compose, down --remove-orphans)

ssh-php: ##@docker SSH to php container
	@$(call run-in-container, -u www-data:www-data, php, bash)

ssh-nginx: ##@docker SSH to nginx container
	@$(call run-in-container, -u www-data:www-data, nginx, bash)