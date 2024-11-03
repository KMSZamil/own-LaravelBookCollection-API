### Project Name: Laravel Book Collection

GitHub Link: https://github.com/KMSZamil/own-LaravelBookCollection-API.git

Or, Download the .zip file

After that do the following:

Make a `.env` file and connect with your database

`$ composer update`

`$ PHP artisan key:generate`

`$ php artisan migrate`

`$ php artisan db:seed`

`$ php artisan jwt:secret`

`$ php artisan config:cache`

`$ php artisan serve`

- Student email password:

    student@gmail.com
    password

- Librarian email password:

    librarian@gmail.com
    password

After login an authorization token is provided. This token is needed for getting all the API responses.

The exported json file of the API is provided with the code in /public/doc/ folder.
