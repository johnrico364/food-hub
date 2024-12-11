import 'package:flutter/material.dart';
import 'package:z_mobile/pages/countrypage.dart/countrypage.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  bool showModal = false;
  String selectedCategory = ''; // Track selected category

  // Sample recipe data with categories
  final List<Map<String, dynamic>> recipes = [
    {
      'name': 'Chocolate Cake',
      'category': 'Dessert',
      'image': 'assets/images/ingredients/Egg.jpg',
    },
    {
      'name': 'Chicken Soup',
      'category': 'Soups',
      'image': 'assets/images/ingredients/pork belly.jpg',
    },
    {
      'name': 'Pancakes',
      'category': 'Breakfast',
      'image': 'assets/images/ingredients/Egg.jpg',
    },
    {
      'name': 'Adobo',
      'category': 'Meat',
      'image': 'assets/images/ingredients/pork belly.jpg',
    },
    // Add more recipes as needed
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
              leading: const Icon(Icons.favorite),
              title: const Text('Country'),
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => const CountryPage()),
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
                      _buildCategoryChip('Dessert'),
                      _buildCategoryChip('Meat'),
                      _buildCategoryChip('Soups'),
                      _buildCategoryChip('Breakfast'),
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
                      'Show Recipe',
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
              // Modal backdrop
              GestureDetector(
                onTap: () => setState(() => showModal = false),
                child: Container(
                  color: Colors.black.withOpacity(0.5),
                ),
              ),
              // Modal content
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
                            'Adobo Sinigang Ala Kare-kare',
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
                      const Text('Philippines'),
                      const SizedBox(height: 8),
                      const Row(
                        children: [
                          Icon(Icons.timer, size: 16),
                          SizedBox(width: 4),
                          Text('15 Mins'),
                          SizedBox(width: 16),
                          Icon(Icons.restaurant, size: 16),
                          SizedBox(width: 4),
                          Text('21 Ingredients'),
                        ],
                      ),
                      const SizedBox(height: 16),
                      const Text(
                        'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
                        style: TextStyle(fontSize: 14),
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
