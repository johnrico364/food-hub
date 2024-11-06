"use client";
import { useEffect, useState } from "react";
import ReactPaginate from "react-paginate";
// Components
import { CategoryBox } from "@/components/category-box";
import { RecipeBox } from "@/components/recipe-box";
// Hooks
import { useGetRecipes } from "@/hooks/useGetRecipes";
// Icons
import { AiOutlineAppstoreAdd } from "react-icons/ai";
import { CiBowlNoodles } from "react-icons/ci";
import { IoFishOutline, IoRestaurantOutline, IoSearch } from "react-icons/io5";
import { LiaMugHotSolid } from "react-icons/lia";
import { LuIceCream2, LuPopcorn, LuSalad, LuSoup } from "react-icons/lu";
import { MdOutlineBakeryDining } from "react-icons/md";
import { BiBowlRice } from "react-icons/bi";

type RecipeProps = {
  id: number;
  name: string;
  description: string;
};

const categories = [
  {
    icon: AiOutlineAppstoreAdd,
    name: "All",
    items: 1309,
  },
  {
    icon: IoRestaurantOutline,
    name: "Main course",
    items: 68,
  },
  {
    icon: LiaMugHotSolid,
    name: "Breakfast",
    items: 125,
  },
  {
    icon: LuSoup,
    name: "Soups",
    items: 189,
  },
  {
    icon: CiBowlNoodles,
    name: "Pasta",
    items: 73,
  },
  {
    icon: LuIceCream2,
    name: "Desserts",
    items: 189,
  },
  {
    icon: LuSalad,
    name: "Salad",
    items: 51,
  },
  {
    icon: MdOutlineBakeryDining,
    name: "Baked",
    items: 11,
  },
  {
    icon: LuPopcorn,
    name: "Snacks",
    items: 31,
  },
  {
    icon: BiBowlRice,
    name: "Appetizers",
    items: 24,
  },
  {
    icon: IoFishOutline,
    name: "Seafood",
    items: 34,
  },
];

export default function Recipes() {
  const { getRecipesByCategory } = useGetRecipes();

  const [recipes, set_recipes] = useState([]);
  const [categoryType, set_categoryType] = useState("All");
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

  const effectFn = async () => {
    const recipesData = await getRecipesByCategory(categoryType);
    set_recipes(recipesData);
  };

  useEffect(() => {
    effectFn();
  }, [categoryType]);
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
        {categories?.map((category, i) => {
          return (
            <div key={i} onClick={() => set_categoryType(category.name)}>
              <CategoryBox
                icon={category.icon}
                name={category.name}
                items={category.items}
                isActive={category.name === categoryType}
              />
            </div>
          );
        })}
      </div>

      <div className="recipe-container">
        {displayRecipes.map((r: RecipeProps, i) => {
          return (
            <div key={i}>
              <RecipeBox id={r.id} name={r.name} description={r.description} />
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
