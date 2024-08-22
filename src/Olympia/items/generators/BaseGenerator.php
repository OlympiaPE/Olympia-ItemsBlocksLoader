<?php

namespace Olympia\items\generators;

use cosmicpe\worldbuilder\editor\executor\ReplaceEditorTaskInfo;
use cosmicpe\worldbuilder\editor\task\listener\EditorTaskOnCompletionListener;
use cosmicpe\worldbuilder\editor\utils\replacement\BlockToBlockReplacementMap;
use cosmicpe\worldbuilder\Loader;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Durable;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\sound\BlockPlaceSound;

abstract class BaseGenerator extends Durable implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);
    }

    public function getMaxStackSize(): int
    {
        return 1;
    }

    public function getMaxDurability(): int
    {
        return 25;
    }

    abstract public function getBlockGenerated(Player $player): Block;

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        $position = $player->getPosition();
        $world = $position->getWorld();

        $x = $position->getFloorX();
        $y = $position->getFloorY();
        $z = $position->getFloorZ();
        $yMax = $world->getHighestBlockAt($x, $z) ?? $y + 1;

        $replace = new BlockToBlockReplacementMap();
        $replace->put(VanillaBlocks::AIR(), $this->getBlockGenerated($player));

        $task = new ReplaceEditorTaskInfo(
            $world,
            $x,
            $yMax >= $y ? 1 : $yMax,
            $z,
            $x,
            $y - 1,
            $z,
            $replace,
            true
        );

        /** @var Loader $worldBuilder */
        $worldBuilder = Server::getInstance()->getPluginManager()->getPlugin("WorldBuilder");
        $instance = $worldBuilder->getEditorManager()->buildInstance($task);

        $instance->registerListener(new EditorTaskOnCompletionListener(function() use ($player, $position): void {
            $player->broadcastSound(new BlockPlaceSound($this->getBlockGenerated($player)));
            $this->applyDamage(1);
        }));

        $worldBuilder->getEditorManager()->push($instance);

        return ItemUseResult::SUCCESS();
    }
}