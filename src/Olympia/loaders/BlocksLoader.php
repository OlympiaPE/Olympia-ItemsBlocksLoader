<?php

namespace Olympia\loaders;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\block\Material;
use customiesdevs\customies\block\Model;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\blocks\types\AntiPearlBlock;
use Olympia\blocks\types\ChunkBuster;
use Olympia\blocks\types\fencegate\FenceGateClose;
use Olympia\blocks\types\fencegate\FenceGateOpen;
use Olympia\blocks\types\MithrilOre;
use Olympia\blocks\types\OrichalqueBlock;
use Olympia\blocks\types\OrichalqueOre;
use pocketmine\math\Vector3;

final class BlocksLoader
{
    public static function loadAllBlocks(): void
    {
        self::registerBlock(MithrilOre::class, "mithril_ore", "mithril_ore", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_ORE);
        self::registerBlock(OrichalqueOre::class, "orichalque_ore", "orichalque_ore", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_ORE);
        self::registerBlock(OrichalqueBlock::class, "orichalque_block", "orichalque_block", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_CONSTRUCTION);

        self::registerBlock(AntiPearlBlock::class, "antipearl_block", "antipearl_block", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_ITEMS);
        self::registerBlock(ChunkBuster::class, "chunk_buster", "chunk_buster", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_ITEMS);

        self::registerBlock(FenceGateClose::class, "fence_gate_close", "olympia_fence_gate", Model::SOLID, "geometry.fence_gate_close", CreativeInventoryInfo::CATEGORY_CONSTRUCTION, CreativeInventoryInfo::GROUP_FENCE_GATE, new Vector3(-8, 0, -4), new Vector3(16, 16, 8));
        self::registerBlock(FenceGateOpen::class, "fence_gate_open", "olympia_fence_gate", Model::NOT_SOLID, "geometry.fence_gate_open", CreativeInventoryInfo::CATEGORY_CONSTRUCTION, CreativeInventoryInfo::GROUP_FENCE_GATE, new Vector3(-8, 0, -4), new Vector3(16, 16, 8));
    }

    private static function registerBlock(
        string $class,
        string $identifierName,
        string $texture,
        int $solid = Model::SOLID,
        string $geometry = "geometry.block",
        string $category = CreativeInventoryInfo::CATEGORY_ALL,
        string $group = CreativeInventoryInfo::NONE,
        Vector3 $modelOrigin = new Vector3(-8, 0, -8),
        Vector3 $modelSize = new Vector3(16, 16, 16)
    ): void {
        $identifier = "minecraft:$identifierName";
        if (!CustomiesBlockFactory::getInstance()->exists($identifier)) {
            $material = new Material(Material::TARGET_ALL, $texture, Material::RENDER_METHOD_ALPHA_TEST);
            $creative = new CreativeInventoryInfo($category, $group);
            $model = new Model([$material], $geometry, $modelOrigin, $modelSize, $solid);
            CustomiesBlockFactory::getInstance()->registerBlock(static fn () => new $class(), $identifier, $model, $creative);
        }
    }
}