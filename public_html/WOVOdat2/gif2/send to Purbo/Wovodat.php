<?php

class Wovodat {
    /*
     * Constructor
     */

    public function __construct() {
        $this->connectWovodatServer();
    }

    public function connectWovodatServer() {
        $link = mysql_connect("www.wovodat.org", "wovodat_view", "+00World") or die(mysql_error());
        mysql_select_db("wovodat") or die(mysql_error());
        return $link;
    }

    /*
     * Return the list of all available volcano in our database
     */

    public function getVolcanoList() {
        mysql_query("set character_set_results='utf8'");
        $result = mysql_query("select vd_name, vd_cavw FROM vd ORDER BY vd_name");
        $i = mysql_fetch_array($result);
        if ($i === false)
            return;
        else
            while (true) {
                echo "$i[0]&$i[1]";
                $i = mysql_fetch_array($result);
                if ($i === false)
                    break;
                echo ";";
            }
    }

    /*
     * Return the list of all eruption of one specifci volcano
     */

    public function getEruptionList($cavw) {
        mysql_query("set character_set_results='utf8'");
        $result = mysql_query("select ed.ed_code , ed.ed_stime, ed.ed_stime_bc from vd, ed where vd.vd_cavw = '$cavw' and vd.vd_id = ed.vd_id order by ed.ed_stime desc");
        $i = mysql_fetch_array($result);
        if ($i === false)
            return;
        else
            while (true) {
                if ($i[1] == "0000-00-00 00:00:00") {
                    $i[1] = "BC" . $i[2];
                } else {
                    $i[1] = explode(" ", $i[1]);
                    $i[1] = $i[1][0] . "&" . $i[1][1];
                }
                echo "$i[0]&$i[1]";
                $i = mysql_fetch_array($result);
                if ($i === false)
                    break;
                echo ";";
            }
    }

    /*
     * Get latitude and longitute of a volcano
     * 
     */

    public function getLatLon($cavw) {
        $result = mysql_query("select vd_inf_slat,vd_inf_slon, vd_inf_selev from vd_inf where vd_inf_cavw = '$cavw'");
        $i = mysql_fetch_array($result);
        if ($i === false)
            return;
        echo "$i[0];$i[1];$i[2]";
    }

    /*
     * Destructor
     */

    public function __destruct() {
        mysql_close();
    }

    /*
     * Get cc_url of a volcano
     * of a specific cavw
     */

    public function getCCUrl($cavw) {
        $query1 = mysql_query("select cc_id from vd where vd_cavw='" . $cavw . "'");
        $result1 = mysql_fetch_array($query1);
        if ($result1 !== false) {
            $cc_id = $result1[0];
            $query1_2 = mysql_query("select cc_url from cc where cc_id='" . $cc_id . "'");
            $result1_2 = mysql_fetch_array($query1_2);
            if ($result1_2 !== false)
                echo $result1_2[0] . ";";
            else
                echo ";";
        }
        $query2 = mysql_query("select vd_inf_status, vd_inf_type from vd_inf where vd_inf_cavw='" . $cavw . "'");
        $result2 = mysql_fetch_array($query2);
        if ($result2 !== false) {
            echo $result2[0] . "-" . $result2[1];
        }
    }

    /*
     * Get available stations TYPE around a specific volcano, the default value will be
     * 20 km aray from the top of the volcano
     */

