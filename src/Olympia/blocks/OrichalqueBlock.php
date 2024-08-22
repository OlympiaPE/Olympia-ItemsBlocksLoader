<?php

namespace Olympia\Kitmap\blocks\types;

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
        parent::__construct(new BlockIdentifier(BlockTypeIds::newId()), "Orichalque Block", $info);
    }
}