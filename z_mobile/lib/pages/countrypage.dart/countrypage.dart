import 'package:flutter/material.dart';

class CountryPage extends StatefulWidget {
  const CountryPage({super.key});

  @override
  State<CountryPage> createState() => _CountryPageState();
}

class _CountryPageState extends State<CountryPage> {
  bool showModal = false;
  String selectedCategory = '';

  // Sample recipe data with categories and countries
  final List<Map<String, dynamic>> recipes = [
    {
      'name': 'Sushi',
      'category': 'Seafood',
      'country': 'Japan',
      'image': 'assets/images/ingredients/Egg.jpg',
    },
    {
      'name': 'Pizza',
      'category': 'Main Course',
      'country': 'Italy',
      'image': 'assets/images/ingredients/pork belly.jpg',
    },
    {
      'name': 'Pad Thai',
      'category': 'Noodles',
      'country': 'Thailand',
      'image': 'assets/images/ingredients/Egg.jpg',
    },
    {
      'name': 'Tacos',
      'category': 'Street Food',
      'country': 'Mexico',
      'image': 'assets/images/ingredients/pork belly.jpg',
    },
  ];

  List<Map<String, dynamic>> get filteredRecipes {
    if (selectedCategory.isEmpty) {
      return recipes;
    }
    return recipes
        .where((recipe) => recipe['category'] == selectedCategory)
        .toList();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          SafeArea(
            child: Column(
              children: [
                // App Bar
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16.0),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      IconButton(
                        icon: const Icon(Icons.arrow_back),
                        onPressed: () {
                          Navigator.pop(context);
                        },
                      ),
                      const Text(
                        'Countries',
                        style: TextStyle(
                          fontSize: 20,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      const SizedBox(width: 48),
                    ],
                  ),
                ),

                // Categories
                SingleChildScrollView(
                  scrollDirection: Axis.horizontal,
                  padding: const EdgeInsets.all(16),
                  child: Row(
                    children: [
                      _buildCategoryChip('Philippines'),
                      _buildCategoryChip('Canada'),
                    ],
                  ),
                ),

                // Recipe Grid
                Expanded(
                  child: GridView.count(
                    crossAxisCount: 2,
                    padding: const EdgeInsets.all(16),
                    mainAxisSpacing: 16,
                    crossAxisSpacing: 16,
                    children: filteredRecipes
                        .map((recipe) => _buildRecipeCard(recipe))
                        .toList(),
                  ),
                ),
              ],
            ),
          ),
          _buildRecipeModal(),
        ],
      ),
    );
  }

  Widget _buildCategoryChip(String label) {
    return Container(
      margin: const EdgeInsets.only(right: 8),
      child: FilterChip(
        selected: selectedCategory == label,
        label: Text(
          label,
          style: TextStyle(
            color: selectedCategory == label ? Colors.white : Colors.black,
          ),
        ),
        backgroundColor: Colors.white,
        selectedColor: Colors.green,
        onSelected: (bool selected) {
          setState(() {
            selectedCategory = selected ? label : '';
          });
        },
      ),
    );
  }

  Widget _buildRecipeCard(Map<String, dynamic> recipe) {
    return Container(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(12),
        color: Colors.white,
        boxShadow: [
          BoxShadow(
            color: Colors.grey.withOpacity(0.2),
            spreadRadius: 1,
            blurRadius: 4,
            offset: const Offset(0, 2),
          ),
        ],
      ),
      clipBehavior: Clip.antiAlias,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          Expanded(
            flex: 3,
            child: Image.asset(
              recipe['image'],
              fit: BoxFit.cover,
            ),
          ),
          Expanded(
            flex: 2,
            child: Padding(
              padding: const EdgeInsets.all(8.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    recipe['name'],
                    style: TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.bold,
                      color: Colors.grey[800],
                    ),
                  ),
                  const SizedBox(height: 4),
                  Text(
                    recipe['country'],
                    style: TextStyle(
                      fontSize: 14,
                      color: Colors.grey[600],
                    ),
                  ),
                  const SizedBox(height: 8),
                  ElevatedButton(
                    onPressed: () {
                      setState(() {
                        showModal = true;
                      });
                    },
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.green,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(20),
                      ),
                    ),
                    child: const Text(
                      'View Recipe',
                      style: TextStyle(
                        color: Colors.white,
                        fontSize: 12,
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildRecipeModal() {
    return showModal
        ? Stack(
            children: [
              GestureDetector(
                onTap: () => setState(() => showModal = false),
                child: Container(
                  color: Colors.black.withOpacity(0.5),
                ),
              ),
              Center(
                child: Container(
                  margin: const EdgeInsets.symmetric(horizontal: 16),
                  padding: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Column(
                    mainAxisSize: MainAxisSize.min,
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          const Text(
                            'Recipe Details',
                            style: TextStyle(
                              fontSize: 20,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          IconButton(
                            icon: const Icon(Icons.close),
                            onPressed: () => setState(() => showModal = false),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),
              ),
            ],
          )
        : const SizedBox.shrink();
  }
}
