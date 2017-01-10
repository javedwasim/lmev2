<?php
class BusinessplandetailModel {
    //put your code here

    public function plan_name($id){
        global $database;
        $sql = "SELECT 	planname FROM businessplan WHERE id={$id}";
        $result = $database->query($sql);
        $row = $database->fetch_array($result);
        if($row['planname'] != ""){
            return str_replace(" ","_",$row['planname']);
        }else{
            return "YourBusinessPlan";
        }
    }
}
global $BusinessplandetailModel_obj,$tbl_businessplandetail;
