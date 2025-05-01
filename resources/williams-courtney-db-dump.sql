-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2025 at 02:41 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amqcapmy_grandmas_pantry`
--
DROP DATABASE IF EXISTS `amqcapmy_grandmas_pantry`;
CREATE DATABASE IF NOT EXISTS `amqcapmy_grandmas_pantry` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `amqcapmy_grandmas_pantry`;

-- --------------------------------------------------------

--
-- Table structure for table `cook_times`
--

CREATE TABLE `cook_times` (
  `cook_time_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `time_seconds` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cook_times`
--

INSERT INTO `cook_times` (`cook_time_id`, `recipe_id`, `time_seconds`) VALUES
(1, 1, 900),
(2, 2, 1200),
(3, 3, 900),
(4, 4, 7200),
(5, 5, 900),
(6, 6, 1800),
(7, 7, 3600),
(8, 8, 0),
(9, 9, 2700),
(10, 10, 900),
(11, 11, 600),
(12, 12, 1500),
(13, 13, 0),
(14, 14, 600),
(15, 15, 1500),
(16, 16, 1800),
(17, 17, 7200),
(18, 18, 900),
(19, 19, 1200),
(20, 20, 900),
(21, 21, 1800),
(22, 22, 900),
(23, 23, 2700),
(24, 24, 1800),
(25, 25, 2700),
(31, 31, 1200),
(32, 32, 900),
(33, 33, 1200),
(34, 34, 600),
(35, 35, 1800),
(36, 36, 900),
(37, 37, 1800),
(38, 38, 900),
(39, 39, 1200),
(40, 40, 1800);

-- --------------------------------------------------------

--
-- Table structure for table `diet_types`
--

CREATE TABLE `diet_types` (
  `diet_type_id` int(11) NOT NULL,
  `diet_type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diet_types`
--

INSERT INTO `diet_types` (`diet_type_id`, `diet_type_name`) VALUES
(3, 'Gluten-Free'),
(7, 'Paleo'),
(5, 'Raw'),
(6, 'Sugar-Free'),
(1, 'Vegan'),
(2, 'Vegetarian'),
(4, 'Whole Food');

-- --------------------------------------------------------

--
-- Table structure for table `directions`
--

CREATE TABLE `directions` (
  `direction_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `step_number` smallint(6) NOT NULL,
  `instruction` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `directions`
--

