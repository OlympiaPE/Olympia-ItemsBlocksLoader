<?php

namespace Olympia\blocks;

use customiesdevs\customies\block\CustomiesBlockFactory;
use Olympia\blocks\types\AntiPearlBlock;
use Olympia\blocks\types\ChunkBuster;
use Olympia\blocks\types\MithrilOre;
use Olympia\blocks\types\OrichalqueBlock;
use Olympia\blocks\types\OrichalqueOre;
use pocketmine\block\Block;
use pocketmine\utils\CloningRegistryTrait;

/**
 * Mithril :
 * @method static MithrilOre MITHRIL_ORE()
 *
 * Orichalque :
 * @method static OrichalqueOre ORICHALQUE_ORE()
 * @method static OrichalqueBlock ORICHALQUE_BLOCK()
 *
 * Special :
 * @method static AntiPearlBlock ANTIPEARL_BLOCK()
 * @method static ChunkBuster CHUNK_BUSTER()
 */

final class OlympiaBlocks
{
    use CloningRegistryTrait;

    protected static function register(string $name, Block $block): void
    {
        self::_registryRegister($name, $block);
    }

    /**
     * @return Block[]
     * @phpstan-return array<string, Item>
     */
    public static function getAll(): array
    {
        /** @var Block[] $result */
        $result = self::_registryGetAll();
        return $result;
    }

    protected static function setup(): void
    {
        self::register("mithril_ore", CustomiesBlockFactory::getInstance()->get("minecraft:mithril_ore"));

        self::register("orichalque_ore", CustomiesBlockFactory::getInstance()->get("minecraft:orichalque_ore"));
        self::register("orichalque_block", CustomiesBlockFactory::getInstance()->get("minecraft:orichalque_block"));

        self::register("antipearl_block", CustomiesBlockFactory::getInstance()->get("minecraft:antipearl_block"));
        self::register("chunk_buster", CustomiesBlockFactory::getInstance()->get("minecraft:chunk_buster"));
    }
}