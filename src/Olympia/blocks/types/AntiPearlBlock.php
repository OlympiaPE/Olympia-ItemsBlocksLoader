<?php

namespace Olympia\blocks\types;

use Olympia\blocks\OlympiaBlockTypeIds;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeInfo;
use pocketmine\item\ToolTier;

final class AntiPearlBlock extends Block
{
    public function __construct()
    {
        $info = new BlockTypeInfo(BlockBreakInfo::pickaxe(2, ToolTier::WOOD));
        parent::__construct(new BlockIdentifier(OlympiaBlockTypeIds::ANTIPEARL_BLOCK), "AntiPearl Block", $info);
    }
}