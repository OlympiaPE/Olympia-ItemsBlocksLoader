<?php

namespace Olympia\items\lobby;

use Olympia\items\OlympiaItemTypeIds;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class StopJump extends Item
{
    public function __construct()
    {
        parent::__construct(new ItemIdentifier(OlympiaItemTypeIds::STOP_JUMP), "Stop");
        $this->setCustomName("§r§6Stop");
    }
}