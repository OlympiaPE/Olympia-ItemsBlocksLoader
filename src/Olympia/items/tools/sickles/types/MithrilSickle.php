<?php

namespace Olympia\items\tools\sickles\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\items\tools\sickles\BaseSickle;
use Olympia\Kitmap\managers\Managers;
use pocketmine\item\ItemIdentifier;

final class MithrilSickle extends BaseSickle
{
    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::NONE);
        $this->initComponent("mithril_sickle", $creativeInfo);

        $this->setCustomName("§r§fFaucille en mithril");
        $this->addComponent(new IconComponent("mithril_sickle"));

        $this->setLore([
            "",
            "§7Permet de labourer la terre,",
            "§7planter des graines et",
            "§7récolter des cultures",
            "§7en §63x3",
        ]);
    }

    public function getRadius(): int
    {
        return 3;
    }

    /**
     * @return int
     */
    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.mithril_sickle.durability");
    }

    public function getAttackPoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.mithril_sickle.damage");
    }
}