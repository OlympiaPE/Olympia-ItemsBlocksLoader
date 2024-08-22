<?php

namespace Olympia\items\armors\mithril;

use Olympia\Kitmap\items\armors\BaseArmor;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\managers\Managers;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class MithrilHelmet extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_HEAD);
        parent::__construct($identifier, "Mithril Helmet", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_HELMET);
        $this->initComponent("mithril_helmet", $creativeInfo);

        $this->setCustomName("§r§fCasque en mithril");
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.mithril_helmet.durability");
    }

    public function getDefensePoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.mithril_helmet.defense");
    }
}