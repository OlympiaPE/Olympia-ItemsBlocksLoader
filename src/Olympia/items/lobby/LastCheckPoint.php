<?php

namespace Olympia\items\lobby;

use Olympia\items\OlympiaItemTypeIds;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class LastCheckPoint extends Item
{
    public function __construct()
    {
        parent::__construct(new ItemIdentifier(OlympiaItemTypeIds::LAST_CHECKPOINT), "Last Checkpoint");
        $this->setCustomName("§r§6Last Checkpoint");
    }
}