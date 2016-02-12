<?php
set_time_limit (2000);
$username=urlencode($_POST['username']);
$password=urlencode($_POST['password']);

if ($handle = opendir('.')) {
	while (false !== ($file = readdir($handle)))
    {
        if ($file !== "." && $file !== ".." && strpos($file,".xml")!==false)
		{
			
			$filetype="wovoml";
			$obs_id="";
			$n_list="0";
			$another_pub="no";
			$post_data=array('uname'=>"$username",
							 'password'=>"$password",
							 'login_submit'=>"Log In",
							 'filetype'=>"wovoml");
			$cookie="./cookie.txt";
			$header[0] = 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8)';
			$header[1] = 'Accept-Charset:UTF-8,*';
			$header[2] = 'Accept-Encoding:gzip, deflate';
			$header[3] = 'Accept-Language:en-us,en;q=0.5';
			$header[4] = 'Connection:keep-alive';
			$header[5] = 'DNT:1';
			$header[6] = 'Host:www.wovodat.org';
			$header[7] = 'Referer:http://www.wovodat.org/populate/login_required.php';
			$header[8] = 'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64; rv:8.0) Gecko/20100101 Firefox/8.0';
			$viewstate="...";
			//$postdata="&uname=$username&password=$password&btnSubmit=Login";
			$postdata="&uname=$username&password=$password&filetype=wovoml";
			$ch = curl_init();

			// Now try the login
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_URL,"http://wovodat.org/populate/home_populate.php?type=wovoml");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($ch, CURLOPT_HEADER, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:8.0) Gecko/20100101 Firefox/8.0");
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_COOKIESESSION, true);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
			curl_setopt($ch, CURLOPT_COOKIEFILE, '');
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			$result = curl_exec($ch);
			
			//post file to upload_file_check.php
			$header2[0] = 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
			$header2[1] = 'Accept-Charset:UTF-8,*';
			$header2[2] = 'Accept-Encoding:gzip, deflate';
			$header2[3] = 'Accept-Language:en-us,en;q=0.5';
			$header2[4] = 'Connection:keep-alive';
			$header2[5] = 'DNT:1';
			$header2[6] = 'Host:www.wovodat.org';
			$header2[7] = 'Referer:http://www.wovodat.org/populate/home_populate.php';
			$header2[8] = 'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64; rv:8.0) Gecko/20100101 Firefox/8.0';
			$file_type = "wovoml";
			$fileDir = getcwd();
			if (strpos($fileDir,"\\")!==FALSE)
				$connector = "\\";
			else
				$connector = "/";
			$file_path = getcwd().$connector.$file;
			echo "file path:". $file_path. "<br/>";
			echo "---------------------------------------------------------------------------------"."<br/>";
			$postdata2= array('file_type'=>"wovoml",
							 'obs_id'=>"",
							 'n_list'=>"0",
							 'another_pub'=>"no",
							 'auth_input'=>"",
							 'title_input'=>"",
							 'year_input'=>"",
							 'journ_input'=>"",
							 'vol_input'=>"",
							 'pub_input'=>"",
							 'page_input'=>"",
							 'doi_input'=>"",
							 'isbn_input'=>"",
							 'url_input'=>"",
							 'labadr_input'=>"",
							 'keywords_input'=>"",
							 'upload_file_inputfile'=>"@$file_path",
							 'upload_file_ok'=>"OK");
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_URL, "http://wovodat.org/populate/upload_file_check.php");
			curl_setopt($ch, CURLOPT_HEADER, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header2);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata2);

			$result = curl_exec ($ch);
			//confirm the upload
			$header3[0] = 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
			$header3[1] = 'Accept-Charset:UTF-8,*';
			$header3[2] = 'Accept-Encoding:gzip, deflate';
			$header3[3] = 'Accept-Language:en-us,en;q=0.5';
			$header3[4] = 'Connection:keep-alive';
			$header3[5] = 'DNT:1';
			$header3[6] = 'Host:www.wovodat.org';
			$header3[7] = 'Referer:http://www.wovodat.org/populate/home_populate.php';
			$header3[8] = 'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64; rv:8.0) Gecko/20100101 Firefox/8.0';

			$postdata3= array('confirm_file_upload'=>"Confirm");
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_URL, "http://wovodat.org/populate/upload_file_upload.php");
			//curl_setopt($ch, CURLOPT_HEADER, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header3);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata3);

			$result = curl_exec ($ch);
			print $result;
        }
    }
  closedir($handle);
}

curl_close($ch);

exit;

?>
