<?php

namespace Olympia\items\armors\theia;

use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\items\armors\BaseArmor;
use Olympia\Loader;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class TheiaLeggings extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_LEGS);
        parent::__construct($identifier, "Theia Leggings", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_LEGGINGS);
        $this->initComponent("theia_leggings", $creativeInfo);

        $this->setCustomName("§r§fJambières de Theia");
    }

    public function getMaxDurability(): int
    {
        return Loader::getInstance()->getConfigManager()->getNested("theia_leggings.durability");
    }

    public function getDefensePoints(): int
    {
        return Loader::getInstance()->getConfigManager()->getNested("theia_leggings.defense");
    }
}