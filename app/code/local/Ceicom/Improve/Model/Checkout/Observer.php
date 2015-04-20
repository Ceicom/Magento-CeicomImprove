<?php
class Ceicom_Improve_Model_Checkout_Observer
{

    public function dispatch(Varien_Event_Observer $observer)
    {
        $request        = Mage::app()->getRequest();
        $controllerName = $request->getControllerName();
        $actionName      = $request->getActionName();

        if($controllerName == 'cart' AND $actionName == 'index') {
            Mage::getSingleton('checkout/session')->getQuote()->getPayment()->setData('method', '');
        }

        if($controllerName == 'onepage' AND $actionName == "saveShippingMethod") {
            Mage::getSingleton('checkout/session')->getQuote()->getPayment()->setData('method', '');
        }
    }

}
