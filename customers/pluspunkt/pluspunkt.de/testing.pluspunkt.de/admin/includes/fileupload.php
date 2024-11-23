<?php
	function resizeImage($imageName, $imageDefiniedHeight = '600', $imageDefiniedWidth = '600', $imageDestinationOld, $imageDestinationNew)
	{
		#echo $imageName." - ".$imageNewWidth." - ".$imageDestinationOld." - ".$imageDestinationNew;
		$imageSize = getimagesize($imageDestinationOld.$imageName);
	
		$imageWidth = $imageSize[0];
		$imageHeight = $imageSize[1];
	
		if($imageWidth > $imageDefiniedWidth)
		{
			$imageNewHeight = ($imageHeight * $imageDefiniedWidth) / $imageWidth;
	
			if($imageSize[2] == 1) # GIF
			{
				$imageOld = ImageCreateFromGIF($imageDestinationOld.$imageName);
				$imageNew = ImageCreateTrueColor($imageDefiniedWidth, $imageNewHeight);
				ImageCopyResized($imageNew, $imageOld, 0, 0, 0, 0, $imageDefiniedWidth, $imageNewHeight, $imageWidth, $imageHeight);
				ImageGIF($imageNew, $imageDestinationNew.$imageName);
			}
			elseif($imageSize[2] == 2) # JPG
			{
				$imageOld = ImageCreateFromJPEG($imageDestinationOld.$imageName);
				$imageNew = ImageCreateTrueColor($imageDefiniedWidth, $imageNewHeight);
				ImageCopyResized($imageNew, $imageOld, 0, 0, 0, 0, $imageDefiniedWidth, $imageNewHeight, $imageWidth, $imageHeight);
				ImageJPEG($imageNew, $imageDestinationNew.$imageName);
			}
			elseif($imageSize[2] == 3) # PNG
			{
				$imageOld = ImageCreateFromPNG($imageDestinationOld.$imageName);
				$imageNew = ImageCreateTrueColor($imageDefiniedWidth, $imageNewHeight);
				ImageCopyResized($imageNew, $imageOld, 0, 0, 0, 0, $imageDefiniedWidth, $imageNewHeight, $imageWidth, $imageHeight);
				ImagePNG($imageNew, $imageDestinationNew.$imageName);
			}
			
			$imageSize = getimagesize($imageDestinationNew.$imageName);
	
			$imageWidth = $imageSize[0];
			$imageHeight = $imageSize[1];
			
			if($imageHeight > $imageDefiniedHeight)
			{
				$imageNewWidth = ($imageWidth * $imageDefiniedHeight) / $imageHeight;
	
				if($imageSize[2] == 1) # GIF
				{
					$imageOld = ImageCreateFromGIF($imageDestinationNew.$imageName);
					$imageNew = ImageCreateTrueColor($imageNewWidth, $imageDefiniedHeight);
					ImageCopyResized($imageNew, $imageOld, 0, 0, 0, 0, $imageNewWidth, $imageDefiniedHeight, $imageWidth, $imageHeight);
					ImageGIF($imageNew, $imageDestinationNew.$imageName);
				}
				elseif($imageSize[2] == 2) # JPG
				{
					$imageOld = ImageCreateFromJPEG($imageDestinationNew.$imageName);
					$imageNew = ImageCreateTrueColor($imageNewWidth, $imageDefiniedHeight);
					ImageCopyResized($imageNew, $imageOld, 0, 0, 0, 0, $imageNewWidth, $imageDefiniedHeight, $imageWidth, $imageHeight);
					ImageJPEG($imageNew, $imageDestinationNew.$imageName);
				}
				elseif($imageSize[2] == 3) # PNG
				{
					$imageOld = ImageCreateFromPNG($imageDestinationNew.$imageName);
					$imageNew = ImageCreateTrueColor($imageNewWidth, $imageDefiniedHeight);
					ImageCopyResized($imageNew, $imageOld, 0, 0, 0, 0, $imageNewWidth, $imageDefiniedHeight, $imageWidth, $imageHeight);
					ImagePNG($imageNew, $imageDestinationNew.$imageName);
				}
			}
		}
	}//function resizeImage($imageName, $imageDefiniedHeight = '600', $imageDefiniedWidth = '600', $imageDestinationOld, $imageDestinationNew)
	
	function gif2jpeg($p_fl, $p_new_fl = '', $bgcolor = false)
	{
		list($wd, $ht, $tp, $at)=getimagesize($p_fl);
		$img_src=imagecreatefromgif($p_fl);
		$img_dst=imagecreatetruecolor($wd,$ht);
		$clr['red']=255;
		$clr['green']=255;
		$clr['blue']=255;
		if(is_array($bgcolor)) $clr=$bgcolor;
		$kek=imagecolorallocate($img_dst,$clr['red'],$clr['green'],$clr['blue']);
		imagefill($img_dst,0,0,$kek);
		imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $wd, $ht, $wd, $ht);
		$draw=true;
		if(strlen($p_new_fl)>0)
		{
			if($hnd=fopen($p_new_fl,'w'))
			{
				$draw=false;
				fclose($hnd);
			}
		}
		if(true==$draw)
		{
			header("Content-type: image/jpeg");
			imagejpeg($img_dst);
		}
		else imagejpeg($img_dst, $p_new_fl);
		imagedestroy($img_dst);
		imagedestroy($img_src);
	}//function gif2jpeg($p_fl, $p_new_fl = '', $bgcolor = false)
?>
