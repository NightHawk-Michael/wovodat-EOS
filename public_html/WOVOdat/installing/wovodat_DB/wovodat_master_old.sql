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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Contact' AUTO_INCREMENT=294 ;

-- --------------------------------------------------------

--
-- Table structure for table `ch`
--

CREATE TABLE IF NOT EXISTS `ch` (
  `ch_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ch_linkname` enum('cb','cc','ch','cm','cn','co','cp','cr','cr_tmp','cs','cu','dd_ang','dd_edm','dd_gps','dd_gpv','dd_lev','dd_sar','dd_srd','dd_str','dd_tlt','dd_tlv','di_gen','di_tlt','ds','ed','ed_for','ed_phs','ed_vid','fd_ele','fd_gra','fd_mag','fd_mgv','fi','fs','gd','gd_plu','gd_sol','gi','gs','hd','hi','hs','ip_hyd','ip_mag','ip_pres','ip_sat','ip_tec','jj_concon','jj_imgx','jj_subnet','jj_volcon','jj_volnet','j_sarsat','md','sd_evn','sd_evs','sd_int','sd_ivl','sd_rsm','sd_sam','sd_ssm','sd_trm','sd_wav','si','si_cmp','sn','ss','st_eqt','td','td_img','td_pix','ti','ts','vd','vd_inf','vd_mag','vd_tec') DEFAULT NULL COMMENT 'Table',
  `ch_link_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Link ID',
  `ch_atname` varchar(30) DEFAULT NULL COMMENT 'Field name',
  `ch_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
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
  `cn_sub` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Has sub-networks? 0=FALSE, 1=TRUE',
  `cn_name` varchar(255) DEFAULT NULL COMMENT 'Name',
  `cn_type` enum('Deformation','Fields','Gas','Hydrologic','Thermal','Unknown') NOT NULL DEFAULT 'Unknown' COMMENT 'Type',
  `cn_area` float DEFAULT NULL COMMENT 'Area',
  `cn_map` varchar(255) DEFAULT NULL COMMENT 'Map',
  `cn_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start time',
  `cn_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `cn_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End time',
  `cn_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
  `cn_utc` float DEFAULT NULL COMMENT 'Difference from UTC',
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
  `cs_id` mediumint(8) unsigned DEFAULT NULL,
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
  `dd_sar_jpg` varchar(255) DEFAULT NULL COMMENT 'JPG of interferogram',
  `dd_sar_geotiff` varchar(255) DEFAULT NULL COMMENT 'GEOTIFF of interferogram',
  `dd_sar_prometh` varchar(255) DEFAULT NULL COMMENT 'Processing method',
  `dd_sar_softwr` varchar(255) DEFAULT NULL COMMENT 'Software',
  `dd_sar_dem_qual` enum('E','G','F','U') DEFAULT NULL COMMENT 'DEM quality: E=Excellent, G=Good, F=Fair, U=Unknown',
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
  KEY `VOLCANO` (`vd_id`)
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
  `di_gen_type` varchar(50) DEFAULT NULL COMMENT 'Type',
  `di_gen_units` varchar(30) DEFAULT NULL COMMENT 'Measured units',
  `di_gen_res` float DEFAULT NULL COMMENT 'Resolution',
  `di_gen_stn` float DEFAULT NULL COMMENT 'Signal to noise',
  `di_gen_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start time',
  `di_gen_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `di_gen_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End time',
  `di_gen_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
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
  `di_tlt_type` varchar(50) DEFAULT NULL COMMENT 'Type',
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
  `gd_plu_weth` varchar(255) DEFAULT NULL COMMENT 'Weather notes',
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
  `jj_idname` enum('cb','cc','ch','cm','cn','co','cp','cr','cr_tmp','cs','cu','dd_ang','dd_edm','dd_gps','dd_gpv','dd_lev','dd_sar','dd_srd','dd_str','dd_tlt','dd_tlv','di_gen','di_tlt','ds','ed','ed_for','ed_phs','ed_vid','fd_ele','fd_gra','fd_mag','fd_mgv','fi','fs','gd','gd_plu','gd_sol','gi','gs','hd','hi','hs','ip_hyd','ip_mag','ip_pres','ip_sat','ip_tec','jj_concon','jj_imgx','jj_volcon','jj_volnet','j_sarsat','md','sd_evn','sd_evs','sd_int','sd_ivl','sd_rsm','sd_sam','sd_ssm','sd_trm','sd_wav','si','si_cmp','sn','ss','st_eqt','td','td_img','td_pix','ti','ts','vd','vd_inf','vd_mag','vd_tec') DEFAULT NULL COMMENT 'Table name',
  `jj_x_id` mediumint(8) unsigned DEFAULT NULL COMMENT 'Link ID',
  `jj_imgx_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`jj_imgx_id`),
  UNIQUE KEY `LINK` (`cm_id`,`jj_idname`,`jj_x_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Image junction' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jj_subnet`
--

CREATE TABLE IF NOT EXISTS `jj_subnet` (
  `jj_subnet_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Network-subnetwork ID',
  `jj_net_id` smallint(5) unsigned NOT NULL COMMENT 'Network ID',
  `jj_sub_id` smallint(5) unsigned NOT NULL COMMENT 'Subnetwork ID',
  `jj_net_type` enum('C','S') NOT NULL COMMENT 'Network type (S=Seismic, C=Common)',
  `jj_subnet_loaddate` datetime NOT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned NOT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`jj_subnet_id`),
  UNIQUE KEY `LINK` (`jj_net_id`,`jj_sub_id`,`jj_net_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Volcano-network junction' AUTO_INCREMENT=2170 ;

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
  `sd_evn_eqtype` enum('R','Q','V','VT','VT_D','VT_S','H','H_HLF','H_LHF','LF','LF_LP','LF_T','LF_ILF','VLP','E') DEFAULT NULL COMMENT 'The WOVOdat terminology for the earthquake type',
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
  KEY `TECHNIQUE` (`sd_evn_tech`)
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
  `sd_evs_eqtype` enum('R','Q','V','VT','VT_D','VT_S','H','H_HLF','H_LHF','LF','LF_LP','LF_T','LF_ILF','VLP','E') DEFAULT NULL COMMENT 'The WOVOdat terminology for the earthquake type',
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
  `sd_ivl_eqtype` enum('R','Q','V','VT','VT_D','VT_S','H','H_HLF','H_LHF','LF','LF_LP','LF_T','LF_ILF','VLP','E') DEFAULT NULL COMMENT 'Earthquake type',
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
  `sd_ivl_desc` varchar(255) DEFAULT NULL COMMENT 'Description',
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
  `sn_sub` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Has sub-networks? 0=FALSE, 1=TRUE',
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
  `st_eqt_org` varchar(255) DEFAULT NULL COMMENT 'Original terminology',
  `st_eqt_wovo` varchar(255) DEFAULT NULL COMMENT 'WOVOdat terminology',
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `st_eqt_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`st_eqt_id`),
  UNIQUE KEY `USER TRANSLATION` (`st_eqt_wovo`,`cc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Earthquake type translation' AUTO_INCREMENT=1 ;

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
  `td_img_jpg` blob COMMENT 'JPG',
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
  `cc_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id2` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id3` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id4` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `cc_id5` smallint(5) unsigned DEFAULT NULL COMMENT 'Contact ID',
  `vd_loaddate` datetime DEFAULT NULL COMMENT 'Load date',
  `vd_pubdate` datetime DEFAULT NULL COMMENT 'Publish date',
  `cc_id_load` smallint(5) unsigned DEFAULT NULL COMMENT 'Loader ID',
  PRIMARY KEY (`vd_id`),
  UNIQUE KEY `CAVW NUMBER` (`vd_cavw`)
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
  `vd_inf_evol` float DEFAULT NULL COMMENT 'Volume of edifice',
  `vd_inf_numcald` tinyint(4) unsigned DEFAULT NULL COMMENT 'Number of calderas',
  `vd_inf_lcald_dia` float DEFAULT NULL COMMENT 'Diameter of largest caldera',
  `vd_inf_ycald_lat` double DEFAULT NULL COMMENT 'Latitude of youngest caldera',
  `vd_inf_ycald_lon` double DEFAULT NULL COMMENT 'Longitude of youngest caldera',
  `vd_inf_stime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Start time',
  `vd_inf_stime_unc` datetime DEFAULT NULL COMMENT 'Start time uncertainty',
  `vd_inf_etime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' COMMENT 'End time',
  `vd_inf_etime_unc` datetime DEFAULT NULL COMMENT 'End time uncertainty',
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
