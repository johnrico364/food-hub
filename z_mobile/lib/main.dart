import 'package:flutter/material.dart';
import 'package:z_mobile/splash_screen.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:z_mobile/pages/bloc/recipes_bloc.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MultiBlocProvider(
      providers: [
        BlocProvider<RecipesBloc>(
          create: (context) => RecipesBloc(),
        ),
        // Add other BlocProviders if needed
      ],
      child: MaterialApp(
        theme: ThemeData(
          fontFamily: 'Poppins',
        ),
        home: const SplashScreen(),
      ),
    );
  }
}
