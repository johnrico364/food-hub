import 'package:flutter/material.dart';
import 'package:z_mobile/pages/widgets/category_chip.dart';
import 'package:z_mobile/pages/widgets/recipe_card.dart';
import 'package:z_mobile/pages/views/homepage.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:z_mobile/pages/bloc/recipes_bloc.dart';
import 'package:z_mobile/pages/bloc/recipes_event.dart';
import 'package:z_mobile/pages/bloc/recipes_state.dart';

class CountryPage extends StatefulWidget {
  const CountryPage({super.key});

  @override
  State<CountryPage> createState() => _CountryPageState();
}

class _CountryPageState extends State<CountryPage> {
  bool showModal = false;
  String selectedCategory = 'All'; // Track selected category
  String selectedCountry = 'Philippines'; // Track selected country

  @override
  void initState() {
    super.initState();
    context.read<RecipesBloc>().add(
      FetchRecipesByCategory('All', country: selectedCountry)
    );
  }



  @override
  Widget build(BuildContext context) {
    return Scaffold(
      drawer: Drawer(
        child: ListView(
          padding: EdgeInsets.zero,
          children: [
            DrawerHeader(
              decoration: const BoxDecoration(
                color: Colors.green,
              ),
              child: Center(
                child: Image.asset(
                  'assets/images/utils/logo.png',
                  height: 25,
                ),
              ),
            ),
            ListTile(
              leading: const Icon(Icons.home),
              title: const Text('Home'),
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => HomePage()),
                );
              },
            ),
            ListTile(
              leading: const Icon(Icons.add_location_alt_rounded),
              title: const Text('Country'),
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => CountryPage()),
                );
              },
            ),
          ],
        ),
      ),
      body: Stack(
        children: [
          SafeArea(
            child: Column(
              children: [
                // App Bar
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16.0),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Builder(
                        builder: (context) => GestureDetector(
                          onTap: () => Scaffold.of(context).openDrawer(),
                          child: const Icon(
                            Icons.menu,
                            size: 25,
                          ),
                        ),
                      ),
                      const Expanded(
                        child: Center(
                          child: Text(
                            'Country Recipes',
                            style: TextStyle(
                              fontSize: 20,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ),
                      ),
                    ],
                  ),
                ),

                // Categories
                SingleChildScrollView(
                  scrollDirection: Axis.horizontal,
                  padding: const EdgeInsets.all(16),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Container(
                        alignment: Alignment.centerLeft,
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.start,
                          children: [
                            CategoryChip(
                              label: 'All',
                              isSelected: selectedCategory == 'All',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'All';
                                  context.read<RecipesBloc>().add(
                                    FetchRecipesByCategory('All', country: selectedCountry)
                                  );
                                });
                              },
                            ),
                            CategoryChip(
                              label: 'Main course',
                              isSelected: selectedCategory == 'Main course',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'Main course';
                                  context.read<RecipesBloc>().add(FetchRecipesByCategory('Main course', country: selectedCountry));
                                });
                              },
                            ),
                            CategoryChip(
                              label: 'Breakfast',
                              isSelected: selectedCategory == 'Breakfast',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'Breakfast';
                                  context.read<RecipesBloc>().add(FetchRecipesByCategory('Breakfast', country: selectedCountry));
                                });
                              },
                            ),
                            CategoryChip(
                              label: 'Soups',
                              isSelected: selectedCategory == 'Soups',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'Soups';
                                  context.read<RecipesBloc>().add(FetchRecipesByCategory('Soups', country: selectedCountry));
                                });
                              },
                            ),
                            CategoryChip(
                              label: 'Pasta',
                              isSelected: selectedCategory == 'Pasta',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'Pasta';
                                  context.read<RecipesBloc>().add(FetchRecipesByCategory('Pasta', country: selectedCountry));
                                });
                              },
                            ),
                            CategoryChip(
                              label: 'Desserts',
                              isSelected: selectedCategory == 'Desserts',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'Desserts';
                                  context.read<RecipesBloc>().add(FetchRecipesByCategory('Desserts', country: selectedCountry));
                                });
                              },
                            ),
                            CategoryChip(
                              label: 'Salad',
                              isSelected: selectedCategory == 'Salad',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'Salad';
                                  context.read<RecipesBloc>().add(FetchRecipesByCategory('Salad', country: selectedCountry));
                                });
                              },
                            ),
                            CategoryChip(
                              label: 'Baked',
                              isSelected: selectedCategory == 'Baked',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'Baked';
                                  context.read<RecipesBloc>().add(FetchRecipesByCategory('Baked', country: selectedCountry));
                                });
                              },
                            ),
                            CategoryChip(
                              label: 'Snacks',
                              isSelected: selectedCategory == 'Snacks',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'Snacks';
                                  context.read<RecipesBloc>().add(FetchRecipesByCategory('Snacks', country: selectedCountry));
                                });
                              },
                            ),
                            CategoryChip(
                              label: 'Appetizers',
                              isSelected: selectedCategory == 'Appetizers',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'Appetizers';
                                  context.read<RecipesBloc>().add(FetchRecipesByCategory('Appetizers', country: selectedCountry));
                                });
                              },
                            ),
                            CategoryChip(
                              label: 'Seafood',
                              isSelected: selectedCategory == 'Seafood',
                              onSelected: (selected) {
                                setState(() {
                                  selectedCategory = 'Seafood';
                                  context.read<RecipesBloc>().add(FetchRecipesByCategory('Seafood', country: selectedCountry));
                                });
                              },
                            ),
                          ],
                        ),
                      ),
                      const SizedBox(height: 16),
                      Row(
                        children: [
                          CategoryChip(
                            label: 'Philippines',
                            isSelected: selectedCountry == 'Philippines',
                            onSelected: (selected) {
                              setState(() {
                                selectedCountry = selected ? 'Philippines' : 'Philippines';
                                context.read<RecipesBloc>().add(
                                  FetchRecipesByCategory(selectedCategory, country: selected ? 'Philippines' : 'Philippines')
                                );
                              });
                            },
                          ),
                          CategoryChip(
                            label: 'Thailand',
                            isSelected: selectedCountry == 'Thailand',
                            onSelected: (selected) {
                              setState(() {
                                selectedCountry = selected ? 'Thailand' : 'Philippines';
                                context.read<RecipesBloc>().add(
                                  FetchRecipesByCategory(selectedCategory, country: selected ? 'Thailand' : 'Philippines')
                                );
                              });
                            },
                          ),
                          CategoryChip(
                            label: 'South Korea',
                            isSelected: selectedCountry == 'South Korea',
                            onSelected: (selected) {
                              setState(() {
                                selectedCountry = selected ? 'South Korea' : 'Philippines';
                                context.read<RecipesBloc>().add(
                                  FetchRecipesByCategory(selectedCategory, country: selected ? 'South Korea' : 'Philippines')
                                );
                              });
                            },
                          ),
                          // Add more country categories as needed
                        ],
                      ),
                    ],
                  ),
                ),

                // Recipe Grid
                Expanded(
                  child: BlocBuilder<RecipesBloc, RecipesState>(
                    builder: (context, state) {
                      if (state is RecipesLoading) {
                        return const Center(
                          child: CircularProgressIndicator(),
                        );
                      }
                      
                      if (state is RecipesError) {
                        return Center(
                          child: Text(state.message),
                        );
                      }
                      
                      if (state is RecipesLoaded) {
                        final filteredRecipes = state.recipes.where((recipe) {
                          // if (selectedCountry.isEmpty) return true;
                          return recipe['country'] == selectedCountry;
                        }).toList();

                        return GridView.count(
                          crossAxisCount: 2,
                          padding: const EdgeInsets.all(16),
                          mainAxisSpacing: 16,
                          crossAxisSpacing: 16,
                          children: filteredRecipes
                              .map((recipe) => RecipeCard(
                                recipe: recipe,
                                context: context,
                              ))
                              .toList(),
                        );
                      }

                      return const Center(
                        child: Text('No recipes available'),
                      );
                    },
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
