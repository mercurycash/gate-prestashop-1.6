<?php

class MercurycashPaymentModuleFrontController extends ModuleFrontController
{

    public function initContent()
    {
        parent::initContent();

        $cart = $this->context->cart;
        $process_url  = $this->context->link->getModuleLink($this->module->name, 'validation', array('ajax' => true));
        $status_url   = $this->context->link->getModuleLink($this->module->name, 'check',      array('ajax' => true));
        $settings_url = $this->context->link->getModuleLink($this->module->name, 'settings',   array('ajax' => true));
        $success_url  = $this->context->link->getModuleLink($this->module->name, 'success',    array('ajax' => true));

        $refresh_period = Configuration::get('MERCURYCASH_STATUS_PERIOD', null, null, null, 5);

        $this->context->smarty->assign([
            'get_settings_url' => $settings_url,
            'success_url' => $success_url,
            'action' => $this->context->link->getModuleLink($this->module->name, 'validation', array(), true),
            'url' => $process_url,
            'status_url' => $status_url,
            'refresh_period' => $refresh_period,
            'nbProducts' => $cart->nbProducts(),
        ]);

        $this->setTemplate('payment_form.tpl');
    }

}