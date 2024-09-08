<?php

namespace Olympia\items\lobby;

use Olympia\items\OlympiaItemTypeIds;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class NavigationItem extends Item
{
    public function __construct()
    {
        parent::__construct(new ItemIdentifier(OlympiaItemTypeIds::NAVIGATION_ITEM), "Navigation");
        $this->setCustomName("§r§6Navigation");
    }
}