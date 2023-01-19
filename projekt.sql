-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Sty 2023, 17:01
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
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uploaded_videos`
--

CREATE TABLE `uploaded_videos` (
  `id_video` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 'edytor', 'edytor', 'edytor@edytor.pl', 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id_priv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `uploaded_videos`
--
ALTER TABLE `uploaded_videos`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `user_background_color`
--
ALTER TABLE `user_background_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user_tags`
--
ALTER TABLE `user_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `videos`
--
ALTER TABLE `videos`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
