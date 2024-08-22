<?php

namespace Olympia;

use Olympia\loaders\BlocksLoader;
use Olympia\loaders\ItemsLoader;
use Olympia\loaders\RecipesLoader;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Loader extends PluginBase
{
    use SingletonTrait;

    private ConfigManager $configManager;

    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    protected function onEnable(): void
    {
        $this->configManager = new ConfigManager($this);
        BlocksLoader::loadAllBlocks();
        ItemsLoader::loadAllItems();
        RecipesLoader::loadAllRecipes();
    }

    public function getConfigManager(): ConfigManager
    {
        return $this->configManager;
    }
}