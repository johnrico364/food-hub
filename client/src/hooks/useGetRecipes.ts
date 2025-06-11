import axios from "axios";

type RecipeProps = {
  id: number;
  name: string;
  description: string;
  country: string;
  image: string;
  ingredients: string;
  prep_time: number;
  yt_link: string;
  category: string;
  isDeleted: boolean;
  created_at: string;
  updated_at: string;
};

export const useGetRecipes = () => {
  const getRecipesByCategory = async (category: string) => {
    try {
      const data = await axios.get(
        `http://127.0.0.1:8000/api/recipes/category/${category}`
      );

      const recipes = data?.data?.data.map((recipe: RecipeProps) => {
        return {
          id: recipe.id,
          name: recipe.name,
          description: recipe.description,
          image: JSON.parse(recipe.image),
        };
      });

      return recipes;
    } catch (error) {
      console.log(error);
    }
  };

  const getRecipesByCountry = async (category: string, country: string) => {
    try {
      const data = await axios.get(
        `http://127.0.0.1:8000/api/recipes/category/${category}`
      );
      const filteredReturn = data?.data?.data?.filter((data: RecipeProps) => {
        return data.country === country.replace("%20", " ");
      });

      const recipes = filteredReturn.map((recipe: RecipeProps) => {
        return {
          id: recipe.id,
          name: recipe.name,
          description: recipe.description,
          image: JSON.parse(recipe.image),
        };
      })

      return recipes;
    } catch (error) {
      console.log(error);
    }
  };

  const getRecipeDetails = async (id: string) => {
    try {
      const data = await axios.get(
        `http://127.0.0.1:8000/api/recipe_details/${id}`
      );

      const details = data?.data?.data;
      details.category = JSON.parse(details.category);
      details.ingredients = JSON.parse(details.ingredients);
      details.image = JSON.parse(details.image);

      return details;
    } catch (error) {
      console.log(error);
    }
  };

  const getRecipesCount = async () => {
    try {
      const data = await axios.get("http://127.0.0.1:8000/api/category_count");
      return data?.data?.category_count;
    } catch (error) {
      console.log(error);
    }
  };

  const getRecipeCountbyCountry = async (countryName: string) => {
    try {
      const data = await axios.get(
        `http://127.0.0.1:8000/api/country/category_count/${countryName}`
      );
      return data?.data?.category_count;
    } catch (error) {
      console.log(error);
    }
  };

  const getRecipeCountries = async () => {
    try {
      const data = await axios.get("http://127.0.0.1:8000/api/country_list");
      return data?.data?.data?.country;
    } catch (error) {
      console.log(error);
    }
  };
  return {
    getRecipesByCategory,
    getRecipesByCountry,
    getRecipeDetails,
    getRecipesCount,
    getRecipeCountbyCountry,
    getRecipeCountries,
  };
};