INSERT INTO `directions` (`direction_id`, `recipe_id`, `step_number`, `instruction`) VALUES
(1, 1, 1, 'Boil pasta until al dente.'),
(2, 1, 2, 'Cook pancetta until crispy.'),
(3, 1, 3, 'Whisk eggs with Parmesan cheese.'),
(4, 1, 4, 'Drain pasta and mix quickly with egg mixture.'),
(5, 1, 5, 'Stir in pancetta and season with black pepper.'),
(6, 2, 1, 'Cook fettuccine pasta and drain.'),
(7, 2, 2, 'Sauté chicken pieces until cooked through.'),
(8, 2, 3, 'Melt butter and stir in garlic and cream.'),
(9, 2, 4, 'Add Parmesan cheese to form sauce.'),
(10, 2, 5, 'Toss pasta and chicken in sauce until coated.'),
(11, 3, 1, 'Heat tortillas in a pan.'),
(12, 3, 2, 'Sauté black beans, corn, and bell peppers.'),
(13, 3, 3, 'Mash avocado with lime juice.'),
(14, 3, 4, 'Fill tortillas with vegetables and avocado.'),
(15, 3, 5, 'Top with salsa and fresh cilantro.'),
(16, 4, 1, 'Brown beef cubes in a large pot.'),
(17, 4, 2, 'Add chopped onions, carrots, and celery.'),
(18, 4, 3, 'Pour in beef broth and add herbs.'),
(19, 4, 4, 'Simmer covered for 2 hours.'),
(20, 4, 5, 'Add potatoes and cook until tender.'),
(21, 5, 1, 'Preheat grill and oil the grates.'),
(22, 5, 2, 'Season salmon fillets with salt and pepper.'),
(23, 5, 3, 'Grill salmon skin-side down for 5–6 minutes.'),
(24, 5, 4, 'Flip and cook another 2–3 minutes.'),
(25, 5, 5, 'Serve with lemon wedges.'),
(26, 6, 1, 'Slice and salt eggplant, let sit.'),
(27, 6, 2, 'Bread slices and fry until golden.'),
(28, 6, 3, 'Layer eggplant, marinara, and cheese in a dish.'),
(29, 6, 4, 'Bake at 375°F for 25 minutes.'),
(30, 6, 5, 'Garnish with basil and serve.'),
(31, 7, 1, 'Prepare pie crust and chill.'),
(32, 7, 2, 'Slice apples and toss with sugar and spices.'),
(33, 7, 3, 'Fill crust with apple mixture.'),
(34, 7, 4, 'Cover with top crust and seal edges.'),
(35, 7, 5, 'Bake at 375°F for 45 minutes.'),
(36, 8, 1, 'Wash and chop romaine lettuce.'),
(37, 8, 2, 'Make dressing with garlic, lemon, and anchovies.'),
(38, 8, 3, 'Toss lettuce with dressing and croutons.'),
(39, 8, 4, 'Add shaved Parmesan on top.'),
(40, 8, 5, 'Serve immediately.'),
(41, 9, 1, 'Preheat oven to 350°F and grease pans.'),
(42, 9, 2, 'Mix dry and wet ingredients separately.'),
(43, 9, 3, 'Combine and pour into pans.'),
(44, 9, 4, 'Bake for 30–35 minutes.'),
(45, 9, 5, 'Cool and frost as desired.'),
(46, 10, 1, 'Chop all vegetables into bite-sized pieces.'),
(47, 10, 2, 'Heat oil in wok and add garlic.'),
(48, 10, 3, 'Stir-fry vegetables until crisp-tender.'),
(49, 10, 4, 'Add soy sauce and toss to coat.'),
(50, 10, 5, 'Serve with rice or noodles.'),
(51, 11, 1, 'Mix corn, mayonnaise, and sugar in a bowl.'),
(52, 11, 2, 'Spread mixture into a skillet.'),
(53, 11, 3, 'Top generously with mozzarella cheese.'),
(54, 11, 4, 'Cook until cheese melts and bubbles.'),
(55, 11, 5, 'Garnish with chopped parsley.'),
(56, 12, 1, 'Season chicken and coat in flour.'),
(57, 12, 2, 'Deep fry chicken until crispy.'),
(58, 12, 3, 'Melt butter, honey, and hot sauce together.'),
(59, 12, 4, 'Toss fried chicken in spicy honey butter sauce.'),
(60, 12, 5, 'Serve hot and garnish with sesame seeds.'),
(61, 13, 1, 'Boil eggs until fully cooked.'),
(62, 13, 2, 'Mash eggs with Japanese mayo and seasoning.'),
(63, 13, 3, 'Spread egg salad between slices of milk bread.'),
(64, 13, 4, 'Trim crusts and cut sandwich into halves.'),
(65, 13, 5, 'Serve chilled or room temperature.'),
(66, 14, 1, 'Slice croissants and lightly toast them.'),
(67, 14, 2, 'Top each croissant half with smoked salmon.'),
(68, 14, 3, 'Poach eggs and place on top of salmon.'),
(69, 14, 4, 'Drizzle hollandaise sauce over eggs.'),
(70, 14, 5, 'Garnish with dill and serve.'),
(71, 15, 1, 'Marinate chicken with lemongrass, garlic, and fish sauce.'),
(72, 15, 2, 'Heat oil and sear chicken until browned.'),
(73, 15, 3, 'Lower heat and cook through.'),
(74, 15, 4, 'Glaze chicken with remaining marinade.'),
(75, 15, 5, 'Serve with jasmine rice.'),
(76, 16, 1, 'Sauté mushrooms and onions in butter.'),
(77, 16, 2, 'Add arborio rice and toast lightly.'),
(78, 16, 3, 'Gradually add warm broth while stirring.'),
(79, 16, 4, 'Stir in Parmesan and truffle oil.'),
(80, 16, 5, 'Serve creamy and hot.'),
(81, 17, 1, 'Season and sear short ribs.'),
(82, 17, 2, 'Braise ribs in red wine and broth until tender.'),
(83, 17, 3, 'Shred meat and set aside.'),
(84, 17, 4, 'Boil gnocchi until they float.'),
(85, 17, 5, 'Toss gnocchi with short rib sauce.'),
(86, 18, 1, 'Season shrimp with Cajun spices.'),
(87, 18, 2, 'Cook shrimp quickly in a hot pan.'),
(88, 18, 3, 'Cook grits until creamy.'),
(89, 18, 4, 'Top grits with shrimp and drizzle with butter sauce.'),
(90, 18, 5, 'Garnish with green onions.'),
(91, 19, 1, 'Crisp Peking duck skin and shred meat.'),
(92, 19, 2, 'Warm small tortillas.'),
(93, 19, 3, 'Spread hoisin sauce on tortillas.'),
(94, 19, 4, 'Add duck meat, cucumbers, and scallions.'),
(95, 19, 5, 'Fold and serve.'),
(101, 20, 1, 'Thinly slice and fry zucchini until golden.'),
(102, 20, 2, 'Boil spaghetti until al dente.'),
(103, 20, 3, 'Blend half zucchini with Parmesan to make sauce.'),
(104, 20, 4, 'Toss pasta with sauce and remaining zucchini.'),
(105, 20, 5, 'Serve with extra cheese and basil.'),
(106, 21, 1, 'Bloom gelatin in cold water.'),
(107, 21, 2, 'Heat taro milk tea and sugar until warm.'),
(108, 21, 3, 'Stir in gelatin until dissolved.'),
(109, 21, 4, 'Pour into molds and chill until set.'),
(110, 21, 5, 'Serve cold with whipped cream.'),
(111, 22, 1, 'Melt dark chocolate with a pinch of chili powder.'),
(112, 22, 2, 'Whip cream to soft peaks.'),
(113, 22, 3, 'Fold melted chocolate into whipped cream gently.'),
(114, 22, 4, 'Chill mousse in the refrigerator.'),
(115, 22, 5, 'Garnish with shaved chocolate and serve.'),
(116, 23, 1, 'Cook grated carrots with milk and sugar until thick.'),
(117, 23, 2, 'Prepare cheesecake crust and filling.'),
(118, 23, 3, 'Layer carrot halwa on crust, then pour cheesecake batter.'),
(119, 23, 4, 'Bake until center is set.'),
(120, 23, 5, 'Chill before slicing.'),
(121, 24, 1, 'Dip Biscoff cookies in coffee.'),
(122, 24, 2, 'Layer cookies with mascarpone mixture.'),
(123, 24, 3, 'Repeat layers until ingredients are used up.'),
(124, 24, 4, 'Chill in the fridge overnight.'),
(125, 24, 5, 'Dust with cocoa powder before serving.'),
(126, 25, 1, 'Whip eggs and sugar until thick and pale.'),
(127, 25, 2, 'Fold in flour gently.'),
(128, 25, 3, 'Add honey and mix carefully.'),
(129, 25, 4, 'Pour into a lined square mold.'),
(130, 25, 5, 'Bake low and slow until golden.'),
(131, 26, 1, 'Mix almond flour, sugar, and butter.'),
(132, 26, 2, 'Press part of the mixture into a cake pan for crust.'),
(133, 26, 3, 'Add yogurt, eggs, and cardamom to remaining mix.'),
(134, 26, 4, 'Pour batter over crust and bake.'),
(135, 26, 5, 'Garnish with rose petals and pistachios.'),
(136, 27, 1, 'Mix glutinous rice flour with sugar and black sesame paste.'),
(137, 27, 2, 'Add milk and eggs to form batter.'),
(138, 27, 3, 'Pour batter into a greased pan.'),
(139, 27, 4, 'Bake until set but still chewy.'),
(140, 27, 5, 'Cool before cutting into squares.'),
(141, 28, 1, 'Tear bread into pieces and place in a baking dish.'),
(142, 28, 2, 'Mix eggs, milk, sugar, and a touch of miso.'),
(143, 28, 3, 'Pour custard over bread and soak.'),
(144, 28, 4, 'Bake until golden and set.'),
(145, 28, 5, 'Drizzle with caramel sauce.'),
(146, 29, 1, 'Bake tart shell until golden.'),
(147, 29, 2, 'Prepare passionfruit curd with eggs and butter.'),
(148, 29, 3, 'Fill tart shell with curd.'),
(149, 29, 4, 'Chill until firm.'),
(150, 29, 5, 'Garnish with tropical fruits.'),
(151, 30, 1, 'Prepare butterscotch-flavored cupcake batter.'),
(152, 30, 2, 'Bake cupcakes until a toothpick comes out clean.'),
(153, 30, 3, 'Make butterbeer frosting with butterscotch and whipped cream.'),
(154, 30, 4, 'Frost cooled cupcakes generously.'),
(155, 30, 5, 'Drizzle extra butterscotch sauce on top.'),
(156, 31, 1, 'Season chicken breasts with salt, pepper, and olive oil.'),
(157, 31, 2, 'Grill chicken until cooked through.'),
(158, 31, 3, 'Slice chicken into strips.'),
(159, 31, 4, 'Toss greens, tomatoes, and cucumbers together.'),
(160, 31, 5, 'Top salad with grilled chicken and dressing.'),
(166, 33, 1, 'Cook and slice chicken breast.'),
(167, 33, 2, 'Toss chicken with Caesar dressing and romaine lettuce.'),
(168, 33, 3, 'Warm tortillas slightly.'),
(169, 33, 4, 'Fill tortillas with chicken mixture.'),
(170, 33, 5, 'Wrap tightly and slice in half.'),
(171, 34, 1, 'Bread chicken breasts with flour, egg, and breadcrumbs.'),
(172, 34, 2, 'Bake chicken until golden.'),
(173, 34, 3, 'Top with marinara sauce and mozzarella cheese.'),
(174, 34, 4, 'Bake until cheese is melted.'),
(175, 34, 5, 'Serve hot with pasta.'),
(176, 35, 1, 'Season and cook chicken until tender.'),
(177, 35, 2, 'Shred the cooked chicken.'),
(178, 35, 3, 'Warm taco shells.'),
(179, 35, 4, 'Fill tacos with chicken and toppings.'),
(180, 35, 5, 'Serve with salsa and lime.'),
(181, 36, 1, 'Sear chicken pieces until golden.'),
(182, 36, 2, 'Remove chicken and sauté onions and garlic.'),
(183, 36, 3, 'Add rice, broth, and seasonings.'),
(184, 36, 4, 'Nestle chicken back into the pot.'),
(185, 36, 5, 'Simmer until rice is cooked and chicken is tender.'),
(186, 37, 1, 'Slice chicken and vegetables.'),
(187, 37, 2, 'Cook chicken in a hot wok.'),
(188, 37, 3, 'Add vegetables and stir-fry sauce.'),
(189, 37, 4, 'Cook until veggies are tender-crisp.'),
(190, 37, 5, 'Serve immediately with rice or noodles.'),
(191, 38, 1, 'Season wings with salt, pepper, and paprika.'),
(192, 38, 2, 'Bake or fry wings until crispy.'),
(193, 38, 3, 'Toss wings in spicy sauce.'),
(194, 38, 4, 'Bake a few more minutes to set sauce.'),
(195, 38, 5, 'Serve hot with ranch or blue cheese.'),
(196, 39, 1, 'Marinate chicken in lemon juice, herbs, and olive oil.'),
(197, 39, 2, 'Preheat grill to medium-high heat.'),
(198, 39, 3, 'Grill chicken until cooked through.'),
(199, 39, 4, 'Let chicken rest before slicing.'),
(200, 39, 5, 'Garnish with fresh herbs and lemon slices.'),
(201, 40, 1, 'Sauté onions, carrots, and celery in a large pot.'),
(202, 40, 2, 'Add chicken pieces and broth.'),
(203, 40, 3, 'Simmer until chicken is cooked and tender.'),
(204, 40, 4, 'Remove chicken, shred it, and return to pot.'),
(205, 40, 5, 'Season to taste and serve hot.'),
(206, 41, 1, 'Season chicken with salt, pepper, and paprika.'),
(207, 41, 2, 'Sear chicken in a pan until golden.'),
(208, 41, 3, 'Add lemon juice, garlic, and broth to the pan.'),
(209, 41, 4, 'Simmer until chicken is cooked through.'),
(210, 41, 5, 'Serve with extra sauce spooned on top.');

