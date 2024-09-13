<?php

namespace Olympia\items\partners;

use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Durable;
use pocketmine\item\ItemIdentifier;

class GrapplingHook extends Durable implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Grappling Hook")
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("grappling_hook", $creativeInfo);

        $this->setCustomName("§r§6Grappin");
        $this->addComponent(new DisplayNameComponent($this->getCustomName()));
        $this->setupRenderOffsets(32, 32, true);
        
        $this->setLore([
            "",
            "§7Permet de vous déplacer plus",
            "§7rapidement",
        ]);
    }

    public function getMaxDurability(): int
    {
        return 384;
    }

    public function getMaxStackSize(): int
    {
        return 1;
    }
}