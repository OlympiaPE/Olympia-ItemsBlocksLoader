<?php

namespace Olympia\items;

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
use pocketmine\item\Item;
use pocketmine\utils\CloningRegistryTrait;

/**
 * Farm :
 * @method static FarmLeggings FARM_LEGGINGS()
 * @method static FarmBoots FARM_BOOTS()
 *
 * Mithril :
 * @method static MithrilHelmet MITHRIL_HELMET()
 * @method static MithrilChestplate MITHRIL_CHESTPLATE()
 * @method static MithrilLeggings MITHRIL_LEGGINGS()
 * @method static MithrilBoots MITHRIL_BOOTS()
 * @method static MithrilSword MITHRIL_SWORD()
 * @method static MithrilSickle MITHRIL_SICKLE()
 * @method static MithrilIngot MITHRIL_INGOT()
 *
 * Orichalque :
 * @method static OrichalqueHelmet ORICHALQUE_HELMET()
 * @method static OrichalqueChestplate ORICHALQUE_CHESTPLATE()
 * @method static OrichalqueLeggings ORICHALQUE_LEGGINGS()
 * @method static OrichalqueBoots ORICHALQUE_BOOTS()
 * @method static OrichalqueSword ORICHALQUE_SWORD()
 * @method static OrichalqueSickle ORICHALQUE_SICKLE()
 * @method static OrichalqueIngot ORICHALQUE_INGOT()
 * @method static OrichalqueNugget ORICHALQUE_NUGGET()
 *
 * Cronos :
 * @method static CronosHelmet CRONOS_HELMET()
 * @method static CronosChestplate CRONOS_CHESTPLATE()
 * @method static CronosLeggings CRONOS_LEGGINGS()
 * @method static CronosBoots CRONOS_BOOTS()
 *
 * Theia :
 * @method static TheiaHelmet THEIA_HELMET()
 * @method static TheiaChestplate THEIA_CHESTPLATE()
 * @method static TheiaLeggings THEIA_LEGGINGS()
 * @method static TheiaBoots THEIA_BOOTS()
 *
 * Special tools :
 * @method static InfinitySword INFINITY_SWORD()
 * @method static VulcainPickaxe VULCAIN_PICKAXE()
 *
 * Generators :
 * @method static GeneratorCobblestone GENERATOR_COBBLESTONE()
 * @method static GeneratorCraftingTable GENERATOR_CRAFTINGTABLE()
 * @method static GeneratorFenceGate GENERATOR_FENCEGATE()
 *
 * Special items :
 * @method static EnderPearl ENDER_PEARL()
 * @method static EggTrap EGGTRAP()
 * @method static Switchball SWITCHBALL()
 * @method static Force FORCE()
 * @method static Resistance RESISTANCE()
 * @method static Levitation LEVITATION()
 * @method static PortalTp PORTAL_TP()
 * @method static Rocket ROCKET()
 * @method static InfernalStick INFERNAL_STICK()
 * @method static AntiPearlStick ANTI_PEARL_STICK()
 * @method static AntiBuildStick ANTI_BUILD_STICK()
 * @method static Nemo NEMO()
 * @method static InstantTp INSTANT_TP()
 * @method static FlyingSoup FLYING_SOUP()
 */

final class OlympiaItems
{
    use CloningRegistryTrait;

    protected static function register(string $name, Item $item): void
    {
        self::_registryRegister($name, $item);
    }

    /**
     * @return Item[]
     * @phpstan-return array<string, Item>
     */
    public static function getAll(): array
    {
        /** @var Item[] $result */
        $result = self::_registryGetAll();
        return $result;
    }

    protected static function setup(): void
    {
        $factory = CustomiesItemFactory::getInstance();

        self::register("farm_leggings", $factory->get("minecraft:farm_leggings"));
        self::register("farm_boots", $factory->get("minecraft:farm_boots"));

        self::register("mithril_helmet", $factory->get("minecraft:mithril_helmet"));
        self::register("mithril_chestplate", $factory->get("minecraft:mithril_chestplate"));
        self::register("mithril_leggings", $factory->get("minecraft:mithril_leggings"));
        self::register("mithril_boots", $factory->get("minecraft:mithril_boots"));
        self::register("mithril_sword", $factory->get("minecraft:mithril_sword"));
        self::register("mithril_sickle", $factory->get("minecraft:mithril_sickle"));
        self::register("mithril_ingot", $factory->get("minecraft:mithril_ingot"));

        self::register("orichalque_helmet", $factory->get("minecraft:orichalque_helmet"));
        self::register("orichalque_chestplate", $factory->get("minecraft:orichalque_chestplate"));
        self::register("orichalque_leggings", $factory->get("minecraft:orichalque_leggings"));
        self::register("orichalque_boots", $factory->get("minecraft:orichalque_boots"));
        self::register("orichalque_sword", $factory->get("minecraft:orichalque_sword"));
        self::register("orichalque_sickle", $factory->get("minecraft:orichalque_sickle"));
        self::register("orichalque_ingot", $factory->get("minecraft:orichalque_ingot"));
        self::register("orichalque_nugget", $factory->get("minecraft:orichalque_nugget"));

        self::register("cronos_helmet", $factory->get("minecraft:cronos_helmet"));
        self::register("cronos_chestplate", $factory->get("minecraft:cronos_chestplate"));
        self::register("cronos_leggings", $factory->get("minecraft:cronos_leggings"));
        self::register("cronos_boots", $factory->get("minecraft:cronos_boots"));

        self::register("theia_helmet", $factory->get("minecraft:theia_helmet"));
        self::register("theia_chestplate", $factory->get("minecraft:theia_chestplate"));
        self::register("theia_leggings", $factory->get("minecraft:theia_leggings"));
        self::register("theia_boots", $factory->get("minecraft:theia_boots"));

        self::register("vulcain_pickaxe", $factory->get("minecraft:vulcain_pickaxe"));
        self::register("infinity_sword", $factory->get("minecraft:infinity_sword"));

        self::register("generator_cobblestone", $factory->get("minecraft:generator_cobblestone"));
        self::register("generator_craftingtable", $factory->get("minecraft:generator_craftingtable"));
        self::register("generator_fencegate", $factory->get("minecraft:generator_fencegate"));

        self::register("ender_pearl", $factory->get("minecraft:olympia_ender_pearl"));
        self::register("eggtrap", $factory->get("minecraft:eggtrap"));
        self::register("switchball", $factory->get("minecraft:switchball"));
        self::register("force", $factory->get("minecraft:force"));
        self::register("resistance", $factory->get("minecraft:resistance"));
        self::register("levitation", $factory->get("minecraft:levitation"));
        self::register("portal_tp", $factory->get("minecraft:portal_tp"));
        self::register("rocket", $factory->get("minecraft:rocket"));
        self::register("infernal_stick", $factory->get("minecraft:infernal_stick"));
        self::register("anti_pearl_stick", $factory->get("minecraft:anti_pearl_stick"));
        self::register("anti_build_stick", $factory->get("minecraft:anti_build_stick"));
        self::register("nemo", $factory->get("minecraft:nemo"));
        self::register("instant_tp", $factory->get("minecraft:instant_tp"));
        self::register("flying_soup", $factory->get("minecraft:flying_soup"));
    }
}