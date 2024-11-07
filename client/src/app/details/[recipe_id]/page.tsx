/* eslint-disable @typescript-eslint/no-require-imports */
"use client";
import { useGetRecipes } from "@/hooks/useGetRecipes";
import Image from "next/image";
import { useEffect, useState } from "react";

// Icons
import { AiOutlineAppstoreAdd } from "react-icons/ai";
import { BiWorld } from "react-icons/bi";
import { FaRegClock } from "react-icons/fa";

type Props = {
  params: {
    recipe_id: string;
  };
};
type RecipeProps = {
  category: string;
  country: string;
  description: string;
  id: number;
  image: string;
  ingredients: string;
  name: string;
  prep_time: number;
  yt_link: string;
};

const ingredients = ["Egg", "Pork", "Soy Sauce", "Vinegar", "Black Pepper"];

export default function RecipeDetails({ params }: Props) {
  const { getRecipeDetails } = useGetRecipes();

  const [recipeDetails, set_recipeDetails] = useState<RecipeProps>();
  const [pageNumber, set_pageNumber] = useState(0);
  const pageVisited = pageNumber * 3;

  const displayIngredients = ingredients.slice(pageVisited, pageVisited + 3);

  const swipeIngredientsFn = (action: string) => {
    const isNext = displayIngredients.length === 3;
    const isBack = pageNumber !== 0;
    if (action === "next" && isNext) {
      set_pageNumber(pageNumber + 1);
    }
    if (action === "back" && isBack) {
      set_pageNumber(pageNumber - 1);
    }
  };

  const effectFn = async () => {
    const response = await getRecipeDetails(params.recipe_id);
    console.log(response);
    set_recipeDetails(response);
  };

  useEffect(() => {
    effectFn();
  }, []);

  return (
    <div className="recipe-details-section">
      <div className="wrapper justify-center">
        <div className="lg:basis-10/12 basis-11/12">
          <div className="wrapper">
            <div className="basis-6/12">
              <Image
                className="recipe-pic"
                src={require("@/images/ingredients/Pork.jpg")}
                alt="recipe"
              />
            </div>
            <div className="basis-6/12 px-10">
              <div className="recipe-name">{recipeDetails?.name}</div>

              <div className="wrapper mt-9">
                <div className="recipe-details">
                  <div className="flex justify-center">
                    <AiOutlineAppstoreAdd className="icon" />
                  </div>
                  <div className="flex justify-center">
                    <div className="value">{recipeDetails?.category[0]}</div>
                  </div>
                </div>
                <div className="recipe-details">
                  <div className="flex justify-center">
                    <FaRegClock className="icon" />
                  </div>
                  <div className="flex justify-center">
                    <div className="value">
                      {recipeDetails?.prep_time} minutes
                    </div>
                  </div>
                </div>
                <div className="recipe-details">
                  <div className="flex justify-center">
                    <BiWorld className="icon" />
                  </div>
                  <div className="flex justify-center">
                    <div className="value">{recipeDetails?.country}</div>
                  </div>
                </div>
                <div className="border-2 mt-16 w-full"></div>
              </div>

              <div className="recipe-description">
                {recipeDetails?.description}
              </div>
            </div>
          </div>

          <div className="wrapper mt-11">
            <div className="lg:basis-6/12 md:basis-7/12">
              <div className="font-bold">Ingredients</div>

              <div className="ingredients-box">
                <button
                  className="swipe-btn"
                  onClick={() => swipeIngredientsFn("back")}
                >
                  {"<"}
                </button>
                {displayIngredients.map((data, i) => {
                  return (
                    <div className="ingre-card" key={i}>
                      <div className="center-items">
                        <Image
                          className="ingre-pic"
                          src={require(`@/images/ingredients/${data}.jpg`)}
                          alt="recipe"
                        />
                      </div>
                      <div className="center-items">
                        <div className="ingre-name">{data}</div>
                      </div>
                    </div>
                  );
                })}
                <button
                  className="swipe-btn"
                  onClick={() => swipeIngredientsFn("next")}
                >
                  {">"}
                </button>
              </div>
            </div>
            <div className="lg:basis-6/12 md:basis-5/12">
              <div className="wrapper justify-end">
                <button
                  className="tutorial-btn"
                  onClick={() => window.open(recipeDetails?.yt_link, '_blank')}
                >
                  Show Tutorial
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
