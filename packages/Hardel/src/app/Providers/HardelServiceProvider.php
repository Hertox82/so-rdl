<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 09:48
 */

namespace Hardel\Providers;

use Hardel\Support\Block\Submask\SubmaskBlock;
use Hardel\Support\Block\Submask\SubmaskBlockAjax;
use Hardel\Support\Field\CheckboxField;
use Hardel\Support\Field\DateField;
use Hardel\Support\Field\EmailField;
use Hardel\Support\Field\HiddenField;
use Hardel\Support\Field\PasswordField;
use Hardel\Support\Field\PriceField;
use Hardel\Support\Field\SelectField;
use Hardel\Support\Field\TextareaField;
use Hardel\Support\Field\TextField;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Hardel\Support\ListManager;
use Hardel\Support\EditManager;
use Hardel\Support\Menu;

use Hardel\Support\Block\Base\Block;


class HardelServiceProvider extends ServiceProvider
{

    public function boot()
    {
        /**
         * Routing
         */
        if (!$this->app->routesAreCached()) {
            require __DIR__.'/../routes.php';
        }

        /**
         * Risorse - VIEW
         */
        $this->loadViewsFrom(__DIR__.'/../../resources/view','hardel');

        $this->registerHelperFile();
    }

    public function register()
    {
        $aliases = require __DIR__.'/../aliases.php';
        AliasLoader::getInstance($aliases)->register();

        /**
         * Facades
         */
        $this->app->bind('listmanager',function($app) {
            return new ListManager();
        });
        $this->app->bind('editmanager',function($app) {
            return new EditManager();
        });
        $this->app->bind('menu',function($app) {
            return new Menu();
        });

        $this->registerComponent();
    }


    private function registerHelperFile()
    {
        if(file_exists($file = __DIR__.'/../helpers.php'))
        {
            require $file;
        }
    }

    private function registerComponent(){

        $this->registerBlock();

        $this->registerField();
    }

    private function registerBlock()
    {
        $this->app->bind('block',function($app) {
            return new Block();
        });

        $this->app->bind('sbmskblock',function($app) {
            return new SubmaskBlock();
        });

        $this->app->bind('sbmskblockAJ',function($app) {
            return new SubmaskBlockAjax();
        });
    }

    private function registerField()
    {
        $this->app->bind('checkbox',function($app) {
            return new CheckboxField();
        });

        $this->app->bind('date',function($app) {
            return new DateField();
        });

        $this->app->bind('email',function($app) {
            return new EmailField();
        });

        $this->app->bind('hidden',function($app) {
            return new HiddenField();
        });

        $this->app->bind('password',function($app) {
            return new PasswordField();
        });

        $this->app->bind('price',function($app) {
            return new PriceField();
        });

        $this->app->bind('select',function($app) {
            return new SelectField();
        });

        $this->app->bind('textarea',function($app) {
            return new TextareaField();
        });

        $this->app->bind('text',function($app) {
            return new TextField();
        });
    }
}
