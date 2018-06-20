<?php

class cHome{

	/*
	ATTRIBUTS
	*/
	
	//string
	protected $_title = NULL;
	
	//string
	protected $_desc = NULL;

	//array
	protected $_descDelta = NULL;

	//string
	protected $_headerColor = NULL;


	public function getTitle() { return $this->_title; }
	public function setTitle($value) { $this->_title = $value; }

	public function getDesc() { return $this->_desc; }
	public function setDesc($value) { $this->_desc = $value; }

	public function getDescDelta() { return $this->_descDelta; }
	public function setDescDelta($value) { $this->_descDelta = $value; }

	public function getHeaderColor() { return $this->_headerColor; }
	public function setHeaderColor($value) { $this->_headerColor = $value; }

	/*
	CONSTRUCTOR
	*/

	public function __construct($details = NULL)
	{
		//importe l'objet depuis la BDD grâce à l'ID
		if(!is_array($details))
		{
			$details = intval($details);
			$this->import($details);
		}
	
		//ou créé l'objet à partir des données en array
		if(is_array($details))
		{
			if($details != NULL)
			{
				foreach($details as $key => $detail)
				{
					switch(strtolower($key))
					{
						case "title":
							$this->_title = $detail;
							break;
						case "desc":
							$this->_desc = $detail;
							break;
						case "descdelta":
							$this->_descDelta = $detail;
							break;
						case "headercolor":
							$this->_headerColor = $detail;
							break;
					}
				}
			}
		}
	}

	/*
	FUNCTION IMPORT
	*/

	public function import($id)
	{
		global $dataBase;

		$query = "SELECT * FROM home";
		$data = $dataBase->query($query, FETCH_ARRAY);

		$this->_title = $dataBase->unprotect($data["title"], _STRING_);
		$this->_desc = $dataBase->unprotect($data["Hdesc"], _STRING_);
		$this->_descDelta = $dataBase->unprotect($data["Hdesc_delta"], _ARRAY_);
		$this->_headerColor = $dataBase->unprotect($data["headerColor"], _STRING_);
	}

	/*
	FUNCTION UPDATE
	*/
	public function update()
	{
		global $dataBase;

		$ho_title = 		$dataBase->protect($this->_title, _STRING_);
		$ho_desc = 			$dataBase->protect($this->_desc, _STRING_);
		$ho_descDelta = 	$dataBase->protect($this->_descDelta, _ARRAY_);
		$ho_headerColor =	$dataBase->protect($this->_headerColor, _STRING_);

		echo $ho_descDelta;

		$query = "
		UPDATE home
		SET title = $ho_title, Hdesc = $ho_desc, Hdesc_delta = $ho_descDelta, headerColor = $ho_headerColor";

		$dataBase->query($query);	
		// echo $query;	
	}
}