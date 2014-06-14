-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Чрв 14 2014 р., 21:07
-- Версія сервера: 5.5.35
-- Версія PHP: 5.4.4-14+deb7u9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Structure for view `catalog`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `catalog` AS select `p`.`product_id` AS `product_id`,`p`.`model` AS `model`,`p`.`sku` AS `sku`,`p`.`upc` AS `upc`,`pd`.`description` AS `description`,`pd`.`tag` AS `tag`,`pd`.`name` AS `name`,`ad`.`name` AS `attributes` from (((`oc_product` `p` join `oc_product_description` `pd` on((`p`.`product_id` = `pd`.`product_id`))) join `oc_product_attribute` `pa` on((`p`.`product_id` = `pa`.`product_id`))) join `oc_attribute_description` `ad` on((`ad`.`attribute_id` = `pa`.`attribute_id`)));

--
-- VIEW  `catalog`
-- Дані: Жодного
--

