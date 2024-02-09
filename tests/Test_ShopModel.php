<?php

include_once "./models/PageModel.php";
include_once "./models/ShopModel.php";
include_once "Test_ShopCrud.php";
include_once "TestProduct.php";
include_once "IShopCrud.php";
use PHPUnit\Framework\TestCase;

class Test_ShopModel extends TestCase {
    public function testPrepWebShop() {
        //prepare
        $crud = new Test_ShopCrud(); //dummy CRUD
        $crud->arrayToReturn = array(1 => $this->createTestProduct(1), 3 => $this->createTestProduct(3));

        $pageModel = new PageModel(null);
        $model = new ShopModel($pageModel, $this->crud); //Object to test<<
        
        //test</span>
        $model->prepareWebshopData();

        //validate</span>
        $this->assertNotEmpty($model->items);
        $this->assertEqual(1, count($crud->sqlQueries));
        $this->assertEqual($crud->arrayToReturn, $model->items);
    }

    /**
      * Helper function to create a new test 
      *
      * param int $id the id of the product 
      * return a new Product instance.
      */
        function createTestProduct($id) {
            $name = "Test" . $id;
            $price = $id * 100;
            $image = "testimage.jpg";

            return new TestProduct($id, $name, $price, $image);        
      }

      public function testAddToCart() {
        //setting up test data
        $userId = 123;
        $itemId = 999;
        $amount = 300;
        $itemDetails = "Test product!";
        $mockShopCrud = $this->getMockBuilder(ShopCrud::class)->getMock();
        $pageModel = null;


        //instantiating shopmodel with these mocked dependencies
        $shopModel = new ShopModel($pageModel, $mockShopCrud);

        //Call method under test instance
        $shopModel->addToCart($userId, $itemId, $amount, $itemDetails);

        $cart = $shopModel->cart;

        //Assertions
        $this->assertNotEmpty($cart);
        $this->assertCount(1, $cart);
        $this->assertEquals($userId, $cart[0]['userId']);
        $this->assertsEqual($itemId, $cart[0]['itemId']);
        $this->assertsEqual($amount, $cart[0]['amount']);
        $this->assertsEqual($itemDetails, $cart[0]['itemDetails']);
      }
      //other functions of the productModel to test all called "test...."
}

?>