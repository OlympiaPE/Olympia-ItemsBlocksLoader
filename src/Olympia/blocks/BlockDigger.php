<?php

namespace Olympia\blocks;

use pocketmine\block\BlockToolType;
use pocketmine\block\VanillaBlocks;

class BlockDigger
{
    /** @var string[][] $blockToolsTypes */
    private static array $blockToolsTypes;

    private static function registerAllBlocksToolsTypes(): void
    {
        $vanillaBlocks = VanillaBlocks::getAll();
        $olympiaBlocks = OlympiaBlocks::getAll();
        $blocks = array_merge($vanillaBlocks, $olympiaBlocks);

        foreach ($blocks as $block) {
            $type = $block->getBreakInfo()->getToolType();
            if ($type !== BlockToolType::NONE) {
                self::$blockToolsTypes[$type][] = $block;
            }
        }
    }

    public static function getBlocksToolTypeById(int $toolType): array
    {
        if (!isset(self::$blockToolsTypes)) {
            self::registerAllBlocksToolsTypes();
        }

        $blocks = [];
        foreach (self::$blockToolsTypes as $type => $typeBlocks) {
            if (($type & $toolType) !== 0) {
                $blocks = array_merge($blocks, $typeBlocks);
            }
        }
        return $blocks;
    }
}