# Connecting Two Laravel Projects in Docker-Compose Environments

A comprehensive guide to setting up and managing communication between multiple Laravel microservices using Docker and Docker Compose.

<p align="center"><br><br>
<img src="https://miro.medium.com/v2/resize:fit:700/1*txgMcAusL5s0q9Mmh0cFow.png" alt="Login Page" /><br><br>
</p>


More info -
https://medium.com/@murilolivorato/connecting-two-laravel-projects-built-in-two-docker-compose-environments-1a979e64f332

## Overview

This project demonstrates how to:
- Set up multiple Laravel projects in separate Docker environments
- Establish communication between microservices
- Manage containerized Laravel applications
- Handle inter-service communication
- Implement service discovery
- Configure network connectivity between containers

## Features

- Multiple Laravel projects in Docker containers
- Inter-service communication
- Docker network configuration
- Service discovery
- Environment isolation
- Scalable microservices architecture
- Container orchestration

## Prerequisites

- Docker and Docker Compose installed
- Basic understanding of Laravel
- Basic knowledge of Docker concepts
- Two separate Laravel projects
- Git

## Installation

### 1. Project Structure
```bash
microservices/
├── project-1/
│ ├── docker/
│ │ ├── nginx/
│ │ │ └── default.conf
│ │ └── php/
│ │ └── Dockerfile
│ ├── docker-compose.yml
│ └── .env
└── project-2/
├── docker/
│ ├── nginx/
│ │ └── default.conf
│ └── php/
│ └── Dockerfile
├── docker-compose.yml
└── .env
```


### 2. Docker Network Setup

1. Create a shared network:
```bash
docker network create laravel-network
```

2. Configure docker-compose.yml for Project 1:
```yaml
# project-1/docker-compose.yml
version: '3'
services:
  app1:
    build:
      context: .
      dockerfile: docker/php/Dockerfile
    container_name: project1_app
    volumes:
      - .:/var/www/html
    networks:
      - laravel-network
    environment:
      - DB_HOST=mysql
      - DB_DATABASE=project1
      - DB_USERNAME=root
      - DB_PASSWORD=secret
      - PROJECT2_URL=http://project2_app:8000

  nginx1:
    image: nginx:alpine
    container_name: project1_nginx
    ports:
      - "8001:80"
    volumes:
      - .:/var/www/html
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    networks:
      - laravel-network
    depends_on:
      - app1

  mysql1:
    image: mysql:8.0
    container_name: project1_mysql
    environment:
      MYSQL_DATABASE: project1
      MYSQL_ROOT_PASSWORD: secret
    networks:
      - laravel-network
    volumes:
      - mysql1_data:/var/lib/mysql

networks:
  laravel-network:
    external: true

volumes:
  mysql1_data:
```

3. Configure docker-compose.yml for Project 2:
```yaml
# project-2/docker-compose.yml
version: '3'
services:
  app2:
    build:
      context: .
      dockerfile: docker/php/Dockerfile
    container_name: project2_app
    volumes:
      - .:/var/www/html
    networks:
      - laravel-network
    environment:
      - DB_HOST=mysql
      - DB_DATABASE=project2
      - DB_USERNAME=root
      - DB_PASSWORD=secret

  nginx2:
    image: nginx:alpine
    container_name: project2_nginx
    ports:
      - "8002:80"
    volumes:
      - .:/var/www/html
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    networks:
      - laravel-network
    depends_on:
      - app2

  mysql2:
    image: mysql:8.0
    container_name: project2_mysql
    environment:
      MYSQL_DATABASE: project2
      MYSQL_ROOT_PASSWORD: secret
    networks:
      - laravel-network
    volumes:
      - mysql2_data:/var/lib/mysql

networks:
  laravel-network:
    external: true

volumes:
  mysql2_data:
```

## Implementation

### 1. Service Communication

