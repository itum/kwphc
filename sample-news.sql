-- فایل تست SQL برای سیستم import اخبار
-- این فایل باید با سیستم جدید کار کند

-- ایجاد جدول اخبار (اختیاری)
CREATE TABLE IF NOT EXISTS `kw_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT 0,
  `sender_id` varchar(50) DEFAULT '',
  `subject` varchar(255) NOT NULL,
  `summary` text,
  `content` longtext,
  `image_url` varchar(255) DEFAULT '',
  `hits` int(11) DEFAULT 0,
  `news_date` varchar(20) DEFAULT '',
  `news_time` varchar(20) DEFAULT '',
  `year` int(4) DEFAULT 0,
  `month` varchar(20) DEFAULT '',
  `num_month` int(2) DEFAULT 0,
  `day` int(2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- درج نمونه اخبار
INSERT INTO `kw_news` VALUES 
(1, 1, 'admin', 'خبر تست شماره یک', 'این خلاصه خبر تست اول است', 'محتوای کامل خبر تست اول که شامل جزئیات بیشتری می‌باشد. این خبر برای تست سیستم import نوشته شده است.', '', 15, '1403/04/15', '10:30', 1403, 'فروردین', 4, 15),
(2, 1, 'admin', 'اطلاعیه مهم دانشگاه', 'اطلاعیه در مورد برنامه‌های جدید', 'این اطلاعیه شامل اطلاعات مهمی در مورد برنامه‌های آموزشی جدید دانشگاه می‌باشد. دانشجویان عزیز می‌توانند جهت کسب اطلاعات بیشتر به دفتر آموزش مراجعه کنند.', '', 42, '1403/04/16', '14:00', 1403, 'فروردین', 4, 16),
(3, 1, 'system', 'نتایج امتحانات اعلام شد', 'نتایج امتحانات نیمسال اول', 'نتایج امتحانات نیمسال اول سال تحصیلی 1403-1402 در سامانه آموزش قرار گرفته است. دانشجویان می‌توانند با مراجعه به سامانه، نمرات خود را مشاهده کنند.', '', 89, '1403/04/20', '16:45', 1403, 'فروردین', 4, 20);

-- ایجاد جدول کامنت‌ها (اختیاری)
CREATE TABLE IF NOT EXISTS `kw_news_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `comment_date` varchar(20) DEFAULT '',
  `comment_time` varchar(20) DEFAULT '',
  `email` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- درج نمونه کامنت‌ها
INSERT INTO `kw_news_comments` VALUES 
(1, 1, 'احمد رضایی', 'خبر بسیار مفیدی بود، ممنون', 1, '1403/04/15', '11:00', 'ahmad@example.com'),
(2, 1, 'فاطمه محمدی', 'لطفاً اطلاعات بیشتری ارائه دهید', 1, '1403/04/15', '12:30', 'fateme@example.com'),
(3, 2, 'علی احمدی', 'چه زمانی این برنامه‌ها اجرا می‌شود؟', 1, '1403/04/16', '15:20', 'ali@example.com'),
(4, 2, 'مریم حسینی', 'آیا برای دانشجویان کارشناسی ارشد هم هست؟', 0, '1403/04/16', '16:10', 'maryam@example.com'),
(5, 3, 'محمد کریمی', 'متشکرم از اطلاع‌رسانی سریع', 1, '1403/04/20', '17:00', 'mohammad@example.com'); 