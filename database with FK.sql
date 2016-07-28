--
-- Create New Database Named as nms
--
DROP DATABASE IF EXISTS nms;

CREATE DATABASE nms;

USE nms;

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
INSERT INTO `user` (`user_id`, `name`, `email`, `password`) VALUES
(1, 'admin' , 'admin', 'admin');


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
   PRIMARY KEY (`p_id`),
   FOREIGN KEY (user_id) REFERENCES user(user_id)
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
   PRIMARY KEY (`r_id`),
   FOREIGN KEY (user_id) REFERENCES user(user_id),
   FOREIGN KEY (p_id) REFERENCES product(p_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;