    public function getStationsWithDataList($cavw) {
        $volcanoId = mysql_query("select vd_id from vd where vd_cavw = '$cavw'");
        $volcanoId = mysql_fetch_array($volcanoId);
        $volcanoId = $volcanoId[0];
        $temp = Array();
        $value = "";
        $seismicStations = mysql_query("(select  c.ss_code FROM sn a, ss c  where a.vd_id = '$volcanoId'  and a.sn_id = c.sn_id) UNION (select c.ss_code FROM jj_volnet a, ss c , vd_inf d  WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id  and a.jj_net_flag = 'S' and a.jj_net_id = c.sn_id and (sqrt(power(d.vd_inf_slat - c.ss_lat, 2) + power(d.vd_inf_slon - c.ss_lon, 2))*100)<20)") or die(mysql_error());
        while ($temp = mysql_fetch_array($seismicStations)) {
            // get the station code
            $temp = $temp[0];
            // sd_ivl
            $value = mysql_query("select b.ss_id from ss a, sd_ivl b where a.ss_code = '$temp' and a.ss_id = b.ss_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "seismic;";
                break;
            }
            // sd_rsm
            $value = mysql_query("select c.sd_rsm_id from ss a, sd_sam b, sd_rsm c where a.ss_code = '$temp' and a.ss_id = b.ss_id and b.sd_sam_id = c.sd_sam_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "seismic;";
                break;
            }
        }
        $deformationStations = mysql_query("(select  c.ds_code FROM cn a, ds c  where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id  order by c.ds_code) UNION (select c.ds_code FROM jj_volnet a, ds c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.ds_nlat, 2) + power(d.vd_inf_slon - c.ds_nlon, 2))*100)<20	ORDER BY c.ds_code)") or die(mysql_error());
        while ($temp = mysql_fetch_array($deformationStations)) {
            // get the station code
            $temp = $temp[0];
            // dd_tlt
            $value = mysql_query("select b.ds_id from ds a, dd_tlt b where a.ds_code = '$temp' and a.ds_id = b.ds_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_tlv
            $value = mysql_query("select b.ds_id from ds a, dd_tlv b where a.ds_code = '$temp' and a.ds_id = b.ds_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_str
            $value = mysql_query("select b.ds_id from ds a, dd_str b where a.ds_code = '$temp' and a.ds_id = b.ds_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_edm
            $value = mysql_query("select b.ds_id from ds a, dd_edm b where a.ds_code = '$temp' and (a.ds_id = b.ds_id1 or a.ds_id = b.ds_id2)  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_ang
            $value = mysql_query("select b.ds_id from ds a, dd_ang b where a.ds_code = '$temp' and a.ds_id = b.ds_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_gps
            $value = mysql_query("select b.ds_id from ds a, dd_gps b where a.ds_code = '$temp' and a.ds_id = b.ds_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_gpv
            $value = mysql_query("select b.ds_id from ds a, dd_gpv b where a.ds_code = '$temp' and a.ds_id = b.ds_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_lev
            $value = mysql_query("select b.ds_id from ds a, dd_lev b where a.ds_code = '$temp' and (a.ds_id = b.ds_id1 or a.ds_id = b.ds_id2) limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_sar: no station? , how to display the data
            // use volcano id instead
            $value = mysql_query("select vd_id from dd_sar where vd_id = '$volcanoId' limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
        }
        $fieldStations = mysql_query("(select  c.fs_code FROM cn a, fs c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id  order by c.fs_code) UNION (select c.fs_code FROM jj_volnet a, fs c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.fs_lat, 2) + power(d.vd_inf_slon - c.fs_lon, 2))*100)<20 ORDER BY c.fs_code)") or die(mysql_error());
        //fd_ele
        while ($temp = mysql_fetch_array($fieldStations)) {
            $temp = $temp[0];
            $value = mysql_query("select fd_ele_id from fs, fd_ele where fs_code = '$temp' and (fs_id = fs_id1 or fs_id = fs_id2)  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "field;";
                break;
            }
            // fd_gra
            $value = mysql_query("select fd_gra_id from fs , fd_gra where fs.fs_code = '$temp' and fs.fs_id = fd_gra.fs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "field;";
                break;
            }
            // fd_mag
            $value = mysql_query("select fd_mag_id from fs , fd_mag where fs.fs_code = '$temp' and fs.fs_id = fd_mag.fs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "field;";
                break;
            }
            // fd_mgv
            $value = mysql_query("select fd_mgv_id from fs , fd_gra where fs.fs_code = '$temp' and fs.fs_id = fd_mgv.fs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "field;";
                break;
            }
        }
        $gasStations = mysql_query("(select  c.gs_code FROM cn a, gs c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.gs_code FROM jj_volnet a, gs c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.gs_lat, 2) + power(d.vd_inf_slon - c.gs_lon, 2))*100)<20 ORDER BY c.gs_code)") or die(mysql_error());
        while ($temp = mysql_fetch_array($gasStations)) {
            $temp = $temp[0];
            // gd
            $value = mysql_query("select gd_id from gs , gd where gs.gs_code = '$temp' and gs.gs_id = gd.gs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "gas;";
                break;
            }
            // gd_plu
            $value = mysql_query("select gd_plu_id from gs , gd_plu where gs.gs_code = '$temp' and gs.gs_id = gd_plu.gs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "gas;";
                break;
            }
            // gd_sol
            $value = mysql_query("select gd_sol_id from gs , gd_sol where gs.gs_code = '$temp' and gs.gs_id = gd_sol.gs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "gas;";
                break;
            }
        }
        $hydrologicStations = mysql_query("(select  c.hs_code FROM cn a, hs c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.hs_code FROM jj_volnet a, hs c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.hs_lat, 2) + power(d.vd_inf_slon - c.hs_lon, 2))*100)<30 ORDER BY c.hs_code)") or die(mysql_error());
        while ($temp = mysql_fetch_array($hydrologicStations)) {
            $temp = $temp[0];
            // hd
            $value = mysql_query("select hd_id from hs, hd where hs_code = '$temp' and hs.hs_id = hd.hs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "hydrologic;";
                break;
            }
        }
        $thermalStations = mysql_query("(select  c.ts_code FROM cn a, ts c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.ts_code FROM jj_volnet a, ts c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.ts_lat, 2) + power(d.vd_inf_slon - c.ts_lon, 2))*100)<20 ORDER BY c.ts_code)") or die(mysql_error());
        while ($temp = mysql_fetch_array($thermalStations)) {
            $temp = $temp[0];
            // td
            $value = mysql_query("select td_id from ts,td where ts_code = '$temp' and ts.ts_id = td.ts_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "thermal;";
                break;
            }
        }
//        $meteorStations         = mysql_query("(select  c.ms_code FROM cn a, ms c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.ms_code FROM jj_volnet a, ms c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.ms_lat, 2) + power(d.vd_inf_slon - c.ms_lon, 2))*100)<20 ORDER BY c.ms_code)  limit 0 , 1") or die(mysql_error());
//        if (mysql_num_rows($meteorStations))
//            echo "meteor;";
    }

    /* Get all stations near a volcano
      Regardless they contain time series data or not
      author: Tran Thien Nam
      2012-07-16
     */

    function getAllStationsList($cavw) {
        $vd_id = $this->getVolcanoId($cavw);
        $collection = array();
        $query_collection = array();
        $table_names = array("ss", "ds", "fs", "hs", "gs", "ts");
        $latlon_names = array(array("ss_lat", "ss_lon"), array("ds_nlat", "ds_nlon"), array("fs_lat", "fs_lon"), array("hs_lat", "hs_lon"), array("gs_lat", "gs_lon"), array("ts_lat", "ts_lon"));
        $network_names_col = array("sn", "cn", "cn", "cn", "cn", "cn");
        $type = array("Seismic", "Deformation", "Field", "Hydrologic", "Gas", "Thermal");
        for ($i = 0; $i < count($table_names); $i++) {
            $tb = $table_names[$i];
            $lat = $latlon_names[$i][0];
            $lon = $latlon_names[$i][1];
            $nn = $network_names_col[$i];
            $flag = strToUpper(substr($nn, 0, 1));
            $next_query = "(select c.{$tb}_name, c.{$lat}, c.{$lon} from {$nn} a, {$tb} c  where a.vd_id = '$vd_id' and a.{$nn}_id = c.{$nn}_id  order by c.{$tb}_name) UNION (select c.{$tb}_name, c.{$lat}, c.{$lon} FROM jj_volnet a, {$tb} c,vd_inf d WHERE a.vd_id = '$vd_id' and a.vd_id=d.vd_id   and a.jj_net_flag = '{$flag}' and a.jj_net_id = c.{$nn}_id and (sqrt(power(d.vd_inf_slat - c.{$lat}, 2) + power(d.vd_inf_slon - c.{$lon}, 2))*100)<20 ORDER BY c.{$tb}_name)";
            $query_exe = mysql_query($next_query) or die("Cannot connect to server");
            while ($query_result = mysql_fetch_array($query_exe)) {
                $next_station = new Station($query_result["{$tb}_name"], $query_result[$lat], $query_result[$lon], $type[$i]);
                array_push($collection, $next_station);
            }
        }
        foreach ($collection as $next_station) {
            echo $next_station->outputInfo();
        }
    }

    /*
     * Get available stations TYPE around a specific volcano, the default value will be
     * 20 km aray from the top of the volcano
     */

    public function getAvailableStations($cavw) {
        $volcanoId = mysql_query("select vd_id from vd where vd_cavw = '$cavw'");
        $volcanoId = mysql_fetch_array($volcanoId);
        $volcanoId = $volcanoId[0];
        $temp = Array();
        $value = "";
        $seismicStations = mysql_query("(select  c.ss_code FROM sn a, ss c  where a.vd_id = '$volcanoId'  and a.sn_id = c.sn_id) UNION (select c.ss_code FROM jj_volnet a, ss c , vd_inf d  WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id  and a.jj_net_flag = 'S' and a.jj_net_id = c.sn_id and (sqrt(power(d.vd_inf_slat - c.ss_lat, 2) + power(d.vd_inf_slon - c.ss_lon, 2))*100)<20)") or die(mysql_error());
        while ($temp = mysql_fetch_array($seismicStations)) {
            // get the station code
            $temp = $temp[0];
            // sd_ivl
            $value = mysql_query("select b.ss_id from ss a, sd_ivl b where a.ss_code = '$temp' and a.ss_id = b.ss_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "seismic;";
                break;
            }
            // sd_rsm
            $value = mysql_query("select c.sd_rsm_id from ss a, sd_sam b, sd_rsm c where a.ss_code = '$temp' and a.ss_id = b.ss_id and b.sd_sam_id = c.sd_sam_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "seismic;";
                break;
            }
        }
        $deformationStations = mysql_query("(select  c.ds_code FROM cn a, ds c  where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id  order by c.ds_code) UNION (select c.ds_code FROM jj_volnet a, ds c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.ds_nlat, 2) + power(d.vd_inf_slon - c.ds_nlon, 2))*100)<20	ORDER BY c.ds_code)") or die(mysql_error());
        while ($temp = mysql_fetch_array($deformationStations)) {
            // get the station code
            $temp = $temp[0];
            // dd_tlt
            $value = mysql_query("select b.ds_id from ds a, dd_tlt b where a.ds_code = '$temp' and a.ds_id = b.ds_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_tlv
            $value = mysql_query("select b.ds_id from ds a, dd_tlv b where a.ds_code = '$temp' and a.ds_id = b.ds_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_str
            $value = mysql_query("select b.ds_id from ds a, dd_str b where a.ds_code = '$temp' and a.ds_id = b.ds_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_edm
            $value = mysql_query("select b.ds_id from ds a, dd_edm b where a.ds_code = '$temp' and (a.ds_id = b.ds_id1 or a.ds_id = b.ds_id2)  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_ang
            $value = mysql_query("select b.ds_id from ds a, dd_ang b where a.ds_code = '$temp' and a.ds_id = b.ds_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_gps
            $value = mysql_query("select b.ds_id from ds a, dd_gps b where a.ds_code = '$temp' and a.ds_id = b.ds_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_gpv
            $value = mysql_query("select b.ds_id from ds a, dd_gpv b where a.ds_code = '$temp' and a.ds_id = b.ds_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_lev
            $value = mysql_query("select b.ds_id from ds a, dd_lev b where a.ds_code = '$temp' and (a.ds_id = b.ds_id1 or a.ds_id = b.ds_id2) limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
            // dd_sar: no station? , how to display the data
            // use volcano id instead
            $value = mysql_query("select vd_id from dd_sar where vd_id = '$volcanoId' limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "deformation;";
                break;
            }
        }
        $fieldStations = mysql_query("(select  c.fs_code FROM cn a, fs c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id  order by c.fs_code) UNION (select c.fs_code FROM jj_volnet a, fs c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.fs_lat, 2) + power(d.vd_inf_slon - c.fs_lon, 2))*100)<20 ORDER BY c.fs_code)") or die(mysql_error());
        //fd_ele
        while ($temp = mysql_fetch_array($fieldStations)) {
            $temp = $temp[0];
            $value = mysql_query("select fd_ele_id from fs, fd_ele where fs_code = '$temp' and (fs_id = fs_id1 or fs_id = fs_id2)  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "field;";
                break;
            }
            // fd_gra
            $value = mysql_query("select fd_gra_id from fs , fd_gra where fs.fs_code = '$temp' and fs.fs_id = fd_gra.fs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "field;";
                break;
            }
            // fd_mag
            $value = mysql_query("select fd_mag_id from fs , fd_mag where fs.fs_code = '$temp' and fs.fs_id = fd_mag.fs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "field;";
                break;
            }
            // fd_mgv
            $value = mysql_query("select fd_mgv_id from fs , fd_gra where fs.fs_code = '$temp' and fs.fs_id = fd_mgv.fs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "field;";
                break;
            }
        }
        $gasStations = mysql_query("(select  c.gs_code FROM cn a, gs c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.gs_code FROM jj_volnet a, gs c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.gs_lat, 2) + power(d.vd_inf_slon - c.gs_lon, 2))*100)<20 ORDER BY c.gs_code)") or die(mysql_error());
        while ($temp = mysql_fetch_array($gasStations)) {
            $temp = $temp[0];
            // gd
            $value = mysql_query("select gd_id from gs , gd where gs.gs_code = '$temp' and gs.gs_id = gd.gs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "gas;";
                break;
            }
            // gd_plu
            $value = mysql_query("select gd_plu_id from gs , gd_plu where gs.gs_code = '$temp' and gs.gs_id = gd_plu.gs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "gas;";
                break;
            }
            // gd_sol
            $value = mysql_query("select gd_sol_id from gs , gd_sol where gs.gs_code = '$temp' and gs.gs_id = gd_sol.gs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "gas;";
                break;
            }
        }
        $hydrologicStations = mysql_query("(select  c.hs_code FROM cn a, hs c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.hs_code FROM jj_volnet a, hs c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.hs_lat, 2) + power(d.vd_inf_slon - c.hs_lon, 2))*100)<30 ORDER BY c.hs_code)") or die(mysql_error());
        while ($temp = mysql_fetch_array($hydrologicStations)) {
            $temp = $temp[0];
            // hd
            $value = mysql_query("select hd_id from hs, hd where hs_code = '$temp' and hs.hs_id = hd.hs_id  limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "hydrologic;";
                break;
            }
        }
        $thermalStations = mysql_query("(select  c.ts_code FROM cn a, ts c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.ts_code FROM jj_volnet a, ts c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.ts_lat, 2) + power(d.vd_inf_slon - c.ts_lon, 2))*100)<20 ORDER BY c.ts_code)") or die(mysql_error());
        while ($temp = mysql_fetch_array($thermalStations)) {
            $temp = $temp[0];
            // td
            $value = mysql_query("select td_id from ts,td where ts_code = '$temp' and ts.ts_id = td.ts_id limit 0 , 1");
            if ($value && mysql_num_rows($value)) {
                echo "thermal;";
                break;
            }
        }
//        $meteorStations         = mysql_query("(select  c.ms_code FROM cn a, ms c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.ms_code FROM jj_volnet a, ms c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.ms_lat, 2) + power(d.vd_inf_slon - c.ms_lon, 2))*100)<20 ORDER BY c.ms_code)  limit 0 , 1") or die(mysql_error());
//        if (mysql_num_rows($meteorStations))
//            echo "meteor;";
    }

    /*
     * Get volcano id based on its cavw
     */

    private function getVolcanoId($cavw) {
        $volcanoId = mysql_query("select vd_id from vd where vd_cavw = '$cavw'");
        $volcanoId = mysql_fetch_array($volcanoId);
        return $volcanoId[0];
    }

    /*
     * Get latitude and longitude of a volcano based on its cavw
     */

    private function _getLatLonElev($cavw) {
        $result = mysql_query("select vd_inf_slat,vd_inf_slon, vd_inf_selev from vd_inf where vd_inf_cavw = '$cavw'");
        $i = mysql_fetch_array($result);
        return $i;
    }

    /*
     * Get available station for a specfic type for a specific volcano
     */

    public function getStations($cavw, $type) {
        $volcanoId = $this->getVolcanoId($cavw);
        $stations = "";
        $value = "";
        $code = "";
        switch ($type) {
            case 'seismic':
                $stations = mysql_query("(select  c.ss_code,c.ss_lat,c.ss_lon FROM sn a, ss c  where a.vd_id = '$volcanoId'  and a.sn_id = c.sn_id) UNION (select c.ss_code,c.ss_lat,c.ss_lon FROM jj_volnet a, ss c , vd_inf d  WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id  and a.jj_net_flag = 'S' and a.jj_net_id = c.sn_id and (sqrt(power(d.vd_inf_slat - c.ss_lat, 2) + power(d.vd_inf_slon - c.ss_lon, 2))*100)<20)") or die(mysql_error());
                while ($temp = mysql_fetch_array($stations)) {
                    // get the station code
                    $code = $temp[0];
                    // sd_ivl
                    $value = mysql_query("select b.ss_id from ss a, sd_ivl b where a.ss_code = '$code' and a.ss_id = b.ss_id  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Seismic&Interval&$code&$temp[1]&$temp[2];";
                    }
                    // sd_rsm
                    $value = mysql_query("select c.sd_rsm_id from ss a, sd_sam b, sd_rsm c where a.ss_code = '$code' and a.ss_id = b.ss_id and b.sd_sam_id = c.sd_sam_id limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Seismic&RSAM&$code&$temp[1]&$temp[2];";
                        break;
                    }
                }
                break;
            case 'deformation':
                $stations = mysql_query("(select  c.ds_code,c.ds_nlat,c.ds_nlon FROM cn a, ds c  where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id  order by c.ds_code) UNION (select c.ds_code,c.ds_nlat,c.ds_nlon FROM jj_volnet a, ds c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.ds_nlat, 2) + power(d.vd_inf_slon - c.ds_nlon, 2))*100)<20	ORDER BY c.ds_code)") or die(mysql_error());
                // get the station code
                while ($temp = mysql_fetch_array($stations)) {
                    $code = $temp[0];
                    // dd_tlt
                    $value = mysql_query("select b.ds_id from ds a, dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Deformation&ElectronicTilt&$code&$temp[1]&$temp[2]&Tilt1;";
                        echo "Deformation&ElectronicTilt&$code&$temp[1]&$temp[2]&Tilt2;";
                    }
                    // dd_tlv
                    $value = mysql_query("select b.ds_id from ds a, dd_tlv b where a.ds_code = '$code' and a.ds_id = b.ds_id limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Deformation&TiltVector&$code&$temp[1]&$temp[2];";
                    }
                    // dd_str
                    $value = mysql_query("select b.ds_id from ds a, dd_str b where a.ds_code = '$code' and a.ds_id = b.ds_id limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Deformation&Strain&$code&$temp[1]&$temp[2]&Comp1;";
                        echo "Deformation&Strain&$code&$temp[1]&$temp[2]&Comp2;";
                        echo "Deformation&Strain&$code&$temp[1]&$temp[2]&Comp3;";
                        echo "Deformation&Strain&$code&$temp[1]&$temp[2]&Comp4;";
                        echo "Deformation&Strain&$code&$temp[1]&$temp[2]&Vdstr;";
                        echo "Deformation&Strain&$code&$temp[1]&$temp[2]&Ax1;";
                        echo "Deformation&Strain&$code&$temp[1]&$temp[2]&Ax2;";
                        echo "Deformation&Strain&$code&$temp[1]&$temp[2]&Ax3;";
                    }
                    // dd_edm
                    $value = mysql_query("select b.ds_id from ds a, dd_edm b where a.ds_code = '$code' and (a.ds_id = b.ds_id1 or a.ds_id = b.ds_id2)  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Deformation&EDM&$code&$temp[1]&$temp[2];";
                    }
                    // dd_ang
                    $value = mysql_query("select b.ds_id from ds a, dd_ang b where a.ds_code = '$code' and a.ds_id = b.ds_id limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Deformation&Angle&$code&$temp[1]&$temp[2]&Hort1;";
                        echo "Deformation&Angle&$code&$temp[1]&$temp[2]&Hort2;";
                        echo "Deformation&Angle&$code&$temp[1]&$temp[2]&Vert1;";
                        echo "Deformation&Angle&$code&$temp[1]&$temp[2]&Vert2;";
                    }
                    // dd_gps
                    $value = mysql_query("select b.ds_id from ds a, dd_gps b where a.ds_code = '$code' and a.ds_id = b.ds_id limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Deformation&GPS&$code&$temp[1]&$temp[2]&Lat;";
                        echo "Deformation&GPS&$code&$temp[1]&$temp[2]&Lon;";
                        echo "Deformation&GPS&$code&$temp[1]&$temp[2]&Elev;";
                    }
                    // dd_gpv
                    $value = mysql_query("select b.ds_id from ds a, dd_gpv b where a.ds_code = '$code' and a.ds_id = b.ds_id limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Deformation&GPSVector&$code&$temp[1]&$temp[2]&NS;";
                        echo "Deformation&GPSVector&$code&$temp[1]&$temp[2]&EW;";
                        echo "Deformation&GPSVector&$code&$temp[1]&$temp[2]&Z;";
                    }
                    // dd_lev
                    $value = mysql_query("select b.ds_id from ds a, dd_lev b where a.ds_code = '$code' and (a.ds_id = b.ds_id1 or a.ds_id = b.ds_id2) limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Deformation&Leveling&$code&$temp[1]&$temp[2];";
                    }
                    // dd_sar: no station? , how to display the data
                    // use volcano id instead
                    $value = mysql_query("select vd_id from dd_sar where vd_id = '$volcanoId' limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Deformation&InSAR&$code&$temp[1]&$temp[2];";
                    }
                }
                break;
            case 'field':
                $stations = mysql_query("(select  c.fs_code,c.fs_lat,c.fs_lon FROM cn a, fs c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id  order by c.fs_code) UNION (select c.fs_code,c.fs_lat,c.fs_lon FROM jj_volnet a, fs c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.fs_lat, 2) + power(d.vd_inf_slon - c.fs_lon, 2))*100)<20 ORDER BY c.fs_code)") or die(mysql_error());

                while ($temp = mysql_fetch_array($stations)) {
                    $code = $temp[0];
                    // fd_ele
                    $value = mysql_query("select fd_ele_id from fs, fd_ele where fs_code = '$code' and (fs_id = fs_id1 or fs_id = fs_id2)  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Field&ElectricFields&$code&$temp[1]&$temp[2];";
                    }
                    // fd_gra
                    $value = mysql_query("select fd_gra_id from fs , fd_gra where fs.fs_code = '$code' and fs.fs_id = fd_gra.fs_id  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Field&Gravity&$code&$temp[1]&$temp[2];";
                    }
                    // fd_mag
                    $value = mysql_query("select fd_mag_id from fs , fd_mag where fs.fs_code = '$code' and fs.fs_id = fd_mag.fs_id  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Field&MagneticFields&$code&$temp[1]&$temp[2];";
                    }
                    // fd_mgv
                    $value = mysql_query("select fd_mgv_id from fs , fd_gra where fs.fs_code = '$code' and fs.fs_id = fd_mgv.fs_id  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Field&MagneticVector&$code&$temp[1]&$temp[2]&Dec;";
                        echo "Field&MagneticVector&$code&$temp[1]&$temp[2]&Incl;";
                    }
                }
                break;
            case 'gas':
                $stations = mysql_query("(select  c.gs_code,c.gs_lat,c.gs_lon FROM cn a, gs c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.gs_code,c.gs_lat,c.gs_lon FROM jj_volnet a, gs c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.gs_lat, 2) + power(d.vd_inf_slon - c.gs_lon, 2))*100)<20 ORDER BY c.gs_code)") or die(mysql_error());
                while ($temp = mysql_fetch_array($stations)) {
                    $code = $temp[0];
                    // gd
                    $value = mysql_query("select gd_id from gs , gd where gs.gs_code = '$code' and gs.gs_id = gd.gs_id  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Gas&SampledGas&$code&$temp[1]&$temp[2];";
                    }
                    // gd_plu
                    $value = mysql_query("select gd_plu_id from gs , gd_plu where gs.gs_code = '$code' and gs.gs_id = gd_plu.gs_id  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Gas&Plume&$code&$temp[1]&$temp[2];";
                    }
                    // gd_sol
                    $value = mysql_query("select gd_sol_id from gs , gd_sol where gs.gs_code = '$code' and gs.gs_id = gd_sol.gs_id  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Gas&SoilEfflux&$code&$temp[1]&$temp[2];";
                    }
                }
                break;
            case 'hydrologic':
                $stations = mysql_query("(select  c.hs_code,c.hs_lat,c.hs_lon FROM cn a, hs c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.hs_code,c.hs_lat,c.hs_lon FROM jj_volnet a, hs c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.hs_lat, 2) + power(d.vd_inf_slon - c.hs_lon, 2))*100)<30 ORDER BY c.hs_code)") or die(mysql_error());
                while ($temp = mysql_fetch_array($stations)) {
                    $code = $temp[0];
                    // hd
                    $value = mysql_query("select hd_id from hs, hd where hs_code = '$code' and hs.hs_id = hd.hs_id  limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Hydrologic&Data&$code&$temp[1]&$temp[2]&Welev;";
                        echo "Hydrologic&Data&$code&$temp[1]&$temp[2]&Temp;";
                        echo "Hydrologic&Data&$code&$temp[1]&$temp[2]&Wdepth;";
                        echo "Hydrologic&Data&$code&$temp[1]&$temp[2]&Bp;";
                        echo "Hydrologic&Data&$code&$temp[1]&$temp[2]&Dwlev;";
                        echo "Hydrologic&Data&$code&$temp[1]&$temp[2]&Sdisc;";
                        echo "Hydrologic&Data&$code&$temp[1]&$temp[2]&Prec;";
                        echo "Hydrologic&Data&$code&$temp[1]&$temp[2]&Cond;";
                        echo "Hydrologic&Data&$code&$temp[1]&$temp[2]&Comp;";
                    }
                }
                break;
            case 'thermal':
                $stations = mysql_query("(select  c.ts_code,c.ts_lat,c.ts_lon FROM cn a, ts c where a.vd_id = '$volcanoId' and a.cn_id = c.cn_id) UNION (select c.ts_code,c.ts_lat,c.ts_lon FROM jj_volnet a, ts c,vd_inf d WHERE a.vd_id = '$volcanoId' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.ts_lat, 2) + power(d.vd_inf_slon - c.ts_lon, 2))*100)<20 ORDER BY c.ts_code)") or die(mysql_error());
                while ($temp = mysql_fetch_array($stations)) {
                    $code = $temp[0];
                    // td
                    $value = mysql_query("select td_id from ts,td where ts_code = '$code' and ts.ts_id = td.ts_id limit 0 , 1");
                    if ($value && mysql_num_rows($value)) {
                        echo "Thermal&Data&$code&$temp[1]&$temp[2];";
                    }
                }
                break;
        }
    }


    /*
     * Get station data
     */

    public function getStationData($type, $table, $code, $component, $referenceTime) {
        $data = '';
        $result = '';
        $array = '';
        switch ($type) {
            case 'seismic':
                switch ($table) {
                    case 'Interval':
                        $result = mysql_query("select b.sd_ivl_stime, b.sd_ivl_nrec from ss a, sd_ivl b where a.ss_code = '$code' and a.ss_id = b.ss_id order by b.sd_ivl_stime desc");
                        break;
                    case 'RSAM':
                        $result = mysql_query("select sd_rsm.sd_rsm_stime, sd_rsm.sd_rsm_count from sd_rsm,sd_sam,ss where ss.ss_code = '$code' and sd_sam.ss_id = ss.ss_id and sd_sam.sd_sam_id = sd_rsm.sd_sam_id order by sd_rsm.sd_rsm_stime desc");
                        break;
                }
                break;
            case 'deformation':
                switch ($table) {
                    case 'ElectronicTilt':
                        if ($referenceTime != 0) {
                            $referenceTime = $referenceTime / 1000;
                            if ($component == "Tilt1") {
                                mysql_query("set time_zome = 'UTC';");
//                            $result = mysql_query("select b.dd_tlt_time,b.dd_tlt1 from ds a, dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_tlt_time desc");
                                $result = mysql_query("select b.dd_tlt_time as dd_tlt_time,b.dd_tlt1 as dd_tlt1 from
ds a, dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id and ($referenceTime - UNIX_TIMESTAMP(b.dd_tlt_time)) mod 43200 < 600 order by b.dd_tlt_time desc;");
                            } else if ($component == "Tilt2") {
                                mysql_query("set time_zome = 'UTC';");
//                            $result = mysql_query("select b.dd_tlt_time,b.dd_tlt2 from ds a, dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_tlt_time desc");
                                $result = mysql_query("select b.dd_tlt_time as dd_tlt_time,b.dd_tlt2 as dd_tlt2 from
ds a, dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id and ($referenceTime - UNIX_TIMESTAMP(b.dd_tlt_time)) mod 43200 < 600 order by b.dd_tlt_time desc;");
                            }
                        } else {
                            if ($component == "Tilt1") {
//                            $result = mysql_query("select b.dd_tlt_time,b.dd_tlt1 from ds a, dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_tlt_time desc");
                                $result = mysql_query("select b.dd_tlt_time as dd_tlt_time,b.dd_tlt1 as dd_tlt1 from
ds a, dd_tlt b,(select UNIX_TIMESTAMP(b.dd_tlt_time) as max from ds a , dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id limit 1) as c
where a.ds_code = '$code' and a.ds_id = b.ds_id and (c.max - UNIX_TIMESTAMP(b.dd_tlt_time)) mod 43200 < 600 order by b.dd_tlt_time desc");
                            } else if ($component == "Tilt2") {
//                            $result = mysql_query("select b.dd_tlt_time,b.dd_tlt2 from ds a, dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_tlt_time desc");
                                $result = mysql_query("select b.dd_tlt_time as dd_tlt_time,b.dd_tlt2 as dd_tlt2 from
ds a, dd_tlt b,(select UNIX_TIMESTAMP(b.dd_tlt_time) as max from ds a , dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id limit 1) as c
where a.ds_code = '$code' and a.ds_id = b.ds_id and (c.max - UNIX_TIMESTAMP(b.dd_tlt_time)) mod 43200 < 600 order by b.dd_tlt_time desc");
                            }
                        }
                        break;
                    case 'TiltVector':
                        $result = mysql_query("select b.dd_tlv_stime, b.dd_tlv_mag from ds a, dd_tlv b where a.ds_code = '$code' and a.ds_id = b.ds_id order by dd_tlv_stime desc");
                        break;
                    case 'Strain':
                        switch ($component) {
                            case 'Comp1':
                                $result = mysql_query("select b.dd_str_time, b.dd_str_comp1 from ds a, dd_str b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_str_time desc");
                                break;
                            case 'Comp2':
                                $result = mysql_query("select b.dd_str_time, b.dd_str_comp2 from ds a, dd_str b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_str_time desc");
                                break;
                            case 'Comp3':
                                $result = mysql_query("select b.dd_str_time, b.dd_str_comp3 from ds a, dd_str b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_str_time desc");
                                break;
                            case 'Comp4':
                                $result = mysql_query("select b.dd_str_time, b.dd_str_comp4 from ds a, dd_str b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_str_time desc");
                                break;
                            case 'Vdstr':
                                $result = mysql_query("select b.dd_str_time, b.dd_str_vdstr from ds a, dd_str b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_str_time desc");
                                break;
                            case 'Ax1':
                                $result = mysql_query("select b.dd_str_time, b.dd_sstr_ax1 from ds a, dd_str b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_str_time desc");
                                break;
                            case 'Ax2':
                                $result = mysql_query("select b.dd_str_time, b.dd_sstr_ax2 from ds a, dd_str b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_str_time desc");
                                break;
                            case 'Ax3':
                                $result = mysql_query("select b.dd_str_time, b.dd_sstr_ax3 from ds a, dd_str b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_str_time desc");
                                break;
                        }
                        break;
                    case 'EDM':
                        $result = mysql_query("select b.dd_edm_time, b.dd_edm_line from ds a, dd_edm b where a.ds_code = '$code' and b.ds_id = a.ds_id order by b.dd_edm_time desc");
                        break;
                    case 'Angle':
                        switch ($component) {
                            case 'Hort1':
                                $result = mysql_query("select b.dd_ang_time, b.dd_ang_hort1 form ds a, dd_ang b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_ang_time desc");
                                break;
                            case 'Hort2':
                                $result = mysql_query("select b.dd_ang_time, b.dd_ang_hort2 form ds a, dd_ang b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_ang_time desc");
                                break;
                            case 'Vert1':
                                $result = mysql_query("select b.dd_ang_time, b.dd_ang_vert1 form ds a, dd_ang b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_ang_time desc");
                                break;
                            case 'Vert2':
                                $result = mysql_query("select b.dd_ang_time, b.dd_ang_vert2 form ds a, dd_ang b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_ang_time desc");
                                break;
                        }
                        break;
                    case 'GPS':
                        switch ($component) {
                            case 'Lat':
                                $result = mysql_query("select b.dd_gps_stime, b.dd_gps_lat form ds a, dd_gps b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_gps_stime desc");
                                break;
                            case 'Lon':
                                $result = mysql_query("select b.dd_gps_stime, b.dd_gps_lon form ds a, dd_gps b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_gps_stime desc");
                                break;
                            case 'Elev':
                                $result = mysql_query("select b.dd_gps_stime, b.dd_gps_elev form ds a, dd_gps b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_gps_stime desc");
                                break;
                        }
                        break;
                    case 'GPSVector':
                        if ($component == "NS")
                            $result = mysql_query("select b.dd_gpv_stime, b.dd_gpv_N from ds a, dd_gpv b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_gpv_stime desc");
                        else if ($component == "EW")
                            $result = mysql_query("select b.dd_gpv_stime, b.dd_gpv_E from ds a, dd_gpv b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_gpv_stime desc");
                        else if ($component == "Z")
                            $result = mysql_query("select b.dd_gpv_stime, b.dd_gpv_vert from ds a, dd_gpv b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_gpv_stime desc");
                        break;
                    case 'Leveling':
                        $result = mysql_query("select b.dd_lev_stime, b.dd_lev_dlev from ds a, dd_lev where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_lev_stime desc");
                        break;
                }
                break;
            case 'field':
                switch ($table) {
                    case 'ElectricFields':
                        $result = mysql_query("select b.fd_ele_time, b.fd_ele_field from fs a, fd_ele b  where a.fs_code = '$code' and a.fs_code = b.fs_code order by b.fd_ele_time desc");
                        break;
                    case 'Gravity':
                        $result = mysql_query("select b.fd_gra_time, b.fd_gra_fstr from fs a, fd_gra b where a.fs_code = '$code' and a.fs_code = b.fs_code order by b.fd_gra_time desc");
                        break;
                    case 'MagneticFields':
                        $result = mysql_query("select b.fd_mag_time, b.fd_mag_f from fs a, fd_mag b where a.fs_code = '$code' and a.fs_code = b.fs_code order by b.fd_mag_time desc");
                        break;
                    case 'MagneticVector':
                        if ($component == "Dec")
                            $result = mysql_query("select b.fd_mgv_time, b.fd_mgv_dec from fs a, fd_mgv b where a.fs_code = '$code' and a.fs_code = b.fs_code order by b.fd_mgv_time desc");
                        else if ($component == "Incl")
                            $result = mysql_query("select b.fd_mgv_time, b.fd_mgv_incl from fs a, fd_mgv b where a.fs_code = '$code' and a.fs_code = b.fs_code order by b.fd_mgv_time desc");

                        break;
                }
                break;
            case 'gas':
                switch ($table) {
                    case 'SampledGas':
                        $result = mysql_query("select b.gd_time, b.gd_concentration from gs a, gd b where a.gs_code ='$code' and b.gs_id = a.gs_id order by b.gd_time desc");
                        break;
                    case 'Plume':
                        $result = mysql_query("select b.gd_plu_time, b.gd_plu_emit  from gs a, gd_plu b where a.gs_code ='$code' and b.gs_id = a.gs_id order by b.gd_plu_time desc");
                        break;
                    case 'SoilEfflux':
                        $result = mysql_query("select b.gd_sol_time, b.gd_sol_tfulx from gs a, gd_sol b where a.gs_code ='$code' and b.gs_id = a.gs_id order by b.gd_sol_time desc");
                        break;
                }
                break;
            case 'hydrologic':
                switch ($component) {
                    case 'Welev':
                        $result = mysql_query("select b.hd_time, b.hd_welev from hs a, hd b where a.hs_code = '$code' and a.hs_id = b.hs_id order by b.hd_time desc");
                        break;
                    case 'Temp':
                        $result = mysql_query("select b.hd_time, b.hd_temp from hs a, hd b where a.hs_code = '$code' and a.hs_id = b.hs_id order by b.hd_time desc");
                        break;
                    case 'Wdepth':
                        $result = mysql_query("select b.hd_time, b.hd_wdepth from hs a, hd b where a.hs_code = '$code' and a.hs_id = b.hs_id order by b.hd_time desc");
                        break;
                    case 'Bp':
                        $result = mysql_query("select b.hd_time, b.hd_bp from hs a, hd b where a.hs_code = '$code' and a.hs_id = b.hs_id order by b.hd_time desc");
                        break;
                    case 'Dwlev':
                        $result = mysql_query("select b.hd_time, b.hd_dwlev from hs a, hd b where a.hs_code = '$code' and a.hs_id = b.hs_id order by b.hd_time desc");
                        break;
                    case 'Sdisc':
                        $result = mysql_query("select b.hd_time, b.hd_sdisc from hs a, hd b where a.hs_code = '$code' and a.hs_id = b.hs_id order by b.hd_time desc");
                        break;
                    case 'Prec':
                        $result = mysql_query("select b.hd_time, b.hd_Prec from hs a, hd b where a.hs_code = '$code' and a.hs_id = b.hs_id order by b.hd_time desc");
                        break;
                    case 'Cond':
                        $result = mysql_query("select b.hd_time, b.hd_cond from hs a, hd b where a.hs_code = '$code' and a.hs_id = b.hs_id order by b.hd_time desc");
                        break;
                    case 'Comp':
                        $result = mysql_query("select b.hd_time, b.hd_comp_content from hs a, hd b where a.hs_code = '$code' and a.hs_id = b.hs_id order by b.hd_time desc");
                        break;
                }
                break;
            case 'thermal':
                $result = mysql_query("select b.td_time, b.td_temp from ts a , td b where a.ts_code = '$code' and a.ts_id = b.ts_id order by b.td_time desc");
                break;
            default:
                throw new Exception('Not relevant data');
                break;
        }
        date_default_timezone_set("UTC");
        $numberOfRows = mysql_num_rows($result);
        if ($numberOfRows > 50000) {
            // 12 hours ranges
            $this->filterData($result, 3600 * 12);
        } else {
            $data = Array();
            $data[0] = Array();
            $count = 0;
            if ($result == false)
                return;
            while ($array = mysql_fetch_array($result, MYSQL_NUM)) {
                $data[0][$count++] = Array(1000 * strtotime($array[0]), floatval($array[1]));
            }
            echo json_encode($data);
        }
    }

    public function getFullStationData($type, $table, $code, $component) {
        $data = '';
        $result = '';
        $array = '';
        switch ($type) {
            case 'deformation':
                switch ($table) {
                    case 'ElectronicTilt':
                        if ($component == "Tilt1")
                            $result = mysql_query("select b.dd_tlt_time,b.dd_tlt1 from ds a, dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_tlt_time desc");
                        else if ($component == "Tilt2")
                            $result = mysql_query("select b.dd_tlt_time,b.dd_tlt2 from ds a, dd_tlt b where a.ds_code = '$code' and a.ds_id = b.ds_id order by b.dd_tlt_time desc");
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
        $data = Array();
        $data[0] = Array();
        $count = 0;

        if ($result == false) {
            return;
        }
        while ($array = mysql_fetch_array($result, MYSQL_NUM)) {
            $data[0][$count++] = Array(1000 * strtotime($array[0]), floatval($array[1]));
        }
        echo json_encode($data);
    }

    public function getEarthquakes($qty, $cavw, $lat, $lon, $elev) {
        $quakeQuery = "(select sd_evn_elat, sd_evn_elon, sd_evn_edep, sd_evn_pmag, sd_evn_time, sd_evn_eqtype, sn_id FROM sd_evn WHERE ABS($lat - sd_evn_elat)<1 and ABS($lon - sd_evn_elon)<6 and sqrt(pow(($lat - sd_evn_elat)*110, 2) + pow(($lon - sd_evn_elon)*111.32*cos($lat/57.32), 2))<30 order by sd_evn_pmag desc LIMIT $qty)";
        $getQuakes = mysql_query($quakeQuery) or die(mysql_error());
        $count = 0;
        while ($row = mysql_fetch_array($getQuakes)) {
            echo $row['sd_evn_elat'] . "," . $row['sd_evn_elon'] . "," . $row['sd_evn_edep'] . "," . $row['sd_evn_pmag'] . "," . $row['sd_evn_time'] . "," . $row['sd_evn_eqtype'] . "," . $row['sn_id'] . ";";
            $count++;
        }
    }

    private function filterData1($resource, $seconds) {
        $array = mysql_fetch_array($resource);
        $value1 = strtotime($array[0]);
        $array = mysql_fetch_array($resource);
        $value2 = strtotime($array[0]);
        $range = $value1 - $value2;
        $jump = $seconds / $range;
        $data = Array();
        $data[0] = Array();
        $count = 0;
        $data[0][$count++] = array($value2 * 1000, floatval($array[1]));
        $i = 1;
        while ($array = mysql_fetch_array($resource)) {
            if ($i++ < $jump)
                continue; else
                $i = 1;
            $data[0][$count++] = array(strtotime($array[0]) * 1000, floatval($array[1]));
        }
        echo json_encode($data);
    }

    private

    function filterData($resource, $seconds) {
        if ($resource == false)
            return;
        $milliseconds = $seconds * 1000;
        $nextValue = '';
        $current;
        $data = Array();
        $data[0] = Array();
        $array = mysql_fetch_array($resource);
        $data[0][0] = array(1000 * strtotime($array[0]), floatval($array[1]));
        $nextValue = $data[0][0][0] - $milliseconds;
        $count = 1;
        while ($array = mysql_fetch_array($resource)) {
            $current = 1000 * strtotime($array[0]);
            if ($current <= $nextValue) {
                $nextValue = $current - $milliseconds;
                $data[0][$count++] = array($current, floatval($array[1]));
            }
        }

        echo json_encode($data);
    }
		/* Get list of neighbor of a volcano
	*Author: Tran Thien Nam
	*2012-07-26
	*/
	public function getNeighbors($cavw){
		mysql_query("set character_set_results='utf8'");
		//get lat,lon of the volcano
		$query0 = "select vd_inf_slat, vd_inf_slon from vd_inf where vd_inf_cavw='".$cavw."'";
		$result0 = mysql_query($query0) or die("Cannot connect to server");
		if ($result0!==false){
			$row0 = mysql_fetch_array($result0);
			$volcLat = $row0[0];
			$volcLon = $row0[1];
			$query = "select a.vd_cavw, a.vd_name, b.vd_inf_slat, b.vd_inf_slon from vd a, vd_inf b where SUBSTR(a.vd_name,1,7)!='Unnamed' and a.vd_cavw!='$cavw' and a.vd_id = b.vd_id order by sqrt(pow(($volcLat - b.vd_inf_slat)*110, 2) + pow(($volcLon - b.vd_inf_slon)*111.32*cos($volcLat/57.32), 2)) limit 15";
			// echo $query."\r\n"."aaa";
			$result = mysql_query($query) or die("Cannot connect to server");
			while (($row = mysql_fetch_array($result))!==FALSE){
				echo $row[0].";".$row[1].";".$row[2].";".$row[3]."&";
			}
		}
		else
			echo "";
	}

}

class Station {

    var $stationName;
    var $lat;
    var $lon;
    var $type;

    function Station($name, $plat, $plon, $ptype) {
        $this->stationName = $name;
        $this->lat = $plat;
        $this->lon = $plon;
        $this->type = $ptype;
    }

    function outputInfo() {
        return $this->type . "& &" . $this->stationName . "&" . $this->lat . "&" . $this->lon . "& ;";
    }

}

?>