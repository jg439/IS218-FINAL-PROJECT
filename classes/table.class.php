<?php
//This table class has been taken from one of our first assignments
class table {
	protected $html;
	public function getHTML($array){
		$this->getArray($array);
	 	return $this->html;
  }
  public function getArray(array $array) {
		$this->html = '<table>';
		$this->html .= '<tr>';
		$first = true;
		foreach($array[0] as $key=>$value){
			$this->html .= '<th>' . $value . '</th>';
		}
		$this->html .= '</tr>';
		foreach($array as $key=>$value) {
	 	  if($first) {
		    $first = false;
		    continue;
		  }
		  $this->html .= '<tr>';
		  foreach($value as $key2=>$value2){
		    $this->html .= '<td>' . $value2 . '</td>';
		  }
		  $this->html .= '</tr>';
	  }
	  $this->html .= '</table>';
	  return $this->html;
	}
}

?>
