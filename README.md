# Gundam TCG Deck Builder (Prototype)

## Project Description

A prototype web application for Gundam Trading Card Game enthusiasts to search cards and build decks. This is an early-stage project built with Laravel and Livewire.

### Current Features
- Welcome page with Gundam-themed design
- Basic card search interface
- Simple deck builder prototype
- Dark space-themed UI
- Responsive design

### Technology Stack
- **Backend**: Laravel with Livewire
- **Frontend**: Tailwind CSS (CDN)
- **Database**: SQLite
- **Styling**: Dark theme with Gundam aesthetics

### Future Plans
- Complete card database
- Advanced search filters
- Deck validation and optimization
- User accounts and deck saving

## Prerequisites
- PHP 8.1 or higher
  - NOTE: You will need to enable extension=fileinfo and extension=zip in the php.ini file
- ensure you have a .env file in the root of your project
  - NOTE: You will need to run "php artisan key:generate" before you will be able to run the server locally
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

**Alternative:** Install [Laravel Herd](https://herd.laravel.com/) for a simplified development environment.

## Recommended VS Code Extensions
- Laravel
- Laravel Blade Formatter
- Laravel Blade Snippets
- Laravel Goto View
- Laravel Snippets
- Material Icon Theme
- PHP Intelephense


The application will be available at http://localhost:8000
