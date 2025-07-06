-- =============================================
-- MySQL/WordPress Compatible Database Script
-- Table: kw_news (converted from SQL Server Kw_News)
-- Complete News Data with Full Content (Summary + Content + Images)
-- =============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table kw_news
--

DROP TABLE IF EXISTS kw_news;
CREATE TABLE kw_news (
  id int(11) NOT NULL AUTO_INCREMENT,
  group_id int(11) NOT NULL DEFAULT 1,
  sender_id varchar(36) NOT NULL,
  subject varchar(500) NOT NULL,
  summary text NOT NULL,
  content longtext NOT NULL,
  image_url varchar(256) DEFAULT NULL,
  hits int(11) NOT NULL DEFAULT 0,
  news_date varchar(50) NOT NULL,
  news_time varchar(50) NOT NULL,
  year int(11) NOT NULL,
  month varchar(50) NOT NULL,
  num_month int(11) NOT NULL,
  day int(11) NOT NULL,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status varchar(20) NOT NULL DEFAULT 'published',
  PRIMARY KEY (id),
  KEY idx_group (group_id),
  KEY idx_date (news_date),
  KEY idx_year_month (year, num_month),
  KEY idx_hits (hits),
  KEY idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table kw_news with full content
--

ALTER TABLE kw_news AUTO_INCREMENT = 1;

INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (49191, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'تودیع و معارفه سرپرست مجتمع', '<p dir="RTL">
	مراسم تکریم و معارفه سرپرست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد.</p>
', '<p dir="RTL" style="text-align: justify;">
	&nbsp;به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان: مراسم تکریم و معارفه رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور مدیر و رئیس دفتر بازرسی مجامع سازمان آب و برق خوزستان و همچنین جمعی از معاونین مدیران و پرسنل مجتمع آموزشی برگزار شد.</p>
<p dir="RTL" style="text-align: justify;">
	طی این مراسم مهندس محسن انصاری به عنوان سرپرست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان منصوب و از زحمات&nbsp; دکتر نرگس ظهرابی تقدیر به عمل آمد.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;مهندس رئیسی مدیر دفتر بازرسی و مجامع سازمان آب و برق خوزستان در این مراسم ضمن قدردانی از تلاش های دلسوزانه دکتر نرگس ظهرابی طی دو سال تصدی ریاست مجتمع گفت:</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;به حمدالله ظرفیت بسیار خوبی در زمینه آموزش و پژوهش در مجتمع آموزشی خوزستان به وجود آمده که این را مدیون تلاش های دکتر ظهرابی و مجموعه همکاران این مجتمع هستیم.</p>
<p dir="RTL" style="text-align: justify;">
	جایگاه مناسبی را در سطح آموزش وزارت نیرو در استان و حتی در کشور احراز کرده ایم، مهندس رئیسی در ادامه به روشن بودن مسیر و اهداف پیش رو اشاره کرد و افزود:</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;بر اساس ریل گذاری های صورت گرفته و همچنین حمایت مجموعه دفتر مدیریت بازرسی و مجامع، تلاش، پشتکار و البته انگیزه&zwnj;ای دوچندان می طلبد تا به امید خدا بتوانیم قطب آموزشی - پژوهشی صنعت آب و برق استان و سپس کشور باشیم.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;دکتر نرگس ظهرابی رئیس سابق مجتمع آموزشی نیز ضمن قدردانی از زحمات و مجدانه پرسنل گفت:</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;طی این مدت دو سال&nbsp; که در مجتمع آموزشی توفیق خدمت داشتم به لطف خدا و همت همکاران توانستیم به دستاوردهای ارزشمندی در زمینه های آموزشی و پژوهشی دست یابیم.</p>
<p dir="RTL" style="text-align: justify;">
	دکتر ظهرابی به نمودار رو به رشد عملکرد دو ساله اشاره کرد و افزود:</p>
<p dir="RTL" style="text-align: justify;">
	این مهم را مدیون همت بلند و دلسوزانه شما همکاران هستم. دکتر ظهرابی در پایان برای ریاست جدید مجتمع آموزشی و دیگر همکاران&nbsp; آرزوی توفیق کرد. وی در ادامه این نکته را مهم برشمرد که ادامه همین مسیر رو به رشد مرهون همدلی و پشتکار و البته تمرکز به متن و فاصله گرفتن از هر گونه حاشیه احتمالی است.</p>
<p dir="RTL" style="text-align: justify;">
	مهندس محسن انصاری سرپرست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان ضمن&nbsp; تبریک ایام الله دهه مبارک فجر و چهل و سومین سال پیروزی شکوهمند انقلاب اسلامی و تبریک و تهنیت به مناسبت ۱۳ رجب، میلاد امام اول شیعیان حضرت علي(ع) و روز پدر، از&nbsp; زحمات دکتر ظهرابی قدردانی کرد و افزود:</p>
<p dir="RTL" style="text-align: justify;">
	جا دارد قبل از هر چيز تشکري داشته باشم از حسن اعتمادي که به اين حقير شده است، خصوصاً از مديريت مجموعه محترم سازمان آب و برق خوزستان، دکتر ایزد جو، دکتر خدابخشی، مهندس رئیسی و مهندس عچرش، همچنین رياست محترم آموزشهای تخصصی و صالحيت حرفه اي صنعت آب و برق جناب آقاي دکتر فدائي تهرانی و معاون محترم تحقیقات و منابع انسانی وزیر نیرو و رياست محترم هيات امنا جناب آقاي دکتر انجم شعاع که با ابلاغ اين حکم، توفيق خدمتگزاري به نظام مقدس جمهوري اسلامي در اين مجتمع را براي بنده فراهم نمودند. ضمنا جا دارد از حضور همه همکاران عزيز و سروران ارجمندي که زحمت کشيدند و در اين جلسه حضور بهم رساندند، صميمانه سپاسگزاری کنم.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;سرپرست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در رابطه با زحمات و خدمات دکتر ظهرابی عنوان کرد:</p>
<p dir="RTL" style="text-align: justify;">
	زمان تصدی ایشان به واقع نقطه عطفی در تمام دوران مجتمع آموزشی است.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;ایشان با اشاره به تهیه سند راهبردی پنج ساله که اخیراً تدوین شده، افزود در این سند مسیر مشخص، اهداف و برنامه ها و راهکارها نیز تعیین شده است هم اکنون نیاز به همت مجدانه و تلاش دلسوزانه مجموعه معاونین مدیران و همکاران مجتمع داریم.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;مهندس انصاری عنوان داشت:</p>
<p dir="RTL" style="text-align: justify;">
	جهت رسیدن به این مهم نکاتی را برای خودم اصل می دانم که عبارتند از:</p>
<p dir="RTL" style="text-align: justify;">
	- در انجام امور معتقد به علم محوری، برنامه محوری، کارشناس محوری، اخلاق محوری و انضباط محوری هستم.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;- تمرکز مطلق بر انجام صرف وظیفه کاری و دوری از مسائل حاشیه&zwnj;ای و سیاسی کاری</p>
<p dir="RTL" style="text-align: justify;">
	- داشتن، تعامل سازنده با شرکت ها و البته&nbsp; اصل مشورت در تمام امور را مد نظر خواهم داشت.</p>
<p dir="RTL" style="text-align: justify;">
	- مخالف حذف یا نادیده گرفتن تصمیمات، سیاستها و اقدامات خوب گذشته خواهم بود و معیشت کارکنان از جمله مسائل حائز اهمیت برای اینجانب هستند.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;مهندس انصاری گفت:</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;طی ۲۰ سال سابقه خدمت در این مجتمع با چالش های بسیاری مواجه بوده ایم اما به لطف خدا علیرغم هرگونه فراز و فرود توانستیم از آنها عبور کنیم.</p>
<p dir="RTL" style="text-align: justify;">
	مهندس انصاری در خصوص عملکرد دو سال اخیر اینگونه عنوان کرد:</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;درصد رشد عملکرد آموزشی در سال ۹۹ نسبت به ۹۸،&nbsp; در حدود ۶۱ درصد و از در ۹ ماهه ۱۴۰۰ نسبت به ۹ ماهه ۹۹، حدود ۴۰ درصد بوده است.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp; امیدوارم با همت و همراهی همه همکاران بتوانیم این وضعیت رو به رشد رو تحکیم ببخشیم و علاوه بر آن نیز شاهد رشد عملکرد بهتر و رضایتمندی بیشتر شرکتهای طرف قرارداد و هیات امنای محترم باشیم .</p>
<p style="text-align: justify;">
	<span dir="RTL">&nbsp;در پایان جلسه مهندس عچرش رئیس دفتر بازرسی و مجامع سازمان آب و برق خوزستان ضمن قدردانی از دکتر نرگس ظهرابی و اهدای لوح تقدیر به ایشان، حکم انتصاب محسن انصاری را به وی اعطا کرد.</span></p>
', '49191mansaris.jpg', 2521, '1400/11/26', '4:34:35 PM', 1400, 'بهمن', 11, '26');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (50184, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری دوره آموزشی شناخت صلاحیت حرفه ای', '<p dir="RTL" style="text-align: justify;">
	دوره آموزشی &quot;شناخت صلاحیت حرفه ای&quot; به میزبانی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	دوره آموزشی &quot;شناخت صلاحیت حرفه ای نیروی انسانی و چشم انداز آن در صنعت آب و برق&quot; به میزبانی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در روز یکشنبه مورخ 18 اردیبهشت 1401 در محل سالن همایش بوستان شهرستان اهواز برگزار شد.</p>
<p dir="RTL" style="text-align: justify;">
	در ابتدای جلسه که با حضور نمایندگانی از کلیه شرکت های صنعت آب و برق استان خوزستان و برخی شرکت های آب و برق سایر استان ها از قبیل شرکت مادرتخصصی مهندسی آب و فاضلاب کشور، شرکت های توزیع نیروی برق استان های خراسان رضوی، بوشهر، یزد و لرستان و همچنین شرکت های آب منطقه ای فارس و همدان به صورت حضوری و مجازی برخط و همزمان برگزار گردید، مهندس محسن انصاری سرپرست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان ضمن خیر مقدم به مدعوین، ابراز خرسندی کرد و افزود: برگزاری دوره آموزشی به صورت حضوری را پس از دو سال محدودیت بیماری کرونا به فال نیک می&zwnj;گیریم و فرصت دیدار همکاران را غنیمت می&zwnj;شماریم. مهندس انصاری ضمن تشکر و قدردانی از زحمات و همکاری آقای دکتر مهدی مقسمی رئیس گروه آموزش سازمان آب و برق خوزستان در برگزاری این دوره اذعان داشت: در دوران بیماری کرونا ضرورت ایجاد و به روزرسانی بستر آموزش های مجازی بیش از پیش احساس شد که به لطف خدا و با تلاش شبانه&zwnj;روزی و مجدانه پرسنل مجتمع خوزستان توانستیم به استانداردهای مورد نظر در این حوزه دست یابیم. در ادامه ایشان افزود با عنایت به صدور بخشنامه ابلاغی معاونت محترم تحقیقات و منابع انسانی وزارت نیرو در خصوص آموزش و صلاحیت حرفه ای نیروی انسانی شرکت های پیمانکار صنعت آب و برق بر آن شدیم که تکلیف یاد شده را به عنوان اولین مرکز در کشور برگزار نماییم.</p>
<p dir="RTL" style="text-align: justify;">
	سپس دکتر محمدرضا فدائی تهرانی رییس مرکز آموزش های تخصصی و صلاحیت حرفه&zwnj;ای صنعت آب و برق با اشاره به اهمیت اجرای این طرح گفت: رویکردی که از سنوات گذشته مورد تحقیق و بررسی قرار گرفته از ابتدای سال جاری وارد مرحله اجرا شده است. ایشان افزود نیروهای شاغل در وزارت نیرو می بایست استانداردهای حرفه&zwnj;های مورد نظر در تصدی هر شغل را جهت توانمندسازی در حوزه کاری خود احراز کرده و گواهینامه مورد تایید وزارتخانه را کسب نمایند. وی در ادامه از لزوم اجرای این طرح سخن گفت و اضافه کرد: مرکز صلاحیت حرفه&zwnj;ای در نظر دارد تا نیروهای پیمانکاری به کارگیری شده در امور فنی در گام نخست آموزش دیده و سپس توسط افراد و کمیته های مجرب در خصوص تشخیص صلاحیت حرفه&zwnj;ای پایش و پس از آن به کارگیری شوند. ایشان ضمن تاکید بر این نکته که هدف حذف هیچکدام از نیروهای پیمانکاری موجود نیست، افزود: غایت و انگیزه اجرای این طرح صرفاً ارتقاء سطح کیفی و شغلی کارکنان است.</p>
<p dir="RTL" style="text-align: justify;">
	دکتر عماد ملکی نیا معاون مرکز آموزش های تخصصی و صلاحیت حرفه ای صنعت آب و برق که به عنوان مدرس دوره نیز دعوت شده بودند، ضمن تشکر از میزبانی و رضایتمندی از نحوه برگزاری گفت: موضوع آموزش از موارد بسیار حائز اهمیت در وزارت نیرو است که در نهایت منتج به توانمندسازی نیروی انسانی می گردد. وی در ادامه به موضوعاتی حول محور شناخت صلاحیت حرفه ای نیروی انسانی و استانداردهای تعریف شده در قالب بخشنامه های وزارت نیرو پرداخت.</p>
<p dir="RTL" style="text-align: justify;">
	پس از برگزاری دوره آموزشی جلسه پرسش و پاسخ جهت تبیین و شفاف سازی موضوع&nbsp; و رفع ابهام های احتمالی برگزار گردید.</p>
<p>
	&nbsp;</p>
<table border="0" cellpadding="1" cellspacing="1" style="width: 910px">
	<tbody>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_1.jpeg" /></td>
			<td style="text-align: center; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_2.jpeg" /></td>
			<td style="text-align: center; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_3.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_4.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_5.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_6.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_7.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_8.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_9.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_10.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_11.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_12.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_13.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_14.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_15.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_16.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '49192Sm.jpg', 670, '1401/2/20', '11:49:58 AM', 1401, 'اردیبهشت', 2, '20');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (50185, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'پذیرش دانشجو بدون کنکور', '<p dir="RTL" style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برای مهر ماه سال 1401 بدون کنکور دانشجو می پذیرد.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، مهر ماه سال 1401 با 36ظرفیت&nbsp; رشته تحصیلی در <strong>مقاطع کاردانی و کارشناسی،</strong> <strong>بدون کنکور</strong> دانشجو می پذیرد. علاقمندان می توانند جهت کسب اطلاعات بیشتر با شماره های 06133340070 و 09378535157 تماس حاصل نموده یا به آدرس : اهواز &ndash; بلوار گلستان &ndash; بین خیابان کاشان و همدان &ndash; رو به روی هتل نیشکر مراجعه نمایند.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_17.jpeg" /></p>
', '50185sabtname.jpg', 1107, '1401/3/29', '3:07:55 PM', 1401, 'خرداد', 3, '29');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (51185, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'آزمون استخدامی', '<p>
	<strong><span dir="RTL">شرکت ( به خدمات وفا منطقه دشت آزادگان ) به منظور تأمين نيروي انساني، اقدام به جذب نیرو می نماید</span></strong></p>
', '<p dir="RTL">
	<strong>به اطلاع ميرساند شرکت پیمانکاری بهره برداری (( به خدمات وفا منطقه دشت آزادگان )) به منظور تأمين نيروي انساني مورد نياز، تعداد 7 نفر از آقايان واجد شرايط را از طريق آزمون توانمنديهاي تخصصي(كتبي) و آزمون دانش مهارت (مصاحبه) به ترتیب از بالاترین نمره با شرايط ذيل و در قالب قرار داد نیروی حجمی جذب می نماید.</strong></p>
<p dir="RTL">
	<strong>در صورت بروز هرگونه مشكل و ابهام با شماره تلفن 33347248-061 مجتمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به عنوان مجري آزمون در وقت اداري تماس حاصل نمایید</strong><strong><span dir="LTR">.</span></strong></p>
<p dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<a href="https://kwphc.ir/Archive/Other/DaftarCheh.pdf" target="_blank"><span style="font-size:16px;"><strong>دریافت دفترچه آزمون</strong></span></a></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<a href="https://estekhdam.kwphc.ir/azmoon140105" target="_blank"><span style="font-size:18px;"><strong>لینک ثبت نام</strong></span></a></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_18.jpeg" /></p>
', '50186Estekhdam.jpg', 24554, '1401/5/21', '10:14:12 AM', 1401, 'مرداد', 5, '21');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (51186, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'بازگشایی ثبت نام و پذیرش دانشجو جهت مهرماه ۱۴۰۱', '<p>
	<span dir="RTL">مرکز علمی کاربردی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، مهر ماه سال </span><span dir="RTL">۱۴۰۱</span> <span dir="RTL">در </span><span dir="RTL">۳۶</span> <span dir="RTL">عنوان رشته تحصیلی دانشجو می پذیرد.</span></p>
', '<p dir="RTL" style="text-align: justify;">
	مرکز علمی کاربردی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، مهر ماه سال ۱۴۰۱ در ۳۶ عنوان رشته تحصیلی در مقاطع کاردانی (۲۱ رشته) و کارشناسی ناپیوسته (۱۵ رشته)، از تاریخ ۱ لغایت ۴ شهریور بدون کنکور دانشجو می پذیرد.</p>
<p dir="RTL" style="text-align: justify;">
	علاقمندان می توانند جهت کسب اطلاعات بیشتر با شماره های 06133340070 و 09378535157 تماس حاصل نموده یا به آدرس : اهواز &ndash; بلوار گلستان &ndash; بین خیابان کاشان و همدان &ndash; روبروی هتل نیشکر مراجعه نمایند.</p>
<p dir="RTL" style="text-align: justify;">
	جهت ثبت نام می توانید از طریق سامانه سازمان سنجش آموزش کشور يا بصورت حضوري اقدام گردد.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://www.sanjesh.org/group.aspx?gid=5" target="_blank"><span style="font-size:16px;">لینک ثبت نام با استفاده از سامانه</span></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<span style="font-size:16px;"><span style="color:#ff66ff;"><strong>دریافت </strong></span><a href="https://www.uast.ac.ir/file/download/page/1660452628-note-jamekardani-v1.pdf"><span style="color:#ff66ff;"><strong>دفترچه راهنمای دوره کاردانی فنی و دوره کاردانی حرفه ای ناپیوسته نظام آموزش مهارتی مهرماه سال 1401</strong></span></a></span></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<span style="font-size:16px;"><span style="color:#2980b9;"><strong><span style="font-size:16px;"><strong><span style="color:#16a085;"><span style="font-size:16px;">دریافت </span></span><a href="https://www.uast.ac.ir/file/download/page/1660452970-notekarshenasi-jame-v1-1401.pdf"><span style="color:#16a085;"><span style="font-size:16px;">دفترچه راهنمای دوره مهندسی فناوری و دوره کارشناسی حرفه ای ناپیوسته نظام آموزش مهارتی مهرماه سال 1401</span></span></a></strong></span></strong></span></span></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_19.jpeg" /></p>
<p>
	&nbsp;</p>
', '51186TamdidPic.jpg', 1234, '1401/5/30', '3:57:28 PM', 1401, 'مرداد', 5, '30');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (51187, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'آگهي جذب نيروی کار در قالب قرارداد نیروی حجمی', '<p dir="RTL">
	شرکت پیمانکاری تلاشگران آروین آپادانا به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	به اطلاع ميرساند شرکت پیمانکاری تلاشگران آروین آپادانا از شرکتهای طرف قرارداد شرکت توزیع نیروی برق استان کهگیلویه و بویراحمد به منظور تأمين نيروي انساني مورد نياز، تعداد 16 نفر (تعداد 7 نفر به عنوان مامور قرائت کنتور و 9 نفر به عنوان راننده پایه یکم) از آقايان واجد شرايط را از طريق آزمون توانمنديهاي عمومی و تخصصي(كتبي) و آزمون دانش مهارت (مصاحبه) و طی فرآیند گزینش و به ترتیب از بالاترین نمره با شرايط ذيل و در قالب قرارداد نیروی حجمی جذب می نماید</p>
<p dir="RTL" style="text-align: justify;">
	در صورت بروز هرگونه مشكل و ابهام با شماره تلفن 33347248-061 مجتمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به عنوان مجري آزمون در وقت اداري تماس حاصل نمایید.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://estekhdam.kwphc.ir/azmoon140106/" target="_blank"><span style="font-size:20px;"><span style="color:#000080;"><strong>لینک ثبت نام</strong></span></span></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_20.jpeg" /></p>
<p>
	&nbsp;</p>
', '51187NP.jpg', 1855, '1401/5/30', '4:49:24 PM', 1401, 'مرداد', 5, '30');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (51188, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'اطلاعیه مهم آزمون استخدامی', '<p>
	<span dir="RTL">قابل توجه داوطلبان رشته برق (کاردانی و کارشناسی) آزمون جذب نیروی حجمی <span dir="RTL">شرکت به خدمات وفا منطقه دشت آزادگان</span> مورخ</span> <span dir="RTL">10 شهریور 1401</span></p>
', '<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<strong>قابل توجه داوطلبان رشته برق (کاردانی و کارشناسی) آزمون جذب نیروی حجمی مورخ 10 شهریور 1401</strong></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL">
	به اطلاع می رساند نظر به درخواست های مکرر متقاضیان جدید جهت ثبت نام و شرکت در این آزمون و محدودیت هایی در این خصوص، شرایط ثبت نام در آزمون به شرح ذیل اصلاح گردید:</p>
<p dir="RTL">
	۱) افزایش حداکثر سن شرکت کنندگان</p>
<p dir="RTL">
	۲) لغو معافیت پزشکی</p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL">
	جهت اطلاعات بیشتر آگهی آزمون مجددا دریافت و مطالعه گردد.</p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL">
	&nbsp;لذا مهلت ثبت نام و همچنین ویرایش اطلاعات تا <strong>ساعت 20 چهارشنبه مورخ 9 شهریور 1401</strong> تمدید گردید.</p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir/Archive/Other/DaftarCheh.pdf" target="_blank"><span style="font-size:16px;">دریافت دفترچه آزمون</span></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://estekhdam.kwphc.ir/azmoon140105" target="_blank"><span style="font-size:16px;">لینک ثبت نام</span></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_21.jpeg" /></p>
<p>
	&nbsp;</p>
', '51188ImpAdv.jpg', 1008, '1401/6/8', '3:14:26 PM', 1401, 'شهریور', 6, '8');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (51189, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'اعلام نتایج آزمون', '<p dir="RTL">
	اعلام نتایج آزمون کتبي جذب نيروي حجمي مورخ 10 شهریور شرکت به خدمات وفا منطقه دشت آزادگان</p>
<p>
	&nbsp;</p>
', '<p dir="RTL">
	داوطلبین محترم آزمون کتبي جذب نيروي حجمي مورخ 10 شهریور شرکت به خدمات وفا منطقه دشت آزادگان می توانند جهت اطلاع از نتایج آزمون از لینک ذیل مراجعه نمایند.</p>
<p dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<strong><a href="https://estekhdam.kwphc.ir/azmoon140105" target="_blank"><span style="color:#a52a2a;"><span style="font-size:18px;">اعلام نتایج آزمون</span></span></a></strong></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<strong><a href="https://kwphc.ir/Archive/Other/Result610.pdf" target="_blank"><span style="color:#008000;"><span style="font-size:16px;">دریافت اطلاعیه</span></span></a></strong></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<img alt="" src="wp-content/uploads/news-images/image_22.jpeg" /></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p>
	&nbsp;</p>
', '51189PicResult.jpg', 2591, '1401/6/17', '4:35:25 PM', 1401, 'شهریور', 6, '17');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (51190, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'تمدید زمان ثبت نام', '<p dir="RTL">
	قابل توجه داوطلبان آزمون جذب نیروی حجمی شرکت پیمانکاری تلاشگران آروین آپادانا مورخ 31 شهریور 1401</p>
<p>
	&nbsp;</p>
', '<p dir="RTL">
	به اطلاع می رساند نظر به درخواست های مکرر متقاضیان جدید جهت ثبت نام و شرکت در این آزمون&nbsp; مهلت ثبت نام و ویرایش تا روز شنبه مورخ 26 شهریورماه تمدید گردید.</p>
<p dir="RTL">
	لازم به ذکر است پذیرفته شدگان ۳ برابر ظرفیت رشته شغلی رانندگان پایه یکم علاوه بر شرایط ذکر شده در آگهی آزمون، دارا بودن گواهینامه کار با جرثقیل و یا بالابر، از امتیاز ویژه ای در آزمون دانش مهارت (مصاحبه) برخوردار خواهند شد.</p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://estekhdam.kwphc.ir/azmoon140106" target="_blank"><strong><span style="color:#a52a2a;"><span style="font-size:18px;">لینک ثبت نام</span></span></strong></a></p>
<p style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_23.jpeg" /></p>
', '51190PicTamdid.jpg', 2351, '1401/6/17', '5:00:48 PM', 1401, 'شهریور', 6, '17');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (52189, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'آگهي استخدام', '<p>
	شرکت شرکت نصب و تعمیرات نیروگاه های خوزستان به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید.</p>
', '<p dir="RTL" style="margin-right: 0.2pt; text-align: justify;">
	به اطلاع ميرساند شرکت نصب و تعمیرات نیروگاه های خوزستان ازشرکت&shy;های طرف قرارداد شرکت سهامی برق منطقه&shy;ای خوزستان به منظور تأمين نيروي انساني مورد نياز، تعداد <strong><u>53</u></strong> نفر <strong>از آقايان </strong>واجد شرايط را از طريق آزمون توانمندي&shy;هاي عمومی و تخصصي(كتبي) و آزمون دانش مهارت (&shy;مصاحبه) و طی فرآیند گزینش و به ترتیب از بالاترین نمره با شرايط ذيل و در قالب قرارداد نیروی حجمی جذب مي&shy; نمايد.</p>
<p dir="RTL" style="text-align: justify;">
	در صورت بروز هرگونه مشكل و ابهام با شماره تلفن 33347248-061 مجتمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به عنوان مجري آزمون در وقت اداري تماس حاصل نمایید.</p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir/archive/other/help40108.pdf" target="_blank"><strong><span style="color:#008000;"><span style="font-family:tahoma,geneva,sans-serif;"><span style="font-size:18px;">دریافت فایل راهنما</span></span></span></strong></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="http://estekhdam.kwphc.ir/azmoon140108/" target="_blank"><span style="color:#800080;"><strong><span style="font-family:tahoma,geneva,sans-serif;"><span style="font-size:18px;">لینک ثبت نام</span></span></strong></span></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<span style="color:#800080;"><strong><span style="font-family:tahoma,geneva,sans-serif;"><span style="font-size:18px;"><img alt="" src="wp-content/uploads/news-images/image_24.jpeg" /></span></span></strong></span></p>
<p>
	&nbsp;</p>
', '51191EstNrg.jpg', 7830, '1401/7/26', '1:59:37 PM', 1401, 'مهر', 7, '26');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (52190, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'اعلام نتایج آزمون', '<div style="direction:rtl;">
	<p dir="RTL">
		اعلام نتایج آزمون کتبي جذب نيروي حجمي مورخ 31 شهریور شرکت تلاشگران آروین آپادانا</p>
</div>
<p>
	&nbsp;</p>
', '<p dir="RTL">
	داوطلبین محترم آزمون کتبي جذب نيروي حجمي مورخ 31 شهریور شرکت تلاشگران آروین آپادانا می توانند جهت اطلاع از نتایج آزمون از لینک ذیل مراجعه نمایند.</p>
<p dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<a href="https://estekhdam.kwphc.ir/azmoon140106" target="_blank"><span style="font-family:tahoma,geneva,sans-serif;"><strong><span style="color:#a52a2a;"><span style="font-size:18px;">اعلام نتایج آزمون</span></span></strong></span></a></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<a href="https://kwphc.ir/Archive/Other/ApadanaAdv.pdf" target="_blank"><span style="font-family:tahoma,geneva,sans-serif;"><strong><span style="color:#008000;"><span style="font-size:16px;">دریافت اطلاعیه</span></span></strong></span></a></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<img alt="" src="wp-content/uploads/news-images/image_25.jpeg" /></p>
<p>
	&nbsp;</p>
', '52190AdvApadana.jpg', 2250, '1401/8/3', '1:45:08 PM', 1401, 'آبان', 8, '3');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (52191, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'تمدید زمان ثبت نام آزمون مورخ 26 آبان', '<p>
	قابل توجه داوطلبان آزمون جذب نیروی حجمی شرکت نصب و تعمیرات نیروگاه های خوزستان مورخ 26 آبان ماه 1401</p>
', '<p>
	به اطلاع می رساند نظر به درخواست های مکرر متقاضیان جدید جهت ثبت نام و شرکت در این آزمون مهلت ثبت نام و ویرایش تا روز شنبه مورخ 21 آبان ماه تمدید گردید.</p>
<p>
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir/archive/other/help40108.pdf" target="_blank"><strong><span style="color:#008000;"><span style="font-family:tahoma,geneva,sans-serif;"><span style="font-size:18px;">دریافت فایل راهنما</span></span></span></strong></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="http://estekhdam.kwphc.ir/azmoon140108/" target="_blank"><span style="color:#800080;"><strong><span style="font-family:tahoma,geneva,sans-serif;"><span style="font-size:18px;">لینک ثبت نام</span></span></strong></span></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<span style="color:#800080;"><strong><span style="font-family:tahoma,geneva,sans-serif;"><span style="font-size:18px;"><img alt="" src="wp-content/uploads/news-images/image_26.jpeg" /></span></span></strong></span></p>
<p style="text-align: center;">
	&nbsp;</p>
', '52191Tmd0826.jpg', 3427, '1401/8/14', '4:15:41 PM', 1401, 'آبان', 8, '14');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (53189, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برای اولین بار رقم خورد', '<p>
	<span dir="RTL">مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان موفق به کسب رتبه برتر آموزشی در بین موسسات دارای صلاحیت آموزش کارکنان دولت در هفته آموزش استان خوزستان در سال </span><span dir="RTL">۱۴۰۱</span> <span dir="RTL">گردید.</span></p>
', '<p dir="RTL" style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، در نخستین بزرگداشت هفته آموزش استان که با حضور آقای مهندس موالی زاده فرماندار محترم استان خوزستان، آقای دکتر نیکو رئیس سازمان مدیریت و برنامه ریزی خوزستان و جمعی از مدیران ارشد دانشگاه ها و دستگاه های خصوصی و اجرایی استان برگزار شد، عنوان موسسه برتر آموزشی در بین موسسات دارای صلاحیت آموزش کارکنان دولت را در هفته آموزش استان خوزستان در سال ۱۴۰۱ احراز نمود و از سوی استاندار خوزستان تندیس و لوح تقدیر دریافت نمود.</p>
<p dir="RTL" style="text-align: justify;">
	گفتنی است آیین تجلیل از برگزیدگان این بزرگداشت روز چهارشنبه مورخ ۱۸ آبان ماه ۱۴۰۱ در سالن همایش کوی بوستان سازمان آب و برق خوزستان برگزار و از آقای مهندس محسن انصاری (سرپرست مجتمع) تقدیر به عمل آمد.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="1" cellspacing="1" style="width: 910px">
	<tbody>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_27.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_28.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_29.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_30.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_31.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_32.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_33.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: top;">
				<img alt="" src="wp-content/uploads/news-images/image_34.png" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: top;">
				<img alt="" src="wp-content/uploads/news-images/image_35.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: center;">
	<br />
	<br />
	<br />
	<br />
	&nbsp;</p>
', '52192NP.jpg', 1312, '1401/8/28', '3:05:50 PM', 1401, 'آبان', 8, '28');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (53190, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری آزمون استخدامی', '<div style="direction:rtl;">
	<p>
		<span dir="RTL">قابل توجه داوطلبان شرکت در آزمون جذب نیروی حجمی <span dir="RTL">شرکت برجمان ارشیا، دنیا کاران جنوب و تاراز منار</span></span></p>
</div>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	به اطلاع ميرساند شرکت<span dir="RTL"><span dir="RTL">برجمان ارشیا، دنیا کاران جنوب و تاراز منار</span></span> به منظور تأمين نيروي انساني مورد نياز، از آقايان واجد شرايط و از طريق آزمون توانمنديهاي عمومی و تخصصي(كتبي) و آزمون دانش مهارت (مصاحبه) و طی فرآیند گزینش و به ترتیب از بالاترین نمره با شرايط ذيل و در قالب قرارداد نیروی حجمی جذب می نماید.</p>
<p dir="RTL" style="text-align: justify;">
	در صورت بروز هرگونه مشكل و ابهام با شماره تلفن 33347248-061 مجتمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به عنوان مجري آزمون در وقت اداري تماس حاصل نمایید.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir/Archive/Other/WECo.pdf" target="_blank"><strong><span style="color:#008000;"><span style="font-family:tahoma,geneva,sans-serif;"><span style="font-size:18px;">دریافت فایل راهنما</span></span></span></strong></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="http://estekhdam.kwphc.ir/azmoon140109" target="_blank"><span style="color:#800080;"><strong><span style="font-family:tahoma,geneva,sans-serif;"><span style="font-size:18px;">لینک ثبت نام</span></span></strong></span></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_36.jpeg" style="height: 850px; width: 600px;" /></p>
', '53190NGHSH.png', 5791, '1401/9/6', '11:34:40 AM', 1401, 'آذر', 9, '6');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (53191, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برای اولین بار رقم خورد', '<p dir="RTL" style="text-align: justify;">
	این مجتمع موفق به کسب رتبه برتر آموزشی در بین موسسات دارای صلاحیت آموزش کارکنان دولت در هفته آموزش استان خوزستان در سال ۱۴۰۱ گردید.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، در نخستین بزرگداشت هفته آموزش استان که با حضور آقای مهندس موالی زاده فرماندار محترم استان خوزستان، آقای دکتر نیکو رئیس سازمان مدیریت و برنامه ریزی خوزستان و جمعی از مدیران ارشد دانشگاه ها و دستگاه های خصوصی و اجرایی استان برگزار شد، عنوان موسسه برتر آموزشی در بین موسسات دارای صلاحیت آموزش کارکنان دولت را در هفته آموزش استان خوزستان در سال ۱۴۰۱ احراز نمود و از سوی استاندار خوزستان تندیس و لوح تقدیر دریافت نمود.</p>
<p dir="RTL" style="text-align: justify;">
	گفتنی است آیین تجلیل از برگزیدگان این بزرگداشت روز چهارشنبه مورخ ۱۸ آبان ماه ۱۴۰۱ در سالن همایش کوی بوستان سازمان آب و برق خوزستان برگزار و از آقای مهندس محسن انصاری (سرپرست مجتمع) تقدیر به عمل آمد.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="1" cellspacing="1" style="width: 910px">
	<tbody>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_37.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_38.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_39.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_40.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_41.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_42.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_43.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: top;">
				<img alt="" src="wp-content/uploads/news-images/image_44.png" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: top;">
				<img alt="" src="wp-content/uploads/news-images/image_45.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: center;">
	<br />
	<br />
	&nbsp;</p>
', '53191Avalinbar.jpg', 332, '1401/9/10', '8:05:59 PM', 1401, 'آذر', 9, '10');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (53192, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'اعلام نتایج آزمون', '<p>
	اعلام نتایج آزمون کتبي جذب نيروي حجمي مورخ 26 آبان ماه شرکت نصب و تعمیرات نیروگاه های خوزستان</p>
', '<p dir="RTL">
	داوطلبین محترم آزمون کتبي جذب نيروي حجمي مورخ 26 آبان ماه 1401 شرکت نصب و تعمیرات نیروگاه های خوزستان می توانند جهت اطلاع از نتایج آزمون از لینک ذیل استفاده نمایند.</p>
<p dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<a href="https://estekhdam.kwphc.ir/azmoon140108" target="_blank"><span style="font-family:tahoma,geneva,sans-serif;"><strong><span style="color:#a52a2a;"><span style="font-size:18px;">اعلام نتایج آزمون</span></span></strong></span></a></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<a href="https://www.kwphc.ir/Archive/Other/AdvNasb.pdf" target="_blank"><span style="font-family:tahoma,geneva,sans-serif;"><strong><span style="color:#008000;"><span style="font-size:16px;">دریافت اطلاعیه</span></span></strong></span></a></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<img alt="" src="wp-content/uploads/news-images/image_46.jpeg" style="height: 707px; width: 500px;" /></p>
<p align="center" dir="RTL">
	<br />
	<br />
	&nbsp;</p>
<p style="text-align: center;">
	&nbsp;</p>
', '53192NasbNews.jpg', 7036, '1401/9/20', '3:56:28 PM', 1401, 'آذر', 9, '20');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (53193, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'پذیرش دانشجو بدون کنکور', '<p>
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برای بهمن ماه سال 1401 بدون کنکور دانشجو می پذیرد.</p>
', '<p style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، بهمن ماه سال 1401 با ظرفیت 18 رشته تحصیلی در <strong>مقاطع کاردانی و کارشناسی ناپیوسته،</strong> <strong>بدون کنکور</strong> دانشجو می پذیرد.</p>
<p style="text-align: justify;">
	علاقمندان می توانند جهت کسب اطلاعات بیشتر با شماره های 06133340070 و 09378535157 تماس حاصل نموده یا به آدرس : اهواز &ndash; بلوار گلستان &ndash; بین خیابان کاشان و همدان &ndash; روبروی هتل نیشکر مراجعه نمایند.</p>
<p style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: center;">
	<span style="font-size:18px;"><a href="https://register2.sanjesh.org/regjamekardani_140110/" target="_blank"><span style="color:#ff00cc;">ثبت نام دوره کاردانی</span></a></span></p>
<p style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<a href="https://register2.sanjesh.org/NOET_Register_Jamekarshenasi140110" target="_blank"><span style="color:#800080;"><span style="font-size:18px;">ثبت نام دوره کارشناسی ناپيوسته</span></span></a></p>
<p style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_47.jpeg" /></p>
', '53193SbtPic.jpg', 1590, '1401/10/4', '2:06:10 AM', 1401, 'دی', 10, '4');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (53194, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'اعلام نتایج آزمون', '<p>
	اعلام نتایج آزمون کتبي جذب نيروي حجمي مورخ 25 آذرماه1401 شرکتهای برجمان ارشیا، دنیا کاران جنوب و تاراز منار</p>
', '<p dir="RTL">
	داوطلبین محترم آزمون کتبي جذب نيروي حجمي مورخ 25 آذرماه1401 شرکتهای برجمان ارشیا، دنیا کاران جنوب و تاراز منار می توانند جهت اطلاع از نتایج آزمون از لینک ذیل استفاده نمایند.</p>
<p dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<a href="https://estekhdam.kwphc.ir/azmoon140109/" target="_blank"><span style="font-family:tahoma,geneva,sans-serif;"><strong><span style="color:#a52a2a;"><span style="font-size:18px;">اعلام نتایج آزمون</span></span></strong></span></a></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p style="text-align: center;">
	<a href="https://www.kwphc.ir/Archive/Other/Az2509.pdf" target="_blank"><span style="font-family:tahoma,geneva,sans-serif;"><strong><span style="color:#008000;"><span style="font-size:16px;">دریافت اطلاعیه</span></span></strong></span></a></p>
<p style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_48.jpeg" /></p>
', '53194RsltPic.jpg', 2274, '1401/10/10', '2:46:39 PM', 1401, 'دی', 10, '10');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (54193, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'آزمون استخدامی', '<p>
	موسسه خدمات حفاظتی و مراقبتی حافظین امنیت پادنا به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید.</p>
', '<p dir="RTL" style="margin-right: 0.2pt; text-align: justify;">
	به اطلاع ميرساند موسسه خدمات حفاظتی و مراقبتی حافظین امنیت پادنا به منظور تأمين نيروي انساني مورد نياز، <strong>از آقايان </strong>واجد شرايط را از طريق آزمون توانمندي&shy;هاي عمومی و تخصصي(كتبي) و آزمون دانش مهارت (&shy;مصاحبه) و طی فرآیند گزینش و به ترتیب از بالاترین نمره با شرايط ذيل و در قالب قرارداد نیروی حجمی جذب مي&shy; نمايد.</p>
<p dir="RTL" style="text-align: justify;">
	در صورت بروز هرگونه مشكل و ابهام با شماره تلفن 33347248-061 مجتمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به عنوان مجري آزمون در وقت اداري تماس حاصل نمایید.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<span style="color:#ff6600;"><strong>قابل توجه داوطبان گرامی : با عنایت به قانون حمایت از خانواده و جوانی جمعیت شرایط سنی این آگهی تغییر یافت لطفا نسبت مطالعه مجدد آن اقدام نمایید .</strong></span></p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir/Azmoon/AzmoonAdv/AdvNegahban.pdf" target="_blank"><span style="color:#4b0082;"><span style="font-size:18px;">دریافت آگهی</span></span></a></p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir/Azmoon/AzmoonAdv/Attach1.pdf" target="_blank"><span style="font-size:18px;"><span style="color:#800080;">دریافت ضمیمه 1</span></span></a></p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir/Azmoon/AzmoonAdv/Attach2.pdf" target="_blank"><span style="color:#ee82ee;"><span style="font-size:18px;">دریافت ضمیمه 2</span></span></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://estekhdam.kwphc.ir/azmoon140111" target="_blank"><span style="color:#000080;"><span style="font-size:18px;">لینک ثبت نام</span></span></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_49.jpeg" style="height: 708px; width: 500px;" /></p>
', '53195nwspadena.jpg', 15611, '1401/11/6', '5:53:05 PM', 1401, 'بهمن', 11, '6');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (54194, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'نخستین رویداد سنجش و ارزیابی صلاحیت حرفه ای', '<section class="News-Detail-Lead">
	<div style="text-align: justify;">
		<span style="font-size:14px;"><a href="https://www.news.kwpa.ir/%D8%A8%D8%AE%D8%B4-%D8%AF%D8%B3%D8%AA%D9%87-%D8%A8%D9%86%D8%AF%DB%8C-%D9%86%D8%B4%D8%AF%D9%87-1/7682-%D9%86%D8%AE%D8%B3%D8%AA%DB%8C%D9%86-%D8%A2%D8%B2%D9%85%D9%88%D9%86-%D8%B3%D9%86%D8%AC%D8%B4-%D8%A7%D8%B1%D8%B2%DB%8C%D8%A7%D8%A8%DB%8C-%D8%B5%D9%84%D8%A7%D8%AD%DB%8C%D8%AA-%D8%AD%D8%B1%D9%81%D9%87-%D8%A7%DB%8C-%D9%86%DB%8C%D8%B1%D9%88%DB%8C-%D8%A7%D9%86%D8%B3%D8%A7%D9%86%DB%8C-%D8%B4%D8%B1%DA%A9%D8%AA%D9%87%D8%A7%DB%8C-%D9%BE%DB%8C%D9%85%D8%A7%D9%86%DA%A9%D8%A7%D8%B1-%D8%A8%D8%AE%D8%B4-%D8%A2%D8%A8-%D9%88%D8%B2%D8%A7%D8%B1%D8%AA-%D9%86%DB%8C%D8%B1%D9%88-%D8%AF%D8%B1-%D8%B3%D8%A7%D8%B2%D9%85%D8%A7%D9%86-%D8%A2%D8%A8-%D8%A8%D8%B1%D9%82-%D8%AE%D9%88%D8%B2%D8%B3%D8%AA%D8%A7%D9%86" target="_blank" title="نخستین آزمون سنجش و ارزیابی صلاحیت حرفه ای نیروی انسانی شرکتهای پیمانکار بخش آب وزارت نیرو در سازمان آب و برق خوزستان"><span style="color:#000000;">نخستین رویداد سنجش و ارزیابی صلاحیت حرفه ای نیروی انسانی شرکت&zwnj;های پیمانکار در مشاغل</span></a><span style="color:#000000;"> اختصاصی بخش آب وزارت نیرو، توسط مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد.</span></span></div>
</section>
<p>
	&nbsp;</p>
', '<p style="text-align: justify;">
	<span style="font-size:14px;"><span style="color:#000000;">برای اولین&zwnj; بار، سنجش و ارزیابی صلاحیت حرفه&zwnj;ای مشاغل اختصاصی صنعت آب و برق در &quot;سطح الف&quot; مطابق با نظام صلاحیت حرفه&zwnj;ای نیروی انسانی، برای کارکنان شاغل در شرکت بهره&zwnj;برداری از سد، نیروگاه و شبکه&zwnj;های آبیاری مارون در روزهای 4 و 5 بهمن&zwnj;ماه برگزاری شد.<br />
	این رویداد ارزیابی صلاحیت حرفه&zwnj;ای مطابق با استانداردهای شایستگی مشاغل شرکت مادرتخصصی مدیریت منابع آب ایران، در 14 رشته شغلی از حوزه&zwnj;های بهره&zwnj;برداری و نگهداری از سد، نیروگاه و شبکه&zwnj;های آبیاری و زهکشی توسط مجتمع آموزشی و پژوهشی خوزستان در بهبهان برگزار شد. شاغلان این آزمون از سوی ارزیابان تخصصي معرفی&zwnj;شده شرکت مادرتخصصي منابع آب ايران مورد سنجش و ارزیابی دانشی قرار گرفتند.<br />
	لازم به ذکر است، تحقق اهداف مهم صنعت آب و برق شامل تأمین برق مطمئن و پايا، آب سالم و كافي و خدمات بهداشتي فاضلاب، نيازمند هماهنگي منابع سه&zwnj;گانه &laquo;مالي، سخت&zwnj;افزاري و نيروي انساني&raquo; است و نقش منابع انساني شاغل در این صنعت زیربنائی، حیاتی است. به&zwnj;طور خاص، كاركنان شاغل در مشاغل اختصاصي شركت&zwnj;هاي پيمانكاري صنعت آب و برق در راستاي تكاليف و مأموریت&zwnj;های وزارت نيرو نقش کلیدی دارند تا ضمن بهره&zwnj;برداري بهينه از تأسیسات و تجهيزات صنعت آب و برق، فرايندهاي نگهداري و تعميرات را به نحو مطلوب جهت حداكثر بهره&zwnj;وري و افزايش طول عمر مفيد آن به انجام رسانند. مسئوليت توسعه نظامات و سازوكارهاي لازم براي كسب اطمينان از صلاحيت فني و تخصصي و حرفه&zwnj;اي سرمايه&zwnj;هاي انساني صنعت و ارتقاء دانش و مهارت&zwnj;هاي شغلي ايشان و همچنين كاهش حوادث و سوانح شغلي، بر عهده وزارت نیرو به عنوان متولی تامین آب و برق، می&zwnj;باشد. از جمله اقدامات معاونت تحقيقات و منابع انساني وزارت نيرو، پياده&zwnj;سازي نظام صلاحيت حرفه&zwnj;اي منابع انساني شاغل در شركت&zwnj;هاي پيمانكار بوده كه مرحله اجرايي آن در سطح شركت&zwnj;هاي تابعه از سال 1401 آغاز شده است؛ مطابق مصوبات هفتادمين كميته توانمندسازي صنعت آب و برق، استقرار &quot;سطح الف&quot; طرح فوق شامل ارزیابی صلاحیت دانشی تا انتهاي سال جاري در دستور کار دارد. افرادي که در سطح الف نظام صلاحیت حرفه&zwnj;ای نیروی انسانی پذيرفته شوند، در مراحل بعد مي&zwnj;توانند در ارزیابي دانشي تکميلي و مهارتي براي دريافت گواهينامه &quot;سطح ب&quot; نظام صلاحیت حرفه&zwnj;ای نیروی انسانی شرکت نمایند. با توجه به برنامه&zwnj;ريزي انجام&zwnj;شده توسط وزارت نيرو جهت پياده&zwnj;سازي مطلوب سطوح بعدي اين نظام در سال 1402، مزايا و امتياز شغلي متناسب آن طراحي، تدوين و ابلاغ خواهد شد.</span></span></p>
<p style="text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 910px">
	<tbody>
		<tr>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_50.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_51.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_52.jpeg" /></td>
		</tr>
		<tr>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
		</tr>
		<tr>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_53.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_54.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_55.jpeg" /></td>
		</tr>
		<tr>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
		</tr>
		<tr>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_56.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '54194slhnws.jpg', 1008, '1401/11/11', '1:06:43 PM', 1401, 'بهمن', 11, '11');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (54195, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'پیام تبریک سرپرست مجتمع به مناسبت دهه فجر', '<p>
	پیام تبریک سرپرست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به مناسبت فرا رسیدن ایام الله دهه مبارک فجر و چهل و چهارمین سالگرد پیروزی انقلاب شکوهمند اسلامی</p>
', '<p style="text-align: justify;">
	<span style="font-size:14px;">انقلاب&nbsp; سال ١٣٥٧، طلوع عصری زرین در سرگذشت مردمانی است که باور کردند پیشرفت و سعادت جز با رهایی از بند استبداد، میسر نیست. مسیری که متولد شد و با درایت&nbsp; بنیانگذار و رهبر عظیم الشانش انفجار نور لقب گرفت تا جهانیان بدانند که ظلمت هرگز پایدار نخواهد ماند، به خصوص در سرزمینی که مردمانش قلب&zwnj;هایی به زیبایی و روشنی الماس دارند. دهه مبارک فجر، ایام به ثمر رسیدن جانفشانی&zwnj;های مردم آزاده&zwnj;ای است که در برابر استبدادی دیرپا، وابسته به بیگانه و عدالت &zwnj;ستیز یکپارچه به پاخاستند و در چنین روزهایی فرشی از صداقت به پهنای ایران زمین گستردند و حضور امام عشق را در فضای این آب و خاک محقق ساختند و انقلاب بزرگ و تاریخ&zwnj; ساز خود را به پیروزی رساندند.<br />
	<br />
	اینجانب ضمن گرامیداشت یاد امام خمینی (ره) و درود به روح پاک و مطهر ایشان و ارواح طیبه شهدا، فرا رسیدن چهل و چهارمین سالگرد پیروزی شکوهمند انقلاب اسلامی و همچنین ولادت با سعادت امیرالمؤمنین علی(ع) مقتدای همه عدالتخواهان جهان و روز پدر را به پیشگاه مقام عظمای ولایت و به محضر یکایک ملت شریف ایران و به &zwnj;ویژه کارکنان خدوم و ولایتمدار صنعت آب و برق و جامعه دانشگاه جامع علمی کاربردی تبریک و تهنیت عرض می&shy; نمایم و امیدوارم تحت زعامت مقام معظم رهبری، پرچم این انقلاب در دستان صاحب اصلی آن حضرت ولیعصر (عج الله تعالی فجه الشریف) به اهتزاز درآید.</span></p>
', '54195RsNws.jpg', 437, '1401/11/12', '8:12:57 PM', 1401, 'بهمن', 11, '12');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (54196, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری جلسه مجمع سالیانه هیات امنای مجتمع', '<p dir="RTL">
	جلسه مجمع سالیانه هیات امنای مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور اعضای هیات امنا، برگزار شد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	بیست و نهمین جلسه مجمع هیات امنای مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به ریاست مهندس عباس صدریان فر، مدیرعامل سازمان آب و برق خوزستان و قائم مقام هیات امنای مجتمع و با حضور سایر اعضا، در روز یکشنبه مورخ 16 بهمن ماه 1401 در سالن جلسات حوزه مدیرعامل سازمان آب و برق خوزستان برگزار و فعالیت های آموزشی، پژوهشی و فرهنگی مجتمع در سال 1400 و 10 ماهه سال 1401 مورد بررسی قرار گرفت<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در ابتدای جلسه پس از تلاوت آیاتی چند از کلام الله مجید، مهندس صدریان فر ضمن تبریک فرا رسیدن چهل و چهارمین سالگرد پیروزی شکوهمند انقلاب اسلامی و همچنین ولادت با سعادت امیرالمؤمنین علی (ع) و خیر مقدم و خوشامدگویی به اعضاء به ویژه جناب آقای دکتر محمدرضا فدائی تهرانی رئیس مرکز آموزش های تخصصی و صلاحیت حرفه ای صنعت آب و برق، بر جایگاه آموزش در صنعت آب و برق و رسالت خطیر مجتمع در این خصوص تاکید نمودند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در این جلسه که رییس مرکز آموزش های تخصصی و صلاحیت حرفه ای صنعت آب و برق، مدیرعامل شرکت توزیع نیروی برق خوزستان، معاونین مالی و پشتیبانی و منابع انسانی شرکت برق منطقه ای خوزستان، نماینده مدیرعامل و معاون منابع انسانی و تحقیقات شرکت آب و فاضلاب خوزستان، معاونت های برنامه ریزی، منابع انسانی، مالی و پشتیبانی و شبکه های آبیاری و زهکشی، مدیریت بازرسی، حسابرسی و مجامع و رئیس گروه آموزش سازمان آب و برق خوزستان حضور داشتند، &ldquo;محسن انصاری&rdquo;سرپرست مجتمع و دبیر هیات امنا، ضمن تبریک ایام الله دهه مبارک فجر و میلاد امام علی (ع)، از همراهی قائم مقام هیات امنا، رییس مرکز آموزش های تخصصی و صلاحیت حرفه ای صنعت آب و برق، کلیه اعضا و شرکت های طرف قرارداد که فعالیت های آموزشی خود را در سال 1400 و 1401 همگام با توسعه فناوری سیستم مدیریت آموزش و یادگیری مجازی مجتمع، آموزش های خود را توسعه دادند تشکر و قدردانی نمود و در ادامه به تشریح فعالیت های مجتمع پرداختند<span dir="LTR">.</span> وی با اشاره به رشد 24 درصدی فعالیت های آموزشی مجتمع در سال 1400 نسبت به سال 1399 و رشد 6 درصدی 10 ماهه سال جاری نسبت به سال قبل، گزارشی از سهم مشارکت شرکت های صنعت آب و برق استان در فعالیت های مجتمع و حوزه آموزش&zwnj;های ارایه شده به ویژه در بخش های شغلی اختصاصی و مدیریتی ارایه نمودند<span dir="LTR">.</span> مهندس انصاری در ادامه ضمن ارائه گزارشی از اقدامات انجام شده در جهت بهبود عملکرد و رویکردهای اصلاحی و با ابراز علاقه مندی و آمادگی مجتمع جهت انجام فعالیت های تحقیقاتی و پژوهش های کاربردی، برنامه های سال ۱۴۰2 و استراتژیک بلند مدت را در حوزه نیازسنجی آموزشی، استانداردسازی و تولید محتوای دوره ها، پیاده سازی و اجرای نظام صلاحیت حرفه ای نیروی انسانی صنعت آب و برق، سنجش و ارزیابی آموزشی سطح 3 و 4، توسعه آموزش های بین الملل، توسعه رویدادهای شتاب و استارتاپ، ایجاد مراکز نوآوری، دانش بنیان و مدیریت دانش، توسعه برنامه های توانمندساز سرمایه انسانی صنعت آب و برق، آموزش های بلندمدت دانشجویی مجتمع تشریح نمودند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	پس از ارایه گزارش سرپرست مجتمع، گزارش حسابرسی و صورت های مالی مجتمع مورد بررسی قرار گرفت که با توجه به ارایه گزارش حسابرس مبنی بر مطلوب بودن صورت های مالی منتهی به 29 اسفند سال 1400، قائم مقام و سایر اعضای هیات امنا از فعالیت های آموزشی و مدیریت مالی انجام شده ابراز رضایت و تشکر نمودند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در ادامه سایر اعضای هیات امنا ضمن تقدیر از فعالیت های مدیریت مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان و مجموعه تحت سرپرستی و ارائه پیشنهاداتی در خصوص ارتقاء فعالیت های مجتمع، از برنامه های مجتمع در جهت توانمندسازی سرمایه انسانی صنعت آب و برق استان و پیشنهادهای توسعه ای و توانمند ساز مجتمع استقبال و حمایت نمودند.</p>
<p dir="RTL" style="text-align: justify;">
	در پایان مهندس صدریان فر ضمن تشکر از حضور اعضا و فعالیت های بسیار خوب مجتمع، بر استمرار فعالیت های اثربخش مذکور و انعقاد قرارداد آموزشی و پژوهشی شرکت های صنعت آب و برق استان با مجتمع ضمن حفظ کیفیت و توسعه ظرفیت های آموزشی و پژوهشی جهت تحقق شعار سال مقام معظم رهبری (مدظله العالی) تاکید نمودند.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 910px">
	<tbody>
		<tr>
			<td style="text-align: center; vertical-align: middle;">
				<img alt="" src="wp-content/uploads/news-images/image_57.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				<img alt="" src="wp-content/uploads/news-images/image_58.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				<img alt="" src="wp-content/uploads/news-images/image_59.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle;">
				<img alt="" src="wp-content/uploads/news-images/image_60.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				<img alt="" src="wp-content/uploads/news-images/image_61.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				<img alt="" src="wp-content/uploads/news-images/image_62.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle;">
				<img alt="" src="wp-content/uploads/news-images/image_63.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				<img alt="" src="wp-content/uploads/news-images/image_64.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				<img alt="" src="wp-content/uploads/news-images/image_65.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '54196HOmana.jpg', 275, '1401/11/18', '2:42:04 PM', 1401, 'بهمن', 11, '18');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (54197, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'دیدار سرپرست مجتمع با خانواده شهید فاضل موسوی امین', '<p dir="RTL" style="text-align: justify;">
	دیدار سرپرست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به همراه فرمانده حوزه مقاومت بسیج شهید عباسپور و جمعی از اساتید و کارکنان، با خانواده معظم شهید مدافع حرم سید فاضل موسوی امین</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	سرپرست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به همراه فرمانده حوزه مقاومت بسیج شهید عباسپور و جمعی از اساتید و کارکنان، در منزل&nbsp; شهید مدافع حرم <em><strong>سید فاضل موسوی امین </strong></em>حضور یافتند و با خانواده معظم این شهید والا مقام دیدار کردند.</p>
<p dir="RTL" style="text-align: justify;">
	محسن انصاری سرپرست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در این دیدار با بیان اینکه شهدای مدافع حرم با بصیرت و شجاعت در میدان نبرد حضور داشتند گفت: این شهدا وظیفه خود را به درستی شناختند و دراین راه نیز به نهایت آرزوی خود یعنی شهادت رسیدند. وی در ادامه افزود: خانواده های معظم شهدا با تقدیم بهترین عزیزان خود در راه دفاع از آرمان های کشور و مرزهای آن کاری بزرگ و ستودنی انجام دادند که این مهم، افتخار بزرگی برای تمام ملت ایران است<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	عباس نبگانی فرمانده حوزه مقاومت بسیج شهید عباسپور با تاکید به اینکه امروز خانواده های شهدا مایه افتخار کشور هستند، گفتند: حضور در جمع این خانواده ها علاوه بر اینکه مسئولیت ما را در انجام وظایف سخت تر می کند، انرژی مضاعفی را برای خدمت رسانی ایجاد می کند. وی در ادامه افزود: شهدا نیز همچون همه مردم، درگیری زندگی و روزمرگی&zwnj;های آن بودند و پیشاپیش روی&zwnj;شان نیز زندگی ادامه داشت؛ با این همه، پای باورهایشان ایستادند و از همه چیز خود گذشتند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	شهید سید فاضل موسوی امین فرزند سید جلال نخستین شهید مدافع حرم شهرک رزمندگان اهواز است که در تاریخ یکم اردیبهشت &zwnj;ماه سال ۱۳۶۴ به &zwnj;عنوان فرزند نخست خانواده، دیده به جهان گشود. پس از هجوم تکفیری &zwnj;ها به کشورهای اسلامی این جوان باغیرت به کشور سوریه رفت و به دفاع از حرم حضرت زینب کبری(س) و حضرت رقیه(س) پرداخت. این دلیرمرد جوان پس از حضور در سوریه در هشتم بهمن&zwnj; ماه سال ۱۳۹۶ به شهادت رسید و پیکر پاکش بعد از پنج ماه به وطن بازگشت. آئین تشییع پیکر مطهر شهید مدافع حرم سید فاضل موسوی امین روز پنج&zwnj;شنبه ۳۱ خردادماه سال 1397 از مقابل مسجد امام خمینی(ره) شهرک رزمندگان اهواز برگزار شد. پس از برگزاری آئین تشییع، پیکر شهید موسوی امین به گلزار شهدای اهواز انتقال یافت و در قطعه شهدای مدافع حرم آرام گرفت.</p>
<p dir="RTL" style="text-align: justify;">
	در این دیدار، هدیه ای از سوی سرپرست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به رسم ادب و یادبود به پدر شهید والامقام سید موسوی اهدا شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" dir="rtl" style="width: 920px">
	<tbody>
		<tr>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_66.jpeg" /></td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_67.jpeg" /></td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_68.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center; width: 300px;">
				&nbsp;</td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center; width: 300px;">
				&nbsp;</td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center; width: 300px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_69.jpeg" /></td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_70.jpeg" /></td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_71.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center; width: 300px;">
				&nbsp;</td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center; width: 300px;">
				&nbsp;</td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center; width: 300px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_72.jpeg" /></td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_73.jpeg" /></td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_74.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '54197A1.jpg', 505, '1401/11/19', '4:17:18 PM', 1401, 'بهمن', 11, '19');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (54198, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری مسابقات فرهنگی ویژه دهه فجر انقلاب اسلامی', '<p dir="RTL" style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به مناسبت دهه مبارک فجر اقدام به برگزاری مسابقات فرهنگی در زمینه های کتابخوانی، مقاله نویسی، عکاسی، نقاشی، پادکست و ساخت کلیپ نموده است.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	فرا رسیدن چهل و چهارمین سالگرد پیروزی شکوهمند انقلاب اسلامی و آغاز دهه فجر مبارک باد.</p>
<p dir="RTL" style="text-align: justify;">
	بدین مناسبت مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با عنایت به رسالت آموزشی و فرهنگی خویش در نظر دارد با همکاری دفتر امور فرهنگی و دینی صنعت آب و برق خوزستان، جهت شکوفایی و پویایی استعداد فرزندان و خانواده صنعت آب و برق، دانشگاه و مراکز آموزش علمی کاربردی استان خوزستان و به منظور پیشبرد سیاستگذاری هدفمند و ایجاد فضایی پویا و با نشاط جهت بزرگداشت عید انقلاب، اقدام به تدارک و برگزاری مسابقات فرهنگی شامل کتابخوانی، نقاشی، عکاسی، ساخت کلیپ، پادکست و مقاله نویسی با محوریت ایام الله دهه فجر نماید.</p>
<p dir="RTL" style="text-align: justify;">
	جهت اطلاع از شرایط ثبت نام و شرکت در مسابقه بر روی لینک ذیل کلیک نمایید.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<strong><a href="https://www.kwphc.ir/fajr"><span style="color:#4b0082;"><span style="font-size:16px;">لینک شرکت در مسابقه</span></span></a></strong></p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 910px">
	<tbody>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_75.jpeg" /></td>
			<td style="text-align: center; width: 10px;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_76.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p style="text-align: center;">
	&nbsp;</p>
', '54198Mosabeqe.jpg', 334, '1401/11/19', '4:41:19 PM', 1401, 'بهمن', 11, '19');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (54199, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'حضور سرپرست مجتمع در راهپیمایی یوم الله ۲۲ بهمن', '<p style="text-align: justify;">
	محسن انصاری در اجتماع راهپیمایان مراسم یوم&zwnj;الله ۲۲ بهمن و جشن چهل و چهارمین سالگرد انقلاب اسلامی، حضور یافت. جمعی از استادان، کارکنان و دانشجویان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، مهندس انصاری را همراهی کردند.<br />
	&nbsp;</p>
', '<p style="text-align: justify;">
	دهه مبارک فجر و یوم&zwnj;الله ۲۲ بهمن، یادآور مجاهدت و ایثار ملت رشید ایران و پیروزی انقلاب اسلامی به رهبری امام راحل عظیم الشأن حضرت امام خمینی(ره) و جانفشانی شهیدان سرافراز این سرزمین است؛ نهضت امام خمینی به عنوان یک تجربه نوین، سرآغاز بیداری در برابر ستمگران و موجب قطع ید استکبار جهانی به سردمداری آمریکای تجاوزکار از ایران اسلامی بوده است و انقلاب اسلامی ایران، فروغ امید و گرمی حیات را به کالبد سرد مسلمانان و مستضعفان جهان دمید و تجربه&zwnj;ای تازه از حکومت دینی توأم با ارزش&zwnj;هایی مانند عدالت، استقلال، آزادی و مردم سالاری دینی را به بشریت عرضه کرد.<br />
	در چهل و چهارمین سالروز پیروزی انقلاب شکوهمند اسلامی ایران، محسن انصاری به همراه جمعی از استادان، کارکنان و دانشجویان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، همراه با سایر اقشار ملت انقلابی، متعهد و همیشه در صحنه، در راهپیمایی یوم الله ۲۲ بهمن حضور یافتند و ضمن تجدید میثاق با آرمان&zwnj;های انقلاب اسلامی، بیان نمودند بار دیگر فداکارانه بر عهد و پیمان خود با شهدای والامقام و امام بزرگوار وفادار بوده و در هیچ شرایطی در برابر زورگویان عالم به ویژه شیطان بزرگ؛ آمریکای جنایتکار از نظام مقدس جمهوری اسلامی و آرمان&zwnj;های آن دست نخواهند کشید.</p>
<p style="text-align: justify;">
	&nbsp;</p>
<table border="0" cellpadding="0" cellspacing="0" style="width: 900px">
	<tbody>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_77.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_78.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_79.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '54199nwsbahman.jpg', 285, '1401/11/24', '9:43:12 AM', 1401, 'بهمن', 11, '24');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (54200, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری آزمون استخدامی', '<p>
	شرکت برجمان ارشیا، دنیا کاران جنوب و تاراز منار به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید.</p>', '<p>
	به اطلاع ميرساند شرکت برجمان ارشیا، دنیا کاران جنوب و تاراز منار به منظور تأمين نيروي انساني مورد نياز، <strong>از آقايان </strong>واجد شرايط را از طريق آزمون توانمندي&shy;هاي عمومی و تخصصي(كتبي) و آزمون دانش مهارت (&shy;مصاحبه) و طی فرآیند گزینش و به ترتیب از بالاترین نمره با شرايط ذيل و در قالب قرارداد نیروی حجمی جذب مي&shy; نمايد.</p>
<p dir="RTL" style="text-align: justify;">
	در صورت بروز هرگونه مشكل و ابهام با شماره تلفن 33347248-061 مجتمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به عنوان مجري آزمون در وقت اداري تماس حاصل نمایید.</p>', '54200nwsbarjman.jpg', 3330, '1401/11/24', '4:09:55 PM', 1401, 'بهمن', 11, '24');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (55200, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری جشن نیمه شعبان در مجتمع', '<p dir="RTL" style="text-align: justify;">
	در آستانه نیمه شعبان، مراسم جشن با شکوهی با حضور خانواده همکاران، اساتید و دانشجویان در روز دوشنبه مورخ 15 اسفند 1401 در محل مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: justify;">
	در آستانه میلاد با سعادت دوازدهمین خورشید تابناک آسمان امامت و ولایت، مراسم جشن با شکوهی با حضور خانواده همکاران، اساتید و دانشجویان در روز دوشنبه مورخ 15/12/1401 در محل مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید.</p>
<p dir="RTL" style="text-align: justify;">
	در ابتدای مراسم آقای &quot;<strong>مهدی هودگر</strong>&quot; ریاست مجتمع، ضمن خیر مقدم به مدعوین و تبریک اعیاد شعبانیه، میلاد مسعود منجی عالم بشریت حضرت مهدی صاحب الزمان(عج) را تبریک گفتند. در ادامه حجت الاسلام نرادی پرگلی مشاور فرهنگی مدیرعامل سازمان آب و برق خوزستان و رئیس انسجام بخشی امور فرهنگی و دینی صنعت آب و برق استان خوزستان، در سخنانی با اشاره به ترویج اندیشه ظهور و انتظار و تاکید بر&nbsp;ضرورت تبیین درست فرهنگ مهدویت در جامعه اسلامی به تشریح ابعاد مختلف مهدویت و وجود نورانی حضرت بقیه الله الاعظم(عج) پرداختند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	برگزاری مسابقه، اهدای جوایز، سرود، تواشیح، شعرخوانی و اجرای نمایشنامه از دیگر برنامه های جشن نیمه شعبان بود.</p>
<p dir="RTL" style="text-align: justify;">
	در این مراسم که حجت الاسلام و المسلمین جناب آقای عادلی نژاد ریاست محترم دفتر نهاد مقام معظم رهبری در دانشگاه های استان خوزستان و حجت الاسلام جناب آقای ناصری مسئول دفتر نهاد رهبری در دانشگاه جامع علمی کاربردی خوزستان نیز حضور داشتند به کلیه دانشجویان ممتاز مرکز، لوح تقدیر و هدیه ای نفیس به رسم یاد بود اهدا گردید.</p>
<p dir="RTL" style="text-align: justify;">
	در پایان این جشن از میهمانان به صرف شیرینی و شام، پذیرایی به عمل آمد.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 915px">
	<tbody>
		<tr>
			<td style="width: 300px; text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_80.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="width: 300px; text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_81.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="width: 300px; text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_82.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_83.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_84.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_85.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_86.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_87.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_88.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '54201Mn.jpg', 234, '1401/12/16', '10:52:14 PM', 1401, 'اسفند', 12, '16');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (55201, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری رویداد شتاب (استارتاپی)', '<p dir="RTL" style="text-align: justify;">
	دفتر نوآوری مرکز علمی کاربردی صنعت آب و برق خوزستان اقدام به برگزاری رویداد شتاب (استارتاپی) با عنوان <em>&quot;طراحی محتواهای آموزشی و تبلیغاتی در صنعت آب و برق&quot;</em> نمود.</p>
<p>
	&nbsp;</p>', '<p style="text-align: justify;">
	<span dir="RTL">دفتر نوآوری مرکز علمی کاربردی صنعت آب و برق خوزستان اقدام به برگزاری رویداد شتاب ( استارتاپی) با عنوان &quot; طراحی محتواهای آموزشی و تبلیغاتی در صنعت آب و برق&quot; نمود. این رویداد در روز یکشنبه 21 اسفندماه 1401 در سالن جلسات دفتر ریاست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید. هدف از برگزاری این رویداد جذب ایده های نوآورانه و خلاقانه در تولید محتواهای آموزشی، اطلاع رسانی مجموعه فعالیت های وزارت نیرو به جامعه و آگاهی بخشیدن به مردم در خصوص کاهش مصرف آب و انرژی می باشد. در این رویداد سه داور داخلی از گروه های آموزشی و سه داور مدعو از پارک علم و فناوری، مرکز رشد &nbsp;شهرستان دزفول و سازمان فنی و حرفه ای استان خوزستان برگزار گردید و در نهایت از میان ايده های شرکت کنندگان در رویداد سه ایده برتر توسط داوران انتخاب گردید.</span></p>
<p style="text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 1005px">
	<tbody>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_89.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; width: 500px;">
				<img alt="" src="wp-content/uploads/news-images/image_90.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_91.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_92.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>', '55201RePosterNews.jpg', 470, '1401/12/25', '1:16:58 PM', 1401, 'اسفند', 12, '25');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (56200, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'ارزیابی صلاحیت حرفه ای نیروی انسانی', '<p dir="RTL" style="margin-right: -8.5pt; text-align: justify;">
	ارزیابی صلاحیت حرفه ای نیروی انسانی مشاغل فنی و تخصصی 3 شرکت از شرکت های طرف پیمان سازمان آب و برق خوزستان</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="margin-right: -8.5pt; text-align: justify;">
	در راستای پیاده سازی نظام صلاحیت حرفه ای نیروی انسانی مشاغل فنی و تخصصی شرکت های پیمانکار سازمان آب و برق خوزستان، سطح الف سنجش و ارزیابی صلاحیت حرفه ای نیروی انسانی مشاغل فنی و تخصصی&quot; شرکت بهره برداری &nbsp;شبکه های آبیاری و زهکشی کارون بزرگ&quot;، &quot; شرکت بهره برداری از شبکه های آبیاری ناحیه شمال&quot; و &quot; شرکت تولید بهره برداری سد و نیروگاه کرخه برق آبی&quot; در حوزه مشاغل 21 گانه &quot;آبیاری و زهکشی&quot;، &quot; نیروگاه برق آبی&quot; و &quot;سد و کنترل پایداری&quot; با برنامه ریزی و حضور نمایندگان شرکت مدیریت منابع آب ایران، نماینده معاونت برنامه ریزی و رییس گروه آموزش سازمان و اعضای کارگروه صلاحیت حرفه ای سازمان توسط مجتمع عالی آموزشی و پژوهشی آب و برق خوزستان در محل شرکت های مذکور برگزار گردید.</p>
<p dir="RTL" style="margin-right: -8.5pt; text-align: justify;">
	این ارزیابی که در روزهای 20 الی 22 اسفند سال جاری برگزار گردید در مجموع382 نفر از شاغلین فنی و تخصصی شرکت های مذکور حضور داشتند.</p>
<p dir="RTL" style="margin-right: -8.5pt; text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 1005px">
	<tbody>
		<tr>
			<td style="text-align: center; width: 500px;">
				<img alt="" src="wp-content/uploads/news-images/image_93.jpeg" /></td>
			<td style="text-align: center; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; width: 500px;">
				<img alt="" src="wp-content/uploads/news-images/image_94.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_95.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_96.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_97.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_98.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_99.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_100.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_101.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_102.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_103.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_104.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_105.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_106.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_107.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_108.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '55202salahiyatnews.jpg', 364, '1401/12/27', '10:49:07 AM', 1401, 'اسفند', 12, '27');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (56201, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'مجتمع در آیینه رمضان', '<p style="text-align: justify;">
	<span dir="RTL">شروع سال کاری 1402 و همزمانی با ماه روزه داری و خودسازی و همگامی بهار طبیعت با بهار قرآن ، فصل پر طراوت کار فرهنگی را در مجتمع به ارمغان آورد.</span></p>
', '<p dir="RTL">
	شروع سال کاری 1402 و همزمانی با ماه روزه داری و خودسازی و همگامی بهار طبیعت با بهار قرآن ، فصل پر طراوت کار فرهنگی را در مجتمع به ارمغان آورد که از جمله آنهاست:</p>
<p dir="RTL">
	1-انتشار الکترونیک (آلاء) ویژه نامه ماه مبارک رمضان در 30 شماره با عناوین : الف)&nbsp; علاج پرو پاگاندا&nbsp; &quot; تبیین &quot; است. ب- تفسیر 30 آیه از 30 جزء قرآن کریم&nbsp; ج-خوش اخلاقی (بیان نکات اخلاقی در کنار پاسخ به سؤالات مربوط به احکام روزه داری) د)مسابقه قرآنی&nbsp; (30 سؤال از 30 جزء قران&nbsp; به همراه 30 سؤال از متن&nbsp; 30 شماره ویژه نامه)و.....</p>
<p dir="RTL">
	2- جلسه ختم قرآن کریم &nbsp;با حضور همکاران ( قرائت 30 جزء قرآن )</p>
<p dir="RTL">
	3- احیای شب 27 ماه مبارک رمضان همراه با صرف سحری&nbsp;</p>
<p dir="RTL">
	4-سخنرانی امام جماعت مجتمع بین نماز ظهر و عصر&nbsp;</p>
<p dir="RTL">
	5- توزیع ارزاق رمضان بین همکاران ، به مناسبت میلاد کریم اهل بیت حضرت امام مجتبی (ع)</p>
<p>
	<span dir="RTL">6-شرکت اساتید ، دانشجویان&nbsp; و همکاران مجتمع در راهپیمایی عظیم روز قدس</span></p>
<p style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_109.jpeg" /></p>
<p style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_110.jpeg" /></p>
<p style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_111.jpeg" /></p>
<p style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_112.jpeg" /></p>
', '56201Start1402.jpg', 264, '1402/2/19', '12:52:54 PM', 1402, 'اردیبهشت', 2, '19');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (56202, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری اردوی راهیان نور', '<p dir="RTL" style="text-align: justify;">
	اردوی راهیان نور به مقصد مناطق عملیاتی غرب کشور به اهتمام بسیج کارکنان سازمان آب و بق خوزستان و همکاری بسیج مجتمع برگزار شد.</p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	اردوی راهیان نور به مقصد مناطق عملیاتی غرب کشور به اهتمام بسیج کارکنان سازمان آب و بق خوزستان و همکاری بسیج مجتمع برگزار شد. در این اردوی چها روزه که در منطقه &quot;بازی دراز &quot; انجام شد، مسئول سمعی و بصری مجتمع ،پوشش صوتی و تصویری کاروان را برعهده داشتند.</p>
<p>
	&nbsp;</p>', '56202Rahian.jpg', 135, '1402/2/19', '1:04:34 PM', 1402, 'اردیبهشت', 2, '19');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (57201, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری کارگاه تخصصی و آموزشی بازرسان', '<p dir="RTL" style="text-align: justify;">
	&nbsp;به اهتمام گروه آموزش های عمومی مجتمع کارگاه تخصصی و آموزشی بازرسان ماده 91 و 92 قانون مدیریت خدمات کشوری برگزار&nbsp; شد.</p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	عبدالرسول فلاح زاده، مسئول راهبری واحدهای بازرسی دستگاههای اجرایی در سازمان اداری و استخدامی کشور و مدرس کارگاه تخصصی و آموزشی بازرسان ماده 91 و 92 قانون مدیریت خدمات &nbsp;با بیان اینکه دستگاه های اجرایی موظفند علاوه بر نظارت مستقیم مدیران از طریق انجام بازرسی های مستمر داخلی توسط بازرسان معتمد و متخصص در اجرای این ماده نظارت مستقیم نمایند افزود: چنانچه تخلف هریک از کارمندان مستند به گزارش حداقل یک بازرس معتمد به تایید مدیر مربوطه برسد، بالاترین مقام دستگاه اجرایی یا مقامات و مدیران مجاز، می توانند دستور اعمال کسر یک سوم از حقوق، مزایا و عناوین مشابه و یا انفصال از خدمات دولتی برای مدت یکماه تا یکسال را برای فرد متخلف صادر نمایند<span dir="LTR">.</span>وی ادامه داد: درصورت تکرار این تخلف به استناد گزارش هایی که به تائید بازرس معتمد و مدیر مربوطه برسد پرونده فرد خاطی به هیئت های رسیدگی به تخلفات اداری ارجاع و یکی از مجازات های بازخرید، اخراج و انفصال دائم از خدمات دولتی اعمال خواهد شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	مسئول راهبری واحدهای بازرسی دستگاههای اجرایی در سازمان اداری و استخدامی کشور با بیان اینکه دستگاه های اجرایی موظف است اسامی افراد حقیقی و حقوقی رشوه دهنده به کارمندان دستگاه های اجرایی را جهت ممنوعیت عقد قرارداد به کلیه دستگاه های اجرایی اعلام نماید افزود: سازمان موظف است اسامی افراد حقیقی و حقوقی رشوه دهنده به کارمندان دستگاه های اجرایی را جهت ممنوعیت عقد قرارداد به کلیه دستگاه های اجرایی اعلام نماید<span dir="LTR">.</span> وی در خصوص ماده 92 قانون مدیریت خدمات کشوری تصریح کرد: مدیران و سرپرستان بلافصل، مسئول نظارت و کنترل و حفظ روابط سالم کارمندان خود در انجام وظایف محوله می باشند و در مورد عملکرد آنان باید پاسخگو باشند<span dir="LTR">.</span> مدرس کارگاه تخصصی و آموزشی بازرسان ماده 91 و 92 قانون مدیریت خدمات کشوری افزود: در صورتی که کارمندان مزبور با اقدامات خود موجب ضرر و زیان دولت گردند و یا تخلفاتی نظیر رشوه و یا سوء استفاده در حیطه مدیریت مسئولان مزبور مشاهده و اثبات گردد، علاوه بر برخورد با کارمندان خاطی با مدیران و سرپرستان کارمندان (حسب مورد) نیزکه در کشف تخلف یا جرایم اهمال نموده باشند مطابق قوانین مربوط، با آنان رفتار خواهد شد.</p>
<p>
	&nbsp;</p>', '56205News4.jpg', 126, '1402/2/23', '9:40:20 AM', 1402, 'اردیبهشت', 2, '23');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (57202, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'بازدید معاون وزارت نیرو از مجتمع', '<p dir="RTL" style="text-align: justify;">
	&nbsp;معاونت سرمایه انسانی ، تحقیقات&nbsp; و فن آوری اطلاعات وزارت نیرو از&nbsp; بخش های مختلف مجتمع بازدید کردند.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	معاونت سرمایه انسانی ، تحقیقات&nbsp; و فن آوری اطلاعات وزارت نیرو از&nbsp; بخش های مختلف مجتمع بازدید کردند.</p>
<p dir="RTL" style="text-align: justify;">
	خانم کارگر نجفی در پایان دیدار و در جلسه با هیئت امنا ی مجتمع و مدیرا ن آموزش شرکت ها در خصو ص ارتقای کیفیت آموزش بر&nbsp; چند نکته تاکید داشتند:</p>
<p dir="RTL" style="text-align: justify;">
	1- در حوزه انرژی های تجدید پذیر دوره های آموزشی تعریف شود.</p>
<p dir="RTL" style="text-align: justify;">
	2- مجتمع های آموزشی&nbsp; وزارت نیرو &nbsp;در پذیرش&nbsp; کار آموز از استان های دیگر کشور با یکدیگر تعامل داشته باشند(زیرا تغییر محل آموزش می تواند بهروری آموزش را ارتقا دهد)</p>
<p dir="RTL" style="text-align: justify;">
	3-دوره های آموزشی براساس نیاز های جدید تدوین شود.</p>
<p dir="RTL" style="text-align: justify;">
	4- تمرکز فعالیت &nbsp;مجتمع های آموزشی بر تربیت نیروهای متخصص باشد.</p>
<p dir="RTL" style="text-align: justify;">
	5- باید فضای محل آموزش برای متعلمین جاذبه داشته باشدو فضای آموزشی متفاوت از فضای اداری باشد.</p>
<p dir="RTL" style="text-align: justify;">
	6- امکانات و تجهیزات مجتمع خوزستان &nbsp;در آموزش های تخصصی، بیشتر از قبل مورد استفاده واقع شود.</p>
<p dir="RTL" style="text-align: justify;">
	7- با توجه به&nbsp; معدل سنوات خدمتی در مجتمع خوزستان ( که 23 سال می باشد) در کنار تجربه نیروهای موجود از ظرفیت نشاط و شادابی نیروهای جوان نیز بهره گرفته شود.</p>
', '57202Bazdid.jpg', 328, '1402/2/23', '9:51:30 AM', 1402, 'اردیبهشت', 2, '23');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (57203, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'پذیرش دانشجو بدون کنکور', '<p dir="RTL" style="text-align: justify;">
	مرکز آموزش علمی - کاربردی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برای مهر ماه سال 1402 بدون کنکور دانشجو می پذیرد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	مرکز آموزش علمی - کاربردی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، مهر ماه سال 1402 با ظرفیت 13 رشته تحصیلی در <strong>مقاطع کاردانی و کارشناسی ناپیوسته،</strong> <strong>بدون کنکور</strong> دانشجو می پذیرد. علاقمندان می توانند جهت کسب اطلاعات بیشتر با شماره های <span dir="LTR">06133340070</span> و 09378535157 تماس حاصل نموده و یا به آدرس : اهواز &ndash; بلوار گلستان &ndash; بین خیابان کاشان و همدان &ndash; رو به روی هتل نیشکر مراجعه نمایند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="color:#ff0099;"><strong><span style="font-size:14px;">ثبت نام رشته های کارشناسی: ۲۸ خرداد لغایت ۴ تیر<br />
	ثبت نام رشته های کاردانی: ۱۸ تیر لغایت ۲۵ تیر</span></strong></span></p>
<p dir="RTL" style="text-align: justify;">
	<strong><span style="color:#800080;"><u>نحوه ثبت نام:</u><br />
	به صورت حضوری (بلوار گلستان بین خیابان کاشان و همدان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان) و یا از طریق سایت سازمان سنجش به نشانی: (www.sanjesh.org)</span></strong></p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL">
	<span style="font-size:16px;"><span style="color:#ff8c00;"><u><strong>رشته های کارشناسی:</strong></u></span></span><br />
	<br />
	✅مهندسی فناوری ایمنی، سلامت و محیط زیست(HSE)<br />
	✅ مهندسی فناوری شبکه های توزیع برق<br />
	✅ مهندسی فناوری بهره برداری نیروگاه<br />
	✅ مهندسی فناوری اطلاعات<br />
	✅ مهندسی فناوری عمران آب و فاضلاب<br />
	✅ کارشناسی حرفه ای حسابداری مالی<br />
	<br />
	<span style="font-size:16px;"><span style="color:#ffa500;"><u><strong>رشته های کاردانی:</strong></u></span></span><br />
	<br />
	✅ کاردانی فنی ایمنی کار و حفاظت فنی<br />
	✅ کاردانی فنی برق-توزیع<br />
	✅ کاردانی فنی ابزار دقیق<br />
	✅ کاردانی فنی فناوری اطلاعات-اینترنت و شبکه های گسترده<br />
	✅ کاردانی حرفه ای مدیریت کسب و کار<br />
	✅ کاردانی حرفه ای حسابداری بهای تمام شده<br />
	✅ کاردانی حرفه ای گردشگری</p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_113.jpeg" /></p>
<p>
	&nbsp;</p>
', '57203FreeKonkour.jpg', 901, '1402/3/20', '12:32:58 AM', 1402, 'خرداد', 3, '20');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (57204, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری سمینار جنبه های حقوقی و قراردادی پروژه های صنعتی', '<p dir="RTL" style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان کارگاه آموزشی و ارزیابی با عنوان &quot;جنبه های حقوقی و قراردادی پروژه های صنعتی&quot; را چهارشنبه مورخ 31 خرداد ماه 1402 برگزار می نماید.</p>
<p>
	&nbsp;</p>', '<p style="text-align: justify;">
	<span dir="RTL">کارگاه آموزشی و ارزیابی با عنوان &quot; جنبه های حقوقی و قراردادی پروژه های صنعتی &quot; ساعت 8 بامداد 31 خرداد ماه 1402 در آمفی تئاتر سازمان آب و برق خوزستان جهت همکاران سازمان آب و برق و ساعت 13 همان روز در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق جهت همکاران شرکت های طرف قرارداد سازمان برگزار خواهد شد. مهمترین اهداف این کارگاه بررسی کلی و ارزیابی مشکلات و چالشهای قراردادی و حقوقی سازمان و شرکت ها می باشد و با توجه به مسائل و مشکلاتی که شرکت کنندگان در کارگاه مطرح می نمایند، موضوع و سرفصل کارگاههای بعدی تعریف خواهد گردید. </span></p>
<p style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_114.jpeg" /></p>', '57204Seminar.jpg', 399, '1402/3/24', '3:07:33 PM', 1402, 'خرداد', 3, '24');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (57205, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'مشاهده اطلاعات محل آزمون های پایان ترم  دانشجویان', '<p>
	دانشجوی گرامی<br />
	با سلام<br />
	جهت مشاهده اطلاعات محل آزمون پایان ترم&nbsp; (شماره کلاس -شماره صندلی) از طریق لینک زیر اقدام نمایید:</p>
<p style="text-align: center;">
	<a href="https://kwphc.ir/ExamProgram.aspx">مشاهده اطلاعات محل آزمون های پایان ترم (شماره کلاس - شماره صندلی)</a></p>', '<p>
	دانشجوی گرامی<br />
	جهت مشاهده اطلاعات محل آزمون پایان ترم&nbsp; (شماره کلاس -شماره صندلی) از طریق لینک زیر اقدام نمایید:</p>
<p style="text-align: center;">
	<a href="https://kwphc.ir/ExamProgram.aspx">مشاهده اطلاعات محل آزمون های پایان ترم (شماره کلاس - شماره صندلی)</a></p>', '57205Azmoon1.jpg', 810, '1402/3/24', '3:44:53 PM', 1402, 'خرداد', 3, '24');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (57206, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'قابل توجه کارکنان صنعت آب و برق خوزستان', '<p dir="RTL">
	با سلام و احترام</p>
<p dir="RTL">
	جهت پیش ثبت نام دوره های آموزشی اوقات فراغت (فرزندان 7 تا 18 سال) از طریق لینک ذیل اقدام نمایید:</p>
<p dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<a href="https://kwphc.ir/summertime"><span style="font-size:14px;"><span style="color:#800080;">لینک ثبت نام</span></span></a></p>
<p>
	&nbsp;</p>
', '<p dir="RTL">
	با سلام و احترام</p>
<p dir="RTL">
	جهت پیش ثبت نام دوره های آموزشی اوقات فراغت (فرزندان 7 تا 18 سال) از طریق لینک ذیل اقدام نمایید:</p>
<p align="center" dir="RTL">
	<strong><span style="font-size:16px;"><a href="http://kwphc.ir/summertime"><span style="color:#800080;">لینک ثبت نام</span></a></span></strong></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<img alt="" src="wp-content/uploads/news-images/image_115.jpeg" /></p>
<p>
	&nbsp;</p>
', '57206Oqat.jpg', 1309, '1402/4/5', '4:24:33 PM', 1402, 'تیر', 4, '5');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (58205, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'اوقات فراغت تابستانه ویژه صنعت آب و برق خوزستان', '<p dir="RTL">
	فرزندان خانواده صنعت آب و برق خوزستان این تابستان مهمان مجتمع عالی آموزشی هستند.</p>
<p>
	&nbsp;</p>', '<p dir="RTL">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در قالب تفاهم نامه همکاری با دفتر امور فرهنگی و دینی سازمان آب و برق خوزستان اقدام به برگزاری دوره های آموزشی &ndash; مهارتی و ورزشی فرزندان صنعت آب وبرق خوزستان تابستانه نمود.</p>
<p dir="RTL">
	دوره های اوقات فراغت در سه بخش آموزشی، مهارتی و فرهنگی در فضای آموزشی مجتمع &nbsp;و ورزشی در مجموعه ورزشی بوستان خواهد بود، که با تفکیک جنسیت و به صورت مجزا در 4 رده سنی 7 تا 18 سال برنامه ریزی شد.</p>
<p dir="RTL">
	این دوره ها طبق نظر سنجی های به عمل آمده در رشته های حفظ موضوعی قرآن، نقاشی، فن بیان و مهارت ارتباطی، خوشنویسی با خودکار، تقویت اعتماد به نفس، آموزش پیش رانندگی، طراحی و آموزش کار با پهپاد و در رشته های ورزشی: فوتسال ، والیبال ، بسکتبال و آموزش شنا است.</p>
<p dir="RTL">
	مجتمع آموزشی به منظور تسهیل در تردد و راحتی شرکت کنندگان در این دوره ها با هماهنگی سازمان آب و برق خوزستان با یک شرکت معتبرجهت رفت و آمد، قراردادی منعقد نمود تا امکان رفت و آمد از درب منز تا محل برگزاری دوره ها فراهم شود.</p>
<p dir="RTL">
	طبق آمار اعلامی حدود 320نفر دختر و 310نفر پسر در برنامه ثبت نام کرده اند.</p>
<p dir="RTL">
	دکتر مهدی هودگر رئیس مجتمع آموزشی در این باره اشاره نمود: برنامه اوقات فراغت تابستانه فرزندان وزارت نیرو بحمداله شروع خوبی داشت ، این اولین سال اجرای چنین برنامه هایی در مجتمع آموزشی بود، اما با این وجود همکاران توانستند در کمترین زمان مشکلات پیش آمده را با هماهنگی های اولیه در حوزه برگزاری و تدارکات دوره ها مرتفع کنند.</p>
<p dir="RTL">
	دکتر هودگر ضمن قدر دانی از پرسنل مجتمع آموزشی افزود: قطعا اجرای با کیفیت و رضایت بخش را به تنهایی نمیتوانیم به دست بیاوریم و من از این طریق از خدمات و زحمات کلیه همکاران صنعت آب و برق خوزستان بالاخص مدیر عامل محترم سازمان آب و برق خوزستان جناب آقای مهندس صدریان فر که در این راستا نظرات کارشناسی و ارزشمندی ارائه نمودند و همکاری ویژه ای داشتند، سپاسگزارم.</p>
<p dir="RTL">
	وی همچنین از همکاران خدوم خدمات سازمان و مدیر عامل محترم شرکت ساب خوزستان جناب آقای مهندس یگانه و کادر زحمتکش و انقلابی امور فرهنگی و دینی سازمان آب و برق خوزستان نیز صمیمانه تشکر نمود.</p>
<p dir="RTL">
	ایشان در ادامه ضمن قدردانی از خانواده هایی که در برگزاری این پروژه همکاری و همیاری داشتند، تاکید کرد: مجموعه مدیران و پرسنل اجرایی برنامه اوقات فراغت فرزندان، برای شنیدن دیدگاه ها و نقد های دلسوزانه شما آماده است.</p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL">
	<img alt="" src="wp-content/uploads/news-images/image_116.jpeg" /><img alt="" src="wp-content/uploads/news-images/image_117.jpeg" /><img alt="" src="wp-content/uploads/news-images/image_118.jpeg" /><img alt="" src="wp-content/uploads/news-images/image_119.jpeg" /><img alt="" src="wp-content/uploads/news-images/image_120.jpeg" /></p>
<p>
	&nbsp;</p>', '572072.jpg', 673, '1402/4/31', '11:37:40 AM', 1402, 'تیر', 4, '31');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (58206, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'پذیرش دانشجو بدون کنکور', '<p dir="RTL">
	به اطلاع متقاضیان ثبت&zwnj; نام در پذیرش دوره های کاردانی و کارشناسی ناپیوسته می رساند،&nbsp;زمان ثبت &zwnj;نام در دوره های کاردانی از روز سه&zwnj;شنبه 7 شهریور لغایت دوشنبه 20 شهریور و ثبت&zwnj; نام در دوره های کارشناسی ناپیوسته از روز یکشنبه 5 شهریور لغایت دوشنبه مورخ 20 شهریورمی باشد<span dir="LTR">.</span><br />
	لذا داوطلبان واجد شرایط می&zwnj;توانند در مهلت مقرر برای ثبت نام از طریق درگاه اطلاع&zwnj;رسانی سازمان سنجش کشور به نشانی:<span dir="LTR"> www.sanjesh.org </span>اقدام نمایند<span dir="LTR">.</span></p>
<p style="text-align: justify;">
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	مرکز آموزش علمی - کاربردی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، مهر ماه سال 1402 با ظرفیت 13 رشته تحصیلی در <strong>مقاطع کاردانی و کارشناسی ناپیوسته،</strong> <strong>بدون کنکور</strong> دانشجو می پذیرد. علاقمندان می توانند جهت کسب اطلاعات بیشتر با شماره های <span dir="LTR">06133340070</span> و 06133340013&nbsp; تماس حاصل نموده و یا به آدرس : اهواز &ndash; بلوار گلستان &ndash; بین خیابان کاشان و همدان &ndash; رو به روی هتل نیشکر مراجعه نمایند</p>
<p dir="RTL" style="text-align: justify;">
	<span dir="LTR">.</span></p>
<p dir="RTL">
	<span style="font-size:16px;"><span style="color:#ff8c00;"><u><strong>رشته های کارشناسی:</strong></u></span></span><br />
	<br />
	✅مهندسی فناوری ایمنی، سلامت و محیط زیست(HSE) - <span style="color:#b22222;">کد رشته: 20610</span><br />
	✅ مهندسی فناوری شبکه های توزیع برق - <span style="color:#b22222;">کد رشته: 20100</span><br />
	✅ مهندسی فناوری بهره برداری نیروگاه - <span style="color:#b22222;">کد رشته: 20180</span><br />
	✅ مهندسی فناوری اطلاعات - <span style="color:#b22222;">کد رشته: 20381</span><br />
	✅ مهندسی فناوری عمران آب و فاضلاب - <span style="color:#b22222;">کد رشته: 20463</span><br />
	✅ کارشناسی حرفه ای حسابداری مالی - <span style="color:#b22222;">کد رشته: 20825</span><br />
	<br />
	<span style="font-size:16px;"><span style="color:#ffa500;"><u><strong>رشته های کاردانی:</strong></u></span></span><br />
	<br />
	✅ کاردانی فنی ایمنی کار و حفاظت فنی - <span style="color:#b22222;">کد رشته: 10704</span><br />
	✅ کاردانی فنی برق-توزیع - <span style="color:#b22222;">کد رشته: 10144</span><br />
	✅ کاردانی فنی ابزار دقیق - <span style="color:#b22222;">کد رشته: 10195</span><br />
	✅ کاردانی فنی فناوری اطلاعات-اینترنت و شبکه های گسترده - <span style="color:#b22222;">کد رشته: 10497</span><br />
	✅ کاردانی حرفه ای مدیریت کسب و کار - <span style="color:#b22222;">کد رشته: 11857</span><br />
	✅ کاردانی حرفه ای حسابداری بهای تمام شده - <span style="color:#b22222;">کد رشته: 11705</span><br />
	✅ کاردانی حرفه ای گردشگری - <span style="color:#b22222;">کد رشته: 12462</span></p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:16px;"><span style="color:#ff0099;"><strong>ثبت نام رشته های کارشناسی ناپیوسته: 5 لغایت 20 شهریور</strong></span></span></p>
<p dir="RTL" style="text-align: center;">
	<strong><span style="font-size:16px;"><a href="https://kwphc.ir/Archive/Other/Karshenasi140205.pdf" target="_blank"><span style="color:#6666ff;">دریافت دفترچه کارشناسی ناپیوسته</span></a></span></strong></p>
<p dir="RTL" style="text-align: center;">
	<a href="https://register1.sanjesh.org/RegJameKarshenasi140203" target="_blank"><span style="color:#6666ff;"><span style="font-size:16px;"><strong>لینک ثبت نام رشته های کارشناسی ناپیوسته</strong></span></span></a></p>
<p dir="RTL">
	<span style="font-size:16px;"><span style="color:#ff0099;"><strong>ثبت نام رشته های کاردانی: 7 لغایت 20 شهریور</strong></span></span></p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir\Archive\Other\Kardani140205.pdf" target="_blank"><span style="color:#6666ff;"><strong><span style="font-size:16px;">دریافت دفترچه کاردانی</span></strong></span></a></p>
<p dir="RTL" style="text-align: center;">
	<a href="https://register2.sanjesh.org/Noetkardani_jame_Registration140203/" target="_blank"><span style="color:#6666ff;"><span style="font-size:16px;"><strong>لینک ثبت نام رشته های کاردانی</strong></span></span></a></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:16px;"><span style="color:#ff0099;"><strong>نحوه ثبت نام :</strong></span></span><br />
	<span style="font-size:16px;"><strong><span style="color:#800080;">به صورت حضوری (بلوار گلستان بین خیابان کاشان و همدان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان) و یا از طریق سایت سازمان سنجش به نشانی: (www.sanjesh.org)</span></strong></span></p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_121.jpeg" /></p>
', '58206FreeKonkour.jpg', 2536, '1402/6/3', '10:03:11 AM', 1402, 'شهریور', 6, '3');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (58208, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'اعلام نتایج آزمون', '<p dir="RTL" style="margin-right: 1.7pt; text-align: justify;">
	<strong>قابل توجه داوطلبان محترم آزمون جذب نيرو در قالب قرارداد تامين نيروي انساني مورخ 20 مردادماه 1402</strong> <strong>به اطلاع مي رساند</strong><strong><span dir="LTR">:</span></strong></p>
<p dir="RTL" style="margin-right: 1.7pt; text-align: justify;">
	&nbsp;<strong>نتيجه آزمون ياد شده روز چهارشنبه مورخ 5 مهرماه 1402 راس ساعت 8 صبح در وبگاه مجتــمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به نشاني: </strong><a href="https://estekhdam.kwphc.ir/azmoon140205" target="_blank">https://estekhdam.kwphc.ir/azmoon140205</a><strong> اعلام می&shy;گردد. </strong></p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="margin-right: 1.7pt; text-align: justify;">
	<span style="color:#003366;"><strong>قابل توجه داوطلبان محترم آزمون جذب نيرو در قالب قرارداد تامين نيروي انساني مورخ 20 مردادماه 1402</strong> <strong>به اطلاع مي رساند</strong><strong><span dir="LTR">:</span></strong></span></p>
<p dir="RTL" style="margin-right: 1.7pt; text-align: justify;">
	<span style="color:#003366;">&nbsp;<strong>نتيجه آزمون ياد شده روز چهارشنبه مورخ 5 مهرماه 1402 راس ساعت 8 صبح در وبگاه مجتــمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به نشاني : </strong></span><a href="https://estekhdam.kwphc.ir/azmoon140205" target="_blank"><span style="color:#003366;">https://estekhdam.kwphc.ir/azmoon140205</span></a><span style="color:#003366;"><strong> اعلام می&shy;گردد. </strong></span></p>
<p dir="RTL" style="margin-right: 1.7pt; text-align: justify;">
	<span style="color:#003366;"><strong>ضمن تبريک و آرزوي موفقيت براي پذيرفته شدگان در آزمون کتبي، مقتضي است اصل و تصوير سوابق و مستندات ( طبق مفاد آگهي) جهت بررسي، تشکيل پرونده اوليه و انجام مصاحبه</strong><strong>،</strong><strong> <u>مطابق برنامه زماني به شرح جدول ذيل</u>، به آدرس اهواز </strong><strong>_</strong><strong> بلوار گلستان </strong><strong>_</strong><strong> بين خيابان همدان و کاشان ( روبروي هتل نيشکر) مجتــمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان مراجعه و ارائه نمايند.</strong></span></p>
<p dir="RTL" style="margin-right: 1.7pt; text-align: justify;">
	<span style="color:#003366;"><strong>بديهي است عدم ارائه &nbsp;سوابق موردنظر در بازه زماني ياد شده توسط پذيرفته شدگان به منزله انصراف تلقي خواهد شد و از نامبردگان در آزمون دانش مهارت ( مصاحبه ) دعوت به عمل نخواهد آمد. </strong></span></p>
<p dir="RTL" style="margin-right: 1.7pt; text-align: center;">
	&nbsp;</p>
<table align="center" border="1" cellpadding="0" cellspacing="0" dir="rtl" style="width: 100%">
	<tbody>
		<tr>
			<td style="width:47px;">
				<p align="center" dir="RTL">
					<span style="color:#003366;">رديف</span></p>
			</td>
			<td style="width:94px;">
				<p align="center" dir="RTL">
					<span style="color:#003366;">نام شهرستان</span></p>
			</td>
			<td style="width:236px;">
				<p align="center" dir="RTL">
					<span style="color:#003366;">تاريخ&nbsp; و زمان ارائه سوابق</span></p>
			</td>
			<td style="width:292px;">
				<p align="center" dir="RTL">
					<span style="color:#003366;">مستندات مورد نياز</span></p>
			</td>
		</tr>
		<tr>
			<td style="width:47px;height:44px;">
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>1</strong></span></p>
			</td>
			<td style="width: 94px; height: 44px; text-align: center; vertical-align: middle;">
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>انديمشک</strong></span></p>
			</td>
			<td rowspan="2" style="width:236px;height:44px;">
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>روز شنبه مورخ 15/07/1402 لغايت&nbsp; </strong></span></p>
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>روز دوشنبه مورخ 17/07/1402</strong></span></p>
			</td>
			<td rowspan="4" style="width:292px;height:44px;">
				<p dir="RTL">
					<span style="color:#003366;"><strong>اصل و تصوير برابر با اصل مدارک:</strong></span></p>
				<p dir="RTL">
					<span style="color:#003366;"><strong>1) تحصيلي</strong></span></p>
				<p dir="RTL">
					<span style="color:#003366;"><strong>2) مدارک سجلي( شناسنامه ، کارت ملي ،مدرک نظام وظيفه و </strong><strong><span dir="LTR">....</span></strong><strong> )</strong></span></p>
				<p dir="RTL">
					<span style="color:#003366;"><strong>3) گواهي سابقه کار مرتبط همراه با سوابق پرداخت بيمه</strong></span></p>
				<p dir="RTL">
					<span style="color:#003366;"><strong>4) ساير سوابق مفاد آگهي مانند : سوابق مربوط به فرزندان خانواده هاي شهدا ، بومي بودن و ....</strong></span></p>
			</td>
		</tr>
		<tr>
			<td style="width:47px;height:47px;">
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>2</strong></span></p>
			</td>
			<td style="width: 94px; height: 44px; text-align: center; vertical-align: middle;">
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>دزفول</strong></span></p>
			</td>
		</tr>
		<tr>
			<td style="width:47px;height:47px;">
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>3</strong></span></p>
			</td>
			<td style="width: 94px; height: 44px; text-align: center; vertical-align: middle;">
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>ايذه</strong></span></p>
			</td>
			<td rowspan="2" style="width:236px;height:47px;">
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>روز سه شنبه مورخ 18/07/1402 لغايت&nbsp; </strong></span></p>
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>روز پنجشنبه مورخ 20/07/1402</strong></span></p>
			</td>
		</tr>
		<tr>
			<td style="width:47px;height:46px;">
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>4</strong></span></p>
			</td>
			<td style="width: 94px; height: 44px; text-align: center; vertical-align: middle;">
				<p align="center" dir="RTL">
					<span style="color:#003366;"><strong>مسجدسليمان</strong></span></p>
			</td>
		</tr>
	</tbody>
</table>
<div style="clear:both;">
	&nbsp;</div>
<div style="clear:both;">
	<span style="color:#003366;"><strong><span dir="RTL">&nbsp;پذيرفته شدگان در صورت هرگونه سوال مي توانند از طريق شماره تلفن : 33347248-061&nbsp; تماس حاصل نمايند.</span></strong></span></div>
<p>
	&nbsp;</p>
', '58207ENatayej.jpg', 6103, '1402/7/4', '5:53:55 PM', 1402, 'مهر', 7, '4');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (58209, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری رویداد اقتصاد دیجیتال', '<p dir="RTL" style="text-align: justify;">
	پارک علم و فناوری استان با معاونت هماهنگی امور اقتصادی استانداری اقدام به برگزاری رویدادی با عنوان تویعه اقتصاد دیجیتال در محورهای انرژی، بهداشت و درمان، نیازهای شهری و بازار نموده است.</p>
<p>
	&nbsp;</p>', '<p dir="RTL">
	<span style="color:#000066;">پارک علم و فناوری استان با معاونت هماهنگی امور اقتصادی استانداری اقدام به برگزاری رویدادی با عنوان تویعه اقتصاد دیجیتال در محورهای ذیل نموده است.</span></p>
<ul dir="rtl">
	<li>
		<span style="color:#000066;">انرژی</span></li>
	<li>
		<span style="color:#000066;">&nbsp;بهداشت و درمان</span></li>
	<li>
		<span style="color:#000066;">نیازهای شهری</span></li>
	<li>
		<span style="color:#000066;">بازار</span></li>
</ul>
<p dir="RTL">
	<span style="color:#000066;">از دانشجویان، مدرسان، دانش آموختگان، کارشناسان و محققان دعوت به عمل می آید با ثبت ایده های خلاقانه خود در این رویداد بزرگ شرکت نمایند.</span></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<a href="https://www.itapf.ir" target="_blank"><span style="color:#ff3399;"><span style="font-size:16px;">سامانه ثبت ایده</span></span></a></p>
<p align="center" dir="RTL">
	&nbsp;</p>
<p align="center" dir="RTL">
	<img alt="" src="wp-content/uploads/news-images/image_122.jpeg" /></p>
<p>
	&nbsp;</p>', '58209ITAP.jpg', 301, '1402/7/15', '6:34:14 PM', 1402, 'مهر', 7, '15');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (58210, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'اعلام نتیجه دوره كاردانی فنی و دوره كاردانی حرفه‌ای', '<p style="text-align: justify;">
	با عنایت به اعلام نتایج ثبت نام دوره مقطع کاردانی فنی و دوره کاردانی حرفه ای نظام آموزشی مهارتی دانشگاه جامع علمی کاربردی، به اطلاع می رساند داوطلبانی که ثبت نام خود را در سایت سنجش آموزش کشور انجام داده اند می توانند از طریق لینک ذیل از قبولی خود مطلع گردند :</p>
<p style="text-align: center;">
	<a href="https://result2.sanjesh.org/RSJame/JameKardani140207" target="_blank"><span style="font-size:16px;"><span style="color:#4b0082;">مشاهده و چاپ نتیجه</span></span></a></p>
<p style="text-align: justify;">
	&nbsp;</p>
', '<p style="text-align: justify;">
	ضمن تبریک به پذیرفته&zwnj;شدگان، می&zwnj;بایست جهت اطلاع از تاریخ دقیق ثبت&zwnj;نام و انتخاب واحد در روز شنبه ۲۲ مهرماه سال جاری به اطلاعیه مندرج در درگاه اطلاع رسانی دانشگاه به نشانی www.uast.ac.ir مراجعه گردد.<br />
	<br />
	پذیرفته&zwnj;شدگان لازم است در بازه زمانی مندرج در سامانه هم&zwnj;آوا به نشانی edu.uast.ac.ir، اقدام به بارگذاری مدارک اعلام شده زیر در سامانه کنند و سپس جهت تکمیل فرآیند ثبت&zwnj;نام و انتخاب واحد با در دست داشتن اصل مدارک مذکور، به نشانی مرکز آموزشی محل قبولی (اهواز، بلوار گلستان، بین خیابان کاشان و همدان، مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان) مراجعه نمایند.<br />
	<br />
	مدارک لازم برای ثبت&zwnj;نام:<br />
	<br />
	۱- شش قطعه عکس پرسنلی پشت سفید تمام رخ ۴&times;۳ پشت نویسی شده سال جاری.<br />
	۲- دو نسخه تصویر تمام صفحات شناسنامه و اصل آن برای مطابقت.<br />
	۳- دو نسخه تصویر کارت ملی و اصل آن برای مطابقت.<br />
	۴- اصل گواهینامه پایان تحصیلات متوسطه (دیپلم سه ساله نظام جدید ۳-۳-۶ یا نظام ترمی/سالی واحدی شامل نظری، فنی و حرفه&zwnj;ای، &zwnj;کاردانش یا دیپلم نظام قدیم آموزش متوسطه شامل دوره چهارساله یا شش ساله نظری و فنی و حرفه&zwnj;ای) با مهر و امضای رئیس اداره آموزش و پرورش منطقه محل تحصیل.<br />
	۵- اصل کاربرگ ۱۰۱ (گواهی اشتغال به کار) با امضاء و مهر بالاترین&zwnj; مقام&zwnj; مسئول، آخرین فیش حقوقی و آخرین حکم کارگزینی یا قرارداد معتبر انجام کار و برای شاغلین نیروهای مسلح ارایه حکم کارگزینی یا گواهی اشتغال به کار از یگان مربوط برای پذیرفته&zwnj;شدگان در کدرشته محل&zwnj;هایی که مطابق ضوابط مندرج در دفترچه منحصراً پذیرش از شاغلین صورت پذیرفته است.<br />
	۶- اصل کاربرگ شماره ۱۰۲ (فرم تایید معدل) برای پذیرفته&zwnj;شدگانی که گواهینامه پایان تحصیلات متوسطه برای آنان صادر نشده است و حداکثر تا تاریخ ۱۴۰۲/۰۳/۳۱ در مقطع متوسطه دانش&zwnj;آموخته شده&zwnj;اند.<br />
	۷- مدرکی که وضعیت نظام وظیفه برادران را با توجه به بخش مقررات وظیفه عمومی مندرج در دفترچه راهنمای پذیرش دوره&zwnj;های مذکور مشخص نماید و تهیه ۲ نسخه کپی از آن.<br />
	۸- ثبت نام در سامانه خدمات الکترونیک انتظامی (ePolice.ir) برای دانشجویانی که مجاز به استفاده از معافیت تحصیلی می باشند و تحویل تاییدیه ثبت نام در سامانه به صورت حضوری به اداره آموزش.<br />
	۹- درخواست الف) تاییدیه مدرک تحصیلی و ب) سوابق فارغ التحصیلی در سامانه https://emt.medu.ir و تحویل رسیدهای ثبت نام در سامانه به صورت حضوری به اداره آموزش.<br />
	۱۰- بارگذاری تمام مدارک هویتی و سوابق تحصیلی در سامانه https://edu.uast.ac.ir</p>
', '58210PicNews.jpg', 365, '1402/7/20', '2:37:27 PM', 1402, 'مهر', 7, '20');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59210, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'بهره برداری از مرکز رشد شهدای صنعت آب و برق خوزستان', '<p style="text-align: justify;">
	مرکز رشد شهدای صنعت آب و برق خوزستان&nbsp;صبح سه&zwnj;شنبه ۲۵ مهر سال&nbsp;جاری با حضور&nbsp;محمود معین&zwnj;پور، عضو هیئت رئیسه سپاه خوزستان، جمعی از مسئولان و مدیران سازمان آب و برق خوزستان و مراکز رشد و دانشگاه های استان خوزستان در سالن اجتماعات مجتمع عالی آموزشی و پژوهشی سازمان آب و برق برگزار شد.</p>', '<p style="text-align: justify;">
	مرکز رشد شهدای صنعت آب و برق خوزستان&nbsp;صبح سه&zwnj;شنبه ۲۵ مهر سال&nbsp;جاری با حضور&nbsp;محمود معین&zwnj;پور، عضو هیئت رئیسه سپاه خوزستان، جمعی از مسئولان و مدیران سازمان آب و برق خوزستان و مراکز رشد و دانشگاه های استان خوزستان در سالن اجتماعات مجتمع عالی آموزشی و پژوهشی سازمان آب و برق برگزار شد.</p>
<p style="text-align: justify;">
	معین پور با بیان اینکه این اقدام می&zwnj;تواند به توسعه علم و تحقیق کمک شایانی داشته باشد افزود: سازمان بسیج علم و پژوهش&zwnj;های فناوری با هدف ساماندهی نخبگان ایجاد و با کمک به ایجاد خودباوری تقویت بنیه علمی و بالا بردن انگیزه&zwnj;های علمی به فعالیت&zwnj;هایش ادامه می&zwnj;دهد.</p>
<p style="text-align: justify;">
	وی تصریح کرد: ما مراکز رشد را در سطح&zwnj;های کشوری و استانی برای پرورش ایده و طرح و اجرای آزمایش&zwnj;ها قرار دادیم .</p>
<p style="text-align: justify;">
	معین پور ابراز امیدواری کرد تا با استعانت از خداوند متعال این مرکز توانمند و تخصصی به یک مرکز موفق، شاخص و پیشرو در عرصه ملی تبدیل شود.</p>
<p style="text-align: justify;">
	&nbsp;مهدی هودگر،&nbsp;رئیس مرکز علمی کاربردی سازمان آب و برق، پس از ارائه گزارشی از این مرکز، با بیان اینکه یکی از حلقه&zwnj;هایی که میتواند دانش و پژوهش را تکمیل کند حوزه فناوری و تبدیل علم به محصول است تاکید کرد: این اتفاق در مراکز رشد روی می&zwnj;دهند.</p>
<p style="text-align: justify;">
	وی افزود: ظرفیت سازمان آب و برق خوزستان، شرکت&zwnj;های تحت پوشش آن و همچنین زیرساخت مجتمع عالی آموزشی و پژوهشی صنعت آب و برق، بستر مناسبی است تا بتوانیم پژوهش را به فناوری تبدیل کنیم.</p>
<p style="text-align: justify;">
	وی ادامه داد: برای این کار هم به زیرساخت&zwnj;های فیزیکی و هم به پشتیبانی&zwnj;های مالی نیاز داریم بنابراین تفاهم نامه&zwnj;ای با سازمان علمی و پژوهشی سپاه حضرت ولی عصر عجل الله منعقد شد که در این فرایند بحث پشتیبانی مالی و سرمایه&zwnj;گذاری روی طرح&zwnj;ها از طریق بودجه سازمان علمی و پژوهشی سپاه انجام شود و زیرساخت&zwnj;های فنی و کاربردی مرکز رشد از فضای فیزیکی و امکانات مجتمع عالی آموزشی و پژوهشی سازمان فراهم خواهد شد که این دو بال باعث خواهند شد تا بتوانیم به دانشورانی که در صنعت آب و برق توانایی تولید محصولات دانش محور را دارند خدمات رسانی کرده و ایده&zwnj;ها و محصولات اولیه آنها را تبدیل به محصول قابل ارائه در بازار کنیم.</p>
<p style="text-align: justify;">
	در پایان مدعوین پس از افتتاح مرکز رشد شهدای صنعت آب و برق از قسمت های مختلف آن بازدید و با متولیان آن گفتگو کردند.</p>
<p style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_123.jpeg" /></p>', '58211NewsMrRoshd.jpg', 769, '1402/7/26', '11:13:02 PM', 1402, 'مهر', 7, '26');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59211, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'فراخوان جذب مدرس دانشگاه جامع علمی کاربردی', '<p style="text-align: justify;">
	فراخوان جذب مدرس دانشگاه جامع علمی کاربردی برای سال 1402 از روز شنبه 29 مهرماه آغاز می شود.</p>', '<p style="text-align: justify;">
	فراخوان جذب مدرس دانشگاه جامع علمی کاربردی برای سال 1402 از روز شنبه 29 مهرماه آغاز می شود.<br />
	به گزارش روابط عمومی دانشگاه جامع علمی کاربردی ، دکتر اصغر کشت کار قائم مقام رئیس و معاون آموزشی دانشگاه با اعلام این خبر افزود: متقاضیان واجد شرایط می توانند به مدت 2 هفته تا 6 آبان ماه با مراجعه به سامانه جذب مدرسان به آدرس https://jam.uast.ac.ir اقدامات لازم برای مراحل ثبت نام را انجام دهند. دکتر کشت کار درخصوص فرآیند جذب مدرسان دانشگاه جامع علمی کاربردی در سال جاری اظهار داشت: فرآیند بکارگیری مدرسان با نیازسنجی اولیه در مراکز آموزشی انجام شده و ظرفیت نهایی اختصاص یافته پس از تایید واحدهای استانی، جهت تامین نیازها و استفاده بهینه از ظرفیت های موجود باتوجه به دوره های در حال اجرا و هم چنین رشته های جدید در قالب گروه درس های تعیین شده، صورت گرفته است به نحوی که تامین مدرس مورد نیاز مراکز آموزشی، طبق زمان بندی مناسب صورت پذیرد.<br />
	قائم مقام رئیس و معاون آموزشی دانشگاه جامع علمی کاربردی تصریح کرد: حداقل سن متقاضیان برای شرکت در فراخوان ۲۸ سال و حداکثر سن ۶۵ سال می باشد و جذب مدرس بصورت بومی در واحدهای استانی صورت می گیرد. دکتر کشت کار افزود: ملاک ثبت نام قطعی متقاضیان در این فراخوان ، تکمیل فرم های سامانه، پرداخت وجه و اخذ کد رهگیری می&zwnj;باشد.<br />
	قائم مقام رئیس و معاون آموزشی دانشگاه جامع علمی کاربردی در ادامه گفت: ظرفیت پیش بینی شده برای پذیرش مدرسان 3809 نفر می باشد که نیازسنجی آن در یک بازه زمانی مشخص باتوجه به نیازهای زمانی و مکانی مطابق با آمایش آموزش های عالی علمی کاربردی از طریق واحدهای استانی دانشگاه جامع علمی کاربردی انجام و جمع بندی شده است.<br />
	دکتر کشت کار در خاتمه اظهار داشت: دانشگاه تلاش می کند نتایج فراخوان را قبل از شروع ترم آتی تحصیلی ، اعلام نماید تا بتوانیم از خدمات مدرسان جدید در بهبود ارائه آموزش های اشتغال محور بهره مند شویم.</p>', '59211FarakhanModares.jpg', 527, '1402/7/27', '12:06:29 AM', 1402, 'مهر', 7, '27');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59212, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'چهارمین دوره فراخوان سراسری مدرسان تخصصی صنعت آب و برق', '<p dir="RTL">
	فراخوان متقاضیان تدریس در صنعت آب و برق ویژه :</p>
<ul>
	<li dir="RTL">
		متخصصان و کارشناسان خبره شاغل در شرکت های صنعت آب و برق</li>
	<li dir="RTL">
		اعضای هیئت علمی دانشگاه ها و مدرسان مؤسسات آموزشی و پژوهشی</li>
	<li dir="RTL">
		دانشآموختگان کارشناسی ارشد و دکترا در رشته های فنی تخصصی مرتبط با وزارت نیرو (آب، آب و فاضلاب محیط زیست، برق و انرژی و مکانیک)</li>
</ul>
<p>
	&nbsp;</p>
', '<p dir="RTL">
	<span style="color:#6666ff;">به منظور تكميل شبكه مدرسان تخصصي صنعت آب و برق،&zwnj; اعضاي هيأت علمي دانشگاه&shy;ها و مؤسسات آموزش عالي، متخصصان و كارشناسان خبره شاغل در صنعت آب و برق، دانش آموختگان كارشناسي ارشد و دكتراي مرتبط با وزارت نیرو (آب، آب و فاضلاب محیط زیست، برق و انرژی و مکانیک)، &zwnj;مي توانند جهت ثبت اطلاعات و بارگذاري مدارك خود از تاريخ 1 لغايت 30 آبان ماه 1402 با مراجعه به سامانه جامع راهبري آموزش و صلاحيت حرفه اي به نشاني </span><a href="https://tvqc-trainers.moe.gov.ir/login" target="_blank"><span style="color:#ff0099;">https://tvqc-trainers.moe.gov.ir/login</span></a><span style="color:#6666ff;"> اقدام نمايند.</span></p>
<p dir="RTL">
	<span style="color:#6666ff;">بديهي است پس از بررسي و ارزيابي مدارك بارگذاري شده از سوي متقاضيان،&nbsp; در صورت كسب امتيازات لازم ، اسامي نفرات تأييد شده به همراه حيطه و گرايش مربوطه در سامانه جامع راهبري آموزش و صلاحيت حرفه &shy;اي درج و در دسترس شركت&shy;ها و مراكز آموزشي مجاز قرار خواهد گرفت.</span></p>
<p dir="RTL">
	<span style="color:#6666ff;">جهت كسب اطلاعات بيشتر، سركار خانم دهقاني با شماره تماس </span><span style="color:#ff3399;">09014377705</span><span style="color:#6666ff;"> معرفي مي&shy; شود.</span></p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir/Archive/Other/RahnamVorod.pdf" target="_blank"><span style="color:#ff3399;"><span style="font-size:16px;">دریافت فایل راهنمای ورود اطلاعات مدرسین</span></span></a></p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_124.jpeg" style="height: 864px; width: 600px;" /></p>
<p>
	&nbsp;</p>
', '59212FarakhanPic.jpg', 2943, '1402/8/6', '11:08:57 AM', 1402, 'آبان', 8, '6');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59213, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'فراخوان اولین جشنواره رویش', '<p dir="RTL" style="text-align: justify;">
	به استحضار میرساند، جشنواره &quot;رویش&quot;، یادبود دانشمند جهادگر دکتر کاظمی آشتیانی و فراخوان آثار پژوهشگران شاهد و ایثارگر و پژوهشگران عرصه ایثار و شهادت درآذرماه سال جاري توسط بنیاد شهید برگزار می گردد.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	ترویج فرهنگ ایثار و شهادت همچون هر پدیده فرهنگي دیگري از ظرافتها و حساسیت هاي خاص خود برخوردار است و هرنوع موفقیت در این زمینه مستلزم بهره گیري از روشهاي صحیح فرهنگ سازي است. براي حفظ و انتقال ارزش هاي دفاع مقدس و فرهنگ ایثار و شهادت به نسل آینده، مي بایست این فرهنگ با جدیت تمام در سیاست ها و برنامه ریزي هاي فرهنگي، اجتماعي كشور لحاظ و ثبت گردد. به همین منظور اولین جشنواره &quot;رویش&quot;، یادبود دانشمند جهادگر دکتر کاظمی آشتیانی و فراخوان آثار پژوهشگران شاهد و ایثارگر و پژوهشگران عرصه ایثار و شهادت درآذرماه سال جاري توسط بنیاد شهید برگزار می گردد.</p>
<p dir="RTL" style="text-align: justify;">
	علاقه مندان می توانند آثار خود را در قالب کتاب، مقاله و پایان نامه تا تاریخ 15 آبان ماه به دبیرخانه باشگاه پژوهشگران شاهد و ایثارگر واقع در پژوهشکده مهندسی و علوم پزشکی جانبازان، دفتر مطالعات و پژوهش ها و یا به آدرس الکترونیک <a href="mailto:Researchdmp@mail.ir"><span dir="LTR">Researchdmp@mail.ir</span></a> ارسال نمایند.</p>
<p dir="RTL" style="text-align: center;">
	<span style="color:#6666ff;"><span style="font-size:16px;"><span style="font-size:14px;">تلفن دبیرخانه: 09101462848</span></span></span></p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir/archive/other/DastoorAmal.pdf" target="_blank"><span style="font-size:16px;"><span style="color:#ff0099;">دریافت دستورالعمل برگزاری جشنواره </span></span></a></p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_125.jpeg" /></p>
<p>
	&nbsp;</p>
', '59213NewsShahed.jpg', 495, '1402/8/13', '8:54:23 AM', 1402, 'آبان', 8, '13');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59214, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری آزمون استخدامی', '<p>
	شرکت آبادگران صنعت بختیاری به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید.</p>
', '<div style="text-align:justify">
	<p>
		به اطلاع ميرساند شرکت آبادگران صنعت بختیاری به منظور تأمين نيروي انساني مورد نياز، <strong>از آقايان </strong>واجد شرايط را از طريق آزمون توانمندي&shy;هاي عمومی و تخصصي(كتبي) و آزمون دانش مهارت (&shy;مصاحبه) و طی فرآیند گزینش و به ترتیب از بالاترین نمره با شرايط ذيل و در قالب قرارداد نیروی حجمی جذب مي&shy; نمايد.</p>
	<p dir="RTL" style="text-align: justify;">
		در صورت بروز هرگونه مشكل و ابهام با شماره تلفن 33347248-061 مجتمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به عنوان مجري آزمون در وقت اداري تماس حاصل نمایید.</p>
	<p dir="RTL" style="text-align: center;">
		<a href="http://estekhdam.kwphc.ir/azmoon1402" target="_blank"><span style="font-size:16px;"><span style="color:#800080;"><strong>ورود به سامانه ثبت نام</strong></span></span></a></p>
	<p dir="RTL" style="text-align: center;">
		<a href="https://kwphc.ir/archive/other/zamime.zip" target="_blank"><strong><span style="font-size:16px;"><span style="color:#ff0099;">دریافت فایلهای ضمیمه</span></span></strong></a></p>
	<p dir="RTL" style="text-align: center;">
		<img alt="" src="wp-content/uploads/news-images/image_126.jpeg" /></p>
</div>
<p>
	&nbsp;</p>
', '59214Azmoon.jpg', 9058, '1402/8/16', '3:39:24 PM', 1402, 'آبان', 8, '16');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59215, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری جلسه ارزیابی صلاحیت حرفه ای با شرکت های زیر مجموعه شرکت مادر تخصصی توانیر', '<p>
	<span dir="RTL">روز یکشنبه مورخ 12 آذر ماه، جلسه تصمیم گیری در خصوص نحوه برگزاری ارزیابی صلاحیت حرفه ای مشاغل استاندارد شرکت های زیر مجموعه شرکت مادر تخصصی توانیر در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید.</span></p>', '<p dir="RTL" style="margin-right: 0.6pt; text-align: justify;">
	در روز یکشنبه مورخ 12 آذر ماه، جلسه تصمیم گیری در خصوص نحوه برگزاری ارزیابی صلاحیت حرفه ای مشاغل استاندارد شرکت های زیر مجموعه شرکت مادر تخصصی توانیر در استان خوزستان با حضور نماینده شرکت توانیر، معاونین شرکت برق منطقه ای و شرکت توزیع برق خوزستان و شرکت توزیع برق اهواز و کارشناسان مربوطه در محل سالن جلسات مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید.</p>
<p dir="RTL" style="margin-right: 0.6pt; text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="margin-right: 0.6pt; text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_127.jpeg" /></p>
<p dir="RTL" style="margin-right: 0.6pt; text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="margin-right: 0.6pt; text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_128.jpeg" /></p>
<p>
	&nbsp;</p>', '59215Picture.jpg', 210, '1402/9/14', '4:09:48 PM', 1402, 'آذر', 9, '14');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59216, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری مراسم گرامیداشت روز دانشجو و آئین استقبال از دانشجویان جدیدالورد', '<p style="text-align: justify;">
	<span dir="RTL">مراسم گرامیداشت روز دانشجو روز یکشنبه مورخ ۱۴۰۲/۰۹/۱۲ در سالن همایش های مجتمع آب و برق و با حضور ریاست محترم واحد استانی دانشگاه جامع جناب آقای دکتر بهرهی، ریاست محترم مجتمع، معاونین، مدیران، مشاورین، اساتید و دانشجویان مرکز برگزار گردید.</span></p>', '<p dir="RTL" style="text-align: justify;">
	مراسم گرامیداشت روز دانشجو روز یکشنبه مورخ ۱۴۰۲/۰۹/۱۲ در سالن همایش های مجتمع آب و برق و با حضور ریاست محترم واحد استانی دانشگاه جامع جناب آقای دکتر بهرهی، ریاست محترم مجتمع، معاونین، مدیران، مشاورین، اساتید و دانشجویان مرکز برگزار گردید. در این مراسم که بدلیل تلاقی با ایام فاطمیه در فضایی معنوی برگزار گردید، جناب آقای دکتر هودگر ریاست مجتمع و جناب آقای دکتر عرب زاده سرپرست معاونت آموزشی و پژوهشی ضمن خوش آمد به میهمانان، فلسفه وجودی روز دانشجو، نقش دانشجو، رویکرد و اهداف مجتمع با تاکید بر لزوم فعال نمودن تشکل ها. کانون ها و انجمن های علمی را به عنوان یک مرکز آموزشی و پژوهشی تبیین نمودند. در ادامه قوانین و مقررات آموزشی جهت دانشجویان توسط گروه آموزشی بلند مدت ارائه گردید. پخش کلیپ، روضه خوانی به مناسبت ایام فاطمیه، برگزاری پرسش و پاسخ، اهدا کتاب به میهمانان و پذیرایی از دیگر برنامه های این مراسم بود.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="1" cellspacing="5" style="width: 910px">
	<tbody>
		<tr>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_129.jpeg" /></td>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_130.jpeg" /></td>
			<td style="text-align: center; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_131.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_132.jpeg" /></td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_133.jpeg" /></td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>', '59216Main.jpg', 408, '1402/9/14', '4:17:30 PM', 1402, 'آذر', 9, '14');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59217, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'پیام ریاست محترم مجتمع درخصوص گرامیداشت هفته پژوهش', '<p dir="RTL" style="text-align: justify;">
	پژوهش به عنوان اساسی&shy; ترین ارکان رشد و پیشرفت هر کشور، زمینه ساز بزرگترین تحولات، توسعه پایدار و جهش علمی آن کشور به شمار می رود. فرهنگ تحقیق و پژوهش در هر جامعه &shy;ای موجب پویایی و نشاط آن جامعه شده و مانع ایجاد سکون و رکورد در آموزش می&shy; گردد.&nbsp;</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: center;">
	<span style="font-size:16px;"><strong>پژوهش و فناوری، پیشران رشد تولید و مهار تورم</strong></span></p>
<p dir="RTL" style="text-align: justify;">
	پژوهش به عنوان اساسی &shy;ترین ارکان رشد و پیشرفت هر کشور، زمینه ساز بزرگترین تحولات، توسعه پایدار و جهش علمی آن کشور به شمار می رود. فرهنگ تحقیق و پژوهش در هر جامعه&shy; ای موجب پویایی و نشاط آن جامعه شده و مانع ایجاد سکون و رکورد در آموزش می &shy;گردد. &nbsp;</p>
<p dir="RTL" style="text-align: justify;">
	هفته&shy; ی پژوهش امکان ایجاد فضای تعاملی برای آشنایی ذینفعان حال و آینده با واحدهای پژوهش و فناوری را فراهم می نماید. معرفی عملکرد مطالعاتی و تحقیقاتی مؤسسات پژوهشی و عرضه دستاوردهای آنها سبب افزایش حساسیت و توجه مدیران به اهمیت این حوزه شده و زمینه تجاری&zwnj;سازی یافته&zwnj;های پژوهشی و فناوری&zwnj;های توسعه&zwnj; یافته را فراهم می نماید. به دلیل اهمیت این امر، در ایران عزیزمان هفته ای تحت عنوان &quot; هفته &shy;ی پژوهش و فناوری &quot; نام&shy;گذاری شده است.</p>
<p dir="RTL" style="text-align: justify;">
	نقش و اهمیت پژوهش در عرصه اندیشه، در ابعاد مختلف حیات امروز بشر بارها بررسی و تأکید گردیده؛ به ویژه با ابتکار مقام معظم رهبری در طرح نظریه جنبش نرم افزاری، ضرورت توجه به آن بیشتر تبیین و تشریح شده است<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	اینجانب به مناسبت هفته ی پژوهش زحمات تلاشگران سنگر علم و پژوهشگران جوان و مجرب در پیشبرد اهداف متعالی ایران اسلامی را ارج می نهم و توفیق روزافزون آنها در عرصه پژوهش و فناوری را از درگاه خداوند متعال طلب دارم<span dir="LTR">.</span></p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_134.jpeg" /></p>
', '59217Research.jpg', 237, '1402/9/14', '4:25:32 PM', 1402, 'آذر', 9, '14');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59218, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری مراسم بزرگداشت هفته پژوهش و فناوری در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان', '<p style="text-align: justify;">
	مراسم افتتاحیه بزرگداشت هفته پژوهش و فناوری روز سه شنبه مورخ 14 آذر در مجتمع آب و برق و با حضور ریاست محترم مجتمع، معاونین، مشاورین، مدیران، اساتید و دانشجویان مرکز برگزار گردید.</p>
', '<p style="text-align: justify;">
	مراسم افتتاحیه بزرگداشت هفته پژوهش و فناوری روز سه شنبه مورخ 14 آذر در مجتمع آب و برق و با حضور ریاست محترم مجتمع، معاونین، مشاورین، مدیران، اساتید و دانشجویان مرکز برگزار گردید. در این مراسم جناب آقای دکتر هودگر ریاست محترم مجتمع ضمن تبریک این هفته و بیان برنامه های مجتمع در هفته مذکور و همچنین اعلام شرکت مجتمع در نمایشگاه های تهران و اهواز به همین مناسبت، اهمیت مقوله پژوهش و برنامه های جدید جهت نقش آفرینی بیشتر&nbsp; مجتمع در این عرصه را بیان فرمودند. سپس جناب آقای دکتر عرب زاده معاونت محترم آموزشی و پژوهشی مجتمع ضمن تبریک هفته پژوهش و فناوری، تاریخچه و فلسفه نامگذاری این هفته را جهت حضار ارائه نمودند. در ادامه نیز یک کارگاه ((آشنائی با بوم کسب و کار)) توسط آقای دکتر هودگر ریاست مجتمع جهت شرکت کنندگان در جلسه ارائه گردید. برگزاری کارگاه و سمینارهای مختلف و همچنین برگزاری مسابقه جهت دانشجویان مجتمع از دیگر برنامه های هفته پژوهش و فناوری در مجتمع آب و برق خوزستان می باشد.</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_135.jpeg" /></p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_136.jpeg" /></p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_137.jpeg" /></p>
', '59218P1.jpg', 173, '1402/9/16', '12:43:14 PM', 1402, 'آذر', 9, '16');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59219, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری کارگاه سخنوری', '<p style="text-align: justify;">
	<span dir="RTL">به مناسبت هفته پژوهش و روز دانشجو کارگاه هنر بیان و سخنوری با تدریس دکتر کیوان&nbsp; لطفی (گوینده و مجری صدا و سیما، مدرس دانشگاه و مترجم کتاب قدرت سخنوری) </span><span dir="RTL">به صورت حضوری و در سالن همایش های مجتمع برگزار گردید. </span></p>
', '<p dir="RTL" style="text-align: justify;">
	به گزارش روابط عمومی مجتمع آموزشی و پژوهشی صنعت آب و برق خوزستان؛ به مناسبت هفته پژوهش و روز دانشجو کارگاه هنر بیان و سخنوری با تدریس دکتر کیوان&nbsp; لطفی (گوینده و مجری صدا و سیما، مدرس دانشگاه و مترجم کتاب قدرت سخنوری) به همت معاونت آموزشی و پژوهشی و همکاری روابط&zwnj;عمومی و دفتر پژوهش و فناوری مجتمع عالی آموزشی صنعت آب و برق خوزستان به صورت حضوری و در سالن همایش های مجتمع برگزار گردید. این کارگاه با استقبال دانشجویان و اساتید و نیز پرسنل مجتمع آموزشی و پژوهشی&nbsp; همراه با صدور گواهی معتبر و رایگان طبق تقویم هفته پژوهش روبه رو شد که در پایان&nbsp; نیز کتابی به رسم احترام و تکریم توسط سخنران محترم به یکی از اساتید پیشکسوت و با سابقه بهمراه امضا تقدیم گردید.</p>
<table align="center" border="0" cellpadding="5" cellspacing="5" style="width: 910px">
	<tbody>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_138.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle; width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_139.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_140.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle; width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_141.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_142.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle; width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_143.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '59219MainPic.jpg', 261, '1402/9/18', '4:31:30 PM', 1402, 'آذر', 9, '18');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59221, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری کارگاه مقاله نویسی به مناسبت هفته پژوهش', '<p style="text-align: justify;">
	<span dir="RTL">به مناسبت هفته ی پژوهش و روز دانشجو کارگاهی تحت عنوان آموزش مقاله نویسی توسط خانم دکتر صدری صیفی&nbsp; با همت معاونت آموزشی و پژوهشی و همکاری روابط عمومی و همچنین دفتر پژوهش و فناوری به صورت حضوری و رایگان برگزار گردید. </span></p>
', '<p dir="RTL" style="text-align: justify;">
	به مناسبت هفته ی پژوهش و روز دانشجو کارگاهی تحت عنوان آموزش مقاله نویسی توسط خانم دکتر صدری صیفی از نخبگان دانشگاه تهران در روز شنبه مورخ 18 آذر ماه در سالن همایش های مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با همت معاونت آموزشی و پژوهشی و همکاری روابط عمومی و همچنین دفتر پژوهش و فناوری به صورت حضوری و رایگان برگزار گردید. در این کارگاه به بررسی انواع مقالات، روش ها ، آموزش و نکات لازم جهت نوشتن مقالات <span dir="LTR">ISI</span> پرداخته شد.</p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_144.jpeg" /></p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_145.jpeg" /></p>
', '59221SPic.jpg', 378, '1402/9/19', '3:23:51 PM', 1402, 'آذر', 9, '19');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59222, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'یکی از بزرگترین نمایشگاه‌ دستاوردهای پژوهش؛ فناوری و فن بازار برگزار گردید', '<p dir="RTL" style="text-align: justify;">
	به گزارش روابط عمومی مجتمع عالی آموزش و پژوهشی صنعت آب و برق خوزستان&nbsp; به مناسبت هفته پژوهش و فناوری&nbsp; از برگزاری بیست و چهارمین نمایشگاه دستاوردهای پژوهش، فناوری و فن بازار در مصلی امام خمینی (ره) تهران خبر داد که شعار هفته پژوهش و فناوری با تاکیدات رهبری: پژوهش و فناوری پیشران رشد تولید و مهار تورم نامگذاری شده است.</p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	به گزارش روابط عمومی مجتمع عالی آموزش و پژوهشی صنعت آب و برق خوزستان&nbsp; به مناسبت هفته پژوهش و فناوری&nbsp; از برگزاری بیست و چهارمین نمایشگاه دستاوردهای پژوهش، فناوری و فن بازار در مصلی امام خمینی (ره) تهران خبر داد که شعار هفته پژوهش و فناوری با تاکیدات رهبری: پژوهش و فناوری پیشران رشد تولید و مهار تورم نامگذاری شده است.</p>
<p dir="RTL" style="text-align: justify;">
	دکتر هودگر ریاست محترم مجتمع در این خصوص عنوان نمود که&nbsp; یکی از مهترین اهداف این نمایشگاه شناسایی نیازهای پژوهشی و فناورانه و برقراری ارتباط سازنده میان بخش عرضه و تقاضای فناوری کشور است که مجتمع عالی آموزشی و پژوهشی نیز همگام و دوشادوش وزارت نیرو و نیز&nbsp; سازمان آب و برق خوزستان مشارکت فعال داشته است و در حاشیه این نمایشگاه با برپایی غرفه و ایجاد فضای تعامل گرایانه با موسسات و مجموعه های فناورانه و پژوهشی مذاکرات و نشست های نیز برقرار نموده است.</p>
<p dir="RTL" style="text-align: justify;">
	گفتنی است زمان برگزاری هفته پژوهش و فناوری ملی از ۱۹ تا ۲۵ آذر ۱۴۰۲ در شهر تهران منعقد گردیده بود.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 910px">
	<tbody>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_146.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_147.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_148.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 300px; height: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; height: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 300px; height: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; height: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 300px; height: 5px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_149.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_150.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_151.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 300px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 300px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 300px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" rowspan="1" style="text-align: center; vertical-align: middle;">
				<img alt="" src="wp-content/uploads/news-images/image_152.jpeg" /></td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle;">
				&nbsp;</td>
		</tr>
	</tbody>
</table>
<p>
	<br />
	<br />
	&nbsp;</p>
<p>
	&nbsp;</p>', '59222SMain.jpg', 419, '1402/9/25', '3:28:31 PM', 1402, 'آذر', 9, '25');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59223, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'حضور فعال مجتمع عالی آموزشی و پژوهشی آب و برق خوزستان در نمایشگاه هفته پژوهش', '<p style="text-align: justify;">
	<strong><span dir="RTL">بیست و چهارمین نمایشگاه دستاوردهای پژوهش و فناوری و یازدهمین فن بازار استان خوزستان با هدف ارائه آخرین دستاوردها و عرضه محصولات فناورانه برگزار گردید. در این نمایشگاه، ادارات، سازمان ها، شرکت ها، دانشگاه ها و مراکز آموزش عالی استان خوزستان در محل دائمی نمایشگاه های استان خوزستان در سالن خرمشهر شرکت نمودند. </span></strong></p>
', '<p dir="RTL" style="text-align: justify;">
	<strong>بیست و چهارمین نمایشگاه دستاوردهای پژوهش و فناوری و یازدهمین فن بازار استان خوزستان با هدف ارائه آخرین دستاوردها و عرضه محصولات فناورانه برگزار گردید. در این نمایشگاه، ادارات، سازمان ها، شرکت ها، دانشگاه ها و مراکز آموزش عالی استان خوزستان در محل دائمی نمایشگاه های استان خوزستان در سالن خرمشهر شرکت نمودند. </strong></p>
<p dir="RTL" style="text-align: justify;">
	<strong>دکتر هودگر ریاست مجتمع آب و برق خوزستان در حاشیه این نمایشگاه با بیان اینکه مجتمع با هفت اختراع و دستاورد در حوزه های مختلف فناوری، نوآوری و نمونه اولیه و همچنین در مراحل تولید انبوه در این نمایشگاه شرکت نمود و با معرفی دستاوردهای واحدهای فناور مستقر در مرکز رشد شهدای صنعت آب و برق با پخش کلیپ، ماکت، کتابچه و بروشور، موجبات ثبت قرارداد سرمایه گذاران با مخترعین و انعقاد تفاهم نامه با مراکز علمی و دانشگاه ها را فراهم نموده است. </strong></p>
<p dir="RTL" style="text-align: justify;">
	<strong>وی افزود: استقبال قابل توجه ای از غرفه این مرکز توسط مسولان، واحدهای فناور و خصوصاً دانشجویان شد که در حاشیه این نمایشگاه با برگزاری کارگاه های آموزشی با ارایه گواهینامه رایگان و معتبر نظیر مقاله نویسی، بوم کسب و کار، استارتاپ و چگونگی ثبت اختراع و... توسط معاونت آموزشی و پژوهشی مجتمع &nbsp;با همکاری مرکز رشد شهدای صنعت آب و برق خوزستان را از دیگر برنامه های مجتمع آب و برق در این نمایشگاه بیان فرمودند</strong> <strong>که مورد استقبال و اقبال عموم بازدیدکنندگان قرار گرفت.</strong></p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 910px">
	<tbody>
		<tr>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_153.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_154.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_155.jpeg" /></td>
		</tr>
		<tr>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
		</tr>
		<tr>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_156.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_157.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_158.jpeg" /></td>
		</tr>
		<tr>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
		</tr>
		<tr>
			<td>
				<img alt="" src="wp-content/uploads/news-images/image_159.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td>
				&nbsp;</td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '59223p0.jpg', 561, '1402/10/5', '3:46:37 PM', 1402, 'دی', 10, '5');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59224, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'تقدیر نامه', '<p>
	در حاشیه ششمین نشست روسای مراکز جامع علمی و کاربردی استان خوزستان از آقای دکتر هودگر ریاست مجتمع عالی آموزشی و پژوهشی آب و برق خوزستان به جهت مشارکت و فعالیت موثر&nbsp; مجموعه مرکز آب و برق در برپایی غرفه و ارائه دستاوردها در نمایشگاه دستاوردهای پژوهش فناوری و فن بازار سال ۱۴۰۲&nbsp; تقدیر و تشکر به عمل آمد.</p>', '<table border="1" cellpadding="1" cellspacing="1" style="width: 500px">
	<tbody>
		<tr>
			<td style="width: 900px; height: 1000px;">
				<img alt="" src="wp-content/uploads/news-images/image_160.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>', '', 289, '1402/11/2', '8:54:26 AM', 1402, 'بهمن', 11, '2');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59225, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'پذیرش دانشجو بدون کنکور', '<p style="text-align: justify;">
	به اطلاع متقاضیان ثبت&zwnj; نام در پذیرش دوره های کاردانی و کارشناسی ناپیوسته می رساند،&nbsp;زمان ثبت &zwnj;نام در دوره های کاردانی از روز دوشنبه 16 بهمن لغایت پنجشنبه 19 بهمن و ثبت&zwnj; نام در دوره های کارشناسی ناپیوسته از روز شنبه 14 بهمن لغایت چهارشنبه مورخ 18 بهمن می باشد<span dir="LTR">.</span><br />
	لذا داوطلبان واجد شرایط می&zwnj;توانند در مهلت مقرر برای ثبت نام از طریق درگاه اطلاع&zwnj;رسانی سازمان سنجش کشور به نشانی:<span dir="LTR"> www.sanjesh.org </span>اقدام نمایند</p>
', '<p dir="RTL" style="text-align: justify;">
	مرکز آموزش علمی - کاربردی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، بهمن ماه سال 1402 در <strong>مقاطع کاردانی و کارشناسی ناپیوسته،</strong> <strong>بدون کنکور</strong> دانشجو می پذیرد. علاقمندان می توانند جهت کسب اطلاعات بیشتر با شماره های <span dir="LTR">06133340070</span> و 06133340013&nbsp; تماس حاصل نموده و یا به آدرس : اهواز &ndash; بلوار گلستان &ndash; بین خیابان کاشان و همدان &ndash; رو به روی هتل نیشکر مراجعه نمایند</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:16px;"><span style="color:#ff0099;"><strong>ثبت نام رشته های کارشناسی ناپیوسته: 16 لغایت 19 بهمن</strong></span></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><span style="color:#ff0099;"><strong>ثبت نام رشته های کاردانی: 14 لغایت 18 بهمن</strong></span></span></p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: justify;">
	<span style="color:#800080;"><span style="font-size:16px;"><strong>نحوه ثبت نام :</strong></span><br />
	<span style="font-size:16px;"><strong>به صورت حضوری (بلوار گلستان بین خیابان کاشان و همدان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان) و یا از طریق سایت سازمان سنجش به نشانی: (www.sanjesh.org)</strong></span></span></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_161.jpeg" style="height: 1255px; width: 750px;" /></p>
', '59225Freekonkour4022.jpg', 507, '1402/11/16', '7:47:37 PM', 1402, 'بهمن', 11, '16');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59226, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری رویداد استارتاپی در حوزه های آب و برق', '<p dir="RTL">
	به گزارش خبری سازمان آب و برق خوزستان و به نقل از دکتر هودگر :رویدادهای استارتاپی در حوزه آب و برق در دو روز متوالی8 و 9 اسفندماه برگزار گردید، این رویداد با حضور 12 داور برتر در زمینه های تخصصی و حمایت سازمان آب وبرق خوزستان و شرکت هایی چون &quot;شرکت بهره برداری از شبکه های آبیاری کرخه و شاوور، شرکت بهره برداری، تولید و انتقال آب غدیر خوزستان، سازمان علمی پژوهشی سپاه ولی عصر (عج) و نیروگاه رامین&quot; در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید.</p>
<p>
	&nbsp;</p>', '<p dir="RTL">
	به گزارش خبری سازمان آب و برق خوزستان و به نقل از دکتر هودگر :رویدادهای استارتاپی در حوزه آب و برق در دو روز متوالی8 و 9 اسفندماه برگزار گردید، این رویداد با حضور 12 داور برتر در زمینه های تخصصی و حمایت سازمان آب وبرق خوزستان و شرکت هایی چون &quot;شرکت بهره برداری از شبکه های آبیاری کرخه و شاوور، شرکت بهره برداری، تولید و انتقال آب غدیر خوزستان، سازمان علمی پژوهشی سپاه ولی عصر (عج) و نیروگاه رامین&quot; در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید.</p>
<p dir="RTL">
	ریاست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان عنوان نمود:در اولین روز رویداد با موضوع &quot;مدیریت کیفی منابع آب&quot; 25 ایده اولیه در سامانه ثبت نام کردند، که از میان آن ها 14 ایده برگزیده شد تا در رویداد حضور یابند، که پس از داوری و کسب امتیاز داوران 4 ایده برتر برگزیده شد.</p>
<p dir="RTL">
	در رویداد روز دوم نیز با موضوع &quot;ژنراتورها و موتورها در صنعت برق&quot;10 ایده اولیه در سامانه ثبت نام کردند، که از میان آن ها 6 ایده برای داوری انتخاب گردید، تا در رویداد حضور یابند که پس از داوری و کسب امتیاز 4 ایده برتر برگزیده گردید.</p>
<p dir="RTL">
	وی افزود در اختتامیه رویداد که در 13 اسفندماه در سالن همایش های گیت بوستان برگزار گردید، از حامیان و داروران رویداد تجلیل شد و همچنین از کلیه شرکت کنندگان و برگزیدگان رویداد جوایز نفیس و تقدیر به عمل آمد،شایان ذکر است در روز اختتامیه نیز دکتر بختیاری معاونت پارک علم وفناوری استان خوزستان و یکی از کارآفرینان برتر استان بعنوان سخنران تجربه محور نیز سخنرانی کردند.</p>
<p dir="RTL">
	هودگر برگزاری رویداد&zwnj;های مختلف که منجر به جسارت بیان و به اشتراک گذاشتن ایده&zwnj;ها از سوی افراد صاحب ایده می&zwnj;شود را یکی از راهکار&zwnj;های مهم توسعه و ترویج فرهنگ نوآوری و فناوری در جامعه برشمرد همچنین معاونت پارک علم و فناوری خوزستان برگزاری این نوع رویداد&zwnj;ها را فرصتی مغتنم برای ایجاد ارتباط بین فناوران و شرکت&zwnj;های بزرگ در راستای همکاری&zwnj;های مشترک و انتقال فناوری دانست.</p>
<p dir="RTL">
	در جلسه اختتامیه بیانیه رویداد نیز با شعار افق های جدید و روشن در صنعت آب و برق توسط دبیر رویداد برای حضار قرائت گردید که هدف از انتخاب این شعار را گوشزد کردن ضرورت بهره گیری از تکنولوژی ها و روشهای نوین در صنعت آب و برق عنوان نمود و صنعتگران و ایده پردازان را جهت پیدا نمودن راه حل مشکلات این صنعت و تشویق نمودن آنها برای رفع مشکلات و کاستی های این صنعت در استان و کشور با توان داخلی باشند.</p>
<p>
	&nbsp;</p>', '', 160, '1402/12/15', '12:32:19 PM', 1402, 'اسفند', 12, '15');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59227, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری اولین اردوی فناورانه راهیان پیشرفت ویژه دانشجویان فنی مرکز آموزشی و پژوهشی صنعت آب و برق استان خوزستان', '<p dir="RTL" style="text-align: justify;">
	به همت معاونت آموزشی و پژوهشی و همچنین امور فرهنگی دانشجويي مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان نخستین اردوي راهيان پيشرفت (تور علمي و فناوري سد مسجد سلیمان ) به مدت یک روز برگزار گرديد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	دکتر هودگر ریاست مجتمع عالی با بیان اینکه نظر به ضرورت گسترش فعالیت و پویایی هر چه بیشتر دانشجویان، با برنامه ریزی های صورت گرفته گام اول در راستای هویت بخشی به تیم های دانشجویی و ار تباط آن ها با صنعت&nbsp; اردو&zwnj;های راهیان پیشرفت و امید با حضور جمعی از دانشجویان &nbsp;بمدت 1 روز &nbsp;در سد و نیروگاه برق آبی مسجد سلیمان &nbsp;برگزار شد</p>
<p dir="RTL" style="text-align: justify;">
	در این اردو دانشجویان &nbsp;از فعالیت ها و اقدامات مهم این بخش از صنعت و همچنین دستاورد&zwnj;های علمی&nbsp; بازدید داشتند.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;هودگر افزود: اجرای منویات رهبر معظم انقلاب مبنی بر جهاد تبیین و اولویت مهم بازگو کردن دستاوردهای نظام اسلامی بهترین راهکار برای مردم به ویژه دانشجویانی است که در معرض &nbsp;تهاجم خبری مسموم قرار دارند که این مهم با عنایت به ارتباط موثر مجتمع با صنایع موجود در استان و بالاخص صنعت آب و برق می تواند فتح بابی برای بازدید هر چه بیشتر دانشجویان باشد و این بعد از نگاه می تواند جلوه&zwnj;ای از پیشرفت، توسعه و خودکفایی در کشور محسوب &zwnj;شود که لازم است نسل جدید و دانش&zwnj;جویان با آن و اهمیتی که برای کشور دارد آشنا شوند.</p>
<p dir="RTL" style="text-align: justify;">
	شایان ذکر است در این بازدید عرب زاده معاونت آموزشی و پژوهشی و حجت الاسلام قدوسی مسئول امور فرهنگی مجتمع بهمراه دانشجویان حضور داشتند که طی بازدید مطالبات و پیشنهادات دانشجویان به مسئولین مطرح گردید و از سوی مسئولین مرکز نیز تاکید بر آن شد که انتظار می رود فعالیت های مشورتی و فعالیت های انجمن های علمی، پزوهشی، فرهنگی و هنری هر چه زودتر تعریف گردد و از ظرفیت های هم افزایی و تعامل با دانشجویان استقبال خواهد شد.</p>
<p dir="RTL" style="text-align: justify;">
	گفتنی است سد مسجد سلیمان یا سد گُدار لَندَ، در شهرستان مسجد سلیمان و استان خوزستان بر روی رودخانه کارون احداث شده&zwnj;است. سد مسجد سلیمان با ۱۷۷ متر ارتفاع از نوع سدهای خاکی می&zwnj;باشد.از ویژگی&zwnj;های بارز این سد دریچه&zwnj;های قطاعی سرریز آن است که بزرگ&zwnj;ترین در جهان محسوب می&zwnj;شود. همچنین نیروگاه این سد بزرگ&zwnj;ترین نیروگاه جریانی کشور به حساب می&zwnj;آید. ظرفیت این نیروگاه ۲۰۰۰ مگاوات است که در دو فاز ۱۰۰۰ مگاواتی اول و ۱۰۰۰ مگاواتی طرح توسعه اجرا شده&zwnj;است. مراحل احداث این سد در تابستان سال ۱۳۷۰ آغاز شده و سال ۱۳۸۰ به پایان رسیده&zwnj;است.</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" dir="rtl" style="width: 805px">
	<tbody>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_162.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; width: 400px;">
				<img alt="" src="wp-content/uploads/news-images/image_163.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_164.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_165.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				&nbsp;</td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="text-align: center;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_166.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_167.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>', '59227TsPic.jpg', 329, '1402/12/21', '9:13:34 AM', 1402, 'اسفند', 12, '21');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59228, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری جشن بزرگ‌ نیمه شعبان در مجتمع آموزشی و پژوهشی صنعت آب و برق استان خوزستان', '<p style="text-align: justify;">
	به مناسبت ولادت با سعادت منجی عالم بشریت حضرت مهدی ( عجل الله) جشن خانوادگی با شکوهی در این مرکز برگزار شد.</p>', '<p style="text-align: justify;">
	به مناسبت ولادت با سعادت منجی عالم بشریت حضرت مهدی ( عجل الله) جشن خانوادگی با شکوهی به همت بسیج و امور فرهنگی و دینی مجتمع آموزشی و پژوهشی صنعت آب و برق استان خوزستان در این مرکز برگزار شد.<br />
	<br />
	در این مراسم که با قرائت قرآن و اجرای سرود ملی شروع شد،برنامه های متعددی از جمله&nbsp; خیر مقدم رئیس مجتمع جناب دکتر هودگر، سخنرانی دکتر شریفی درباره مسائل خانواده، استدآپ کمدین ، اجرای مسابقه برای کودکان و اهدای جوایز به آن ها و صحبت درباره انتخابات برگزار گردید.<br />
	<br />
	در انتهای این مراسم همه دعوت سفره بابرکت امام زمان ( عجل الله) بودند و در آخر برنامه نور افشانی در حیاط مجتمع برگزار گردید.</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" dir="rtl" style="width: 805px">
	<tbody>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 400px;">
				<img alt="" src="wp-content/uploads/news-images/image_168.jpeg" /></td>
			<td style="text-align: center; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 400px;">
				<img alt="" src="wp-content/uploads/news-images/image_169.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 400px;">
				&nbsp;</td>
			<td style="text-align: center; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 400px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 400px;">
				<img alt="" src="wp-content/uploads/news-images/image_170.jpeg" /></td>
			<td style="text-align: center; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 400px;">
				<img alt="" src="wp-content/uploads/news-images/image_171.jpeg" /></td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 400px;">
				&nbsp;</td>
			<td style="text-align: center; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 400px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle; width: 400px;">
				<img alt="" src="wp-content/uploads/news-images/image_172.jpeg" /></td>
			<td style="text-align: center; width: 5px;">
				&nbsp;</td>
			<td style="text-align: center; vertical-align: middle; width: 400px;">
				<img alt="" src="wp-content/uploads/news-images/image_173.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>', '59228PPic.jpg', 350, '1402/12/21', '9:32:01 AM', 1402, 'اسفند', 12, '21');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59229, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'مراسم تقدیر از مجتمع در زمینه آموزش و پژوهش', '<p dir="RTL" style="text-align: justify;">
	با توجه به فعالیت های موفق مرکز علمی کاربردی صنعت آب و برق خوزستان در زمینه هی پژوهشی &ndash; نوآوری ، فرهنگی &ndash; دانشجویی و فن آوری در جلسه رؤسای مراکز علمی کاربردی استان خوزستان که در محل دانشگاه جامع علمی کاربردی استان برگزار گردید از تلاش های رئیس و کارکنان این مرکز تقدیر بعمل آمد . لذا لوح تقدیر جداگانه ای در زمینه های فوق الذکر به این مرکز اهدا گردید.</p>
<p>
	&nbsp;</p>
', '<p style="text-align: justify;">
	<span style="font-size:14px;"><strong><span dir="RTL">تقدیراز مرکز آموزش علمی کاربردی صنعت آب و برق خوزستان در خصوص مشارکت فعال در برگزاری همایش جهاد تبیین:</span></strong></span></p>
<p style="text-align: justify;">
	<span dir="RTL">تقدیر از مرکز آموزش علمی کاربردی صنعت آب و برق خوزستان به جهت مشارکت فعال در برگزاری همایش جهاد تبیین با موضوع مهدویت و جشن نیمه شعبان میلاد یگانه منجی عالم بشریت حضرت مهدی موعود (عج)، این مراسم مورخ 2 اسفند 1402 در سالن &nbsp;همایش های واحد استانی دانشگاه جامع علمی و کاربردی خوزستان با دعوت از نماینده محترم ولی فقیه در استان خوزستان حضرت آیت الله موسوی فرد و با حضور اساتید ، دانشجویان و روسای مراکز علمی کاربردی برگزار گردید. </span></p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_174.jpeg" /></p>
<p style="text-align: justify;">
	<span style="font-size:14px;"><strong><span dir="RTL">تقدیر از برگزاری رویداد استارتاپی موفق در سال 1402</span></strong></span></p>
<p style="text-align: justify;">
	<span dir="RTL">جناب آقای دکتر بهرهی سرپرست دانشگاه جامع علمی و کاربردی استان خوزستان به جهت تلاش ها و فعالیت های ارزنده جناب آقای دکتر هودگر ریاست محترم مرکز آموزش علمی کاربردی صنعت آب و برق خوزستان در برگزاری رویدادهای استاتاپی &laquo; مدیریت کیفی منابع آب&raquo; و &laquo; ژنراتورها و موتورها در صنعت برق &raquo; در سال 1402 با تقدیم تقدیر نامه ای تشکر و قدر دانی نمودند. رویدادهای استارتاپی در حوزه آب و برق در دو روز متوالی8 و 9 اسفندماه برگزار گردید. این رویداد با حضور 12 داور برتر در زمینه های تخصصی و حمایت سازمان آب وبرق خوزستان و شرکت هایی چون &quot;شرکت بهره برداری از شبکه های آبیاری کرخه و شاوور، شرکت بهره برداری، تولید و انتقال آب غدیر خوزستان، سازمان علمی پژوهشی سپاه ولی عصر (عج) و نیروگاه رامین&quot; در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید. </span></p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_175.jpeg" /></p>
<p style="text-align: justify;">
	<span style="font-size:14px;"><strong><span dir="RTL">مرکز آموزش علمی کاربردی صنعت آب و برق خوزستان در سال 1402 موفق به طراحی و اجرای دوره های کوتاه مدت استاندارد در حوزه های تخصصی گردید.</span></strong></span></p>
<p dir="RTL" style="text-align: justify;">
	مرکز آموزش علمی کاربردی صنعت آب و برق خوزستان در سال 1402 موفق به طراحی و اجرای دوره های کوتاه مدت استاندارد در حوزه های تخصصی گردید در این راستا دکتر کیانوش بهرهی سرپرست دانشگاه جامع علمی و کاربردی استان خوزستان طی تقدیر نامه ای از تلاشها و فعالیت های ارزنده مجموعه پرسنل مرکز آموزش علمی و کاربردی صنعت آب وبرق خوزستان بدلیل طراحی یازده دوره و اجرای یک دوره کوتاه مدت در قالب دانشگاه جامع علمی کاربردی استان خوزستان در سال 1402 قدردانی به عمل آوردند.</p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_176.jpeg" /></p>
<p style="text-align: justify;">
	&nbsp;</p>
', '59229TaqdirPic.jpg', 424, '1402/12/21', '2:55:03 PM', 1402, 'اسفند', 12, '21');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (59230, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری آزمون استخدامی شرکت کشت و صنعت دعبل خزائی', '<p style="text-align: justify;">
	<span dir="RTL">آزمون جذب نیرو در قالب قرارداد تامین نیروی انسانی جهت شرکت کشت و صنعت دعبل خزاعی در تاریخ 26 اسفند ماه 1402 با همت و برنامه ریزی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان و برگزار گردید.</span></p>', '<p dir="RTL" style="text-align: justify;">
	به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان آزمون جذب نیرو شرکت کشت و صنعت دعبل خزاعی در قالب قرارداد تامین نیروی انسانی از ساعت 9 صبح روز شنبه مورخ <span dir="RTL">26 اسفند ماه 1402</span> در محل مجتمع و دانشگاه پیان نور برای تعدا 2092 شرکت کننده برگزار گردید. در جریان برگزاری آزمون جناب آقای علم الهدی مدیر عامل محترم شرکت کشت و صنعت دعبل خزاعی از حوزه های برگزاری بازدید و از نزدیک بر روند اجرای آزمون را نظارت نمودند. در اثنای این بازدید با جناب آقای دکتر هودگر ریاست مجتمع نیز ملاقاتی داشتند که در این ملاقات بر ادامه همکاری طرفین تاکید گردید.</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" dir="rtl" style="width: 910px">
	<tbody>
		<tr>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_177.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_178.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_179.jpeg" /></td>
		</tr>
		<tr>
			<td style="width: 300px;">
				&nbsp;</td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				&nbsp;</td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_180.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_181.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_182.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>', '59230MainPic.jpg', 1288, '1402/12/26', '3:18:04 PM', 1402, 'اسفند', 12, '26');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60230, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'نخستین دوره آموزشی تربیت و تعالی راویان پیشرفت در وزارت نیرو یادواره شهید آوینی برگزار شد', '<p dir="RTL" style="text-align: justify;">
	روز پنج شنبه ۱۳ اردیبهشت ۱۴۰۳، آیین اختتامیه اولین دوره آموزشی تربیت و تعالی راویان پیشرفت در وزارت نیرو &quot;یادواره شهید آوینی&quot; در سالن همایش های بین المللی گیت بوستان برگزار شد<span dir="LTR">.</span> برنامه این دوره ملی که اولین دوره آن در خوزستان برگزار شد، به مدت سه ماه در وزارت نیرو در دست بررسی بود و چهار چوب و سر فصل های آن بر اساس استاندارد های روایت گری مشخص شده است<span dir="LTR">.</span></p>
<p style="text-align: justify;">
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	دکتر هودگر رییس مجتمع عالی آموزشی و پژوهشی سازمان آب و برق خوزستان بیان کردند: حدود ۸۰ نفر از کارکنان شرکت های زیر&nbsp;مجموعه صنعت آب و برق به صورت حضوری و ۱۲۰ نفر نیز به صورت بر خط از اقصا نقاط کشور در این برنامه&nbsp;شرکت کردند و توانستند از آموزش های ارائه شده در این دوره استفاده کنند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	وی با اشاره به اینکه همه شرکت های مادر تخصصی ذیل وزارت نیرو از جمله توانیر، آبفا، منابع آب، توزیع برق و نیروگاه های حرارتی همچنین سازمان آب و برق خوزستان و شرکت های زیر مجموعه آن در این دوره سه روزه شرکت کردند، تصریح کرد: به منظور ارزیابی و تعیین سطح شرکت کنندگان، یک آزمون غیر حضوری از امروز به مدت ۳ روز کاری برگزار می شود که شرکت کنندگان با توجه به تکنیک های آموزش داده شده در این دوره یک فیلم کوتاه از روایت گری های خود تهیه کرده و برای دبیرخانه برنامه ارسال می کنند که پس از ارزیابی هیات داوران به ۱۰ نفر اول جوایز ارزنده ای اهدا خواهد شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	ایشان بیان کردند: در این دوره با مفاهیمی از جمله ابعاد بیانیه گام دوم انقلاب اسلامی، سند ملی روایت پیشرفت و تکالیف وزارت نیرو در اجرای این سند و الگوی اسلامی ایرانی پیشرفت و قواعد مربوط به آن آشنا شدیم<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	وی اضافه کردند: در این دوره روایت هایی از حماسه آفرینی های دفاع مقدس، نقش و سهم نسل جوان و نخبه در ساختن آینده صنعت آب و برق و روایت هایی از دستاوردهای کلان صنعت آب و برق مطرح شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	دکتر هودگر اشاره کردند: آشنایی با اصول روایتگری و سخنوری، زبان و فرازبان ها، زبان بدن، کارکردهای هویتی تاریخ شفاهی، خاطره نویسی و داستان سرایی و آشنایی با تولید محتوا از جمله سر فصل هایی بود که توسط اساتید مربوطه برای علاقه مندان تدریس شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	رئیس مجتمع بیان کردند: در پایان این دوره آموزشی از شرکت کنندگانی که حضور داشتند ارائه روایتگری ۷ نفر انتخاب شد و داوران روایت گری آن ها را طبق استاندارد های تدریس شده بررسی کرده و نقاط قوت و ضعف آنها را مشخص و منتقل کردند تا یک الگوی استاندارد برای ارسال فیلم های روایت گری برای دبیرخانه مشخص شود<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	وی خاطر نشان کردند: در پایان این مراسم از همه کسانی که برای برگزاری این دوره ملی تلاش کردند با اهدا لوح تقدیر، قدردانی شد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '59231pic.jpg', 254, '1403/2/16', '1:59:41 PM', 1403, 'اردیبهشت', 2, '16');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60231, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری بزرگداشت هفته معلم و استاد در مجتمع آموزشی و پژوهشی آب و برق خوزستان', '<p style="text-align: justify;">
	به مناسبت هفته معلم و گرامیداشت مقام شامخ معلم و استاد، نشست صمیمانه ای با حضور ریاست مجتمع آب و برق خوزستان و مدرسین و اساتید این مجتمع در محل دفتر ریاست برگزار گردید.</p>
', '<p style="text-align: justify;">
	به مناسبت هفته معلم و گرامیداشت مقام شامخ معلم و استاد، نشست صمیمانه ای با حضور ریاست مجتمع آب و برق خوزستان و مدرسین و اساتید این مجتمع در محل دفتر ریاست برگزار گردید. در این مراسم مهدی هودگر ریاست مجتمع ضمن یادآوری فلسفه نام گذاری این روز و تبیین نقش حساس معلم، مراتب تبریک و قدردانی خود و مجموعه آموزشی آب و برق را به حاضرین اعلام نمودند. در ادامه مدرسین به بیان نقطه نظرات و پیشنهادات خود در جهت بهبود کیفیت خدمات آموزشی پرداختند که موارد توسط ریاست و معاونت آموزشی و پژوهشی مجتمع مورد بررسی و پاسخگوئی قرار گرفت. در انتها نیز به رسم ادب لوح تقدیر، هدیه و شاخه گلی به اساتید حاضر در جلسه اهدا گردید. همچنین ریاست مجتمع به همراه معاونت آموزشی و پژوهشی و مسئولین ذی ربط بصورت حضوری در کلاس های درس حاضر و اساتیدی که امکان حضور در جلسه را نداشتند را مورد تقدیر و تجلیل قرار دادند.</p>
<table align="center" border="0" cellpadding="1" cellspacing="1" dir="rtl" style="width: 905px">
	<tbody>
		<tr>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_183.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_184.jpeg" /></td>
		</tr>
		<tr>
			<td style="width: 450px;">
				&nbsp;</td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 450px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_185.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_186.jpeg" /></td>
		</tr>
		<tr>
			<td style="width: 450px;">
				&nbsp;</td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 450px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_187.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_188.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '60231NPic.jpg', 538, '1403/2/19', '12:38:14 PM', 1403, 'اردیبهشت', 2, '19');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60232, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'تفاهم‌نامه همکاری میان پژوهشگاه نیرو و مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان مبادله شد', '<p style="text-align: justify;">
	روسای پژوهشگاه نیرو و مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، در راستای توسعه فعالیت&zwnj;های آموزشی و پژوهشی و بهره&zwnj;برداری از ظرفیت&zwnj;های آموزشی و تحقیقاتی طرفین،تفاهم&zwnj;نامه همکاری امضا کردند.</p>
', '<p style="text-align: justify;">
	روسای پژوهشگاه نیرو و مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، در راستای توسعه فعالیت&zwnj;های آموزشی و پژوهشی و بهره&zwnj;برداری از ظرفیت&zwnj;های آموزشی و تحقیقاتی طرفین،تفاهم&zwnj;نامه همکاری امضا کردند که این تفاهم&zwnj;نامه روز چهارشنبه میان &quot;مجید عمیدپور&quot; رئیس پژوهشگاه نیرو و &quot;مهدی هودگر&quot; رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به امضا رسید.</p>
<p style="text-align: justify;">
	همکاری در اجرای پروژه&zwnj;های تحقیقاتی و پژوهشی مورد نیاز صنعت آب و برق، انجام مشاوره یا نظارت بر طرح&zwnj;های تحقیقاتی- پژوهشی در دست اقدام در صنعت آب و برق استان خوزستان و استان&zwnj;های مجاور، برگزاری سمینار، کنگره و نشست&zwnj;های علمی و تخصصی مشترک، طراحی و اجرای طرح&zwnj;های پژوهشی کاربردی مشترک در استان خوزستان و سایر استان&zwnj;های همجوار از جمله محورهای اصلی این تفاهم&zwnj;نامه همکاری است.&zwnj;</p>
<p style="text-align: justify;">
	همچنین گسترش همکاری&zwnj;های آموزشی و صلاحیت حرفه&zwnj;ای طرفین، برگزاری دوره&zwnj;های آموزشی داخلی و بین&zwnj;المللی و ارزیابی&zwnj;های صلاحیت حرفه&zwnj;ای، برگزاری دوره&zwnj;های مدیریت انرژی عمومی و تخصصی در چهارچوب سیلابس مدون مرکز ملی آموزش مدیریت انرژی به نیروهای شرکت&zwnj;های تولید و توزیع برق استان خوزستان و شرکت&zwnj;های توزیع برق جنوب کشور عراق، برگزاری دوره&zwnj;های داخلی و خارجی در محل پارک بین&zwnj;المللی آموزش&zwnj;های تخصصی فوق توزیع و انتقال مستقر در مجتمع خراسان پژوهشگاه نیرو، برگزاری تورهای فناورانه صنعتی و دوره&zwnj;های آموزشی مشترک در استان خوزستان و استان خراسان جهت شرکت&zwnj;های بهره&zwnj;بردار صنعت آب و برق، بخشی از توافقات طرفین در حوزه فعالیت&zwnj;های آموزشی است.</p>
<p style="text-align: justify;">
	&nbsp;تبادل کارشناسان و ایجاد کمیته مشترک به منظور بررسی و ممیزی مسائل و مشکلات مدیریت انرژی، فراهم آوردن بستر همکاری میان نمایندگی&zwnj;های پژوهشگاه نیرو در استان&zwnj;های مختلف نیز از دیگر محورهای قید شده در این تفاهم&zwnj;نامه همکاری است.</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_189.jpeg" style="height: 466px; width: 700px;" /></p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_190.jpeg" style="height: 466px; width: 700px;" /></p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_191.jpeg" style="height: 466px; width: 700px;" /></p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_192.jpeg" style="height: 466px; width: 700px;" /></p>
', '60232MainP1.jpg', 483, '1403/2/19', '11:53:34 PM', 1403, 'اردیبهشت', 2, '19');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60233, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'پیام تسلیت رئیس مجتمع در پی شهادت رئیس جمهور محبوب و مردمی و هیئت همراه', '<p style="text-align: justify;">
	رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در پیامی شهادت رئیس جمهور جهادی و خستگی&zwnj;ناپذیر و هیئت همراه در سانحه سقوط بالگرد و حین انجام وظیفه برای مردم را تسلیت گفت.</p>', '<p style="text-align: center;">
	بسم الله الرحمن الرحیم<br />
	مِنَ الْمُؤْمِنِینَ رِجَالٌ صَدَقُوا مَا عَاهَدُوا اللَّهَ عَلَیْهِ فَمِنْهُمْ مَنْ قَضَى نَحْبَهُ وَمِنْهُمْ مَنْ یَنْتَظِرُ وَمَا بَدَّلُوا تَبْدِیلًا ﴿احزاب،23﴾</p>
<p style="text-align: justify;">
	روح بلند آیت&zwnj;الله سید ابراهیم رئیسی، خادم الرضا (ع) و رئیس جمهوری محبوب و مردمی و هیئت همراه ایشان حین خدمت به مردم ایران به ملکوت اعلی پیوست.<br />
	با قلبی سرشار از اندوه، شهادت آیت الله سید ابراهیم رئیسی، خادم الرضا (ع) و رئیس جمهور محبوب ایران اسلامی، حسین امیرعبداللهیان، وزیر انقلابی امور خارجه، آیت الله سیدمحمدعلی آل هاشم، امام جمعه بزرگوار تبریز و نماینده ولی فقیه در استان آذربایجان شرقی، مالک رحمتی، استاندار خدوم استان آذربایجان شرقی و دیگر همراهان، حین خدمت و انجام وظیفه برای مردم ایران را به امام زمان ارواحنا له الفداء، رهبر معظم انقلاب اسلامی حضرت آیت&zwnj;الله خامنه&zwnj;ای حفظ الله، خانواده شهدای خدمت و مردم شهید پرور ایران به ویژه خانواده صنعت آب و برق و دانشگاهیان تسلیت عرض می&zwnj;کنم.<br />
	خداوند به همه ما توفیق دهد تا همواره خط سرخ شهادت را پاس بداریم و در مسیر خدمت به مردم، همچون آن شهید بزرگوار خدمت، با اخلاص تمام، انجام وظیفه نمائیم.</p>', '60233Ertehal.jpg', 357, '1403/2/31', '12:58:32 PM', 1403, 'اردیبهشت', 2, '31');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60234, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری مراسم گرامیداشت مقام رئیس جمهورِ شهید آیت الله رئیسی‏ و همراهان ایشان', '<p style="text-align: justify;">
	مراسم گرامیداشت مقام رئیس جمهورِ شهید آیت الله رئیسی&rlm; و همراهان ایشان در مجتمع آموزشی و پژوهشی صنعت آب و برق استان خوزستان برگزار شد.</p>
', '<p style="text-align: justify;">
	به گزارش بسیج و امور فرهنگی و دینی مجتمع آموزشی و پژوهشی صنعت آب و برق استان خوزستان، مراسم گرامیداشت مقام رئیس جمهورِ شهید آیت الله رئیسی&rlm; و همراهان ایشان در مجتمع آموزشی و پژوهشی صنعت آب و برق استان خوزستان برگزار شد.<br />
	این مراسم با قرائت قرآن آغاز گردید و سپس ریاست مجتمع بیاناتی درباره این سانحه غمبار ایراد فرمودند و در ادامه ثواب قرائت زیارت عاشورا و روضه خوانی به ارواح مطهر شهدای این سانحه هدیه شد.</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 905px">
	<tbody>
		<tr>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_193.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td style="text-align: center; width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_194.jpeg" /></td>
		</tr>
		<tr>
			<td style="width: 450px;">
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td style="text-align: center; width: 450px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_195.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td style="text-align: center; width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_196.jpeg" /></td>
		</tr>
		<tr>
			<td style="width: 450px;">
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td style="text-align: center; width: 450px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" style="width: 450px; text-align: center;">
				<img alt="" src="wp-content/uploads/news-images/image_197.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p style="text-align: center;">
	<br />
	&nbsp;</p>
', '60234Main.jpg', 385, '1403/3/2', '3:21:45 PM', 1403, 'خرداد', 3, '2');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60235, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری کارگاه اهمیت بررسی خوردگی در تأسیسات سد و شبکه', '<p dir="RTL" style="text-align: justify;">
	کارگاه اهمیت بررسی خوردگی در تأسیسات سد و شبکه در روزهای سه شنبه و چهارشنبه مورخ 8 و 9 خرداد ماه از ساعت 9 الی 15 در محل سالن جلسات دفتر ریاست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	کارگاه اهمیت بررسی خوردگی در تأسیسات سد و شبکه در روزهای سه شنبه و چهارشنبه مورخ 8 و 9 خرداد ماه از ساعت 9 الی 15 در محل سالن جلسات دفتر ریاست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید.</p>
<p dir="RTL" style="text-align: justify;">
	در این کارگاه دو روزه که استقبال و رضایتمندی فراگیران را در پی داشت پس از قرائت قرآن و پخش سرود ملی، به بیان اصول و مبانی خوردگی در فلزات، انواع خوردگی و واکنش های آن، خوردگی در محیط های مختلف و روش های جلوگیری از آن پرداخته شد. همچنین جناب آقای دکتر علی حیدری مقدم با توضیح و تشریح اقدامات لازم و اصولی جهت نگهداری و بازدارندگی تجهیزات از خوردگی، مشکلات و مسائل شرکت ها در حوزه موضوع بحث را به صورت موردی بررسی نمودند و به پرسش های حضار پاسخ دادند.</p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 905px">
	<tbody>
		<tr>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_198.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_199.jpeg" /></td>
		</tr>
		<tr>
			<td style="width: 450px;">
				&nbsp;</td>
			<td>
				&nbsp;</td>
			<td style="width: 450px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_200.jpeg" /></td>
			<td>
				&nbsp;</td>
			<td style="width: 450px;">
				<img alt="" src="wp-content/uploads/news-images/image_201.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '60235Mainpic.jpg', 553, '1403/3/9', '5:46:23 PM', 1403, 'خرداد', 3, '9');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60236, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری آزمون استخدامی', '<p dir="RTL" style="text-align: justify;">
	شرکت های پیمانکاری طرف پیمان شرکت توزیع نیروی برق اهواز به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	به اطلاع ميرساند شرکت های پیمانکاری طرف پیمان شرکت توزیع نیروی برق اهواز، به منظور تأمين نيروي انساني مورد نياز، تعداد ۱۵نفر از آقايان واجد شرايط (مطابق با مفاد آگهی پیوست) را از طريق آزمون توانمنديهاي تخصصي (كتبي) و آزمون دانش مهارت (مصاحبه) به ترتیب از بالاترین نمره در قالب قرار داد نیروی حجمی جذب می نماید.</p>
<p dir="RTL" style="text-align: justify;">
	در صورت بروز هرگونه مشكل و ابهام با شماره تلفن 33347248-061 مجتمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به عنوان مجري آزمون در وقت اداري تماس حاصل نمایید.</p>
<p dir="RTL" style="text-align: center;">
	<span style="font-size:20px;"><a href="https://estekhdam.kwphc.ir/azmoon140301" target="_blank"><span style="color:#b22222;">لینک ثبت نام</span></a></span></p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_202.jpeg" style="width: 700px; height: 982px;" /></p>
', '60236estekhdami.jpg', 8199, '1403/4/3', '10:07:22 AM', 1403, 'تیر', 4, '3');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60237, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری آزمون استخدامی', '<p style="text-align: justify;">
	شرکت دزیاران کارون و موسسه خدمات حفاظتی و مراقبتی حافظین امنیت پادنا، طرف قرارداد شرکت سهامی برق منطقه ای خوزستان به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید</p>
', '<p dir="RTL" style="text-align: justify;">
	به اطلاع مي رساند شرکت دزیاران کارون و موسسه خدمات حفاظتی و مراقبتی حافظین امنیت پادنا، طرف قرارداد شرکت سهامی برق منطقه ای خوزستان، به منظور تأمين نيروي انساني مورد نياز، تعداد 251 نفر از آقايان واجد شرايط جهت اپراتور پست برق و تعدا 189 نفر به منظور نگهبان (مطابق با مفاد آگهی پیوست) را از طريق آزمون توانمنديهاي تخصصي (كتبي) و آزمون دانش مهارت (مصاحبه) به ترتیب از بالاترین نمره در قالب قرار داد نیروی حجمی جذب می نماید.</p>
<p dir="RTL" style="text-align: justify;">
	در صورت بروز هرگونه مشكل و ابهام با شماره تلفن 33347248-061 مجتمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به عنوان مجري آزمون در وقت اداري تماس حاصل نمایید.</p>
<p dir="RTL" style="text-align: center;">
	<strong><span style="color:#ee82ee;"><span style="font-size:14px;">جهت مشاهده آخرین تغییرات محل رشته شغلی و تعداد نفرات موردنیاز ، آگهی آزمون را مطالعه نمایید.</span></span></strong></p>
<p dir="RTL" style="text-align: center;">
	<strong><a href="https://kwphc.ir/Azmoon/AzmoonAdv/Azmoon140305.pdf" target="_blank"><span style="color:#800080;"><span style="font-size:20px;">دریافت آگهی</span></span></a></strong></p>
<p dir="RTL" style="text-align: center;">
	<a href="https://estekhdam.kwphc.ir/azmoon140302" target="_blank"><span style="color:#008080;"><strong><span style="font-size:20px;">لینک ثبت نام</span></strong></span></a></p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_203.jpeg" style="height: 800px; width: 570px;" /></p>
', '60237AzmoonPic.jpg', 17438, '1403/4/9', '9:58:03 AM', 1403, 'تیر', 4, '9');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60238, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'آزمون استخدامی شرکت کشت و صنعت حکیم فارابی', '<p>
	شرکت کشت و صنعت حکیم فارابی به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید.</p>
', '<p dir="RTL" style="text-align: justify;">
	به اطلاع مي رساند شرکت کشت و صنعت حکیم فارابی به منظور تأمين نيروي انساني مورد نياز خود تعدادي از آقايان واجد شرايط را از ميان داوطلبان بومي و از طريق برگزاري آزمون توانمنديهاي عمومي و تخصصي (كتبي) و آزمون دانش مهارت (مصاحبه) و طي فرايند گزينش و به ترتيب از بالاترين نمره با شرايط ذيل و در قالب قرارداد تامين نيروي انساني جذب و بکارگيري مي نمايند.</p>
<p dir="RTL" style="text-align: justify;">
	در صورت بروز هرگونه مشكل و ابهام با شماره تلفن 33347248-061 مجتمع عالي آموزشي و پژوهشي صنعت آب و برق خوزستان به عنوان مجري آزمون در وقت اداري تماس حاصل نمایید.</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://kwphc.ir/Azmoon/AzmoonAdv/Azmoon14030518.pdf" target="_blank"><span style="color:#4b0082;"><span style="font-size:20px;">دریافت آگهی</span></span></a></p>
<p dir="RTL" style="text-align: center;">
	<a href="https://estekhdam.kwphc.ir" target="_blank"><span style="color:#800080;"><span style="font-size:20px;">لینک ثبت نام</span></span></a></p>
', '60238ForNews.jpg', 6174, '1403/4/31', '10:02:35 AM', 1403, 'تیر', 4, '31');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60239, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'معرفی مدیر و اعضای‌ شورای راهبردی مرکز رشد شهدای صنعت آب ‌و‌ برق خوزستان', '<p dir="RTL" style="text-align: justify;">
	طی مراسمی با حضور دکتر هودگر رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب &zwnj;و برق خوزستان ، دکتر عرب زاده معاونت آموزشی و پژوهشی مجتمع، آقای مهندس محمد لیموئی به عنوان مدیر مرکز رشد شهدای صنعت آب و برق خوزستان معرفی شدند.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	طی مراسمی با حضور دکتر هودگر رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب &zwnj;و برق خوزستان، دکتر عرب زاده معاونت آموزشی و پژوهشی مجتمع، آقای مهندس محمد لیموئی به عنوان مدیر مرکز رشد شهدای صنعت آب و برق خوزستان معرفی شدند. در این مراسم دکتر هودگر&nbsp; با اشاره به مسئولیت و اهداف مهم مرکز رشد، مدیر&nbsp; مرکز رشد و اعضای شورای راهبردی را معرفی نمودند.</p>
<p dir="RTL" style="text-align: justify;">
	دکتر هودگر&nbsp; با توجه به شعار سال به بیان برنامه&zwnj;های حوزه معاونت آموزشی و پژوهشی مجتمع در حوزه فناوری پرداختند. ایشان ابراز امیدواری کردند که با همکاری های صورت گرفته با پارک پژوهشگاه نیرو و سازمان بسیج علمی و پژوهشی خوزستان، مرکز رشد شهدای صنعت آب و برق خوزستان از سال گذشته در عرصه کارآفرینی، نوآوری و اجرای استارت تاپ موفق بوده است .</p>
<p dir="RTL" style="text-align: justify;">
	لازم به توضیح است که در این مراسم اعضای شورای راهبردی مرکز رشد،حکم مدیر مرکز رشد با پیشنهاد ریاست مجتمع ابلاغ شد.</p>
<ul>
	<li dir="RTL" style="text-align: justify;">
		دکتر مهدی هودگر ریاست شورای راهبردی</li>
	<li dir="RTL" style="text-align: justify;">
		دکتر اسماعیل عرب زاده نایب رئیس شواری راهبردی</li>
	<li dir="RTL" style="text-align: justify;">
		دکتر طالب زاده عضو شواری راهبردی</li>
	<li dir="RTL" style="text-align: justify;">
		خانم دکتر الهام ساکی مالحی عضو شواری راهبردی</li>
	<li dir="RTL" style="text-align: justify;">
		خانم مهندس صدری صیفی عضو شورای راهبردی</li>
	<li dir="RTL" style="text-align: justify;">
		مهندس محمد لیموئی دبیر شورای راهبردی</li>
</ul>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_204.jpeg" style="height: 400px; width: 600px;" /></p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_205.jpeg" style="height: 419px; width: 600px;" /></p>
<p>
	&nbsp;</p>
', '60239Main.jpg', 4427, '1403/6/11', '10:48:01 AM', 1403, 'شهریور', 6, '11');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60240, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'پذیرش دانشجو بدون کنکور در مقاطع کاردانی و کارشناسی ناپیوسته علمی کاربردی', '<p style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان همانند سنوات گذشته در راستای رسالت خود مبنی بر مهارت افزایی و پرورش تکنسین و کارشناس متخصص، جهت نیمسال مهرماه ۱۴۰۳ در دو مقطع کاردانی و کارشناسی ناپیوسته اقدام به پذیرش دانشجو (بدون کنکور) می نماید.</p>', '<p style="text-align: justify;">
	پذیرش دانشجوی علمی کاربردی جهت مهرماه ۱۴۰۳ در مقاطع کاردانی و کارشناسی به زودی آغاز می گردد.<br />
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان همانند سنوات گذشته در راستای رسالت خود مبنی بر مهارت افزایی و پرورش تکنسین و کارشناس متخصص، جهت نیمسال مهرماه ۱۴۰۳ در دو مقطع کاردانی و کارشناسی در رشته های مختلف اقدام به پذیرش دانشجو (بدون کنکور) می نماید.<br />
	🔥 اضافه شدن سه رشته جدید و کاربردی:<br />
	⬅️ مهندسی تجهیزات پزشکی<br />
	⬅️ مدیریت امداد و سوانح طبیعی<br />
	⬅️ مترجمی زبان انگلیسی<br />
	<br />
	⏱ زمان ثبت نام:<br />
	- کاردانی: ۱۹ لغایت ۲۴ شهریور<br />
	- کارشناسی: ۲۱ لغایت ۲۶ شهریور<br />
	<br />
	📌 نحوه ثبت نام:<br />
	- مراجعه به سایت www.sanjesh.org<br />
	- به صورت حضوری در محل مرکز آب و برق<br />
	<br />
	📝 اطلاعات بیشتر:<br />
	📞 ۰۶۱-۳۳۳۴۰۰۷۰</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_206.jpeg" style="height: 876px; width: 700px;" /></p>', '60240Mainphoto.jpg', 1588, '1403/6/15', '5:15:08 PM', 1403, 'شهریور', 6, '15');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60241, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'برگزاری اردوی راهیان پیشرفت', '<p style="text-align: justify;">
	اردوی راهیان پیشرفت با حضور دانشجویان و مسئولان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان از روند پروژه فاضلاب اهواز برگزار شد.</p>
', '<p style="text-align: justify;">
	به گزارش روابط عمومی مجتمع عالی، دکتر مهدی هودگر صبح دوشنبه 26 شهریور 1403 در حاشیه برپایی اردوی راهیان پیشرفت در قرارگاه خاتم&zwnj;الانبیا اهواز اظهار داشت: این اردو در راستای شناخت دانشجویان با دستاوردهای انقلاب و پیروفرمایشات مقام معظم رهبری در خصوص اردوهای راهیان پیشرفت که یکی از رسالت&zwnj;های مهم اجتماعی ما و دست&zwnj;اندرکاران حوزه ی علمی و دانشگاهی&nbsp; جهاد تبیین است انجام شده و این اردوها تداوم خواهد داشت.<br />
	وی افزود: برای عمران و آبادانی استان خوزستان، اقدامات ارزشمندی به ویژه در حوزه آبرسانی؛ نیروگاهی و رفع مشکلات و معضلات فاضلاب&nbsp; انجام گردیده که تبیین این دستاوردها و آشنایی مردم و بالاخص دانشجویان با این خدمات، لازم و ضروری است.<br />
	در این بازدید یک روزه که ۴۰ نفر از دانشجویان مستعد از رشته های مهندسی عمران- فاضلاب ؛ایمنی و حفاظت کاری و مهندسی HSE بهمراه معاونت آموزشی و پژوهشی مجتمع (دکتر عرب زاده) و متولی امور فرهنگی (حاج آقا قدوسی) حضور داشتند از روند پروژه فاضلاب و اهداف این پروژه بازدید به عمل آورند و مجریان طرح نیز در ارتباط با آخرین وضعیت پروژه و پیشرفت فیزیکی توضیحات لازم را به صورت مبسوط ارائه و تشریح نمودند.<br />
	امید است دانشجویان از فرصت های پیش آمده بهره و ثمره لازم را برده باشند و بعنوان متخصصین آینده کشور نقش خود را ایفا نمایند.<br />
	هدف اصلی از اردوی راهیان پیشرفت، تبیین و بیان دستاوردهای انقلاب اسلامی ایران در عرصه&zwnj;های مختلف علمی است که باتوجه به پیشرفت کشور در عرصه علمی، لازم است که این دستاوردها در قالب اردوی راهیان&zwnj; پیشرفت بیان و دانشجویان و متخصصین بعنوان راویان پیشرفت موضوعات را تبیین و نشر نمایند.<br />
	در پایان نیز به رسم یادبود، هدایایی از طرف قرارگاه سازندگی خاتم الانبیا به دانشجویان اهدا گردید.</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 1005px">
	<tbody>
		<tr>
			<td style="width: 500px;">
				<img alt="" src="wp-content/uploads/news-images/image_207.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 500px;">
				<img alt="" src="wp-content/uploads/news-images/image_208.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '60241MainPic.jpg', 388, '1403/6/28', '9:03:19 AM', 1403, 'شهریور', 6, '28');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60242, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'حضور بسیجیان مجتمع عالی آموزشی پژوهشی صنعت آب و برق خوزستان در مراسم غبار روبی گلزار شهدا', '<p style="text-align: justify;">
	<span dir="RTL">به مناسبت فرا رسیدن هفته دفاع مقدس با هدف تجدید میثاق با شهدای انقلاب و هشت سال دفاع مقدس مراسم غبار روبی و عطر افشانی مزار شهدا با حضور بسیجیان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در گلزار شهدا برگزار شد.</span></p>
', '<p dir="RTL" style="text-align: justify;">
	به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به مناسبت فرا رسیدن هفته دفاع مقدس با هدف تجدید میثاق با شهدای انقلاب و هشت سال دفاع مقدس مراسم غبار روبی و عطر افشانی مزار شهدا با حضور بسیجیان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در گلزار شهدا برگزار شد.</p>
<p dir="RTL" style="text-align: justify;">
	دکتر مهدی هودگر ریاست مجتمع عالی در این آیین با بیان اینکه شرکت کنندگان در این مراسم با غبار روبی و عطرافشانی مزار شهداء و با قرائت فاتحه ضمن ادای احترام به روح بلند شهدا، بار دیگر با آرمان های امام راحل و شهدای انقلاب اسلامی تجدید میثاق کردندو نیز ضمن بزرگداشت مقام شهدا و به مناسبت هفته دفاع مقدس، اظهار کرد: این هفته یادآور فداکاری&zwnj;ها و خدمت&zwnj;گذاری شهیدان و جانبازان و جان برکفان است، باشد که همه خدمتگزاران و همکاران&nbsp; آن فداکاری&zwnj;ها را سرلوحه کار خود قرار دهند.</p>
<p dir="RTL" style="text-align: justify;">
	وی همچنین افزود:دولت مردان در نظام جمهوری اسلامی ایران با تکیه بر آرمان های امام و شهدا لحظه ای از خدمت رسانی به مردم کوتاهی نخواهند کرد و امید است همکاران ما در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان نیز همواره در راه خدمتگذاری به خانواده صنعت آب و برق و در راستای ماموریت ها و رسالت خویش موفق و توفیق روز افزون داشته باشند.</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 910px">
	<tbody>
		<tr>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_209.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_210.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_211.jpeg" /></td>
		</tr>
		<tr>
			<td style="width: 300px;">
				&nbsp;</td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				&nbsp;</td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_212.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_213.jpeg" /></td>
			<td style="width: 5px;">
				&nbsp;</td>
			<td style="width: 300px;">
				<img alt="" src="wp-content/uploads/news-images/image_214.jpeg" /></td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
', '60242Main.jpg', 340, '1403/7/6', '4:38:30 PM', 1403, 'مهر', 7, '6');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60243, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'بررسی نظامنامه صلاحیت حرفه‌ای نیروی انسانی صنعت آب و برق', '<p dir="RTL" style="text-align: justify;">
	جلسه&zwnj;ی بررسی نظامنامه صلاحیت حرفه&zwnj;ای نیروی انسانی صنعت آب و برق از سوی دفترآموزش، تحقیقات و نوآوری و با حضور نمایندگان شرکت&zwnj;های مادرتخصصی، پژوهشگاه نیرو، آموزشکده فنی خوزستان و دانشگاه شهید بهشتی صبح امروز (مورخ ۹ مهرماه ۱۴۰۳) در محل حوزه ستادی وزارت نیرو برگزار شد.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	جلسه&zwnj;ی بررسی نظامنامه صلاحیت حرفه&zwnj;ای نیروی انسانی صنعت آب و برق از سوی دفترآموزش، تحقیقات و نوآوری و با حضور نمایندگان شرکت&zwnj;های مادرتخصصی، پژوهشگاه نیرو، آموزشکده فنی خوزستان و دانشگاه شهید بهشتی صبح امروز (مورخ ۹ مهرماه ۱۴۰۳) در محل حوزه ستادی وزارت نیرو برگزار شد.</p>
<p dir="RTL" style="text-align: justify;">
	در این نشست، نکته نظرات اعضای کارگروه در خصوص نظامنامه پیشنهادی دفتر آموزش، تحقیقات و نوآوری وزارت نیرو مطرح و مورد بحث و تبادل نظر قرار گرفت و در نهایت مقرر شد به منظور&nbsp;&nbsp; تصویب و ابلاغ نظامنامه فوق، آخرین اصلاحات در اسرع وقت به این دفتر ارائه شود.</p>
<p dir="RTL" style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_215.jpeg" style="height: 700px; width: 700px;" /></p>
', '60243Main.jpg', 773, '1403/7/10', '10:53:52 AM', 1403, 'مهر', 7, '10');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60245, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری مراسم عزاداری شهادت حضرت زهرا سلام‌الله‌علیها', '<p>
	مراسم عزاداری ایام فاطمیه به مدت 3 روز در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار می شود.</p>', '<p>
	به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، مراسم عزاداری ایام فاطمیه&nbsp; از روز شنبه 26&nbsp; آبان&zwnj;ماه به مدت 3 روز در محل نمازخانه مجتمع بعد از نماز ظهر و عصر برگزار خواهد شد.</p>
<p>
	&nbsp;</p>
<p>
	<img alt="" src="wp-content/uploads/news-images/image_216.jpeg" /></p>', '60244AZA.jpg', 169, '1403/8/23', '3:57:54 PM', 1403, 'آبان', 8, '23');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60246, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'بازدید مسئول مرکز مدیریت راهبردی افتا خوزستان از مجتمع آموزشی آب و برق خوزستان', '<p>
	حسینی فر، مسئول مرکز مدیریت راهبردی افتا در استان خوزستان از مجتمع آموزشی آب و برق خوزستان بازدید کرد، در جریان این بازدید که با حضور رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان و مشاور حقوقی این مجتمع انجام شد، فرصت های توسعه همکاری ها و ظرفیت های هر دو نهاد مورد بحث و تبادل نظر قرار گرفت.</p>
', '<p>
	حسینی فر، مسئول مرکز مدیریت راهبردی افتا در استان خوزستان از مجتمع آموزشی آب و برق خوزستان بازدید کرد، در جریان این بازدید که با حضور رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان و مشاور حقوقی این مجتمع انجام شد، فرصت های توسعه همکاری ها و ظرفیت های هر دو نهاد مورد بحث و تبادل نظر قرار گرفت.</p>
<p>
	&nbsp;</p>
<p>
	همچنین راهکارهای افزایش تعاملات بین مجتمع آب و برق خوزستان و مدیریت راهبردی افتا استان خوزستان و نحوه فرهنگ سازی امنیت سایبری و آموزش های مورد نیاز متخصصین بومی استان نیز از جمله موضوعات این جلسه بود.</p>
<p>
	&nbsp;</p>
<p>
	&nbsp;</p>
', '60246Untitled.jpg', 325, '1403/8/26', '11:28:12 AM', 1403, 'آبان', 8, '26');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60247, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری موفق آزمون صلاحیت حرفه‌ای نیروهای پیمانکار در شرکت توزیع نیروی برق خوزستان', '<p dir="RTL">
	آزمون صلاحیت حرفه&zwnj;ای برای تبدیل وضعیت 365 نفر از نیروهای پیمانکار شاغل در شرکت توزیع نیروی برق خوزستان با حضور نمایندگان دستگاه متقاضی و به صورت هماهنگ در سطح کشور برگزار شد. این آزمون از ساعت 10:00 صبح آغاز و در ساعت 11:45 به پایان رسید<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '<p dir="RTL">
	به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در روز جمعه مورخ 25 آبان ماه ، آزمون صلاحیت حرفه&zwnj;ای جهت تبدیل وضعیت نیروهای پیمانکار شاغل در شرکت توزیع نیروی برق خوزستان برگزار شد<span dir="LTR">. </span>این آزمون با حضور 365 نفر از واجدین شرایط، در محل سالن آزمون اداره کل فنی حرفه&zwnj;ای خوزستان برگزار گردید<span dir="LTR">.</span></p>
<p dir="RTL">
	آزمون مذکور طبق ساعت از پیش تعیین شده به صورت هماهنگ در کل کشور آغاز شد و از ساعت 10:00 صبح شروع و تا ساعت 11:45 ادامه یافت. مجری برگزاری این آزمون، اداره صلاحیت حرفه&zwnj;ای مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان بود<span dir="LTR">.</span></p>
<p dir="RTL">
	همچنین، نمایندگان دستگاه متقاضی (توزیع برق خوزستان) به عنوان ناظر آزمون در محل برگزاری حاضر شدند و پس از اتمام آزمون، مراتب رضایتمندی دستگاه متقاضی از اجرای آزمون اعلام گردید. این اقدام گامی مثبت در راستای ارتقاء کیفیت خدمات و تبدیل وضعیت نیروهای پیمانکار به شمار می&zwnj;آید<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '60247azmoon.jpg', 287, '1403/8/27', '10:54:41 AM', 1403, 'آبان', 8, '27');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60248, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'حضور پر رنگ کارکنان بسیجی موسسه عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در رزمایش بزرگ الی بیت المقدس ۱۵', '<p>
	این رزمایش بزرگ با حضور ۲۵۰ گردان بسیج خواهران و برادران در راستای منویات رهبر معظم انقلاب و با هدف حفظ اقتدار نظام، تقویت بنیه دفاعی کشور و همچنین بالا بردن سطح آمادگی و توانایی رزمی نیروهای بسیج انجام شد .</p>
', '<p>
	&nbsp;این رزمایش بزرگ با حضور ۲۵۰ گردان بسیج خواهران و برادران در راستای منویات رهبر معظم انقلاب و با هدف حفظ اقتدار نظام، تقویت بنیه دفاعی کشور و همچنین بالا بردن سطح آمادگی و توانایی رزمی نیروهای بسیج انجام شد .<br />
	<br />
	&nbsp;به گزارش روابط عمومی مجتمع آموزشی صنعت آب و برق خوزستان، دومین روز از رزمایش ۶۰ هزار نفری الی بیت المقدس با نام سردار محمدرضا زاهدی شهید سپاه قدس، صبح جمعه با حضور سردار حسین سلامی فرمانده کل سپاه پاسداران، جمعی از فرماندهان نیروهای مسلح و مسئولان استان خوزستان و گردان&zwnj;های بسیج سراسر استان برگزار شد، که اعضای پایگاه مقاومت بسیج موسسه عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در این رزمایش حضور فعال داشتند.</p>
', '60248razmayesh1.jpg', 217, '1403/9/4', '12:38:00 AM', 1403, 'آذر', 9, '4');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60249, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'با هدف  آسیب شناسی و احصاء چالش‌های اجرای دوره‌های آموزشی  آموزشی سال ١۴٠٣ برگزار شد', '<p>
	&nbsp;به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، جلسه هم افزایی و بررسی تقویم آموزشی با محوریت گزارش عملکرد میزان تحقق تقویم سال ١۴٠٣ و آسیب شناسی آن با حضور رییس گروه آموزش، نماینده مدیریت ایمنی و سازمان آب وبرق خوزستان، مدیران آموزش شرکت&zwnj;&zwnj;های طرف قرارداد سازمان آب و برق خوزستان آب و برق خوزستان برگزار شد.</p>
', '<p>
	&nbsp;به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، جلسه هم افزایی و بررسی تقویم آموزشی با محوریت گزارش عملکرد میزان تحقق تقویم سال ١۴٠٣ و آسیب شناسی آن با حضور رییس گروه آموزش، نماینده مدیریت ایمنی و سازمان آب وبرق خوزستان، مدیران آموزش شرکت&zwnj;&zwnj;های طرف قرارداد سازمان آب و برق خوزستان آب و برق خوزستان برگزار شد.<br />
	<br />
	&nbsp;در این نشست حاضران با ارائه گزارشاتی از میزان تحقق برنامه تقویم در سال جاری به عارضه&zwnj;یابی و بیان چالش&zwnj;های مسیر پیش روی اجرای دوره&zwnj;های آموزشی ضمن خدمت پرداختندو همچنین میزان پیشرفت تدوین تقویم آموزشی سال ١۴٠۴ نیز از جمله مباحثی بود که در این جلسه مورد بحث و تبادل نظر قرار گرفت.<br />
	<br />
	&nbsp;بررسی میزان عملکرد شرکت&zwnj;ها بر اساس دوره و نفرماه توسط اسماعیل عرب زاده، معاون برنامه ریزی آموزشی مجتمع عالی آموزشی صنعت آب و برق خوزستان صورت گرفت.<br />
	<br />
	&nbsp;رئیس مجتمع عالی آموزش و پژوهش صنعت آب و برق خوزستان و رئیس گروه آموزش سازمان آب و برق استان نیز به صورت مجزا توضیحاتی را در خصوص مقدمات، دستورالعمل&zwnj;ها، الزامات و ضوابط تقویم آموزشی ارائه کردند.</p>
<p>
	<br />
	در این نشست میزان دوره&zwnj;های اجرا شده طی ٨ ماهه اخیر و دوره&zwnj;های باقی مانده تا پایان سال تشریح و برنامه&zwnj; ریزی&zwnj;های لازم جهت جذب بودجه جهت اجرای برنامه&zwnj;های باقی&zwnj;مانده انجام شد و در پایان نیز مدیران و رؤسای آموزش شرکت&zwnj;ها به طرح سوالات، مسائل و چالش&zwnj;های موجود پرداختند و مدیران حاضر پاسخگوی سوالات و دغدغه&zwnj;های آنان شدند.<br />
	<br />
	&nbsp;</p>
', '60249AMOO.jpg', 214, '1403/9/9', '3:44:36 PM', 1403, 'آذر', 9, '9');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60250, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری جلسه شورای فرهنگی مجتمع صنعت آب و برق خوزستان با محوریت گزارش عملکرد و برنامه‌ریزی فرهنگی', '<p>
	&nbsp;در جلسه&zwnj;ای که به منظور ارائه گزارش عملکرد امور فرهنگی در آبان ماه برگزار شد، شورای فرهنگی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به بررسی تمامی مصوبات مربوط به این ماه پرداخت. این جلسه با حضور ریاست محترم و اعضای شورای فرهنگی برگزار گردید و در آن برنامه&zwnj;های فرهنگی آذر ماه نیز مورد بحث و بررسی قرار گرفت.</p>', '<p>
	&nbsp;در جلسه&zwnj;ای که به منظور ارائه گزارش عملکرد امور فرهنگی در آبان ماه برگزار شد، شورای فرهنگی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به بررسی تمامی مصوبات مربوط به این ماه پرداخت. این جلسه با حضور ریاست محترم و اعضای شورای فرهنگی برگزار گردید و در آن برنامه&zwnj;های فرهنگی آذر ماه نیز مورد بحث و بررسی قرار گرفت.<br />
	<br />
	در این جلسه، تقویم فرهنگی آذر ماه به تصویب رسید و تصمیمات مهمی در خصوص راه&zwnj;اندازی هیئت اندیشه&zwnj;ورز دانشجویی اتخاذ شد. این هیئت با هدف ارتقاء سطح تفکر و خلاقیت دانشجویان و ایجاد فضایی برای تبادل نظر و ایده&zwnj;ها تشکیل خواهد شد.<br />
	<br />
	&nbsp;همچنین، برنامه&zwnj;های فرهنگی ویژه&zwnj;ای برای کارکنان و دانشجویان در نظر گرفته شده است که انتظار می&zwnj;رود با استقبال خوبی مواجه شود. این برنامه&zwnj;ها به منظور تقویت روحیه همکاری و همبستگی در میان اعضای مجتمع طراحی شده&zwnj;اند.<br />
	<br />
	&nbsp;این اقدامات نشان&zwnj;دهنده عزم جدی مسئولان امور فرهنگی در راستای ارتقاء سطح فعالیت&zwnj;های فرهنگی و اجتماعی در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان است و امید می&zwnj;رود که با اجرای این برنامه&zwnj;ها، فضای فرهنگی مجتمع بیش از پیش رونق یابد.<br />
	&nbsp;</p>', '60250farhangi.jpg', 186, '1403/9/15', '9:43:26 PM', 1403, 'آذر', 9, '15');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60252, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'آیین بزرگداشت روز دانشجو و جشن  دانشجویان جدید الورود ۱۴۰۳ برگزار شد', '<p>
	به گزارش روابط عمومی مجتمع ، آیین بزرگداشت روز دانشجو و جشن دانشجویان جدید الورود ۱۴۰۳ با حضور کیانوش بهرهی، سرپرست دانشگاه علمی کاربردی استان خوزستان و مهدی هودگر، رییس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد.</p>
', '<p>
	&nbsp;به گزارش روابط عمومی مجتمع ، آیین بزرگداشت روز دانشجو و جشن دانشجویان جدید الورود ۱۴۰۳ با حضور کیانوش بهرهی، سرپرست دانشگاه علمی کاربردی استان خوزستان و مهدی هودگر، رییس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد.<br />
	<br />
	&nbsp;در ابتدای این برنامه، دکتر هودگر با تبریک روز دانشجو به تمامی دانشجویان، به ویژه دانشجویان جدید الورود، خیر مقدم گفت و اهمیت این روز را در تاریخ دانشگاه&zwnj;ها و نقش دانشجویان در پیشرفت جامعه یادآوری کرد.<br />
	&nbsp;سپس، رییس دانشگاه علمی کاربردی استان خوزستان به ارائه آمارهایی از عملکرد دانشگاه پرداخت و خدمات دانشجویی ارائه شده در سال&zwnj;های اخیر را تشریح کرد. او همچنین بر لزوم توجه به نیازهای دانشجویان و ارتقای کیفیت آموزشی تاکید کرد.<br />
	&nbsp;در این مراسم، کلیپی با مضمون خاطرات دانشجویی پخش شد که با استقبال گرم دانشجویان روبرو شد. همچنین، یک استندآپ کمدی اجرا شد که لحظات شاد و مفرحی را برای حاضران به ارمغان آورد. در ادامه، منشور اخلاقی دانشجویان قرائت شد که بر اهمیت رفتار اخلاقی و حرفه&zwnj;ای در محیط دانشگاه تاکید داشت.<br />
	در پایان برنامه، جوایز نقدی به شش نفر از برندگان مسابقه کتابخوانی اهدا شد که این اقدام، انگیزه&zwnj;ای برای ترویج فرهنگ مطالعه در بین دانشجویان بود. این آیین با شور و نشاط خاصی برگزار شد و امید می&zwnj;رود که دانشجویان جدید الورود در مسیر تحصیل و پژوهش موفق باشند.</p>
', '60252DANSHJOO.jpg', 169, '1403/9/25', '11:25:07 PM', 1403, 'آذر', 9, '25');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60253, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'با حضور رئیس سازمان فنی و حرفه‌ای کشور: مرکز کارآموزی جوار کارگاهی و بین کارگاهی صنعت آب و برق خوزستان افتتاح شد', '<p>
	مرکز کارآموزی جوار کارگاهی و بین کارگاهی صنعت آب و برق خوزستان با حضور غلامحسین محمدی، معاون وزیر تعاون کار و رفاه اجتماعی و رئیس سازمان فنی و حرفه&zwnj;ای کشور، مهدی هودگر، رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان و برخی مسئولان سازمان در محل مجتمع آموزشی صنعت آب و برق افتتاح شد.</p>', '<p>
	مرکز کارآموزی جوار کارگاهی و بین کارگاهی صنعت آب و برق خوزستان با حضور غلامحسین محمدی، معاون وزیر تعاون کار و رفاه اجتماعی و رئیس سازمان فنی و حرفه&zwnj;ای کشور، مهدی هودگر، رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان و برخی مسئولان سازمان در محل مجتمع آموزشی صنعت آب و برق افتتاح شد.<br />
	<br />
	&nbsp;این مرکز با هدف شناسایی بازارهای مهارت آموزی، طرح&zwnj;ریزی آموزش&zwnj;های مهارتی سفارش محور و انطباق با نیازهای استان و دستیابی به مدل&zwnj;های توانمندسازی شاغلان و کارجویان بازگشایی شد. از جمله اهداف دیگر ایجاد این مرکز می&zwnj;توان به کاهش قیمت تمام شده محصول خدمات با ایجاد جوارهای کارگاهی و بین کارگاهی، بازارسازی آموزش&zwnj;های مهارتی و ... اشاره کرد.<br />
	<br />
	به گفته اسماعیل عرب زاده، معاون برنامه ریزی آموزشی مجتمع عالی آموزشی صنعت آب و برق خوزستان، افتتاح مرکز کارآموزی جوار کارگاهی و بین کارگاهی صنعت آب و برق زمینه&zwnj;ساز کاهش حوادث حین کار، افزایش عمر تجهیزات، افزایش سودآوری بنگاه&zwnj;های اقتصادی و فنی خواهد شد.<br />
	<br />
	&nbsp;از جمله مزایای این مرکز نیز می&zwnj;توان به ارتقاء مهارت اپراتور تولید، مدیران، آموزش اخلاق حرفه&zwnj;ای و آموزش&zwnj;های حین&zwnj;کار، تربیت بازآموزی و تأمین مربی مورد نیاز با استانداردهای فنی و حرفه&zwnj;ای و صنعت اشاره کرد. گفتنی است، شهرام ملایی هزاروندی، مدیر کل آموزش فنی و حرفه&zwnj;ای خوزستان در این آیین رئیس سازمان فنی و حرفه&zwnj;ای کشور را همراهی می&zwnj;کرد.<br />
	<br />
	&nbsp;</p>', '60253VAZIR.jpg', 169, '1403/9/25', '11:28:21 PM', 1403, 'آذر', 9, '25');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60254, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'آگهي آزمون بکارگیری نیروی حجمي', '<p dir="RTL" style="text-align: justify;">
	به اطلاع ميرساند شرکت های پیمانکار طرف قرارداد شرکت توزیع نیروی برق استان ایلام به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید<span dir="LTR">.</span></p>
', '<p dir="RTL" style="text-align: justify;">
	به اطلاع مي رساند شرکت های پیمانکار طرف قرارداد شرکت توزیع نیروی برق استان ایلام به منظور تأمين نيروي انساني مورد نياز، تعداد 7 نفر (تعداد: 3 نفر به عنوان سيمبان خط &ndash; سرد(بهره برداري)، 3 نفر به عنوان سيمبان مشترکين (قطع و وصل) و 1 نفر مأمور قرائت کنتور) از آقایان واجد شرايط را از طريق برگزاري آزمون و طي فرآيند گزينش و به ترتيب از بالاترين نمره کسب شده با شرايط ذيل در قالب قرارداد نیروی حجمي بکارگيري مي نمايد<strong><span dir="LTR">.</span></strong></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	<a href="https://estekhdam.kwphc.ir/azmoon140310/"><strong><span style="font-size:16px;"><span style="color:#800080;">ورود به سامانه ثبت نام</span></span></strong></a></p>
<p dir="RTL" style="text-align: center;">
	<a href="http://kwphc.ir/Azmoon/AzmoonAdv/Adv14031010.pdf"><strong><span style="color:#008000;"><span style="font-size:16px;">دریافت فایلهای ضمیمه</span></span></strong></a></p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_217.jpeg" style="height: 912px; width: 650px;" /></p>
', '60254IlamEstekhdam.jpg', 1038, '1403/9/28', '3:52:59 PM', 1403, 'آذر', 9, '28');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60255, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'حضور فعال غرفه مرکز رشد صنعت آب و برق خوزستان در نمایشگاه فن بازار', '<p>
	غرفه مرکز رشد شهدای صنعت آب و برق خوزستان در نمایشگاه فن بازار استان خوزستان که در محل کتابخانه مرکزی اهواز در حال برگزاری است، با استقبال گسترده&zwnj;ای مواجه شده است. این نمایشگاه فرصتی مناسب برای معرفی نوآوری&zwnj;ها و دستاوردهای فناورانه در حوزه صنعت آب و برق به شمار می&zwnj;رود.</p>', '<p>
	&nbsp;غرفه مرکز رشد شهدای صنعت آب و برق خوزستان در نمایشگاه فن بازار استان خوزستان که در محل کتابخانه مرکزی اهواز در حال برگزاری است، با استقبال گسترده&zwnj;ای مواجه شده است. این نمایشگاه فرصتی مناسب برای معرفی نوآوری&zwnj;ها و دستاوردهای فناورانه در حوزه صنعت آب و برق به شمار می&zwnj;رود.<br />
	در این رویداد مهم، معاون اقتصادی استاندار خوزستان، رئیس بنیاد نخبگان خوزستان و رئیس پژوهش و توسعه منطقه ویژه اقتصادی ماهشهر با حضور در غرفه مرکز رشد شهدای صنعت آب و برق خوزستان، از نزدیک با فعالیت&zwnj;ها و پروژه&zwnj;های این مرکز آشنا شدند.<br />
	&nbsp;حضور مسئولان ارشد استان در این نمایشگاه نشان&zwnj;دهنده اهمیت و توجه ویژه به توسعه فناوری&zwnj;های نوین در صنایع مرتبط با آب و برق است. غرفه مرکز رشد شهدای صنعت آب و برق خوزستان در تلاش است تا با ارائه ایده&zwnj;ها و راهکارهای نوآورانه، نقش موثری در پیشرفت این صنایع ایفا کند.<br />
	<br />
	&nbsp;</p>', '60255fanbazar.jpg', 38, '1403/10/9', '11:15:28 PM', 1403, 'دی', 10, '9');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60256, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری مراسم جشن ولادت حضرت فاطمه زهرا (س) و گرامیداشت روز زن در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان', '<p>
	&nbsp;مراسم جشن ولادت با سعادت حضرت فاطمه زهرا سلام الله علیها و گرامیداشت روز زن با حضور ریاست محترم مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، معاونین مجتمع و بانوان شاغل در این مجتمع، در سالن جلسات برگزار شد.</p>', '<p>
	&nbsp;مراسم جشن ولادت با سعادت حضرت فاطمه زهرا سلام الله علیها و گرامیداشت روز زن با حضور ریاست محترم مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، معاونین مجتمع و بانوان شاغل در این مجتمع، در سالن جلسات برگزار شد.</p>
<p>
	&nbsp;در این مراسم، مهدی هودگر، ریاست مجتمع، ضمن تبریک و گرامیداشت این روز فرخنده، به مقام والای زن در اسلام اشاره کرد و اهمیت نقش زنان در خانواده و جامعه را مورد تأکید قرار داد. وی با بیان ویژگی&zwnj;های بارز حضرت فاطمه زهرا (س)، از ایشان به عنوان الگوی کامل زنان مسلمان یاد کرد.در ادامه، معاونین مجتمع و بانوان حاضر در مراسم نیز هر کدام به نوبه خود این روز را به همکاران خود تبریک گفتند و از زحمات و تلاش&zwnj;های بانوان شاغل در مجتمع قدردانی کردند.</p>
<p>
	<br />
	&nbsp;مراسم با تقدیر و تجلیل از بانوان شاغل در مجتمع به پایان رسید که نشان&zwnj;دهنده احترام و ارادت به مقام زن و تلاش&zwnj;های ارزشمند آنان در پیشبرد اهداف مجتمع بود. این مراسم به عنوان یک رویداد فرهنگی و اجتماعی، فرصت مناسبی برای ایجاد همبستگی و تبادل نظر میان بانوان شاغل در صنعت آب و برق فراهم آورد.<br />
	<br />
	&nbsp;</p>', '60256roozzann.jpg', 126, '1403/10/9', '11:18:16 PM', 1403, 'دی', 10, '9');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60257, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'رویداد ارائه نیازهای فناورانه احصا شده شرکت شهرک های صنعتی خوزستان در نمایشگاه فن بازار خوزستان', '<p>
	در حاشیه برگزاری نمایشگاه فن بازار خوزستان، رویداد مهمی به منظور ارائه نیازهای فناورانه احصا شده از سوی شرکت شهرک&zwnj;های صنعتی خوزستان توسط پارک علم و فناوری خوزستان برگزار گردید. این رویداد فرصتی مناسب برای تبادل نظر و همفکری میان فعالان صنعت و پژوهشگران و ایده پردازان فراهم آورد.</p>', '<p>
	در حاشیه برگزاری نمایشگاه فن بازار خوزستان، رویداد مهمی به منظور ارائه نیازهای فناورانه احصا شده از سوی شرکت شهرک&zwnj;های صنعتی خوزستان توسط پارک علم و فناوری خوزستان برگزار گردید. این رویداد فرصتی مناسب برای تبادل نظر و همفکری میان فعالان صنعت و پژوهشگران و ایده پردازان فراهم آورد.<br />
	&nbsp;در این جلسه، معاون برنامه&zwnj;ریزی آموزشی و معاون مالی و پشتیبانی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان نیز حضور داشتند.این حضور نشان&zwnj;دهنده اهمیت موضوعات فناورانه و نیازهای صنعتی در توسعه و اقتصاد پایدار و همچنین توان بومی و داخلی&nbsp; استان است.<br />
	&nbsp;مکان برگزاری این رویداد، سالن کنفرانس کتابخانه مرکزی اهواز&nbsp;&nbsp; به عنوان یک فضای مناسب برای برگزاری نشست&zwnj;های علمی و تخصصی انتخاب گردید. شرکت&zwnj;کنندگان در این جلسه با ارائه نظرات و پیشنهادات خود، به بررسی چالش&zwnj;ها و فرصت&zwnj;های موجود در حوزه فناوری پرداختند.<br />
	&nbsp;این رویداد نه تنها به شناسایی نیازهای فناورانه کمک&nbsp; خواهد کرد، بلکه زمینه&zwnj;ساز همکاری&zwnj;های بیشتر بین نهادهای علمی و صنعتی در استان خوزستان و اهمیت ارتباط صنعت و دانشگاه خواهد بود.</p>', '60257faanbazarr.jpg', 116, '1403/10/9', '11:21:35 PM', 1403, 'دی', 10, '9');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60258, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'کسب سه عنوان برتر توسط مرکز رشد شهدای صنعت آب و برق خوزستان در شانزدهمین جشنواره جهادگران علم و فناوری خوزستان', '<p>
	شانزدهمین جشنواره جهادگران علم و فناوری استان خوزستان، به میزبانی سازمان منطقه ویژه اقتصادی پتروشیمی، در دی ماه سال جاری برگزار شد. این جشنواره با هدف شناسایی و حمایت از مخترعان و نوآوری&zwnj;های برتر در حوزه&zwnj;های علمی و صنعتی طراحی شده بود و به عنوان یک رویداد مهم در تقویت روحیه نوآوری و خلاقیت در استان شناخته می&zwnj;شود.</p>', '<p>
	شانزدهمین جشنواره جهادگران علم و فناوری استان خوزستان، به میزبانی سازمان منطقه ویژه اقتصادی پتروشیمی، در دی ماه سال جاری برگزار شد. این جشنواره با هدف شناسایی و حمایت از مخترعان و نوآوری&zwnj;های برتر در حوزه&zwnj;های علمی و صنعتی طراحی شده بود و به عنوان یک رویداد مهم در تقویت روحیه نوآوری و خلاقیت در استان شناخته می&zwnj;شود.<br />
	&nbsp;در این رویداد، مرکز رشد شهدای صنعت آب و برق خوزستان موفق به کسب سه عنوان برتر شد که این موفقیت در اولین سال تاسیس این مرکز، نشان از توانمندی و پتانسیل بالای آن دارد. همچنین، این مرکز به عنوان مرکز رشد برتر معرفی و تقدیر گردید که بیانگر کیفیت و اثرگذاری فعالیت&zwnj;های آن در زمینه پرورش ایده&zwnj;ها و حمایت از مخترعان است.<br />
	&nbsp;از دیگر دستاوردهای مهم در این جشنواره، معرفی دو تیم مستقر در مرکز رشد شهدای صنعت آب و برق به عنوان جز ۱۰ اختراع برتر بود .</p>', '60258roooshd.jpg', 419, '1403/10/9', '11:25:21 PM', 1403, 'دی', 10, '9');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60259, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری جلسه مشترک برای بررسی تسهیلات رفاهی کارکنان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق', '<p>
	در یک نشست به منظور ارتقا خدمات به سرمایه های انسانی مجتمع ، مهدی هودگر، رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، به همراه معاون مالی و پشتیبانی مجتمع و مشاور حقوقی ایشان با محمد قصری،رئیس&nbsp; سرپرستی بانک رسالت استان خوزستان دیدار کردند. هدف این جلسه بررسی راهکارها و اخذ تسهیلات رفاهی برای کارکنان مجتمع بود.</p>', '<p>
	در یک نشست به منظور ارتقا خدمات به سرمایه های انسانی مجتمع ، مهدی هودگر، رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، به همراه معاون مالی و پشتیبانی مجتمع و مشاور حقوقی ایشان با محمد قصری،رئیس&nbsp; سرپرستی بانک رسالت استان خوزستان دیدار کردند. هدف این جلسه بررسی راهکارها و اخذ تسهیلات رفاهی برای کارکنان مجتمع بود.<br />
	&nbsp;در این جلسه، موضوعات متنوعی در خصوص تسهیلات رفاهی مطرح شد و روند فعلی اعطای این تسهیلات مورد بررسی قرار گرفت. کارکنان مجتمع در حال تشکیل پرونده برای دریافت این تسهیلات هستند و برنامه&zwnj;های مربوط به آن در حال توسعه است.<br />
	&nbsp;این اقدام نشان&zwnj;دهنده توجه ویژه به رفاه کارکنان و تلاش برای بهبود شرایط کاری آنهاست. انتظار می&zwnj;رود با همکاری&zwnj;های بیشتر بین بانک رسالت و مجتمع عالی آموزشی و پژوهشی صنعت آب و برق، خدمات بهتری به کارکنان ارائه شود و شرایط رفاهی آنها ارتقاء یابد.<br />
	<br />
	&nbsp;</p>', '60259resalat.jpg', 153, '1403/10/9', '11:26:49 PM', 1403, 'دی', 10, '9');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60260, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'کسب رتبه چهارم استانی در جذب حداکثری دانشجو توسط مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان', '<p dir="RTL" style="text-align: justify;">
	سرپرست دانشگاه جامع علمی کاربردی استان خوزستان با صدور پیامی، از ریاست و کارکنان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به خاطر تلاش&zwnj;های ارزشمندشان در جذب حداکثری دانشجویان در مهر سال 1403 قدردانی کرد<span dir="LTR">. </span></p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	سرپرست دانشگاه جامع علمی کاربردی استان خوزستان با صدور پیامی، از ریاست و کارکنان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به خاطر تلاش&zwnj;های ارزشمندشان در جذب حداکثری دانشجویان در مهر سال 1403 قدردانی کرد<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	در این پیام، کیانوش بهری با اشاره به کسب رتبه چهارم این مجتمع در جذب دانشجو در سطح استان، این موفقیت را نتیجه همت و تلاش مستمر ریاست و کارکنان مجتمع دانست و بر اهمیت آموزش&zwnj;های مهارتی و تخصصی در توسعه صنعت آب و برق تاکید کرد<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	وی همچنین ابراز امیدواری کرد که با ادامه این روند، مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان بتواند به عنوان یک الگوی موفق در جذب دانشجویان و ارتقاء کیفیت آموزش در استان شناخته شود. این تقدیر نشان&zwnj;دهنده توجه ویژه دانشگاه جامع علمی کاربردی به فعالیت&zwnj;های آموزشی و پژوهشی در راستای تحقق اهداف توسعه&zwnj;ای استان خوزستان است<span dir="LTR">. </span></p>
<p>
	&nbsp;</p>
', '60260taghdir.jpg', 77, '1403/10/16', '6:55:03 PM', 1403, 'دی', 10, '16');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60261, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'به مناسبت دهه فجر مرکز رشد شهدای صنعت آب و برق خوزستان برگزار می‌کند', '<p dir="RTL" style="text-align: justify;">
	مرکز رشد شهدای صنعت آب و برق خوزستان با هدف ترویج و گسترش سواد آبی در جامعه، رویداد استارتاپی ویژه&zwnj;ای را تحت عنوان &quot;گسترش سواد آبی&quot; برگزار می&zwnj;کند. این رویداد به دنبال شناسایی و حمایت از ایده&zwnj;های نوآورانه در زمینه استفاده بهینه از منابع آبی است<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	مرکز رشد شهدای صنعت آب و برق خوزستان با هدف ترویج و گسترش سواد آبی در جامعه، رویداد استارتاپی ویژه&zwnj;ای را تحت عنوان &quot;گسترش سواد آبی&quot; برگزار می&zwnj;کند. این رویداد به دنبال شناسایی و حمایت از ایده&zwnj;های نوآورانه در زمینه استفاده بهینه از منابع آبی است<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	<span dir="LTR"><img alt="🔹" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png" width="64" /></span> محورهای رویداد</p>
<p dir="RTL" style="text-align: justify;">
	روش های نوین آموزشی در ترویج سواد آبی</p>
<p dir="RTL" style="text-align: justify;">
	فناوری های نوین در ترویج سواد آبی</p>
<p dir="RTL" style="text-align: justify;">
	فرهنگ سازی در استفاده بهتر از آب</p>
<p dir="RTL" style="text-align: justify;">
	<span dir="LTR"><img alt="🔹" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png" width="64" /></span> مزایا<span dir="LTR">:</span></p>
<p dir="RTL" style="text-align: justify;">
	اهدای جوایز و لوح تقدیر به ایده های برتر شرکت کننده در رویداد به همراه برگزاری کارگاه های پیش رشد</p>
<p dir="RTL" style="text-align: justify;">
	<span dir="LTR"><img alt="🔹" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png" width="64" /></span> مهلت ثبت ایده ۰۱ بهمن ماه 1403 <span dir="LTR"><img alt="🔹" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png" width="64" /></span>تاریخ برگزاری رویداد ۱۵ بهمن ماه 1403</p>
<p dir="RTL" style="text-align: justify;">
	<span dir="LTR"><img alt="🔹" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png" width="64" /></span> لینک ثبت ایده <a href="https://kwphc.ir/startup" target="_blank"><span dir="LTR">https://kwphc.ir/startup</span></a><span dir="LTR"> <img alt="🔹" border="0" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png" width="64" /></span>لینک برگزاری رویداد <a href="https://elearning.kwphc.ir/" target="_blank"><span dir="LTR">https://elearning.kwphc.ir</span></a></p>
<p dir="RTL" style="text-align: justify;">
	<span dir="LTR"><img alt="🔹" border="0" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png" width="64" /></span> مکان برگزاری مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان</p>
<p dir="RTL" style="text-align: justify;">
	<span dir="LTR"><img alt="🌟" border="0" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image002.png" width="64" /></span> شرکت در این رویداد برای تمام عموم آزاد است<span dir="LTR"><img alt="🌟" border="0" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image002.png" width="64" /></span><span dir="LTR"> <img alt="🌟" border="0" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image002.png" width="64" /></span>برای شرکت در مسابقات و ارائه ایده&zwnj;ها، ثبت&zwnj;نام الزامی است<span dir="LTR"><img alt="🌟" border="0" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image002.png" width="64" /></span></p>
<p dir="RTL" style="text-align: justify;">
	<span dir="LTR"><img alt="🔹" border="0" height="64" src="file:///C:/Users/ADMINI~1.KWP/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png" width="64" /></span> اطلاعات تماس برای ثبت ایده و سوالات برای ثبت ایده و اطلاعات بیشتر با شماره تلفن 633343123-061 - 09023569225 تماس بگیرید یا به آدرس <a href="mailto:Reserch@kwphc.ir" target="_blank"><span dir="LTR">Reserch@kwphc.ir</span></a> ایمیل ارسال فرمائید<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '60261savadabi.jpg', 96, '1403/10/16', '7:01:11 PM', 1403, 'دی', 10, '16');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60262, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'بازدید مسئول نهاد رهبری دانشگاه علمی کاربردی خوزستان از مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به منظور راه‌اندازی مرکز آموزش‌های بین‌الملل', '<p dir="RTL" style="text-align: justify;">
	حجت&zwnj;الاسلام و المسلمین محمدعلی سمیع، مسئول نهاد رهبری در دانشگاه علمی کاربردی استان خوزستان به همراه هیأتی از مسئولین، از مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان بازدید کردند. این بازدید به منظور بررسی و تبادل نظر در خصوص راه&zwnj;اندازی مرکز آموزش&zwnj;های بین&zwnj;الملل در این مجتمع انجام شد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	حجت&zwnj;الاسلام و المسلمین محمدعلی سمیع، مسئول نهاد رهبری در دانشگاه علمی کاربردی استان خوزستان به همراه هیأتی از مسئولین، از مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان بازدید کردند. این بازدید به منظور بررسی و تبادل نظر در خصوص راه&zwnj;اندازی مرکز آموزش&zwnj;های بین&zwnj;الملل در این مجتمع انجام شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در این دیدار، مسئول نهاد رهبری با تأکید بر اهمیت توسعه آموزش&zwnj;های بین&zwnj;المللی در راستای ارتقاء کیفیت آموزشی و پژوهشی، به بررسی ظرفیت&zwnj;ها و امکانات موجود در مجتمع پرداخته و بر لزوم همکاری&zwnj;های بین&zwnj;المللی در این زمینه تأکید کرد<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	مدیران مجتمع نیز ضمن ارائه گزارشی از فعالیت&zwnj;ها و دستاوردهای خود، نظرات و پیشنهادات لازم را برای راه&zwnj;اندازی این مرکز مطرح کردند. این نشست فرصتی مناسب برای تبادل تجربیات و برنامه&zwnj;ریزی جهت توسعه آموزش&zwnj;های بین&zwnj;الملل در حوزه صنعت آب و برق بود<span dir="LTR">. </span></p>
<p>
	&nbsp;</p>
', '60262nahadrahbri.jpg', 87, '1403/10/20', '8:49:35 AM', 1403, 'دی', 10, '20');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60263, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'دیدار رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با فرمانده حوزه مقاومت بسیج شهید عباسپور', '<p dir="RTL" style="text-align: justify;">
	در یک دیدار رسمی، دکتر هودگر، رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، با سرهنگ مسلم زهیری، فرمانده حوزه مقاومت بسیج شهید عباسپور، ملاقات کرد. در این جلسه، دکتر هودگر انتصاب سرهنگ زهیری به عنوان فرمانده حوزه را تبریک گفت و بر اهمیت همکاری&zwnj;های مشترک تاکید کرد<span dir="LTR">. </span></p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	در یک دیدار رسمی، دکتر هودگر، رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، با سرهنگ مسلم زهیری، فرمانده حوزه مقاومت بسیج شهید عباسپور، ملاقات کرد. در این جلسه، دکتر هودگر انتصاب سرهنگ زهیری به عنوان فرمانده حوزه را تبریک گفت و بر اهمیت همکاری&zwnj;های مشترک تاکید کرد<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	این دیدار به منظور هم&zwnj;اندیشی و بررسی راهکارهای برگزاری دوره&zwnj;های توانمندسازی برای فرماندهان پایگاه&zwnj;های زیرمجموعه سازمان آب و برق خوزستان برگزار شد. طرفین در این جلسه بر لزوم ارتقاء سطح علمی و عملی فرماندهان تاکید کردند و به تبادل نظر در خصوص برنامه&zwnj;های آموزشی و پژوهشی آینده پرداختند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	این اقدام به عنوان گامی مهم در جهت تقویت توانمندی&zwnj;ها و افزایش کارایی نیروهای فعال بسیجی در حوزه آب و برق استان خوزستان تلقی می&zwnj;شود<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '60263basiij.jpg', 147, '1403/10/20', '8:56:45 AM', 1403, 'دی', 10, '20');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60264, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'جلسه همفکری مسئولین فرهنگی دانشگاه جامع علمی کاربردی استان خوزستان برگزار شد', '<p dir="RTL" style="text-align: justify;">
	در یک نشست همفکری که با حضور مسئولین فرهنگی دانشگاه جامع علمی کاربردی استان خوزستان برگزار شد، مسئول امور فرهنگی و دینی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان نیز به نمایندگی از این مجتمع حضور یافت</p>
<p style="text-align: justify;">
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	در یک نشست همفکری که با حضور مسئولین فرهنگی دانشگاه جامع علمی کاربردی استان خوزستان برگزار شد، مسئول امور فرهنگی و دینی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان نیز به نمایندگی از این مجتمع حضور یافت<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	این نشست با هدف تبادل نظر و بررسی راهکارهای ارتقاء فعالیت&zwnj;های فرهنگی و دینی در دانشگاه&zwnj;ها برگزار شد. مسئولین حاضر در این جلسه به بحث و بررسی چالش&zwnj;ها و فرصت&zwnj;های موجود در حوزه فرهنگ و دین پرداختند و بر لزوم همکاری&zwnj;های مشترک برای تقویت برنامه&zwnj;های فرهنگی تاکید کردند<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '60264fahang.jpg', 113, '1403/10/20', '8:59:10 AM', 1403, 'دی', 10, '20');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60265, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', '‍ پذیرش دانشجو بدون آزمون', '<p>
	مرکز علمی کاربردی صنعت آب و برق خوزستان در بهمن ماه ۱۴۰۳ و در مقاطع تحصیلی کاردانی و کارشناسی، بدون آزمون دانشجو می پذیرد.</p>', '<p style="text-align: justify;">
	<span style="font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;">آموزش های علمی کاربردی، کوتاه ترین، آسان ترین و کم هزینه ترین مسیر برای ورود به بازار کار</span></p>
<p style="text-align: justify;">
	<span style="font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;">با انتخاب رشته های علمی کاربردی آینده شغلی خود را تضمین کنید.</span></p>
<p style="text-align: justify;">
	<span style="font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;">مرکز علمی کاربردی صنعت آب و برق خوزستان در بهمن ماه ۱۴۰۳ و در مقاطع تحصیلی کاردانی و کارشناسی، بدون آزمون دانشجو می پذیرد.</span></p>
<p style="text-align: justify;">
	<span style="font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;">از علاقه مندان دعوت می گردد جهت ثبت نام به سایت</span><span style="font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;"> </span><a class="anchor-url" href="https://www.sanjesh.org/" rel="noopener noreferrer" style="box-sizing: inherit; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); display: inline-block; direction: ltr; font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;" target="_blank">www.sanjesh.org</a><span style="font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;"> </span><span style="font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;">مراجعه نموده و یا بصورت حضوری ثبت نام خود را در مرکز آب و برق نهایی نمایند.</span></p>
<h1 style="text-align: justify;">
	<span style="color:#ff0000;"><span style="font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;">زمان ثبت نام: یکم لغایت ششم بهمن ماه ۱۴۰۳</span></span></h1>
<h1 style="text-align: justify;">
	<span style="color:#ff0000;"><span style="font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;">نشانی محل ثبت نام : مرکز علمی کاربردی صنعت آب و برق خوزستان واقع در اهواز؛اتوبان گلستان بین خیابان کاشان و همدان</span></span></h1>
<h1 style="text-align: justify;">
	<span style="color:#ff0000;"><span style="font-family: Vazirmatn; font-size: 16px; white-space-collapse: preserve;">شماره تماس : ۳۳۳۴۰۰۷۰-۰۶۱</span></span></h1>', '60265paziresh.jpg', 212, '1403/10/20', '10:02:50 AM', 1403, 'دی', 10, '20');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60266, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری جلسه همکاری‌های مشترک بین موسسه چهارم خرداد و مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان', '<p style="text-align: justify;">
	&nbsp;در راستای تقویت همکاری&zwnj;های آموزشی و تربیتی، جلسه&zwnj;ای با حضور نمایندگان موسسه چهارم خرداد (روز ملی مقاومت) و مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد. این جلسه با هدف بررسی راهکارهای آموزش و تربیت کادر فنی برای روایتگری در اردوهای راهیان پیشرفت و راهیان نور تشکیل گردید.</p>', '<p style="text-align: justify;">
	&nbsp;در راستای تقویت همکاری&zwnj;های آموزشی و تربیتی، جلسه&zwnj;ای با حضور نمایندگان موسسه چهارم خرداد (روز ملی مقاومت) و مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد. این جلسه با هدف بررسی راهکارهای آموزش و تربیت کادر فنی برای روایتگری در اردوهای راهیان پیشرفت و راهیان نور تشکیل گردید.<br />
	&nbsp;در این جلسه، کارشناسان و متخصصان دو نهاد به تبادل نظر درباره اهمیت روایتگری در انتقال فرهنگ ایثار و مقاومت پرداختند و بر لزوم آماده&zwnj;سازی نیروهای متخصص برای اجرای هرچه بهتر این اردوها تأکید کردند. همچنین، برنامه&zwnj;های آموزشی و دوره&zwnj;های تخصصی برای تربیت راویان با هدف ارتقای کیفیت اردوهای یادشده مورد بحث و بررسی قرار گرفت.<br />
	&nbsp;موسسه چهارم خرداد و مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان بر این باورند که همکاری&zwnj;های مشترک می&zwnj;تواند به ترویج فرهنگ ایثار و شهادت کمک شایانی کند و در نهایت موجب آگاهی نسل جوان از ارزش&zwnj;های دفاع مقدس شود.</p>', '60266khordad.jpg', 114, '1403/10/26', '1:49:30 AM', 1403, 'دی', 10, '26');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (60267, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری جشن ولادت با سعادت حضرت علی علیه السلام و روز پدر در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان', '<p>
	&nbsp;به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، جشن ولادت با سعادت حضرت علی علیه السلام و روز پدر با حضور پرسنل و خانواده&zwnj;های محترم ایشان برگزار شد.</p>', '<p style="text-align: justify;">
	&nbsp;به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، جشن ولادت با سعادت حضرت علی علیه السلام و روز پدر با حضور پرسنل و خانواده&zwnj;های محترم ایشان برگزار شد.</p>
<p style="text-align: justify;">
	&nbsp;این مراسم با قرائت قرآن کریم آغاز گردید و سپس دکتر هودگر، ریاست مجتمع، به میهمانان خوش&zwnj;آمد گفت. در ادامه، آیت الله سید ابوالحسن حسن زاده، نماینده محترم استان خوزستان در مجلس خبرگان رهبری، در خصوص فضایل امام علی علیه السلام و اهمیت روز پدر سخنرانی کرد.<br />
	<br />
	&nbsp;جشن ولادت حضرت علی (ع) با برنامه&zwnj;های شاد و مفرحی همراه بود که توسط جمعی از هنرمندان مطرح استان اجرا شد. این مراسم شامل بخش&zwnj;های متنوعی از جمله اجرای گروه تواشیح، پخش کلیپ و سرود، و ضیافت شام بود. همچنین برای کودکان حاضر در مراسم، برنامه&zwnj;ای جداگانه تحت عنوان &quot;ایستگاه شادمانه نوجوان&quot; برگزار شد که موجب شادی و نشاط آنها گردید.<br />
	<br />
	&nbsp;</p>', '60267jashn.jpg', 104, '1403/10/26', '1:53:46 AM', 1403, 'دی', 10, '26');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (61266, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری جلسه شورای فرهنگی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان', '<p style="text-align: justify;">
	جلسه شورای فرهنگی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور ریاست و اعضای شورا برگزار شد.</p>', '<p style="text-align: justify;">
	جلسه شورای فرهنگی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور ریاست و اعضای شورا برگزار شد. در این جلسه، برنامه&zwnj;های فرهنگی اجرا شده در دی ماه گذشته ارزیابی و نقاط قوت و ضعف آن&zwnj;ها مورد بحث و بررسی قرار گرفت. همچنین، اعضای شورا به برنامه&zwnj;ریزی برای اجرای بهتر برنامه&zwnj;های فرهنگی در بهمن ماه پرداختند تا با ایجاد ابتکارات جدید، فضاهای فرهنگی مجتمع را غنی&zwnj;تر سازند.</p>
<p style="text-align: justify;">
	این جلسات به منظور ارتقاء سطح فعالیت&zwnj;های فرهنگی و آموزشی در مجتمع برگزار می&zwnj;شود و اعضا بر اهمیت همکاری و همفکری در این راستا تأکید کردند.</p>', '60268Untitledmm.jpg', 89, '1403/11/5', '10:50:45 AM', 1403, 'بهمن', 11, '5');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (61267, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری یازدهمین جلسه روسای مراکز علمی کاربردی استان خوزستان', '<p style="text-align: justify;">
	یازدهمین جلسه روسای مراکز علمی کاربردی استان خوزستان به میزبانی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد. این جلسه با حضور دکتر بهرهی، ریاست دانشگاه جامع علمی کاربردی استان خوزستان، حجت الاسلام والمسلمین سمیع، مسئول نهاد رهبری دانشگاه جامع علمی کاربردی خوزستان، و دکتر مهدی هودگر، رئیس مرکز و مجتمع عالی آب و برق خوزستان تشکیل گردید.</p>
<p>
	&nbsp;</p>', '<p style="text-align: justify;">
	یازدهمین جلسه روسای مراکز علمی کاربردی استان خوزستان به میزبانی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد. این جلسه با حضور دکتر بهرهی، ریاست دانشگاه جامع علمی کاربردی استان خوزستان، حجت الاسلام والمسلمین سمیع، مسئول نهاد رهبری دانشگاه جامع علمی کاربردی خوزستان، و دکتر مهدی هودگر، رئیس مرکز و مجتمع عالی آب و برق خوزستان تشکیل گردید.</p>
<p style="text-align: justify;">
	هدف از برگزاری این جلسه، همفکری و ارتقای روابط بین مراکز علمی کاربردی استان بود. در این نشست، مدیران به تبادل نظرات و تجربیات خود پرداختند و راهکارهای لازم برای بهبود همکاری&zwnj;ها و ارتقای کیفیت آموزش در مراکز علمی کاربردی مورد بررسی قرار گرفت.</p>', '61267Untitleaad.jpg', 108, '1403/11/5', '3:49:33 PM', 1403, 'بهمن', 11, '5');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (61268, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'آزمون استخدامی شرکت های وابسته (غیر دولتی) زیر مجموعه شرکت مادر تخصصی تولید نیروی برق حرارتی برگزار شد', '<p>
	به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در روز پنجشنبه مورخ ۴ بهمن ماه ، آزمون استخدامی شرکت های وابسته (غیر دولتی) زیر مجموعه شرکت مادر تخصصی تولید نیروی برق حرارتی برگزار شد.</p>', '<p style="text-align: justify;">
	&nbsp; به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در روز پنجشنبه مورخ ۴ بهمن ماه ، آزمون استخدامی شرکت های وابسته (غیر دولتی) زیر مجموعه شرکت مادر تخصصی تولید نیروی برق حرارتی برگزار شد.</p>
<p style="text-align: justify;">
	آزمون مذکور از ساعت ۹:۰۰ صبح شروع و تا ساعت ۱۱:۳۰ ادامه یافت.</p>
<p style="text-align: justify;">
	مجری برگزاری این آزمون، اداره صلاحیت حرفه&zwnj;ای مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان بود. همچنین، نمایندگان دستگاه متقاضی ( نیروگاه های حرارتی کشور ) به عنوان ناظر آزمون در محل برگزاری حاضر شدند و پس از اتمام آزمون، مراتب رضایتمندی دستگاه متقاضی از اجرای آزمون اعلام گردید.</p>', '61268Unffftitled.jpg', 155, '1403/11/5', '3:51:53 PM', 1403, 'بهمن', 11, '5');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (61269, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری جلسه هماهنگی دوره حامیم: توانمندسازی دانشجویان در حوزه‌های فرهنگی و اجتماعی', '<p style="text-align: justify;">
	به گزارش روابط عمومی مجتمع، جلسه&zwnj;ی هماهنگی برای دوره حامیم با حضور حجت الاسلام محمد علی سمیع، مسئول نهاد رهبری دانشگاه جامع علمی کاربردی خوزستان و مهندس محمد طاهر دباغ، مسئول امور فرهنگی مجتمع عالی آموزشی صنعت آب و برق خوزستان برگزار شد.</p>', '<p style="text-align: justify;">
	به گزارش روابط عمومی مجتمع، جلسه&zwnj;ی هماهنگی برای دوره حامیم با حضور حجت الاسلام محمد علی سمیع، مسئول نهاد رهبری دانشگاه جامع علمی کاربردی خوزستان و مهندس محمد طاهر دباغ، مسئول امور فرهنگی مجتمع عالی آموزشی صنعت آب و برق خوزستان برگزار شد.</p>
<p style="text-align: justify;">
	طرح حامیم که مخفف عبارت &laquo;حلقه&zwnj;های میانی&raquo; است، از سال ۱۴۰۱ به منظور توانمندسازی دانشجویان فعال در حوزه&zwnj;های مختلف معرفتی و مهارتی روز از جمله اندیشه اسلامی، انقلاب اسلامی، تاریخ، جریان&zwnj;شناسی دانشگاه امروز و تحولات جهان و همچنین پاسخ به شبهات طراحی شده است.</p>
<p style="text-align: justify;">
	از اهداف اصلی این طرح می&zwnj;توان به شبکه&zwnj;سازی دانشجویان مستعد، استفاده حداکثری از ظرفیت آن&zwnj;ها و تقویت نشاط و روحیه کار جمعی اشاره کرد. در این طرح، دانشجویان فعال و با انگیزه که دارای سابقه فعالیت&zwnj;های علمی، فرهنگی، سیاسی و رسانه&zwnj;ای هستند، شناسایی می&zwnj;شوند. پس از انجام مصاحبه حضوری، دانشجویان به نسبت تعداد دانشجویان هر استان به کل دانشجویان کشور برای مراحل دانشگاهی، استانی و کشوری گزینش می&zwnj;گردند.</p>
<p style="text-align: justify;">
	لازم به ذکر است میزبان دوره دانشجویی حامیم مراکز علمی کاربردی استان ، مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان می باشد .</p>', '61269Untitledaaa.jpg', 119, '1403/11/8', '9:28:55 PM', 1403, 'بهمن', 11, '8');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (61270, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'مهلت ثبت نام در مقطع كارداني و كارشناسي ناپیوسته بدون آزمون تا 13 بهمن ماه تمدید شد', '<p>
	به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان ، مهلت ثبت نام و&zwnj; انتخاب رشته مقطع کاردانی و کارشناسی ناپیوسته، بدون آزمون (صرفا بر اساس سوابق تحصیلی) برای ترم بهمن تمدید شد.</p>', '<p style="text-align: justify;">
	به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان ، مهلت ثبت نام و&zwnj; انتخاب رشته مقطع کاردانی و کارشناسی ناپیوسته، بدون آزمون (صرفا بر اساس سوابق تحصیلی) برای ترم بهمن تمدید شد. بر این اساس، ثبت نام و انتخاب رشته پذیرش بر اساس سوابق تحصیلی ، تا ۱۳ بهمن ماه تمدید شد. داوطلبان می&zwnj;توانند به منظور ثبت نام به سامانه <a class="anchor-url" href="https://Sanjesh.Org" rel="noopener noreferrer" target="_blank">Sanjesh.Org</a> مراجعه و بعد از مطالعه دفترچه راهنمای ثبت نام و کسب آگاهی، در صورت تمایل و داشتن شرایط با تهیه کارت اعتباری نسبت به ثبت نام و انتخاب رشته اقدام کنند.</p>', '61270phototamdid.jpg', 200, '1403/11/8', '9:36:10 PM', 1403, 'بهمن', 11, '8');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62269, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'جلسه بررسی عملکرد پایگاه بسیج مجتمع آموزشی صنعت آب و برق خوزستان و برنامه‌ریزی دوره تربیت فرماندهان', '<p dir="RTL" style="text-align: justify;">
	در جلسه&zwnj;ای که با حضور سرهنگ زهیری، فرمانده حوزه بسیج شهید عباسپور سازمان آب و برق خوزستان و دکتر مهدی هودگر، ریاست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد، موضوعات مهمی مورد بحث و بررسی قرار گرفت<span dir="LTR">.</span></p>
', '<p dir="RTL" style="text-align: justify;">
	در جلسه&zwnj;ای که با حضور سرهنگ زهیری، فرمانده حوزه بسیج شهید عباسپور سازمان آب و برق خوزستان و دکتر مهدی هودگر، ریاست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد، موضوعات مهمی مورد بحث و بررسی قرار گرفت<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	این جلسه به منظور ارزیابی عملکرد پایگاه بسیج مجتمع و همچنین برنامه&zwnj;ریزی برای دوره تربیت تعالی فرماندهان برگزار گردید. در این نشست، دکتر هودگر به تشریح فعالیت&zwnj;ها و دستاوردهای پایگاه بسیج پرداخت و بر اهمیت تقویت روحیه همکاری و هم&zwnj;افزایی میان اعضای بسیج تأکید کرد<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	سرهنگ زهیری نیز در این جلسه به ضرورت تربیت فرماندهان کارآمد و متعهد اشاره کرد و خواستار تدوین برنامه&zwnj;های آموزشی مؤثر برای ارتقاء سطح توانمندی&zwnj;های فرماندهان بسیج شد<span dir="LTR">.</span></p>
', '61271basij.jpg', 110, '1403/11/17', '9:54:29 AM', 1403, 'بهمن', 11, '17');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62270, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'جلسه بررسی عملکرد آموزشی و دوره های برگزار شده و تقویم سال آینده فنی مهندسی - تخصصی شرکت‌های بهره‌برداری و تعمیرات سد و نیروگاه ها در سال ۱۴۰۳', '<p dir="RTL" style="text-align: justify;">
	جلسه&zwnj;ای به منظور بررسی عملکرد آموزشی و دوره&zwnj;های فنی مهندسی و بهره برداری برگزار شده برای شرکت&zwnj;های شد و نیروگاه در سال ۱۴۰۳، با حضور مدیران و کارشناسان مرتبط در سالن جلسات گیت بوستان برگزار شد. در این جلسه، برنامه&zwnj;ریزی برای تقویم آموزشی سال ۱۴۰۴ نیز مورد بحث و بررسی قرار گرفت<span dir="LTR">.</span></p>
', '<p dir="RTL" style="text-align: justify;">
	جلسه&zwnj;ای با هدف بررسی عملکرد آموزشی و دوره&zwnj;های برگزار شده برای پرسنل فنی مهندسی و بهره برداری شش شرکت&zwnj; سد و نیروگاه در سال ۱۴۰۳، در روز دوشنبه مورخ ۱۴۰۳/۱۱/۱۵ در سالن جلسات گیت بوستان برگزار شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	این جلسه با حضور دکتر گرامی مقدم، مدیر بهره&zwnj;برداری سد و نیروگاه&zwnj;ها، دکتر عرب زاده معاونت برنامه&zwnj;ریزی آموزشی و مهندس ناصر نژاد رئیس گروه آموزشی برق، انرژی و نیروگاه، همچنین روسا و مدیران آموزشی به همراه معاونین فنی مهندسی و معاونی بهره&zwnj;برداری شش شرکت معاونت سد و نیروگاه تشکیل گردید<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در این جلسه، گزارشی از عملکرد آموزشی سال ۱۴۰۳ ارائه شد و موضوعات مختلفی مورد بحث قرار گرفت. همچنین، به منظور برنامه&zwnj;ریزی برای تقویم آموزشی سال ۱۴۰۴، تصمیم گرفته شد که از هفته پیش رو کمیته&zwnj;ای تخصصی به تأیید دوره&zwnj;های مورد نیاز برای شش شرکت سد و نیروگاه&zwnj;ها تشکیل شود. این جلسات قرار است به صورت هفتگی برگزار گردد تا تقویم آموزشی به طور مؤثری بررسی٬ تولید و تنظیم شود<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	این اقدام نشان&zwnj;دهنده اهتمام جدی معاونت بخشی سد و نیروگاه و مدیریت شرکت&zwnj;ها به ارتقاء سطح دانش و مهارت&zwnj;های فنی پرسنل خود و همچنین بهبود کیفیت خدمات در حوزه سد و نیروگاه&zwnj;ها است<span dir="LTR">.</span></p>
', '62270jalase.jpg', 144, '1403/11/17', '10:01:56 AM', 1403, 'بهمن', 11, '17');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62271, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'اولین رویداد ملی استارتاپی فناوری‌های نوین در انرژی‌های تجدیدپذیر برگزار شد', '<p dir="RTL" style="text-align: justify;">
	رویداد استارتاپی با عنوان &quot;فناوری های نوین در انرژی های تجدیدپذیر&quot; در تاریخ 16 بهمن ماه در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد. این رویداد با حضور داوران و حامیانی از پارک علم و فناوری خوزستان و بنیاد ملی نخبگان، به ارائه 14 طرح نوآورانه در زمینه انرژی&zwnj;های تجدیدپذیر پرداخت<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	در تاریخ 16 بهمن ماه، مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان میزبان رویداد استارتاپی &quot;فناوری های نوین در انرژی های تجدیدپذیر&quot; بود. دکتر مهدی هوگر، رئیس رویداد، در ابتدای مراسم با خوش آمدگویی به حاضران، از داوران و عوامل برگزارکننده تشکر کرد و بر اهمیت گسترش و حمایت از چنین رویدادهایی تأکید کرد. او گفت: &quot;این گونه رویدادها نه تنها به شناسایی و پرورش ایده&zwnj;های نوآورانه کمک می&zwnj;کند، بلکه بستری مناسب برای تعامل میان نخبگان و صنعتگران فراهم می&zwnj;آورد. حمایت از ایده&zwnj;های جوانان و ارتقاء توانمندی&zwnj;های علمی و فنی در زمینه انرژی&zwnj;های تجدیدپذیر، از اهداف اصلی ماست<span dir="LTR">.&quot;</span></p>
<p dir="RTL" style="text-align: justify;">
	این رویداد مورد حمایت سازمان علمی پژوهشی بسیج خوزستان، پارک علم و فناوری خوزستان، بنیاد ملی نخبگان خوزستان&nbsp; و سازمان آب و برق خوزستان بود. داوران حاضر در این رویداد از پارک علم و فناوری، برق منطقه&zwnj;ای استان و شتابدهنده های فعال استان&nbsp; بودند، تا در صورت جذابیت طرح ها بتوان مورد حمایت قرار گیرد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	از میان طرح&zwnj;های ارسال شده، 14 طرح موفق به پذیرش شدند که شامل 12 ایده در زمینه انرژی خورشیدی و 2 ایده در زمینه انرژی بادی بود. پس از ارائه تیم&zwnj;ها بصورت حضوری و مجازی ، طرح&zwnj;ها به بحث و داوری گذاشته شدند تا بهترین ایده&zwnj;ها شناسایی و مورد حمایت قرار گیرند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	به نفرات برتر این رویداد جوایزی اهدا خواهد شد که شامل حمایت&zwnj;های مالی و همچنین امکان استقرار در مرکز رشد شهدای صنعت آب و برق خوزستان است. این مرکز با ارائه امکانات و منابع لازم، به استارتاپ&zwnj;ها کمک می&zwnj;کند تا ایده&zwnj;های خود را به مرحله اجرایی برسانند و در بازار رقابتی امروز جایگاه مناسبی پیدا کنند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	با توجه به اهمیت روزافزون انرژی&zwnj;های تجدیدپذیر و نیاز به توسعه پایدار، این رویداد می&zwnj;تواند نقش بسزایی در رشد و پیشرفت این حوزه ایفا کند و به ایجاد یک اکوسیستم پویا برای استارتاپ&zwnj;ها در زمینه فناوری&zwnj;های نوین انرژی کمک نماید.</p>
<p>
	&nbsp;</p>', '62271Unt.jpg', 116, '1403/11/19', '11:56:15 PM', 1403, 'بهمن', 11, '19');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62272, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'آگهي آزمون بکارگیری نیروی حجمي', '<p dir="RTL" style="text-align: justify;">
	به اطلاع ميرساند شرکت های پیمانکار طرف قرارداد شرکت توزیع نیروی برق استان ایلام به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید.</p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="margin-right: 0.2pt; text-align: justify;">
	به اطلاع مي&shy;رساند شرکت های پیمانکار (سبزپوشان کارآفرین ، زیباکاران ایلام )طرف قرارداد شرکت توزیع نیروی برق استان کرمانشاه به منظور تأمين نيروي انساني مورد نياز، تعداد <span style="color:#000080;"><strong>30</strong></span> نفر (تعـداد: <span style="color:#000080;"><strong>2</strong></span> نفر به عنوان راننده خودرو سنگین &ndash; پایه یکم وجرثقال، <span style="color:#000080;"><strong>28</strong></span> نفر به عـنوان سیمبان) از آقايـان واجد شرايط را از طريق آزمون دانش مهارت (کتبی تخصصی و مصاحبه) و طی فرآیند گزینش و به ترتیب از بالاترین نمره با شرايط ذيل و در قالب قرارداد نیروی حجمی بکارگیری مي&shy;نمايند.</p>
<p dir="RTL" style="margin-right: 0.2pt; text-align: center;">
	<strong><a href="https://kwphc.ir/Azmoon/AzmoonAdv/Adv14031126.pdf" target="_blank"><span style="color:#800080;"><span style="font-size:16px;">دریافت آگهی</span></span></a></strong></p>
<p dir="RTL" style="margin-right: 0.2pt; text-align: center;">
	<a href="https://estekhdam.kwphc.ir/azmoon140311/" target="_blank"><span style="color:#0000cd;"><span style="font-size:16px;"><strong>لینک ثبت نام</strong></span></span></a></p>
', '62272ExamNews.jpg', 1701, '1403/11/26', '5:31:03 PM', 1403, 'بهمن', 11, '26');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62273, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'بررسی همکاری‌های مرکز رشد شهدای صنعت آب و برق خوزستان و بنیاد نخبگان خوزستان', '<p style="text-align: justify;">
	<span dir="RTL">در تاریخ ۲۴ بهمن، نشستی با حضور دکتر کردزنگنه، رئیس بنیاد نخبگان خوزستان و&nbsp; مرکز رشد شهدای صنعت آب و برق خوزستان و جمعی از مسئولان و نخبگان برگزار شد. در این نشست، موضوع حمایت از مخترعان و تجاری&zwnj;سازی ایده&zwnj;های نوآورانه مورد بحث و بررسی قرار گرفت</span>.</p>', '<p dir="RTL" style="text-align: justify;">
	در تاریخ ۲۴ بهمن، نشستی با حضور دکتر کردزنگنه، رئیس بنیاد نخبگان خوزستان و&nbsp; مرکز رشد شهدای صنعت آب و برق خوزستان و جمعی از مسئولان و نخبگان برگزار شد. در این نشست، موضوع حمایت از مخترعان و تجاری&zwnj;سازی ایده&zwnj;های نوآورانه مورد بحث و بررسی قرار گرفت<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	محمد لیموئی ضمن تبریک اعیاد شعبانیه، به ظرفیت&zwnj;های مرکز رشد اشاره کرد و تأکید داشت که وظیفه اصلی مخترعان تولید علم است، اما رسالت مرکز رشد، تجاری&zwnj;سازی این دستاوردها و رساندن آن&zwnj;ها به مرحله تولید و بازار است. وی همچنین به مدل&zwnj;های درآمدی و روش&zwnj;های سودآوری استارتاپ&zwnj;ها پرداخته و اهمیت برنامه&zwnj;ریزی اقتصادی برای اختراعات را مورد تأکید قرار داد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	دکتر کردزنگنه، رئیس بنیاد نخبگان خوزستان نیز با اشاره به سیاست&zwnj;های حمایتی بنیاد نخبگان، بیان کرد که حمایت این بنیاد به&zwnj;طور ویژه بر اختراعاتی متمرکز است که قابلیت تجاری&zwnj;سازی داشته باشند. وی از ادامه همکاری&zwnj;ها میان بنیاد و مرکز رشد خبر داد و بر ضرورت استمرار این جلسات تأکید کرد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در این نشست، دکتر طالب&zwnj;زاده، مسئول ارتباط با صنعت مجتمع، به فرایند تجاری&zwnj;سازی و معرفی شرکت&zwnj;هایی که می&zwnj;توانند در این مسیر نقش&zwnj;آفرینی کنند، پرداخت. همچنین سرکار خانم دکتر ساکی، معاونت آموزشی و پژوهشی مجتمع ، با توجه به اهمیت رویدادهای برگزارشده توسط مرکز رشد، خواستار حمایت بیشتر از طرح&zwnj;های پژوهشی که قابلیت تولید و ورود به بازار را دارند، شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در پایان، مقرر شد که مرکز رشد شهدای صنعت آب و برق خوزستان به&zwnj;عنوان یکی از مجموعه&zwnj;های واجد شرایط بهره&zwnj;مندی از ماده ۱۶ قانون جهش تولید دانش&zwnj;بنیان، به بنیاد نخبگان معرفی شود. این قانون با هدف توسعه سیاست&zwnj;های حمایت از انرژی&zwnj;های تجدیدپذیر و تشویق صنایع و بخش مسکن به استفاده از این منابع تدوین شده است<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	همچنین، در این جلسه یکی از اختراعات مستقر در مرکز رشد که مورد ارزیابی بنیاد نخبگان قرار گرفته بود، بررسی شد. طی بازدید از نمونه پایلوت این دستگاه، شرکت&zwnj;هایی که متقاضی سرمایه&zwnj;گذاری و خرید این فناوری بودند، معرفی شدند. در نهایت، دکتر کردزنگنه فرآیند ارزیابی و داوری این اختراع را برای عضویت در بنیاد نخبگان و دریافت سطح سه توضیح داد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	این جلسه گامی مهم در راستای توسعه تعاملات میان بنیاد نخبگان و مرکز رشد، حمایت از نخبگان، و تسریع در مسیر تجاری&zwnj;سازی فناوری&zwnj;های نوین محسوب می&zwnj;شود.</p>
<p>
	&nbsp;</p>', '62273photojal.jpg', 1361, '1403/11/27', '6:49:49 AM', 1403, 'بهمن', 11, '27');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62275, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'آزمون تبدیل وضعیت و ارتقاء شغلی کارکنان شرکت توزیع برق استان کرمانشاه برگزار شد', '<p style="text-align: justify;">
	به گزارش شبکه خبری سازمان آب و برق خوزستان، این آزمون توسط اداره صلاحیت حرفه&zwnj;ای و آزمون های مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور ۱۰۳ نفر از کارکنان آن شرکت برگزار شد.</p>', '<p style="text-align: justify;">
	به گزارش شبکه خبری سازمان آب و برق خوزستان، این آزمون توسط اداره صلاحیت حرفه&zwnj;ای و آزمون های مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور ۱۰۳ نفر از کارکنان آن شرکت برگزار شد.</p>
<p style="text-align: justify;">
	این اقدام به منظور تقویت توانمندی&zwnj;های نیروی انسانی و افزایش بهره&zwnj;وری در شرکت توزیع برق استان کرمانشاه انجام شده است.</p>', '62274Untitledxx.jpg', 287, '1403/11/29', '12:23:30 AM', 1403, 'بهمن', 11, '29');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62276, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'آگهي آزمون بکارگیری نیروی حجمي', '<p dir="RTL" style="text-align: justify;">
	به اطلاع ميرساند شرکت های پیمانکار طرف قرارداد شرکت سهامي برق منطقه ای خوزستان به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید<span dir="LTR">.</span></p>
', '<p dir="RTL" style="text-align: justify;">
	به اطلاع ميرساند شرکتهای پیمانکار <span style="color:#9933cc;"><strong>دزیاران کارون، شمیم مهر آریا و پارس وحدت اکسین&nbsp;</strong></span> طرف قرارداد شرکت سهامي برق منطقه ای خوزستان به منظور تأمین نیروي انساني مورد نیاز، تعدادي ازآقايان و خانمهای واجد شرایط را از میان داوطلبان بومي و از طریق برگزاري آزمون توانمنديهاي عمومي و تخصصي (کتبي) و آزمون دانش مهارت (مصاحبه) و طي فرایند گزینش و به ترتیب از بالاترین نمره با شرایط ذیل و در قالب قرارداد نیروی حجمي جذب و بکارگیري مينمایند<span dir="LTR">.</span></p>
<ul dir="rtl">
	<li style="text-align: justify;">
		داشتن تابعيت نظام جمهوري اسلامي ايران<span dir="LTR">.</span></li>
	<li style="text-align: justify;">
		التزام به قانون اساسي جمهوري اسلامي ايران</li>
	<li style="text-align: justify;">
		اعتقاد به دين مبين اسلام يا يكي از اديان شناخته شده در قانون اساسي جمهوري اسلامي ايران<span dir="LTR">.</span></li>
	<li style="text-align: justify;">
		دارا بودن شرايط احراز شغل متناسب با جدول نيازهاي اعلامي و توانايي لازم براي شغل مورد نظر</li>
	<li style="text-align: justify;">
		احراز صلاحيتهاي عمومي به تأييد گزينش پس از قبولي در آزمون کتبي و مصاحبه و تست ورزش براي شغل آتش نشان</li>
	<li style="text-align: justify;">
		انجام خدمت دوره ضرورت يا معافیت قانونی دائم <span style="color:#b22222;">(معافیت پزشکی و معاف از رزم در شغل آتش نشان مورد پذیرش نمی باشد<span dir="LTR">(</span></span></li>
	<li style="text-align: justify;">
		عدم اعتياد به هرگونه مواد مخدر و يا مشروبات الكلي</li>
	<li style="text-align: justify;">
		نداشتن سابقه محكوميت کيفري و ارائه گواهي عدم سوء پيشينه</li>
	<li style="text-align: justify;">
		داشتن سلامت جسماني و رواني و توانايي لازم براي انجام وظايف شغل مورد نظر</li>
	<li style="text-align: justify;">
		<span style="color:#008080;">تبصره 1 : کليه متقاضيان در صورت قبولي آزمون موظف به ارائه گواهي سلامت جسماني از مراکز طب کار هستند</span></li>
	<li style="text-align: justify;">
		نداشتن منع قانوني براي جذب و عدم تعهد خدمتي به ديگر سازمانها و شرکتهاي دولتي يا خصوصي</li>
	<li style="text-align: justify;">
		نداشتن سابقه اخراج از شرکتهاي پيمانكاري در حوزه عملياتي شرکتهاي برق</li>
	<li style="text-align: justify;">
		کسب حد نصاب نمره آزمون کتبي (حداقل 50 درصد ميانگين نمره مكتسبه سه نفر اول آزمون در همان شهرستان/شهر و در هر شغل<span dir="LTR">( </span></li>
	<li style="text-align: justify;">
		دارا بودن شرايط سني مورد نياز(مطابق با مفاد اين آگهي<span dir="LTR">(</span></li>
</ul>
<p style="text-align: center;">
	<a href="https://kwphc.ir/Azmoon/AzmoonAdv/Adv14031129.pdf" target="_blank"><strong><span style="font-size:16px;"><span style="color:#800080;">دریافت فایل راهنما</span></span></strong></a></p>
<p style="text-align: center;">
	<a href="https://estekhdam.kwphc.ir/azmoon140312" target="_blank"><span style="color:#4b0082;"><strong><span style="font-size:16px;">لینک ثبت نام</span></strong></span></a></p>
<p style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_218.jpeg" style="height: 788px; width: 600px;" /></p>
', '62276ExamNews3.jpg', 5161, '1403/11/29', '8:31:55 AM', 1403, 'بهمن', 11, '29');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62277, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'آگهي آزمون بکارگیری نیروی حجمي', '<p dir="RTL" style="text-align: justify;">
	به اطلاع ميرساند شرکت پیمانکار دنیاکاران جنوب شرکت توزیع نیروی برق اهواز به منظور تأمين نيروي انساني مورد نياز خود از بین افراد واجد شرایط دعوت به همکاری می نماید.</p>
', '<p dir="RTL">
	به اطلاع مي رساند <strong><span style="color:#9900ff;">شرکت پیمانکار دنیاکاران جنوب </span></strong>طرف قرارداد شرکت توزیع نیروی برق اهواز به منظور تأمين نيروي انساني مورد نياز، تعداد 8 نفر(تعداد: 2 نفر به عنوان سیمبان خط گرم، 1 نفر به عنوان راننده خودرو سنگین- پایه یکم، 1 نفر مامورقرائت کنتور و 4 نفر نیروی خدمات) از آقایان واجد شرايط را از طريق برگزاري آزمون توانمنديهاي عمومي وتخصصي (كتبي) و آزمون دانش مهارت (مصاحبه) و طي فرآيند گزينش و به ترتيب از بالاترين نمره با شرايط ذيل و در قالب قرارداد نیروی حجمی جذب مي نمايد<span dir="LTR">.</span></p>
<p dir="RTL">
	<strong>شرايط عمومي:</strong></p>
<ul dir="rtl">
	<li>
		داشتن تابعیت نظام جمهوری اسلامي ایران</li>
	<li>
		التزام به قانون اساسي جمهوری اسلامي ایران</li>
	<li>
		اعتقاد به دین مبین اسلام یا یکي از ادیان شناخته شده در قانون اساسي جمهوری اسلامي ایران</li>
	<li>
		دارا بودن شرایط احراز شغل و توانایي انجام کار</li>
	<li>
		احراز صلاحیت های عمومي به تأیید هسته گزینش</li>
	<li>
		داشتن کارت پایان خدمت نظام وظیفه یا معافیت قانوني دائم غیر پزشکي تا تاریخ برگزاری آزمون الزامي مي باشد</li>
	<li>
		عدم اعتیاد به مواد مخدر و دخانیات</li>
	<li>
		نداشتن سابقه محکومیت جزایي مؤثر</li>
	<li>
		داشتن سلامت جسماني، روحي و رواني</li>
	<li>
		دارا بودن شرایط فیزیکي و جسماني لازم، <span style="color:#b22222;">(با تایید پزشک معتمد شرکت توزیع نیروی برق اهواز)</span></li>
	<li>
		دارا بودن قدرت تحرک وتوانایي جسمي لازم</li>
	<li>
		سلامت کامل بینایي</li>
	<li>
		سلامت کامل ستون قفرات</li>
	<li>
		نداشتن بیماری خاص ویا تصادفي که منجر به استفاده از پلاتین در اعضای بدن شده باشد</li>
	<li>
		عدم داشتن منع قانوني جهت بکارگیری و نداشتن تعهد خدمت به دیگر سازمانها وشرکت های دولتي و خصوصي</li>
	<li>
		دارا بودن شرایط سني موردنیاز <span style="color:#b22222;">(مطابق با مفاد آین آگهي)</span></li>
</ul>
<p style="text-align: center;">
	<a href="https://kwphc.ir/Azmoon/AzmoonAdv/Adv14031130.pdf" target="_blank"><span style="font-size:16px;"><strong><span style="color:#800080;">دریافت فایل راهنما</span></strong></span></a></p>
<p style="text-align: center;">
	<a href="https://estekhdam.kwphc.ir/azmoon140312-2/" target="_blank"><span style="color:#4b0082;"><span style="font-size:16px;"><strong>لینک ثبت نام</strong></span></span></a></p>
<p style="text-align: center;">
	&nbsp;</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_219.jpeg" style="height: 744px; width: 600px;" /></p>
<p>
	&nbsp;</p>
', '62277ExamNews4.jpg', 3352, '1403/11/29', '2:42:06 PM', 1403, 'بهمن', 11, '29');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62278, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', '"اختتامیه رقابت‌های ریسرچ‌پیچ و اینوتکس‌پیچ خوزستان: معرفی طرح‌های برتر و تیم‌های منتخب"', '<p>
	رقابت&zwnj;های ریسرچ&zwnj;پیچ و اینوتکس&zwnj;پیچ خوزستان با حمایت مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان و مرکز رشد دانشگاه شهید چمران اهواز به پایان رسید.</p>', '<p>
	رقابت&zwnj;های ریسرچ&zwnj;پیچ و اینوتکس&zwnj;پیچ خوزستان با حمایت مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان و مرکز رشد دانشگاه شهید چمران اهواز به پایان رسید. در بخش ریسرچ&zwnj;پیچ، ۲۱ طرح پژوهشی ثبت و ۱۲ طرح به مرحله ارائه حضوری راه یافتند. پنج طرح برتر شامل بومی&zwnj;سازی کمپرسور سیلندر پیستونی، بتن بایولوژیک، آشکارساز التراسونیک، لوله&zwnj;های نوری خورشیدی و امواج گرمایی سفارشی معرفی شدند.&nbsp;</p>
<p>
	در رقابت اینوتکس&zwnj;پیچ، ۴۳ طرح ارزیابی و ۱۳ تیم به مرحله ارائه حضوری راه پیدا کردند. تیم &laquo;آلتین کاغذ&raquo; مقام اول را برای تولید کاغذ با کودهای حیوانی کسب کرد و تیم &laquo;ادیب گستر اروند&raquo; مقام دوم را به دست آورد. همچنین تیم دانش&zwnj;آموزی &laquo;راما&raquo; به عنوان طرح شایسته تقدیر معرفی شد.&nbsp;</p>
<p>
	تیم&zwnj;های منتخب هر دو رویداد مجوز حضور در مرحله نهایی این رقابت&zwnj;ها که از ۹ تا ۱۲ اردیبهشت ۱۴۰۴ در پارک فناوری پردیس برگزار می&zwnj;شود، کسب کردند. دکتر مهدی هودگر و دکتر اسماعیل عرب زاده نیز به عنوان داوران اصلی در این رویداد حضور داشتند.</p>', '62278Untitled.jpg', 89, '1403/12/3', '1:37:12 AM', 1403, 'اسفند', 12, '3');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62279, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری موفق رویداد استارتاپی سواد آبی با ارائه ۱۲ طرح برتر', '<p style="text-align: justify;">
	رویداد استارتاپی سواد آبی با هدف ارتقای دانش و آگاهی عمومی در حوزه مدیریت منابع آبی به&zwnj;طور موفقیت&zwnj;آمیز برگزار شد و ۱۲ طرح استارتاپی به مرحله نهایی راه پیدا کردند. این رویداد با حضور داورانی تخصصی در حوزه آب همچون دکتر ممبینی، رئیس سازمان بسیج علمی، پژوهشی و فناوری خوزستان؛ دکتر نصراصفهانی، رئیس گروه دفتر نوآوری و توسعه سازمان آب و برق خوزستان؛ و دکتر مقسمی، رئیس گروه آموزش سازمان آب و برق خوزستان و خانم مهندس احمدی دبیر ستاد سواد آبی سازمان آب و برق خوزستان برگزار شد.</p>', '<p style="text-align: justify;">
	رویداد استارتاپی سواد آبی با هدف ارتقای دانش و آگاهی عمومی در حوزه مدیریت منابع آبی به&zwnj;طور موفقیت&zwnj;آمیز برگزار شد و ۱۲ طرح استارتاپی به مرحله نهایی راه پیدا کردند. این رویداد با حضور داورانی تخصصی در حوزه آب همچون دکتر ممبینی، رئیس سازمان بسیج علمی، پژوهشی و فناوری خوزستان؛ دکتر نصراصفهانی، رئیس گروه دفتر نوآوری و توسعه سازمان آب و برق خوزستان؛ و دکتر مقسمی، رئیس گروه آموزش سازمان آب و برق خوزستان و خانم مهندس احمدی دبیر ستاد سواد آبی سازمان آب و برق خوزستان برگزار شد.&nbsp;</p>
<p style="text-align: justify;">
	دکتر مهدی هودگر، ریاست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، در ابتدای این رویداد ضمن خوشامدگویی به داوران، مهمانان و عوامل اجرایی، بر اهمیت موضوع مدیریت منابع آبی و ضرورت ارتقای سواد آبی در جامعه تأکید کرد. وی گفت: &quot;حضور ایده&zwnj;های نوآورانه در این رویداد نشان&zwnj;دهنده پتانسیل بالای جوانان کشور در حل چالش&zwnj;های مربوط به منابع آب است.&quot;&nbsp;</p>
<p style="text-align: justify;">
	در این رویداد، داورانی از حوزه&zwnj;های مختلف از جمله مدیریت منابع آب، اقتصاد، کسب و کار و نرم&zwnj;افزارهای کامپیوتری به ارزیابی و داوری طرح&zwnj;ها پرداختند. طرح&zwnj;های ارائه شده در زمینه&zwnj;هایی نظیر بهینه&zwnj;سازی مصرف آب، حسگرهای هوشمند، پیش&zwnj;بینی بحران&zwnj;های آبی و بازی&zwnj;های دیجیتال با هدف آموزش و ارتقای سواد آبی بود. پس از ارزیابی&zwnj;های دقیق، ۱۲ طرح منتخب به مرحله نهایی رسیدند و به ارائه ایده&zwnj;های خود پرداختند.</p>
<p style="text-align: justify;">
	این طرح&zwnj;ها از حمایت&zwnj;های تخصصی مرکز رشد شهدای صنعت آب و برق خوزستان برخوردار خواهند شد که شامل کمک در توسعه بیزینس پلن، تجاری&zwnj;سازی و معرفی به بازار است. این رویداد به&zwnj;عنوان یک گام بزرگ در جهت جذب و پشتیبانی از استارتاپ&zwnj;های نوآورانه در حوزه منابع آبی، می&zwnj;تواند به بهبود مدیریت منابع آب در کشور کمک شایانی کند و همچنین آگاهی عمومی نسبت به مسائل مهم آب را افزایش دهد.</p>', '62279Untitleddd.jpg', 112, '1403/12/3', '1:40:14 AM', 1403, 'اسفند', 12, '3');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62280, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'بازدید سرپرست دانشگاه جامع علمی کاربردی از دانشگاه صنعت آب و برق خوزستان', '<p style="text-align: justify;">
	دکتر علی اکبری، ریاست محترم دانشگاه جامع علمی کاربردی کشور به همراه هیئتی متشکل از دکتر بهرهی سرپرست دانشگاه علمی کاربردی استان خوزستان، معاونت برنامه ریزی سازمان آب و برق خوزستان، و معاونین آموزشی و پژوهشی استان، از زیرساخت&zwnj;های آموزشی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان بازدید کرد. این بازدید به منظور بررسی شرایط اعطای مجوز جذب دانشجوی بین&zwnj;المللی، به ویژه از کشور عراق، انجام شد.</p>', '<p style="text-align: justify;">
	دکتر علی اکبری، ریاست محترم دانشگاه جامع علمی کاربردی کشور به همراه هیئتی متشکل از دکتر بهرهی سرپرست دانشگاه علمی کاربردی استان خوزستان، معاونت برنامه ریزی سازمان آب و برق خوزستان، و معاونین آموزشی و پژوهشی استان، از زیرساخت&zwnj;های آموزشی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان بازدید کرد. این بازدید به منظور بررسی شرایط اعطای مجوز جذب دانشجوی بین&zwnj;المللی، به ویژه از کشور عراق، انجام شد.</p>
<p style="text-align: justify;">
	در این بازدید، پرفسور علی اکبری ضمن بررسی عملکرد آموزشی، پژوهشی و فن آوری مدیران مجتمع، از تلاش&zwnj;ها و اقدامات صورت گرفته در راستای ارتقاء کیفیت آموزشی تقدیر کرد و بر اهمیت جذب دانشجویان بین&zwnj;المللی تاکید نمود. وی همچنین به لزوم فراهم کردن امکانات و خدمات مناسب برای این دانشجویان اشاره کرد و گفت: &quot;جذب دانشجویان بین&zwnj;المللی نه تنها به افزایش تبادل فرهنگی کمک می&zwnj;کند، بلکه می&zwnj;تواند موجب ارتقاء سطح علمی و پژوهشی دانشگاه نیز شود.&quot;</p>
<p style="text-align: justify;">
	دکتر هودگر، رئیس محترم مجتمع نیز در این دیدار ضمن خوشامدگویی به ریاست دانشگاه، از آمادگی زیرساخت&zwnj;های مجتمع عالی آموزشی صنعت آب و برق برای جذب دانشجویان بین&zwnj;المللی خبر داد. وی افزود: &quot;ما تمامی امکانات لازم را برای ارائه آموزش با کیفیت و تسهیل روند پذیرش دانشجویان خارجی فراهم کرده&zwnj;ایم و امیدواریم با همکاری&zwnj;های مشترک، بتوانیم به هدف جذب دانشجویان بین&zwnj;المللی دست یابیم.&quot;</p>', '62280Untitledee.jpg', 149, '1403/12/3', '1:42:16 AM', 1403, 'اسفند', 12, '3');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62281, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'سفر زیارتی مناطق عملیاتی جنوب کشور ویژه پرسنل مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان', '<p dir="RTL">
	<span style="font-size:14px;">به گزارش روابط عمومی مجتمع آموزشی آب و برق خوزستان، در روز جمعه مورخ ۱۴۰۳/۱۲/۳ کاروان راهیان نور ویژه خانواده های پرسنل مجتمع به مناطق عملیاتی جنوب کشور اعزام شدند <span dir="LTR">.</span></span></p>
<p style="text-align: justify;">
	&nbsp;</p>
', '<p dir="RTL">
	<span style="font-size:14px;">به گزارش روابط عمومی مجتمع آموزشی آب و برق خوزستان، در روز جمعه مورخ ۱۴۰۳/۱۲/۳ کاروان راهیان نور ویژه خانواده های پرسنل مجتمع به مناطق عملیاتی جنوب کشور اعزام شدند <span dir="LTR">.</span></span></p>
<p>
	&nbsp;</p>
', '62281deb.jpg', 203, '1403/12/5', '8:49:30 AM', 1403, 'اسفند', 12, '5');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62282, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری آزمون جذب نیروی حجمی در شرکت توزیع برق استان کرمانشاه', '<p dir="RTL" style="text-align: justify;">
	به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، آزمون جذب نیروی حجمی شرکت&zwnj;های پیمانکار طرف قرارداد شرکت توزیع برق استان کرمانشاه در تاریخ&zwnj;های 6 و 7 اسفند ماه به شیوه مهارتی برگزار شد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	به گزارش روابط عمومی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، آزمون جذب نیروی حجمی شرکت&zwnj;های پیمانکار طرف قرارداد شرکت توزیع برق استان کرمانشاه در تاریخ&zwnj;های 6 و 7 اسفند ماه به شیوه مهارتی برگزار شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	این آزمون با حضور 120 نفر از متقاضیان جذب، توسط اداره صلاحیت حرفه&zwnj;ای و آزمون&zwnj;های مجتمع آموشی آب و برق خوزستان برگزار گردید<span dir="LTR">.</span></p>', '62282f8d.jpg', 618, '1403/12/8', '9:32:32 AM', 1403, 'اسفند', 12, '8');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62283, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'اختتامیه رویدادهای استارتاپی فناوری‌های نوین در حوزه انرژی‌های تجدیدپذیر و سواد آبی: شناسایی و حمایت از ایده‌های خلاقانه', '<p dir="RTL">
	اختتامیه رویدادهای استارتاپی فناوری&zwnj;های نوین در حوزه انرژی&zwnj;های تجدیدپذیر و سواد آبی، در تاریخ ۷ اسفند ۱۴۰۲ در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور جمعی از متخصصان، فعالان صنعت و علاقه&zwnj;مندان به نوآوری برگزار شد. این رویدادها با هدف شناسایی و حمایت از ایده&zwnj;های نوآورانه و ارائه راهکارهای عملی برای چالش&zwnj;های کلیدی در این حوزه&zwnj;ها طراحی شده بودند<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	اختتامیه رویدادهای استارتاپی فناوری&zwnj;های نوین در حوزه انرژی&zwnj;های تجدیدپذیر و سواد آبی، در تاریخ ۷ اسفند ۱۴۰۲ در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور جمعی از متخصصان، فعالان صنعت و علاقه&zwnj;مندان به نوآوری برگزار شد. این رویدادها با هدف شناسایی و حمایت از ایده&zwnj;های نوآورانه و ارائه راهکارهای عملی برای چالش&zwnj;های کلیدی در این حوزه&zwnj;ها طراحی شده بودند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	دکتر هودگر، رئیس این رویداد، در سخنرانی خود به اهمیت حضور تیم&zwnj;های خلاق و نوآور اشاره کرد و گفت: &laquo;در رویداد استارتاپی انرژی&zwnj;های تجدیدپذیر، ۱۴ ایده برتر به مرحله نهایی رسیدند که نشان&zwnj;دهنده پتانسیل بالای جوانان کشور در این حوزه است. همچنین، در رویداد سواد آبی، ۱۳ تیم راهکارهای فناورانه خود را ارائه کردند که می&zwnj;تواند به بهبود مدیریت منابع آب کمک کند<span dir="LTR">.&raquo;</span></p>
<p dir="RTL" style="text-align: justify;">
	وی افزود: &laquo;این رویدادها تنها یک مسابقه برای ایده&zwnj;ها نیستند، بلکه بستری برای تحول در صنعت آب و انرژی کشور محسوب می&zwnj;شوند. ما به دنبال ایجاد فضایی هستیم که نوآوری&zwnj;ها بتوانند به راحتی رشد کنند و به مرحله اجرایی برسند<span dir="LTR">.&raquo;</span></p>
<p dir="RTL" style="text-align: justify;">
	در پایان مراسم، از تیم&zwnj;های برتر با اعطای جوایز نقدی و فرصت&zwnj;های حمایتی تقدیر شد. این جوایز شامل مشاوره&zwnj;های تخصصی، حمایت مالی و دسترسی به شبکه&zwnj;های سرمایه&zwnj;گذاری بود<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>
', '62283gggg.jpg', 453, '1403/12/9', '11:09:49 AM', 1403, 'اسفند', 12, '9');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62284, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'اولین دوره عملی طراحی و نصب سیستم‌های تولید برق از انرژی خورشیدی در خوزستان برگزار شد', '<p dir="RTL" style="text-align: justify;">
	برای نخستین بار در استان خوزستان، دوره&zwnj;ای کاملاً عملی در زمینه طراحی و نصب سیستم&zwnj;های تولید برق از انرژی خورشیدی در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد. این دوره با استقبال و رضایت حداکثری شرکت&zwnj;کنندگان همراه بود و به هدف ارتقای دانش فنی و مهارت&zwnj;های عملی افراد علاقه&zwnj;مند به حوزه انرژی&zwnj;های تجدیدپذیر طراحی و اجرا گردید<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	برای نخستین بار در استان خوزستان، دوره&zwnj;ای کاملاً عملی در زمینه طراحی و نصب سیستم&zwnj;های تولید برق از انرژی خورشیدی در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد. این دوره با استقبال و رضایت حداکثری شرکت&zwnj;کنندگان همراه بود و به هدف ارتقای دانش فنی و مهارت&zwnj;های عملی افراد علاقه&zwnj;مند به حوزه انرژی&zwnj;های تجدیدپذیر طراحی و اجرا گردید<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	محورهای اصلی این دوره شامل آموزش الزامات و طراحی نیروگاه خورشیدی، اجرای موفقیت&zwnj;آمیز یک نیروگاه آن&zwnj;گرید<span dir="LTR"> (On-Grid) </span>و اجرای موفقیت&zwnj;آمیز یک نیروگاه آف&zwnj;گرید<span dir="LTR"> (Off-Grid) </span>بود<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	این دوره به عنوان اولین تجربه آموزشی عملی در خوزستان، شرکت&zwnj;کنندگان را در نصب و راه&zwnj;اندازی نیروگاه&zwnj;های واقعی مشارکت داد و دانش به&zwnj;روز و تخصصی را با تمرکز بر مهارت&zwnj;های عملی ارائه کرد. همچنین، این رویداد به ایجاد یک مسیر مشخص برای تربیت متخصصان و تکنسین&zwnj;های بومی در حوزه انرژی خورشیدی کمک شایانی نمود<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	با توجه به استقبال و رضایت عالی شرکت&zwnj;کنندگان، به نظر می&zwnj;رسد که این مدل آموزش می&zwnj;تواند نقش مؤثری در توسعه زیرساخت&zwnj;های انرژی خورشیدی ایفا کند و الگویی جدید برای آموزش&zwnj;های کاربردی در این حوزه ارائه دهد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '62284bbb.jpg', 1255, '1403/12/13', '8:30:36 AM', 1403, 'اسفند', 12, '13');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62285, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'سفر زیارتی مناطق عملیاتی جنوب کشور ویژه دانشجویان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار گردید', '<p>
	<span style="color: rgb(119, 119, 119); font-family: primary-font, &quot;segoe ui&quot;, tahoma; font-size: 14px; text-align: justify;">به گزارش روابط عمومی مجتمع آموزشی آب و برق خوزستان، در روز جمعه مورخ ۱۴۰۳/۱۲/10 کاروان راهیان نور ویژه دانشجویان مجتمع به مناطق عملیاتی جنوب کشور اعزام شدند&nbsp;</span><span dir="LTR" style="box-sizing: border-box; color: rgb(119, 119, 119); font-family: primary-font, &quot;segoe ui&quot;, tahoma; font-size: 14px; text-align: justify;">.</span></p>
<p>
	&nbsp;</p>
', '<p>
	<span style="color: rgb(119, 119, 119); font-family: primary-font, &quot;segoe ui&quot;, tahoma; font-size: 14px; text-align: justify;">به گزارش روابط عمومی مجتمع آموزشی آب و برق خوزستان، در روز جمعه مورخ ۱۴۰۳/۱۲/10 کاروان راهیان نور ویژه دانشجویان مجتمع به مناطق عملیاتی جنوب کشور اعزام شدند&nbsp;</span><span dir="LTR" style="box-sizing: border-box; color: rgb(119, 119, 119); font-family: primary-font, &quot;segoe ui&quot;, tahoma; font-size: 14px; text-align: justify;">.</span></p>
<p>
	&nbsp;</p>
', '62285vvv.jpg', 365, '1403/12/14', '9:05:38 AM', 1403, 'اسفند', 12, '14');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62286, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'دیدار رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با پرسنل به مناسبت سال نو و عید سعید فطر', '<p dir="RTL" style="text-align: justify;">
	در پی فرارسیدن سال نو و عید سعید فطر، رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با پرسنل این مجتمع دیدار و گفتگو کرد. در این دیدار که با حضور جمعی از کارکنان و معاونین مجتمع برگزار شد، دکتر مهدی هودگر ضمن تبریک آغاز سال جدید و عید سعید فطر، از تلاش&zwnj;های بی&zwnj;وقفه و مستمر پرسنل تشکر و قدردانی کرد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	در پی فرارسیدن سال نو و عید سعید فطر، رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با پرسنل این مجتمع دیدار و گفتگو کرد. در این دیدار که با حضور جمعی از کارکنان و معاونین مجتمع برگزار شد، دکتر مهدی هودگر ضمن تبریک آغاز سال جدید و عید سعید فطر، از تلاش&zwnj;های بی&zwnj;وقفه و مستمر پرسنل تشکر و قدردانی کرد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	مهدی هودگر با اشاره به دستاوردهای سال گذشته، بیان کرد: &quot;تلاش&zwnj;های شما عزیزان در سال گذشته باعث پیشرفت&zwnj;های چشمگیری در حوزه&zwnj;های آموزشی و پژوهشی شده است. ما به عنوان یک خانواده بزرگ، باید همواره در راستای ارتقاء کیفیت خدمات و آموزش&zwnj;های ارائه شده گام برداریم<span dir="LTR">.&quot;</span></p>
<p dir="RTL" style="text-align: justify;">
	وی همچنین افزود: &quot;امیدوارم در سال جدید با همت و همکاری بیشتر، بتوانیم چالش&zwnj;های پیش&zwnj;رو را پشت سر بگذاریم و به اهداف بلندمدت خود دست یابیم. عید سعید فطر فرصتی است تا با تجدید میثاق با یکدیگر، روحیه&zwnj;ای تازه بگیریم و در کنار هم برای تحقق آرمان&zwnj;هایمان تلاش کنیم<span dir="LTR">.&quot;</span></p>
<p dir="RTL" style="text-align: justify;">
	در پایان، دکتر هودگر از پرسنل خواست تا نظرات و پیشنهادات خود را برای بهبود عملکرد مجتمع ارائه دهند و تأکید کرد که مدیریت مجتمع همواره آماده شنیدن صدای کارکنان است<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '62286salnooo.jpg', 253, '1404/1/19', '9:59:05 AM', 1404, 'فروردین', 1, '19');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62287, 1, 'e7b6bb6e-4088-45d8-9725-d2c15ddd7cbb', 'آغاز فراخوان جذب مدرس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان سال۱۴۰۴', '<p style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان جهت تکمیل تیم مدرسان گروه های تخصصی خود از مدرسین،اساتید٬همکاران متخصص در صنعت آب و برق و کلیه علاقه مندان به تدریس در حوزه های مرتبط دعوت به همکاری می کند.</p>
', '<p style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان جهت تکمیل تیم مدرسان گروه های تخصصی خود از مدرسین،اساتید٬همکاران متخصص در صنعت آب و برق و کلیه علاقه مندان به تدریس در حوزه های مرتبط دعوت به همکاری می کند.<br />
	کلیه علاقه مندان به همکاری می توانند رزومه علمی و کاری خود را تا ۱۵ اردیبهشت ماه در آدرس ذیل بارگذاری نمایند.:</p>
<p style="text-align: center;">
	<span style="font-size:14px;"><a href="https://kwphc.ir/LecturerReg.aspx"><span style="color:#800080;">Https://www.Kwphc.ir/LecturerReg</span></a></span></p>
<p style="text-align: justify;">
	<span style="color:#b22222;"><strong>✓</strong></span> <span style="color:#9900cc;"><strong>دپارتمان عمومی و مدیریت شامل رشته های:</strong></span><br />
	مدیریت(دولتی، مالی و بازرگانی، کسب و کار، اجرایی، آموزشی، استراتژیک و ...)، حقوق، قراردادها، اقتصاد، حسابداری، روانشناسی، جامعه شناسی، صنایع، آمار، علوم سیاسی،&nbsp; کلیه گرایش های مهندسی کامپیوتر، بیمه، کتابداری، برنامه ریزی و علوم تربیتی<br />
	<br />
	<span style="color:#b22222;"><strong>✓</strong></span><span style="color:#9900cc;"><strong> دپارتمان آموزشی تخصصی آب و آبفا و بهداشت ، ایمنی و محیط زیست شامل رشته های:</strong></span><br />
	&nbsp;مهندسی نقشه برداری در کلیه گرایش های GIS&nbsp; ، فتوگرامتری ، سنجش از دور و میکروژئودزی<br />
	مهندسی عمران در کلیه گرایش های آب ، سازه ، ساختمان ، زلزله و ژئوتکنیک<br />
	مهندسی سازه های آبی<br />
	مهندسی زمین شناسی<br />
	مهندسی HSE<br />
	مهندسی علوم آب، هیدرولوژی<br />
	مهندسی آبیاری و زهکشی<br />
	مهندسی کشاورزی گرایش سازه های آبی<br />
	رشته حقوق (آب)<br />
	<br />
	<span style="color:#b22222;"><strong>✓</strong></span> <span style="color:#9900cc;"><strong>دپارتمان برق، انرژی و نیروگاه شامل رشته های:</strong></span><br />
	&nbsp;مهندسی برق، مکانیک، الکترونیک، صنایع و گرایش های: کنترل، ابزاردقیق، سیستم های قدرت، الکترونیک، الکترونیک قدرت، مخابرات، انرژی های تجدید پذیر، مکانیک سیالات، دینامیک، کنترل و ارتعاشات</p>
<p style="text-align: center;">
	<img alt="" src="wp-content/uploads/news-images/image_220.jpeg" style="height: 1000px; width: 700px;" /></p>
', '62287JModarres.jpg', 192, '1404/2/3', '10:07:57 AM', 1404, 'اردیبهشت', 2, '3');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62288, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری جلسه هماهنگی اجرای نظام صلاحیت حرفه‌ای نیروی انسانی شرکت‌های پیمانکار طرف قرارداد با شرکت‌های توزیع نیروی برق در استان', '<p style="text-align: justify;">
	<span dir="RTL" style="font-size: 11pt; line-height: 107%; font-family: Arial, sans-serif; color: black; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">&nbsp;در تاریخ ۱۴۰۴/۰۲/۰۱ جلسه&zwnj;ای به منظور هماهنگی و بررسی اجرای نظام صلاحیت حرفه&zwnj;ای نیروی انسانی شرکت&zwnj;های پیمانکار طرف قرارداد با شرکت&zwnj;های توزیع نیروی برق استان برگزار شد. این جلسه با حضور رئیس مجتمع آموزشی و پژوهشی آب و برق خوزستان ،نماینده شرکت مادر تخصصی توانیر،نمایندگان شرکت&zwnj;های توزیع نیروی برق اهواز و استان، نمایندگان انجمن صنفی کارفرمایی شرکت&zwnj;های توزیع نیروی برق کشور و همچنین کارکنان اداره صلاحیت حرفه&zwnj;ای و آزمون ها تشکیل گردید</span></p>
', '<p dir="RTL" style="text-align: justify;">
	در تاریخ ۱۴۰۴/۰۲/۰۱ جلسه&zwnj;ای به منظور هماهنگی و بررسی اجرای نظام صلاحیت حرفه&zwnj;ای نیروی انسانی شرکت&zwnj;های پیمانکار طرف قرارداد با شرکت&zwnj;های توزیع نیروی برق استان برگزار شد. این جلسه با حضور رئیس مجتمع آموزشی و پژوهشی آب و برق خوزستان ،نماینده شرکت مادر تخصصی توانیر،نمایندگان شرکت&zwnj;های توزیع نیروی برق اهواز و استان، نمایندگان انجمن صنفی کارفرمایی شرکت&zwnj;های توزیع نیروی برق کشور و همچنین کارکنان اداره صلاحیت حرفه&zwnj;ای و آزمون ها تشکیل گردید<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در این جلسه، اعضا به بررسی الزامات و استانداردهای لازم برای انجام سنجش و ارزیابی شایستگی های مشاغل فنی و تخصصی پرداختند و اهمیت رعایت این استانداردها در ارتقاء کیفیت خدمات ؛ بهره وری و افزایش ایمنی در شبکه توزیع برق مورد تأکید قرار گرفت. همچنین، نمایندگان حاضر در جلسه به تبادل نظر درباره چالش&zwnj;ها و موانع موجود در اجرای این نظام پرداخته و راهکارهای مناسبی را برای حل آن&zwnj;ها ارائه کردند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	همچنین دکتر هودگر رئیس مجتمع آموزشی آب و برق خوزستان با اشاره به اهمیت این موضوع، بر لزوم همکاری نزدیک میان تمامی ذینفعان تأکید کردند و خواستار تدوین برنامه&zwnj;ای جامع برای آموزش و ارتقاء مهارت&zwnj;های نیروی انسانی شدند. ایشان همچنین بر نقش کلیدی شرکت&zwnj;های پیمانکار در تحقق اهداف نظام صلاحیت حرفه&zwnj;ای تأکید کردند و خواستار حمایت و همفکری بیشتر از سوی نهادهای مربوطه شدند<span dir="LTR">.</span></p>
', '62288bdd.jpg', 109, '1404/2/7', '11:49:49 AM', 1404, 'اردیبهشت', 2, '7');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62289, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'مرکز رشد شهدای صنعت آب و برق خوزستان، به عنوان شعبه منطقه‌ای پژوهشگاه نیرو معرفی شد', '<p dir="RTL" style="text-align: justify;">
	در راستای توسعه زیست&zwnj;بوم نوآوری در حوزه آب، برق و انرژی و با هدف بهره&zwnj;برداری حداکثری از ظرفیت&zwnj;های علمی و فناورانه منطقه، &laquo;مرکز رشد شهدای صنعت آب و برق خوزستان&raquo; به عنوان شعبه منطقه&zwnj;ای پژوهشگاه نیرو معرفی شد و به شبکه مراکز رشد وابسته به این پژوهشگاه ملحق گردید<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	در راستای توسعه زیست&zwnj;بوم نوآوری در حوزه آب، برق و انرژی و با هدف بهره&zwnj;برداری حداکثری از ظرفیت&zwnj;های علمی و فناورانه منطقه، &laquo;مرکز رشد شهدای صنعت آب و برق خوزستان&raquo; به عنوان شعبه منطقه&zwnj;ای پژوهشگاه نیرو معرفی شد و به شبکه مراکز رشد وابسته به این پژوهشگاه ملحق گردید<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	این اقدام طی نشستی رسمی با حضور معاونت فناوری پژوهشگاه نیرو، مدیران جذب، مالی و فناوری، مدیر مرکز رشد خوزستان و سایر مسئولین مرتبط انجام شد. در این جلسه، ضمن ارائه گزارش عملکرد مرکز رشد در دو سال گذشته، به فرآیند شناسایی، پرورش و رشد تیم&zwnj;های فناور اشاره شد که منجر به شکل&zwnj;گیری و فعالیت ۱۴ هسته فناور گردیده است. این هسته&zwnj;ها اکنون در مسیر تبدیل به شرکت&zwnj;های فناور قرار دارند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	با الحاق رسمی مرکز رشد شهدای صنعت آب و برق خوزستان به پژوهشگاه نیرو، امکان بهره&zwnj;مندی از ظرفیت&zwnj;های این نهاد ملی از جمله خدمات آزمایشگاهی تخصصی، مشاوره&zwnj;های علمی و اقتصادی، مشارکت در نمایشگاه&zwnj;ها و رویدادهای تخصصی، شبکه&zwnj;سازی با نهادهای صنعت&zwnj;محور و بهره&zwnj;مندی از ظرفیت رسانه&zwnj;ای فراهم گردیده است<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '62289ad.jpg', 1054, '1404/2/7', '11:53:22 AM', 1404, 'اردیبهشت', 2, '7');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62290, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'پیام تسلیت رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در پی حادثه دلخراش بندر شهید رجایی', '<p style="text-align: justify;">
	با کمال تاسف و اندوه، حادثه دلخراش انفجار در بندر شهید رجایی بندرعباس را دریافتیم. این واقعه ناگوار، دل&zwnj;های بسیاری را در سراسر کشور به درد آورد و ما را بر آن داشت تا با مردم شریف و مقاوم این دیار همدردی کنیم.اینجانب و همکارانم در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، ضمن ابراز تسلیت به خانواده&zwnj;های داغدار و آسیب&zwnj;دیده، اعلام می&zwnj;داریم که در این زمان سخت و دشوار، با شما هستیم.</p>
<body id="cke_pastebin" style="position: absolute; top: 12px; width: 1px; height: 1px; overflow: hidden; right: -1000px;">
	<p>
		با کمال تاسف و اندوه، حادثه دلخراش انفجار در بندر شهید رجایی بندرعباس را دریافتیم. این واقعه ناگوار، دل&zwnj;های بسیاری را در سراسر کشور به درد آورد و ما را بر آن داشت تا با مردم شریف و مقاوم این دیار همدردی کنیم.اینجانب و همکارانم در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، ضمن ابراز تسلیت به خانواده&zwnj;های داغدار و آسیب&zwnj;دیده، اعلام می&zwnj;داریم که در این زمان سخت و دشوار، با شما هستیم.</p>
</body>', '<p dir="RTL" style="text-align: center;">
	بسمه تعالی</p>
<p dir="RTL" style="text-align: justify;">
	با کمال تاسف و اندوه، حادثه دلخراش انفجار در بندر شهید رجایی بندرعباس را دریافتیم. این واقعه ناگوار، دل&zwnj;های بسیاری را در سراسر کشور به درد آورد و ما را بر آن داشت تا با مردم شریف و مقاوم این دیار همدردی کنیم.اینجانب و همکارانم در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، ضمن ابراز تسلیت به خانواده&zwnj;های داغدار و آسیب&zwnj;دیده، اعلام می&zwnj;داریم که در این زمان سخت و دشوار، با شما هستیم.</p>
<p dir="RTL" style="text-align: center;">
	<span style="text-align: center;">وَبَشِّرِ الصَّابرِینَ الَّذینَ إِذَا أَصَابَتْهُمْ مُصِیبَهٌ قَالُوا إِنَّا لِلَّهِ وَ إِنَّا إِلَیْهِ رَاجِعُونَ</span></p>
<p dir="RTL" style="text-align: justify;">
	&nbsp;بی&zwnj;تردید، صبر و استقامت مردم بندرعباس در برابر این مصیبت بزرگ ستودنی است و ما به عنوان یک ملت، همواره در کنار یکدیگر خواهیم بود. امیدوارم که خداوند متعال به بازماندگان صبر و شکیبایی عطا فرماید و روح درگذشتگان را قرین رحمت و مغفرت خویش قرار دهد.</p>
<p dir="RTL" style="text-align: center;">
	&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	با احترام و همدردی</p>
<p dir="RTL" style="text-align: center;">
	مهدی هودگر&nbsp;</p>
<p dir="RTL" style="text-align: center;">
	رئیس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان</p>
<p>
	&nbsp;</p>', '62290bandar.jpg', 125, '1404/2/8', '10:44:45 AM', 1404, 'اردیبهشت', 2, '8');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62291, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری دوره توانمندسازی دانشجویان فعال فرهنگی، اجتماعی و سیاسی در خوزستان تحت عنوان «حلقه‌های میانی؛ حامیم»', '<p dir="RTL" style="text-align: justify;">
	به همت نهاد نمایندگی مقام معظم رهبری در دانشگاه علمی کاربردی استان خوزستان و با همکاری و میزبانی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، دوره توانمندسازی دانشجویان فعال فرهنگی، سیاسی و اجتماعی با عنوان &laquo;حلقه&zwnj;های میانی؛ حامیم&raquo; برگزار شد. این دوره با هدف ارتقای آگاهی و مهارت&zwnj;های دانشجویان در زمینه&zwnj;های مختلف اجتماعی و فرهنگی طراحی شده است<span dir="LTR">. </span></p>', '<p dir="RTL" style="text-align: justify;">
	به همت نهاد نمایندگی مقام معظم رهبری در دانشگاه علمی کاربردی استان خوزستان و با همکاری و میزبانی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، دوره توانمندسازی دانشجویان فعال فرهنگی، سیاسی و اجتماعی با عنوان &laquo;حلقه&zwnj;های میانی؛ حامیم&raquo; برگزار شد. این دوره با هدف ارتقای آگاهی و مهارت&zwnj;های دانشجویان در زمینه&zwnj;های مختلف اجتماعی و فرهنگی طراحی شده است<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	محورهای اصلی این دوره شامل موضوعات مهمی نظیر &quot;گام دوم انقلاب&quot;، &quot;جوانان پیشرو&quot;، &quot;مسئولیت و سازندگی&quot;، &quot;مشاوره توسعه کسب و کار&quot;، &quot;دشمن&zwnj;شناسی<span dir="LTR">&quot;</span>، <span dir="LTR">&quot;</span>کار باید تشکیلاتی باشد&quot; و &quot;توسعه فردی&quot; بود که به منظور تقویت روحیه فعالیت&zwnj;های اجتماعی و فرهنگی در بین جوانان برنامه&zwnj;ریزی شده بود<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	افتتاحیه این دوره با حضور دکتر بهرهی، رئیس دانشگاه جامع علمی کاربردی استان خوزستان و دکتر هودگر، رئیس مجتمع آموزشی پژوهشی صنعت آب و برق خوزستان برگزار شد<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	در ابتدای برنامه، دکتر مهدی هودگر ضمن خوش آمدگویی به شرکت&zwnj;کنندگان، ابراز افتخار کرد که مجتمع آموزشی آب و برق میزبان این دوره است. وی به اهمیت بیانیه گام دوم انقلاب اشاره کرده و گفت: &laquo;این بیانیه نقشه راهی برای جوانان است تا در مسیر پیشرفت کشور گام بردارند.&raquo; همچنین، وی از تلاش&zwnj;های امور فرهنگی مجتمع برای برنامه&zwnj;ریزی و اجرای این طرح قدردانی کرد و بر لزوم همکاری همه&zwnj;جانبه برای تحقق اهداف فرهنگی تأکید کرد<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	در ادامه، دکتر بهرهی نیز به ظرفیت&zwnj;های دانشگاه&zwnj;های استان اشاره کرد و بر اهمیت برگزاری این دوره تأکید نمود. وی گفت: &laquo;دانشجویان باید با آگاهی از مسائل روز جامعه، نقش موثری در توسعه کشور ایفا کنند و این دوره می&zwnj;تواند به تقویت روحیه فعالیت&zwnj;های اجتماعی و فرهنگی در بین جوانان کمک کند<span dir="LTR">.&raquo; </span></p>
<p dir="RTL" style="text-align: justify;">
	پس از افتتاحیه، کارگاه&zwnj;های آموزشی به ترتیب برنامه اجرا شد. کارگاه نخست با حضور حجت الاسلام عادلی نژاد، مسئول نهاد نمایندگی مقام معظم رهبری در دانشگاه&zwnj;های استان خوزستان برگزار شد. سپس کارگاه دوم با حضور حجت الاسلام حاجتی، استاد حوزه و دانشگاه و امام جمعه موقت اهواز ادامه یافت. کارگاه سوم نیز با حضور حجت الاسلام سمیع، مسئول نهاد رهبری دانشگاه جامع علمی کاربردی استان خوزستان برگزار گردید<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	کارگاه چهارم به ارائه مهندس حسین معاونی اختصاص داشت. وی مجری اسبق توسعه زنجیره&zwnj;های ارزش اقتصادی استان خوزستان، مدیر سابق پروژه&zwnj;های اقتصادی جنوب غرب بنیاد علوی و مدیر کانون اشتغال آستان قدس رضوی بود. مهندس معاونی در این کارگاه به بررسی چالش&zwnj;ها و فرصت&zwnj;های موجود در زمینه توسعه کسب و کار پرداخت<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	در بین برنامه&zwnj;ها، اقامه نماز ظهر و عصر، تلاوت قرآن و صرف ناهار نیز برای شرکت&zwnj;کنندگان فراهم شد. همچنین دورهمی جوانان پیشرو با حضور محمدعلی رستمی، معاون جوانان اداره کل ورزش و جوانان استان خوزستان برگزار گردید که فضایی برای تبادل نظر و گفتگو میان جوانان فراهم آورد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '62291photoooo.jpg', 127, '1404/2/14', '12:57:19 AM', 1404, 'اردیبهشت', 2, '14');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62292, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'تجلیل از اساتید مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان به مناسبت روز معلم', '<p dir="RTL" style="text-align: justify;">
	به مناسبت روز معلم، مدیران مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور در کلاس&zwnj;های درس، از زحمات و تلاش&zwnj;های اساتید تجلیل کردند<span dir="LTR">. </span>این اقدام با هدف قدردانی از نقش کلیدی معلمان در تربیت نسل آینده و ارتقاء سطح علمی دانشجویان انجام شد<span dir="LTR">. </span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	به مناسبت روز معلم، مدیران مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور در کلاس&zwnj;های درس، از زحمات و تلاش&zwnj;های اساتید تجلیل کردند<span dir="LTR">. </span>این اقدام با هدف قدردانی از نقش کلیدی معلمان در تربیت نسل آینده و ارتقاء سطح علمی دانشجویان انجام شد<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	مدیران با حضور در کلاس&zwnj;ها، ضمن ابراز احترام به مقام معلم، به اساتید لوح تقدیر و شاخه گل اهدا کردند. این حرکت نمادی از ارادت و قدردانی جامعه علمی به زحمات بی&zwnj;وقفه اساتید بود<span dir="LTR">. </span></p>
<p dir="RTL" style="text-align: justify;">
	اساتید نیز در این دیدارها، از توجه و حمایت مدیران قدردانی کردند و بر اهمیت نقش خود در آموزش و پرورش دانشجویان تأکید کردند<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '62292ostad.jpg', 162, '1404/2/14', '1:04:53 AM', 1404, 'اردیبهشت', 2, '14');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62293, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'اردوی راهیان پیشرفت؛ فرصتی برای ارتقای خودباوری و آشنایی با دستاوردهای صنعت آب و برق', '<p dir="RTL" style="text-align: justify;">
	به گزارش روابط عمومی مجتمع آموزشی آب و برق خوزستان، اردوی راهیان پیشرفت با هدف ارتقای خودباوری، امیدآفرینی و تقویت اراده با حضور جمعی از دانشجویان و کارکنان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد. این اردو در محل شرکت آب جنوب شرق و با همکاری این شرکت برگزار گردید<span dir="LTR">. </span></p>
<p>
	&nbsp;</p>', '<p>
	<!--[if gte mso 9]><xml>
 <o:OfficeDocumentSettings>
  <o:AllowPNG/>
 </o:OfficeDocumentSettings>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:View>Normal</w:View>
  <w:Zoom>0</w:Zoom>
  <w:TrackMoves/>
  <w:TrackFormatting/>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>EN-US</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>AR-SA</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
   <w:SplitPgBreakAndParaMark/>
   <w:EnableOpenTypeKerning/>
   <w:DontFlipMirrorIndents/>
   <w:OverrideTableStyleHps/>
  </w:Compatibility>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"/>
   <m:brkBin m:val="before"/>
   <m:brkBinSub m:val="&#45;-"/>
   <m:smallFrac m:val="off"/>
   <m:dispDef/>
   <m:lMargin m:val="0"/>
   <m:rMargin m:val="0"/>
   <m:defJc m:val="centerGroup"/>
   <m:wrapIndent m:val="1440"/>
   <m:intLim m:val="subSup"/>
   <m:naryLim m:val="undOvr"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"
  DefSemiHidden="false" DefQFormat="false" DefPriority="99"
  LatentStyleCount="376">
  <w:LsdException Locked="false" Priority="0" QFormat="true" Name="Normal"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 1"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 2"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 3"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 4"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 5"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 6"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 7"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 8"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 9"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 1"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 2"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 3"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 4"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 5"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 6"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 7"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 8"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="footnote text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="header"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="footer"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index heading"/>
  <w:LsdException Locked="false" Priority="35" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="caption"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="table of figures"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="envelope address"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="envelope return"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="footnote reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="line number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="page number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="endnote reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="endnote text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="table of authorities"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="macro"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="toa heading"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 5"/>
  <w:LsdException Locked="false" Priority="10" QFormat="true" Name="Title"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Closing"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Signature"/>
  <w:LsdException Locked="false" Priority="1" SemiHidden="true"
   UnhideWhenUsed="true" Name="Default Paragraph Font"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Message Header"/>
  <w:LsdException Locked="false" Priority="11" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Salutation"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Date"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text First Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text First Indent 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Note Heading"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Block Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Hyperlink"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="FollowedHyperlink"/>
  <w:LsdException Locked="false" Priority="22" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" Priority="20" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Document Map"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Plain Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="E-mail Signature"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Top of Form"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Bottom of Form"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal (Web)"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Acronym"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Address"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Cite"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Code"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Definition"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Keyboard"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Preformatted"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Sample"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Typewriter"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Variable"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal Table"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation subject"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="No List"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Contemporary"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Elegant"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Professional"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Subtle 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Subtle 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Balloon Text"/>
  <w:LsdException Locked="false" Priority="39" Name="Table Grid"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Theme"/>
  <w:LsdException Locked="false" SemiHidden="true" Name="Placeholder Text"/>
  <w:LsdException Locked="false" Priority="1" QFormat="true" Name="No Spacing"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 1"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 1"/>
  <w:LsdException Locked="false" SemiHidden="true" Name="Revision"/>
  <w:LsdException Locked="false" Priority="34" QFormat="true"
   Name="List Paragraph"/>
  <w:LsdException Locked="false" Priority="29" QFormat="true" Name="Quote"/>
  <w:LsdException Locked="false" Priority="30" QFormat="true"
   Name="Intense Quote"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 1"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 1"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 2"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 2"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 2"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 3"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 3"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 3"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 4"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 4"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 4"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 5"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 5"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 5"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 6"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 6"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 6"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="19" QFormat="true"
   Name="Subtle Emphasis"/>
  <w:LsdException Locked="false" Priority="21" QFormat="true"
   Name="Intense Emphasis"/>
  <w:LsdException Locked="false" Priority="31" QFormat="true"
   Name="Subtle Reference"/>
  <w:LsdException Locked="false" Priority="32" QFormat="true"
   Name="Intense Reference"/>
  <w:LsdException Locked="false" Priority="33" QFormat="true" Name="Book Title"/>
  <w:LsdException Locked="false" Priority="37" SemiHidden="true"
   UnhideWhenUsed="true" Name="Bibliography"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="TOC Heading"/>
  <w:LsdException Locked="false" Priority="41" Name="Plain Table 1"/>
  <w:LsdException Locked="false" Priority="42" Name="Plain Table 2"/>
  <w:LsdException Locked="false" Priority="43" Name="Plain Table 3"/>
  <w:LsdException Locked="false" Priority="44" Name="Plain Table 4"/>
  <w:LsdException Locked="false" Priority="45" Name="Plain Table 5"/>
  <w:LsdException Locked="false" Priority="40" Name="Grid Table Light"/>
  <w:LsdException Locked="false" Priority="46" Name="Grid Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="Grid Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="Grid Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="46" Name="List Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="List Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="List Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Mention"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Smart Hyperlink"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Hashtag"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Unresolved Mention"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Smart Link"/>
 </w:LatentStyles>
</xml><![endif]--><!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin-top:0cm;
	mso-para-margin-right:0cm;
	mso-para-margin-bottom:8.0pt;
	mso-para-margin-left:0cm;
	line-height:107%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:Arial;
	mso-bidi-theme-font:minor-bidi;
	mso-font-kerning:1.0pt;
	mso-ligatures:standardcontextual;}
</style>
<![endif]--></p>
<p class="MsoNormal" dir="RTL" style="direction: rtl; unicode-bidi: embed; text-align: justify;">
	<span lang="AR-SA" style="font-family:&quot;Arial&quot;,sans-serif;mso-ascii-font-family:
Calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi">به گزارش روابط عمومی مجتمع آموزشی آب و برق خوزستان، اردوی راهیان پیشرفت با هدف ارتقای خودباوری، امیدآفرینی و تقویت اراده با حضور جمعی از دانشجویان و کارکنان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد. این اردو در محل شرکت آب جنوب شرق و با همکاری این شرکت برگزار گردید</span><span dir="LTR">. </span></p>
<p class="MsoNormal" dir="RTL" style="direction: rtl; unicode-bidi: embed; text-align: justify;">
	<span lang="AR-SA" style="font-family:&quot;Arial&quot;,sans-serif;mso-ascii-font-family:
Calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi">در این برنامه، شرکت&zwnj;کنندگان از اداره</span><span dir="LTR"> HSC </span><span lang="AR-SA" style="font-family:&quot;Arial&quot;,sans-serif;mso-ascii-font-family:Calibri;mso-ascii-theme-font:
minor-latin;mso-hansi-font-family:Calibri;mso-hansi-theme-font:minor-latin;
mso-bidi-theme-font:minor-bidi">و تصفیه&zwnj;خانه شرکت آب جنوب شرق بازدید کردند. در خلال این بازدید، توضیحات مفصلی درباره عملکرد و دستاوردهای این اداره ارائه شد که به درک بهتر دانشجویان از روند کار و اهمیت این صنعت کمک کرد</span><span dir="LTR">. </span></p>
<p class="MsoNormal" dir="RTL" style="direction: rtl; unicode-bidi: embed; text-align: justify;">
	<span lang="AR-SA" style="font-family:&quot;Arial&quot;,sans-serif;mso-ascii-font-family:
Calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi">علاوه بر بازدید از تأسیسات، دانشجویان همچنین از اسکله این شرکت دیدن کردند که به عنوان یکی از نقاط کلیدی در مدیریت منابع آبی و انتقال آب به شمار می&zwnj;رود</span><span dir="LTR">. </span></p>
<p class="MsoNormal" dir="RTL" style="direction: rtl; unicode-bidi: embed; text-align: justify;">
	<span lang="AR-SA" style="font-family:&quot;Arial&quot;,sans-serif;mso-ascii-font-family:
Calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi">در پایان این اردوی آموزشی، نهاری در مجموعه گیت بوستان برای شرکت&zwnj;کنندگان فراهم شد که فرصتی برای تبادل نظر و گفتگو درباره تجربیات به دست آمده در طول روز بود</span><span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '62293ordo.jpg', 137, '1404/2/14', '1:26:15 AM', 1404, 'اردیبهشت', 2, '14');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62294, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری نمایشگاه اینوتکس ۲۰۲۵ در پارک فناوری پردیس', '<p style="text-align: justify;">
	<span dir="RTL">نمایشگاه اینوتکس </span><span dir="RTL">۲۰۲۵</span> <span dir="RTL">از نهم تا دوازدهم اردیبهشت در پارک فناوری پردیس برگزار شد. این رویداد ملی با حضور بیش از </span><span dir="RTL">۴۵۰</span> <span dir="RTL">شرکت نوآور، </span><span dir="RTL">۱۵۰</span> <span dir="RTL">سرمایه&zwnj;گذار و یکصد هزار بازدیدکننده از زیست بوم نوآوری و فناوری، به برگزاری بیش از </span><span dir="RTL">۴۰۰</span> <span dir="RTL">جلسه</span> B<span dir="RTL">۲</span>B <span dir="RTL">و </span><span dir="RTL">۲۰</span> <span dir="RTL">رویداد علمی پرداخت</span>.</p>', '<p dir="RTL" style="text-align: justify;">
	نمایشگاه اینوتکس ۲۰۲۵ از نهم تا دوازدهم اردیبهشت در پارک فناوری پردیس برگزار شد. این رویداد ملی با حضور بیش از ۴۵۰ شرکت نوآور، ۱۵۰ سرمایه&zwnj;گذار و یکصد هزار بازدیدکننده از زیست بوم نوآوری و فناوری، به برگزاری بیش از ۴۰۰ جلسه<span dir="LTR"> B</span>۲<span dir="LTR">B </span>و ۲۰ رویداد علمی پرداخت<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در بخش&zwnj;های جنبی نمایشگاه، استیج اینوتکس با هدف اتصال ایده&zwnj;های جذاب و گفتگوهای نوآورانه، به بررسی آینده کسب و کارها و نقش فناوری&zwnj;های نوظهور پرداخت. همچنین فروم حکمرانی و قانون&zwnj;گذاری با نگاهی به سیاست&zwnj;گذاری نوآوری و فناوری کشور، و رویدادهای شبکه&zwnj;سازی مانند اینونایت و کافه سرمایه برای تأمین منابع مالی برگزار شد. پاویون مشاوران نیز خدمات مشاوره&zwnj;ای متناسب با نیازهای اکوسیستم فناوری ارائه کرد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	از دیگر رویدادهای مهم نمایشگاه می&zwnj;توان به ریسرچ پیج، اینوتکس پیج و رقابت استارتاپ&zwnj;ها اشاره کرد که در حضور سرمایه&zwnj;گذاران و با امتیازدهی داوران ایرانی و بین&zwnj;المللی برگزار شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	همچنین، با توجه به مشارکت مؤثر مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان در رقابت&zwnj;های مقدماتی این رویداد، ریاست مجتمع (دکتر هودگر)، معاونت برنامه&zwnj;ریزی آموزشی (دکتر عرب زاده) و مدیر مرکز رشد شهدای صنعت آب و برق (مهندس لیمویی) به عنوان میهمانان ویژه در این رویداد حضور داشتند<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '62294Untitled.jpg', 1052, '1404/2/20', '3:07:53 AM', 1404, 'اردیبهشت', 2, '20');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (62295, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'توسعه همکاری‌های مجتمع آموزشی آب و برق خوزستان و مرکز آموزشی حرم مطهر امام رضا علیه السلام', '<p dir="RTL" style="text-align: justify;">
	در روز پنجشنبه، ۱۸ اردیبهشت، و در آستانه میلاد با سعادت امام رضا علیه&zwnj;السلام، توافقی جامع و مهم در زمینه همکاری&zwnj;های آموزشی میان مجتمع آب و برق خوزستان و مرکز آموزش حرم مطهر رضوی منعقد گردید<span dir="LTR"> . </span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	در روز پنجشنبه، ۱۸ اردیبهشت، و در آستانه میلاد با سعادت امام رضا علیه&zwnj;السلام، توافقی جامع و مهم در زمینه همکاری&zwnj;های آموزشی میان مجتمع آب و برق خوزستان و مرکز آموزش حرم مطهر رضوی منعقد گردید<span dir="LTR"> . </span></p>
<p dir="RTL" style="text-align: justify;">
	انتظار می&zwnj;رود این همکاری در آینده نزدیک به برگزاری کارگاه&zwnj;ها و دوره&zwnj;های تخصصی در زمینه&zwnj;های مختلف منجر شود و از طرف دیگر، با توجه به ارتباطات فرهنگی و مذهبی، فرصتی برای ترویج ارزش&zwnj;های انسانی و اخلاقی نیز فراهم آورد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '62295reza.jpg', 128, '1404/2/20', '3:16:20 AM', 1404, 'اردیبهشت', 2, '20');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (63294, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'تجلیل از کارکنان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان؛ تاکید بر ارزیابی فصلی عملکرد', '<p dir="RTL">
	مراسم تجلیل و تقدیر از کارکنان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور مدیران و کارکنان این مجتمع برگزار شد<span dir="LTR">. </span>در این مراسم، دکتر مهدی هودگر، ریاست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، ضمن خوشامدگویی به حاضران، از تلاش&zwnj;های خالصانه و صادقانه کارکنان در راستای اهداف مجتمع قدردانی کرد و نقش آن&zwnj;ها را در پیشبرد برنامه&zwnj;ها و تحقق اهداف سازمانی مهم ارزیابی کرد. وی با اشاره به اهمیت نیروی انسانی متخصص و متعهد در توسعه و پیشرفت صنعت آب و برق، بر لزوم توجه به ارتقای دانش و مهارت&zwnj;های کارکنان تاکید کرد<span dir="LTR">. </span></p>
<p>
	&nbsp;</p>', '<p dir="RTL">
	مراسم تجلیل و تقدیر از کارکنان مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور مدیران و کارکنان این مجتمع برگزار شد<span dir="LTR">. </span>در این مراسم، دکتر مهدی هودگر، ریاست مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان، ضمن خوشامدگویی به حاضران، از تلاش&zwnj;های خالصانه و صادقانه کارکنان در راستای اهداف مجتمع قدردانی کرد و نقش آن&zwnj;ها را در پیشبرد برنامه&zwnj;ها و تحقق اهداف سازمانی مهم ارزیابی کرد. وی با اشاره به اهمیت نیروی انسانی متخصص و متعهد در توسعه و پیشرفت صنعت آب و برق، بر لزوم توجه به ارتقای دانش و مهارت&zwnj;های کارکنان تاکید کرد<span dir="LTR">. </span></p>
<p dir="RTL">
	دکتر هودگر در ادامه سخنان خود، از رویکرد جدید مجتمع در ارزیابی عملکرد کارکنان خبر داد و اعلام کرد که از سال جدید، عملکرد کارکنان به صورت فصلی مورد ارزیابی قرار خواهد گرفت. وی هدف از این اقدام را ایجاد انگیزه بیشتر در بین کارکنان، شناسایی نقاط قوت و ضعف و ارائه بازخورد سازنده برای بهبود عملکرد عنوان کرد. به گفته وی، این ارزیابی&zwnj;ها به صورت شفاف و عادلانه انجام خواهد شد و نتایج آن در تصمیم&zwnj;گیری&zwnj;های مربوط به ارتقاء و تشویق کارکنان لحاظ خواهد شد<span dir="LTR">. </span></p>
<p dir="RTL">
	<span dir="RTL">در پایان این مراسم، از تعدادی از کارکنان و مدیران فعال مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با اهدای لوح تقدیر قدردانی شد</span></p>
<p>
	&nbsp;</p>', '62296Untitledsss.jpg', 72, '1404/2/27', '3:57:18 AM', 1404, 'اردیبهشت', 2, '27');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (63295, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری دوره آموزشی آرشیو و مستندسازی روابط عمومی با محوریت هوش مصنوعی در خوزستان', '<p dir="RTL" style="text-align: justify;">
	دوره آموزشی آرشیو و مستندسازی در روابط عمومی با هدف ارتقای دانش و مهارت مدیران و کارشناسان روابط عمومی شرکت&zwnj;های تابعه آب و برق خوزستان، در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق این استان برگزار شد<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	دوره آموزشی آرشیو و مستندسازی در روابط عمومی با هدف ارتقای دانش و مهارت مدیران و کارشناسان روابط عمومی شرکت&zwnj;های تابعه آب و برق خوزستان، در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق این استان برگزار شد<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	این دوره آموزشی به بررسی مباحث کلیدی در زمینه آرشیو و مستندسازی در روابط عمومی&zwnj;ها، اهداف و استانداردهای این حوزه، و بهره&zwnj;گیری از فناوری&zwnj;های نوین به ویژه هوش مصنوعی در بهبود فرآیندهای کاری پرداخت<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در حاشیه این دوره، شرکت&zwnj;کنندگان از شبکه جهانی الاهواز بازدید کردند. در این بازدید، مدیران رسانه الاهواز ضمن معرفی این شبکه، به تشریح فعالیت&zwnj;ها و دستاوردهای آن پرداختند. مجید خطیب، مدیر روابط عمومی شبکه الاهواز، ضمن خوشامدگویی به مدیران روابط عمومی شرکت های تابعه سازمان آب و برق خوزستان، به ارائه گزارشی از عملکرد شبکه پرداخت<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	مهندس حردانی، معاون اجرایی شبکه الاهواز نیز با حضور در جمع شرکت&zwnj;کنندگان، به مباحث فنی و آموزشی در حوزه تولید محتوا، آرشیو، و نحوه پخش برنامه&zwnj;ها پرداخت و تجربیات خود را در این زمینه به اشتراک گذاشت. در ادامه این بازدید، شرکت&zwnj;کنندگان از استودیوها و اتاق فرمان شبکه الاهواز بازدید کردند و با تجهیزات و فرآیندهای فنی تولید و پخش برنامه&zwnj;ها آشنا شدند<span dir="LTR">.</span></p>
<p dir="RTL" style="text-align: justify;">
	در پایان دوره، شرکت&zwnj;کنندگان ضمن ابراز رضایت از محتوای ارائه شده و کیفیت برگزاری، خواستار تداوم برگزاری دوره&zwnj;های مشابه در آینده شدند<span dir="LTR">.</span></p>
<p>
	&nbsp;</p>', '63295Untitledfff.jpg', 82, '1404/2/27', '4:01:07 AM', 1404, 'اردیبهشت', 2, '27');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (63296, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'تمدید فراخوان جذب مدرس مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان سال۱۴۰۴', '<p style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان جهت تکمیل تیم مدرسان گروه های تخصصی خود از مدرسین،اساتید٬همکاران متخصص در صنعت آب و برق و کلیه علاقه مندان به تدریس در حوزه های مرتبط دعوت به همکاری می کند.</p>', '<p style="text-align: justify;">
	مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان جهت تکمیل تیم مدرسان گروه های تخصصی خود از مدرسین،اساتید٬همکاران متخصص در صنعت آب و برق و کلیه علاقه مندان به تدریس در حوزه های مرتبط دعوت به همکاری می کند.<br />
	کلیه علاقه مندان به همکاری می توانند رزومه علمی و کاری خود را تا ۱۵ اردیبهشت ماه در آدرس ذیل بارگذاری نمایند.:</p>
<p style="text-align: center;">
	<span style="font-size:14px;"><a href="https://kwphc.ir/LecturerReg.aspx"><span style="color:#800080;">Https://www.Kwphc.ir/LecturerReg</span></a></span></p>
<p style="text-align: justify;">
	<span style="color:#b22222;"><strong>✓</strong></span> <span style="color:#9900cc;"><strong>دپارتمان عمومی و مدیریت شامل رشته های:</strong></span><br />
	مدیریت(دولتی، مالی و بازرگانی، کسب و کار، اجرایی، آموزشی، استراتژیک و ...)، حقوق، قراردادها، اقتصاد، حسابداری، روانشناسی، جامعه شناسی، صنایع، آمار، علوم سیاسی،&nbsp; کلیه گرایش های مهندسی کامپیوتر، بیمه، کتابداری، برنامه ریزی و علوم تربیتی<br />
	<br />
	<span style="color:#b22222;"><strong>✓</strong></span><span style="color:#9900cc;"><strong> دپارتمان آموزشی تخصصی آب و آبفا و بهداشت ، ایمنی و محیط زیست شامل رشته های:</strong></span><br />
	&nbsp;مهندسی نقشه برداری در کلیه گرایش های GIS&nbsp; ، فتوگرامتری ، سنجش از دور و میکروژئودزی<br />
	مهندسی عمران در کلیه گرایش های آب ، سازه ، ساختمان ، زلزله و ژئوتکنیک<br />
	مهندسی سازه های آبی<br />
	مهندسی زمین شناسی<br />
	مهندسی HSE<br />
	مهندسی علوم آب، هیدرولوژی<br />
	مهندسی آبیاری و زهکشی<br />
	مهندسی کشاورزی گرایش سازه های آبی<br />
	رشته حقوق (آب)<br />
	<br />
	<span style="color:#b22222;"><strong>✓</strong></span> <span style="color:#9900cc;"><strong>دپارتمان برق، انرژی و نیروگاه شامل رشته های:</strong></span><br />
	&nbsp;مهندسی برق، مکانیک، الکترونیک، صنایع و گرایش های: کنترل، ابزاردقیق، سیستم های قدرت، الکترونیک، الکترونیک قدرت، مخابرات، انرژی های تجدید پذیر، مکانیک سیالات، دینامیک، کنترل و ارتعاشات</p>
<p>
	&nbsp;</p>', '63296Untitledffff.jpg', 139, '1404/2/27', '4:05:31 AM', 1404, 'اردیبهشت', 2, '27');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (63297, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری طرح دسته‌جمعی قرائت قرآن کریم به مناسبت روز شهدای خدمت در مراکز آموزش علمی کاربردی خوزستان', '<p dir="RTL">
	به اطلاع می ساند با توجه به ثبت روز ۳۰ اردیبهشت به عنوان روز شهدای خدمت در متن تقویم رسمی کشور توسط رئیس محترم جمهور و رئیس شورای عالی انقلاب فرهنگی و به منظور پاسداشت مقام شامخ شهدای این روز شهید جمهور آیت الله سید ابراهیم رئیسی و هیات همراه اداره کل امور دانشجویان شاهد و ایثارگر در نظر دارد طرح دسته جمعی قرائت قرآن کریم را در روز ۳۰ اردیبهشت ماه به صورت سراسری در مراکز آموزش علمی کاربردی به نیت شادی روح شهدای خدمت برگزار نماید.</p>
<p>
	&nbsp;</p>', '<p dir="RTL">
	به اطلاع می ساند با توجه به ثبت روز ۳۰ اردیبهشت به عنوان روز شهدای خدمت در متن تقویم رسمی کشور توسط رئیس محترم جمهور و رئیس شورای عالی انقلاب فرهنگی و به منظور پاسداشت مقام شامخ شهدای این روز شهید جمهور آیت الله سید ابراهیم رئیسی و هیات همراه اداره کل امور دانشجویان شاهد و ایثارگر در نظر دارد طرح دسته جمعی قرائت قرآن کریم را در روز ۳۰ اردیبهشت ماه به صورت سراسری در مراکز آموزش علمی کاربردی به نیت شادی روح شهدای خدمت برگزار نماید.</p>
<p>
	&nbsp;</p>', '63297photoqoran.jpg', 105, '1404/2/29', '12:27:58 PM', 1404, 'اردیبهشت', 2, '29');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (64294, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری ارزیابی صلاحیت حرفه‌ای نیروهای پیمانکار شرکت توزیع نیروی برق اهواز', '<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;"><strong>صلاحیت حرفه&zwnj;ای نیروهای فنی و تخصصی شرکت&zwnj;های پیمانکار زیرمجموعه شرکت توزیع نیروی برق اهواز در مشاغل &quot;فن&zwnj;ورز عملیات و اتفاقات شبکه، فن&zwnj;ورز تعمیرات شبکه و پست، فن&zwnj;ورز خط گرم و فن&zwnj;ورز نصب و اصلاح لوازم اندازه&zwnj;گیری&quot; طی سه روز، از ۲۳ لغایت ۲۵ اردیبهش&zwnj; ماه ۱۴۰۴ در مجتمع آموزشی صنعت آب و برق خوزستان برگزار گردید<span dir="LTR">.</span></strong></span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;"><strong>صلاحیت حرفه&zwnj;ای نیروهای فنی و تخصصی شرکت&zwnj;های پیمانکار زیرمجموعه شرکت توزیع نیروی برق اهواز در مشاغل &quot;فن&zwnj;ورز عملیات و اتفاقات شبکه، فن&zwnj;ورز تعمیرات شبکه و پست، فن&zwnj;ورز خط گرم و فن&zwnj;ورز نصب و اصلاح لوازم اندازه&zwnj;گیری&quot; طی سه روز، از ۲۳ لغایت ۲۵ اردیبهش&zwnj; ماه ۱۴۰۴ در مجتمع آموزشی صنعت آب و برق خوزستان برگزار گردید<span dir="LTR">.</span></strong></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;"><strong>این برنامه با حضور بیش از ۲۶۰ نفر از نیروهای پیمانکار و ارزیابانی از استان&zwnj;های مختلف کشور، در ایستگاه&zwnj;های تخصصی شامل آزمون دانشی، شناخت تجهیزات ایمنی، خط گرم، لوازم اندازه&zwnj;گیری و تجهیزات و یراق شناسی شبکه، طب کار و روانشناسی برگزار گردید. ارزیابی توسط مجتمع آموزشی صنعت آب و برق خوزستان و با همکاری شرکت توزیع نیروی برق اهواز و انجمن صنفی شرکت&zwnj;های توزیع، همچنین حمایت شرکت توانیر انجام شد</strong></span></p>
<p>
	&nbsp;</p>', '63298azmoonnbargh.jpg', 140, '1404/3/2', '4:33:34 PM', 1404, 'خرداد', 3, '2');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (64295, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'تقدیر ریاست دانشگاه جامع علمی‌کاربردی خوزستان از مرکز آموزشی آب و برق بخاطر برگزاری دوره «حامیم»', '<p dir="RTL" style="text-align: justify;">
	در آیینی با حضور دکتر بهرهی ، ریاست محترم دانشگاه جامع علمی&zwnj;کاربردی استان خوزستان، از زحمات و اقدامات ارزشمند دکتر هودگر ریاست محترم مرکز آموزشی علمی کاربردی آب و برق خوزستان و همچنین مهندس محمد طاهر دباغ مسئول امور فرهنگی مرکز در خصوص اجرای برنامه فرهنگی بویژه برگزاری دوره توانمندسازی دانشجویان تحت عنوان &laquo;حلقه&zwnj;های میانی؛ حامیم&raquo; تقدیر به عمل آمد<span dir="LTR">.&nbsp; </span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	در آیینی با حضور دکتر بهرهی ، ریاست محترم دانشگاه جامع علمی&zwnj;کاربردی استان خوزستان، از زحمات و اقدامات ارزشمند دکتر هودگر ریاست محترم مرکز آموزشی علمی کاربردی آب و برق خوزستان و همچنین مهندس محمد طاهر دباغ مسئول امور فرهنگی مرکز در خصوص اجرای برنامه فرهنگی بویژه برگزاری دوره توانمندسازی دانشجویان تحت عنوان &laquo;حلقه&zwnj;های میانی؛ حامیم&raquo; تقدیر به عمل آمد<span dir="LTR">.&nbsp; </span></p>
<p dir="RTL" style="text-align: justify;">
	این دوره آموزشی که به همت نهاد نمایندگی مقام معظم رهبری و در دانشگاه علمی&zwnj;کاربردی و با میزبانی مرکز علمی کاربردی صنعت آب و برق خوزستان برگزار شد، با استقبال چشمگیر دانشجویان فعال فرهنگی، اجتماعی و سیاسی همراه بود<span dir="LTR">.&nbsp; </span></p>
<p dir="RTL" style="text-align: justify;">
	دکتر بهرهی در این مراسم با اشاره به محورهای غنی این دوره شامل &laquo;گام دوم انقلاب&raquo;، &laquo;جوانان پیشرو&raquo;، &laquo;مسئولیت و سازندگی&raquo;، &laquo;مشاوره توسعه کسب&zwnj;وکار&raquo;، &laquo;دشمن&zwnj;شناسی&raquo; و &laquo;کار تشکیلاتی&raquo;، این اقدام را گامی بلند در جهت تربیت نیروهای متعهد و انقلابی دانستند<span dir="LTR">.&nbsp; </span></p>
<p dir="RTL" style="text-align: justify;">
	ریاست دانشگاه جامع علمی&zwnj;کاربردی خوزستان در ادامه از همکاری&zwnj;های سازنده مرکز آموزشی و پژوهشی صنعت آب و برق خوزستان تقدیر نمود و بر تداوم چنین برنامه&zwnj;های اثرگذاری در راستای توانمندسازی نسل جوان تأکید کرد<span dir="LTR">.&nbsp; </span></p>
<p>
	&nbsp;</p>', '64295taghdirhamim.jpg', 137, '1404/3/2', '4:35:20 PM', 1404, 'خرداد', 3, '2');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (64296, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'مراسم تودیع و معارفه مدیران در مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان برگزار شد', '<p>
	<span dir="RTL">مراسم تودیع و معارفه مدیران مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور دکتر مهدی هودگر، ریاست این مجتمع، برگزار شد. در این مراسم، ضمن تقدیر از خدمات مدیران پیشین، انتصابات جدیدی در حوزه&zwnj;های آموزشی و اداری انجام شد</span>.&nbsp;&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">&nbsp;مراسم تودیع و معارفه مدیران مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان با حضور دکتر مهدی هودگر، ریاست این مجتمع، برگزار شد. در این مراسم، ضمن تقدیر از خدمات مدیران پیشین، انتصابات جدیدی در حوزه&zwnj;های آموزشی و اداری انجام شد<span dir="LTR">.&nbsp;</span></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;"><span dir="LTR">🔰</span> انتصابات جدید در حوزه آموزش<span dir="LTR"> :</span></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">در ابتدای این مراسم، دکتر هودگر با تقدیر از زحمات آرش ساردوئی در اداره آموزش بلندمدت، وی را به سمت سرپرست گروه آموزشی آب، آبفا و<span dir="LTR"> HSE</span>منصوب کرد.&nbsp;همچنین، فاطمه دشتستانی به عنوان سرپرست جدید اداره آموزش بلندمدت معرفی شد. ریاست مجتمع در این بخش بر اهمیت توسعه کیفی برنامه&zwnj;های آموزشی و نقش این مدیران در ارتقای سطح آموزش&zwnj;های تخصصی صنعت آب و برق تأکید کرد<span dir="LTR">.&nbsp;</span></span></p>
<p dir="RTL" style="text-align: justify;">
	<span dir="LTR" style="font-size: 14px;">🔰</span><span style="font-size: 14px;"> تغییرات در اداره بودجه و قراردادها</span><span dir="LTR" style="font-size: 14px;">:</span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">&nbsp;در ادامه مراسم، از خدمات آقای نصیریان در اداره بودجه و قراردادها تقدیر شد و خانم رضوان بیت سیاح به عنوان سرپرست جدید این اداره منصوب گردید. دکتر هودگر با اشاره به اهمیت مدیریت مالی و انعقاد قراردادهای اثربخش، خواستار تحقق اهداف کلان مجموعه در این حوزه شد<span dir="LTR">.&nbsp;</span>دکتر مهدی هودگر در پایان این مراسم، ضمن آرزوی موفقیت برای مدیران جدید، از تمامی همکاران خواست تا با همکاری و تعامل بیشتر، در راستای پیشبرد اهداف آموزشی و پژوهشی مجتمع گام بردارند. وی همچنین قدردانی صمیمانه&zwnj;ای از مدیران سابق به عمل آورد و خاطرنشان کرد که تجربیات و تلاش&zwnj;های آنان، زمینه&zwnj;ساز تحولات آینده خواهد بود<span dir="LTR">.&nbsp;</span></span></p>
<p>
	&nbsp;</p>', '64296photojalase.jpg', 176, '1404/3/6', '2:55:05 PM', 1404, 'خرداد', 3, '6');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (64297, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'برگزاری دوره تخصصی "مدیریت آموزشی بر اساس استاندارد ISO 10015" در نیروگاه کرخه', '<p dir="RTL" style="text-align: justify;">
	<strong>در راستای ارتقای دانش تخصصی کارکنان صنعت آب و برق، دوره آموزشی &laquo;مدیریت آموزشی بر اساس استاندارد </strong><strong><span dir="LTR">ISO 10015</span></strong><strong>&raquo; با حضور جمعی از همکاران در محل سد و نیروگاه کرخه برگزار شد. این دوره که در تاریخ ۳۱ اردیبهشت ۱۴۰۴ برگزار گردید، با هدف توانمندسازی منابع انسانی و بهبود کیفیت فرآیندهای آموزشی طراحی شده بود.&nbsp; </strong></p>
<p>
	&nbsp;</p>
', '<p dir="RTL" style="text-align: justify;">
	<strong>در راستای ارتقای دانش تخصصی کارکنان صنعت آب و برق، دوره آموزشی &laquo;مدیریت آموزشی بر اساس استاندارد </strong><strong><span dir="LTR">ISO 10015</span></strong><strong>&raquo; با حضور جمعی از همکاران در محل سد و نیروگاه کرخه برگزار شد. این دوره که در تاریخ ۳۱ اردیبهشت ۱۴۰۴ برگزار گردید، با هدف توانمندسازی منابع انسانی و بهبود کیفیت فرآیندهای آموزشی طراحی شده بود.&nbsp; </strong></p>
<p dir="RTL" style="text-align: justify;">
	<strong>جلسه افتتاحیه با سخنرانی مهندس صالحی فر، مدیرعامل سد و نیروگاه کرخه، و دکتر هودگر، رئیس مجتمع عالی آموزشی صنعت آب و برق خوزستان، آغاز شد. سپس دکتر اباصلت خراسانی، دانشیار دانشگاه شهید بهشتی، به عنوان مدرس دوره، مباحث تخصصی را در قالب کارگاه&zwnj;های تعاملی ارائه داد.&nbsp;</strong></p>
<p dir="RTL" style="text-align: justify;">
	<span style="color:#ee82ee;"><strong>در این دوره، استاندارد </strong><strong><span dir="LTR">ISO 10015</span></strong><strong> به عنوان راهنمای کیفیت آموزش و مکمل </strong><strong><span dir="LTR">ISO 9001</span></strong><strong> معرفی شد. چهار مرحله اصلی این استاندارد شامل:&nbsp; </strong></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="color:#ee82ee;"><strong>۱. شناسایی نیازهای آموزشی</strong></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="color:#ee82ee;"><strong>۲. طراحی و برنامه&zwnj;ریزی آموزش</strong></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="color:#ee82ee;"><strong>۳. اجرای آموزش</strong></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="color:#ee82ee;"><strong>۴. ارزیابی نتایج آموزش</strong></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="color:#ee82ee;"><strong>به صورت عملی و با مثال&zwnj;های واقعی بررسی گردید.&nbsp;</strong></span></p>
<p dir="RTL" style="text-align: justify;">
	<strong>این دوره با بهره&zwnj;گیری از شیوه&zwnj;های نوین آموزشی مانند کار گروهی، پرسش&zwnj;وپاسخ و تحلیل موردی سازمان&zwnj;های موفق اجرا شد. شرکت&zwnj;کنندگان در قالب تیم&zwnj;های چندنفره به طراحی برنامه&zwnj;های آموزشی بر اساس استاندارد پرداختند که با استقبال چشمگیری همراه بود. و&nbsp;در پایان این دوره، از زحمات و همکاری&zwnj;های ارزشمند مدیران و کارشناسان آموزش با اهدای لوح تقدیر و هدایای یادبودی تقدیر به عمل آمد</strong></p>
<p>
	&nbsp;</p>
', '64297seminarr.jpg', 162, '1404/3/7', '12:31:25 PM', 1404, 'خرداد', 3, '7');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (64298, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'مرکز شهدای صنعت آب و برق  خوزستان برگزار می‌کند: رویداد استارتاپی آب هوشمند', '<p dir="RTL">
	فرصتی برای ایده&zwnj;پردازان و استارتاپ&zwnj;های حوزه آب و پساب<span dir="LTR">!</span></p>
', '<p dir="RTL">
	<span style="font-size:16px;"><strong>مرکز شهدای صنعت آب و برق&nbsp; خوزستان برگزار می&zwnj;کند<span dir="LTR">:</span></strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span style="color:#b22222;">رویداد استارتاپی آب هوشمند</span></strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong>فرصتی برای ایده&zwnj;پردازان و استارتاپ&zwnj;های حوزه آب و پساب<span dir="LTR">!</span></strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong>با محورهای تخصصی<span dir="LTR">:</span></strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span style="color:#ff0000;"><span dir="LTR">✅</span> پایش هوشمند کیفیت آب و پساب</span></strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span style="color:#ff0000;"><span dir="LTR">✅</span> تصفیه نوآورانه و بازیافت</span></strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span style="color:#ff0000;"><span dir="LTR">✅</span> پیش&zwnj;بینی و تشخیص آلودگی</span></strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span style="color:#ff0000;"><span dir="LTR">✅</span> سامانه&zwnj;های هشدار سریع منابع آب</span></strong></span></p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span dir="LTR">🎯</span> مزایا<span dir="LTR">:</span></strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span style="color:#008000;"><span dir="LTR">🎓</span> برگزاری کارگاه&zwnj;های منتورینگ</span></strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span style="color:#008000;"><span dir="LTR">🏆</span> جوایز نقدی و تقدیر از ایده&zwnj;های برتر</span></strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span style="color:#008000;"><span dir="LTR">🏢</span> فرصت استقرار تیم&zwnj;های برتر در مرکز رشد</span></strong></span></p>
<p dir="RTL">
	&nbsp;</p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span dir="LTR">📅</span> مهلت ثبت&zwnj;نام: تا ۲۰ خرداد</strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span dir="LTR">📆</span> تاریخ رویداد: ۲۷ خرداد ۱۴۰۴</strong></span></p>
<p dir="RTL">
	<span style="font-size:16px;"><strong><span dir="LTR">🔗</span> ثبت ایده :&nbsp;&nbsp;<span dir="LTR">&nbsp;kwpchc.ir/startup</span></strong></span></p>
<p>
	&nbsp;</p>
', '64298roydadadddddd.jpg', 2292, '1404/3/13', '2:27:27 AM', 1404, 'خرداد', 3, '13');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (64299, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'معرفی ۱۸ هسته فناور مرکز رشد شهدای صنعت آب و برق خوزستان برای دریافت حمایت ۳۰۰ میلیون تومانی', '<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">در پی برگزاری نشست مشترک بین مدیر مرکز رشد شهدای صنعت آب و برق خوزستان و ریاست سازمان بسیج علمی، پژوهشی و فناوری استان، ۱۸ هسته فناور فعال در این مرکز برای دریافت حمایت مالی بلاعوض تا سقف ۳۰۰ میلیون تومان معرفی شدند<span dir="LTR">. </span></span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">در پی برگزاری نشست مشترک بین مدیر مرکز رشد شهدای صنعت آب و برق خوزستان و ریاست سازمان بسیج علمی، پژوهشی و فناوری استان، ۱۸ هسته فناور فعال در این مرکز برای دریافت حمایت مالی بلاعوض تا سقف ۳۰۰ میلیون تومان معرفی شدند<span dir="LTR">.</span></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">بر اساس توافق&zwnj;های صورت&zwnj;گرفته، سازمان بسیج علمی خوزستان از توسعه همکاری&zwnj;ها با مرکز رشد استقبال کرده و حمایت از هسته&zwnj;های فناور را در اولویت قرار داده است. این حمایت&zwnj;ها شامل برگزاری رویدادهای تخصصی نظیر ریورس&zwnj;پیچ، همایش&zwnj;های فناورانه و نشست&zwnj;های<span dir="LTR"> B2B </span>می&zwnj;شود. همچنین، این سازمان متعهد شده است تا زیرساخت&zwnj;های لازم و حمایت&zwnj;های مادی و معنوی را برای پیشبرد اهداف این هسته&zwnj;ها فراهم کند<span dir="LTR">. </span></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">هسته&zwnj;های فناور واجد شرایط که مراحل اولیه رشد را در مرکز رشد طی کرده&zwnj;اند، می&zwnj;توانند از این حمایت&zwnj;ها بهره&zwnj;مند شوند. در صورت ارتقاء به &laquo;واحد فناور&raquo;، امکان دریافت وام&zwnj;های بدون بهره از طریق مؤسسه پیشگامان نیز برای آنها فراهم خواهد بود. نکته حائز اهمیت این است که تمامی این حمایت&zwnj;ها بدون هرگونه مشارکت مالکیتی در هسته&zwnj;ها انجام می&zwnj;شود تا استقلال و مالکیت فکری آنها حفظ شود<span dir="LTR">.</span></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">این ۱۸ هسته فناور در حوزه&zwnj;های مختلفی از جمله فناوری&zwnj;های نوین آب، انرژی&zwnj;های تجدیدپذیر، هوشمندسازی و ایمنی صنعتی فعالیت دارند. بیش از ۹۰ درصد اعضای این تیم&zwnj;ها دارای مدارک تحصیلات تکمیلی بوده و برخی نیز دارای مدارک دکتری و پسادکتری هستند که نشان&zwnj;دهنده ظرفیت علمی و فناورانه بالای آنهاست<span dir="LTR">.</span></span></p>
<p>
	&nbsp;</p>', '64299mojtamaa.jpg', 2342, '1404/3/17', '12:41:19 PM', 1404, 'خرداد', 3, '17');
INSERT INTO kw_news (id, group_id, sender_id, subject, summary, content, image_url, hits, news_date, news_time, year, month, num_month, day) VALUES (64300, 1, 'fbd7d553-8a7c-4de4-b9b3-fa012cc9fbcf', 'کرسی آزاداندیشی با موضوع "هوش مصنوعی؛ تهدید یا فرصت" در مرکز علمی کاربردی صنعت آب و برق خوزستان برگزار شد', '<p dir="RTL">
	مرکز علمی کاربردی صنعت آب و برق خوزستان میزبان کرسی آزاداندیشی با موضوع &quot;هوش مصنوعی؛ تهدید یا فرصت؟&quot; بود که با حضور ، دانشجویان ، کارکنان و علاقه مندان به این حوزه برگزار شد<span dir="LTR">. </span></p>
<p>
	&nbsp;</p>', '<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">مرکز علمی کاربردی صنعت آب و برق خوزستان میزبان کرسی آزاداندیشی با موضوع &quot;هوش مصنوعی؛ تهدید یا فرصت؟&quot; بود که با حضور ، دانشجویان ، کارکنان و علاقه مندان به این حوزه برگزار شد<span dir="LTR">.</span></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">در این نشست تخصصی، دکتر مهدی هودگر به عنوان مدرس، به بررسی ابعاد مختلف هوش مصنوعی، چالشها و فرصتهای پیشروی این فناوری پرداخت. وی در سخنان خود به تأثیرات هوش مصنوعی بر مشاغل، اخلاق دیجیتال، حریم خصوصی و همچنین کاربردهای نوین آن در صنایع مختلف، از جمله صنعت آب و برق اشاره کرد<span dir="LTR">.</span></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">دکتر هودگر با اشاره به رشد سریع فناوریهای هوش مصنوعی، تأکید کرد: &quot;هوش مصنوعی یک ابزار قدرتمند است که میتواند همزمان هم فرصتهای بی نظیری خلق کند و هم چالشهای جدی به همراه داشته باشد. نحوه مواجهه ما با این فناوری تعیین کننده آینده آن در اقتصاد، آموزش و جامعه خواهد بود<span dir="LTR">.&quot;</span></span></p>
<p dir="RTL" style="text-align: justify;">
	<span style="font-size:14px;">شرکت کنندگان در این مرکز نیز به بیان دیدگاهها و پرسشهای خود در مورد آینده هوش مصنوعی، نقش آن در بهینه&zwnj;سازی مصرف انرژی و چگونگی مقابله با تهدیدات امنیتی ناشی از آن پرداختند<span dir="LTR">.</span></span></p>
<p>
	&nbsp;</p>', '64300picclas.jpg', 66, '1404/3/17', '12:43:42 PM', 1404, 'خرداد', 3, '17');

COMMIT;
