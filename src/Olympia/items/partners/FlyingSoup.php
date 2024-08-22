<?php

namespace Olympia\items\partners;

use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use Olympia\Kitmap\session\Session;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class FlyingSoup extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Flying Soup")
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("flying_soup", $creativeInfo);

        $this->setCustomName("§r§2Soupe de vol 2h");
        $this->addComponent(new DisplayNameComponent($this->getCustomName()));

        $this->addComponent(new IconComponent("flying_soup"));

        $this->setLore([
            "",
            "§7Permet d'accéder à la commande",
            "§7/fly pendant 2 heures"
        ]);
    }

    public function getMaxStackSize(): int
    {
        return 64;
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        /** @var Session $player */
        $player->addFlyingTime(60*60*2);
        $player->sendPopup("§2+ 2 heures de vol");
        $this->pop();
        return ItemUseResult::SUCCESS;
    }
}