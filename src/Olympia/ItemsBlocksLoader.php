<?php

namespace Olympia;

use customiesdevs\customies\item\CustomiesItemFactory;
use pocketmine\plugin\PluginBase;

class ItemsBlocksLoader extends PluginBase
{
    protected function onEnable(): void
    {

    }

    private function registerAllItems(): void
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