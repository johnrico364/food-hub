<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipesSeeder extends Seeder
{
  public function run()
  {
    DB::table('recipes')->insert([
      [
        'name' => 'Pork Adobo',
        'description' => 'Adobo is widely regarded as the unofficial national dish of the Philippines. This savory recipe typically uses chicken or pork braised in a mix of vinegar, soy sauce, garlic, and spices, resulting in a flavorful, tender meat with a dark, rich sauce. The unique balance of tangy and salty flavors makes it both hearty and comforting, embodying the essence of Filipino cuisine.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['pork belly', 'soy sauce', 'vinegar', 'crushed garlic', 'peppercorns', 'bay leaves', 'salt', 'water']),
        'country' => 'Philippines',
        'prep_time' => 60,
        'yt_link' => 'https://www.youtube.com/watch?v=OTGASYe7hQk',
        'image' => 'pork adobo.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Sinigang na Baboy',
        'description' => 'Sinigang na Baboy is a beloved Filipino sour soup that uses pork as its base, cooked with vegetables like radish, string beans, and eggplant. The key flavor comes from tamarind, which gives the soup its iconic sour taste, making it a warming dish that is perfect for colder days or for relieving the tropical heat. It’s considered a true comfort food that is both nourishing and refreshing.',
        'category' => json_encode(['Main course', 'Soups']),
        'ingredients' => json_encode(['pork belly', 'onion', 'tomatoes', 'radishes', 'eggplants', 'string beans', 'tamarind paste', 'salt', 'pepper', 'water']),
        'country' => 'Philippines',
        'prep_time' => 75,
        'yt_link' => 'https://www.youtube.com/watch?v=Vuk3wly8mxQ',
        'image' => 'sinigang na baboy.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Halo-Halo',
        'description' => 'Halo-Halo, meaning "mix-mix" in Filipino, is a vibrant and refreshing dessert. It’s made with a mix of shaved ice and milk, along with sweetened fruits, beans, and jellies. Topped with flan, purple yam paste, and sometimes a scoop of ice cream, this dessert is a favorite during hot Philippine summers. Its layers and colors make it a visual delight, and each spoonful offers a different texture and flavor.',
        'category' => json_encode(['Desserts']),
        'ingredients' => json_encode(['shaved ice', 'sweetened beans', 'nata de coco', 'sweetened jackfruit', 'sweetened banana', 'purple yam paste', 'ice cream', 'evaporated milk']),
        'country' => 'Philippines',
        'prep_time' => 15,
        'yt_link' => 'https://www.youtube.com/watch?v=QfP5Mk8I-co',
        'image' => 'halo-halo.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Lumpiang Shanghai',
        'description' => 'Lumpiang Shanghai, also known as Filipino spring rolls, are a popular appetizer often served at parties and family gatherings. These crunchy rolls are filled with a savory mixture of ground pork, finely chopped vegetables, and seasonings, wrapped in thin spring roll wrappers, then deep-fried to golden perfection. They’re usually served with a sweet and sour dipping sauce for an extra burst of flavor.',
        'category' => json_encode(['Appetizers', 'Snacks']),
        'ingredients' => json_encode(['ground pork', 'carrot', 'onion', 'garlic', 'egg', 'salt', 'pepper', 'spring roll wrappers', 'oil']),
        'country' => 'Philippines',
        'prep_time' => 45,
        'yt_link' => 'https://www.youtube.com/watch?v=san6M1fGoGw',
        'image' => 'lumpiang shanghai.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Pancit Canton',
        'description' => 'Pancit Canton is a classic Filipino stir-fried noodle dish, loved for its comforting flavors and versatility. Made with wheat noodles, vegetables, and a choice of protein like chicken, pork, or shrimp, Pancit Canton is seasoned with soy sauce and a hint of calamansi for a citrusy twist. This dish is commonly served during birthdays and celebrations as it symbolizes long life and prosperity.',
        'category' => json_encode(['Main course', 'Pasta']),
        'ingredients' => json_encode(['pancit canton noodles', 'chicken breast', 'shrimp', 'cabbage', 'carrot', 'onion', 'garlic', 'soy sauce', 'oyster sauce', 'salt', 'pepper']),
        'country' => 'Philippines',
        'prep_time' => 30,
        'yt_link' => 'https://www.youtube.com/watch?v=9UEv8VlLDOc',
        'image' => 'pancit canton.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Kare-Kare',
        'description' => 'Kare-Kare is a Filipino stew known for its thick, peanut-based sauce. Traditionally made with oxtail, tripe, and vegetables like eggplant, string beans, and banana blossoms, Kare-Kare is slow-cooked to tender perfection. The creamy, nutty sauce pairs well with bagoong (fermented shrimp paste), which adds a unique salty contrast to the dish’s rich flavors.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['oxtail', 'peanut butter', 'ground toasted rice', 'eggplant', 'string beans', 'banana blossoms', 'onion', 'salt', 'pepper', 'bagoong']),
        'country' => 'Philippines',
        'prep_time' => 120,
        'yt_link' => 'https://www.youtube.com/watch?v=UVQrw4eNWOs',
        'image' => 'kare kare.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Bibingka',
        'description' => 'Bibingka is a traditional Filipino rice cake, typically enjoyed during the holiday season, especially around Christmas. Made from rice flour, coconut milk, and sugar, this fluffy cake is often baked with banana leaves for an added earthy aroma. Topped with salted eggs and cheese, Bibingka is a delicious blend of sweet and savory flavors, with a soft and moist texture that melts in your mouth.',
        'category' => json_encode(['Desserts', 'Baked']),
        'ingredients' => json_encode(['rice flour', 'coconut milk', 'sugar', 'eggs', 'baking powder', 'banana leaves', 'salted egg slices', 'grated cheese']),
        'country' => 'Philippines',
        'prep_time' => 45,
        'yt_link' => 'https://www.youtube.com/watch?v=uJKaKI0s2Vw',
        'image' => 'bibingka.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Arroz Caldo',
        'description' => 'Arroz Caldo is a Filipino rice porridge that combines rice, chicken, and ginger, cooked slowly to achieve a creamy texture. This comforting dish is often garnished with fried garlic, scallions, and a squeeze of calamansi for added flavor. Known as a go-to remedy for colds, it’s a warm and soothing meal that’s commonly enjoyed as breakfast or merienda (afternoon snack).',
        'category' => json_encode(['Breakfast', 'Soups']),
        'ingredients' => json_encode(['glutinous rice', 'chicken', 'onion', 'garlic', 'ginger', 'chicken broth', 'salt', 'pepper', 'scallions', 'fried garlic']),
        'country' => 'Philippines',
        'prep_time' => 60,
        'yt_link' => 'https://www.youtube.com/watch?v=CGCaBQGKMXM',
        'image' => 'arroz caldo.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Buko Pandan Salad',
        'description' => 'Buko Pandan Salad is a delightful Filipino dessert made with young coconut strips and pandan-flavored gelatin. Combined with sweetened cream and condensed milk, this creamy salad is chilled to perfection and served as a refreshing dessert, especially during festive gatherings and special occasions. The pandan gives it a distinct aroma and a bright green color, making it visually appealing and irresistibly tasty.',
        'category' => json_encode(['Desserts', 'Salads']),
        'ingredients' => json_encode(['young coconut strips', 'pandan-flavored gelatin', 'condensed milk', 'heavy cream', 'grated cheese']),
        'country' => 'Philippines',
        'prep_time' => 30,
        'yt_link' => 'https://www.youtube.com/watch?v=m2ol9IihZM8',
        'image' => 'buko pandan.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Turon',
        'description' => 'Turon is a popular Filipino snack made from ripe banana slices and jackfruit wrapped in spring roll wrappers, then deep-fried to a golden crisp. Often coated in caramelized sugar, this treat is loved for its crunchy texture and sweet, fruity filling. Turon is commonly sold as street food in the Philippines and is enjoyed by people of all ages.',
        'category' => json_encode(['Snacks', 'Desserts']),
        'ingredients' => json_encode(['saba bananas', 'jackfruit', 'spring roll wrappers', 'brown sugar', 'oil']),
        'country' => 'Philippines',
        'prep_time' => 20,
        'yt_link' => 'https://www.youtube.com/watch?v=16np55dhV-0',
        'image' => 'turon.jpeg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Chicken Inasal',
        'description' => 'Chicken Inasal is a famous grilled chicken dish from Bacolod, Philippines. Marinated in a mix of calamansi, vinegar, garlic, and lemongrass, it’s then grilled and basted with annatto oil, giving it a vibrant color and a smoky, savory flavor. Served with rice and dipping sauce, Chicken Inasal is loved for its tangy and mildly sweet taste.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['chicken thighs', 'calamansi juice', 'vinegar', 'garlic', 'lemongrass', 'annatto oil', 'salt', 'pepper']),
        'country' => 'Philippines',
        'prep_time' => 90,
        'yt_link' => 'https://www.youtube.com/watch?v=Y6Ixbef7iRc',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Laing',
        'description' => 'Laing is a flavorful dish from the Bicol region, known for its rich and spicy coconut sauce. Made with dried taro leaves cooked in coconut milk, chilies, and shrimp paste, Laing is often served as a side or main dish, and is loved for its creamy, slightly spicy taste. It’s best enjoyed with rice to balance the bold flavors.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['dried taro leaves', 'coconut milk', 'shrimp paste', 'garlic', 'ginger', 'onion', 'green chilies', 'salt']),
        'country' => 'Philippines',
        'prep_time' => 60,
        'yt_link' => 'https://www.youtube.com/watch?v=y9k09vX44tA',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Taho',
        'description' => 'Taho is a popular Filipino snack or breakfast item made with soft tofu, arnibal (sweet syrup from brown sugar and vanilla), and sago pearls. Served warm in cups, it’s a comforting, sweet treat often sold by street vendors. The combination of silky tofu and caramel-like syrup makes it a nostalgic favorite for many Filipinos.',
        'category' => json_encode(['Breakfast', 'Desserts']),
        'ingredients' => json_encode(['soft tofu', 'brown sugar', 'water', 'vanilla extract', 'sago pearls']),
        'country' => 'Philippines',
        'prep_time' => 20,
        'yt_link' => 'https://www.youtube.com/watch?v=0Q1q0V3f08A',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Chicken Adobo',
        'description' => 'Adobo is widely regarded as the unofficial national dish of the Philippines. This savory recipe typically uses chicken or pork braised in a mix of vinegar, soy sauce, garlic, and spices, resulting in a flavorful, tender meat with a dark, rich sauce. The unique balance of tangy and salty flavors makes it both hearty and comforting, embodying the essence of Filipino cuisine.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['chicken', 'onion', 'brown sugar', 'soy sauce', 'vinegar', 'crushed garlic', 'peppercorns', 'bay leaves', 'salt', 'water']),
        'country' => 'Philippines',
        'prep_time' => 60,
        'yt_link' => 'https://www.youtube.com/watch?v=e0Yjljw2awA',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Pinakbet',
        'description' => 'Pinakbet is a traditional vegetable stew from the Ilocos region, made with a mix of fresh vegetables like bitter melon, squash, eggplant, and okra. It’s cooked with shrimp paste, which enhances its savory, umami flavor. Pinakbet is typically served as a side dish and is loved for its health benefits and hearty taste.',
        'category' => json_encode(['Main course', 'Appetizers']),
        'ingredients' => json_encode(['bitter melon', 'pork belly', 'squash', 'eggplant', 'okra', 'tomatoes', 'onion', 'garlic', 'shrimp paste', 'salt']),
        'country' => 'Philippines',
        'prep_time' => 40,
        'yt_link' => 'https://www.youtube.com/watch?v=ZTm1LJwNsMg',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Champorado',
        'description' => 'Champorado is a comforting chocolate rice porridge that is enjoyed as breakfast or a snack in the Philippines. Made with glutinous rice and cocoa powder, it’s sweet, creamy, and often topped with condensed milk. Traditionally, it’s also served with salty dried fish (tuyo) on the side, balancing the sweet and salty flavors perfectly.',
        'category' => json_encode(['Breakfast', 'Desserts']),
        'ingredients' => json_encode(['glutinous rice', 'cocoa powder', 'sugar', 'water', 'condensed milk', 'salt']),
        'country' => 'Philippines',
        'prep_time' => 30,
        'yt_link' => 'https://www.youtube.com/watch?v=OKn6DUERXLs',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Spaghetti Carbonara',
        'description' => 'Spaghetti Carbonara is a classic Italian pasta dish from Rome. Made with eggs, cheese, pancetta, and pepper, this creamy and savory pasta is easy to make and deeply satisfying. It is traditionally made without cream, relying on the eggs and cheese to create a silky sauce that coats the noodles perfectly.',
        'category' => json_encode(['Pasta']),
        'ingredients' => json_encode(['spaghetti', 'eggs', 'pancetta', 'guanciale', 'parmesan cheese', 'black pepper', 'salt']),
        'country' => 'Italy',
        'prep_time' => 25,
        'yt_link' => 'https://www.youtube.com/watch?v=0NX_Y6HjBZI',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Pad Thai',
        'description' => 'Pad Thai is a popular stir-fried noodle dish from Thailand. Made with rice noodles, shrimp, tofu, peanuts, scrambled eggs, and bean sprouts, Pad Thai has a balanced flavor of sweet, sour, and salty, thanks to tamarind paste, fish sauce, and a hint of sugar.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['rice noodles', 'shrimp', 'tofu', 'eggs', 'bean sprouts', 'peanuts', 'green onions', 'tamarind paste', 'fish sauce', 'sugar']),
        'country' => 'Thailand',
        'prep_time' => 30,
        'yt_link' => 'https://www.youtube.com/watch?v=b7YnoRFuZ9o',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Chicken Tikka Masala',
        'description' => 'Chicken Tikka Masala is a beloved Indian-inspired dish featuring grilled chicken chunks in a rich, creamy tomato sauce. It’s spiced with garam masala, cumin, and coriander, creating a comforting dish with complex flavors that is best enjoyed with naan or rice.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['chicken breast', 'yogurt', 'garam masala', 'cumin', 'coriander', 'lemon juice', 'cream', 'garlic', 'ginger', 'red chilli', 'oil']),
        'country' => 'India',
        'prep_time' => 45,
        'yt_link' => 'https://www.youtube.com/watch?v=BOKdsepCrbc',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Tacos al Pastor',
        'description' => 'Tacos al Pastor is a popular Mexican street food made with marinated pork cooked on a vertical spit. The pork is flavored with a blend of chilies, spices, and pineapple, giving it a tangy-sweet flavor. Served on small corn tortillas and topped with onions, cilantro, and salsa.',
        'category' => json_encode(['Main course', 'Snacks']),
        'ingredients' => json_encode(['pork shoulder', 'dried chiles', 'pineapple', 'vinegar', 'onion', 'cilantro', 'corn tortillas']),
        'country' => 'Mexico',
        'prep_time' => 180,
        'yt_link' => 'https://www.youtube.com/watch?v=4ZJIzEeqAFw',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Sushi',
        'description' => 'Sushi is a traditional Japanese dish made with vinegared rice, raw fish, and vegetables. It is often accompanied by soy sauce, wasabi, and pickled ginger. Popular types include nigiri, sashimi, and maki rolls, making sushi a versatile and popular meal worldwide.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['sushi rice', 'raw fish', 'nori', 'cucumber', 'avocado', 'soy sauce', 'wasabi']),
        'country' => 'Japan',
        'prep_time' => 60,
        'yt_link' => 'https://www.youtube.com/watch?v=nIoOv6lWYnk',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Beef Bourguignon',
        'description' => 'Beef Bourguignon is a classic French stew featuring beef braised in red wine, with onions, mushrooms, and bacon. The slow cooking results in tender meat and a rich, flavorful sauce. Often served with mashed potatoes or crusty bread, it’s a comforting dish perfect for chilly days.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['beef chuck', 'red wine', 'onion', 'carrot', 'mushrooms', 'bacon', 'garlic', 'thyme']),
        'country' => 'France',
        'prep_time' => 180,
        'yt_link' => 'https://www.youtube.com/watch?v=_Bx9P32tdaM',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Falafel',
        'description' => 'Falafel is a popular Middle Eastern street food made from ground chickpeas or fava beans, mixed with herbs and spices, then fried to crispy perfection. It’s typically served in pita bread with fresh vegetables and tahini sauce, making it a flavorful and satisfying vegetarian dish.',
        'category' => json_encode(['Snacks', 'Appetizers']),
        'ingredients' => json_encode(['chickpeas', 'parsley', 'cilantro', 'onion', 'garlic', 'cumin', 'coriander', 'salt', 'oil']),
        'country' => 'Middle East',
        'prep_time' => 30,
        'yt_link' => 'https://www.youtube.com/watch?v=NZcWedPKysk',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Kimchi',
        'description' => 'Kimchi is a traditional Korean side dish made from fermented vegetables, most commonly napa cabbage and radishes, seasoned with chili powder, garlic, ginger, and fish sauce. Known for its tangy and spicy flavor, Kimchi is packed with probiotics and is a staple in Korean cuisine. (1 day for fermentation)',
        'category' => json_encode(['Appetizers']),
        'ingredients' => json_encode(['napa cabbage', 'salt', 'gochugaru (Korean chili powder)', 'garlic', 'ginger', 'scallions', 'fish sauce']),
        'country' => 'South Korea',
        'prep_time' => 10,
        'yt_link' => 'https://www.youtube.com/watch?v=FpYtCQDCcsc',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Paella',
        'description' => 'Paella is a famous Spanish rice dish originally from Valencia, made with saffron-infused rice, vegetables, and a mix of meats like chicken, rabbit, and seafood. It’s cooked in a large shallow pan, creating a crispy crust on the bottom called socarrat, making it a unique and flavorful dish.',
        'category' => json_encode(['Main course', 'Seafood']),
        'ingredients' => json_encode(['short-grain rice', 'chicken', 'rabbit', 'shrimp', 'mussels', 'saffron', 'tomatoes', 'green beans', 'paprika']),
        'country' => 'Spain',
        'prep_time' => 90,
        'yt_link' => 'https://www.youtube.com/watch?v=vaTscmbOmf4',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Baklava',
        'description' => 'Baklava is a rich, sweet dessert pastry made of layers of filo filled with chopped nuts and sweetened with syrup or honey. Originating from the Ottoman Empire and popular throughout the Middle East and Balkans, Baklava has a unique crispy and flaky texture with a luscious filling and aromatic sweetness.',
        'category' => json_encode(['Desserts', 'Baked']),
        'ingredients' => json_encode(['phyllo dough', 'walnuts', 'pistachios', 'butter', 'sugar', 'honey', 'cinnamon']),
        'country' => 'Turkey',
        'prep_time' => 120,
        'yt_link' => 'https://www.youtube.com/watch?v=uxJe1cEr1Ts',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Tom Yum Goong',
        'description' => 'Tom Yum Goong is a hot and sour Thai soup known for its bold, aromatic flavors. Made with shrimp, lemongrass, kaffir lime leaves, galangal, and chilies, this soup has a balance of tangy, spicy, and slightly sweet flavors. It’s a favorite in Thai cuisine and perfect for a warming, flavorful meal.',
        'category' => json_encode(['Soups', 'Main course']),
        'ingredients' => json_encode(['shrimp', 'lemongrass', 'kaffir lime leaves', 'galangal', 'chilies', 'mushrooms', 'fish sauce', 'lime']),
        'country' => 'Thailand',
        'prep_time' => 25,
        'yt_link' => 'https://www.youtube.com/watch?v=hhcYNjeQ_XY',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Risotto alla Milanese',
        'description' => 'Risotto alla Milanese is a traditional Italian risotto dish from Milan, featuring creamy Arborio rice cooked in a broth with saffron. The saffron gives it a distinct yellow color and a subtle, earthy flavor. Finished with Parmesan cheese, it’s a luxurious and creamy side or main dish.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['Arborio rice', 'saffron', 'butter', 'onion', 'chicken broth', 'white wine', 'Parmesan cheese']),
        'country' => 'Italy',
        'prep_time' => 40,
        'yt_link' => 'https://www.youtube.com/watch?v=h_jD0KEJL8s',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Pad Krapow Moo Saap',
        'description' => 'Pad Krapow Moo Saap, or Thai Basil Pork, is a savory stir-fry dish from Thailand. Ground pork is stir-fried with garlic, Thai chilies, and holy basil, seasoned with fish sauce and soy sauce. Often served over rice and topped with a fried egg, this dish is a spicy, fragrant delight.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['ground pork', 'garlic', 'Thai basil', 'chilies', 'fish sauce', 'soy sauce', 'sugar', 'oil']),
        'country' => 'Thailand',
        'prep_time' => 20,
        'yt_link' => 'https://www.youtube.com/watch?v=xG_jL8luhF0',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Margherita Pizza',
        'description' => 'Margherita Pizza is a classic Italian pizza topped simply with fresh tomatoes, mozzarella, and basil. It’s baked until the crust is crispy and the cheese is melted. Known for its fresh and simple flavors, Margherita Pizza is a staple of Italian cuisine and a favorite worldwide.',
        'category' => json_encode(['Main course', 'Snacks']),
        'ingredients' => json_encode(['pizza dough', 'tomato sauce', 'mozzarella cheese', 'fresh basil', 'olive oil', 'salt']),
        'country' => 'Italy',
        'prep_time' => 15,
        'yt_link' => 'https://www.youtube.com/watch?v=xKDnD8sJsuY',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Green Curry',
        'description' => 'Green Curry, or Gaeng Keow Wan, is a creamy and spicy Thai curry made with green curry paste, coconut milk, and vegetables like eggplant. Often cooked with chicken or beef, it’s known for its bright green color and bold flavors, typically served with jasmine rice.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['green curry paste', 'coconut milk', 'chicken', 'eggplant', 'bamboo shoots', 'Thai basil', 'fish sauce']),
        'country' => 'Thailand',
        'prep_time' => 30,
        'yt_link' => 'https://www.youtube.com/watch?v=rTK8MWYYLko',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Bolognese Sauce',
        'description' => 'Bolognese Sauce is a hearty Italian meat sauce made with ground beef, pork, tomatoes, and aromatic vegetables. Simmered slowly, it has a rich, meaty flavor and is typically served with pasta, especially tagliatelle or fettuccine. It’s a comforting and classic Italian meal.',
        'category' => json_encode(['Pasta', 'Main course']),
        'ingredients' => json_encode(['ground beef', 'ground pork', 'onion', 'carrot', 'celery', 'tomato paste', 'red wine', 'milk', 'olive oil']),
        'country' => 'Italy',
        'prep_time' => 90,
        'yt_link' => 'https://www.youtube.com/watch?v=Gyz7s3cFjZU',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Thai Mango Sticky Rice',
        'description' => 'Mango Sticky Rice is a traditional Thai dessert featuring sweet sticky rice served with ripe mango slices. The rice is cooked in coconut milk and sugar, giving it a rich, creamy flavor. This dish is beloved for its contrast of sweet, juicy mango and chewy rice.',
        'category' => json_encode(['Desserts']),
        'ingredients' => json_encode(['sticky rice', 'coconut milk', 'sugar', 'salt', 'ripe mango']),
        'country' => 'Thailand',
        'prep_time' => 45,
        'yt_link' => 'https://www.youtube.com/watch?v=Gf7-yDNX2nY',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Osso Buco',
        'description' => 'Osso Buco is a hearty Italian dish made with braised veal shanks cooked in wine and broth with vegetables. Traditionally served with gremolata (a mixture of lemon zest, garlic, and parsley), this Milanese specialty has a deep, flavorful sauce and is a perfect comfort meal.',
        'category' => json_encode(['Main course']),
        'ingredients' => json_encode(['veal shanks', 'carrot', 'celery', 'onion', 'white wine', 'beef broth', 'garlic', 'lemon zest']),
        'country' => 'Italy',
        'prep_time' => 120,
        'yt_link' => 'https://www.youtube.com/watch?v=EXrG445Ruuw',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Thai Papaya Salad (Som Tum)',
        'description' => 'Som Tum, or Thai Papaya Salad, is a refreshing and spicy salad made with shredded green papaya, tomatoes, peanuts, and chilies. Dressed with fish sauce, lime juice, and a bit of sugar, it offers a balance of sweet, sour, and spicy flavors. It’s popular as a side or a light meal in Thailand.',
        'category' => json_encode(['Salads', 'Appetizers']),
        'ingredients' => json_encode(['green papaya', 'tomatoes', 'chilies', 'peanuts', 'lime juice', 'fish sauce', 'palm sugar', 'green beans']),
        'country' => 'Thailand',
        'prep_time' => 15,
        'yt_link' => 'https://www.youtube.com/watch?v=Re6bkPQq2BA',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Panna Cotta',
        'description' => 'Panna Cotta is a creamy, delicate Italian dessert made from sweetened cream thickened with gelatin. Often flavored with vanilla and served with a fruit compote or caramel sauce, this dessert has a smooth, melt-in-your-mouth texture. It’s light and elegant, perfect for any occasion.',
        'category' => json_encode(['Desserts']),
        'ingredients' => json_encode(['heavy cream', 'sugar', 'vanilla extract', 'gelatin', 'strawberries or berries for topping']),
        'country' => 'Italy',
        'prep_time' => 20,
        'yt_link' => 'https://www.youtube.com/watch?v=VVbtSlEJ5eY',
        'image' => 'default.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}