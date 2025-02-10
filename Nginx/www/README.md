# Game Application

A simple game application with random number generation and win calculation.

## Requirements

- Docker
- Docker Compose
- Make

## Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>

2. Navigate to the project directory:
   ```bash
   cd ./Nginx/www
3. Run application:
    ```bash
   make init
4. After successful initialization, the application will be available at [http://localhost:8000](http://localhost:8000)
5. ## Available Make Commands

- `make build` - Build Docker containers
- `make run` - Start Docker containers
- `make exec` - Open PHP container bash
- `make migrate` - Run migrations
- `make init` - Initialize application (migrations and permissions)
- `make install` - Install Composer dependencies
- `make clear` - Clear cache
