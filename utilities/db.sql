-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2017 at 10:05 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `behrndc`
--
CREATE DATABASE `behrndc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `behrndc`;

-- --------------------------------------------------------

--
-- Table structure for table `bookauthors`
--

CREATE TABLE IF NOT EXISTS `bookauthors` (
  `AuthorID` int(11) NOT NULL AUTO_INCREMENT,
  `nameF` varchar(15) NOT NULL,
  `nameL` varchar(15) NOT NULL,
  PRIMARY KEY (`AuthorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `bookauthors`
--

INSERT INTO `bookauthors` (`AuthorID`, `nameF`, `nameL`) VALUES
(1, 'Jason', 'Gilmore'),
(2, 'David', 'Sklar'),
(3, 'Luke', 'Welling'),
(4, 'Laura', 'Thomson'),
(5, 'Steve', 'Krug'),
(6, 'Ben', 'Forta'),
(8, 'Jakob', 'Nielsen'),
(9, 'Hoa', 'Loranger'),
(11, 'Alan', 'Beaulieu'),
(12, 'Jesse', 'Liberty'),
(13, 'Dan', 'Hurwitz'),
(14, 'Michele E.', 'Davis'),
(15, 'John A.', 'Phillips'),
(16, 'Jeffrey', 'Friedl'),
(17, 'Michael J.', 'Hernandez'),
(18, 'John L.', 'Viescas'),
(22, 'Stephan', 'Walther'),
(23, 'Andrew', 'Watt'),
(24, 'Eric', 'Rosebrok'),
(25, 'Kevin', 'Tatroe'),
(26, 'Rasmus', 'Lerdorf'),
(27, 'Peter', 'MacIntyre'),
(29, 'Matthew', 'MacDonald'),
(30, 'Julian', 'Templeman'),
(31, 'Thomas', 'Erl'),
(32, 'Hugh E.', 'Williams'),
(33, 'David', 'Lane');

-- --------------------------------------------------------

--
-- Table structure for table `bookauthorsbooks`
--

