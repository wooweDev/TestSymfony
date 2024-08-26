# Symfony 7 Application

This is a Symfony 7 application that requires PHP 8.2 or higher.

## Requirements

- PHP 8.2 or higher
- Composer (latest version)
- MySQL or other databases supported by Doctrine

## Installation

1. **Clone the Repository**:
   ```bash
   git clone <your-repository-url>
   cd <your-repository-folder>

2. Install dependency
   composer install
   
3. Set .Env
  DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

4. Configure Database
   php bin/console make:migration
   php bin/console doctrine:migrations:migrate
   
5. Run Seeder
  php bin/console app:create-admin admin@example.com strongpassword
  php bin/console doctrine:fixtures:load

6. Load Local Server
   php -S localhost:8000 -t 
