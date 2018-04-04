<?php

namespace AvoRed\Banner;

use AvoRed\Banner\Widget\Banner\Widget;
use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Widget\Facade as WidgetFacade;
use AvoRed\Framework\AdminMenu\Facade as AdminMenuFacade;
use AvoRed\Framework\AdminMenu\AdminMenu;
use AvoRed\Framework\Breadcrumb\Facade as BreadcrumbFacade;

class Module extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
        $this->registerWidget();
        $this->registerAdminMenu();
        $this->registerBreadCrumb();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Registering AvoRed featured Resource
     * e.g. Route, View, Database  & Translation Path
     *
     * @return void
     */
    protected function registerResources()
    {

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-banner');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-banner');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register the Widget.
     *
     * @return void
     */
    protected function registerWidget()
    {
        $bannerProduct = new Widget();
        WidgetFacade::make($bannerProduct->identifier(), $bannerProduct);
    }

    /**
     * Register the Admin Menu.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        $systemMenu = AdminMenuFacade::get('system');

        $bannerMenu = new AdminMenu();
        $bannerMenu->key('banner')
            ->label('Banner')
            ->route('admin.banner.index')
            ->icon('fas fa-ticket-alt');

        $systemMenu->subMenu('banner', $bannerMenu);
    }

    /**
     * Register the Admin Menu.
     *
     * @return void
     */
    protected function registerBreadCrumb()
    {


        BreadcrumbFacade::make('admin.banner.index', function ($breadcrumb) {
                                $breadcrumb->label('Banner')
                                    ->parent('admin.dashboard');
                            });

        BreadcrumbFacade::make('admin.banner.create', function ($breadcrumb) {
                                $breadcrumb->label('Create')
                                    ->parent('admin.dashboard')
                                    ->parent('admin.banner.index');
                            });
    }

}