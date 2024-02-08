<?php
use PHPUnit\Framework\TestCase;

class ShopModelTest extends TestCase {
    public function testPrepWebShop() {
        //prepare
        $crud = new TestShopCrud(); //dummy CRUD
        $crud->arrayToReturn = array(1 => $this->createTestProduct(1),
                                     3 => $this->createTestProduct(3),
        $pageModel = new PageModel(null);
        $model = new ShopModel($pageModel, $crud); //Object to test<<
        
        //test</span>
        $model->prepWebshop();

        //validate</span>
        $this->assertNotEmpty($model->products);
        $this->assertEqual(1, count($crud->sqlQueries));
        $this->assertEqual($crud0->arrayToReturn, $model->products);
    }

    /**
      * Helper function to create a new test 
      *
      * @param int $id the id of the product 
      * @return a new Product instance.
      */
        function createTestProduct($id) {
            return new TestProduct($id, "Test".$id, "A Test product", $id * 1.01,"testimage.jpg");
        
        //other functions of the productModel to test all called "test...."
        
      }
}

?>