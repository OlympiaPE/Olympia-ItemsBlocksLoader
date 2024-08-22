<?php

namespace Olympia;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\item\CustomiesItemFactory;
use pocketmine\crafting\ExactRecipeIngredient;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\VanillaItems;

final class RecipesLoader
{
    private static function registerCraftRecipes(): void
    {
        $itemsFactory = CustomiesItemFactory::getInstance();
        $blocksFactory = CustomiesBlockFactory::getInstance();
        $crafts = [];

        $mithrilIngot = new ExactRecipeIngredient($itemsFactory->get("minecraft:mithril_ingot"));
        $orichalqueNugget = new ExactRecipeIngredient($itemsFactory->get("minecraft:orichalque_nugget"));
        $orichalqueIngot = new ExactRecipeIngredient($itemsFactory->get("minecraft:orichalque_ingot"));
        $orichalqueBlock = new ExactRecipeIngredient($blocksFactory->get("minecraft:orichalque_block")->asItem());
        $stick = new ExactRecipeIngredient(VanillaItems::STICK());

        // MITHRIL
        $crafts[] = new ShapedRecipe(["MMM", "M M", "   "], ["M" => $mithrilIngot], [$itemsFactory->get("minecraft:mithril_helmet")]);
        $crafts[] = new ShapedRecipe(["   ", "MMM", "M M"], ["M" => $mithrilIngot], [$itemsFactory->get("minecraft:mithril_helmet")]);

        $crafts[] = new ShapedRecipe(["M M", "MMM", "MMM"], ["M" => $mithrilIngot], [$itemsFactory->get("minecraft:mithril_chestplate")]);

        $crafts[] = new ShapedRecipe(["MMM", "M M", "M M"], ["M" => $mithrilIngot], [$itemsFactory->get("minecraft:mithril_leggings")]);

        $crafts[] = new ShapedRecipe(["M M", "M M", "   "], ["M" => $mithrilIngot], [$itemsFactory->get("minecraft:mithril_boots")]);
        $crafts[] = new ShapedRecipe(["   ", "M M", "M M"], ["M" => $mithrilIngot], [$itemsFactory->get("minecraft:mithril_boots")]);

        $crafts[] = new ShapedRecipe(["M  ", "M  ", "S  "], ["M" => $mithrilIngot, "S" => $stick], [$itemsFactory->get("minecraft:mithril_sword")]);
        $crafts[] = new ShapedRecipe([" M ", " M ", " S "], ["M" => $mithrilIngot, "S" => $stick], [$itemsFactory->get("minecraft:mithril_sword")]);
        $crafts[] = new ShapedRecipe(["  M", "  M", "  S"], ["M" => $mithrilIngot, "S" => $stick], [$itemsFactory->get("minecraft:mithril_sword")]);

        $crafts[] = new ShapedRecipe(["  M", " MM", "S  "], ["M" => $mithrilIngot, "S" => $stick], [$itemsFactory->get("minecraft:mithril_sickle")]);

        // ORICHALQUE
        $crafts[] = new ShapedRecipe(["OOO", "O O", "   "], ["O" => $orichalqueIngot], [OlympiaItems::ORICHALQUE_HELMET()]);
        $crafts[] = new ShapedRecipe(["   ", "OOO", "O O"], ["O" => $orichalqueIngot], [OlympiaItems::ORICHALQUE_HELMET()]);

        $crafts[] = new ShapedRecipe(["O O", "OOO", "OOO"], ["O" => $orichalqueIngot], [OlympiaItems::ORICHALQUE_CHESTPLATE()]);

        $crafts[] = new ShapedRecipe(["OOO", "O O", "O O"], ["O" => $orichalqueIngot], [OlympiaItems::ORICHALQUE_LEGGINGS()]);

        $crafts[] = new ShapedRecipe(["O O", "O O", "   "], ["O" => $orichalqueIngot], [OlympiaItems::ORICHALQUE_BOOTS()]);
        $crafts[] = new ShapedRecipe(["   ", "O O", "O O"], ["O" => $orichalqueIngot], [OlympiaItems::ORICHALQUE_BOOTS()]);

        $crafts[] = new ShapedRecipe(["O  ", "O  ", "S  "], ["O" => $orichalqueIngot, "S" => $stick], [OlympiaItems::ORICHALQUE_SWORD()]);
        $crafts[] = new ShapedRecipe([" O ", " O ", " S "], ["O" => $orichalqueIngot, "S" => $stick], [OlympiaItems::ORICHALQUE_SWORD()]);
        $crafts[] = new ShapedRecipe(["  O", "  O", "  S"], ["O" => $orichalqueIngot, "S" => $stick], [OlympiaItems::ORICHALQUE_SWORD()]);

        $crafts[] = new ShapedRecipe(["  B", " BB", "S  "], ["B" => $orichalqueBlock, "S" => $stick], [OlympiaItems::ORICHALQUE_SICKLE()]);

        $this->registerSingleItemCraft($orichalqueIngot, OlympiaItems::ORICHALQUE_NUGGET()->setCount(9), $crafts);
        $this->registerSingleItemCraft($orichalqueBlock, OlympiaItems::ORICHALQUE_INGOT()->setCount(9), $crafts);

        $crafts[] = new ShapedRecipe(["NNN", "NNN", "NNN"], ["N" => $orichalqueNugget], [OlympiaItems::ORICHALQUE_INGOT()]);
        $crafts[] = new ShapedRecipe(["OOO", "OOO", "OOO"], ["O" => $orichalqueIngot], [OlympiaBlocks::ORICHALQUE_BLOCK()->asItem()]);

        $manager = Server::getInstance()->getCraftingManager();
        foreach ($crafts as $craft) {
            $manager->registerShapedRecipe($craft);
        }
    }

    private function registerSingleItemCraft(ExactRecipeIngredient $ingredient, Item $result, array &$crafts): void
    {
        $rows = ["I  ", " I ", "  I"];
        foreach ($rows as $row) {
            for ($column = 0; $column <= 2; $column++) {
                $shape = array_fill(0, 3, "   ");
                $shape[$column] = $row;
                $crafts[] = new ShapedRecipe($shape, ["I" => $ingredient], [$result]);
            }
        }
    }
}