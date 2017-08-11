<?php

class trad {

	private
	$lCode = "",
	$error = "No errors found",
	$variable = "",
	$trad = "";
	
	public function __construct($lCode)
	{
		if($lCode)
		{
			$lE = explode("-", $lCode, 2);
			$lC = $lE['0'];
			$this->lCode = $lC;
		} else {
			$this->lCode = 'it';
		}
		
	}	
	
	public function getErr()
	{
		if($this->lCode == "")
		{
			$this->error = "Invalid Language Code";
			return $this->error;
		} elseif (!file_exists("Languages/$this->lCode"))
        {
        	$this->error="Doesn't exists $this->lCode file!";
        }elseif ($this->variable == "")
		{
			$this->error = "Invalid Variable";
		} elseif (!strstr(file_get_contents("Languages/$this->lCode"), $this->variable))
		{
			$this->error = "Invalid Variable. There's no variables like this in the mentioned path";
			return $this->error;
		} else {
			return $this->error;
		}
	}
	
	public function build($variable)
	{
		$this->variable = $variable;
	}
	
	public function getTrad()
	{
		$content = file_get_contents("Languages/$this->lCode");
		$explode = explode("\n", $content);
		foreach($explode as $var)
		{
            $e = explode(" : ", $var, 2);
			if($e[0] == $this->variable)
            {
            	$this->trad = $e[1];
            	return $this->trad;
            }
		} 
        if($this->trad == "")
        {
			$this->error = "Traduction not found. Use inserTrad::insert() to insert the variable in you traduction list!";
			return $this->error;
        }
	}
}

class insertTrad {
	private 
    $lCode = "",	
    $error = "";
    
    public function __construct($lCode)
    {
            $this->lCode = $lCode;
            mkdir("Languages");
    }
    
    public function insert($variabile, $trad)
    {
    	if(!$variabile)
        {
        	$this->error="Invalid variable name";
            return $this->error;
        } elseif (!$trad)
        {
        	$this->error="Invalid traduction for $variabile";
            return $this->error;
        } elseif ($this->lCode == "")
        {
        	$this->error="Invalid language code";
            return $this->error;
        } else {
        	$content = file_get_contents("Languages/$this->lCode");
        	file_put_contents("Languages/$this->lCode", "$content\n$variabile : $trad");
        }
    }
}	
