<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'modules\Users\Interfaces\UserInterface',
            'modules\Users\Repositories\UserRepository',
        );

        $this->app->bind(
            'modules\Admins\Interfaces\AdminInterface',
            'modules\Admins\Repositories\AdminRepository',
        );

        $this->app->bind(
            'modules\Categories\Interfaces\CategoryInterface',
            'modules\Categories\Repositories\CategoryRepository',
        );

        $this->app->bind(
            'modules\Images\Interfaces\ImageInterface',
            'modules\Images\Repositories\ImageRepository',
        );

        $this->app->bind(
            'modules\Orders\Interfaces\OrderInterface',
            'modules\Orders\Repositories\OrderRepository',
        );

        $this->app->bind(
            'modules\Payments\Interfaces\PaymentInterface',
            'modules\Payments\Repositories\PaymentRepository',
        );

        $this->app->bind(
            'modules\Products\Interfaces\ProductInterface',
            'modules\Products\Repositories\ProductRepository',
        );

        $this->app->bind(
            'modules\Rates\Interfaces\RateInterface',
            'modules\Rates\Repositories\RateRepository',
        );

        $this->app->bind(
            'modules\Reviews\Interfaces\ReviewInterface',
            'modules\Reviews\Repositories\ReviewRepository',
        );

        $this->app->bind(
            'modules\Specs\Interfaces\SpecInterface',
            'modules\Specs\Repositories\SpecRepository',
        );
        $this->app->bind(
            'modules\Vendors\Interfaces\VendorInterface',
            'modules\Vendors\Repositories\VendorRepository',
        );
        $this->app->bind(
            'modules\Roles\Interfaces\RoleInterface',
            'modules\Roles\Repositories\RoleRepository',
        );

        $this->app->bind(
            'modules\Permissions\Interfaces\PermissionInterface',
            'modules\Permissions\Repositories\PermissionRepository',
        );

        $this->app->bind(
            'modules\Carts\Interfaces\CartInterface',
            'modules\Carts\Repositories\CartRepository',
        );





    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
