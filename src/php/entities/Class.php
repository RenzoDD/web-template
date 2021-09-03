<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Class template
 */

require_once __DIR__.'/DataBase.php';

class ClassTemplate extends DataBase
{
    public $ClassID;

    public $ClassAtribute1;
    public $ClassAtribute2;
    public $ClassAtribute3;
    
	private function FillData($destino, $origen)
	{
		if (isset($origen['ClassID']))
			$destino->ClassID = $origen['ClassID'];

		if (isset($origen['ClassAtribute1']))
			$destino->ClassAtribute1 = $origen['ClassAtribute1'];
			
		if (isset($origen['ClassAtribute2']))  
			$destino->ClassAtribute2 = $origen['ClassAtribute2'];
		
		if (isset($origen['ClassAtribute3']))  
			$destino->FechaCreacion = $origen['ClassAtribute3'];
	}

	public function Create($ClassAtribute1,$ClassAtribute2)
	{
		try
		{
			$query = $this->db->prepare("CALL CLASS_TEMPLATE_CREATE(:ClassAtribute1,:ClassAtribute2)");
			$query->bindParam(":ClassAtribute1", $ClassAtribute1, PDO::PARAM_STR);
			$query->bindParam(":ClassAtribute2", $ClassAtribute2, PDO::PARAM_STR);
			
			if (!$query->execute())
				return false;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return false;
			
			$this->FillData($this, $result[0]);
			
			return true;
		}
		catch (Exception $e)
		{ return false; }
	}

    public function RealAll()
    {
        try
        {
            $query = $this->db->prepare("CALL CLASS_TEMPLATE_READ_ALL()");
            
            if (!$query->execute())
                return [];
                
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $A = [];
            foreach ($result as $row)
            {
                $obj = new ClassTemplate();
                $obj->FillData($obj, $row);
                $A[$obj->ClassID] = $obj;
            }

            return $A;
        }
        catch (Exception $e)
        { return []; }
    }

	public function ReadID($ClassID)
	{
		try
		{
			$query = $this->db->prepare("CALL CLASS_TEMPLATE_READ_ID(:ClassID)");
			$query->bindParam(":ClassID", $ClassID, PDO::PARAM_INT);
			
			if (!$query->execute())
				return null;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return null;
			
			$obj = new ClassTemplate();
			$obj->FillData($obj, $result[0]);
			
			return $obj;
		}
		catch (Exception $e)
		{ return null; }
	}

    public function EditAll($ClassID,$ClassAtribute1,$ClassAtribute2,$ClassAtribute3)
    {
		try
		{
			$query = $this->db->prepare("CALL CLASS_TEMPLATE_EDIT_ALL(:ClassID,:ClassAtribute1,:ClassAtribute2,:ClassAtribute3)");
			$query->bindParam(":ClassID",        $ClassID,        PDO::PARAM_INT);
			$query->bindParam(":ClassAtribute1", $ClassAtribute1, PDO::PARAM_STR);
			$query->bindParam(":ClassAtribute2", $ClassAtribute2, PDO::PARAM_STR);
			$query->bindParam(":ClassAtribute3", $ClassAtribute3, PDO::PARAM_STR);
	
			if (!$query->execute())
				return false;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return false;
			
			$this->FillData($this, $result[0]);
			
			return true;
		}
		catch (Exception $e)
		{ return false; } 
    }

	public function DeleteID($ClassID)
	{
		try
		{
			$query = $this->db->prepare("CALL CLASS_TEMPLATE_DELETE_ID(:ClassID)");
			$query->bindParam(":ClassID", $ClassID, PDO::PARAM_INT);
			
			if (!$query->execute())
				return false;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			return (sizeof($result) == 0);
		}
		catch (Exception $e)
		{ return false; }
	}
}

?>