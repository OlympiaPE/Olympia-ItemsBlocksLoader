<?php

namespace Olympia\items\lobby;

use Olympia\items\OlympiaItemTypeIds;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class EnderButtItem extends Item
{
    public function __construct()
    {
        parent::__construct(new ItemIdentifier(OlympiaItemTypeIds::ENDER_BUTT_ITEM), "Ender Butt");
        $this->setCustomName("§r§6Ender Butt");
    }
}