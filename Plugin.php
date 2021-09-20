<?php
namespace Sunsoft\Rtl;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name' => 'Rtl',
            'description' => 'Rtl support for October cms',
            'author' => 'Sunsoft',
            'icon' => 'icon-headphones',
        ];
    }

    public function boot()
    {
        // Check if we are currently in backend module.
        if (!\App::runningInBackend()) return;

        // Listen for `backend.page.beforeDisplay` event and inject js to current controller instance.
        \Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            if (!\Request::ajax()) {
                $controller->addCss(\Config::get('cms.pluginsPath') . ('/plugins/sunsoft/rtl/assets/rtl.css'));
				$controller->addJs(\Config::get('cms.pluginsPath') . ('/plugins/sunsoft/rtl/assets/rtl.js'));
            }
        });
    }
}