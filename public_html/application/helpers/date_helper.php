<?php
if (!isset($GLOBALS["date_day_id"])) $GLOBALS["date_day_id"] = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
if (!isset($GLOBALS["date_month_id"]))$GLOBALS["date_month_id"] = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
if (!isset($GLOBALS["date_month_en"]))$GLOBALS["date_month_en"] = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
if (!isset($GLOBALS["date_simple_month_id"]))$GLOBALS["date_simple_month_id"] = array("JAN", "FEB", "MAR", "APR", "MEI", "JUNI", "JULI", "AUG", "SEPT", "OKT", "NOV", "DES");

if ( ! function_exists('date_reformat')) {
	function date_reformat($format = "", $strdate = "") {
		return @date($format, @strtotime($strdate));
	}
}

if ( ! function_exists('dateday_lang_reformat_long')) {
	function dateday_lang_reformat_long($strdate, $lang = "id") {
		global $date_day_id, $date_month_id;
		
		$sttime = @strtotime($strdate);
		if ($lang == "id") {
			return $date_day_id[date("w", $sttime)]." ".date("j", $sttime)."/".date("n", $sttime)."/".date("Y", $sttime).", ".date("H", $sttime).".".date("i", $sttime)." WIB";
		} else {
			return date("l, F j Y");
		}
	}
}
if ( ! function_exists('dateday_lang_reformat_long_report')) {
	function dateday_lang_reformat_long_report($strdate, $lang = "id") {
		global $date_day_id, $date_month_id;
		
		$sttime = @strtotime($strdate);
		if ($lang == "id") {
			return $date_day_id[date("w", $sttime)]." , ".date("j", $sttime)." ".$date_month_id[date("n", $sttime)-1]." ".date("Y", $sttime);
		} else {
			return date("l, F j Y");
		}
	}
}
if ( ! function_exists('date_lang_reformat_long')) {
	function date_lang_reformat_long($strdate, $lang = "id") {
		global $date_day_id, $date_month_id;
		
		$sttime = @strtotime($strdate);
		if ($lang == "id") {
			return date("j", $sttime)." ".$date_month_id[date("n", $sttime)-1]." ".date("Y", $sttime);
		} else {
			return date("l, F j Y");
		}
	}
}

if ( ! function_exists('date_lang_reformat_long')) {
	function date_lang_reformat_long($strdate, $lang = "id") {
		global $date_day_id, $date_month_id;
		
		$sttime = @strtotime($strdate);
		if ($lang == "id") {
			return date("j", $sttime)." ".$date_month_id[date("n", $sttime)-1]." ".date("Y", $sttime);
		} else {
			return date("l, F j Y");
		}
	}
}

if ( ! function_exists('date_min_format')) {
	function date_min_format($strdate, $lang = "id") {
		global $date_day_id, $date_simple_month_id;
		
		$sttime = @strtotime($strdate);
		if ($lang == "id") {
			return date("j", $sttime)."-".$date_simple_month_id[date("n", $sttime)-1]."-".date("Y", $sttime);
		} else {
			return date("F j Y");
		}
	}
}

if ( ! function_exists('datetime_lang_reformat_long')) {
	function datetime_lang_reformat_long($strdate, $lang = "id") {
		global $date_day_id, $date_month_id;

		$sttime = @strtotime($strdate);
		if ($lang == "id") {
			return  date("j", $sttime)." ".$date_month_id[date("n", $sttime)-1]." ".date("Y", $sttime)." | ".date("H", $sttime).":".date("i", $sttime);
		} else {
			return date("F j Y | H:i");
		}
	}
}

if ( ! function_exists('simple_date')) {
	function simple_date($strdate, $lang = "id") {
		global $date_day_id, $date_month_id;

		$sttime = @strtotime($strdate);
		if ($lang == "id") {
			return  date("Y", $sttime)."/".date("n", $sttime)."/".date("j", $sttime);
		} else {
			return date("F j Y | H:i");
		}
	}
}
if ( ! function_exists('insight_date_format')) {
	function insight_date_format($strdate, $lang = "id") {
		global $date_day_id, $date_month_id;

		$sttime = @strtotime($strdate);
		if ($lang == "id") {
			return  date("j", $sttime)."/".date("n", $sttime)."/".date("Y", $sttime)." ".date("H", $sttime).":".date("i", $sttime);
		} else {
			return date("F j Y | H:i");
		}
	}
}
?>