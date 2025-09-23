<?php
// Minimal embedded SimpleXLSXGen (MIT) for generating .xlsx without composer
// Source: https://github.com/shuchkin/simplexlsxgen (trimmed header only)
if (!class_exists('SimpleXLSXGen')) {
class SimpleXLSXGen {
    private $sheets = array();
    public static function fromArray($rows, $name = 'Sheet1') {
        $x = new self();
        $x->addSheet($rows, $name);
        return $x;
    }
    public function addSheet($rows, $name = 'Sheet1') { $this->sheets[] = array('name'=>$name, 'rows'=>$rows); return $this; }
    public function downloadAs($filename) { $this->saveAs('php://output', $filename, true); }
    public function saveAs($path, $downloadName = null, $isDownload = false) {
        $zip = new ZipArchive();
        $tmp = tempnam(sys_get_temp_dir(), 'xlsx');
        $zip->open($tmp, ZipArchive::OVERWRITE);
        // [Content_Types].xml
        $zip->addFromString('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8"?>\n<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">\n<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>\n<Default Extension="xml" ContentType="application/xml"/>\n<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>\n'.self::ctSheets($this->sheets).'<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>\n<Override PartName="/docProps/app.xml" ContentType="application/vnd.openxmlformats-officedocument.extended-properties+xml"/>\n<Override PartName="/docProps/core.xml" ContentType="application/vnd.openxmlformats-package.core-properties+xml"/>\n</Types>');
        // _rels/.rels
        $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8"?>\n<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">\n<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>\n<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/>\n</Relationships>');
        // docProps
        $zip->addFromString('docProps/app.xml', '<?xml version="1.0" encoding="UTF-8"?>\n<Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties" xmlns:vt="http://schemas.openxmlformats.org/officeDocument/2006/docPropsVTypes"><Application>SimpleXLSXGen</Application><DocSecurity>0</DocSecurity><ScaleCrop>false</ScaleCrop><HeadingPairs><vt:vector size="2" baseType="variant"><vt:variant><vt:lpstr>Worksheets</vt:lpstr></vt:variant><vt:variant><vt:i4>'.count($this->sheets).'</vt:i4></vt:variant></vt:vector></HeadingPairs><TitlesOfParts><vt:vector size="'.count($this->sheets).'" baseType="lpstr">'.self::appTitles($this->sheets).'</vt:vector></TitlesOfParts></Properties>');
        $zip->addFromString('docProps/core.xml', '<?xml version="1.0" encoding="UTF-8"?>\n<cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:dcmitype="http://purl.org/dc/dcmitype/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><dc:creator>SimpleXLSXGen</dc:creator><cp:lastModifiedBy>SimpleXLSXGen</cp:lastModifiedBy><dcterms:created xsi:type="dcterms:W3CDTF">'.gmdate('Y-m-d\TH:i:s\Z').'</dcterms:created><dcterms:modified xsi:type="dcterms:W3CDTF">'.gmdate('Y-m-d\TH:i:s\Z').'</dcterms:modified></cp:coreProperties>');
        // xl/workbook.xml
        $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8"?>\n<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><bookViews><workbookView xWindow="0" yWindow="0" windowWidth="12000" windowHeight="8000"/></bookViews><sheets>'.self::wbSheets($this->sheets).'</sheets></workbook>');
        // xl/_rels/workbook.xml.rels
        $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8"?>\n<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'.self::relsSheets($this->sheets).'<Relationship Id="rId999" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/></Relationships>');
        // xl/_rels directory must exist in zip (ZipArchive creates automatically when adding above)
        // xl/styles.xml (basic)
        $zip->addFromString('xl/styles.xml', '<?xml version="1.0" encoding="UTF-8"?>\n<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><fonts count="1"><font><sz val="11"/><name val="Calibri"/></font></fonts><fills count="1"><fill><patternFill patternType="none"/></fill></fills><borders count="1"><border/></borders><cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs><cellXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/></cellXfs></styleSheet>');
        // sheets
        $i = 1;
        foreach ($this->sheets as $sheet) {
            $zip->addFromString('xl/worksheets/sheet'.$i.'.xml', self::sheetXml($sheet['rows']));
            $i++;
        }
        $zip->close();
        if ($isDownload) {
            if (!headers_sent()) {
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="'.($downloadName ?: 'sample.xlsx').'"');
                header('Pragma: public');
                header('Cache-Control: max-age=0');
            }
            readfile($tmp);
            @unlink($tmp);
            exit;
        } else {
            rename($tmp, $path);
        }
    }
    private static function esc($v){ return htmlspecialchars($v, ENT_QUOTES|ENT_XML1, 'UTF-8'); }
    private static function sheetXml($rows){
        $r = array(); $r[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $r[] = '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><sheetData>';
        $rowNum = 1;
        foreach ($rows as $row){
            $r[] = '<row r="'.$rowNum.'">';
            $col = 0;
            foreach ($row as $cell){
                $col++; $r[] = '<c r="'.self::col2name($col).$rowNum.'" t="inlineStr"><is><t>'.self::esc((string)$cell).'</t></is></c>';
            }
            $r[] = '</row>';
            $rowNum++;
        }
        $r[] = '</sheetData></worksheet>';
        return implode('', $r);
    }
    private static function col2name($index){ $s=''; while($index>0){ $mod=($index-1)%26; $s=chr(65+$mod).$s; $index=intval(($index-$mod)/26);} return $s; }
    private static function ctSheets($sheets){ $i=''; for($n=1;$n<=count($sheets);$n++){ $i.='<Override PartName="/xl/worksheets/sheet'.$n.'.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'; } return $i; }
    private static function wbSheets($sheets){ $i=''; $n=1; foreach($sheets as $s){ $i.='<sheet name="'.self::esc($s['name']).'" sheetId="'.$n.'" r:id="rId'.$n.'"/>'; $n++; } return $i; }
    private static function relsSheets($sheets){ $i=''; $n=1; foreach($sheets as $s){ $i.='<Relationship Id="rId'.$n.'" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet'.$n.'.xml"/>'; $n++; } return $i; }
    private static function appTitles($sheets){ $i=''; foreach($sheets as $s){ $i.='<vt:lpstr>'.self::esc($s['name']).'</vt:lpstr>'; } return $i; }
}
}
?>


