"use client";
import { useState } from "react";

export default function IngredientsSearchPage() {
  const [ingredients, setIngredients] = useState<string[]>([]);
  const [inputIngredient, setInputIngredient] = useState<string>("");

  return (
    <div className="ingredients-search-section border">
      <div className="wrapper">
        <input
          className="search-input"
          type="text"
          onChange={(e) => setInputIngredient(e.target.value)}
          value={inputIngredient}
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
        <span className="font-semibold">Seacrhing for recipes with: </span>
        {ingredients.map((ingre, i) => (
          <span key={i}>{ingre}, </span>
        ))}
      </div>

      <div className="recipe-container">
      </div>
    </div>
  );
}
