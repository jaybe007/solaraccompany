-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: solaraccompany_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `module` varchar(50) NOT NULL,
  `record_id` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_audit_user` (`user_id`),
  KEY `idx_audit_module` (`module`),
  KEY `idx_audit_created` (`created_at`),
  CONSTRAINT `fk_audit_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (1,1,'login_success','auth','1','User admin logged in successfully','::1','Python-urllib/3.13','2026-10-19 13:09:12'),(2,1,'login_success','auth','1','User admin logged in successfully','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0','2026-10-19 13:10:42');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Engineering Insights','engineering-insights','Technical breakdowns and civil engineering standards','2026-10-19 12:00:03'),(2,'Project Spotlights','project-spotlights','Case studies from landmark construction deliveries','2026-10-19 12:00:03'),(3,'Construction Standards','construction-standards','Quality control and regulatory best practices','2026-10-19 12:00:03');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_post_tags`
--

DROP TABLE IF EXISTS `blog_post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_post_tags` (
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `fk_bpt_tag` (`tag_id`),
  CONSTRAINT `fk_bpt_post` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_bpt_tag` FOREIGN KEY (`tag_id`) REFERENCES `blog_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_post_tags`
--

LOCK TABLES `blog_post_tags` WRITE;
/*!40000 ALTER TABLE `blog_post_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_post_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(400) NOT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(300) DEFAULT NULL,
  `status` enum('Draft','Published','Archived') NOT NULL DEFAULT 'Published',
  `published_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_blog_cat` (`category_id`),
  KEY `idx_blog_author` (`author_id`),
  KEY `idx_blog_status` (`status`),
  KEY `idx_blog_pubdate` (`published_at`),
  CONSTRAINT `fk_blog_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_blog_cat` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (7,'Structural Best Practices for Raft Foundations in Coastal Nigerian Terrains','structural-best-practices-raft-foundations-coastal-nigeria','An engineering breakdown of soil mechanics, load distribution, and water-table mitigation in heavy raft foundations based on our Lekki Scheme 2 project.','<p>Constructing multi-story residential blocks in coastal regions like Lagos requires specialized geotechnical planning. In this article, our structural engineering team examines the critical steps behind our 40-unit raft foundation project at Lekki Scheme 2, covering soil bearing capacity, moisture protection, and continuous pour techniques.</p><p>By implementing heavy continuous rebar meshes and waterproof grade concrete, settlement risks are completely eliminated.</p>','assets/images/projects/foundation work (1).jpeg',1,1,NULL,NULL,NULL,'Published','2026-10-19 12:00:03','2026-10-19 12:00:03','2026-10-19 12:00:03'),(8,'Delivering Excellence in Educational Infrastructure: The Ataoja Model School Case Study','delivering-excellence-ataoja-model-school-case-study','A detailed look at how SOLARAC executed the turnkey engineering supervision and construction of Ataoja Model School of Science in Osogbo.','<p>High-quality educational facilities require durable construction, proper acoustic insulation, natural ventilation, and flexible learning layouts. Learn how SOLARAC managed the construction and supervision of Ataoja Model School of Science to deliver an enduring academic landmark for Osun State.</p>','assets/images/projects/completed ataoja.jpeg',2,1,NULL,NULL,NULL,'Published','2026-10-19 12:00:03','2026-10-19 12:00:03','2026-10-19 12:00:03'),(9,'The Strategic Importance of Fair-Faced Reinforced Concrete in Industrial Perimeter Security','fair-faced-reinforced-concrete-industrial-security','Why industrial free trade zones and critical infrastructure rely on high-strength reinforced concrete fences for security and longevity.','<p>Industrial free trade zones demand perimeter barriers that resist environmental weathering, unauthorized intrusion, and soil shifting. This article explores the design and construction of the 300m reinforced concrete fence engineered by SOLARAC for the Livingspring Free Trade Zone.</p>','assets/images/projects/fair faced reinforced concrete fence, free trade zone, osogbo.jpeg',3,1,NULL,NULL,NULL,'Published','2026-10-19 12:00:03','2026-10-19 12:00:03','2026-10-19 12:00:03');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_tags`
--

DROP TABLE IF EXISTS `blog_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_tags`
--

LOCK TABLES `blog_tags` WRITE;
/*!40000 ALTER TABLE `blog_tags` DISABLE KEYS */;
INSERT INTO `blog_tags` VALUES (1,'Construction','construction'),(2,'Procurement','procurement'),(3,'Healthcare','healthcare'),(4,'Agribusiness','agribusiness'),(5,'Ibadan','ibadan');
/*!40000 ALTER TABLE `blog_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_msg_read` (`is_read`),
  KEY `idx_msg_archived` (`is_archived`),
  KEY `idx_msg_created` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'Ayoade Jubril Ajibade','cloudcurrentng@gmail.com','08136581089','Request to Verify Domain Delegation for solaraccompany.com','ccvvvbb',1,1,'::1','2026-10-19 13:12:50');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'General',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (16,'How do I request a construction quote or schedule a site inspection?','You can use our online \"Request a Quote\" portal or call our engineering team directly at 08035188495 / 08065833345. We will arrange a consultation and site assessment to prepare a comprehensive bill of quantities (BOQ).','General Construction',1,'','2026-10-19 12:00:03'),(17,'What geographic areas does SOLARAC Company LTD cover?','While our headquarters are in Osogbo, Osun State, we manage major civil engineering, building construction, and foundation projects across South-West Nigeria (Lagos, Oyo, Osun, Ogun, Ondo, Ekiti) and execute specialized contracts nationwide.','Operations & Locations',2,'','2026-10-19 12:00:03'),(18,'How long does a typical civil construction project take to complete?','Project timelines depend on project scale and complexity. Residential structures typically require 3 to 8 months, while large-scale commercial complexes, institutional buildings, and infrastructure projects range from 6 to 18 months under strict CPM scheduling.','Timelines & Delivery',3,'','2026-10-19 12:00:03'),(19,'Do you provide architectural design, structural analysis, and statutory approvals?','Yes. SOLARAC provides turnkey design-build solutions including architectural drawings, COREN-certified structural calculations, soil test coordination, EIA compliance, and assistance with statutory building approvals.','Design & Permits',4,'','2026-10-19 12:00:03'),(20,'Is SOLARAC registered and certified for public and federal contracts?','Yes. SOLARAC Company LTD is registered with the Corporate Affairs Commission (RC: 1175907), certified by the Bureau of Public Procurement (BPP IRR), fully compliant with FIRS, PenCom, and ITF, and our engineers are accredited by COREN and the Nigerian Society of Engineers (NSE).','Certifications & Compliance',5,'','2026-10-19 12:00:03');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `attempted_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_attempts_ip_time` (`ip_address`,`attempted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `mime_type` varchar(100) NOT NULL,
  `file_size` bigint(20) unsigned NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT '',
  `uploaded_by` int(10) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_media_mime` (`mime_type`),
  KEY `idx_media_created` (`created_at`),
  KEY `fk_media_user` (`uploaded_by`),
  CONSTRAINT `fk_media_user` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(300) DEFAULT NULL,
  `status` enum('published','draft') NOT NULL DEFAULT 'published',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_pages_slug` (`slug`),
  KEY `idx_pages_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'privacy-policy','Privacy Policy','<h2>Privacy Policy for STONE ENERGY INT\'L LTD</h2><p>At STONE ENERGY INT\'L LTD, accessible from our official website, your privacy is of paramount importance to us. This Privacy Policy document outlines the types of information that is collected and recorded by us and how we utilize it.</p><h3>Information We Collect</h3><p>We collect information you supply when submitting a Request for Quotation (RFQ), using our contact form, or communicating with our offices. This includes your name, company name, phone number, email address, project requirements, and location.</p><h3>Use of Your Information</h3><p>We use collected data solely to provide customized commercial quotations, execute general contracting agreements, fulfill procurement orders, and respond to commercial inquiries.</p><h3>Data Security</h3><p>We employ administrative and technical precautions to safeguard submitted information against unauthorized access, alteration, or disclosure.</p>','Privacy Policy | STONE ENERGY INT\'L LTD','Learn how STONE ENERGY INT\'L LTD protects your corporate and personal data.','published','2026-10-19 10:29:02'),(2,'terms-and-conditions','Terms & Conditions','<h2>Terms & Conditions</h2><p>Welcome to STONE ENERGY INT\'L LTD. By accessing this website and utilizing our RFQ and contracting portals, you agree to comply with the terms and conditions set forth herein.</p><h3>Commercial Quotations</h3><p>Quotations issued via our website or following RFQ submission represent non-binding estimates until confirmed through formal commercial purchase orders or signed contracts.</p><h3>Intellectual Property</h3><p>All brand assets, service specifications, website content, and media remain the property of STONE ENERGY INT\'L LTD.</p>','Terms & Conditions | STONE ENERGY INT\'L LTD','Review the terms and conditions governing engagement with STONE ENERGY INT\'L LTD.','published','2026-10-19 10:29:02'),(3,'cookie-policy','Cookie Policy','<h2>Cookie Policy</h2><p>STONE ENERGY INT\'L LTD uses essential cookies to ensure safe browsing, CSRF security verification, and administrative session management.</p><p>We do not sell personal browsing data to external advertisers.</p>','Cookie Policy | STONE ENERGY INT\'L LTD','Detailed explanation of cookie usage and session security on our platform.','published','2026-10-19 10:29:02'),(4,'disclaimer','Legal Disclaimer','<h2>Legal Disclaimer</h2><p>The information on this website is provided for general informational and procurement reference. While STONE ENERGY INT\'L LTD strives to maintain accurate and updated information, specifications and material availability may vary depending on project scale, market availability, and contractual requirements.</p><p>Technical and regulatory compliance requirements for oil & gas, civil construction, and healthcare equipment supplies are formally verified on a per-contract basis.</p>','Legal Disclaimer | STONE ENERGY INT\'L LTD','Official disclaimer regarding product availability and general contracting services.','published','2026-10-19 10:29:02');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(120) NOT NULL,
  `token_hash` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `token_hash` (`token_hash`),
  KEY `idx_pw_email` (`email`),
  KEY `idx_pw_token` (`token_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `module` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Manage Users','users.manage','users','2026-10-19 10:29:02'),(2,'Manage Roles','roles.manage','roles','2026-10-19 10:29:02'),(3,'Manage Settings','settings.manage','settings','2026-10-19 10:29:02'),(4,'Manage RFQs','rfqs.manage','rfqs','2026-10-19 10:29:02'),(5,'Manage Messages','messages.manage','messages','2026-10-19 10:29:02'),(6,'Manage Services','services.manage','services','2026-10-19 10:29:02'),(7,'Manage Products','products.manage','products','2026-10-19 10:29:02'),(8,'Manage Projects','projects.manage','projects','2026-10-19 10:29:02'),(9,'Manage Blog','blog.manage','blog','2026-10-19 10:29:02'),(10,'Manage Media','media.manage','media','2026-10-19 10:29:02'),(11,'Manage Pages','pages.manage','pages','2026-10-19 10:29:02'),(12,'View Audit Logs','audit.view','audit','2026-10-19 10:29:02'),(13,'Export Backups','backup.export','backup','2026-10-19 10:29:02');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'Oil & Gas Petroleum','oil-and-gas','Crude oil, refined petroleum products (AGO diesel, PMS, DPK) and bulk energy supplies',NULL,1,'2026-10-19 10:29:02'),(2,'Construction','construction','Building materials, aggregates, structural steel and civil supplies',NULL,2,'2026-10-19 10:29:02'),(3,'Hospital Equipment','hospital-equipment','Clinical furniture, monitoring devices and hospital ward fittings',NULL,3,'2026-10-19 10:29:02'),(4,'Hospital Consumables','hospital-consumables','Sterile medical consumables, protective gear and laboratory sundries',NULL,4,'2026-10-19 10:29:02'),(5,'Agriculture','agriculture','Grains, seeds, bulk agricultural produce and farm inputs',NULL,5,'2026-10-19 10:29:02'),(6,'Agro-Allied','agro-allied','Fertilizers, agrochemicals and soil management supplies',NULL,6,'2026-10-19 10:29:02'),(7,'Animal Feeds & Agroprocessing','agroprocessing','Quality floating fish feed, poultry & livestock feeds, and feed milling supplies',NULL,7,'2026-10-19 10:29:02'),(8,'Industrial Supplies','industrial-supplies','Tools, safety equipment, fasteners and workshop machinery',NULL,8,'2026-10-19 10:29:02'),(9,'Other','other','Specialized commercial procurement and custom supply items',NULL,9,'2026-10-19 10:29:02');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_pimg_prod` (`product_id`),
  CONSTRAINT `fk_pimg_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `short_description` varchar(350) NOT NULL,
  `description` longtext NOT NULL,
  `specifications` longtext DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `datasheet` varchar(255) DEFAULT NULL,
  `availability` enum('in_stock','available_on_order','procured_on_demand') NOT NULL DEFAULT 'available_on_order',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('published','draft','archived') NOT NULL DEFAULT 'published',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `sku` (`sku`),
  KEY `idx_prod_cat` (`category_id`),
  KEY `idx_prod_status` (`status`),
  KEY `idx_prod_featured` (`featured`),
  CONSTRAINT `fk_prod_cat` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Automotive Gas Oil (AGO / Diesel) Bulk Petroleum Supply','automotive-gas-oil-ago-diesel-bulk-petroleum-supply','SEI-PET-001',1,'Depot-direct metered supply and tanker haulage of high-grade Automotive Gas Oil (AGO / Diesel) for corporate fleets, telecom hubs, and manufacturing facilities.','<p>High-flashpoint, clean-combustion Automotive Gas Oil (AGO) sourced from certified downstream depots. Engineered for peak performance in commercial heavy trucks, industrial power generators, and institutional boiler systems across Nigeria.</p>','Product: Automotive Gas Oil (AGO / Diesel)||Specification: NMDPRA Standard Compliant||Flash Point: Min 66Γö¼ΓûæC||Density @ 15Γö¼ΓûæC: 0.820 - 0.860 kg/L||Delivery Capacities: 11,000L / 22,000L / 33,000L / 45,000L Metered Tankers','Stone Energy Petroleum','Certified Downstream Depots',NULL,NULL,'in_stock',1,'published','2026-10-19 10:29:02','2026-10-19 10:29:02'),(2,'High-Tensile TMT Deformed Reinforcing Steel Bars','high-tensile-tmt-reinforcing-steel-bars','SEI-CON-002',2,'Grade Fe 500 / 500D high-yield thermo-mechanically treated deformed rebars for heavy civil and commercial building foundations.','<p>Tested reinforcement steel bars sourced directly for high-stress structural civil works, bridges, commercial complexes, and industrial warehouses across Nigeria. Compliant with national building codes.</p>','Grade: Fe 500 / 500D||Diameters Available: 10mm, 12mm, 16mm, 20mm, 25mm, 32mm||Length: Standard 12m Bundles||Bendability: Superior Cold Bend Capability','Standard Grade','Certified Mill',NULL,NULL,'available_on_order',1,'published','2026-10-19 10:29:02','2026-10-19 10:29:02'),(3,'Multi-Function Electric ICU Patient Bed','multi-function-electric-icu-patient-bed','SEI-MED-003',3,'Advanced multi-position medical ward bed with electric remote control, backup battery, and integrated ABS fold-down side rails.','<p>Built to enhance clinical care and patient comfort in emergency wards, ICUs, and private hospital rooms. Provides smooth trendelenburg, reverse trendelenburg, backrest, and knee elevation adjustments.</p>','Frame: Epoxy Powder-Coated Steel||Functions: 5-Function Electric Adjustment||Castors: 125mm Central Locking Castors||Safe Working Load: 250 kg||Safety: Emergency CPR Quick Release','Medical Solutions','Accredited Medical Supplier',NULL,NULL,'procured_on_demand',1,'published','2026-10-19 10:29:02','2026-10-19 10:29:02'),(4,'Sterile Surgical Gloves & Clinical PPE Pack','sterile-surgical-gloves-clinical-ppe-pack','SEI-MED-004',4,'Powder-free textured latex and nitrile surgical gloves packaged with disposable barrier gowns and surgical masks for healthcare providers.','<p>Essential infection prevention consumables supplied in bulk cartons to clinics, general hospitals, and research facilities across Oyo State and surrounding regions.</p>','Material: Medical Grade Latex / Nitrile||Sterilization: Gamma Ray / EO Gas||Sizes: 6.5, 7.0, 7.5, 8.0||Packaging: 50 Pairs/Box, 10 Boxes/Carton','Standard Medical','Approved Manufacturer',NULL,NULL,'in_stock',1,'published','2026-10-19 10:29:02','2026-10-19 10:29:02'),(5,'Bulk Clean Maize & Soybeans Agricultural Supply','bulk-clean-maize-soybeans-agricultural-supply','SEI-AG-005',5,'High-grade commercial yellow/white maize and non-GMO soybeans for commercial feed mills and agroprocessors.','<p>Procured from verified farmer cooperatives and organized agricultural clusters. Cleaned, graded, and moisture-tested to ensure maximum conversion efficiency for poultry and livestock feed millers.</p>','Moisture Content: Max 12% - 13%||Foreign Matter: Under 1.5%||Broken Grains: Max 2%||Packaging: 50kg / 100kg Polypropylene Bags or Bulk Tipper','Stone Agro Supply','Farm Cluster Aggregation',NULL,NULL,'available_on_order',1,'published','2026-10-19 10:29:02','2026-10-19 10:29:02'),(6,'Premium Floating Catfish & Tilapia Feed (Extruded Pellets)','premium-floating-catfish-tilapia-feed-extruded-pellets','SEI-FEED-006',7,'High-protein, highly digestible extruded floating fish feed pellets formulated for rapid weight gain and optimal feed conversion ratios.','<p>Manufactured using quality marine fishmeal, toasted soybeans, essential amino acids, and balanced premixes. Extruded with advanced buoyant technology ensuring pellets stay floating on the water surface for over 30 minutes, preventing pond water fouling and maximizing fish nutrient absorption.</p>','Crude Protein: 42% - 45% (Fingerling/Juvenile) | 38% - 40% (Grower/Finisher)||Pellet Diameters: 1.5mm, 2mm, 3mm, 4mm, 6mm, 9mm||Buoyancy: >95% Floating Buoyant Pellets||Packaging: 15kg & 25kg Durable Woven Bags','Stone Feeds','Stone Energy Agroprocessing Division',NULL,NULL,'in_stock',1,'published','2026-10-19 10:29:02','2026-10-19 10:29:02'),(7,'Crude Oil Commercial Supply & Offtake Logistics','crude-oil-commercial-supply-offtake-logistics','SEI-PET-007',1,'Commercial brokerage, off-take coordination, and haulage logistics for certified crude oil allocations and industrial users.','<p>Facilitating structured crude oil supply arrangements and terminal logistics for approved buyers, refineries, and commercial industrial end-users across West Africa.</p>','Grade: Light Sweet Crude / Domestic Heavy Blends||Quality Verification: Independent SGS / Intertek Inspection Available||Logistics: Marine Vessel Charter / Pipeline & Road Haulage Coordination','Stone Energy Petroleum','Terminal Offtake Partners',NULL,NULL,'available_on_order',1,'published','2026-10-19 10:29:02','2026-10-19 10:29:02'),(8,'Commercial Animal Feeds (Poultry, Swine & Livestock)','commercial-animal-feeds-poultry-swine-livestock','SEI-FEED-008',7,'Scientifically balanced complete mash and pellet feeds for poultry broilers, layers, pigs, and cattle.','<p>Nutrient-dense feeds formulated with accurate energy-to-protein ratios to support high egg production in layers, fast meat development in broilers, and healthy swine growth with minimum feed wastage.</p>','Feed Types: Broiler Starter/Finisher, Layer Mash, Pig Grower, Cattle Concentrate||Packaging: 25kg / 50kg Branded Bags||Key Ingredients: Maize, Soya Meal, Wheat Offal, Bone Meal, Premix','Stone Feeds','Stone Energy Agroprocessing Division',NULL,NULL,'in_stock',1,'published','2026-10-19 10:29:02','2026-10-19 10:29:02');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_categories`
--

DROP TABLE IF EXISTS `project_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_categories`
--

LOCK TABLES `project_categories` WRITE;
/*!40000 ALTER TABLE `project_categories` DISABLE KEYS */;
INSERT INTO `project_categories` VALUES (15,'Educational & Institutional','educational-institutional','Educational & Institutional Projects','2026-10-19 12:00:03'),(16,'Infrastructure & Industrial Fencing','infrastructure-fencing','Infrastructure & Industrial Fencing Projects','2026-10-19 12:00:03'),(17,'Residential & Housing Estates','residential-housing','Residential & Housing Estates Projects','2026-10-19 12:00:03'),(18,'Foundations & Earthworks','foundations-earthworks','Foundations & Earthworks Projects','2026-10-19 12:00:03'),(19,'Commercial & Community Centers','commercial-community','Commercial & Community Centers Projects','2026-10-19 12:00:03');
/*!40000 ALTER TABLE `project_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_images`
--

DROP TABLE IF EXISTS `project_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_pimg2_proj` (`project_id`),
  CONSTRAINT `fk_pimg2_proj` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_images`
--

LOCK TABLES `project_images` WRITE;
/*!40000 ALTER TABLE `project_images` DISABLE KEYS */;
INSERT INTO `project_images` VALUES (19,23,'assets/images/projects/completed ataoja.jpeg','Ataoja Model School of Science',1),(20,24,'assets/images/projects/fair faced reinforced concrete fence, free trade zone, osogbo.jpeg','Livingspring Free Trade Zone 300m Reinforced Concrete Fence',1),(21,25,'assets/images/projects/foundation work (1).jpeg','40 Units Raft Foundation for 3-Story Blocks of Flats',1),(22,26,'assets/images/projects/jk (1).jpeg','Jokodolu Foundation Vocational Center & Admin Complex',1),(23,27,'assets/images/projects/reinforeced concrete fece obada-ede.jpeg','Reinforced Concrete Perimeter Barrier - Obada-Ede',1),(24,28,'assets/images/projects/ata2.jpeg','Ataoja Model School Construction - Phase 2',1),(25,29,'assets/images/projects/foundation work (2).jpeg','Structural Foundation Works - Phase 2',1),(26,30,'assets/images/projects/image-4.jpg','Modern Multi-Unit Residential Block Development',1),(27,31,'assets/images/projects/jk (2).jpeg','Jokodolu Foundation Service Quarters Complex',1);
/*!40000 ALTER TABLE `project_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `location` varchar(150) NOT NULL,
  `client` varchar(150) NOT NULL DEFAULT '[ADD CLIENT NAME]',
  `description` longtext NOT NULL,
  `scope` text NOT NULL,
  `start_date` date DEFAULT NULL,
  `completion_date` date DEFAULT NULL,
  `status` enum('Upcoming','Ongoing','Completed') NOT NULL DEFAULT 'Upcoming',
  `featured_image` varchar(255) DEFAULT NULL,
  `published_status` enum('published','draft') NOT NULL DEFAULT 'published',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_proj_cat` (`category_id`),
  KEY `idx_proj_status` (`status`),
  KEY `idx_proj_pub` (`published_status`),
  CONSTRAINT `fk_proj_cat` FOREIGN KEY (`category_id`) REFERENCES `project_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (23,'Ataoja Model School of Science','ataoja-model-school-of-science',15,'Osogbo, Osun State','Osun State Government / Ministry of Works','Engineering supervision and turnkey construction of Ataoja Model School of Science in Osogbo, recognized as a landmark academic institution in Osun State.','Complete engineering supervision and construction of modern science lecture halls, laboratories, administrative facilities, external paved accesses, and storm water drainage.',NULL,'2023-11-15','Completed','assets/images/projects/completed ataoja.jpeg','published','2026-10-19 12:00:03','2026-10-19 12:00:03'),(24,'Livingspring Free Trade Zone 300m Reinforced Concrete Fence','livingspring-free-trade-zone-fence',16,'Abeere-Ede Road, Osun State','Livingspring Free Trade Zone Authority','Construction of 300m fair-faced reinforced concrete security perimeter fence for Livingspring Free Trade Zone, delivering maximum durability and structural resilience.','300 meters of continuous high-strength reinforced concrete fence panels, heavy pilasters, grade beams, expansion joints, and erosion control retaining walls.',NULL,'2024-02-20','Completed','assets/images/projects/fair faced reinforced concrete fence, free trade zone, osogbo.jpeg','published','2026-10-19 12:00:03','2026-10-19 12:00:03'),(25,'40 Units Raft Foundation for 3-Story Blocks of Flats','raft-foundation-lekki-scheme-2',18,'Lekki Scheme 2, Lagos State','Prime Residential Consortium','Engineering and casting of 40 units of high-capacity Raft Foundations for 3-story block of flats at Lekki Scheme 2, Lagos, ensuring zero-settlement stability in coastal terrain.','Excavation, geotechnical stabilization, continuous steel reinforcement grids, damp-proof membrane installation, and precision high-MPa concrete casting.',NULL,'2024-06-10','Completed','assets/images/projects/foundation work (1).jpeg','published','2026-10-19 12:00:03','2026-10-19 12:00:03'),(26,'Jokodolu Foundation Vocational Center & Admin Complex','jokodolu-foundation-vocational-complex',19,'Ogbomoso, Oyo State','Jokodolu Foundation','Construction of 200-Seater Vocational Training Hall, Administrative Complex, and Computer Laboratory for the Jokodolu Foundation in Ogbomoso.','Structural concrete framing, high-span roofing, specialized computer lab power architecture, seminar halls, and surrounding paved compound.',NULL,'2024-04-18','Completed','assets/images/projects/jk (1).jpeg','published','2026-10-19 12:00:03','2026-10-19 12:00:03'),(27,'Reinforced Concrete Perimeter Barrier - Obada-Ede','reinforced-concrete-fence-obada-ede',16,'Obada-Ede, Osun State','Industrial Estate Developers','Reinforced concrete security fence constructed with heavy structural columns and anti-weathering concrete in Obada-Ede.','Structural excavation, concrete columns casting, pre-cast and in-situ wall panels, capping beams, and anti-intrusion perimeter design.',NULL,'2023-09-30','Completed','assets/images/projects/reinforeced concrete fece obada-ede.jpeg','published','2026-10-19 12:00:03','2026-10-19 12:00:03'),(28,'Ataoja Model School Construction - Phase 2','ataoja-construction-phase-2',15,'Osogbo, Osun State','Osun State Ministry of Works','Phase 2 expansion of Ataoja Model School of Science, completing advanced laboratories and campus access infrastructure.','Superstructure construction, internal partitions, architectural painting and coating, plumbing installations, and electrical distribution.',NULL,'2024-01-15','Completed','assets/images/projects/ata2.jpeg','published','2026-10-19 12:00:03','2026-10-19 12:00:03'),(29,'Structural Foundation Works - Phase 2','foundation-construction-phase-2',18,'Lekki Coastal Corridor, Lagos','Commercial Developers Ltd','Deep foundation works executing precision reinforced concrete substructures under challenging soil conditions.','Deep beam excavations, steel cage placement, concrete vibratory compaction, and moisture barrier integration for high-density foundations.',NULL,'2024-08-01','Ongoing','assets/images/projects/foundation work (2).jpeg','published','2026-10-19 12:00:03','2026-10-19 12:00:03'),(30,'Modern Multi-Unit Residential Block Development','modern-multi-unit-residential-development',17,'Osogbo Metro, Osun State','Private Property Investors','Turnkey construction of modern residential units with reinforced concrete slab framing and luxury surface finishes.','Full architectural execution from ground-breaking to luxury interior finishing, protective coating, and exterior landscaping.',NULL,'2024-05-20','Completed','assets/images/projects/image-4.jpg','published','2026-10-19 12:00:03','2026-10-19 12:00:03'),(31,'Jokodolu Foundation Service Quarters Complex','jokodolu-foundation-service-quarters',19,'Ogbomoso, Oyo State','Jokodolu Foundation','Dedicated service quarters constructed within the Jokodolu Foundation training compound in Ogbomoso.','Construction of modern residential quarters for administrative staff and trainers, complete with utilities and security features.',NULL,'2024-07-15','Completed','assets/images/projects/jk (2).jpeg','published','2026-10-19 12:00:03','2026-10-19 12:00:03');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rfq_items`
--

DROP TABLE IF EXISTS `rfq_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rfq_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rfq_id` int(10) unsigned NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `specifications` text DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_rfq_items` (`rfq_id`),
  CONSTRAINT `fk_rfq_items` FOREIGN KEY (`rfq_id`) REFERENCES `rfqs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfq_items`
--

LOCK TABLES `rfq_items` WRITE;
/*!40000 ALTER TABLE `rfq_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `rfq_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rfqs`
--

DROP TABLE IF EXISTS `rfqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rfqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rfq_number` varchar(30) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `service_or_product` varchar(200) NOT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `project_location` varchar(200) DEFAULT NULL,
  `required_delivery_date` date DEFAULT NULL,
  `project_description` longtext NOT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `status` enum('NEW','UNDER REVIEW','QUOTATION PREPARED','SENT','NEGOTIATION','APPROVED','COMPLETED','CANCELLED') NOT NULL DEFAULT 'NEW',
  `admin_notes` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `rfq_number` (`rfq_number`),
  KEY `idx_rfq_num` (`rfq_number`),
  KEY `idx_rfq_status` (`status`),
  KEY `idx_rfq_email` (`email`),
  KEY `idx_rfq_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfqs`
--

LOCK TABLES `rfqs` WRITE;
/*!40000 ALTER TABLE `rfqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `rfqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permissions` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `fk_rp_perm` (`permission_id`),
  CONSTRAINT `fk_rp_perm` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_rp_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(2,3),(2,4),(2,5),(2,6),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(3,6),(3,7),(3,8),(3,9),(3,10),(3,11),(4,6),(4,7),(4,8),(4,9),(4,10),(4,11);
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','super_admin','Full system access and administrator management','2026-10-19 10:29:02'),(2,'Admin','admin','Manage business content, RFQs, messages and settings','2026-10-19 10:29:02'),(3,'Editor','editor','Manage catalog, projects, services and publications','2026-10-19 10:29:02'),(4,'Content Manager','content_manager','Manage content pages, media, blog and portfolio','2026-10-19 10:29:02');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo_metadata`
--

DROP TABLE IF EXISTS `seo_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo_metadata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entity_type` varchar(50) NOT NULL,
  `entity_id` int(10) unsigned NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(300) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_seo_entity` (`entity_type`,`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo_metadata`
--

LOCK TABLES `seo_metadata` WRITE;
/*!40000 ALTER TABLE `seo_metadata` DISABLE KEYS */;
/*!40000 ALTER TABLE `seo_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_categories`
--

DROP TABLE IF EXISTS `service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_categories`
--

LOCK TABLES `service_categories` WRITE;
/*!40000 ALTER TABLE `service_categories` DISABLE KEYS */;
INSERT INTO `service_categories` VALUES (18,'Project Management & EPC','project-management','Complete lifecycle engineering supervision, cost engineering, procurement, and turnkey delivery.','2026-10-19 12:00:03'),(19,'Civil & Building Construction','civil-construction','Structural engineering, multi-story buildings, raft foundations, and educational institutions.','2026-10-19 12:00:03'),(20,'Infrastructure & Transportation','infrastructure-transport','Road construction, reinforced concrete fences, bridges, drainage, and hydraulic structures.','2026-10-19 12:00:03'),(21,'Facilities Management & Telecom','facilities-telecom','Telecom mast erection, base stations, mechanical maintenance, and corporate facility management.','2026-10-19 12:00:03');
/*!40000 ALTER TABLE `service_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `icon` varchar(100) DEFAULT 'wrench',
  `short_description` varchar(300) NOT NULL,
  `full_description` longtext NOT NULL,
  `features` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(300) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_services_cat` (`category_id`),
  KEY `idx_services_status` (`status`),
  KEY `idx_services_order` (`sort_order`),
  CONSTRAINT `fk_services_cat` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (25,'Comprehensive Project Management','project-management-services',18,'briefcase','End-to-end engineering supervision, quality control, cost management, and timely project delivery from planning to completion.','SOLARAC provides full-lifecycle construction project management designed to eliminate risks, minimize overheads, and guarantee architectural excellence. Our experienced project managers supervise daily site operations, maintain stringent QA/QC schedules, oversee vendor compliance, and ensure zero-compromise safety protocols under Advanced HSE frameworks.','[\"Feasibility & Site Assessment\",\"CPM Scheduling & Milestones\",\"Procurement & Vendor Oversight\",\"Advanced QA\\/QC Testing\",\"Full Regulatory Handover & Commissioning\"]','assets/images/slide1.jpg','active',1,NULL,NULL,'2026-10-19 12:00:03','2026-10-19 12:00:03'),(26,'Civil Engineering & Building Construction','civil-engineering-construction',19,'building','Execution of modern commercial complexes, educational institutions, residential blocks, and industrial superstructures.','We engineer and construct landmark structures utilizing state-of-the-art Eurocode, BS, and Nigerian building code standards. Notable deliveries include the Ataoja Model School of Science in Osogbo, high-density residential blocks in Lagos, and specialized foundation works across South-West Nigeria.','[\"Reinforced Concrete Works\",\"Commercial & Institutional Complexes\",\"High-Rise & Block of Flats\",\"Structural Steel Fabrication\",\"Architectural Design-Build Execution\"]','assets/images/projects/completed ataoja.jpeg','active',2,NULL,NULL,'2026-10-19 12:00:03','2026-10-19 12:00:03'),(27,'Foundation Engineering & Sub-Structures','foundation-engineering',19,'layers','High-capacity raft foundations, pile caps, soil stabilization, and heavy load-bearing substructures.','Our structural engineers specialize in deep foundation solutions and raft foundations for challenging terrains, including waterlogged coastal areas like Lekki Scheme 2 in Lagos where we engineered 40 units of Raft Foundations for 3-story blocks of flats.','[\"Raft Foundation Engineering\",\"Heavy Reinforced Sub-bases\",\"Geotechnical Soil Analysis\",\"Waterproofing & Damp-proofing\",\"Structural Load Testing\"]','assets/images/projects/foundation work (1).jpeg','active',3,NULL,NULL,'2026-10-19 12:00:03','2026-10-19 12:00:03'),(28,'Reinforced Concrete Fencing & Civil Works','reinforced-concrete-fencing',20,'shield','Industrial perimeter security walls, fair-faced concrete barriers, and massive civil infrastructure.','Specialized construction of high-durability reinforced concrete perimeter walls for free trade zones, government assets, and industrial parks. Featured project: 300m Reinforced Concrete Fence for Livingspring Free Trade Zone, Abeere-Ede Road, Osogbo.','[\"300m+ Industrial Concrete Fences\",\"Fair-Faced Architectural Concrete\",\"Perimeter Security Structures\",\"Earth Retention & Retaining Walls\",\"Heavy Earthmoving & Grading\"]','assets/images/projects/fair faced reinforced concrete fence, free trade zone, osogbo.jpeg','active',4,NULL,NULL,'2026-10-19 12:00:03','2026-10-19 12:00:03'),(29,'Transportation & Hydraulic Engineering','transportation-hydraulic-engineering',20,'truck','Road network construction, asphalt surfacing, bridge culverts, drainage channels, and water infrastructure.','Planning, engineering, and construction of vital transport links that connect communities and promote economic vitality. We construct durable roads, access corridors, hydraulic retaining walls, and storm-water drainage networks with maximum lifespan.','[\"Road Infrastructure & Asphalting\",\"Box Culverts & Hydraulic Channels\",\"Storm Drainage Systems\",\"Traffic Flow Planning\",\"Bridge Abutments & Retaining Structures\"]','assets/images/slide3.jpg','active',5,NULL,NULL,'2026-10-19 12:00:03','2026-10-19 12:00:03'),(30,'General Facilities Management & Telecom Infrastructure','facilities-management-telecom',21,'tool','Telecom mast erection, base transceiver station (BTS) construction, corporate building maintenance, and MEP services.','Turnkey facilities management and telecommunication engineering services. Our teams manage high-grade telecom masts, BTS infrastructure, mechanical, electrical, plumbing (MEP) installations, and routine facility refurbishment to protect asset value.','[\"Telecom Mast Erection & Maintenance\",\"BTS Foundation & Tower Grounding\",\"Corporate Facility Maintenance\",\"MEP Infrastructure Servicing\",\"Painting, Decorating & Protective Coatings\"]','assets/images/slide2.jpg','active',6,NULL,NULL,'2026-10-19 12:00:03','2026-10-19 12:00:03');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` mediumtext DEFAULT NULL,
  `setting_group` varchar(50) NOT NULL DEFAULT 'general',
  `label` varchar(150) NOT NULL,
  `field_type` enum('text','textarea','editor','image','boolean','select','number') NOT NULL DEFAULT 'text',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`),
  KEY `idx_settings_group` (`setting_group`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'company_name','SOLARAC Company LTD','general','Company Legal Name','text','2026-10-19 11:35:20'),(2,'tagline','CIVIL ENGINEERING, BUILDING CONSTRUCTION & PROJECT MANAGEMENT','general','Company Tagline','text','2026-10-19 11:35:20'),(3,'motto','Building the Future with Integrity, Innovation and Excellence.','general','Brand Motto','text','2026-10-19 11:35:20'),(4,'cac_number','RC 1175907','general','CAC Registration Number','text','2026-10-19 11:35:20'),(5,'rc_number','RC: 1175907','general','Corporate Affairs RC Number','text','2026-10-19 11:35:20'),(6,'logo_url','assets/images/logo.png','general','Header Logo Image','image','2026-10-19 11:35:20'),(7,'favicon_url','assets/images/logo.png','general','Website Favicon','image','2026-10-19 11:35:20'),(8,'phone_primary','08035188495','contact','Primary Phone Number','text','2026-10-19 11:35:20'),(9,'phone_secondary','08065833345','contact','Secondary Phone Number','text','2026-10-19 11:35:20'),(10,'email_primary','info@solaraccompany.com','contact','Official Email Address','text','2026-10-19 11:35:20'),(11,'email_support','info@solaraccompany.com','contact','Support / RFQ Email','text','2026-10-19 11:35:20'),(12,'office_address','No 48, Baruwa Street, Opposite Old Governor\'s Office, Osogbo, Osun State, Nigeria','contact','Physical Headquarters Address','textarea','2026-10-19 11:35:20'),(13,'city','Osogbo','contact','Base City','text','2026-10-19 11:35:20'),(14,'state','Osun State','contact','State','text','2026-10-19 11:35:20'),(15,'country','Nigeria','contact','Country','text','2026-10-19 10:29:02'),(16,'business_hours','Mon - Fri: 8:00 AM - 6:00 PM | Sat: 9:00 AM - 4:00 PM | Sun: Closed','contact','Official Business Hours','text','2026-10-19 11:35:20'),(17,'whatsapp_number','2348035188495','whatsapp','WhatsApp Business Number (digits only)','text','2026-10-19 11:35:20'),(18,'whatsapp_message','Hello SOLARAC Company LTD, I would like to inquire about your civil engineering, construction, and project management services.','whatsapp','WhatsApp Default Message','textarea','2026-10-19 11:35:20'),(19,'whatsapp_enabled','1','whatsapp','Enable Floating WhatsApp Widget','boolean','2026-10-19 10:29:02'),(20,'google_maps_embed','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.889379848555!2d4.5501869!3d7.7788481!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1037882200000001%3A0x64b8bb26d9c6e545!2sOsogbo%2C%20Osun!5e0!3m2!1sen!2sng!4v1700000000000!5m2!1sen!2sng\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>','contact','Google Maps Embed URL','textarea','2026-10-19 11:35:20'),(21,'social_facebook','','social','Facebook URL','text','2026-10-19 10:29:02'),(22,'social_linkedin','','social','LinkedIn Company URL','text','2026-10-19 10:29:02'),(23,'social_twitter','','social','X / Twitter URL','text','2026-10-19 10:29:02'),(24,'social_instagram','','social','Instagram URL','text','2026-10-19 10:29:02'),(25,'social_youtube','','social','YouTube Channel URL','text','2026-10-19 10:29:02'),(26,'smtp_host','localhost','smtp','SMTP Server Host','text','2026-10-19 10:29:02'),(27,'smtp_port','587','smtp','SMTP Port','number','2026-10-19 10:29:02'),(28,'smtp_username','','smtp','SMTP Username','text','2026-10-19 10:29:02'),(29,'smtp_password','','smtp','SMTP Password','text','2026-10-19 10:29:02'),(30,'smtp_encryption','tls','smtp','SMTP Encryption (tls / ssl / none)','text','2026-10-19 10:29:02'),(31,'smtp_from_email','info@solaraccompany.com','smtp','System Sender Email','text','2026-10-19 11:35:20'),(32,'smtp_from_name','SOLARAC Company LTD','smtp','Sender Display Name','text','2026-10-19 11:35:20'),(33,'smtp_enabled','0','smtp','Enable Live SMTP Sending','boolean','2026-10-19 10:29:02'),(34,'analytics_ga_id','','analytics','Google Analytics Measurement ID (G-XXXXXXXX)','text','2026-10-19 10:29:02'),(35,'analytics_gtm_id','','analytics','Google Tag Manager Container ID','text','2026-10-19 10:29:02'),(36,'analytics_gsc_tag','','analytics','Google Search Console Verification Tag','text','2026-10-19 10:29:02'),(37,'hero_headline','Building the Future with Integrity, Innovation & Engineering Excellence','homepage','Hero Main Headline','textarea','2026-10-19 11:35:20'),(38,'hero_subheadline','SOLARAC Company LTD (RC: 1175907) is a premier Nigerian civil and building construction firm delivering expertise in Project Management, Structural Design, General Facilities Management, and Turnkey EPC Contracting.','homepage','Hero Sub-headline','textarea','2026-10-19 11:35:20'),(39,'hero_cta_primary_text','REQUEST A QUOTE','homepage','Hero Primary Button Text','text','2026-10-19 10:29:02'),(40,'hero_cta_primary_link','quote.php','homepage','Hero Primary Button Link','text','2026-10-19 10:29:02'),(41,'hero_cta_secondary_text','EXPLORE OUR SERVICES','homepage','Hero Secondary Button Text','text','2026-10-19 10:29:02'),(42,'hero_cta_secondary_link','services.php','homepage','Hero Secondary Button Link','text','2026-10-19 10:29:02'),(43,'section_hero_enabled','1','homepage','Enable Hero Section','boolean','2026-10-19 10:29:02'),(44,'section_services_enabled','1','homepage','Enable Services Section','boolean','2026-10-19 10:29:02'),(45,'section_why_choose_enabled','1','homepage','Enable Why Choose Us Section','boolean','2026-10-19 10:29:02'),(46,'section_products_enabled','0','homepage','Enable Featured Products Section','boolean','2026-10-19 11:35:20'),(47,'section_projects_enabled','1','homepage','Enable Featured Projects Section','boolean','2026-10-19 10:29:02'),(48,'section_quote_cta_enabled','1','homepage','Enable Fast Quote Banner','boolean','2026-10-19 10:29:02'),(49,'section_testimonials_enabled','1','homepage','Enable Client Testimonials Section','boolean','2026-10-19 10:29:02'),(50,'about_overview','SOLARAC Company Limited (RC: 1175907) is an indigenous Limited Liability Company incorporated to deliver exceptional expertise in Project Management, Civil Engineering and Construction, General Facilities Management, and General Contract Services. Headquartered in Osogbo, Osun State, we have built a reputation for delivering high-impact projects that meet the most stringent international standards.','about','Corporate Overview','textarea','2026-10-19 11:35:20'),(51,'about_mission','To provide dependable multi-sector supply chain and general contracting solutions across Nigeria through uncompromising integrity, technical competence, and customer-first execution.','about','Mission Statement','textarea','2026-10-19 10:29:02'),(52,'about_vision','To stand as Nigeria\'s most trusted multi-sector supply partner and contractor of choice for energy, construction, healthcare, and agro-allied enterprises.','about','Vision Statement','textarea','2026-10-19 10:29:02'),(53,'about_core_values','Reliability, Professional Integrity, Quality Assurance, Procurement Transparency, Timely Delivery, Safety First','about','Core Values','textarea','2026-10-19 10:29:02'),(54,'about_company_history','[ADD COMPANY HISTORY - Awaiting corporate profile document]','about','Company History Placeholder','textarea','2026-10-19 10:29:02'),(55,'about_management_message','[ADD MANAGEMENT MESSAGE - Awaiting executive address]','about','Management Message Placeholder','textarea','2026-10-19 10:29:02'),(199,'mission','At SOLARAC, our mission is to build the Future with Integrity, Innovation and Excellence. We are dedicated to delivering High-Quality Construction Solutions that not only meet but exceed our Clients\' expectations by fostering a culture of safety, sustainability, and collaboration to create long-lasting structures that enhance the communities we serve.','general','Mission','text','2026-10-19 11:35:20'),(200,'vision','Our vision is to be a Trusted Leader in the Construction and Real Estate Industry, delivering Exceptional Quality, Innovative Solutions, and Lasting Values for our Clients and Communities across Nigeria and beyond.','general','Vision','text','2026-10-19 11:35:20'),(201,'why_choose_us','Proven engineering track record, COREN/NSE certified personnel, state-of-the-art construction equipment, uncompromising safety compliance, and on-time project completion within budget.','general','Why Choose Us','text','2026-10-19 11:35:20');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_links`
--

DROP TABLE IF EXISTS `social_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `platform` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_links`
--

LOCK TABLES `social_links` WRITE;
/*!40000 ALTER TABLE `social_links` DISABLE KEYS */;
INSERT INTO `social_links` VALUES (1,'LinkedIn','#','linkedin',1,1),(2,'Facebook','#','facebook',1,2),(3,'Twitter','#','twitter',1,3),(4,'Instagram','#','instagram',1,4),(5,'YouTube','#','youtube',0,5);
/*!40000 ALTER TABLE `social_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '[ADD TEAM MEMBER NAME]',
  `position` varchar(100) NOT NULL DEFAULT '[ADD POSITION / TITLE]',
  `bio` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` VALUES (11,'Engr. Bashiru Abiola Saliu','Managing Partner & Seasoned Civil Engineer (MNSE, FNICE)','Engr. Bashiru Abiola Saliu MNSE, FNICE brings nearly 20 years of sterling experience in civil engineering, structural design, project management, financial management, and human resource leadership. He has spearheaded road, bridge, telecom mast, hydraulic, and building projects across Nigeria. Advanced HSE and EIA Certified.','assets/images/certificates/unnamed (2).png',1,'active','2026-10-19 12:00:03'),(12,'Engr. Odebunmi Babawale','Managing Director (B.Tech Structural Eng, M.Eng Construction Mgt)','Engr. Babawale oversees corporate strategy, technical leadership, and engineering innovation. He directs technical teams on structural analysis, Eurocode compliance, and high-impact infrastructure delivery.','assets/images/certificates/page24_img2.png',2,'active','2026-10-19 12:00:03'),(13,'Engr. Salam B.H','Senior Project Manager (B.Tech Civil Eng, PMP)','Engr. Salam coordinates complex civil construction operations from planning to client handover. His rigorous project governance and quality control ensure timely delivery and client satisfaction.','assets/images/certificates/page25_img2.png',3,'active','2026-10-19 12:00:03'),(14,'Engr. Ogunsadekoya Samuel','Project Lead & Safety Officer (B.Tech Civil Eng, Certified Safety)','Engr. Samuel oversees on-site civil operations, technical supervision, and strict adherence to occupational safety protocols, ensuring zero-incident project execution across all job sites.','assets/images/certificates/page26_img2.png',4,'active','2026-10-19 12:00:03'),(15,'Ajibade Taofeek Oladayo','Certified Painting & Decorating Specialist (Fed Ministry of Labour)','Ajibade is a skilled painting and protective coating specialist with meticulous attention to detail, delivering durable, elegant surface finishes for commercial, institutional, and luxury residential projects.','assets/images/certificates/TAOFEEK-CERT.png',5,'active','2026-10-19 12:00:03'),(16,'Afolabi Titilope Busayo','Certified Carpenter & Joiner Specialist (Fed Ministry of Labour & FSTC Yaba)','Afolabi is a certified carpentry and joinery craftswoman with extensive technical expertise in structural timber formwork, precision architectural joinery, reinforced concrete shuttering, and bespoke roof truss systems for civil engineering and modern building projects.','assets/images/certificates/AFOLABI-LABOUR-CERT.png',6,'active','2026-10-21 11:37:00');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL DEFAULT '[ADD CLIENT NAME]',
  `organization` varchar(150) NOT NULL DEFAULT '[ADD ORGANIZATION NAME]',
  `content` text NOT NULL,
  `rating` tinyint(3) unsigned NOT NULL DEFAULT 5,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (7,'Alhaji K. Adediran','Ataoja Model School Development Board, Osogbo','SOLARAC Company LTD demonstrated unmatched engineering precision during the construction of Ataoja Model School of Science. Their attention to structural integrity, timely milestone delivery, and quality materials made them our best construction partner to date.',5,'',1,'2026-10-19 12:00:03'),(8,'Engr. D. Ogunleye','Livingspring Free Trade Zone Authority','The 300m reinforced concrete fence delivered by SOLARAC at the Free Trade Zone stands as proof of superior craftsmanship. Their fair-faced concrete finishing and adherence to strict project timelines exceeded our expectations.',5,'',2,'2026-10-19 12:00:03'),(9,'Chief M. O. Jokodolu','Chairman, Board of Trustees, Jokodolu Foundation','The vocational training complex and administrative buildings constructed by SOLARAC in Ogbomoso are truly state-of-the-art. Their leadership team was accessible, professional, and transparent from day one.',5,'',3,'2026-10-19 12:00:03');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_ur_role` (`role_id`),
  CONSTRAINT `fk_ur_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ur_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,1);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role_id` int(10) unsigned NOT NULL DEFAULT 4,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `avatar` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_users_role` (`role_id`),
  KEY `idx_users_status` (`status`),
  CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@solaraccompany.com','$2y$10$teTpwuNLl4hG1swqD3ELLeyuKOmCOFNiY/B04io53nIJEUyVhzSAa','SOLARAC Administrator',1,'active',NULL,'2026-10-19 13:10:42','2026-10-19 10:29:02','2026-10-19 13:10:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-19 13:55:26
