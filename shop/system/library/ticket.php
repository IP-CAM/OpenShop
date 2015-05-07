<?php
class Ticket {
    private $config;
    private $db;
    private $data = array();

    public function __construct($registry) {
        $this->config = $registry->get('config');
        $this->customer = $registry->get('customer');
        $this->session = $registry->get('session');
        $this->db = $registry->get('db');
        $this->tax = $registry->get('tax');

        if (!isset($this->session->data['cart']) || !is_array($this->session->data['cart'])) {
            $this->session->data['cart'] = array();
        }
    }

    public function validateQuantity($data){

        $status=array();
        $status['validation']='success';
        //call store procedure
        $result=mysql_query('') or die(mysql_error());
        while($row=mysql_fetch_row($result)){
            foreach($data as $item){
                    $stock=$item['stock'];
                    foreach($stock as $v){
                        if(isset($v)&&!empty($v)){
                            if($v[0]>$row[$item['name']]['quantity']){
                                $status['validation']='fail';
                                return $status;
                            }
                        }
                    }
            }
        }
        return $status;
    }
    public function getTotal($data){

    }
}