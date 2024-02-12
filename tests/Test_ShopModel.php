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
      
      $mockShopCrud = $this->createMock(ShopCrud::class);
      $mockShopCrud->method('retrieveAllItems')->willReturn($expectedItems);

      $pageModel = new PageModel(null);
      $shopModel = new ShopModel($pageModel, $mockShopCrud);

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

      //Create shopmodel object with mock shopCrud object
      $mockShopCrud = $this->createMock(ShopCrud:: class);
      $mockShopCrud->method('retrieveOrderHistory')->willReturn($expectedOrders);

      $pageModel = new PageModel(null);
      $shopModel = new ShopModel($pageModel, $mockShopCrud);
      ob_start(); //capture any echo statement
      $shopModel->prepareOrderData($userId);
      $output = ob_get_clean(); //get output

      //Assertions
      $this->assertEquals($expectedOrders, $shopModel->orders);
      $this->assertEquals("", $output); //there shouldnt be an echo
    }






      

}

?>

<?php

/*

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
        $this->assertCount(4, $cart); //check number of elements in array
        $this->assertEquals($userId, $cart[0]['userId']);
        $this->assertEquals($itemId, $cart[0]['itemId']);
        $this->assertEquals($amount, $cart[0]['amount']);
        $this->assertEquals($itemDetails, $cart[0]['itemDetails']);
      }
    */

    ?>