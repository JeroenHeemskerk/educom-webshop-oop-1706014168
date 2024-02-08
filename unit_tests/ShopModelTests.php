<?php
use PHPUnit\Framework\TestCase;
require_once "ShopCrudTests.php";

class ShopModelTest extends TestCase {
    public function testPrepWebShop() {
        //prepare
        $crud = new TestShopCrud(); //dummy CRUD
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
      * @param int $id the id of the product 
      * @return a new Product instance.
      */
        function createTestProduct($id) {
            return new TestProduct($id, "Test".$id, "A Test product", $id * 1.01,"testimage.jpg");        
      }

      public function testAddToCart() {

        $mockSessionManager = $this->getMockBuilder(SessionManager::class)
                                   ->getMock();
        //setting up test data
        $userId = 123;
        $itemId = 999;
        $amount = 300;
        $itemDetails = "Test product!";

        //expectations for sessionManager
        $mockSessionManager->expects($this->once())
        ->method("getCart")
        ->willReturn([]);

        //instantiating shopmodel with these mocked dependencies
        $shopModel = new ShopModel(null, null);
        $shopModel->setSessionManager($mockSessionManager);

        //Call method under test instance
        $shopModel->addToCart($userId, $itemId, $amount, $itemDetails);

        $cart = $shopModel->getCart();

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