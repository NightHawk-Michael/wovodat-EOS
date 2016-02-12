<?php
function woml2hydroruapehuserial($arry){
	foreach ($arry as $k => $v){ // $k wovoml
		if(is_array($v)){
			foreach ($v as $k1 => $v1){ //Data
				if(is_array($v1) && $k1=="Data"){
					foreach ($v1 as $k2 => $v2){ //Hydrologic
						if(is_array($v2)){
							foreach ($v2 as $k3 => $v3){ //Sample
								if(is_array($v3)){
									$kso=0;$kcl=0;$kmg=0;$kca=0;$kfe=0;$kna=0;$kkk=0;$kf=0;
									foreach ($v3 as $k4 => $v4){ //Seq.Number
										if(is_array($v4)){
											$kk=$k4*2;
											$kk1=$k4*2+1;
											$qq=0;$qq1=0;

				$s=$arry[$k][$k1][$k2][$k3][$k4]["species"];
				$content=$arry[$k][$k1][$k2][$k3][$k4]["content"];
				$datime=$arry[$k][$k1][$k2][$k3][$k4]["measTime"];
				$tmw=datetimeToUnix($datime);
				if($kk==0) $tmwfirst=$tmw;
				$tmw=$tmw-$tmwfirst;

				$dataflot[0][0]="SO4";
				$dataflot[1][0]="Cl";
				$dataflot[2][0]="Fe";
				$dataflot[3][0]="K";
				$dataflot[4][0]="Na";
				$dataflot[5][0]="F";
				if($s=="SO4-"){   // then kso=seq. numb w/ incree "2" => 0, 2, 4, 6, etc
					$s="SO4";$sk=0; // qq=1,3,5,7,etc    $qqs=0,1,2,3,4,etc
					$qq=$kso+1;$qq1=$qq+1;$qqs=($qq-1)/2;$kso=$kso+2;
					if($contentmax[0]<=$content) $contentmax[0]=$content;
				$dataflot[$sk][$qq]=$qqs;//odd numb -> seq.
				$dataflot[$sk][$qq1]=$content; //even numb -> value
				$qq=0;$qq1=0;
				}
				if($s=="Cl-"){
					$s="Cl";$sk=1;
					$kkcl=$kcl+1;$qq=$kkcl;$qq1=$qq+1;$qqs=($qq-1)/2;$kcl=$kcl+2;
					if($contentmax[1]<=$content) $contentmax[1]=$content;
				$dataflot[$sk][$qq]=$qqs;
				$dataflot[$sk][$qq1]=$content;
				$qq=0;$qq1=0;
				}
				if($s=="Fe"){
					$sk=2;
					$kkfe=$kfe+1;$qq=$kkfe;$qq1=$qq+1;$qqs=($qq-1)/2;$kfe=$kfe+2;
					if($contentmax[2]<=$content) $contentmax[2]=$content;
				$dataflot[$sk][$qq]=$qqs;
				$dataflot[$sk][$qq1]=$content;
				$qq=0;$qq1=0;
				}
				if($s=="K"){
					$sk=3;
					$kkck=$kck+1;$qq=$kkck;$qq1=$qq+1;$qqs=($qq-1)/2;$kck=$kck+2;
					if($contentmax[3]<=$content) $contentmax[3]=$content;
				$dataflot[$sk][$qq]=$qqs;
				$dataflot[$sk][$qq1]=$content;
				$qq=0;$qq1=0;
				}
				if($s=="Na"){
					$sk=4;
					$kkna=$kna+1;$qq=$kkna;$qq1=$qq+1;$qqs=($qq-1)/2;$kna=$kna+2;
					if($contentmax[4]<=$content) $contentmax[4]=$content;
				$dataflot[$sk][$qq]=$qqs;
				$dataflot[$sk][$qq1]=$content;
				$qq=0;$qq1=0;
				}
				if($s=="F-"){
					$s="F";	$sk=5;
					$kkf=$kf+1;$qq=$kkf;$qq1=$qq+1;$qqs=($qq-1)/2;$kf=$kf+2;
					if($contentmax[5]<=$content) $contentmax[5]=$content;
				$dataflot[$sk][$qq]=$qqs;
				$dataflot[$sk][$qq1]=$content;
				$qq=0;$qq1=0;
				}
//echo "content:".$content."<br>";
//echo "speciesvalue:".$spe."<br>";
//echo "dataflotvalue:".$dataflot[$spe][$qq1]."<br>";

	}	}	}	}	}	}	}	}	}	}
	foreach($dataflot as $q => $w ){
		if(is_array($w)){
			$urut=0;
echo "contentmax:"."q:".$q."=".$contentmax[$q]."<br>";
			foreach($w as $q1 => $w1){
				if($q1!=0){
					if($q1 % 2==0){
						$dataflot[$q][$q1]=$w1/$contentmax[$q];
					}
				}
			}
		}
	}
	return $dataflot;
}

