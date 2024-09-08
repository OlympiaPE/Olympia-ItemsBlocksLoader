<?php

namespace Olympia\blocks;

use customiesdevs\customies\block\CustomiesBlockFactory;
use Olympia\blocks\types\AntiPearlBlock;
use Olympia\blocks\types\ChunkBuster;
use Olympia\blocks\types\MithrilOre;
use Olympia\blocks\types\OrichalqueBlock;
use Olympia\blocks\types\OrichalqueOre;
use Olympia\blocks\types\fencegate\FenceGateClose;
use Olympia\blocks\types\fencegate\FenceGateOpen;
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
 *
 * Fence Gate :
 * @method static FenceGateClose FENCE_GATE_CLOSE()
 * @method static FenceGateOpen FENCE_GATE_OPEN()
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
     * @phpstan-return array<string, Block>
     */
    public static function getAll(): array
    {
        /** @var Block[] $result */
        $result = self::_registryGetAll();
        return $result;
    }

    protected static function setup(): void
    {
        $factory = CustomiesBlockFactory::getInstance();

        $blocks = [
            "mithril_ore",
            "orichalque_ore",
            "orichalque_block",
            "antipearl_block",
            "chunk_buster",
            "fence_gate_close",
            "fence_gate_open",
        ];

        foreach ($blocks as $block) {
            self::register($block, $factory->get("minecraft:$block"));
        }
    }
}