-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Sty 2023, 19:59
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `ticket_id`, `message`, `sender_id`) VALUES
(1, 1, 'I am having trouble uploading my video. It keeps giving me an error message.', 2),
(2, 1, 'Can you please provide more details about the error message and the steps you are taking to upload the video?', 1),
(3, 1, 'The error message says \"file format not supported\" and I am trying to upload a .mp4 file.', 2),
(4, 1, 'We apologize for the inconvenience. Our platform currently only supports .avi and .mov file formats. We will work on adding support for .mp4 files in the future.', 1),
(5, 2, 'I am unable to access my account. It keeps giving me an error message.', 3),
(6, 2, 'Can you please provide more details about the error message and the steps you are taking to access your account?', 1),
(7, 2, 'The error message says \"incorrect login information\" and I am sure I am using the correct email and password.', 3),
(8, 2, 'We apologize for the inconvenience. It seems that your account may have been compromised. Please reset your password and contact us if you continue to have issues.', 1),
(9, 3, 'I am requesting a password reset for my account.', 3),
(10, 3, 'We have received your request. A password reset link has been sent to your email. Please follow the instructions in the email to reset your password.', 1),
(11, 5, 'I am having trouble streaming videos on your platform. It keeps buffering and the quality is poor.', 2),
(12, 5, 'Can you please provide more details about the specific videos you are trying to stream and the device you are using?', 1),
(13, 6, 'I have a suggestion for a new feature on your platform. It would be great if you could add a search function for videos.', 3),
(14, 6, 'Thank you for your suggestion. We will definitely consider it for future updates. Is there anything else you would like to share?', 4),
(15, 9, 'I made a payment but it was not processed. Can you please look into this issue?', 2),
(16, 9, 'We apologize for the inconvenience. We have identified the issue and processed your payment. Please let us know if you have any further issues.', 1),
(17, 10, 'I am having trouble with video buffering on your platform. Can you please look into this issue?', 3),
(18, 10, 'We apologize for the inconvenience. We have identified the issue and fixed the problem. Please let us know if you continue to have any issues.', 4),
(19, 7, 'I am requesting a change of email address for my account.', 3),
(20, 7, 'We have received your request. Please confirm the new email address by clicking on the link sent to your current email address.', 1),
(21, 7, 'I have confirmed the new email address. Can you please update my account?', 3),
(22, 7, 'Your account has been updated with the new email address. Please let us know if you have any further issues.', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `privileges`
--

CREATE TABLE `privileges` (
  `id_priv` int(11) NOT NULL,
  `role_name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `privileges`
--

INSERT INTO `privileges` (`id_priv`, `role_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'edytor');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `privilege_change_request`
--

CREATE TABLE `privilege_change_request` (
  `case_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `case_status` tinyint(4) DEFAULT NULL,
  `user_message` text NOT NULL,
  `admin_message` text NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reasons`
--

CREATE TABLE `reasons` (
  `reason_id` int(11) NOT NULL,
  `reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reported_videos`
--

CREATE TABLE `reported_videos` (
  `id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reported_video_reasons`
--

CREATE TABLE `reported_video_reasons` (
  `id` int(11) NOT NULL,
  `reason_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `id_video` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `tags`
--

INSERT INTO `tags` (`id`, `tag`, `id_video`) VALUES
(1, 'coffee', 1),
(2, 'brewing', 1),
(3, 'perfect cup', 1),
(4, 'photography', 2),
(5, 'beginner', 2),
(6, 'tips', 2),
(7, 'pizza', 3),
(8, 'science', 3),
(9, 'great', 3),
(10, 'chocolate', 4),
(11, 'history', 4),
(12, 'calligraphy', 5),
(13, 'art', 5),
(14, 'omelette', 6),
(15, 'perfect', 6),
(16, 'cocktail', 7),
(17, 'secrets', 7),
(18, 'great', 7),
(19, 'guitar', 8),
(20, 'history', 8),
(21, 'knitting', 9),
(22, 'art', 9),
(23, 'brewing', 10),
(24, 'science', 10),
(25, 'beer', 10),
(26, 'camera', 11),
(27, 'history', 11),
(28, 'pottery', 12),
(29, 'art', 12),
(30, 'baking', 13),
(31, 'science', 13),
(32, 'bicycle', 14),
(33, 'history', 14),
(34, 'origami', 15),
(35, 'art', 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `ticket_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `user_id`, `status`, `type`, `ticket_name`) VALUES
(1, 2, 1, 'technical', 'Cannot upload video'),
(2, 3, 1, 'other', 'Can t access account'),
(3, 3, 1, 'account', 'Password reset request'),
(4, 2, 1, 'technical', 'Error when streaming video'),
(5, 2, 1, 'payment', 'Refund request'),
(6, 3, 1, 'technical', 'Video quality issue'),
(7, 3, 1, 'other', 'Suggestion for new feature'),
(8, 2, 1, 'account', 'Change email request'),
(9, 2, 1, 'payment', 'Payment not processed'),
(10, 3, 1, 'technical', 'Video buffering issue');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uploaded_videos`
--

CREATE TABLE `uploaded_videos` (
  `id_video` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `uploaded_videos`
--

INSERT INTO `uploaded_videos` (`id_video`, `id_user`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_priv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `login`, `passwd`, `email`, `id_priv`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 1),
(2, 'user', 'user', 'user@user.pl', 2),
(3, 'edytor', 'edytor', 'edytor@edytor.pl', 3),
(4, 'admin2', 'admin2', 'admin2@admin.com', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_background_color`
--

CREATE TABLE `user_background_color` (
  `id` int(11) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_tags`
--

CREATE TABLE `user_tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `user_tags`
--

INSERT INTO `user_tags` (`id`, `tag`, `user_id`) VALUES
(1, 'coffee', 2),
(2, 'brewing', 2),
(3, 'pizza', 2),
(4, 'history', 2),
(5, 'omelette', 2),
(6, 'knitting', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `videos`
--

CREATE TABLE `videos` (
  `id_video` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `videos`
--

INSERT INTO `videos` (`id_video`, `title`, `extension`, `url`) VALUES
(1, 'How to make a perfect cup of coffee', 'url', 'https://www.youtube.com/watch?v=gK_qiu9W7TU'),
(2, '5 Tips for beginner photographers', 'url', 'https://www.youtube.com/watch?v=OOjRcLZmBOc'),
(3, 'The science behind a great pizza', 'url', 'https://www.youtube.com/watch?v=m30YnuF9vUc'),
(4, 'The history of chocolate', 'url', 'https://www.youtube.com/watch?v=ibjUpk9Iagk'),
(5, 'The art of calligraphy', 'url', 'https://www.youtube.com/watch?v=tgKNFJfd78s'),
(6, 'How to make a perfect omelette', 'url', 'https://www.youtube.com/watch?v=y-Wr401Bio4'),
(7, 'The secrets of a great cocktail', 'url', 'https://www.youtube.com/watch?v=2RAFr6F2Xp8'),
(8, 'The history of the guitar', 'url', 'https://www.youtube.com/watch?v=AjK4GVR1EcE'),
(9, 'The art of knitting', 'url', 'https://www.youtube.com/watch?v=dTTJjD_q2Ik'),
(10, 'The science of brewing beer', 'url', 'https://www.youtube.com/watch?v=Y1oaFtpGKuM'),
(11, 'The history of the camera', 'url', 'https://www.youtube.com/watch?v=cvy7Qlp4A2k'),
(12, 'The art of pottery', 'url', 'https://www.youtube.com/watch?v=1RadZYqdb2c'),
(13, 'The science of baking', 'url', 'https://www.youtube.com/watch?v=09WXvI3gbbI'),
(14, 'The history of the bicycle', 'url', 'https://www.youtube.com/watch?v=yqkDW14S6JQ'),
(15, 'The art of origami', 'url', 'https://www.youtube.com/watch?v=etCW9M9VdGk');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id_priv`);

--
-- Indeksy dla tabeli `privilege_change_request`
--
ALTER TABLE `privilege_change_request`
  ADD PRIMARY KEY (`case_id`);

--
-- Indeksy dla tabeli `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`reason_id`);

--
-- Indeksy dla tabeli `reported_videos`
--
ALTER TABLE `reported_videos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `video_id` (`video_id`);

--
-- Indeksy dla tabeli `reported_video_reasons`
--
ALTER TABLE `reported_video_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indeksy dla tabeli `uploaded_videos`
--
ALTER TABLE `uploaded_videos`
  ADD PRIMARY KEY (`id_video`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeksy dla tabeli `user_background_color`
--
ALTER TABLE `user_background_color`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user_tags`
--
ALTER TABLE `user_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT dla tabeli `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id_priv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `privilege_change_request`
--
ALTER TABLE `privilege_change_request`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `reasons`
--
ALTER TABLE `reasons`
  MODIFY `reason_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `reported_videos`
--
ALTER TABLE `reported_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `reported_video_reasons`
--
ALTER TABLE `reported_video_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT dla tabeli `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `uploaded_videos`
--
ALTER TABLE `uploaded_videos`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `user_background_color`
--
ALTER TABLE `user_background_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user_tags`
--
ALTER TABLE `user_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `videos`
--
ALTER TABLE `videos`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
