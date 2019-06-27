<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {

    $api->group(['prefix' => 'auth'], function (Router $api) {
        $api->post('social-login', 'App\\Api\\V1\\Controllers\\LoginController@socialLogin');
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');
        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
        $api->post('logout', 'App\\Api\\V1\\Controllers\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Controllers\\RefreshController@refresh');
        $api->get('me', 'App\\Api\\V1\\Controllers\\UserController@me');
    });

    $api->group(['middleware' => 'bindings'], function ($api) {
        $api->group(['prefix' => 'data'], function (Router $api) {

            # Branch
            $api->get('branches/{branch}', 'App\Api\V1\Controllers\BranchController@showMain');
            $api->get('branches', 'App\Api\V1\Controllers\BranchController@indexMain');    
            $api->resource('branches', 'App\Api\V1\Controllers\BranchController', [
                        'except' => ['index', 'show']
                        ]);
            $api->resource('companies.branches', 'App\Api\V1\Controllers\BranchController');


            # BranchType
            $api->get('branchtypes/{branchtype}', 'App\Api\V1\Controllers\BranchTypeController@showMain');
            $api->get('branchtypes', 'App\Api\V1\Controllers\BranchTypeController@indexMain');
            $api->put('branchtypes', 'App\Api\V1\Controllers\BranchTypeController@find');
            $api->resource('branchtypes', 'App\Api\V1\Controllers\BranchTypeController', [
                'except' => ['index', 'show']
                ]);

            # Category
            $api->get('categories/{category}', 'App\Api\V1\Controllers\CategoryController@showMain');
            $api->get('categories', 'App\Api\V1\Controllers\CategoryController@indexMain');
            $api->resource('categories', 'App\Api\V1\Controllers\CategoryController', [
                'except' => ['index', 'show']
                ]);

            # City
            $api->get('cities/{city}', 'App\Api\V1\Controllers\CityController@showMain');
            $api->get('cities', 'App\Api\V1\Controllers\CityController@indexMain');
            $api->resource('cities', 'App\Api\V1\Controllers\CityController', [
                        'except' => ['index', 'show']
                        ]);
            $api->resource('states.cities', 'App\Api\V1\Controllers\CityController');


            # Company
            $api->get('companies/{company}', 'App\Api\V1\Controllers\CompanyController@showMain');
            $api->get('companies', 'App\Api\V1\Controllers\CompanyController@indexMain');
            $api->resource('companies', 'App\Api\V1\Controllers\CompanyController', [
                            'except' => ['index', 'show']
                        ]);
            $api->resource('companytypes.companies', 'App\Api\V1\Controllers\CompanyController');

            # CompanyType
            $api->get('companytypes/{companytype}', 'App\Api\V1\Controllers\CompanyTypeController@showMain');
            $api->get('companytypes', 'App\Api\V1\Controllers\CompanyTypeController@indexMain');
            $api->resource('companytypes', 'App\Api\V1\Controllers\CompanyTypeController', [
                'except' => ['index', 'show']
                ]);

            # Counter
            $api->get('counters/{counter}', 'App\Api\V1\Controllers\CounterController@showMain');
            $api->get('counters', 'App\Api\V1\Controllers\CounterController@indexMain');
            $api->resource('counters', 'App\Api\V1\Controllers\CounterController', [
                'except' => ['index', 'show']
                ]);

            # Country
            $api->get('countries/{country}', 'App\Api\V1\Controllers\CountryController@showMain');
            $api->get('countries', 'App\Api\V1\Controllers\CountryController@indexMain');
            $api->resource('countries', 'App\Api\V1\Controllers\CountryController', [
                'except' => ['index', 'show']
                ]);

            # Currency
            $api->get('currencies/{currency}', 'App\Api\V1\Controllers\CurrencyController@showMain');
            $api->get('currencies', 'App\Api\V1\Controllers\CurrencyController@indexMain');
            $api->resource('currencies', 'App\Api\V1\Controllers\CurrencyController', [
                'except' => ['index', 'show']
                ]);

            # DietaryPreference
            $api->get('dietarypreferences/{dietarypreference}', 'App\Api\V1\Controllers\DietaryPreferenceController@showMain');
            $api->get('dietarypreferences', 'App\Api\V1\Controllers\DietaryPreferenceController@indexMain');
            $api->resource('dietarypreferences', 'App\Api\V1\Controllers\dietarypreferenceController', [
                'except' => ['index', 'show']
                ]);

            # Menu
            $api->get('menus/{menu}', 'App\Api\V1\Controllers\MenuController@showMain');
            $api->get('menus', 'App\Api\V1\Controllers\MenuController@indexMain');
            
            # Menu Resource
            $api->resource('menus', 'App\Api\V1\Controllers\MenuController', [
                            'except' => ['index', 'show']
                        ]);
            $api->resource('branches.menus', 'App\Api\V1\Controllers\MenuController');

            # MenuHasProduct
            $api->get('menuhasproducts/{menuhasproduct}', 'App\Api\V1\Controllers\MenuHasProductController@showMain');
            $api->get('menuhasproducts', 'App\Api\V1\Controllers\MenuHasProductController@indexMain');
            $api->resource('menuhasproducts', 'App\Api\V1\Controllers\MenuHasProductController', [
                'except' => ['index', 'show']
                ]);

            # ModelHasPermission
            $api->get('modelhaspermissions/{modelhaspermission}', 'App\Api\V1\Controllers\ModelHasPermissionController@show');
            $api->get('modelhaspermissions', 'App\Api\V1\Controllers\ModelHasPermissionController@index');

            # ModelHasRole
            $api->get('modelhasroles/{modelhasrole}', 'App\Api\V1\Controllers\ModelHasRoleController@show');
            $api->get('modelhasroles', 'App\Api\V1\Controllers\ModelHasRoleController@index');


            # PasswordReset
            $api->get('passwordreset/{passwordreset}', 'App\Api\V1\Controllers\ResetPasswordController@show');
            $api->get('passwordreset', 'App\Api\V1\Controllers\ResetPasswordController@index');


            # Permission
            $api->resource('permissions', 'App\Api\V1\Controllers\PermissionController');

            # Product
            $api->get('products/{product}', 'App\Api\V1\Controllers\ProductController@showMain');
            $api->get('products', 'App\Api\V1\Controllers\ProductController@indexMain');
            $api->resource('products', 'App\Api\V1\Controllers\ProductController', [
                'except' => ['index', 'show']
                ]);


            # ProductHasAddon
            $api->get('producthasaddons/{producthasaddon}', 'App\Api\V1\Controllers\ProductHasAddonController@showMain');
            $api->get('producthasaddons', 'App\Api\V1\Controllers\ProductHasAddonController@indexMain');
            $api->resource('producthasaddons', 'App\Api\V1\Controllers\ProductHasAddonController', [
                'except' => ['index', 'show']
                ]);


            # ProductUnit
            $api->get('productunits/{productunit}', 'App\Api\V1\Controllers\ProductUnitController@showMain');
            $api->get('productunits', 'App\Api\V1\Controllers\ProductUnitController@indexMain');
            $api->resource('productunits', 'App\Api\V1\Controllers\ProductUnitController', [
                'except' => ['index', 'show']
                ]);


            # Role
            $api->resource('roles', 'App\Api\V1\Controllers\RoleController');

            # RoleHasPermission
            $api->get('rolehaspermissions/{rolehaspermission}', 'App\Api\V1\Controllers\RoleHasPermissionController@show');
            $api->get('rolehaspermissions', 'App\Api\V1\Controllers\RoleHasPermissionController@index');


            # Selection
            $api->get('selections/{selection}', 'App\Api\V1\Controllers\SelectionController@showMain');
            $api->get('selections', 'App\Api\V1\Controllers\SelectionController@indexMain');
            $api->resource('selections', 'App\Api\V1\Controllers\SelectionController', [
                'except' => ['index', 'show']
                ]);


            # SocialAuthentication
            // $api->get('socialauthentication/{socialauthentication}', 'App\Api\V1\Controllers\SocialAuthenticationController@showMain');
            // $api->get('socialauthentication', 'App\Api\V1\Controllers\SocialAuthenticationController@indexMain');


            # State
            $api->get('states/{state}', 'App\Api\V1\Controllers\StateController@showMain');
            $api->get('states', 'App\Api\V1\Controllers\StateController@indexMain');
            # State Resource
            $api->resource('states', 'App\Api\V1\Controllers\StateController', [
                'except' => ['index', 'show']
            ]);
            $api->resource('countries.states', 'App\Api\V1\Controllers\StateController');

            # Unit
            $api->get('units/{unit}', 'App\Api\V1\Controllers\UnitController@showMain');
            $api->get('units', 'App\Api\V1\Controllers\UnitController@indexMain');
            $api->resource('units', 'App\Api\V1\Controllers\UnitController', [
                'except' => ['index', 'show']
                ]);


            # User
            $api->get('users/{users\}', 'App\Api\V1\Controllers\UserController@showMain');
            $api->get('users', 'App\Api\V1\Controllers\UserController@indexMain');
            $api->resource('users', 'App\Api\V1\Controllers\UserController', [
                'except' => ['index', 'show']
                ]);


            # Variation
            $api->get('variations/{variation}', 'App\Api\V1\Controllers\VariationController@showMain');
            $api->get('variations', 'App\Api\V1\Controllers\VariationController@indexMain');
            $api->resource('variations', 'App\Api\V1\Controllers\VariationController', [
                'except' => ['index', 'show']
            ]);
        
        });
    });

    $api->group(['middleware' => 'jwt.auth'], function (Router $api) {
        $api->get('refresh', ['middleware' => 'jwt.refresh', function () {
            return response()->json([
                'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!',
            ]);
        }]);
    });

    // For Guest Users
    $api->group(['middleware' => 'bindings'], function (Router $api) {
        // User Management
        $api->resource('users', 'App\\Api\\V1\\Controllers\\UserController');
    });
});
