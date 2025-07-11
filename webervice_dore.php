<?php
// تعریف ثابت برای اجازه اجرای اسکریپت
define('KWPHC_WEBSERVICE_AUTHORIZED', true);

// شامل کردن فایل اصلی وب سرویس
require_once 'kw_dsk_webservice.php';

// اجرای وب سرویس
$service = new KwDskWebService();
$service->handleRequest(); 