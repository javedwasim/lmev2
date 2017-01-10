<?php

class SearchModules extends My_Model{

    function getSearchedModules($searchModules){
        $data = array();
        $this->db->select('id,module_number,module_title,video_count,video_number,video_title,tags,audio,pdf,video_filename');
        $this->db->like('module_title', $searchModules,'both');
        $this->db->or_like('video_title', $searchModules,'both');
        $this->db->or_like('tags', $searchModules,'both');
        $Q = $this->db->get('modules');

        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }


    function getAllModules(){
        $data = array();
        $this->db->select('id,module_number,module_title,video_count,video_number,video_title,tags,audio,pdf,video_filename');
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
        $this->db->select('id,module_number,module_title,video_count,video_number,video_title,tags,audio,pdf,video_filename');
        $this->db->where('module_number', $module_numnber);
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
        $this->db->select('id,module_number,module_title,video_count,video_number,video_title,tags,audio,pdf,video_filename');
        $this->db->where('module_number', $module_number);
        $this->db->where('video_number', $video_numnber);
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
}

?>
