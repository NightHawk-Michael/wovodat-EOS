-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Database: `wovodatdb`
--
CREATE DATABASE IF NOT EXISTS `wovodatdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `wovodatdb`;
-- --------------------------------------------------------

--
-- Table structure for table `cb`
--


CREATE TABLE IF NOT EXISTS `cb` (
  `cb_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Bibliographic data ID',
  `cb_auth` varchar(255) DEFAULT NULL COMMENT 'Authors/Editors',
  `cb_year` year(4) DEFAULT NULL COMMENT 'Publication year',
  `cb_title` varchar(255) DEFAULT NULL COMMENT 'Title',
  `cb_journ` varchar(255) DEFAULT NULL COMMENT 'Journal',
  `cb_vol` varchar(20) DEFAULT NULL COMMENT 'Volume',
  `cb_pub` varchar(50) DEFAULT NULL COMMENT 'Publisher',
  `cb_page` varchar(30) DEFAULT NULL COMMENT 'Pages number',
  `cb_doi` varchar(20) DEFAULT NULL COMMENT 'Digital Object Identifier',
  `cb_isbn` varchar(13) DEFAULT NULL COMMENT 'International Standard Book Number',
  `cb_url` varchar(255) DEFAULT NULL COMMENT 'Info on the web',
  `cb_labadr` varchar(320) DEFAULT NULL COMMENT 'Email address of observatory or laboratory',
  `cb_keywords` varchar(255) DEFAULT NULL COMMENT 'Keywords',
  `cb_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cb_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID (link to cc.cc_id)',
  PRIMARY KEY (`cb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Bibliographic' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cc`
--

