<?php

class Modules extends My_Model{

    function getAllModules(){
        $data = array();
        $this->db->select('modules.id,module_number,module_title,video_count,video_number,
        video_title,tags,audio,pdf,video_filename,uservideos.module_id as video_watched');
        $this->db->join('uservideos', 'modules.id = uservideos.module_id', 'left outer');
        $this->db->group_by("module_number");
        $this->db->order_by('module_number','asc');
        $Q = $this->db->get('modules');

        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function getAllModulesVideos($module_numnber){
        $data = array();
        $this->db->select('modules.id,module_number,module_title,video_count,video_number,video_title,
        tags,audio,pdf,video_filename,uservideos.module_id as video_watched');
        $this->db->join('uservideos', 'modules.id = uservideos.module_id', 'left outer');
        $this->db->where('modules.module_number', $module_numnber);
        $this->db->order_by('modules.video_number','asc');
        $Q = $this->db->get('modules');

        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function getSelectedModule($module_numnber){

        $data = array();
        $this->db->select('id,module_number,module_title,video_count,video_number,video_title,tags,audio,pdf,video_filename');

        $this->db->where('module_number', $module_numnber);
        $this->db->limit(1);
        $Q = $this->db->get('modules');

        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }


    function getSelectedModuleVideo($module_number , $video_numnber){

        $data = array();
        $this->db->select('modules.id,module_number,module_title,video_count,video_number,
        video_title,tags,audio,pdf,video_filename,resource1,resource2,resource3,resource4,uservideos.module_id as video_watched');
        $this->db->join('uservideos', 'modules.id = uservideos.module_id', 'left outer');
        $this->db->where('module_number', $module_number);
        $this->db->where('video_number', $video_numnber);
        $this->db->limit(1);
        $Q = $this->db->get('modules');

        //print_r($Q->result_array()); die();

        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function  userVideosLink($userid,$moduleid){

        $this->db->select('id');
        $this->db->where('user_id',$userid);
        $this->db->where('module_id',$moduleid);
        $this->db->limit(1);
        $Q = $this->db->get('uservideos');

        if ($Q->num_rows() == 0){

            $data = array(
                'user_id' => $userid,
                'module_id' => $moduleid,
            );

            $this->db->insert('uservideos', $data);
        }

    }

    function userVideos($userid,$moduleid){

        $this->db->select('id');
        $this->db->where('user_id',$userid);
        $this->db->where('module_id',$moduleid);
        $this->db->limit(1);
        $Q = $this->db->get('uservideos');

        if ($Q->num_rows() == 0){

            $data = array(
                'user_id' => $userid,
                'module_id' => $moduleid,
            );

            $this->db->insert('uservideos', $data);
        }else{

            $this->db->where('user_id', $userid);
            $this->db->where('module_id', $moduleid);
            $this->db->delete('uservideos');
        }
    }

    function countModuleVideos($module_number){
        $this->db->where('module_number', $module_number);
        $num_rows = $this->db->count_all_results('modules');
        return $num_rows;
    }


    function countLastModuleVideos($module_number){
        $this->db->where('module_number', $module_number);
        $num_rows = $this->db->count_all_results('modules');
        return $num_rows;
    }

    function getModuleVideos($module_number){

        $this->db->select('*');
        $this->db->from('modules');
        $this->db->where('module_number',$module_number);
        $Q = $this->db->get();
        $result = $Q->result();

        return $result;

    }

    function getUserVideos($video_id,$userid){

       $user_videos = array();
        $this->db->select('module_id');
        $this->db->from('uservideos');
        $this->db->where('user_id',$userid);
        $this->db->where('module_id',$video_id);
        $this->db->limit(1);
        $Q = $this->db->get();
        $result = $Q->result();

        if ($Q->num_rows()>0){

            return $result[0]->module_id;
        }

        //echo "<pre>"; print_r($Q->num_rows()); die();

    }



}

?>
