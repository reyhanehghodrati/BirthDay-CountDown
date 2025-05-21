-- اضافه کردن ستون وضعیت ارسال پیامک

ALTER TABLE `birthdays` ADD `sms_status` INT NOT NULL AFTER `about`;
ALTER TABLE `birthdays` ADD `sms_send_at` TIMESTAMP NULL DEFAULT NULL AFTER `sms_status`;


DELIMITER $$

CREATE TRIGGER `trg_sms_status_changed` BEFORE UPDATE ON `birthdays`
    FOR EACH ROW BEGIN
    If NEW.sms_status <> OLD.sms_status
THEN
    SET NEW.sms_send_at = NOW();
END IF;
END
DELIMITER ;



-- جدول شماره ادمین و روز تا ارسال

CREATE TABLE settings( id INT AUTO_INCREMENT PRIMARY KEY, admin_phone varchar(20), notif_day int DEFAULT 5 );
INSERT INTO `settings` (`id`, `admin_phone`, `notif_day`) VALUES (NULL, '09109253995', '5');