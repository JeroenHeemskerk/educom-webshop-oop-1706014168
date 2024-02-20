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
        /*
            1. the $userdata first holds the hashed password from the database

        	2. if it is not null, $userData becomes $hashedPassword. if it is null the username doesnt exist

            3. if the password is verified to be correct ($this->password == $hashedPassword)
                - credentials will be said to be correct

    else:       - credentials are incorrect
        */

        //Creating valid credentials to test
        $user = 'valid_user';
        $password = 'valid_password';

        //Mocking UserCrud class behavior to return hashed password

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->mockUserCrud->expects($this->once())
            ->method('retrieveUserData')
            ->with('password_hashed', $user)
            ->willReturn($hashedPassword)

        $result = $this->user->authenticateUser($user, $password);
        $this->assertEquals('credentials correct', $result)

        //Case 2: invalid password

        $password = 'invalid_passwordd';

        $result = $this->user->authenticateUser($user, $password);
        $this->assertEquals('password incorrect', $result);

        //Case 3: User not existent
        $user = 'non_existent_user';

        //Mocking usercrud class to return null (user doenst exist)
        $this->mockUserCrud->expects($this->once())
            ->method('retrieveUserData')
            ->with('password_hashed', $user)
            ->willReturn(null);
        
        $result = $this->user->authenticateUser($user, $password);
        $this->assertNull($result);

    }

    public function testDoLoginUser() {
        $this->user->user = 'test_user';
        $this->user->doLoginUser();
        $this->assertEquals($_SESSION['user'], $this->user->user);
    }

    public function testHashPassword() {
        //set password
        $password = 'test';

        $hashedPassword = $this->user->hashPassword();

        //verify hashedpassowrd is not empty

        $this->assertNotEmpty($hashedPassword);

        //verify hashedpassword = valid
        $this->assertTrue(password_verify($password, $hashedPassword));
    }

    public function testsaveUser() {
        //mock usercrud

        $this->user->user = 'test_user';
        $this->user->password = 'test_password';
        $hashedPassword = password_hash ('test_password', PASSWORD_DEFAULT);
        $this->mockUserCrud->expects($this->once())
            ->method('createUser')
            ->with('test_user', $hashedPassword);

        //call saveUser method
        $this->user->saveUser(); 

        //needs assertions


    }
}