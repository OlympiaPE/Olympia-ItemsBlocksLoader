<?php

namespace Olympia\items\armors\cronos;

use Olympia\Kitmap\items\armors\BaseArmor;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\managers\Managers;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class CronosHelmet extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_HEAD);
        parent::__construct($identifier, "Cronos Helmet", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_HELMET);
        $this->initComponent("cronos_helmet", $creativeInfo);

        $this->setCustomName("§r§fCasque de Cronos");
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.cronos_helmet.durability");
    }

    public function getDefensePoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.cronos_helmet.defense");
    }
}