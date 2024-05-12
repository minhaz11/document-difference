# Document Difference Viewer

## Installation guide

- Clone the repository
- Run `composer install` to install the dependencies.
- Run `npm install` or `yarn` to install npm dependencies
- Run `npm run dev` or `yarn run dev` to start vite
- Run `php artisan serve` to run the app on `http://localhost:8000`

## Database setup

- Make `.env` file from `.env.example` file.
- Change database credentials with yours.
- Run `php artisan migrate --seed` to migrate the database.
- Now you are ready to go.
- Login with these credentials "user@mail.com" and "password"

##### Open `http://localhost:8000` in your browser to see the app running.

## Backend urls

- GET `/dashboard` - Shows all the documents related to users.
- GET `/documents/{document}` - show the specific document and differences between last version and latest version as well

## Task scheduler run
- Run `php artisan schedule:run` to run the task scheduler

