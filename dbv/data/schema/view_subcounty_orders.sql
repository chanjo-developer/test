CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_subcounty_orders` AS select `m`.`order_by` AS `order_by`,`m`.`order_id` AS `order_id`,`m`.`date_created` AS `date_created`,`m`.`station_id` AS `station_id`,`sb`.`subcounty_name` AS `subcounty_name`,`sb`.`county` AS `county`,`mc`.`county_name` AS `county_name` from ((`m_order` `m` left join `subcounty_userbase` `sb` on((`sb`.`user_id` = `m`.`order_by`))) left join `m_county` `mc` on((`mc`.`id` = `sb`.`county`))) where (`m`.`station_level` = 4)