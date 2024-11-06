import axios from "axios";

export const useGetRecipes = () => {
  const getRecipesByCategory = async (category: string) => {
    try {
      const data = await axios.get(
        `http://127.0.0.1:8000/api/recipes/category/${category}`
      );
      return data?.data?.data
    } catch (error) {
      console.log(error);
    }
  };

  return { getRecipesByCategory };
};
