-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-09-2024 a las 01:58:20
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `instagram`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `SecurityUserActionsDelete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserActionsDelete` (IN `_datos` VARCHAR(255))   BEGIN
  DECLARE error_code INT DEFAULT 0;
  DECLARE error_message TEXT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    GET DIAGNOSTICS CONDITION 1
      error_code = MYSQL_ERRNO,
      error_message = MESSAGE_TEXT;

    ROLLBACK;

    SELECT CONCAT('E|Ocurrion un error: ', error_message) AS data;
  END;

  START TRANSACTION;

  DELETE FROM user_actions WHERE id = _datos;

  DELETE FROM user_permissions WHERE action_id = _datos;

  COMMIT;

  SELECT CONCAT('id|Nombre¬10|180¬Int32|String',
    IFNULL((
      SELECT GROUP_CONCAT(CONCAT('¬', id, '|', name) SEPARATOR '')
      FROM user_actions
    ), ''),
    '¯A|Registro eliminado correctamente'
  ) AS data;
END$$

DROP PROCEDURE IF EXISTS `SecurityUserActionsEdit`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserActionsEdit` (IN `_datos` VARCHAR(255))   BEGIN
  SELECT IFNULL(CONCAT( id, '|', name), '') AS data
  FROM user_actions WHERE id = _datos;
END$$

DROP PROCEDURE IF EXISTS `SecurityUserActionsList`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserActionsList` (IN `_datos` VARCHAR(255))   BEGIN
  SELECT CONCAT('id|Nombre¬10|180¬Int32|String',
    IFNULL((
      SELECT GROUP_CONCAT(CONCAT('¬', id, '|', name) SEPARATOR '')
      FROM user_actions
    ), '')) AS data;
END$$

DROP PROCEDURE IF EXISTS `SecurityUserActionsSave`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserActionsSave` (IN `_datos` VARCHAR(255))   BEGIN
  DECLARE _id INT;
  DECLARE _name VARCHAR(100);
  DECLARE error_code INT DEFAULT 0;
  DECLARE error_message TEXT;
  DECLARE message TEXT;
  
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    GET DIAGNOSTICS CONDITION 1
      error_code = MYSQL_ERRNO,
      error_message = MESSAGE_TEXT;

    ROLLBACK;

    SELECT CONCAT('id|Nombre¬10|180¬Int32|String',
      IFNULL((
        SELECT GROUP_CONCAT(CONCAT('¬', id, '|', name) SEPARATOR '')
        FROM user_actions
      ), ''),
      '¯E|Ocurrion un error: ', error_message
    ) AS data;
  END;

  START TRANSACTION;

  SET _id = SplitString(_datos, '|', 1);
  SET _name = SplitString(_datos, '|', 2);

  IF (_id = 0) THEN
    INSERT INTO user_actions (id, name) VALUES (_id, _name);
    SET message = 'A|Registro guardado con exito';
  ELSE
    UPDATE user_actions SET name = _name WHERE id = _id;
    SET message = 'A|Registro actualizado con exito';
  END IF;
  
  COMMIT;

  SELECT CONCAT('id|Nombre¬10|180¬Int32|String',
    IFNULL((
      SELECT GROUP_CONCAT(CONCAT('¬', id, '|', name) SEPARATOR '')
      FROM user_actions
    ), ''),
    '¯', message
  ) AS data;
END$$

DROP PROCEDURE IF EXISTS `SecurityUserTypesActionsList`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserTypesActionsList` (IN `_datos` VARCHAR(255))   BEGIN
  SELECT IFNULL((
    SELECT GROUP_CONCAT(CONCAT(action_id, '|') SEPARATOR '')
    FROM user_permissions WHERE user_type_id = _datos
  ), '') AS data;
END$$

DROP PROCEDURE IF EXISTS `SecurityUserTypesActionsSave`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserTypesActionsSave` (IN `_datos` VARCHAR(255))   BEGIN
  DECLARE _USER_TYPE_ID INT;
  DECLARE _ACTION_ID INT;
  DECLARE error_code INT DEFAULT 0;
  DECLARE error_message TEXT;
  DECLARE message TEXT;
  
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    GET DIAGNOSTICS CONDITION 1
      error_code = MYSQL_ERRNO,
      error_message = MESSAGE_TEXT;

    ROLLBACK;

    SELECT CONCAT('E|Ocurrion un error: ', error_message) AS data;
  END;

  START TRANSACTION;

  SET _USER_TYPE_ID = SplitString(_datos, '|', 1);
  SET _ACTION_ID = SplitString(_datos, '|', 2);

  IF EXISTS(
    SELECT * FROM user_permissions 
    WHERE user_type_id = _USER_TYPE_ID AND action_id = _ACTION_ID
  ) THEN
    DELETE FROM user_permissions 
    WHERE user_type_id = _USER_TYPE_ID AND action_id = _ACTION_ID;
    
    SET message = 'A|Permiso eliminado con exito';
  ELSE
    INSERT INTO user_permissions (user_type_id, action_id) 
    VALUES (_USER_TYPE_ID, _ACTION_ID);

    SET message = 'A|Permiso guardado con exito';
  END IF;
  
  COMMIT;

  SELECT message AS data;
END$$

DROP PROCEDURE IF EXISTS `SecurityUserTypesDelete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserTypesDelete` (IN `_datos` VARCHAR(255))   BEGIN
  DECLARE error_code INT DEFAULT 0;
  DECLARE error_message TEXT;
  
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    GET DIAGNOSTICS CONDITION 1
      error_code = MYSQL_ERRNO,
      error_message = MESSAGE_TEXT;

    ROLLBACK;

    SELECT CONCAT('E|Ocurrion un error ', error_code, ': ', error_message) AS data;
  END;

  START TRANSACTION;

  DELETE FROM user_types WHERE id = _datos;
  
  COMMIT;

  SELECT CONCAT('id|Nombre¬10|180¬Int32|String',
    IFNULL((
      SELECT GROUP_CONCAT(CONCAT('¬', id, '|', name) SEPARATOR '')
      FROM user_types
    ), ''),
    '¯A|Registro eliminado correctamente'
  ) AS data;
END$$

DROP PROCEDURE IF EXISTS `SecurityUserTypesEdit`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserTypesEdit` (IN `_datos` VARCHAR(255))   BEGIN
  SELECT IFNULL(CONCAT( id, '|', name), '') AS data
  FROM user_types WHERE id = _datos;
