<?php

use PHPUnit\Framework\TestCase;

include_once "./models/PageModel.php";
include_once "./models/UserModel.php";
include_once "./models/CrudUser.php";
include_once "./models/Crud.php";
include_once "IUserCrud.php";
include_once "ICrud.php";

class Test_UserModel extends TestCase {

    public function setUp(): void {
        $this->mockPageModel = $this->createMock(PageModel::class);
        $this->mockUserCrud = $this->createMock(UserCrud::class);
        $this->user = new UserModel($this->mockPageModel, $this->mockUserCrud);
    }
    public function testValidateLogin() {

        //needed to fall into the proper if condition if(isPost)
        $this->user->isPost = true;
        $_POST['login_user'] = '100';
        $_POST['login_password'] = '100';

        // Test case 1: Both username and password are provided
        $this->user->validateLogin();
        $this->assertEmpty($this->user->userEr);
        $this->assertEmpty($this->user->passwordEr);

        // Test case 2: Username is missing
        $_POST['login_user'] = '';
        $_POST['login_password'] = '100';
        $this->user->validateLogin();
        $this->assertEquals("Gebruikersnaam is verplicht", $this->user->userEr);
        $this->assertEmpty($this->user->passwordEr);

        // Test case 3: Password is missing
        $_POST['login_user'] = '100';
        $_POST['login_password'] = '';
        $this->user->validateLogin();
        $this->assertEmpty($this->user->userEr);
        $this->assertEquals("Password is verplicht", $this->user->passwordEr);

        // Test case 4: Both username and password are missing
        $_POST['login_user'] = '';
        $_POST['login_password'] = '';
        $this->user->validateLogin();
        $this->assertEquals("Gebruikersnaam is verplicht", $this->user->userEr);
        $this->assertEquals("Password is verplicht", $this->user->passwordEr);

    }

    public function testValidateRegistration() {

        //needed to fall into the proper if condition if(isPost)
        $this->user->isPost = true;
        $_POST['register_user'] = '100';
        $_POST['register_password'] = '100';

        // Test case 1: Both username and password are provided
        $this->user->validateRegistration();
        $this->assertEmpty($this->user->userEr);
        $this->assertEmpty($this->user->passwordEr);

        // Test case 2: Username is missing
        $_POST['register_user'] = '';
        $_POST['register_password'] = '100';
        $this->user->validateRegistration();
        $this->assertEquals("Gebruikersnaam is verplicht", $this->user->userEr);
        $this->assertEmpty($this->user->passwordEr);

        // Test case 3: Password is missing
        $_POST['register_user'] = '100';
        $_POST['register_password'] = '';
        $this->user->validateRegistration();
        $this->assertEmpty($this->user->userEr);
        $this->assertEquals("Password is verplicht", $this->user->passwordEr);

        // Test case 4: Both username and password are missing
        $_POST['register_user'] = '';
        $_POST['register_password'] = '';
        $this->user->validateRegistration();
        $this->assertEquals("Gebruikersnaam is verplicht", $this->user->userEr);
        $this->assertEquals("Password is verplicht", $this->user->passwordEr);

    }

    public function testAuthenticateUser($user, $password) {
        //todo
    }

    public function testDoLoginUser() {
        //it is one line of code, is it testable?
    }

    public function testHashPassword() {
        //it is one line of code, is that testable?
    }

    public function testsaveUser() {
        //it is one line of code, is that testable?
    }
}