<?php

ob_start();

use PHPUnit\Framework\TestCase;
include_once "./models/PageModel.php";
include_once "./models/ShopModel.php";
include_once "Test_ShopCrud.php";
include_once "TestProduct.php";
include_once "IShopCrud.php";

class Test_ShopModel extends TestCase {
  private $crud;
    public function testPrepareWebShopData() {
       // Mock dependencies
       $mockShopCrud = $this->getMockBuilder(ShopCrud::class)
       ->getMock();
        // Set up expected return value for retrieveAllItems method
        $expectedItems = [
        ['id' => 1, 'name' => 'Item 1', 'price' => 10],
        ['id' => 2, 'name' => 'Item 2', 'price' => 20]
        ];
        $mockShopCrud->expects($this->once())
        ->method('retrieveAllItems')
        ->willReturn($expectedItems);

        // Instantiate ShopModel object with mocked dependency
        $pageModel = new PageModel(null); // You might need to mock this as well
        $shopModel = new ShopModel($pageModel, $mockShopCrud);

        // Call the method under test
        $shopModel->prepareWebshopData();

        // Assert that the items property has been correctly populated
        $this->assertEquals($expectedItems, $shopModel->items);
            }

    /**
      * Helper function to create a new test 
      *
      * param int $id the id of the product 
      * return a new Product instance.
      */
      public function createTestProduct($id) {
            $name = "Test" . $id;
            $price = 100;
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
