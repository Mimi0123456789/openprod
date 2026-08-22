-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2026 at 07:37 PM
-- Server version: 8.4.3
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `openprod`
--

-- --------------------------------------------------------

--
-- Table structure for table `avancements`
--

CREATE TABLE `avancements` (
  `ID` int NOT NULL,
  `libelle_avance` varchar(100) NOT NULL,
  `prcent` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `avancements`
--

INSERT INTO `avancements` (`ID`, `libelle_avance`, `prcent`) VALUES
(1, 'PRIS EN CHARGE', '12.5%'),
(2, 'ÉTUDE EN COURS', '25%'),
(3, 'ATTENTE DE FOURNITURES', '37.5%'),
(4, 'RÉALISATION EN ATELIER', '50%'),
(5, 'LIVRAISON EN COURS', '62.5%'),
(6, 'INTALLATION EN COURS', '75%'),
(7, 'TERMINÉ', '87.5%'),
(8, 'CLÔTURÉ', '100%');

-- --------------------------------------------------------

--
-- Table structure for table `av_technique`
--

CREATE TABLE `av_technique` (
  `id` int NOT NULL,
  `libelle_av_tech` varchar(32) NOT NULL,
  `libelle_av_tech_lg` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `av_technique`
--

INSERT INTO `av_technique` (`id`, `libelle_av_tech`, `libelle_av_tech_lg`) VALUES
(1, 'NON COMMENCÉ', 'NON COMMENCÉ'),
(2, 'EN COURS', 'EN COURS'),
(3, 'TERMINÉ', 'TERMINÉ');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `c_postal` varchar(32) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `num_tel` varchar(32) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `representant` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `adresse`, `c_postal`, `ville`, `num_tel`, `mail`, `representant`) VALUES
(1, 'EPA', '26 route de Genève', '01700', 'neyron', '0478550099', 'com@epa.fr', 'M.SEYMARC'),
(2, 'MECALYS', '26 route de geneve', '01700', 'Neyron', '0478550099', 'com@epa.fr', 'M. SEYMARC'),
(3, 'MECA 3D', '745 rue Edouard Daladier', '84200', 'CARPENTRAS', '04 32 40 98 25', 'contact@meca3d84.fr', 'M. XXXXX'),
(5, 'SEPAL FAIVELEY GROUPE', 'ROUTE DE ST JEAN DE BOURNAY', '38300', 'BOURGOIN JALLIEU CEDEX', '04 74 28 24 22', 'mecanique.maubec@sepal-faiveley.fr', 'M. XXXXX'),
(6, 'ARAYMOND FLUID CONNECTION', '123 rue Hilaire de CHARDONNET-QUAI L', '38100', 'GRENOBLE', '04.57.38.12.74', '', 'M. XXXXX'),
(7, 'TOP INDUSTRIES', '7 Rue de NANCY', '68220', 'HESINGUE', '0389709555', 'h.yildiz@euro-production.fr', 'M. XXXXX'),
(8, 'SYMATHESE DEVICE ', '135 ROUTE NEUVE', '69540', 'IRIGNY', '04 72 39 74 14', 'joseph.sottile@gmail.com', 'M. XXXXX'),
(9, 'MECANO TECHNIQUE', 'ZI EST 29, rue louis Saillant', '69120', 'VAUX EN VELIN', '0478794158', 'L.Solignac@mecano-technique.com', 'Philippe Seymarc'),
(10, 'ITRON', '15, Avenue du MARECHAL JUIN', '91301 ', 'MASSY', '0180001518', 'dominique.bertaux@itron.com', 'Philippe Seymarc'),
(11, 'EFI', '77 ALLEE DES GRANDES COMBES ZI OUEST', '01700', 'BEYNOST', '0472013574', 'gilles.mellet@efiautomotive.com', 'Philippe Seymarc'),
(12, 'HERDEGEN', '7 RUE EUGENE FREYSSINET', '77500', 'CHELLES', '0784265541', 'alexandreherdegen@herdegen.fr', 'Philippe Seymarc'),
(13, 'VALEO SYSTEMES THERMIQUES', '130 Route de MAYENNE', '53022', 'LAVAL', '0243494038', 'yoann.huchede@valeo.com', 'Philippe Seymarc'),
(14, 'AKWEL SA (MGI CHAMPFROMIER)', '975 rte Burgondes', '01410', 'CHAMPFROMIER', '0699795736', 'alain.generenaz@mgicoutier.fr', 'Philippe Seymarc'),
(15, 'SAVOY INTERNATIONAL', '52 Rue Guillaume Fichet', '74300', 'CLUSES', '0770191474', 'ceischen@savoy-moulage.com', 'Philippe Seymarc'),
(16, 'RABOURDIN ACI', '4 Avenue GUTENBERG', '77600', 'BUSSY SAINT GEORGES', '0164764101', 'nicolas.cayla@rabourdin.fr', 'Philippe Seymarc'),
(17, 'SOCMA', 'ZA du CASTELLAS 599 AV COL DE CHEVRE', '11100', 'MONTREDON DES CORBIERES', '0468415030', 'socma@wanadoo.fr', 'Philippe Seymarc'),
(18, 'LEMAN INDUSTRIE SA', '241 RUE DE PRECISION LD LES PRES DE LALAIS', '74970', 'MARIGNIER', '0450340862', '', 'Philippe Seymarc'),
(19, 'SALVIO SYSTEMS S.L.U', 'P. ind.CAMI DEL MIG 62-64 C/D NAU 15B', '08349', 'CABRERA DE MARC', ' +34 696737710', 'mario@salviosystems.com', 'Philippe Seymarc'),
(20, 'HERTUS INDUSTRIES', 'ZAC des montagnes Ouest', '16430', 'CHAMPNIERS', '0545659298', '', 'Philippe Seymarc'),
(21, 'TMP CONVERT', '546 Route de BOURG', '01250', 'SIMANDRE SUR SURAN ', '0474258484', 'isidore.garcia@tmpconvert.com', 'Philippe Seymarc'),
(22, 'LVP (LA VENDEENNE DES PLASTIQUES)', 'ZA Route dePAREDS', '85110', 'LA JAUDONNERIE', '0251343347', 'd.caquelin@lfp-sa.com', 'Philippe Seymarc'),
(23, 'STEEP PLASTIQUES', '3 CHEMIN PILON LIEU DIT \"LES COMBES\"', '01700', 'ST MAURICE DE BEYNOST CEDEX', '04 72 88 10 80', 'eric.dessalles@steep-plastique.com', 'seymarc'),
(24, 'BAILLY COMTE ITW', '239 RUE JACQUARD', '69730', 'GENAY', ' 04 78 98 69 69', 'c.lombard@itwbailly-comte.fr', 'Philippe Seymarc'),
(25, 'PLASTIVALOIRE72', 'Site de SABLE-ZA le pont 17-19 rue st Blaise', '72300', 'SABLE SUR SARTHE', '33 (0)6 85 94 71 23', 'thierry.danilo@plastivaloire.com', 'Philippe Seymarc'),
(29, 'SOCMA', 'ZA DU CASTELLAS 599 AV COL DE CHEVRE', '11100', 'MONTREDON DES CORBIERES', '0468415030', 'socma@wanadoo.fr', 'PHILIPPE SEYMARC'),
(39, 'SIPLAST INJECTION PLASTIQUE', '1086 AVENUE RENé DESCARTES', '43700', 'SAINT GERMAIN LAPRADE', '04 71 03 51 23', 'info@siplastfr.com', 'M. XXXXX');

-- --------------------------------------------------------

--
-- Table structure for table `etat_init`
--

CREATE TABLE `etat_init` (
  `id` int NOT NULL,
  `id_inter` int NOT NULL,
  `eg_propre` varchar(255) DEFAULT NULL,
  `eg_ancien` varchar(255) DEFAULT NULL,
  `eg_etatgene` varchar(255) DEFAULT NULL,
  `eg_aspectgene` varchar(255) DEFAULT NULL,
  `eg_aspectdesc` text,
  `eg_rouille` varchar(255) DEFAULT NULL,
  `eg_demontage` varchar(255) DEFAULT NULL,
  `eg_fuite_mat` varchar(255) DEFAULT NULL,
  `eg_avis_etatgene` text,
  `mec_etatgene` varchar(255) DEFAULT NULL,
  `mec_eta_entre_mat` varchar(255) DEFAULT NULL,
  `mec_eta_entre_mat_pre` varchar(255) DEFAULT NULL,
  `mec_eta_sorti_mat` varchar(255) DEFAULT NULL,
  `mec_eta_sorti_mat_pre` varchar(255) DEFAULT NULL,
  `mec_huile_fuit` varchar(255) DEFAULT NULL,
  `mec_avis_tech` text,
  `ele_etatgene` varchar(255) DEFAULT NULL,
  `ele_etatcable` varchar(255) DEFAULT NULL,
  `ele_etatprotec` varchar(255) DEFAULT NULL,
  `ele_avis_tech` text,
  `ele_resis_hs` int DEFAULT '0',
  `ele_sonde_hs` int DEFAULT '0',
  `th_etatgene` varchar(255) DEFAULT NULL,
  `th_stable` varchar(255) DEFAULT NULL,
  `th_inerti` varchar(32) DEFAULT NULL,
  `th_test` varchar(255) DEFAULT NULL,
  `th_temp_test` int DEFAULT NULL,
  `th_pilotage` varchar(255) DEFAULT NULL,
  `th_avis_therm` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `etat_init`
--

INSERT INTO `etat_init` (`id`, `id_inter`, `eg_propre`, `eg_ancien`, `eg_etatgene`, `eg_aspectgene`, `eg_aspectdesc`, `eg_rouille`, `eg_demontage`, `eg_fuite_mat`, `eg_avis_etatgene`, `mec_etatgene`, `mec_eta_entre_mat`, `mec_eta_entre_mat_pre`, `mec_eta_sorti_mat`, `mec_eta_sorti_mat_pre`, `mec_huile_fuit`, `mec_avis_tech`, `ele_etatgene`, `ele_etatcable`, `ele_etatprotec`, `ele_avis_tech`, `ele_resis_hs`, `ele_sonde_hs`, `th_etatgene`, `th_stable`, `th_inerti`, `th_test`, `th_temp_test`, `th_pilotage`, `th_avis_therm`) VALUES
(1, 1, 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Aspect satisfaisant.', 'AUCUNE', 'INCORRECT', 'INCORRECT', 'Bon état général.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Mécanique conforme.', 'CORRECT', 'CORRECT', 'CORRECT', 'Aucune anomalie.', 0, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 280, 'VALIDÉ', 'Essais conformes.'),
(2, 2, 'A REVOIR', 'CORRECT', 'A REVOIR', 'CHOC(S)', 'Impact léger sur la face avant.', 'PARTIELLE', 'PARTIEL', 'PARTIELLE', 'Usure modérée.', 'A REVOIR', 'CORRECT', 'INCORRECT', 'A REVOIR', 'CORRECT', 'INCORRECT', 'Joint à remplacer.', 'CORRECT', 'A REVOIR', 'CORRECT', 'Quelques câbles usés.', 1, 0, 'A REVOIR', 'VALIDÉ', 'A REVOIR', 'VALIDÉ', 260, 'VALIDÉ', 'Température stable.'),
(3, 3, 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', '', 'AUCUNE', 'INCORRECT', 'INCORRECT', 'RAS.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Aucune remarque.', 'CORRECT', 'CORRECT', 'CORRECT', 'Conforme.', 0, 1, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 290, 'VALIDÉ', 'Essais OK.'),
(4, 4, 'A REVOIR', 'A REVOIR', 'A REVOIR', 'FISSURE(S)', 'Microfissure détectée.', 'PARTIELLE', 'TOTAL', 'PARTIELLE', 'Réparation conseillée.', 'A REVOIR', 'A REVOIR', 'INCORRECT', 'A REVOIR', 'INCORRECT', 'INCORRECT', 'Jeu mécanique important.', 'A REVOIR', 'A REVOIR', 'CORRECT', 'Remplacement d\'une résistance.', 2, 1, 'A REVOIR', 'A REVOIR', 'A REVOIR', 'VALIDÉ', 250, 'A REVOIR', 'Montée lente en température.'),
(5, 5, 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', '', 'AUCUNE', 'INCORRECT', 'INCORRECT', 'Très bon état.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Conforme.', 'CORRECT', 'CORRECT', 'CORRECT', 'Conforme.', 0, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 300, 'VALIDÉ', 'Aucun défaut.'),
(6, 6, 'CORRECT', 'A REVOIR', 'CORRECT', 'CHOC(S)', 'Chocs superficiels.', 'PARTIELLE', 'PARTIEL', 'INCORRECT', 'Surveillance recommandée.', 'CORRECT', 'A REVOIR', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Fonctionnement correct.', 'A REVOIR', 'CORRECT', 'A REVOIR', 'Protection usée.', 1, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 275, 'VALIDÉ', 'Essai concluant.'),
(7, 7, 'A REVOIR', 'CORRECT', 'A REVOIR', 'CHOC(S)', 'Rayures importantes.', 'PARTIELLE', 'PARTIEL', 'PARTIELLE', 'Usure visible.', 'A REVOIR', 'CORRECT', 'CORRECT', 'A REVOIR', 'CORRECT', 'CORRECT', 'Prévoir entretien.', 'CORRECT', 'A REVOIR', 'CORRECT', 'Contrôle conseillé.', 0, 2, 'A REVOIR', 'A REVOIR', 'VALIDÉ', 'A REVOIR', 240, 'A REVOIR', 'Inertie élevée.'),
(8, 8, 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', '', 'AUCUNE', 'INCORRECT', 'INCORRECT', 'RAS.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'RAS.', 'CORRECT', 'CORRECT', 'CORRECT', 'RAS.', 0, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 310, 'VALIDÉ', 'Excellent fonctionnement.'),
(9, 9, 'A REVOIR', 'A REVOIR', 'A REVOIR', 'FISSURE(S)', 'Déformation constatée.', 'TOTALE', 'TOTAL', 'TOTALE', 'Révision complète nécessaire.', 'A REVOIR', 'A REVOIR', 'INCORRECT', 'A REVOIR', 'INCORRECT', 'INCORRECT', 'Usure importante.', 'A REVOIR', 'A REVOIR', 'A REVOIR', 'Isolation dégradée.', 3, 2, 'A REVOIR', 'NON RÉALISÉ', 'NON RÉALISÉ', 'NON RÉALISÉ', 0, 'NON RÉALISÉ', 'Essais impossibles.'),
(10, 10, 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', '', 'AUCUNE', 'INCORRECT', 'INCORRECT', 'Bon état.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'RAS.', 'CORRECT', 'CORRECT', 'CORRECT', 'RAS.', 0, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 295, 'VALIDÉ', 'Conforme.'),
(11, 11, 'CORRECT', 'A REVOIR', 'CORRECT', 'CHOC(S)', 'Petit impact.', 'PARTIELLE', 'INCORRECT', 'INCORRECT', 'Aspect acceptable.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Bon fonctionnement.', 'CORRECT', 'CORRECT', 'CORRECT', 'Conforme.', 1, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 285, 'VALIDÉ', 'Aucun défaut.'),
(12, 12, 'A REVOIR', 'CORRECT', 'CORRECT', 'CORRECT', '', 'AUCUNE', 'PARTIEL', 'INCORRECT', 'Nettoyage recommandé.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Prévoir maintenance.', 'A REVOIR', 'CORRECT', 'CORRECT', 'Connecteur à contrôler.', 1, 1, 'CORRECT', 'VALIDÉ', 'A REVOIR', 'VALIDÉ', 265, 'VALIDÉ', 'Essai satisfaisant.'),
(13, 13, 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', '', 'AUCUNE', 'INCORRECT', 'INCORRECT', 'RAS.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'RAS.', 'CORRECT', 'CORRECT', 'CORRECT', 'RAS.', 0, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 300, 'VALIDÉ', 'Conforme.'),
(14, 14, 'A REVOIR', 'A REVOIR', 'A REVOIR', 'CHOC(S)', 'Nombreux impacts.', 'PARTIELLE', 'PARTIEL', 'PARTIELLE', 'Surveillance nécessaire.', 'A REVOIR', 'A REVOIR', 'INCORRECT', 'A REVOIR', 'INCORRECT', 'CORRECT', 'Graissage conseillé.', 'A REVOIR', 'A REVOIR', 'CORRECT', 'Protection fissurée.', 2, 1, 'A REVOIR', 'A REVOIR', 'A REVOIR', 'VALIDÉ', 255, 'A REVOIR', 'Montée difficile.'),
(15, 15, 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', '', 'AUCUNE', 'INCORRECT', 'INCORRECT', 'Excellent état.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Aucun défaut.', 'CORRECT', 'CORRECT', 'CORRECT', 'Conforme.', 0, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 305, 'VALIDÉ', 'Très bon comportement.'),
(16, 16, 'CORRECT', 'CORRECT', 'A REVOIR', 'CHOC(S)', 'Choc léger.', 'PARTIELLE', 'PARTIEL', 'INCORRECT', 'À surveiller.', 'A REVOIR', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Jeu acceptable.', 'CORRECT', 'A REVOIR', 'CORRECT', 'Câble légèrement abîmé.', 0, 1, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 280, 'VALIDÉ', 'RAS.'),
(17, 17, 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', '', 'AUCUNE', 'INCORRECT', 'INCORRECT', 'Bon état général.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'RAS.', 'CORRECT', 'CORRECT', 'CORRECT', 'RAS.', 0, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 290, 'VALIDÉ', 'Essais conformes.'),
(18, 18, 'A REVOIR', 'CORRECT', 'A REVOIR', 'FISSURE(S)', 'Fissure sur capot.', 'PARTIELLE', 'TOTAL', 'PARTIELLE', 'Réparation à prévoir.', 'A REVOIR', 'A REVOIR', 'INCORRECT', 'A REVOIR', 'CORRECT', 'INCORRECT', 'Contrôle mécanique requis.', 'A REVOIR', 'A REVOIR', 'A REVOIR', 'Isolation insuffisante.', 2, 2, 'A REVOIR', 'A REVOIR', 'NON RÉALISÉ', 'A REVOIR', 235, 'A REVOIR', 'Essais interrompus.'),
(19, 19, 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', '', 'AUCUNE', 'INCORRECT', 'INCORRECT', 'RAS.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Aucun défaut.', 'CORRECT', 'CORRECT', 'CORRECT', 'RAS.', 0, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 295, 'VALIDÉ', 'Fonctionnement nominal.'),
(20, 20, 'CORRECT', 'A REVOIR', 'CORRECT', 'CHOC(S)', 'Traces d\'utilisation normales.', 'PARTIELLE', 'INCORRECT', 'INCORRECT', 'Bon état malgré l\'usure.', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'CORRECT', 'Prévoir entretien préventif.', 'CORRECT', 'CORRECT', 'CORRECT', 'Conforme.', 1, 0, 'CORRECT', 'VALIDÉ', 'VALIDÉ', 'VALIDÉ', 0, 'VALIDÉ', 'Aucun défaut thermique.'),
(2501, 2515, 'A REVOIR', 'A REVOIR', 'A REVOIR', 'CHOC(S)', '', 'PARTIELLE', 'PARTIEL', 'PARTIELLE', '', 'A REVOIR', 'A REVOIR', 'CORRECT', 'A REVOIR', 'CORRECT', 'CORRECT', '', 'A REVOIR', 'A REVOIR', 'A REVOIR', '', 0, 1, 'CORRECT', 'NON RÉALISÉ', 'VALIDÉ', 'NON RÉALISÉ', 0, 'NON RÉALISÉ', '');

-- --------------------------------------------------------

--
-- Table structure for table `fonctions`
--

CREATE TABLE `fonctions` (
  `ID` int NOT NULL,
  `libelle_fct` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `fonctions`
--

INSERT INTO `fonctions` (`ID`, `libelle_fct`) VALUES
(1, 'DIRECTION'),
(2, 'COMMERCIAL'),
(3, 'ATELIER'),
(4, 'BUREAU ETUDE'),
(5, 'SAV'),
(6, 'ADMINISTRATEUR');

-- --------------------------------------------------------

--
-- Table structure for table `f_inter`
--

CREATE TABLE `f_inter` (
  `id` int NOT NULL,
  `id_clients` int NOT NULL,
  `id_responsable` int NOT NULL,
  `id_priorite` int NOT NULL,
  `date_crea` date DEFAULT NULL,
  `facturation` varchar(32) DEFAULT NULL,
  `date_max` date DEFAULT NULL,
  `id_avancements` int NOT NULL,
  `visa_intervenant` text,
  `demande` text,
  `lieu` varchar(16) DEFAULT NULL,
  `num_devis` varchar(32) DEFAULT NULL,
  `anomalie` text,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `id_intervenant` int NOT NULL,
  `desc_travaux` text,
  `conclu` text,
  `duree_init` int DEFAULT NULL,
  `duree_trav` int DEFAULT NULL,
  `duree_cont` int DEFAULT NULL,
  `visa_client` varchar(13) NOT NULL DEFAULT 'vise',
  `comm_client` text,
  `comm_inter` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `f_inter`
--

INSERT INTO `f_inter` (`id`, `id_clients`, `id_responsable`, `id_priorite`, `date_crea`, `facturation`, `date_max`, `id_avancements`, `visa_intervenant`, `demande`, `lieu`, `num_devis`, `anomalie`, `date_debut`, `date_fin`, `id_intervenant`, `desc_travaux`, `conclu`, `duree_init`, `duree_trav`, `duree_cont`, `visa_client`, `comm_client`, `comm_inter`) VALUES
(1, 12, 4, 3, '2026-01-03', 'SOUS CONTRAT', '2026-01-10', 5, 'J. MARTIN', 'EXPERTISE', 'SITE CLIENT', 'DV260001', 'Fuite sur raccord hydraulique', '2026-01-04', '2026-01-06', 9, 'Remplacement du raccord et essais.', 'Intervention conforme.', 35, 120, 45, 'M. DUPONT', 'RAS.', 'Matériel remis en service.'),
(2, 8, 1, 5, '2026-01-05', 'AVEC FACTURE', '2026-01-12', 3, 'P. DURAND', 'CONFIRMEE', 'SITE MECALYS', 'DV260002', 'Panne électrique intermittente', '2026-01-06', '2026-01-08', 4, 'Recherche de panne et remplacement relais.', 'Fonctionnement nominal.', 40, 180, 60, 'S. BERNARD', 'Très satisfait.', 'Essais validés.'),
(3, 27, 10, 2, '2026-01-08', 'SANS FACTURE', '2026-01-18', 2, 'L. PETIT', 'EXPERTISE', 'SITE CLIENT', 'DV260003', 'Usure prématurée des joints', '2026-01-09', '2026-01-11', 8, 'Contrôle des étanchéités.', 'Préconisation remplacement.', 30, 95, 30, 'A. MOREAU', 'En attente devis.', 'Diagnostic transmis.'),
(4, 5, 11, 6, '2026-01-10', 'SOUS CONTRAT', '2026-01-20', 7, 'N. ROBERT', 'CONFIRMEE', 'SITE MECALYS', 'DV260004', 'Température excessive', '2026-01-11', '2026-01-15', 11, 'Remplacement ventilateur.', 'Température stabilisée.', 45, 220, 50, 'C. GARNIER', 'OK.', 'Essais thermiques réalisés.'),
(5, 34, 8, 1, '2026-01-12', 'AVEC FACTURE', '2026-01-22', 8, 'D. ROUX', 'EXPERTISE', 'SITE CLIENT', 'DV260005', 'Vibration importante', '2026-01-13', '2026-01-14', 1, 'Équilibrage mécanique.', 'Machine conforme.', 25, 110, 25, 'M. HENRY', 'Conforme.', 'RAS.'),
(6, 17, 9, 4, '2026-01-15', 'SOUS CONTRAT', '2026-01-24', 4, 'J. MARTIN', 'CONFIRMEE', 'SITE MECALYS', 'DV260006', 'Défaut de capteur', '2026-01-16', '2026-01-18', 10, 'Remplacement du capteur.', 'Incident résolu.', 35, 140, 40, 'L. GIRAUD', 'Merci.', 'Calibration effectuée.'),
(7, 22, 4, 7, '2026-01-18', 'SANS FACTURE', '2026-01-30', 1, 'P. DURAND', 'EXPERTISE', 'SITE CLIENT', 'DV260007', 'Corrosion externe', '2026-01-19', '2026-01-21', 4, 'Inspection complète.', 'Expertise réalisée.', 30, 80, 20, 'B. SIMON', 'Attente rapport.', 'Rapport envoyé.'),
(8, 3, 1, 2, '2026-01-22', 'AVEC FACTURE', '2026-01-31', 6, 'L. PETIT', 'CONFIRMEE', 'SITE MECALYS', 'DV260008', 'Bruit anormal moteur', '2026-01-23', '2026-01-26', 8, 'Remplacement roulements.', 'Essais concluants.', 40, 240, 60, 'D. THOMAS', 'RAS.', 'Machine conforme.'),
(9, 15, 10, 5, '2026-01-25', 'SOUS CONTRAT', '2026-02-02', 5, 'N. ROBERT', 'EXPERTISE', 'SITE CLIENT', 'DV260009', 'Perte de puissance', '2026-01-26', '2026-01-28', 9, 'Contrôle alimentation.', 'Cause identifiée.', 30, 90, 35, 'M. LEROY', 'Bien reçu.', 'Diagnostic validé.'),
(10, 31, 11, 3, '2026-01-29', 'AVEC FACTURE', '2026-02-08', 8, 'D. ROUX', 'CONFIRMEE', 'SITE MECALYS', 'DV260010', 'Fuite pneumatique', '2026-01-30', '2026-02-01', 11, 'Remplacement flexible.', 'Circuit étanche.', 25, 100, 30, 'C. DUPUIS', 'Parfait.', 'Essais OK.'),
(11, 2, 8, 4, '2026-02-02', 'SOUS CONTRAT', '2026-02-10', 2, 'J. MARTIN', 'EXPERTISE', 'SITE CLIENT', 'DV260011', 'Capot endommagé', '2026-02-03', '2026-02-04', 1, 'Inspection visuelle.', 'Prévoir remplacement.', 20, 45, 15, 'P. RENAUD', 'En attente.', 'Photos ajoutées.'),
(12, 19, 4, 6, '2026-02-05', 'AVEC FACTURE', '2026-02-14', 7, 'P. DURAND', 'CONFIRMEE', 'SITE MECALYS', 'DV260012', 'Carte électronique HS', '2026-02-06', '2026-02-09', 10, 'Remplacement carte.', 'Machine opérationnelle.', 45, 210, 55, 'A. BLANC', 'Merci.', 'Tests fonctionnels OK.'),
(13, 39, 9, 2, '2026-02-08', 'SOUS CONTRAT', '2026-02-16', 4, 'L. PETIT', 'EXPERTISE', 'SITE CLIENT', 'DV260013', 'Fuite huile', '2026-02-09', '2026-02-10', 9, 'Contrôle circuit.', 'Joint défectueux.', 30, 85, 20, 'F. MARTIN', 'Bon diagnostic.', 'Prévoir réparation.'),
(14, 25, 1, 7, '2026-02-10', 'SANS FACTURE', '2026-02-20', 1, 'N. ROBERT', 'CONFIRMEE', 'SITE MECALYS', 'DV260014', 'Défaut automate', '2026-02-11', '2026-02-13', 4, 'Reprogrammation automate.', 'Automate fonctionnel.', 35, 170, 45, 'J. SIMON', 'Conforme.', 'Programme sauvegardé.'),
(15, 6, 10, 5, '2026-02-12', 'AVEC FACTURE', '2026-02-22', 5, 'D. ROUX', 'EXPERTISE', 'SITE CLIENT', 'DV260015', 'Roulement usé', '2026-02-13', '2026-02-15', 8, 'Expertise mécanique.', 'Usure confirmée.', 30, 95, 30, 'M. COLIN', 'RAS.', 'Préconisations envoyées.'),
(16, 11, 11, 3, '2026-02-15', 'SOUS CONTRAT', '2026-02-24', 8, 'J. MARTIN', 'CONFIRMEE', 'SITE MECALYS', 'DV260016', 'Défaut isolation', '2026-02-16', '2026-02-18', 11, 'Remplacement câblage.', 'Isolation conforme.', 40, 180, 50, 'A. GILLET', 'Très bien.', 'Contrôle diélectrique OK.'),
(17, 14, 8, 1, '2026-02-18', 'AVEC FACTURE', '2026-02-28', 6, 'P. DURAND', 'EXPERTISE', 'SITE CLIENT', 'DV260017', 'Jeu mécanique', '2026-02-19', '2026-02-20', 10, 'Mesures dimensionnelles.', 'Tolérance dépassée.', 25, 70, 20, 'C. GARNIER', 'En attente devis.', 'Rapport transmis.'),
(18, 35, 4, 4, '2026-02-21', 'SOUS CONTRAT', '2026-03-03', 3, 'L. PETIT', 'CONFIRMEE', 'SITE MECALYS', 'DV260018', 'Ventilation insuffisante', '2026-02-22', '2026-02-25', 9, 'Nettoyage échangeur.', 'Débit conforme.', 35, 150, 40, 'L. ROUX', 'OK.', 'Maintenance réalisée.'),
(19, 1, 1, 6, '2026-02-24', 'AVEC FACTURE', '2026-03-05', 7, 'N. ROBERT', 'EXPERTISE', 'SITE CLIENT', 'DV260019', 'Défaut sonde', '2026-02-25', '2026-02-26', 8, 'Mesure résistance.', 'Sonde HS.', 25, 60, 15, 'B. HUGO', 'Merci.', 'Pièce commandée.'),
(20, 18, 10, 2, '2026-02-28', 'SANS FACTURE', '2026-03-08', 2, 'D. ROUX', 'CONFIRMEE', 'SITE MECALYS', 'DV260020', 'Pompe bloquée', '2026-03-01', '2026-03-03', 4, 'Réfection pompe.', 'Fonctionnement validé.', 45, 240, 55, 'P. THOMAS', 'Très satisfait.', 'Essais longue durée OK.'),
(2512, 3, 4, 2, '2026-07-01', 'Avec facture', '2026-07-08', 3, '', 'EXPERTISE', 'Site MECALYS', 'ded 1', '', '2026-07-02', '2026-07-03', 3, '', '', 3, 0, 0, 'vise', '', ''),
(2513, 12, 3, 1, '2026-07-01', 'Sous contrat', '2026-07-08', 1, '', 'EXPERTISE', 'Site MECALYS', '', '', '2026-07-04', '2026-07-04', 10, '', '', 2, 0, 0, 'vise', '', ''),
(2514, 24, 8, 1, '2026-07-01', 'Avec facture', '2026-07-08', 3, '', 'EXPERTISE', 'Site MECALYS', '', '', NULL, NULL, 11, '', '', 2, 0, 0, 'vise', '', ''),
(2515, 16, 10, 5, '2026-07-01', 'Sous contrat', '2026-07-08', 6, '', 'EXPERTISE', 'Site Client', 'DEV 1', '', '2026-07-06', '2026-07-07', 4, '', '', 2, 7, 2, 'vise', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `matieres`
--

CREATE TABLE `matieres` (
  `id` int NOT NULL,
  `libelle_mat` varchar(32) NOT NULL,
  `libelle_mat_lg` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `matieres`
--

INSERT INTO `matieres` (`id`, `libelle_mat`, `libelle_mat_lg`) VALUES
(3, 'PE', 'polyéthylène'),
(4, 'PP', 'polypropylène '),
(5, 'PS', 'polystyrène '),
(6, 'PC', 'polycarbonate  '),
(7, 'PET', 'polyéthylène téréphtalate '),
(8, 'PPM', 'polyoxyméthylène '),
(9, 'PVC', 'polychlorure de vinyle '),
(10, 'PA', 'polyamides'),
(11, 'PMMA', 'polyméthacrylate de méthyle'),
(12, 'PUR', 'polyuréthanes  '),
(13, 'PI', 'polyesters insaturés '),
(14, 'PF', 'phénoplastes '),
(15, 'MF', 'aminoplastes '),
(16, 'PEEK', 'Polyethercetonecetone');

-- --------------------------------------------------------

--
-- Table structure for table `obturateurs_init`
--

CREATE TABLE `obturateurs_init` (
  `id` int NOT NULL,
  `id_eta_init` int NOT NULL,
  `num_obtu` int NOT NULL,
  `jeu_obtu` tinyint(1) NOT NULL DEFAULT '0',
  `jeu_guide` tinyint(1) NOT NULL DEFAULT '0',
  `etat_obtu` varchar(32) DEFAULT NULL,
  `etat_guide` varchar(32) DEFAULT NULL,
  `attel_etat` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obturateurs_init`
--

INSERT INTO `obturateurs_init` (`id`, `id_eta_init`, `num_obtu`, `jeu_obtu`, `jeu_guide`, `etat_obtu`, `etat_guide`, `attel_etat`) VALUES
(53, 2500, 1, 1, 1, 'abime', 'abime', 'abime'),
(1, 1, 1, 1, 1, 'abime', 'correct', 'casse'),
(2, 1, 2, 1, 1, 'correct', 'casse', 'correct'),
(3, 1, 3, 1, 1, 'casse', 'correct', 'use'),
(4, 3, 1, 1, 1, 'casse', 'correct', 'use'),
(5, 3, 2, 0, 1, 'correct', 'use', 'abime'),
(6, 5, 1, 1, 0, 'use', 'abime', 'correct'),
(7, 5, 2, 1, 1, 'abime', 'correct', 'casse'),
(8, 5, 3, 1, 1, 'correct', 'casse', 'correct'),
(9, 5, 4, 1, 1, 'casse', 'correct', 'use'),
(10, 5, 5, 0, 1, 'correct', 'use', 'abime'),
(11, 6, 1, 1, 1, 'abime', 'correct', 'casse'),
(12, 6, 2, 1, 1, 'correct', 'casse', 'correct'),
(13, 6, 3, 1, 1, 'casse', 'correct', 'use'),
(14, 6, 4, 0, 1, 'correct', 'use', 'abime'),
(15, 8, 1, 1, 1, 'casse', 'correct', 'use'),
(16, 8, 2, 0, 1, 'correct', 'use', 'abime'),
(17, 8, 3, 1, 1, 'use', 'abime', 'correct'),
(18, 8, 4, 1, 0, 'abime', 'correct', 'casse'),
(19, 10, 1, 1, 1, 'use', 'abime', 'correct'),
(20, 10, 2, 1, 0, 'abime', 'correct', 'casse'),
(21, 10, 3, 1, 1, 'correct', 'casse', 'correct'),
(22, 12, 1, 1, 1, 'correct', 'casse', 'correct'),
(23, 12, 2, 1, 1, 'casse', 'correct', 'use'),
(24, 12, 3, 0, 1, 'correct', 'use', 'abime'),
(25, 12, 4, 1, 1, 'use', 'abime', 'correct'),
(26, 12, 5, 1, 1, 'abime', 'correct', 'casse'),
(27, 13, 1, 1, 1, 'casse', 'correct', 'use'),
(28, 13, 2, 0, 1, 'correct', 'use', 'abime'),
(29, 15, 1, 1, 1, 'use', 'abime', 'correct'),
(30, 15, 2, 1, 1, 'abime', 'correct', 'casse'),
(31, 15, 3, 1, 0, 'correct', 'casse', 'correct'),
(32, 15, 4, 1, 1, 'casse', 'correct', 'use'),
(33, 17, 1, 1, 0, 'correct', 'casse', 'correct'),
(34, 17, 2, 1, 1, 'casse', 'correct', 'use'),
(35, 17, 3, 0, 1, 'correct', 'use', 'abime'),
(36, 18, 1, 1, 1, 'casse', 'correct', 'use'),
(37, 18, 2, 0, 1, 'correct', 'use', 'abime'),
(38, 18, 3, 1, 1, 'use', 'abime', 'correct'),
(39, 18, 4, 1, 1, 'abime', 'correct', 'casse'),
(40, 18, 5, 1, 1, 'correct', 'casse', 'correct'),
(56, 20, 3, 1, 1, 'correct', 'casse', 'correct'),
(55, 20, 2, 1, 1, 'abime', 'correct', 'casse'),
(54, 20, 1, 0, 0, 'correct', 'use', 'correct'),
(57, 20, 4, 1, 0, 'casse', 'correct', 'use'),
(67, 2515, 5, 0, 0, 'correct', 'correct', 'correct'),
(66, 2515, 4, 0, 0, 'correct', 'correct', 'correct'),
(65, 2515, 3, 0, 1, 'use', 'correct', 'correct'),
(64, 2515, 2, 0, 0, 'correct', 'correct', 'correct'),
(63, 2515, 1, 1, 0, 'use', 'correct', 'use');

-- --------------------------------------------------------

--
-- Table structure for table `presences`
--

CREATE TABLE `presences` (
  `ID` int NOT NULL,
  `libelle_pres` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `presences`
--

INSERT INTO `presences` (`ID`, `libelle_pres`) VALUES
(1, '--'),
(2, 'PEU'),
(3, 'PARTIELLE'),
(4, 'TOTALE');

-- --------------------------------------------------------

--
-- Table structure for table `priorites`
--

CREATE TABLE `priorites` (
  `ID` int NOT NULL,
  `libelle_ct_prio` varchar(32) NOT NULL,
  `libelle_lg_prio` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `priorites`
--

INSERT INTO `priorites` (`ID`, `libelle_ct_prio`, `libelle_lg_prio`) VALUES
(1, 'Urgent', '00 - URGENT'),
(2, '12h', '01 - A 12H'),
(3, '24h', '02 - A 24H'),
(4, '48H', '03 - A 48H'),
(5, '7 JOURS', '04 - A LA SEMAINE'),
(6, '15 Jours', '05 - A 15 JOURS'),
(7, 'Mois', '06 - AU MOIS');

-- --------------------------------------------------------

--
-- Table structure for table `prises_init`
--

CREATE TABLE `prises_init` (
  `id` int NOT NULL,
  `id_eta_init` int NOT NULL,
  `num_prise` int NOT NULL DEFAULT '1',
  `type1` varchar(32) NOT NULL DEFAULT '0',
  `etat1` tinyint(1) NOT NULL DEFAULT '0',
  `iso1` tinyint(1) NOT NULL DEFAULT '0',
  `type2` varchar(32) NOT NULL DEFAULT '0',
  `etat2` tinyint(1) NOT NULL DEFAULT '0',
  `iso2` tinyint(1) NOT NULL DEFAULT '0',
  `type3` varchar(32) NOT NULL DEFAULT '0',
  `etat3` tinyint(1) NOT NULL DEFAULT '0',
  `iso3` tinyint(1) NOT NULL DEFAULT '0',
  `type4` varchar(32) NOT NULL DEFAULT '0',
  `etat4` tinyint(1) NOT NULL DEFAULT '0',
  `iso4` tinyint(1) NOT NULL DEFAULT '0',
  `type5` varchar(32) NOT NULL DEFAULT '0',
  `etat5` tinyint(1) NOT NULL DEFAULT '0',
  `iso5` tinyint(1) NOT NULL DEFAULT '0',
  `type6` varchar(32) NOT NULL DEFAULT '0',
  `etat6` tinyint(1) NOT NULL DEFAULT '0',
  `iso6` tinyint(1) NOT NULL DEFAULT '0',
  `type7` varchar(32) NOT NULL DEFAULT '0',
  `etat7` tinyint(1) NOT NULL DEFAULT '0',
  `iso7` tinyint(1) NOT NULL DEFAULT '0',
  `type8` varchar(32) NOT NULL DEFAULT '0',
  `etat8` tinyint(1) NOT NULL DEFAULT '0',
  `iso8` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `prises_init`
--

INSERT INTO `prises_init` (`id`, `id_eta_init`, `num_prise`, `type1`, `etat1`, `iso1`, `type2`, `etat2`, `iso2`, `type3`, `etat3`, `iso3`, `type4`, `etat4`, `iso4`, `type5`, `etat5`, `iso5`, `type6`, `etat6`, `iso6`, `type7`, `etat7`, `iso7`, `type8`, `etat8`, `iso8`) VALUES
(1, 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0),
(2, 1, 2, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1),
(3, 1, 3, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(4, 1, 4, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(5, 2, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1),
(6, 2, 2, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(7, 3, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0),
(8, 3, 2, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(9, 4, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'non_cable', 0, 0),
(10, 5, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'non_cable', 0, 0, 'resistance', 1, 1),
(11, 5, 2, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(12, 5, 3, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 1, 1),
(13, 5, 4, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(14, 5, 5, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'non_cable', 0, 0),
(15, 6, 1, 'resistance', 1, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(16, 6, 2, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1),
(17, 6, 3, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1),
(18, 7, 1, 'sonde', 0, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1),
(19, 7, 2, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1),
(20, 8, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1),
(21, 8, 2, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(22, 8, 3, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1),
(23, 8, 4, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(24, 8, 5, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(25, 9, 1, 'resistance', 1, 1, 'sonde', 1, 0, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(26, 10, 1, 'sonde', 1, 0, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1),
(27, 10, 2, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(28, 10, 3, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(29, 10, 4, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1),
(30, 11, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(31, 11, 2, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(32, 12, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(33, 12, 2, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1),
(34, 12, 3, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(35, 12, 4, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1),
(36, 12, 5, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1),
(37, 13, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1),
(38, 13, 2, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(39, 13, 3, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1),
(40, 14, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0),
(41, 15, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1),
(42, 15, 2, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1),
(43, 15, 3, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 0, 'non_cable', 0, 0),
(44, 15, 4, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 0, 1),
(45, 16, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(46, 16, 2, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'non_cable', 0, 0),
(47, 16, 3, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 0, 'non_cable', 0, 0, 'resistance', 0, 1),
(48, 17, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(49, 17, 2, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 0, 1),
(50, 18, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 0, 1),
(51, 18, 2, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 0, 1, 'sonde', 1, 1),
(52, 18, 3, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 0, 'non_cable', 0, 0, 'resistance', 0, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(53, 18, 4, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 0, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1),
(54, 18, 5, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 0, 0, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(55, 19, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 0, 1, 'sonde', 1, 1),
(80, 20, 3, 'resistance', 1, 1, 'sonde', 1, 0, 'non_cable', 0, 0, 'resistance', 0, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1),
(79, 20, 2, 'sonde', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 0, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1),
(78, 20, 1, 'resistance', 1, 1, 'resistance', 0, 1, 'resistance', 0, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 0, 1, 'sonde', 1, 1, 'non_cable', 0, 0),
(81, 20, 4, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 0, 1, 'sonde', 1, 1, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1),
(88, 2515, 3, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0),
(87, 2515, 2, 'resistance', 1, 1, 'resistance', 1, 1, 'resistance', 1, 1, 'resistance', 1, 1, 'resistance', 1, 1, 'resistance', 1, 1, 'resistance', 1, 1, 'resistance', 1, 1),
(86, 2515, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'resistance', 0, 1, 'sonde', 1, 0, 'resistance', 0, 0, 'non_cable', 1, 0, 'non_cable', 0, 0, 'non_cable', 0, 0),
(89, 2515, 4, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `systemes`
--

CREATE TABLE `systemes` (
  `id` int NOT NULL,
  `id_inter` int NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `marque` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `num_immat_sys` varchar(100) DEFAULT NULL,
  `nbr_pt` int NOT NULL DEFAULT '0',
  `mat_inject` int NOT NULL DEFAULT '1',
  `temp_inject` int DEFAULT NULL,
  `obturation` tinyint(1) NOT NULL DEFAULT '0',
  `nbr_obtu` int NOT NULL DEFAULT '0',
  `type_obturation` varchar(100) DEFAULT NULL,
  `embout` varchar(100) DEFAULT NULL,
  `nbr_resistance` int NOT NULL DEFAULT '0',
  `nbr_sonde` int NOT NULL DEFAULT '0',
  `nbr_prise` int NOT NULL DEFAULT '0',
  `description` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `systemes`
--

INSERT INTO `systemes` (`id`, `id_inter`, `reference`, `marque`, `type`, `num_immat_sys`, `nbr_pt`, `mat_inject`, `temp_inject`, `obturation`, `nbr_obtu`, `type_obturation`, `embout`, `nbr_resistance`, `nbr_sonde`, `nbr_prise`, `description`) VALUES
(2, 2, 'REF-260002', 'MOLDMASTER', 'MOULE ENTIER', 'SYS-2026-0002', 6, 8, 240, 0, 0, 'HYDRAULIQUE', 'TOPLESS', 6, 6, 2, 'Ensemble en bon état, contrôle visuel conforme.'),
(1, 1, 'REF-260001', 'MECALYS', 'BLOC CHAUD', 'SYS-2026-0001', 8, 13, 280, 1, 3, 'HYDRAULIQUE', 'DEBOUCHANT', 8, 8, 4, 'Bloc chaud présentant une légère usure générale, nettoyage effectué.'),
(3, 3, 'REF-260003', 'HUSKY', 'DEMI MOULE', 'SYS-2026-0003', 4, 5, 220, 1, 2, 'PNEUMATIQUE', 'DEBOUCHANT', 4, 4, 2, 'Présence de traces d usure sur les portées.'),
(4, 4, 'REF-260004', 'YUDO', 'BUSE DE PRESSE', 'SYS-2026-0004', 2, 14, 310, 0, 0, 'ELECTRIQUE', 'TOPLESS', 2, 2, 1, 'Buse contrôlée, fonctionnement normal.'),
(5, 5, 'REF-260005', 'EWIKON', 'ENSEMBLE DE BUSETTE', 'SYS-2026-0005', 10, 16, 320, 1, 5, 'ELECTRIQUE', 'DEBOUCHANT', 10, 9, 5, 'Ensemble complet nécessitant un nettoyage approfondi.'),
(6, 6, 'REF-260006', 'MECALYS', 'BLOC CHAUD', 'SYS-2026-0006', 7, 10, 260, 1, 4, 'HYDRAULIQUE', 'TOPLESS', 7, 6, 3, 'Bon état général après démontage.'),
(7, 7, 'REF-260007', 'MOLDMASTER', 'DEMI MOULE', 'SYS-2026-0007', 5, 7, 230, 0, 0, 'PNEUMATIQUE', 'DEBOUCHANT', 5, 5, 2, 'Légère corrosion superficielle observée.'),
(8, 8, 'REF-260008', 'HOTSET', 'MOULE ENTIER', 'SYS-2026-0008', 9, 15, 300, 1, 4, 'HYDRAULIQUE', 'TOPLESS', 9, 8, 5, 'Contrôle électrique conforme.'),
(9, 9, 'REF-260009', 'THERMOPLAY', 'BUSE DE PRESSE', 'SYS-2026-0009', 3, 6, 210, 0, 0, 'ELECTRIQUE', 'DEBOUCHANT', 3, 3, 1, 'Buse remplacée lors de la maintenance.'),
(10, 10, 'REF-260010', 'YUDO', 'BLOC CHAUD', 'SYS-2026-0010', 8, 12, 285, 1, 3, 'PNEUMATIQUE', 'TOPLESS', 8, 7, 4, 'Remplacement de plusieurs joints.'),
(11, 11, 'REF-260011', 'MECALYS', 'ENSEMBLE DE BUSETTE', 'SYS-2026-0011', 4, 9, 245, 0, 0, 'HYDRAULIQUE', 'DEBOUCHANT', 4, 4, 2, 'Équipement propre et fonctionnel.'),
(12, 12, 'REF-260012', 'INCOE', 'MOULE ENTIER', 'SYS-2026-0012', 10, 16, 330, 1, 5, 'ELECTRIQUE', 'TOPLESS', 10, 10, 5, 'Essais thermiques validés.'),
(13, 13, 'REF-260013', 'HUSKY', 'DEMI MOULE', 'SYS-2026-0013', 5, 11, 270, 1, 2, 'HYDRAULIQUE', 'DEBOUCHANT', 5, 6, 3, 'Usure normale constatée.'),
(14, 14, 'REF-260014', 'MOLDMASTER', 'BUSE DE PRESSE', 'SYS-2026-0014', 2, 4, 200, 0, 0, 'PNEUMATIQUE', 'TOPLESS', 2, 2, 1, 'Aucune anomalie détectée.'),
(15, 15, 'REF-260015', 'EWIKON', 'BLOC CHAUD', 'SYS-2026-0015', 9, 13, 295, 1, 4, 'ELECTRIQUE', 'DEBOUCHANT', 9, 9, 4, 'Résistances remplacées préventivement.'),
(16, 16, 'REF-260016', 'THERMOPLAY', 'MOULE ENTIER', 'SYS-2026-0016', 7, 8, 255, 0, 0, 'HYDRAULIQUE', 'TOPLESS', 7, 6, 3, 'Contrôle mécanique conforme.'),
(17, 17, 'REF-260017', 'MECALYS', 'DEMI MOULE', 'SYS-2026-0017', 6, 10, 275, 1, 3, 'PNEUMATIQUE', 'DEBOUCHANT', 6, 5, 2, 'Nettoyage complet effectué.'),
(18, 18, 'REF-260018', 'INCOE', 'ENSEMBLE DE BUSETTE', 'SYS-2026-0018', 10, 15, 315, 1, 5, 'HYDRAULIQUE', 'TOPLESS', 10, 10, 5, 'Matériel entièrement révisé.'),
(19, 19, 'REF-260019', 'HOTSET', 'BUSE DE PRESSE', 'SYS-2026-0019', 3, 5, 225, 0, 0, 'ELECTRIQUE', 'DEBOUCHANT', 3, 2, 1, 'État satisfaisant, aucune intervention requise.'),
(20, 20, 'REF-260020', 'YUDO', 'BLOC CHAUD', 'SYS-2026-0020', 8, 14, 305, 1, 4, 'HYDRAULIQUE', 'TOPLESS', 8, 8, 4, 'Validation finale après essais de chauffe.'),
(2503, 2514, 'fgdfgh', 'test', 'BLOC CHAUD', '123456', 2, 7, 145, 1, 2, 'Obturation pneumatique', 'Topless', 10, 5, 1, ''),
(2504, 2515, '123', '123', 'BLOC CHAUD', '123', 1, 10, 123, 1, 5, 'Obturation pneumatique', 'Topless', 2, 3, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int NOT NULL,
  `id_inter` int NOT NULL,
  `tt_eg_propre` varchar(32) DEFAULT NULL,
  `tt_eg_etatgene` varchar(32) DEFAULT NULL,
  `tt_eg_avis_tech` text,
  `tt_mec_etatgene` varchar(32) DEFAULT NULL,
  `tt_mec_eta_entre_mat` varchar(32) DEFAULT NULL,
  `tt_mec_eta_sorti_mat` varchar(32) DEFAULT NULL,
  `tt_mec_huile_fuit` varchar(32) DEFAULT NULL,
  `tt_mec_bleu` varchar(32) DEFAULT NULL,
  `tt_mec_avis_tech` text,
  `tt_ele_etatgene` varchar(32) DEFAULT NULL,
  `tt_ele_etatcable` varchar(32) DEFAULT NULL,
  `tt_ele_resit` varchar(32) DEFAULT NULL,
  `tt_ele_sond` varchar(32) DEFAULT NULL,
  `tt_ele_avis_tech` text,
  `tt_th_etatgene` varchar(32) DEFAULT NULL,
  `tt_th_stable` varchar(32) DEFAULT NULL,
  `tt_th_inerti` varchar(32) DEFAULT NULL,
  `tt_th_temp_test` int DEFAULT NULL,
  `tt_th_pilotage` varchar(32) DEFAULT NULL,
  `tt_th_avis_therm` text,
  `tt_date` date DEFAULT NULL,
  `tt_validation` varchar(32) DEFAULT NULL,
  `tt_rec_obtu` varchar(32) DEFAULT NULL,
  `tt_th_dur_mont` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `id_inter`, `tt_eg_propre`, `tt_eg_etatgene`, `tt_eg_avis_tech`, `tt_mec_etatgene`, `tt_mec_eta_entre_mat`, `tt_mec_eta_sorti_mat`, `tt_mec_huile_fuit`, `tt_mec_bleu`, `tt_mec_avis_tech`, `tt_ele_etatgene`, `tt_ele_etatcable`, `tt_ele_resit`, `tt_ele_sond`, `tt_ele_avis_tech`, `tt_th_etatgene`, `tt_th_stable`, `tt_th_inerti`, `tt_th_temp_test`, `tt_th_pilotage`, `tt_th_avis_therm`, `tt_date`, `tt_validation`, `tt_rec_obtu`, `tt_th_dur_mont`) VALUES
(6, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2499, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2500, 2500, 'NON CORRECT', 'NON CORRECT', '', 'NON CORRECT', 'NON CORRECT', 'NON CORRECT', 'NON CORRECT', 'NON CORRECT', '', 'NON CORRECT', 'NON CORRECT', 'NON CORRECT', 'NON CORRECT', '', 'NON CORRECT', 'STABLE', 'NON CORRECT', 0, 'NON CORRECT', '', '2026-06-05', 'NON VALIDÉ', 'NON CORRECT', 0),
(2501, 20, 'NON CORRECT', 'NON CORRECT', '', 'NON CORRECT', 'NON CORRECT', 'NON CORRECT', 'NON CORRECT', 'NON CORRECT', '', 'NON CORRECT', 'NON CORRECT', 'NON CORRECT', 'NON CORRECT', '', 'NON CORRECT', 'STABLE', 'NON CORRECT', 0, 'NON CORRECT', '', '2026-07-01', 'VALIDÉ', 'NON CORRECT', 0),
(2502, 2515, 'NON CORRECT', 'NEUF', '', 'NON CORRECT', 'NEUF', 'NEUF', 'NEUF', 'NEUF', '', 'CORRECT', 'NEUF', 'NEUF', 'NON CORRECT', '', 'NON CORRECT', 'STABLE', 'NON CORRECT', 0, 'NON CORRECT', '', '2026-07-01', 'VALIDÉ', 'CORRECT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `travaux`
--

CREATE TABLE `travaux` (
  `id` int NOT NULL,
  `id_inter` int NOT NULL,
  `id_av_trav` int NOT NULL DEFAULT '1',
  `passage_four` tinyint(1) DEFAULT '0',
  `chang_resistance` tinyint(1) DEFAULT '0',
  `nbr_chang_resistance` int DEFAULT '0',
  `chang_sonde` tinyint(1) DEFAULT '0',
  `nbr_chang_sonde` int DEFAULT '0',
  `nettoyage` tinyint(1) DEFAULT '0',
  `modif_cablage_elec` tinyint(1) NOT NULL DEFAULT '0',
  `modif_cir_eau` tinyint(1) NOT NULL DEFAULT '0',
  `modif_cir_huile` tinyint(1) NOT NULL DEFAULT '0',
  `modif_cir_elec` tinyint(1) NOT NULL DEFAULT '0',
  `modif_cir_air` tinyint(1) NOT NULL DEFAULT '0',
  `modif_meca` tinyint(1) NOT NULL DEFAULT '0',
  `modif_meca_tete` tinyint(1) NOT NULL DEFAULT '0',
  `nbr_modif_meca_tete` int NOT NULL DEFAULT '0',
  `modif_meca_rectif` tinyint(1) NOT NULL DEFAULT '0',
  `nbr_modif_meca_rectif` int NOT NULL DEFAULT '0',
  `modif_meca_corp` tinyint(1) NOT NULL DEFAULT '0',
  `desc_modif_meca_corp` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `travaux`
--

INSERT INTO `travaux` (`id`, `id_inter`, `id_av_trav`, `passage_four`, `chang_resistance`, `nbr_chang_resistance`, `chang_sonde`, `nbr_chang_sonde`, `nettoyage`, `modif_cablage_elec`, `modif_cir_eau`, `modif_cir_huile`, `modif_cir_elec`, `modif_cir_air`, `modif_meca`, `modif_meca_tete`, `nbr_modif_meca_tete`, `modif_meca_rectif`, `nbr_modif_meca_rectif`, `modif_meca_corp`, `desc_modif_meca_corp`) VALUES
(3, 3, 3, 1, 1, 4, 1, 2, 1, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 0, ''),
(2, 2, 8, 0, 0, 0, 1, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, ''),
(1, 1, 5, 1, 1, 2, 0, 0, 1, 0, 0, 0, 1, 0, 1, 1, 2, 0, 0, 0, ''),
(4, 4, 7, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 1, 0, 0, 1, 2, 1, 'Rectification du plan de joint et reprise des surfaces d\'appui.'),
(5, 5, 8, 0, 1, 3, 1, 3, 1, 1, 0, 0, 1, 0, 1, 1, 4, 0, 0, 1, 'Remplacement d\'une bague de guidage.'),
(6, 6, 4, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, ''),
(7, 7, 2, 0, 1, 1, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, ''),
(8, 8, 6, 1, 1, 6, 1, 4, 1, 1, 1, 0, 1, 0, 1, 1, 2, 1, 1, 1, 'Rectification de plusieurs portées de busettes.'),
(9, 9, 5, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(10, 10, 8, 1, 1, 2, 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 1, 0, 0, 0, ''),
(11, 11, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(12, 12, 7, 1, 1, 5, 1, 5, 1, 1, 1, 1, 1, 0, 1, 1, 3, 1, 2, 1, 'Réfection complète du corps de chauffe.'),
(13, 13, 3, 0, 0, 0, 1, 2, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, ''),
(14, 14, 4, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, ''),
(15, 15, 8, 1, 1, 8, 1, 6, 1, 1, 1, 1, 1, 1, 1, 1, 5, 1, 3, 1, 'Reprise complète des usinages mécaniques du corps.'),
(16, 16, 6, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, ''),
(17, 17, 5, 1, 1, 3, 1, 2, 1, 1, 0, 0, 1, 0, 1, 1, 2, 0, 0, 0, ''),
(18, 18, 2, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 1, 2, 1, 'Rectification du logement des obturateurs.'),
(19, 19, 7, 1, 1, 2, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, ''),
(20, 20, 2, 1, 1, 4, 1, 4, 1, 1, 1, 1, 0, 1, 1, 1, 3, 1, 2, 1, 'Révision générale avec remplacement des éléments mécaniques usés.'),
(2502, 2515, 2, 0, 0, 2, 1, 2, 0, 1, 1, 0, 0, 1, 1, 1, 5, 1, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tt_obtu`
--

CREATE TABLE `tt_obtu` (
  `id` int NOT NULL,
  `id_eta_init` int NOT NULL,
  `num_obtu` int NOT NULL,
  `jeu_guide` tinyint(1) NOT NULL,
  `etat_obtu` varchar(32) NOT NULL,
  `etat_guide` varchar(32) NOT NULL,
  `attel_etat` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

--
-- Dumping data for table `tt_obtu`
--

INSERT INTO `tt_obtu` (`id`, `id_eta_init`, `num_obtu`, `jeu_guide`, `etat_obtu`, `etat_guide`, `attel_etat`) VALUES
(1, 1, 1, 1, 'abime', 'correct', 'casse'),
(2, 1, 2, 1, 'correct', 'casse', 'correct'),
(3, 1, 3, 1, 'casse', 'correct', 'use'),
(4, 3, 1, 1, 'casse', 'correct', 'use'),
(5, 3, 2, 1, 'correct', 'use', 'abime'),
(6, 5, 1, 0, 'use', 'abime', 'correct'),
(7, 5, 2, 1, 'abime', 'correct', 'casse'),
(8, 5, 3, 1, 'correct', 'casse', 'correct'),
(9, 5, 4, 1, 'casse', 'correct', 'use'),
(10, 5, 5, 1, 'correct', 'use', 'abime'),
(11, 6, 1, 1, 'abime', 'correct', 'casse'),
(12, 6, 2, 1, 'correct', 'casse', 'correct'),
(13, 6, 3, 1, 'casse', 'correct', 'use'),
(14, 6, 4, 1, 'correct', 'use', 'abime'),
(15, 8, 1, 1, 'casse', 'correct', 'use'),
(16, 8, 2, 1, 'correct', 'use', 'abime'),
(17, 8, 3, 1, 'use', 'abime', 'correct'),
(18, 8, 4, 0, 'abime', 'correct', 'casse'),
(19, 10, 1, 1, 'use', 'abime', 'correct'),
(20, 10, 2, 0, 'abime', 'correct', 'casse'),
(21, 10, 3, 1, 'correct', 'casse', 'correct'),
(22, 12, 1, 1, 'correct', 'casse', 'correct'),
(23, 12, 2, 1, 'casse', 'correct', 'use'),
(24, 12, 3, 1, 'correct', 'use', 'abime'),
(25, 12, 4, 1, 'use', 'abime', 'correct'),
(26, 12, 5, 1, 'abime', 'correct', 'casse'),
(27, 13, 1, 1, 'casse', 'correct', 'use'),
(28, 13, 2, 1, 'correct', 'use', 'abime'),
(29, 15, 1, 1, 'use', 'abime', 'correct'),
(30, 15, 2, 1, 'abime', 'correct', 'casse'),
(31, 15, 3, 0, 'correct', 'casse', 'correct'),
(32, 15, 4, 1, 'casse', 'correct', 'use'),
(33, 17, 1, 0, 'correct', 'casse', 'correct'),
(34, 17, 2, 1, 'casse', 'correct', 'use'),
(35, 17, 3, 1, 'correct', 'use', 'abime'),
(36, 18, 1, 1, 'casse', 'correct', 'use'),
(37, 18, 2, 1, 'correct', 'use', 'abime'),
(38, 18, 3, 1, 'use', 'abime', 'correct'),
(39, 18, 4, 1, 'abime', 'correct', 'casse'),
(40, 18, 5, 1, 'correct', 'casse', 'correct'),
(41, 20, 1, 1, 'use', 'abime', 'correct'),
(42, 20, 2, 1, 'abime', 'correct', 'casse'),
(43, 20, 3, 1, 'correct', 'casse', 'correct'),
(44, 20, 4, 0, 'casse', 'correct', 'use'),
(63, 2515, 5, 0, 'correct', 'correct', 'correct'),
(62, 2515, 4, 0, 'correct', 'correct', 'correct'),
(61, 2515, 3, 0, 'correct', 'correct', 'correct'),
(60, 2515, 2, 0, 'correct', 'correct', 'correct'),
(59, 2515, 1, 0, 'use', 'abime', 'use');

-- --------------------------------------------------------

--
-- Table structure for table `tt_prises`
--

CREATE TABLE `tt_prises` (
  `id` int NOT NULL,
  `id_eta_init` int NOT NULL,
  `num_prise` int NOT NULL,
  `type1` varchar(32) NOT NULL,
  `etat1` tinyint(1) NOT NULL DEFAULT '0',
  `iso1` tinyint(1) NOT NULL DEFAULT '0',
  `etat2` tinyint(1) NOT NULL,
  `iso2` tinyint(1) NOT NULL,
  `type2` varchar(32) NOT NULL,
  `etat3` tinyint(1) NOT NULL,
  `iso3` tinyint(1) NOT NULL,
  `type3` varchar(32) NOT NULL,
  `etat4` tinyint(1) NOT NULL,
  `iso4` tinyint(1) NOT NULL,
  `type4` varchar(32) NOT NULL,
  `etat5` tinyint(1) NOT NULL,
  `iso5` tinyint(1) NOT NULL,
  `type5` varchar(32) NOT NULL,
  `etat6` tinyint(1) NOT NULL,
  `iso6` tinyint(1) NOT NULL,
  `type6` varchar(32) NOT NULL,
  `etat7` tinyint(1) NOT NULL,
  `iso7` tinyint(1) NOT NULL,
  `type7` varchar(32) NOT NULL,
  `etat8` tinyint(1) NOT NULL,
  `iso8` tinyint(1) NOT NULL,
  `type8` varchar(32) NOT NULL,
  `val1` decimal(5,2) NOT NULL,
  `val2` decimal(5,2) NOT NULL,
  `val3` decimal(5,2) NOT NULL,
  `val4` decimal(5,2) NOT NULL,
  `val5` decimal(5,2) NOT NULL,
  `val6` decimal(5,2) NOT NULL,
  `val7` decimal(5,2) NOT NULL,
  `val8` decimal(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

--
-- Dumping data for table `tt_prises`
--

INSERT INTO `tt_prises` (`id`, `id_eta_init`, `num_prise`, `type1`, `etat1`, `iso1`, `etat2`, `iso2`, `type2`, `etat3`, `iso3`, `type3`, `etat4`, `iso4`, `type4`, `etat5`, `iso5`, `type5`, `etat6`, `iso6`, `type6`, `etat7`, `iso7`, `type7`, `etat8`, `iso8`, `type8`, `val1`, `val2`, `val3`, `val4`, `val5`, `val6`, `val7`, `val8`) VALUES
(1, 1, 1, 'resistance', 1, 1, 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 0, 1, 'sonde', 0, 0, 'non_cable', 206.00, 97.30, 0.00, 215.00, 97.90, 221.00, 98.30, 0.00),
(2, 1, 2, 'sonde', 1, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 97.60, 0.00, 223.00, 98.20, 229.00, 98.60, 0.00, 238.00),
(3, 1, 3, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 231.00, 98.50, 237.00, 98.90, 0.00, 246.00, 96.30),
(4, 1, 4, 'resistance', 1, 1, 1, 1, 'sonde', 1, 1, 'resistance', 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 239.00, 98.80, 245.00, 96.00, 0.00, 254.00, 96.60, 0.00),
(5, 2, 1, 'sonde', 1, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 97.50, 0.00, 219.00, 98.10, 225.00, 98.50, 0.00, 234.00),
(6, 2, 2, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 227.00, 98.40, 233.00, 98.80, 0.00, 242.00, 96.20),
(7, 3, 1, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 0.00, 223.00, 98.30, 229.00, 98.70, 0.00, 238.00, 96.10),
(8, 3, 2, 'resistance', 1, 1, 1, 1, 'sonde', 1, 1, 'resistance', 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 231.00, 98.60, 237.00, 99.00, 0.00, 246.00, 96.40, 0.00),
(9, 4, 1, 'resistance', 1, 1, 1, 1, 'sonde', 1, 1, 'resistance', 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 0, 0, 'non_cable', 227.00, 98.50, 233.00, 98.90, 0.00, 242.00, 96.30, 0.00),
(10, 5, 1, 'sonde', 1, 1, 1, 1, 'resistance', 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 98.70, 237.00, 99.10, 0.00, 246.00, 96.50, 0.00, 255.00),
(11, 5, 2, 'resistance', 1, 1, 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 245.00, 96.20, 0.00, 254.00, 96.80, 0.00, 263.00, 97.40),
(12, 5, 3, 'sonde', 0, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 96.50, 0.00, 262.00, 97.10, 0.00, 271.00, 97.70, 277.00),
(13, 5, 4, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 270.00, 97.40, 0.00, 279.00, 98.00, 190.00, 98.40),
(14, 5, 5, 'resistance', 1, 1, 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 278.00, 97.70, 0.00, 192.00, 98.30, 198.00, 98.70, 0.00),
(15, 6, 1, 'resistance', 1, 1, 0, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 241.00, 96.10, 0.00, 250.00, 96.70, 0.00, 259.00, 97.30),
(16, 6, 2, 'sonde', 0, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 96.40, 0.00, 258.00, 97.00, 0.00, 267.00, 97.60, 273.00),
(17, 6, 3, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 266.00, 97.30, 0.00, 275.00, 97.90, 186.00, 98.30),
(18, 7, 1, 'sonde', 0, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 96.30, 0.00, 254.00, 96.90, 0.00, 263.00, 97.50, 269.00),
(19, 7, 2, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 262.00, 97.20, 0.00, 271.00, 97.80, 277.00, 98.20),
(20, 8, 1, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 0, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 258.00, 97.10, 0.00, 267.00, 97.70, 273.00, 98.10),
(21, 8, 2, 'resistance', 1, 1, 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 266.00, 97.40, 0.00, 275.00, 98.00, 186.00, 98.40, 0.00),
(22, 8, 3, 'sonde', 1, 1, 0, 0, 'non_cable', 1, 0, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 97.70, 0.00, 188.00, 98.30, 194.00, 98.70, 0.00, 203.00),
(23, 8, 4, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 196.00, 98.60, 202.00, 99.00, 0.00, 211.00, 96.40),
(24, 8, 5, 'resistance', 1, 1, 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 204.00, 98.90, 210.00, 96.10, 0.00, 219.00, 96.70, 0.00),
(25, 9, 1, 'resistance', 1, 1, 1, 0, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 262.00, 97.30, 0.00, 271.00, 97.90, 277.00, 98.30, 0.00),
(26, 10, 1, 'sonde', 1, 0, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 97.50, 0.00, 275.00, 98.10, 186.00, 98.50, 0.00, 195.00),
(27, 10, 2, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 188.00, 98.40, 194.00, 98.80, 0.00, 203.00, 96.20),
(28, 10, 3, 'resistance', 1, 0, 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 196.00, 98.70, 202.00, 99.10, 0.00, 211.00, 96.50, 0.00),
(29, 10, 4, 'sonde', 1, 0, 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 99.00, 210.00, 96.20, 0.00, 219.00, 96.80, 0.00, 228.00),
(30, 11, 1, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 279.00, 98.30, 190.00, 98.70, 0.00, 199.00, 96.10),
(31, 11, 2, 'resistance', 1, 1, 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 192.00, 98.60, 198.00, 99.00, 0.00, 207.00, 96.40, 0.00),
(32, 12, 1, 'resistance', 1, 1, 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 188.00, 98.50, 194.00, 98.90, 0.00, 203.00, 96.30, 0.00),
(33, 12, 2, 'sonde', 1, 1, 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 98.80, 202.00, 96.00, 0.00, 211.00, 96.60, 0.00, 220.00),
(34, 12, 3, 'resistance', 1, 1, 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 210.00, 96.30, 0.00, 219.00, 96.90, 0.00, 228.00, 97.50),
(35, 12, 4, 'sonde', 1, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 96.60, 0.00, 227.00, 97.20, 0.00, 236.00, 97.80, 242.00),
(36, 12, 5, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 235.00, 97.50, 0.00, 244.00, 98.10, 250.00, 98.50),
(37, 13, 1, 'sonde', 1, 1, 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 98.70, 198.00, 99.10, 0.00, 207.00, 96.50, 0.00, 216.00),
(38, 13, 2, 'resistance', 1, 1, 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 206.00, 96.20, 0.00, 215.00, 96.80, 0.00, 224.00, 97.40),
(39, 13, 3, 'sonde', 1, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 96.50, 0.00, 223.00, 97.10, 0.00, 232.00, 97.70, 238.00),
(40, 14, 1, 'resistance', 1, 1, 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 202.00, 96.10, 0.00, 211.00, 96.70, 0.00, 220.00, 97.30),
(41, 15, 1, 'sonde', 1, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 96.30, 0.00, 215.00, 96.90, 0.00, 224.00, 97.50, 230.00),
(42, 15, 2, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 0.00, 223.00, 97.20, 0.00, 232.00, 97.80, 238.00, 98.20),
(43, 15, 3, 'resistance', 1, 1, 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 0, 'sonde', 0, 0, 'non_cable', 231.00, 97.50, 0.00, 240.00, 98.10, 246.00, 98.50, 0.00),
(44, 15, 4, 'sonde', 1, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 97.80, 0.00, 248.00, 98.40, 254.00, 98.80, 0.00, 263.00),
(45, 16, 1, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0.00, 219.00, 97.10, 0.00, 228.00, 97.70, 234.00, 98.10),
(46, 16, 2, 'resistance', 1, 1, 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 227.00, 97.40, 0.00, 236.00, 98.00, 242.00, 98.40, 0.00),
(47, 16, 3, 'sonde', 1, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 1, 0, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 97.70, 0.00, 244.00, 98.30, 250.00, 98.70, 0.00, 259.00),
(48, 17, 1, 'resistance', 1, 1, 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 223.00, 97.30, 0.00, 232.00, 97.90, 238.00, 98.30, 0.00),
(49, 17, 2, 'sonde', 1, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 97.60, 0.00, 240.00, 98.20, 246.00, 98.60, 0.00, 255.00),
(50, 18, 1, 'sonde', 1, 1, 0, 0, 'non_cable', 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 97.50, 0.00, 236.00, 98.10, 242.00, 98.50, 0.00, 251.00),
(51, 18, 2, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 1, 'sonde', 1, 0, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 1, 1, 'sonde', 0.00, 244.00, 98.40, 250.00, 98.80, 0.00, 259.00, 96.20),
(52, 18, 3, 'resistance', 1, 1, 1, 1, 'sonde', 1, 1, 'resistance', 1, 0, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 252.00, 98.70, 258.00, 99.10, 0.00, 267.00, 96.50, 0.00),
(53, 18, 4, 'sonde', 1, 1, 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 99.00, 266.00, 96.20, 0.00, 275.00, 96.80, 0.00, 189.00),
(54, 18, 5, 'resistance', 1, 1, 1, 1, 'sonde', 0, 0, 'non_cable', 0, 0, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 274.00, 96.50, 0.00, 188.00, 97.10, 0.00, 197.00, 97.70),
(55, 19, 1, 'non_cable', 0, 0, 1, 1, 'resistance', 1, 0, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 1, 1, 'sonde', 0.00, 240.00, 98.30, 246.00, 98.70, 0.00, 255.00, 96.10),
(56, 20, 1, 'resistance', 1, 1, 1, 0, 'sonde', 1, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 244.00, 98.50, 250.00, 98.90, 0.00, 259.00, 96.30, 0.00),
(57, 20, 2, 'sonde', 1, 1, 1, 0, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 98.80, 258.00, 96.00, 0.00, 267.00, 96.60, 0.00, 276.00),
(58, 20, 3, 'resistance', 1, 1, 1, 0, 'sonde', 0, 0, 'non_cable', 0, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 266.00, 96.30, 0.00, 275.00, 96.90, 0.00, 189.00, 97.50),
(59, 20, 4, 'sonde', 1, 1, 0, 0, 'non_cable', 0, 1, 'resistance', 1, 1, 'sonde', 0, 0, 'non_cable', 1, 1, 'resistance', 1, 1, 'sonde', 1, 1, 'resistance', 96.60, 0.00, 188.00, 97.20, 0.00, 197.00, 97.80, 203.00),
(103, 2515, 4, 'non_cable', 0, 0, 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(102, 2515, 3, 'sonde', 1, 0, 0, 1, 'resistance', 0, 1, 'resistance', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(101, 2515, 2, 'non_cable', 0, 0, 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(100, 2515, 1, 'resistance', 1, 0, 0, 1, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 0, 0, 'non_cable', 2.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `nom` varchar(64) DEFAULT NULL,
  `prenom` varchar(64) DEFAULT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_fonctions` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `login`, `password`, `id_fonctions`) VALUES
(1, 'SEYMARC', 'Thomas', 't.seymarc', '1f89282ce1f44bd8953925eaa8687c8d', 6),
(5, 'LEPINE', 'Emeline', 'e.lepine', '$argon2id$v=19$m=65536,t=4,p=2$UUhDb2tiaGZDbUJxZGsxdA$8o5IAqntzDppALPxtOmYAnzJtmkQYYEf0XOvGff/rzc', 6),
(3, 'SEYMARC', 'Philippe', 'p.seymarc', '0b17d130c970d46f50e405c3b3f6b12f', 1),
(4, 'COUNDIAL', 'Frédéric', 'f.coundial', '$argon2id$v=19$m=65536,t=4,p=2$RmQyY0RERlNHUVFkZTNtTg$Ae+0Dl8PIkpkT0H0i/Orf0+DIfi0xrQY8B2NU1bkb1c', 2),
(6, 'TEULET', 'René', 'r.teulet', '0b17d130c970d46f50e405c3b3f6b12f', 4),
(8, 'DAMOUR', 'Michel', 'm.damour', '0b17d130c970d46f50e405c3b3f6b12f', 2),
(9, 'TA', 'Michel', 'm.ta', '0b17d130c970d46f50e405c3b3f6b12f', 3),
(10, 'CROST', 'Hervé', 'h.crost', '0b17d130c970d46f50e405c3b3f6b12f', 4),
(11, 'FAUCHER', 'Rémi', 'r.faucher', '0b17d130c970d46f50e405c3b3f6b12f', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avancements`
--
ALTER TABLE `avancements`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `av_technique`
--
ALTER TABLE `av_technique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etat_init`
--
ALTER TABLE `etat_init`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonctions`
--
ALTER TABLE `fonctions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `f_inter`
--
ALTER TABLE `f_inter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obturateurs_init`
--
ALTER TABLE `obturateurs_init`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presences`
--
ALTER TABLE `presences`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `priorites`
--
ALTER TABLE `priorites`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `prises_init`
--
ALTER TABLE `prises_init`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systemes`
--
ALTER TABLE `systemes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travaux`
--
ALTER TABLE `travaux`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tt_obtu`
--
ALTER TABLE `tt_obtu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tt_prises`
--
ALTER TABLE `tt_prises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avancements`
--
ALTER TABLE `avancements`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `av_technique`
--
ALTER TABLE `av_technique`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `etat_init`
--
ALTER TABLE `etat_init`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2502;

--
-- AUTO_INCREMENT for table `fonctions`
--
ALTER TABLE `fonctions`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `f_inter`
--
ALTER TABLE `f_inter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2516;

--
-- AUTO_INCREMENT for table `matieres`
--
ALTER TABLE `matieres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `obturateurs_init`
--
ALTER TABLE `obturateurs_init`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `presences`
--
ALTER TABLE `presences`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `priorites`
--
ALTER TABLE `priorites`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prises_init`
--
ALTER TABLE `prises_init`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `systemes`
--
ALTER TABLE `systemes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2505;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2503;

--
-- AUTO_INCREMENT for table `travaux`
--
ALTER TABLE `travaux`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2503;

--
-- AUTO_INCREMENT for table `tt_obtu`
--
ALTER TABLE `tt_obtu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tt_prises`
--
ALTER TABLE `tt_prises`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
