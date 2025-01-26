<?php

declare(strict_types=1);

namespace Axleus\ThemeManager\Helper;

use Axleus\ThemeManager\ConfigProvider;
use Laminas\View\HelperPluginManager;
use Laminas\View\Helper\BasePath;
use Psr\Container\ContainerInterface;

final class ThemeHelperFactory
{
    public function __invoke(ContainerInterface $container): ThemeHelper
    {
        $manager = $container->get(HelperPluginManager::class);
        return new ThemeHelper(
            $manager->get(BasePath::class),
            $container->get('config')[ConfigProvider::class] ?? []
        );
    }
}
