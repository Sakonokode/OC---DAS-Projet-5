# Make sure to run the given command in a container identified by the given service
#
# $(1) the exec options
# $(2) the Docker Compose service
# $(3) the command to run
#
define run-in-container
	$(call run-docker-compose, exec $(1) $(2) $(3))
endef

# Run a docker-compose command, ensuring the docker machine is up if required
#
# $(1) the command(s) to run
#
define run-docker-compose
	sudo docker-compose $(1)
endef

# Run a docker command, ensuring the docker machine is up if required
#
# $(1) the command(s) to run
#
define run-docker
	docker $(1)
endef

define run-php
	sudo docker exec -ti ocdasprojet5_php_1 $(1)
endef