-- --------------------------------------------------------

--
-- Table structure for table `ethnic_types`
--

CREATE TABLE `ethnic_types` (
  `ethnic_type_id` int(11) NOT NULL,
  `ethnic_type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ethnic_types`
--

INSERT INTO `ethnic_types` (`ethnic_type_id`, `ethnic_type_name`) VALUES
(5, 'American'),
(12, 'Chinese'),
(2, 'Cuban'),
(4, 'Fusion'),
(1, 'Italian'),
(6, 'Mexican'),
(3, 'Thai');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_id` int(11) NOT NULL,
  `ingredient_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `ingredient_name`) VALUES
(1, 'chicken breast'),
(2, 'ground beef'),
(3, 'beef short ribs'),
(4, 'duck'),
(5, 'shrimp'),
(6, 'smoked salmon'),
(7, 'salmon fillet'),
(8, 'bacon'),
(9, 'eggs'),
(10, 'heavy cream'),
(11, 'milk'),
(12, 'parmesan cheese'),
(13, 'mozzarella cheese'),
(14, 'cream cheese'),
(15, 'butter'),
(16, 'truffle oil'),
(17, 'biscoff spread'),
(18, 'spaghetti'),
(19, 'gnocchi'),
(20, 'rice'),
(21, 'grits'),
(22, 'croissant'),
(23, 'bread'),
(24, 'garlic'),
(25, 'onion'),
(26, 'shallots'),
(27, 'carrots'),
(28, 'celery'),
(29, 'potatoes'),
(30, 'eggplant'),
(31, 'zucchini'),
(32, 'bell peppers'),
(33, 'mixed vegetables'),
(34, 'lettuce'),
(35, 'lemongrass'),
(36, 'mushrooms'),
(37, 'green onions'),
(38, 'apples'),
(39, 'lemon'),
(40, 'all-purpose flour'),
(41, 'sugar'),
(42, 'brown sugar'),
(43, 'baking powder'),
(44, 'baking soda'),
(45, 'cocoa powder'),
(46, 'chocolate'),
(47, 'vanilla extract'),
(48, 'honey'),
(49, 'yeast'),
(50, 'taro powder'),
(51, 'salt'),
(52, 'black pepper'),
(53, 'olive oil'),
(54, 'vegetable oil'),
(55, 'soy sauce'),
(56, 'fish sauce'),
(57, 'hoisin sauce'),
(58, 'gochujang'),
(59, 'cajun seasoning'),
(60, 'maple syrup'),
(61, 'honey butter'),
(62, 'vinegar'),
(63, 'cornstarch'),
(64, 'sweetened condensed milk'),
(65, 'tea');

-- --------------------------------------------------------

--
-- Table structure for table `meal_types`
--

