<?php

namespace Olympia\items\partners;

use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use Olympia\Kitmap\Loader;
use Olympia\Kitmap\session\Session;
use Olympia\Kitmap\session\SessionCooldowns;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;

class PortalTp extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Portal Tp")
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("portal_tp", $creativeInfo);

        $this->setCustomName("§r§6Portail TP");
        $this->addComponent(new DisplayNameComponent($this->getCustomName()));

        $this->addComponent(new IconComponent("portal_tp"));
        
        $this->setLore([
            "",
            "§7Clique droit pour se téléporter",
            "§7sur le dernier joueur qui vous a",
            "§7tapé durant ces 10 dernières",
            "§7secondes"
        ]);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        /** @var Session $player */
        if(!$player->canUseItem()) {
            return ItemUseResult::FAIL();
        }

        if(!$player->getCooldowns()->hasCooldown(SessionCooldowns::COOLDOWN_PORTALTP)) {

            $errMessage = "§6» §fAucun joueur ne vous a tapé dans ces 10 dernières secondes.";
            $cause = $player->getLastDamageCause();
            if($cause instanceof EntityDamageByEntityEvent) {
                $damager = $cause->getDamager();
                if($damager instanceof Session) {
                    if(time() - $player->getLastAttackedTime() <= 10) {

                        $player->sendMessage("§6» §fVous venez d'utiliser l'item §6Portail TP §f!");
                        $player->sendMessage("§6» §fVous allez être téléporté sur §6{$damager->getName()} §fdans §63 secondes§f.");
                        $damager->sendMessage("§6» §6{$player->getName()} §fva être téléporté sur vous dans §63 secondes§f.");

                        $player->getCooldowns()->setCooldown(SessionCooldowns::COOLDOWN_PORTALTP, 120);
                        $this->pop();

                        $scheduler = Loader::getInstance()->getScheduler();
                        $scheduler->scheduleDelayedTask(new ClosureTask(function () use ($player, $damager): void {
                            $player->teleport($damager->getPosition());
                        }), 60);
                        return ItemUseResult::SUCCESS();
                    }else{
                        $player->sendMessage($errMessage);
                    }
                }else{
                    $player->sendMessage($errMessage);
                }
            }else{
                $player->sendMessage($errMessage);
            }
        }else{

            $cooldown = $player->getCooldowns()->getCooldown(SessionCooldowns::COOLDOWN_PORTALTP);
            $player->sendMessage("§6» §fVous devez attendre $cooldown secondes avant de pouvoir réutiliser cet item.");
        }
        return ItemUseResult::FAIL();
    }
}