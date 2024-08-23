<?php

namespace Olympia\blocks\types;

use Olympia\blocks\OlympiaBlockTypeIds;
use pocketmine\block\Block;
use Olympia\items\OlympiaItems;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\utils\FortuneDropHelper;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;

final class OrichalqueOre extends Block
{
    public function __construct()
    {
        $info = new BlockTypeInfo(BlockBreakInfo::pickaxe(4.5, ToolTier::IRON));
        parent::__construct(new BlockIdentifier(OlympiaBlockTypeIds::ORICHALQUE_ORE), "Orichalque Ore", $info);
    }

    public function getDropsForCompatibleTool(Item $item): array
    {
        return [
            OlympiaItems::ORICHALQUE_NUGGET()->setCount(FortuneDropHelper::weighted($item, 1, 1))
        ];
    }

    public function isAffectedBySilkTouch(): bool
    {
        return true;
    }

    protected function getXpDropAmount(): int
    {
        return mt_rand(6, 9);
    }
}