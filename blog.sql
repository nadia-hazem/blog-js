-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 24 mars 2023 à 11:17
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `categories` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `image` text NOT NULL,
  `summary` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislikes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `description`, `categories`, `date`, `id_utilisateur`, `image`, `summary`, `likes`, `dislikes`) VALUES
(9, 'Week-end à Prague', 'Les formalités\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices dolor metus, non auctor nisl suscipit at. Suspendisse eget nunc nec sem hendrerit tincidunt a ut nulla. Sed tempor lacus at semper aliquet. Sed placerat lorem nec dignissim mollis. Nullam dui elit, consequat sit amet sapien quis, interdum aliquam ipsum. Fusce gravida vitae tortor eu tempus. Pellentesque ut malesuada est. Duis bibendum leo sit amet iaculis tincidunt.\r\n\r\nMaecenas eleifend porta quam at congue. Aenean mattis molestie lacus, eu semper dui elementum ut. Proin at turpis tortor. Pellentesque ipsum augue, vehicula in dapibus quis, pulvinar a metus. Suspendisse vitae sollicitudin tellus. Cras faucibus, nunc quis gravida egestas, mi urna fringilla nisl, non tincidunt tellus felis in diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi sollicitudin tempus mi dignissim vulputate. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\r\n\r\nNunc maximus lobortis ipsum, ut consequat dui dapibus laoreet. Etiam a dapibus massa. Vestibulum et odio id tortor vulputate congue. Etiam eget velit non velit ullamcorper ornare. Praesent gravida nec urna vitae venenatis. In eu justo eleifend, varius elit non, rhoncus nunc. Vestibulum vitae massa urna. Nam eu luctus velit. Phasellus eleifend, sem ut auctor congue, dui turpis aliquet justo, nec aliquet neque leo sed enim. Vivamus vitae blandit leo, vitae ultricies velit.', '5', '2023-03-11 12:22:57', 1, 'prague.jpg', 'Les formalités\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices dolor metus, non auctor nisl suscipit at. Suspendisse eget nunc...', 0, 0),
(4, 'First complete article', '&quot;Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...&quot;\r\n&quot;There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...&quot;\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tempor nulla elit. Pellentesque mattis euismod dui. Nunc placerat dolor vel purus rhoncus, ut malesuada turpis porttitor. Fusce fermentum quis risus ut aliquam. Etiam turpis orci, tincidunt nec sapien ac, sollicitudin fermentum quam. Aliquam nec massa sem. Morbi vitae aliquam sapien. Proin efficitur lorem augue. Suspendisse potenti. Mauris non iaculis turpis. Integer vel ante faucibus, molestie ipsum et, ornare mi. Maecenas in consequat risus. Etiam eleifend lectus sit amet ex malesuada feugiat. Aliquam pulvinar mauris non ligula fringilla tincidunt. Integer ac orci tincidunt, scelerisque tortor at, lobortis urna. Phasellus in venenatis sem.\r\n\r\nNullam sit amet imperdiet ex. Proin laoreet at nulla at dictum. Cras ante risus, lacinia vitae neque eu, semper imperdiet nisi. Curabitur vel tincidunt eros, a ultricies tellus. Proin nec orci laoreet, euismod nunc non, tempor mi. Donec egestas vitae erat consequat auctor. Phasellus a mi interdum, finibus est hendrerit, porttitor mauris. Suspendisse porttitor gravida consequat. Pellentesque sed maximus nisl, vel venenatis neque. Proin quis volutpat tortor. Morbi aliquet placerat orci, malesuada vulputate libero ultrices eu. Nunc vel ullamcorper mi, ac vehicula enim. Vestibulum eu est sed urna consequat porttitor. Nam ut tristique ligula, vel mollis est.\r\n\r\nPhasellus aliquam ultricies sem. Integer fermentum cursus urna, mattis tincidunt ipsum placerat eget. Quisque ut venenatis elit. Vestibulum diam nisl, suscipit eu lacus ut, eleifend bibendum magna. Integer sed lacus cursus, gravida elit nec, ultrices augue. Etiam iaculis sapien vitae nisl porta, non sollicitudin odio auctor. Aliquam a euismod leo. Sed orci massa, pellentesque hendrerit vehicula id, ultrices quis lorem. In magna elit, scelerisque sed porta non, elementum quis ante.\r\n\r\nMauris ullamcorper nec erat ac hendrerit. Proin libero felis, egestas eu dictum in, vestibulum ut lorem. Donec malesuada, mi nec mattis interdum, ipsum sapien finibus arcu, vitae posuere lacus lacus at eros. Integer eleifend orci id nulla sollicitudin, non sagittis urna elementum. Duis at ipsum feugiat, finibus urna a, sodales lacus. Donec in blandit risus, a auctor massa. Etiam pulvinar nisl convallis sagittis posuere. Sed tempor mauris a neque pulvinar, ac placerat justo fermentum. Etiam feugiat, sapien at molestie ullamcorper, nisi ex molestie leo, ac consectetur lorem sem vitae quam. Vivamus at nulla id libero aliquet rhoncus. Aenean consectetur bibendum nulla facilisis accumsan. Curabitur sed finibus tortor, eu tincidunt nisi. Maecenas efficitur eros a nunc suscipit maximus. Etiam in elit ultrices, sagittis ante id, tincidunt dui.\r\n\r\nDuis ac viverra leo. Donec lacus augue, consequat non leo in, imperdiet auctor dolor. Proin ut semper lacus, ultricies ultricies dolor. Aenean in orci ac nisi scelerisque finibus finibus ut dui. Mauris nulla nisl, porta id quam vel, varius suscipit felis. Etiam nisi tellus, molestie non dignissim sollicitudin, gravida id neque. Vivamus ac lorem interdum, luctus purus sed, sodales ante. Maecenas congue, nisl sed lobortis euismod, elit enim sodales orci, quis pulvinar lectus lacus sed eros. Maecenas enim sem, accumsan at tempus gravida, mollis vitae felis.', '6', '2023-03-09 15:08:03', 1, 'NY.jpg', '', 0, 0),
(5, 'Les Maldives', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin lacus in libero suscipit lacinia. Donec laoreet leo justo, non venenatis diam fermentum quis. Quisque sit amet odio mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean sapien nulla, placerat sed sapien posuere, hendrerit euismod neque. Aliquam iaculis dictum lectus maximus vehicula. Cras sed libero a urna aliquet consectetur. Nulla non faucibus arcu. Duis eget quam augue. Cras pellentesque sollicitudin suscipit. Sed ac turpis ut risus semper iaculis. Sed sodales vestibulum augue, in placerat justo pellentesque id. Nam vel lacinia turpis. Proin mollis molestie dui, quis bibendum nisi elementum at. Pellentesque eget sagittis nibh. Quisque et dignissim mauris.\r\n\r\nUt elit felis, luctus sit amet laoreet a, sollicitudin sit amet purus. Duis non augue vestibulum, sollicitudin erat eget, dictum turpis. Morbi in justo tincidunt, convallis purus nec, faucibus nunc. Mauris consectetur blandit lacus faucibus sagittis. Quisque ornare mi odio. Ut ex felis, vehicula sed ultrices non, vehicula eu ligula. Duis placerat dapibus risus eu blandit.\r\n\r\nMaecenas sagittis mi velit, sed auctor felis mattis ut. Suspendisse potenti. Vestibulum quis aliquam tellus. Etiam scelerisque semper lacus, id cursus lacus sollicitudin eu. In hac habitasse platea dictumst. Fusce iaculis felis nulla, vitae volutpat mauris fermentum sit amet. Vivamus eu velit rhoncus, consectetur mi in, mollis ex. Aliquam vestibulum a turpis sed sodales. In odio libero, dictum vitae mollis et, vestibulum ut neque.', '4', '2023-03-10 01:11:49', 1, 'maldives.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin lacus in libero suscipit lacinia. Donec laoreet leo justo, non venenatis d...', 0, 0),
(6, 'Japan', '<h2>Lorem ipsum dolor sit amet</h2> consectetur adipiscing elit. Donec sollicitudin lacus in libero suscipit lacinia. Donec laoreet leo justo, non venenatis diam fermentum quis. Quisque sit amet odio mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean sapien nulla, placerat sed sapien posuere, hendrerit euismod neque. Aliquam iaculis dictum lectus maximus vehicula. Cras sed libero a urna aliquet consectetur. Nulla non faucibus arcu. Duis eget quam augue. Cras pellentesque sollicitudin suscipit. Sed ac turpis ut risus semper iaculis. Sed sodales vestibulum augue, in placerat justo pellentesque id. Nam vel lacinia turpis. Proin mollis molestie dui, quis bibendum nisi elementum at. Pellentesque eget sagittis nibh. Quisque et dignissim mauris.\r\n\r\nUt elit felis, luctus sit amet laoreet a, sollicitudin sit amet purus. Duis non augue vestibulum, sollicitudin erat eget, dictum turpis. Morbi in justo tincidunt, convallis purus nec, faucibus nunc. Mauris consectetur blandit lacus faucibus sagittis. Quisque ornare mi odio. Ut ex felis, vehicula sed ultrices non, vehicula eu ligula. Duis placerat dapibus risus eu blandit.\r\n\r\nMaecenas sagittis mi velit, sed auctor felis mattis ut. Suspendisse potenti. Vestibulum quis aliquam tellus. Etiam scelerisque semper lacus, id cursus lacus sollicitudin eu. In hac habitasse platea dictumst. Fusce iaculis felis nulla, vitae volutpat mauris fermentum sit amet. Vivamus eu velit rhoncus, consectetur mi in, mollis ex. Aliquam vestibulum a turpis sed sodales. In odio libero, dictum vitae mollis et, vestibulum ut neque.', '4', '2023-03-10 01:18:42', 1, 'japan.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin lacus in libero suscipit lacinia. Donec laoreet leo justo, non venenatis d...', 1, 0),
(7, 'Namibie', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin lacus in libero suscipit lacinia. Donec laoreet leo justo, non venenatis diam fermentum quis. Quisque sit amet odio mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean sapien nulla, placerat sed sapien posuere, hendrerit euismod neque. Aliquam iaculis dictum lectus maximus vehicula. Cras sed libero a urna aliquet consectetur. Nulla non faucibus arcu. Duis eget quam augue. Cras pellentesque sollicitudin suscipit. Sed ac turpis ut risus semper iaculis. Sed sodales vestibulum augue, in placerat justo pellentesque id. Nam vel lacinia turpis. Proin mollis molestie dui, quis bibendum nisi elementum at. Pellentesque eget sagittis nibh. Quisque et dignissim mauris.\r\n\r\nUt elit felis, luctus sit amet laoreet a, sollicitudin sit amet purus. Duis non augue vestibulum, sollicitudin erat eget, dictum turpis. Morbi in justo tincidunt, convallis purus nec, faucibus nunc. Mauris consectetur blandit lacus faucibus sagittis. Quisque ornare mi odio. Ut ex felis, vehicula sed ultrices non, vehicula eu ligula. Duis placerat dapibus risus eu blandit.\r\n\r\nMaecenas sagittis mi velit, sed auctor felis mattis ut. Suspendisse potenti. Vestibulum quis aliquam tellus. Etiam scelerisque semper lacus, id cursus lacus sollicitudin eu. In hac habitasse platea dictumst. Fusce iaculis felis nulla, vitae volutpat mauris fermentum sit amet. Vivamus eu velit rhoncus, consectetur mi in, mollis ex. Aliquam vestibulum a turpis sed sodales. In odio libero, dictum vitae mollis et, vestibulum ut neque.', '3', '2023-03-10 01:21:02', 1, 'namibie.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin lacus in libero suscipit lacinia. Donec laoreet leo justo, non venenatis d...', 0, 0),
(8, 'Londres', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc egestas consectetur nisi non cursus. Quisque tristique arcu felis, a imperdiet dui iaculis vel. Aenean consectetur metus at velit porta gravida. Donec pulvinar metus quis eros consectetur, varius pretium ex venenatis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer ut purus lectus. Cras viverra auctor erat et vulputate. Aliquam id eros fermentum, venenatis ex ac, hendrerit leo. Nunc interdum mauris cursus ex bibendum malesuada eu sit amet massa. Aliquam ut neque volutpat, viverra magna vitae, lacinia risus. Donec volutpat risus nec nisi venenatis suscipit. Morbi dignissim quis mauris sed consequat. Donec cursus urna eget ex convallis, feugiat porttitor leo blandit. Sed ac lobortis quam. Vestibulum vitae libero eget ex ornare elementum eu id risus. Aliquam lorem metus, maximus ut mollis rhoncus, interdum vel nunc.\r\n\r\nInteger pretium mattis massa at tempor. Phasellus tincidunt maximus diam, a ultricies tellus. Donec imperdiet sed erat ac consequat. Fusce eget ex cursus, efficitur dui eu, lacinia sapien. Sed cursus lacus a est luctus, cursus hendrerit mauris rutrum. Proin rhoncus ex velit, non fermentum tellus elementum nec. Duis aliquam faucibus eleifend. Etiam convallis scelerisque massa sed luctus. Sed in mattis arcu.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque vel augue odio. Integer vel justo a enim tempor tincidunt eu at lectus. Sed eros metus, lobortis sed porta nec, pellentesque sit amet ligula. Cras quis risus nec odio consectetur vestibulum id et quam. Nulla et faucibus quam. Sed vitae ipsum blandit, mattis eros nec, eleifend magna. Vestibulum luctus vestibulum lorem vel semper. Proin elementum sollicitudin ante, vitae dignissim libero convallis quis. Nunc dictum nunc vitae velit hendrerit, vel sodales nisl congue.', '5', '2023-03-10 12:25:47', 1, 'londres.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc egestas consectetur nisi non cursus. Quisque tristique arcu felis, a imperdiet dui iacul...', 0, 0),
(10, 'Indonésie spirituelle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices dolor metus, non auctor nisl suscipit at. Suspendisse eget nunc nec sem hendrerit tincidunt a ut nulla. Sed tempor lacus at semper aliquet. Sed placerat lorem nec dignissim mollis. Nullam dui elit, consequat sit amet sapien quis, interdum aliquam ipsum. Fusce gravida vitae tortor eu tempus. Pellentesque ut malesuada est. Duis bibendum leo sit amet iaculis tincidunt.\r\n\r\nMaecenas eleifend porta quam at congue. Aenean mattis molestie lacus, eu semper dui elementum ut. Proin at turpis tortor. Pellentesque ipsum augue, vehicula in dapibus quis, pulvinar a metus. Suspendisse vitae sollicitudin tellus. Cras faucibus, nunc quis gravida egestas, mi urna fringilla nisl, non tincidunt tellus felis in diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi sollicitudin tempus mi dignissim vulputate. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\r\n\r\nNunc maximus lobortis ipsum, ut consequat dui dapibus laoreet. Etiam a dapibus massa. Vestibulum et odio id tortor vulputate congue. Etiam eget velit non velit ullamcorper ornare. Praesent gravida nec urna vitae venenatis. In eu justo eleifend, varius elit non, rhoncus nunc. Vestibulum vitae massa urna. Nam eu luctus velit. Phasellus eleifend, sem ut auctor congue, dui turpis aliquet justo, nec aliquet neque leo sed enim. Vivamus vitae blandit leo, vitae ultricies velit.', '4', '2023-03-11 12:23:49', 1, 'indonesie.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices dolor metus, non auctor nisl suscipit at. Suspendisse eget nunc nec sem hendreri...', 0, 0),
(11, 'Surprenante Hambourg', 'Hambourg, grande ville portuaire du nord de l\'Allemagne, est reliée à la mer du Nord par le fleuve Elbe. Traversée de centaines de canaux, elle comporte également de vastes parcs. À proximité de son centre, le plan d\'eau Binnenalster est parsemé de bateaux et bordé de cafés. Le boulevard Jungfernstieg, en plein centre, relie la Neustadt (nouvelle ville) à l\'Altstadt (vieille ville), où se trouvent de nombreuses attractions, notamment l\'église Saint Michel, datant du XVIIIe siècle. \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices dolor metus, non auctor nisl suscipit at. Suspendisse eget nunc nec sem hendrerit tincidunt a ut nulla. Sed tempor lacus at semper aliquet. Sed placerat lorem nec dignissim mollis. Nullam dui elit, consequat sit amet sapien quis, interdum aliquam ipsum. Fusce gravida vitae tortor eu tempus. Pellentesque ut malesuada est. Duis bibendum leo sit amet iaculis tincidunt.\r\n\r\nMaecenas eleifend porta quam at congue. Aenean mattis molestie lacus, eu semper dui elementum ut. Proin at turpis tortor. Pellentesque ipsum augue, vehicula in dapibus quis, pulvinar a metus. Suspendisse vitae sollicitudin tellus. Cras faucibus, nunc quis gravida egestas, mi urna fringilla nisl, non tincidunt tellus felis in diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi sollicitudin tempus mi dignissim vulputate. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\r\n\r\nNunc maximus lobortis ipsum, ut consequat dui dapibus laoreet. Etiam a dapibus massa. Vestibulum et odio id tortor vulputate congue. Etiam eget velit non velit ullamcorper ornare. Praesent gravida nec urna vitae venenatis. In eu justo eleifend, varius elit non, rhoncus nunc. Vestibulum vitae massa urna. Nam eu luctus velit. Phasellus eleifend, sem ut auctor congue, dui turpis aliquet justo, nec aliquet neque leo sed enim. Vivamus vitae blandit leo, vitae ultricies velit.', '5', '2023-03-11 12:25:52', 1, 'hamburg.jpg', 'Hambourg, grande ville portuaire du nord de l\'Allemagne, est reliée à la mer du Nord par le fleuve Elbe. Traversée de centaines de canaux, elle com...', 0, 0),
(12, 'Les Maldives', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin lacus in libero suscipit lacinia. Donec laoreet leo justo, non venenatis diam fermentum quis. Quisque sit amet odio mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean sapien nulla, placerat sed sapien posuere, hendrerit euismod neque. Aliquam iaculis dictum lectus maximus vehicula. Cras sed libero a urna aliquet consectetur. Nulla non faucibus arcu. Duis eget quam augue. Cras pellentesque sollicitudin suscipit. Sed ac turpis ut risus semper iaculis. Sed sodales vestibulum augue, in placerat justo pellentesque id. Nam vel lacinia turpis. Proin mollis molestie dui, quis bibendum nisi elementum at. Pellentesque eget sagittis nibh. Quisque et dignissim mauris. Ut elit felis, luctus sit amet laoreet a, sollicitudin sit amet purus. Duis non augue vestibulum, sollicitudin erat eget, dictum turpis. Morbi in justo tincidunt, convallis purus nec, faucibus nunc. Mauris consectetur blandit lacus faucibus sagittis. Quisque ornare mi odio. Ut ex felis, vehicula sed ultrices non, vehicula eu ligula. Duis placerat dapibus risus eu blandit. Maecenas sagittis mi velit, sed auctor felis mattis ut. Suspendisse potenti. Vestibulum quis aliquam tellus. Etiam scelerisque semper lacus, id cursus lacus sollicitudin eu. In hac habitasse platea dictumst. Fusce iaculis felis nulla, vitae volutpat mauris fermentum sit amet. Vivamus eu velit rhoncus, consectetur mi in, mollis ex. Aliquam vestibulum a turpis sed sodales. In odio libero, dictum vitae mollis et, vestibulum ut neque.', '5', '2023-03-11 22:09:28', 1, '1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin lacus in libero suscipit lacinia. Donec laoreet leo justo, non venenatis d...', 0, 0),
(16, 'Sydney', 'Nam sollicitudin enim quis metus hendrerit, eget hendrerit tellus vehicula. Curabitur dui turpis, sagittis in dapibus ac, consectetur vel nunc. Nunc vulputate felis elit, vitae sodales mi mollis eget. Proin ullamcorper facilisis tortor, vel fringilla dui. Fusce hendrerit pulvinar ligula at rutrum. Aliquam risus erat, elementum ut justo quis, porttitor tempor nunc. Quisque consectetur ex congue pulvinar mattis. Integer venenatis eu nunc at tincidunt. Mauris varius interdum aliquam. Sed a condimentum elit, ac maximus nulla. Pellentesque et porta massa. Pellentesque vel lectus at lacus eleifend venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices urna elit, ut faucibus neque iaculis a.', '6', '2023-03-13 14:11:38', 1, 'sydney.jpg', 'Nam sollicitudin enim quis metus hendrerit, eget hendrerit tellus vehicula. Curabitur dui turpis, sagittis in dapibus ac, consectetur vel nunc. Nunc v...', 0, 0),
(17, 'Alberta, Canada', 'Lorem ipsum\r\ndolor&amp;nbsp;sit amet, consectetur adipiscing elit. Cras placerat ornare metus sed scelerisque. Cras tristique rhoncus accumsan. Curabitur eleifend varius justo nec facilisis.&amp;nbsp;Mauris&amp;nbsp;dictum odio in tellus luctus molestie. Mauris tempor turpis mattis lorem accumsan molestie. Pellentesque eget pulvinar urna, id maximus neque. Proin nec congue lorem. Curabitur molestie lectus eu arcu egestas venenatis. Nunc vel odio placerat sem rhoncus volutpat.\r\nSed iaculis\r\ncommodo justo, id tincidunt velit. Fusce vitae risus consectetur risus interdum congue. Morbi vitae sagittis quam. Nam at felis enim. Integer in urna posuere, maximus dolor ullamcorper, tincidunt risus.\r\nSuspendisse maximus massa in felis ultrices pulvinar. Vivamus dictum fringilla finibus. Curabitur non viverra neque, aliquet sagittis mauris. Nullam eget mi bibendum, semper justo et, efficitur orci. In vitae erat elit. Aenean pretium lectus et porta aliquam. Maecenas efficitur aliquam vestibulum. Cras condimentum mollis egestas. Proin molestie malesuada arcu, ut auctor neque commodo sed.', '1', '2023-03-21 11:46:19', 1, 'alberta.jpg', 'Lorem ipsum\r\ndolor&amp;nbsp;sit amet, consectetur adipiscing elit. Cras placerat ornare metus sed scelerisque. Cras tristique rhoncus accumsan. Curabi...', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `categorie`) VALUES
(1, 'Amérique/Nord'),
(2, 'Amérique/Sud'),
(3, 'Afrique'),
(4, 'Asie'),
(5, 'Europe'),
(6, 'Océanie');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` varchar(255) DEFAULT NULL,
  `commentaire` text,
  `date` datetime NOT NULL,
  `id_article` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_article` (`id_article`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `sujet`, `commentaire`, `date`, `id_article`, `id_utilisateur`) VALUES
(1, 'premier test', 'test de commentaire', '2023-03-14 10:52:15', 11, 1),
(2, 'test 2', 'ceci est un test', '2023-03-14 11:30:53', 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `droit` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `droit`) VALUES
(1, 'admin', '$2y$10$mjOzUAISXGSykqZtiuqYpOBs8UYZwIBRx6eoR5g6pB3xQVkPYfRz6', 'admin'),
(2, 'nadia', '$2y$10$1XO1pci9kQ9Lq96lPFRLceAOqaDfBNbTA8lC4sCBCu4GHzfvZo1Ea', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `valeur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`id`, `id_article`, `id_utilisateur`, `valeur`) VALUES
(2, 6, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
