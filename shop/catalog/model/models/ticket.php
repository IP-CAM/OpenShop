<?php
class Ticket extends Model {

	public function get_ticket_list($user,$data = array()) {

        $result=array();

        if(isset($data) && !empty($data)){

            $filter_name        = $this->db->escape(isset($data['filter_name']) ? $data['filter_name'] : null);
            $filter_status      = $this->db->escape(isset($data['filter_status']) ? $data['filter_status'] : 1);
            $order              = $this->db->escape(isset($data['order']) ? $data['order'] : 'ASC');
            $start              = $this->db->escape(isset($data['start']) ? $data['start'] : 0);
            $limit              = $this->db->escape(isset($data['limit']) ? $data['limit'] : 20);

            $result = $this->db->multi_query("CALL get_tickets('$filter_name',$filter_status,'$order',$start,$limit)");

        }
        else{

        }
        return $result;
	}

	public function get_ticket_price($user,$ticket_id) {
        $result=array();

        if($ticket_id>0){

            $result = $this->db->multi_query("CALL get_ticket_price($ticket_id)");

        }
        else{

        }
        return $result;
	}

    public function get_ticket_discount($user,$ticket_id) {
        $result=array();

        if($ticket_id>0){

            $result = $this->db->multi_query("CALL get_ticket_discount($ticket_id)");

        }
        else{

        }
        return $result;
    }

	public function get_ticket_general($user,$ticket_id) {
        $result=array();

        if($ticket_id > 0){

            $result = $this->db->multi_query("CALL get_ticket_general($ticket_id)");

        }
        else {

        }
        if(!empty($result)){
            return $result[0];
        }
        else{
            return $result;
        }

	}

	public function get_ticket_total($user,$data = array()) {

        if(isset($data) && !empty($data)){
            $filter_name        = $this->db->escape(isset($data['filter_name']) ? $data['filter_name'] : null);
            $filter_status      = $this->db->escape(isset($data['filter_status']) ? $data['filter_status'] : 1);
            $order              = $this->db->escape(isset($data['order']) ? $data['order'] : 'ASC');
            $start              = $this->db->escape(isset($data['start']) ? $data['start'] : 0);
            $limit              = $this->db->escape(isset($data['limit']) ? $data['limit'] : 20);

            $this->db->multi_query("call get_total_tickets('$filter_name',$filter_status,'$order',$start,$limit,@result)");
            $_result=get_object_vars($this->db->query("SELECT @result"));

            return $_result['row']['@result'];

        }
        else{

        }

	}

    public function get_ticket_to_event($user,$ticket_id) {

        $result=array();

        if($ticket_id > 0){

            $query = $this->db->multi_query("CALL get_ticket_to_event($ticket_id)");

        }
        else {

        }

        if(!empty($query)){
            $result =  $query[0];

        }

        return $result;

    }

    public function merge_data($old_array = array(),$update_array = array()){

        $temp_array =  array();

        if(is_array($update_array) && isset($update_array) && !empty($update_array)) {

            foreach ($update_array as $update_key => $update_value) {

                foreach($update_value as $k=>$v){
                    $temp_array[$update_key][$k]=$v;
                }
                $temp_array[$update_key]['row_id']=$update_key;
                $temp_array[$update_key]['status']=1;

                foreach($old_array as $keys=>$values){

                    if(array_key_exists($update_key,$values)){
                        break;
                    }
                    else{
                        $temp_array[$update_key]['data_status']='insert';
                        $temp_array[$update_key]['status']=1;
                    }
                }
            }
        }



        if(is_array($old_array) && isset($old_array) && !empty($old_array)){

            foreach($old_array as $keys=>$values){

                if(array_key_exists($values['row_id'],$update_array)){
                    $temp_array[$values['row_id']]['data_status']='update';
                    $temp_array[$values['row_id']]['status']=1;
                }
                else{
                    foreach($values as $old_k=>$old_val){
                        $temp_array[$values['row_id']][$old_k]= $old_val;
                    }
                    $temp_array[$values['row_id']]['data_status']='delete';
                    $temp_array[$values['row_id']]['status']=0;
                }
            }

        }

        return $temp_array;
    }

    public function get_ticket_for_cart($user,$data=array()) {

        $result=array();
        $event_id=$data['event_id'];
        $ticket_id=51;

        if($ticket_id > 0){

            $query = $this->db->multi_query("CALL get_ticket_price_for_cart($event_id,$ticket_id)");

        }
        else {

        }
        if(!empty($query)){
            $result['ticket_price_list'] =$query;
        }
        else{
            $result['ticket_price_list'] =null;
        }

        if($ticket_id > 0){

            $query = $this->db->multi_query("CALL get_ticket_position_for_cart($ticket_id)");

        }
        else {

        }
        if(!empty($query)){
            $result['ticket_position_list'] =$query;
        }
        else{
            $result['ticket_position_list'] =null;
        }

        return $result;

    }
}
