<?php

declare(strict_types=1);

namespace Axleus\ThemeManager;

use Mezzio\LaminasView\LaminasViewRenderer;

final class ConfigProvider
{
    public const APP_SETTINGS_KEY = 'app_settings';
    public const DEFAULT_THEME    = 'default';
    public const THEME_CONFIG_KEY = 'themes';

    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            static::APP_SETTINGS_KEY => $this->getAppSettings(),
        ];
    }

    public function getAppSettings(): array
    {
        return [
            static::class => [
                'themes' => [
                    static::DEFAULT_THEME => [
                        'id'       => 1,
                        'active'   => false,
                        'name'     => 'default',
                        'fallback' => 'default',
                        // 'resource_map' => [
                        //     'css/style.css'              => 'theme/default/css/style.css',
                        //     'css/bootstrap.css'          => 'theme/default/css/bootstrap.css',
                        //     'css/bootstrap.min.css'      => 'theme/default/css/bootstrap.min.css',
                        //     'js/bootstrap.js'            => 'theme/default/js/bootstrap.js',
                        //     'js/bootstrap.min.js'        => 'theme/default/js/bootstrap.min.js',
                        //     'img/favicon.ico'            => 'theme/default/img/favicon.ico',
                        //     'img/webinertia-logo-75.png' => 'theme/default/img/webinertia-logo-75.png',
                        // ],
                    ],
                ],
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                LaminasViewRenderer::class => RendererFactory::class,
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'theme-manager' => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