function woml2rsamserial($arry){
	echo "TRIAL 3a: ok".$fnm;
	foreach ($arry as $k => $v){ // wovoml for RSAM data
		if(is_array($v)){
			foreach ($v as $k1 => $v1){ //Data
				if(is_array($v1) && $k1=="Data"){
					foreach ($v1 as $k2 => $v2){ //Seismic
						if(is_array($v2)){
							foreach ($v2 as $k3 => $v3){ //RSAM-SSAM
								if(is_array($v3)){
									foreach ($v3 as $k4 => $v4){ //RSAM
										if(is_array($v4)){
											foreach ($v4 as $k5 => $v5){ //RSAM_Data
												if(is_array($v5)){ 
													$kk=0;
													$dataflot[0][0]="rsam";
													foreach ($v5 as $k6 => $v6){ //DataValue
														$kk=$k6*2+1;
														$kk1=$k6*2+2;
														if(is_array($v6)){	echo "TRIAL 3b: ok".$fnm;
				$tmw=datetimeToUnix($arry[$k][$k1][$k2][$k3][$k4][$k5][$k6]["startTime"]);
				if($kk==1) { $tmwfirst=$tmw;	echo "TRIAL 3c: ok".$fnm;}
				$tmw=$tmw-$tmwfirst;
				$dataflot[0][$kk]=$k6;
				$dataflot[0][$kk1]=$arry[$k][$k1][$k2][$k3][$k4][$k5][$k6]["cnt"];
				$dataflo["RSAM"][$kk-1]=$k6;
				$dataflo["RSAM"][$kk1-1]=$arry[$k][$k1][$k2][$k3][$k4][$k5][$k6]["cnt"];
	}	}	}	}	}	}	}	}	}	}	}	}	}	}
	return $dataflot;
		echo "TRIAL 3d: ok".$fnm;
}

function woml2plumeso2serial($arry){
	foreach ($arry as $k => $v){ // for PlumeSO2 data
		if(is_array($v)){
			foreach ($v as $k1 => $v1){ //Data
				if(is_array($v1) && $k1=="Data"){
					foreach ($v1 as $k2 => $v2){ //Gas
						if(is_array($v2)){
							foreach ($v2 as $k3 => $v3){ //Plume
								if(is_array($v3)){
									$dataflot[0][0]="so2";
									foreach ($v3 as $k4 => $v4){ //DataValue
										$kk=$k4*2+1;
										$kk1=$k4*2+2;
										if(is_array($v4)){
				$tmw=datetimeToUnix($arry[$k][$k1][$k2][$k3][$k4]["measTime"]);
				if($kk==1)  $tmwfirst=$tmw;
				$tmw=$tmw-$tmwfirst;
				$dataflot[0][$kk]=$k4;
				$dataflot[0][$kk1]=$arry[$k][$k1][$k2][$k3][$k4]["emissionRate"];
	}	}	}	}	}	}	}	}	}	}
	return $dataflot;
}

?>
