abstract class RecipesState {}

class RecipesInitial extends RecipesState {}

class RecipesLoading extends RecipesState {}

class RecipesLoaded extends RecipesState {
  final List<dynamic> recipes;

  RecipesLoaded(this.recipes);
}

class RecipesError extends RecipesState {
  final String message;

  RecipesError(this.message);
}

class CategoryCountLoaded extends RecipesState {
  final List<dynamic> categories;

  CategoryCountLoaded(this.categories);
}