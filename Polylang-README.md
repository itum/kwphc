# راهنمای استفاده از Polylang با افزونه مدیریت دانشگاه

این افزونه اکنون به طور کامل با **Polylang Pro** سازگار است و امکان ترجمه تمام ویجت‌های المنتور را فراهم می‌کند.

## مراحل راه‌اندازی

### 1. نصب و فعال‌سازی Polylang Pro
ابتدا افزونه **Polylang Pro** را نصب و فعال کنید.

### 2. تنظیم زبان‌ها
1. به **Languages > Languages** بروید
2. زبان‌های مورد نظر خود را اضافه کنید (فارسی، انگلیسی، عربی و غیره)
3. زبان پیش‌فرض را انتخاب کنید

### 3. ترجمه رشته‌های ویجت‌ها
1. به **Languages > String translations** بروید
2. در قسمت **Group**، گزینه **University Management** را انتخاب کنید
3. تمام رشته‌های ویجت‌ها در این بخش نمایش داده خواهند شد
4. برای هر رشته، ترجمه مورد نظر خود را در زبان‌های مختلف وارد کنید

## ویژگی‌های پشتیبانی شده

### ویجت‌های قابل ترجمه:
- **تقویم دانشگاه**: تمام برچسب‌ها، پیام‌ها و گزینه‌ها
- **زمان‌بندی کلاس‌ها**: نام‌های فیلدها و پیام‌های نمایشی
- **مدیریت ویدیوها**: برچسب‌ها، دسته‌بندی‌ها و پیام‌ها
- **اسلایدر کارگاه و سمینار**: تمام عناصر رابط کاربری
- **آزمون استخدامی**: برچسب‌ها و وضعیت‌ها
- **آزمون‌های استخدامی**: نمایش‌های مختلف و برچسب‌ها

### رشته‌های ثبت شده شامل:
- برچسب‌های فیلدها در پنل تنظیمات ویجت‌ها
- پیام‌های خطا و اطلاع‌رسانی
- گزینه‌های انتخابی (Dropdown options)
- متن‌های نمایشی در فرانت‌اند
- عناوین ویجت‌ها
- دکمه‌های عملیات (مثل "شروع یادگیری")
- برچسب‌های اطلاعات (مثل "زمان برگزاری:" و "مدرس:")
- اسامی اساتید و مدرسین نمونه
- عناوین دوره‌ها و کارگاه‌های نمونه
- تاریخ‌ها و زمان‌های نمونه

## نکات مهم

### تبدیل خودکار
- تمام رشته‌های متنی به صورت خودکار در زمان بارگذاری افزونه با Polylang ثبت می‌شوند
- نیازی به تنظیم دستی نیست

### fallback
- اگر ترجمه‌ای برای زبان فعلی موجود نباشد، متن فارسی اصلی نمایش داده می‌شود
- این امر از خالی بودن محتوا جلوگیری می‌کند

### سازگاری
- افزونه با هر دو نسخه رایگان و Pro افزونه Polylang سازگار است
- در صورت غیرفعال بودن Polylang، افزونه بدون مشکل کار می‌کند

## مثال کاربردی

### مرحله 1: اضافه کردن زبان انگلیسی
```
Languages > Languages > Add New Language
- Language: English
- Language code: en  
- Flag: United States
```

### مرحله 2: ترجمه رشته‌های ویجت‌ها
```
Languages > String translations > Group: University Management

نمونه‌هایی از رشته‌های قابل ترجمه:

// ویجت تقویم
فارسی: "تقویم دانشگاه" → انگلیسی: "University Calendar"
فارسی: "منبع رویدادها" → انگلیسی: "Event Source"
فارسی: "تنظیمات عمومی" → انگلیسی: "General Settings"

// ویجت سمینار و کارگاه
فارسی: "اسلایدر کارگاه و سمینار" → انگلیسی: "Seminar & Workshop Slider"
فارسی: "زمان برگزاری:" → انگلیسی: "Event Time:"
فارسی: "مدرس:" → انگلیسی: "Instructor:"
فارسی: "شروع یادگیری" → انگلیسی: "Start Learning"

// اسامی اساتید و عناوین دوره‌ها
فارسی: "مهدی بیگدلی" → انگلیسی: "Mehdi Bigdeli"
فارسی: "فرانت‌اند" → انگلیسی: "Frontend"
فارسی: "Node.js" → انگلیسی: "Node.js" (یا همان)
```

### مرحله 3: تست در فرانت‌اند
- تغییر زبان سایت را امتحان کنید
- ویجت‌ها باید با زبان انتخابی نمایش داده شوند

## رفع مشکل

### ویجت‌ها ترجمه نمی‌شوند؟
1. مطمئن شوید Polylang Pro نصب و فعال است
2. بررسی کنید که رشته‌ها در **String translations** موجود باشند
3. cache سایت و مرورگر را پاک کنید

### رشته‌ها در String translations نمایش داده نمی‌شوند؟
1. یکبار صفحه‌ای که ویجت دارد را بازدید کنید
2. به **String translations** برگردید
3. اگر هنوز نمایش داده نشد، افزونه را غیرفعال/فعال کنید

### صفحه خراب شده بعد از نصب؟
اگر بعد از فعال کردن افزونه صفحه خراب شد:

1. **غیرفعال کردن افزونه از طریق FTP:**
   - به پوشه `/wp-content/plugins/` بروید
   - نام پوشه افزونه را تغییر دهید (مثلاً به `university-management-disabled`)

2. **بررسی لاگ‌های خطا:**
   - فایل `wp-config.php` را ویرایش کنید
   - `define('WP_DEBUG', true);` را اضافه کنید
   - خطاها در `/wp-content/debug.log` ثبت می‌شوند

3. **مراحل بازگردانی:**
   - Polylang را نصب کنید
   - سپس افزونه را مجدداً فعال کنید

### مشکل تداخل با سایر افزونه‌ها
اگر با سایر افزونه‌ها تداخل دارد:
1. سایر افزونه‌ها را موقتاً غیرفعال کنید
2. یکی یکی فعال کرده و مشکل را شناسایی کنید
3. با پشتیبانی تماس بگیرید

## تغییرات نسبت به WPML

- فایل `wpml-config.xml` حذف شده است
- رشته‌ها اکنون با `pll_register_string` ثبت می‌شوند
- تابع کمکی `um_translate()` برای ترجمه استفاده می‌شود
- سازگاری کامل با Polylang Pro

## پشتیبانی

برای سوالات یا مشکلات، با تیم توسعه تماس بگیرید.

---
**نسخه**: 1.4.2
**سازگار با**: Polylang Pro 3.0+
**تست شده با**: WordPress 6.0+ 