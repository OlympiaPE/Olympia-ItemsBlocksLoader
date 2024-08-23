<?php

namespace Olympia\blocks\types;

use Olympia\blocks\OlympiaBlockTypeIds;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\item\ToolTier;

final class OrichalqueBlock extends Block
{
    public function __construct()
    {
        $info = new BlockTypeInfo(BlockBreakInfo::pickaxe(6.0, ToolTier::STONE, 30.0));
        parent::__construct(new BlockIdentifier(OlympiaBlockTypeIds::ORICHALQUE_BLOCK), "Orichalque Block", $info);
    }
}