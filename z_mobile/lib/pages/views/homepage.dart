import 'package:flutter/material.dart';
import 'package:z_mobile/pages/views/countrypage.dart';
import 'package:z_mobile/pages/widgets/category_chip.dart';
import 'package:z_mobile/pages/widgets/recipe_card.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:z_mobile/pages/bloc/recipes_bloc.dart';
import 'package:z_mobile/pages/bloc/recipes_event.dart';
import 'package:z_mobile/pages/bloc/recipes_state.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  bool showModal = false;
  String selectedCategory = 'All'; // Track selected category

  @override
  void initState() {
    super.initState();
    // Fetch initial data when page loads
    context.read<RecipesBloc>().add(FetchRecipesByCategory('All'));
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
                  MaterialPageRoute(builder: (context) => const HomePage()),
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
                            'Food Recipes',
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
                  child: Row(
                    children: [
                      CategoryChip(
                        label: 'All',
                        isSelected: selectedCategory == 'All',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'All';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('All'));
                          });
                        },
                      ),
                      CategoryChip(
                        label: 'Main course',
                        isSelected: selectedCategory == 'Main course',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'Main course';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('Main course'));
                          });
                        },
                      ),
                      CategoryChip(
                        label: 'Breakfast',
                        isSelected: selectedCategory == 'Breakfast',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'Breakfast';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('Breakfast'));
                          });
                        },
                      ),
                      CategoryChip(
                        label: 'Soups',
                        isSelected: selectedCategory == 'Soups',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'Soups';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('Soups'));
                          });
                        },
                      ),
                      CategoryChip(
                        label: 'Pasta',
                        isSelected: selectedCategory == 'Pasta',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'Pasta';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('Pasta'));
                          });
                        },
                      ),
                      CategoryChip(
                        label: 'Desserts',
                        isSelected: selectedCategory == 'Desserts',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'Desserts';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('Desserts'));
                          });
                        },
                      ),
                      CategoryChip(
                        label: 'Salad',
                        isSelected: selectedCategory == 'Salad',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'Salad';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('Salad'));
                          });
                        },
                      ),
                      CategoryChip(
                        label: 'Baked',
                        isSelected: selectedCategory == 'Baked',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'Baked';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('Baked'));
                          });
                        },
                      ),
                      CategoryChip(
                        label: 'Snacks',
                        isSelected: selectedCategory == 'Snacks',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'Snacks';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('Snacks'));
                          });
                        },
                      ),
                      CategoryChip(
                        label: 'Appetizers',
                        isSelected: selectedCategory == 'Appetizers',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'Appetizers';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('Appetizers'));
                          });
                        },
                      ),
                      CategoryChip(
                        label: 'Seafood',
                        isSelected: selectedCategory == 'Seafood',
                        onSelected: (selected) {
                          setState(() {
                            selectedCategory = 'Seafood';
                            context.read<RecipesBloc>().add(FetchRecipesByCategory('Seafood'));
                          });
                        },
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
                        return GridView.count(
                          crossAxisCount: 2,
                          padding: const EdgeInsets.all(16),
                          mainAxisSpacing: 16,
                          crossAxisSpacing: 16,
                          children: state.recipes
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
