<?php

namespace Olympia\items\minerals;

use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

final class MithrilIngot extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("mithril_ingot", $creativeInfo);
        $this->addComponent(new MaxStackSizeComponent(64));
        $this->setCustomName("§r§fLingot de mithril");
        $this->addComponent(new DisplayNameComponent($this->getCustomName()));
    }

}