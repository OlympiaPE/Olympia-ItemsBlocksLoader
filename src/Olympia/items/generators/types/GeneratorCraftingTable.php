<?php

namespace Olympia\items\generators\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\items\generators\BaseGenerator;
use pocketmine\item\ItemIdentifier;

final class GeneratorCraftingTable extends BaseGenerator
{
    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS, CreativeInventoryInfo::NONE);
        $this->initComponent("generator_craftingtable", $creativeInfo);

        $this->setCustomName("§r§fGénérateur de table de craft");
        $this->addComponent(new IconComponent("generator_craftingtable"));
    }
}