CREATE TABLE IF NOT EXISTS `bookauthorsbooks` (
  `ISBN` varchar(15) NOT NULL,
  `AuthorID` int(11) NOT NULL,
  PRIMARY KEY (`ISBN`,`AuthorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookauthorsbooks`
--

INSERT INTO `bookauthorsbooks` (`ISBN`, `AuthorID`) VALUES
('0131428985', 31),
('0201433362', 17),
('0201433362', 18),
('0321344758', 5),
('0321350316', 8),
('0321350316', 9),
('0596005431', 33),
('0596005601', 2),
('0596006810', 25),
('0596006810', 26),
('0596006810', 27),
('0596007272', 11),
('059600916X', 12),
('059600916X', 13),
('0596101104', 14),
('0596101104', 15),
('0596528124', 16),
('0672325675', 6),
('0672326728', 3),
('0672326728', 4),
('0672328232', 22),
('0764574892', 23),
('0782142796', 24),
('1590595521', 1),
('1590595726', 29),
('1590595726', 30);

-- --------------------------------------------------------

--
-- Table structure for table `bookcategories`
--

CREATE TABLE IF NOT EXISTS `bookcategories` (
  `CategoryID` int(4) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(20) NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `bookcategories`
--

INSERT INTO `bookcategories` (`CategoryID`, `CategoryName`) VALUES
(1, 'PHP'),
(2, 'MySQL'),
(3, 'Web Usability'),
(4, 'SQL'),
(5, 'ASP.NET'),
(6, 'Regular Expressions'),
(7, 'Web Services'),
(8, 'Morse Code');

-- --------------------------------------------------------

--
-- Table structure for table `bookcategoriesbooks`
--

CREATE TABLE IF NOT EXISTS `bookcategoriesbooks` (
  `CategoryID` int(4) NOT NULL,
  `ISBN` varchar(15) NOT NULL,
  PRIMARY KEY (`CategoryID`,`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookcategoriesbooks`
--

INSERT INTO `bookcategoriesbooks` (`CategoryID`, `ISBN`) VALUES
(1, '0131428985'),
(1, '0596005431'),
(1, '0596005601'),
(1, '0596006810'),
(1, '0596101104'),
(1, '0672326728'),
(1, '0782142796'),
(1, '1590595521'),
(2, '0596005431'),
(2, '0596101104'),
(2, '0672326728'),
(2, '1590595521'),
(3, '0321344758'),
(3, '0321350316'),
(4, '0201433362'),
(4, '0596007272'),
(4, '0672325675'),
(5, '059600916X'),
(5, '0672328232'),
(5, '1590595726'),
(6, '0596528124'),
(6, '0764574892'),
(7, '0131428985'),
(7, '0782142796');

-- --------------------------------------------------------

--
-- Table structure for table `bookcomments`
--

CREATE TABLE IF NOT EXISTS `bookcomments` (
  `isbn` int(11) NOT NULL,
  `comment` varchar(400) NOT NULL,
  `title` varchar(110) NOT NULL,
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`commentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `bookcomments`
--

INSERT INTO `bookcomments` (`isbn`, `comment`, `title`, `commentID`) VALUES
(596528124, 'love this book dude', 'rocks', 13);

-- --------------------------------------------------------

--
-- Table structure for table `bookcustomers`
--

CREATE TABLE IF NOT EXISTS `bookcustomers` (
  `custID` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `street` varchar(25) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(5) NOT NULL,
  PRIMARY KEY (`custID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `bookcustomers`
--

INSERT INTO `bookcustomers` (`custID`, `fname`, `lname`, `email`, `street`, `city`, `state`, `zip`) VALUES
(1, 'Tom', 'Clancy', 'Tom@Clancy.com', '1 Tom Clancy Dr', 'CINCINNATI', 'OH', '45249'),
(2, 'Dalia', 'Cross', 'daliacross@email.com', '9551 Fletcher Street', 'Helmetta', 'WA', '08828'),
(24, 'Colby', 'Behrndt', 'colbehr@gmail.com', '1450 Chuckanut Crest Dr', 'Bellingham', 'WA', '98229'),
(66, 'ww', 'ww', 'nwe@em.c', '2ww', 'ww', 'WA', '77877'),
(67, 'ww', 'ww', 'nwe@em.c', '2ww', 'ww', 'WA', '77877'),
(68, 'name', 'lname', 'new@cust2.com', '4street', 'blah', 'WA', '98229'),
(69, 'name', 'lname', 'new@cust22.com', '4street', 'blah', 'WA', '98229'),
(70, 'name', 'lname', 'new@cust22.com', '4street', 'blah', 'WA', '98229'),
(71, 'name', 'lname', 'new@cust22.com', '4street', 'blah', 'WA', '98229'),
(72, 'name', 'lname', 'new@cust1.com', '4street', 'blah', 'WA', '98229'),
(73, 'name', 'lname', 'new@cust1.com', '4street', 'blah', 'WA', '98229'),
(74, 'name', 'lname', 'new@cust23.com', '4street', 'blah', 'WA', '98229'),
(75, 'name', 'lname', 'new@cust1.com4', '4street', 'blah', 'WA', '98229'),
(76, 'name', 'lname', 'nwe@em.c22', '4street', 'blah', 'WA', '98229'),
(77, 'name', 'lname', 'nwe@em.c22', '4street', 'blah', 'WA', '98229'),
(78, 'name', 'lname', 'nwe@em.c22', '4street', 'blah', 'WA', '98229'),
(79, 'name', 'lname', 'new@cust1.com42', '4street', 'blah', 'WA', '98229'),
(80, 'name', 'lname', 'new@cust1.com42', '4street', 'blah', 'WA', '98229'),
(81, 'name', 'lname', 'new@cust1.com42', '4street', 'blah', 'WA', '98229'),
(82, 'Chris', 'Sandvigg', 'csandvig@wwu.edu', '515 High St', 'Bellingham', 'WA', '98225'),
(83, 'dave', 'mer', 'dave@me.com', '1ff', 'dfds', 'WA', '92292'),
(84, 'dave', 'mer', 'dave@me.com', '1ff', 'dfds', 'WA', '92292'),
(85, 'wa', 'wawa', 'dave@aaaaaaaaaaaaaaamm.com', '1beea', 'bee', 'WA', '23232'),
(86, 'ff', 'Ff', 'newcust@dfds432432423.co', '2ff', 'ff', 'LA', '33333'),
(87, 'Fname', 'lname', 'c@c.c', '1010 d', 'city', 'WA', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `bookdescriptions`
--

CREATE TABLE IF NOT EXISTS `bookdescriptions` (
  `ISBN` varchar(15) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `pubdate` varchar(25) NOT NULL,
  `edition` varchar(5) NOT NULL,
  `pages` varchar(5) NOT NULL,
  PRIMARY KEY (`ISBN`),
  KEY `strTitle` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookdescriptions`
--

INSERT INTO `bookdescriptions` (`ISBN`, `title`, `description`, `price`, `publisher`, `pubdate`, `edition`, `pages`) VALUES
('0131428985', 'Service-Oriented Architecture : A Field Guide to Integrating XML and Web Services', '<p>The emergence of key second-generation Web  services standards has positioned service-oriented architecture (SOA)  as the foremost platform for contemporary business automation  solutions. The integration of SOA principles and technology is  empowering organizations to build applications with unprecedented  levels of flexibility, agility, and sophistication (while also allowing  them to leverage existing legacy environments).</p><p>This  guide will help you dramatically reduce the risk, complexity, and cost  of integrating the many new concepts and technologies introduced by the  SOA platform. It brings together the first comprehensive collection of  field-proven strategies, guidelines, and best practices for making the  transition toward the service-oriented enterprise.</p><p>Writing  for architects, analysts, managers, and developers, Thomas Erl offers  expert advice for making strategic decisions about both immediate and  long-term integration issues. Erl addresses a broad spectrum of  integration challenges, covering technical and design issues, as well  as strategic planning.</p><ul>  <li>Covers crucial second-generation  (WS-*) Web services standards: BPEL4WS, WS-Security, S-Coordination,  WS-Transaction, WS-Policy, WS-ReliableMessaging, and WS-Attachments </li>  <li>Includes  hundreds of individual integration strategies and more than 60 best  practices for both XML and Web services technologies </li>  <li>Includes a complete tutorial on service-oriented design principles for business and technical modeling </li>  <li>Explores  design issues related to a wide variety of service-oriented integration  architectures that integrate XML and Web services into legacy and EAI  environments </li>  <li>Provides a clear roadmap for planning a long-term migration toward a standardized service-oriented enterprise</li></ul><p>Service-oriented  architecture is no longer an exclusive discipline practiced only by  expensive consultants. With this book''s help, you can plan, architect,  and implement your own service-oriented environments-efficiently and  cost-effectively.</p>', '44.95', 'Prentice Hall', 'April 16, 2004', '1', '560'),
('0201433362', 'SQL Queries for Mere Mortals: A Hands-On Guide to Data Manipulation in SQL ', '<p>To the people who are accomplished in its use, Structured Query  Language (SQL) is a highly capable, eminently flexible, even beautiful  way of describing the data that you want from a database, or the  changes that you want to make to a database. For the rest of us,  however, SQL is a first-class nuisance that we do our best to avoid by  relying on relatively user-friendly--but usually less powerful--tools. <em>SQL Queries for Mere Mortals</em> aims to bring SQL-phobes  closer to the first camp by tutoring them carefully in what SQL can do.<p> The authors recognize that SQL queries usually come about as a result  of questions from human beings, and so usefully spend a fair bit of  time showing how to convert, say, &quot;In what cities do our customers  live?&quot; into, &quot;Select city from the customers table&quot; and, finally,  &quot;SELECT city FROM customers&quot; in SQL. They call this the &quot;translation  and clean up&quot; process, and it''s a fine approach. They don''t press it  too far, however, and are equally adept at presenting straight  explanations of SQL syntax elements in prose. They spend a lot of  energy graphically diagramming aspects of SQL syntax in a format that  requires some up-front study. A particular reader might prefer text  capsules to this arrow-intensive format, but other learners might like  the graphical syntax diagrams. <em>--David Wall</em></p>', '54.99', 'Addison-Wesley Professional', 'August 21, 2000', '1', '528'),
('0321344758', 'Don''t Make Me Think', '<p>Usability design is one of the most important--yet often least attractive--tasks for a Web developer. In <em>Don''t Make Me Think</em>, author Steve Krug lightens up the subject with good humor and excellent, to-the-point examples.</p><p> The title of the book is its chief personal design premise. All of the  tips, techniques, and examples presented revolve around users being  able to surf merrily through a well-designed site with minimal  cognitive strain. Readers will quickly come to agree with many of the  book''s assumptions, such as &quot;We don''t read pages--we scan them&quot; and &quot;We  don''t figure out how things work--we muddle through.&quot; Coming to grips  with such hard facts sets the stage for Web design that then produces  topnotch sites.</p><p> Using an attractive mix of full-color screen  shots, cute cartoons and diagrams, and informative sidebars, the book  keeps your attention and drives home some crucial points. Much of the  content is devoted to proper use of conventions and content layout, and  the &quot;before and after&quot; examples are superb. Topics such as the wise use  of rollovers and usability testing are covered using a consistently  practical approach.</p><p> This is the type of book you can blow  through in a couple of evenings. But despite its conciseness, it will  give you an expert''s ability to judge Web design. You''ll never form a  first impression of a site in the same way again. <em>--Stephen W. Plain</em></p><p> <strong>Topics covered:</strong> </p><ul>  <li>User patterns </li>  <li>Designing for scanning </li>  <li>Wise use of copy </li>  <li>Navigation design </li>  <li>Home page layout </li>  <li>Usability testing</li></ul>', '35.00', 'New Riders Press', 'Aug. 18, 2005', '2', '224'),
('0321350316', 'Prioritizing Web Usability', '<p>In 2000, Jakob Nielsen, the world''s leading expert on Web usability, published a book that changed how people think about the Web''Designing Web Usability (New Riders). Many applauded. A few jeered. But everyone listened. The best-selling usability guru is back and has revisited his classic guide, joined forces with Web usability consultant Hoa Loranger, and created an updated companion book that covers the essential changes to the Web and usability today. Prioritizing Web Usability is the guide for anyone who wants to take their Web site(s) to next level and make usability a priority! Through the authors'' wisdom, experience, and hundreds of real-world user tests and contemporary Web site critiques, you''ll learn about site design, user experience and usability testing, navigation and search capabilities, old guidelines and prioritizing usability issues, page design and layout, content design, and more!</p>', '50.00', 'New Riders Press', 'April 20, 2006', '1', '432'),
('0596005431', 'Web Database Applications with PHP & MySQL', '<p> There are many reasons for serving up dynamic content from a web  site: to offer an online shopping site, create customized information  pages for users, or just manage a large volume of content through a  database. Anyone with a modest knowledge of HTML and web site  management can learn to create dynamic content through the PHP  programming language and the MySQL database. This book gives you the  background and tools to do the job safely and reliably. <em>Web Database Applications with PHP and MySQL</em>,  Second Edition thoroughly reflects the needs of real-world  applications. It goes into detail on such practical issues as  validating input (do you know what a proper credit card number looks  like?), logging in users, and using templates to give your dynamic web  pages a standard look. But this book goes even further. It shows how  JavaScript and PHP can be used in tandem to make a user''s experience  faster and more pleasant. It shows the correct way to handle errors in  user input so that a site looks professional. It introduces the vast  collection of powerful tools available in the PEAR repository and shows  how to use some of the most popular tools. Even while it serves as an  introduction to new programmers, the book does not omit critical tasks  that web sites require. For instance, every site that allows updates  must handle the possibility of multiple users accessing data at the  same time. This book explains how to solve the problem in detail with  locking. Through a sophisticated sample application--Hugh and Dave''s  Wine Store--all the important techniques of dynamic content are  introduced. Good design is emphasized, such as dividing logic from  presentation. The book introduces PHP 5 and MySQL 4.1 features, while  providing techniques that can be used on older versions of the software  that are still in widespread use. This new edition has been redesigned  around the rich offerings of PEAR. Several of these, including the  Template package and the database-independent query API, are fully  integrated into examples and thoroughly described in the text. Topics  include:</p><ul>  <li>Installation and configuration of Apache, MySQL, and PHP on Unix&reg;, Windows&reg;, and Mac OS&reg; X systems</li>  <li>Introductions to PHP, SQL, and MySQL administration</li>  <li>Session management, including the use of a custom database for improved efficiency</li>  <li>User input validation, security, and authentication</li>  <li>The PEAR repository, plus details on the use of PEAR DB and Template classes</li>  <li>Production of PDF reports</li></ul>', '44.95', 'O''Reilly Media', 'May 16, 2004', '2', '680'),
('0596005601', 'Learning PHP 5', '<p>PHP has gained a following among non-technical web designers who need  to add interactive aspects to their sites. Offering a gentle learning  curve, PHP is an accessible yet powerful language for creating dynamic  web pages. As its popularity has grown, PHP''s basic feature set has  become increasingly more sophisticated. Now PHP 5 boasts advanced  features--such as new object-oriented capabilities and support for XML  and Web Services--that will please even the most experienced web  professionals while still remaining user-friendly enough for those with  a lower tolerance for technical jargon. If you''ve wanted to try your  hand at PHP but haven''t known where to start, then <em>Learning PHP 5</em> is the book you need. If you''ve wanted to try your hand at PHP but haven''t known where to start, then <em>Learning PHP 5</em> is the book you need. With attention to both PHP 4 and the new PHP  version 5, it provides everything from a explanation of how PHP works  with your web server and web browser to the ins and outs of working  with databases and HTML forms. Written by the co-author of the popular <em>PHP Cookbook</em>, this book is for intelligent (but not necessarily highly-technical) readers. <em>Learning PHP 5</em> guides you through every aspect of the language you''ll need to master  for professional web programming results. This book provides a hands-on  learning experience complete with exercises to make sure the lessons  stick. <em>Learning PHP 5</em> covers the following topics, and more:</p><ul>  <li>How PHP works with your web browser and web server</li>  <li>PHP language basics, including data, variables, logic and looping</li>  <li>Working with arrays and functions</li>  <li>Making web forms</li>  <li>Working with databases like MySQL</li>  <li>Remembering users with sessions</li>  <li>Parsing and generating XML</li>  <li>Debugging</li></ul><p>Written by David Sklar, coauthor of the <em>PHP Cookbook</em> and an instructor in PHP, this book offers the ideal classroom learning  experience whether you''re in a classroom or on your own. From learning  how to install PHP to designing database-backed web applications, <em>Learning PHP 5</em> will guide you through every aspect of the language you''ll need to master to achieve professional web programming results.</p>', '29.95', 'O''Reilly Media', 'July 2004', '1', '348'),
('0596006810', 'Programming PHP', '<p><em>Programming PHP</em>, 2nd Edition, is the authoritative guide to  PHP 5 and is filled with the unique knowledge of the creator of PHP  (Rasmus Lerdorf) and other PHP experts. When it comes to creating  websites, the PHP scripting language is truly a red-hot property. In  fact, PHP is currently used on more than 19 million websites,  surpassing Microsoft''s ASP .NET technology in popularity. Programmers  love its flexibility and speed; designers love its accessibility and  convenience. </p><p> As the industry standard book on PHP, all of the  essentials are covered in a clear and concise manner. Language syntax  and programming techniques are coupled with numerous examples that  illustrate both correct usage and common idioms. With style tips and  practical programming advice, this book will help you become not just a  PHP programmer, but a <em>good</em> PHP programmer. <em>Programming PHP, Second Edition</em> covers everything you need to know to create effective web applications with PHP. Contents include:</p><ul>  <li>Detailed information on the basics of the PHP language, including data types, variables, operators, and flow control statements</li>  <li>Chapters outlining the basics of functions, strings, arrays, and objects</li>  <li>Coverage of common PHP web application techniques, such as form processing and validation, session tracking, and cookies</li>  <li>Material  on interacting with relational databases, such as MySQL and Oracle,  using the database-independent PEAR DB library and the new PDO Library</li>  <li>Chapters that show you how to generate dynamic images, create PDF files, and parse XML files with PHP</li>  <li>Advanced  topics, such as creating secure scripts, error handling, performance  tuning, and writing your own C language extensions to PHP</li>  <li>A handy quick reference to all the core functions in PHP and all the standard extensions that ship with PHP</li></ul>', '26.39', 'O''Reilly Media', 'April 1, 2006', '2', '521'),
('0596007272', 'Learning SQL', '<p>SQL (Structured Query Language) is a standard programming language for  generating, manipulating, and retrieving information from a relational  database. If you''re working with a relational database--whether you''re  writing applications, performing administrative tasks, or generating  reports--you need to know how to interact with your data. Even if you  are using a tool that generates SQL for you, such as a reporting tool,  there may still be cases where you need to bypass the automatic  generation feature and write your own SQL statements.</p><p> To help you attain this fundamental SQL knowledge, look to <em>Learning SQL</em>, an introductory guide to SQL, designed primarily for developers just cutting their teeth on the language. </p><p> <em>Learning SQL</em> moves you quickly through the basics and then on to some of the more  commonly used advanced features. Among the topics discussed: </p><ul>  <li>The history of the computerized database </li>  <li>SQL  Data Statements--those used to create, manipulate, and retrieve data  stored in your database; example statements include select, update,  insert, and delete </li>  <li>SQL Schema Statements--those used to create database objects, such as tables, indexes, and constraints </li>  <li>How data sets can interact with queries </li>  <li>The importance of subqueries </li>  <li>Data conversion and manipulation via SQL''s built-in functions </li>  <li>How conditional logic can be used in Data Statements</li></ul><p>Best of all, <em>Learning SQL</em> talks to you in a real-world manner, discussing various platform  differences that you''re likely to encounter and offering a series of  chapter exercises that walk you through the learning process. Whenever  possible, the book sticks to the features included in the ANSI SQL  standards. This means you''ll be able to apply what you learn to any of  several different databases; the book covers MySQL, Microsoft SQL  Server, and Oracle Database, but the features and syntax should apply  just as well (perhaps with some tweaking) to IBM DB2, Sybase Adaptive  Server, and PostgreSQL.</p><p> Put the power and flexibility of SQL to work. With <em>Learning SQL</em> you can master this important skill and know that the SQL statements you write are indeed correct.</p>', '34.95', 'O''Reilly Media', 'August 22, 2005', '1', '289'),
('059600916X', 'Programming ASP.NET', '<p>Suitable for most any programmer who wants to master ASP.NET with an eye toward real-world development, <em>Programming ASP.NET</em> is an excellent resource that mixes good coverage of APIs with actual  programming techniques and advice using Visual Basic .NET and C#. The  combination places it in the forefront of currently available titles on  ASP.NET.</p><p>Written in part by veteran computer author Jesse Liberty,  this book offers an excellent mix of coverage of important ASP.NET  features that you will absolutely need to use for real-world  programming. Readers with previous ASP experience will appreciate early  sections that compare an older ASP sample with the new ASP.NET to  highlight what''s new and improved, with good explanation of the ASP.NET  event model. The pace of this book is just excellent. The authors first  move through the essentials, like basic ASP Web controls and data  binding, before delving into data-driven applications using the  (slightly complicated) ASP.NET database APIs. It also helps that the  authors let you use Notepad (or another text editor) to create your  ASP.NET programs first. (Later, they cover the details of Visual Studio  .NET, pointing out how this tool can sometimes make it difficult to see  where your code is generated.) There''s also coverage of debugging and  tracing techniques.</p><p>Standout sections on the calendar, <em>Repeater</em>, <em>DataList</em>, and <em>DataGrid</em> controls (all presented in good detail) will help you master these  important controls. Coverage of techniques and support for validating  user input in Web pages will also help you use these essential features.</p><p>The  author''s well-measured tutorial on Web services (much touted by  Microsoft) is as good as any. Their demos (using a well-traveled  example of a stock ticker server) will show you what all the fuss is  about. They cut through the hype here and manage to show why Web  services are a potentially better way toward distributed computing.  Later sections look at deployment, configuration, and performance (as  well as caching) options that you''ll need to deploy and run your  ASP.NET programs successfully. Coverage of security options in .NET  rounds out the tour of what you''ll need to create real applications.</p><p>Illustrated throughout with samples from VB .NET and C#, <em>Programming ASP.NET</em> is a worthy addition to the O''Reilly lineup and one of the best  available titles for learning ASP.NET. The authors have achieved an  excellent balance of practical, hands-on examples and essential  programming techniques with the most important APIs and features, all  without getting bogged down in the richness and complexity of .NET  itself. <em>--Richard Dragan</em> </p><p> <strong>Topics covered:</strong> Introduction to the .NET platform and ASP.NET; basic programs in HTML;  ASP and ASP.NET compared; events in ASP.NET (application, session,  page, and control events); HTML and ASP controls compared; basic ASP  controls APIs (including in-depth coverage of calendar support); code  behind forms; using the Visual Studio .NET IDE; tracing, debugging, and  error handling; validation controls in ASP.NET (including built-in and  custom validators, plus regular expression support); basic data-binding  techniques; list and <em>DataGrid</em> controls; ADO.NET tutorial (basic APIs and programming techniques); calling stored procedures; updating database records; <em>Repeater</em> and <em>DataList</em> controls used with ADO.NET; custom ASP.NET controls (including derived,  composite, and full custom controls); overview of Web services  (including SOAP, WSDL, and other standards); creating and consuming a  sample Web service for a stock ticker; ASP.NET caching techniques  explained (including fragment and object caching); security options in  ASP.NET for authentication, authorization, and impersonation;  configuration and deployment options in ASP.NET (including XCOPY  deployment); and an appendix with a quick tutorial on database design. </p>', '49.95', 'O''Reilly Media', 'October 1, 2005', '3', '930'),
('0596101104', 'Learning PHP and MySQL', '<p> The PHP scripting language and MySQL open source database are quite  effective independently, but together they make a simply unbeatable  team. When working hand-in-hand, they serve as the standard for the  rapid development of dynamic, database-driven websites. This  combination is so popular, in fact, that it''s attracting many  programming newbies who come from a web or graphic design background  and whose first language is HTML. If you fall into this ever-expanding  category, then this book is for you.</p>', '29.99', 'O''Reilly Media', 'une 1, 2006', '1', '359'),
('0596528124', 'Mastering Regular Expressions  ', '<p>Regular expressions are an extremely powerful tool for manipulating  text and data. They are now standard features in a wide range of  languages and popular tools, including Perl, Python, Ruby, Java, VB.NET  and C# (and any language using the .NET Framework), PHP, and MySQL.</p><p> If you don''t use regular expressions yet, you will discover in this  book a whole new world of mastery over your data. If you already use  them, you''ll appreciate this book''s unprecedented detail and breadth of  coverage. If you think you know all you need to know about regular  expressions, this book is a stunning eye-opener.</p><p> As this book  shows, a command of regular expressions is an invaluable skill. Regular  expressions allow you to code complex and subtle text processing that  you never imagined could be automated. Regular expressions can save you  time and aggravation. They can be used to craft elegant solutions to a  wide range of problems. Once you''ve mastered regular expressions,  they''ll become an invaluable part of your toolkit. You will wonder how  you ever got by without them.</p><p> Yet despite their wide  availability, flexibility, and unparalleled power, regular expressions  are frequently underutilized. Yet what is power in the hands of an  expert can be fraught with peril for the unwary. <em>Mastering Regular Expressions</em> will help you navigate the minefield to becoming an expert and help you optimize your use of regular expressions. </p><p> <em>Mastering Regular Expressions</em>,  Third Edition, now includes a full chapter devoted to PHP and its  powerful and expressive suite of regular expression functions, in  addition to enhanced PHP coverage in the central &quot;core&quot; chapters.  Furthermore, this edition has been updated throughout to reflect  advances in other languages, including expanded in-depth coverage of  Sun''s <em>java.util.regex</em> package, which has emerged as the standard Java regex implementation.Topics include:</p><ul>  <li>A comparison of features among different versions of many languages and tools</li>  <li>How the regular expression engine works</li>  <li>Optimization (major savings available here!)</li>  <li>Matching just what you want, but not what you don''t want</li>  <li>Sections and chapters on individual languages</li></ul><p> Written in the lucid, entertaining tone that makes a complex, dry topic  become crystal-clear to programmers, and sprinkled with solutions to  complex real-world problems, <em>Mastering Regular Expressions</em>, Third Edition offers a wealth information that you can put to immediate use.</p>', '44.99', 'O''Reilly Media', 'August 8, 2006', '3', '515'),
('0672325675', 'Teach Yourself SQL in 10 Minutes', '<p><em>Sams Teach Yourself SQL in 10 Minutes</em> has established itself as  the gold standard for introductory SQL books, offering a fast-paced  accessible tutorial to the major themes and techniques involved in  applying the SQL language. Forta''s examples are clear and his writing  style is crisp and concise. As with earlier editions, this revision  includes coverage of current versions of all major commercial SQL  platforms. New this time around is coverage of MySQL, and PostgreSQL.  All examples have been tested against each SQL platform, with  incompatibilities or platform distinctives called out and explained.</p>', '14.99', 'Sams', 'April 7, 2004', '3', '256'),
('0672326728', 'PHP & MySQL Web Development', '<p>The PHP server-side scripting language and the MySQL database  management system (DBMS) make a potent pair. Both are open-source  products--free of charge for most purposes--remarkably strong, and  capable of handling all but the most enormous transaction loads. Both  are supported by large, skilled, and enthusiastic communities of  architects, programmers, and designers. <em>PHP and MySQL Web Development</em> introduces readers (who are assumed to have little or no experience  with the title subjects) to PHP and MySQL for the purpose of creating  dynamic Internet sites. It teaches the same skills as introductory  Active Server Pages (ASP) and ColdFusion books--technologies that  address the same niche.</p><p> Authors Luke Welling and Laura Thomson''s  technique aims to get readers going on their own projects as soon as  possible. They present easily digestible sections on specific technical  processes--&quot;Accessing array contents&quot; and &quot;Using encryption with PHP&quot;  are two examples. Each section centers on a sample program that strips  the task at hand down to its essentials, enabling the reader to fit the  process into his or her own solutions as required. Tables that list  options and other nuggets of reference material appear as well, but the  many examples and the authors'' commentary on them take center stage.</p><p> For reference material on MySQL, have a look at Paul DuBois''s <em><a href="http://www.amazon.com/exec/obidos/ASIN/0735709211/$%7B0%7D">MySQL</a></em>. On the PHP side, <em><a href="http://www.amazon.com/exec/obidos/ASIN/0735709971/$%7B0%7D">Web Application Development with PHP 4.0</a></em> is excellent. <em>--David Wall</em></p><p> <strong>Topics covered:</strong> </p><ul>  <li>The MySQL database server (for both Unix and Windows) </li>  <li>Accessing MySQL databases through PHP scripting (the letters don''t really stand for anything) </li>  <li>Database creation and modification </li>  <li>PHP tricks in order of increasing complexity--everything from basic SQL queries to secure transactions for commerce </li>  <li>Authentication </li>  <li>Network connectivity </li>  <li>Session management </li>  <li>Content customization</li></ul>', '32.99', 'Sams', 'September 29, 2004', '3', '984'),
('0672328232', 'ASP.NET 2.0 Unleashed', '<p><em>ASP.NET 2.0 Unleashed&nbsp;</em>is a revision of the best-selling <em>ASP.NET Unleashed, </em>by Microsoft Software Legend <strong>Stephen Walther</strong>. It<strong>&nbsp;</strong>covers  virtually all features of ASP.NET 2.0&nbsp;including more than 50 new  controls, personalization, master pages, and web parts. All code  samples are presented in VB and C#. Throughout the more than&nbsp;2,000  pages, you will be shown how to develop state-of-the-art Web  applications using Microsoft''s latest development tools. This resource  is guaranteed to be used as a&nbsp;reference guide&nbsp;over and over! </p>', '59.99', 'Sams', 'June 6, 2006', '1', '1992'),
('0764574892', 'Beginning Regular Expressions', '<p>Regular expressions help users and developers to find and manipulate  text more effectively and efficiently. In addition, regular expressions  are supported by many scripting languages, programming languages, and  databases. This example-rich tutorial helps debunk the traditional  reputation of regular expressions as being cryptic. It explains the  various parts of a regular expression pattern, what those parts mean,  how to use them, and common pitfalls to avoid when writing regular  expressions. With chapters on using regular expressions with popular  Windows platform software including databases, cross platform scripting  languages, and programming languages, you''ll learn to make effective  use of the power provided by regular expressions once you fully  comprehend their strengths and potential. What you will learn from this  book -Fundamental concepts of regular expressions and how to write them  -How to break down a text manipulation problem into component parts so  you can then logically construct a regular expression pattern -How to  use regular expressions in several scripting and programming languages  and software packages -The variations that exist among regular  expression dialects -Reusable, real-world working code that can be used  to solve everyday regular expression problems Who this book is for:  This book is for developers who need to manipulate text but are new to  regular expressions. Some basic programming or scripting experience is  useful but not required.</p>', '39.99', 'Wrox', 'February 4, 2005', '1', '768'),
('0782142796', 'Creating Interactive Web Sites with PHP and Web Services', '<p>  PHP and MySQL are great tools for building database-driven  websites. There''s nothing new about that. What is new is the  environment in which your site operates&mdash;a world rich (and growing  richer) in web services that can add value and functionality in many  different ways. Creating Interactive Web Sites with PHP and Web  Services walks you through every step of a major web project&mdash;a  content-management system&mdash;teaching you both the basic techniques and  little-known tricks you need to build successful web sites. And you can  use those skills to develop dynamic applications that will meet your  special requirements. Here''s some of what you''ll find covered inside: </p><ul>  <li>Adding, deleting, and displaying data with a custom content-management system </li>  <li>Building a template system with PHP </li>  <li>Interacting with web services using PHP and MySQL </li>  <li>Creating and managing a user system and a shopping cart </li>  <li>Processing credit card payments using merchant accounts and third-party payment solutions </li>  <li>Tracking site statistics using PHP and MySQL </li>  <li>Enhancing your site with third-party scripts </li></ul><p> Tons of examples, complete with explanations and supported by online  source code, will speed your progress, whether you''re a true beginner  or already have PHP experience. This book is platform-agnostic, so it  doesn''t matter if you''re deploying your site on Linux or Windows. You  also get PHP and MySQL references, so you can quickly resolve questions  about syntax and similar issues. </p>', '39.99', 'Sybex', 'December 19, 2003', '1', '512'),
('1590595521', 'Beginning PHP and MySQL 5', '<p> <em>Beginning PHP 5 and MYSQL: From Novice to Professional</em> offers a comprehensive introduction to two of the most popular Web  application building technologies on the planet: the scripting language  PHP and the MySQL database server. This book will not only expose you  to the core aspects of both technologies, but will provide valuable  insight into how they are used in unison to create dynamic data-driven  Web applications.</p><p><em>Beginning PHP 5 and MYSQL</em> explains the  new features of the latest releases of the world&rsquo;s most popular Open  Source Web development technologies: MySQL 4 database server and PHP 5  scripting language. This book explores the benefits, extensive new  features, and advantages of the object-oriented PHP 5, and how it can  be used in conjunction with MySQL 4 to create powerful dynamic Web  sites. </p><p> This is the perfect book for the Web designer,  programmer, hobbyist, or novice that wants to learn how to create  applications with PHP 5 and MySQL 4, and is a great entrance point for  Apress&rsquo;s extensive spectrum of PHP books planned for 2004.</p>', '44.99', 'Apress', 'January 23, 2006', '1', '952'),
('1590595726', 'Beginning ASP.NET 2.0 in C#', '<p><em>Beginning ASP.NET 2.0 in C# 2005: From Novice to Professional</em> steers you through the maze of ASP.NET web programming concepts. You  will learn language and theory simultaneously, mastering the core  techniques necessary to develop good coding practices and enhance your  skill set.</p><p>This book provides thorough coverage of ASP.NET,  guiding you from beginning to advanced techniques, such as querying  databases from within a web page and performance-tuning your site.  You''ll find tips for best practices and comprehensive discussions of  key database and XML principles.</p><p>The book also emphasizes the  invaluable coding techniques of object orientation and code-behind,  which will enable you to build real-world websites instead of just  scraping by with simplified coding practices. By the time you finish  this book, you will have mastered the core techniques essential to  professional ASP.NET developers.</p>', '49.99', 'Apress', 'January 27, 2006', '1', '1184');

-- --------------------------------------------------------

--
-- Table structure for table `bookorderitems`
--

CREATE TABLE IF NOT EXISTS `bookorderitems` (
  `orderID` int(11) NOT NULL,
  `ISBN` varchar(15) NOT NULL,
  `qty` int(4) NOT NULL,
  `price` double(6,2) NOT NULL,
  KEY `orderID` (`orderID`,`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookorderitems`
--

INSERT INTO `bookorderitems` (`orderID`, `ISBN`, `qty`, `price`) VALUES
(13, '0131428985', 1, 35.96),
(14, '0131428985', 1, 35.96),
(15, '0131428985', 1, 35.96),
(16, '0131428985', 1, 35.96),
(17, '0131428985', 1, 35.96),
(18, '0131428985', 1, 35.96),
(19, '1590595726', 1, 39.99),
(20, '1590595726', 1, 39.99),
(21, '1590595726', 1, 39.99),
(22, '1590595726', 1, 39.99),
(23, '1590595726', 1, 39.99),
(24, '1590595726', 1, 39.99),
(25, '1590595726', 1, 39.99),
(26, '1590595726', 1, 39.99),
(27, '1590595726', 1, 39.99),
(28, '1590595726', 1, 39.99),
(29, '1590595726', 1, 39.99),
(30, '1590595726', 1, 39.99),
(31, '1590595726', 1, 39.99),
(32, '1590595726', 1, 39.99),
(33, '1590595726', 1, 39.99),
(34, '1590595726', 2, 39.99),
(35, '1590595726', 2, 39.99),
(36, '1590595726', 2, 39.99),
(37, '1590595726', 2, 39.99),
(38, '1590595726', 2, 39.99),
(39, '1590595726', 2, 39.99),
(40, '1590595726', 2, 39.99),
(41, '1590595726', 2, 39.99),
(42, '1590595726', 2, 39.99),
(43, '1590595726', 2, 39.99),
(44, '0672328232', 2, 47.99),
(45, '059600916X', 1, 39.96),
(46, '1590595521', 2, 35.99),
(47, '0321350316', 1, 40.00),
(52, '0782142796', 1, 31.99),
(53, '0321344758', 1, 28.00),
(78, '0596006810', 1, 21.11),
(83, '0596006810', 1, 21.11),
(86, '1590595521', 1, 35.99),
(87, '1590595521', 1, 35.99),
(88, '0596005601', 1, 23.96),
(93, '0672325675', 1, 11.99),
(119, '0596007272', 1, 27.96),
(120, '0596007272', 1, 27.96),
(121, '0321344758', 1, 28.00),
(122, '0672328232', 1, 47.99),
(123, '1590595521', 1, 35.99),
(124, '0672328232', 2, 47.99),
(125, '0596007272', 1, 27.96),
(126, '0596005431', 1, 35.96),
(127, '0596005431', 1, 35.96),
(128, '0596005431', 1, 35.96),
(129, '0596005431', 1, 35.96),
(130, '0596005431', 1, 35.96),
(131, '0596005601', 1, 23.96),
(132, '0596528124', 2, 35.99),
(133, '0596528124', 2, 35.99),
(134, '0131428985', 1, 35.96),
(135, '0131428985', 1, 35.96),
(136, '1590595521', 4, 35.99),
(137, '0596006810', 2, 21.11),
(138, '0596005601', 1, 23.96),
(139, '1590595521', 1, 35.99),
(140, '0672326728', 1, 26.39),
(141, '059600916X', 2, 39.96),
(142, '0596528124', 2, 35.99),
(143, '0596528124', 1, 35.99),
(144, '0596005601', 1, 23.96),
(145, '0782142796', 1, 31.99),
(146, '0321350316', 1, 40.00),
(147, '1590595521', 1, 35.99),
(148, '0596005601', 1, 23.96),
(149, '0672325675', 2, 11.99),
(150, '0672325675', 2, 11.99),
(151, '0596101104', 1, 23.99),
(152, '0672328232', 1, 47.99),
(153, '0596006810', 1, 21.11),
(154, '0596101104', 1, 23.99),
(155, '0596528124', 1, 35.99),
(156, '0596005601', 1, 23.96),
(157, '0321350316', 1, 40.00),
(158, '0672328232', 1, 47.99),
(159, '0672328232', 1, 47.99),
(160, '0596006810', 1, 21.11),
(161, '0596005431', 1, 35.96),
(162, '0321344758', 1, 28.00),
(163, '0131428985', 1, 35.96),
(164, '0321350316', 1, 40.00),
(165, '059600916X', 1, 39.96),
(166, '0131428985', 1, 35.96),
(167, '0764574892', 1, 31.99),
(168, '0764574892', 1, 31.99),
(169, '0764574892', 1, 31.99),
(170, '0764574892', 1, 31.99),
(171, '0764574892', 1, 31.99),
(172, '0201433362', 1, 43.99),
(173, '0201433362', 1, 43.99),
(174, '0201433362', 1, 43.99),
(175, '0201433362', 1, 43.99),
(176, '0201433362', 1, 43.99),
(177, '0201433362', 1, 43.99),
(178, '0201433362', 1, 43.99),
(179, '0201433362', 1, 43.99),
(180, '0201433362', 1, 43.99),
(181, '0201433362', 1, 43.99),
(182, '0201433362', 1, 43.99),
(183, '0201433362', 1, 43.99),
(184, '0201433362', 1, 43.99),
(185, '0201433362', 1, 43.99),
(186, '0201433362', 1, 43.99),
(187, '0201433362', 1, 43.99),
(188, '0201433362', 1, 43.99),
(189, '0201433362', 1, 43.99),
(190, '0201433362', 1, 43.99),
(191, '0201433362', 1, 43.99),
(192, '0201433362', 1, 43.99),
(193, '0672326728', 1, 26.39),
(194, '0131428985', 1, 35.96),
(195, '0596007272', 1, 27.96),
(196, '0782142796', 1, 31.99),
(197, '059600916X', 1, 39.96),
(198, '0672326728', 1, 26.39),
(199, '0201433362', 3, 43.99),
(200, '059600916X', 2, 39.96),
(201, '0321344758', 1, 28.00),
(202, '059600916X', 1, 39.96),
(203, '0596005431', 1, 35.96),
(204, '0764574892', 3, 31.99),
(205, '0764574892', 3, 31.99),
(206, '0764574892', 3, 31.99),
(207, '1590595726', 1, 39.99),
(208, '1590595726', 1, 39.99),
(209, '0596006810', 1, 21.11),
(210, '0596006810', 1, 21.11),
(211, '0596006810', 1, 21.11),
(212, '0596006810', 1, 21.11),
(213, '0596006810', 1, 21.11),
(214, '0596006810', 1, 21.11),
(215, '0596006810', 1, 21.11),
(216, '0764574892', 4, 31.99),
(216, '1590595726', 1, 39.99),
(216, '0596006810', 1, 21.11),
(217, '0764574892', 4, 31.99),
(217, '1590595726', 1, 39.99),
(217, '0596006810', 1, 21.11),
(217, '0782142796', 1, 31.99),
(218, '059600916X', 1, 39.96),
(219, '0764574892', 1, 31.99),
(220, '0321350316', 1, 40.00),
(221, '0596006810', 1, 21.11),
(222, '1590595726', 1, 39.99),
(223, '0201433362', 1, 43.99),
(224, '0201433362', 1, 43.99),
(224, '0596528124', 1, 35.99),
(225, '0596006810', 1, 21.11),
(226, '0596101104', 1, 23.99),
(227, '0321344758', 7, 28.00),
(227, '0672328232', 1, 47.99),
(228, '0321344758', 7, 28.00),
(228, '0672328232', 1, 47.99),
(229, '0321344758', 7, 28.00),
(229, '0672328232', 1, 47.99),
(230, '0321344758', 7, 28.00),
(230, '0672328232', 1, 47.99),
(231, '0596007272', 1, 27.96),
(232, '0321344758', 7, 28.00),
(232, '0672328232', 1, 47.99),
(232, '0596007272', 1, 27.96),
(233, '0321344758', 7, 28.00),
(233, '0672328232', 1, 47.99),
(233, '0596007272', 1, 27.96),
(234, '0321344758', 7, 28.00),
(234, '0672328232', 1, 47.99),
(234, '0596007272', 1, 27.96),
(235, '0321344758', 7, 28.00),
(235, '0672328232', 1, 47.99),
(235, '0596007272', 1, 27.96),
(236, '0321344758', 7, 28.00),
(236, '0672328232', 1, 47.99),
(236, '0596007272', 1, 27.96),
(237, '0321344758', 7, 28.00),
(237, '0672328232', 1, 47.99),
(237, '0596007272', 1, 27.96),
(238, '0131428985', 1, 35.96),
(239, '1590595726', 1, 39.99),
(240, '0596006810', 2, 21.11),
(241, '1590595726', 1, 39.99),
(242, '0596101104', 1, 23.99),
(243, '0596528124', 1, 35.99),
(243, '0672328232', 2, 47.99),
(244, '0596528124', 1, 35.99);

-- --------------------------------------------------------

--
-- Table structure for table `bookorders`
--

CREATE TABLE IF NOT EXISTS `bookorders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `custID` int(6) NOT NULL,
  `orderdate` int(11) NOT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=245 ;

--
-- Dumping data for table `bookorders`
--

INSERT INTO `bookorders` (`orderID`, `custID`, `orderdate`) VALUES
(4, 2, 1464402450),
(5, 2, 1464402484),
(6, 2, 1464412654),
(7, 2, 1464412668),
(8, 2, 1464412692),
(9, 2, 1464412796),
(10, 2, 1464412813),
(11, 2, 1464412863),
(12, 2, 1464412863),
(13, 2, 1464412880),
(14, 2, 1464412984),
(15, 2, 1464413012),
(16, 2, 1464413032),
(17, 2, 1464413067),
(18, 2, 1464413212),
(19, 2, 1464413256),
(20, 2, 1464413331),
(21, 2, 1464413348),
(22, 2, 1464413354),
(23, 2, 1464413370),
(24, 2, 1464413438),
(25, 2, 1464413446),
(26, 2, 1464413567),
(27, 2, 1464413592),
(28, 2, 1464413595),
(29, 2, 1464413623),
(30, 2, 1464413629),
(31, 2, 1464413636),
(32, 2, 1464413772),
(33, 2, 1464413813),
(34, 2, 1464413883),
(35, 2, 1464413946),
(36, 2, 1464413960),
(37, 2, 1464413970),
(38, 2, 1464413974),
(39, 2, 1464413997),
(40, 2, 1464414011),
(41, 2, 1464414064),
(42, 2, 1464414112),
(43, 2, 1464414189),
(44, 0, 1464414478),
(45, 0, 1464414507),
(46, 0, 1464414540),
(47, 0, 1464414580),
(48, 0, 1464414589),
(49, 0, 1464414589),
(50, 0, 1464414637),
(51, 0, 1464414637),
(52, 0, 1464414657),
(53, 0, 1464414756),
(54, 0, 1464414828),
(55, 0, 1464414828),
(56, 0, 1464414982),
(57, 0, 1464414982),
(58, 0, 1464415008),
(59, 0, 1464415008),
(60, 0, 1464415023),
(61, 0, 1464415023),
(62, 0, 1464415025),
(63, 0, 1464415025),
(64, 0, 1464415025),
(65, 0, 1464415025),
(66, 0, 1464415026),
(67, 0, 1464415026),
(68, 0, 1464415027),
(69, 0, 1464415027),
(70, 0, 1464415028),
(71, 0, 1464415028),
(72, 0, 1464415029),
(73, 0, 1464415029),
(74, 0, 1464415029),
(75, 0, 1464415029),
(76, 0, 1464415029),
(77, 0, 1464415029),
(78, 0, 1464482527),
(79, 0, 1464482598),
(80, 0, 1464482598),
(81, 0, 1464482636),
(82, 0, 1464482636),
(83, 0, 1464482686),
(84, 0, 1464482706),
(85, 0, 1464482706),
(86, 0, 1464482718),
(87, 0, 1464482718),
(88, 0, 1464482731),
(89, 0, 1464482860),
(90, 0, 1464482860),
(91, 0, 1464482865),
(92, 0, 1464482865),
(93, 0, 1464482879),
(94, 0, 1464482903),
(95, 0, 1464482903),
(96, 0, 1464482905),
(97, 0, 1464482905),
(98, 0, 1464482906),
(99, 0, 1464482906),
(100, 0, 1464483206),
(101, 0, 1464483222),
(102, 0, 1464483243),
(103, 0, 1464483247),
(104, 0, 1464483297),
(105, 0, 1464483320),
(106, 0, 1464483350),
(107, 0, 1464483393),
(108, 0, 1464483426),
(109, 0, 1464483452),
(110, 0, 1464483472),
(111, 0, 1464483510),
(112, 0, 1464483516),
(113, 0, 1464483519),
(114, 0, 1464483520),
(115, 0, 1464483547),
(116, 0, 1464483558),
(117, 0, 1464483589),
(118, 0, 1464483591),
(119, 24, 1464484025),
(120, 0, 1464484105),
(121, 66, 1464484283),
(122, 2, 1464484674),
(123, 2, 1464488806),
(124, 2, 1464488849),
(125, 0, 1464488987),
(126, 0, 1464489010),
(127, 0, 1464489129),
(128, 71, 1464489182),
(129, 72, 1464489210),
(130, 73, 1464489259),
(131, 74, 1464489283),
(132, 76, 1464489342),
(133, 77, 1464489374),
(134, 79, 1464489387),
(135, 24, 1464490933),
(136, 24, 1464491698),
(137, 24, 1464492461),
(138, 24, 1464558446),
(139, 24, 1464558498),
(140, 24, 1464575463),
(141, 24, 1464575480),
(142, 24, 1464584771),
(143, 24, 1464584836),
(144, 24, 1464584872),
(145, 24, 1464584992),
(146, 24, 1464585189),
(147, 24, 1464585500),
(148, 24, 1464585536),
(149, 24, 1464585660),
(150, 24, 1464585660),
(151, 24, 1464585737),
(152, 24, 1464585776),
(153, 24, 1464585907),
(154, 24, 1464585971),
(155, 24, 1464586358),
(156, 24, 1464586393),
(157, 24, 1464586460),
(158, 24, 1464586494),
(159, 24, 1464586494),
(160, 24, 1464586521),
(161, 24, 1464593748),
(162, 24, 1464593868),
(163, 24, 1464593892),
(164, 24, 1464593957),
(165, 24, 1464638834),
(166, 24, 1464644435),
(167, 24, 1464644511),
(168, 24, 1464644712),
(169, 24, 1464644909),
(170, 24, 1464644931),
(171, 24, 1464644952),
(172, 24, 1464644966),
(173, 24, 1464645005),
(174, 24, 1464645022),
(175, 24, 1464649449),
(176, 24, 1464649478),
(177, 24, 1464649515),
(178, 24, 1464649550),
(179, 24, 1464649565),
(180, 24, 1464649607),
(181, 24, 1464649622),
(182, 24, 1464649649),
(183, 24, 1464649670),
(184, 24, 1464649701),
(185, 24, 1464649735),
(186, 24, 1464649757),
(187, 24, 1464649838),
(188, 24, 1464649876),
(189, 24, 1464649945),
(190, 24, 1464650180),
(191, 24, 1464650348),
(192, 24, 1464650408),
(193, 2, 1464650601),
(194, 24, 1464662114),
(195, 2, 1464662200),
(196, 2, 1464662287),
(197, 82, 1464901154),
(198, 82, 1464901302),
(199, 24, 1465084995),
(200, 24, 1465086089),
(201, 24, 1465099768),
(202, 24, 1465101914),
(203, 24, 1465102346),
(204, 24, 1465102448),
(205, 24, 1465102475),
(206, 24, 1465102549),
(207, 24, 1465102568),
(208, 24, 1465102903),
(209, 24, 1465102955),
(210, 24, 1465103032),
(211, 24, 1465106073),
(212, 24, 1465106091),
(213, 24, 1465106103),
(214, 24, 1465106198),
(215, 24, 1465106306),
(216, 24, 1465106342),
(217, 24, 1465106537),
(218, 24, 1465106664),
(219, 24, 1465106684),
(220, 24, 1465108157),
(221, 24, 1465108598),
(222, 83, 1465161882),
(223, 85, 1465162121),
(224, 24, 1465164051),
(225, 24, 1465169417),
(226, 24, 1465169472),
(227, 24, 1465190585),
(228, 24, 1465190643),
(229, 24, 1465190656),
(230, 24, 1465190658),
(231, 24, 1465190696),
(232, 24, 1465190715),
(233, 24, 1465190760),
(234, 24, 1465190773),
(235, 24, 1465190826),
(236, 24, 1465190856),
(237, 24, 1465191020),
(238, 24, 1465191048),
(239, 24, 1465195085),
(240, 24, 1465195649),
(241, 24, 1465278692),
(242, 24, 1465343948),
(243, 82, 1465415252),
(244, 87, 1488871781);

-- --------------------------------------------------------

--
-- Table structure for table `dvdactors`
--

CREATE TABLE IF NOT EXISTS `dvdactors` (
  `actorID` int(5) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  PRIMARY KEY (`actorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `dvdactors`
--

INSERT INTO `dvdactors` (`actorID`, `fname`, `lname`) VALUES
(3, 'Harrison', 'Ford'),
(4, 'Sean', 'Young'),
(5, 'Leonardo', 'DiCaprio'),
(6, 'Tom ', 'Hardy'),
(7, 'Ralph ', 'Fiennes'),
(8, 'Bill ', 'Murray'),
(9, 'Matthew', 'McConaughey'),
(10, 'Anne ', 'Hathaway');

-- --------------------------------------------------------

--
-- Table structure for table `dvdactorstitles`
--

CREATE TABLE IF NOT EXISTS `dvdactorstitles` (
  `asin` varchar(15) NOT NULL,
  `actorID` int(5) NOT NULL,
  PRIMARY KEY (`asin`,`actorID`),
  KEY `actorID` (`actorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dvdactorstitles`
--

INSERT INTO `dvdactorstitles` (`asin`, `actorID`) VALUES
('B008M4MB8K', 3),
('B008M4MB8K', 4),
('B002ZG980U', 5),
('B002ZG980U', 6),
('B00JAQJNN0', 7),
('B00JAQJNN0', 8),
('B013TYXV04', 9),
('B013TYXV04', 10);

-- --------------------------------------------------------

--
-- Table structure for table `dvdtitles`
--

CREATE TABLE IF NOT EXISTS `dvdtitles` (
  `asin` varchar(15) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` double(5,2) NOT NULL,
  PRIMARY KEY (`asin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dvdtitles`
--

INSERT INTO `dvdtitles` (`asin`, `title`, `price`) VALUES
('B002ZG980U', 'Inception', 4.99),
('B008M4MB8K', 'Blade Runner', 13.89),
('B00JAQJNN0', 'The Grand Budapest Hotel ', 9.99),
('B013TYXV04', 'Interstellar', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `geekcategories`
--

CREATE TABLE IF NOT EXISTS `geekcategories` (
  `CatID` int(4) NOT NULL AUTO_INCREMENT,
  `CatName` varchar(20) NOT NULL,
  PRIMARY KEY (`CatID`),
  KEY `CatName` (`CatName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `geekcategories`
--

INSERT INTO `geekcategories` (`CatID`, `CatName`) VALUES
(5, 'Binary'),
(1, 'Caffeine'),
(6, 'Clocks'),
(7, 'Computing'),
(3, 'Cube Goodies'),
(2, 'T-shirts'),
(4, 'Toys @ Work');

-- --------------------------------------------------------

--
-- Table structure for table `geekproductcategories`
--

CREATE TABLE IF NOT EXISTS `geekproductcategories` (
  `CatID` int(4) NOT NULL,
  `ItemID` char(4) NOT NULL,
  PRIMARY KEY (`CatID`,`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `geekproductcategories`
--

INSERT INTO `geekproductcategories` (`CatID`, `ItemID`) VALUES
(1, '2891'),
(1, '2a01'),
(1, '3820'),
(1, '5a65'),
(2, '2891'),
(2, '5aa9'),
(3, '2a01'),
(3, '3820'),
(3, '59b4'),
(3, '59e0'),
(3, '5ac8'),
(3, '5c3f'),
(3, '8193'),
(4, '59b4'),
(4, '5ac8'),
(4, '8193'),
(5, '59e0'),
(5, '5aa9'),
(6, '59e0'),
(7, '5c3f'),
(7, '8193');

-- --------------------------------------------------------

--
-- Table structure for table `geekproducts`
--

CREATE TABLE IF NOT EXISTS `geekproducts` (
  `ItemID` char(4) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `ShortDesc` varchar(200) NOT NULL,
  `LongDesc` varchar(4000) NOT NULL,
  `Image` varchar(25) NOT NULL,
  `price` double(7,2) NOT NULL,
  PRIMARY KEY (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `geekproducts`
--

INSERT INTO `geekproducts` (`ItemID`, `Name`, `ShortDesc`, `LongDesc`, `Image`, `price`) VALUES
('2891', 'Caffeine Molecule', 'A ThinkGeek Classic. A simple shirt with a great molecule on it...', 'You live and code by this alkaloid, why not wear your badge of addiction for all to see? Kind of like a scarlet molecule. Except it''s green. <br><br>', 'caffeine.jpg', 14.99),
('2a01', 'Caffeine Mug', 'There is something very special about a clear mug with hot coffee in it...', 'The now famous caffeine molecule emblazoned on a swell glass mug is the perfect addition to your caffeine collection. This one''s got some somewhat calm earl-grey tea in it cuz that''s what I was drinking when I took the picture, but feel free to use it for your daily double cappucino with a shot of skyrocket syrup. ', 'caffeine-mug.jpg', 7.99),
('3820', 'Caffeine Molecule Stainless Travel Mug', 'Grab this caffeine molecule emblazoned stainless travel mug for the morning grind...', 'These sophisticated stainless steel, travel style, mugs have our famous Caffeine molecule printed in black on the front. You must be thinking to yourselves right now <I>''your Caffeine molecule...''</I>? Yep. Our Caffeine molecule. Here at ThinkGeek, we like to pretend we invented all the elements and hence we have first dibs on claiming ownership of any and all molecules derived from the use of our elements.  I think Jen whipped up Carbon while playing around with a Rail Gun in Quake. ', 'caffeine-stainless.jpg', 14.99),
('59b4', 'Roger''s Connection', 'A package of magnetic rods and balls that work addictively together to create neat stuff!', 'Using these basic components, a truly endless variety of simple or complicated designs can be constructed, limited only by your imagination! A few examples are shown above. Multiple sets can be combined for larger designs. Designs with motion can also be created using  magnetic bearings, composed of nothing more than the same basic steel balls and magnetic rods, assembled in a very particular way!', 'rogers-connection.jpg', 22.99),
('59e0', 'Binary Clock', 'A small desktop clock that takes some elite skills to read!', 'It''s easy for any self-respecting geek to figure out how to read this clock in a few minutes. Check out the image below for the details. Still don''t get it? Then you probably shouldn''t buy one, should you? Sure you could wing it and ''approximate'' the time based on the position of the sun and act like you can read this clock, but you should probably go get one of these instead .<br><br>', 'led-binclock.jpg', 22.99),
('5a65', 'Shower Shock Caffeinated Soap', 'Soap with caffeine infused in it! Believe it. A truly clean buzz...', 'Tired of waking up and having to wait for your morning java to brew? Are you one of those groggy early morning types that just needs that extra kick?  Know any programmers who dont regularly bathe and need some special motivation? Introducing Shower Shock, the original and world''s first caffeinated soap from ThinkGeek. When you think about it, ShowerShock is the ultimate clean buzz ;) ', 'shower-shock.jpg', 14.99),
('5aa9', 'Binary People', 'There are 10 types of people in the world: Those who understand binary, and those who don''t...', 'Do you enjoy watching the desperately puzzled faces of your co-workers day in and day out? Then we are sure you''ll enjoy being the source of their frustrations as you stride down the flourescent hallways with this fine koan of a t-shirt... <br><br>', 'binary-people.jpg', 15.99),
('5ac8', 'Smart Mass Thinking Putty', 'An adult sized and highly complex putty, Smart Mass is almost alien in nature...', 'The Ultimate Stress Reduction office toy is here. Of course you remember playing with putty as a kid. Welp, this aint your kids putty. Adult sized, and as feature-rich as your favorite Operating System, the Smart Mass putty  from ThinkGeek makes living life fun all over again. Like to fidget while sitting in front of the monitor?  Enjoy being the envy of all those who surround you? Trying to make an impression on that new coder down the hall? Smart Mass putty will help...', 'thinking-putty.jpg', 11.99),
('5c3f', 'Auravision EluminX Illuminated Keyboard', 'Perfect for late-night coding sessions', 'The Auravision(tm) EluminX(tm) Illuminated Keyboard is a computer keyboard with', 'keyboard.jpg', 79.99),
('8193', 'Bluetooth Laser Virtual Keyboard', 'Laser projection keyboard allows you to type on any flat surface ', 'Remember when you were promised all those amazing future tech innovations? Just around the corner was supposed to be a shining technology utopia with flying cars, personal space travel to distant galaxies, and bio-implantable cell phones. It''s almost disappointing enough to make you sit at home and watch old episodes of "Space 1999". Don''t lose hope! An amazing glimpse of this promised future has just arrived at ThinkGeek in the form of the Bluetooth Laser Virtual Keyboard. This tiny device laser-projects a keyboard on any flat surface... you can then type away accompanied by simulated key click sounds. It really is true future magic at its best. You''ll be turning heads the moment you pull this baby from your pocket and use it to compose an e-mail on your bluetooth enabled PDA or Cell Phone. With 63 keys and and full size QWERTY layout the Laser Virtual Keyboard can approach typing speeds of a standard keyboard... in a size a little larger than a matchbook. Product Features * Connects to PDAs Smartphones and Computers using Bluetooth * Projects a full size keyboard onto any flat surface * Allows the convenience of regular keyboard typing in a tiny form factor * Rechargeable battery lasts for 120 minutes of continuous typing * Tiny size only 3.5 inches high * Compatible with PalmOS 5, PocketPC 2003, Windows Smartphone, Symbian OS, and Windows 2000/XP. Limited Mac OSX Support. ', 'virtual_keyboard.jpg', 159.99);

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomers`
--

CREATE TABLE IF NOT EXISTS `tblcustomers` (
  `custID` int(11) NOT NULL AUTO_INCREMENT,
  `NameL` varchar(50) NOT NULL,
  `NameF` varchar(50) NOT NULL,
  PRIMARY KEY (`custID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`custID`, `NameL`, `NameF`) VALUES
(1, 'Smithtest', 'Johntest');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dvdactorstitles`
--
ALTER TABLE `dvdactorstitles`
  ADD CONSTRAINT `dvdactorstitles_ibfk_1` FOREIGN KEY (`actorID`) REFERENCES `dvdactors` (`actorID`),
  ADD CONSTRAINT `dvdactorstitles_ibfk_2` FOREIGN KEY (`asin`) REFERENCES `dvdtitles` (`asin`);
