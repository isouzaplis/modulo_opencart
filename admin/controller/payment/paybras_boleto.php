<?php 
class ControllerPaymentPaybrasBoleto extends Controller {
	private $error = array(); 

	public function index() {
		$this->language->load('payment/paybras_boleto');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('paybras_boleto', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_sandbox'] = $this->language->get('text_sandbox');
		$this->data['text_local'] = $this->language->get('text_local');
		$this->data['text_live'] = $this->language->get('text_live');
		$this->data['text_payment'] = $this->language->get('text_payment');
		$this->data['text_defered'] = $this->language->get('text_defered');
		$this->data['text_authenticate'] = $this->language->get('text_authenticate');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_token'] = $this->language->get('entry_token');
		$this->data['entry_ambience'] = $this->language->get('entry_ambience');
		$this->data['entry_transaction'] = $this->language->get('entry_transaction');
		$this->data['entry_total'] = $this->language->get('entry_total');	
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_title'] = $this->language->get('entry_title');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}

		if (isset($this->error['token'])) {
			$this->data['error_token'] = $this->error['token'];
		} else {
			$this->data['error_token'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),      		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/paybras_boleto', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = $this->url->link('payment/paybras_boleto', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['paybras_boleto_email'])) {
			$this->data['paybras_boleto_email'] = $this->request->post['paybras_boleto_email'];
		} else {
			$this->data['paybras_boleto_email'] = $this->config->get('paybras_boleto_email');
		}

		if (isset($this->request->post['paybras_boleto_token'])) {
			$this->data['paybras_boleto_token'] = $this->request->post['paybras_boleto_token'];
		} else {
			$this->data['paybras_boleto_token'] = $this->config->get('paybras_boleto_token');
		}
		
		if (isset($this->request->post['paybras_boleto_password'])) {
			$this->data['paybras_boleto_password'] = $this->request->post['paybras_boleto_password'];
		} else {
			$this->data['paybras_boleto_password'] = $this->config->get('paybras_boleto_password');
		}


		if (isset($this->request->post['paybras_boleto_ambience'])) {
			$this->data['paybras_boleto_ambience'] = $this->request->post['paybras_boleto_ambience'];
		} else {
			$this->data['paybras_boleto_ambience'] = $this->config->get('paybras_boleto_ambience');
		}
		
		if (isset($this->request->post['paybras_boleto_title'])) {
			$this->data['paybras_boleto_title'] = $this->request->post['paybras_boleto_title'];
		} else {
			$this->data['paybras_boleto_title'] = $this->config->get('paybras_boleto_title');
		}
		
		if (isset($this->request->post['paybras_boleto_total'])) {
			$this->data['paybras_boleto_total'] = $this->request->post['paybras_boleto_total'];
		} else {
			$this->data['paybras_boleto_total'] = $this->config->get('paybras_boleto_total'); 
		} 
				
		if (isset($this->request->post['paybras_boleto_order_status_id'])) {
			$this->data['paybras_boleto_order_status_id'] = $this->request->post['paybras_boleto_order_status_id'];
		} else {
			$this->data['paybras_boleto_order_status_id'] = $this->config->get('paybras_boleto_order_status_id'); 
		} 

		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['paybras_boleto_geo_zone_id'])) {
			$this->data['paybras_boleto_geo_zone_id'] = $this->request->post['paybras_boleto_geo_zone_id'];
		} else {
			$this->data['paybras_boleto_geo_zone_id'] = $this->config->get('paybras_boleto_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');
										
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['paybras_boleto_status'])) {
			$this->data['paybras_boleto_status'] = $this->request->post['paybras_boleto_status'];
		} else {
			$this->data['paybras_boleto_status'] = $this->config->get('paybras_boleto_status');
		}
		
		if (isset($this->request->post['paybras_boleto_sort_order'])) {
			$this->data['paybras_boleto_sort_order'] = $this->request->post['paybras_boleto_sort_order'];
		} else {
			$this->data['paybras_boleto_sort_order'] = $this->config->get('paybras_boleto_sort_order');
		}

		$this->template = 'payment/paybras_boleto.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/paybras_boleto')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['paybras_boleto_email']) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if (!$this->request->post['paybras_boleto_token']) {
			$this->error['token'] = $this->language->get('error_token');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>