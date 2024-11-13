import axios, { AxiosError } from "axios";

export const useSearchRecipes = () => {
  const searchRecipes = async (searchTerm: string) => {
    try {
      const match = await axios.get("http://127.0.0.1:8000/api/search?", {
        params: {
          searched: searchTerm,
        },
      });

      let recipesData;
      if (match?.data?.exact_match) {
        recipesData = [match?.data?.exact_match, ...match?.data?.related_match];
      } else {
        recipesData = match?.data?.related_match;
      }

      return {
        status: match?.status,
        data: recipesData,
      };
    } catch (error) {
      const axiosError = error as AxiosError;
      return {
        status: axiosError.response?.status,
        data: "Recipes not found",
      };
    }
  };

  return { searchRecipes };
};
