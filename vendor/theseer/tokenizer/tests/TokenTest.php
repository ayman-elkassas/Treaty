<?php declare(strict_types = 1);
namespace TheSeer\Tokenizer;

use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase {

    /** @var  Token */
    private $token;

    protected function setUp() {
        $this->token = new Token(1,'migrateSpec-dummy', 'blank');
    }

    public function testTokenCanBeCreated() {
        $this->assertInstanceOf(Token::class, $this->token);
    }

    public function testTokenLineCanBeRetrieved() {
        $this->assertEquals(1, $this->token->getLine());
    }

    public function testTokenNameCanBeRetrieved() {
        $this->assertEquals('migrateSpec-dummy', $this->token->getName());
    }

    public function testTokenValueCanBeRetrieved() {
        $this->assertEquals('blank', $this->token->getValue());
    }

}
