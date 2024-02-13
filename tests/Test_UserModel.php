<?php

use PHPUnit\Framework\TestCase;

include_once "./models/PageModel.php";
include_once "./models/UserModel.php";
include_once "./models/CrudUser.php";
include_once "./models/Crud.php";
include_once "IUserCrud.php";
include_once "ICrud.php";

class Test_UserModel extends TestCase {
    public function testValidateLogin() {

        $mockPageModel = $this->createMock(PageModel::class);
        $mockUserCrud = $this->createMock(UserCrud::class);
        //creating instance of class with mock constructor arguments
        $user = new UserModel($mockPageModel, $mockUserCrud);

        //needed to fall into the proper if condition if(isPost)
        $user->isPost = true;

        //Checking with no username or password
        // Validate login
        $user->validateLogin();
        $this->assertFalse($user->valid);
        $this->assertEquals("Gebruikersnaam is verplicht", $user->userEr);

        $username = ""; //empty username 
        $password = ""; //empty password

        //setting post variables
        $user->user = $username;
        $user->password = $password;
    }
}