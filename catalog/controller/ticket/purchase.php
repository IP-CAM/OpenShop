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

        $this->session->data['purcase_item']=$data;

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