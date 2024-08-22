<?php

namespace Olympia\Kitmap\blocks\types;

use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\item\ToolTier;

final class AntiPearlBlock extends Block
{
    public function __construct()
    {
        $info = new BlockTypeInfo(BlockBreakInfo::pickaxe(2, ToolTier::WOOD));
        parent::__construct(new BlockIdentifier(BlockTypeIds::newId()), "AntiPearl Block", $info);
    }
}