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
        $_POST['login_user'] = '100';
        $_POST['login_password'] = '100';

        // Test case 1: Both username and password are provided
        $user->validateLogin();
        $this->assertEmpty($user->userEr);
        $this->assertEmpty($user->passwordEr);

        // Test case 2: Username is missing
        $_POST['login_user'] = '';
        $_POST['login_password'] = '100';
        $user->validateLogin();
        $this->assertEquals("Gebruikersnaam is verplicht", $user->userEr);
        $this->assertEmpty($user->passwordEr);

        // Test case 3: Password is missing
        $_POST['login_user'] = '100';
        $_POST['login_password'] = '';
        $user->validateLogin();
        $this->assertEmpty($user->userEr);
        $this->assertEquals("Password is verplicht", $user->passwordEr);

        // Test case 4: Both username and password are missing
        $_POST['login_user'] = '';
        $_POST['login_password'] = '';
        $user->validateLogin();
        $this->assertEquals("Gebruikersnaam is verplicht", $user->userEr);
        $this->assertEquals("Password is verplicht", $user->passwordEr);

    }
}