# Laravel 9 Project with Vue 3 and Statamic - README

Welcome to this amazing Laravel 9 project with Vue 3 and Statamic! This project is set up using the fantastic Tailwind CSS and SCSS. In this README, you'll find a detailed guide on how to install the project, starting from `composer install` all the way to running `npm run build`. We'll guide you step by step.

## Requirements

Before getting started, make sure you have the following tools and software installed:

- Composer
- Node.js (version 14.x or higher)

## Installation

1. Clone the repository to your local environment:

```
$ git clone https://github.com/henrik560/Designated.git
```

2. Navigate to the project directory:

```
$ cd Designated
```

3. Install the PHP dependencies using Composer:

```
$ composer install
```

4. Make a copy of the `.env.example` file and name it `.env`. Update the database settings in the `.env` file.

5. Generate an application key:

```
$ php artisan key:generate
```

6. Run the database migrations:

```
$ php artisan migrate
```

7. Install the Node.js dependencies:

```
$ npm install
```

8. Build the assets using Laravel Mix:

```
$ npm run dev
```

Development:

It's time to code and take your project to the next level! The Laravel 9 project is set up with Vue 3 and Statamic. You can use the following commands during development:

- Start the development server:

```
$ php artisan serve
```

Feel free to customize and add your personal touch to this guide. Have fun building your amazing project!

**Note:**
This project is available on [GitHub](https://github.com/henrik560/Designated).

