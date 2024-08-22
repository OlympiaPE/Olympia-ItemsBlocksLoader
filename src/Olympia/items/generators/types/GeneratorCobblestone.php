<?php

namespace Olympia\items\generators\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\items\generators\BaseGenerator;
use pocketmine\item\ItemIdentifier;

final class GeneratorCobblestone extends BaseGenerator
{
    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS, CreativeInventoryInfo::NONE);
        $this->initComponent("generator_cobblestone", $creativeInfo);

        $this->setCustomName("§r§fGénérateur de pierres");
        $this->addComponent(new IconComponent("generator_cobblestone"));
    }
}