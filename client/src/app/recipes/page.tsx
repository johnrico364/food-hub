"use client";
import { useState } from "react";
import ReactPaginate from "react-paginate";
// Components
import { CategoryBox } from "@/components/category-box";
import { RecipeBox } from "@/components/recipe-box";
// Icons
import { AiOutlineAppstoreAdd } from "react-icons/ai";
import { CiBowlNoodles } from "react-icons/ci";
import { IoRestaurantOutline, IoSearch } from "react-icons/io5";
import { LiaMugHotSolid } from "react-icons/lia";
import { LuIceCream2, LuSoup } from "react-icons/lu";
import { TbBurger } from "react-icons/tb";

// Fakedata
import Recipes_Data from "../../recipes.json";

type Props = {
  Name: string;
  Instructions: string;
  Month: string;
};

export default function Recipes() {
  const recipes_data: Props[] = Recipes_Data;

  const [recipes] = useState(recipes_data.slice(0, 203));
  const [pageNumber, set_pageNumber] = useState(0);

  const recipesPerPage = 10;
  const pagesVisited = pageNumber * recipesPerPage;
  const pageCount = Math.ceil(recipes.length / recipesPerPage); //3.1 -> 4

  const displayRecipes = recipes.slice(
    pagesVisited,
    pagesVisited + recipesPerPage
  );

  const onChange = ({ selected }: { selected: number }) => {
    set_pageNumber(selected);
  };

  return (
    <div className="recipes-section">
      <div className="wrapper search-container">
        <IoSearch className="icon" />
        <input
          className="search-input"
          type="text"
          placeholder="Search Recipe here..."
        />
      </div>

      <div className="category-container ">
        <CategoryBox icon={AiOutlineAppstoreAdd} name={"All"} items={1309} />
        <CategoryBox icon={LiaMugHotSolid} name={"Breakfast"} items={125} />
        <CategoryBox icon={LuSoup} name={"Soups"} items={189} />
        <CategoryBox icon={CiBowlNoodles} name={"Pasta"} items={73} />
        <CategoryBox
          icon={IoRestaurantOutline}
          name={"Main Course"}
          items={68}
        />
        <CategoryBox icon={TbBurger} name={"Burgers"} items={102} />
        <CategoryBox icon={LuSoup} name={"Soups"} items={189} />
        <CategoryBox icon={LuIceCream2} name={"Desserts"} items={189} />
      </div>

      <div className="recipe-container">
        {displayRecipes.map((r, i) => {
          return (
            <div key={i}>
              <RecipeBox name={r.Name} description={r.Instructions} />
            </div>
          );
        })}
      </div>
      <div className="pagination-container">
        <ReactPaginate
          previousLabel={"<"}
          nextLabel={">"}
          pageCount={pageCount}
          onPageChange={onChange}
          // classnames -> Mga pangalan sa classnames sa mga buttons
          containerClassName={"pagination-box"}
          previousLinkClassName={"previous-btn"}
          nextLinkClassName={"next-btn"}
          disabledClassName={"pagination-disable"}
          activeClassName={"pagination-active"}
        />
      </div>
    </div>
  );
}
