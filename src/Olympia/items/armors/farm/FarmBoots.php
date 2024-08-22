<?php

namespace Olympia\items\armors\farm;

use Olympia\Kitmap\items\armors\BaseArmor;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\managers\Managers;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class FarmBoots extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_FEET);
        parent::__construct($identifier, "Farm Boots", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_BOOTS);
        $this->initComponent("farm_boots", $creativeInfo);

        $this->setCustomName("§r§fBottes de farm");
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.farm_boots.durability");
    }

    public function getDefensePoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.farm_boots.defense");
    }
}