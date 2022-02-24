# projetoblackpar
Project in node js and php

# To start the project have nodejs and npm installed on the machine
Clone the project in the link: https://github.com/carlosjuniorsp/projetoblackpar.git

# After installation, enter the location where the project was cloned and navigate to the root project folder
Example: cd /home/project

# Install the folder node_modules
Run in the Terminal or Prompt: run npm install

# Access connection.js in root folder to enter environment variables from db connection using node.js

# After the process enter the folter "front" for install the db and folder vendor the laravel
Example: cd front

# Install vendor folder, this process requires composer to be installed
Run in the terminal or Prompt: composer install

# Install the DB
Access the .env in the folder main "front" to inserting the environment variables and conection

# Run migrations to install all tables the project, Make sure you are in the "front" folder
Run in the terminal or Prompt: php artisan migrate

# After the whole process run the server node
Example: cd home/project
run: npm start

# After running node server run laravel
Example: cd home/project/front
run: php artisan serve