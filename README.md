
# Codevoyage

Simple Personal Blog about programming and tech related topics.

## Run Locally

1. Clone the project repository

```bash
# using ssh
git clone git@github.com:ojpro/Codevoyage.git

# using https
git clone https://github.com/ojpro/Codevoyage.git
```

then

```bash
cd Codevoyage
```

2. install all the need packages

```bash
# install composer's packages
composer install

# install node's packages

## using yarn
yarn 

## using npm
npm install
```

3. Configuration

```bash
# make a copy of the .env file
cp .env.example .env

# generate a new application key
php artisan key:generate
```
4. 🚀 run the application

```bash
npm run dev

# then
 php artisan serve  # ⚡ you can add an alias for this command like mine `pas=php artisan serve`
```

Finaly I hope you like it.
## Running Tests

To run tests, run the following command

```bash
  php artisan test
```


## Authors

- [ojpro](https://www.ojpro.me)


## License

[MIT](https://choosealicense.com/licenses/mit/)

