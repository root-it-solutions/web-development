<?php

if($_REQUEST["save"] != '') 
{

	foreach($_REQUEST["questions"] as $one => $two)
	{
		
		$aUpdate = "UPDATE 	".DB_FRAGEN." 
					SET 	question='".$two."'
					WHERE 	id='".$one."' 
					";
		$Update = $db->sql_query($aUpdate); 
	
	}
	
	foreach($_REQUEST["answers"] as $one => $two)
	{
		
		$two = textTrumbowyg($two); 
		
		$aUpdate = "UPDATE 	".DB_ANTWORTEN." 
					SET 	answer='".$two."'
					WHERE 	id='".$one."' 
					";
		$Update = $db->sql_query($aUpdate); 
	
	}
	
	$_SESSION['success'] = 'Die Änderungen waren erfolgreich.';

	header("Location: /".$urlOne.""); 
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="cache-control" content="no-cache">
<meta name="theme-color" content="#225380">

<link rel="shortcut icon" href="/img/favicon.png" type="image/png">
<link rel="icon" href="/img/favicon.png" type="image/png">

<title>admin. typenchecker by pluspunkt.</title>

<link rel="stylesheet" href="https://cdn.oceandock.de/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.oceandock.de/css/fontawesome6/css/all.min.css"> 
<link rel="stylesheet" href="https://cdn.oceandock.de/bootstrap/select/bootstrap-select.css" />
<link rel="stylesheet" href="https://cdn.oceandock.de/fonts/css?family=source-sans-pro">
<link rel="stylesheet" href="https://cdn.oceandock.de/fonts/css?family=abeezee">
<link rel="stylesheet" href="/js/trumbowyg/ui/trumbowyg.min.css">
<link rel="stylesheet" href="/css/frontend.css"/>

</head>

<form action="" name="save" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
<input name="save" type="hidden" value="1" />

<div class="frame bg-white">
	
	<?php echo $show_message; ?>
	
	<h1>Fragen</h1>
	
	<hr>
	
	<div class="row">
	<div class="col-md-12">
    <?php 
       
            $aDaten = "SELECT * FROM ".DB_FRAGEN." ";
            $qDaten = $db->sql_query($aDaten);
            $rDaten = $db->sql_num_rows($qDaten);
            while($Daten = $db->sql_fetch_object($qDaten)) 
            { 
                {
                   
                 echo '
				 
				
				<div class="form-group">
					<label class="col-sm-12 control-label"><strong>'.$Daten->area.' > '.$Daten->result.'</strong></label>
					<div class="col-sm-12">
						<input type="text" name="questions['.$Daten->id.']" value="'.$Daten->question.'" class="form-control">
					</div>
				</div>
				
				';
					
				}
			}
                    
    
    ?>
		
		<br><br>
		
	<h1>Antworten</h1>
	
	<hr>
	
	<div class="row">
	<div class="col-md-12">
    <?php 
       
            $aDaten = "SELECT * FROM ".DB_ANTWORTEN." ";
            $qDaten = $db->sql_query($aDaten);
            $rDaten = $db->sql_num_rows($qDaten);
            while($Daten = $db->sql_fetch_object($qDaten)) 
            { 
                {
                   
                 echo '
				 
				
				<div class="form-group">
					<label class="col-sm-12 control-label"><strong>'.$Daten->result.'</strong></label>
					<div class="col-sm-12">
						<textarea name="answers['.$Daten->id.']" class="form-control editorSmall" rows="10">'.$Daten->answer.'</textarea>
					</div>
				</div>
				
				';
					
				}
			}
                    
    
    ?>
	
               
	<div class="form-group">
		<label class="col-sm-12 control-label"></label>
		<div class="col-sm-12">
			<button type="submit" name="send" class="btn btn-primary">Speichern</button>
		</div>
	</div>
		
	</div>
	</div>
	
</div>

</form>
    

<script src="https://cdn.oceandock.de/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.oceandock.de/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.oceandock.de/bootstrap/select/bootstrap-select.min.js"></script>
<script src="/js/trumbowyg/trumbowyg.js"></script>
<script src="/js/trumbowyg/langs/de.min.js"></script>
<script src="/js/jquery-functions.js"></script>
    
</body>
</html>