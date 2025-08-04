# راهنمای رفع مشکلات - مدیریت دانشگاه آب و برق خوزستان

## مشکلات شناسایی شده و راه‌حل‌ها

### 1. خطای 404 برای فایل‌های CSS و JS

**مشکل:**
```
frontend.css:1 Failed to load resource: the server responded with a status of 404 ()
frontend.js:1 Failed to load resource: the server responded with a status of 404 ()
```

**راه‌حل:**
- فایل‌های `frontend.css` و `frontend.js` در پوشه `assets` ایجاد شده‌اند
- این فایل‌ها شامل استایل‌ها و اسکریپت‌های عمومی برای فرانت‌اند هستند

### 2. خطای JavaScript در class-timer-widget

**مشکل:**
```
class-timer-widget.js?ver=1.4.3:354 Uncaught TypeError: Cannot set properties of null (setting 'innerHTML')
```

**راه‌حل:**
- مشکل در خط 354 فایل `class-timer-widget.js` رفع شده است
- کد اصلاح شده برای بررسی وجود عنصر قبل از تنظیم innerHTML

### 3. مشکل نمایش ویدیوها

**مشکل:**
- پیام "ویدیویی برای نمایش وجود ندارد" نمایش داده می‌شود

**راه‌حل:**
- فایل `create-sample-videos.php` ایجاد شده است
- این فایل ویدیوهای نمونه ایجاد می‌کند
- برای اجرا: فایل را در مرورگر باز کنید یا از طریق wp-admin اجرا کنید

### 4. مشکل loading overlay

**مشکل:**
- استایل‌های loading overlay وجود نداشت

**راه‌حل:**
- استایل‌های loading overlay به فایل `frontend.css` اضافه شده است

## مراحل رفع مشکلات

### مرحله 1: ایجاد ویدیوهای نمونه
```bash
# فایل create-sample-videos.php را در مرورگر باز کنید
# یا از طریق wp-admin اجرا کنید
```

### مرحله 2: بررسی فایل‌های ایجاد شده
- `assets/css/frontend.css` - استایل‌های عمومی
- `assets/js/frontend.js` - اسکریپت‌های عمومی
- `create-sample-videos.php` - ایجاد ویدیوهای نمونه

### مرحله 3: پاک کردن کش
- کش مرورگر را پاک کنید
- کش وردپرس را پاک کنید (اگر از پلاگین کش استفاده می‌کنید)

### مرحله 4: بررسی مجدد
- صفحه را refresh کنید
- console مرورگر را بررسی کنید تا خطاها برطرف شده باشند

## فایل‌های اصلاح شده

1. **assets/css/frontend.css** - فایل CSS عمومی جدید
2. **assets/js/frontend.js** - فایل JavaScript عمومی جدید
3. **assets/js/class-timer-widget.js** - رفع خطای null reference
4. **create-sample-videos.php** - ایجاد ویدیوهای نمونه

## نکات مهم

- فایل `create-sample-videos.php` فقط یک بار باید اجرا شود
- پس از ایجاد ویدیوهای نمونه، فایل را حذف کنید
- اگر ویدیوهای واقعی دارید، از آن‌ها استفاده کنید
- برای اضافه کردن ویدیوهای جدید، از بخش مدیریت وردپرس استفاده کنید

## بررسی عملکرد

پس از اعمال تغییرات، موارد زیر را بررسی کنید:

1. ✅ خطاهای 404 برای frontend.css و frontend.js برطرف شده
2. ✅ خطای JavaScript در class-timer-widget برطرف شده
3. ✅ ویدیوها نمایش داده می‌شوند
4. ✅ loading overlay به درستی کار می‌کند

## پشتیبانی

در صورت بروز مشکل جدید، لطفاً console مرورگر را بررسی کرده و خطاها را گزارش دهید. 