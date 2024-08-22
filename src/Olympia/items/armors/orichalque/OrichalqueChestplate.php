<?php

namespace Olympia\items\armors\orichalque;

use Olympia\Kitmap\items\armors\BaseArmor;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\managers\Managers;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class OrichalqueChestplate extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_CHEST);
        parent::__construct($identifier, "Orichalque Chestplate", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_CHESTPLATE);
        $this->initComponent("orichalque_chestplate", $creativeInfo);

        $this->setCustomName("§r§fPlastron en orichalque");
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.orichalque_chestplate.durability");
    }

    public function getDefensePoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.orichalque_chestplate.defense");
    }
}