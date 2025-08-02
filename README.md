# README for Gundam TCG Deck Database/Builder

## Prerequisites
- PHP 8.1 or higher
- MySQL or PostgreSQL
- Git

## Installing Composer
1. Download the installer from [getcomposer.org](https://getcomposer.org/download/)
2. Run the installer script:
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
3. Move composer to global location (optional):
```bash
sudo mv composer.phar /usr/local/bin/composer
```

## Setting Up the Project
1. Clone the repository:
```bash
git clone https://github.com/yourusername/Gundam.git
cd Gundam
```

2. Install PHP dependencies:
```bash
composer install
```

3. Copy the example environment file:
```bash
cp .env.example .env
```

4. Configure your database settings in the `.env` file

5. Generate application key:
```bash
php artisan key:generate
```

6. Run database migrations:
```bash
php artisan migrate
```

7. Start the local development server:
```bash
php artisan serve
```

OR INSTALL HERD AND SAVE YOURSEFL A HEADACHE


The application will be available at http://localhost:8000
