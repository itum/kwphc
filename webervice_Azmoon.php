<?php
// تعریف ثابت برای اجازه اجرای اسکریپت
define('KWPHC_WEBSERVICE_AUTHORIZED', true);

// شامل کردن فایل اصلی وب سرویس
require_once 'kw_dsk_webservice_Azmoon.php';

// اجرای وب سرویس
$service = new KwDskWebServiceAzmoon();
$service->handleRequest();
?> 