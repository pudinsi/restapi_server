--
-- Kontak
--
CREATE TABLE IF NOT EXISTS `telepon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `nomor` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `telepon` (`id`, `nama`, `nomor`) VALUES
(1, 'Orion', '08576666762'),
(2, 'Mars', '08576666770'),
(7, 'Alpha', '08576666765');

--
--
---

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_nama` varchar(60) NOT NULL,
  `pegawai_unit` varchar(50) NOT NULL,
  `pegawai_jabatan` varchar(50) NOT NULL,
  `pegawai_telpon` varchar(13) NOT NULL,
  `pegawai_tgl_input` datetime NOT NULL,
  `pegawai_tgl_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- REST Enable Keys
--

CREATE TABLE `keys` (
       `id` INT(11) NOT NULL AUTO_INCREMENT,
       `user_id` INT(11) NOT NULL,
       `key` VARCHAR(40) NOT NULL,
       `level` INT(2) NOT NULL,
       `ignore_limits` TINYINT(1) NOT NULL DEFAULT '0',
       `is_private_key` TINYINT(1)  NOT NULL DEFAULT '0',
       `ip_addresses` TEXT NULL DEFAULT NULL,
       `date_created` INT(11) NOT NULL,
       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- REST Enable Logging
--

CREATE TABLE `logs` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `uri` VARCHAR(255) NOT NULL,
    `method` VARCHAR(6) NOT NULL,
    `params` TEXT DEFAULT NULL,
    `api_key` VARCHAR(40) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `time` INT(11) NOT NULL,
    `rtime` FLOAT DEFAULT NULL,
    `authorized` VARCHAR(1) NOT NULL,
    `response_code` smallint(3) DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- REST Method Access Control
--

CREATE TABLE `access` (
   `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
   `key` VARCHAR(40) NOT NULL DEFAULT '',
   `all_access` TINYINT(1) NOT NULL DEFAULT '0',
   `controller` VARCHAR(50) NOT NULL DEFAULT '',
   `date_created` DATETIME DEFAULT NULL,
  `date_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- REST Enable Limits
--

CREATE TABLE `limits` (
   `id` INT(11) NOT NULL AUTO_INCREMENT,
   `uri` VARCHAR(255) NOT NULL,
   `count` INT(10) NOT NULL,
   `hour_started` INT(11) NOT NULL,
   `api_key` VARCHAR(40) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
--
--


