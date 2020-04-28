.PHONY: logs logs-php cc dc

logs: ##@app Display logs of a single or all containers. Single usage: CONTAINER=nginx make logs
	$(call run-docker-compose, logs -f --tail=1000 $(CONTAINER))

logs-php: ##@app Display php container logs
	CONTAINER=php $(MAKE) logs

cc: ##@app Clear cache for dev env
	@echo "$'\e[0;34m Clearing cache $'\e[0m"
	$(call run-php, bin/console cache:clear --env=dev -v)
	@echo "$'\e[32m Cache clear $'\e[0m"

dc: ##@app Clean doctrine cache, and validate schema
	@echo "$'\e[0;34m Clearing doctrine cache $'\e[0m"
	-$(call run-php, bin/console doctrine:cache:clear-metadata --env=dev)
	-$(call run-php, bin/console doctrine:cache:clear-query --env=dev)
	-$(call run-php, bin/console doctrine:cache:clear-result --env=dev)
	-$(call run-php, bin/console doctrine:schema:validate --env=dev)
	@echo "$'\e[32m Doctrine cache cleared $'\e[0m"

lf: ##@app Delete database if exists, create new one and load fixtures
	-$(call run-php, bin/console d:d:d --force --if-exists)
	-$(call run-php, bin/console d:d:c --if-not-exists)
	-$(call run-php, bin/console d:s:u --force)
	-$(call run-php, bin/console d:f:l --no-interaction)
	@echo "$'\e[32m Fixtures loaded $'\e[0m"