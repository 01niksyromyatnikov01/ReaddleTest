Тут представлены запросы по пунктам задания
----------------------------------------------------------------------------------------------
SELECT `city`.`id`,`city`.`Name`,`country`.`Name`,`city`.`CountryCode`,`city`.`Population` 
FROM `city` INNER JOIN `country` ON  `city`.id = `country`.`Capital` ORDER BY Population DESC LIMIT 5

---------------------------------------------------------------------------------------------------------

SELECT sum(`country`.`Population`*`countrylanguage`.`Percentage`/100) AS `Population` FROM `countrylanguage` 
INNER JOIN `country` ON `country`.`Code` = `countrylanguage`.`CountryCode` 
WHERE `Continent` = "Europe" AND `countrylanguage`.`Language` = 'English'

61,799,068.3, а вышло 61,799,070.2

----------------------------------------------------------------------------------------------------------


SELECT * FROM(SELECT * FROM(SELECT `countrylanguage`.`CountryCode`,count(`countrylanguage`.`CountryCode`) AS `NonOffCounter`
FROM `countrylanguage` WHERE `countrylanguage`.`IsOfficial` = 'F' GROUP BY `countrylanguage`.`CountryCode`) AS `T1` 
WHERE `T1`.`NonOffCounter` > 3) AS `T2`  INNER JOIN 
(SELECT * FROM(SELECT `countrylanguage`.`CountryCode`,count(`countrylanguage`.`CountryCode`) AS `OffCounter`
FROM `countrylanguage` WHERE `countrylanguage`.`IsOfficial` = 'T' GROUP BY `countrylanguage`.`CountryCode`) AS `T11` 
WHERE `T11`.`OffCounter` > 1) AS `T3` ON `T2`.`CountryCode` = `T3`.`CountryCode` WHERE `T2`.`NonOffCounter`/`T3`.`OffCounter` >=2 