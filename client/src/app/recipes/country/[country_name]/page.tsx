"use client";
import { useEffect, useState } from "react";
import ReactPaginate from "react-paginate";

// Components
import { CategoryBox } from "@/components/category-box";
import { RecipeBox } from "@/components/recipe-box";
// Hooks
import { useGetRecipes } from "@/hooks/useGetRecipes";
// import { categories } from "@/hooks/categories";

// Icons
import { AiOutlineAppstoreAdd } from "react-icons/ai";
import { CiBowlNoodles } from "react-icons/ci";
import { IoFishOutline, IoRestaurantOutline } from "react-icons/io5";
import { LiaMugHotSolid } from "react-icons/lia";
import { LuIceCream2, LuPopcorn, LuSalad, LuSoup } from "react-icons/lu";
import { MdOutlineBakeryDining } from "react-icons/md";
import { BiBowlRice } from "react-icons/bi";

type Props = {
  params: {
    country_name: string;
  };
};

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

export default function Country({ params }: Props) {
  const { getRecipesByCountry, getRecipeCountbyCountry } = useGetRecipes();

  const [recipes, set_recipes] = useState([]);
  const [categories, set_categories] = useState<CategoryProps[]>([]);
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
    const recipesData = await getRecipesByCountry(
      categoryType,
      params.country_name
    );
    const categoryCount = await getRecipeCountbyCountry(params.country_name);
    set_recipes(recipesData);
    set_categories(categoryCount);
  };

  useEffect(() => {
    effectFn();
  }, [categoryType]);

  return (
    <div className="recipe-country-section">
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
