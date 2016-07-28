--
-- Create New Database Named as nms
--
DROP DATABASE IF EXISTS ms;

CREATE DATABASE ms;

USE ms;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text(50) NOT NULL,
  `email` text(50) NOT NULL,
  `password` text(30) NOT NULL,
  `image_path` text(30),
  `user_role` varchar(20),
  `published` boolean DEFAULT false,
  `u_date&time` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user`
--


--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `p_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10),
  `p_name` text(50) NOT NULL,
  `p_discription` text(50) NOT NULL,
  `p_price` int(10) NOT NULL,
  `p_category` text(50) NOT NULL,
  `p_image_path` text(30),
  `p_date&time` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `r_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `r_body` varchar(255) NOT NULL,
  `user_id` int(10),
  `p_id` int(10),
  `r_date&time` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`r_id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_name` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_sub` varchar(255) NOT NULL,
  `c_body` varchar(255) NOT NULL,
  `c_date&time` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`c_id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `o_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int,
  `p_id` int,
  `o_price` int(10) NOT NULL,
  `o_discount` int(10),
  `o_amount_paid` int(10),
  `o_date&time` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`o_id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `order_products`
--

CREATE TABLE IF NOT EXISTS `order_products` (
  `o_id` int,
  `p_id` int,
  `p_admin_id` int
  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
