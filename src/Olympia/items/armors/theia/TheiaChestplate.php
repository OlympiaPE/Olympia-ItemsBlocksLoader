<?php

namespace Olympia\items\armors\theia;

use Olympia\items\armors\BaseArmor;
use Olympia\Loader;
use customiesdevs\customies\item\CreativeInventoryInfo;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class TheiaChestplate extends BaseArmor
{
    public function __construct(ItemIdentifier $identifier)
    {
        $info = new ArmorTypeInfo($this->getDefensePoints(), $this->getMaxDurability(), ArmorInventory::SLOT_CHEST);
        parent::__construct($identifier, "Theia Chestplate", $info);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_CHESTPLATE);
        $this->initComponent("theia_chestplate", $creativeInfo);

        $this->setCustomName("§r§fPlastron de Theia");
    }

    public function getMaxDurability(): int
    {
        return Loader::getInstance()->getConfigManager()->getNested("theia_chestplate.durability");
    }

    public function getDefensePoints(): int
    {
        return Loader::getInstance()->getConfigManager()->getNested("theia_chestplate.defense");
    }
}