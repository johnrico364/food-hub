import axios, { AxiosError } from "axios";

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

      recipesData = recipesData.map((recipe: RecipeProps) => {
        return {
          id: recipe.id,
          name: recipe.name,
          description: recipe.description,
          image: JSON.parse(recipe.image),
        }
      })

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

  const ingredientsSearch = async (ingredients: string[]) => {
    try {
      const data = await axios.get(
        "http://127.0.0.1:8000/api/ingredients_search",
        {
          params: { ingredients },
        }
      );

      const recipesData = data?.data?.data.map((recipe: RecipeProps) => {
        return {
          id: recipe.id,
          name: recipe.name,
          description: recipe.description,
          image: JSON.parse(recipe.image),
        };
      })

      return recipesData;
    } catch (error) {
      console.log(error);
    }
  };
  return { searchRecipes, ingredientsSearch };
};
