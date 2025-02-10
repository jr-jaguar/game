GREEN = \033[0;32m
NC = \033[0m # No Color

# Default target
.DEFAULT_GOAL := help

DOCKER_COMPOSE = @cd ../../ && docker-compose
DOCKER_EXEC = $(DOCKER_COMPOSE) exec app

.PHONY: help
help: ## Help command to display available commands
	@echo "Available commands:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "$(GREEN)%-30s$(NC) %s\n", $$1, $$2}'

.PHONY: build
build: ## Build Docker containers
	$(DOCKER_COMPOSE) build

.PHONY: run
run: ## Start Docker containers
	$(DOCKER_COMPOSE) up -d
	@echo "Go to http://localhost:8000"

.PHONY: install
install: ## Install Composer dependencies
	$(DOCKER_EXEC) composer install

.PHONY: migrate
migrate: ## Run migrations
	$(DOCKER_EXEC) php artisan migrate

.PHONY: clear
clear: ## Clear cache
	$(DOCKER_EXEC) php artisan cache:clear
	$(DOCKER_EXEC) php artisan config:clear
	$(DOCKER_EXEC) php artisan route:clear
	$(DOCKER_EXEC) php artisan view:clear

.PHONY: init
init: ## Application initialization
	@if [ ! -f .env ]; then cp .env.example .env; fi
	@if [ ! -f database/database.sqlite ]; then touch database/database.sqlite; fi
	@make build
	@make run
	@make install
	$(DOCKER_EXEC) php artisan key:generate
	@make migrate
	@echo "$(GREEN)Project successfully initialized!$(NC)"
	@echo "Go to http://localhost:8000"

.PHONY: exec
exec: ## Open PHP container bash
	$(DOCKER_COMPOSE) exec app bash

