#!/bin/bash

# Check if npm is installed mendingan install di docker image supaya wktu docker run ga lama
# if ! command -v npm &> /dev/null; then
#   echo "npm could not be found. Installing npm..."
#   apt-get install -y npm
# else
#   echo "npm is already installed."
# fi

# if [ ! -f "vendor/autoload.php" ]; then
#     echo "installing composer"
#     composer install --no-progress --no-interaction
# fi

# if [ ! -d "node_modules" ]; then
#   echo "node_modules directory does not exist. Running npm install..."
#   npm install
# else
#   echo "node_modules directory already exists. Skipping npm install."
# fi

if [ ! -f ".env" ]; then
    echo "Creating env file"
    cp .env.example .env
else
    echo "env file exists."
fi

update_env_var() {
  local var_name=$1
  local var_value=$2

  # Check if the variable value is empty
  if [ -n "$var_value" ]; then
    # Check if the variable exists in the .env file
    if grep -q "^${var_name}=" /var/www/.env; then
      echo "Updating ${var_name} to ${var_value}"
      sed -i "s/^${var_name}=.*/${var_name}=${var_value}/" /var/www/.env
    fi
  else
    echo "${var_name} is not provided, keeping existing value in .env file"
  fi
}

update_env_var "DB_HOST" "${DB_HOST}"
update_env_var "DB_PORT" "${DB_PORT}"
update_env_var "DB_DATABASE" "${DB_DATABASE}"
update_env_var "DB_USERNAME" "${DB_USERNAME}"
update_env_var "DB_PASSWORD" "${DB_PASSWORD}"

# sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" /var/www/.env
# sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" /var/www/.env
# sed -i "s/DB_PORT=.*/DB_PORT=${DB_PORT}/" /var/www/.env
# sed -i "s/DB_HOST=.*/DB_HOST=${DB_HOST}/" /var/www/.env
# sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/" /var/www/.env

# npm run build
php artisan migrate --force
php artisan key:generate
cd public
rm -r storage
cd ..
php artisan storage:link
# php artisan cache:clear
# php artisan config:clear
# php artisan route:clear
php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
exec docker-php-entrypoint "$@"