<?php

declare(strict_types=1);

namespace Axleus\ThemeManager\ConsoleCommand;

use Psr\Container\ContainerInterface;

final class BuildThemeCommandFactory
{
    public function __invoke(ContainerInterface $container): BuildThemeCommand
    {
        return new BuildThemeCommand($container->get('config'));
    }
}
