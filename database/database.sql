-- جدول تاریخ تولد کارمندان

CREATE TABLE birthdays  (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(255) NOT NULL,
                            mobile VARCHAR(255) NOT NULL,
                            birthday TEXT,
                            about TEXt
);


-- جدول ادمین
CREATE TABLE `site_users` (
                              `id` int(11) NOT NULL,
                              `username` varchar(255) NOT NULL,
                              `password` varchar(255) NOT NULL,
                              `role` enum('admin','user') NOT NULL DEFAULT 'user',
                              `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `site_users`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `site_users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

INSERT INTO `site_users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
    (1, 'admin', 'admin123', 'admin', '2025-02-25 06:33:05');


