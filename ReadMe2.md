
### New Project
```angular2html
laravel new _my_project
```

### New Project + Authorization
```angular2html
laravel new app
cd app
```
```angular2html
composer require laravel/breeze --dev
```
```angular2html
php artisan breeze:install
```


### Show current database
```angular2html
php artisan db:show
```

### Build us all table based on migrations code edited
```angular2html
php artisan migrate
```

### New Model 
```angular2html
php artisan make:model _Employee -m
```



### Factory class create for random generation of instance
```angular2html
php artisan make:factory _JobFactory
```

### Model + Factory
```angular2html
php artisan make:model _Employer -f
```

### Model + Migration + Factory
```angular2html
php artisan make:model _Tag -mf
```

### create instance
```angular2html
php artisan tinker
App\Models\User::factory(100)->create() 
```

### UNKNOWN
```angular2html
php artisan migrate:rollback 
```

### UNKNOWN
```angular2html
php artisan migrate:rollback; php artisan migrate
```

### Remove all data and initialize empty
```angular2html
 php artisan migrate:fresh   
```

### Remove all data and initialize with seed data
```angular2html
php artisan migrate:fresh --seed   
```

### new seeder
```angular2html
php artisan make:seeder
```
<hr>

### new controller
```angular2html
 php artisan make:controller
```

### check all route list
```angular2html
php artisan route:list --except-vendor
```
