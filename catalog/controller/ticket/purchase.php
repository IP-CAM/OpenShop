<?php
class ControllerTicketPurchase extends Controller {
	public function index() {
		$this->load->language('ticket/purchase');
        $this->load->model('models/interface');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('common/home'),
			'text' => $this->language->get('text_home')
		);

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('ticket/purchase'),
			'text' => $this->language->get('heading_title')
		);

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_next'] = $this->language->get('text_next');
			$data['text_next_choice'] = $this->language->get('text_next_choice');
			$data['column_name'] = $this->language->get('column_name');
			$data['column_model'] = $this->language->get('column_model');
        $data['column_zone']=$this->language->get('column_zone');
			$data['column_quantity'] = $this->language->get('column_quantity');
			$data['column_price'] = $this->language->get('column_price');
			$data['column_total'] = $this->language->get('column_total');
			$data['button_update'] = $this->language->get('button_update');
			$data['button_remove'] = $this->language->get('button_remove');
			$data['button_shopping'] = $this->language->get('button_shopping');
			$data['button_checkout'] = $this->language->get('button_checkout');
			$data['action'] = $this->url->link('ticket/purchase/checkout');
			$data['tickets'] = array();


        $ticket_list=array();

        $event=array('event_id'=>'50');
        $zone=array();
        $ticket_db=$this->model_models_interface->model_interface(0,'ticket','for_cart','get',$event);
        //print_r($ticket_db);
        foreach ($ticket_db as $key => $value) {
            if (is_array($value) && !empty($value)) {
                if ($key == 'ticket_price_list') {
                    foreach($value as $v){
                                $ticket_list[$v['row_id']]['name']=$v['ticket_level_name'];
                                $ticket_list[$v['row_id']]['price']=$v['price'];
                    }
                }
                if($key=='ticket_position_list'){
                    foreach($value as $v) {
                            $ticket_list[$v['ticket_price_row_id']]['zone'][$v['zone']] = $v['capacity'];
                        }
                }
            }
        }
        $data['tickets']=$ticket_list;

			$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');

			//$this->load->model('extension/extension');

			$data['checkout_buttons'] = array();

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/cart.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/ticket/purchase.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/ticket/purchase.tpl', $data));
			}
	}

    //if a user is logged, redirect to checkout page
    //otherwise, redirect to register page
    public function checkout($data){
        //To do - get purchase data from view

        $this->session->data['purchase_items']=$this->request->post;

        //Populate order data for inserting new data into database
//        $order_array=array();
//        $order_array['order_id']=isset($data['order_id']) ? $data['order_id'] : 0;
//        $order_array['event_id']=isset($data['event_id']) ? $data['event_id'] : 0;
//        $order_array['order_type_id']=isset($data['order_type_id']) ? $data['order_type_id'] : 0;
//        $order_array['invoice_no']=isset($data['invoice_no']) ? $data['invoice_no'] : '';
//        $order_array['invoice_prefix']=isset($data['invoice_prefix']) ? $data['invoice_prefix'] : '';
//        $order_array['store_id']=isset($data['store_id']) ? $data['store_id'] : 0;
//        $order_array['store_name']=isset($data['store_name']) ? $data['store_name'] : '';
//        $order_array['store_url']=isset($data['store_url']) ? $data['store_url'] : '';
//        $order_array['customer_id']=isset($data['customer_id']) ? $data['customer_id'] : 0;
//        $order_array['customer_group_id']=isset($data['customer_group_id']) ? $data['customer_group_id'] : 0;
//        $order_array['firstname']=isset($data['firstname']) ? $data['filter_name'] : '';
//        $order_array['lastname']=isset($data['lastname']) ? $data['lastname'] : '';
//        $order_array['email']=isset($data['email']) ? $data['email'] : '';
//        $order_array['telephone']=isset($data['telephone']) ? $data['telephone'] : '';
//        $order_array['fax']=isset($data['fax']) ? $data['fax'] : '';
//        $order_array['payment_firstname']=isset($data['payment_firstname']) ? $data['payment_firstname'] : '';
//        $order_array['payment_lastname']=isset($data['payment_lastname']) ? $data['payment_lastname'] : '';
//        $order_array['payment_company']=isset($data['payment_company']) ? $data['payment_company'] : '';
//        $order_array['payment_address_1']=isset($data['payment_address_1']) ? $data['payment_address_1'] : '';
//        $order_array['payment_address_2']=isset($data['payment_address_2']) ? $data['payment_address_2'] : '';
//        $order_array['payment_city']=isset($data['payment_city']) ? $data['payment_city'] : '';
//        $order_array['payment_postcode']=isset($data['payment_postcode']) ? $data['payment_postcode'] : '';
//        $order_array['payment_country']=isset($data['payment_country']) ? $data['payment_country'] : '';
//        $order_array['payment_country_id']=isset($data['payment_country_id']) ? $data['payment_country_id'] : 0;
//        $order_array['payment_zone']=isset($data['payment_zone']) ? $data['payment_zone'] : '';
//        $order_array['payment_zone_id']=isset($data['payment_zone_id']) ? $data['payment_zone_id'] : 0;
//        $order_array['payment_address_format']=isset($data['payment_address_format']) ? $data['payment_address_format'] : '';
//        $order_array['payment_custom_field']=isset($data['payment_custom_field']) ? $data['payment_custom_field'] : '';
//        $order_array['payment_method']=isset($data['payment_method']) ? $data['payment_method'] : '';
//        $order_array['payment_code']=isset($data['payment_code']) ? $data['payment_code'] : '';
//        $order_array['shipping_firstname']=isset($data['shipping_firstname']) ? $data['shipping_firstname'] : '';
//        $order_array['shipping_lastname']=isset($data['shipping_lastname']) ? $data['shipping_lastname'] : '';
//        $order_array['shipping_company']=isset($data['shipping_company']) ? $data['shipping_company'] : '';
//        $order_array['shipping_address_1']=isset($data['shipping_address_1']) ? $data['shipping_address_1'] : '';
//        $order_array['shipping_address_2']=isset($data['shipping_address_2']) ? $data['shipping_address_2'] : '';
//        $order_array['shipping_city']=isset($data['shipping_city']) ? $data['shipping_city'] : '';
//        $order_array['shipping_postcode']=isset($data['shipping_postcode']) ? $data['shipping_postcode'] : '';
//        $order_array['shipping_country']=isset($data['shipping_country']) ? $data['shipping_country'] : '';
//        $order_array['shipping_country_id']=isset($data['shipping_country_id']) ? $data['shipping_country_id'] : 0;
//        $order_array['shipping_zone']=isset($data['shipping_zone']) ? $data['shipping_zone'] : '';
//        $order_array['shipping_zone_id']=isset($data['shipping_zone_id']) ? $data['shipping_zone_id'] : 0;
//        $order_array['shipping_address_format']=isset($data['shipping_address_format']) ? $data['shipping_address_format'] : '';
//        $order_array['shipping_custom_field']=isset($data['shipping_custom_field']) ? $data['shipping_custom_field'] : '';
//        $order_array['shipping_method']=isset($data['shipping_method']) ? $data['shipping_method'] : '';
//        $order_array['shipping_code']=isset($data['shipping_code']) ? $data['shipping_code'] : '';
//        $order_array['comment']=isset($data['comment']) ? $data['comment'] : '';
//        $order_array['total']=isset($data['total']) ? $data['total'] : '';
//        $order_array['commission']=isset($data['commission']) ? $data['commission'] : '';
//        $order_array['tracking']=isset($data['tracking']) ? $data['tracking'] : '';
//        $order_array['language_id']=isset($data['language_id']) ? $data['language_id'] : 1;
//        $order_array['currency_id']=isset($data['currency_id']) ? $data['currency_id'] : 1;
//        $order_array['currency_code']=isset($data['currency_code']) ? $data['currency_code'] : '';
//        $order_array['currency_value']=isset($data['currency_value']) ? $data['currency_value'] : '';
//        $order_array['ip']=isset($data['ip']) ? $data['ip'] : '';
//        $order_array['forwarded_ip']=isset($data['forwarded_ip']) ? $data['forwarded_ip'] : '';
//        $order_array['user_agent']=isset($data['user_agent']) ? $data['user_agent'] : '';
//        $order_array['accept_language']=isset($data['accept_language']) ? $data['accept_language'] : 1;
//        $order_array['status']=isset($data['status']) ? $data['status'] : 1;
//        $order_array['created_date']=isset($data['created_date']) ? $data['created_date'] : '0000-00-00';
//        $order_array['modified_date']=isset($data['modified_date']) ? $data['modified_date'] : '0000-00-00';
//        $order_array['operator_id']=$this->customer->getId();

        //To do - need to reverse the if statement for production
        if ($this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');

            $this->response->redirect($this->url->link('account/register', '', 'SSL'));
        }
        else{
            $this->response->redirect($this->url->link('ticket/checkout', '', 'SSL'));
        }
        }
}