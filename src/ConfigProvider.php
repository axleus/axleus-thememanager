<?php

declare(strict_types=1);

namespace Axleus\ThemeManager;

use Axleus\Core\ConfigProviderInterface;
use Mezzio\LaminasView\LaminasViewRenderer;

final class ConfigProvider implements ConfigProviderInterface
{
    public const DEFAULT_THEME    = 'default';
    public const THEME_CONFIG_KEY = 'themes';

    public function __invoke(): array
    {
        return [
            'dependencies'       => $this->getDependencies(),
            static::class        => $this->getAxleusConfig(),
            'view_helpers'       => $this->getViewHelpers(),
            'view_helper_config' => $this->getViewHelperConfig(),
            'view_manager'       => $this->getViewManagerConfig(),
            'templates'          => $this->getTemplates(),
        ];
    }

    public function getAxleusConfig(): array
    {
        return [
            static::THEME_CONFIG_KEY => [
                static::DEFAULT_THEME => [
                    'id'        => 1,
                    'active'    => false,
                    'name'      => 'default',
                    'fallback'  => 'default',
                    'bsTheme'   => 'dark',
                    'assetMap' => [
                        'image'      => 'themes/%s/img/%s',
                        'stylesheet' => 'themes/%s/css/%s',
                        'script'     => 'themes/%s/js/%s',
                    ],
                ],
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            // 'aliases' => [
            //     LaminasViewRenderer::class => Renderer\Renderer::class,
            // ],
            'factories' => [
                LaminasViewRenderer::class => Renderer\RendererFactory::class,
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'layout' => 'layout::layout',
            'header' => 'layout::header',
            'body'   => 'layout::body',
            'footer' => 'layout::footer',
            // 'paths' => [
            //     'theme-manager' => [__DIR__ . '/../templates/'],
            // ],
        ];
    }

    public function getViewHelperConfig(): array
    {
        return [
            'doctype' => 'HTML5',
        ];
    }

    public function getViewHelpers(): array
    {
        return [
            'aliases' => [
                'theme'       => Helper\ThemeHelper::class,
                'themeHelper' => Helper\ThemeHelper::class,
            ],
            'factories' => [
                Helper\ThemeHelper::class => Helper\ThemeHelperFactory::class,
            ],
        ];
    }

    public function getViewManagerConfig(): array
    {
        return [
            'base_path' => '/',
        ];
    }
}
