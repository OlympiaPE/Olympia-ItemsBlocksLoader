<?php

namespace Olympia\items\armors\mithril;

use Olympia\Kitmap\items\armors\BaseArmor;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\managers\Managers;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class MithrilLeggings extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_LEGS);
        parent::__construct($identifier, "Mithril Leggings", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_LEGGINGS);
        $this->initComponent("mithril_leggings", $creativeInfo);

        $this->setCustomName("§r§fJambières en mithril");
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.mithril_leggings.durability");
    }

    public function getDefensePoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.mithril_leggings.defense");
    }
}