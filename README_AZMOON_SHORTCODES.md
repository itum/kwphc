# شورت‌کدهای داینامیک آزمون‌های استخدامی

این فایل شامل تمام شورت‌کدهای داینامیک برای نمایش اطلاعات آزمون‌های استخدامی است.

## شورت‌کدهای موجود

### 1. شورت‌کد عنوان آزمون
```php
[um_azmoon_title id="1" default="آزمون استخدامی"]
```
**پارامترها:**
- `id`: شناسه آزمون (اختیاری)
- `default`: متن پیش‌فرض در صورت عدم یافتن آزمون

### 2. شورت‌کد تاریخ آزمون
```php
[um_azmoon_date id="1" default="۱۴۰۳/۰۱/۰۱"]
```
**پارامترها:**
- `id`: شناسه آزمون (اختیاری)
- `default`: تاریخ پیش‌فرض

### 3. شورت‌کد دپارتمان آزمون
```php
[um_azmoon_department id="1" default="عمومی"]
```
**پارامترها:**
- `id`: شناسه آزمون (اختیاری)
- `default`: دپارتمان پیش‌فرض

### 4. شورت‌کد وضعیت آزمون
```php
[um_azmoon_status id="1" default="فعال"]
```
**پارامترها:**
- `id`: شناسه آزمون (اختیاری)
- `default`: وضعیت پیش‌فرض

**وضعیت‌های موجود:**
- `active`: فعال
- `inactive`: غیرفعال
- `completed`: تکمیل شده

### 5. شورت‌کد لینک آزمون
```php
[um_azmoon_link id="1" default="#"]
```
**پارامترها:**
- `id`: شناسه آزمون (اختیاری)
- `default`: لینک پیش‌فرض

### 6. شورت‌کد تصویر آزمون
```php
[um_azmoon_image id="1" default="URL_تصویر_پیش‌فرض"]
```
**پارامترها:**
- `id`: شناسه آزمون (اختیاری)
- `default`: URL تصویر پیش‌فرض

### 7. شورت‌کد توضیحات آزمون
```php
[um_azmoon_description id="1" default="توضیحات آزمون"]
```
**پارامترها:**
- `id`: شناسه آزمون (اختیاری)
- `default`: توضیحات پیش‌فرض

### 8. شورت‌کد لیست آزمون‌ها
```php
[um_azmoon_list limit="6" status="active" department="" template="grid"]
```
**پارامترها:**
- `limit`: تعداد آزمون‌ها برای نمایش (پیش‌فرض: 6)
- `status`: فیلتر بر اساس وضعیت (پیش‌فرض: active)
- `department`: فیلتر بر اساس دپارتمان (اختیاری)
- `template`: قالب نمایش (grid یا list)

## نمونه‌های استفاده

### نمایش اطلاعات یک آزمون خاص
```php
<div class="azmoon-details">
    <h2>[um_azmoon_title id="1"]</h2>
    <p>تاریخ: [um_azmoon_date id="1"]</p>
    <p>دپارتمان: [um_azmoon_department id="1"]</p>
    <p>وضعیت: [um_azmoon_status id="1"]</p>
    <a href="[um_azmoon_link id="1"]">مشاهده جزئیات</a>
</div>
```

### نمایش لیست آزمون‌های فعال
```php
[um_azmoon_list limit="10" status="active" template="grid"]
```

### نمایش لیست آزمون‌های یک دپارتمان خاص
```php
[um_azmoon_list limit="5" department="فنی و مهندسی" template="list"]
```

### نمایش آزمون‌های تکمیل شده
```php
[um_azmoon_list limit="8" status="completed" template="grid"]
```

## قالب‌های نمایش

### قالب Grid (پیش‌فرض)
نمایش آزمون‌ها در قالب کارت‌های شبکه‌ای

### قالب List
نمایش آزمون‌ها در قالب لیست عمودی با جزئیات بیشتر

## استایل‌های CSS

تمام شورت‌کدها از استایل‌های موجود در فایل `assets/css/azmoon-widget.css` استفاده می‌کنند.

## نکات مهم

1. **احراز هویت**: تمام شورت‌کدها نیاز به احراز هویت با API دارند
2. **کش**: داده‌ها برای بهبود عملکرد کش می‌شوند
3. **خطا**: در صورت عدم دسترسی به API، متن پیش‌فرض نمایش داده می‌شود
4. **امنیت**: تمام خروجی‌ها با `esc_html` و `esc_url` پاکسازی می‌شوند

## مثال کامل

```php
<div class="azmoon-section">
    <h1>آزمون‌های استخدامی</h1>
    
    <!-- نمایش آزمون خاص -->
    <div class="featured-azmoon">
        <h2>[um_azmoon_title id="1" default="آزمون ویژه"]</h2>
        <img src="[um_azmoon_image id="1"]" alt="تصویر آزمون">
        <p>تاریخ: [um_azmoon_date id="1"]</p>
        <p>وضعیت: [um_azmoon_status id="1"]</p>
        <a href="[um_azmoon_link id="1"]" class="btn">مشاهده جزئیات</a>
    </div>
    
    <!-- نمایش لیست آزمون‌ها -->
    <div class="azmoon-list">
        [um_azmoon_list limit="6" status="active" template="grid"]
    </div>
    
    <!-- نمایش آزمون‌های تکمیل شده -->
    <div class="completed-azmoons">
        <h3>آزمون‌های تکمیل شده</h3>
        [um_azmoon_list limit="4" status="completed" template="list"]
    </div>
</div>
```

## پشتیبانی

برای سوالات و مشکلات، لطفاً با تیم توسعه تماس بگیرید. 