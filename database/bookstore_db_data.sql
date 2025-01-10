-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 03:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(3, 2, 'user', 'user@gmail.com', '123123', 'Hello Shelf Symphony'),
(4, 2, 'user', 'user@gmail.com', '123123', 'Hi there'),
(5, 3, 'Arijesa', 'arijesamujaa@gmail.com', '123123', 'Hello to ShelfSymphony');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(11) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 2, 'user', '123123', 'user@gmail.com', 'Prishtine', 'The Elegance of the Hedgehog (1) The Zombie Room (1) The Hunger Games (1) Stoner (1)', 80, '06-Jan-2025', 'Completed'),
(2, 2, 'user', '123123', 'user@gmail.com', 'Prishtine', 'A Story of Yesterday (1)', 18, '06-Jan-2025', 'Completed'),
(3, 2, 'user', '123123', 'user@gmail.com', 'Prishtine', 'The Zombie Room (1) To Kill a Mockingbird (1) Defy Me (Shatter Me #5) (1)', 38, '07-Jan-2025', 'Completed'),
(4, 2, 'user', '123123', 'user@gmail.com', 'Prishtine', 'Imagine Me (Shatter Me #6) (1)', 12, '08-Jan-2025', 'Completed'),
(5, 3, 'Arijesa', '123123', 'arijesamujaa@gmail.com', 'Prishtine', 'A Story of Yesterday (1) The Zombie Room (1)', 34, '08-Jan-2025', 'Completed'),
(6, 2, 'user', '123123', 'user@gmail.com', 'Prishtine', 'No Country for Old Men (1) Imagine Me (Shatter Me #6) (1)', 26, '09-Jan-2025', 'Completed'),
(7, 2, 'user', '123123', 'user@gmail.com', 'Prishtine\r\n', 'The Zombie Room (1)', 16, '10-Jan-2025', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `author`, `genre`, `description`, `price`, `image`) VALUES
(1, 'An Acceptable Time', 'Madeleine L\'Engle', 'Fantasy', 'A flash of lightning, a quiver in the ground, and, instead of her grandparents\' farm, Polly sees mist and jagged mountains—and coming toward her, a group of young men carrying spears.\r\nWhy has a time gate opened and dropped Polly into a world that existed three thousand years ago?', 19, 'uploaded_img/Acceptabletime.jpg'),
(2, 'A Story of Yesterday', 'Sergio Cobo', 'Thriller', 'A Story of Yesterday is a concise and straight punch to the jaw of life.\r\nUnder a sky of different colors germinates a magical story of survival, where the result of each choice, enclosed in this particular tale, will snatch the whereabouts of each story forever.', 18, 'uploaded_img/storyOfYesterday.jpg'),
(3, 'The Elegance of the Hedgehog', 'Muriel Barbery ', 'Fiction', 'We are in the center of Paris, in an elegant apartment building inhabited by bourgeois families. Renée, the concierge, is witness to the lavish but vacuous lives of her numerous employers. Outwardly she conforms to every stereotype of the concierge: fat, cantankerous, addicted to television.', 20, 'uploaded_img/theEleganceHedgehog.jpg'),
(4, 'The Zombie Room', 'R.D. Ronald', 'Thriller, Mistery, Fiction', 'An unlikely bond is forged between three men from very different backgrounds when they serve time together in prison. A series of wrong turns and disastrous life choices has led to their incarceration. Following their release, Mangle, Decker and Tazeem stick together as they return to a life of crime.', 16, 'uploaded_img/zombieRoom.jpg'),
(5, 'War and Peace', 'Leo Tolstoy', 'Classics, Fiction', 'War and Peace broadly focuses on Napoleon’s invasion of Russia in 1812 and follows three of the most well-known characters in literature: Pierre Bezukhov, the illegitimate son of a count who is fighting for his inheritance and yearning for spiritual fulfillment.', 15, 'uploaded_img/warAndPeace.jpg'),
(6, 'To Kill a Mockingbird', 'Harper Lee', 'Fiction', 'The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it. \"To Kill A Mockingbird\" became both an instant bestseller and a critical success when it was first published in 1960. It went on to win the Pulitzer Prize in 1961 and was later made into an Academy Award-winning film, also a classic', 12, 'uploaded_img/mockingbird.jpg'),
(7, 'The Hunger Games', 'Suzanne Collins', 'Fiction, Fantasy', 'In the ruins of a place once known as North America lies the nation of Panem, a shining Capitol surrounded by twelve outlying districts. The Capitol is harsh and cruel and keeps the districts in line by forcing them all to send one boy and one girl between the ages of twelve and eighteen to participate in the annual Hunger Games, a fight to the death on live TV.', 20, 'uploaded_img/hungerGames.jpg'),
(10, 'No Country for Old Men', 'Cormac McCarthy', 'Fiction, Thriller', 'In his blistering new novel, Cormac McCarthy returns to the Texas-Mexico border, the setting of his famed Border Trilogy. The time is our own, when rustlers have given way to drug-runners and small towns have become free-fire zones.\r\n\r\nOne day, Llewellyn Moss finds a pickup truck surrounded by a bodyguard of dead men. A load of heroin and two million dollars in cash are still in the back. When Moss takes the money, he sets off a chain reaction of catastrophic violence that not even the law–in the person of aging, disillusioned Sheriff Bell–can contain.\r\n', 14, 'uploaded_img/countryOldMen.jpg'),
(11, 'Stoner', 'John Williams', 'Fiction, Historical Fiction', 'William Stoner is born at the end of the nineteenth century into a dirt-poor Missouri farming family. Sent to the state university to study agronomy, he instead falls in love with English literature and embraces a scholar’s life, so different from the hardscrabble existence he has known. And yet as the years pass, Stoner encounters a succession of disappointments: marriage into a “proper” family estranges him from his parents; his career is stymied; his wife and daughter turn coldly away from him; a transforming experience of new love ends under threat of scandal. Driven ever deeper within himself, Stoner rediscovers the stoic silence of his forebears and confronts an essential solitude.', 22, 'uploaded_img/stoner.jpg'),
(12, 'Shatter Me (Shatter Me, #1)', 'Tahereh Mafi', 'Dystopia, Young, Adult Fiction', 'Juliette hasn\'t touched anyone in exactly 264 days.\r\n\r\nThe last time she did, it was an accident, but The Reestablishment locked her up for murder. No one knows why Juliette\'s touch is fatal. As long as she doesn\'t hurt anyone else, no one really cares. The world is too busy crumbling to pieces to pay attention to a 17-year-old girl. Diseases are destroying the population, food is hard to find, birds don\'t fly anymore, and the clouds are the wrong color.\r\n\r\nThe Reestablishment said their way was the only way to fix things, so they threw Juliette in a cell. Now so many people are dead that the survivors are whispering war—and The Reestablishment has changed its mind. Maybe Juliette is more than a tortured soul stuffed into a poisonous body. Maybe she\'s exactly what they need right now.', 10, 'uploaded_img/shatterMe-1.jpg'),
(13, 'Unravel Me (Shatter Me #2)', 'Tahereh Mafi', 'Fantasy, Dystopia, Young Adult', 'The thrilling second installment in New York Times bestselling author Tahereh Mafi’s Shatter Me series.\r\n\r\nIt should have taken Juliette a single touch to kill Warner. But his mysterious immunity to her deadly power has left her shaken, wondering why her ultimate defense mechanism failed against the person she most needs protection from.\r\n\r\nShe and Adam were able to escape Warner’s clutches and join up with a group of rebels, many of whom have powers of their own. Juliette will finally be able to actively fight against The Reestablishment and try to fix her broken world. And perhaps these new allies can help her shed light on the secret behind Adam’s—and Warner’s—immunity to her killer skin.', 11, 'uploaded_img/shatterMe-2.jpg'),
(14, 'Ignite Me (Shatter Me #3)', 'Tahereh Mafi', 'Fantasy, Dystopia, Romance', 'The heart-stopping third installment in the New York Times bestselling Shatter Me series, which Ransom Riggs, author of Miss Peregrine\'s Home for Peculiar Children and Hollow City, called \"a thrilling, high-stakes saga of self-discovery and forbidden love.\"\r\n\r\nWith Omega Point destroyed, Juliette doesn\'t know if the rebels, her friends, or even Adam are alive. But that won\'t keep her from trying to take down The Reestablishment once and for all. Now she must rely on Warner, the handsome commander of Sector 45. The one person she never thought she could trust. The same person who saved her life. He promises to help Juliette master her powers and save their dying world . . . but that\'s not all he wants with her.', 12, 'uploaded_img/shatterMe-3.jpg'),
(15, 'Restore Me (Shatter Me #4)', 'Tahereh Mafi', 'Fantasy Dystopia Romance', 'Juliette Ferrars thought she\'d won. She took over Sector 45, was named the new Supreme Commander, and now has Warner by her side. But she\'s still the girl with the ability to kill with a single touch—and now she\'s got the whole world in the palm of her hand. When tragedy hits, who will she become? Will she be able to control the power she wields and use it for good?', 9, 'uploaded_img/shatterMe-4.jpg'),
(16, 'Defy Me (Shatter Me #5)', 'Tahereh Mafi', 'Fantasy, Dystopia, Romance', 'The gripping fifth installment in the New York Times, USA Today, and Publishers Weekly bestselling Shatter Me series. Will Juliette’s broken heart make her vulnerable to the strengthening darkness within her?\r\n\r\nJuliette’s short tenure as the supreme commander of North America has been an utter disaster. When the children of the other world leaders show up on her doorstep, she wants nothing more than to turn to Warner for support and guidance. But he shatters her heart when he reveals that he’s been keeping secrets about her family and her identity from her—secrets that change everything.\r\n\r\nJuliette is devastated, and the darkness that’s always dwelled within her threatens to consume her. An explosive encounter with unexpected visitors might be enough to push her over the edge.', 10, 'uploaded_img/shatterMe-5.jpg'),
(17, 'Imagine Me (Shatter Me #6)', 'Tahereh Mafi', 'Fantasy, Dystopia, Romance', 'The explosive finale to the New York Times and USA Today bestselling Shatter Me series.\r\n\r\nJuliette Ferrars.\r\n\r\nElla Sommers.\r\n\r\nWhich is the truth and which is the lie?\r\n\r\nNow that Ella knows who Juliette is and what she was created for, things have only become more complicated. As she struggles to understand the past that haunts her and looks to a future more uncertain than ever, the lines between right and wrong—between Ella and Juliette—blur. And with old enemies looming, her destiny may not be her own to control.\r\n\r\nThe day of reckoning for the Reestablishment is coming. But she may not get to choose what side she fights on.', 12, 'uploaded_img/shatterMe-6.jpg'),
(18, 'Shatter Me', 'Tahereh Mafi', 'Fantasy, Dystopia, Romance', 'Shatter Me Series 6-Book Box Set: Shatter Me, Unravel Me, Ignite Me, Restore Me, Defy Me, Imagine Me', 95, 'uploaded_img/shatterMe.jpg'),
(19, 'The Maze Runner', 'James Dashner', 'Young Adult, Dystopia, Science Fiction', 'The Maze Runner Series Complete Collection Boxed Set (5-Book)', 69, 'uploaded_img/mazeRunner.jpg'),
(20, 'Sarah J. Maas Starter Bundle', 'Sarah J. Maas', 'Fantasy, Romance', 'Sarah J. Maas Starter Bundle: A Court of Thorns and Roses, House of Earth and Blood, Throne of Glass', 45, 'uploaded_img/courtOfThrones.jpg'),
(21, 'Slammed Series', 'Colleen Hoover', 'Romance', 'Colleen Hoover Ebook Boxed Set Slammed Series: Slammed, Point of Retreat, This Girl', 34, 'uploaded_img/slammed.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `confirm_password`, `is_admin`) VALUES
(1, 'admin', 'admin', 'admin@bookstore.com', '$2y$10$SEn1DdcVQ6TJ9BJvwG5fZuj80dUSlnB3fbnOXRGVu2gTKMD4IXD1O', '$2y$10$hB4kIp2vGYMgJlVNEnQXveK1gsGjP8jG/Rs3PPxuN99o2LU/rggk.', 1),
(2, 'user', 'user', 'user@gmail.com', '$2y$10$7sZu3bOrGelt48wYSbCeieGfA1wBhG4EdK2cVCxt6BdsyYLEo/0xS', '$2y$10$tIuzRl4TQMBVfbLsgpRLHOdC.hRxQJt5bdtDQnjKlGi4XcxmJVouC', 0),
(3, 'ArijesaMuja', 'Arijesa', 'arijesamujaa@gmail.com', '$2y$10$KAj7rHCpT96rUpy2Zr56TOkhczZydVkMjwKXNXk.66ZCaaf9pT1yq', '$2y$10$ei8VtZYojLoflNOc6Ajnh./RbLrOsnw2IZuMaO5CWBb8a5VEXMjC6', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_user` (`user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_user` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
