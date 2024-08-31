<?php

namespace Olympia\loaders;

use customiesdevs\customies\item\CustomiesItemFactory;
use Olympia\ConfigManager;
use Olympia\items\armors\cronos\CronosBoots;
use Olympia\items\armors\cronos\CronosChestplate;
use Olympia\items\armors\cronos\CronosHelmet;
use Olympia\items\armors\cronos\CronosLeggings;
use Olympia\items\armors\farm\FarmBoots;
use Olympia\items\armors\farm\FarmLeggings;
use Olympia\items\armors\mithril\MithrilBoots;
use Olympia\items\armors\mithril\MithrilChestplate;
use Olympia\items\armors\mithril\MithrilHelmet;
use Olympia\items\armors\mithril\MithrilLeggings;
use Olympia\items\armors\orichalque\OrichalqueBoots;
use Olympia\items\armors\orichalque\OrichalqueChestplate;
use Olympia\items\armors\orichalque\OrichalqueHelmet;
use Olympia\items\armors\orichalque\OrichalqueLeggings;
use Olympia\items\armors\theia\TheiaBoots;
use Olympia\items\armors\theia\TheiaChestplate;
use Olympia\items\armors\theia\TheiaHelmet;
use Olympia\items\armors\theia\TheiaLeggings;
use Olympia\items\generators\types\GeneratorCobblestone;
use Olympia\items\generators\types\GeneratorCraftingTable;
use Olympia\items\generators\types\GeneratorFenceGate;
use Olympia\items\minerals\MithrilIngot;
use Olympia\items\minerals\OrichalqueIngot;
use Olympia\items\minerals\OrichalqueNugget;
use Olympia\items\partners\AntiBuildStick;
use Olympia\items\partners\AntiPearlStick;
use Olympia\items\partners\EggTrap;
use Olympia\items\partners\FlyingSoup;
use Olympia\items\partners\Force;
use Olympia\items\partners\InfernalStick;
use Olympia\items\partners\InstantTp;
use Olympia\items\partners\Levitation;
use Olympia\items\partners\Nemo;
use Olympia\items\partners\PortalTp;
use Olympia\items\partners\Resistance;
use Olympia\items\partners\Rocket;
use Olympia\items\partners\Switchball;
use Olympia\items\projectiles\EnderPearlFFA;
use Olympia\items\projectiles\EnderPearlKitMap;
use Olympia\items\tools\pickaxes\types\VulcainPickaxe;
use Olympia\items\tools\sickles\types\MithrilSickle;
use Olympia\items\tools\sickles\types\OrichalqueSickle;
use Olympia\items\tools\swords\types\InfinitySword;
use Olympia\items\tools\swords\types\MithrilSword;
use Olympia\items\tools\swords\types\OrichalqueSword;
use Olympia\Loader;
use pocketmine\item\StringToItemParser;

