<?php
// Lightweight XLSX writer inspired by mk-j/php_xlsxwriter (MIT) - trimmed for simple string cells only
// Supports one or more sheets, string cells, no styles. Good enough for sample files.
if (!class_exists('UM_XLSXWriter')) {
class UM_XLSXWriter {
    private $sheets = array();
    public function addSheet($rows, $name = 'Sheet1') { $this->sheets[] = array('name'=>$name,'rows'=>$rows); }
    public function download($filename = 'sample.xlsx') { $this->save('php://output', $filename, true); }
    public function save($path, $downloadName = null, $isDownload = false) {
        $zip = new ZipArchive();
        $tmp = tempnam(sys_get_temp_dir(), 'xlsx');
        if ($tmp === false) {
            die('خطا در ایجاد فایل موقت');
        }
        $result = $zip->open($tmp, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        if ($result !== true) {
            die('خطا در باز کردن فایل ZIP: ' . $result);
        }
        // Content types
        $ct = '<?xml version="1.0" encoding="UTF-8"?>'
            .'<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            .'<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            .'<Default Extension="xml" ContentType="application/xml"/>'
            .'<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
            .self::ctSheets($this->sheets)
            .'<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
            .'<Override PartName="/docProps/app.xml" ContentType="application/vnd.openxmlformats-officedocument.extended-properties+xml"/>'
            .'<Override PartName="/docProps/core.xml" ContentType="application/vnd.openxmlformats-package.core-properties+xml"/>'
            .'</Types>';
        $zip->addFromString('[Content_Types].xml', $ct);
        // relationships
        $rels = '<?xml version="1.0" encoding="UTF-8"?>'
            .'<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            .'<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
            .'<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/>'
            .'</Relationships>';
        $zip->addFromString('_rels/.rels', $rels);
        // docProps
        $zip->addFromString('docProps/app.xml', '<?xml version="1.0" encoding="UTF-8"?><Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties" xmlns:vt="http://schemas.openxmlformats.org/officeDocument/2006/docPropsVTypes"><Application>UM_XLSXWriter</Application></Properties>');
        $zip->addFromString('docProps/core.xml', '<?xml version="1.0" encoding="UTF-8"?><cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><dc:creator>UM_XLSXWriter</dc:creator><cp:lastModifiedBy>UM_XLSXWriter</cp:lastModifiedBy><dcterms:created xsi:type="dcterms:W3CDTF">'.gmdate('Y-m-d\TH:i:s\Z').'</dcterms:created><dcterms:modified xsi:type="dcterms:W3CDTF">'.gmdate('Y-m-d\TH:i:s\Z').'</dcterms:modified></cp:coreProperties>');
        // workbook
        $wb = '<?xml version="1.0" encoding="UTF-8"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><bookViews><workbookView/></bookViews><sheets>'.self::wbSheets($this->sheets).'</sheets></workbook>';
        $zip->addFromString('xl/workbook.xml', $wb);
        // workbook relationships - باید sharedStrings را هم شامل شود
        $workbook_rels = '<?xml version="1.0" encoding="UTF-8"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'.self::relsSheets($this->sheets).'<Relationship Id="rId999" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/><Relationship Id="rId998" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/sharedStrings" Target="sharedStrings.xml"/></Relationships>';
        $zip->addFromString('xl/_rels/workbook.xml.rels', $workbook_rels);
        // styles basic
        $zip->addFromString('xl/styles.xml', '<?xml version="1.0" encoding="UTF-8"?><styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><fonts count="1"><font><sz val="11"/><name val="Calibri"/></font></fonts><fills count="1"><fill><patternFill patternType="none"/></fill></fills><borders count="1"><border/></borders><cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs><cellXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/></cellXfs></styleSheet>');
        // shared strings - باید قبل از ساخت sheet XML ها ساخته شود
        list($sst, $si_count, $shared_map) = self::buildSharedStrings($this->sheets);
        // sharedStrings.xml همیشه باید اضافه شود حتی اگر خالی باشد
        if (empty($sst)) {
            $sst = '<?xml version="1.0" encoding="UTF-8"?><sst xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" count="0" uniqueCount="0"></sst>';
        }
        $zip->addFromString('xl/sharedStrings.xml', $sst);
        
        // sheets - استفاده از map ساخته شده
        $i=1; 
        foreach ($this->sheets as $sheet) {
            if (!isset($sheet['rows']) || !is_array($sheet['rows'])) {
                $sheet['rows'] = array();
            }
            $sheetXml = self::sheetXml($sheet['rows'], $shared_map);
            $zip->addFromString('xl/worksheets/sheet'.$i.'.xml', $sheetXml);
            $i++; 
        }
        $close_result = $zip->close();
        if ($close_result !== true) {
            @unlink($tmp);
            die('خطا در بستن فایل ZIP: ' . $close_result);
        }
        if ($isDownload) {
            if (!headers_sent()) {
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="'.($downloadName ?: 'sample.xlsx').'"');
                header('Pragma: public'); header('Cache-Control: max-age=0');
            }
            readfile($tmp); @unlink($tmp); exit;
        } else { 
            if (file_exists($tmp)) {
                if (copy($tmp, $path)) {
                    @unlink($tmp);
                } else {
                    @unlink($tmp);
                    die('خطا در کپی فایل به مسیر نهایی');
                }
            } else {
                die('فایل موقت ایجاد نشد');
            }
        }
    }
    private static function esc($v){ return htmlspecialchars($v, ENT_QUOTES|ENT_XML1, 'UTF-8'); }
    private static function col2name($i){ $s=''; while($i>0){ $m=($i-1)%26; $s=chr(65+$m).$s; $i=intval(($i-$m)/26);} return $s; }
    private static function wbSheets($sheets){ $i=''; $n=1; foreach($sheets as $s){ $i.='<sheet name="'.self::esc($s['name']).'" sheetId="'.$n.'" r:id="rId'.$n.'"/>'; $n++; } return $i; }
    private static function relsSheets($sheets){ $i=''; $n=1; foreach($sheets as $s){ $i.='<Relationship Id="rId'.$n.'" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet'.$n.'.xml"/>'; $n++; } return $i; }
    private static function ctSheets($sheets){ $i=''; for($n=1;$n<=count($sheets);$n++){ $i.='<Override PartName="/xl/worksheets/sheet'.$n.'.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'; } if (count($sheets)>0) $i.='<Override PartName="/xl/sharedStrings.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sharedStrings+xml"/>'; return $i; }
    private static function buildSharedStrings($sheets){
        $map = array(); $list = array(); $count = 0;
        foreach ($sheets as $sheet) {
            if (!isset($sheet['rows']) || !is_array($sheet['rows'])) {
                continue;
            }
            foreach ($sheet['rows'] as $row) {
                if (!is_array($row)) {
                    continue;
                }
                foreach ($row as $cell) {
                    $val = (string)$cell; 
                    if (!isset($map[$val])) { 
                        $map[$val] = count($list); 
                        $list[] = $val; 
                    }
                    $count++;
                }
            }
        }
        if (empty($list)) {
            return array('', 0, array());
        }
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'
             .'<sst xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" count="'.$count.'" uniqueCount="'.count($list).'">';
        foreach ($list as $s) { 
            $xml .= '<si><t>'.self::esc($s).'</t></si>'; 
        }
        $xml .= '</sst>';
        return array($xml, $count, $map);
    }
    
    private static function sheetXml($rows, $shared_map = array()){
        if (!is_array($rows) || empty($rows)) {
            return '<?xml version="1.0" encoding="UTF-8"?><worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><sheetData></sheetData></worksheet>';
        }
        $r = array(); 
        $r[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $r[] = '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><sheetData>';
        $rowNum = 1; 
        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }
            $r[] = '<row r="'.$rowNum.'">'; 
            $col = 0; 
            foreach ($row as $cell) {
                $col++; 
                $cellVal = (string)$cell;
                $v = isset($shared_map[$cellVal]) ? $shared_map[$cellVal] : 0; 
                $r[] = '<c r="'.self::col2name($col).$rowNum.'" t="s"><v>'.$v.'</v></c>'; 
            } 
            $r[] = '</row>'; 
            $rowNum++; 
        }
        $r[] = '</sheetData></worksheet>'; 
        return implode('', $r);
    }
}
}
?>


