"use client";
import { RecipeBox } from "@/components/recipe-box";
import { useSearchRecipes } from "@/hooks/useSearchRecipes";
import { useEffect, useState } from "react";

type RecipeProps = {
  id: number;
  name: string;
  description: string;
  image: string;
};

export default function IngredientsSearchPage() {
  const { ingredientsSearch } = useSearchRecipes();

  const [ingredients, setIngredients] = useState<string[]>([]);
  const [inputIngredient, setInputIngredient] = useState<string>("");
  const [recipes, setRecipes] = useState<RecipeProps[]>([]);

  const handleSearchRecipes = async () => {
    const response = await ingredientsSearch(ingredients);
    setRecipes(response);
  };

  const effectFn = async () => {
    await handleSearchRecipes();
  };

  useEffect(() => {
    effectFn();
  }, [ingredients]);

  return (
    <div className="ingredients-search-section">
      <div className="wrapper">
        <input
          className="search-input"
          type="text"
          onChange={(e) =>
            setInputIngredient(e.target.value.toLocaleLowerCase())
          }
          value={inputIngredient}
          placeholder="Add ingredient here..."
        />
        <button
          className="add-btn"
          onClick={() => {
            if (inputIngredient.trim() !== "") {
              setIngredients([...ingredients, inputIngredient]);
              setInputIngredient("");
            }
          }}
        >
          Add
        </button>
      </div>

      <div className="ingredients-list mt-2">
        <span className="font-semibold">Searching for recipes with: </span>
        {ingredients.map((ingre, i) => (
          <span
            key={i}
            onClick={() => {
              const newIngredients = ingredients.filter(
                (_, index) =>
                  index !== i /* _ -> meaning ignore a first parameter */
              );
              setIngredients(newIngredients);
            }}
            className="cursor-pointer hover:text-red-500"
          >
            {ingre},
          </span>
        ))}
      </div>

      <div className="recipe-container">
        {recipes?.map((recipe, i) => {
          console.log(recipe);
          return (
            <div key={i}>
              <RecipeBox
                id={recipe.id}
                name={recipe.name}
                description={recipe.description}
                image={recipe.image}
              />
            </div>
          );
        })}
      </div>
    </div>
  );
}
