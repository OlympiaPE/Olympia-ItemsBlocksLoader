<?php

namespace Olympia\items\armors\theia;

use Olympia\Kitmap\items\armors\BaseArmor;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\managers\Managers;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class TheiaBoots extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_FEET);
        parent::__construct($identifier, "Theia Boots", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_BOOTS);
        $this->initComponent("theia_boots", $creativeInfo);

        $this->setCustomName("§r§fBottes de Theia");
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.theia_boots.durability");
    }

    public function getDefensePoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.theia_boots.defense");
    }
}