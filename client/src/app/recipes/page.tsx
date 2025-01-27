"use client";
import React, { useEffect, useState } from "react";
import ReactPaginate from "react-paginate";
// Components
import { CategoryBox } from "@/components/category-box";
import { RecipeBox } from "@/components/recipe-box";
// Hooks
import { useGetRecipes } from "@/hooks/useGetRecipes";
// import { categories } from "@/hooks/categories";
import { useSearchRecipes } from "@/hooks/useSearchRecipes";
// Icons
import { IoSearch } from "react-icons/io5";
import { AiOutlineAppstoreAdd } from "react-icons/ai";
import { CiBowlNoodles } from "react-icons/ci";
import { IoFishOutline, IoRestaurantOutline } from "react-icons/io5";
import { LiaMugHotSolid } from "react-icons/lia";
import { LuIceCream2, LuPopcorn, LuSalad, LuSoup } from "react-icons/lu";
import { MdOutlineBakeryDining } from "react-icons/md";
import { BiBowlRice } from "react-icons/bi";

type RecipeProps = {
  id: number;
  name: string;
  description: string;
  image: string;
};

type CategoryProps = {
  category: string;
  count: number;
  icon: string;
};

const iconComponents = {
  'AiOutlineAppstoreAdd': AiOutlineAppstoreAdd,
  'CiBowlNoodles': CiBowlNoodles,
  'IoFishOutline': IoFishOutline,
  'IoRestaurantOutline': IoRestaurantOutline,
  'LiaMugHotSolid': LiaMugHotSolid,
  'LuIceCream2': LuIceCream2,
  'LuPopcorn': LuPopcorn,
  'LuSalad': LuSalad,
  'LuSoup': LuSoup,
  'MdOutlineBakeryDining': MdOutlineBakeryDining,
  'BiBowlRice': BiBowlRice,
};

export default function Recipes() {
  const { getRecipesByCategory, getRecipesCount } = useGetRecipes();
  const { searchRecipes } = useSearchRecipes();

  const [recipes, set_recipes] = useState([]);
  const [categories, set_categories] = useState<CategoryProps[]>([]);
  const [searchTerm, set_searchTerm] = useState("");
  const [isSearching, set_isSearching] = useState(false);
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

  const handleSearchFn = async (e: React.FormEvent) => {
    e.preventDefault();
    set_isSearching(true);

    if (searchTerm.trim() === "") {
      const recipesData = await getRecipesByCategory(categoryType);
      set_recipes(recipesData);
      return;
    }
    const response = await searchRecipes(searchTerm.trim());
    if (response?.status === 404) {
      alert(response?.data);
      return;
    }
    set_recipes(response?.data);
    set_pageNumber(0);
    set_categoryType("All");
  };

  const effectFn = async () => {
    if (isSearching) return;

    const recipesData = await getRecipesByCategory(categoryType);
    const categoryCount = await getRecipesCount();
    set_recipes(recipesData);
    set_categories(categoryCount);
  };

  useEffect(() => {
    effectFn();
  }, [categoryType]);

  // Reset isSearching after recipes update
  useEffect(() => {
    if (isSearching) set_isSearching(false);
  }, [recipes]);

  return (
    <div className="recipes-section">
      <form className="wrapper search-container" onSubmit={handleSearchFn}>
        <IoSearch className="icon" />
        <input
          className="search-input"
          type="text"
          placeholder="Search Recipe here..."
          onChange={(e) => set_searchTerm(e.target.value)}
        />
      </form>

      <div className="category-container">
        {categories?.map((category, i) => {
          const IconComponent = iconComponents[category.icon as keyof typeof iconComponents];
          return (
            <div key={i} onClick={() => set_categoryType(category.category)}>
              <CategoryBox
                icon={IconComponent}
                name={category.category}
                items={category.count}
                isActive={category.category === categoryType}
              />
            </div>
          );
        })}
      </div>

      <div className="recipe-container">
        {displayRecipes.map((r: RecipeProps, i) => {
          return (
            <div key={i}>
              <RecipeBox
                id={r.id}
                name={r.name}
                description={r.description}
                image={r.image[0]}
              />
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
