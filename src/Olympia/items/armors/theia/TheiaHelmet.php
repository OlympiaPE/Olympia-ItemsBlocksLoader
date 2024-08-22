<?php

namespace Olympia\items\armors\theia;

use Olympia\items\armors\BaseArmor;
use Olympia\Loader;
use customiesdevs\customies\item\CreativeInventoryInfo;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class TheiaHelmet extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_HEAD);
        parent::__construct($identifier, "Theia Helmet", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_HELMET);
        $this->initComponent("theia_helmet", $creativeInfo);

        $this->setCustomName("§r§fCasque de Theia");
    }

    public function getMaxDurability(): int
    {
        return Loader::getInstance()->getConfigManager()->getNested("theia_helmet.durability");
    }

    public function getDefensePoints(): int
    {
        return Loader::getInstance()->getConfigManager()->getNested("theia_helmet.defense");
    }
}