import axios from "axios";

export const useGetRecipes = () => {
  const getRecipesByCategory = async (category: string) => {
    try {
      const data = await axios.get(
        `http://127.0.0.1:8000/api/recipes/category/${category}`
      );
      return data?.data?.data;
    } catch (error) {
      console.log(error);
    }
  };

  const getRecipesByCountry = async (category: string, country: string) => {
    type Props = {
      id: number;
      name: string;
      description: string;
      country: string;
    };

    try {
      const data = await axios.get(
        `http://127.0.0.1:8000/api/recipes/category/${category}`
      );
      const recipes = data?.data?.data;
      const filteredReturn = recipes?.filter((data: Props) => {
        return data.country === country.replace("%20", " ");
      });

      return filteredReturn;
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
      const recipeReturn = {
        category: JSON.parse(details.category),
        country: details.country,
        description: details.description,
        id: details.id,
        image: details.image,
        ingredients: JSON.parse(details.ingredients),
        name: details.name,
        prep_time: details.prep_time,
        yt_link: details.yt_link,
      };
      return recipeReturn;
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
