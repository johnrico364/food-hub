/* eslint-disable @typescript-eslint/no-require-imports */
"use client";
import Image from "next/image";
import { useState } from "react";

// Icons
import { AiOutlineAppstoreAdd } from "react-icons/ai";
import { BiWorld } from "react-icons/bi";
import { FaRegClock } from "react-icons/fa";

type Props = {
  params: {
    recipe_id: string;
  };
};

const ingredients = ["Egg", "Pork", "Soy Sauce", "Vinegar", "Black Pepper"];

export default function RecipeDetails({ params }: Props) {
  const [pageNumber, set_pageNumber] = useState(0);
  const pageVisited = pageNumber * 3;

  const displayIngredients = ingredients.slice(pageVisited, pageVisited + 3);

  console.log(displayIngredients.length);

  const swipeIngredientsFn = (action: string) => {
    const isNext = displayIngredients.length === 3;
    const isBack = pageNumber !== 0;
    if (action === "next" && isNext) {
      set_pageNumber(pageNumber + 1)
    }
    if (action === "back" && isBack) {
      set_pageNumber(pageNumber - 1)
    }
  };

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
              <div className="recipe-name">Adobo Sinigang</div>

              <div className="wrapper mt-9">
                <div className="recipe-details">
                  <div className="flex justify-center">
                    <AiOutlineAppstoreAdd className="icon" />
                  </div>
                  <div className="flex justify-center">
                    <div className="value">Main Course</div>
                  </div>
                </div>
                <div className="recipe-details">
                  <div className="flex justify-center">
                    <FaRegClock className="icon" />
                  </div>
                  <div className="flex justify-center">
                    <div className="value">4 Hours</div>
                  </div>
                </div>
                <div className="recipe-details">
                  <div className="flex justify-center">
                    <BiWorld className="icon" />
                  </div>
                  <div className="flex justify-center">
                    <div className="value">India</div>
                  </div>
                </div>
                <div className="border-2 mt-16 w-full"></div>
              </div>

              <div className="recipe-description">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Repellat doloribus laborum hic ducimus autem, cupiditate
                exercitationem voluptatibus quisquam tenetur sapiente excepturi
                facilis sequi voluptate earum est illo eaque sunt ipsa. Lorem
                ipsum dolor, sit amet consectetur adipisicing elit. Consectetur,
                natus libero omnis recusandae similique unde, doloribus velit a
                nemo earum magnam accusamus hic nihil et cupiditate vero nostrum
                esse quia! Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Quaerat quidem totam iste enim explicabo maiores
                doloremque aperiam eos aliquam maxime ratione molestias dicta
                ullam autem esse harum culpa dolor similique recusandae ea,
                nihil cupiditate consequuntur sit. Autem delectus perspiciatis
                voluptatibus iure labore dignissimos illo exercitationem sint
                modi quod, quis commodi ut veniam. Ullam labore quos modi
                quibusdam rem sit praesentium. Recusandae eius ea officia aut
                saepe quisquam esse pariatur! Esse commodi, blanditiis quaerat
                veniam ipsa natus a exercitationem hic atque illo provident
                deserunt necessitatibus. Totam sequi dolorem perferendis sunt
                dicta laboriosam eos! Voluptatem molestias est repellendus
                aspernatur illum dignissimos quod, asperiores, nihil nemo culpa
                rerum laborum magnam sapiente maiores alias a? Sed esse
                dignissimos exercitationem rem beatae dicta maxime ex hic iste,
                at accusantium sit ut assumenda, suscipit fuga distinctio
                praesentium quidem optio modi mollitia eum vel. Maiores dolores
                quidem pariatur quaerat tempore quasi possimus, omnis
                repudiandae? Aperiam consequuntur explicabo omnis quia
                asperiores aut obcaecati quo quae neque dolor. Iure doloremque
                voluptatibus atque nulla fugit culpa error temporibus non a
                aspernatur adipisci hic delectus debitis esse sint ad ab
                explicabo, harum architecto facere dolor itaque odio aperiam
                possimus. Cumque numquam asperiores quia praesentium quos dolore
                consectetur vitae omnis, velit nulla?
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
                <button className="tutorial-btn">Show Tutorial</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
