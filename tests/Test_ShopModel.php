<?php

use PHPUnit\Framework\TestCase;
include_once "./models/PageModel.php";
include_once "./models/ShopModel.php";
include_once "./models/CrudShop.php";
include_once "./models/Crud.php";
include_once "Test_ShopCrud.php";
include_once "TestProduct.php";
include_once "IShopCrud.php";
include_once "ICrud.php";

class Test_ShopModel extends TestCase {
  private $crud;
  public function testprepareWebshopData() {
        // Set up expected return value for retrieveAllItems method
        $expectedItems = [
          ['id' => 1, 'name' => 'Item 1', 'price' => 10],
          ['id' => 2, 'name' => 'Item 2', 'price' => 20]
          ];
        
        $mockPageModel = $this->createMock(PageModel::class);
        $mockShopCrud = $this->createMock(ShopCrud::class);
        $mockShopCrud->method('retrieveAllItems')->willReturn($expectedItems);

        $shopModel = new ShopModel($mockPageModel, $mockShopCrud);

        $shopModel->prepareWebshopData();

          // Assert that the items property has been correctly populated
          $this->assertEquals($expectedItems, $shopModel->items);
  }
        

    public function testprepareOrderData() {
        $expectedOrders = [
          ['id' =>  1, 'item_name' => 'Item  1', 'user_id' =>  1, 'amount' =>  10],
          ['id' =>  2, 'item_name' => 'Item  2', 'user_id' =>  1, 'amount' =>  20]
        ];

        $userId = 1;


        $mockCrud = $this->createMock(Crud::class);
        $mockShopCrud = $this->getMockBuilder(ShopCrud:: class)
        ->setConstructorArgs([$mockCrud])
        ->getMock();
        $mockShopCrud->method('retrieveOrderHistory')
        ->with($userId)
        ->willReturn($expectedOrders);

        $mockPageModel = $this->createMock(PageModel::class);
        $shopModel = new ShopModel($mockPageModel, $mockShopCrud);

        ob_start(); //capture any echo statement
        $shopModel->prepareOrderData($userId);
        $output = ob_get_clean(); //get output

        //Assertions
        $this->assertEquals($expectedOrders, $shopModel->orders);
        $this->assertEquals("", $output); //there shouldnt be an echo
    }

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

        $mockCrud = $this->createMock(Crud::class);

        $mockShopCrud = $this->getMockBuilder(ShopCrud::class)
        ->setConstructorArgs([$mockCrud])
        ->getMock();
        $mockPageModel = $this->createMock(PageModel::class);


        //instantiating shopmodel with these mocked dependencies
        $shopModel = new ShopModel($mockPageModel, $mockShopCrud);

        //Call method under test instance
        $shopModel->addToCart($userId, $itemId, $amount, $itemDetails);

        $cart = $shopModel->cart;

        //Assertions
        $this->assertNotEmpty($cart);
        $this->assertCount(4, $cart); //check number of elements in array
        $this->assertEquals($userId, $cart[0]['userId']);
        $this->assertEquals($itemId, $cart[0]['itemId']);
        $this->assertEquals($amount, $cart[0]['amount']);
        $this->assertEquals($itemDetails, $cart[0]['itemDetails']);
    }

    public function testSetItemDetails() {
      $mockCrud = $this->createMock(Crud::class);

      $mockShopCrud = $this->getMockBuilder(ShopCrud::class)
                         ->setConstructorArgs([$mockCrud])
                         ->getMock();

      $mockPageModel = $this->createMock(PageModel::class);

      $shopModel = new ShopModel($mockPageModel, $mockShopCrud);

      $itemDetails = [
        'id' =>  1,
        'name' => 'Test Item',
        'price' =>  10.99,
        'image' => 'test-item.jpg'
      ];

      $shopModel->setItemDetails($itemDetails);

      $this->assertEquals($itemDetails, $shopModel->itemDetails);                  
    }

    public function testPlaceOrder() {
      $mockCrud = $this->createMock(Crud::class);
      $mockShopCrud = $this->getMockBuilder(ShopCrud::class)
      ->setConstructorArgs([$mockCrud])
      ->getMock();

      //instantiating shopmodel with mocked dependencies
      $mockPageModel = $this->createMock(PageModel::class);
      $shopModel = new ShopModel($mockPageModel, $mockShopCrud);

      // Stub the getCart() method of SessionManager
    $shopModel->sessionManager = $this->getMockBuilder(SessionManager::class)
    ->getMock();
    $shopModel->sessionManager->expects($this->once())
    ->method('getCart')
    ->willReturn([
    ['itemId' => 1, 'amount' => 2],
    ['itemId' => 2, 'amount' => 1],
    ]);
    
      $shopModel->placeOrder(123, 'testuser');
    }
}