1. **Project 1 Service**
```php
// project-1/app/Services/Project2Service.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class Project2Service
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('PROJECT2_URL');
    }

    public function getData()
    {
        try {
            $response = Http::get("{$this->baseUrl}/api/data");
            return $response->json();
        } catch (\Exception $e) {
            return [
                'error' => 'Failed to communicate with Project 2',
                'message' => $e->getMessage()
            ];
        }
    }
}
```

2. **Project 2 API Endpoint**
```php
// project-2/routes/api.php
Route::get('/data', function () {
    return response()->json([
        'message' => 'Data from Project 2',
        'timestamp' => now()
    ]);
});
```

### 2. Environment Configuration

1. **Project 1 .env**
```env
# project-1/.env
APP_NAME=Project1
APP_ENV=local
APP_KEY=base64:your-key
APP_DEBUG=true
APP_URL=http://localhost:8001

DB_CONNECTION=mysql
DB_HOST=mysql1
DB_PORT=3306
DB_DATABASE=project1
DB_USERNAME=root
DB_PASSWORD=secret

PROJECT2_URL=http://project2_app:8000
```

2. **Project 2 .env**
```env
# project-2/.env
APP_NAME=Project2
APP_ENV=local
APP_KEY=base64:your-key
APP_DEBUG=true
APP_URL=http://localhost:8002

DB_CONNECTION=mysql
DB_HOST=mysql2
DB_PORT=3306
DB_DATABASE=project2
DB_USERNAME=root
DB_PASSWORD=secret
```

## Usage

### Starting the Services

1. Start Project 1:
```bash
cd project-1
docker-compose up -d
```

2. Start Project 2:
```bash
cd project-2
docker-compose up -d
```

### Testing the Connection

1. **From Project 1 to Project 2**
```php
// project-1/routes/web.php
Route::get('/test-connection', function () {
    $service = new \App\Services\Project2Service();
    return $service->getData();
});
```

2. **Access the endpoint**
```bash
curl http://localhost:8001/test-connection
```

## Best Practices

1. **Network Configuration**
   - Use external networks for service communication
   - Implement proper network security
   - Use container names for service discovery

2. **Environment Management**
   - Use environment variables for configuration
   - Keep sensitive data in .env files
   - Use different environments for development and production

3. **Service Communication**
   - Implement proper error handling
   - Use HTTP client for service communication
   - Implement retry mechanisms for failed requests

4. **Security**
   - Implement proper authentication between services
   - Use HTTPS for service communication
   - Implement rate limiting
   - Use proper firewall rules




## 👥 Author

For questions, suggestions, or collaboration:
- **Author**: Murilo Livorato
- **GitHub**: [murilolivorato](https://github.com/murilolivorato)
- **linkedIn**: https://www.linkedin.com/in/murilo-livorato-80985a4a/



## 📸 Screenshots

### Running
![Login Page](https://miro.medium.com/v2/resize:fit:700/1*pNGfOFkI_PsDjnRfBo6c0w.png)

### Stating the project
![Dashboard](https://miro.medium.com/v2/resize:fit:700/1*dCB4hvoLmF0_CljmYo8vPA.png)

### localhost:8082
![Edit Profile](https://miro.medium.com/v2/resize:fit:700/1*eKv1ekQpnAb1ZxkII7UdBA.png)

### localhost:8083
![Edit Profile](https://miro.medium.com/v2/resize:fit:700/1*EyFAN6YpIANvIWd4nwIm_g.png)

### Creating the connection between two docker compose
![Edit Profile](https://miro.medium.com/v2/resize:fit:700/1*YXuHTUGaXodOlupNtSEXBA.png)

<div align="center">
  <h3>⭐ Star This Repository ⭐</h3>
  <p>Your support helps us improve and maintain this project!</p>
  <a href="https://github.com/murilolivorato/k8s-react-python-ci-cd-deploy
/stargazers">
    <img src="https://img.shields.io/github/stars/murilolivorato/k8s-react-python-ci-cd-deploy
?style=social" alt="GitHub Stars">
  </a>
</div>
