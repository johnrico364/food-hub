/* eslint-disable @typescript-eslint/no-require-imports */
"use client";
import { useGetRecipes } from "@/hooks/useGetRecipes";
import Image from "next/image";
import { useEffect, useState } from "react";

import { Splide, SplideSlide } from "@splidejs/react-splide";
import "@splidejs/react-splide/css";

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
  image: string[];
  ingredients: string;
  name: string;
  prep_time: number;
  yt_link: string;
};

export default function RecipeDetails({ params }: Props) {
  const { getRecipeDetails } = useGetRecipes();

  const [ingredients, set_ingredients] = useState([]);
  const [recipeDetails, set_recipeDetails] = useState<RecipeProps>();
  const [pageNumber, set_pageNumber] = useState(0);
  const pageVisited = pageNumber * 3;
  const [showModal, set_showModal] = useState(false);

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
    set_ingredients(response?.ingredients);
  };

  useEffect(() => {
    effectFn();
  }, []);

  return (
    <div className="recipe-details-section">
      <div className="wrapper justify-center">
        <div className="basis-11/12">
          <div className="wrapper">
            <div className="md:basis-5/12 basis-full">
              <Splide>
                {recipeDetails?.image.map((img, i) => {
                  return (
                    <SplideSlide key={i}>
                      <Image
                        className="recipe-pic"
                        src={`http://127.0.0.1:8000/api/image/${recipeDetails?.image[i]}`}
                        alt="recipe"
                        width={1000}
                        height={150}
                      />
                    </SplideSlide>
                  );
                })}
              </Splide>
            </div>
            <div className="md:basis-6/12 basis-full md:pl-[3rem]">
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
            <div className="md:basis-6/12 basis-full">
              <div className="font-bold">Ingredients</div>

              <div className="ingredients-box">
                <button
                  className="swipe-btn"
                  onClick={() => swipeIngredientsFn("back")}
                >
                  {"<"}
                </button>
                {displayIngredients.map((data, i) => {
                  let imageSrc: string;
                  try {
                    imageSrc = require(`@/images/ingredients/${data}.jpg`);
                  } catch (error) {
                    imageSrc = require("@/images/ingredients/default.jpg");
                    console.log(error);
                  }
                  return (
                    <div className="ingre-card" key={i}>
                      <div className="center-items">
                        <Image
                          className="ingre-pic"
                          src={imageSrc}
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
            <div className="md:basis-6/12 max-md:mt-[1rem] basis-full">
              <div className="wrapper justify-end">
                <button
                  className="tutorial-btn"
                  onClick={() => set_showModal(true)}
                >
                  Show Tutorial
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Add Modal */}
      {showModal && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
          <div className="bg-white p-4 rounded-lg w-11/12 max-w-4xl">
            <div className="flex justify-end mb-2">
              <button
                className="text-gray-500 hover:text-gray-700"
                onClick={() => set_showModal(false)}
              >
                ✕
              </button>
            </div>
            <div className="relative pt-[56.25%]">
              <iframe
                className="absolute top-0 left-0 w-full h-full"
                src={recipeDetails?.yt_link.replace("watch?v=", "embed/")}
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowFullScreen
              />
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
