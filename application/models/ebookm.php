<?php

Class ebookM extends CI_Model{
    
    
    
    public function createNewEBook($eBookName){
  
        $createdDate = date("Y-m-d H:i:s");  
        
        $data = array(
            
           'ebookname' => $eBookName ,
           'datecreated' => $createdDate,
           'lastupdate' => $createdDate,
           'user_id'=>$this->session->userdata['logged_in']['id'],
            'ebookcontent' => ''
            
        );
        
        $this->db->insert('ebooks', $data);
        $last_inserted_id = $this->db->insert_id();
        $userid = $this->session->userdata['logged_in']['id'];
        
        

        if($last_inserted_id>0){   
             return $last_inserted_id;
        }else{
             return false;
        }

        
    }
    
      public function getAllEbooks(){
        
         $this->db->select('id,ebookname,datecreated,lastupdate ');
         $this->db->from('ebooks');
        
         $query = $this->db->get();
         return $query->result();
                }
   
        public function  savecontent($data){
            
                
        $this->db->where('id', $data['id']);
        $this->db->update('ebooks', array('ebookcontent'=>$data['ebookcontent']));
               
        }
        
        
        public function getSaveContent($id){
            //echo $bp_id;
            $this->db->select('ebookcontent');
            $this->db->from('ebooks');
            $this->db->where('id', $id);

            $query = $this->db->get();
            return $query->result();
                
    }
    
    
}

?>