CREATE TABLE IF NOT EXISTS `cc` (
  `cc_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Contact ID',
  `cc_code` varchar(15) DEFAULT NULL COMMENT 'Code',
  `cc_code2` varchar(15) DEFAULT NULL COMMENT 'Alias of cc_code (contact code)',
  `cc_fname` varchar(30) DEFAULT NULL COMMENT 'First name',
  `cc_lname` varchar(30) DEFAULT NULL COMMENT 'Last name',
  `cc_obs` varchar(150) DEFAULT NULL COMMENT 'Observatory',
  `cc_add1` varchar(60) DEFAULT NULL COMMENT 'Address 1',
  `cc_add2` varchar(60) DEFAULT NULL COMMENT 'Address 2',
  `cc_city` varchar(50) DEFAULT NULL COMMENT 'City',
  `cc_state` varchar(30) DEFAULT NULL COMMENT 'State',
  `cc_country` varchar(50) DEFAULT NULL COMMENT 'Country',
  `cc_post` varchar(30) DEFAULT NULL COMMENT 'Postal code',
  `cc_url` varchar(255) DEFAULT NULL COMMENT 'Web address',
  `cc_email` varchar(320) DEFAULT NULL COMMENT 'Email',
  `cc_phone` varchar(50) DEFAULT NULL COMMENT 'Phone',
  `cc_phone2` varchar(50) DEFAULT NULL COMMENT 'Phone 2',
  `cc_fax` varchar(60) DEFAULT NULL COMMENT 'Fax',
  `cc_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  PRIMARY KEY (`cc_id`),
  UNIQUE KEY `CODE` (`cc_code`),
  UNIQUE KEY `CODE2` (`cc_code2`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Contact' AUTO_INCREMENT=307 ;

-- --------------------------------------------------------

--
-- Table structure for table `ch`
--

CREATE TABLE IF NOT EXISTS `ch` (
  `ch_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ch_linkname` enum('cb','cc','ch','cm','cn','co','cp','cr','cr_tmp','cs','cu','dd_ang','dd_edm','dd_gps','dd_gpv','dd_lev','dd_sar','dd_srd','dd_str','dd_tlt','dd_tlv','di_gen','di_tlt','ds','ed','ed_for','ed_phs','ed_vid','fd_ele','fd_gra','fd_mag','fd_mgv','fi','fs','gd','gd_plu','gd_sol','gi','gs','hd','hi','hs','ip_hyd','ip_mag','ip_pres','ip_sat','ip_tec','jj_concon','jj_imgx','jj_subnet','jj_volcon','jj_volnet','j_sarsat','md','med','mi','ms','sd_evn','sd_evs','sd_int','sd_ivl','sd_rsm','sd_sam','sd_ssm','sd_trm','sd_wav','si','si_cmp','sn','ss','st_eqt','td','td_img','td_pix','ti','ts','vd','vd_inf','vd_mag','vd_tec') DEFAULT NULL COMMENT 'Table',
  `ch_link_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Link ID',
  `ch_atname` varchar(30) DEFAULT NULL COMMENT 'Field name',
  `ch_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `ch_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `ch_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID (link to cc.cc_id)',
  PRIMARY KEY (`ch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Change' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cm`
--

CREATE TABLE IF NOT EXISTS `cm` (
  `cm_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cm_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID (link to vd.vd_id)',
  `cm_lat` double DEFAULT NULL COMMENT 'Latitude',
  `cm_lon` double DEFAULT NULL COMMENT 'Longitude',
  `cm_location` varchar(255) DEFAULT NULL COMMENT 'Location',
  `cm_description` varchar(255) DEFAULT NULL COMMENT 'Description',
  `cm_format` varchar(10) DEFAULT NULL COMMENT 'Format',
  `cm_date` datetime DEFAULT NULL COMMENT 'Date',
  `cm_date_unc` datetime DEFAULT NULL COMMENT 'Date uncertainty',
  `cm_image` varchar(255) DEFAULT NULL COMMENT 'Data',
  `cm_usage` varchar(255) DEFAULT NULL COMMENT 'Usage',
  `cm_keywords` varchar(255) DEFAULT NULL COMMENT 'Keywords',
  `cm_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original for observatory',
  `cm_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID (link to cc.cc_id)',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `cm_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cm_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID (link to cc.cc_id)',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`cm_id`),
  KEY `OWNER 1` (`cc_id`),
  KEY `CODE` (`cm_code`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Image' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cn`
--

CREATE TABLE IF NOT EXISTS `cn` (
  `cn_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cn_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `cn_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `cn_type` enum('Deformation','Fields','Gas','Hydrologic','Thermal','Meteo','Unknown') NOT NULL DEFAULT 'Unknown' COMMENT 'Type',
  `cn_area` float DEFAULT NULL COMMENT 'Area',
  `cn_map` varchar(255) DEFAULT NULL COMMENT 'Map',
  `cn_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start time',
  `cn_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `cn_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End time',
  `cn_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `cn_utc` float DEFAULT NULL COMMENT 'Difference from UTC',
  `cn_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `cn_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `cn_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `cn_loaddate` datetime NOT NULL COMMENT 'Load date',
  `cn_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`cn_id`),
  KEY `CODE` (`cn_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `TYPE` (`cn_type`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Common network' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `co`
--

CREATE TABLE IF NOT EXISTS `co` (
  `co_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `co_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `co_observe` text COMMENT 'Description',
  `co_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `co_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `co_etime` datetime DEFAULT NULL COMMENT 'End time',
  `co_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `co_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Observer ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `co_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `co_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`co_id`),
  KEY `CODE` (`co_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Observation' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cp`
--

CREATE TABLE IF NOT EXISTS `cp` (
  `cp_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cr_id` tinyint(3) unsigned DEFAULT NULL COMMENT 'Registry ID',
  `cp_access` enum('0','1','2','3','4','5','6','7','8','9') NOT NULL DEFAULT '9' COMMENT 'Access level: 0=Developer, 9=Minimum access',
  `cp_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`cp_id`),
  UNIQUE KEY `REGISTERED USER` (`cr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Permission' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cr`
--

CREATE TABLE IF NOT EXISTS `cr` (
  `cr_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'User ID',
  `cr_uname` varchar(30) NOT NULL COMMENT 'Username',
  `cr_pwd` varchar(200) DEFAULT NULL COMMENT 'Password',
  `cr_regdate` datetime DEFAULT NULL COMMENT 'Registration date',
  `cr_update` datetime DEFAULT NULL COMMENT 'Last update',
  PRIMARY KEY (`cr_id`),
  UNIQUE KEY `USERNAME` (`cr_uname`),
  UNIQUE KEY `CONTACT` (`cc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Registry' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cr_tmp`
--

CREATE TABLE IF NOT EXISTS `cr_tmp` (
  `cr_tmp_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cr_tmp_time` datetime NOT NULL COMMENT 'Time',
  `cr_tmp_email` varchar(320) NOT NULL COMMENT 'Email',
  `cr_tmp_fname` varchar(30) DEFAULT NULL COMMENT 'First name',
  `cr_tmp_lname` varchar(30) DEFAULT NULL COMMENT 'Last name',
  `cr_tmp_obs` varchar(150) DEFAULT NULL COMMENT 'Observatory',
  `cr_tmp_add1` varchar(60) DEFAULT NULL COMMENT 'Address 1',
  `cr_tmp_add2` varchar(60) DEFAULT NULL COMMENT 'Address 2',
  `cr_tmp_city` varchar(50) DEFAULT NULL COMMENT 'City',
  `cr_tmp_state` varchar(30) DEFAULT NULL COMMENT 'State',
  `cr_tmp_country` varchar(50) DEFAULT NULL COMMENT 'Country',
  `cr_tmp_post` varchar(30) DEFAULT NULL COMMENT 'Postal code',
  `cr_tmp_url` varchar(255) DEFAULT NULL COMMENT 'Web address',
  `cr_tmp_phone` varchar(50) DEFAULT NULL COMMENT 'Phone',
  `cr_tmp_phone2` varchar(50) DEFAULT NULL COMMENT 'Phone 2',
  `cr_tmp_fax` varchar(60) DEFAULT NULL COMMENT 'Fax',
  `cr_tmp_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cr_tmp_uname` varchar(30) NOT NULL COMMENT 'Username',
  `cr_tmp_pwd` varchar(200) DEFAULT NULL COMMENT 'Password',
  PRIMARY KEY (`cr_tmp_id`),
  UNIQUE KEY `USERNAME` (`cr_tmp_uname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Temporary registry' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cs`
--

CREATE TABLE IF NOT EXISTS `cs` (
  `cs_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cs_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `cs_type` enum('S','A') DEFAULT NULL COMMENT 'Type (A=Airplane, S=Satellite)',
  `cs_name` varchar(50) DEFAULT NULL COMMENT 'Name',
  `cs_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start time',
  `cs_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `cs_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End time',
  `cs_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `cs_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `cs_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `cs_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `cs_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cs_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`cs_id`),
  KEY `CODE` (`cs_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Satellite' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cu`
--

CREATE TABLE IF NOT EXISTS `cu` (
  `cu_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cu_file` varchar(255) NOT NULL COMMENT 'Original file name',
  `cu_type` enum('P','PE','TBP','T','TE','TBT','U','O') DEFAULT NULL COMMENT 'Type of upload: P=Processed, PE=Process Error, TBP=To Be Processed, T=Translated, TE=Translation Error, TBT=To Be Translated, U=Undone, O=Others',
  `cu_com` text COMMENT 'Comments or error message',
  `cu_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`cu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Upload history' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dd_ang`
--

CREATE TABLE IF NOT EXISTS `dd_ang` (
  `dd_ang_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_ang_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `di_gen_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'General deformation instrument ID',
  `ds_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Instrument station ID',
  `ds_id1` mediumint(8) unsigned DEFAULT NULL COMMENT 'Target station 1 ID',
  `ds_id2` mediumint(8) unsigned DEFAULT NULL COMMENT 'Target station 2 ID',
  `dd_ang_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `dd_ang_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `dd_ang_hort1` float DEFAULT NULL COMMENT 'Horizontal angle to target 1',
  `dd_ang_hort2` float DEFAULT NULL COMMENT 'Horizontal angle to target 2',
  `dd_ang_vert1` float DEFAULT NULL COMMENT 'Vertical angle to target 1',
  `dd_ang_vert2` float DEFAULT NULL COMMENT 'Vertical angle to target 2',
  `dd_ang_herr1` float DEFAULT NULL COMMENT 'Horizontal error on angle 1',
  `dd_ang_herr2` float DEFAULT NULL COMMENT 'Horizontal error on angle 2',
  `dd_ang_verr1` float DEFAULT NULL COMMENT 'Vertical error on angle 1',
  `dd_ang_verr2` float DEFAULT NULL COMMENT 'Vertical error on angle 2',
  `dd_ang_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `dd_ang_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `dd_ang_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `dd_ang_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`dd_ang_id`),
  KEY `CODE` (`dd_ang_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ds_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Angle' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dd_edm`
--

CREATE TABLE IF NOT EXISTS `dd_edm` (
  `dd_edm_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_edm_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `di_gen_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'General deformation instrument ID',
  `ds_id1` mediumint(8) unsigned DEFAULT NULL COMMENT 'Instrument station ID',
  `ds_id2` mediumint(8) unsigned DEFAULT NULL COMMENT 'Target station ID',
  `dd_edm_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `dd_edm_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `dd_edm_line` double DEFAULT NULL COMMENT 'Line length',
  `dd_edm_cerr` float DEFAULT NULL COMMENT 'Constant error',
  `dd_edm_serr` float DEFAULT NULL COMMENT 'Scale error',
  `dd_edm` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `dd_edm_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `dd_edm_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `dd_edm_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`dd_edm_id`),
  KEY `CODE` (`dd_edm_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ds_id1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='EDM' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dd_gps`
--

CREATE TABLE IF NOT EXISTS `dd_gps` (
  `dd_gps_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_gps_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `di_gen_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'General deformation instrument ID',
  `ds_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'GPS station ID',
  `ds_id_ref1` mediumint(8) unsigned DEFAULT NULL COMMENT 'Reference station 1 ID',
  `ds_id_ref2` mediumint(8) unsigned DEFAULT NULL COMMENT 'Reference station 2 ID',
  `dd_gps_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `dd_gps_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `dd_gps_lat` double DEFAULT NULL COMMENT 'Latitude',
  `dd_gps_lon` double DEFAULT NULL COMMENT 'Longitude',
  `dd_gps_elev` double DEFAULT NULL COMMENT 'Elevation',
  `dd_gps_nserr` double DEFAULT NULL COMMENT 'N-S error',
  `dd_gps_ewerr` double DEFAULT NULL COMMENT 'E-W error',
  `dd_gps_verr` float DEFAULT NULL COMMENT 'Vertical error',
  `dd_gps_software` varchar(50) DEFAULT NULL COMMENT 'Position-determining software',
  `dd_gps_orbits` varchar(255) DEFAULT NULL COMMENT 'Orbits used',
  `dd_gps_dur` varchar(255) DEFAULT NULL COMMENT 'Duration of the solution',
  `dd_gps_qual` enum('E','G','P','U') DEFAULT NULL COMMENT 'Quality: E=Excellent, G=Good, P=Poor, U=Unknown',
  `dd_gps_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `dd_gps_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `dd_gps_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `dd_gps_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`dd_gps_id`),
  KEY `CODE` (`dd_gps_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ds_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='GPS' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dd_gpv`
--

CREATE TABLE IF NOT EXISTS `dd_gpv` (
  `dd_gpv_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_gpv_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `di_gen_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'General deformation instrument',
  `ds_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Deformation station ID',
  `dd_gpv_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `dd_gpv_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `dd_gpv_etime` datetime DEFAULT NULL COMMENT 'End time',
  `dd_gpv_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `dd_gpv_dmag` float DEFAULT NULL COMMENT 'Displacement magnitude',
  `dd_gpv_daz` float DEFAULT NULL COMMENT 'Displacement azimuth',
  `dd_gpv_vincl` float DEFAULT NULL COMMENT 'Vector inclination',
  `dd_gpv_N` float DEFAULT NULL COMMENT 'North displacement',
  `dd_gpv_E` float DEFAULT NULL COMMENT 'East displacement',
  `dd_gpv_vert` float DEFAULT NULL COMMENT 'Vertical displacement',
  `dd_gpv_dherr` float DEFAULT NULL COMMENT 'Magnitude horizontal uncertainty',
  `dd_gpv_dnerr` float DEFAULT NULL COMMENT 'North displacement uncertainty',
  `dd_gpv_deerr` float DEFAULT NULL COMMENT 'East displacement uncertainty',
  `dd_gpv_dverr` float DEFAULT NULL COMMENT 'Magnitude vertical uncertainty',
  `dd_gpv_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `dd_gpv_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `dd_gpv_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `dd_gpv_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`dd_gpv_id`),
  KEY `CODE` (`dd_gpv_code`),
  KEY `STATION` (`ds_id`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='GPS vector' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dd_lev`
--

CREATE TABLE IF NOT EXISTS `dd_lev` (
  `dd_lev_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_lev_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `di_gen_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'General deformation instrument ID',
  `ds_id_ref` mediumint(8) unsigned DEFAULT NULL COMMENT 'Reference benchmark ID',
  `ds_id1` mediumint(8) unsigned DEFAULT NULL COMMENT 'First benchmark (n) ID',
  `ds_id2` mediumint(8) unsigned DEFAULT NULL COMMENT 'Second benchmark (n+1) ID',
  `dd_lev_ord` mediumint(9) DEFAULT NULL COMMENT 'Order',
  `dd_lev_class` varchar(30) DEFAULT NULL COMMENT 'Class',
  `dd_lev_time` datetime DEFAULT NULL COMMENT 'Survey date',
  `dd_lev_time_unc` datetime DEFAULT NULL COMMENT 'Survey date uncertainty',
  `dd_lev_delev` float DEFAULT NULL COMMENT 'Elevation change',
  `dd_lev_herr` float DEFAULT NULL COMMENT 'Elevation change uncertainty',
  `dd_lev_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `dd_lev_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `dd_lev_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `dd_lev_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`dd_lev_id`),
  KEY `CODE` (`dd_lev_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ds_id_ref`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Leveling' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dd_sar`
--

CREATE TABLE IF NOT EXISTS `dd_sar` (
  `dd_sar_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_sar_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `di_gen_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'General deformation instrument ID',
  `cs_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Satellite ID',
  `dd_sar_slat` double DEFAULT NULL COMMENT 'Starting latitude',
  `dd_sar_slon` double DEFAULT NULL COMMENT 'Starting longitude',
  `dd_sar_spos` enum('BLC','TLC') DEFAULT NULL COMMENT 'Starting position: BLC=Bottom Left Corner, TLC=Top Left Corner',
  `dd_sar_rord` varchar(30) DEFAULT NULL COMMENT 'Row order',
  `dd_sar_nrows` smallint(5) unsigned DEFAULT NULL COMMENT 'Number of rows',
  `dd_sar_ncols` smallint(5) unsigned DEFAULT NULL COMMENT 'Number of columns',
  `dd_sar_units` varchar(30) DEFAULT NULL COMMENT 'Units',
  `dd_sar_ndata` varchar(30) DEFAULT NULL COMMENT 'Null data value',
  `dd_sar_loc` varchar(255) DEFAULT NULL COMMENT 'Location',
  `dd_sar_pair` enum('P','S','U') DEFAULT NULL COMMENT 'Flag: P=Pair, S=Stacked, U=Unknown',
  `dd_sar_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `dd_sar_dem` varchar(50) DEFAULT NULL COMMENT 'DEM',
  `dd_sar_dord` varchar(30) DEFAULT NULL COMMENT 'Data order',
  `dd_sar_img1_time` datetime DEFAULT NULL COMMENT 'Date of image 1',
  `dd_sar_img1_time_unc` datetime DEFAULT NULL COMMENT 'Date of image 1 uncertainty',
  `dd_sar_img2_time` datetime DEFAULT NULL COMMENT 'Date of image 2',
  `dd_sar_img2_time_unc` datetime DEFAULT NULL COMMENT 'Date of image 2 uncertainty',
  `dd_sar_pixsiz` float DEFAULT NULL COMMENT 'Pixel size',
  `dd_sar_spacing` float DEFAULT NULL COMMENT 'Spacing of rows and columns',
  `dd_sar_lookang` float DEFAULT NULL COMMENT 'Look angle',
  `dd_sar_limb` enum('ASC','DES') DEFAULT NULL COMMENT 'Limb: ASC=Ascending, DES=Descending',
  `dd_sar_img_path` varchar(255) DEFAULT NULL COMMENT 'Image Path',
  `dd_sar_geotiff` varchar(255) DEFAULT NULL COMMENT 'GEOTIFF of interferogram',
  `dd_sar_prometh` varchar(255) DEFAULT NULL COMMENT 'Processing method',
  `dd_sar_softwr` varchar(255) DEFAULT NULL COMMENT 'Software',
  `dd_sar_dem_qual` enum('E','G','F','U') DEFAULT NULL COMMENT 'DEM quality: E=Excellent, G=Good, F=Fair, U=Unknown',
  `dd_sar_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `dd_sar_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `dd_sar_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `dd_sar_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`dd_sar_id`),
  KEY `CODE` (`dd_sar_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`),
  KEY `cs_id` (`cs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='InSAR image' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dd_srd`
--

CREATE TABLE IF NOT EXISTS `dd_srd` (
  `dd_srd_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_sar_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'InSAR image ID',
  `dd_srd_numb` int(10) unsigned DEFAULT NULL COMMENT 'Number',
  `dd_srd_dchange` float DEFAULT NULL COMMENT 'Range of change',
  `dd_srd_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `dd_srd_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`dd_srd_id`),
  UNIQUE KEY `PIXEL NUMBER` (`dd_sar_id`,`dd_srd_numb`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='InSAR image pixel' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dd_str`
--

CREATE TABLE IF NOT EXISTS `dd_str` (
  `dd_str_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_str_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ds_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Deformation station ID',
  `di_tlt_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Strainmeter ID',
  `dd_str_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `dd_str_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `dd_str_comp1` double DEFAULT NULL COMMENT 'Component 1',
  `dd_str_comp2` double DEFAULT NULL COMMENT 'Component 2',
  `dd_str_comp3` double DEFAULT NULL COMMENT 'Component 3',
  `dd_str_comp4` double DEFAULT NULL COMMENT 'Component 4',
  `dd_str_err1` double DEFAULT NULL COMMENT 'Component 1 error',
  `dd_str_err2` double DEFAULT NULL COMMENT 'Component 2 error',
  `dd_str_err3` double DEFAULT NULL COMMENT 'Component 3 error',
  `dd_str_err4` double DEFAULT NULL COMMENT 'Component 4 error',
  `dd_str_vdstr` double DEFAULT NULL COMMENT 'Volumetric strain change',
  `dd_str_vdstr_err` double DEFAULT NULL COMMENT 'Volumetric strain change error',
  `dd_str_sstr_ax1` double DEFAULT NULL COMMENT 'Shear strain of axis 1',
  `dd_str_azi_ax1` float DEFAULT NULL COMMENT 'Azimuth of axis 1',
  `dd_str_sstr_ax2` double DEFAULT NULL COMMENT 'Shear strain of axis 2',
  `dd_str_azi_ax2` float DEFAULT NULL COMMENT 'Azimuth of axis 2',
  `dd_str_sstr_ax3` double DEFAULT NULL COMMENT 'Shear strain of axis 3',
  `dd_str_azi_ax3` float DEFAULT NULL COMMENT 'Azimuth of axis 3',
  `dd_str_stderr1` double DEFAULT NULL COMMENT 'Strain for axis 1 uncertainty',
  `dd_str_stderr2` double DEFAULT NULL COMMENT 'Strain for axis 2 uncertainty',
  `dd_str_stderr3` double DEFAULT NULL COMMENT 'Strain for axis 3 uncertainty',
  `dd_str_pmax` double DEFAULT NULL COMMENT 'Maximum principal strain',
  `dd_str_pmaxerr` double DEFAULT NULL COMMENT 'Maximum principal strain uncertainty',
  `dd_str_pmin` double DEFAULT NULL COMMENT 'Minimum principal strain',
  `dd_str_pminerr` double DEFAULT NULL COMMENT 'Minimum principal strain uncertainty',
  `dd_str_pmax_dir` float DEFAULT NULL COMMENT 'Maximum principal strain direction',
  `dd_str_pmax_direrr` float DEFAULT NULL COMMENT 'Maximum principal strain direction uncertainty',
  `dd_str_pmin_dir` float DEFAULT NULL COMMENT 'Minimum principal strain direction',
  `dd_str_pmin_direrr` float DEFAULT NULL COMMENT 'Minimum principal strain direction uncertainty',
  `dd_str_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `dd_str_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `dd_str_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `dd_str_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`dd_str_id`),
  KEY `CODE` (`dd_str_code`),
  KEY `STATION` (`ds_id`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Strain' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dd_tlt`
--

CREATE TABLE IF NOT EXISTS `dd_tlt` (
  `dd_tlt_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_tlt_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ds_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Deformation station ID',
  `di_tlt_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Tiltmeter ID',
  `dd_tlt_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `dd_tlt_timecsec` decimal(2,2) DEFAULT NULL COMMENT 'Centisecond precision for measurement time',
  `dd_tlt_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `dd_tlt_timecsec_unc` decimal(2,2) DEFAULT NULL COMMENT 'Centisecond precision for measurement time uncertainty',
  `dd_tlt_srate` double DEFAULT NULL COMMENT 'Sampling rate',
  `dd_tlt1` double DEFAULT NULL COMMENT 'Tilt measurement 1',
  `dd_tlt2` double DEFAULT NULL COMMENT 'Tilt measurement 2',
  `dd_tlt_err1` double DEFAULT NULL COMMENT 'Tilt 1 error',
  `dd_tlt_err2` double DEFAULT NULL COMMENT 'Tilt 2 error',
  `dd_tlt_proc_flg` enum('P','R') DEFAULT NULL COMMENT 'Flag: P=Processed, R=Raw',
  `dd_tlt_temp` double DEFAULT NULL COMMENT 'Temperature',
  `dd_tlt_bat` double DEFAULT NULL COMMENT 'Battery Level',
  `dd_tlt_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `dd_tlt_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `dd_tlt_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `dd_tlt_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`dd_tlt_id`),
  KEY `CODE` (`dd_tlt_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ds_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Electronic tilt' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dd_tlv`
--

CREATE TABLE IF NOT EXISTS `dd_tlv` (
  `dd_tlv_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_tlv_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ds_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Deformation station ID',
  `di_tlt_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Tiltmeter ID',
  `dd_tlv_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `dd_tlv_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `dd_tlv_etime` datetime DEFAULT NULL COMMENT 'End time',
  `dd_tlv_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `dd_tlv_mag` float DEFAULT NULL COMMENT 'Magnitude',
  `dd_tlv_azi` float DEFAULT NULL COMMENT 'Azimuth',
  `dd_tlv_magerr` float DEFAULT NULL COMMENT 'Magnitude error',
  `dd_tlv_azierr` float DEFAULT NULL COMMENT 'Azimuth error',
  `dd_tlv_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `dd_tlv_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `dd_tlv_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `dd_tlv_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`dd_tlv_id`),
  KEY `CODE` (`dd_tlv_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ds_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tilt vector' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `di_gen`
--

CREATE TABLE IF NOT EXISTS `di_gen` (
  `di_gen_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `di_gen_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ds_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Deformation station ID',
  `di_gen_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `di_gen_type` enum('Angle','CGPS','EDM','EDM_Reflector','GPS','Total_Station','OtherTypes') DEFAULT NULL COMMENT 'Type',
  `di_gen_units` varchar(30) DEFAULT NULL COMMENT 'Measured units',
  `di_gen_res` float DEFAULT NULL COMMENT 'Resolution',
  `di_gen_stn` float DEFAULT NULL COMMENT 'Signal to noise',
  `di_gen_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start time',
  `di_gen_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `di_gen_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End time',
  `di_gen_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `di_gen_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `di_gen_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `di_gen_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `di_gen_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`di_gen_id`),
  KEY `CODE` (`di_gen_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ds_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='General deformation instrument' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `di_tlt`
--

CREATE TABLE IF NOT EXISTS `di_tlt` (
  `di_tlt_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `di_tlt_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ds_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Deformation station ID',
  `di_tlt_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `di_tlt_type` enum('Tilt','Strain') DEFAULT NULL COMMENT 'Type',
  `di_tlt_depth` float DEFAULT NULL COMMENT 'Depth',
  `di_tlt_units` varchar(30) DEFAULT NULL COMMENT 'Measured units',
  `di_tlt_res` float DEFAULT NULL COMMENT 'Resolution',
  `di_tlt_dir1` float DEFAULT NULL COMMENT 'Azimuth of direction 1',
  `di_tlt_dir2` float DEFAULT NULL COMMENT 'Azimuth of direction 2',
  `di_tlt_dir3` float DEFAULT NULL COMMENT 'Azimuth of direction 3',
  `di_tlt_dir4` float DEFAULT NULL COMMENT 'Azimuth of direction 4',
  `di_tlt_econv1` float DEFAULT NULL COMMENT 'Electronic conversion for component 1',
  `di_tlt_econv2` float DEFAULT NULL COMMENT 'Electronic conversion for component 2',
  `di_tlt_econv3` float DEFAULT NULL COMMENT 'Electronic conversion for component 3',
  `di_tlt_econv4` float DEFAULT NULL COMMENT 'Electronic conversion for component 4',
  `di_tlt_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start time',
  `di_tlt_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `di_tlt_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End time',
  `di_tlt_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `di_tlt_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `di_tlt_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `di_tlt_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `di_tlt_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`di_tlt_id`),
  KEY `CODE` (`di_tlt_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tilt/Strain instrument' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ds`
--

CREATE TABLE IF NOT EXISTS `ds` (
  `ds_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ds_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ds_name` varchar(30) DEFAULT NULL COMMENT 'Name',
  `cn_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Deformation network ID',
  `ds_perm` varchar(255) DEFAULT NULL COMMENT 'List of permanent instruments',
  `ds_nlat` double DEFAULT NULL COMMENT 'Nominal latitude',
  `ds_nlon` double DEFAULT NULL COMMENT 'Nominal longitude',
  `ds_nelev` float DEFAULT NULL COMMENT 'Nominal elevation',
  `ds_herr_loc` float DEFAULT NULL COMMENT 'Horizontal precision of nominal location',
  `ds_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `ds_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `ds_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `ds_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `ds_utc` float DEFAULT NULL COMMENT 'Difference from UTC',
  `ds_rflag` enum('Y','N') DEFAULT NULL COMMENT 'Reference station flag: Y=Yes, N=No',
  `ds_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `ds_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `ds_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ds_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ds_pubdate` datetime DEFAULT NULL COMMENT 'Publish dat',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ds_id`),
  KEY `CODE` (`ds_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `NETWORK` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Deformation station' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ed`
--

CREATE TABLE IF NOT EXISTS `ed` (
  `ed_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ed_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `ed_name` varchar(60) DEFAULT NULL COMMENT 'Name',
  `ed_nar` varchar(255) DEFAULT NULL COMMENT 'Narrative',
  `ed_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `ed_stime_bc` smallint(6) DEFAULT NULL COMMENT 'Start time before Christ',
  `ed_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `ed_etime` datetime DEFAULT NULL COMMENT 'End time',
  `ed_etime_bc` smallint(6) DEFAULT NULL COMMENT 'End time before Christ',
  `ed_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `ed_climax` datetime DEFAULT NULL COMMENT 'Onset of climax',
  `ed_climax_bc` smallint(6) DEFAULT NULL COMMENT 'Climax time before Christ',
  `ed_climax_unc` datetime DEFAULT NULL COMMENT 'Onset of climax uncertainty',
  `ed_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ed_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ed_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ed_id`),
  KEY `CODE` (`ed_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Eruption' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ed_for`
--

CREATE TABLE IF NOT EXISTS `ed_for` (
  `ed_for_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ed_for_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `ed_phs_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Eruption phase ID',
  `ed_for_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `ed_for_open` datetime DEFAULT NULL COMMENT 'Earliest expected start time of eruption',
  `ed_for_open_unc` datetime DEFAULT NULL COMMENT 'Earliest expected start time of eruption uncertainty',
  `ed_for_close` datetime DEFAULT NULL COMMENT 'Latest expected start time of eruption',
  `ed_for_close_unc` datetime DEFAULT NULL COMMENT 'Latest expected start time of eruption uncertainty',
  `ed_for_time` datetime DEFAULT NULL COMMENT 'Issue date',
  `ed_for_time_unc` datetime DEFAULT NULL COMMENT 'Issue date uncertainty',
  `ed_for_tsucc` enum('Y','N','P') DEFAULT NULL COMMENT 'Success on time: Y=Yes, N=No, P=Partly',
  `ed_for_msucc` enum('Y','N','P') DEFAULT NULL COMMENT 'Success on magnitude: Y=Yes, N=No, P=Partly',
  `ed_for_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ed_for_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ed_for_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ed_for_id`),
  KEY `CODE` (`ed_for_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`),
  KEY `ERUPTION PHASE` (`ed_phs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Eruption forecast' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ed_phs`
--

CREATE TABLE IF NOT EXISTS `ed_phs` (
  `ed_phs_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ed_phs_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ed_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Eruption ID',
  `ed_phs_phsnum` float DEFAULT NULL COMMENT 'Phase number',
  `ed_phs_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `ed_phs_stime_bc` smallint(6) DEFAULT NULL COMMENT 'Year of start time before Christ',
  `ed_phs_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `ed_phs_etime` datetime DEFAULT NULL COMMENT 'End time',
  `ed_phs_etime_bc` smallint(6) DEFAULT NULL COMMENT 'Year of end time before Christ',
  `ed_phs_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `ed_phs_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `ed_phs_vei` mediumint(9) DEFAULT NULL COMMENT 'VEI (Volcanic Explosivity Index)',
  `ed_phs_max_lext` float DEFAULT NULL COMMENT 'Maximum lava extrusion rate',
  `ed_phs_max_expdis` float DEFAULT NULL COMMENT 'Maximum explosive mass discharge rate',
  `ed_phs_dre` float DEFAULT NULL COMMENT 'DRE',
  `ed_phs_mix` enum('Y','N','U') DEFAULT NULL COMMENT 'Evidence of magma mixing: Y=Yes, N=No, U=Unknown',
  `ed_phs_col` float DEFAULT NULL COMMENT 'Column height',
  `ed_phs_coldet` varchar(255) DEFAULT NULL COMMENT 'Column height determination',
  `ed_phs_minsio2_mg` float DEFAULT NULL COMMENT 'Minimum SiO2 of matrix glass',
  `ed_phs_maxsio2_mg` float DEFAULT NULL COMMENT 'Maximum SiO2 of matrix glass',
  `ed_phs_minsio2_wr` float DEFAULT NULL COMMENT 'Minimum SiO2 of whole rock',
  `ed_phs_maxsio2_wr` float DEFAULT NULL COMMENT 'Maximum SiO2 of whole rock',
  `ed_phs_totxtl` float DEFAULT NULL COMMENT 'Total crystallinity',
  `ed_phs_phenc` float DEFAULT NULL COMMENT 'Phenocryst content',
  `ed_phs_phena` varchar(255) DEFAULT NULL COMMENT 'Phenocryst assemblage',
  `ed_phs_h2o` float DEFAULT NULL COMMENT 'Pre-eruption water content',
  `ed_phs_h2o_xtl` varchar(255) DEFAULT NULL COMMENT 'Description of phenocryst and melt inclusion',
  `ed_phs_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ed_phs_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ed_phs_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ed_phs_id`),
  KEY `CODE` (`ed_phs_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `ERUPTION` (`ed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Eruption phase' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ed_vid`
--

CREATE TABLE IF NOT EXISTS `ed_vid` (
  `ed_vid_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ed_vid_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `ed_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Eruption ID',
  `ed_phs_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Eruption phase ID',
  `ed_vid_link` varchar(255) DEFAULT NULL COMMENT 'Link',
  `ed_vid_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `ed_vid_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `ed_vid_length` time DEFAULT NULL COMMENT 'Length',
  `ed_vid_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `ed_vid_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ed_vid_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ed_vid_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ed_vid_id`),
  KEY `CODE` (`ed_vid_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`),
  KEY `ERUPTION` (`ed_id`),
  KEY `ERUPTION PHASE` (`ed_phs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Eruption video' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fd_ele`
--

CREATE TABLE IF NOT EXISTS `fd_ele` (
  `fd_ele_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fd_ele_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `fs_id1` mediumint(8) unsigned DEFAULT NULL COMMENT 'ID of fields station from which the electrode is subtracted',
  `fs_id2` mediumint(8) unsigned DEFAULT NULL COMMENT 'ID of fields station for the electrode that''s being subtracted',
  `fi_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Fields instrument ID',
  `fd_ele_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `fd_ele_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `fd_ele_field` float DEFAULT NULL COMMENT 'Field',
  `fd_ele_ferr` float DEFAULT NULL COMMENT 'Field uncertainty',
  `fd_ele_dir` float DEFAULT NULL COMMENT 'Direction',
  `fd_ele_hpass` float DEFAULT NULL COMMENT 'High pass filter frequency',
  `fd_ele_lpass` float DEFAULT NULL COMMENT 'Low pass filter frequency',
  `fd_ele_spot` float DEFAULT NULL COMMENT 'Self potential',
  `fd_ele_spot_err` float DEFAULT NULL COMMENT 'Self potential uncertainty',
  `fd_ele_ares` float DEFAULT NULL COMMENT 'Apparent resistivity',
  `fd_ele_ares_err` float DEFAULT NULL COMMENT 'Apparent resistivity uncertainty',
  `fd_ele_dres` float DEFAULT NULL COMMENT 'Direct resistivity',
  `fd_ele_dres_err` float DEFAULT NULL COMMENT 'Direct resistivity uncertainty',
  `fd_ele_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `fd_ele_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `fd_ele_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `fd_ele_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`fd_ele_id`),
  KEY `CODE` (`fd_ele_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION 1` (`fs_id1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Electric fields' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fd_gra`
--

CREATE TABLE IF NOT EXISTS `fd_gra` (
  `fd_gra_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fd_gra_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `fs_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Fields station ID',
  `fs_id_ref` mediumint(8) unsigned DEFAULT NULL COMMENT 'Reference station ID',
  `fi_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Fields instrument ID',
  `fd_gra_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `fd_gra_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `fd_gra_fstr` double DEFAULT NULL COMMENT 'Strength',
  `fd_gra_ferr` double DEFAULT NULL COMMENT 'Strength uncertainty',
  `fd_gra_vdisp` varchar(255) DEFAULT NULL COMMENT 'Associated vertical displacement: Y=Yes, N=No, U=Unknown',
  `fd_gra_gwater` varchar(255) DEFAULT NULL COMMENT 'Associated change in groundwater level: Y=Yes, N=No, U=Unknown',
  `fd_gra_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `fd_gra_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `fd_gra_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `fd_gra_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`fd_gra_id`),
  KEY `CODE` (`fd_gra_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`fs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Gravity' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fd_mag`
--

CREATE TABLE IF NOT EXISTS `fd_mag` (
  `fd_mag_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fd_mag_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `fs_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Fields station ID',
  `fs_id_ref` mediumint(8) unsigned DEFAULT NULL COMMENT 'Reference station ID',
  `fi_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Fields instrument ID',
  `fd_mag_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `fd_mag_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `fd_mag_f` double DEFAULT NULL COMMENT 'F',
  `fd_mag_compx` double DEFAULT NULL COMMENT 'X',
  `fd_mag_compy` double DEFAULT NULL COMMENT 'Y',
  `fd_mag_compz` double DEFAULT NULL COMMENT 'Z',
  `fd_mag_ferr` float DEFAULT NULL COMMENT 'Total field strength uncertainty',
  `fd_mag_errx` float DEFAULT NULL COMMENT 'Component X uncertainty',
  `fd_mag_erry` float DEFAULT NULL COMMENT 'Component Y uncertainty',
  `fd_mag_errz` float DEFAULT NULL COMMENT 'Component Z uncertainty',
  `fd_mag_highpass` float DEFAULT NULL COMMENT 'High pass',
  `fd_mag_lowpass` float DEFAULT NULL COMMENT 'Low pass',
  `fd_mag_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `fd_mag_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `fd_mag_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `fd_mag_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`fd_mag_id`),
  KEY `CODE` (`fd_mag_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`fs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Magnetic fields' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fd_mgv`
--

CREATE TABLE IF NOT EXISTS `fd_mgv` (
  `fd_mgv_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fd_mgv_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `fs_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Fields station ID',
  `fi_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Fields instrument ID',
  `fd_mgv_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `fd_mgv_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `fd_mgv_dec` float DEFAULT NULL COMMENT 'Declination',
  `fd_mgv_incl` float DEFAULT NULL COMMENT 'Inclination',
  `fd_mgv_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `fd_mgv_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `fd_mgv_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `fd_mgv_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`fd_mgv_id`),
  KEY `CODE` (`fd_mgv_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`fs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Magnetic vector' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fi`
--

CREATE TABLE IF NOT EXISTS `fi` (
  `fi_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fi_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `fs_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Fields station ID',
  `fi_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `fi_type` varchar(255) DEFAULT NULL COMMENT 'Type',
  `fi_res` float DEFAULT NULL COMMENT 'Resolution',
  `fi_units` varchar(255) DEFAULT NULL COMMENT 'Measured units',
  `fi_rate` float DEFAULT NULL COMMENT 'Sampling rate',
  `fi_filter` varchar(255) DEFAULT NULL COMMENT 'Filter type',
  `fi_orient` varchar(255) DEFAULT NULL COMMENT 'Orientation',
  `fi_calc` varchar(255) DEFAULT NULL COMMENT 'Calculation',
  `fi_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `fi_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `fi_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `fi_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `fi_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `fi_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `fi_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `fi_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`fi_id`),
  KEY `CODE` (`fi_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`fs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Fields instrument' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fs`
--

CREATE TABLE IF NOT EXISTS `fs` (
  `fs_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fs_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `cn_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Fields network ID',
  `fs_name` varchar(50) DEFAULT NULL COMMENT 'Name',
  `fs_lat` double DEFAULT NULL COMMENT 'Latitude',
  `fs_lon` double DEFAULT NULL COMMENT 'Longitude',
  `fs_elev` float DEFAULT NULL COMMENT 'Elevation',
  `fs_inst` varchar(255) DEFAULT NULL COMMENT 'Instruments list',
  `fs_utc` float DEFAULT NULL COMMENT 'Difference from UTC',
  `fs_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `fs_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `fs_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `fs_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `fs_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `fs_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `fs_com` varchar(255) DEFAULT NULL COMMENT 'Description',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `fs_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `fs_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`fs_id`),
  KEY `CODE` (`fs_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `NETWORK` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Fields station' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gd`
--

CREATE TABLE IF NOT EXISTS `gd` (
  `gd_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gd_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `gs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Gas station ID',
  `gi_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Gas instrument ID',
  `gd_time` datetime DEFAULT NULL COMMENT 'Sampling/measurement time',
  `gd_time_unc` datetime DEFAULT NULL COMMENT 'Sampling/measurement time uncertainty',
  `gd_gtemp` float DEFAULT NULL COMMENT 'Gas temperature',
  `gd_bp` float DEFAULT NULL COMMENT 'Barometric pressure',
  `gd_flow` float DEFAULT NULL COMMENT 'Gas emission rate',
  `gd_species` enum('CO2','SO2','H2S','HCl','HF','CH4','H2','CO','3He4He','d13C','d34S','d18O','dD') DEFAULT NULL COMMENT 'Species or ratio of gas reported',
  `gd_waterfree_flag` enum('Y','N') DEFAULT NULL COMMENT 'Water free gas: Y=Yes, N=No',
  `gd_units` varchar(30) DEFAULT NULL COMMENT 'Reported units',
  `gd_concentration` float DEFAULT NULL COMMENT 'Gas concentration',
  `gd_concentration_err` float DEFAULT NULL COMMENT 'Gas concentration uncertainty',
  `gd_recalc` enum('O','R') DEFAULT NULL COMMENT 'Recalculated value: O=Original, R=Recalculated',
  `gd_envir` varchar(255) DEFAULT NULL COMMENT 'Environmental factors',
  `gd_submin` varchar(255) DEFAULT NULL COMMENT 'Sublimate minerals',
  `gd_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `gd_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `gd_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `gd_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`gd_id`),
  KEY `CODE` (`gd_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`gs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Directly sampled gas' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gd_plu`
--

CREATE TABLE IF NOT EXISTS `gd_plu` (
  `gd_plu_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gd_plu_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `cs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Satellite ID',
  `gs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Gas station ID',
  `gi_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Gas instrument ID',
  `gd_plu_lat` double DEFAULT NULL COMMENT 'Latitude',
  `gd_plu_lon` double DEFAULT NULL COMMENT 'Longitude',
  `gd_plu_height` float DEFAULT NULL COMMENT 'Height',
  `gd_plu_hdet` varchar(255) DEFAULT NULL COMMENT 'Height determination',
  `gd_plu_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `gd_plu_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `gd_plu_species` enum('CO2','SO2','H2S','HCl','HF','CO') DEFAULT NULL COMMENT 'Species of gas reported',
  `gd_plu_units` varchar(30) DEFAULT NULL COMMENT 'Reported units',
  `gd_plu_emit` float DEFAULT NULL COMMENT 'CO2 emission rate',
  `gd_plu_emit_err` float DEFAULT NULL COMMENT 'CO2 emission rate uncertainty',
  `gd_plu_recalc` enum('O','R') DEFAULT NULL COMMENT 'SO2 emission rate',
  `gd_plu_wind` float DEFAULT NULL COMMENT 'Wind speed',
  `gd_plu_wsmin` float DEFAULT NULL COMMENT 'Minimum Wind speed',
  `gd_plu_wsmax` float DEFAULT NULL COMMENT 'Maximum Wind speed',
  `gd_plu_wdir` varchar(30) DEFAULT NULL COMMENT 'Wind Direction',
  `gd_plu_weth` varchar(255) DEFAULT NULL COMMENT 'Weather notes',
  `gd_plu_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `gd_plu_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `gd_plu_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `gd_plu_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`gd_plu_id`),
  KEY `CODE` (`gd_plu_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`),
  KEY `STATION` (`gs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Plume' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gd_sol`
--

CREATE TABLE IF NOT EXISTS `gd_sol` (
  `gd_sol_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gd_sol_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `gs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Gas station ID',
  `gi_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Gas instrument ID',
  `gd_sol_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `gd_sol_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `gd_sol_species` varchar(30) DEFAULT NULL COMMENT 'Measured species',
  `gd_sol_tflux` float DEFAULT NULL COMMENT 'Total flux',
  `gd_sol_flux_err` float DEFAULT NULL COMMENT 'Total flux uncertainty',
  `gd_sol_pts` smallint(5) unsigned DEFAULT NULL COMMENT 'Number of points',
  `gd_sol_area` float DEFAULT NULL COMMENT 'Area',
  `gd_sol_high` float DEFAULT NULL COMMENT 'Highest individual flux',
  `gd_sol_htemp` float DEFAULT NULL COMMENT 'Highest temperature',
  `gd_sol_units` varchar(30) DEFAULT NULL COMMENT 'Reported Units',
  `gd_sol_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `gd_sol_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `gd_sol_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `gd_sol_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`gd_sol_id`),
  KEY `CODE` (`gd_sol_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`gs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Soil efflux' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gi`
--

CREATE TABLE IF NOT EXISTS `gi` (
  `gi_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gi_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `cs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Satellite ID',
  `gs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Gas station ID',
  `gi_type` varchar(255) DEFAULT NULL COMMENT 'Type',
  `gi_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `gi_units` varchar(50) DEFAULT NULL COMMENT 'Measured units',
  `gi_pres` float DEFAULT NULL COMMENT 'Resolution',
  `gi_stn` float DEFAULT NULL COMMENT 'Signal to noise',
  `gi_calib` varchar(255) DEFAULT NULL COMMENT 'Calibration',
  `gi_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `gi_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `gi_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `gi_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `gi_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `gi_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `gi_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `gi_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`gi_id`),
  KEY `CODE` (`gi_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `SATELLITE` (`cs_id`),
  KEY `STATION` (`gs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Gas instrument' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gs`
--

CREATE TABLE IF NOT EXISTS `gs` (
  `gs_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gs_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `gs_name` varchar(50) DEFAULT NULL COMMENT 'Name',
  `cn_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Gas network ID',
  `gs_lat` double DEFAULT NULL COMMENT 'Latitude',
  `gs_lon` double DEFAULT NULL COMMENT 'Longitude',
  `gs_elev` float DEFAULT NULL COMMENT 'Elevation',
  `gs_inst` varchar(255) DEFAULT NULL COMMENT 'Permanent instruments list',
  `gs_type` varchar(255) DEFAULT NULL COMMENT 'Type of gas body',
  `gs_utc` float DEFAULT NULL COMMENT 'Difference from UTC',
  `gs_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `gs_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `gs_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `gs_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `gs_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `gs_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `gs_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `gs_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `gs_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`gs_id`),
  UNIQUE KEY `CODE` (`gs_code`,`cc_id`,`gs_stime`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Gas station' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hd`
--

CREATE TABLE IF NOT EXISTS `hd` (
  `hd_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Hydrologic sample data ID',
  `hd_code` varchar(30) DEFAULT NULL COMMENT 'ID given by collector',
  `hs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Hydrologic station ID',
  `hi_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Hydrologic instrument ID',
  `hd_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `hd_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `hd_temp` float DEFAULT NULL COMMENT 'Water temperature',
  `hd_welev` double DEFAULT NULL COMMENT 'Water elevation',
  `hd_wdepth` double DEFAULT NULL COMMENT 'Water depth',
  `hd_dwlev` double DEFAULT NULL COMMENT 'Change in water level',
  `hd_bp` float DEFAULT NULL COMMENT 'Barometric pressure',
  `hd_sdisc` double DEFAULT NULL COMMENT 'Spring discharge rate',
  `hd_prec` float DEFAULT NULL COMMENT 'Precipitation',
  `hd_dprec` float DEFAULT NULL COMMENT 'Precipitation of preceding day',
  `hd_tprec` enum('R','FR','S','H','R-FR','R-S','R-H','FR-R','FR-S','FR-H','S-R','S-FR','S-H','H-R','H-FR','H-S') DEFAULT NULL COMMENT 'Type of precipitation: R=Rain, FR=Freezing Rain, S=Snow, H=Hail, and combinations',
  `hd_ph` float DEFAULT NULL COMMENT 'pH',
  `hd_ph_err` float DEFAULT NULL COMMENT 'pH standard error',
  `hd_cond` float DEFAULT NULL COMMENT 'Conductivity',
  `hd_cond_err` float DEFAULT NULL COMMENT 'Conductivity standard error',
  `hd_comp_species` enum('SO4','H2S','Cl','F','HCO3','Mg','Fe','Ca','Na','K','3He4He','c3He4He','d13C','d34S','dD','d18O') DEFAULT NULL COMMENT 'Type of compound, kation, anion or ratio',
  `hd_comp_units` varchar(30) DEFAULT NULL COMMENT 'Reported units',
  `hd_comp_content` float DEFAULT NULL COMMENT 'Content of compound, kation, anion or ratio',
  `hd_comp_content_err` float DEFAULT NULL COMMENT 'Content of compound, kation, anion or ratio error',
  `hd_atemp` float DEFAULT NULL COMMENT 'Air temperature',
  `hd_tds` float DEFAULT NULL COMMENT 'Total disolved solid',
  `hd_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `hd_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `hd_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `hd_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`hd_id`),
  KEY `CODE` (`hd_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`hs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Hydrologic sample data' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hi`
--

CREATE TABLE IF NOT EXISTS `hi` (
  `hi_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `hi_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `hs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Hydrologic station ID',
  `hi_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `hi_type` varchar(50) DEFAULT NULL COMMENT 'Type',
  `hi_meas` enum('A','V') DEFAULT NULL COMMENT 'Pressure measurement type: A=Absolute, V=Vented',
  `hi_units` varchar(50) DEFAULT NULL COMMENT 'Measured units',
  `hi_res` float DEFAULT NULL COMMENT 'Resolution',
  `hi_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `hi_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `hi_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `hi_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `hi_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `hi_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `hi_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `hi_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `hi_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`hi_id`),
  KEY `CODE` (`hi_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`hs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Hydrologic instrument' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hs`
--

CREATE TABLE IF NOT EXISTS `hs` (
  `hs_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `hs_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `cn_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Hydrologic network ID',
  `hs_lat` double DEFAULT NULL COMMENT 'Latitude',
  `hs_lon` double DEFAULT NULL COMMENT 'Longitude',
  `hs_elev` float DEFAULT NULL COMMENT 'Elevation',
  `hs_perm` varchar(255) DEFAULT NULL COMMENT 'List of permanent instruments',
  `hs_name` varchar(30) DEFAULT NULL COMMENT 'Name',
  `hs_type` varchar(255) DEFAULT NULL COMMENT 'Type of water body',
  `hs_utc` float DEFAULT NULL COMMENT 'Difference from UTC',
  `hs_tscr` float DEFAULT NULL COMMENT 'Top of screen',
  `hs_bscr` float DEFAULT NULL COMMENT 'Bottom of screen',
  `hs_tdepth` double DEFAULT NULL COMMENT 'Total depth of well',
  `hs_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `hs_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `hs_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `hs_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `hs_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `hs_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `hs_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `hs_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `hs_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`hs_id`),
  KEY `CODE` (`hs_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `NETWORK` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Hydrologic station' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ip_hyd`
--

CREATE TABLE IF NOT EXISTS `ip_hyd` (
  `ip_hyd_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ip_hyd_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `ip_hyd_time` datetime DEFAULT NULL COMMENT 'Inference time',
  `ip_hyd_time_unc` datetime DEFAULT NULL COMMENT 'Inference time uncertainty',
  `ip_hyd_start` datetime DEFAULT NULL COMMENT 'Start time',
  `ip_hyd_start_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `ip_hyd_end` datetime DEFAULT NULL COMMENT 'End time',
  `ip_hyd_end_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `ip_hyd_gwater` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Heated groundwater: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_hyd_ipor` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Pore destabilization: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_hyd_edef` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Pore deformation: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_hyd_hfrac` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Hydrofracturing: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_hyd_btrem` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Boiling induced tremor: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_hyd_abgas` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Absorption of soluble gases: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_hyd_species` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Change in equilibrium species: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_hyd_chim` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Boiling until dry chimneys are formed: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_hyd_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `ip_hyd_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Interpreter ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ip_hyd_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ip_hyd_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ip_hyd_id`),
  KEY `CODE` (`ip_hyd_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Hydrothermal system interaction' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ip_mag`
--

CREATE TABLE IF NOT EXISTS `ip_mag` (
  `ip_mag_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ip_mag_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `ip_mag_time` datetime DEFAULT NULL COMMENT 'Inference time',
  `ip_mag_time_unc` datetime DEFAULT NULL COMMENT 'Inference time uncertainty',
  `ip_mag_start` datetime DEFAULT NULL COMMENT 'Start time',
  `ip_mag_start_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `ip_mag_end` datetime DEFAULT NULL COMMENT 'End time',
  `ip_mag_end_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `ip_mag_deepsupp` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Supply of magma from depth: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_mag_asc` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Ascent: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_mag_convb` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Convection below: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_mag_conva` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Convection above: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_mag_mix` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Magma mixing: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_mag_dike` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Dike intrusion: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_mag_pipe` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Pipe intrusion: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_mag_sill` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Sill intrusion: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_mag_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `ip_mag_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Interpreter ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ip_mag_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ip_mag_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ip_mag_id`),
  KEY `CODE` (`ip_mag_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Magma movement' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ip_pres`
--

CREATE TABLE IF NOT EXISTS `ip_pres` (
  `ip_pres_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ip_pres_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `ip_pres_time` datetime DEFAULT NULL COMMENT 'Inference date',
  `ip_pres_time_unc` datetime DEFAULT NULL COMMENT 'Inference date uncertainty',
  `ip_pres_start` datetime DEFAULT NULL COMMENT 'Start time',
  `ip_pres_start_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `ip_pres_end` datetime DEFAULT NULL COMMENT 'End time',
  `ip_pres_end_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `ip_pres_gas` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Gas-induced overpressure: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_pres_tec` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Tectonic overpressure: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_pres_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `ip_pres_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Interpreter ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ip_pres_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ip_pres_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ip_pres_id`),
  KEY `CODE` (`ip_pres_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Buildup of magma pressure' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ip_sat`
--

CREATE TABLE IF NOT EXISTS `ip_sat` (
  `ip_sat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ip_sat_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `ip_sat_time` datetime DEFAULT NULL COMMENT 'Inference time',
  `ip_sat_time_unc` datetime DEFAULT NULL COMMENT 'Inference time uncertainty',
  `ip_sat_start` datetime DEFAULT NULL COMMENT 'Start time',
  `ip_sat_start_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `ip_sat_end` datetime DEFAULT NULL COMMENT 'End time',
  `ip_sat_end_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `ip_sat_co2` enum('Y','N','M','U') DEFAULT NULL COMMENT 'CO2 saturation: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_sat_h2o` enum('Y','N','M','U') DEFAULT NULL COMMENT 'H2O saturation: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_sat_decomp` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Decompression: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_sat_dfo2` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Fugacity: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_sat_add` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Volatile addition: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_sat_xtl` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Crystallization or 2nd boiling: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_sat_ves` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Vesiculation: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_sat_deves` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Devesiculation: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_sat_degas` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Degassing: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_sat_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `ip_sat_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Interpreter ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ip_sat_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ip_sat_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ip_sat_id`),
  KEY `CODE` (`ip_sat_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Volatile saturation' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ip_tec`
--

CREATE TABLE IF NOT EXISTS `ip_tec` (
  `ip_tec_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ip_tec_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `ip_tec_time` datetime DEFAULT NULL COMMENT 'Inference time',
  `ip_tec_time_unc` datetime DEFAULT NULL COMMENT 'Inference time uncertainty',
  `ip_tec_start` datetime DEFAULT NULL COMMENT 'Start time',
  `ip_tec_start_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `ip_tec_end` datetime DEFAULT NULL COMMENT 'End time',
  `ip_tec_end_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `ip_tec_change` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Tectonic changes: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_tec_sstress` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Static stress: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_tec_dstrain` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Dynamic strain: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_tec_fault` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Local shear: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_tec_seq` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Slow earthquake: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_tec_press` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Distal pressurization: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_tec_depress` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Distal depressurization: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_tec_hppress` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Hydrothermal lubrication: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_tec_etide` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Earth-tide: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_tec_atmp` enum('Y','N','M','U') DEFAULT NULL COMMENT 'Atmospheric influence: Y=Yes, N=No, M=Maybe, U=Unknown',
  `ip_tec_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `ip_tec_com` char(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Interpreter ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ip_tec_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ip_tec_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ip_tec_id`),
  KEY `CODE` (`ip_tec_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Regional tectonics interaction' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jj_concon`
--

CREATE TABLE IF NOT EXISTS `jj_concon` (
  `jj_concon_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cc_id` smallint(5) unsigned NOT NULL COMMENT 'Granting user ID',
  `cc_id_granted` smallint(5) unsigned NOT NULL COMMENT 'Granted user ID',
  `jj_concon_view` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Permission to view unpublished data: 0=No, 1=Yes',
  `jj_concon_upload` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Permission to upload data: 0=No, 1=Yes',
  `jj_concon_update` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Permission to update data: 0=No, 1=Yes',
  `jj_concon_admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Permission to manage account: 0=No, 1=Yes',
  `jj_concon_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`jj_concon_id`),
  UNIQUE KEY `GRANT` (`cc_id`,`cc_id_granted`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='User to user permissions' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jj_imgx`
--

CREATE TABLE IF NOT EXISTS `jj_imgx` (
  `jj_imgx_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cm_id` smallint(5) unsigned NOT NULL COMMENT 'Image ID',
  `jj_idname` enum('cb','cc','ch','cm','cn','co','cp','cr','cr_tmp','cs','cu','dd_ang','dd_edm','dd_gps','dd_gpv','dd_lev','dd_sar','dd_srd','dd_str','dd_tlt','dd_tlv','di_gen','di_tlt','ds','ed','ed_for','ed_phs','ed_vid','fd_ele','fd_gra','fd_mag','fd_mgv','fi','fs','gd','gd_plu','gd_sol','gi','gs','hd','hi','hs','ip_hyd','ip_mag','ip_pres','ip_sat','ip_tec','jj_concon','jj_imgx','jj_volcon','jj_volnet','j_sarsat','md','med','mi','ms','sd_evn','sd_evs','sd_int','sd_ivl','sd_rsm','sd_sam','sd_ssm','sd_trm','sd_wav','si','si_cmp','sn','ss','st_eqt','td','td_img','td_pix','ti','ts','vd','vd_inf','vd_mag','vd_tec') DEFAULT NULL COMMENT 'Table name',
  `jj_x_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Link ID',
  `jj_imgx_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`jj_imgx_id`),
  UNIQUE KEY `LINK` (`cm_id`,`jj_idname`,`jj_x_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Image junction' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jj_volcon`
--

CREATE TABLE IF NOT EXISTS `jj_volcon` (
  `jj_volcon_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `vd_id` mediumint(8) unsigned NOT NULL,
  `cc_id` smallint(5) unsigned NOT NULL,
  `jj_volcon_loaddate` datetime DEFAULT NULL,
  `cc_id_load` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`jj_volcon_id`),
  UNIQUE KEY `LINK` (`vd_id`,`cc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Volcano-contact junction' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jj_volnet`
--

CREATE TABLE IF NOT EXISTS `jj_volnet` (
  `jj_volnet_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `jj_net_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Network ID',
  `jj_net_flag` enum('C','S') DEFAULT NULL COMMENT 'Network type: C=Common, S=Seismic',
  `jj_volnet_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`jj_volnet_id`),
  UNIQUE KEY `LINK` (`vd_id`,`jj_net_id`,`jj_net_flag`),
  KEY `jj_volnet_id` (`jj_volnet_id`),
  KEY `jj_volnet_id_2` (`jj_volnet_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Volcano-network junction' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j_sarsat`
--

CREATE TABLE IF NOT EXISTS `j_sarsat` (
  `j_sarsat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dd_sar_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'InSAR image ID',
  `cs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Satellite ID',
  `j_sarsat_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`j_sarsat_id`),
  UNIQUE KEY `LINK` (`dd_sar_id`,`cs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='InSAR-satellite junction' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `md`
--

CREATE TABLE IF NOT EXISTS `md` (
  `md_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `md_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) DEFAULT NULL COMMENT 'Volcano ID',
  `md_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `md_type` varchar(30) DEFAULT NULL COMMENT 'Type',
  `md_srtm` varchar(255) DEFAULT NULL COMMENT 'Link to SRTM',
  `md_scale` varchar(30) DEFAULT NULL COMMENT 'Scale',
  `md_contour` float DEFAULT NULL COMMENT 'Contour interval',
  `md_date` date DEFAULT NULL COMMENT 'Publication date',
  `md_date_unc` date DEFAULT NULL COMMENT 'Publication date uncertainty',
  `md_proj` varchar(255) DEFAULT NULL COMMENT 'Projection',
  `mp_map_datum` varchar(255) DEFAULT NULL COMMENT 'Datum',
  `md_west` float DEFAULT NULL COMMENT 'West bounding coordinate',
  `md_east` float DEFAULT NULL COMMENT 'East bounding coordinate',
  `md_north` float DEFAULT NULL COMMENT 'North bounding coordinate',
  `md_south` float DEFAULT NULL COMMENT 'South bounding coordinate',
  `md_elev_max` float DEFAULT NULL COMMENT 'Maximum elevation',
  `md_elev_min` float DEFAULT NULL COMMENT 'Minimum elevation',
  `md_use` varchar(255) DEFAULT NULL COMMENT 'Intended use',
  `md_restrictions` varchar(255) DEFAULT NULL COMMENT 'Restrictions on the use',
  `md_quality` varchar(255) DEFAULT NULL COMMENT 'Quality',
  `md_image` varchar(255) DEFAULT NULL COMMENT 'Link to image',
  `md_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `md_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `md_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `md_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `md_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`md_id`),
  KEY `CODE` (`md_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Map' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `med`
--

CREATE TABLE IF NOT EXISTS `med` (
  `med_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Meteo data ID',
  `med_code` varchar(30) DEFAULT NULL COMMENT 'ID given by collector',
  `ms_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Meteo station ID',
  `mi_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Meteo instrument ID',
  `med_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `med_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `med_temp` float DEFAULT NULL COMMENT 'Air temperature',
  `med_stemp` float DEFAULT NULL COMMENT 'Soil temperature',
  `med_bp` float DEFAULT NULL COMMENT 'Barometric pressure at the time of measurement',
  `med_prec` float DEFAULT NULL COMMENT 'Measured precipitation (daily)',
  `med_tprec` enum('R','FR','S','H','R-FR','R-S','R-H','FR-R','FR-S','FR-H','S-R','S-FR','S-H','H-R','H-FR','H-S') DEFAULT NULL COMMENT 'Type of precipitation: R=Rain, FR=Freezing Rain, S=Snow, H=Hail, and combinations',
  `med_hd` float DEFAULT NULL COMMENT 'Humidity',
  `med_wind` float DEFAULT NULL COMMENT 'Wind speed',
  `med_wsmin` float DEFAULT NULL COMMENT 'Minimum Wind speed',
  `med_wsmax` float DEFAULT NULL COMMENT 'Maximum Wind speed',
  `med_wdir` varchar(30) DEFAULT NULL COMMENT 'Wind direction',
  `med_clc` float DEFAULT NULL COMMENT 'Cloud coverage',
  `med_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `med_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `med_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `med_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`med_id`),
  KEY `CODE` (`med_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ms_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Meteo Data' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mi`
--

CREATE TABLE IF NOT EXISTS `mi` (
  `mi_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `mi_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ms_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Meteo station ID',
  `mi_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `mi_type` varchar(50) DEFAULT NULL COMMENT 'Type',
  `mi_units` varchar(50) DEFAULT NULL COMMENT 'Measured units',
  `mi_res` float DEFAULT NULL COMMENT 'Resolution',
  `mi_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `mi_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `mi_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `mi_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `mi_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `mi_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `mi_com` varchar(255) DEFAULT NULL COMMENT 'comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `mi_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `mi_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`mi_id`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ms_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Meteo instrument' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ms`
--

CREATE TABLE IF NOT EXISTS `ms` (
  `ms_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ms_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `cn_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Meteo network ID',
  `ms_name` varchar(30) DEFAULT NULL COMMENT 'Name',
  `ms_lat` double DEFAULT NULL COMMENT 'Latitude',
  `ms_lon` double DEFAULT NULL COMMENT 'Longitude',
  `ms_elev` float DEFAULT NULL COMMENT 'Elevation',
  `ms_perm` varchar(255) DEFAULT NULL COMMENT 'List of permanent instruments',
  `ms_type` varchar(255) DEFAULT NULL COMMENT 'Type',
  `ms_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `ms_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `ms_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `ms_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `ms_utc` float DEFAULT NULL COMMENT 'Difference from UTC',
  `ms_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `ms_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `ms_com` varchar(255) DEFAULT NULL COMMENT 'comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ms_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ms_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ms_id`),
  KEY `CODE` (`ms_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `NETWORK` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Meteo station' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sd_evn`
--

CREATE TABLE IF NOT EXISTS `sd_evn` (
  `sd_evn_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Seismic data ID',
  `sd_evn_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `sn_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Seismic network ID',
  `sd_evn_arch` varchar(255) DEFAULT NULL COMMENT 'Location of the seismogram archive',
  `sd_evn_time` datetime DEFAULT NULL COMMENT 'Origin time',
  `sd_evn_timecsec` decimal(2,2) DEFAULT NULL COMMENT 'Centiseconds precision for the origin time',
  `sd_evn_time_unc` datetime DEFAULT NULL COMMENT 'Origin time uncertainty',
  `sd_evn_timecsec_unc` decimal(2,2) DEFAULT NULL COMMENT 'The uncertainty in the centiseconds for the origin time',
  `sd_evn_dur` float DEFAULT NULL COMMENT 'Average duration of the earthquake as recorded at stations <15 km from the volcano (in sec)',
  `sd_evn_dur_unc` float DEFAULT NULL COMMENT 'The uncertainty in the average duration of the earthquake',
  `sd_evn_tech` varchar(255) DEFAULT NULL COMMENT 'The technique used to locate the event',
  `sd_evn_picks` enum('A','R','H','U') DEFAULT NULL COMMENT 'Determination of picks: A=Automatic picker, R=Ruler, H=Human using a computer-based picker, U=Unknown',
  `sd_evn_elat` double DEFAULT NULL COMMENT 'Estimated latitude',
  `sd_evn_elon` double DEFAULT NULL COMMENT 'Estimated longitude',
  `sd_evn_edep` float DEFAULT NULL COMMENT 'Estimated depth (km)',
  `sd_evn_fixdep` enum('Y','N','U') DEFAULT NULL COMMENT 'Fixed depth: Y=Yes, N=No, U=Unknown',
  `sd_evn_nst` tinyint(3) unsigned DEFAULT NULL COMMENT 'The total number of seismic stations that reported arrival times for this earthquake',
  `sd_evn_nph` tinyint(3) unsigned DEFAULT NULL COMMENT 'The total number of P and S arrival-time observations used to compute the hypocenter location',
  `sd_evn_gp` float DEFAULT NULL COMMENT 'The largest azimuthal gap between azimuthally adjacent stations (in degrees, 0-360)',
  `sd_evn_dcs` float DEFAULT NULL COMMENT 'Horizontal distance from the epicenter to the nearest station (km)',
  `sd_evn_rms` float DEFAULT NULL COMMENT 'RMS travel time residual (s)',
  `sd_evn_herr` float DEFAULT NULL COMMENT 'The horizontal location error defined as the length of the largest projection of the three principal errors on a horizontal plane (km)',
  `sd_evn_xerr` float DEFAULT NULL COMMENT 'The maximum x (longitude) error, in km, for cases where the horizontal error is not given',
  `sd_evn_yerr` float DEFAULT NULL COMMENT 'The maximum y (latitude) error, in km, for cases where the horizontal error is not given',
  `sd_evn_derr` float DEFAULT NULL COMMENT 'The depth error, in km, defined as the largest projection of the three principal errors on a vertical line',
  `sd_evn_locqual` varchar(255) DEFAULT NULL COMMENT 'The quality of the calculated location',
  `sd_evn_pmag` float DEFAULT NULL COMMENT 'The primary magnitude',
  `sd_evn_pmag_type` varchar(30) DEFAULT NULL COMMENT 'The primary magnitude type, e.g., Ms, Mb, Mw, Md (the last, duration or "coda" magnitude)',
  `sd_evn_smag` float DEFAULT NULL COMMENT 'A secondary magnitude',
  `sd_evn_smag_type` varchar(30) DEFAULT NULL COMMENT 'A secondary magnitude type',
  `sd_evn_eqtype` enum('R','Q','V','VT','VT_D','VT_S','H','H_HLF','H_LHF','LF','LF_LP','LF_T','LF_ILF','VLP','E','U','O','X') DEFAULT NULL COMMENT 'The WOVOdat terminology for the earthquake type: U=Unknown Origin, O=Other non-volcanic, X=Undefined',
  `sd_evn_mtscale` float DEFAULT NULL COMMENT 'The scale of the following moment tensor data. Please store as a multiplier for the moment tensor data',
  `sd_evn_mxx` float DEFAULT NULL COMMENT 'Moment tensor m_xx stored as +/- x.xx',
  `sd_evn_mxy` float DEFAULT NULL COMMENT 'Moment tensor m_xy stored as +/- x.xx',
  `sd_evn_mxz` float DEFAULT NULL COMMENT 'Moment tensor m_xz stored as +/- x.xx',
  `sd_evn_myy` float DEFAULT NULL COMMENT 'Moment tensor m_yy',
  `sd_evn_myz` float DEFAULT NULL COMMENT 'Moment tensor m_yz',
  `sd_evn_mzz` float DEFAULT NULL COMMENT 'Moment tensor m_zz',
  `sd_evn_strk1` float DEFAULT NULL COMMENT 'Strike 1 of best double couple (0-360 degrees)',
  `sd_evn_strk1_err` float DEFAULT NULL COMMENT 'The uncertainty in the value of strike 1',
  `sd_evn_dip1` float DEFAULT NULL COMMENT 'Dip 1 of best double couple (0-90 degrees)',
  `sd_evn_dip1_err` float DEFAULT NULL COMMENT 'The uncertainty in the value of dip 1',
  `sd_evn_rak1` float DEFAULT NULL COMMENT 'Rake 1 of best double couple (0-90 degrees)',
  `sd_evn_rak1_err` float DEFAULT NULL COMMENT 'The uncertainty in the value of rake 1',
  `sd_evn_strk2` float DEFAULT NULL COMMENT 'Strike 2 of best double couple',
  `sd_evn_strk2_err` float DEFAULT NULL COMMENT 'The uncertainty in the value of strike 2',
  `sd_evn_dip2` float DEFAULT NULL COMMENT 'Dip 2 of best double couple',
  `sd_evn_dip2_err` float DEFAULT NULL COMMENT 'The uncertainty in the value of dip 2',
  `sd_evn_rak2` float DEFAULT NULL COMMENT 'Rake 2 of best double couple',
  `sd_evn_rak2_err` float DEFAULT NULL COMMENT 'The uncertainty in the value of rake 2',
  `sd_evn_foc` varchar(255) DEFAULT NULL COMMENT 'The focal plane solution (beachball, w/ arrivals) stored as a .gif for well defined events',
  `sd_evn_samp` float DEFAULT NULL COMMENT 'The sampling rate in Hz',
  `sd_evn_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `sd_evn_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `sd_evn_loaddate` datetime DEFAULT NULL COMMENT 'The date this row was entered in UTC',
  `sd_evn_pubdate` datetime DEFAULT NULL COMMENT 'The date this row can become public',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'The loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`sd_evn_id`),
  KEY `CODE` (`sd_evn_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `NETWORK` (`sn_id`),
  KEY `TECHNIQUE` (`sd_evn_tech`),
  KEY `latlonIndex` (`sd_evn_elat`,`sd_evn_elon`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Event data from a network' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sd_evs`
--

CREATE TABLE IF NOT EXISTS `sd_evs` (
  `sd_evs_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sd_evs_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ss_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Seismic station ID',
  `sd_evs_time` datetime DEFAULT NULL COMMENT 'Start time',
  `sd_evs_time_ms` decimal(2,2) DEFAULT NULL COMMENT 'Centisecond precision for start time',
  `sd_evs_time_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `sd_evs_time_unc_ms` decimal(2,2) DEFAULT NULL COMMENT 'Centisecond precision for uncertainty in start time',
  `sd_evs_picks` enum('A','R','H','U') DEFAULT NULL COMMENT 'Determination of picks: A=Automatic picker, R=Ruler, H=Human using a computer-based picker, U=Unknown',
  `sd_evs_spint` float DEFAULT NULL COMMENT 'S-P interval',
  `sd_evs_dur` float DEFAULT NULL COMMENT 'Duration',
  `sd_evs_dur_unc` float DEFAULT NULL COMMENT 'Duration uncertainty',
  `sd_evs_dist_actven` float DEFAULT NULL COMMENT 'Distance from active vent',
  `sd_evs_maxamptrac` float DEFAULT NULL COMMENT 'Maximum amplitude of trace',
  `sd_evs_samp` float DEFAULT NULL COMMENT 'Sampling rate',
  `sd_evs_eqtype` enum('R','Q','V','VT','VT_D','VT_S','H','H_HLF','H_LHF','LF','LF_LP','LF_T','LF_ILF','VLP','E','U','O','X') DEFAULT NULL COMMENT 'The WOVOdat terminology for the earthquake type: U=Unknown Origin, O=Other non-volcanic, X=Undefined',
  `sd_evs_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `sd_evs_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `sd_evs_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `sd_evs_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`sd_evs_id`),
  KEY `CODE` (`sd_evs_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ss_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Seismic event data from a single station' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sd_int`
--

CREATE TABLE IF NOT EXISTS `sd_int` (
  `sd_int_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sd_int_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `sd_evn_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Seismic event data from a network ID',
  `sd_evs_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Seismic event from a single station ID',
  `sd_int_time` datetime DEFAULT NULL COMMENT 'Time',
  `sd_int_time_unc` datetime DEFAULT NULL COMMENT 'Time uncertainty',
  `sd_int_city` varchar(30) DEFAULT NULL COMMENT 'City',
  `sd_int_maxdist` float DEFAULT NULL COMMENT 'Max distance felt',
  `sd_int_maxrint` float DEFAULT NULL COMMENT 'Maximum reported intensity',
  `sd_int_maxrint_dist` float DEFAULT NULL COMMENT 'Distance at maximum reported intensity',
  `sd_int_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `sd_int_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `sd_int_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `sd_int_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`sd_int_id`),
  KEY `CODE` (`sd_int_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Intensity' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sd_ivl`
--

CREATE TABLE IF NOT EXISTS `sd_ivl` (
  `sd_ivl_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sd_ivl_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `sn_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Seismic network ID',
  `ss_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Seismic station ID',
  `sd_ivl_eqtype` enum('R','Q','V','VT','VT_D','VT_S','H','H_HLF','H_LHF','LF','LF_LP','LF_T','LF_ILF','VLP','E','U','O','X') DEFAULT NULL COMMENT 'The WOVOdat terminology for the earthquake type: U=Unknown Origin, O=Other non-volcanic, X=Undefined',
  `sd_ivl_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `sd_ivl_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `sd_ivl_etime` datetime DEFAULT NULL COMMENT 'End time',
  `sd_ivl_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `sd_ivl_hdist` float DEFAULT NULL COMMENT 'Horizontal distance from summit to swarm center',
  `sd_ivl_avgdepth` float DEFAULT NULL COMMENT 'Mean depth',
  `sd_ivl_vdispers` float DEFAULT NULL COMMENT 'Vertical dispersion',
  `sd_ivl_hmigr_hyp` float DEFAULT NULL COMMENT 'Horizontal migration of hypocenters',
  `sd_ivl_vmigr_hyp` float DEFAULT NULL COMMENT 'Vertical migration of hypocenters',
  `sd_ivl_patt` varchar(30) DEFAULT NULL COMMENT 'Temporal pattern',
  `sd_ivl_data` enum('L','C','H','U') DEFAULT NULL COMMENT 'Data type: L=Located earthquakes, C=Detected by computer trigger algorithm, H=Hand counted, U=Unknown',
  `sd_ivl_picks` enum('A','R','H','U') DEFAULT NULL COMMENT 'Determination of picks: A=Automatic picker, R=Ruler, H=Human using a computer-based picker, U=Unknown',
  `sd_ivl_felt_stime` datetime DEFAULT NULL COMMENT 'Earthquake counts felt start time',
  `sd_ivl_felt_stime_unc` datetime DEFAULT NULL COMMENT 'Earthquake counts felt start time uncertainty',
  `sd_ivl_felt_etime` datetime DEFAULT NULL COMMENT 'Earthquake counts felt end time',
  `sd_ivl_felt_etime_unc` datetime DEFAULT NULL COMMENT 'Earthquake counts felt end time uncertainty',
  `sd_ivl_nrec` mediumint(6) unsigned DEFAULT NULL COMMENT 'Number of recorded earthquakes',
  `sd_ivl_nfelt` smallint(4) unsigned DEFAULT NULL COMMENT 'Number of felt earthquakes',
  `sd_ivl_etot_stime` datetime DEFAULT NULL COMMENT 'Total seismic energy release measurement start time',
  `sd_ivl_etot_stime_unc` datetime DEFAULT NULL COMMENT 'Total seismic energy release measurement start time uncertainty',
  `sd_ivl_etot_etime` datetime DEFAULT NULL COMMENT 'Total seismic energy release measurement end time',
  `sd_ivl_etot_etime_unc` datetime DEFAULT NULL COMMENT 'Total seismic energy release measurement end time uncertainty',
  `sd_ivl_etot` float DEFAULT NULL COMMENT 'Total seismic energy release',
  `sd_ivl_fmin` float DEFAULT NULL COMMENT 'Minimum frequency',
  `sd_ivl_fmax` float DEFAULT NULL COMMENT 'Maximum frequency',
  `sd_ivl_amin` float DEFAULT NULL COMMENT 'Minimum amplitude',
  `sd_ivl_amax` float DEFAULT NULL COMMENT 'Maximum amplitude',
  `sd_ivl_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `sd_ivl_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `sd_ivl_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `sd_ivl_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `sd_ivl_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`sd_ivl_id`),
  KEY `CODE` (`sd_ivl_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `NETWORK` (`sn_id`),
  KEY `STATION` (`ss_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Interval (swarm)' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sd_rsm`
--

CREATE TABLE IF NOT EXISTS `sd_rsm` (
  `sd_rsm_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sd_sam_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'RSAM-SSAM ID',
  `sd_rsm_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `sd_rsm_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `sd_rsm_count` float DEFAULT NULL COMMENT 'Count',
  `sd_rsm_calib` float DEFAULT NULL COMMENT 'Reduced displacement per 100 RSAM counts',
  `sd_rsm_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `sd_rsm_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`sd_rsm_id`),
  UNIQUE KEY `TIME` (`sd_sam_id`,`sd_rsm_stime`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='RSAM data' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sd_sam`
--

CREATE TABLE IF NOT EXISTS `sd_sam` (
  `sd_sam_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sd_sam_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ss_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Seismic station ID',
  `sd_sam_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `sd_sam_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `sd_sam_etime` datetime DEFAULT NULL COMMENT 'End time',
  `sd_sam_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `sd_sam_int` float DEFAULT NULL COMMENT 'Counting interval',
  `sd_sam_int_unc` float DEFAULT NULL COMMENT 'Counting interval uncertainty',
  `sd_sam_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `sd_sam_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `sd_sam_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `sd_sam_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`sd_sam_id`),
  KEY `CODE` (`sd_sam_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ss_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='RSAM-SSAM' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sd_ssm`
--

CREATE TABLE IF NOT EXISTS `sd_ssm` (
  `sd_ssm_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sd_sam_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'RSAM-SSAM ID',
  `sd_ssm_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `sd_ssm_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `sd_ssm_lowf` float DEFAULT NULL COMMENT 'Low frequency limit',
  `sd_ssm_highf` float DEFAULT NULL COMMENT 'High frequency limit',
  `sd_ssm_count` float DEFAULT NULL COMMENT 'Count',
  `sd_ssm_calib` float DEFAULT NULL COMMENT 'Reduced displacement per 100 SSAM counts',
  `sd_ssm_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `sd_ssm_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`sd_ssm_id`),
  UNIQUE KEY `TIME AND FREQUENCY` (`sd_sam_id`,`sd_ssm_stime`,`sd_ssm_lowf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='SSAM data' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sd_trm`
--

CREATE TABLE IF NOT EXISTS `sd_trm` (
  `sd_trm_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sd_trm_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `sn_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Seismic network ID',
  `ss_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Seismic station ID',
  `sd_trm_stime` datetime DEFAULT NULL COMMENT 'Start time',
  `sd_trm_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `sd_trm_etime` datetime DEFAULT NULL COMMENT 'End time',
  `sd_trm_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `sd_trm_dur_day` float DEFAULT NULL COMMENT 'Duration per day',
  `sd_trm_dur_day_unc` float DEFAULT NULL COMMENT 'Duration per day uncertainty',
  `sd_trm_type` enum('G','M','H','C') DEFAULT NULL COMMENT 'Type: G=General, M=Monochromatic, H=Harmonic, C=Close-events',
  `sd_trm_qdepth` enum('D','I','S','U') DEFAULT NULL COMMENT 'Qualitative depth: D=Deep (>10 km), I=Intermediate (4-10 km), S=Shallow (0-4 km), U =Unknown',
  `sd_trm_domfreq1` float DEFAULT NULL COMMENT 'Dominant frequency',
  `sd_trm_domfreq2` float DEFAULT NULL COMMENT 'Second dominant frequency',
  `sd_trm_maxamp` float DEFAULT NULL COMMENT 'Maximum amplitude',
  `sd_trm_noise` float DEFAULT NULL COMMENT 'Background noise level',
  `sd_trm_reddis` float DEFAULT NULL COMMENT 'Reduced displacement (as estimated using a station >5km from source)',
  `sd_trm_rderr` float DEFAULT NULL COMMENT 'Reduced displacement error',
  `sd_trm_visact` varchar(255) DEFAULT NULL COMMENT 'Description of associated visible activity',
  `sd_trm_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `sd_trm_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `sd_trm_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `sd_trm_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`sd_trm_id`),
  KEY `CODE` (`sd_trm_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ss_id`),
  KEY `NETWORK` (`sn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tremor' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sd_wav`
--

CREATE TABLE IF NOT EXISTS `sd_wav` (
  `sd_wav_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sd_wav_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ss_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Seismic station ID',
  `sd_evn_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Seismic event ID',
  `sd_evs_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Single Station Event ID',
  `sd_trm_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Tremor ID',
  `sd_wav_arch` varchar(255) DEFAULT NULL COMMENT 'Location of seismogram archive',
  `sd_wav_link` varchar(255) DEFAULT NULL COMMENT 'Link to archive',
  `sd_wav_dist` enum('P','I','D','U') DEFAULT NULL COMMENT 'Distance from summit: P=Proximal (< 2 km), I=Intermediate (2-5 km), D=Distal (> 5 km), U=Unknown',
  `sd_wav_img` varchar(255) DEFAULT NULL COMMENT 'Image',
  `sd_wav_info` varchar(255) DEFAULT NULL COMMENT 'Information',
  `sd_wav_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `sd_wav_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `sd_wav_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `sd_wav_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `sd_wav_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`sd_wav_id`),
  KEY `CODE` (`sd_wav_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ss_id`),
  KEY `EVENT` (`sd_evn_id`),
  KEY `EVENT TYPE` (`sd_evs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Waveform' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `si`
--

CREATE TABLE IF NOT EXISTS `si` (
  `si_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `si_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ss_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Seismic station ID',
  `si_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `si_type` varchar(255) DEFAULT NULL COMMENT 'Type',
  `si_range` varchar(255) DEFAULT NULL COMMENT 'Dynamic range',
  `si_igain` float DEFAULT NULL COMMENT 'Gain',
  `si_filter` varchar(255) DEFAULT NULL COMMENT 'Filters',
  `si_ncomp` tinyint(3) unsigned DEFAULT NULL COMMENT 'Number of components',
  `si_resp` varchar(255) DEFAULT NULL COMMENT 'Response overview',
  `si_resp_file` varchar(255) DEFAULT NULL COMMENT 'File containing response',
  `si_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `si_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `si_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `si_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `si_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `si_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `si_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `si_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`si_id`),
  KEY `CODE` (`si_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ss_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Seismic instrument' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `si_cmp`
--

CREATE TABLE IF NOT EXISTS `si_cmp` (
  `si_cmp_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `si_cmp_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `si_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Seismic instrument ID',
  `si_cmp_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `si_cmp_type` varchar(255) DEFAULT NULL COMMENT 'Type',
  `si_cmp_resp` varchar(255) DEFAULT NULL COMMENT 'Description of response',
  `si_cmp_band` varchar(30) DEFAULT NULL COMMENT 'Band type (SEED convention)',
  `si_cmp_samp` float DEFAULT NULL COMMENT 'Sampling rate',
  `si_cmp_icode` varchar(30) DEFAULT NULL COMMENT 'Instrument code (SEED convention)',
  `si_cmp_orient` varchar(30) DEFAULT NULL COMMENT 'Orientation code (SEED convention)',
  `si_cmp_sens` varchar(255) DEFAULT NULL COMMENT 'Sensitivity',
  `si_cmp_depth` float DEFAULT NULL COMMENT 'Depth',
  `si_cmp_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `si_cmp_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `si_cmp_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `si_cmp_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`si_cmp_id`),
  KEY `CODE` (`si_cmp_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `INSTRUMENT` (`si_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Seismic component' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sn`
--

CREATE TABLE IF NOT EXISTS `sn` (
  `sn_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sn_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `sn_name` varchar(30) DEFAULT NULL COMMENT 'Name',
  `sn_vmodel` varchar(511) DEFAULT NULL COMMENT 'Description of velocity model',
  `sn_vmodel_detail` varchar(255) DEFAULT NULL COMMENT 'Link to a file containing additional details about velocity model',
  `sn_zerokm` varchar(255) DEFAULT NULL COMMENT 'Elevation of zero km “depth”',
  `sn_fdepth_flag` enum('Y','N','U') DEFAULT NULL COMMENT 'A flag whether depth is fixed',
  `sn_fdepth` varchar(255) DEFAULT NULL,
  `sn_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `sn_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `sn_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `sn_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `sn_tot` tinyint(3) unsigned DEFAULT NULL COMMENT 'Total number of seismometers',
  `sn_bb` tinyint(3) unsigned DEFAULT NULL COMMENT 'Number of broadband seismometers',
  `sn_smp` tinyint(3) unsigned DEFAULT NULL COMMENT 'Number of short- and mid-period seismometers',
  `sn_digital` tinyint(3) unsigned DEFAULT NULL COMMENT 'Number of digital seismometers',
  `sn_analog` tinyint(3) unsigned DEFAULT NULL COMMENT 'Number of analog seismometers',
  `sn_tcomp` tinyint(3) unsigned DEFAULT NULL COMMENT 'Number of 3 component seismometers',
  `sn_micro` tinyint(3) unsigned DEFAULT NULL COMMENT 'Number of microphones',
  `sn_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `sn_utc` float DEFAULT NULL COMMENT 'Difference from UTC',
  `sn_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `sn_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `sn_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `sn_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`sn_id`),
  KEY `CODE` (`sn_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Seismic network' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ss`
--

CREATE TABLE IF NOT EXISTS `ss` (
  `ss_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ss_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `sn_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Seismic network ID',
  `ss_name` varchar(30) DEFAULT NULL COMMENT 'Name',
  `ss_lat` double DEFAULT NULL COMMENT 'Latitude',
  `ss_lon` double DEFAULT NULL COMMENT 'Longitude',
  `ss_elev` float DEFAULT NULL COMMENT 'Elevation',
  `ss_depth` varchar(255) DEFAULT NULL COMMENT 'Depth of instruments',
  `ss_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `ss_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `ss_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `ss_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `ss_utc` float DEFAULT NULL COMMENT 'Difference from UTC',
  `ss_instr_type` varchar(255) DEFAULT NULL COMMENT 'Instrument types',
  `ss_sgain` float DEFAULT NULL COMMENT 'System gain',
  `ss_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `ss_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `ss_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ss_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ss_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ss_id`),
  KEY `CODE` (`ss_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `NETWORK` (`sn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Seismic station' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `st_eqt`
--

CREATE TABLE IF NOT EXISTS `st_eqt` (
  `st_eqt_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `st_eqt_wovo` varchar(255) DEFAULT NULL COMMENT 'WOVOdat terminology',
  `st_eqt_org` varchar(255) DEFAULT NULL COMMENT 'Original terminology',
  `st_eqt_name` varchar(30) DEFAULT NULL,
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `st_eqt_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`st_eqt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Earthquake type translation';

-- --------------------------------------------------------

--
-- Table structure for table `td`
--

CREATE TABLE IF NOT EXISTS `td` (
  `td_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `td_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `ts_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Thermal station',
  `ti_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Thermal instrument',
  `td_mtype` varchar(255) DEFAULT NULL COMMENT 'Measurement type',
  `td_time` datetime DEFAULT NULL COMMENT 'Measurement time',
  `td_time_unc` datetime DEFAULT NULL COMMENT 'Measurement time uncertainty',
  `td_depth` float DEFAULT NULL COMMENT 'Depth of measurement',
  `td_distance` float DEFAULT NULL COMMENT 'Distance from instrument to the measured object',
  `td_calc_flag` enum('O','R') DEFAULT NULL COMMENT 'Recalculated value: O=Original, R=Recalculated',
  `td_temp` float DEFAULT NULL COMMENT 'Temperature',
  `td_terr` float DEFAULT NULL COMMENT 'Temperature standard error',
  `td_aarea` float DEFAULT NULL COMMENT 'Approximate area of body measured',
  `td_flux` float DEFAULT NULL COMMENT 'Heat flux',
  `td_ferr` float DEFAULT NULL COMMENT 'Heat flux standard error',
  `td_bkgg` float DEFAULT NULL COMMENT 'Background geothermal gradient',
  `td_tcond` float DEFAULT NULL COMMENT 'Thermal conductivity',
  `td_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `td_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `td_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `td_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`td_id`),
  KEY `CODE` (`td_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ts_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Ground-based thermal data' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `td_img`
--

CREATE TABLE IF NOT EXISTS `td_img` (
  `td_img_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `td_img_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `cs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Satellite ID',
  `ts_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Thermal station ID',
  `ti_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Thermal instrument ID',
  `td_img_iplat` varchar(255) DEFAULT NULL COMMENT 'Description of instrument platform',
  `td_img_ialt` float DEFAULT NULL COMMENT 'Instrument altitude',
  `td_img_ilat` float DEFAULT NULL COMMENT 'Instrument latitude',
  `td_img_ilon` float DEFAULT NULL COMMENT 'Instrument longitude',
  `td_img_idatum` varchar(50) DEFAULT NULL COMMENT 'Datum',
  `td_img_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `td_img_time` datetime DEFAULT NULL COMMENT 'Time',
  `td_img_time_unc` datetime DEFAULT NULL COMMENT 'Time uncertainty',
  `td_img_bname` varchar(255) DEFAULT NULL COMMENT 'Band name',
  `td_img_hbwave` float DEFAULT NULL COMMENT 'High band wavelength',
  `td_img_lbwave` float DEFAULT NULL COMMENT 'Low band wavelength',
  `td_img_path` varchar(255) DEFAULT NULL COMMENT 'Image Path',
  `td_img_psize` float DEFAULT NULL COMMENT 'Pixel size',
  `td_img_maxrad` float DEFAULT NULL COMMENT 'Maximum radiance',
  `td_img_maxrrad` float DEFAULT NULL COMMENT 'Maximum relative radiance',
  `td_img_maxtemp` float DEFAULT NULL COMMENT 'Maximum temperature',
  `td_img_totrad` float DEFAULT NULL COMMENT 'Total radiance in the frame',
  `td_img_maxflux` float DEFAULT NULL COMMENT 'Maximum heat flux',
  `td_img_ntres` float DEFAULT NULL COMMENT 'Nominal temperature resolution',
  `td_img_atmcorr` varchar(255) DEFAULT NULL COMMENT 'Atmospheric correction',
  `td_img_thmcorr` varchar(255) DEFAULT NULL COMMENT 'Thermal correction',
  `td_img_ortho` varchar(255) DEFAULT NULL COMMENT 'Orthorectification procedure',
  `td_img_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `td_img_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `td_img_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `td_img_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`td_img_id`),
  KEY `CODE` (`td_img_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ts_id`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Thermal image' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `td_pix`
--

CREATE TABLE IF NOT EXISTS `td_pix` (
  `td_pix_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `td_img_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Thermal image ID',
  `td_pix_elev` float DEFAULT NULL COMMENT 'Elevation',
  `td_pix_lat` float DEFAULT NULL COMMENT 'Latitude',
  `td_pix_lon` float DEFAULT NULL COMMENT 'Longitude',
  `td_pix_rad` float DEFAULT NULL COMMENT 'Radiance',
  `td_pix_flux` float DEFAULT NULL COMMENT 'Heat flux',
  `td_pix_temp` float DEFAULT NULL COMMENT 'Temperature',
  `td_pix_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `td_pix_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`td_pix_id`),
  UNIQUE KEY `LAT/LON` (`td_img_id`,`td_pix_lat`,`td_pix_lon`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Thermal image pixel' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ti`
--

CREATE TABLE IF NOT EXISTS `ti` (
  `ti_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ti_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `cs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Satellite ID',
  `ts_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Thermal station ID',
  `ti_type` varchar(255) DEFAULT NULL COMMENT 'Type',
  `ti_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `ti_units` varchar(50) DEFAULT NULL COMMENT 'Measured units',
  `ti_pres` float DEFAULT NULL COMMENT 'Resolution',
  `ti_stn` float DEFAULT NULL COMMENT 'Signal to noise',
  `ti_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `ti_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `ti_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `ti_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `ti_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `ti_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ti_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ti_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ti_id`),
  KEY `CODE` (`ti_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `STATION` (`ts_id`),
  KEY `SATELLITE` (`cs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Thermal instrument' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ts`
--

CREATE TABLE IF NOT EXISTS `ts` (
  `ts_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ts_code` varchar(30) DEFAULT NULL COMMENT 'Code',
  `cn_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Thermal network ID',
  `ts_name` varchar(30) DEFAULT NULL COMMENT 'Name',
  `ts_type` varchar(255) DEFAULT NULL COMMENT 'Type of thermal feature',
  `ts_ground` varchar(255) DEFAULT NULL COMMENT 'Soil or ground type',
  `ts_lat` float DEFAULT NULL COMMENT 'Latitude',
  `ts_lon` float DEFAULT NULL COMMENT 'Longitude',
  `ts_elev` float DEFAULT NULL COMMENT 'Elevation',
  `ts_perm` varchar(255) DEFAULT NULL COMMENT 'List of permanent instruments',
  `ts_utc` float DEFAULT NULL COMMENT 'Difference from UTC',
  `ts_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start date',
  `ts_stime_unc` datetime DEFAULT NULL COMMENT 'Start date uncertainty',
  `ts_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End date',
  `ts_etime_unc` datetime DEFAULT NULL COMMENT 'End date uncertainty',
  `ts_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `ts_ori` enum('D','O') DEFAULT NULL COMMENT 'A flag for source of data: D=digitized/Bibliography, O=Original from observatory',
  `ts_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 2 ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Owner 3 ID',
  `ts_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `ts_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`ts_id`),
  KEY `CODE` (`ts_code`),
  KEY `OWNER 1` (`cc_id`),
  KEY `OWNER 2` (`cc_id2`),
  KEY `OWNER 3` (`cc_id3`),
  KEY `NETWORK` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Thermal station' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vd`
--

CREATE TABLE IF NOT EXISTS `vd` (
  `vd_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `vd_cavw` varchar(15) DEFAULT NULL COMMENT 'The current CAVW number for this volcano',
  `vd_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `vd_name2` varchar(255) DEFAULT NULL COMMENT 'Name',
  `vd_tzone` float DEFAULT NULL COMMENT 'Time zone',
  `vd_mcont` char(1) DEFAULT NULL COMMENT 'M=Multiple contacts for this volcano',
  `vd_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id4` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id5` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `vd_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `vd_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`vd_id`),
  UNIQUE KEY `CAVW NUMBER` (`vd_cavw`),
  KEY `cc_id` (`cc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Volcano' AUTO_INCREMENT=1678 ;

-- --------------------------------------------------------

--
-- Table structure for table `vd_inf`
--

CREATE TABLE IF NOT EXISTS `vd_inf` (
  `vd_inf_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `vd_inf_cavw` varchar(15) DEFAULT NULL COMMENT 'CAVW number',
  `vd_inf_status` enum('Anthropology','Ar/Ar','Dendrochronology','Fumarolic','Historical','Holocene','Holocene?','Hot Springs','Hydration Rind','Hydrophonic','Ice Core','Lichenometry','Magnetism','Pleistocene','Potassium-Argon','Radiocarbon','Seismicity','Surface Exposure','Tephrochronology','Thermoluminescence','Uncertain','Uranium-series','Varve Count','Unknown') NOT NULL DEFAULT 'Unknown' COMMENT 'Status',
  `vd_inf_desc` varchar(255) DEFAULT NULL COMMENT 'Short narrative',
  `vd_inf_slat` double DEFAULT NULL COMMENT 'Summit latitude',
  `vd_inf_slon` double DEFAULT NULL COMMENT 'Summit longitude',
  `vd_inf_selev` float DEFAULT NULL COMMENT 'Summit elevation',
  `vd_inf_type` enum('Caldera','Cinder cone','Complex volcano','Compound volcano','Cone','Crater rows','Explosion craters','Fissure vent','Hydrothermal field','Lava cone','Lava dome','Maar','Pumice cone','Pyroclastic cone','Pyroclastic shield','Scoria cone','Shield volcano','Somma volcano','Stratovolcano','Subglacial volcano','Submarine volcano','Tuff cone','Tuff ring','Unknown','Volcanic complex','Volcanic field') NOT NULL DEFAULT 'Unknown' COMMENT 'Type',
  `vd_inf_loc` varchar(30) DEFAULT NULL COMMENT 'Geographic location ',
  `vd_inf_rtype` enum('Basalt','Tephrit/Trachybasalt','Andesite/Basaltic-andesite','Trachyandesite','Dacite','Rhyolite','Trachyte','Phonolite','Phonotephrite','Foidite','Unknown') NOT NULL DEFAULT 'Unknown' COMMENT 'Dominant Rock Type',
  `vd_inf_evol` float DEFAULT NULL COMMENT 'Volume of edifice',
  `vd_inf_numcald` tinyint(4) unsigned DEFAULT NULL COMMENT 'Number of calderas',
  `vd_inf_lcald_dia` float DEFAULT NULL COMMENT 'Diameter of largest caldera',
  `vd_inf_ycald_lat` double DEFAULT NULL COMMENT 'Latitude of youngest caldera',
  `vd_inf_ycald_lon` double DEFAULT NULL COMMENT 'Longitude of youngest caldera',
  `vd_inf_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start time',
  `vd_inf_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `vd_inf_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End time',
  `vd_inf_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `vd_inf_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `vd_inf_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `vd_inf_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`vd_inf_id`),
  KEY `TYPE` (`vd_inf_type`),
  KEY `VOLCANO` (`vd_id`),
  KEY `STATUS` (`vd_inf_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Volcano information' AUTO_INCREMENT=1648 ;

-- --------------------------------------------------------

--
-- Table structure for table `vd_mag`
--

CREATE TABLE IF NOT EXISTS `vd_mag` (
  `vd_mag_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `vd_mag_lvz_dia` float DEFAULT NULL COMMENT 'Diameter of low velocity zone',
  `vd_mag_lvz_vol` float DEFAULT NULL COMMENT 'Volume of low velocity zone',
  `vd_mag_tlvz` float DEFAULT NULL COMMENT 'Depth to top of low velocity zone',
  `vd_mag_lerup_vol` double DEFAULT NULL COMMENT 'Volume of largest eruption',
  `vd_mag_drock` varchar(60) DEFAULT NULL COMMENT 'Dominant rock type',
  `vd_mag_orock` varchar(60) DEFAULT NULL COMMENT 'Outlier rock type',
  `vd_mag_orock2` varchar(60) DEFAULT NULL COMMENT 'Second outlier rock type',
  `vd_mag_orock3` varchar(60) DEFAULT NULL COMMENT 'Third outlier rock type',
  `vd_mag_minsio2` float DEFAULT NULL COMMENT 'Minimum SiO2 content of whole rocks erupted',
  `vd_mag_maxsio2` float DEFAULT NULL COMMENT 'Maximum SiO2 content of whole rocks erupted',
  `vd_mag_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `vd_mag_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `vd_mag_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`vd_mag_id`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Magma chamber' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vd_tec`
--

CREATE TABLE IF NOT EXISTS `vd_tec` (
  `vd_tec_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `vd_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Volcano ID',
  `vd_tec_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `vd_tec_strslip` float DEFAULT NULL COMMENT 'Rate of strike-slip',
  `vd_tec_ext` float DEFAULT NULL COMMENT 'Rate of extension',
  `vd_tec_conv` float DEFAULT NULL COMMENT 'Rate of convergence',
  `vd_tec_travhs` float DEFAULT NULL COMMENT 'Travel rate across hotspot',
  `vd_tec_com` varchar(255) DEFAULT NULL COMMENT 'Comments',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Collector ID',
  `vd_tec_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `vd_tec_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  `cb_ids` varchar(255) DEFAULT NULL COMMENT 'List of cb_ids (linking to cb.cb_id) separated by a comma',
  PRIMARY KEY (`vd_tec_id`),
  KEY `VOLCANO` (`vd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tectonic setting' AUTO_INCREMENT=1 ;
INSERT INTO cc (cc_id,cc_code,cc_code2,cc_fname,cc_lname,cc_obs,cc_add1,cc_add2,cc_city,cc_state,cc_country, cc_post,cc_url,cc_email,cc_phone,cc_phone2,cc_fax,cc_com,cc_loaddate) VALUES('134','CVGHM','VSI','','','Volcanological Survey of Indonesia','Jalan Diponegoro No. 57','','Bandung','','Indonesia','40122','http://www.vsi.esdm.go.id','surono@vsi.esdm.go.id','(62-22) 727 2606, 727 1402, 721 4612','','(62) 22-720 2761','Directorate of Volcanology and Geological Hazards Mitigation','2009-07-23 07:21:27');
INSERT INTO vd(vd_id,vd_cavw,vd_name,vd_name2,vd_tzone,vd_mcont,cc_id,cc_id2,cc_id3,cc_id4,cc_id5,vd_loaddate,vd_pubdate,cc_id_load) VALUES ('407','0601-02=','261020','Seulawah Agam','Seulawaih Agam','7','N','','134','','','','','2009-05-01 00:00:00'),('408','0601-03=','261030','Peuet Sague','Puet Sagu','7','N','','134','','','','','2009-05-01 00:00:00'),('409','0601-05=','261050','Telong, Bur ni','Tutong, Gunung','7','N','','134','','','','','2009-05-01 00:00:00'),('410','0601-07=','261070','Sibayak','Sibajak','7','N','','134','','','','','2009-05-01 00:00:00'),('411','0601-08=','261080','Sinabung','Sinaboeng','7','N','','134','','','','','2009-05-01 00:00:00'),('412','0601-09=','261090','Toba','','7','N','','134','','','','','2009-05-01 00:00:00'),('413','0601-101','261101','Imun','','7','N','','134','','','','','2009-05-01 00:00:00'),('414','0601-111','261111','Lubukraya','Lubuk Raja','7','N','','134','','','','','2009-05-01 00:00:00'),('415','0601-11=','261110','Sibualbuali','Bual Buali','7','N','','134','','','','','2009-05-01 00:00:00'),('416','0601-12=','261120','Sorikmarapi','Sorieq Berapi','7','N','','134','','','','','2009-05-01 00:00:00'),('417','0601-131','261131','Sarik-Gajah','','7','N','','134','','','','','2009-05-01 00:00:00'),('418','0601-13=','261130','Talakmau','Talamau','7','N','','134','','','','','2009-05-01 00:00:00'),('419','0601-14=','261140','Marapi','Merapi','7','N','','134','','','','','2009-05-01 00:00:00'),('420','0601-15=','261150','Tandikat','Tandikai','7','N','','134','','','','','2009-05-01 00:00:00'),('421','0601-16=','261160','Talang','Tallang','7','N','','134','','','','','2009-05-01 00:00:00'),('422','0601-171','261171','Kunyit','Koenjit','7','N','','134','','','','','2009-05-01 00:00:00'),('423','0601-172','261172','Hutapanjang','Hulumajang','7','N','','134','','','','','2009-05-01 00:00:00'),('424','0601-17=','261170','Kerinci','Korinci','7','N','','134','','','','','2009-05-01 00:00:00'),('425','0601-18=','261180','Sumbing0601-18=','Soembing','7','N','','134','','','','','2009-05-01 00:00:00'),('426','0601-191','261191','Pendan','Pandan','7','N','','134','','','','','2009-05-01 00:00:00'),('427','0601-20=','261200','Belirang-Beriti','Blerang-beriti','7','N','','134','','','','','2009-05-01 00:00:00'),('428','0601-21=','261210','Daun, Bukit','Lumutdaun, Bukit','7','N','','134','','','','','2009-05-01 00:00:00'),('429','0601-22=','261220','Kaba','Kaaba','7','N','','134','','','','','2009-05-01 00:00:00'),('430','0601-231','261231','Patah','','7','N','','134','','','','','2009-05-01 00:00:00'),('431','0601-23=','261230','Dempo','','7','N','','134','','','','','2009-05-01 00:00:00'),('432','0601-24=','261240','Lumut Balai, Bukit','Loemoet Balai, Boekit','7','N','','134','','','','','2009-05-01 00:00:00'),('433','0601-251','261251','Ranau','','7','N','','134','','','','','2009-05-01 00:00:00'),('434','0601-25=','261250','Besar','Basar','7','N','','134','','','','','2009-05-01 00:00:00'),('435','0601-26=','261260','Sekincau Belirang','Sekintjau Belirang','7','N','','134','','','','','2009-05-01 00:00:00'),('436','0601-27=','261270','Suoh','Soeoh-Senke','7','N','','134','','','','','2009-05-01 00:00:00'),('437','0601-28=','261280','Hulubelu','Hoeloebeloe','7','N','','134','','','','','2009-05-01 00:00:00'),('438','0601-29=','261290','Rajabasa','Lobo Radja','7','N','','134','','','','','2009-05-01 00:00:00'),('439','0602-00=','262000','Krakatau','Cracatoa','7','N','','134','','','','','2009-05-01 00:00:00'),('440','0603-01=','263010','Pulosari','Poelasari','7','N','','134','','','','','2009-05-01 00:00:00'),('441','0603-02=','263020','Karang','Kalang','7','N','','134','','','','','2009-05-01 00:00:00'),('442','0603-04=','263040','Perbakti-Gagak','','7','N','','134','','','','','2009-05-01 00:00:00'),('443','0603-05=','263050','Salak','Satak','7','N','','134','','','','','2009-05-01 00:00:00'),('444','0603-06=','263060','Gede','Gedeh','7','N','','134','','','','','2009-05-01 00:00:00'),('445','0603-07=','263070','Patuha','Patoeha','7','N','','134','','','','','2009-05-01 00:00:00'),('446','0603-081','263081','Malabar','','7','N','','134','','','','','2009-05-01 00:00:00'),('447','0603-08=','263080','Wayang-Windu','Walang','7','N','','134','','','','','2009-05-01 00:00:00'),('448','0603-09=','263090','Tangkubanparahu','Tangkuban Parahu','7','N','','134','','','','','2009-05-01 00:00:00'),('449','0603-10=','263100','Papandayan','Papandajan','7','N','','134','','','','','2009-05-01 00:00:00'),('450','0603-11=','263110','Kendang','Kendeng','7','N','','134','','','','','2009-05-01 00:00:00'),('451','0603-131','263131','Tampomas','','7','N','','134','','','','','2009-05-01 00:00:00'),('452','0603-13=','263130','Guntur','Goentoer','7','N','','134','','','','','2009-05-01 00:00:00'),('453','0603-14=','263140','Galunggung','Galoenggoeng','7','N','','134','','','','','2009-05-01 00:00:00'),('454','0603-15=','263150','Talagabodas','Telagabodas','7','N','','134','','','','','2009-05-01 00:00:00'),('455','0603-16=','263160','Karaha, Kawah','Kawahkaraha','7','N','','134','','','','','2009-05-01 00:00:00'),('456','0603-17=','263170','Cereme','Tjareme','7','N','','134','','','','','2009-05-01 00:00:00'),('457','0603-18=','263180','Slamet','Slamat','7','N','','134','','','','','2009-05-01 00:00:00'),('458','0603-20=','263200','Dieng Volc Complex','Pegunungan Dieng','7','N','','134','','','','','2009-05-01 00:00:00'),('459','0603-21=','263210','Sundoro','Soendoro','7','N','','134','','','','','2009-05-01 00:00:00'),('460','0603-22=','263220','Sumbing0603-22=','Soembing','7','N','','134','','','','','2009-05-01 00:00:00'),('461','0603-231','263231','Telomoyo','Telomojo','7','N','','134','','','','','2009-05-01 00:00:00'),('462','0603-23=','263230','Ungaran','Oengaran','7','N','','134','','','','','2009-05-01 00:00:00'),('463','0603-24=','263240','Merbabu','Merbaboe','7','N','','134','','','','','2009-05-01 00:00:00'),('464','0603-251','263251','Muria','Muriah','7','N','','134','','','','','2009-05-01 00:00:00'),('465','0603-25=','263250','Merapi','','7','N','','134','','','','','2009-05-01 00:00:00'),('466','0603-26=','263260','Lawu','Lawoe','7','N','','134','','','','','2009-05-01 00:00:00'),('467','0603-27=','263270','Wilis','Adika-wilis','7','N','','134','','','','','2009-05-01 00:00:00'),('468','0603-281','263281','Kawi-Butak','','7','N','','134','','','','','2009-05-01 00:00:00'),('469','0603-28=','263280','Kelut','Kloet','7','N','','134','','','','','2009-05-01 00:00:00'),('470','0603-291','263291','Penanggungan','','7','N','','134','','','','','2009-05-01 00:00:00'),('471','0603-292','263292','Malang Plain','','7','N','','134','','','','','2009-05-01 00:00:00'),('472','0603-29=','263290','Arjuno-Welirang','','7','N','','134','','','','','2009-05-01 00:00:00'),('473','0603-30=','263300','Semeru','Smeru','7','N','','134','','','','','2009-05-01 00:00:00'),('474','0603-31=','263310','Tengger Caldera','Bromo-Tengger Caldera','7','N','','134','','','','','2009-05-01 00:00:00'),('475','0603-321','263321','Lurus','Loeroes','7','N','','134','','','','','2009-05-01 00:00:00'),('476','0603-32=','263320','Lamongan','Lemongan','7','N','','134','','','','','2009-05-01 00:00:00'),('477','0603-33=','263330','Iyang-Argapura','Ijang-Argapura','7','N','','134','','','','','2009-05-01 00:00:00'),('478','0603-34=','263340','Raung','Raoeng','7','N','','134','','','','','2009-05-01 00:00:00'),('479','0603-351','263351','Baluran','','7','N','','134','','','','','2009-05-01 00:00:00'),('480','0603-35=','263350','Ijen','Ijen, Kawah','7','N','','134','','','','','2009-05-01 00:00:00'),('481','0604-001','264001','Bratan','Catur Caldera','8','N','','134','','','','','2009-05-01 00:00:00'),('482','0604-01=','264010','Batur','Batoer','8','N','','134','','','','','2009-05-01 00:00:00'),('483','0604-02=','264020','Agung','Bali, Peak of','8','N','','134','','','','','2009-05-01 00:00:00'),('484','0604-03=','264030','Rinjani','Rindjani','8','N','','134','','','','','2009-05-01 00:00:00'),('485','0604-04=','264040','Tambora','Tomboro','8','N','','134','','','','','2009-05-01 00:00:00'),('486','0604-05=','264050','Sangeang Api','Sangean Api','8','N','','134','','','','','2009-05-01 00:00:00'),('487','0604-06=','264060','Sano, Wai','','8','N','','134','','','','','2009-05-01 00:00:00'),('488','0604-071','264071','Ranakah','','8','N','','134','','','','','2009-05-01 00:00:00'),('489','0604-07=','264070','Poco Leok','Potjo Leok','8','N','','134','','','','','2009-05-01 00:00:00'),('490','0604-08=','264080','Inierie','Ineri','8','N','','134','','','','','2009-05-01 00:00:00'),('491','0604-09=','264090','Inielika','Inie Lika','8','N','','134','','','','','2009-05-01 00:00:00'),('492','0604-10=','264100','Ebulobo','Keo Peak','8','N','','134','','','','','2009-05-01 00:00:00'),('493','0604-11=','264110','Iya','Ija','8','N','','134','','','','','2009-05-01 00:00:00'),('494','0604-12=','264120','Sukaria Caldera','Soekaria Caldera','8','N','','134','','','','','2009-05-01 00:00:00'),('495','0604-13=','264130','Ndete Napu','Ndetu Napu','8','N','','134','','','','','2009-05-01 00:00:00'),('496','0604-14=','264140','Kelimutu','Geli Moetoe','8','N','','134','','','','','2009-05-01 00:00:00'),('497','0604-15=','264150','Paluweh','Paloe','8','N','','134','','','','','2009-05-01 00:00:00'),('498','0604-16=','264160','Egon','Namang','8','N','','134','','','','','2009-05-01 00:00:00'),('499','0604-17=','264170','Ilimuda','Ilimoeda','8','N','','134','','','','','2009-05-01 00:00:00'),('500','0604-18=','264180','Lewotobi','Lobetobi','8','N','','134','','','','','2009-05-01 00:00:00'),('501','0604-20=','264200','Leroboleng','Lewono','8','N','','134','','','','','2009-05-01 00:00:00'),('502','0604-22=','264220','Iliboleng','Bolin','8','N','','134','','','','','2009-05-01 00:00:00'),('503','0604-23=','264230','Lewotolo','Gunungapi','8','N','','134','','','','','2009-05-01 00:00:00'),('504','0604-24=','264240','Ililabalekan','Ililamararap','8','N','','134','','','','','2009-05-01 00:00:00'),('505','0604-25=','264250','Iliwerung','Iliweroeng','8','N','','134','','','','','2009-05-01 00:00:00'),('506','0604-26=','264260','Tara, Batu','Tara, Batoe','8','N','','134','','','','','2009-05-01 00:00:00'),('507','0604-27=','264270','Sirung','Siroeng','8','N','','134','','','','','2009-05-01 00:00:00'),('508','0604-28=','264280','Yersey','','8','N','','134','','','','','2009-05-01 00:00:00'),('509','0605-01=','265010','Emperor of China','','9','N','','134','','','','','2009-05-01 00:00:00'),('510','0605-02=','265020','Nieuwerkerk','','9','N','','134','','','','','2009-05-01 00:00:00'),('511','0605-03=','265030','Gunungapi Wetar','Api','9','N','','134','','','','','2009-05-01 00:00:00'),('512','0605-04=','265040','Wurlali','Damar','9','N','','134','','','','','2009-05-01 00:00:00'),('513','0605-05=','265050','Teon','Tiauw','9','N','','134','','','','','2009-05-01 00:00:00'),('514','0605-06=','265060','Nila','Kokon','9','N','','134','','','','','2009-05-01 00:00:00'),('515','0605-07=','265070','Serua','Legetala','9','N','','134','','','','','2009-05-01 00:00:00'),('516','0605-08=','265080','Manuk','Manoek','9','N','','134','','','','','2009-05-01 00:00:00'),('517','0605-09=','265090','Banda Api','','9','N','','134','','','','','2009-05-01 00:00:00'),('518','0606-01=','266010','Colo [Una Una]','Una Una','8','N','','134','','','','','2009-05-01 00:00:00'),('519','0606-02=','266020','Ambang','','8','N','','134','','','','','2009-05-01 00:00:00'),('520','0606-03=','266030','Soputan','Sopoetan','8','N','','134','','','','','2009-05-01 00:00:00'),('521','0606-04=','266040','Sempu','Sempoe','8','N','','134','','','','','2009-05-01 00:00:00'),('522','0606-07-','266070','Tondano Caldera','','8','N','','134','','','','','2009-05-01 00:00:00'),('523','0606-10=','266100','Lokon-Empung','Lokon-empoeng','8','N','','134','','','','','2009-05-01 00:00:00'),('524','0606-11=','266110','Mahawu','Mahawoe','8','N','','134','','','','','2009-05-01 00:00:00'),('525','0606-12=','266120','Klabat','','8','N','','134','','','','','2009-05-01 00:00:00'),('526','0606-13=','266130','Tongkoko','Tonkoko','8','N','','134','','','','','2009-05-01 00:00:00'),('527','0607-01=','267010','Ruang','Roeang','8','N','','134','','','','','2009-05-01 00:00:00'),('528','0607-02=','267020','Karangetang [Api Siau]','Api Siau','8','N','','134','','','','','2009-05-01 00:00:00'),('529','0607-03=','267030','Banua Wuhu','Banua Bauja','8','N','','134','','','','','2009-05-01 00:00:00'),('530','0607-04=','267040','Awu','Awoe','8','N','','134','','','','','2009-05-01 00:00:00'),('531','0607-05=','267050','Unnamed0607-05=','','8','N','','134','','','','','2009-05-01 00:00:00'),('532','0608-001','268001','Tarakan','','9','N','','134','','','','','2009-05-01 00:00:00'),('533','0608-01=','268010','Dukono','Doekono','9','N','','134','','','','','2009-05-01 00:00:00'),('534','0608-02-','268020','Tobaru','Loloda','9','N','','134','','','','','2009-05-01 00:00:00'),('535','0608-03=','268030','Ibu','Iboe','9','N','','134','','','','','2009-05-01 00:00:00'),('536','0608-04=','268040','Gamkonora','Gamkunora','9','N','','134','','','','','2009-05-01 00:00:00'),('537','0608-051','268051','Jailolo','Djailolo','9','N','','134','','','','','2009-05-01 00:00:00'),('538','0608-052','268052','Hiri','','9','N','','134','','','','','2009-05-01 00:00:00'),('539','0608-05=','268050','Todoko-Ranu','Todako','9','N','','134','','','','','2009-05-01 00:00:00'),('540','0608-061','268061','Tidore','','9','N','','134','','','','','2009-05-01 00:00:00'),('541','0608-062','268062','Mare','','9','N','','134','','','','','2009-05-01 00:00:00'),('542','0608-063','268063','Moti','Motir','9','N','','134','','','','','2009-05-01 00:00:00'),('543','0608-06=','268060','Gamalama','Ternate','9','N','','134','','','','','2009-05-01 00:00:00'),('544','0608-071','268071','Tigalalu','','9','N','','134','','','','','2009-05-01 00:00:00'),('545','0608-072','268072','Amasing','','9','N','','134','','','','','2009-05-01 00:00:00'),('546','0608-073','268073','Bibinoi','','9','N','','134','','','','','2009-05-01 00:00:00'),('547','0608-07=','268070','Makian','Wakiong','9','N','','134','','','','','2009-05-01 00:00:00'),('1583','0601-121','261121','Malintang','Sorikmalintang','7','N','','134','','','','','2009-05-01 00:00:00'),('1599','060101=A','261800','Pulau Weh','','7','N','','134','','','','','2009-05-01 00:00:00'),('1600','060104=A','261809','Geureudong','','7','N','','134','','','','','2009-05-01 00:00:00'),('1601','060106=A','261810','Kembar','','7','N','','134','','','','','2009-05-01 00:00:00'),('1602','060110=B','261815','Helatoba-Tarutung','','7','N','','134','','','','','2009-05-01 00:00:00'),('1603','0603-03=','0','Kiaraberes-Gagak','','7','N','','134','','','','','2009-05-01 00:00:00'),('1604','060312=A','263805','Kamojang, Kawah','','7','N','','134','','','','','2009-05-01 00:00:00'),('1605','0604-19=','0','Lewotobi Perempuan','','8','N','','134','','','','','2009-05-01 00:00:00'),('1606','060421=A','264800','Ilikedeka','','8','N','','134','','','','','2009-05-01 00:00:00');
INSERT INTO vd_inf(vd_inf_id,vd_id,vd_inf_cavw,vd_inf_status,vd_inf_desc,vd_inf_slat,vd_inf_slon,vd_inf_selev,vd_inf_type,vd_inf_evol,vd_inf_numcald,vd_inf_lcald_dia,vd_inf_ycald_lat,vd_inf_ycald_lon,vd_inf_stime,vd_inf_stime_unc,vd_inf_etime,vd_inf_etime_unc,cc_id,vd_inf_loaddate,vd_inf_pubdate,cc_id_load) VALUES ('377','407','0601-02=','Historical','Seulawah Agam at the NW tip of Sumatra is an extensively forested volcano of Pleistocene-Holocene age constructed within the large Pleistocene Lam Teuba caldera.  A smaller 8 x 6 km caldera lies within Lam Teuba caldera.  The summit contains a forested, 400-m-wide crater.  The active van Heutsz crater, located at 650 m on the NNE flank of Suelawah Agam, is one of several areas containing active fumarole fields.  Sapper (1927) and the Catalog of Active Volcanoes of the World (CAVW) reported an explosive eruption in the early 16th century, and the CAVW also listed an eruption from the van Heutsz crater in 1839.  Rock et al. (1982) found no evidence for historical eruptions.  However the Volcanological Survey of Indonesia noted that although no historical eruptions have occurred from the main cone, the reported NNE-flank explosive activity may have been hydrothermal and not have involved new magmatic activity.','5.447999954','95.65799713','1810','Stratovolcano','Indonesia','Sumatra','Northwestern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('378','408','0601-03=','Historical','Peuet Sague is a large volcanic complex that rises to 2801 m in NW Sumatra.  The volcano, whose name means ""square,"" contains four summit peaks, with the youngest lava dome being located to the north or NW.  This extremely isolated volcano lies several days journey on foot from the nearest village and is infrequently visited.  The first recorded historical eruption took place from 1918-21, when explosive activity and pyroclastic flows accompanied summit lava-dome growth.  The historically active crater is located SE of the Gunung Tutung lava dome and has typically produced small-to-moderate explosive eruptions. ','4.914000034','96.32900238','2801','Complex volcano','Indonesia','Sumatra','Northwestern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('379','409','0601-05=','Historical','The conical Bur ni Telong volcano was constructed at the southern base of the massive Bur ni Geureudong volcanic complex, one of the largest in northern Sumatra.  The historically active Bur ni Telong volcano lies 4.5 km from the summit of Geureudong and grew to a height of 2624 m.  The summit crater of Bur ni Telong has migrated to the ESE, leaving arcuate crater rims.  Lava flows are exposed on the southern flank.  Explosive eruptions were recorded during the 19th and 20th centuries.    ','4.769000053','96.82099915','2617','Stratovolcano','Indonesia','Sumatra','Northwestern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('380','410','0601-07=','Historical','Sibayak and Pinto are twin volcanoes within a compound caldera open to the north.  The 900-m-wide crater of Sibayak is partially filled on the north by Pinto volcano.  A lava flow traveled through a gap in the western crater wall from the summit lava dome of Sibayak.  Area residents record legends of eruptions.  Neumann van Padang (1983) cited a report by Hoekstra of ash clouds that were emitted from the volcano in 1881.    ','3.230000019','98.51999664','2212','Stratovolcano','Indonesia','Sumatra','Northwestern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('381','411','0601-08=','Historical','Gunung Sinabung is a Pleistocene-to-Holocene stratovolcano with many lava flows on its flanks.  The migration of summit vents along a N-S line gives the summit crater complex an elongated form.  The youngest crater of  this conical, 2460-m-high andesitic-to-dacitic volcano is at the southern end of the four overlapping summit craters.  An unconfirmed eruption was noted in 1881, and solfataric activity was seen at the summit and upper flanks of Sinabung in 1912.  No confirmed historical eruptions were recorded prior to explosive eruptions during August-September 2010 that produced ash plumes to 5 km above the summit.     ','3.170000076','98.39199829','2460','Stratovolcano','Indonesia','Sumatra','Northwestern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('382','412','0601-09=','Holocene','The 35 x 100 km Toba caldera, the Earth's largest Quaternary caldera, was formed during four major Pleistocene ignimbrite-producing eruptions beginning at 1.2 million years ago.  The latest of these produced the Young Toba Tuff (YTT) about 74,000 years ago.  The YTT represents the world's largest known Quaternary eruption, ejecting about 2500-3000 cu km (dense rock equivalent) of ignimbrite and airfall ash from vents at the NW and SE ends of present-day Lake Toba.  Resurgent doming forming the massive Samosir Island and Uluan Peninsula structural blocks postdated eruption of the YTT.  Additional post-YTT eruptions include emplacement of a series of lava domes, growth of the solfatarically active Pusukbukit volcano on the south margin of the caldera, and formation of Tandukbenua volcano at the NW-most rim of the caldera.  Lack of vegetation suggests that this volcano may be only a few hundred years old (Chesner and Rose, 1991).  ','2.579999924','98.83000183','2157','Caldera','Indonesia','Sumatra','Northwestern Sumatra','Dacite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('383','413','0601-101','Holocene?','Imun is a single small dacitic and/or rhyolitic cone south of Lake Toba with a youthful, undissected morphology, and is considered to be of late-Pleistocene or Holocene age (Aldiss et al., 1983).      ','2.157999992','98.93000031','1505','Unknown','Indonesia','Sumatra','Northern Sumatra','Dacite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('384','414','0601-111','Holocene?','Lubukraya is a well-defined andesitic stratovolcano of latest Pleistocene to possibly Holocene age with a broad crater breached to the south and a prominent lava dome at the southern foot of the volcano (Aspden et al. 1982).     ','1.478000045','99.20899963','1862','Stratovolcano','Indonesia','Sumatra','Northern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('385','415','0601-11=','Holocene?','Sibualbuali is an eroded Pleistocene stratovolcano with two solfatara fields on the eastern flank.  Rhyolitic-dacitic lava domes erupted from fissure vents along the Toru-Asik fault to the south are late Pleistocene or possibly Holocene in age and are considered part of the Sibualbuali volcanic center (Aspden et al., 1982).     ','1.555999994','99.25499725','1819','Stratovolcano','Indonesia','Sumatra','Northern Sumatra','Dacite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('386','416','0601-12=','Historical','Sorikmarapi is a forested stratovolcano with a 600-m-wide summit crater containing a crater lake and substantial sulfur deposits.  A smaller parasitic crater (Danau Merah) on the upper SE flank also contains a crater lake; these two craters and a series of smaller explosion pits occur along a NW-SE line.   Several solfatara fields are located on the eastern flank.  Phreatic eruptions have occurred from summit and flank vents during the 19th and 20th centuries.    ','0.68599999','99.53900146','2145','Stratovolcano','Indonesia','Sumatra','Northern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('387','417','0601-131','Holocene?','The Sarik volcanic andesitic/basaltic center consists of two young cones with vegetated, but uneroded surfaces.  The andesitic-dacitic Gajah center, 10 km to the SW, consists of a single cone with a rubbly lava flow.  Both centers were considered to be of Pleistocene or Holocene age (Rock et al., 1983).     ','0.079999998','100.1999969','120','Pyroclastic cone','Indonesia','Sumatra','Central Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('388','418','0601-13=','Holocene','Talakmau (also known as Talamau) is a massive compound volcano rising above the western coastal plain of Sumatra.  The andesitic-dacitic volcano is constructed along a NE-SW line, rising to 2912 m, more than 700 m above its twin volcano Pasaman to the SW, which has its own adventive cone, Bukit Nilam, lying 3.4 km to the SW.  Three craters along the same NE-SW trend occur at the summit of Talakmau; the NE-most and highest crater is filled by a lava dome.  Reports of historical eruptions, including one with rumblings and ""smoke"" emission in 1937, are considered doubtful, but eruptive activity has occurred during the Holocene.    ','0.079000004','99.98000336','2919','Complex volcano','Indonesia','Sumatra','Central Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('389','419','0601-14=','Historical','Gunung Marapi, not to be confused with the better-known Merapi volcano on Java, is Sumatra's most active volcano.  Marapi is a massive complex stratovolcano that rises 2000 m above the Bukittinggi plain in Sumatra's Padang Highlands.  A broad summit contains multiple partially overlapping summit craters constructed within the small 1.4-km-wide Bancah caldera.  The summit craters are located along an ENE-WSW line, with volcanism migrating to the west.  More than 50 eruptions, typically consisting of small-to-moderate explosive activity, have been recorded since the end of the 18th century; no lava flows outside the summit craters have been reported in historical time.   ','-0.381000012','100.4729996','2891','Complex volcano','Indonesia','Sumatra','Central Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('390','420','0601-15=','Historical','Tandikat and its twin volcano to the NNE, Singgalang, lie across the Bukittinggi plain from Marapi volcano.  Volcanic activity has migrated to the SSW from Singgalang and only Tandikat has had historical activity.  The summit of Tandikat has a partially eroded 1.2-km-wide crater containing a large central cone capped by a 360-m-wide crater with a small crater lake.  The only three reported historical eruptions, in the late 19th and early 20th centuries, produced only mild explosive activity.    ','-0.432999998','100.3170013','2438','Stratovolcano','Indonesia','Sumatra','Central Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('391','421','0601-16=','Historical','Talang, which forms a twin volcano with the extinct Pasar Arbaa volcano, lies ESE of the major city of Padang and rises NW of Dibawah Lake.  Talang has two crater lakes on its flanks; the largest of these is 1 x 2 km wide Danau Talang.  Most historical eruptions have not occurred from the summit of the volcano, which lacks a crater.  Historical eruptions from Gunung Talang volcano have mostly involved small-to-moderate explosive activity first documented in the 19th century that originated from a series of small craters in a valley on the upper NE flank.     ','-0.977999985','100.6790009','2597','Stratovolcano','Indonesia','Sumatra','Central Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('392','422','0601-171','Fumarolic','Kunyit volcano lies about 10 km south of Lake Kerinci, well to the north of its location listed in Neumann van Padang (1951).    The summit of the dacitic, 2151-m-high Kunyit volcano contains two craters open to the south, the uppermost of which has a small crater lake.  The age of the latest eruptive activity from Kunyit is not known, although fumarolic activity occurs at the youngest crater on the northern side of the summit area.     ','-2.273999929','101.4830017','2151','Stratovolcano','Indonesia','Sumatra','Central Sumatra','Dacite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('393','423','0601-172','Holocene','Hutapanjang stratovolcano, located to the NW of Sumbing volcano,  was classified as active by Rock et al. (1982) and Posavec et al. (1973), with no additional information.  Little is known of this central Sumatran volcano.     ','-2.329999924','101.5999985','2021','Stratovolcano','Indonesia','Sumatra','Central Sumatra','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('394','424','0601-17=','Historical','The 3800-m-high Gunung Kerinci in central Sumatra forms Indonesia's highest volcano and is one of the most active in Sumatra.  Kerinci is capped by an unvegetated young summit cone that was constructed NE of an older crater remnant.  The volcano contains a deep 600-m-wide summit crater often partially filled by a small crater lake that lies on the NE crater floor, opposite the SW-rim summit of Kerinci.  The massive 13 x 25 km wide volcano towers 2400-3300 m above surrounding plains and is elongated in a N-S direction.  The frequently active Gunung Kerinci has been the source of numerous moderate explosive eruptions since its first recorded eruption in 1838.','-1.697000027','101.2639999','3800','Stratovolcano','Indonesia','Sumatra','Central Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('395','425','0601-18=','Historical','Smaller than its prominent namesake on Java, Sumatra's Sumbing volcano has a complicated summit region containing several crater remnants and a 180-m-long crater lake.  Its only two known historical eruptions, in 1909 and 1921, produced moderate explosions.  Hot springs occur at the SW foot of the volcano.     ','-2.414000034','101.7279968','2507','Stratovolcano','Indonesia','Sumatra','Central Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('396','426','0601-191','Holocene','Pendan is a little-known volcano in central Sumatra that was listed as an active volcanic center by Rock et al. (1982) and Posavec et al. (1973), with no additional information.      ','-2.819999933','102.0199966','120','Unknown','Indonesia','Sumatra','Central Sumatra','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('397','427','0601-20=','Fumarolic','The compound Belerang-Beriti volcano rises above the Semalako Plain in SW Sumatra, forming a NW-SE-trending massif that contains a 1.2-km-wide crater breached to the NE.  The age of its latest eruptions is not known, although fumaroles occur in the crater walls.     ','-2.819999933','102.1800003','1958','Compound volcano','Indonesia','Sumatra','Central Sumatra','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('398','428','0601-21=','Fumarolic','Located in a sparsely populated region of Sumatra, Bukit Daun forms a twin volcano with Gedang volcano, which is truncated by a 3-km-wide probable caldera.  The 600-m-wide summit crater of Bukit Daun contains a crater lake; a smaller crater lake is found at Tologo Kecil on the SSW flank.  No historical eruptions are known from Bukit Daun, although active fumaroles occur in the SSW flank crater.     ','-3.380000114','102.3700027','2467','Stratovolcano','Indonesia','Sumatra','Southeastern Sumatra','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('399','429','0601-22=','Historical','Kaba, a twin volcano with Mount Hitam, has an elongated summit crater complex dominated by three large historically active craters trending ENE from the summit to the upper NE flank.  The SW-most crater of 1952-m-high Gunung Kaba, Kawah Lama, is the largest.  Most historical eruptions have affected only the summit region of the volcano.  They mostly originated from the central summit craters, although the upper-NE flank crater Kawah Vogelsang also produced explosions during the 19th and 20th centuries.     ','-3.519999981','102.6200027','1952','Stratovolcano','Indonesia','Sumatra','Southeastern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('400','430','0601-231','Fumarolic','Patah is a heavily forested, dissected Quaternary volcano SE of Dempo volcano.  The age of its latest eruptions is not known, although on May 1, 1989, a possible new crater with active fumaroles was observed by a cargo aircraft pilot in a heavily forested area about 6 km SE of the summit of Gunung Patah, near Bukit Baturigis (about 4 deg 18 min S, 103 deg 19 min E).  The exact location of the 150-m-wide crater, date of its formation, and its geologic relationship to nearby Patah volcano are uncertain.   Another vent containing a crater lake is located 1 km to the south.    ','-4.269999981','103.3000031','2817','Unknown','Indonesia','Sumatra','Southeastern Sumatra','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('401','431','0601-23=','Historical','Dempo is a prominent 3173-m-high stratovolcano that rises above the Pasumah Plain of SE Sumatra.  The andesitic Dempo volcanic complex has two main peaks, Gunung Dempo and Gunung Marapi, constructed near the SE rim of a 3 x 5 km caldera breached to the north. The one called Dempo is slightly lower, with an elevation of 3049 m and lies at the SE end of the summit complex. The taller Marapi cone, with a summit elevation 3173 m, was constructed within a crater cutting the older Gunung Dempo edifice.  Remnants of 7 craters are found at or near the summit of the complex, with volcanism migrating to the WNW with time.  The large, 800 x 1100 m wide historically active summit crater cuts the NW side of Gunung Marapi (not to be confused with Marapi volcano 500 km to the NW in Sumatra) and contains a 400-m-wide lake located at the far NW end of the crater complex.  Historical eruptions have been restricted to small-to-moderate explosive activity that produced ashfall near the volcano.      ','-4.03000021','103.1299973','3173','Stratovolcano','Indonesia','Sumatra','Southeastern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('402','432','0601-24=','Fumarolic','Bukit Lumut Balai is a heavily eroded volcano consisting of three eruption centers, two on Bukit Lumut and one on the NE side of Bukit Balai, 5 km to the east.  Large lava flows occur on the north side of Bukit Balai.  The age of the latest eruption of the volcano is not known, but active fumarole fields are found in two crescentic basins that open to the north on Bukit Lumut.     ','-4.21999979','103.6200027','2055','Stratovolcano','Indonesia','Sumatra','Southeastern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('403','433','0601-251','Holocene?','Ranau is an 8 x 13 km Pleistocene caldera partially filled by the crescent-shaped Lake Ranau.  The caldera lies along the Great Sumatran Fault that extends the length of Sumatra.  Incremental formation of the caldera culminated in the eruption of the voluminous Ranau Tuff about 0.55 million years ago.  A morphologically young post-caldera stratovolcano, Gunung Semuning, was constructed within the SE side of the caldera to a height of more than 1600 m above the caldera lake surface.  The volcano has not been mapped in sufficient detail to determine the age of its latest eruptions, although fish kills and sulfur smells in the late 19th and early 20th centuries may be related to sublacustral eruptions.    ','-4.829999924','103.9199982','1881','Caldera','Indonesia','Sumatra','Southeastern Sumatra','Dacite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('404','434','0601-25=','Historical','Gunung Besar is a 1899-m-high volcano in SE Sumatra with a minor sulfur deposit in its crater.  A major solfatara field, Marga Bayur, is located along its north and NW flanks along the Semangko fault system.  A minor phreatic eruption occurred in 1940 from Gemurah Ilahan, one of four solfatara fields of the Marga Bayur field.     ','-4.429999828','103.6699982','1899','Stratovolcano','Indonesia','Sumatra','Southeastern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('405','435','0601-26=','Fumarolic','Sekincau volcano was constructed near the southern rim of the small NW-SE-trending double Belirang and Balak calderas, 2 and 2.5 km wide, respectively.  The 300-m-wide crater of Sekincau is open to the south.  The age of the latest eruptive activity is not known, although fumarolic activity occurs on the caldera floor and on the eastern and SE outer flanks of Balak caldera.     ','-5.119999886','104.3199997','1719','Caldera','Indonesia','Sumatra','Southeastern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('406','436','0601-27=','Historical','The 8 x 16 km Suoh (or Suwoh) depression appears to have a dominantly tectonic origin, but contains a smaller complex of overlapping calderas oriented NNE-SSW.  Historically active maars and silicic domes lie along the margins of the depression, which lies along the Great Sumatran Fault that extends the length of the island.  Numerous hot springs occur along faults within the depression, which contains the Pematang Bata fumarole field.  Large phreatic explosions (0.2 cu km tephra) occurred at the time of a major tectonic earthquake in 1933.  Very minor hydrothermal explosions produced two 5-m-wide craters at the time of a February 1994 earthquake.    ','-5.25','104.2699966','1000','Caldera','Indonesia','Sumatra','Southeastern Sumatra','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('407','437','0601-28=','Fumarolic','Hulubelu is an elliptical, 4-km-long caldera or volcano-tectonic depression in SE Sumatra.  The caldera floor, about 700 m above sea level, is surrounded by steep walls.  Post-caldera volcanism formed central cones and basaltic and andesitic flank volcanoes.  The age of its latest eruptions is not known, although solfataric areas, mud volcanoes, and hot springs occur at several locations.  Thermal areas are aligned NE of and parallel to the Great Sumatran Fault, which runs the entire length of the island of Sumatra.     ','-5.349999905','104.5999985','1040','Caldera','Indonesia','Sumatra','Southeastern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('408','438','0601-29=','Fumarolic','Rajabasa is a prominent, isolated volcano along the Sunda Strait at the SE-most tip of Sumatra.  The low, 1281-m-high conical volcano has a well-preserved 500 x 700 m summit crater with a swampy floor.  The age of its most recent eruptions is not known, although fumarolic activity occurs on the foot and flanks of the volcano.  Increased activity was reported in April 1863 and May 1892.     ','-5.78000021','105.625','1281','Stratovolcano','Indonesia','Sumatra','Southeastern Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('409','439','0602-00=','Historical','The renowned volcano Krakatau (frequently misstated as Krakatoa) lies in the Sunda Strait between Java and Sumatra.  Collapse of the ancestral Krakatau edifice, perhaps in 416 AD, formed a 7-km-wide caldera.  Remnants of this ancestral volcano are preserved in Verlaten and Lang Islands; subsequently Rakata, Danan and Perbuwatan volcanoes were formed, coalescing to create the pre-1883 Krakatau Island.  Caldera collapse during the catastrophic 1883 eruption destroyed Danan and Perbuwatan volcanoes, and left only a remnant of Rakata volcano.  This eruption, the 2nd largest in Indonesia during historical time, caused more than 36,000 fatalities, most as a result of devastating tsunamis that swept the adjacent coastlines of Sumatra and Java.  Pyroclastic surges traveled 40 km across the Sunda Strait and reached the Sumatra coast.  After a quiescence of less than a half century, the post-collapse cone of Anak Krakatau (Child of Krakatau) was constructed within the 1883 caldera at a point between the former cones of Danan and Perbuwatan.  Anak Krakatau has been the site of frequent eruptions since 1927.  ','-6.102000237','105.4229965','813','Caldera','Indonesia','Krakatau','Rakata, Verlaten Island, Lang ','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('410','440','0603-01=','Holocene','Pulosari volcano at the western end of Java lies south of the 15-km-wide Pleistocene Danau caldera.  The summit of Pulosari stratovolcano contains a nearly 300-m-deep crater with active solfataras on its wall.  The 1346-m-high basaltic-to-andesitic Pulosari volcano lies across a low saddle from the higher Karang volcano, which was constructed on the SE rim of Danau caldera.','-6.342000008','105.9749985','1346','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('411','441','0603-02=','Holocene?','Gunung Karang volcano in westernmost Java was constructed SE of the 15-km-wide Pleistocene Danau caldera.  Two craters, Kawah Welirang and Kawah Haji, display fumarolic activity and are found on the eastern flanks of 1778-m-high Karang volcano, which may be of Holocene age (Bronto 1995, pers. comm.).  The forested andesitic and basaltic volcano is the highest of a group of stratovolcanoes in the Danau caldera area and lies across a low saddle from Pulosari volcano.     ','-6.269999981','106.0419998','1778','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('412','442','0603-04=','Historical','The Perbakti-Gagak volcanic complex, also known as Kiaraberes-Gagak, is a cluster of deeply eroded stratovolcanoes situated immediately SW of Salak volcano.  The 1699-m-high summit ridge of Gunung Perbakti is elongated in a NW-SE direction, and Gunung Endut volcano rises to 1474 m above a saddle SW of Perbakti.  Gunung Gagak lies to the NW; it is capped by pumice and obsidian, and obsidian lava flows extend to the north and NE.  Quaternary rhyolitic lava domes form a NNE-trending chain at the eastern side of the complex.  Two 2-km-wide depressions on the northern and southern sides of Perbakti form the headwaters of the Kaluwung Herang and Pamatutan rivers, respectively.   The volcanic complex is marked by vigorous geothermal activity.  Fumaroles, mud pots and hot springs are located on the south and SE flanks of Perbakti and at the Kiaraberes area, which includes the commercial geothermal field of Awibengkok.  Mild phreatic eruptions took place during the Holocene into historical time from flank fumarolic fields.','-6.75','106.6999969','1699','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('413','443','0603-05=','Historical','Salak volcano was constructed at the NE end of an eroded volcanic range.  Satellitic cones occur on the SW flank and at the northern foot of the forested volcano.  Two large breached craters truncate the summit of Gunung Salak.  One crater is breached to the NE and the westernmost crater was the source of a debris-avalanche deposit that extends 10 km WNW of the summit.  Historical eruptions from Gunung Salak have been restricted to phreatic explosions from craters in a prominent solfataric area at 1400 m on the western flank.  Salak volcano has been the site of extensive geothermal exploration.     ','-6.71999979','106.7300034','2211','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('414','444','0603-06=','Historical','Gede volcano is one of the most prominent in western Java, forming a twin volcano with Pangrango volcano to the NW.  The major cities of Cianjur, Sukabumi, and Bogor are situated below the volcanic complex to the east, south, and NW, respectively.  Gunung Pangrango, constructed over the NE rim of a 3 x 5 km caldera, forms the 3019 m high point of the complex.  Many lava flows are visible on the flanks of the younger Gunung Gede, including some that may have been erupted in historical time.  The steep-walled summit crater has migrated about 1 km to the NNW over time.  Two large debris-avalanche deposits on its flanks, one of which underlies the city of Cianjur, record previous large-scale collapses of Gede volcano.  Historical activity, recorded since the 16th century, typically consists of small explosive eruptions of short duration.   ','-6.78000021','106.9800034','2958','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('415','445','0603-07=','Holocene','The forested twin volcano Gunung Patuha rises SW of the plain of Bandung.  The andesitic volcano contains two summit craters 600 m apart along a NW-SE line.  The NW-most and highest summit crater is dry, but the SE crater, Kawah Putih, contains a shallow greenish-white crater lake.  Kawah Putih is mined for sulfur.  A large debris-avalanche deposit produced by collapse of the volcano extends to the NE.  The volcano was formed during the late Pleistocene, but has a youthful morphology.  No historical eruptions are known from Patuha.     ','-7.159999847','107.4000015','2434','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('416','446','0603-081','Holocene?','The forested Gunung Malabar stratovolcano, located immediately south of the city of Bandung, is of possible Holocene age (Bronto 1995, pers. comm.).  The broad, 2343-m-high basaltic-andesite Gunung Malabar rises north of Wayang-Windu lava dome and west of Kawah Kamojang volcano.      ','-7.130000114','107.6500015','2343','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('417','447','0603-08=','Fumarolic','Wayang-Windu, the site of a geothermal prospect, is a twin-peaked lava dome of Quaternary age about 40 km south of Bandung, immediately west of Kamojang volcano.  Gunung Wayang, with a 750-m-wide crescentic crater open to the west, contains four groups of fumaroles.  Gunung Windu, 1.6 to the SW, has a 350-m-wide crater open to the ESE.  The age of the latest eruptive activity from Wayang-Windu is not known.    ','-7.208000183','107.6299973','2182','Lava dome','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('418','448','0603-09=','Historical','Tangkubanparahu (also known as Tangkuban Perahu) is a broad shield-like stratovolcano overlooking Indonesia's former capital city of Bandung.  The volcano was constructed within the 6 x 8 km Pleistocene Sunda caldera, which formed about 190,000 years ago.  The volcano's low profile is the subject of legends referring to the mountain of the ""upturned boat.""   The rim of Sunda caldera forms a prominent ridge on the western side; elsewhere the caldera rim is largely buried by deposits of Tangkubanparahu volcano.  The dominantly small phreatic historical eruptions recorded since the 19th century have originated from several nested craters within an elliptical 1 x 1.5 km summit depression.    ','-6.769999981','107.5999985','2084','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('419','449','0603-10=','Historical','Papandayan is a complex stratovolcano with four large summit craters, the youngest of which was breached to the NE by collapse during a brief eruption in 1772 and contains active fumarole fields.  The broad 1.1-km-wide, flat-floored Alun-Alun crater truncates the summit of Papandayan, and Gunung Puntang to the north gives the volcano a twin-peaked appearance.  Several episodes of collapse have given the volcano an irregular profile and produced debris avalanches that have impacted lowland areas beyond the volcano.  A sulfur-encrusted fumarole field occupies historically active Kawah Mas (""Golden Crater"").  After its first historical eruption in 1772, in which collapse of the NE flank produced a catastrophic debris avalanche that destroyed 40 villages and killed nearly 3000 persons, only small phreatic eruptions had occurred prior to an explosive eruption that began in November 2002.    ','-7.320000172','107.7300034','2665','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('420','450','0603-11=','Holocene','The Quaternary Gunung Kendang volcano (also spelled Kendeng) is located immediately north of Papandayan volcano.  Kendang contains four fumarole fields, the most prominent of which is Kawah Manuk, located in a broad 2.75-km-wide crater-like depression.  Thermal activity consists of fumaroles with sulfur sublimation, mud pots, and hot water pools with occasional mild water ejections.  The Darajat geothermal field is located on the eastern flank of Gunung Kendang.  The geothermal field is located along the Kendang fault, which extends NE to the Kawah Kamojang geothermal field.  The latest eruptions of Kendang volcano produced the very young Kiamis rhyolitic lava dome and obsidian lava flows.  Gunung Kiamis was labeled as Recent on a map of Whittome and Salveson (1990) and is located 2 km NE of the Darajat geothermal field.   ','-7.230000019','107.7200012','2608','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('421','451','0603-131','Holocene','Gunung Tampomas, the northernmost young volcano in western Java, is a small andesitic stratovolcano overlooking the northern coastal plain about halfway between Tangkubanparahu and Cereme volcanoes.  Youthful-looking lava flows are found on the flanks of Tampomas volcano.','-6.769999981','107.9499969','1684','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('422','452','0603-13=','Historical','Guntur is a complex of several overlapping stratovolcanoes about 10 km NW of the city of Garut in western Java.  Young lava flows, the most recent of which was erupted in 1840, are visible on the flanks of the erosionally unmodified Gunung Guntur, which rises about 1550 m above the plain of Garut.  Guntur is one of a group of younger cones constructed to the SW of an older eroded group of volcanoes at the NE end of the complex.  Guntur, whose name means ""thunder,"" is the only historically active center, with eruptions having been recorded since the late-17th century.  Although Guntur produced frequent explosive eruptions in the 19th century, making it one of the most active volcanoes of western Java, it has not erupted since.    ','-7.143000126','107.8399963','2249','Complex volcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('423','453','0603-14=','Historical','The forested slopes of 2168-m-high Galunggung volcano in western Java are cut by a large horseshoe-shaped caldera breached to the SE that has served to channel the products of recent eruptions in that direction.  The ""Ten Thousand Hills of Tasikmalaya"" dotting the plain below the volcano are debris-avalanche hummocks from the collapse that formed the breached caldera about 4200 years ago.  Although historical eruptions, restricted to the central vent near the caldera headwall, have been infrequent, they have caused much devastation.  The first historical eruption in 1822 produced pyroclastic flows and lahars that killed over 4000 persons.  More recently, a strong explosive eruption during 1982-1983 caused severe economic disruption to populated areas near the volcano.   ','-7.25','108.0579987','2168','Stratovolcano','Indonesia','Java','Western Java','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('424','454','0603-15=','Fumarolic','Gunung Talagabodas stratovolcano lies immediately north of the more well-known Galunggung volcano.  Talagabodas, also spelled Telagabodas, is one of the older Quaternary volcanoes in an arcuate N-S-trending volcano group east of the city of Garut and is built up of andesitic lavas and pyroclastics.  Younger pyroclastics from Gunung Putri-Eweranda overlap the Talagabodas products in the north.  The crater of Talagabodas has shifted 1.3 km north from the summit crater of Canar and contains a large sulfur-saturated lake.  Fumaroles, mud pots, and a warm spring are found around the lake, which has an elevated temperature.  The age of the most recent eruption from Talagabodas is not known.  Changes in lake color occurred in 1913 and 1921, and expanded solfataric activity was reported in 1927.  Suffocating gases have frequently killed animals that have wandered into the Pajagalan valley on the NE flank and the Kawah Saat geothermal area south of the crater lake.','-7.208000183','108.0699997','2201','Stratovolcano','Indonesia','Java','Western Java','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('425','455','0603-16=','Fumarolic','Kawah Karaha is a fumarole field in an area of eroded Quaternary volcanoes at the northern end of a chain of volcanoes extending north from Galunggung.  The Kawah Karaha fumarole field covers an area of 250 x 80 m and contains a sulfur deposit.  The age of the most recent eruption of Kawah Karaha is not known, although the Catalog of Active Volcanoes of the World (Neumann van Padang, 1951) reported an uncertain phreatic eruption in May, 1861.       ','-7.119999886','108.0800018','1155','Hydrothermal field','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('426','456','0603-17=','Historical','The symmetrical stratovolcano Cereme, also known as Ciremai, is located closer to the northern coast than other central Java volcanoes.  A steep-sided double crater elongated in an E-W direction caps 3078-m-high Gunung Cereme, which was constructed on the northern rim of the 4.5 x 5 km Geger Halang caldera.  A large landslide deposit to the north may be associated with the origin of the caldera, although collapse may rather be due to a voluminous explosive eruption (Newhall and Dzurisin, 1988).  Eruptions, relatively infrequent in historical time, have included explosive activity and lahars, primarily from the summit crater.    ','-6.892000198','108.4000015','3078','Stratovolcano','Indonesia','Java','Western Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('427','457','0603-18=','Historical','Slamet, Java's second highest volcano at 3428 m and one of its most active, has a cluster of about three dozen cinder cones on its lower SE-NE flanks and a single cinder cone on the western flank.  Slamet is composed of two overlapping edifices, an older basaltic-andesite to andesitic volcano on the west and a younger basaltic to basaltic-andesite one on the east.  Gunung Malang II cinder cone on the upper eastern flank on the younger edifice fed a lava flow that extends 6 km to the east.  Four craters occur at the summit of Gunung Slamet, with activity migrating to the SW over time.  Historical eruptions, recorded since the 18th century, have originated from a 150-m-deep, 450-m-wide, steep-walled crater at the western part of the summit and have consisted of explosive eruptions generally lasting a few days to a few weeks.    ','-7.242000103','109.2080002','3428','Stratovolcano','Indonesia','Java','Central Java','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('428','458','0603-20=','Historical','The Dieng plateau in the highlands of central Java is renowned both for the variety of its volcanic scenery and as a sacred area housing Java's oldest Hindu temples, dating back to the 9th century AD.  The Dieng volcanic complex consists of two or more stratovolcanoes and more than 20 small craters and cones of Pleistocene-to-Holocene age over a 6 x 14 km area.  Prahu stratovolcano was truncated by a large Pleistocene caldera, which was subsequently filled by a series of dissected to youthful cones, lava domes, and craters, many containing lakes.  Lava flows cover much of the plateau, but have not occurred in historical time, when activity has been restricted to minor phreatic eruptions.  Toxic volcanic gas emission has caused fatalities and is a hazard at several craters.  The abundant thermal features that dot the plateau and high heat flow make Dieng a major geothermal prospect.      ','-7.199999809','109.9199982','2565','Complex volcano','Indonesia','Java','Central Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('429','459','0603-21=','Historical','Gunung Sundoro, one Java's most symmetrical volcanoes, is separated by a 1400-m-high saddle from Sumbing volcano.  Parasitic craters and cones, the largest of which is Kembang, occur on the NW-to-southern flanks, and all fed lava flows.  A small lava dome occupies the summit crater of the 3136-m-high volcano, and numerous phreatic explosion vents were formed along radial fissure that cut the dome and extend across the crater rim.  Lava flows extend in all directions from the summit crater.  Deposits of a large prehistoric debris avalanche are located below the NE flank of Sundoro.  Pyroclastic-flow deposits dated at 1720 years before present extend as far as 13 km from the summit.  Historical eruptions typically have consisted of mild-to-moderate phreatic explosions, mostly from the summit crater.  Flank vents were also active in 1882 and 1903.    ','-7.300000191','109.9919968','3136','Stratovolcano','Indonesia','Java','Central Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('430','460','0603-22=','Historical','Gunung Sumbing is a prominent 3371-m-high stratovolcano that lies across a 1400-m-high saddle from symmetrical Sundoro volcano in central Java.  Prominent flank cones are located on the north and SE sides of Sumbing, which is somewhat more dissected than Sundoro volcano.  An 800-m-wide horseshoe-shaped summit crater breached to the NE is partially filled by a lava dome that fed a lava flow down to 2400 m altitude.  Emplacement of the dome followed the eruption of extensive pyroclastic flows down the NE flank.  The only report of historical activity at Sumbing volcano, in about 1730 AD, may have produced the small phreatic craters found at the summit.     ','-7.383999825','110.0699997','3371','Stratovolcano','Indonesia','Java','Central Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('431','461','0603-231','Holocene','Telomoyo volcano, also spelled Telemojo, was constructed over the southern flank of the eroded Pleistocene Soropati volcano and is in part of Holocene age (van Bemmelen 1941).  It lies along a NNW-SSE-trending line of volcanoes extending from Ungaran in the north to Merapi in the south.  The eastern flank of Soropati volcano collapsed during the Pleistocene, leaving a U-shaped depression.  Telomoyo subsequently filled much of the southern side of this depression and grew to a height of 600 m above its rim.','-7.369999886','110.4000015','1894','Stratovolcano','Indonesia','Java','Central Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('432','462','0603-23=','Holocene','Gunung Ungaran volcano, south of the northern coastal city of Semarang, lies at the northern end of a transverse chain of Java volcanoes extending NNW from Merapi.  Ungaran was formed in three stages, with growth of the youngest edifice taking place during the late Pleistocene and Holocene.  The youngest Ungaran edifice was constructed south of three large remnant structural blocks of the 2nd Ungaran volcano.  A group of pyroclastic cones was also constructed along the margins of the older volcano.  Ungaran is deeply eroded and no historical eruptions have been reported, but two active fumarole fields are located on the volcano's flanks.     ','-7.179999828','110.3300018','2050','Stratovolcano','Indonesia','Java','Central Java','Trachyandesite/Basaltic trachy-andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('433','463','0603-24=','Historical','Gunung Merbabu is a massive forested volcano that rises to the north above a broad 1500-m-high saddle from the renowned Merapi volcano in central Java.  The volcano is elongated in a NNW-SSE direction, parallel to the trend of the long transverse volcanic chain extending from Merapi to Ungaran volcano.  Three prominent U-shaped radial valleys extend from the 3145-m-high summit of Merbabu toward the NW, NE, and SE, dividing the volcano into three segments.  The most recent magmatic eruptions originated from a NNW-SSE fissure system that cut across the summit and fed the large-volume Kopeng and Kajor lava flows on the northern and southern flanks, respectively.  Moderate explosive eruptions have occurred from the summit crater of Merbabu in historical time.     ','-7.449999809','110.4300003','3145','Stratovolcano','Indonesia','Java','Central Java','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('434','464','0603-251','Holocene','Muria stratovolcano forms the broad Muria Peninsula along the northern coast of central Java and lies well north of the main volcanic chain.  This 1625-m-high volcano occupies much of the peninsula and is flanked by Genuk volcano, an eroded lava-dome complex near the coast at the northern base of Muria.  Muria (also spelled Muriah) is largely Pleistocene in age and displays deeply eroded flanks.  The summit of the high-potassium volcano is cut by several large N-S-trending craters, some containing lava domes.  Numerous flank vents include lava domes, cinder cones, and maars.  The most recent eruptive activity at Muria produced three maars on the SE and NE flanks and a lava flow from a SE-flank vent that entered one of the maars.  Conflicting late-Pleistocene to Holocene age dates for these maars leave uncertainties about their ages, but their youthful morphology in surrounding eroded terrain suggests a probable Holocene age, and they could be as young as several thousand years.','-6.619999886','110.8799973','1625','Stratovolcano','Indonesia','Java','Central Java','Trachybasalt/Tephrite Basanite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('435','465','0603-25=','Historical','Merapi, one of Indonesia's most active volcanoes, lies in one of the world's most densely populated areas and dominates the landscape immediately north of the major city of Yogyakarta.  Merapi is the youngest and southernmost of a volcanic chain extending NNW to Ungaran volcano.  Growth of Old Merapi volcano beginning during the Pleistocene ended with major edifice collapse perhaps about 2000 years ago, leaving a large arcuate scarp cutting the eroded older Batulawang volcano.  Subsequently growth of the steep-sided Young Merapi edifice, its upper part unvegetated due to frequent eruptive activity, began SW of the earlier collapse scarp.  Pyroclastic flows and lahars accompanying growth and collapse of the steep-sided active summit lava dome have devastated cultivated lands on the volcano's western-to-southern flanks and caused many fatalities during historical time.  The volcano is the object of extensive monitoring efforts by the Merapi Volcano Observatory.','-7.541999817','110.4420013','2968','Stratovolcano','Indonesia','Java','Central Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('436','466','0603-26=','Historical','The massive compound stratovolcano Lawu contains an older, deeply eroded volcano on the north separated by a crescentic rift valley from the younger Lawu volcano of Holocene age (van Bemmelen, 1949b).  Parasitic crater lakes and pyroclastic cones are found at the eastern side of the rift.  The younger Lawu volcano contains eroded crater rims; its latest activity, including construction of a lava dome, occurred at the south end.  A fumarolic area is located on the south flank at 2550 m.  The only reported historical eruption from Lawu took place in 1885, when rumblings and light ashfall were reported.  A major eruption reported from Lawu in 1752 was from neighboring Kelut volcano.','-7.625','111.1920013','3265','Stratovolcano','Indonesia','Java','Central Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('437','467','0603-27=','Holocene','Gunung Wilis is a solitary volcanic massif surrounded by low-elevation plains on all but its southern side.  It was formed during three episodes dating back to the mid Pleistocene.  Following destruction of the 2nd edifice, the most recent cone grew during the Holocene.  No confirmed historical eruptions are known from Wilis volcano, although there was a report of an eruption in 1641 AD, the same year as a major eruption of nearby Kelut volcano.  Fumaroles and mud pots occur near Lake Ngebel on the lower western flank of Gunung Wilis.','-7.808000088','111.7580032','2563','Stratovolcano','Indonesia','Java','East-central Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('438','468','0603-281','Holocene','The broad Kawi-Butak volcanic massif lies immediately east of Kelut volcano and south of Arjuno-Welirang volcano.  The 2551-m-high Gunung Kawi was constructed to the NW of 2868-m-high Gunung Butak.  No historical eruptions are known from either volcano, but both are primarily of Holocene age.  ','-7.920000076','112.4499969','2651','Stratovolcano','Indonesia','Java','Eastern Java','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('439','469','0603-28=','Historical','The relatively inconspicuous, 1731-m-high Kelut stratovolcano contains a summit crater lake that has been the source of some of Indonesia's most deadly eruptions.  A cluster of summit lava domes cut by numerous craters has given the summit a very irregular profile.  Satellitic cones and lava domes are also located low on the eastern, western, and SSW flanks.  Eruptive activity has in general migrated in a clockwise direction around the summit vent complex.  More than 30 eruptions have been recorded from Gunung Kelut since 1000 AD.  The ejection of water from the crater lake during Kelut's typically short, but violent eruptions has created pyroclastic flows and lahars that have caused widespread fatalities and destruction.  After more than 5000 persons were killed during an eruption in 1919, an ambitious engineering project sought to drain the crater lake.  This initial effort lowered the lake by more than 50 m, but the 1951 eruption deepened the crater by 70 m, leaving 50 million cubic meters of water after repair of the damaged drainage tunnels.  After more than 200 deaths in the 1966 eruption, a new deeper tunnel was constructed, and the lake's volume before the 1990 eruption was','-7.929999828','112.3079987','1731','Stratovolcano','Indonesia','Java','Eastern Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('440','470','0603-291','Holocene','Gunung Penanggungan, one of Java's most revered mountains, is a small stratovolcano constructed immediately north of the Arjuno-Welirang massif.  Numerous ruins of sanctuaries, monuments, and sacred bathing places dating from 977-1511 AD are found on the northern and western flanks of the volcano.  Lava flows from flank vents descend all sides of the 1653-m-high volcano and pyroclastic-flow deposits form an apron around it.  Penanggungan volcano was mapped as similar in age to Arjuno-Welirang and Semeru volcanoes by van Bemmelen (1937).  Penanggungan was considered to be extinct for at least 1000 years.  Its last eruption may have occurred about 200 AD.      ','-7.619999886','112.6299973','1653','Stratovolcano','Indonesia','Java','Eastern Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('441','471','0603-292','Holocene','A group of nine ash cones, maars, and volcanic plugs of subrecent-to-recent (Holocene) age are found on the Malang Plain, SE and NE of the city of Malang (van Bemmelen, 1937).  Some of these may be partly parasitic to Tengger Caldera, although others have no clear connection to any specific eruption center and are situated on a distinct N-S zone of tectonic weakness.     ','-8.020000458','112.6800003','680','Maar','Indonesia','Java','Eastern Java','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('442','472','0603-29=','Historical','The twin volcanoes of Arjuno and Welirang anchor the SE and NW ends, respectively, of a 6-km-long line of volcanic cones and craters.  The Arjuno-Welirang complex overlies two older volcanoes, Gunung Ringgit to the east and Gunung Linting to the south.  The summit areas of both Arjuno and Welirang volcanoes are unvegetated.  Additional pyroclastic cones are located on the north flank of Gunung Welirang and along an E-W-trending line cutting across the southern side of Gunung Arjuno that extends to the lower SE flank.  Fumarolic areas with sulfur deposition occur at several locations on Gunung Welirang.        ','-7.724999905','112.5800018','3339','Stratovolcano','Indonesia','Java','Eastern Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('443','473','0603-30=','Historical','Semeru, the highest volcano on Java, and one of its most active, lies at the southern end of a volcanic massif extending north to the Tengger caldera.  The steep-sided volcano, also referred to as Mahameru (Great Mountain), rises abruptly to 3676 m above coastal plains to the south.  Gunung Semeru was constructed south of the overlapping Ajek-ajek and Jambangan calderas.  A line of lake-filled maars was constructed along a N-S trend cutting through the summit, and cinder cones and lava domes occupy the eastern and NE flanks.  Summit topography is complicated by the shifting of craters from NW to SE.  Frequent 19th and 20th century eruptions were dominated by small-to-moderate explosions from the summit crater, with occasional lava flows and larger explosive eruptions accompanied by pyroclastic flows that have reached the lower flanks of the volcano.  Semeru has been in almost continuous eruption since 1967.   ','-8.107999802','112.9199982','3676','Stratovolcano','Indonesia','Java','Eastern Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('444','474','0603-31=','Historical','The 16-km-wide Tengger caldera is located at the northern end of a volcanic massif extending from Semeru volcano.  The massive Tengger volcanic complex dates back to about 820,000 years ago and consists of five overlapping stratovolcanoes, each truncated by a caldera.  Lava domes, pyroclastic cones, and a maar occupy the flanks of the massif.  The Ngadisari caldera at the NE end of the complex formed about 150,000 years ago and is now drained through the Sapikerep valley.  The most recent of the Tengger calderas is the 9 x 10 km wide Sandsea caldera at the SW end of the complex, which formed incrementally during the late Pleistocene and early Holocene.  An overlapping cluster of post-caldera cones was constructed on the floor of the Sandsea caldera within the past several thousand years.  The youngest of these is Bromo, one of Java's most active and most frequently visited volcanoes.    ','-7.941999912','112.9499969','2329','Stratovolcano','Indonesia','Java','Eastern Java','Trachyandesite/Basaltic trachy-andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('445','475','0603-321','Holocene?','The small Lurus volcanic complex along the northern coast of eastern Java, north of the Iyang-Argapura massif, produced leucite-bearing rocks followed by later eruptions of andesitic and trachytic composition.  This little known complex was mapped as subrecent-to-recent age by van Bemmelen (1949b).','-7.730000019','113.5800018','539','Complex volcano','Indonesia','Java','Eastern Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('446','476','0603-32=','Historical','Lamongan, a small 1631-m-high stratovolcano located between the massive Tengger and Iyang-Argapura volcanic complexes, is surrounded by numerous maars and cinder cones.  The currently active cone has been constructed 650 m to the SW of Gunung Tarub, the volcano's high point.  As many as 27 maars with diameters from 150 to 700 m, some containing crater lakes, surround the volcano, along with about 60 cinder cones and spatter cones.  Lake-filled maars, including Ranu Pakis, Ranu Klakah, and Ranu Bedali, are located on the eastern and western flanks; dry maars are predominately located on the northern flanks.  None of the Lamongan maars has erupted during historical time, although several of the youthful maars cut drainage channels from Gunung Tarub.  Lamongan was very active from the time of its first historical eruption in 1799 through the end of the 19th century, producing frequent explosive eruptions and lava flows from vents on the western side of the volcano ranging from the summit to about 450 m elevation.  ','-7.979000092','113.3420029','1651','Stratovolcano','Indonesia','Java','Eastern Java','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('447','477','0603-33=','Holocene','The massive Iyang-Argapura volcanic complex dominates the landscape between Raung and Lamongan volcanoes in eastern Java.  Valleys up to 1000 m deep dissect the strongly eroded basal Iyang volcano.  Several Holocene volcanic cones have been constructed at the center of a N-S-trending central rift.  No major eruptions have occurred within at least the last 500 years, although there was an unverified report of an eruption in 1597 AD.  Fumaroles occur in some of the many explosion pits found in the summit crater complex.     ','-7.96999979','113.5699997','3088','Complex volcano','Indonesia','Java','Eastern Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('448','478','0603-34=','Historical','Raung, one of Java's most active volcanoes, is a massive stratovolcano in easternmost Java that was constructed SW of the rim of Ijen caldera.  The 3332-m-high, unvegetated summit of Gunung Raung is truncated by a dramatic steep-walled, 2-km-wide caldera that has been the site of frequent historical eruptions.  A prehistoric collapse of Gunung Gadung on the west flank produced a large debris avalanche that traveled 79 km from the volcano, reaching nearly to the Indian Ocean.  Raung contains several centers constructed along a NE-SW line, with Gunung Suket and Gunung Gadung stratovolcanoes being located to the NE and west, respectively.    ','-8.125','114.0419998','3332','Stratovolcano','Indonesia','Java','Eastern Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('449','479','0603-351','Holocene?','The small 1247-m-high andesitic volcano of Baluran, dwarfed by its neighbor Ijen volcano to the SW, occupies the very NE tip of Java.  Gunung Baluran contains a broad horseshoe-shaped crater breached to the NE.  The volcano lies within a national park and game reserve featuring savannah grasslands and monsoon forests.  Baluran was considered by van Bemmelen (1949b) to be of Holocene age.','-7.849999905','114.3700027','1247','Stratovolcano','Indonesia','Java','Eastern Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('450','480','0603-35=','Historical','The Ijen volcano complex at the eastern end of Java consists of a group of small stratovolcanoes constructed within the large 20-km-wide Ijen (Kendeng) caldera.  The north caldera wall forms a prominent arcuate ridge, but elsewhere the caldera rim is buried by post-caldera volcanoes, including Gunung Merapi stratovolcano, which forms the 2799 m high point of the Ijen complex.  Immediately west of Gunung Merapi is the renowned historically active Kawah Ijen volcano, which contains a nearly 1-km-wide, turquoise-colored, acid crater lake.  Picturesque Kawah Ijen is the world's largest highly acidic lake and is the site of a labor-intensive sulfur mining operation in which sulfur-laden baskets are hand-carried from the crater floor.  Many other post-caldera cones and craters are located within the caldera or along its rim.  The largest concentration of post-caldera cones forms an E-W-trending zone across the southern side of the caldera.  Coffee plantations cover much of the Ijen caldera floor, and tourists are drawn to its waterfalls, hot springs, and dramatic volcanic scenery.   ','-8.057999611','114.2419968','2799','Stratovolcano','Indonesia','Java','Eastern Java','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('451','481','0604-001','Holocene','The 11 x 6 km wide Bratan caldera (also known as Catur or Tjatur caldera or the Buyan-Bratan volcanic complex) in north-central Bali contains three caldera lakes.  Several post-caldera stratovolcanoes straddle its southern rim; the largest post-caldera cone, Batukau, is 10 km to the SW.  The cones are well-formed, but covered with thick soils and vegetation; they are thought to have been inactive for hundreds or thousands of years (Wheller, 1986).  Tapak and Lesong cones are not covered by deposits of the youngest dacitic pumice eruptions of nearby Batur volcano, and are thus <23,000 years old.  The Buyan-Bratan geothermal field within the caldera has been developed to produce electrical power, and hot springs are located in more than a dozen locations.','-8.279999733','115.1299973','2276','Caldera','Indonesia','Lesser Sunda Islands','Bali','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('452','482','0604-01=','Historical','The historically active Batur volcano is located at the center of two concentric calderas NW of Agung volcano.  The outer 10 x 13.5 km wide caldera was formed during eruption of the Bali (or Ubud) Ignimbrite about 29,300 years ago and now contains a caldera lake on its SE side, opposite the satellitic cone of 2152-m-high Gunung Abang, the topographic high of the Batur complex.  The inner 6.4 x 9.4 km wide caldera was formed about 20,150 years ago during eruption of the Gunungkawi Ignimbrite.  The SE wall of the inner caldera lies beneath Lake Batur; Batur cone has been constructed within the inner caldera to a height above the outer caldera rim.  The 1717-m-high Batur stratovolcano has produced vents over much of the inner caldera, but a NE-SW fissure system has localized the Batur I, II, and III craters along the summit ridge.  Historical eruptions have been characterized by mild-to-moderate explosive activity sometimes accompanied by lava emission.  Basaltic lava flows from both summit and flank vents have reached the caldera floor and the shores of Lake Batur in historical time.  ','-8.241999626','115.375','1717','Caldera','Indonesia','Lesser Sunda Islands','Bali','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('453','483','0604-02=','Historical','Symmetrical Agung stratovolcano, Bali's highest and most sacred mountain, towers over the eastern end of the island.  The volcano, whose name means ""Paramount,"" rises above the SE caldera rim of neighboring Batur volcano, and the northern and southern flanks of Agung extend to the coast.  The 3142-m-high summit of Agung contains a steep-walled, 500-m-wide, 200-m-deep crater.  The flank cone Pawon is located low on the SE side of Gunung Agung.  Only a few eruptions dating back to the early 19th century have been recorded from Agung in historical time.  Agung's 1963-64 eruption, one of the world's largest of the 20th century, produced voluminous ashfall and devastating pyroclastic flows and lahars that caused extensive damage and many fatalities.      ','-8.342000008','115.5080032','3142','Stratovolcano','Indonesia','Lesser Sunda Islands','Bali','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('454','484','0604-03=','Historical','Rinjani volcano on the island of Lombok rises to 3726 m, second in height among Indonesian volcanoes only to Sumatra's Kerinci volcano.  Rinjani has a steep-sided conical profile when viewed from the east, but the west side of  the compound volcano is truncated by the 6 x 8.5  km, oval-shaped Segara Anak caldera.  The western half of the caldera contains a  230-m-deep lake whose crescentic form results from growth of the post-caldera cone Barujari at the east end of the caldera.  Historical eruptions at Rinjani dating back to 1847 have been restricted to Barujari cone and consist of moderate explosive activity and occasional lava flows that have entered Segara Anak lake.   ','-8.420000076','116.4700012','3726','Stratovolcano','Indonesia','Lesser Sunda Islands','Lombok','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('455','485','0604-04=','Historical','The massive Tambora stratovolcano forms the entire 60-km-wide Sanggar Peninsula on northern Sumbawa Island.  The largely  trachybasaltic-to-trachyandesitic volcano grew to about 4000 m elevation before forming a caldera more than 43,000 years ago.  Late-Pleistocene lava flows largely filled the early caldera, after which activity changed to dominantly explosive eruptions during the early Holocene.  Tambora was the source of history's largest explosive eruption, in April 1815.  Pyroclastic flows reached the sea on all sides of the peninsula, and heavy tephra fall devastated croplands, causing an estimated 60,000 fatalities.  The eruption of an estimated more than 150 cu km of tephra formed a 6-km-wide, 1250-m-deep caldera and produced global climatic effects.  Minor lava domes and flows have been extruded on the caldera floor at Tambora during the 19th and 20th centuries.  ','-8.25','118','2850','Stratovolcano','Indonesia','Lesser Sunda Islands','Sumbawa','Trachybasalt/Tephrite Basanite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('456','486','0604-05=','Historical','Sangeang Api volcano, one of the most active in the Lesser Sunda Islands, forms a small 13-km-wide island off the NE coast of Sumbawa Island.  Two large trachybasaltic-to-tranchyandesitic volcanic cones, 1949-m-high Doro Api and 1795-m-high Doro Mantoi, were constructed in the center and on the eastern rim, respectively, of an older, largely obscured caldera.  Flank vents occur on the south side of Doro Mantoi and near the northern coast.  Intermittent historical eruptions have been recorded since 1512, most of them during in the 20th century.    ','-8.199999809','119.0699997','1949','Complex volcano','Indonesia','Lesser Sunda Islands','','Trachybasalt/Tephrite Basanite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('457','487','0604-06=','Holocene','Wai Sano is a low, elliptical caldera, 3.5 x 2.5 km wide, at the western end of Flores Island.  Wai Sano contains a large caldera lake whose surface is 260 m below the 903 m high point on the southern caldera rim.  The SE caldera wall truncated the slopes of 1632-m-high Gunung Cerak.  Two solfataras are located at the SE shore of the lake.  No historical eruptions are known from Wai Sano, which was mapped as Holocene in age (Ratman and Yasin, 1978).     ','-8.720000267','120.0199966','903','Caldera','Indonesia','Lesser Sunda Islands','Flores','Dacite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('458','488','0604-071','Historical','A new lava dome, named Anak Ranakah (Child of Ranakah)  was formed in 1987 in an area without previous historical eruptions at the base of the large older lava dome of Gunung Ranakah.  An arcuate group of lava domes extending westward from Gunung Ranakah occurs on the outer flanks of the poorly known Poco Leok caldera on western Flores Island.  Pocok Mandosawa lava dome, at 2350 m the highest point on the island of Flores, lies west of Anak Ranakah.     ','-8.619999886','120.5199966','2350','Lava dome','Indonesia','Lesser Sunda Islands','Western Flores','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('459','489','0604-07=','Fumarolic','Poco Leok volcano in western Flores Island was constructed with an irregular 7-km-wide caldera of uncertain origin.  No pyroclastic-flow deposits are associated with the ""caldera,"" which is poorly known geologically (Casadevall, 1989, pers. comm.).  Poco Leok volcano was constructed within the caldera, culminating in the eruption of an andesite lava within the crater area.  Volcanism is of Quaternary age (van Bemmelen, 1949b), and four fumarole fields are located at elevations of 825-1200 m within the depression.  The Ulumbu geothermal field is located on the flank of Poco Leok at 650 m elevation and includes hot springs, fumaroles, mud pots, and steaming ground.   ','-8.680000305','120.4800034','1675','Stratovolcano','Indonesia','Lesser Sunda Islands','Flores','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('460','490','0604-08=','Radiocarbon','The symmetrical Gunung Inierie volcano in south-central Flores overlooks the Sawu Sea, and at 2245 m is the highest volcano on the island.  A small steep-walled crater is oriented E-W immediately east of the summit of the conical stratovolcano, whose upper slopes are unvegetated.  A somma wall lies west and NW of Inierie (also known as Rokka Peak).  A NNW-SSE-trending chain of volcanoes extends from across a low saddle to the NE of Inierie, including 1400-m-high Wolo Bobo.  These are part of the Pleistocene Bajawa cinder cone complex, which lies north to east of the volcano.  A column of ""smoke"" is sometimes visible from the crater of Inierie, as occurred in June 1911.  The age of the latest eruption of Inierie is not known, although the volcano was mapped as Holocene, and an eruption of Wolo Bobo was radiocarbon dated at about 10,000 years ago (Nasution et al., 2000).  Hot springs are located at the northern flank of the volcano, and additional geothermal areas are located to the east and NE.   ','-8.875','120.9499969','2245','Stratovolcano','Indonesia','Lesser Sunda Islands','Flores','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('461','491','0604-09=','Historical','Inielika is a broad, low volcano in central Flores Island that was constructed within the Lobobutu caldera.  The complex summit of the 1559-m-high volcano contains ten craters, some of which are lake filled, in a 5-sq-km area north of the city of Bajawa.  The largest of these, Wolo Runu and Wolo Lega North, are 750 m wide.  The first historical eruption of Inielika, a phreatic explosion that formed a new crater, did not occur until 1905 and was the volcano's only eruption during the 20th century.  Another eruption took place about a century later, in 2001.  A chain of Pleistocene cinder cones, the Bajawa cinder cone complex, extends southward to Ineri.   ','-8.729999542','120.9800034','1559','Complex volcano','Indonesia','Lesser Sunda Islands','Central Flores','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('462','492','0604-10=','Historical','Ebulobo, also referred to as Amburombu or Keo Peak, is a symmetrical stratovolcano in central Flores Island.  The summit of 2124-m-high Gunung Ebulobo cosists of a flat-topped lava dome.  The 250-m-wide summit crater of the steep-sided volcano is breached on three sides.  The Watu Keli lava flow traveled from the northern breach to 4 km from the summit in 1830, the first of only four recorded historical eruptions of the volcano.     ','-8.819999695','121.1800003','2124','Stratovolcano','Indonesia','Lesser Sunda Islands','Flores','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('463','493','0604-11=','Historical','Gunung Iya is the southernmost of a group of three volcanoes comprising a small peninsula south of the city of Ende on central Flores Island.  The cones to the north, Rooja and Pui, appear to be slightly older than Iya and have not shown historical activity, although Pui has a youthful profile (a reported 1671 eruption of Pui was considered to have originated from Iya volcano).  Iya, whose truncated southern side drops steeply to the sea, has had numerous moderate explosive eruptions during historical time.     ','-8.897000313','121.6449966','637','Stratovolcano','Indonesia','Lesser Sunda Islands','Flores','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('464','494','0604-12=','Fumarolic','The poorly known Sukaria caldera in central Flores Island, NE of Iya volcano, is 8 km in diameter.  A 750-m-high northern caldera wall rises above the village of Sukaria in the center of the caldera.  The southern caldera wall is very irregular.  A small fumarolic area on the western flank contains several vents that eject geyser-like water columns with a smell of hydrogen sulfide.  No historical eruptions are known from the caldera.','-8.791999817','121.7699966','1500','Caldera','Indonesia','Lesser Sunda Islands','Flores','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('465','495','0604-13=','Fumarolic','The Ndete Napu fumarole field, located at 750 m elevation along the Lowomelo river valley in central Flores Island, originated during 1927-29.  In 1932 it contained mudpots and high-pressure water fountains.  The age of volcanism in the Ndete Napu area is not known precisely, but it was included in the Catalog of Active Volcanoes of the World (Neumann van Padang, 1951) based on its thermal activity. ','-8.720000267','121.7799988','750','Hydrothermal field','Indonesia','Lesser Sunda Islands','Flores','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('466','496','0604-14=','Historical','Kelimutu is a small, but well-known Indonesian volcano in central Flores Island with three summit crater lakes of varying colors.  The western lake, Tiwi Ata Mbupu (Lake of Old People) is commonly blue.  Tiwu Nua Muri Kooh Tai (Lake of Young Men and Maidens) and Tiwu Ata Polo (Bewitched, or Enchanted Lake), which share a common crater wall, are commonly green- and red-colored, respectively, although lake colors vary periodically.  Active upwelling, probably fed by subaqueous fumaroles, occurs at the two eastern lakes.  The scenic lakes are a popular tourist destination and have been the source of minor phreatic eruptions in historical time.  The summit of the compound 1639-m-high Kelimutu volcano is elongated 2 km in a WNW-ESE direction; the older cones of Kelido and Kelibara are located respectively 3 km to the north and 2 km to the south.   ','-8.770000458','121.8199997','1639','Complex volcano','Indonesia','Lesser Sunda Islands','Central Flores','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('467','497','0604-15=','Historical','Paluweh volcano, also known as Rokatenda, forms the 8-km-wide island of Paluweh north of the volcanic arc that cuts across Flores Island.  Although the volcano rises about 3000 m above the sea floor, its summit reaches only 875 m above sea level.  The broad irregular summit region contains overlapping craters up to 900 m wide and several lava domes.  Several flank vents occur along a NW-trending fissure.  The largest historical eruption of Paluweh occurred in 1928, when a strong explosive eruption was accompanied by landslide-induced tsunamis and lava dome emplacement.    ','-8.319999695','121.7080002','875','Stratovolcano','Indonesia','Lesser Sunda Islands','Paluweh','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('468','498','0604-16=','Historical','Gunung Egon volcano sits astride the narrow waist of eastern Flores Island.  The barren, sparsely vegetated summit region has a 350-m-wide, 200-m-deep crater that sometimes contains a lake.  Other small crater lakes occur on the flanks of the 1703-m-high volcano, which is also known as Namang.  A lava dome forms the southern 1671-m-high summit.  Solfataric activity occurs on the crater wall and rim and on the upper southern flank.   Reports of historical eruptive activity prior to explosive eruptions beginning in 2004 were inconclusive.  A column of ""smoke"" was often observed above the summit during 1888-1891 and in 1892.  Strong ""smoke"" emission in 1907 reported by Sapper (1917) was considered by the Catalog of Active Volcanoes of the World (Neumann van Padang, 1951) to be an historical eruption, but Kemmerling (1929) noted that this was likely confused with an eruption on the same date and time from Lewotobi Lakilaki volcano.  ','-8.670000076','122.4499969','1703','Stratovolcano','Indonesia','Lesser Sunda Islands','Flores','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('469','499','0604-17=','Fumarolic','The broad Ilimuda volcano, located 6.5 km north of Lewotobi Lakilaki volcano opposite Konga bay in eastern Flores Island, contains a 1-km-wide, 450-m-deep crescentic crater open to the SE.  Satellitic cones, including the Ilibotong lava dome, are located on the lower SE and NE flanks.  No historical eruptions are known from Gunung Ilimuda.  A fumarole is located inside the NE crater rim.      ','-8.477999687','122.6709976','1100','Stratovolcano','Indonesia','Lesser Sunda Islands','Flores','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('470','500','0604-18=','Historical','The Lewotobi ""husband and wife"" twin volcano (also known as Lewetobi) in eastern Flores Island is composed of the Lewotobi Lakilaki and Lewotobi Perempuan stratovolcanoes.  Their summits are less than 2 km apart along a NW-SE line.  The conical 1584-m-high Lewotobi Lakilaki has been frequently active during the 19th and 20th centuries, while the taller and broader 1703-m-high Lewotobi Perempuan has erupted only twice in historical time.  Small lava domes have grown during the 20th century in the crescentic summit craters of both volcanoes, which are open to the north.  A prominent flank cone, Iliwokar, occurs on the east flank of Lewotobi Perampuan.    ','-8.541999817','122.7750015','1703','Stratovolcano','Indonesia','Lesser Sunda Islands','Flores','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('471','501','0604-20=','Historical','Leroboleng volcano, also known as Lereboleng or Lewono, lies at the eastern end of a 4.5-km-long, WSW-ESE-trending chain of three volcanoes straddling a narrow peninsula in NE Flores Island.  The summit of Gunung Leroboleng contains 29 small fissure-controlled craters, two containing lakes.  A small lava dome occupies one of the craters.  Most of the craters originated along three N-S-trending fissures immediately east of the summit of the volcano.  The largest crater, 250-m-wide Ili Gelimun, is located SSE of the summit and fed lava flows from a lower south-flank vent.  Explosive eruptions were reported from Burak crater during the 19th century.      ','-8.357999802','122.8420029','1117','Complex volcano','Indonesia','Lesser Sunda Islands','Flores','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('472','502','0604-22=','Historical','Iliboleng stratovolcano was constructed at the SE end of Adonara Island across a narrow strait from Lomblen Island.  The volcano is capped by multiple, partially overlapping summit craters.  Lava flows modify its profile, and a cone low on the SE flank, Balile, has also produced lava flows.  Historical eruptions, first recorded in 1885,  have consisted of moderate explosive activity, with lava flows accompanying only the 1888 eruption.     ','-8.342000008','123.2580032','1659','Stratovolcano','Indonesia','Lesser Sunda Islands','Adonara','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('473','503','0604-23=','Historical','Anchoring the eastern end of an elongated peninsula that is connected to Lembata (formerly Lomblen) Island by a narrow isthmus and extends northward into the Flores Sea, Lewotolo rises to 1423 m.  Lewotolo is a symmetrical stratovolcano as viewed from the north and east.  A small cone with a 130-m-wide crater constructed at the SE side of a larger crater forms the volcano's high point.  Many lava flows have reached the coastline.  Historical eruptions, recorded since 1660, have consisted of explosive activity from the summit crater.    ','-8.272000313','123.5049973','1423','Stratovolcano','Indonesia','Lesser Sunda Islands','Lembata','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('474','504','0604-24=','Fumarolic','Ililabalekan volcano is situated on a prominent peninsula in SW Lembata (formerly Lomblen) Island.  A satellitic cone was constructed on the SE flank of the steep-sided volcano.  Four craters, one of which contains a lava dome and two small explosion pits, occur at the summit of Mount Labalekan.  No historical eruptions are known from the volcano, although fumaroles are found near its summit. ','-8.550000191','123.3799973','1018','Stratovolcano','Indonesia','Lesser Sunda Islands','Lembata, South Coast','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('475','505','0604-25=','Historical','Constructed on the southern rim of the Lerek caldera, Iliwerung forms a prominent south-facing peninsula on Lembata (formerly Lomblen) Island.  Craters and lava domes have formed along N-S and NW-SE lines on the complex volcano; during historical time vents from the summit to the submarine SE flank have been active.  The Iliwerung summit lava dome was formed during an eruption in 1870.  In 1948 Iligripe lava dome grew on the eastern flank at 120 m altitude.  Beginning in 1973-74, when three ephemeral islands were formed, submarine eruptions began on the lower SE flank at a vent named Hobal; several other eruptions took place from this vent before the end of the century.','-8.529999733','123.5699997','1018','Complex volcano','Indonesia','Lesser Sunda Islands','Lembata','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('476','506','0604-26=','Historical','The small isolated island of Batu Tara in the Flores Sea about 50 km north of Lembata (fomerly Lomblen) Island contains a scarp on the eastern side similar to the Sciara del Fuoco of Italy's Stromboli volcano.  Vegetation covers the flanks of Batu Tara to within 50 m of the 748-m-high summit.  Batu Tara lies north of the main volcanic arc and is noted for its potassic leucite-bearing basanitic and tephritic rocks.  The first historical eruption from Batu Tara, during 1847-52, produced explosions and a lava flow. ','-7.791999817','123.5790024','748','Stratovolcano','Indonesia','Lesser Sunda Islands','Komba','Trachybasalt/Tephrite Basanite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('477','507','0604-27=','Historical','Sirung volcano is located at the NE end of a 14-km-long line of volcanic centers that form a peninsula at the southern end of Pantar Island.  The low, 862-m-high volcano is truncated by a 2-km-wide caldera whose floor often contains one or more small lakes.  Much of the volcano is constructed of basaltic lava flows, and the Gunung Sirung lava dome forms the high point on the caldera's western rim.  A number of phreatic eruptions have occurred from vents within the caldera during the 20th century.  Forested Gunung Topaki, the 1390-m high point of the volcanic chain, lies at the SW end and contains a symmetrical summit crater.','-8.508000374','124.1299973','862','Complex volcano','Indonesia','Lesser Sunda Islands','Pantar','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('478','508','0604-28=','Uncertain','Old sea charts described a reef, presumed to result from a submarine eruption, at a location in the southern Banda Basin where a 1929 survey showed a depth of 3800 m (Catalog of Active Volcanoes of the World).  A 600-m-high submarine ridge at this location is along trend with a ridge extending from the active island volcanoes of Batu Tara and Gunungapi Wetar.  However, the existence of a submarine volcano at this location was considered questionable by Jezek (1978, pers. comm.).  ','-7.53000021','123.9499969','-3800','Submarine volcano','Indonesia','Lesser Sunda Islands','','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('479','509','0605-01=','Uncertain','The Catalog of Active Volcanoes of the World described a submarine volcano named Emperor of China in the western part of the Banda Sea with reported eruptions of somewhat uncertain authenticity sometime before 1893 and in 1927.  The existence of an active submarine volcano at this location, which has a minimum depth of 2850 m, was considered questionable by Jezek (1978, pers. comm.).      ','-6.619999886','124.2200012','-2850','Submarine volcano','Indonesia','Banda Sea','','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('480','510','0605-02=','Uncertain','The Catalog of Active Volcanoes of the World described a submarine volcano with two summits 7 km apart along a NNW-SSE-trending ridge in the western part of the Banda Sea.  Eruptions of somewhat uncertain authenticity were reported to have occurred sometime before 1893, and in 1925 and 1927.  The existence of a submarine volcano at this location was considered questionable by Jezek (1978, pers. comm.).      ','-6.599999905','124.6750031','-2285','Submarine volcano','Indonesia','Banda Sea','','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('481','511','0605-03=','Historical','Gunungapi Wetar volcano forms an isolated island in the Banda Sea north of Wetar Island.  The small circular island reaches only 282 m above the sea surface but is the summit of a massive stratovolcano that towers 5000 m above the sea floor.  The central crater contains a small cone.  Three large landslide scarps, the largest of which forms a prominent embayment on the NE coast, cut the flanks of the volcano.  The youngest lava flow descended the SW flank to the coast.  Explosive eruptions in 1512 and 1699 mark the only known historical activity of Gunungapi Wetar.','-6.642000198','126.6500015','282','Stratovolcano','Indonesia','Banda Sea','Gunung Api','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('482','512','0605-04=','Historical','Wurlali volcano, also known as Damar, is the SW-most historically active volcano in the Banda arc.  The 868-m-high andesitic stratovolcano was constructed at the northern end of a 5-km-wide caldera on the eastern side of Damar Island in the Banda Sea.  Fumarolic activity occurs in the twin summit craters and on the SE flanks, producing exploitable sulfur deposits.  An explosive eruption in 1892 is the only known historical activity.     ','-7.125','128.6750031','868','Stratovolcano','Indonesia','Banda Sea','Damar','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('483','513','0605-05=','Historical','Teon, an elongated island in the southwestern Banda arc, is also known as Serawerna, the name of its active crater.  Another smaller crater is located to the NNE of Serawerna.  Explosive eruptions have been recorded from the andesitic Teon volcano since the 17th century.  The largest historical eruption, in 1660, produced pyroclastic flows and surges and caused damage and fatalities.  ','-6.920000076','129.125','655','Stratovolcano','Indonesia','Banda Sea','Teon','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('484','514','0605-06=','Historical','The 5 x 6 km Nila Island in the Banda Sea is comprised of a low-rimmed caldera whose rim is breached at sea level on the south and east and contains a 781-m-high youthful forested cone.  Phreatic eruptions from the dominantly andesitic Nila, also known as Laworkawra, have occurred from summit vents and flank fissures in historical time.  A 1932 eruption from a fissure that extended from the summit to the SE coast produced heavy ashfall that forced abandonment of Rumadai village.    ','-6.730000019','129.5','781','Stratovolcano','Indonesia','Banda Sea','Nila','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('485','515','0605-07=','Historical','The small 2 x 4 km island of Serua is the emergent summit of a volcano rising 3600 m above the Banda Sea floor.  A truncated central cone surrounded by an old somma wall is capped by 641-m-high Gunung Wuarlapna lava dome.  The andesitic Serua volcano, also known as Legatala, lies near the center of the Banda arc and is one of the most active of the Banda Sea volcanoes, with many eruptions recorded since the 17th century.     ','-6.300000191','130','641','Stratovolcano','Indonesia','Banda Sea','Serua','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('486','516','0605-08=','Fumarolic','The small steep-sided island of Manuk is the easternmost volcano in the arcuate Banda volcanic arc.  The 282-m-high truncated andesitic cone rises 3000 m from the sea floor.  No confirmed historical eruptions are known from this uninhabited island, although there was an uncertain report that a member of the 1874 Challenger Expedition saw smoke rising from the crater of Manuk.  Highly altered fumarolic areas are located within the crater and on its western rim and were once the source of sulfur extraction by Chinese traders.','-5.53000021','130.2920074','282','Stratovolcano','Indonesia','Banda Sea','Manuk','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('487','517','0605-09=','Historical','The small island volcano of Banda Api is the NE-most volcano in the Sunda-Banda arc and has a long period of historical observation because of its key location in the thriving Portuguese and Dutch spice trade.  The basaltic-to-rhyodacitic Banda Api is located in the SW corner of a 7-km-wide mostly submerged caldera that comprises the northernmost of a chain of volcanic islands in the Banda Sea. At least two episodes of caldera formation are thought to have occurred, with the arcuate islands of Lonthor and Neira considered to be remnants of the pre-caldera volcanoes.  Gunung Api forms a conical peak rising to 640 m at the center of the 3-km-wide Banda Api island.  Historical eruptions have been recorded since 1586, mostly consisting of strombolian eruptions from the summit crater, but larger explosive eruptions have occurred and occasional lava flows have reached the coast.   ','-4.525000095','129.8710022','640','Caldera','Indonesia','Banda Sea','Banda Api','Dacite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('488','518','0606-01=','Historical','Colo volcano forms the isolated small island of Una-Una in the middle of the Gulf of Tomini in northern Sulawesi.  The broad, low volcano, whose summit is only 507 m above sea level, contains a 2-km-wide caldera with a small central cone.  Only three eruptions have been recorded in historical time, but two of those caused widespread damage over much of the island.  The last eruption, in 1983, produced pyroclastic flows that swept over most of the island shortly after all residents had been evacuated.    ','-0.170000002','121.6080017','507','Stratovolcano','Indonesia','Sulawesi','Una Una','Trachyandesite/Basaltic trachy-andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('489','519','0606-02=','Historical','The compound Ambang volcano is the westernmost of the active volcanoes on the northern arm of Sulawesi.  The 1795-m-high stratovolcano rises 750 m above lake Danau.  Several craters up to 400 m in diameter and five solfatara fields are located at the summit.  Ambang's only known historical eruption, of unspecified character, took place in the 1840s.     ','0.75','124.4199982','1795','Complex volcano','Indonesia','Sulawesi','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('490','520','0606-03=','Historical','The small Soputan stratovolcano on the southern rim of the Quaternary Tondano caldera on the northern arm of Sulawesi Island is one of Sulawesi's most active volcanoes.  The youthful, largely unvegetated volcano rises to 1784 m and is located SW of Sempu volcano.  It was constructed at the southern end of a SSW-NNE trending line of vents.  During historical time the locus of eruptions has included both the summit crater and Aeseput, a prominent NE-flank vent that formed in 1906 and was the source of intermittent major lava flows until 1924.    ','1.10800004','124.7300034','1784','Stratovolcano','Indonesia','Sulawesi','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('491','521','0606-04=','Fumarolic','The 1549-m-high Sempu stratovolcano was constructed within the 3-km-wide Sempu caldera.  Kawah Masem maar was formed in the SW part of the caldera and contains a crater lake.  No historical eruptions are known from Sempu.  Sulfur has been extracted from fumarolic areas in the maar since 1938. ','1.129999995','124.7580032','1549','Caldera','Indonesia','Sulawesi','','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('492','522','0606-07-','Fumarolic','Tondano is an approximately 20 x 30 km Quaternary caldera in north Sulawesi containing post-caldera pyroclastic cones, obsidian flows, and thermal areas.  Lake Tondano lies against the well-defined eastern caldera rim.  The historically active andesitic-to-basaltic stratovolcanoes Soputan, Sempu, Lokon-Empung and Mahawu (described elsewhere in this compilation) lie astride the poorly defined southern and northern rims of the caldera.  The age of the latest eruptions within the caldera is not known, although thermal areas occur at Batu Kolok and Sarangson, and at the Tampusu cinder cone and Lahendong maar.    ','1.230000019','124.8300018','1202','Caldera','Indonesia','Sulawesi','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('493','523','0606-10=','Historical','The twin volcanoes Lokon and Empung, rising about 800 m above the plain of Tondano, are among the most active volcanoes of Sulawesi.  Lokon, the higher of the two peaks ( whose summits are only 2.2 km apart), has a flat, craterless top.  The morphologically younger Empung volcano has a 400-m-wide, 150-m-deep crater that erupted last in the 18th century, but all subsequent eruptions have originated from Tompaluan, a 150 x 250 m wide double crater situated in the saddle between the two peaks.  Historical eruptions have primarily produced small-to-moderate ash plumes that have occasionally damaged croplands and houses, but lava-dome growth and pyroclastic flows have also occurred.    ','1.35800004','124.7919998','1580','Stratovolcano','Indonesia','Sulawesi','','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('494','524','0606-11=','Historical','The elongated Mahawu volcano immediately east of Lokon-Empung volcano is the northernmost of a series of young volcanoes along a SSW-NNE line near the margin of the Quaternary Tondano caldera.  Mahawu is capped by a 180-m-wide, 140-m-deep crater that sometimes contains a small crater lake, and has two pyroclastic cones on its northern flank.  Less active than its neighbor, Lokon-Empung, Mahawu's historical activity has been restricted to occasional small explosive eruptions recorded since 1789.  In 1994 fumaroles, mudpots, and small geysers were observed along the shores of a greenish-colored crater lake.  ','1.35800004','124.8580017','1324','Stratovolcano','Indonesia','Sulawesi','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('495','525','0606-12=','Fumarolic','Klabat is an isolated symmetrical stratovolcano that rises to 1995 m near the eastern tip of the elongated northern arm of Sulawesi Island.  The volcano lies east of the city of Manado (also spelled Menado) and is the highest in Sulawesi.  Klabat has a shallow lake in its 170 x 250 m summit crater.  No verified historical eruptions have occurred from this volcano, but fumarolic activity has occurred within historical time.  A report of an eruption in 1683 probably was from nearby Tongkoko volcano.     ','1.470000029','125.0299988','1995','Stratovolcano','Indonesia','Sulawesi','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('496','526','0606-13=','Historical','The NE-most volcano on the island of Sulawesi, Tongkoko (also known as Tangkoko) has a summit that is elongated in a NW-SE direction with a large deep crater that in 1801 contained a cone surrounded by lake water.  The slightly higher Dua Saudara stratovolcano is located only 3 km to the SW of Tongkoko, and along with Tongkoko, forms the most prominent features of Gunung Dua Saudara National Park, a noted wildlife preserve.  Eruptions occurred from the summit crater of Tongkoko in the 17th century and in 1801.  The prominent, flat-topped lava dome Batu Angus formed on the east flank of Tongkoko in 1801, and, along with an adjacent east flank vent, has been the source of all subsequent eruptions.    ','1.519999981','125.1999969','1149','Stratovolcano','Indonesia','Sulawesi','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('497','527','0607-01=','Historical','Ruang volcano, not to be confused with the better known Raung volcano on Java, is the southernmost volcano in the Sangihe Island arc, north of Sulawesi Island.  The 4 x 5 km island volcano rises to 725 m across a narrow strait SW of the larger Tagulandang Island.  The summit of Ruang volcano contains a crater partially filled by a lava dome initially emplaced in 1904.  Explosive eruptions recorded since 1808 have often been accompanied by lava dome formation and pyroclastic flows that have damaged inhabited areas.    ','2.299999952','125.3700027','725','Stratovolcano','Indonesia','Sangihe Islands','Ruang','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('498','528','0607-02=','Historical','Karangetang (Api Siau) volcano lies at the northern end of the island of Siau, north of Sulawesi.  The 1784-m-high stratovolcano contains five summit craters along a N-S line.  Karangetang is one of Indonesia's most active volcanoes, with more than 40 eruptions recorded since 1675 and many additional small eruptions that were not documented in the historical record (Catalog of Active Volcanoes of the World: Neumann van Padang, 1951).  Twentieth-century eruptions have included frequent explosive activity sometimes accompanied by pyroclastic flows and lahars.  Lava dome growth has occurred in the summit craters; collapse of lava flow fronts has also produced pyroclastic flows.    ','2.779999971','125.4000015','1784','Stratovolcano','Indonesia','Sangihe Islands','Siau I','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('499','529','0607-03=','Historical','The Banua Wuhu submarine volcano in the Sangihe Islands rises more than 400 m from the sea floor to form a shoal less than 5 m below sea level.  Several ephemeral islands were constructed during the 19th and 20th centuries.   An island 90 m high was formed in 1835, but dwindled to only a few rocks by 1848.  A new island formed in 1889 was 50 m high in 1894.  Five new craters were formed during an eruption that built a new island in 1904.  Another new island that formed in 1919 had disappeared by 1935.    ','3.148000114','125.44','-5','Submarine volcano','Indonesia','Sangihe Islands','Northern Sangihe Islands','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('500','530','0607-04=','Historical','The massive Gunung Awu stratovolcano occupies the northern end of Great Sangihe Island, the largest of the Sangihe arc.  Deep valleys that form passageways for lahars dissect the flanks of the 1320-m-high volcano, which was constructed within a 4.5-km-wide caldera.  Awu is one of Indonesia's deadliest volcanoes; powerful explosive eruptions in 1711, 1812, 1856, 1892, and 1966 produced devastating pyroclastic flows and lahars that caused more than 8000 cumulative fatalities.  Awu contained a summit crater lake that was 1 km wide and 172 m deep in 1922, but was largely ejected during the 1966 eruption.    ','3.670000076','125.5','1320','Stratovolcano','Indonesia','Sangihe Islands','Great Sangihe Island','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('501','531','0607-05=','Uncertain','The Catalog of Active Volcanoes of the World (CAVW) reported a submarine volcano in the Celebes Sea with an eruption in 1922.  The reported ocean depth at this location is 5000 m (CAVW), and Jezek (1978, pers. comm.) considered the existence of this submarine volcano to be questionable.     ','3.970000029','124.1699982','-5000','Submarine volcano','Indonesia','Sangihe Islands','Celebes Sea','Unknown','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('502','532','0608-001','Holocene','Two large cinder cones are located near the shore of Galela Bay NE of Dukono volcano.  Tarakan Lamo and Tarakan Itji (large and small Tarakan) have well-formed summit craters 800 and 500 m in diameter and 160 and 125 m deep, respectively.  The cinder cones lie between Galela Bay and Lake Galela, whose bottom lies below sea level.  Supriatna (1980) mapped Tarakan as a basaltic volcano of Holocene age.      ','1.830000043','127.8300018','318','Pyroclastic cone','Indonesia','Halmahera','','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('503','533','0608-01=','Historical','Reports from this remote volcano in northernmost Halmahera are rare, but Dukono has been one of Indonesia's most active volcanoes.  More-or-less continuous explosive eruptions, sometimes accompanied by lava flows, occurred from 1933 until at least the mid-1990s, when routine observations were curtailed.  During a major eruption in 1550, a lava flow filled in the strait between Halmahera and the north-flank cone of Gunung Mamuya.  Dukono is a complex volcano presenting a broad, low profile with multiple summit peaks and overlapping craters.  Malupang Wariang, 1 km SW of Dukono's summit crater complex, contains a 700 x 570 m crater that has also been active during historical time.     ','1.679999948','127.8799973','1335','Complex volcano','Indonesia','Halmahera','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('504','534','0608-02-','Holocene','Gunung Tobaru, also known as Gunung Lolodai, is located in northern Halmahera WSW of Dukono volcano and NNE of Ibu volcano.  Supriatna (1980) mapped the little known 1035-m-high andesitic volcano as Holocene in age.      ','1.629999995','127.6699982','1035','Unknown','Indonesia','Halmahera','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('505','535','0608-03=','Historical','The truncated summit of Gunung Ibu stratovolcano along the NW coast of Halmahera Island has large nested summit craters.  The inner crater, 1 km wide and 400 m deep, contained several small crater lakes through much of historical time.  The outer crater, 1.2 km wide, is breached on the north side, creating a steep-walled valley.  A large parasitic cone is located ENE of the summit.  A smaller one to the WSW has fed a lava flow down the western flank.  A group of maars is located below the northern and western flanks of the volcano.  Only a few eruptions have been recorded from Ibu in historical time, the first a small explosive eruption from the summit crater in 1911.  An eruption producing a lava dome that eventually covered much of the floor of the inner summit crater began in December 1998.   ','1.488000035','127.6299973','1325','Stratovolcano','Indonesia','Halmahera','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('506','536','0608-04=','Historical','The shifting of eruption centers on Gamkonora, at 1635 m the highest peak of Halmahera, has produced an elongated series of summit craters along a N-S trending rift.  Youthful-looking lava flows originate near the cones of Gunung Alon and Popolojo, south of Gamkonora.  Since its first recorded eruption in the 16th century, Gamkonora has typically produced small-to-moderate explosive eruptions.  Its largest historical eruption, in 1673, was accompanied by tsunamis that inundated villages.    ','1.379999995','127.5299988','1635','Stratovolcano','Indonesia','Halmahera','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('507','537','0608-051','Holocene','The Jailolo volcanic complex forms a peninsula west of Jailolo Bay on the western coast of Halmahera Island.  Jailolo stratovolcano at the center of the complex has youthful lava flows on its eastern flank.  Small calderas are located west and SW of Jailolo.  The westernmost caldera, Idamdehe, truncates an older twin volcano of Jailolo.  Hot springs occur along the NW coast of the caldera.  Kailupa cone forms a small volcanic island off the southern coast of the peninsula.  Hot mudflows were reported from Jailolo volcano shortly prior to 1883, but no eruptions are known during historical time.     ','1.080000043','127.4199982','1130','Stratovolcano','Indonesia','Halmahera','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('508','538','0608-052','Holocene','Hiri, a small 3-km-wide forested island immediately north of Ternate Island, is the northernmost of a chain of volcanic islands off the western coast of Halmahera.  The conical volcano rises to 630 m, but is dominated by its larger and higher neighbor to the south, historically active 1716-m-high Ternate volcano.  Hiri has received less attention than Ternate, but Apandi and Sudana (1980) mapped Hiri as Holocene in age.      ','0.899999976','127.3199997','630','Stratovolcano','Indonesia','Halmahera','','Basalt/Picro-Basalt','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('509','539','0608-05=','Holocene','The twin caldera complex of Todoko-Ranu is part of a large volcanic complex south of Gamkonora.  The 2-km-wide, lava-filled Todoko caldera is south of the 2 x 2.8 km wide nested Ranu calderas and contains a young post-caldera cone, Sahu, on its south flank.  The northern Ranu caldera contains a caldera lake.  Gunung Onu, NW of Ranu caldera, lies at the northern end of the Todoko-Ranu complex.  No historical eruptions have been reported from the complex, mapped as Holocene by Supriatna (1980), but fumaroles are present at Ranu caldera and hot springs on Mt. Sahu.  Youthful-looking lava flows reach the sea from several locations within the complex.   ','1.25','127.4700012','979','Caldera','Indonesia','Halmahera','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('510','540','0608-061','Holocene','The Tidore volcanic complex consists of two dramatically different volcanic structures.  The beautifully conical 1730-m-high Kiematabu peak on the south end of Tidore Island is the highest volcano of the North Maluku island chain west of Halmahera.  The broad, lower Sabale volcano on the north side of the island is a caldera containing two cones.  Maitara Island, 1 km off the NW coast, forms another volcanic construct.  Tidore was mapped as Holocene by Apandi and Sudana (1980).     ','0.657999992','127.4000015','1730','Stratovolcano','Indonesia','Halmahera','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('511','541','0608-062','Holocene','The small volcanic island of Mare, immediately south of Tidore, was mapped as Holocene in age by Apandi and Sudana (1980).  The 2 x 3 km island, part of a chain of volcanic islands off the western coast of Halmahera Island, is elongated in a NE-SW direction.  A large breached crater at the andesitic Mare volcano is located off the SW tip of the 308-m-high island.    ','0.569999993','127.4000015','308','Stratovolcano','Indonesia','Halmahera','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('512','542','0608-063','Holocene','The 5-km-wide island of Moti, also known as Motir, is part of a roughly N-S-trending chain of islands off the western coast of Halmahera Island.  Moti is located north of Makian volcano and south of Mare and Tidore islands and is surrounded by coral reefs.  The truncated, conical island rises to 950 m and contains a crater on its SSW side.  Moti was mapped as Holocene in age by Apandi and Sudana (1980).  An insignificant eruption was reported in 1774 or shorter before, but Gogarten (1918) indicated that this event was confused with the October 1773 eruption of nearby Gamalama volcano, which could have dropped ash on Moti.      ','0.449999988','127.4000015','950','Stratovolcano','Indonesia','Halmahera','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('513','543','0608-06=','Historical','Gamalama (Peak of Ternate) is a near-conical stratovolcano that comprises the entire island of Ternate off the western coast of Halmahera and is one of Indonesia's most active volcanoes.  The island of Ternate was a major regional center in the Portuguese and Dutch spice trade for several centuries, which contributed to the thorough documentation of Gamalama's historical activity.  Three cones, progressively younger to the north, form the summit of Gamalama, which reaches 1715 m.  Several maars and vents define a rift zone, parallel to the Halmahera island arc, that cuts the volcano.  Eruptions, recorded frequently since the 16th century, typically originated from the summit craters, although flank eruptions have occurred in 1763, 1770, 1775, and 1962-63.   ','0.800000012','127.3300018','1715','Stratovolcano','Indonesia','Halmahera','Ternate','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('514','544','0608-071','Holocene','Gunung Tigalalu (Mount Tigalalu) is located at the northern end of Kayoa Island, which straddles the equator and is the southernmost of a chain of small volcanic islands off the western coast of Halmahera Island.  Tigalalu forms a 422-m-high N-S-trending volcanic ridge at the north end of the island, part of which is flanked by coral limestones.  Although much less known than its historically active neighbor to the north, Makian volcano, Tigalalu was mapped as Holocene in age by Apandi and Sudana (1980).      ','0.07','127.4199982','422','Stratovolcano','Indonesia','Halmahera','','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('515','545','0608-072','Holocene','Bukit Amasing (Amasing Hill) is the largest and NW-most of a group of three small andesitic volcanoes of Holocene age (Yasin, 1980).  They are located along a NW-SE line on central Bacan Island, west of the southern tip of Halmahera.  Two smaller volcanoes, Cakasuanggi and Dua Saudara, were constructed to the SE, north of the metamorphic complex of the Sibela Mountains.  These mountains separate the Amasing volcano group from another group of three andesitic Holocene volcanoes in SE-most Bacan Island.','-0.529999971','127.4800034','1030','Stratovolcano','Indonesia','Halmahera','Bacan','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('516','546','0608-073','Holocene','Bukit Bibinoi (Bibinoi Hill) is the largest and SE-most of a group of three andesitic Holocene stratovolcanoes located along a NW-SE line near the SE tip of Bacan Island, west of the southern tip of Halmahera (Yasin, 1980).  The smaller Songsu and Lansa volcanoes straddle a narrow isthmus separating the SE-most peninsula of Bacan Island from the Sibela Mountains metamorphic complex.  The Bibinoi volcano group lies along the same trend as the Amasing volcano group, which is located to the NW on the other side of the Sibela Mountains.     ','-0.769999981','127.7200012','900','Stratovolcano','Indonesia','Halmahera','Bacan','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('517','547','0608-07=','Historical','Makian volcano forms a 10-km-wide island near the southern end of a chain of volcanic islands off the west coast of Halmahera and has been the source of infrequent, but violent eruptions that have devastated villages on the island.  The large 1.5-km-wide summit crater, containing a small lake on the NE side, gives the 1357-m-high peak a flat-topped profile.   Two prominent valleys extend to the coast from the summit crater on the north and east sides.  Four parasitic cones are found on the western flanks.  Eruption have been recorded since about 1550; major eruptions in 1646, 1760-61, 1861-62, 1890, and 1988 caused extensive damage and many fatalities.   ','0.319999993','127.4000015','1357','Stratovolcano','Indonesia','Halmahera','Halmahera','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('1553','1583','0601-121','Holocene','Malintang is a 1983-m-high forested stratovolcano with a caldera breached to the south.  A 900 x 1500 m lake lies against the back caldera wall.  The flanks of Sorikmalintang are relatively pristine and uneroded, and it most likely has had significant eruptions within the past few thousand years (Kieh, 2009 pers. comm.).  The horseshoe-shaped caldera of the andesitic-to-dacitic volcano may be related to emplacement of a large debris avalanche.      ','0.466666667','99.66666667','1983','Stratovolcano','Indonesia','Sumatra','Central Sumatra','Andesite/Basaltic Andesite','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('1569','1599','060101=A','Fumarolic','Pulau Weh island off the NW tip of Sumatra has been interpreted as the remains of a partially collapsed older center breached to the NW and filled by the sea.  Pulau Weh was included in the Catalog of Active Volcanoes of the World (Neumann van Padang 1951) based on its geothermal activity.  Volcanism was assumed to be of Pleistocene age (Bennett et al., 1981), but fumaroles and hot springs are found a NW-E-trending line along the summit of the island and near the western shore of Lhok Perialakot bay on the northern side of the island.','5.88','95.33','584','Stratovolcano','Indonesia','Sumatra','Northwestern Sumatra','','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('1570','1600','060104=A','Fumarolic','Geureudong is a massive, 30-km-wide complex that rises above schists and granitic rocks and is one of the largest volcanic complexes in NW Sumatra.  The 2885-m-high Bur ni Geureudong is Pleistocene in age, but hot springs are found on its northern and southern flanks.  The Pupandji pyroclastic cone was constructed on its SE flank, adjacent to two maars with diameters of 300 and 60 m.','4.82','96.8','2590','Stratovolcano','Indonesia','Sumatra','','','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('1571','1601','060106=A','Fumarolic','The Gayolesten fumarole field is located on the flanks of the Pleistocene Gunung Kembar volcano.  The Kembar complex, located at the junction of two fault systems, is an andesitic shield volcano capped by a complex of craters and cones (Cameron et al. 1982).  Gayolesten was included in the Catalog of Active Volcanoes of the World (Neumann van Padang 1951) based on its geothermal activity.  Active fumaroles and hot springs are present at several locations.     ','3.87','97.6','1500','Complex volcano','Indonesia','Sumatra','Northwestern Sumatra','','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('1572','1602','060110=B','Fumarolic','Helatoba-Tarutung, located in northern Sumatra south of Lake Toba, is a group of sulfurous hot springs along a 40-km-long, NNW-SSE-trending stretch of the Renun-Toru fault zone.  Adjacent volcanics are of Pleistocene age (Aspden et al. 1982, Aldiss et al. 1983), but Helatoba-Tarutung was included in the Catalog of Active Volcanoes of the World (Neumann van Padang 1951) based on its geothermal activity.     ','2.03','98.93','1100','Volcanic field','Indonesia','Sumatra','Northern Sumatra','','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('1573','1603','0603-03=','Historical','','-6.73','106.65','1511','Stratovolcano','','','','','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('1574','1604','060312=A','Fumarolic','Kawah Kamojang, the first developed geothermal field in Indonesia, is located 7 km WNW of the historically active Guntur volcano within the Pleistocene Pangkalan caldera.   Kawah Kamojang was included in the Catalog of Active Volcanoes of the World (Neumann van Padang 1951) based on its geothermal activity.  The 1.2 by 0.7 km thermal area consists of fumaroles, steaming ground, hot lakes, mud pots, and hydrothermally altered ground.  The field is located along a WSW-ENE-trending Quaternary volcanic chain that includes Gunung Rakutak, the Ciharus, Pangkalan, and Gandapura complexes, Gunung Masigit, and Gunung Guntur.  This chain is progressively younger to the ENE.  Kawah Kamojang is associated with the Pangkalan and Gandapura volcanic centers, along the Kendeng fault, which extends SW to the Darajat geothermal field.      ','-7.125','107.8','1730','Volcanic field','Indonesia','Java','Western Java','','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('1575','1605','0604-19=','Historical','','-8.54','122.775','1703','Stratovolcano','','','','','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00',''),('1576','1606','060421=A','Fumarolic','The Riang Kotang fumarole field is located at the northern foot of Quaternary Ilikedeka volcano near the eastern tip of Flores Island.  Two fumarolic areas occur along the saddle on the northern foot of the volcano.  Hot springs are located along the SW side of Oka Bay on the southern coast and Hadang Bay on the NW coast.','-8.3','122.892','200','Volcanic field','Indonesia','Lesser Sunda Islands','Flores','','','','','','','0000-00-00 00:00:00','','9999-12-31 23:59:00','');
INSERT INTO st_eqt (st_eqt_id,st_eqt_wovo,st_eqt_org,st_eqt_name, cc_id, st_eqt_loaddate,cc_id_load) VALUES ('1','R','R','Regional Tectonic', '134', '2013-07-12 11:46:00','269'),('2','Q','Q','Query Blast', '134', '2013-07-12 11:46:00','269'),('3','V','V','Generic Volc. Quake', '134', '2013-07-12 11:46:00','269'),('4','VT','VT','Volcano-tectonics', '134', '2013-07-12 11:46:00','269'),('5','VT_D','VT_D','Deep VT', '134', '2013-07-12 11:46:00','269'),('6','VT_S','VT_S','Shallow VT', '134', '2013-07-12 11:46:00','269'),('7','H','H','Hybrid', '134', '2013-07-12 11:46:00','269'),('8','H_HLF','H_HLF','High to Low Freq. Hybrid', '134', '2013-07-12 11:46:00','269'),('9','H_LHF','H_LHF','Low to High Freq. Hybrid', '134', '2013-07-12 11:46:00','269'),('10','LF','LF','Low Frequency', '134', '2013-07-12 11:46:00','269'),('11','LF_LP','LF_LP','Long period LF', '134', '2013-07-12 11:46:00','269'),('12','LF_T','LF_T','Tornillo', '134', '2013-07-12 11:46:00','269'),('13','LF_ILF','LF_ILF','Intermediate LF', '134', '2013-07-12 11:46:00','269'),('14','VLP','VLP','Very Long Period', '134', '2013-07-12 11:46:00','269'),('15','E','E','Explosion', '134', '2013-07-12 11:46:00','269'),('16','U','U','Unknown origin', '134', '2013-07-12 11:46:00','269'),('17','O','O','Other, non-volcanic origin', '134', '2013-07-12 11:46:00','269'),('18','X','X','Undefined', '134', '2013-07-12 11:46:00','269'),('19','RF','RF','Rock Fall', '134', '2014-08-28 00:00:00','269'),('20','G','G','Gas Burst', '134', '2014-08-28 00:00:00','269'),('21','PF','PF','Pyroclastic Flow', '134', '2014-08-28 00:00:00','269');