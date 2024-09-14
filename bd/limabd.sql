-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-01-2023 a las 15:36:00
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `limabd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `caja_fecha` date NOT NULL,
  `caja_apertura` decimal(10,2) NOT NULL,
  `id_caja_numero` int(11) NOT NULL,
  `id_usuario_apertura` int(11) NOT NULL,
  `caja_apertura_fecha` datetime NOT NULL,
  `caja_cierre` decimal(10,2) DEFAULT NULL,
  `id_usuario_cierre` int(11) DEFAULT NULL,
  `caja_cierre_fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `caja_fecha`, `caja_apertura`, `id_caja_numero`, `id_usuario_apertura`, `caja_apertura_fecha`, `caja_cierre`, `id_usuario_cierre`, `caja_cierre_fecha`) VALUES
(1, '2022-04-06', '0.00', 1, 2, '2022-04-06 21:22:50', NULL, NULL, '2022-04-06 21:22:50'),
(2, '2022-04-10', '0.00', 1, 2, '2022-04-10 11:03:58', NULL, NULL, '2022-04-10 11:03:58'),
(3, '2022-04-12', '0.00', 1, 2, '2022-04-12 08:04:03', NULL, NULL, '2022-04-12 08:04:03'),
(4, '2022-04-20', '0.00', 1, 2, '2022-04-20 12:48:00', NULL, NULL, '2022-04-20 12:48:00'),
(5, '2022-04-22', '0.00', 1, 2, '2022-04-22 13:51:11', NULL, NULL, '2022-04-22 13:51:11'),
(6, '2022-05-04', '0.00', 1, 2, '2022-05-04 10:58:50', NULL, NULL, '2022-05-04 10:58:50'),
(7, '2022-06-03', '0.00', 1, 2, '2022-06-03 11:00:46', NULL, NULL, '2022-06-03 11:00:46'),
(8, '2022-06-06', '0.00', 1, 2, '2022-06-06 12:49:44', NULL, NULL, '2022-06-06 12:49:44'),
(9, '2022-07-09', '0.00', 1, 1, '2022-07-09 12:18:44', NULL, NULL, '2022-07-09 12:18:44'),
(10, '2022-07-11', '0.00', 1, 1, '2022-07-11 13:29:24', NULL, NULL, '2022-07-11 13:29:24'),
(11, '2022-07-12', '0.00', 1, 1, '2022-07-12 10:09:47', NULL, NULL, '2022-07-12 10:09:47'),
(12, '2022-11-07', '0.00', 1, 1, '2022-11-07 17:16:42', NULL, NULL, '2022-11-07 17:16:42'),
(13, '2022-12-22', '0.00', 1, 1, '2022-12-22 17:15:09', NULL, NULL, '2022-12-22 17:15:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_numero`
--

CREATE TABLE `caja_numero` (
  `id_caja_numero` int(11) NOT NULL,
  `caja_numero_nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `caja_numero_fecha` datetime NOT NULL,
  `caja_numero_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja_numero`
--

INSERT INTO `caja_numero` (`id_caja_numero`, `caja_numero_nombre`, `caja_numero_fecha`, `caja_numero_estado`) VALUES
(1, 'Caja 1', '2021-02-17 20:37:19', 1),
(2, 'Caja 2', '2021-02-17 20:37:52', 0),
(3, 'Caja 3', '2021-02-17 20:38:07', 0),
(4, 'Caja 4', '2021-02-17 20:48:26', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `categoria_descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria_nombre`, `categoria_descripcion`) VALUES
(1, 'GENERAL', 'VARIOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `id_tipodocumento` int(11) NOT NULL,
  `cliente_razonsocial` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cliente_nombre` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cliente_numero` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_correo` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cliente_direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cliente_telefono` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cliente_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cliente_estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `id_tipodocumento`, `cliente_razonsocial`, `cliente_nombre`, `cliente_numero`, `cliente_correo`, `cliente_direccion`, `cliente_telefono`, `cliente_fecha`, `cliente_estado`) VALUES
(1, 2, NULL, 'PUBLICO EN GENERAL', '11111111', NULL, '', '', '2020-11-10 12:17:47', 1),
(2, 4, 'Hoteleria y Servicios Generales Gonzales S.R.L', '', '20609180740', '', 'Calle Miraflores #200 - San Juan Bautista', '', '2022-04-06 21:46:03', 1),
(3, 4, 'DELFRIO O&R E.I.R.L', '', '20602214657', '', 'CALLE 26 DE ABRIL MZ P LOTE 14-SANTA CLARA', '', '2022-04-12 09:40:07', 1),
(4, 4, 'SERVICENTRO VARSOVIA E.I.R.L.', '', '20528304355', '', 'Av. Jose Abelardo Quiñones km 4.5', '', '2022-04-20 13:02:54', 1),
(5, 4, 'COMERCIAL FERRETERA EL MAESTRO E.I.R.L.', '', '20601693802', '', 'Amazonas MZ. A- Lt 13 B San Juan', '', '2022-05-04 11:53:01', 1),
(6, 4, 'ADAL IMPORT S.R.L.', '', '20602240127', '', 'Av,Freyre 1785- Punchana', '', '2022-06-03 11:03:55', 1),
(7, 4, 'Comercial Ferreteria Claribec EIRL', '', '20601425093', '', 'Grau 1223', '', '2022-06-06 12:49:19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes`
--

CREATE TABLE `comprobantes` (
  `id_comprobante` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comprobante_tipo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comprobante_serie` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comprobante_correlativo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comprobante_fecha_emision` date NOT NULL,
  `comprobante_fecha_registro` datetime NOT NULL,
  `comprobante_archivo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `comprobante_concepto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `comprobante_ruc_proveedor` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `comprobante_tipo_pago` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comprobante_estado` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativos`
--

CREATE TABLE `correlativos` (
  `id_correlativo` int(11) NOT NULL,
  `correlativo_b` int(11) NOT NULL,
  `correlativo_f` int(11) NOT NULL,
  `correlativo_in` int(11) NOT NULL,
  `correlativo_out` int(11) NOT NULL,
  `correlativo_nc` int(11) NOT NULL,
  `correlativo_nd` int(11) NOT NULL,
  `correlativo_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `correlativos`
--

INSERT INTO `correlativos` (`id_correlativo`, `correlativo_b`, `correlativo_f`, `correlativo_in`, `correlativo_out`, `correlativo_nc`, `correlativo_nd`, `correlativo_venta`) VALUES
(1, 6, 3, 100081, 100166, 2, 1, 100048);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id_egreso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `egreso_descripcion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `egreso_monto` float(10,2) NOT NULL,
  `egreso_estado` tinyint(1) NOT NULL,
  `egreso_fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `empresa_razon_social` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_nombrecomercial` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_descripcion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_ruc` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_domiciliofiscal` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_pais` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_departamento` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_provincia` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_distrito` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_ubigeo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_telefono1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_telefono2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_celular1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_celular2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_foto` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_correo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_usuario_sol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_clave_sol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_fechayhora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `empresa_estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `empresa_razon_social`, `empresa_nombrecomercial`, `empresa_descripcion`, `empresa_ruc`, `empresa_domiciliofiscal`, `empresa_pais`, `empresa_departamento`, `empresa_provincia`, `empresa_distrito`, `empresa_ubigeo`, `empresa_telefono1`, `empresa_telefono2`, `empresa_celular1`, `empresa_celular2`, `empresa_foto`, `empresa_correo`, `empresa_usuario_sol`, `empresa_clave_sol`, `empresa_fechayhora`, `empresa_estado`) VALUES
(1, 'LIMA MOROTE DEOMAR HERMES RAI', 'LIMA', 'LIMA - ACTIVIDADES DE COSTRUCCIÓN Y SERVICIOS', '10711949611', 'CALLE LOS ANGELES 210-B', 'PE', 'LORETO', 'MAYNAS', 'SAN JUAN BAUTISTA', '160101', NULL, NULL, '', NULL, NULL, NULL, 'LIMABUFE', 'Limabufeo1', '2021-11-25 17:16:47', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio_resumen`
--

CREATE TABLE `envio_resumen` (
  `id_envio_resumen` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL DEFAULT '1',
  `envio_resumen_fecha` date NOT NULL,
  `envio_resumen_serie` varchar(20) NOT NULL,
  `envio_resumen_correlativo` varchar(20) NOT NULL,
  `envio_resumen_nombreXML` varchar(200) DEFAULT NULL,
  `envio_resumen_nombreCDR` varchar(200) DEFAULT NULL,
  `envio_resumen_estado` tinyint(4) NOT NULL DEFAULT '0',
  `envio_resumen_estadosunat` varchar(2000) DEFAULT NULL,
  `envio_resumen_estadosunat_consulta` varchar(2000) DEFAULT NULL,
  `envio_resumen_ticket` varchar(100) NOT NULL,
  `envio_sunat_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio_resumen_detalle`
--

CREATE TABLE `envio_resumen_detalle` (
  `id_envio_resumen_detalle` int(11) NOT NULL,
  `id_envio_resumen` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `envio_resumen_detalle_condicion` tinyint(4) NOT NULL COMMENT '1-Creacion, 2-Actualizacion, 3-Baja'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `igv`
--

CREATE TABLE `igv` (
  `id_igv` int(11) NOT NULL,
  `igv_codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `igv_codigoafectacion` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT '10',
  `igv_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `igv_codigoInternacional` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `igv_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `igv_tipodeafectacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `igv_tipo_json` tinyint(4) NOT NULL,
  `igv_estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `igv`
--

INSERT INTO `igv` (`id_igv`, `igv_codigo`, `igv_codigoafectacion`, `igv_descripcion`, `igv_codigoInternacional`, `igv_nombre`, `igv_tipodeafectacion`, `igv_tipo_json`, `igv_estado`) VALUES
(1, '1000', '10', 'IGV Impuesto General a las Ventas', 'VAT', 'IGV', 'Gravado - Operación Onerosa', 1, 1),
(2, '9998', '30', 'Inafecta', 'FRE', 'INA', 'Inafecto - Operación Onerosa', 9, 1),
(3, '9997', '20', 'Exonerado', 'VAT', 'EXO', 'Exonerado - Operación Onerosa', 8, 1),
(4, '9996', '11', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Gravado - Retiro por premio', 2, 1),
(5, '9996', '12', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Gravado - Retiro por donación', 3, 1),
(6, '9996', '13', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Gravado - Retiro', 4, 1),
(7, '9996', '14', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Gravado - Retiro por publicidad', 5, 1),
(8, '9996', '15', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Gravado - Bonificaciones', 6, 1),
(9, '9996', '16', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Gravado - Retiro por entrega a trabajadores', 7, 1),
(10, '1016', '17', 'Impuesto a la Venta Arroz Pilado', 'VAT', 'IVAP', 'Gravado - IVAP', 17, 1),
(11, '9996', '21', 'Gratuita', 'FRE', 'GRA', '[Gratuita] Exonerado - Transferencia gratuita', 0, 0),
(12, '9996', '31', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Inafecta - Retiro por Bonificación', 10, 1),
(13, '9996', '32', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Inafecto - Retiro', 11, 1),
(14, '9996', '33', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Inafecto - Retiro por Muestras Médicas', 12, 1),
(15, '9996', '34', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Inafecto - Retiro por Convenio Colectivo', 13, 1),
(16, '9996', '35', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Inafecto - Retiro por premio', 14, 1),
(17, '9996', '36', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Inafecto - Retiro por publicidad', 15, 1),
(18, '9996', '37', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Inafecto - Transferencia gratuita', 0, 0),
(19, '9995', '40', 'Exportación', 'FRE', 'EXP', 'Exportación de Bienes o Servicios', 16, 1),
(20, '9996', '17', 'Gratuito', 'FRE', 'GRA', '[Gratuita] Gravado - IVAP', 101, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida`
--

CREATE TABLE `medida` (
  `id_medida` int(11) NOT NULL,
  `medida_codigo_unidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `medida_nombre` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `medida_activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `medida`
--

INSERT INTO `medida` (`id_medida`, `medida_codigo_unidad`, `medida_nombre`, `medida_activo`) VALUES
(1, '4A', 'BOBINAS                                           ', 0),
(2, 'BJ', 'BALDE                                             ', 0),
(3, 'BLL', 'BARRILES                                          ', 0),
(4, 'BG', 'BOLSA                                             ', 1),
(5, 'BO', 'BOTELLAS                                          ', 1),
(6, 'BX', 'CAJA                                              ', 1),
(7, 'CT', 'CARTONES                                          ', 0),
(8, 'CMK', 'CENTIMETRO CUADRADO                               ', 0),
(9, 'CMQ', 'CENTIMETRO CUBICO                                 ', 0),
(10, 'CMT', 'CENTIMETRO LINEAL                                 ', 0),
(11, 'CEN', 'CIENTO DE UNIDADES                                ', 0),
(12, 'CY', 'CILINDRO                                          ', 0),
(13, 'CJ', 'CONOS                                             ', 1),
(14, 'DZN', 'DOCENA                                            ', 0),
(15, 'DZP', 'DOCENA POR 10**6                                  ', 0),
(16, 'BE', 'FARDO                                             ', 0),
(17, 'GLI', 'GALON INGLES (4,545956L)', 0),
(18, 'GRM', 'GRAMO                                             ', 0),
(19, 'GRO', 'GRUESA                                            ', 0),
(20, 'HLT', 'HECTOLITRO                                        ', 0),
(21, 'LEF', 'HOJA                                              ', 0),
(22, 'SET', 'JUEGO                                             ', 0),
(23, 'KGM', 'KILOGRAMO                                         ', 0),
(24, 'KTM', 'KILOMETRO                                         ', 0),
(25, 'KWH', 'KILOVATIO HORA                                    ', 0),
(26, 'KT', 'KIT                                               ', 0),
(27, 'CA', 'LATAS                                             ', 0),
(28, 'LBR', 'LIBRAS                                            ', 0),
(29, 'LTR', 'LITRO                                             ', 1),
(30, 'MWH', 'MEGAWATT HORA                                     ', 0),
(31, 'MTR', 'METRO                                             ', 1),
(32, 'MTK', 'METRO CUADRADO                                    ', 0),
(33, 'MTQ', 'METRO CUBICO                                      ', 0),
(34, 'MGM', 'MILIGRAMOS                                        ', 0),
(35, 'MLT', 'MILILITRO                                         ', 0),
(36, 'MMT', 'MILIMETRO                                         ', 0),
(37, 'MMK', 'MILIMETRO CUADRADO                                ', 0),
(38, 'MMQ', 'MILIMETRO CUBICO                                  ', 0),
(39, 'MLL', 'MILLARES                                          ', 0),
(40, 'UM', 'MILLON DE UNIDADES                                ', 0),
(41, 'ONZ', 'ONZAS                                             ', 0),
(42, 'PF', 'PALETAS                                           ', 0),
(43, 'PK', 'PAQUETE                                           ', 0),
(44, 'PR', 'PAR                                               ', 0),
(45, 'FOT', 'PIES                                              ', 0),
(46, 'FTK', 'PIES CUADRADOS                                    ', 0),
(47, 'FTQ', 'PIES CUBICOS                                      ', 0),
(48, 'C62', 'PIEZAS                                            ', 0),
(49, 'PG', 'PLACAS                                            ', 0),
(50, 'ST', 'PLIEGO                                            ', 0),
(51, 'INH', 'PULGADAS                                          ', 0),
(52, 'RM', 'RESMA                                             ', 0),
(53, 'DR', 'TAMBOR                                            ', 0),
(54, 'STN', 'TONELADA CORTA                                    ', 0),
(55, 'LTN', 'TONELADA LARGA                                    ', 0),
(56, 'TNE', 'TONELADAS                                         ', 0),
(57, 'TU', 'TUBOS                                             ', 0),
(58, 'NIU', 'UNIDAD (BIENES)                                   ', 1),
(59, 'ZZ', 'UNIDAD (SERVICIOS) ', 1),
(60, 'GLL', 'US GALON (3,7843 L)', 0),
(61, 'YRD', 'YARDA                                             ', 0),
(62, 'YDK', 'YARDA CUADRADA                                    ', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id_menu` int(11) NOT NULL,
  `menu_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `menu_controlador` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `menu_icono` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `menu_orden` int(11) NOT NULL,
  `menu_mostrar` tinyint(1) NOT NULL,
  `menu_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id_menu`, `menu_nombre`, `menu_controlador`, `menu_icono`, `menu_orden`, `menu_mostrar`, `menu_estado`) VALUES
(1, 'Login', 'Login', '-', 0, 0, 1),
(2, 'Panel de Inicio', 'Admin', 'fa fa-dashboard', 1, 1, 1),
(3, 'Gestión de Menu', 'Menu', 'fa fa-desktop', 2, 1, 1),
(4, 'Roles de Usuario', 'Rol', 'fa fa-user-secret', 4, 1, 1),
(5, 'Usuarios', 'Usuario', 'fa fa-user', 3, 1, 1),
(6, 'Datos Personales', 'Datos', 'fa fa-', 0, 0, 1),
(7, 'INVENTARIO', 'Inventario', 'fa fa-industry', 10, 1, 1),
(8, 'Turnos', 'Turno', 'fa fa-odnoklassniki', 6, 0, 1),
(9, 'MOVIMIENTOS', 'Egresos', 'fa fa-folder-o', 11, 1, 1),
(10, 'Unidad de Medida', 'Unidadmedida', 'fa fa-qrcode', 8, 0, 1),
(11, 'Correlativos', 'Correlativo', 'fa fa-caret-square-o-right', 7, 0, 1),
(12, 'PROVEEDORES', 'Proveedor', 'fa fa-car', 9, 1, 1),
(13, 'Ventas', 'Ventas', 'fa fa-credit-card', 13, 1, 1),
(14, 'CLIENTES', 'Clientes', 'fa fa-child', 12, 1, 1),
(15, 'REPORTES', 'Reporte', 'fa fa-calendar-minus-o', 14, 1, 1),
(16, 'Cajas', 'Caja', 'fa fa-cc-visa', 5, 0, 1),
(17, 'PROFORMA', 'Proforma', 'fa fa-', 15, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id_moneda` int(11) NOT NULL,
  `moneda` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `abreviado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `abrstandar` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `simbolo` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `activo` char(1) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id_moneda`, `moneda`, `abreviado`, `abrstandar`, `simbolo`, `activo`) VALUES
(1, 'soles', 'sol', 'PEN', 'S/', '1'),
(2, 'dólares', 'dol', 'USD', '$', '1'),
(3, 'euros', 'eur', 'EUR', 'E', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id_opcion` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `opcion_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `opcion_funcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `opcion_icono` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `opcion_mostrar` tinyint(1) NOT NULL,
  `opcion_orden` int(11) NOT NULL,
  `opcion_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id_opcion`, `id_menu`, `opcion_nombre`, `opcion_funcion`, `opcion_icono`, `opcion_mostrar`, `opcion_orden`, `opcion_estado`) VALUES
(1, 1, 'Inicio de Sesion', 'inicio', '-', 0, 0, 1),
(2, 2, 'Inicio', 'inicio', 'fa fa-play', 1, 1, 1),
(3, 2, 'Cerrar Sesión', 'finalizar_sesion', 'fa fa-sign-out', 0, 1, 1),
(4, 3, 'Gestionar Menús', 'inicio', '', 1, 1, 1),
(5, 3, 'Iconos', 'iconos', '', 1, 2, 1),
(6, 3, 'Accesos por Rol', 'roles', '', 0, 0, 1),
(7, 3, 'Opciones por Menú', 'opciones', '', 0, 0, 1),
(8, 3, 'Gestionar Permisos(breve)', 'gestion_permisos', '', 0, 0, 1),
(9, 4, 'Gestionar Roles', 'inicio', '', 1, 1, 1),
(10, 4, 'Accesos por Rol', 'accesos', '', 0, 0, 1),
(11, 3, 'Gestionar Restricciones(breve)', 'gestion_restricciones', '', 0, 0, 1),
(12, 5, 'Gestionar Usuarios', 'inicio', '', 1, 1, 1),
(13, 6, 'Editar Datos', 'editar_datos', '', 0, 0, 1),
(14, 6, 'Editar Usuario', 'editar_usuario', '', 0, 0, 1),
(15, 6, 'Cambiar Contraseña', 'cambiar_contrasenha', '', 0, 0, 1),
(16, 7, 'AGREGAR PRODUCTO', 'agregar_producto', '', 1, 1, 1),
(17, 7, 'LISTAR PRODUCTOS', 'listarproductos', '', 1, 2, 1),
(18, 7, 'Editar Producto ', 'editar_producto', '', 0, 3, 1),
(19, 7, 'Ver Costo de Venta', 'productforsale', '', 0, 4, 1),
(20, 7, 'Agregar Precio de Venta', 'addproductforsale', '', 0, 5, 1),
(21, 7, 'Editar Precio de Venta', 'editproductforsale', '', 0, 6, 1),
(22, 7, 'Agregar Stock de Producto', 'agregar_stock', '', 0, 7, 1),
(23, 7, 'Salida de Productos', 'salida_stock', '', 0, 8, 1),
(24, 8, 'Agregar Turnos', 'agregar', '', 1, 1, 1),
(25, 8, 'Listar Turnos', 'listar', '', 1, 2, 1),
(26, 9, 'Agregar Egresos', 'agregar', '', 1, 1, 1),
(27, 9, 'Listar Egresos', 'listar', '', 1, 2, 1),
(28, 10, 'Ver Todo', 'listar', '', 1, 1, 1),
(29, 11, 'EDITAR CORRELATIVOS', 'editar', '', 1, 1, 1),
(30, 12, 'AGREGAR PROVEEDOR', 'agregar', '', 1, 1, 1),
(31, 12, 'LISTAR PROVEEDORES', 'listar', '', 1, 2, 1),
(32, 12, 'Editar', 'editar', '', 0, 3, 1),
(33, 13, 'REALIZAR VENTA', 'realizar_venta', '', 1, 1, 1),
(34, 13, 'VENTAS PENDIENTES DE DECLARAR', 'historial_ventas', '', 1, 2, 1),
(35, 14, 'AGREGAR CLIENTE', 'agregar', '', 1, 1, 1),
(36, 14, 'LISTAR CLIENTES', 'listar', '', 1, 2, 1),
(37, 14, 'Editar ', 'editar', '', 0, 3, 1),
(38, 13, 'Tabla de Productos', 'tabla_productos', '', 0, 3, 1),
(39, 13, 'Ver Venta', 'ver_venta', '', 0, 4, 1),
(40, 15, 'REPORTE DEL DIA', 'reporte_dia', '', 1, 1, 1),
(41, 15, 'INGRESOS Y EGRESOS', 'ingresos_y_egresos', '', 1, 2, 1),
(42, 15, 'INVENTARIO', 'inventario', '', 0, 3, 1),
(43, 15, 'Reporte Dia pdf', 'reporte_dia_pdf', '', 0, 4, 1),
(44, 16, 'Agregar', 'agregar', '', 1, 1, 1),
(45, 16, 'Listar', 'listar', '', 1, 2, 1),
(46, 15, 'Compra de Productos', 'reporte_compras', '', 0, 5, 1),
(47, 15, 'Ingresos Egresos PDF', 'ingresos_egresos_pdf', '', 0, 6, 1),
(48, 15, 'REPORTES', 'inicio', '', 0, 0, 1),
(49, 14, 'CLIENTES Y PROVEEDORES', 'inicio', '', 0, 0, 1),
(50, 7, 'PRODUCTOS', 'productos', '', 0, 0, 1),
(51, 9, 'EGRESOS', 'egresos', '', 0, 0, 1),
(52, 7, 'PROFORMA', 'proforma', '', 0, 0, 0),
(53, 13, 'PROFORMA', 'proforma', '', 0, 0, 1),
(54, 17, 'VER PROFORMA', 'ver_proforma', '', 0, 3, 1),
(55, 17, 'REALIZAR PROFORMA', 'realizar_proforma', '', 0, 1, 1),
(56, 17, 'TABLA PROFORMA', 'tabla_proforma', '', 0, 2, 1),
(57, 17, 'PROFORMA', 'proforma', '', 0, 0, 1),
(58, 13, 'HISTORIAL VENTAS DECLARADAS', 'historial_ventas_enviadas', '', 1, 3, 1),
(59, 13, 'RESUMEN DIARIO', 'envio_resumenes_diario', '', 1, 3, 1),
(60, 13, 'HISTORIAL RESUMEN DIARIO', 'historial_resumen_diario', '', 1, 4, 1),
(61, 13, 'ver_detalle_resumen', 'ver_detalle_resumen', '', 0, 0, 1),
(62, 13, 'HISTORIAL COMUNICACION BAJAS', 'historial_bajas_facturas', '', 1, 5, 1),
(63, 13, 'generar_nota', 'generar_nota', '', 0, 0, 1),
(64, 13, 'ticket_electronico', 'ticket_electronico', '', 0, 0, 1),
(65, 17, 'proforma_pdf', 'proforma_pdf', '', 0, 0, 1),
(66, 13, 'imprimir_ticket_pdf', 'imprimir_ticket_pdf', '', 0, 0, 1),
(67, 13, 'excel_ventas_enviadas', 'excel_ventas_enviadas', '', 0, 0, 1),
(68, 9, 'Agregar Facturas', 'agregar_facturas', '', 1, 2, 1),
(69, 9, 'Listar Comprobantes', 'listar_comprobantes', '', 1, 9, 1),
(70, 13, 'Ticket PDF', 'ticket_pdf', '', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL,
  `permiso_accion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `permiso_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `id_opcion`, `permiso_accion`, `permiso_estado`) VALUES
(1, 1, 'validar_sesion', 1),
(2, 4, 'guardar_menu', 1),
(3, 6, 'configurar_relacion', 1),
(4, 7, 'guardar_opcion', 1),
(5, 7, 'agregar_permiso', 1),
(6, 7, 'eliminar_permiso', 1),
(7, 7, 'configurar_acceso', 1),
(8, 9, 'guardar_rol', 1),
(9, 10, 'gestionar_acceso_rol', 1),
(10, 12, 'guardar_nuevo_usuario', 1),
(11, 12, 'guardar_edicion_usuario', 1),
(12, 12, 'guardar_edicion_persona', 1),
(13, 12, 'restablecer_contrasenha', 1),
(14, 13, 'guardar_datos', 1),
(15, 14, 'guardar_usuario', 1),
(16, 15, 'guardar_contrasenha', 1),
(17, 2, 'agregar_apertura', 1),
(18, 7, 'guardar_menu', 1),
(23, 24, 'agregar_turno', 1),
(24, 25, 'eliminar_turno', 1),
(25, 16, 'guardar_producto_precio', 1),
(26, 17, 'eliminar_producto', 1),
(27, 22, 'editar_stock', 1),
(28, 26, 'agregar_egreso', 1),
(29, 27, 'eliminar_egreso', 1),
(31, 28, 'cambiarestado', 1),
(32, 29, 'editar_c', 1),
(33, 30, 'guardar_proveedor', 1),
(34, 31, 'eliminar_proveedor', 1),
(35, 35, 'guardar_cliente', 1),
(36, 36, 'eliminar_cliente', 1),
(37, 33, 'addproduct', 1),
(38, 33, 'eliminar_producto', 1),
(39, 33, 'guardar_venta', 1),
(40, 44, 'agregar_caja', 1),
(41, 45, 'eliminarcaja', 1),
(42, 33, 'search_by_barcode', 1),
(43, 23, 'salidastock', 1),
(44, 17, 'quitar_producto', 1),
(45, 55, 'addproduct', 1),
(46, 55, 'eliminar_producto', 1),
(47, 55, 'guardar_proforma', 1),
(48, 33, 'consultar_serie', 1),
(49, 33, 'tipo_nota_descripcion', 1),
(50, 34, 'crear_xml_enviar_sunat', 1),
(51, 34, 'anular_boleta_cambiarestado', 1),
(53, 34, 'tipo_nota_descripcion', 1),
(54, 39, 'ticket_electronico', 1),
(55, 33, 'ticket_electronico', 1),
(56, 59, 'crear_enviar_resumen_sunat', 1),
(57, 58, 'comunicacion_baja', 1),
(58, 35, 'obtener_datos_x_ruc', 1),
(59, 35, 'obtener_datos_x_dni', 1),
(60, 63, 'consultar_serie_nota', 1),
(61, 36, 'cambiar_estado_cliente', 1),
(62, 55, 'search_by_barcode', 1),
(63, 55, 'jalar_venta_mm', 1),
(64, 54, 'eliminar_proforma', 1),
(65, 40, 'salidas_stock', 1),
(66, 41, 'datos_x_fecha', 1),
(67, 41, 'ingresos_egresos_pdf', 1),
(68, 17, 'consultar_datos', 1),
(69, 33, 'editar_cantidad_tabla', 1),
(70, 68, 'guardar_comprobantes', 1),
(71, 69, 'eliminar_comprobante', 1),
(72, 34, 'cambiarestado_enviado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `persona_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `persona_apellido_paterno` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `persona_apellido_materno` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `persona_nacimiento` date DEFAULT NULL,
  `persona_telefono` char(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `persona_creacion` datetime NOT NULL,
  `persona_modificacion` datetime NOT NULL,
  `persona_codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `persona_nombre`, `persona_apellido_paterno`, `persona_apellido_materno`, `persona_nacimiento`, `persona_telefono`, `persona_creacion`, `persona_modificacion`, `persona_codigo`) VALUES
(1, 'SUPER ADMINISTRADOR', '', '', '2021-06-01', NULL, '2020-09-17 00:00:00', '2020-09-17 00:00:00', '010101010101'),
(2, 'ADMIN', '', '', '2021-06-01', NULL, '2020-10-27 18:29:10', '2020-10-27 18:29:10', '1603841350.1786'),
(4, 'Cajero 1', 'Cajero 1', 'Cajero 1', '2020-01-01', '999999999', '2021-05-25 10:48:44', '2021-05-25 10:48:44', '1621957724.6612');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `producto_codigo_barra` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `producto_nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `producto_descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `producto_stock` double NOT NULL,
  `producto_creacion` datetime NOT NULL,
  `producto_estado` tinyint(2) NOT NULL DEFAULT '1',
  `producto_codigo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_categoria`, `id_usuario`, `producto_codigo_barra`, `producto_nombre`, `producto_descripcion`, `producto_stock`, `producto_creacion`, `producto_estado`, `producto_codigo`) VALUES
(1, 1, 2, '1', 'Adoquines de bajo transito 20x10x4', NULL, -1, '2021-11-29 23:58:30', 1, '1'),
(2, 1, 2, '2', 'Adoquines de mediano transito 20x10x6', NULL, 0, '2021-11-29 23:58:30', 1, '2'),
(3, 1, 2, '3', 'Adoquines de alto transito 20x10x8', NULL, -2, '2021-11-29 23:58:30', 1, '3'),
(4, 1, 2, '4', 'Bloquetas de Cemento 40x20x10 unidad', NULL, -3, '2021-11-29 23:58:30', 1, '4'),
(5, 1, 2, '5', 'Bloquetas de cemento 40x20x12 unidad', NULL, -202, '2021-11-29 23:58:30', 1, '5'),
(6, 1, 2, '6', 'Ladrillos de Cemento 20x15x10 unidad', NULL, 0, '2021-11-29 23:58:30', 1, '6'),
(7, 1, 2, '7', 'Bloquetas de Cemento 40x20x10 (Millar)', NULL, -2, '2021-11-29 23:58:30', 1, '7'),
(8, 1, 2, '8', 'Bloquetas de cemento 40x20x12 (Millar)', NULL, -1, '2021-11-29 23:58:30', 1, '8'),
(9, 1, 2, '9', 'Ladrillos de Cemento 20x15x10 (Millar)', NULL, 0, '2021-11-29 23:58:30', 1, '9'),
(10, 1, 2, '10', 'Ornamentales 30x30x9', NULL, 0, '2021-11-29 23:58:30', 1, '10'),
(11, 1, 2, '11', 'Caja de Desague', NULL, 0, '2021-11-29 23:58:30', 1, '11'),
(12, 1, 2, '12', 'Fachaleta ', NULL, 0, '2021-11-29 23:58:30', 1, '12'),
(13, 1, 2, '13', 'Lata de arena', NULL, 0, '2021-11-29 23:58:30', 1, '13'),
(14, 1, 2, '14', 'Bolsa de cemento Andino', NULL, -105, '2021-11-29 23:58:30', 1, '14'),
(15, 1, 2, '15', 'Persianas ', NULL, -400, '2021-11-29 23:58:30', 1, '15'),
(16, 1, 2, '16', 'Mosaicos ', NULL, 0, '2021-11-29 23:58:30', 1, '16'),
(17, 1, 2, '17', 'Octagonales ', NULL, 0, '2021-11-29 23:58:30', 1, '17'),
(18, 1, 2, '18', 'Grass Block Michi', NULL, 0, '2021-11-29 23:58:30', 1, '18'),
(19, 1, 2, '19', 'Caja de encofrado', NULL, 0, '2021-11-29 23:58:30', 1, '19'),
(20, 1, 2, '20', 'Caja de registro', NULL, 0, '2021-11-29 23:58:30', 1, '20'),
(21, 1, 2, '100', 'Fierro Varilla 3/8', NULL, -35, '2022-04-12 08:20:58', 1, '1649769658.5329'),
(22, 1, 2, '101', 'Fierro Varilla 1/2', NULL, 22, '2022-04-12 08:22:48', 1, '1649769768.9481'),
(23, 1, 2, '102', 'Alambron ', NULL, -12, '2022-04-12 09:21:32', 1, '1649773292.2673'),
(24, 1, 2, '103', 'Alambre Quemado', NULL, -8, '2022-04-12 09:22:24', 1, '1649773344.43'),
(25, 1, 2, '104', 'Clavo 3 pulgadas', NULL, -6, '2022-04-12 09:23:43', 1, '1649773423.2486'),
(26, 1, 2, '105', 'Clavo 4 pulgadas', NULL, -3, '2022-04-12 09:24:28', 1, '1649773468.5556'),
(27, 1, 2, '106', 'Arena Volquete 18 m3', NULL, -1, '2022-04-12 09:25:59', 1, '1649773559.6571'),
(28, 1, 2, '96369', 'Bolsa de Cemento Apu', NULL, -100, '2022-04-20 13:00:34', 1, '1650477634.6291'),
(29, 1, 2, '002', 'ORNAMENTALES ', NULL, -346, '2022-05-04 11:09:19', 1, '1651680559.7246'),
(30, 1, 1, '', 'PRODUCTO NUEVO AGREGADO', NULL, 1, '2022-11-07 18:35:30', 1, '1667864130.1875');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_precio`
--

CREATE TABLE `producto_precio` (
  `id_producto_precio` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_medida` int(11) NOT NULL,
  `producto_precio_codigoafectacion` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `producto_precio_unidad` int(11) NOT NULL,
  `producto_precio_valor` double(10,2) NOT NULL,
  `producto_precio_valor_xmayor` decimal(10,2) DEFAULT NULL,
  `producto_precio_compra` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto_precio`
--

INSERT INTO `producto_precio` (`id_producto_precio`, `id_producto`, `id_proveedor`, `id_medida`, `producto_precio_codigoafectacion`, `producto_precio_unidad`, `producto_precio_valor`, `producto_precio_valor_xmayor`, `producto_precio_compra`) VALUES
(1, 1, 1, 58, '20', 1, 1.20, NULL, 0.00),
(2, 2, 1, 58, '20', 1, 1.80, NULL, 0.00),
(3, 3, 1, 58, '20', 1, 2.20, NULL, 0.00),
(4, 4, 1, 58, '20', 1, 2.40, NULL, 0.00),
(5, 5, 1, 58, '20', 1, 2.50, NULL, 0.00),
(6, 6, 1, 58, '20', 1, 1.00, NULL, 0.00),
(7, 7, 1, 58, '20', 1, 2400.00, NULL, 0.00),
(8, 8, 1, 58, '20', 1, 2500.00, NULL, 0.00),
(9, 9, 1, 58, '20', 1, 990.00, NULL, 0.00),
(10, 10, 1, 58, '20', 1, 4.00, NULL, 0.00),
(11, 11, 1, 58, '20', 1, 150.00, NULL, 0.00),
(12, 12, 1, 58, '20', 1, 1.80, NULL, 0.00),
(13, 13, 1, 58, '20', 1, 1.00, NULL, 0.00),
(14, 14, 1, 58, '20', 1, 28.00, NULL, 0.00),
(15, 15, 1, 58, '20', 1, 4.50, NULL, 0.00),
(16, 16, 1, 58, '20', 1, 0.00, NULL, 0.00),
(17, 17, 1, 58, '20', 1, 1.50, NULL, 0.00),
(18, 18, 1, 58, '20', 1, 4.00, NULL, 0.00),
(19, 19, 1, 58, '20', 1, 0.00, NULL, 0.00),
(20, 20, 1, 58, '20', 1, 140.00, NULL, 0.00),
(21, 21, 1, 58, '20', 1, 24.00, '24.00', 24.00),
(22, 22, 1, 58, '20', 1, 42.00, '42.00', 42.00),
(23, 23, 1, 58, '20', 1, 6.50, '6.50', 6.50),
(24, 24, 1, 58, '20', 1, 7.00, '7.00', 7.00),
(25, 25, 1, 58, '20', 1, 8.00, '8.00', 8.00),
(26, 26, 1, 58, '20', 1, 8.00, '8.00', 8.00),
(27, 27, 1, 58, '20', 1, 500.00, '500.00', 500.00),
(28, 28, 1, 58, '20', 1, 27.00, '27.00', 27.00),
(29, 29, 1, 58, '20', 1, 2.50, '2.50', 2.50),
(30, 30, 1, 58, '20', 1, 5.00, '5.00', 2.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_venta`
--

CREATE TABLE `producto_venta` (
  `id_venta` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL DEFAULT '1',
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_turno` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL DEFAULT '1',
  `producto_venta_direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `producto_venta_tipo` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `producto_venta_correlativo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `producto_venta_totalgratuita` decimal(10,2) NOT NULL DEFAULT '0.00',
  `producto_venta_totalexonerada` decimal(10,2) NOT NULL DEFAULT '0.00',
  `producto_venta_totalinafecta` decimal(10,2) NOT NULL DEFAULT '0.00',
  `producto_venta_totalgravada` decimal(10,2) NOT NULL DEFAULT '0.00',
  `producto_venta_totaligv` decimal(10,2) NOT NULL DEFAULT '0.00',
  `producto_venta_incluye_igv` tinyint(2) NOT NULL DEFAULT '1',
  `producto_venta_totaldescuento` decimal(10,2) NOT NULL DEFAULT '0.00',
  `producto_venta_icbper` decimal(10,2) NOT NULL DEFAULT '0.00',
  `producto_venta_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `producto_venta_pago` decimal(10,2) NOT NULL DEFAULT '0.00',
  `producto_venta_vuelto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `producto_venta_fecha` datetime NOT NULL,
  `tipo_documento_modificar` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT '01 - es Factura y 03-Boleta',
  `correlativo_modificar` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'se llena cuando se hace una nota',
  `tipo_nota_id` tinyint(4) DEFAULT NULL COMMENT 'el numero depende de que nota es',
  `enviado_facturador` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 - cuando se da en enviar al facturador y 0 por defecto',
  `saleproduct_Ncomprobante` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'se llena cuando se genera el comprobante para luego enviar al facturador sunat',
  `link_pdf_comprobante` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `respuesta_sunat` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_de_baja` date DEFAULT NULL,
  `anulado_sunat` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 cuando se creo su archivo plano para anular el comprobante',
  `producto_venta_cancelar` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto_venta`
--

INSERT INTO `producto_venta` (`id_venta`, `id_empresa`, `id_cliente`, `id_usuario`, `id_turno`, `id_moneda`, `producto_venta_direccion`, `producto_venta_tipo`, `producto_venta_correlativo`, `producto_venta_totalgratuita`, `producto_venta_totalexonerada`, `producto_venta_totalinafecta`, `producto_venta_totalgravada`, `producto_venta_totaligv`, `producto_venta_incluye_igv`, `producto_venta_totaldescuento`, `producto_venta_icbper`, `producto_venta_total`, `producto_venta_pago`, `producto_venta_vuelto`, `producto_venta_fecha`, `tipo_documento_modificar`, `correlativo_modificar`, `tipo_nota_id`, `enviado_facturador`, `saleproduct_Ncomprobante`, `link_pdf_comprobante`, `respuesta_sunat`, `fecha_de_baja`, `anulado_sunat`, `producto_venta_cancelar`) VALUES
(32, 1, 1, 1, 1, 1, '', '03', 'NT° 100029', '0.00', '5.50', '0.00', '0.00', '0.00', 1, '0.00', '0.30', '6.10', '0.00', '0.00', '2021-02-15 21:29:50', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(33, 1, 1, 1, 1, 1, '', '03', 'NT° 100029', '0.00', '23.00', '0.00', '0.00', '0.00', 1, '0.00', '0.30', '23.60', '0.00', '0.00', '2021-02-15 21:31:55', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(34, 1, 1, 1, 1, 1, '', '03', 'NT° 100029', '0.00', '8.80', '0.00', '0.00', '0.00', 1, '0.00', '0.30', '9.10', '0.00', '0.00', '2021-02-16 12:17:44', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(35, 1, 1, 1, 1, 1, '', '03', 'NT° 100029', '0.00', '2.50', '0.00', '0.00', '0.00', 1, '0.00', '0.30', '2.80', '0.00', '0.00', '2021-02-16 14:42:51', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(36, 1, 1, 1, 1, 1, '', '03', 'NT° 100029', '0.00', '20.00', '0.00', '0.00', '0.00', 1, '0.00', '0.30', '20.30', '0.00', '0.00', '2021-02-16 14:43:22', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(37, 1, 1, 1, 1, 1, '', '03', 'NT° 100029', '0.00', '20.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '20.00', '0.00', '0.00', '2021-02-23 11:39:33', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(38, 1, 1, 1, 1, 1, '', '03', 'NT° 100029', '0.00', '3.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '3.50', '0.00', '0.00', '2021-02-23 11:40:08', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(39, 1, 1, 1, 1, 1, '', '03', 'NT° 100029', '0.00', '21.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '21.50', '0.00', '0.00', '2021-02-23 20:28:31', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(40, 1, 1, 1, 1, 1, '', '03', 'NT° 100029', '0.00', '6.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '6.00', '0.00', '0.00', '2021-02-23 20:34:29', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(41, 1, 1, 1, 1, 1, '', '03', 'NT° 100030', '0.00', '2.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '2.50', '0.00', '0.00', '2021-02-23 20:34:50', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(42, 1, 1, 1, 1, 1, '', '03', 'NT° 100031', '0.00', '3.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '3.50', '0.00', '0.00', '2021-02-23 20:35:18', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(43, 1, 1, 1, 1, 1, '', '03', 'NT° 100032', '0.00', '8.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '8.50', '0.00', '0.00', '2021-02-23 20:42:50', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(44, 1, 1, 1, 1, 1, '', '03', 'NT° 100033', '0.00', '1.30', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '1.30', '0.00', '0.00', '2021-02-24 10:46:29', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(45, 1, 1, 1, 1, 1, '', '03', 'NT° 100034', '0.00', '6.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '6.00', '0.00', '0.00', '2021-03-18 13:46:24', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(46, 1, 1, 1, 1, 1, '', 'undefine', 'NT° 100035', '0.00', '25.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '25.00', '0.00', '0.00', '2021-05-04 13:23:40', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(47, 1, 1, 1, 1, 1, '', 'undefine', 'NT° 100036', '0.00', '35.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '35.00', '0.00', '0.00', '2021-05-05 09:30:40', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(48, 1, 1, 1, 1, 1, '', 'undefine', 'NT° 100037', '0.00', '35.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '35.00', '0.00', '0.00', '2021-05-05 09:31:26', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(49, 1, 1, 1, 1, 1, '', '03', 'NT° 100038', '0.00', '29.60', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '29.60', '0.00', '0.00', '2021-05-10 17:32:04', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(50, 1, 1, 1, 1, 1, '', '03', 'NT° 100039', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '2021-05-18 14:19:05', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(51, 1, 1, 1, 1, 1, '', '03', 'NT° 100039', '0.00', '0.20', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '0.20', '0.00', '0.00', '2021-05-18 14:19:19', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(52, 1, 1, 1, 1, 1, '', '03', 'NT° 100040', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '2021-05-18 14:28:28', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(53, 1, 1, 1, 1, 1, '', '03', 'NT° 100040', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '2021-05-19 09:48:08', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(54, 1, 1, 1, 1, 1, '', '03', 'NT° 100040', '0.00', '3.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '3.50', '0.00', '0.00', '2021-05-19 10:01:18', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(55, 1, 1, 1, 1, 1, '', '03', 'NT° 100041', '0.00', '1.30', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '1.30', '0.00', '0.00', '2021-05-20 11:05:55', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(56, 1, 1, 1, 1, 1, '', '03', 'NT° 100042', '0.00', '0.10', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '0.10', '0.00', '0.00', '2021-05-20 11:08:40', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(57, 1, 1, 1, 1, 1, '', '03', 'NT° 100043', '0.00', '3.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '3.50', '0.00', '0.00', '2021-05-21 11:47:27', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(58, 1, 1, 4, 1, 1, '', '03', 'NT° 100044', '0.00', '20.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '20.00', '50.00', '30.00', '2021-05-25 12:33:22', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(59, 1, 1, 4, 1, 1, '', '03', 'NT° 100045', '0.00', '20.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '20.00', '0.00', '0.00', '2021-05-25 14:09:57', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(60, 1, 1, 4, 1, 1, '', '03', 'NT° 100046', '0.00', '2.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '2.50', '0.00', '0.00', '2021-05-25 14:10:20', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1),
(61, 1, 1, 2, 1, 1, '', '03', 'NT° 100047', '0.00', '0.40', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '0.40', '0.00', '0.00', '2021-05-26 11:12:08', '', '', 0, 0, NULL, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proformas`
--

CREATE TABLE `proformas` (
  `id_proforma` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `proforma_correlativo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `proforma_total` decimal(10,2) NOT NULL,
  `proforma_fecha_generada` datetime NOT NULL,
  `proforma_estado` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proforma_detalle`
--

CREATE TABLE `proforma_detalle` (
  `id_proforma_detalle` int(11) NOT NULL,
  `id_proforma` int(11) NOT NULL,
  `id_producto_precio` int(11) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `proforma_detalle_precio` float(10,2) NOT NULL,
  `proforma_detalle_producto_cantidad` double NOT NULL,
  `producto_proforma_total_selled` double NOT NULL,
  `proforma_detalle_mm` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proforma_detalle_fecha_registro` datetime NOT NULL,
  `proforma_detalle_estado` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `proveedor_nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor_documento_identidad` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor_telefono` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor_direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor_correo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `proveedor_fecha_registro` datetime NOT NULL,
  `proveedor_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `proveedor_nombre`, `proveedor_documento_identidad`, `proveedor_telefono`, `proveedor_direccion`, `proveedor_correo`, `proveedor_fecha_registro`, `proveedor_estado`) VALUES
(1, 'GENERAL', '99999999', '777777777', '--', NULL, '2022-04-06 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restricciones`
--

CREATE TABLE `restricciones` (
  `id_restriccion` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol_nombre` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `rol_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rol_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol_nombre`, `rol_descripcion`, `rol_estado`) VALUES
(1, 'Libre', 'Accesos sin inicio de sesión', 1),
(2, 'SuperAdmin', 'Tiene acceso a la gestión total del sistema', 1),
(3, 'Admin', 'Gestión del sistema', 1),
(4, 'Cajero', 'Caja', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_menus`
--

CREATE TABLE `roles_menus` (
  `id_rol_menu` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles_menus`
--

INSERT INTO `roles_menus` (`id_rol_menu`, `id_rol`, `id_menu`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 3, 2),
(7, 3, 5),
(8, 2, 6),
(9, 3, 6),
(10, 2, 7),
(11, 2, 8),
(12, 2, 9),
(13, 2, 10),
(14, 2, 11),
(15, 2, 12),
(16, 2, 13),
(17, 2, 14),
(18, 2, 15),
(19, 2, 16),
(20, 2, 17),
(21, 3, 17),
(22, 4, 2),
(23, 4, 6),
(24, 4, 7),
(25, 4, 8),
(27, 4, 13),
(28, 4, 14),
(29, 4, 17),
(30, 3, 7),
(31, 3, 8),
(32, 3, 9),
(33, 3, 10),
(34, 3, 11),
(35, 3, 12),
(36, 3, 13),
(37, 3, 14),
(38, 3, 15),
(39, 3, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serie`
--

CREATE TABLE `serie` (
  `id_serie` int(11) NOT NULL,
  `tipocomp` char(2) DEFAULT NULL,
  `serie` varchar(8) DEFAULT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

--
-- Volcado de datos para la tabla `serie`
--

INSERT INTO `serie` (`id_serie`, `tipocomp`, `serie`, `correlativo`, `estado`) VALUES
(1, '01', 'F001', 11, 1),
(2, '01', 'F002', 0, 0),
(3, '03', 'B001', 2, 1),
(5, '07', 'FN01', 0, 1),
(6, '07', 'BN01', 0, 1),
(7, '08', 'FD01', 0, 1),
(8, '08', 'BD01', 0, 1),
(9, 'RC', '20211115', 0, 1),
(10, 'RA', '20210530', 0, 1),
(4, '03', 'B003', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `startproduct`
--

CREATE TABLE `startproduct` (
  `id_startproduct` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `startproduct_stock` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `startproduct`
--

INSERT INTO `startproduct` (`id_startproduct`, `id_producto`, `fecha_registro`, `startproduct_stock`) VALUES
(1, 21, '2022-04-12 08:20:58', 0),
(2, 22, '2022-04-12 08:22:49', 42),
(3, 23, '2022-04-12 09:21:32', 0),
(4, 24, '2022-04-12 09:22:24', 0),
(5, 25, '2022-04-12 09:23:43', 0),
(6, 26, '2022-04-12 09:24:28', 0),
(7, 27, '2022-04-12 09:25:59', 0),
(8, 28, '2022-04-20 13:00:34', 0),
(9, 29, '2022-05-04 11:09:19', 0),
(10, 30, '2022-11-07 18:35:30', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocklog`
--

CREATE TABLE `stocklog` (
  `id_stocklog` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_turno` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `stocklog_precio_compra_producto` decimal(10,2) NOT NULL,
  `stocklog_added` double DEFAULT NULL,
  `stocklog_guide` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stocklog_description` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stocklog_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stockout`
--

CREATE TABLE `stockout` (
  `id_stockout` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_turno` int(11) DEFAULT NULL,
  `stockout_out` double NOT NULL,
  `stockout_guide` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `stockout_description` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `stockout_destiny` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `stockout_ruc` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `stockout_origin` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `stockout_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_afectacion`
--

CREATE TABLE `tipo_afectacion` (
  `id_tipo_afectacion` int(11) NOT NULL,
  `codigo` char(2) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `codigo_afectacion` char(4) DEFAULT NULL,
  `nombre_afectacion` char(3) DEFAULT NULL,
  `tipo_afectacion` char(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tipo_afectacion`
--

INSERT INTO `tipo_afectacion` (`id_tipo_afectacion`, `codigo`, `descripcion`, `codigo_afectacion`, `nombre_afectacion`, `tipo_afectacion`) VALUES
(1, '10', 'OP. GRAVADAS', '1000', 'IGV', 'VAT'),
(2, '20', 'OP. EXONERADAS', '9997', 'EXO', 'VAT'),
(3, '30', 'OP. INAFECTAS', '9998', 'INA', 'FRE'),
(4, '21', 'OP. GRATUITAS', '9996', 'GRA', 'FRE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documentos`
--

CREATE TABLE `tipo_documentos` (
  `id_tipodocumento` int(11) NOT NULL,
  `tipodocumento_codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipodocumento_identidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipodocumento_estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documentos`
--

INSERT INTO `tipo_documentos` (`id_tipodocumento`, `tipodocumento_codigo`, `tipodocumento_identidad`, `tipodocumento_estado`) VALUES
(1, '0', 'DOC.TRIB.NO.DOM.SIN.RUC', 1),
(2, '1', 'Documento Nacional de Identidad', 1),
(3, '4', 'Carnet de extranjería', 1),
(4, '6', 'Registro Unico de Contributentes', 1),
(5, '7', 'Pasaporte', 1),
(6, 'A', 'Cédula Diplomática de identidad', 1),
(7, 'B', 'DOC.IDENT.PAIS.RESIDENCIA-NO.D', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ncreditos`
--

CREATE TABLE `tipo_ncreditos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_nota_descripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_ncreditos`
--

INSERT INTO `tipo_ncreditos` (`id`, `codigo`, `tipo_nota_descripcion`, `estado`) VALUES
(1, '01', 'Anulación de la operacion', 0),
(2, '02', 'Anulación por error en el RUC', 0),
(3, '03', 'Corrección por error en la descripcion', 0),
(4, '04', 'Descuento Global', 0),
(5, '05', 'Descuento por ítem', 0),
(6, '06', 'Devolución total', 0),
(7, '07', 'Devolución por ítem', 0),
(8, '08', 'Bonificación', 0),
(9, '09', 'Disminición en el valor', 0),
(10, '10', 'Otros conceptos', 0),
(11, '11', 'Ajustes de operaciones de exportacion', 0),
(12, '12', 'Ajustes afectos al IVAP', 0),
(13, '13', 'Corrección del monto neto pendiente de pago y/o la(s) fechas(s) de vencimiento del pago \r\núnico o de las cuotas y/o los montos correspondientes a cada', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ndebitos`
--

CREATE TABLE `tipo_ndebitos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_nota_descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_ndebitos`
--

INSERT INTO `tipo_ndebitos` (`id`, `codigo`, `tipo_nota_descripcion`, `estado`) VALUES
(1, '01', 'Intereses por mora', 0),
(2, '02', 'Aumento en el valor', 0),
(3, '03', 'Penalidades / Otros conceptos', 0),
(4, '10', 'Ajustes de operaciones de exportación', 0),
(5, '11', 'Ajustes afectos al IVAP', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id_tipo_pago` int(11) NOT NULL,
  `tipo_pago_nombre` varchar(100) NOT NULL,
  `tipo_pago_estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`id_tipo_pago`, `tipo_pago_nombre`, `tipo_pago_estado`) VALUES
(1, 'TARJETA', 1),
(2, 'TRANSFERENCIA', 1),
(3, 'EFECTIVO', 1),
(4, 'PAGO A PLAZO', 0),
(5, 'CUOTAS', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id_turno` int(11) NOT NULL,
  `turno_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `turno_apertura` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `turno_cierre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `turno_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id_turno`, `turno_nombre`, `turno_apertura`, `turno_cierre`, `turno_estado`) VALUES
(1, 'madrugada', '00:00', '8:00', 1),
(2, 'tarde', '16:00', '23:59', 1),
(3, 'mañana', '08:01', '15:59', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `usuario_nickname` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_contrasenha` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_imagen` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_estado` int(11) NOT NULL,
  `usuario_creacion` datetime NOT NULL,
  `usuario_ultimo_login` datetime NOT NULL,
  `usuario_ultima_modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_persona`, `id_rol`, `usuario_nickname`, `usuario_contrasenha`, `usuario_email`, `usuario_imagen`, `usuario_estado`, `usuario_creacion`, `usuario_ultimo_login`, `usuario_ultima_modificacion`) VALUES
(1, 1, 2, 'superadmin', '$2y$10$oPOOOgTUr4zIh511ATm/q.vzsAmxP.e2.vzyEbRn/1pzyWz2oXj0a', 'cesarjose@bufeotec.com', 'media/usuarios/usuario.jpg', 1, '2020-09-17 00:00:00', '2022-11-07 16:58:49', '2020-09-17 00:00:00'),
(2, 2, 3, 'admin', '$2y$10$oPOOOgTUr4zIh511ATm/q.vzsAmxP.e2.vzyEbRn/1pzyWz2oXj0a', 'carlos@gmail.com', 'media/usuarios/usuario.jpg', 1, '2020-10-27 18:29:10', '2022-04-20 13:40:12', '2020-10-27 18:29:10'),
(4, 4, 4, 'cajero1', '$2y$10$sXtacngjleP5YbgpgEyiCOyGxj6l/2Xvrtt4FcJbieX1hvHOOct..', 'cajero@ejemplo.com', 'media/usuarios/usuario.jpg', 1, '2021-05-25 10:48:44', '2021-05-25 16:23:53', '2021-05-25 10:48:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_turno` int(11) NOT NULL,
  `id_tipo_pago` int(11) NOT NULL DEFAULT '3',
  `id_moneda` int(11) NOT NULL DEFAULT '1',
  `venta_condicion_resumen` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-Registro, 2-Actualizar, 3-baja',
  `venta_tipo_envio` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1-directo, 2-resumen diario',
  `venta_direccion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venta_tipo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `venta_serie` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venta_correlativo` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `venta_descuento_global` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_totalgratuita` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_totalexonerada` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_totalinafecta` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_totalgravada` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_totaligv` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_incluye_igv` tinyint(2) NOT NULL DEFAULT '1',
  `venta_totaldescuento` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_icbper` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_pago_cliente` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_vuelto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_fecha` datetime NOT NULL,
  `venta_observacion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_documento_modificar` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serie_modificar` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correlativo_modificar` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venta_codigo_motivo_nota` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venta_estado_sunat` tinyint(4) NOT NULL DEFAULT '0',
  `venta_fecha_envio` datetime DEFAULT NULL,
  `venta_rutaXML` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venta_rutaCDR` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venta_respuesta_sunat` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venta_fecha_de_baja` date DEFAULT NULL,
  `anulado_sunat` tinyint(4) NOT NULL DEFAULT '0',
  `venta_cancelar` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_empresa`, `id_usuario`, `id_cliente`, `id_turno`, `id_tipo_pago`, `id_moneda`, `venta_condicion_resumen`, `venta_tipo_envio`, `venta_direccion`, `venta_tipo`, `venta_serie`, `venta_correlativo`, `venta_descuento_global`, `venta_totalgratuita`, `venta_totalexonerada`, `venta_totalinafecta`, `venta_totalgravada`, `venta_totaligv`, `venta_incluye_igv`, `venta_totaldescuento`, `venta_icbper`, `venta_total`, `venta_pago_cliente`, `venta_vuelto`, `venta_fecha`, `venta_observacion`, `tipo_documento_modificar`, `serie_modificar`, `correlativo_modificar`, `venta_codigo_motivo_nota`, `venta_estado_sunat`, `venta_fecha_envio`, `venta_rutaXML`, `venta_rutaCDR`, `venta_respuesta_sunat`, `venta_fecha_de_baja`, `anulado_sunat`, `venta_cancelar`) VALUES
(1, 1, 2, 2, 1, 3, 1, 1, 1, NULL, '01', 'F001', '1', '0.00', '0.00', '500.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '500.00', '0.00', '0.00', '2022-04-07 21:46:03', NULL, '', '', '', '', 1, '2022-04-10 11:23:34', 'libs/ApiFacturacion/xml/10711949611-01-F001-1.XML', 'libs/ApiFacturacion/cdr/R-10711949611-01-F001-1.XML', 'La Factura numero F001-1, ha sido aceptada', NULL, 0, 1),
(2, 1, 2, 2, 1, 3, 1, 1, 1, NULL, '01', 'F001', '2', '0.00', '0.00', '500.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '500.00', '0.00', '0.00', '2022-04-10 11:22:52', NULL, '', '', '', '', 1, '2022-04-10 11:24:56', 'libs/ApiFacturacion/xml/10711949611-01-F001-2.XML', 'libs/ApiFacturacion/cdr/R-10711949611-01-F001-2.XML', 'La Factura numero F001-2, ha sido aceptada', NULL, 0, 1),
(3, 1, 2, 3, 1, 3, 1, 1, 1, NULL, '01', 'F001', '3', '0.00', '0.00', '7070.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '7070.00', '0.00', '0.00', '2022-04-18 09:40:07', NULL, '', '', '', '', 1, '2022-04-20 12:38:41', 'libs/ApiFacturacion/xml/10711949611-01-F001-3.XML', 'libs/ApiFacturacion/cdr/R-10711949611-01-F001-3.XML', 'La Factura numero F001-3, ha sido aceptada', NULL, 0, 1),
(4, 1, 2, 4, 1, 3, 1, 1, 1, NULL, '01', 'F001', '4', '0.00', '0.00', '2050.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '2050.00', '0.00', '0.00', '2022-04-20 13:02:54', NULL, '', '', '', '', 1, '2022-04-20 13:03:57', 'libs/ApiFacturacion/xml/10711949611-01-F001-4.XML', 'libs/ApiFacturacion/cdr/R-10711949611-01-F001-4.XML', 'La Factura numero F001-4, ha sido aceptada', NULL, 0, 1),
(5, 1, 2, 3, 1, 3, 1, 1, 1, NULL, '01', 'F001', '5', '0.00', '0.00', '1365.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '1365.00', '0.00', '0.00', '2022-04-20 13:24:12', NULL, '', '', '', '', 1, '2022-04-21 08:44:01', 'libs/ApiFacturacion/xml/10711949611-01-F001-5.XML', 'libs/ApiFacturacion/cdr/R-10711949611-01-F001-5.XML', 'La Factura numero F001-5, ha sido aceptada', NULL, 0, 1),
(6, 1, 2, 3, 1, 3, 1, 1, 1, NULL, '01', 'F001', '6', '0.00', '0.00', '500.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '500.00', '0.00', '0.00', '2022-04-22 13:52:48', NULL, '', '', '', '', 1, '2022-04-22 13:53:43', 'libs/ApiFacturacion/xml/10711949611-01-F001-6.XML', 'libs/ApiFacturacion/cdr/R-10711949611-01-F001-6.XML', 'La Factura numero F001-6, ha sido aceptada', NULL, 0, 1),
(7, 1, 2, 5, 1, 3, 1, 1, 1, NULL, '01', 'F001', '7', '0.00', '0.00', '90.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '90.00', '0.00', '0.00', '2022-05-04 11:53:01', NULL, '', '', '', '', 1, '2022-05-04 12:45:21', 'libs/ApiFacturacion/xml/10711949611-01-F001-7.XML', 'libs/ApiFacturacion/cdr/R-10711949611-01-F001-7.XML', 'La Factura numero F001-7, ha sido aceptada', NULL, 0, 1),
(8, 1, 2, 6, 1, 3, 1, 1, 1, NULL, '01', 'F001', '8', '0.00', '0.00', '125.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '125.00', '0.00', '0.00', '2022-06-03 11:08:58', NULL, '', '', '', '', 1, '2022-06-03 11:18:37', 'libs/ApiFacturacion/xml/10711949611-01-F001-8.XML', 'libs/ApiFacturacion/cdr/R-10711949611-01-F001-8.XML', 'La Factura numero F001-8, ha sido aceptada', NULL, 0, 1),
(10, 1, 2, 7, 1, 3, 1, 1, 1, NULL, '01', 'F001', '9', '0.00', '0.00', '300.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '300.00', '0.00', '0.00', '2022-06-06 13:14:10', NULL, '', '', '', '', 1, '2022-06-06 13:27:20', 'libs/ApiFacturacion/xml/10711949611-01-F001-9.XML', 'libs/ApiFacturacion/cdr/R-10711949611-01-F001-9.XML', 'La Factura numero F001-9, ha sido aceptada', NULL, 0, 1),
(11, 1, 1, 1, 1, 3, 1, 1, 0, NULL, '03', 'B001', '1', '0.00', '0.00', '50.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '50.00', '0.00', '0.00', '2022-11-07 17:22:38', NULL, '', '', '', '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(12, 1, 1, 2, 1, 3, 1, 1, 0, NULL, '01', 'F001', '10', '0.00', '0.00', '7.10', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '7.10', '0.00', '0.00', '2022-11-07 17:59:49', NULL, '', '', '', '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(13, 1, 1, 2, 1, 3, 1, 1, 0, NULL, '01', 'F001', '11', '0.00', '0.00', '7.10', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '7.10', '0.00', '0.00', '2022-11-07 18:08:52', NULL, '', '', '', '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(14, 1, 1, 1, 1, 3, 1, 1, 0, NULL, '03', 'B001', '2', '0.00', '0.00', '5.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '5.00', '0.00', '0.00', '2022-11-07 18:35:52', NULL, '', '', '', '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_anulados`
--

CREATE TABLE `ventas_anulados` (
  `id_venta_anulado` int(11) NOT NULL,
  `venta_anulado_fecha` date NOT NULL,
  `venta_anulado_serie` varchar(20) NOT NULL,
  `venta_anulado_correlativo` int(11) NOT NULL,
  `venta_anulacion_ticket` varchar(100) NOT NULL,
  `venta_anulado_rutaXML` varchar(1000) NOT NULL,
  `venta_anulado_rutaCDR` varchar(1000) DEFAULT NULL,
  `venta_anulado_estado_sunat` varchar(1000) DEFAULT NULL,
  `id_venta` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `venta_anulado_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `venta_anulado_estado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id_venta_detalle` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto_precio` int(11) DEFAULT NULL,
  `venta_detalle_valor_unitario` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_detalle_precio_unitario` decimal(10,2) NOT NULL,
  `venta_detalle_nombre_producto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `venta_detalle_cantidad` double NOT NULL,
  `venta_detalle_total_igv` decimal(10,2) NOT NULL,
  `venta_detalle_porcentaje_igv` decimal(10,2) NOT NULL DEFAULT '0.18',
  `venta_detalle_valor_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_detalle_importe_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_detalle_descuento` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id_venta_detalle`, `id_venta`, `id_producto_precio`, `venta_detalle_valor_unitario`, `venta_detalle_precio_unitario`, `venta_detalle_nombre_producto`, `venta_detalle_cantidad`, `venta_detalle_total_igv`, `venta_detalle_porcentaje_igv`, `venta_detalle_valor_total`, `venta_detalle_importe_total`, `venta_detalle_descuento`) VALUES
(1, 1, 15, '2.50', '2.50', 'Persianas ', 200, '0.00', '0.00', '500.00', '500.00', '0.00'),
(2, 2, 15, '2.50', '2.50', 'Persianas ', 200, '0.00', '0.00', '500.00', '500.00', '0.00'),
(3, 3, 14, '27.30', '27.30', 'Bolsa de cemento', 80, '0.00', '0.00', '2184.00', '2184.00', '0.00'),
(4, 3, 21, '24.00', '24.00', 'Fierro Varilla 3/8', 35, '0.00', '0.00', '840.00', '840.00', '0.00'),
(5, 3, 22, '42.00', '42.00', 'Fierro Varilla 1/2', 20, '0.00', '0.00', '840.00', '840.00', '0.00'),
(6, 3, 23, '6.50', '6.50', 'Alambron ', 12, '0.00', '0.00', '78.00', '78.00', '0.00'),
(7, 3, 24, '7.00', '7.00', 'Alambre Quemado', 8, '0.00', '0.00', '56.00', '56.00', '0.00'),
(8, 3, 25, '8.00', '8.00', 'Clavo 3 pulgadas', 6, '0.00', '0.00', '48.00', '48.00', '0.00'),
(9, 3, 26, '8.00', '8.00', 'Clavo 4 pulgadas', 3, '0.00', '0.00', '24.00', '24.00', '0.00'),
(10, 3, 27, '500.00', '500.00', 'Arena Volquete 18 m3', 1, '0.00', '0.00', '500.00', '500.00', '0.00'),
(11, 3, 8, '2500.00', '2500.00', 'Bloquetas cemento 40x20x12 / Millar', 1, '0.00', '0.00', '2500.00', '2500.00', '0.00'),
(12, 4, 28, '27.00', '27.00', 'Bolsa de Cemento Apu', 50, '0.00', '0.00', '1350.00', '1350.00', '0.00'),
(13, 4, 14, '28.00', '28.00', 'Bolsa de cemento Andino', 25, '0.00', '0.00', '700.00', '700.00', '0.00'),
(14, 5, 28, '27.30', '27.30', 'Bolsa de Cemento Apu', 50, '0.00', '0.00', '1365.00', '1365.00', '0.00'),
(15, 6, 5, '2.50', '2.50', 'Bloquetas de cemento 40x20x12 unidad', 200, '0.00', '0.00', '500.00', '500.00', '0.00'),
(16, 7, 29, '2.50', '2.50', 'ORNAMENTALES ', 36, '0.00', '0.00', '90.00', '90.00', '0.00'),
(17, 8, 29, '2.50', '2.50', 'ORNAMENTALES ', 50, '0.00', '0.00', '125.00', '125.00', '0.00'),
(19, 10, 29, '2.50', '2.50', 'ORNAMENTALES ', 120, '0.00', '0.00', '300.00', '300.00', '0.00'),
(20, 11, 29, '2.50', '2.50', 'ORNAMENTALES ', 20, '0.00', '0.00', '50.00', '50.00', '0.00'),
(21, 12, 3, '2.20', '2.20', 'Adoquines de alto transito 20x10x8', 1, '0.00', '0.00', '2.20', '2.20', '0.00'),
(22, 12, 4, '2.40', '2.40', 'Bloquetas de Cemento 40x20x10 unidad', 1, '0.00', '0.00', '2.40', '2.40', '0.00'),
(23, 12, 5, '2.50', '2.50', 'Bloquetas de cemento 40x20x12 unidad', 1, '0.00', '0.00', '2.50', '2.50', '0.00'),
(24, 13, 5, '2.50', '2.50', 'Bloquetas de cemento 40x20x12 unidad', 1, '0.00', '0.00', '2.50', '2.50', '0.00'),
(25, 13, 4, '2.40', '2.40', 'Bloquetas de Cemento 40x20x10 unidad', 1, '0.00', '0.00', '2.40', '2.40', '0.00'),
(26, 13, 3, '2.20', '2.20', 'Adoquines de alto transito 20x10x8', 1, '0.00', '0.00', '2.20', '2.20', '0.00'),
(27, 14, 30, '5.00', '5.00', 'PRODUCTO NUEVO AGREGADO', 1, '0.00', '0.00', '5.00', '5.00', '0.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`),
  ADD KEY `id_caja_numero` (`id_caja_numero`);

--
-- Indices de la tabla `caja_numero`
--
ALTER TABLE `caja_numero`
  ADD PRIMARY KEY (`id_caja_numero`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD PRIMARY KEY (`id_comprobante`);

--
-- Indices de la tabla `correlativos`
--
ALTER TABLE `correlativos`
  ADD PRIMARY KEY (`id_correlativo`);

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id_egreso`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `envio_resumen`
--
ALTER TABLE `envio_resumen`
  ADD PRIMARY KEY (`id_envio_resumen`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `envio_resumen_detalle`
--
ALTER TABLE `envio_resumen_detalle`
  ADD PRIMARY KEY (`id_envio_resumen_detalle`),
  ADD KEY `id_envio_resumen` (`id_envio_resumen`);

--
-- Indices de la tabla `igv`
--
ALTER TABLE `igv`
  ADD PRIMARY KEY (`id_igv`);

--
-- Indices de la tabla `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`id_medida`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id_moneda`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id_opcion`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `producto_precio`
--
ALTER TABLE `producto_precio`
  ADD PRIMARY KEY (`id_producto_precio`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `producto_venta`
--
ALTER TABLE `producto_venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_moneda` (`id_moneda`);

--
-- Indices de la tabla `proformas`
--
ALTER TABLE `proformas`
  ADD PRIMARY KEY (`id_proforma`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `proforma_detalle`
--
ALTER TABLE `proforma_detalle`
  ADD PRIMARY KEY (`id_proforma_detalle`),
  ADD KEY `id_producto_precio` (`id_producto_precio`),
  ADD KEY `id_proforma` (`id_proforma`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `restricciones`
--
ALTER TABLE `restricciones`
  ADD PRIMARY KEY (`id_restriccion`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_opcion` (`id_opcion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `roles_menus`
--
ALTER TABLE `roles_menus`
  ADD PRIMARY KEY (`id_rol_menu`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`id_serie`) USING BTREE;

--
-- Indices de la tabla `startproduct`
--
ALTER TABLE `startproduct`
  ADD PRIMARY KEY (`id_startproduct`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `stocklog`
--
ALTER TABLE `stocklog`
  ADD PRIMARY KEY (`id_stocklog`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `stockout`
--
ALTER TABLE `stockout`
  ADD PRIMARY KEY (`id_stockout`);

--
-- Indices de la tabla `tipo_afectacion`
--
ALTER TABLE `tipo_afectacion`
  ADD PRIMARY KEY (`id_tipo_afectacion`);

--
-- Indices de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  ADD PRIMARY KEY (`id_tipodocumento`);

--
-- Indices de la tabla `tipo_ncreditos`
--
ALTER TABLE `tipo_ncreditos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_ndebitos`
--
ALTER TABLE `tipo_ndebitos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id_tipo_pago`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id_turno`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_moneda` (`id_moneda`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_tipo_pago` (`id_tipo_pago`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `ventas_anulados`
--
ALTER TABLE `ventas_anulados`
  ADD PRIMARY KEY (`id_venta_anulado`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id_venta_detalle`),
  ADD KEY `id_venta` (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `caja_numero`
--
ALTER TABLE `caja_numero`
  MODIFY `id_caja_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  MODIFY `id_comprobante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correlativos`
--
ALTER TABLE `correlativos`
  MODIFY `id_correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id_egreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `envio_resumen`
--
ALTER TABLE `envio_resumen`
  MODIFY `id_envio_resumen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envio_resumen_detalle`
--
ALTER TABLE `envio_resumen_detalle`
  MODIFY `id_envio_resumen_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `igv`
--
ALTER TABLE `igv`
  MODIFY `id_igv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `medida`
--
ALTER TABLE `medida`
  MODIFY `id_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id_opcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `producto_precio`
--
ALTER TABLE `producto_precio`
  MODIFY `id_producto_precio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `producto_venta`
--
ALTER TABLE `producto_venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `proformas`
--
ALTER TABLE `proformas`
  MODIFY `id_proforma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proforma_detalle`
--
ALTER TABLE `proforma_detalle`
  MODIFY `id_proforma_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `restricciones`
--
ALTER TABLE `restricciones`
  MODIFY `id_restriccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles_menus`
--
ALTER TABLE `roles_menus`
  MODIFY `id_rol_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `serie`
--
ALTER TABLE `serie`
  MODIFY `id_serie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `startproduct`
--
ALTER TABLE `startproduct`
  MODIFY `id_startproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `stocklog`
--
ALTER TABLE `stocklog`
  MODIFY `id_stocklog` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stockout`
--
ALTER TABLE `stockout`
  MODIFY `id_stockout` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  MODIFY `id_tipodocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_ncreditos`
--
ALTER TABLE `tipo_ncreditos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipo_ndebitos`
--
ALTER TABLE `tipo_ndebitos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `id_tipo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `ventas_anulados`
--
ALTER TABLE `ventas_anulados`
  MODIFY `id_venta_anulado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id_venta_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`id_caja_numero`) REFERENCES `caja_numero` (`id_caja_numero`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `producto_precio`
--
ALTER TABLE `producto_precio`
  ADD CONSTRAINT `producto_precio_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `producto_precio_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `producto_venta`
--
ALTER TABLE `producto_venta`
  ADD CONSTRAINT `producto_venta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `producto_venta_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `producto_venta_ibfk_3` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id_moneda`);

--
-- Filtros para la tabla `proformas`
--
ALTER TABLE `proformas`
  ADD CONSTRAINT `proformas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `proformas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `proforma_detalle`
--
ALTER TABLE `proforma_detalle`
  ADD CONSTRAINT `proforma_detalle_ibfk_2` FOREIGN KEY (`id_producto_precio`) REFERENCES `producto_precio` (`id_producto_precio`),
  ADD CONSTRAINT `proforma_detalle_ibfk_3` FOREIGN KEY (`id_proforma`) REFERENCES `proformas` (`id_proforma`);

--
-- Filtros para la tabla `restricciones`
--
ALTER TABLE `restricciones`
  ADD CONSTRAINT `restricciones_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `restricciones_ibfk_2` FOREIGN KEY (`id_opcion`) REFERENCES `opciones` (`id_opcion`);

--
-- Filtros para la tabla `roles_menus`
--
ALTER TABLE `roles_menus`
  ADD CONSTRAINT `roles_menus_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `roles_menus_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id_menu`);

--
-- Filtros para la tabla `startproduct`
--
ALTER TABLE `startproduct`
  ADD CONSTRAINT `startproduct_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `stocklog`
--
ALTER TABLE `stocklog`
  ADD CONSTRAINT `stocklog_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`),
  ADD CONSTRAINT `stocklog_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

--
-- Filtros para la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
