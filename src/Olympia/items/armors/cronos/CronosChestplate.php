<?php

namespace Olympia\items\armors\cronos;

use Olympia\Kitmap\items\armors\BaseArmor;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\managers\Managers;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class CronosChestplate extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_CHEST);
        parent::__construct($identifier, "Cronos Chestplate", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_CHESTPLATE);
        $this->initComponent("cronos_chestplate", $creativeInfo);

        $this->setCustomName("§r§fPlastron de Cronos");
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.cronos_chestplate.durability");
    }

    public function getDefensePoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.cronos_chestplate.defense");
    }
}