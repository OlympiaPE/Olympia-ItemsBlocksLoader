<?php

namespace Olympia\items\tools\swords;

use Olympia\Kitmap\session\Session;
use Olympia\Kitmap\session\SessionCooldowns;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

abstract class DashSword extends BaseSword
{
    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        if (!$player instanceof Session) {
            return ItemUseResult::FAIL;
        }

        if(!$player->canUseItem()) {
            return ItemUseResult::FAIL;
        }

        if(!$player->getCooldowns()->hasCooldown(SessionCooldowns::COOLDOWN_DASH)) {

            $player->getCooldowns()->setCooldown(SessionCooldowns::COOLDOWN_DASH, 30);

            $motion = clone $player->getMotion();
            $motion->x += $player->getDirectionVector()->getX() * 1.7;
            $motion->y += 0.8;
            $motion->z += $player->getDirectionVector()->getZ() * 1.7;

            $player->setMotion($motion);
            $player->sendMessage("§6» §fVous venez d'utiliser votre aptitude !");
            return ItemUseResult::SUCCESS;
        }else{

            $cooldown = $player->getCooldowns()->getCooldown(SessionCooldowns::COOLDOWN_DASH);
            $player->sendMessage("§6» §fVous devez attendre $cooldown secondes avant de pouvoir utiliser cette aptitude.");
            return ItemUseResult::FAIL;
        }
    }
}