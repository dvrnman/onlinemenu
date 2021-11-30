-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 30 Kas 2021, 17:51:10
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `onlınemenu2`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `kategori_isim` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `resim_url` varchar(300) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `sirket_id`, `kategori_isim`, `resim_url`) VALUES
(1, 1, 'KEBAPLAR', 'kasibeyaz-bosphorus-subat-2020.jpg'),
(2, 1, 'TATLILAR', 'visne-soslu-sutlu-tatli-f40615ba-62b4-431e-9d69-5957d5893814.jpg'),
(3, 1, 'ÇORBALAR', '5f0da1ea67b0a81050bfb21b.png'),
(4, 2, 'DURUMLER', '2662219_810x458.jpg'),
(5, 0, '', ''),
(6, 1, 'SALATALAR', 'gavurdagi-salatasi-yeni-one-cikan.jpg'),
(7, 1, 'ÇORBALAR', 'gavurdagi-salatasi-yeni-one-cikan.jpg'),
(8, 3, 'ÇİĞDEM LOKANTASI', 'gavurdagi-salatasi-yeni-one-cikan.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sirketler`
--

CREATE TABLE `sirketler` (
  `id` int(11) NOT NULL,
  `isim` varchar(300) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sirketler`
--

INSERT INTO `sirketler` (`id`, `isim`) VALUES
(1, 'MACKA'),
(2, 'KATIK'),
(3, 'ÇİĞDEM LOKANTASI');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `urun_isim` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `resim_url` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `fiyat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `kategori_id`, `sirket_id`, `urun_isim`, `resim_url`, `fiyat`) VALUES
(1, 1, 1, 'ADANA PORSİYON', 'adana-kebap-tarifi20785996565f60f95328bbd.jpg', 55),
(2, 4, 2, 'BORU', 'visne-soslu-sutlu-tatli-f40615ba-62b4-431e-9d69-5957d5893814.jpg', 25);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sirketler`
--
ALTER TABLE `sirketler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `sirketler`
--
ALTER TABLE `sirketler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
