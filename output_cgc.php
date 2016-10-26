<?php
	include 'koneksi.php';
	/*ini_set('max_execution_time', 1000); 
	ini_set('memory_limit', '2048M');*/
	$data		= array();
	//$_POST['produk'] = "EMASKU";
	if ("EMASKU" == $_POST['produk']) {
		$query ="SELECT A.NO_KONTRAK NO_KONTRAK, A.TGL_KREDIT TGL_KREDIT, B.JUM_GRAM GRAM, A.SISA_PEMBIAYAAN_AWAL AS UP , CEIL(A.SISA_PEMBIAYAAN_AWAL/A.TENOR) ANGSURAN_POKOK, A.TGL_JATUH_TEMPO TGL_JATUH_TEMPO
    FROM OP_SDOLIST_MULIA A LEFT JOIN OP_MULIA_KREDIT B
    ON A.NO_KONTRAK = B.NO_KONTRAK
     WHERE A.PRODUCT_CD IN ('29') AND A.AS_OF_DT=trunc(sysdate-1) and a.cif='".$_POST['cif']."'";
    }
        $result = oci_parse($conn, $query);
        oci_execute($result,OCI_DEFAULT);
        while ($row=oci_fetch_array($result,OCI_BOTH)){
 /*        $tgl = $row['AS_OF_DT'];
           $cif = $row['CIF'];
           $sbk	= $row['NO_KONTRAK'];
           $tgl_kredit = $row['TGL_KREDIT'];
           $up = $row['UP'];
           $tgl_jatuh_tempo = $row['TGL_JATUH_TEMPO'];*/
           $data[] = array(
           		"TGL_KREDIT"	=> $row['TGL_KREDIT'],
           		"UP"	=> $row['UP'],
           		"ANGSURAN_POKOK"	=> $row['ANGSURAN_POKOK'],
           		"GRAM"	=> $row['GRAM'],
           		"TGL_JATUH_TEMPO"	=> $row['TGL_JATUH_TEMPO']
           	);
    }
	
	echo json_encode($data);
?>