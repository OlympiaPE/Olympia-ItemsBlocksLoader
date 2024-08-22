<?php

namespace Olympia\items\armors\orichalque;

use Olympia\Kitmap\items\armors\BaseArmor;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\managers\Managers;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class OrichalqueBoots extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_FEET);
        parent::__construct($identifier, "Orichalque Boots", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_BOOTS);
        $this->initComponent("orichalque_boots", $creativeInfo);

        $this->setCustomName("§r§fBottes en orichalque");
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.orichalque_boots.durability");
    }

    public function getDefensePoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.orichalque_boots.defense");
    }
}