<?php

namespace Olympia\items\partners;

use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class FactionTower extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Faction Tower")
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("faction_tower", $creativeInfo);
        $this->addComponent(new MaxStackSizeComponent($this->getMaxStackSize()));
        $this->setCustomName("§r§5Tour de faction");

        $this->setLore([
            "",
            "§7Permet d'obtenir vous et",
            "§7votre faction des effets",
            "§7positifs aléatoires",
        ]);
    }

    public function getMaxStackSize(): int
    {
        return 4;
    }

    public function getCooldownTicks(): int
    {
        return 20;
    }
}