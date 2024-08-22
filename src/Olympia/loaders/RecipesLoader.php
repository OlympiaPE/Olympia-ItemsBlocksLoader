<?php

namespace Olympia\loaders;

use Olympia\blocks\OlympiaBlocks;
use Olympia\items\OlympiaItems;
use pocketmine\crafting\ExactRecipeIngredient;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\Server;

final class RecipesLoader
{
    public static function loadAllRecipes(): void
    {
        $crafts = [];

        $mithrilIngot = new ExactRecipeIngredient(OlympiaItems::MITHRIL_INGOT());
        $orichalqueNugget = new ExactRecipeIngredient(OlympiaItems::ORICHALQUE_NUGGET());
        $orichalqueIngot = new ExactRecipeIngredient(OlympiaItems::ORICHALQUE_INGOT());
        $orichalqueBlock = new ExactRecipeIngredient(OlympiaBlocks::ORICHALQUE_BLOCK()->asItem());
        $stick = new ExactRecipeIngredient(VanillaItems::STICK());

        // MITHRIL
        $crafts[] = new ShapedRecipe(["MMM", "M M", "   "], ["M" => $mithrilIngot], [OlympiaItems::MITHRIL_HELMET()]);
        $crafts[] = new ShapedRecipe(["   ", "MMM", "M M"], ["M" => $mithrilIngot], [OlympiaItems::MITHRIL_HELMET()]);

        $crafts[] = new ShapedRecipe(["M M", "MMM", "MMM"], ["M" => $mithrilIngot], [OlympiaItems::MITHRIL_CHESTPLATE()]);

        $crafts[] = new ShapedRecipe(["MMM", "M M", "M M"], ["M" => $mithrilIngot], [OlympiaItems::MITHRIL_LEGGINGS()]);

        $crafts[] = new ShapedRecipe(["M M", "M M", "   "], ["M" => $mithrilIngot], [OlympiaItems::MITHRIL_BOOTS()]);
        $crafts[] = new ShapedRecipe(["   ", "M M", "M M"], ["M" => $mithrilIngot], [OlympiaItems::MITHRIL_BOOTS()]);

        $crafts[] = new ShapedRecipe(["M  ", "M  ", "S  "], ["M" => $mithrilIngot, "S" => $stick], [OlympiaItems::MITHRIL_SWORD()]);
        $crafts[] = new ShapedRecipe([" M ", " M ", " S "], ["M" => $mithrilIngot, "S" => $stick], [OlympiaItems::MITHRIL_SWORD()]);
        $crafts[] = new ShapedRecipe(["  M", "  M", "  S"], ["M" => $mithrilIngot, "S" => $stick], [OlympiaItems::MITHRIL_SWORD()]);

        $crafts[] = new ShapedRecipe(["  M", " MM", "S  "], ["M" => $mithrilIngot, "S" => $stick], [OlympiaItems::MITHRIL_SICKLE()]);

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

        self::registerSingleItemCraft($orichalqueIngot, OlympiaItems::ORICHALQUE_NUGGET()->setCount(9), $crafts);
        self::registerSingleItemCraft($orichalqueBlock, OlympiaItems::ORICHALQUE_INGOT()->setCount(9), $crafts);

        $crafts[] = new ShapedRecipe(["NNN", "NNN", "NNN"], ["N" => $orichalqueNugget], [OlympiaItems::ORICHALQUE_INGOT()]);
        $crafts[] = new ShapedRecipe(["OOO", "OOO", "OOO"], ["O" => $orichalqueIngot], [OlympiaBlocks::ORICHALQUE_BLOCK()->asItem()]);

        $manager = Server::getInstance()->getCraftingManager();
        foreach ($crafts as $craft) {
            $manager->registerShapedRecipe($craft);
        }
    }

    private static function registerSingleItemCraft(ExactRecipeIngredient $ingredient, Item $result, array &$crafts): void
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