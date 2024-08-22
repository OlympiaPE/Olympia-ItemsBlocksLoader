<?php

namespace Olympia\loaders;

use customiesdevs\customies\item\CustomiesItemFactory;
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
use Olympia\items\projectiles\EnderPearl;
use Olympia\items\tools\pickaxes\types\VulcainPickaxe;
use Olympia\items\tools\sickles\types\MithrilSickle;
use Olympia\items\tools\sickles\types\OrichalqueSickle;
use Olympia\items\tools\swords\types\InfinitySword;
use Olympia\items\tools\swords\types\MithrilSword;
use Olympia\items\tools\swords\types\OrichalqueSword;

final class ItemsLoader
{
    public static function loadAllItems(): void
    {
        $factory = CustomiesItemFactory::getInstance();

        $factory->registerItem(FarmLeggings::class, "minecraft:farm_leggings", "Farm Leggings");
        $factory->registerItem(FarmBoots::class, "minecraft:farm_boots", "Farm Boots");

        $factory->registerItem(MithrilHelmet::class, "minecraft:mithril_helmet", "Mithril Helmet");
        $factory->registerItem(MithrilChestplate::class, "minecraft:mithril_chestplate", "Mithril Chestplate");
        $factory->registerItem(MithrilLeggings::class, "minecraft:mithril_leggings", "Mithril Leggings");
        $factory->registerItem(MithrilBoots::class, "minecraft:mithril_boots", "Mithril Boots");
        $factory->registerItem(MithrilSword::class, "minecraft:mithril_sword", "Mithril Sword");
        $factory->registerItem(MithrilSickle::class, "minecraft:mithril_sickle", "Mithril Sickle");
        $factory->registerItem(MithrilIngot::class, "minecraft:mithril_ingot", "Mithril Ingot");

        $factory->registerItem(OrichalqueHelmet::class, "minecraft:orichalque_helmet", "Orichalque Helmet");
        $factory->registerItem(OrichalqueChestplate::class, "minecraft:orichalque_chestplate", "Orichalque Chestplate");
        $factory->registerItem(OrichalqueLeggings::class, "minecraft:orichalque_leggings", "Orichalque Leggings");
        $factory->registerItem(OrichalqueBoots::class, "minecraft:orichalque_boots", "Orichalque Boots");
        $factory->registerItem(OrichalqueSword::class, "minecraft:orichalque_sword", "Orichalque Sword");
        $factory->registerItem(OrichalqueSickle::class, "minecraft:orichalque_sickle", "Orichalque Sickle");
        $factory->registerItem(OrichalqueIngot::class, "minecraft:orichalque_ingot", "Orichalque Ingot");
        $factory->registerItem(OrichalqueNugget::class, "minecraft:orichalque_nugget", "Orichalque Nugget");

        $factory->registerItem(CronosHelmet::class, "minecraft:cronos_helmet", "Cronos Helmet");
        $factory->registerItem(CronosChestplate::class, "minecraft:cronos_chestplate", "Cronos Chestplate");
        $factory->registerItem(CronosLeggings::class, "minecraft:cronos_leggings", "Cronos Leggings");
        $factory->registerItem(CronosBoots::class, "minecraft:cronos_boots", "Cronos Boots");

        $factory->registerItem(TheiaHelmet::class, "minecraft:theia_helmet", "Theia Helmet");
        $factory->registerItem(TheiaChestplate::class, "minecraft:theia_chestplate", "Theia Chestplate");
        $factory->registerItem(TheiaLeggings::class, "minecraft:theia_leggings", "Theia Leggings");
        $factory->registerItem(TheiaBoots::class, "minecraft:theia_boots", "Theia Boots");

        $factory->registerItem(InfinitySword::class, "minecraft:infinity_sword", "Infinity Sword");
        $factory->registerItem(VulcainPickaxe::class, "minecraft:vulcain_pickaxe", "Vulcain Pickaxe");

        $factory->registerItem(GeneratorCobblestone::class, "minecraft:generator_cobblestone", "Generator Cobbletone");
        $factory->registerItem(GeneratorCraftingTable::class, "minecraft:generator_craftingtable", "Generator Crafting Table");
        $factory->registerItem(GeneratorFenceGate::class, "minecraft:generator_fencegate", "Generator Fence Gate");

        $factory->registerItem(EnderPearl::class, "minecraft:olympia_ender_pearl", "Ender Pearl");
        $factory->registerItem(EggTrap::class, "minecraft:eggtrap", "Egg Trap");
        $factory->registerItem(Switchball::class, "minecraft:switchball", "Switchball");
        $factory->registerItem(Force::class, "minecraft:force", "Force");
        $factory->registerItem(Resistance::class, "minecraft:resistance", "Resistance");
        $factory->registerItem(Levitation::class, "minecraft:levitation", "Levitation");
        $factory->registerItem(PortalTp::class, "minecraft:portal_tp", "Portal Tp");
        $factory->registerItem(Rocket::class, "minecraft:rocket", "Rocket");
        $factory->registerItem(InfernalStick::class, "minecraft:infernal_stick", "Infernal Stick");
        $factory->registerItem(AntiPearlStick::class, "minecraft:anti_pearl_stick", "Anti Pearl Stick");
        $factory->registerItem(AntiBuildStick::class, "minecraft:anti_build_stick", "Anti Build Stick");
        $factory->registerItem(Nemo::class, "minecraft:nemo", "Nemo");
        $factory->registerItem(InstantTp::class, "minecraft:instant_tp", "Instant Tp");
        $factory->registerItem(FlyingSoup::class, "minecraft:flying_soup", "Flying Soup");
    }
}