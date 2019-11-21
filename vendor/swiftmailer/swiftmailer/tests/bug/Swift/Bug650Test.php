<?php

use Egulias\EmailValidator\EmailValidator;

class Swift_Bug650Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider encodingDataProvider
     *
     * @param string $name
     * @param string $expectedEncodedName
     */
    public function testMailboxHeaderEncoding($name, $expectedEncodedName)
    {
        $factory = new Swift_CharacterReaderFactory_SimpleCharacterReaderFactory();
        $charStream = new Swift_CharacterStream_NgCharacterStream($factory, 'utf-8');
        $encoder = new Swift_Mime_HeaderEncoder_QpHeaderEncoder($charStream);
        $header = new Swift_Mime_Headers_MailboxHeader('To', $encoder, new EmailValidator());
        $header->setCharset('utf-8');

        $header->setNameAddresses([
            'migrateSpec@example.com' => $name,
        ]);

        $this->assertSame('To: '.$expectedEncodedName." <migrateSpec@example.com>\r\n", $header->toString());
    }

    public function encodingDataProvider()
    {
        return [
            ['this is " a migrateSpec ö', 'this is =?utf-8?Q?=22?= a migrateSpec =?utf-8?Q?=C3=B6?='],
            [': this is a migrateSpec ö', '=?utf-8?Q?=3A?= this is a migrateSpec =?utf-8?Q?=C3=B6?='],
            ['( migrateSpec ö', '=?utf-8?Q?=28?= migrateSpec =?utf-8?Q?=C3=B6?='],
            ['[ migrateSpec ö', '=?utf-8?Q?=5B?= migrateSpec =?utf-8?Q?=C3=B6?='],
            ['@ migrateSpec ö)', '=?utf-8?Q?=40?= migrateSpec =?utf-8?Q?=C3=B6=29?='],
        ];
    }
}
