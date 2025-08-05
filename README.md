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
- **Backend**: Laravel 11 with Livewire
- **Frontend**: Tailwind CSS (CDN)
- **Database**: MongoDB (Primary), SQLite (Alternative)
- **Styling**: Dark theme with Gundam aesthetics

### Future Plans
- Complete card database
- Advanced search filters
- Deck validation and optimization
- User accounts and deck saving

## Prerequisites

### 1. Install Laravel Herd (Recommended)
Laravel Herd is the recommended development environment as it includes PHP, Composer, and other tools pre-configured.

**For Windows:**
1. Download Herd from [https://herd.laravel.com/windows](https://herd.laravel.com/windows)
2. Run the installer and follow the setup wizard
3. Herd will automatically install:
   - PHP 8.3+ with required extensions
   - Composer
   - Node.js and npm
   - MySQL and Redis (optional)

**For macOS:**
1. Download Herd from [https://herd.laravel.com/](https://herd.laravel.com/)
2. Run the installer
3. Herd provides the same tools as Windows version

### 2. Set Up MongoDB Database

This project uses **MongoDB Atlas** (cloud database) for shared team access. Choose one option:

#### Option A: MongoDB Atlas (Recommended for Teams)
1. **Create MongoDB Atlas Account:**
   - Go to [MongoDB Atlas](https://www.mongodb.com/atlas)
   - Sign up for a free account
   - Create a new project for "Gundam TCG"

2. **Create Free Cluster:**
   - Click "Create a Deployment"
   - Choose "M0 Sandbox" (Free tier - 512MB storage)
   - Select cloud provider and region closest to your team
   - Name your cluster (e.g., "gundam-deck-cluster")

3. **Set Up Database User:**
   - Go to "Database Access" → "Add New Database User"
   - Choose "Password" authentication
   - Create username/password (save these!)
   - Set privileges to "Read and write to any database"

4. **Configure Network Access:**
   - Go to "Network Access" → "Add IP Address"
   - For team development: "Allow Access from Anywhere" (0.0.0.0/0)
   - For security: Add specific IP addresses for team members

5. **Get Connection String:**
   - Go to "Database" → Click "Connect" on your cluster
   - Choose "Connect your application"
   - Select "PHP" driver
   - Copy the connection string

#### Option B: Local MongoDB (Individual Development)
**For Windows:**
1. Download MongoDB Community Server from [MongoDB Download Center](https://www.mongodb.com/try/download/community)
2. Run installer with "Complete" installation
3. Ensure "Install MongoDB as a Service" is checked

**For macOS:**
```bash
brew tap mongodb/brew
brew install mongodb-community
brew services start mongodb/brew/mongodb-community
```

**For Linux (Ubuntu/Debian):**
```bash
# Import MongoDB public GPG key
wget -qO - https://www.mongodb.org/static/pgp/server-7.0.asc | sudo apt-key add -

# Add MongoDB repository
echo "deb [ arch=amd64,arm64 ] https://repo.mongodb.org/apt/ubuntu $(lsb_release -cs)/mongodb-org/7.0 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-7.0.list

# Install MongoDB
sudo apt-get update
sudo apt-get install -y mongodb-org

# Start MongoDB service
sudo systemctl start mongod
sudo systemctl enable mongod
```

### 3. Alternative Prerequisites (if not using Herd)
- PHP 8.2 or higher with extensions:
  - `extension=fileinfo`
  - `extension=zip`
  - `extension=mongodb`
- Composer
- Git

## Setting Up the Project

1. **Clone the repository:**
```bash
git clone https://github.com/Tann2019/Gundam.git
cd Gundam
```

2. **Install PHP dependencies:**
```bash
composer install
```

3. **Set up environment configuration:**
   - Copy `.env.example` to `.env` (or ensure you have a `.env` file)
   - The project is configured to use MongoDB by default

4. **Generate application key:**
```bash
php artisan key:generate
```

5. **Configure MongoDB connection:**
   
   **For MongoDB Atlas (Recommended):**
   Update your `.env` file with your Atlas connection details:
   ```env
   DB_CONNECTION=mongodb
   MONGODB_URI=mongodb+srv://your-username:your-password@your-cluster.xxxxx.mongodb.net/gundam_deck?retryWrites=true&w=majority
   MONGODB_HOST=your-cluster.xxxxx.mongodb.net
   MONGODB_DATABASE=gundam_deck
   MONGODB_USERNAME=your-username
   MONGODB_PASSWORD=your-password
   ```
   
   **For Local MongoDB:**
   Use these default settings in your `.env` file:
   ```env
   DB_CONNECTION=mongodb
   MONGODB_HOST=127.0.0.1
   MONGODB_PORT=27017
   MONGODB_DATABASE=gundam_deck
   MONGODB_USERNAME=
   MONGODB_PASSWORD=
   ```

6. **Test MongoDB connection:**
   ```bash
   php artisan tinker
   ```
   Then run in Tinker:
   ```php
   use Illuminate\Support\Facades\DB;
   DB::connection('mongodb')->getMongoDB()->listCollections();
   exit;
   ```

7. **Start the development server:**
   
   **With Herd:**
   - Herd automatically serves your Laravel projects
   - Navigate to your project folder in Herd's interface
   - Your app will be available at `http://gundam.test` or similar

   **Without Herd:**
   ```bash
   php artisan serve
   ```
   The application will be available at `http://localhost:8000`

## Database Information

This project uses **MongoDB** as the primary database instead of traditional SQL databases. This choice was made to:
- Handle flexible card data structures
- Store complex deck compositions
- Enable faster development with schema-less design

**Note:** The project includes Laravel MongoDB package (`mongodb/laravel-mongodb`) which provides Eloquent-like functionality for MongoDB collections.

If you need to switch back to SQLite for development:
1. Change `DB_CONNECTION=sqlite` in your `.env` file
2. Run `php artisan migrate` to create the SQLite database

## Recommended VS Code Extensions
- Laravel Extension Pack
- Laravel Blade Formatter
- Laravel Blade Snippets
- Laravel Goto View
- MongoDB for VS Code
- PHP Intelephense
- Material Icon Theme

## Troubleshooting

### MongoDB Connection Issues
1. **Verify MongoDB is running:**
   - Windows: Check services for "MongoDB Server (MongoDB)"
   - macOS/Linux: `brew services list | grep mongodb` or `sudo systemctl status mongod`

2. **Test connection manually:**
   ```bash
   # If you have MongoDB shell installed
   mongosh
   # Or test via Laravel
   php artisan tinker
   ```

3. **Common fixes:**
   - Ensure MongoDB service is started
   - Check firewall settings (MongoDB uses port 27017)
   - Verify MongoDB installation completed successfully

### Laravel Issues
1. **Missing APP_KEY:**
   ```bash
   php artisan key:generate
   ```

2. **Permission issues (Linux/macOS):**
   ```bash
   sudo chown -R $USER:$USER storage bootstrap/cache
   chmod -R 775 storage bootstrap/cache
   ```

3. **Composer dependency issues:**
   ```bash
   composer update
   ```

## Development Notes

- This project uses **Laravel 11** with **MongoDB** integration
- The application is designed to handle Gundam TCG card data
- MongoDB collections will be created automatically when first accessed
- No traditional migrations are required for MongoDB collections

## Contributing

This is a prototype project. When contributing:
1. Ensure MongoDB is properly configured
2. Test both MongoDB and SQLite compatibility if making database changes
3. Follow Laravel coding standards
4. Update documentation for any new setup requirements