END$$

DROP PROCEDURE IF EXISTS `SecurityUserTypesHelpersList`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserTypesHelpersList` (IN `_datos` VARCHAR(255))   BEGIN
  SELECT IFNULL((
    SELECT GROUP_CONCAT(CONCAT(id, '|', name, '¬') SEPARATOR '')
    FROM user_actions
  ), '') AS data;
END$$

DROP PROCEDURE IF EXISTS `SecurityUserTypesList`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserTypesList` (IN `datos` VARCHAR(255))   BEGIN
SELECT CONCAT('id|Nombre¬10|180¬Int32|String',
  IFNULL((SELECT GROUP_CONCAT(
    CONCAT('¬', id, '|', name) 
    SEPARATOR ''
  )
  FROM user_types
), '')) AS data;
END$$

DROP PROCEDURE IF EXISTS `SecurityUserTypesSave`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SecurityUserTypesSave` (IN `_datos` VARCHAR(255))   BEGIN
  DECLARE _id INT;
  DECLARE _name VARCHAR(100);
  DECLARE error_code INT DEFAULT 0;
  DECLARE error_message TEXT;
  DECLARE message TEXT;
  
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    GET DIAGNOSTICS CONDITION 1
      error_code = MYSQL_ERRNO,
      error_message = MESSAGE_TEXT;

    ROLLBACK;

    SELECT CONCAT('id|Nombre¬10|180¬Int32|String',
      IFNULL((
        SELECT GROUP_CONCAT(CONCAT('¬', id, '|', name) SEPARATOR '')
        FROM user_types
      ), ''),
      '¯E|Ocurrion un error: ', error_message
    ) AS data;
  END;

  START TRANSACTION;

  SET _id = SplitString(_datos, '|', 1);
  SET _name = SplitString(_datos, '|', 2);

  IF (_id = 0) THEN
    INSERT INTO user_types (id, name) VALUES (_id, _name);
    SET message = 'A|Registro guardado con exito';
  ELSE
    UPDATE user_types SET name = _name WHERE id = _id;
    SET message = 'A|Registro actualizado con exito';
  END IF;
  
  COMMIT;

  SELECT CONCAT('id|Nombre¬10|180¬Int32|String',
    IFNULL((
      SELECT GROUP_CONCAT(CONCAT('¬', id, '|', name) SEPARATOR '')
      FROM user_types
    ), ''),
    '¯', message
  ) AS data;
END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `SplitString`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `SplitString` (`str` VARCHAR(255), `delim` VARCHAR(10), `pos` INT) RETURNS TEXT CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci  BEGIN
  DECLARE output TEXT;
  SET output = SUBSTRING_INDEX(SUBSTRING_INDEX(str, delim, pos), delim, -1);
  RETURN output;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_type_id` int NOT NULL,
  `names` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `names`, `email`, `password`, `status`, `username`, `profile`) VALUES
(1, 3, 'Elar', 'elar@elar.com', '$2y$10$v6ANqw2ZUyUrv7SUKMuVluReGRGM9Ph4pMLjG.Uu3sLBnC8C/OtHK', '1', '', ''),
(2, 2, 'Admin', 'biblioteca@correo.com', '$2y$10$G8VIRtoMO6af56S3p1TBJOog1Q/RK.GV48GxLekk9xs1CphMzkafy', '1', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_actions`
--

DROP TABLE IF EXISTS `user_actions`;
CREATE TABLE IF NOT EXISTS `user_actions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_actions`
--

INSERT INTO `user_actions` (`id`, `name`) VALUES
(1, 'login'),
(2, 'logout'),
(3, 'main'),
(4, 'user'),
(5, 'usertype'),
(6, 'useraction'),
(11, 'inicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE IF NOT EXISTS `user_permissions` (
  `user_type_id` int NOT NULL,
  `action_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_permissions`
--

INSERT INTO `user_permissions` (`user_type_id`, `action_id`) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(1, 2),
(1, 11),
(3, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_types`
--

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, 'Invitado'),
(2, 'Usuario XD'),
(3, 'Administrador');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
