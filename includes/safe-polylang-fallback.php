<?php
/**
 * فایل fallback امن برای Polylang
 * 
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

/**
 * تابع fallback امن برای ترجمه
 */
if (!function_exists('um_translate')) {
    function um_translate($string, $fallback = null) {
        // اگر Polylang موجود است
        if (function_exists('pll__')) {
            $translation = pll__($string);
            if ($translation && $translation !== $string) {
                return $translation;
            }
        }
        
        // اگر fallback موجود است، آن را برگردان
        if ($fallback) {
            return $fallback;
        }
        
        // در غیر این صورت، رشته اصلی را برگردان
        return $string;
    }
}

/**
 * تابع کمکی برای بررسی وجود Polylang
 */
if (!function_exists('um_is_polylang_active')) {
    function um_is_polylang_active() {
        return function_exists('pll__') && function_exists('pll_register_string');
    }
}

/**
 * تابع کمکی برای لاگ
 */
if (!function_exists('um_log_debug')) {
    function um_log_debug($message) {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('UM Plugin Debug: ' . $message);
        }
    }
} 