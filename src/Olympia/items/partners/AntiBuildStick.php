<?php

namespace Olympia\items\partners;

use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class AntiBuildStick extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Anti Build Stick")
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("anti_build_stick", $creativeInfo);

        $this->setCustomName("§r§6Bâton anti build");
        $this->addComponent(new DisplayNameComponent($this->getCustomName()));

        $this->addComponent(new IconComponent("anti_build_stick"));
        
        $this->setLore([
            "",
            "§7Taper un ennemi avec",
            "§7l'item en main pour l'",
            "§7empêcher de poser,",
            "§7casser et intéragir",
            "§7avec des blocs",
        ]);
    }
}