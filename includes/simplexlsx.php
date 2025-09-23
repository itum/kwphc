<?php
// Minimal embedded SimpleXLSX reader (MIT) for reading .xlsx without composer
// Source: https://github.com/shuchkin/simplexlsx (trimmed to a minimal reader)
if (!class_exists('SimpleXLSX')) {
class SimpleXLSX {
    private $sheets = array();
    public $rows = array();
    public static function parseData($data){ $x = new self(); return $x->parseBinary($data) ? $x : false; }
    public static function parse($filename){ $x = new self(); return $x->parseBinary(file_get_contents($filename)) ? $x : false; }
    public function rows($sheetIndex = 0){ return isset($this->rows[$sheetIndex]) ? $this->rows[$sheetIndex] : array(); }
    private function parseBinary($data){
        $tmp = tempnam(sys_get_temp_dir(), 'xlsx'); file_put_contents($tmp, $data);
        $zip = new ZipArchive(); if ($zip->open($tmp)!==true) return false;
        $sharedStrings = array();
        if (($xml = $zip->getFromName('xl/sharedStrings.xml')) !== false){
            preg_match_all('/<si(?:[^>]*)>\s*<t[^>]*>(.*?)<\/t>\s*<\/si>/s', $xml, $m);
            $sharedStrings = array_map(function($v){ return self::xml2str($v); }, $m[1]);
        }
        $sheetNum = 0;
        while (($xml = $zip->getFromName('xl/worksheets/sheet'.($sheetNum+1).'.xml')) !== false){
            $rows = array();
            if (preg_match_all('/<row[^>]*>(.*?)<\/row>/s', $xml, $rm)){
                foreach ($rm[1] as $rxml){
                    $row = array();
                    if (preg_match_all('/<c[^>]*?(?:t="(\w+)")?[^>]*>\s*(?:<v>(.*?)<\/v>|<is>\s*<t[^>]*>(.*?)<\/t>\s*<\/is>)?\s*<\/c>/s', $rxml, $cm, PREG_SET_ORDER)){
                        foreach ($cm as $c){
                            $t = isset($c[1]) ? $c[1] : '';
                            $v = isset($c[2]) && $c[2]!=='' ? $c[2] : (isset($c[3]) ? self::xml2str($c[3]) : '');
                            if ($t==='s' && $v!=='') { $v = isset($sharedStrings[(int)$v]) ? $sharedStrings[(int)$v] : $v; }
                            $row[] = $v;
                        }
                    }
                    $rows[] = $row;
                }
            }
            $this->rows[$sheetNum] = $rows; $sheetNum++;
        }
        $zip->close(); @unlink($tmp); return true;
    }
    private static function xml2str($s){ return html_entity_decode(strip_tags($s), ENT_QUOTES|ENT_XML1, 'UTF-8'); }
}
}
?>