final class ItemsLoader
{
    public static function loadAllItems(): void
    {
        self::registerItem(FarmLeggings::class, "minecraft:farm_leggings", "Farm Leggings");
        self::registerItem(FarmBoots::class, "minecraft:farm_boots", "Farm Boots");

        self::registerItem(MithrilHelmet::class, "minecraft:mithril_helmet", "Mithril Helmet");
        self::registerItem(MithrilChestplate::class, "minecraft:mithril_chestplate", "Mithril Chestplate");
        self::registerItem(MithrilLeggings::class, "minecraft:mithril_leggings", "Mithril Leggings");
        self::registerItem(MithrilBoots::class, "minecraft:mithril_boots", "Mithril Boots");
        self::registerItem(MithrilSword::class, "minecraft:mithril_sword", "Mithril Sword");
        self::registerItem(MithrilSickle::class, "minecraft:mithril_sickle", "Mithril Sickle");
        self::registerItem(MithrilIngot::class, "minecraft:mithril_ingot", "Mithril Ingot");

        self::registerItem(OrichalqueHelmet::class, "minecraft:orichalque_helmet", "Orichalque Helmet");
        self::registerItem(OrichalqueChestplate::class, "minecraft:orichalque_chestplate", "Orichalque Chestplate");
        self::registerItem(OrichalqueLeggings::class, "minecraft:orichalque_leggings", "Orichalque Leggings");
        self::registerItem(OrichalqueBoots::class, "minecraft:orichalque_boots", "Orichalque Boots");
        self::registerItem(OrichalqueSword::class, "minecraft:orichalque_sword", "Orichalque Sword");
        self::registerItem(OrichalqueSickle::class, "minecraft:orichalque_sickle", "Orichalque Sickle");
        self::registerItem(OrichalqueIngot::class, "minecraft:orichalque_ingot", "Orichalque Ingot");
        self::registerItem(OrichalqueNugget::class, "minecraft:orichalque_nugget", "Orichalque Nugget");

        self::registerItem(CronosHelmet::class, "minecraft:cronos_helmet", "Cronos Helmet");
        self::registerItem(CronosChestplate::class, "minecraft:cronos_chestplate", "Cronos Chestplate");
        self::registerItem(CronosLeggings::class, "minecraft:cronos_leggings", "Cronos Leggings");
        self::registerItem(CronosBoots::class, "minecraft:cronos_boots", "Cronos Boots");

        self::registerItem(TheiaHelmet::class, "minecraft:theia_helmet", "Theia Helmet");
        self::registerItem(TheiaChestplate::class, "minecraft:theia_chestplate", "Theia Chestplate");
        self::registerItem(TheiaLeggings::class, "minecraft:theia_leggings", "Theia Leggings");
        self::registerItem(TheiaBoots::class, "minecraft:theia_boots", "Theia Boots");

        self::registerItem(InfinitySword::class, "minecraft:infinity_sword", "Infinity Sword");
        self::registerItem(VulcainPickaxe::class, "minecraft:vulcain_pickaxe", "Vulcain Pickaxe");

        self::registerItem(GeneratorCobblestone::class, "minecraft:generator_cobblestone", "Generator Cobbletone");
        self::registerItem(GeneratorCraftingTable::class, "minecraft:generator_craftingtable", "Generator Crafting Table");
        self::registerItem(GeneratorFenceGate::class, "minecraft:generator_fencegate", "Generator Fence Gate");

        self::registerItem(EnderPearlKitMap::class, "minecraft:ender_pearl_kitmap", "Ender Pearl KitMap");
        self::registerItem(EggTrap::class, "minecraft:eggtrap", "Egg Trap");
        self::registerItem(Switchball::class, "minecraft:switchball", "Switchball");
        self::registerItem(Force::class, "minecraft:force", "Force");
        self::registerItem(Resistance::class, "minecraft:resistance", "Resistance");
        self::registerItem(Levitation::class, "minecraft:levitation", "Levitation");
        self::registerItem(PortalTp::class, "minecraft:portal_tp", "Portal Tp");
        self::registerItem(Rocket::class, "minecraft:rocket", "Rocket");
        self::registerItem(InfernalStick::class, "minecraft:infernal_stick", "Infernal Stick");
        self::registerItem(AntiPearlStick::class, "minecraft:anti_pearl_stick", "Anti Pearl Stick");
        self::registerItem(AntiBuildStick::class, "minecraft:anti_build_stick", "Anti Build Stick");
        self::registerItem(Nemo::class, "minecraft:nemo", "Nemo");
        self::registerItem(InstantTp::class, "minecraft:instant_tp", "Instant Tp");
        self::registerItem(FlyingSoup::class, "minecraft:flying_soup", "Flying Soup");

        self::registerItem(EnderPearlFFA::class, "minecraft:ender_pearl_ffa", "Ender Pearl FFA");
    }

    public static function registerItem(string $className, string $identifier, string $name, bool $customId = true): void
    {
        if (is_null(StringToItemParser::getInstance()->parse($identifier))) {
            $identifierItemName = explode(":", $identifier, 2)[1];
            $id = $customId ? constant("Olympia\items\OlympiaItemTypeIds::" . strtoupper($identifierItemName)) : null;
            CustomiesItemFactory::getInstance()->registerItem($className, $identifier, $name, $id);
        }
    }
}