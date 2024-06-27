CREATE TABLE `User` (
  `user_id` int PRIMARY KEY,
  `username` varchar(255),
  `password` varchar(255),
  `role_id` int
);

CREATE TABLE `Role` (
  `role_id` int PRIMARY KEY,
  `role_name` varchar(255)
);

CREATE TABLE `Division` (
  `division_id` int PRIMARY KEY,
  `kepala_divisi_id` int,
  `user_id` int COMMENT 'User_id 1 adalah Ketua Divisi, user_id 2-6 adalah anggota divisi yang sama'
);

CREATE TABLE `Work` (
  `work_id` int PRIMARY KEY,
  `user_id` int,
  `division_id` int,
  `date` date,
  `activity` varchar(255),
  `status` varchar(255)
);

CREATE TABLE `Approval` (
  `approval_id` int PRIMARY KEY,
  `work_id` int,
  `approved_by` int,
  `date_approved` date
);

ALTER TABLE `User` ADD FOREIGN KEY (`role_id`) REFERENCES `Role` (`role_id`);

ALTER TABLE `Work` ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`);

ALTER TABLE `Work` ADD FOREIGN KEY (`division_id`) REFERENCES `Division` (`division_id`);

ALTER TABLE `Approval` ADD FOREIGN KEY (`work_id`) REFERENCES `Work` (`work_id`);

ALTER TABLE `Approval` ADD FOREIGN KEY (`approved_by`) REFERENCES `User` (`user_id`);
