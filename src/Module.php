<?php

namespace AvoRed\Banner;

use Illuminate\Support\ServiceProvider;
use AvoRed\Banner\Widget\Banner\Widget as BannerWidget;
use AvoRed\Banner\Database\Repository\BannerRepository;
use AvoRed\Banner\Database\Contracts\BannerInterface;
use AvoRed\Framework\Menu\MenuItem;
use AvoRed\Framework\Support\Facades\Menu;
use AvoRed\Framework\Support\Facades\Widget;
use AvoRed\Framework\Support\Facades\Breadcrumb as BreadcrumbFacade;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Tab\TabItem;

class Module extends ServiceProvider
{
    /**
     * Bootstrap any application services
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
        $this->registerWidget();
        $this->registerAdminMenu();
        $this->registerTab();
        $this->registerBreadCrumb();
        // $this->registerPermissions();
        $this->publishFiles();
        $this->registerModelContracts();
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
        $bannerProduct = new BannerWidget();
        Widget::make($bannerProduct->identifier(), $bannerProduct);
    }

    /**
     * Register the Admin Menu.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        $cmsMenu = Menu::get('cms');
        $cmsMenu->subMenu('banner', function (MenuItem $menuItem) {
            $menuItem->label('Banner')
                ->route('admin.banner.index');
        });
    }

    /**
     * Register the Admin Breadcrumb.
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

        BreadcrumbFacade::make('admin.banner.edit', function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.banner.index');
        });
    }

    /**
     * Publish Files for AvoRed Banner Modules.
     *
     * @return void
     */
    public function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('themes/avored/default/views/vendor')
        ], 'avored-banner-views');
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ]);
        $this->publishes([
            __DIR__ . '/../dist/js' => public_path('avored-admin/js'),
        ]);
    }

    /**
     * Register the Repository Instance.
     *
     * @return void
     */
    protected function registerModelContracts()
    {
        $this->app->bind(BannerInterface::class, BannerRepository::class);
    }
    
    /**
     * Register the Tab for the banner module.
     *
     * @return void
     */
    protected function registerTab()
    {
         /****** CATALOG CATEGORY TABS *******/
         Tab::put('cms.banner', function (TabItem $tab) {
            $tab->key('cms.banner.info')
                ->label('avored-banner::banner.basic_info')
                ->view('avored-banner::banner._fields');
        });
    }
}
