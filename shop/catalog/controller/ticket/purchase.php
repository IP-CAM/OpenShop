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


			$data['action'] = $this->url->link('ticket/purchase/edit');

			$data['products'] = array();

$data['ticket']=$this->model_models_interface->model_interface(0,'ticket','to_event','get',51);

		//$products = $this->cart->getProducts();
        $products=array();
        $products['VIP']['id']='1';
        $products['VIP']['name']='VIP Ticket';
        $products['VIP']['price']='1200';
        $products['VIP']['quantity']='';
        $products['VIP']['total']='';
        $products['VIP']['stock']=array(
          array('A','245'),
            array('B','32'),
            array('C','2'),
        );

        $products['VIP']['id']='2';
        $products['Couple']['name']='Couple Ticket';
        $products['Couple']['price']='320';
        $products['Couple']['quantity']='';
        $products['Couple']['total']='';
        $products['Couple']['stock']=array(
            array('D','245'),
            array('E','12'),
            array('H','2'),
        );
        //



        //store ticket data in session
        $_SESSION["tickets"]=$products;

        $data['products']=$products;

			// Totals
			$this->load->model('extension/extension');

			$total_data = array();
			$total = 0;

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

	public function add() {
		$this->load->language('checkout/cart');

		$json = array();

		if (isset($this->request->post['product_id'])) {
			$product_id = (int)$this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			if (isset($this->request->post['quantity'])) {
				$quantity = (int)$this->request->post['quantity'];
			} else {
				$quantity = $product_info['minimum'] ? $product_info['minimum'] : 1;
			}

			if (isset($this->request->post['option'])) {
				$option = array_filter($this->request->post['option']);
			} else {
				$option = array();
			}

			$product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);

			foreach ($product_options as $product_option) {
				if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
					$json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
				}
			}


			$recurrings = $this->model_catalog_product->getProfiles($product_info['product_id']);



			if (!$json) {
				$this->cart->add($this->request->post['product_id'], $quantity, $option, $recurring_id);

				$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']), $product_info['name'], $this->url->link('checkout/cart'));

				unset($this->session->data['shipping_method']);
				unset($this->session->data['shipping_methods']);
				unset($this->session->data['payment_method']);
				unset($this->session->data['payment_methods']);

				// Totals
				$this->load->model('extension/extension');

				$total_data = array();
				$total = 0;
				$taxes = $this->cart->getTaxes();

				// Display prices
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$sort_order = array();

					$results = $this->model_extension_extension->getExtensions('total');

					foreach ($results as $key => $value) {
						$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
					}

					array_multisort($sort_order, SORT_ASC, $results);

					foreach ($results as $result) {
						if ($this->config->get($result['code'] . '_status')) {
							$this->load->model('total/' . $result['code']);

							$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
						}
					}

					$sort_order = array();

					foreach ($total_data as $key => $value) {
						$sort_order[$key] = $value['sort_order'];
					}

					array_multisort($sort_order, SORT_ASC, $total_data);
				}

				$json['total'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total));
			} else {
				$json['redirect'] = str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']));
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

    //validate selected quantity for a ticket
    public function update($data) {
        $this->load->language('ticket/purchase');
        $json=$this->ticket->validateQuantity($data);
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function getTotal($data){

        //not finished yet
        $json=array();

        if(isset($this->session->data['tickets'])&&!empty($this->session->data['tickets'])){


        }
    }
}