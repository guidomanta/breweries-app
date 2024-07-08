# Breweries Project

Breweries is a simple Laravel project in which a user can login and get a list of breweries retrieved by the Open Brewery DB service.

## Installation

Run the following commands to configure everything properly:

```bash
composer install
npm install
npm run build
sail up
sail artisan migrate --seed
```

Open a new terminal and run

```bash
sail artisan migrate --seed
```

## Usage

Navigate to

```bash
http://localhost
```

and enjoy!

## License

[MIT](https://choosealicense.com/licenses/mit/)
