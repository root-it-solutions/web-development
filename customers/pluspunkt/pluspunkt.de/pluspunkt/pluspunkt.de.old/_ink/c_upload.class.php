<?php 
class c_upload
{
	function Upload($pfad,$filename)
	{
		IF (isset($_FILES['file']['tmp_name']) && $_FILES['file']['size'] != "0")
		{
			$dateiname = ereg_replace(' +', '_', $filename);
			$dateiname = ereg_replace("\'", "", $dateiname);
			$dateiname = ereg_replace("\"", "", $dateiname);
			$dateiname = stripslashes($dateiname);

			IF (file_exists($pfad.$dateiname))
			{
//				$fext  = array_pop(explode('.', $dateiname));
//				$fname = basename($dateiname, '.'.$fext);
//				$dateiname = $fname. "_" .time(). "." .$fext;

				return("Fehler");
			}
			ELSE
			{
				$dateiname = $dateiname;

//				move_uploaded_file($datei,$pfad.$dateiname);
				copy($_FILES['file']['tmp_name'],$pfad.$dateiname);

				$fehler = "0";
				return($dateiname);
			}
		}
	}
}
?>
