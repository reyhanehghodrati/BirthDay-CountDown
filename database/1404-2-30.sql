-- اضافه کردن ستون وضعیت ارسال پیامک

ALTER TABLE `birthdays` ADD `sms_status` INT NOT NULL AFTER `about`;
ALTER TABLE `birthdays` ADD `sms_send_at` TIMESTAMP NULL DEFAULT NULL AFTER `sms_status`;


DELIMITER $$

CREATE TRIGGER trg_sms_status_changed
    BEFORE UPDATE ON birthdays
    FOR EACH ROW
BEGIN
    SET NEW.sms_send_at = NOW();
END $$

DELIMITER ;
