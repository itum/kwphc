/**
 * اسکریپت ویجت آزمون استخدامی
 */

(function($) {
    'use strict';

    /**
     * کلاس اصلی ویجت آزمون
     */
    class UMAzmoonWidget {
        constructor(element) {
            this.element = element;
            this.$element = $(element);
            this.settings = this.getSettings();
            this.init();
        }

        /**
         * دریافت تنظیمات از data attributes
         */
        getSettings() {
            return {
                source: this.$element.data('source') || 'manual',
                postsPerPage: this.$element.data('posts-per-page') || 6,
                autoRefresh: this.$element.data('auto-refresh') || false,
                refreshInterval: this.$element.data('refresh-interval') || 300000, // 5 minutes
            };
        }

        /**
         * راه‌اندازی ویجت
         */
        init() {
            this.bindEvents();
            
            if (this.settings.autoRefresh) {
                this.startAutoRefresh();
            }
        }

        /**
         * اتصال رویدادها
         */
        bindEvents() {
            // رویداد کلیک روی کارت‌ها
            this.$element.on('click', '.um-azmoon-card', function(e) {
                if (!$(e.target).closest('.um-azmoon-button').length) {
                    const link = $(this).find('.um-azmoon-button').attr('href');
                    if (link && link !== '#') {
                        window.open(link, '_blank');
                    }
                }
            });

            // رویداد hover برای انیمیشن
            this.$element.on('mouseenter', '.um-azmoon-card', function() {
                $(this).addClass('hover');
            }).on('mouseleave', '.um-azmoon-card', function() {
                $(this).removeClass('hover');
            });

            // رویداد کلیک روی دکمه‌ها
            this.$element.on('click', '.um-azmoon-button', function(e) {
                e.stopPropagation();
                const href = $(this).attr('href');
                if (href && href !== '#') {
                    // اضافه کردن انیمیشن کلیک
                    $(this).addClass('clicked');
                    setTimeout(() => {
                        $(this).removeClass('clicked');
                    }, 200);
                }
            });
        }

        /**
         * شروع به‌روزرسانی خودکار
         */
        startAutoRefresh() {
            setInterval(() => {
                this.refreshData();
            }, this.settings.refreshInterval);
        }

        /**
         * به‌روزرسانی داده‌ها
         */
        refreshData() {
            if (this.settings.source === 'auto') {
                this.loadAzmoonsFromAPI();
            }
        }

        /**
         * بارگذاری آزمون‌ها از API
         */
        loadAzmoonsFromAPI() {
            this.showLoading();

            $.ajax({
                url: um_azmoon_vars.ajax_url,
                type: 'POST',
                data: {
                    action: 'um_get_azmoons_widget',
                    nonce: um_azmoon_vars.nonce,
                    limit: this.settings.postsPerPage
                },
                success: (response) => {
                    this.hideLoading();
                    
                    if (response.success) {
                        this.updateWidget(response.data);
                    } else {
                        this.showError(response.data.message || 'خطا در بارگذاری آزمون‌ها');
                    }
                },
                error: () => {
                    this.hideLoading();
                    this.showError('خطا در اتصال به سرور');
                }
            });
        }

        /**
         * نمایش حالت بارگذاری
         */
        showLoading() {
            this.$element.addClass('loading');
        }

        /**
         * مخفی کردن حالت بارگذاری
         */
        hideLoading() {
            this.$element.removeClass('loading');
        }

        /**
         * نمایش خطا
         */
        showError(message) {
            const errorHtml = `
                <div class="um-azmoon-error">
                    <i class="eicon-alert"></i>
                    <span>${message}</span>
                </div>
            `;
            
            this.$element.find('.um-azmoon-grid').html(errorHtml);
        }

        /**
         * به‌روزرسانی ویجت با داده‌های جدید
         */
        updateWidget(azmoons) {
            if (!azmoons || azmoons.length === 0) {
                this.$element.find('.um-azmoon-grid').html(
                    '<div class="um-azmoon-empty">هیچ آزمونی یافت نشد.</div>'
                );
                return;
            }

            let html = '';
            azmoons.forEach(azmoon => {
                html += this.generateAzmoonCard(azmoon);
            });

            this.$element.find('.um-azmoon-grid').html(html);
        }

        /**
         * تولید HTML کارت آزمون
         */
        generateAzmoonCard(azmoon) {
            const statusText = this.getStatusText(azmoon.status);
            const statusClass = `um-status-${azmoon.status}`;
            
            return `
                <div class="um-azmoon-card">
                    <div class="um-azmoon-image">
                        <img src="${azmoon.image}" alt="${azmoon.title}">
                        <div class="um-azmoon-status ${statusClass}">
                            ${statusText}
                        </div>
                    </div>
                    
                    <div class="um-azmoon-content">
                        <h3 class="um-azmoon-card-title">${azmoon.title}</h3>
                        <div class="um-azmoon-meta">
                            <span class="um-azmoon-date">
                                <i class="eicon-calendar"></i>
                                ${azmoon.date}
                            </span>
                            <span class="um-azmoon-department">
                                <i class="eicon-folder"></i>
                                ${azmoon.department}
                            </span>
                        </div>
                        
                        <div class="um-azmoon-actions">
                            <a href="${azmoon.link}" class="um-azmoon-button" target="_blank" rel="nofollow">
                                ${azmoon.button_text}
                            </a>
                        </div>
                    </div>
                </div>
            `;
        }

        /**
         * دریافت متن وضعیت
         */
        getStatusText(status) {
            const statusMap = {
                'active': 'فعال',
                'inactive': 'غیرفعال',
                'completed': 'تکمیل شده'
            };
            return statusMap[status] || 'نامشخص';
        }
    }

    /**
     * راه‌اندازی ویجت‌ها
     */
    $(document).ready(function() {
        $('.um-azmoon-widget').each(function() {
            new UMAzmoonWidget(this);
        });
    });

    /**
     * راه‌اندازی مجدد ویجت‌ها برای المنتور
     */
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/um_azmoon.default', function($element) {
            new UMAzmoonWidget($element[0]);
        });
    });

})(jQuery); 