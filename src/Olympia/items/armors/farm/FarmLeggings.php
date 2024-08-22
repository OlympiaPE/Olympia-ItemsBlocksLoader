<?php

namespace Olympia\items\armors\farm;

use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\items\armors\BaseArmor;
use Olympia\Kitmap\managers\Managers;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class FarmLeggings extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_LEGS);
        parent::__construct($identifier, "Farm Leggings", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_LEGGINGS);
        $this->initComponent("farm_leggings", $creativeInfo);

        $this->setCustomName("§r§fJambières de farm");
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.farm_leggings.durability");
    }

    public function getDefensePoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.farm_leggings.defense");
    }
}