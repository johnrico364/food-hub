import 'dart:convert';
import 'package:flutter/material.dart';

class RecipeDetailPage extends StatelessWidget {
  final Map<String, dynamic> recipe;

  const RecipeDetailPage({Key? key, required this.recipe}) : super(key: key);

  List<String> _parseIngredients(String ingredientsString) {
    try {
      // Remove any extra whitespace and convert single quotes to double quotes if present
      String cleanedString = ingredientsString.trim().replaceAll("'", '"');
      // Parse the JSON string to List
      List<dynamic> parsed = json.decode(cleanedString);
      // Convert to List<String>
      return parsed.map((e) => e.toString()).toList();
    } catch (e) {
      print('Error parsing ingredients: $e');
      return [];
    }
  }

  @override
  Widget build(BuildContext context) {
    final ingredients = _parseIngredients(recipe['ingredients']);

    return Scaffold(
      appBar: AppBar(
        title: Text(recipe['name']),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Image.asset(
                recipe['image'],
                fit: BoxFit.cover,
                width: double.infinity,
                height: 300,
              ),
              const SizedBox(height: 12),
              Text(
                recipe['name'],
                style: const TextStyle(
                  fontSize: 22,
                  fontWeight: FontWeight.bold,
                ),
              ),
              Text(
                recipe['country'],
                style: const TextStyle(
                  fontSize: 14,
                ),
              ),
              const SizedBox(height: 20),
              Row(
                children: [
                  const Icon(Icons.timer_outlined, size: 16),
                  const SizedBox(width: 4),
                  Text(
                    '${recipe['prep_time']} minutes',
                    style: const TextStyle(fontSize: 14),
                  ),
                  const SizedBox(width: 24),
                  const Icon(Icons.restaurant_menu_outlined, size: 16),
                  const SizedBox(width: 4),
                  Text(
                    '${ingredients.length} ingredients',
                    style: const TextStyle(fontSize: 14),
                  ),
                ],
              ),
              const SizedBox(height: 15),
              const Divider(height: 1, thickness: 2),
              const SizedBox(height: 20),
              Text(
                recipe['description'],
                style: const TextStyle(fontSize: 14),
              ),
              const SizedBox(height: 20),
              const Text(
                'Ingredients:',
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const SizedBox(height: 8),
              ...ingredients.map((ingredient) => Padding(
                padding: const EdgeInsets.symmetric(vertical: 4),
                child: Row(
                  children: [
                    const Icon(Icons.circle, size: 8),
                    const SizedBox(width: 8),
                    Text(
                      ingredient,
                      style: const TextStyle(fontSize: 14),
                    ),
                  ],
                ),
              )).toList(),
              // Add more details as needed
            ],
          ),
        ),
      ),
    );
  }
}
