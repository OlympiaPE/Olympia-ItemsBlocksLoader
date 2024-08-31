<?php

namespace Olympia\blocks\types\fencegate;

use Olympia\blocks\OlympiaBlocks;
use Olympia\blocks\OlympiaBlockTypeIds;
use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class FenceGateClose extends FenceGate
{
    public function __construct()
    {
        parent::__construct(OlympiaBlockTypeIds::FENCE_GATE_CLOSE);
    }

    public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []): bool
    {
        $fenceGate = OlympiaBlocks::FENCE_GATE_OPEN();
        $fenceGate->facing = $this->facing;
        $this->position->world->setBlock($this->position, $fenceGate);
        return parent::onInteract($item, $face, $clickVector, $player, $returnedItems);
    }

    protected function recalculateCollisionBoxes(): array
    {
        return [AxisAlignedBB::one()->extend(Facing::UP, 0.5)->squash(Facing::axis($this->facing), 6 / 16)];
    }
}