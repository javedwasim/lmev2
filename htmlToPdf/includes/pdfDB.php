<?php
require_once('Database.php');

class PdfDB { 

// Common Database Methods

public static function find_by_sql($sql="") {

    global $database;

    $result_set = $database->query($sql);

    $object_array = array();

    while ($row = $database->fetch_array($result_set)) {

      $object_array[] = self::instantiate($row);

    }

    return $object_array;

  }



	public static function count_all() {

	  global $database;

	  $sql = "SELECT COUNT(*) FROM ".self::$table_name;

    $result_set = $database->query($sql);

	  $row = $database->fetch_array($result_set);

    return array_shift($row);

	}



	private static function instantiate($record) {

		// Could check that $record exists and is an array

    $object = new self;

		

		

		// More dynamic, short-form approach:

		foreach($record as $attribute=>$value){

		  if($object->has_attribute($attribute)) {

		    $object->$attribute = $value;

		  }

		}

		return $object;

	}

	

	private function has_attribute($attribute) {

	  // We don't care about the value, we just want to know if the key exists

	  // Will return true or false

	  return array_key_exists($attribute, $this->attributes());

	}



	protected function attributes() { 

		// return an array of attribute names and their values

	  $attributes = array();

	  foreach(self::$db_fields as $field) {

	    if(property_exists($this, $field)) {

	      $attributes[$field] = $this->$field;

	    }

	  }

	  return $attributes;

	}

	

	protected function sanitized_attributes($arr) {

	  global $database;

	  $clean_attributes = array();

	  // sanitize the values before submitting

	  // Note: does not alter the actual value of each attribute

	  foreach($arr as $key => $value){

	    $clean_attributes[$key] = $database->escape_value($value);

	  }

	  return $clean_attributes;

	}

	

	public function save() {

	  // A new record won't have an id yet.

	  return isset($this->id) ? $this->update() : $this->create();

	}

	

	public function create($obj,$table_name) {
            	$arr  = (array)$obj;
                global $database;
                $attributes = $this->sanitized_attributes($arr);
               $sql = "INSERT INTO ".$table_name." (";

		$sql .= join(", ", array_keys($attributes));

	  $sql .= ") VALUES ('";

		$sql .= join("', '", array_values($attributes));

		$sql .= "')";

	
           if($database->query($sql)) {

	    
            $insert_id = $database->insert_id();
	    return true;

	  } else {
              
	    return false;

	  }

	}



	public function update($obj,$table_name,$colName,$colVal) {
                $arr  = (array)$obj;
                global $database;
                $attributes = $this->sanitized_attributes($arr);
		$attribute_pairs = array();

		foreach($attributes as $key => $value) {
                 if(!empty($value) || $value != 0){   
		  $attribute_pairs[] = "{$key}='{$value}'";
                 }  
		}

		$sql = "UPDATE ".$table_name." SET ";

		$sql .= join(", ", $attribute_pairs);

		$sql .= " WHERE $colName = '{$colVal}'";
                
	  $database->query($sql);

	  return ($database->affected_rows() == 1) ? true : false;
        }
        public function updatePdf($obj,$table_name,$colName,$colVal) {
                $arr  = (array)$obj;
                global $database;
                $attributes = $this->sanitized_attributes($arr);
		$attribute_pairs = array();

		foreach($attributes as $key => $value) {
                 //if(!empty($value) || $value != 0){   
		  $attribute_pairs[] = "{$key}='{$value}'";
                 //}  
		}

		$sql = "UPDATE ".$table_name." SET ";

		$sql .= join(", ", $attribute_pairs);

		$sql .= " WHERE $colName = '{$colVal}'";
                
	  $database->query($sql);

	  return ($database->affected_rows() == 1) ? true : false;
        }



	public function delete($tblName,$colName,$colVal) {
            global $database;
            $sql = "DELETE FROM {$tblName} WHERE {$colName} = '{$colVal}' LIMIT 1";
            $database->query($sql);
            return $database->affected_rows();
        }

	

        public function RecordAlreadyExist($tableName,$colName,$colVal){
             global $database;
             $sql = "SELECT {$colName} FROM {$tableName} WHERE {$colName} ='{$colVal}' LIMIT 1";
             $result = $database->query($sql);
             $numofrows     =   $database->num_rows($result);
             if($numofrows > 0){
                return true; 
             }else{
                return false;
               }
             
             }
         public function getSingleRecord($tableName){
             global $database;
             $sql = "SELECT * FROM {$tableName}  LIMIT 1";
             $result = $database->query($sql);
             return $database->fetch_array($result);
             
             }    
         public function getAllRecord($tableName){
             global $database;
             $sql = "SELECT * FROM {$tableName}";
             $result = $database->query($sql);
             return $result;
            }
         public function getAllRecordsByCol($tableName,$colmName,$colmVal){
             global $database;
             $sql = "SELECT * FROM {$tableName} WHERE {$colmName} = '{$colmVal}'";
             $result = $database->query($sql);
             return $result;
            }   
           public function getSingleRecordByCol($tableName,$colmName,$colmVal){
             global $database;
             $sql = "SELECT * FROM {$tableName} WHERE {$colmName} = '{$colmVal}'  LIMIT 1";
             $result = $database->query($sql);
             return $database->fetch_array($result);
             
             }  
}//end of cls
       

?>