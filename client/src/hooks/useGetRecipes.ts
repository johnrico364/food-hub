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

  return { getRecipesByCategory, getRecipeDetails };
};
