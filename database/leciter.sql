-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2017_11_06_173142_create_posts_table',	1),
(2,	'2017_11_06_173143_create_posts_table',	2),
(3,	'2017_11_06_173144_create_posts_table',	3),
(4,	'2017_11_06_173145_create_posts_table',	4);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `posts_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `posts` (`id`, `name`, `header`, `article`, `picture`, `created_at`, `updated_at`) VALUES
(1,	'Boston Dynamics',	'Робот Boston Dynamics сделал бэкфлип',	'<p>Недавно в Сеть попало видео, на котором запечатлен робот Atlas, делающий бэкфлип. </p><p>Пользователи даже не поверили в высокий уровень координации робота, помня нелепые падения прошлых образцов. Однако похоже в компании учли неудачи и в этот раз все сделали отменно.</p><p>Ранее Atlas продемонстрировал способности передвигаться на двух \"ногах\" по пересеченной местности, а также использовать \"руки\" для переноса груза или преодоления вертикальных препятствий. Разработка робота ведется с 2013 года.</p>',	'atlas.jpg',	'2018-02-13 00:52:51',	'2018-02-12 22:52:51'),
(2,	'milliDelta',	'milliDelta. Этот крошечный робот двигается пугающе быстро',	'<p>После того, как небезызвестный Илон Маск в прошлого году увидел человекоподобного робота Atlas компании Boston Dynamics, делающего заднее сальто, предприниматель снова заговорил об опасности и необходимости регулирования ИИ. Еще Маск «пошутил» (или нет?), что этот робот «научится перемещаться столь быстро, что рассмотреть его движения можно будет только под стробоскопом». Что же, Boston Dynamics пока еще не сделали из «Атласа» Флэша, но исследователям Гарвардского университета удалось преуспеть в этом направлении.</p><p>Созданный ими робот является самым маленьким, самым быстрым и самым точным в своем классе. Он называется milliDelta и может двигаться быстро, очень быстро. За секунду этот робот может совершать до 75 движений. Если попробовать зафиксировать эти движения на камеру, то в итоге ничего кроме размытого пятна не выйдет.</p>',	'millidelta.jpg',	'2018-02-12 21:33:08',	'2018-02-12 21:33:08'),
(3,	'Ford',	'Ford запатентовал беспилотный полицейский автомобиль',	'<p>Пока остальные автопроизводители занимаются разработкой беспилотных автомобилей широкого назначения, американский Ford решил копнуть глубже и запатентовал автономный… полицейский автомобиль. Такое средство передвижения сможет работать как в паре с человеком-полицейским, так и самостоятельно – наблюдая за порядком на дорогах и преследуя нарушителей.</p><p>Для определения нарушителей такой беспилотник может использовать собственные камеры и радары или же подключаться к сети установленных на магистралях камер. Заметив нарушителя, умный полицейский автомобиль отправит ему соответствующее уведомление, а если он не остановится по требованию, то робот-полицейский сможет даже удаленно принудительно остановить его у края обочины (естественно, для этого оба автомобиля должны быть оснащены соответствующими интерфейсами и исполнительными устройствами).</p>',	'ford.jpg',	NULL,	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `users_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `address`, `city`, `country`, `email`, `password`) VALUES
(1,	'Александр',	'Иванов',	'ул. Бесконечная, 10123/2',	'Кривой Рог',	'Украина',	'alex.ivanov@gmail.com',	'QD7lQQUSU4'),
(2,	'Alex',	'Freeman',	'121 5th Ave',	'New York',	'USA',	'alexfreeman@gmail.com',	'YPJvDYbzgo'),
(3,	'Tangree',	'Alosh',	'G 50/1, Maharashtra',	'Mumbai',	'India',	'tangree@gmail.com',	'yahMz962Ew'),
(4,	'Алексей',	'Скворцов',	'ул. Ближняя, 11',	'Гомель',	'Беларусь',	'skvorcov@gmail.com',	'ZZYWVq9JYK'),
(5,	'Алина',	'Дубовая',	'ул. Уклонная, 23',	'Челябинск',	'Россия',	'alina82@gmail.com',	'U7OikVXW0x'),
(6,	'Kurt',	'Fritz',	'Friedrich Strasse 21',	'Berlin',	'Germany',	'kurtf@yahoo.com',	'iJZzx80ilq'),
(7,	'John',	'Doe',	'5 Av. 11',	'New York',	'USA',	'john@yahoo.com',	'jH4n9HwNpU');

-- 2018-02-13 04:42:43
