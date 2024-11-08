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
    items: 0,
  },
  {
    icon: IoRestaurantOutline,
    name: "Main course",
    items: 0,
  },
  {
    icon: LiaMugHotSolid,
    name: "Breakfast",
    items: 0,
  },
  {
    icon: LuSoup,
    name: "Soups",
    items: 0,
  },
  {
    icon: CiBowlNoodles,
    name: "Pasta",
    items: 0,
  },
  {
    icon: LuIceCream2,
    name: "Desserts",
    items: 0,
  },
  {
    icon: LuSalad,
    name: "Salad",
    items: 0,
  },
  {
    icon: MdOutlineBakeryDining,
    name: "Baked",
    items: 0,
  },
  {
    icon: LuPopcorn,
    name: "Snacks",
    items: 0,
  },
  {
    icon: BiBowlRice,
    name: "Appetizers",
    items: 0,
  },
  {
    icon: IoFishOutline,
    name: "Seafood",
    items: 0,
  },
];

export default function Recipes() {
  const { getRecipesByCategory, getRecipesCount } = useGetRecipes();

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
    const categoryCount = await getRecipesCount();
    set_recipes(recipesData);

    let categoryIndex = 0;
    for (const key in categoryCount) {
      categories[categoryIndex].items = categoryCount[key];
      categoryIndex++;
    }
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
