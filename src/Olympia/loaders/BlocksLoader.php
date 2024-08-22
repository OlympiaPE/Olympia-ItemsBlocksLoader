<?php

namespace Olympia\loaders;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\block\Material;
use customiesdevs\customies\block\Model;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\blocks\types\AntiPearlBlock;
use Olympia\blocks\types\ChunkBuster;
use Olympia\blocks\types\MithrilOre;
use Olympia\blocks\types\OrichalqueBlock;
use Olympia\blocks\types\OrichalqueOre;
use pocketmine\math\Vector3;

final class BlocksLoader
{
    public static function loadAllBlocks(): void
    {
        self::register(MithrilOre::class, "mithril_ore", "mithril_ore", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_ORE);
        self::register(OrichalqueOre::class, "orichalque_ore", "orichalque_ore", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_ORE);
        self::register(OrichalqueBlock::class, "orichalque_block", "orichalque_block", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_CONSTRUCTION);

        self::register(AntiPearlBlock::class, "antipearl_block", "antipearl_block", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_ITEMS);
        self::register(ChunkBuster::class, "chunk_buster", "chunk_buster", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_ITEMS);
    }

    private static function register(
        string $class,
        string $identifier,
        string $texture,
        int $solid = Model::SOLID,
        string $geometry = "geometry.block",
        string $category = CreativeInventoryInfo::CATEGORY_ALL,
        string $group = CreativeInventoryInfo::NONE
    ): void {
        $material = new Material(Material::TARGET_ALL, $texture, Material::RENDER_METHOD_ALPHA_TEST);
        $creative = new CreativeInventoryInfo($category, $group);
        $model = new Model([$material], $geometry, new Vector3(-8, 0, -8), new Vector3(16, 16, 16), $solid);
        CustomiesBlockFactory::getInstance()->registerBlock(static fn () => new $class(), "minecraft:" . $identifier, $model, $creative);
    }
}