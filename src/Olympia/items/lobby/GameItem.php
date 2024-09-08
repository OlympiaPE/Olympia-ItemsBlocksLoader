<?php

namespace Olympia\items\lobby;

use Olympia\items\OlympiaItemTypeIds;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class GameItem extends Item
{
    public function __construct()
    {
        parent::__construct(new ItemIdentifier(OlympiaItemTypeIds::GAME_ITEM), "Game");
        $this->setCustomName("§r§6Partie");
    }
}