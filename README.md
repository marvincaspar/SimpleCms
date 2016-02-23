[![Code Climate](https://codeclimate.com/github/mc388/SimpleCms/badges/gpa.svg)](https://codeclimate.com/github/mc388/SimpleCms)
[![Test Coverage](https://codeclimate.com/github/mc388/SimpleCms/badges/coverage.svg)](https://codeclimate.com/github/mc388/SimpleCms/coverage)
[![Issue Count](https://codeclimate.com/github/mc388/SimpleCms/badges/issue_count.svg)](https://codeclimate.com/github/mc388/SimpleCms)

# Simple CMS for laravel 5

Simple CMS provides you to create small and simple cms pages.


## Publish assets

To compile all sass files, you need to install npm first.
Then goto `src` folder and run `npm install --save`.
After installing all necessary node modules you can run `gulp` to generate a css file from all sass files and copy all js files.
Next step is to publish the compiled css file to make it available to the meta project.
Therefore run `docker exec -it <foldername>_php_1 bash -c 'php artisan vendor:publish --tag=public --force'` in the meta project.


## Commands for the meta project

- Publish assets, config and migrations: `docker exec -it <foldername>_php_1 bash -c 'php artisan vendor:publish --force'`
- Migrate database: `docker exec -it <foldername>_php_1 bash -c 'php artisan migrate'`
- Seed contact model: `docker exec -it <foldername>_php_1 bash -c 'php artisan db:seed --class="Mc388\SimpleCms\Database\Seeds\ContactSeeder"'`
- Seed content model: `docker exec -it <foldername>_php_1 bash -c 'php artisan db:seed --class="Mc388\SimpleCms\Database\Seeds\ContentSeeder"'`

If you receive a "class not found" error when running migrations, try running the `composer dump-autoload` command and re-issuing the migrate command.

## Uploads

Uploaded files are stored in `<project-root>/storage/media`.
