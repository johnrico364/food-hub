abstract class RecipesEvent {}

class FetchRecipesByCategory extends RecipesEvent {
  final String category;
  final String country;

  FetchRecipesByCategory(this.category, {this.country = ''});
}

class FetchCategories extends RecipesEvent {}