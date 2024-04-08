CREATE DATABASE  IF NOT EXISTS `sg` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sg`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: sg
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sg_aluno`
--

DROP TABLE IF EXISTS `sg_aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sg_aluno` (
  `id_a` int NOT NULL AUTO_INCREMENT,
  `idTurma_a` int DEFAULT NULL,
  `idClasse` int DEFAULT NULL,
  `idEncarregado` int DEFAULT NULL,
  `idUsuario` int DEFAULT NULL,
  `nome_a` varchar(45) NOT NULL,
  `municipio_a` varchar(20) NOT NULL,
  `bairro_a` varchar(20) NOT NULL,
  `sexo_a` varchar(12) NOT NULL,
  `nascimento_a` date NOT NULL,
  `contato_a` varchar(10) NOT NULL,
  `numeroBI_a` varchar(20) NOT NULL,
  `view` tinyint(1) DEFAULT NULL,
  `dataCadastro_a` datetime DEFAULT NULL,
  `dataModificacao_a` datetime DEFAULT NULL,
  PRIMARY KEY (`id_a`),
  KEY `idTurma` (`idTurma_a`),
  KEY `idClasse` (`idClasse`),
  KEY `fk_encarregado_idx` (`idEncarregado`),
  KEY `fk_usuario_a_idx` (`idUsuario`),
  CONSTRAINT `fk_encarregado` FOREIGN KEY (`idEncarregado`) REFERENCES `sg_encarregado` (`id_e`),
  CONSTRAINT `fk_turma_a` FOREIGN KEY (`idTurma_a`) REFERENCES `sg_turma` (`id_t`),
  CONSTRAINT `fk_usuario_a` FOREIGN KEY (`idUsuario`) REFERENCES `sg_usuarios` (`id_u`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sg_aluno`
--

LOCK TABLES `sg_aluno` WRITE;
/*!40000 ALTER TABLE `sg_aluno` DISABLE KEYS */;
INSERT INTO `sg_aluno` VALUES (1,7,4,1,3,'Carla Miguel Bastos Mora','Luanda','benfica','Femenino','2017-03-18','977891089','643df475g',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(2,14,7,1,5,'Adelino Miguel Bastos Mora','Luanda','benfica','Masculino','2014-11-30','900302010','k7a4z53fd',1,'2022-12-01 12:47:48','2022-12-01 13:12:53'),(3,7,4,2,7,'Armando Luvuma Boreon Mateus','Cacuaco','Ngoma','Masculino','2016-10-17','960034010','po2je9hj1',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(4,14,7,4,13,'Estelvio Quitura Kituxi Luegi','Kilamba Kiaxi','Golf2','Masculino','2013-11-17','900302010','45a4wq3d',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(5,12,6,4,14,'Otavia Quitura Almeida Kituxi Luegi','Kilamba Kiaxi','Golf2','Femenino','2012-05-02','961178455','za8df2pm',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(6,12,6,5,15,'Maria Francisca Lussoco Monteiro','Cacuaco','Ngoma','Femenino','2012-12-10','989632011','0w578wq',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(7,7,4,5,16,'Bruno Ribeiro Lussoco Monteiro','Cacuaco','Ngoma','Masculino','2016-08-13','905112044','qw34lf5g',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(8,12,6,5,17,'Sara Francisca Lussoco Monteiro','Cacuaco','Ngoma','Femenino','2012-07-07','975141000','a34ftg56y',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(9,12,6,7,37,'Nelsa Duda Siilva Mourinho','Luanda','ingombota','Femenino','2013-11-17','Opcional','87ghf410y',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(10,12,6,3,40,'Felicia Dendo Muniz Catoka Nvunge','Luanda','Prenda','Femenino','2013-11-07','Opcional','12gh873fd',1,'2022-12-01 13:16:18','2022-12-01 13:16:18');
/*!40000 ALTER TABLE `sg_aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sg_classe`
--

DROP TABLE IF EXISTS `sg_classe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sg_classe` (
  `id_c` int NOT NULL AUTO_INCREMENT,
  `nome_c` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_c`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sg_classe`
--

LOCK TABLES `sg_classe` WRITE;
/*!40000 ALTER TABLE `sg_classe` DISABLE KEYS */;
INSERT INTO `sg_classe` VALUES (1,'1-classe'),(2,'2-classe'),(3,'3-classe'),(4,'4-classe'),(5,'5-classe'),(6,'6-classe'),(7,'7-classe'),(8,'8-classe'),(9,'9-classe');
/*!40000 ALTER TABLE `sg_classe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sg_disciplina`
--

DROP TABLE IF EXISTS `sg_disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sg_disciplina` (
  `id_d` int NOT NULL AUTO_INCREMENT,
  `nome_d` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_d`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sg_disciplina`
--

LOCK TABLES `sg_disciplina` WRITE;
/*!40000 ALTER TABLE `sg_disciplina` DISABLE KEYS */;
INSERT INTO `sg_disciplina` VALUES (1,'Biologia'),(2,'Matematica'),(3,'Lingua Portuguesa'),(4,'Estudo do Meio'),(5,'Educacao Musical'),(6,'Educacao Manual e Plastica'),(7,'Ciencias da Natureza'),(10,'Fisica'),(11,'Quimica'),(12,'Ingles');
/*!40000 ALTER TABLE `sg_disciplina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sg_encarregado`
--

DROP TABLE IF EXISTS `sg_encarregado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sg_encarregado` (
  `id_e` int NOT NULL AUTO_INCREMENT,
  `idUsuario` int DEFAULT NULL,
  `nome_e` varchar(45) DEFAULT NULL,
  `sexo_e` varchar(12) DEFAULT NULL,
  `municipio_e` varchar(20) DEFAULT NULL,
  `bairro_e` varchar(20) DEFAULT NULL,
  `nascimento_e` date DEFAULT NULL,
  `contato_e` varchar(20) DEFAULT NULL,
  `numeroBI_e` varchar(20) DEFAULT NULL,
  `view` tinyint(1) DEFAULT NULL,
  `dataCadastro_e` datetime DEFAULT NULL,
  `dataModificacao_e` datetime DEFAULT NULL,
  PRIMARY KEY (`id_e`),
  KEY `fk_usuario_e_idx` (`idUsuario`),
  CONSTRAINT `fk_usuario_e` FOREIGN KEY (`idUsuario`) REFERENCES `sg_usuarios` (`id_u`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sg_encarregado`
--

LOCK TABLES `sg_encarregado` WRITE;
/*!40000 ALTER TABLE `sg_encarregado` DISABLE KEYS */;
INSERT INTO `sg_encarregado` VALUES (1,2,'Silvia Miguel Kiluange Nzola','Femenino','Luanda','Benfica','1979-07-09','901033330','14fkg95jk',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(2,6,'Fonseca Luvuma Mateus','Masculino','Cacuaco','Ngoma','1976-05-12','901112233','qw345jk5f',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(3,10,'Maria Teixeira Muniz Catoka','Femenino','Luanda','Prenda','1982-04-10','987784121','qwa2453fd',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(4,11,'Victor Almeida Kituxi Luegi','Masculino','Talatona','Patriota','1973-09-23','909787741','65n3f4w70',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(5,12,'Daniel Lussoco Monteiro','Masculino','Luanda','Kinaxixi','1972-01-30','987121011','q7a679u1d',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(6,22,'Biatriz Eliza Moreira','Femenino','Belas','ramiro','1974-03-12','905500550','85a4q53fd',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(7,32,'Zarcia Moutinho Silva Mourinho','Femenino','Luanda','ingombota','1981-05-10','998919795','07a74i3fd',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(8,35,'Jordao Ambrosio de Lemos','Masculino','Cacuaco','azul','1978-07-10','962334551','po2je29hf',1,'2022-12-01 12:47:48','2022-12-01 13:18:48'),(9,41,'Maria Estefania Campos','Femenino','Luanda','Maianga','1977-04-09','900022220','w22df465y',1,'2022-12-01 13:20:26','2022-12-01 13:20:26'),(10,43,'Abel Francisco dos Santos','Masculino','Luanda','Prenda','1982-12-10','997994777','07a4433fd',0,'2022-12-23 20:48:08','2022-12-23 20:48:08');
/*!40000 ALTER TABLE `sg_encarregado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sg_exame`
--

DROP TABLE IF EXISTS `sg_exame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sg_exame` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idEstudante` int DEFAULT NULL,
  `idDisciplina` int DEFAULT NULL,
  `idNotas` int DEFAULT NULL,
  `normal` float DEFAULT NULL,
  `recorrencia` float DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `dataModificacao` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEstudante` (`idEstudante`),
  KEY `idDisciplina` (`idDisciplina`),
  KEY `idNotas` (`idNotas`),
  CONSTRAINT `fk_aluno_n` FOREIGN KEY (`idEstudante`) REFERENCES `sg_aluno` (`id_a`),
  CONSTRAINT `fk_disciplina_n` FOREIGN KEY (`idDisciplina`) REFERENCES `sg_disciplina` (`id_d`),
  CONSTRAINT `fk_notas_n` FOREIGN KEY (`idNotas`) REFERENCES `sg_notas` (`id_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sg_exame`
--

LOCK TABLES `sg_exame` WRITE;
/*!40000 ALTER TABLE `sg_exame` DISABLE KEYS */;
/*!40000 ALTER TABLE `sg_exame` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sg_gerenciar`
--

DROP TABLE IF EXISTS `sg_gerenciar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sg_gerenciar` (
  `id_g` int NOT NULL AUTO_INCREMENT,
  `idDisciplina` int DEFAULT NULL,
  `idProfessor` int DEFAULT NULL,
  `idTurma` int DEFAULT NULL,
  `ano` year DEFAULT NULL,
  PRIMARY KEY (`id_g`),
  KEY `idDisciplina` (`idDisciplina`),
  KEY `idProfessor` (`idProfessor`),
  KEY `idTurma` (`idTurma`),
  CONSTRAINT `fk_disciplina` FOREIGN KEY (`idDisciplina`) REFERENCES `sg_disciplina` (`id_d`),
  CONSTRAINT `fk_professor` FOREIGN KEY (`idProfessor`) REFERENCES `sg_professor` (`id_p`),
  CONSTRAINT `fk_turma` FOREIGN KEY (`idTurma`) REFERENCES `sg_turma` (`id_t`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sg_gerenciar`
--

LOCK TABLES `sg_gerenciar` WRITE;
/*!40000 ALTER TABLE `sg_gerenciar` DISABLE KEYS */;
INSERT INTO `sg_gerenciar` VALUES (1,3,1,7,2022),(2,2,2,7,2022),(3,2,3,12,2022),(4,1,4,12,2022),(5,6,6,7,2022),(6,4,5,7,2022),(7,7,2,7,2022);
/*!40000 ALTER TABLE `sg_gerenciar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sg_notas`
--

DROP TABLE IF EXISTS `sg_notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sg_notas` (
  `id_nota` int NOT NULL AUTO_INCREMENT,
  `id_gerenciar` int DEFAULT NULL,
  `id_aluno` int DEFAULT NULL,
  `id_trimestre` int DEFAULT NULL,
  `avaliacao1` float DEFAULT '0',
  `avaliacao2` float DEFAULT '0',
  `avaliacao3` float DEFAULT '0',
  `prova1` float DEFAULT '0',
  `prova2` float DEFAULT '0',
  `mediaAv` float DEFAULT '0',
  `mediaPv` float DEFAULT '0',
  `mediaF` float DEFAULT NULL,
  `classificacao` varchar(30) DEFAULT 'nenhuma',
  PRIMARY KEY (`id_nota`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sg_notas`
--

LOCK TABLES `sg_notas` WRITE;
/*!40000 ALTER TABLE `sg_notas` DISABLE KEYS */;
INSERT INTO `sg_notas` VALUES (1,1,1,1,0,7,2,7,10.5,3,8.75,6.83333,'Aprovado'),(2,2,3,1,11,0,7,8,9,6,8.5,7.66667,'Aprovado'),(3,2,1,1,4,5,4,5.5,5,4.33333,5.25,4.94444,'reprovado'),(4,2,3,2,4.5,3,2,4,5,3.16667,4.5,4.05556,'reprovado'),(5,2,1,2,11.5,3,1,4,5,5.16667,4.5,4.72222,'reprovado'),(6,2,3,3,1,2,3,2,7,2,4.5,3.66667,'reprovado'),(7,2,1,3,1,5,10,5,8,5.33333,6.5,6.11111,'Aprovado'),(8,1,3,1,5,7,7,7,8,6.33333,7.5,7.11111,'Aprovado'),(9,1,7,1,9,0,3,7,11,4,9,7.33333,'Aprovado'),(10,3,2,1,4,0,6,7,5.5,3.33333,6.25,5.27778,'reprovado'),(11,3,4,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(12,3,6,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(13,3,5,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(14,3,8,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(15,4,2,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(16,4,4,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(17,4,6,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(18,4,5,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(19,4,8,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(20,1,2,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(21,1,6,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(22,1,5,1,0,0,0,0,0,0,0,NULL,'nenhuma'),(23,2,7,1,1,4,5,8,4,3.33333,6,5.11111,'Aprovado'),(24,1,3,2,0,0,0,0,0,0,0,NULL,'nenhuma'),(25,1,7,2,7,4,1,1,2,4,1.5,2.33333,'reprovado'),(26,1,1,2,7,8,1,5,7,5.33333,6,5.77778,'Aprovado'),(27,2,7,2,7,1,2.5,7.5,3,3.5,5.25,4.66667,'reprovado'),(28,2,7,3,4,1,7,8,5,4,6.5,5.66667,'Aprovado'),(29,1,3,3,0,0,0,0,0,0,0,NULL,'nenhuma'),(30,1,7,3,0,0,0,0,0,0,0,NULL,'nenhuma'),(31,1,1,3,4,7,4,1,10,5,5.5,5.33333,'Aprovado'),(32,6,3,1,7,5,8,4,3,6.66667,3.5,4.55556,'reprovado'),(33,6,7,1,2,4,6,7,8,4,7.5,6.33333,'Aprovado'),(34,6,1,1,1,2,6,1,5,3,3,3,'reprovado'),(35,6,3,2,7,2,1,3,2,3.33333,2.5,2.77778,'reprovado'),(36,6,7,2,4,1,2,7,5,2.33333,6,4.77778,'reprovado'),(37,6,1,2,1,2,7,7,4,3.33333,5.5,4.77778,'reprovado'),(38,6,3,3,1,2,5,7,9,2.66667,8,6.22222,'Aprovado'),(39,6,7,3,7,9,2,7,4,6,5.5,5.66667,'Aprovado'),(40,6,1,3,4,7,5,7,5,5.33333,6,5.77778,'Aprovado'),(41,5,3,1,4,7,9,7,5,6.66667,6,6.22222,'Aprovado'),(42,5,7,1,4,7,5,8,9,5.33333,8.5,7.44444,'Aprovado'),(43,5,1,1,1,5,3,7,4,3,5.5,4.66667,'reprovado'),(44,5,3,2,4,7,9,8,4,6.66667,6,6.22222,'Aprovado'),(45,5,7,2,7,8,6,2,3,7,2.5,4,'reprovado'),(46,5,1,2,1,2,3,5,6,2,5.5,4.33333,'reprovado'),(47,5,3,3,7,5,2,7,6,4.66667,6.5,5.88889,'Aprovado'),(48,5,7,3,7,5,2,4,3,4.66667,3.5,3.88889,'reprovado'),(49,5,1,3,8,9,3,1,2,6.66667,1.5,3.22222,'reprovado'),(50,7,3,1,4,4,6,4,9,4.66667,6.5,5.88889,'Aprovado'),(51,7,7,1,9,7,3,4,2,6.33333,3,4.11111,'reprovado'),(52,7,1,1,7,2,0,5.5,9,3,7.25,5.83333,'Aprovado'),(53,7,3,2,2,3,7,9,1,4,5,4.66667,'reprovado'),(54,7,7,2,7,8,2,2.5,10,5.66667,6.25,6.05556,'Aprovado'),(55,7,1,2,4,5,7,2,5,5.33333,3.5,4.11111,'reprovado'),(56,7,3,3,4,7,9,7,8,6.66667,7.5,7.22222,'Aprovado'),(57,7,7,3,4,5,3,4,8,4,6,5.33333,'Aprovado'),(58,7,1,3,5,8,7,11,3,6.66667,7,6.88889,'Aprovado');
/*!40000 ALTER TABLE `sg_notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sg_professor`
--

DROP TABLE IF EXISTS `sg_professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sg_professor` (
  `id_p` int NOT NULL AUTO_INCREMENT,
  `idUsuario` int DEFAULT NULL,
  `nome_p` varchar(40) DEFAULT NULL,
  `email_p` varchar(30) NOT NULL,
  `municipio_p` varchar(30) NOT NULL,
  `bairro_p` varchar(30) NOT NULL,
  `contato_p` varchar(10) NOT NULL,
  `sexo_p` varchar(13) NOT NULL,
  `nascimento_p` date NOT NULL,
  `numeroBI_p` varchar(20) NOT NULL,
  `view` tinyint(1) DEFAULT NULL,
  `dataCadastro_p` datetime DEFAULT NULL,
  `dataModificacao_p` datetime DEFAULT NULL,
  PRIMARY KEY (`id_p`),
  KEY `fk_usuario_p_idx` (`idUsuario`),
  CONSTRAINT `fk_usuario_p` FOREIGN KEY (`idUsuario`) REFERENCES `sg_usuarios` (`id_u`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sg_professor`
--

LOCK TABLES `sg_professor` WRITE;
/*!40000 ALTER TABLE `sg_professor` DISABLE KEYS */;
INSERT INTO `sg_professor` VALUES (1,4,'Patricia Mhongo Jack dos Santos','paty@gmail.com','Kilamba Kiaxi','kimbango','900001002','Femenino','1982-07-21','w23r734t5',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(2,8,'Romário Tavares da Silva','Romario@gmail.com','Belas','kilamba','901112233','Masculino','1981-07-23','gh3r733t5',1,'2022-12-01 12:47:48','2022-12-22 18:27:21'),(3,9,'Silvio Pemba Bastos','Sivi@gmail.com','Viana','mama gorda','989741088','Masculino','1974-08-17','t56df465u',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(4,18,'Gustavo Matias Figueiredo','Guty@hotmail.com','Luanda','maianga','918771011','Masculino','1984-10-15','67tdf412v',1,'2022-12-01 12:47:48','2022-12-01 13:05:20'),(5,19,'Nemo Silva mavinga','Nelmo@hotmail.com','Luanda','Maianga','900302210','Masculino','1978-02-14','k7a4dl1fd',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(6,20,'Branca Gustavo Fírmino da Costa','branca@hotmail.com','Luanda','Prenda','909998788','Femenino','1973-05-20','74a23w3fd',1,'2022-12-01 12:47:48','2022-12-22 18:25:23'),(7,31,'martinho Kussaca Nevide','Martin@hotmail.com','Cacuaco','cefa','972721413','Masculino','1975-07-10','jw2je9hj1',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(8,34,'Gaiser Alexo domingos Rudes','Gair@gmail.com','Viana','km14','930030303','Masculino','1977-09-07','07a4913fd',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(9,38,'Walter cipriano Bungula','w@gmail.com','Cazenga','abete','987744175','Masculino','1980-02-10','po2j19hj0',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(10,39,'Fielo Mavinga Koverin Mzanda','Fiel@hotmail.com','Talatona','zone','911110177','Masculino','1984-03-12','00a4353fd',1,'2022-12-01 13:08:44','2023-07-05 21:57:52'),(11,42,'Karina Buleão Mavinga','kar@gmail.ciom','Luanda','Mutamba','956574110','Femenino','1981-05-24','75qw353fd',1,'2022-12-23 20:41:15','2022-12-23 20:41:15');
/*!40000 ALTER TABLE `sg_professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sg_turma`
--

DROP TABLE IF EXISTS `sg_turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sg_turma` (
  `id_t` int NOT NULL AUTO_INCREMENT,
  `nome_t` varchar(40) DEFAULT NULL,
  `idClasse_t` int NOT NULL,
  PRIMARY KEY (`id_t`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sg_turma`
--

LOCK TABLES `sg_turma` WRITE;
/*!40000 ALTER TABLE `sg_turma` DISABLE KEYS */;
INSERT INTO `sg_turma` VALUES (1,'01-A',1),(2,'01-B',1),(3,'02-A',2),(4,'02-B',2),(5,'03-A',3),(6,'03-B',3),(7,'04-A',4),(8,'04-B',4),(9,'05-A',5),(10,'05-B',5),(11,'08-A',8),(12,'08-B',8),(13,'09-A',9),(14,'09-B',9),(15,'06-A',6),(16,'06-B',6);
/*!40000 ALTER TABLE `sg_turma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sg_usuarios`
--

DROP TABLE IF EXISTS `sg_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sg_usuarios` (
  `id_u` int NOT NULL AUTO_INCREMENT,
  `nome_u` varchar(35) DEFAULT NULL,
  `senha_u` varchar(255) DEFAULT NULL,
  `estado_u` varchar(30) DEFAULT NULL,
  `painel_u` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `view` tinyint(1) DEFAULT NULL,
  `dataCadastro_u` datetime DEFAULT NULL,
  `dataModificacao_u` datetime DEFAULT NULL,
  PRIMARY KEY (`id_u`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sg_usuarios`
--

LOCK TABLES `sg_usuarios` WRITE;
/*!40000 ALTER TABLE `sg_usuarios` DISABLE KEYS */;
INSERT INTO `sg_usuarios` VALUES (1,'Afonso da Trindade','$2y$10$pS.SKg3YbN3KMzRpA6wHp.s9zyanmni5MgU6YfAUY0kH9IUDPcT02','activo','admin',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(2,'Silvia Miguel Kiluange Nzola','$2y$10$ASxzP9OTa3sLyJlSp/nol.1lA3lAPhg.qtvW51nHU2RlP/D8XBIs6','activo','encarregado',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(3,'Carla Miguel Bastos Mora','$2y$10$w14qsPmHhgTkj35txKvf8.pgfTJnUbjrJSGNz3.7w/We4KDNMcW/G','activo','aluno',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(4,'Patricia Mhongo Jack dos Santos','$2y$10$XtamVVh1P4MDBzsbTFlt0.cm/YMiEEzeodNEALs.f/ZMke1WXp6WO','activo','professor',0,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(5,'Adelino Miguel Bastos Mora','$2y$10$w14qsPmHhgTkj35txKvf8.pgfTJnUbjrJSGNz3.7w/We4KDNMcW/G','activo','aluno',0,'2022-12-01 12:47:48','2022-12-01 13:12:53'),(6,'Fonseca Luvuma Mateus','$2y$10$ASxzP9OTa3sLyJlSp/nol.1lA3lAPhg.qtvW51nHU2RlP/D8XBIs6','activo','encarregado',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(7,'Armando Luvuma Boreon Mateus','$2y$10$w14qsPmHhgTkj35txKvf8.pgfTJnUbjrJSGNz3.7w/We4KDNMcW/G','activo','aluno',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(8,'Romário Tavares da Silva','$2y$10$CGARoNfCZWyK2HD8Vf2gmuQPjtAr6n9MYYtM.uxMC0mWtc0etVAXi','activo','professor',1,'2022-12-01 12:47:48','2022-12-22 18:27:21'),(9,'Silvio Pemba Bastos','$2y$10$CGARoNfCZWyK2HD8Vf2gmuQPjtAr6n9MYYtM.uxMC0mWtc0etVAXi','activo','professor',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(10,'Maria Teixeira Muniz Catoka','$2y$10$ASxzP9OTa3sLyJlSp/nol.1lA3lAPhg.qtvW51nHU2RlP/D8XBIs6','activo','encarregado',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(11,'Victor Almeida Kituxi Luegi','$2y$10$ASxzP9OTa3sLyJlSp/nol.1lA3lAPhg.qtvW51nHU2RlP/D8XBIs6','activo','encarregado',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(12,'Daniel Lussoco Monteiro','$2y$10$ASxzP9OTa3sLyJlSp/nol.1lA3lAPhg.qtvW51nHU2RlP/D8XBIs6','activo','encarregado',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(13,'Estelvio Quitura Kituxi Luegi','$2y$10$w14qsPmHhgTkj35txKvf8.pgfTJnUbjrJSGNz3.7w/We4KDNMcW/G','activo','aluno',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(14,'Otavia Quitura Almeida Kituxi Luegi','$2y$10$w14qsPmHhgTkj35txKvf8.pgfTJnUbjrJSGNz3.7w/We4KDNMcW/G','activo','aluno',0,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(15,'Maria Francisca Lussoco Monteiro','$2y$10$w14qsPmHhgTkj35txKvf8.pgfTJnUbjrJSGNz3.7w/We4KDNMcW/G','activo','aluno',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(16,'Bruno Ribeiro Lussoco Monteiro','$2y$10$w14qsPmHhgTkj35txKvf8.pgfTJnUbjrJSGNz3.7w/We4KDNMcW/G','activo','aluno',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(17,'Sara Francisca Lussoco Monteiro','$2y$10$w14qsPmHhgTkj35txKvf8.pgfTJnUbjrJSGNz3.7w/We4KDNMcW/G','activo','aluno',0,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(18,'Gustavo Matias Figueiredo','$2y$10$CGARoNfCZWyK2HD8Vf2gmuQPjtAr6n9MYYtM.uxMC0mWtc0etVAXi','activo','professor',0,'2022-12-01 12:47:48','2022-12-01 13:05:20'),(19,'Nemo Silva mavinga','$2y$10$CGARoNfCZWyK2HD8Vf2gmuQPjtAr6n9MYYtM.uxMC0mWtc0etVAXi','activo','professor',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(20,'Branca Gustavo Fírmino da Costa','$2y$10$CGARoNfCZWyK2HD8Vf2gmuQPjtAr6n9MYYtM.uxMC0mWtc0etVAXi','activo','professor',0,'2022-12-01 12:47:48','2022-12-22 18:25:23'),(21,'Exemplo','$2y$10$cUq8q4YPyZjM/usNGKK5Teto68b6v7.SuRiETFxEal9DPNR.6xlvm','activo','aluno',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(22,'Biatriz Eliza Moreira','$2y$10$RSPUMVVul4aZwoxGg4LkZef3NO5tf/dfgb2YAzCve2U0BVAgMX666','activo','encarregado',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(31,'martinho Kussaca Nevide','$2y$10$kHYIIxfeYhMPyTvcG/SBOe4dMg918lC0qAMlcYrNL1/1J3PQy5n.u','activo','professor',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(32,'Zarcia Moutinho Silva Mourinho','$2y$10$9z1B3es9iDnCy6WS9NBb8eLFn5G96OgJSdijTAreS59QeqZWgjO.m','activo','encarregado',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(34,'Gaiser Alexo domingos Rudes','$2y$10$GRJfnOuADOXXnnRpol54euQBBZXAraruyWg9B068pab/JYsxmfEo.','activo','professor',0,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(35,'Jordao Ambrosio de Lemos','$2y$10$kmhHK4NbILBJTbphdVcta.qdncOuxZXzVWEx3/1WEsjFqLY5B7JOa','activo','encarregado',1,'2022-12-01 12:47:48','2022-12-01 13:18:48'),(36,'Alex berno muniz Nluvua','$2y$10$F6m..dXwTfMaND9ppDfhYOR7A2DxE3K2HxBoRKxd4Mbr.mYOmPmTC','activo','aluno',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(37,'Nelsa Duda Siilva Mourinho','$2y$10$fVa2umdlc3v4a9TNMh99g./8TozMQrAelQi0OKKa/jTO3nRyBu0om','activo','aluno',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(38,'Walter cipriano Bungula','$2y$10$K8DSClORPSg8Q01h5rC7L.jClBv2B0OIZuMMlHeOxX8nsrWLrNLlS','activo','professor',1,'2022-12-01 12:47:48','2022-12-01 12:47:48'),(39,'Fielo Mavinga Koverin Mzanda','$2y$10$DEvjw02qvz2Neg5dedB8nOnKmVVGdO0L3wcP5uhbjpciQnIU4zDV6','activo','professor',0,'2022-12-01 13:08:44','2023-07-05 21:57:52'),(40,'Felicia Dendo Muniz Catoka Nvunge','$2y$10$Pu46P8xpnvssvNiU8gEJpuF1lT32U1YR0AuQCP2Nc9KvLTSiz6Qli','activo','aluno',1,'2022-12-01 13:16:18','2022-12-01 13:16:18'),(41,'Maria Estefania Campos','$2y$10$P1O9Op0S.TfN0N2LnOm9lumLc9n.Bacnmfp4PN8buJldsqC7b3cHq','activo','encarregado',1,'2022-12-01 13:20:26','2022-12-01 13:20:26'),(42,'Karina Buleão Mavinga','$2y$10$BPaSyHOrtqT8jARCAsRFcugZLXTw.3I0XRW8ehpyGMY5MygHFkbLK','activo','professor',0,'2022-12-23 20:41:15','2022-12-23 20:41:15'),(43,'Abel Francisco dos Santos','$2y$10$LyZvsX/jISigPiASE/cYx.kU89Xt4dCwRQzxEg0SOXUelctVVh/wW','activo','encarregado',0,'2022-12-23 20:48:08','2022-12-23 20:48:08');
/*!40000 ALTER TABLE `sg_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-09  0:53:12
