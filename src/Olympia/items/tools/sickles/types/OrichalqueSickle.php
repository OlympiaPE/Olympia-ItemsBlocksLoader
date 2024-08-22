<?php

namespace Olympia\items\tools\sickles\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\items\tools\sickles\BaseSickle;
use Olympia\Loader;
use pocketmine\item\ItemIdentifier;

final class OrichalqueSickle extends BaseSickle
{
    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::NONE);
        $this->initComponent("orichalque_sickle", $creativeInfo);

        $this->setCustomName("§r§fFaucille en orichalque");
        $this->addComponent(new IconComponent("orichalque_sickle"));

        $this->setLore([
            "",
            "§7Permet de labourer la terre,",
            "§7planter des graines et",
            "§7récolter des cultures",
            "§7en §65x5",
        ]);
    }

    public function getRadius(): int
    {
        return 5;
    }

    /**
     * @return int
     */
    public function getMaxDurability(): int
    {
        return Loader::getInstance()->getConfigManager()->getNested("orichalque_sickle.durability");
    }

    public function getAttackPoints(): int
    {
        return Loader::getInstance()->getConfigManager()->getNested("orichalque_sickle.damage");
    }
}