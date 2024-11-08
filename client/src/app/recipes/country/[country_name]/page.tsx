"use client";
import { useEffect, useState } from "react";
import ReactPaginate from "react-paginate";

// Components
import { CategoryBox } from "@/components/category-box";
import { RecipeBox } from "@/components/recipe-box";
// Hooks
import { useGetRecipes } from "@/hooks/useGetRecipes";
import { categories } from "@/hooks/categories";

type Props = {
  params: {
    country_name: string;
  };
};

type RecipeProps = {
  id: number;
  name: string;
  description: string;
};

export default function Country({ params }: Props) {
  const { getRecipesByCountry, getRecipesCount } = useGetRecipes();

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
    const recipesData = await getRecipesByCountry(
      categoryType,
      params.country_name
    );
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
    <div className="recipe-country-section">
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
