# primex_test

1. Clone the repository with git clone.
2. Copy .env.example file to .env and edit database credentials there.
3. Run composer install
4. php artisan make:migration create_userroles_table
5. php artisan make:migration create_users_table
6. Run php artisan migrate
7. php artisan db:seed --class UserRolesTableSeeder
8. php artisan db:seed --class UsersTableSeeder
9. php -S localhost:8000 -t public - this will start the local server.

Until now, there should be 2 tables created in the database.
1. Users
2. User roles

You can run and test the API on the postman tool. 
1. View all users - 
      1) Select the GET method.
      2) Use this URL - http://localhost:8000/api/v1/users.
2. View user's details - 
      1) Select the GET method.
      2) Use this URL - http://localhost:8000/api/v1/user/{id}
3. Create a new user - 
      1) Select POST method.
      2) http://localhost:8000/api/v1/user?firstname={firstname}&lastname={lastname}&email={email}&company={company}&role={role}
      Note : role entered should be any from our database.
4. Update user -    
      1) Select PUT method.
      2) http://localhost:8000/api/v1/user?firstname={firstname}&lastname={lastname}&email={email}&company={company}&role={role}
      Note : role entered should be any from our database.
5. Delete a user
      1) Select DELETE method.
      2) http://localhost:8000/api/v1/user/{id}
