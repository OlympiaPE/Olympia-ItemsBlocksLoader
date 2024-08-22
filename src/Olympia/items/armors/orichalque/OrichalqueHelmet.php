<?php

namespace Olympia\items\armors\orichalque;

use Olympia\Kitmap\items\armors\BaseArmor;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\managers\Managers;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class OrichalqueHelmet extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_HEAD);
        parent::__construct($identifier, "Orichalque Helmet", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_HELMET);
        $this->initComponent("orichalque_helmet", $creativeInfo);

        $this->setCustomName("§r§fCasque en orichalque");
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.orichalque_helmet.durability");
    }

    public function getDefensePoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.orichalque_helmet.defense");
    }
}