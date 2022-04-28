<?php

//$liksnis vedamas skaičiais
// 0 - Vardininkas (Kas?)
// 1 - Kilmininkas (Ko?)
// $first_letterUp - pirmoji raidė dižioji (true)

function getMonthWordInLithuanian($monthNo, $linksnis=0,$first_letterUp=false){
	$months = array(
		"01" => array("sausis","sausio"),
		"02" => array("vasaris", "vasario"),
		"03" => array("kovas", "kovo"),
		"04" => array("balandis", "balandžio"),
		"05" => array("gegužė", "gegužės"),
		"06" => array("birželis", "birželio"),
		"07" => array("liepa", "liepos"),
		"08" => array("rugpjūtis", "rugpjūčio"),
		"09" => array("rugsėjis", "rugsėjo"),
		"10" => array("spalis", "spalio"),
		"11" => array("lapkritis", "lapkričio"),
		"12" => array("gruodis", "gruodžio")
		);
	
	$month_in_word = $months[$monthNo][$linksnis];
	
	if($first_letterUp == true)
		$month_in_word = ucfirst($month_in_word);
		
	return $month_in_word;
}

if( !function_exists('is_param_equal') ) {

    // function is_param_equal($param, $param2) {

    //     if(isset($param) && $param ==  $param2) {
    //         return true;
    //     }

    //     return false;
    // }

    function is_param_equal($method, $key, $comparison) {
        
        return (isset($method[$key]) && $method[$key] ==  $comparison) ? true : false;

    }

}

// funkcija paima faile esančia info jason formate(jei failo nera, ji sukuria)
// ir gavus duomenis iš masyvo juos encodinus į jason prideda prie jau esamu
// $datafilelink - linkas iki failo
// $datatofile - masyvas duomenų, kuriuos prijungsime

function filejasonencode($datafilelink, $datatofile){
	
	$datafile = fopen($datafilelink, 'w+');
	$datafile = file_get_contents($datafilelink);
	$datafileinfo = json_decode($datafile);
	
    if($datafileinfo) {
        $datatofile = array_merge($datafileinfo, $datatofile);
    }
	$datatoencode = json_encode($datatofile);

    file_put_contents($datafilelink, $datatoencode);
	//fclose($datafile);
}