<?php
class Downloader{
    public function download($link){
        if($link == "")
            throw new Exception("Download link is empty");
        if(!is_string($link))
            throw new Exception("Download link is not a string");
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($link));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($link));
        ob_clean();
        flush();
        readfile($link);
    }
}
?>