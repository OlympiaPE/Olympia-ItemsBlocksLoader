<?php

namespace Olympia\items\partners;

use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use Olympia\Kitmap\managers\Managers;
use Olympia\Kitmap\session\Session;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class InstantTp extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Nemo")
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("instant_tp", $creativeInfo);

        $this->setCustomName("§r§fTp instantané");
        $this->addComponent(new DisplayNameComponent($this->getCustomName()));

        $this->addComponent(new IconComponent("instant_tp"));

        $this->setLore([
            "",
            "§7Clique droit pour se téléporter",
            "§7instantanément au spawn",
            "§cFonctionne uniquement ",
            "§csi vous n'êtes pas en combat !",
        ]);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        /** @var Session $player */
        if (!Managers::COMBAT()->inFight($player)) {
            $player->teleport(Managers::TELEPORTATION()->getSpawnPosition());
            $player->sendMessage("§6» §fVous avez été téléporté instantanément au spawn.");
            $this->pop();
            return ItemUseResult::SUCCESS;
        }else{
            $player->sendMessage("§6» §fVous ne pouvez pas utiliser cet item en combat.");
            return ItemUseResult::FAIL;
        }
    }
}