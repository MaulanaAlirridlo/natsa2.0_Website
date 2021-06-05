# NatSa - Laravel 8.0+ Jetstream and Tailwind CSS

Project ini Dibuat dengan bantuan template
- Admin Template oleh [Miten5 Larawind](https://github.com/miten5/larawind)
- e-commerce oleh [tailwindcomponents](https://github.com/tailwindcomponents/e-commerce)

## Requirements

- Laravel installer
- Composer
- npm installer

## Installation

```
# Clone the repository from GitHub and open the directory:
git clone https://github.com/MaulanaAlirridlo/natsa2.0_Website

# cd into your project directory
cd natsa2.0_Website

#install composer and npm packages
composer install
npm install && npm run dev

# Start prepare the environment:
cp .env.example .env // setup database credentials
php artisan key:generate
php artisan migrate
php artisan storage:link

# Run your server
php artisan serve

```
### Project made possible thanks to:

- [Miten5 Larawind](https://github.com/miten5/larawind)
- [tailwindcomponents](https://github.com/tailwindcomponents/e-commerce)
- [Laravel Jetstream](https://jetstream.laravel.com/1.x/introduction.html)
- [Tailwind CSS](https://tailwindcss.com/)
- [Windmill Dashboard](https://windmill-dashboard.vercel.app/)