CREATE TABLE `meal_types` (
  `meal_type_id` int(11) NOT NULL,
  `meal_type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meal_types`
--

INSERT INTO `meal_types` (`meal_type_id`, `meal_type_name`) VALUES
(1, 'Breakfast'),
(5, 'Dessert'),
(3, 'Dinner'),
(2, 'Lunch'),
(4, 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table `prep_times`
--

CREATE TABLE `prep_times` (
  `prep_time_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `time_seconds` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prep_times`
--

INSERT INTO `prep_times` (`prep_time_id`, `recipe_id`, `time_seconds`) VALUES
(1, 1, 900),
(2, 2, 900),
(3, 3, 1200),
(4, 4, 900),
(5, 5, 600),
(6, 6, 1200),
(7, 7, 1800),
(8, 8, 600),
(9, 9, 1500),
(10, 10, 900),
(11, 11, 600),
(12, 12, 1200),
(13, 13, 600),
(14, 14, 900),
(15, 15, 1200),
(16, 16, 1200),
(17, 17, 900),
(18, 18, 900),
(19, 19, 1200),
(20, 20, 900),
(21, 21, 900),
(22, 22, 600),
(23, 23, 1800),
(24, 24, 900),
(25, 25, 1200),
(31, 31, 900),
(32, 32, 600),
(33, 33, 900),
(34, 34, 600),
(35, 35, 900),
(36, 36, 600),
(37, 37, 900),
(38, 38, 600),
(39, 39, 900),
(40, 40, 900);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `recipe_id`, `user_id`, `rating`, `created_at`) VALUES
(29, 1, 12, 5, '2025-04-20 13:10:00'),
(30, 1, 23, 4, '2025-04-20 13:15:00'),
(31, 2, 21, 4, '2025-04-20 13:20:00'),
(32, 3, 25, 5, '2025-04-20 13:25:00'),
(33, 4, 22, 3, '2025-04-20 13:30:00'),
(34, 5, 26, 4, '2025-04-20 13:35:00'),
(35, 6, 12, 5, '2025-04-20 13:40:00'),
(36, 7, 23, 2, '2025-04-20 13:45:00'),
(37, 8, 21, 3, '2025-04-20 13:50:00'),
(38, 9, 22, 5, '2025-04-20 13:55:00'),
(39, 10, 25, 4, '2025-04-20 14:00:00'),
(40, 11, 26, 5, '2025-04-20 14:05:00'),
(41, 12, 12, 3, '2025-04-20 14:10:00'),
(42, 13, 23, 4, '2025-04-20 14:15:00'),
(43, 14, 21, 4, '2025-04-20 14:20:00'),
(44, 15, 22, 5, '2025-04-20 14:25:00'),
(45, 16, 25, 4, '2025-04-20 14:30:00'),
(46, 17, 26, 5, '2025-04-20 14:35:00'),
(47, 18, 12, 3, '2025-04-20 14:40:00'),
(48, 19, 21, 2, '2025-04-20 14:45:00'),
(49, 20, 22, 5, '2025-04-20 14:50:00'),
(50, 21, 23, 4, '2025-04-20 14:55:00'),
(51, 22, 25, 4, '2025-04-20 15:00:00'),
(52, 23, 26, 5, '2025-04-20 15:05:00'),
(56, 1, 21, 3, '2025-04-28 13:42:17'),
(65, 27, 21, 4, '2025-04-29 01:17:26'),
(66, 27, 12, 3, '2025-04-29 01:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `recipe_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `servings` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `user_id`, `recipe_name`, `recipe_description`, `servings`, `created_at`) VALUES
(1, 21, 'Spaghetti Carbonara', 'A classic Italian pasta dish made with eggs, cheese, pancetta, and pepper.', 4, '2025-02-05 07:14:10'),
(2, 2, 'Chicken Alfredo', 'A creamy pasta dish made with chicken, garlic, cream, and Parmesan cheese.', 4, '2025-02-05 07:14:10'),
(3, 3, 'Vegan Tacos', 'Soft corn tortillas filled with spiced lentils, avocado, and fresh vegetables.', 3, '2025-02-05 07:14:10'),
(4, 4, 'Beef Stew', 'A hearty stew made with tender beef, carrots, potatoes, and onions.', 6, '2025-02-05 07:14:10'),
(5, 5, 'Grilled Salmon', 'Fresh salmon fillets grilled to perfection, served with lemon and herbs.', 2, '2025-02-05 07:14:10'),
(6, 6, 'Eggplant Parmesan', 'Baked breaded eggplant slices topped with marinara sauce and melted mozzarella.', 5, '2025-02-05 07:14:10'),
(7, 7, 'Apple Pie', 'A sweet dessert made with cinnamon-spiced apples in a flaky pie crust.', 8, '2025-02-05 07:14:10'),
(8, 8, 'Caesar Salad', 'A classic salad with Romaine lettuce, croutons, Caesar dressing, and Parmesan.', 4, '2025-02-05 07:14:10'),
(9, 9, 'Chocolate Cake', 'A rich and moist chocolate cake topped with creamy chocolate frosting.', 10, '2025-02-05 07:14:10'),
(10, 10, 'Vegetable Stir-fry', 'A colorful stir-fry made with bell peppers, broccoli, carrots, and soy sauce.', 4, '2025-02-05 07:14:10'),
(11, 1, 'Korean Corn Cheese', 'A creamy, cheesy, and slightly sweet Korean street food side dish.', 4, '2025-03-23 16:38:22'),
(12, 2, 'Spicy Honey Butter Fried Chicken', 'Crispy fried chicken glazed with spicy honey butter.', 4, '2025-03-23 16:38:22'),
(13, 3, 'Japanese Tamago Sando', 'A fluffy Japanese egg salad sandwich with milk bread.', 2, '2025-03-23 16:38:22'),
(14, 4, 'Smoked Salmon Croissant Benedict', 'A buttery croissant topped with smoked salmon and poached eggs.', 2, '2025-03-23 16:38:22'),
(15, 5, 'Vietnamese Lemongrass Chicken', 'Juicy, aromatic grilled chicken marinated in lemongrass.', 4, '2025-03-23 16:38:22'),
(16, 6, 'Truffle Mushroom Risotto', 'A creamy risotto infused with truffle and wild mushrooms.', 3, '2025-03-23 16:38:22'),
(17, 7, 'Braised Short Rib Gnocchi', 'Pillowy gnocchi with slow-braised short ribs in a red wine sauce.', 4, '2025-03-23 16:38:22'),
(18, 8, 'Cajun Shrimp and Grits', 'Creamy, cheesy grits topped with spicy Cajun shrimp.', 3, '2025-03-23 16:38:22'),
(19, 9, 'Peking Duck Tacos', 'A fusion dish combining crispy Peking duck with soft tortillas.', 4, '2025-03-23 16:38:22'),
(20, 10, 'Spaghetti alla Nerano', 'An Italian pasta dish with fried zucchini and a creamy cheese sauce.', 2, '2025-03-23 16:38:22'),
(21, 11, 'Taro Milk Tea Panna Cotta', 'A creamy Italian panna cotta infused with sweet taro flavor.', 4, '2025-03-23 16:38:22'),
(22, 12, 'Chili Chocolate Mousse', 'A rich chocolate mousse with a subtle kick of chili spice.', 4, '2025-03-23 16:38:22'),
(23, 13, 'Carrot Halwa Cheesecake', 'A fusion dessert combining Indian carrot halwa with creamy cheesecake.', 8, '2025-03-23 16:38:22'),
(24, 14, 'Biscoff Tiramisu', 'A layered tiramisu with coffee-soaked Biscoff cookies.', 6, '2025-03-23 16:38:22'),
(25, 15, 'Japanese Honey Castella Cake', 'A fluffy and moist sponge cake made with honey.', 8, '2025-03-23 16:38:22'),
(26, 16, 'Persian Love Cake', 'A fragrant and nutty cake with hints of cardamom and rosewater.', 6, '2025-03-23 16:38:22'),
(27, 17, 'Black Sesame Mochi Brownies', 'Chewy brownies infused with nutty black sesame.', 9, '2025-03-23 16:38:22'),
(28, 18, 'Miso Caramel Bread Pudding', 'A sweet and salty twist on classic bread pudding.', 6, '2025-03-23 16:38:22'),
(29, 19, 'Tropical Passionfruit Tart', 'A bright and tangy tart with passionfruit curd and a coconut crust.', 6, '2025-03-23 16:38:22'),
(30, 20, 'Butterbeer Cupcakes', 'Cupcakes inspired by the famous drink, with butterscotch and vanilla.', 8, '2025-03-23 16:38:22'),
(31, 1, 'Grilled Chicken Salad', 'A fresh salad with grilled chicken, lettuce, tomato, cucumber, and dressing.', 2, '2025-03-24 23:49:18'),
(33, 2, 'Chicken Caesar Wrap', 'A delicious wrap with grilled chicken, romaine lettuce, Caesar dressing, and a tortilla.', 2, '2025-03-24 23:49:18'),
(34, 3, 'Baked Chicken Parmesan', 'Breaded chicken topped with marinara sauce, mozzarella, and Parmesan cheese, baked to perfection.', 4, '2025-03-24 23:49:18'),
(35, 4, 'Chicken Tacos', 'Grilled chicken served in taco shells with lettuce, salsa, and sour cream.', 3, '2025-03-24 23:49:18'),
(36, 5, 'Chicken and Rice', 'A simple dish with grilled chicken served with rice and stir-fried vegetables in soy sauce.', 4, '2025-03-24 23:49:18'),
(37, 6, 'Chicken Stir Fry', 'A stir fry made with chicken, mixed vegetables, and served over rice with soy sauce.', 3, '2025-03-24 23:49:18'),
(38, 7, 'Spicy Chicken Wings', 'Crispy chicken wings tossed in a spicy hot sauce with garlic and butter.', 6, '2025-03-24 23:49:18'),
(39, 8, 'Lemon Herb Grilled Chicken', 'Grilled chicken marinated with lemon, garlic, and herbs for a flavorful meal.', 2, '2025-03-24 23:49:18'),
(40, 9, 'Chicken Soup', 'A comforting soup with chicken, carrots, celery, onion, and broth.', 6, '2025-03-24 23:49:18'),
(41, 1, 'Lemon Garlic Chicken', 'A savory chicken recipe with lemon, garlic, and herbs, baked to perfection.', 4, '2025-04-20 10:07:10'),
(65, 21, 'Classic Mac and Cheese', 'A creamy and cheesy comfort food favorite with a crispy', 6, '2025-04-29 17:49:58');

-- --------------------------------------------------------

--
-- Stand-in structure for view `recipe_categories`
-- (See below for the actual view)
--
CREATE TABLE `recipe_categories` (
`recipe_id` int(11)
,`meal_types` text
,`ethnic_types` text
,`diet_types` text
);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_diet_types`
--

CREATE TABLE `recipe_diet_types` (
  `recipe_id` int(11) NOT NULL,
  `diet_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recipe_diet_types`
--

INSERT INTO `recipe_diet_types` (`recipe_id`, `diet_type_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 4),
(3, 1),
(3, 5),
(4, 2),
(4, 4),
(5, 2),
(5, 6),
(6, 1),
(6, 4),
(7, 2),
(7, 4),
(8, 1),
(8, 4),
(9, 1),
(9, 3),
(10, 2),
(10, 6),
(11, 1),
(11, 4),
(12, 1),
(12, 3),
(13, 2),
(13, 5),
(14, 1),
(14, 3),
(15, 2),
(15, 6),
(16, 1),
(16, 4),
(17, 2),
(17, 4),
(18, 1),
(18, 6),
(19, 1),
(19, 5),
(20, 2),
(20, 3),
(21, 1),
(21, 4),
(22, 2),
(22, 5),
(23, 1),
(23, 4),
(24, 2),
(24, 4),
(25, 1),
(25, 3),
(26, 2),
(26, 6),
(27, 1),
(27, 4),
(28, 1),
(28, 5),
(29, 1),
(29, 4),
(30, 2),
(30, 6),
(31, 1),
(31, 3),
(33, 2),
(33, 5),
(34, 1),
(34, 4),
(35, 2),
(35, 7),
(36, 1),
(36, 3),
(37, 2),
(37, 4),
(38, 1),
(38, 6),
(39, 2),
(39, 4),
(40, 1),
(40, 7);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ethnic_types`
--

CREATE TABLE `recipe_ethnic_types` (
  `recipe_id` int(11) NOT NULL,
  `ethnic_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recipe_ethnic_types`
--

INSERT INTO `recipe_ethnic_types` (`recipe_id`, `ethnic_type_id`) VALUES
(1, 1),
(1, 5),
(2, 1),
(2, 5),
(3, 6),
(4, 5),
(5, 1),
(5, 5),
(6, 1),
(6, 5),
(7, 5),
(7, 6),
(8, 1),
(8, 5),
(9, 1),
(9, 5),
(10, 5),
(11, 4),
(11, 5),
(12, 5),
(12, 4),
(13, 3),
(13, 4),
(14, 1),
(14, 5),
(15, 6),
(15, 5),
(16, 1),
(16, 5),
(17, 5),
(18, 6),
(18, 5),
(19, 1),
(20, 1),
(20, 5),
(21, 1),
(21, 5),
(22, 4),
(22, 5),
(23, 4),
(23, 5),
(24, 4),
(24, 5),
(25, 1),
(25, 5),
(26, 1),
(26, 5),
(27, 6),
(27, 5),
(28, 1),
(28, 5),
(29, 1),
(29, 5),
(30, 6),
(30, 5),
(31, 5),
(33, 3),
(33, 5),
(34, 5),
(35, 2),
(35, 5),
(36, 2),
(36, 5),
(37, 1),
(37, 5),
(38, 4),
(38, 5),
(39, 1),
(39, 5),
(40, 3),
(40, 5);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`recipe_id`, `ingredient_id`, `quantity`, `unit_id`) VALUES
(2, 4, 300.00, 1),
(2, 5, 2.00, 2),
(2, 6, 100.00, 1),
(3, 7, 200.00, 1),
(3, 8, 1.00, 2),
(3, 9, 50.00, 1),
(4, 10, 500.00, 1),
(4, 11, 3.00, 2),
(4, 12, 100.00, 1),
(5, 13, 2.00, 2),
(5, 14, 1.00, 1),
(5, 15, 1.00, 2),
(6, 16, 1.00, 2),
(6, 17, 100.00, 1),
(6, 18, 50.00, 1),
(7, 19, 3.00, 2),
(7, 20, 200.00, 1),
(7, 21, 1.00, 2),
(8, 22, 100.00, 1),
(8, 23, 50.00, 1),
(8, 24, 1.00, 2),
(9, 25, 200.00, 1),
(9, 26, 3.00, 2),
(9, 27, 100.00, 1),
(10, 28, 300.00, 1),
(10, 29, 1.00, 2),
(10, 30, 50.00, 1),
(11, 31, 300.00, 1),
(11, 32, 2.00, 2),
(11, 33, 50.00, 1),
(12, 34, 500.00, 1),
(12, 35, 1.00, 2),
(12, 36, 100.00, 1),
(13, 37, 2.00, 2),
(13, 38, 1.00, 1),
(13, 39, 50.00, 1),
(14, 40, 4.00, 2),
(14, 41, 2.00, 2),
(14, 42, 100.00, 1),
(15, 43, 500.00, 1),
(15, 44, 1.00, 2),
(15, 45, 1.00, 2),
(16, 46, 300.00, 1),
(16, 47, 200.00, 1),
(16, 48, 1.00, 2),
(17, 49, 500.00, 1),
(17, 50, 1.00, 2),
(17, 51, 200.00, 1),
(18, 52, 300.00, 1),
(18, 53, 1.00, 2),
(18, 54, 100.00, 1),
(19, 55, 300.00, 1),
(19, 56, 1.00, 2),
(19, 57, 50.00, 1),
(20, 58, 200.00, 1),
(20, 59, 3.00, 2),
(20, 60, 100.00, 1),
(21, 61, 200.00, 1),
(21, 62, 1.00, 2),
(21, 63, 50.00, 1),
(21, 61, 200.00, 1),
(21, 62, 1.00, 2),
(21, 63, 50.00, 1),
(21, 61, 300.00, 1),
(21, 62, 100.00, 1),
(21, 63, 50.00, 1),
(22, 64, 200.00, 1),
(22, 65, 100.00, 1),
(23, 1, 300.00, 1),
(23, 2, 200.00, 1),
(23, 3, 400.00, 1),
(24, 4, 300.00, 1),
(24, 5, 200.00, 1),
(24, 6, 150.00, 1),
(25, 7, 6.00, 2),
(25, 8, 1.00, 2),
(25, 9, 100.00, 1),
(26, 10, 50.00, 1),
(26, 11, 300.00, 1),
(26, 12, 200.00, 1),
(27, 13, 100.00, 1),
(27, 14, 200.00, 1),
(27, 15, 50.00, 1),
(28, 16, 100.00, 1),
(28, 17, 200.00, 1),
(28, 18, 300.00, 1),
(29, 19, 200.00, 1),
(29, 20, 100.00, 1),
(29, 21, 150.00, 1),
(30, 22, 2.00, 2),
(30, 23, 200.00, 1),
(30, 24, 3.00, 2),
(31, 1, 250.00, 1),
(31, 25, 100.00, 1),
(31, 26, 100.00, 1),
(31, 1, 250.00, 1),
(31, 25, 100.00, 1),
(31, 26, 100.00, 1),
(33, 1, 200.00, 1),
(33, 12, 100.00, 1),
(33, 34, 100.00, 1),
(34, 1, 300.00, 1),
(34, 12, 150.00, 1),
(34, 13, 100.00, 1),
(35, 1, 250.00, 1),
(35, 32, 100.00, 1),
(35, 33, 100.00, 1),
(36, 1, 300.00, 1),
(36, 20, 200.00, 1),
(36, 51, 10.00, 1),
(37, 1, 250.00, 1),
(37, 32, 100.00, 1),
(37, 37, 50.00, 1),
(38, 1, 500.00, 1),
(38, 52, 10.00, 1),
(38, 51, 10.00, 1),
(39, 1, 350.00, 1),
(39, 39, 2.00, 2),
(39, 53, 50.00, 1),
(40, 1, 400.00, 1),
(40, 27, 100.00, 1),
(40, 28, 50.00, 1),
(41, 1, 300.00, 1),
(41, 24, 5.00, 2),
(41, 39, 1.00, 2),
(1, 18, 200.00, 1),
(1, 9, 2.00, 5),
(1, 12, 50.00, 1),
(1, 8, 100.00, 1),
(1, 52, 1.00, 4),
(1, 51, 0.50, 4);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_meal_types`
--

CREATE TABLE `recipe_meal_types` (
  `recipe_id` int(11) NOT NULL,
  `meal_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recipe_meal_types`
--

INSERT INTO `recipe_meal_types` (`recipe_id`, `meal_type_id`) VALUES
(1, 1),
(3, 1),
(1, 2),
(2, 2),
(8, 2),
(10, 2),
(2, 3),
(3, 3),
(5, 3),
(6, 3),
(8, 3),
(4, 4),
(10, 4),
(5, 5),
(9, 5),
(6, 2),
(6, 3),
(8, 2),
(8, 3),
(9, 5),
(10, 2),
(10, 3),
(11, 4),
(11, 1),
(12, 2),
(12, 3),
(13, 1),
(13, 4),
(14, 1),
(14, 2),
(15, 2),
(15, 3),
(16, 2),
(16, 3),
(17, 3),
(18, 1),
(18, 3),
(19, 2),
(19, 3),
(20, 2),
(20, 3),
(21, 5),
(22, 5),
(23, 5),
(24, 5),
(25, 1),
(25, 5),
(7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_photos`
--

CREATE TABLE `recipe_photos` (
  `photo_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/web-289/public/assets/recipe-images/default-recipe-image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recipe_photos`
--

INSERT INTO `recipe_photos` (`photo_id`, `recipe_id`, `img_path`) VALUES
(11, 1, '/web-289/public/assets/recipe-images/spaghetti-carbonara.jpg'),
(12, 2, '/web-289/public/assets/recipe-images/chicken-alfredo.jpg'),
(13, 3, '/web-289/public/assets/recipe-images/vegan-tacos.jpg'),
(14, 4, '/web-289/public/assets/recipe-images/beef-stew.jpg'),
(15, 5, '/web-289/public/assets/recipe-images/grilled-salmon.jpg'),
(16, 6, '/web-289/public/assets/recipe-images/eggplant-parmesan.jpg'),
(17, 7, '/web-289/public/assets/recipe-images/apple-pie.jpg'),
(18, 8, '/web-289/public/assets/recipe-images/caesar-salad.jpg'),
(19, 9, '/web-289/public/assets/recipe-images/chocolate-cake.jpg'),
(20, 10, '/web-289/public/assets/recipe-images/vegetable-stir-fry.jpg'),
(21, 11, '/web-289/public/assets/recipe-images/korean-corn-cheese.jpg'),
(22, 12, '/web-289/public/assets/recipe-images/spicy-honey-butter-chicken.jpg'),
(23, 13, '/web-289/public/assets/recipe-images/japanese-tamago-sando.jpg'),
(24, 14, '/web-289/public/assets/recipe-images/smoked-salmon-benedict.jpg'),
(25, 15, '/web-289/public/assets/recipe-images/lemongrass-chicken.jpg'),
(26, 16, '/web-289/public/assets/recipe-images/truffle-mushroom.jpg'),
(27, 17, '/web-289/public/assets/recipe-images/braised-short-rib.jpg'),
(28, 18, '/web-289/public/assets/recipe-images/cajun-shrimp-and-grits.jpg'),
(29, 19, '/web-289/public/assets/recipe-images/peking-duck-tacos.jpg'),
(30, 20, '/web-289/public/assets/recipe-images/spaghetti-alla-nerano.jpg'),
(31, 21, '/web-289/public/assets/recipe-images/taro-milk-panna-cotta.jpg'),
(32, 22, '/web-289/public/assets/recipe-images/chili-chocolate-mousse.jpg'),
(33, 23, '/web-289/public/assets/recipe-images/carrot-halwa-cheesecake.jpg'),
(34, 24, '/web-289/public/assets/recipe-images/biscoff-tiramisu.jpg'),
(35, 25, '/web-289/public/assets/recipe-images/honey-castella-cake.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_videos`
--

CREATE TABLE `recipe_videos` (
  `video_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `youtube_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `credit_paragraph` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recipe_videos`
--

INSERT INTO `recipe_videos` (`video_id`, `recipe_id`, `youtube_id`, `credit_paragraph`) VALUES
(7, 1, 'TiSQXkKZ-c4', 'Video by Chef Max Mariola, licensed under Creative Commons (reuse allowed). Original video: https://www.youtube.com/watch?v=TiSQXkKZ-c4'),
(8, 2, 'Gvx7-R8RmVU', 'Video by Sweet and Savory Meals Blog, licensed under Creative Commons (reuse allowed). Original video: https://www.youtube.com/watch?v=Gvx7-R8RmVU'),
(9, 3, 'UJPlfe_WX1Y', 'Video by yumyotta, licensed under Creative Commons (reuse allowed). Original video: https://www.youtube.com/watch?v=UJPlfe_WX1Y'),
(10, 4, 'uUCrfe-HkvA', 'Video by MartinPlates, licensed under Creative Commons (reuse allowed). Original video: https://www.youtube.com/watch?v=uUCrfe-HkvA'),
(11, 5, 'zUsQNI-MrPI', 'Video by Eric Sullivan, licensed under Creative Commons (reuse allowed). Original video: https://www.youtube.com/watch?v=zUsQNI-MrPI'),
(12, 6, 'YLQlXqx075Q', 'Video by Kris Occhipinti, licensed under Creative Commons (reuse allowed). Original video: https://www.youtube.com/watch?v=YLQlXqx075Q'),
(13, 7, '1X2wRzxRGbk', 'Video by Tasty Dishes, licensed under Creative Commons (reuse allowed). Original video: https://www.youtube.com/watch?v=1X2wRzxRGbk'),
(14, 8, 'XOmAN2GucNU', 'Video by Rockin Robin Cooks, licensed under Creative Commons (reuse allowed). Original video: https://www.youtube.com/watch?v=XOmAN2GucNU');

-- --------------------------------------------------------

--
-- Table structure for table `requested_ingredients`
--

CREATE TABLE `requested_ingredients` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `requested_name` varchar(255) NOT NULL,
  `date_requested` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `role_description` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_description`) VALUES
(1, 'Member', 'Can rate recipes, post recipes with details, and access public content'),
(2, 'Admin', 'Can manage users, categories, and content'),
(3, 'Super Admin', 'Full system access, including Admin capabilities');

-- --------------------------------------------------------

--
-- Table structure for table `saved_recipes`
--

CREATE TABLE `saved_recipes` (
  `saved_recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `saved_recipes`
--

INSERT INTO `saved_recipes` (`saved_recipe_id`, `user_id`, `recipe_id`) VALUES
(7, 21, 1),
(8, 21, 19);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`) VALUES
(1, 'gram'),
(2, 'cup'),
(3, 'tablespoon'),
(4, 'teaspoon'),
(5, 'piece'),
(6, 'slice'),
(7, 'ounce'),
(8, 'pound'),
(9, 'milliliter'),
(10, 'liter'),
(11, 'pinch'),
(12, 'clove'),
(13, 'halved'),
(14, 'minced');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `hashed_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activity` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `hashed_password`, `role_id`, `created_at`, `activity`) VALUES
(12, 'Courtney', 'Williams', 'cwilliams2', 'couuurt@gmail.com', '$2y$10$oiRe6TkikBaJVhKUMAofZuXkt2NpGuH53bECG.W0FqBWbC4g/Yz/m', 1, '2025-03-04 23:48:20', 1),
(21, 'Courtney', 'Williams', 'cwilliams', 'cooourt@gmail.com', '$2y$10$V7LqTGyLiXQ8m0FWo0UWGORbI0BmEx92QqwUrr9tCjmWWUfxHorA2', 3, '2025-03-07 11:36:42', 1),
(22, 'Poppy', 'Seed', 'PoppySeed', 'PoppySeed@example.org', '$2y$10$wv3Bykas2fE3406Jgm.f0uqV9Guq6/0hPIi2Doza6OmPhyi/eVNOe', 2, '2025-03-08 03:38:53', 1),
(23, 'Steve', 'Harvey', 'stevetheman2', 'steveharvey@yahoo.com', '$2y$10$r9Oaq/rMZ98GaOsrGXUixecOunUTP3tiF7aTshB3iS25qu2./D67m', 1, '2025-03-08 05:53:55', 1),
(25, 'Jim', 'Carrey', 'Grinch33', 'dontmessageme@gmail.com', '$2y$10$p42LflWmJ4jkgeoSkoxNXu/ZdgKsCL482LpAWION0SzIEcAM.Ofa2', 1, '2025-03-08 01:02:36', 1),
(26, 'test', 'user', 'testuser12345', 'testeeee@gmail.com', '$2y$10$9BTco2vWXpBCSUFapj2wTuxcDZg3a26jOmadFC00hsuCd/A.jQEnm', 1, '2025-04-13 11:20:18', 1),
(28, 'Admin', 'Test', 'AdminTest', 'admintest@gmail.com', '$2y$10$/iR6fMg.IIckHSdkPm2U/.zBZ8wnCWzm8l4E32VLbz11dNAMbWEVy', 2, '2025-04-29 08:56:35', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cook_times`
--
ALTER TABLE `cook_times`
  ADD PRIMARY KEY (`cook_time_id`);

--
-- Indexes for table `diet_types`
--
ALTER TABLE `diet_types`
  ADD PRIMARY KEY (`diet_type_id`),
  ADD UNIQUE KEY `diet_type_name` (`diet_type_name`);

--
-- Indexes for table `directions`
--
ALTER TABLE `directions`
  ADD PRIMARY KEY (`direction_id`),
  ADD KEY `fk_recipe_directions_recipes` (`recipe_id`);

--
-- Indexes for table `ethnic_types`
--
ALTER TABLE `ethnic_types`
  ADD PRIMARY KEY (`ethnic_type_id`),
  ADD UNIQUE KEY `ethnic_type_name` (`ethnic_type_name`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_id`);

--
-- Indexes for table `meal_types`
--
ALTER TABLE `meal_types`
  ADD PRIMARY KEY (`meal_type_id`),
  ADD UNIQUE KEY `meal_type_name` (`meal_type_name`);

--
-- Indexes for table `prep_times`
--
ALTER TABLE `prep_times`
  ADD PRIMARY KEY (`prep_time_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `fk_ratings_recipes` (`recipe_id`),
  ADD KEY `fk_ratings_users` (`user_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `recipe_diet_types`
--
ALTER TABLE `recipe_diet_types`
  ADD KEY `fk_recipe_diet_types_recipes` (`recipe_id`),
  ADD KEY `fk_recipe_diet_types_diet_types` (`diet_type_id`);

--
-- Indexes for table `recipe_ethnic_types`
--
ALTER TABLE `recipe_ethnic_types`
  ADD KEY `fk_recipe_ethnic_types_recipes` (`recipe_id`),
  ADD KEY `fk_recipe_ethnic_types_ethnic_types` (`ethnic_type_id`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD KEY `fk_recipe_ingredients_recipes` (`recipe_id`),
  ADD KEY `fk_recipe_ingredients_ingredients` (`ingredient_id`);

--
-- Indexes for table `recipe_meal_types`
--
ALTER TABLE `recipe_meal_types`
  ADD KEY `fk_recipe_meal_types_recipes` (`recipe_id`),
  ADD KEY `fk_recipe_meal_types_meal_types` (`meal_type_id`);

--
-- Indexes for table `recipe_photos`
--
ALTER TABLE `recipe_photos`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `fk_recipe_photos_recipes` (`recipe_id`);

--
-- Indexes for table `recipe_videos`
--
ALTER TABLE `recipe_videos`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `fk_recipe_videos_recipes` (`recipe_id`);

--
-- Indexes for table `requested_ingredients`
--
ALTER TABLE `requested_ingredients`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `saved_recipes`
--
ALTER TABLE `saved_recipes`
  ADD PRIMARY KEY (`saved_recipe_id`),
  ADD KEY `fk_saved_recipes_recipes` (`recipe_id`),
  ADD KEY `fk_saved_recipes_users` (`user_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cook_times`
--
ALTER TABLE `cook_times`
  MODIFY `cook_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `diet_types`
--
ALTER TABLE `diet_types`
  MODIFY `diet_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `directions`
--
ALTER TABLE `directions`
  MODIFY `direction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `ethnic_types`
--
ALTER TABLE `ethnic_types`
  MODIFY `ethnic_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `meal_types`
--
ALTER TABLE `meal_types`
  MODIFY `meal_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prep_times`
--
ALTER TABLE `prep_times`
  MODIFY `prep_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `recipe_photos`
--
ALTER TABLE `recipe_photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `recipe_videos`
--
ALTER TABLE `recipe_videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `requested_ingredients`
--
ALTER TABLE `requested_ingredients`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saved_recipes`
--
ALTER TABLE `saved_recipes`
  MODIFY `saved_recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

-- --------------------------------------------------------

--
-- Structure for view `recipe_categories`
--
DROP TABLE IF EXISTS `recipe_categories`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `recipe_categories`  AS SELECT `r`.`recipe_id` AS `recipe_id`, group_concat(distinct `mt`.`meal_type_name` separator ',') AS `meal_types`, group_concat(distinct `et`.`ethnic_type_name` separator ',') AS `ethnic_types`, group_concat(distinct `dt`.`diet_type_name` separator ',') AS `diet_types` FROM ((((((`recipes` `r` left join `recipe_meal_types` `rmt` on((`r`.`recipe_id` = `rmt`.`recipe_id`))) left join `meal_types` `mt` on((`rmt`.`meal_type_id` = `mt`.`meal_type_id`))) left join `recipe_ethnic_types` `ret` on((`r`.`recipe_id` = `ret`.`recipe_id`))) left join `ethnic_types` `et` on((`ret`.`ethnic_type_id` = `et`.`ethnic_type_id`))) left join `recipe_diet_types` `rdt` on((`r`.`recipe_id` = `rdt`.`recipe_id`))) left join `diet_types` `dt` on((`rdt`.`diet_type_id` = `dt`.`diet_type_id`))) GROUP BY `r`.`recipe_id` ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `directions`
--
ALTER TABLE `directions`
  ADD CONSTRAINT `fk_recipe_directions_recipes` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_ratings_recipes` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ratings_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_diet_types`
--
ALTER TABLE `recipe_diet_types`
  ADD CONSTRAINT `fk_recipe_diet_types_diet_types` FOREIGN KEY (`diet_type_id`) REFERENCES `diet_types` (`diet_type_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recipe_diet_types_recipes` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_ethnic_types`
--
ALTER TABLE `recipe_ethnic_types`
  ADD CONSTRAINT `fk_recipe_ethnic_types_ethnic_types` FOREIGN KEY (`ethnic_type_id`) REFERENCES `ethnic_types` (`ethnic_type_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recipe_ethnic_types_recipes` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `fk_recipe_ingredients_ingredients` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`ingredient_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recipe_ingredients_recipes` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_meal_types`
--
ALTER TABLE `recipe_meal_types`
  ADD CONSTRAINT `fk_recipe_meal_types_meal_types` FOREIGN KEY (`meal_type_id`) REFERENCES `meal_types` (`meal_type_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recipe_meal_types_recipes` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_photos`
--
ALTER TABLE `recipe_photos`
  ADD CONSTRAINT `fk_recipe_photos_recipes` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_videos`
--
ALTER TABLE `recipe_videos`
  ADD CONSTRAINT `fk_recipe_videos_recipes` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;

--
-- Constraints for table `requested_ingredients`
--
ALTER TABLE `requested_ingredients`
  ADD CONSTRAINT `requested_ingredients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `saved_recipes`
--
ALTER TABLE `saved_recipes`
  ADD CONSTRAINT `fk_saved_recipes_recipes` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_saved_recipes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
--
-- Database: `amqcapmy_sabirds`
--
DROP DATABASE IF EXISTS `amqcapmy_sabirds`;
CREATE DATABASE IF NOT EXISTS `amqcapmy_sabirds` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `amqcapmy_sabirds`;

-- --------------------------------------------------------

--
-- Table structure for table `birds`
--

CREATE TABLE `birds` (
  `id` int(11) NOT NULL,
  `commonName` varchar(100) NOT NULL,
  `habitat` varchar(100) NOT NULL,
  `food` varchar(100) NOT NULL,
  `nestPlacement` varchar(255) NOT NULL,
  `behavior` varchar(100) NOT NULL,
  `conservationId` int(11) NOT NULL,
  `backyardTips` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `birds`
--

INSERT INTO `birds` (`id`, `commonName`, `habitat`, `food`, `nestPlacement`, `behavior`, `conservationId`, `backyardTips`) VALUES
(8, 'Carolina Wren', 'Open woodlands', 'Insects', 'Cavity', 'Ground Forager', 1, 'Carolina Wrens visit suet-filled feeders during winter.'),
(9, 'Tufted Titmouse', 'Forests', 'Insects', 'Cavity', 'Foliage gleaner', 1, 'Tufted Titmouse are regulars at backyard bird feeders, especially in winter. They prefer sunflower seeds but will eat suet, peanuts, and other seeds as well.'),
(10, 'Ruby-Throated Hummingbird', 'Open woodlands', 'Nectar', 'Tree', 'Hovering', 1, 'You can attract Ruby-throated Hummingbirds to your backyard by setting up hummingbird feeders or by planting tubular flowers.'),
(11, 'Eastern Towhee', 'Scrub', 'Omnivore', 'Ground', 'Ground forager', 1, 'Eastern Towhees are likely to visit – or perhaps live in – your yard if you’ve got brushy, shrubby, or overgrown borders.'),
(12, 'Indigo Bunting', 'Open woodlands', 'Insects', 'Shrub', 'Foliage gleaner', 1, 'You can attract Indigo Buntings to your yard with feeders, particularly with small seeds such as thistle or nyjer.'),
(16, 'Blue Jay', 'Forests', 'Bugs', 'Trees', 'Skidish', 2, 'Don\'t pick up their feathers.'),
(17, 'Barn Owl', 'Forests', 'Mouse', 'Trees', 'Nocturnal', 3, 'Be cautious.'),
(19, 'Sparrow', 'Gardens', 'Seeds', 'Trees', 'Social', 1, 'Place a bird bath in your backyard.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userLevel` char(1) DEFAULT NULL,
  `hashedPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `username`, `userLevel`, `hashedPassword`) VALUES
(3, 'Cowboy', 'Curtis', 'cowboy@playhouse.com', 'cowboycurtis', 'm', '$2y$10$RF7bjUyuF.0xbFCE2ZERmuTtxiPcBnSvtf4/U.jekSER9nbu1QHFq'),
(4, 'Courtney', 'Williams', 'cwilliams@example.org', 'cwilliams', 'a', '$2y$10$UjnYX7cPIz2/QL0rokJUQew7kNr87EnUEYsBPjTksPs3bTXXi8F/i'),
(5, 'Charlie', 'Wallin', 'cwallin@random.org', 'charliewallin', 'a', '$2y$10$NsVcygAerx0ojNEdajFoFuBSRFfVX2gT2p2S5x.tZNKd3pPs.6Diu'),
(6, 'Poppy', 'Seed', 'PoppySeed@example.org', 'PoppySeed', 'm', '$2y$10$mml3Yx5h69lp2xAYuPW0LuZc3h.oQz49nEN42bN.jw2Elz8Wt.Ose');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birds`
--
ALTER TABLE `birds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birds`
--
ALTER TABLE `birds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
