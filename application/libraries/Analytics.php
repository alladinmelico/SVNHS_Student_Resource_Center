<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics{
	
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function regression($actual_data,$x,$y,$toForecast = null){
		$reg=array();
		$sumX=0;
		$sumY=0;
		$sumXY=0;
		$sumXSqElement=0;
		$a=0;
		$b=0;

		foreach($actual_data AS $data){
			$sumX += $data[$x];
			$sumY += $data[$y];
			$sumXY += ($data[$x] * $data[$y]);
			$sumXSqElement += pow($data[$x],2);
		}

		$a = ($sumY*$sumXSqElement-$sumX*$sumXY)/(count($actual_data)*$sumXSqElement-pow($sumX,2));
		$b = (count($actual_data)*$sumXY-$sumX*$sumY)/(count($actual_data)*$sumXSqElement-pow($sumX,2));

		foreach($actual_data AS $data){
			$reg[] = array('x'=>$data[$x],'y'=>$data[$y],'f'=>$a+$b*$data[$x]);
		}

		if($toForecast){
			foreach($toForecast AS $data){
				$reg[] = array('x'=>$data,'y'=>$a+$b*$data,'f'=>$a+$b*$data);
			}
		}
		return $reg;
	}

	public function exponential_smoothing($actual_data,$x,$y,$a,$toForecast = null){
		$expo_smoothing = array();
		$size = count($actual_data)-1;

		for($i = 0; $i < $size; $i++){
			if($i == 0 || $i == 1){
				$expo_smoothing[] = array(
					'x'=>$actual_data[$i][$x],
					'y'=>$actual_data[$i][$y],
					'f'=>$actual_data[0][$y]
				);
				continue;
			}
			$f = ($a*$actual_data[$i-1][$y]) + ((1-$a)*$expo_smoothing[$i-1]['f']);

			$expo_smoothing[] = array(
				'x'=>$actual_data[$i][$x],
				'y'=>$actual_data[$i][$y],
				'f'=> $f
			);
		}

		$sumError = 0;
		for($i = 1; $i < $size; $i++){
			$sumError += pow($expo_smoothing[$i]['y'] - $expo_smoothing[$i]['f'],2);
		}

		$error = $sumError/(count($expo_smoothing)-1);
		for($i = 0; $i < $size; $i++){
			$expo_smoothing[$i]['ue'] = $expo_smoothing[$i]['f']+$error;
			$expo_smoothing[$i]['le'] = $expo_smoothing[$i]['f']-$error;
		}

		// if($toForecast){
		// 	for($i = 0; $i < $toForecast; $i++){
		// 		$f = ($a*$expo_smoothing[$size+$i-1][$y]) + ((1-$a)*$expo_smoothing[$size+$i-1]['f']);
		// 		$expo_smoothing[] = array(
		// 			'x'=>date('Y-m-d', strtotime($expo_smoothing[$size][$x]. ' + 1 days')),
		// 			'y'=>null,
		// 			'f'=>$f
		// 		);
		// 	}
		// }

		return $expo_smoothing;
	}

}

?>
