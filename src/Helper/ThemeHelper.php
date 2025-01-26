<?php

declare(strict_types=1);

namespace Axleus\ThemeManager\Helper;

use Axleus\ThemeManager\ConfigProvider;
use Axleus\ThemeManager\Theme;
use Axleus\ThemeManager\ThemeInterface;
use Laminas\View\Helper\AbstractHelper;
use Laminas\View\Helper\BasePath;

class ThemeHelper extends AbstractHelper
{
    private ThemeInterface $activeTheme;

    public function __construct(
        private BasePath $basePath,
        private array $config
    ) {
    }

    public function __invoke(): self
    {
        $this->getActiveTheme();
        return $this;
    }

    public function getActiveTheme(): ThemeInterface
    {
        foreach ($this->config[ConfigProvider::THEME_CONFIG_KEY] as $theme) {
            if ($theme['active']) {
                $this->setActiveTheme(Theme::factory($theme));
            }
        }
        return $this->activeTheme;
    }

    public function setActiveTheme(ThemeInterface $activeTheme): void
    {
        $this->activeTheme = $activeTheme;
    }

    public function asset(string $type, string $file): string
    {
        $basePath = $this->basePath;
        return $basePath($this->activeTheme->asset($type, $file));
    }

    public function bsTheme(): string
    {
        return $this->activeTheme->offsetExists('bsTheme') ? $this->activeTheme->offsetGet('bsTheme') : 'dark';
    }
}
