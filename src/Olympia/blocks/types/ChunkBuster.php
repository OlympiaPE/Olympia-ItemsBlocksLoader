<?php

namespace Olympia\blocks\types;

use Olympia\blocks\OlympiaBlockTypeIds;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeInfo;
use pocketmine\item\ToolTier;

final class ChunkBuster extends Block
{
    public function __construct()
    {
        $info = new BlockTypeInfo(BlockBreakInfo::pickaxe(2.5, ToolTier::WOOD));
        parent::__construct(new BlockIdentifier(OlympiaBlockTypeIds::CHUNK_BUSTER), "Chunk Buster", $info);
    }
}