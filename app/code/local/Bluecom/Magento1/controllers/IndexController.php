<?php
class Bluecom_Magento1_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        // echo 'Hello Magento1';
        $this->loadLayout(array('default'));
        $this->renderLayout();
    }

    public function showBlogPostAction ()
    {
        // $blogpost = Mage::getModel(‘magento1/blogpost’); // cai nay de gọi model
        // echo get_class($blogpost);

        $params = $this->getRequest()->getParams();
        // $blogpost = Mage::getModel('magento1/blogpost');
        $blogpost = Mage::getModel('magento1/order');
        echo("Loading the blogpost with an ID of ".$params['id']);
        $blogpost->load($params['id']);
        $data = $blogpost->getData();
        var_dump($blogpost->getOrigData());
    }

    public function createNewPostAction() {
        $blogpost = Mage::getModel('magento1/blogpost');
        $blogpost->setTitle('Code Post!');
        $blogpost->setPost('This post was created from code!');
        $blogpost->save();
        echo 'post with ID ' . $blogpost->getId() . ' created';
    }

    public function editFirstPostAction() {
        $blogpost = Mage::getModel('magento1/blogpost');
        $blogpost->load(1);
        $blogpost->setTitle("The First post!");
        $blogpost->save();
        echo 'post edited';
    }

    public function deleteFirstPostAction() {
        $blogpost = Mage::getModel('magento1/blogpost');
        $blogpost->load(1);
        $blogpost->delete();
        echo 'post removed';
    }

    /**
     * Show all Blog Post
     *
     * @author Thanh-TV
     * @since 2016-07-14
     */
    public function showAllBlogPostAction ()
    {
        $posts = Mage::getModel('magento1/blogpost')->getCollection();
        foreach($posts as $blogpost){
            echo '<h3>'.$blogpost->getTitle().'</h3>';
            echo nl2br($blogpost->getPost());
        }

        $posts = Mage::getModel('magento1/order')->getCollection();
        foreach($posts as $order){
            echo '<h3>'.$order->getProductCode().'</h3>';
            echo nl2br($order->getProductValue());
            echo nl2br($order->getFullName());
        }
    }
}