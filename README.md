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

This API provides endpoints to manage book collections for library functionalities.

You can find the full API documentation on Postman here:

[<img src="https://run.pstmn.io/button.svg" alt="Run In Postman" style="width: 128px; height: 32px;">](https://god.gw.postman.com/run-collection/12524899-91a78ed1-8e93-4196-a8f1-6aa9e026b58d?action=collection%2Ffork&source=rip_markdown&collection-url=entityId%3D12524899-91a78ed1-8e93-4196-a8f1-6aa9e026b58d%26entityType%3Dcollection%26workspaceId%3Df2b04104-0337-4ea3-bda2-a7c36b47eafb)

