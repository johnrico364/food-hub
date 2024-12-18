import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import 'package:z_mobile/pages/bloc/recipes_event.dart';
import 'package:z_mobile/pages/bloc/recipes_state.dart';

class RecipesBloc extends Bloc<RecipesEvent, RecipesState> {
  RecipesBloc() : super(RecipesInitial()) {
    on<FetchRecipesByCategory>(_onFetchRecipesByCategory);
    on<FetchCategories>(_onFetchCategoryCount);
  }

  Future<void> _onFetchRecipesByCategory(
    FetchRecipesByCategory event,
    Emitter<RecipesState> emit,
  ) async {
    emit(RecipesLoading());
    try {
      final response = await http.get(
        Uri.parse('http://127.0.0.1:8000/api/recipes/category/${event.category}'),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        emit(RecipesLoaded(data['data']));
      } else {
        emit(RecipesError('Failed to load recipes'));
      }
    } catch (e) {
      emit(RecipesError('An error occurred: $e'));
    }
  }

  Future<void> _onFetchCategoryCount(
    FetchCategories event,
    Emitter<RecipesState> emit,
  ) async {
    emit(RecipesLoading());
    try {
      final response = await http.get(
        Uri.parse('http://127.0.0.1:8000/api/category_count'),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        final recipesData = data['category_count'];
        emit(CategoryCountLoaded(recipesData));
      } else {
        emit(RecipesError('Failed to load category counts'));
      }
    } catch (e) {
      emit(RecipesError('An error occurred: $e'));
    }
  }
}