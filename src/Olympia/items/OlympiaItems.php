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
use Olympia\items\hikabrain\SwordAndBlock;
use Olympia\items\lobby\EnderButtItem;
use Olympia\items\lobby\GameItem;
use Olympia\items\lobby\JumpItem;
use Olympia\items\lobby\LastCheckPoint;
use Olympia\items\lobby\NavigationItem;
use Olympia\items\lobby\StopJump;
use Olympia\items\minerals\MithrilIngot;
use Olympia\items\minerals\OrichalqueIngot;
use Olympia\items\minerals\OrichalqueNugget;
use Olympia\items\partners\AntiBuildStick;
use Olympia\items\partners\AntiPearlStick;
use Olympia\items\partners\EggTrap;
use Olympia\items\partners\FactionTower;
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
 * @method static EnderPearlKitMap ENDER_PEARL_KITMAP()
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
 * @method static FactionTower FACTION_TOWER()
 *
 * KitFFA :
 * @method static EnderPearlFFA ENDER_PEARL_FFA()
 *
 * Lobby :
 * @method static EnderButtItem ENDER_BUTT_ITEM()
 * @method static GameItem GAME_ITEM()
 * @method static JumpItem JUMP_ITEM()
 * @method static NavigationItem NAVIGATION_ITEM()
 * @method static LastCheckPoint LAST_CHECKPOINT()
 * @method static StopJump STOP_JUMP()
 *
 * Hikabrain :
 * @method static SwordAndBlock SWORD_AND_BLOCK()
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

        $items = [
            "farm_leggings",
            "farm_boots",

            "mithril_helmet",
            "mithril_chestplate",
            "mithril_leggings",
            "mithril_boots",
            "mithril_sword",
            "mithril_sickle",
            "mithril_ingot",

            "orichalque_helmet",
            "orichalque_chestplate",
            "orichalque_leggings",
            "orichalque_boots",
            "orichalque_sword",
            "orichalque_sickle",
            "orichalque_ingot",
            "orichalque_nugget",

            "cronos_helmet",
            "cronos_chestplate",
            "cronos_leggings",
            "cronos_boots",

            "theia_helmet",
            "theia_chestplate",
            "theia_leggings",
            "theia_boots",

            "vulcain_pickaxe",
            "infinity_sword",

            "generator_cobblestone",
            "generator_craftingtable",
            "generator_fencegate",

            "olympia_ender_pearl", // ender_pearl_kitmap
            "eggtrap",
            "switchball",
            "force",
            "resistance",
            "levitation",
            "portal_tp",
            "rocket",
            "infernal_stick",
            "anti_pearl_stick",
            "anti_build_stick",
            "nemo",
            "instant_tp",
            "flying_soup",
            "faction_tower",

            "ender_pearl_ffa",

            "ender_butt_item",
            "game_item",
            "jump_item",
            "navigation_item",
            "last_checkpoint",
            "stop_jump",

            "sword_and_block",
        ];

        foreach ($items as $item) {
            self::register($item, $factory->get("minecraft:$item"));
        }
    }
}