-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: 10.100.0.105    Database: plusclouds_v3
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `countries`
--
create table countries
(
    id             int unsigned auto_increment
        primary key,
    id_ref         varchar(36)                null,
    code           char(2)                    not null,
    locale         char(2)                    null,
    name           varchar(45)                not null,
    currency_code  char(3)                    null,
    phone_code     char(5)                    null,
    rate           decimal(8, 2) default 0.00 not null comment 'Local VAT',
    percentage     double        default 0    not null comment 'VAT = rate * 100',
    continent_name varchar(15)                null,
    continent_code char(2)                    null,
    geo_name_id    int                        null,
    is_active      tinyint(1)    default 1    not null
)
    collate = utf8_unicode_ci;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'2494cb82-5cbb-11ec-bbdf-c2ea10853885','TR','TR','Turkey','TRY','90',0.18,18,'Asia','AS',298795,1),(2,'2494cf7c-5cbb-11ec-bbdf-c2ea10853885','AD','CA','Andorra','EUR',NULL,0.00,0,'Europe','EU',3041565,1),(3,'2494d045-5cbb-11ec-bbdf-c2ea10853885','AE','AR','United Arab Emirates','AED',NULL,0.00,0,'Asia','AS',290557,1),(4,'2494d0dd-5cbb-11ec-bbdf-c2ea10853885','AF','UZ','Afghanistan','AFN','93',0.00,0,'Asia','AS',1149361,1),(5,'2494d16e-5cbb-11ec-bbdf-c2ea10853885','AG','EN','Antigua and Barbuda','XCD','1268',0.00,0,'North America','NA',3576396,1),(6,'2494d1f3-5cbb-11ec-bbdf-c2ea10853885','AI','EN','Anguilla','XCD','1264',0.00,0,'North America','NA',3573511,1),(7,'2494d26c-5cbb-11ec-bbdf-c2ea10853885','AL','SQ','Albania','ALL','355',0.00,0,'Europe','EU',783754,1),(8,'2494d2e3-5cbb-11ec-bbdf-c2ea10853885','AM','RU','Armenia','AMD','374',0.00,0,'Asia','AS',174982,1),(9,'2494d356-5cbb-11ec-bbdf-c2ea10853885','AO','PT','Angola','AOA','244',0.00,0,'Africa','AF',3351879,1),(10,'2494d3c2-5cbb-11ec-bbdf-c2ea10853885','AQ',NULL,'Antarctica','XCD',NULL,0.00,0,'Antarctica','AN',6697173,1),(11,'2494d6eb-5cbb-11ec-bbdf-c2ea10853885','AR','AR','Argentina','ARS','54',0.00,0,'South America','SA',3865483,1),(12,'2494d75c-5cbb-11ec-bbdf-c2ea10853885','AS','SM','American Samoa','USD','1684',0.00,0,'Oceania','OC',5880801,1),(13,'2494d7d1-5cbb-11ec-bbdf-c2ea10853885','AT','DE','Austria','EUR','43',0.00,0,'Europe','EU',2782113,1),(14,'2494d846-5cbb-11ec-bbdf-c2ea10853885','AU','EN','Australia','AUD','61',0.00,0,'Oceania','OC',2077456,1),(15,'2494d8b8-5cbb-11ec-bbdf-c2ea10853885','AW','NL','Aruba','AWG','297',0.00,0,'North America','NA',3577279,1),(16,'2494d929-5cbb-11ec-bbdf-c2ea10853885','AX',NULL,'Åland','EUR',NULL,0.00,0,'Europe','EU',661882,1),(17,'2494d996-5cbb-11ec-bbdf-c2ea10853885','AZ','RU','Azerbaijan','AZN','994',0.00,0,'Asia','AS',587116,1),(18,'2494dc57-5cbb-11ec-bbdf-c2ea10853885','BA','SR','Bosnia and Herzegovina','BAM',NULL,0.00,0,'Europe','EU',3277605,1),(19,'2494dcd1-5cbb-11ec-bbdf-c2ea10853885','BB','EN','Barbados','BBD',NULL,0.00,0,'North America','NA',3374084,1),(20,'2494ddd6-5cbb-11ec-bbdf-c2ea10853885','BD','BN','Bangladesh','BDT',NULL,0.00,0,'Asia','AS',1210997,1),(21,'2494de84-5cbb-11ec-bbdf-c2ea10853885','BE','FR','Belgium','EUR','32',0.21,21,'Europe','EU',2802361,1),(22,'2494e17a-5cbb-11ec-bbdf-c2ea10853885','BF','FR','Burkina Faso','XOF',NULL,0.00,0,'Africa','AF',2361809,1),(23,'2494e221-5cbb-11ec-bbdf-c2ea10853885','BG','BG','Bulgaria','BGN','359',0.20,20,'Europe','EU',732800,1),(24,'2494e2c3-5cbb-11ec-bbdf-c2ea10853885','BH','AR','Bahrain','BHD','973',0.00,0,'Asia','AS',290291,1),(25,'2494e5a7-5cbb-11ec-bbdf-c2ea10853885','BI','FR','Burundi','BIF',NULL,0.00,0,'Africa','AF',433561,1),(26,'2494e645-5cbb-11ec-bbdf-c2ea10853885','BJ','FR','Benin','XOF',NULL,0.00,0,'Africa','AF',2395170,1),(27,'2494e929-5cbb-11ec-bbdf-c2ea10853885','BL','FR','Saint Barthélemy','EUR',NULL,0.00,0,'North America','NA',3578476,1),(28,'2494ec11-5cbb-11ec-bbdf-c2ea10853885','BM','EN','Bermuda','BMD',NULL,0.00,0,'North America','NA',3573345,1),(29,'2494eeed-5cbb-11ec-bbdf-c2ea10853885','BN','MS','Brunei','BND',NULL,0.00,0,'Asia','AS',1820814,1),(30,'2494f58d-5cbb-11ec-bbdf-c2ea10853885','BO','QU','Bolivia','BOB',NULL,0.00,0,'South America','SA',3923057,1),(31,'2494f606-5cbb-11ec-bbdf-c2ea10853885','BQ',NULL,'Bonaire','USD',NULL,0.00,0,'North America','NA',7626844,1),(32,'2494f676-5cbb-11ec-bbdf-c2ea10853885','BR','PT','Brazil','BRL','55',0.00,0,'South America','SA',3469034,1),(33,'2494f6e1-5cbb-11ec-bbdf-c2ea10853885','BS','EN','Bahamas','BSD',NULL,0.00,0,'North America','NA',3572887,1),(34,'2494f74e-5cbb-11ec-bbdf-c2ea10853885','BT','DZ','Bhutan','BTN',NULL,0.00,0,'Asia','AS',1252634,1),(35,'2494f7b6-5cbb-11ec-bbdf-c2ea10853885','BV',NULL,'Bouvet Island','NOK',NULL,0.00,0,'Antarctica','AN',3371123,1),(36,'2494f81d-5cbb-11ec-bbdf-c2ea10853885','BW','TN','Botswana','BWP',NULL,0.00,0,'Africa','AF',933860,1),(37,'2494f884-5cbb-11ec-bbdf-c2ea10853885','BY','RU','Belarus','BYR',NULL,0.00,0,'Europe','EU',630336,1),(38,'2494f8ec-5cbb-11ec-bbdf-c2ea10853885','BZ',NULL,'Belize','BZD',NULL,0.00,0,'North America','NA',3582678,1),(39,'2494f953-5cbb-11ec-bbdf-c2ea10853885','CA','FR','Canada','CAD',NULL,0.00,0,'North America','NA',6251999,1),(40,'2494f9b9-5cbb-11ec-bbdf-c2ea10853885','CC',NULL,'Cocos [Keeling] Islands','AUD',NULL,0.00,0,'Asia','AS',1547376,1),(41,'2494fa27-5cbb-11ec-bbdf-c2ea10853885','CD','LN','Democratic Republic of the Congo','CDF',NULL,0.00,0,'Africa','AF',203312,1),(42,'2494fa8d-5cbb-11ec-bbdf-c2ea10853885','CF','FR','Central African Republic','XAF',NULL,0.00,0,'Africa','AF',239880,1),(43,'2494faf3-5cbb-11ec-bbdf-c2ea10853885','CG','LN','Republic of the Congo','XAF',NULL,0.00,0,'Africa','AF',2260494,1),(44,'2494fb5e-5cbb-11ec-bbdf-c2ea10853885','CH','FR','Switzerland','CHF',NULL,0.00,0,'Europe','EU',2658434,1),(45,'2494fbc1-5cbb-11ec-bbdf-c2ea10853885','CI','FR','Ivory Coast','XOF',NULL,0.00,0,'Africa','AF',2287781,1),(46,'2494fc23-5cbb-11ec-bbdf-c2ea10853885','CK',NULL,'Cook Islands','NZD',NULL,0.00,0,'Oceania','OC',1899402,1),(47,'2494fc89-5cbb-11ec-bbdf-c2ea10853885','CL','ES','Chile','CLP',NULL,0.00,0,'South America','SA',3895114,1),(48,'2494fcef-5cbb-11ec-bbdf-c2ea10853885','CM','FR','Cameroon','XAF',NULL,0.00,0,'Africa','AF',2233387,1),(49,'2494fd50-5cbb-11ec-bbdf-c2ea10853885','CN','ZH','China','CNY',NULL,0.00,0,'Asia','AS',1814991,1),(50,'2494fdb3-5cbb-11ec-bbdf-c2ea10853885','CO','ES','Colombia','COP',NULL,0.00,0,'South America','SA',3686110,1),(51,'2494fe20-5cbb-11ec-bbdf-c2ea10853885','CR','ES','Costa Rica','CRC',NULL,0.00,0,'North America','NA',3624060,1),(52,'2494fea1-5cbb-11ec-bbdf-c2ea10853885','CU','ES','Cuba','CUP',NULL,0.00,0,'North America','NA',3562981,1),(53,'2494feed-5cbb-11ec-bbdf-c2ea10853885','CV','PT','Cape Verde','CVE',NULL,0.00,0,'Africa','AF',3374766,1),(54,'2494ff51-5cbb-11ec-bbdf-c2ea10853885','CW','NL','Curacao','ANG',NULL,0.00,0,'North America','NA',7626836,1),(55,'2494ffb3-5cbb-11ec-bbdf-c2ea10853885','CX','EN','Christmas Island','AUD',NULL,0.00,0,'Asia','AS',2078138,1),(56,'24950019-5cbb-11ec-bbdf-c2ea10853885','CY','TR','Cyprus','EUR','357',0.19,19,'Europe','EU',146669,1),(57,'2495007d-5cbb-11ec-bbdf-c2ea10853885','CZ','CS','Czech Republic','CZK',NULL,0.00,0,'Europe','EU',3077311,1),(58,'249500e1-5cbb-11ec-bbdf-c2ea10853885','DE','DE','Germany','EUR','49',0.19,19,'Europe','EU',2921044,1),(59,'24950144-5cbb-11ec-bbdf-c2ea10853885','DJ','AR','Djibouti','DJF',NULL,0.00,0,'Africa','AF',223816,1),(60,'249501a6-5cbb-11ec-bbdf-c2ea10853885','DK','DA','Denmark','DKK','45',0.25,25,'Europe','EU',2623032,1),(61,'2495020b-5cbb-11ec-bbdf-c2ea10853885','DM','EN','Dominica','XCD',NULL,0.00,0,'North America','NA',3575830,1),(62,'2495026f-5cbb-11ec-bbdf-c2ea10853885','DO','ES','Dominican Republic','DOP',NULL,0.00,0,'North America','NA',3508796,1),(63,'249502d3-5cbb-11ec-bbdf-c2ea10853885','DZ','AR','Algeria','DZD',NULL,0.00,0,'Africa','AF',2589581,1),(64,'2495033f-5cbb-11ec-bbdf-c2ea10853885','EC','ES','Ecuador','USD',NULL,0.00,0,'South America','SA',3658394,1),(65,'249503a1-5cbb-11ec-bbdf-c2ea10853885','EE','ET','Estonia','EUR',NULL,0.00,0,'Europe','EU',453733,1),(66,'24950406-5cbb-11ec-bbdf-c2ea10853885','EG','AR','Egypt','EGP',NULL,0.00,0,'Africa','AF',357994,1),(67,'24950469-5cbb-11ec-bbdf-c2ea10853885','EH',NULL,'Western Sahara','MAD',NULL,0.00,0,'Africa','AF',2461445,1),(68,'249504ce-5cbb-11ec-bbdf-c2ea10853885','ER','AR','Eritrea','ERN',NULL,0.00,0,'Africa','AF',338010,1),(69,'24950531-5cbb-11ec-bbdf-c2ea10853885','ES','EU','Spain','EUR','34',0.21,21,'Europe','EU',2510769,1),(70,'24950595-5cbb-11ec-bbdf-c2ea10853885','ET','AM','Ethiopia','ETB',NULL,0.00,0,'Africa','AF',337996,1),(71,'249505f6-5cbb-11ec-bbdf-c2ea10853885','FI','SV','Finland','EUR',NULL,0.00,0,'Europe','EU',660013,1),(72,'24950659-5cbb-11ec-bbdf-c2ea10853885','FJ',NULL,'Fiji','FJD',NULL,0.00,0,'Oceania','OC',2205218,1),(73,'249506bd-5cbb-11ec-bbdf-c2ea10853885','FK','EN','Falkland Islands','FKP',NULL,0.00,0,'South America','SA',3474414,1),(74,'24950724-5cbb-11ec-bbdf-c2ea10853885','FM','EN','Micronesia','USD',NULL,0.00,0,'Oceania','OC',2081918,1),(75,'24950785-5cbb-11ec-bbdf-c2ea10853885','FO','DA','Faroe Islands','DKK',NULL,0.00,0,'Europe','EU',2622320,1),(76,'249507e7-5cbb-11ec-bbdf-c2ea10853885','FR','FR','France','EUR','33',0.20,20,'Europe','EU',3017382,1),(77,'24950849-5cbb-11ec-bbdf-c2ea10853885','GA','FR','Gabon','XAF',NULL,0.00,0,'Africa','AF',2400553,1),(78,'249508ab-5cbb-11ec-bbdf-c2ea10853885','GB','EN','United Kingdom','GBP','44',0.20,20,'Europe','EU',2635167,1),(79,'24950911-5cbb-11ec-bbdf-c2ea10853885','GD','EN','Grenada','XCD',NULL,0.00,0,'North America','NA',3580239,1),(80,'24950979-5cbb-11ec-bbdf-c2ea10853885','GE','KA','Georgia','GEL',NULL,0.00,0,'Asia','AS',614540,1),(81,'249509db-5cbb-11ec-bbdf-c2ea10853885','GF','FR','French Guiana','EUR',NULL,0.00,0,'South America','SA',3381670,1),(82,'24950a40-5cbb-11ec-bbdf-c2ea10853885','GG',NULL,'Guernsey','GBP',NULL,0.00,0,'Europe','EU',3042362,1),(83,'24950aa5-5cbb-11ec-bbdf-c2ea10853885','GH','EN','Ghana','GHS',NULL,0.00,0,'Africa','AF',2300660,1),(84,'24950b05-5cbb-11ec-bbdf-c2ea10853885','GI','EN','Gibraltar','GIP',NULL,0.00,0,'Europe','EU',2411586,1),(85,'24950b66-5cbb-11ec-bbdf-c2ea10853885','GL','KL','Greenland','DKK',NULL,0.00,0,'North America','NA',3425505,1),(86,'24950bc9-5cbb-11ec-bbdf-c2ea10853885','GM','EN','Gambia','GMD',NULL,0.00,0,'Africa','AF',2413451,1),(87,'24950c2c-5cbb-11ec-bbdf-c2ea10853885','GN','FR','Guinea','GNF',NULL,0.00,0,'Africa','AF',2420477,1),(88,'24950c90-5cbb-11ec-bbdf-c2ea10853885','GP','FR','Guadeloupe','EUR',NULL,0.00,0,'North America','NA',3579143,1),(89,'24950cf2-5cbb-11ec-bbdf-c2ea10853885','GQ','PT','Equatorial Guinea','XAF',NULL,0.00,0,'Africa','AF',2309096,1),(90,'24950d55-5cbb-11ec-bbdf-c2ea10853885','GR','EL','Greece','EUR','30',0.23,23,'Europe','EU',390903,1),(91,'24950dbc-5cbb-11ec-bbdf-c2ea10853885','GS',NULL,'South Georgia and the South Sandwich Islands','GBP',NULL,0.00,0,'Antarctica','AN',3474415,1),(92,'24950e23-5cbb-11ec-bbdf-c2ea10853885','GT','ES','Guatemala','GTQ',NULL,0.00,0,'North America','NA',3595528,1),(93,'24950e89-5cbb-11ec-bbdf-c2ea10853885','GU','ES','Guam','USD',NULL,0.00,0,'Oceania','OC',4043988,1),(94,'24950eee-5cbb-11ec-bbdf-c2ea10853885','GW','PT','Guinea-Bissau','XOF',NULL,0.00,0,'Africa','AF',2372248,1),(95,'24950f55-5cbb-11ec-bbdf-c2ea10853885','GY','EN','Guyana','GYD',NULL,0.00,0,'South America','SA',3378535,1),(96,'24950fba-5cbb-11ec-bbdf-c2ea10853885','HK','ZH','Hong Kong','HKD',NULL,0.00,0,'Asia','AS',1819730,1),(97,'2495101f-5cbb-11ec-bbdf-c2ea10853885','HM',NULL,'Heard Island and McDonald Islands','AUD',NULL,0.00,0,'Antarctica','AN',1547314,1),(98,'249511d3-5cbb-11ec-bbdf-c2ea10853885','HN','ES','Honduras','HNL',NULL,0.00,0,'North America','NA',3608932,1),(99,'2495123c-5cbb-11ec-bbdf-c2ea10853885','HR','HR','Croatia','HRK',NULL,0.00,0,'Europe','EU',3202326,1),(100,'249512a0-5cbb-11ec-bbdf-c2ea10853885','HT','FR','Haiti','HTG',NULL,0.00,0,'North America','NA',3723988,1),(101,'24951303-5cbb-11ec-bbdf-c2ea10853885','HU','HU','Hungary','HUF',NULL,0.00,0,'Europe','EU',719819,1),(102,'24951367-5cbb-11ec-bbdf-c2ea10853885','ID','ID','Indonesia','IDR',NULL,0.00,0,'Asia','AS',1643084,1),(103,'249513c9-5cbb-11ec-bbdf-c2ea10853885','IE','GA','Ireland','EUR',NULL,0.00,0,'Europe','EU',2963597,1),(104,'2495142b-5cbb-11ec-bbdf-c2ea10853885','IL','AR','Israel','ILS','972',0.17,17,'Asia','AS',294640,1),(105,'2495149c-5cbb-11ec-bbdf-c2ea10853885','IM',NULL,'Isle of Man','GBP',NULL,0.00,0,'Europe','EU',3042225,1),(106,'2495182e-5cbb-11ec-bbdf-c2ea10853885','IN','TA','India','INR','91',0.15,15,'Asia','AS',1269750,1),(107,'249518a7-5cbb-11ec-bbdf-c2ea10853885','IO',NULL,'British Indian Ocean Territory','USD',NULL,0.00,0,'Asia','AS',1282588,1),(108,'24951911-5cbb-11ec-bbdf-c2ea10853885','IQ','AR','Iraq','IQD',NULL,0.00,0,'Asia','AS',99237,1),(109,'2495197a-5cbb-11ec-bbdf-c2ea10853885','IR','FA','Iran','IRR','98',0.00,0,'Asia','AS',130758,1),(110,'249519e1-5cbb-11ec-bbdf-c2ea10853885','IS','IS','Iceland','ISK',NULL,0.00,0,'Europe','EU',2629691,1),(111,'24951a45-5cbb-11ec-bbdf-c2ea10853885','IT',NULL,'Italy','EUR',NULL,0.00,0,'Europe','EU',3175395,1),(112,'24951aad-5cbb-11ec-bbdf-c2ea10853885','JE',NULL,'Jersey','GBP',NULL,0.00,0,'Europe','EU',3042142,1),(113,'24951b16-5cbb-11ec-bbdf-c2ea10853885','JM',NULL,'Jamaica','JMD',NULL,0.00,0,'North America','NA',3489940,1),(114,'24951b7a-5cbb-11ec-bbdf-c2ea10853885','JO','AR','Jordan','JOD',NULL,0.00,0,'Asia','AS',248816,1),(115,'24951bde-5cbb-11ec-bbdf-c2ea10853885','JP','JA','Japan','JPY',NULL,0.00,0,'Asia','AS',1861060,1),(116,'24951c43-5cbb-11ec-bbdf-c2ea10853885','KE','SW','Kenya','KES',NULL,0.00,0,'Africa','AF',192950,1),(117,'24951ca5-5cbb-11ec-bbdf-c2ea10853885','KG','RU','Kyrgyzstan','KGS',NULL,0.00,0,'Asia','AS',1527747,1),(118,'24951d07-5cbb-11ec-bbdf-c2ea10853885','KH','KM','Cambodia','KHR',NULL,0.00,0,'Asia','AS',1831722,1),(119,'24951ede-5cbb-11ec-bbdf-c2ea10853885','KI',NULL,'Kiribati','AUD',NULL,0.00,0,'Oceania','OC',4030945,1),(120,'24951f49-5cbb-11ec-bbdf-c2ea10853885','KM','AR','Comoros','KMF',NULL,0.00,0,'Africa','AF',921929,1),(121,'249520a6-5cbb-11ec-bbdf-c2ea10853885','KN','EN','Saint Kitts and Nevis','XCD',NULL,0.00,0,'North America','NA',3575174,1),(122,'2495211b-5cbb-11ec-bbdf-c2ea10853885','KP','KO','North Korea','KPW',NULL,0.00,0,'Asia','AS',1873107,1),(123,'24952186-5cbb-11ec-bbdf-c2ea10853885','KR','KO','South Korea','KRW',NULL,0.00,0,'Asia','AS',1835841,1),(124,'24952204-5cbb-11ec-bbdf-c2ea10853885','KW','AR','Kuwait','KWD',NULL,0.00,0,'Asia','AS',285570,1),(125,'24952271-5cbb-11ec-bbdf-c2ea10853885','KY','EN','Cayman Islands','KYD',NULL,0.00,0,'North America','NA',3580718,1),(126,'249522e1-5cbb-11ec-bbdf-c2ea10853885','KZ','RU','Kazakhstan','KZT',NULL,0.00,0,'Asia','AS',1522867,1),(127,'2495234c-5cbb-11ec-bbdf-c2ea10853885','LA','LO','Laos','LAK',NULL,0.00,0,'Asia','AS',1655842,1),(128,'249523ba-5cbb-11ec-bbdf-c2ea10853885','LB','AR','Lebanon','LBP',NULL,0.00,0,'Asia','AS',272103,1),(129,'24952426-5cbb-11ec-bbdf-c2ea10853885','LC','EN','Saint Lucia','XCD',NULL,0.00,0,'North America','NA',3576468,1),(130,'24952493-5cbb-11ec-bbdf-c2ea10853885','LI','DE','Liechtenstein','CHF',NULL,0.00,0,'Europe','EU',3042058,1),(131,'24952502-5cbb-11ec-bbdf-c2ea10853885','LK','TA','Sri Lanka','LKR',NULL,0.00,0,'Asia','AS',1227603,1),(132,'2495256c-5cbb-11ec-bbdf-c2ea10853885','LR','EN','Liberia','LRD',NULL,0.00,0,'Africa','AF',2275384,1),(133,'249525d6-5cbb-11ec-bbdf-c2ea10853885','LS','ST','Lesotho','LSL',NULL,0.00,0,'Africa','AF',932692,1),(134,'24952641-5cbb-11ec-bbdf-c2ea10853885','LT','LT','Lithuania','EUR',NULL,0.00,0,'Europe','EU',597427,1),(135,'249526a8-5cbb-11ec-bbdf-c2ea10853885','LU','LB','Luxembourg','EUR',NULL,0.00,0,'Europe','EU',2960313,1),(136,'24952712-5cbb-11ec-bbdf-c2ea10853885','LV','LV','Latvia','EUR',NULL,0.00,0,'Europe','EU',458258,1),(137,'2495277d-5cbb-11ec-bbdf-c2ea10853885','LY','AR','Libya','LYD',NULL,0.00,0,'Africa','AF',2215636,1),(138,'249527e5-5cbb-11ec-bbdf-c2ea10853885','MA','AR','Morocco','MAD',NULL,0.00,0,'Africa','AF',2542007,1),(139,'2495284e-5cbb-11ec-bbdf-c2ea10853885','MC','FR','Monaco','EUR',NULL,0.00,0,'Europe','EU',2993457,1),(140,'249528b6-5cbb-11ec-bbdf-c2ea10853885','MD','RO','Moldova','MDL','373',0.20,20,'Europe','EU',617790,1),(141,'24952921-5cbb-11ec-bbdf-c2ea10853885','ME','SR','Montenegro','EUR',NULL,0.00,0,'Europe','EU',3194884,1),(142,'24952989-5cbb-11ec-bbdf-c2ea10853885','MF','FR','Saint Martin','EUR',NULL,0.00,0,'North America','NA',3578421,1),(143,'249529fa-5cbb-11ec-bbdf-c2ea10853885','MG','FR','Madagascar','MGA',NULL,0.00,0,'Africa','AF',1062947,1),(144,'24952a65-5cbb-11ec-bbdf-c2ea10853885','MH','MH','Marshall Islands','USD',NULL,0.00,0,'Oceania','OC',2080185,1),(145,'24952acf-5cbb-11ec-bbdf-c2ea10853885','MK','MK','Macedonia','MKD',NULL,0.00,0,'Europe','EU',718075,1),(146,'24952b38-5cbb-11ec-bbdf-c2ea10853885','ML','FR','Mali','XOF',NULL,0.00,0,'Africa','AF',2453866,1),(147,'24952ba1-5cbb-11ec-bbdf-c2ea10853885','MM','MY','Myanmar [Burma]','MMK',NULL,0.00,0,'Asia','AS',1327865,1),(148,'24952c0c-5cbb-11ec-bbdf-c2ea10853885','MN','MN','Mongolia','MNT',NULL,0.00,0,'Asia','AS',2029969,1),(149,'24952c73-5cbb-11ec-bbdf-c2ea10853885','MO','ZH','Macao','MOP',NULL,0.00,0,'Asia','AS',1821275,1),(150,'24952cda-5cbb-11ec-bbdf-c2ea10853885','MP','CH','Northern Mariana Islands','USD',NULL,0.00,0,'Oceania','OC',4041468,1),(151,'24952d47-5cbb-11ec-bbdf-c2ea10853885','MQ','FR','Martinique','EUR',NULL,0.00,0,'North America','NA',3570311,1),(152,'24952db1-5cbb-11ec-bbdf-c2ea10853885','MR','AR','Mauritania','MRO',NULL,0.00,0,'Africa','AF',2378080,1),(153,'24952e18-5cbb-11ec-bbdf-c2ea10853885','MS','EN','Montserrat','XCD',NULL,0.00,0,'North America','NA',3578097,1),(154,'24952e81-5cbb-11ec-bbdf-c2ea10853885','MT','MT','Malta','EUR',NULL,0.00,0,'Europe','EU',2562770,1),(155,'24952eed-5cbb-11ec-bbdf-c2ea10853885','MU','FR','Mauritius','MUR',NULL,0.00,0,'Africa','AF',934292,1),(156,'24952f56-5cbb-11ec-bbdf-c2ea10853885','MV','DV','Maldives','MVR',NULL,0.00,0,'Asia','AS',1282028,1),(157,'24952fbe-5cbb-11ec-bbdf-c2ea10853885','MW','NY','Malawi','MWK',NULL,0.00,0,'Africa','AF',927384,1),(158,'24953025-5cbb-11ec-bbdf-c2ea10853885','MX','ES','Mexico','MXN',NULL,0.00,0,'North America','NA',3996063,1),(159,'24953314-5cbb-11ec-bbdf-c2ea10853885','MY','MS','Malaysia','MYR',NULL,0.00,0,'Asia','AS',1733045,1),(160,'24953385-5cbb-11ec-bbdf-c2ea10853885','MZ','PT','Mozambique','MZN',NULL,0.00,0,'Africa','AF',1036973,1),(161,'249533ec-5cbb-11ec-bbdf-c2ea10853885','NA',NULL,'Namibia','NAD',NULL,0.00,0,'Africa','AF',3355338,1),(162,'24953455-5cbb-11ec-bbdf-c2ea10853885','NC','FR','New Caledonia','XPF',NULL,0.00,0,'Oceania','OC',2139685,1),(163,'249534bf-5cbb-11ec-bbdf-c2ea10853885','NE','FR','Niger','XOF',NULL,0.00,0,'Africa','AF',2440476,1),(164,'24953528-5cbb-11ec-bbdf-c2ea10853885','NF',NULL,'Norfolk Island','AUD',NULL,0.00,0,'Oceania','OC',2155115,1),(165,'24953593-5cbb-11ec-bbdf-c2ea10853885','NG','EN','Nigeria','NGN',NULL,0.00,0,'Africa','AF',2328926,1),(166,'249535fc-5cbb-11ec-bbdf-c2ea10853885','NI','ES','Nicaragua','NIO',NULL,0.00,0,'North America','NA',3617476,1),(167,'24953669-5cbb-11ec-bbdf-c2ea10853885','NL','NL','Netherlands','EUR','31',0.21,21,'Europe','EU',2750405,1),(168,'249536d5-5cbb-11ec-bbdf-c2ea10853885','NO','NB','Norway','NOK','47',0.25,25,'Europe','EU',3144096,1),(169,'24953742-5cbb-11ec-bbdf-c2ea10853885','NP','NE','Nepal','NPR',NULL,0.00,0,'Asia','AS',1282988,1),(170,'249537aa-5cbb-11ec-bbdf-c2ea10853885','NR','NA','Nauru','AUD',NULL,0.00,0,'Oceania','OC',2110425,1),(171,'24953812-5cbb-11ec-bbdf-c2ea10853885','NU',NULL,'Niue','NZD',NULL,0.00,0,'Oceania','OC',4036232,1),(172,'2495387c-5cbb-11ec-bbdf-c2ea10853885','NZ','EN','New Zealand','NZD',NULL,0.00,0,'Oceania','OC',2186224,1),(173,'249538e5-5cbb-11ec-bbdf-c2ea10853885','OM','AR','Oman','OMR','968',0.00,0,'Asia','AS',286963,1),(174,'24953953-5cbb-11ec-bbdf-c2ea10853885','PA','ES','Panama','PAB',NULL,0.00,0,'North America','NA',3703430,1),(175,'249539bd-5cbb-11ec-bbdf-c2ea10853885','PE','QU','Peru','PEN',NULL,0.00,0,'South America','SA',3932488,1),(176,'24953a27-5cbb-11ec-bbdf-c2ea10853885','PF','FR','French Polynesia','XPF',NULL,0.00,0,'Oceania','OC',4030656,1),(177,'24953a92-5cbb-11ec-bbdf-c2ea10853885','PG','HO','Papua New Guinea','PGK',NULL,0.00,0,'Oceania','OC',2088628,1),(178,'24953afb-5cbb-11ec-bbdf-c2ea10853885','PH',NULL,'Philippines','PHP',NULL,0.00,0,'Asia','AS',1694008,1),(179,'24953b65-5cbb-11ec-bbdf-c2ea10853885','PK','UR','Pakistan','PKR','92',0.17,17,'Asia','AS',1168579,1),(180,'24953bd1-5cbb-11ec-bbdf-c2ea10853885','PL','PL','Poland','PLN','48',0.00,0,'Europe','EU',798544,1),(181,'24953c3b-5cbb-11ec-bbdf-c2ea10853885','PM','FR','Saint Pierre and Miquelon','EUR',NULL,0.00,0,'North America','NA',3424932,1),(182,'24953ca5-5cbb-11ec-bbdf-c2ea10853885','PN',NULL,'Pitcairn Islands','NZD',NULL,0.00,0,'Oceania','OC',4030699,1),(183,'24953d0f-5cbb-11ec-bbdf-c2ea10853885','PR','ES','Puerto Rico','USD',NULL,0.00,0,'North America','NA',4566966,1),(184,'24953d7b-5cbb-11ec-bbdf-c2ea10853885','PS','AR','Palestine','ILS','970',0.00,0,'Asia','AS',6254930,1),(185,'24953de6-5cbb-11ec-bbdf-c2ea10853885','PT','PT','Portugal','EUR',NULL,0.00,0,'Europe','EU',2264397,1),(186,'24953e4f-5cbb-11ec-bbdf-c2ea10853885','PW',NULL,'Palau','USD',NULL,0.00,0,'Oceania','OC',1559582,1),(187,'24953eb8-5cbb-11ec-bbdf-c2ea10853885','PY',NULL,'Paraguay','PYG',NULL,0.00,0,'South America','SA',3437598,1),(188,'24953f25-5cbb-11ec-bbdf-c2ea10853885','QA','AR','Qatar','QAR','974',0.00,0,'Asia','AS',289688,1),(189,'24953f8f-5cbb-11ec-bbdf-c2ea10853885','RE','FR','Réunion','EUR',NULL,0.00,0,'Africa','AF',935317,1),(190,'24953ff8-5cbb-11ec-bbdf-c2ea10853885','RO','RO','Romania','RON','40',0.20,20,'Europe','EU',798549,1),(191,'24954060-5cbb-11ec-bbdf-c2ea10853885','RS','SR','Serbia','RSD',NULL,0.00,0,'Europe','EU',6290252,1),(192,'249540c9-5cbb-11ec-bbdf-c2ea10853885','RU','RU','Russia','RUB','7',0.18,18,'Europe','EU',2017370,1),(193,'249543a7-5cbb-11ec-bbdf-c2ea10853885','RW','RW','Rwanda','RWF',NULL,0.00,0,'Africa','AF',49518,1),(194,'24954416-5cbb-11ec-bbdf-c2ea10853885','SA','AR','Saudi Arabia','SAR','966',0.00,0,'Asia','AS',102358,1),(195,'2495447c-5cbb-11ec-bbdf-c2ea10853885','SB','EN','Solomon Islands','SBD',NULL,0.00,0,'Oceania','OC',2103350,1),(196,'249544e5-5cbb-11ec-bbdf-c2ea10853885','SC','FR','Seychelles','SCR',NULL,0.00,0,'Africa','AF',241170,1),(197,'24954552-5cbb-11ec-bbdf-c2ea10853885','SD','AR','Sudan','SDG','249',0.10,10,'Africa','AF',366755,1),(198,'249545bc-5cbb-11ec-bbdf-c2ea10853885','SE','SV','Sweden','SEK',NULL,0.00,0,'Europe','EU',2661886,1),(199,'24954626-5cbb-11ec-bbdf-c2ea10853885','SG','ZH','Singapore','SGD',NULL,0.00,0,'Asia','AS',1880251,1),(200,'24954690-5cbb-11ec-bbdf-c2ea10853885','SH',NULL,'Saint Helena','SHP',NULL,0.00,0,'Africa','AF',3370751,1),(201,'249546fc-5cbb-11ec-bbdf-c2ea10853885','SI','SL','Slovenia','EUR',NULL,0.00,0,'Europe','EU',3190538,1),(202,'24954763-5cbb-11ec-bbdf-c2ea10853885','SJ',NULL,'Svalbard and Jan Mayen','NOK',NULL,0.00,0,'Europe','EU',607072,1),(203,'249547cc-5cbb-11ec-bbdf-c2ea10853885','SK','SK','Slovakia','EUR',NULL,0.00,0,'Europe','EU',3057568,1),(204,'24954833-5cbb-11ec-bbdf-c2ea10853885','SL','EN','Sierra Leone','SLL',NULL,0.00,0,'Africa','AF',2403846,1),(205,'2495489c-5cbb-11ec-bbdf-c2ea10853885','SM','IT','San Marino','EUR',NULL,0.00,0,'Europe','EU',3168068,1),(206,'24954905-5cbb-11ec-bbdf-c2ea10853885','SN','FR','Senegal','XOF',NULL,0.00,0,'Africa','AF',2245662,1),(207,'2495496e-5cbb-11ec-bbdf-c2ea10853885','SO','SO','Somalia','SOS',NULL,0.00,0,'Africa','AF',51537,1),(208,'249549d6-5cbb-11ec-bbdf-c2ea10853885','SR','NL','Suriname','SRD',NULL,0.00,0,'South America','SA',3382998,1),(209,'24954a3e-5cbb-11ec-bbdf-c2ea10853885','SS',NULL,'South Sudan','SSP',NULL,0.00,0,'Africa','AF',7909807,1),(210,'24954aa8-5cbb-11ec-bbdf-c2ea10853885','ST','PT','São Tomé and Príncipe','STD',NULL,0.00,0,'Africa','AF',2410758,1),(211,'24954b11-5cbb-11ec-bbdf-c2ea10853885','SV','ES','El Salvador','USD',NULL,0.00,0,'North America','NA',3585968,1),(212,'24954b7b-5cbb-11ec-bbdf-c2ea10853885','SX','FR','Sint Maarten','ANG',NULL,0.00,0,'North America','NA',7609695,1),(213,'24954be4-5cbb-11ec-bbdf-c2ea10853885','SY','AR','Syria','SYP','963',0.00,0,'Asia','AS',163843,1),(214,'24954c4d-5cbb-11ec-bbdf-c2ea10853885','SZ','SS','Swaziland','SZL',NULL,0.00,0,'Africa','AF',934841,1),(215,'24954cba-5cbb-11ec-bbdf-c2ea10853885','TC','EN','Turks and Caicos Islands','USD',NULL,0.00,0,'North America','NA',3576916,1),(216,'24954f97-5cbb-11ec-bbdf-c2ea10853885','TD','AR','Chad','XAF',NULL,0.00,0,'Africa','AF',2434508,1),(217,'24955005-5cbb-11ec-bbdf-c2ea10853885','TF',NULL,'French Southern Territories','EUR',NULL,0.00,0,'Antarctica','AN',1546748,1),(218,'24955070-5cbb-11ec-bbdf-c2ea10853885','TG','FR','Togo','XOF',NULL,0.00,0,'Africa','AF',2363686,1),(219,'249550d7-5cbb-11ec-bbdf-c2ea10853885','TH','TH','Thailand','THB',NULL,0.00,0,'Asia','AS',1605651,1),(220,'2495513d-5cbb-11ec-bbdf-c2ea10853885','TJ','RU','Tajikistan','TJS',NULL,0.00,0,'Asia','AS',1220409,1),(221,'249551a5-5cbb-11ec-bbdf-c2ea10853885','TK','SM','Tokelau','NZD',NULL,0.00,0,'Oceania','OC',4031074,1),(222,'2495520d-5cbb-11ec-bbdf-c2ea10853885','TL','PT','East Timor','USD',NULL,0.00,0,'Oceania','OC',1966436,1),(223,'24955276-5cbb-11ec-bbdf-c2ea10853885','TM','RU','Turkmenistan','TMT',NULL,0.00,0,'Asia','AS',1218197,1),(224,'249552e0-5cbb-11ec-bbdf-c2ea10853885','TN','AR','Tunisia','TND',NULL,0.00,0,'Africa','AF',2464461,1),(225,'24955347-5cbb-11ec-bbdf-c2ea10853885','TO','TO','Tonga','TOP',NULL,0.00,0,'Oceania','OC',4032283,1),(226,'249553ad-5cbb-11ec-bbdf-c2ea10853885','TT','EN','Trinidad and Tobago','TTD',NULL,0.00,0,'North America','NA',3573591,1),(227,'24955416-5cbb-11ec-bbdf-c2ea10853885','TV',NULL,'Tuvalu','AUD',NULL,0.00,0,'Oceania','OC',2110297,1),(228,'2495547e-5cbb-11ec-bbdf-c2ea10853885','TW','ZH','Taiwan','TWD',NULL,0.00,0,'Asia','AS',1668284,1),(229,'249554e6-5cbb-11ec-bbdf-c2ea10853885','TZ','SW','Tanzania','TZS',NULL,0.00,0,'Africa','AF',149590,1),(230,'24955550-5cbb-11ec-bbdf-c2ea10853885','UA','UK','Ukraine','UAH','380',0.20,20,'Europe','EU',690791,1),(231,'24955824-5cbb-11ec-bbdf-c2ea10853885','UG','SW','Uganda','UGX',NULL,0.00,0,'Africa','AF',226074,1),(232,'2495588f-5cbb-11ec-bbdf-c2ea10853885','UM',NULL,'U.S. Minor Outlying Islands','USD',NULL,0.00,0,'Oceania','OC',5854968,1),(233,'249558fc-5cbb-11ec-bbdf-c2ea10853885','US','EN','United States','USD','1',0.00,0,'North America','NA',6252001,1),(234,'2495596a-5cbb-11ec-bbdf-c2ea10853885','UY','ES','Uruguay','UYU',NULL,0.00,0,'South America','SA',3439705,1),(235,'249559d4-5cbb-11ec-bbdf-c2ea10853885','UZ','RU','Uzbekistan','UZS',NULL,0.00,0,'Asia','AS',1512440,1),(236,'24955a3f-5cbb-11ec-bbdf-c2ea10853885','VA','IT','Vatican City','EUR',NULL,0.00,0,'Europe','EU',3164670,1),(237,'24955aaa-5cbb-11ec-bbdf-c2ea10853885','VC','EN','Saint Vincent and the Grenadines','XCD',NULL,0.00,0,'North America','NA',3577815,1),(238,'24955b15-5cbb-11ec-bbdf-c2ea10853885','VE','ES','Venezuela','VEF',NULL,0.00,0,'South America','SA',3625428,1),(239,'24955b7e-5cbb-11ec-bbdf-c2ea10853885','VG','EN','British Virgin Islands','USD',NULL,0.00,0,'North America','NA',3577718,1),(240,'24955e12-5cbb-11ec-bbdf-c2ea10853885','VI','EN','U.S. Virgin Islands','USD',NULL,0.00,0,'North America','NA',4796775,1),(241,'24955ebf-5cbb-11ec-bbdf-c2ea10853885','VN','VI','Vietnam','VND',NULL,0.00,0,'Asia','AS',1562822,1),(242,'24955f2a-5cbb-11ec-bbdf-c2ea10853885','VU','FR','Vanuatu','VUV',NULL,0.00,0,'Oceania','OC',2134431,1),(243,'24955f8f-5cbb-11ec-bbdf-c2ea10853885','WF','FR','Wallis and Futuna','XPF',NULL,0.00,0,'Oceania','OC',4034749,1),(244,'24955ff9-5cbb-11ec-bbdf-c2ea10853885','WS','SM','Samoa','WST',NULL,0.00,0,'Oceania','OC',4034894,1),(245,'24956065-5cbb-11ec-bbdf-c2ea10853885','XK',NULL,'Kosovo','EUR',NULL,0.00,0,'Europe','EU',831053,1),(246,'249560d1-5cbb-11ec-bbdf-c2ea10853885','YE','AR','Yemen','YER',NULL,0.00,0,'Asia','AS',69543,1),(247,'2495636a-5cbb-11ec-bbdf-c2ea10853885','YT','FR','Mayotte','EUR',NULL,0.00,0,'Africa','AF',1024031,1),(248,'2495641f-5cbb-11ec-bbdf-c2ea10853885','ZA','ZU','South Africa','ZAR',NULL,0.00,0,'Africa','AF',953987,1),(249,'24956501-5cbb-11ec-bbdf-c2ea10853885','ZM','EN','Zambia','ZMW',NULL,0.00,0,'Africa','AF',895949,1),(250,'249565a4-5cbb-11ec-bbdf-c2ea10853885','ZW','SN','Zimbabwe','ZWL',NULL,0.00,0,'Africa','AF',878675,1);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-28 13:48:48
