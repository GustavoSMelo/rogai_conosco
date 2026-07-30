<?php

namespace Tests\Unit;

use App\Casts\EncryptedString;
use Illuminate\Support\Facades\Crypt;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EncryptedStringCastTest extends TestCase
{
    private EncryptedString $cast;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cast = new EncryptedString();
    }

    #[Test]
    public function it_encrypts_on_set(): void
    {
        $result = $this->cast->set(null, 'whatsapp', '+5511999999999', []);

        $this->assertNotNull($result);
        $this->assertNotEquals('+5511999999999', $result);
        $this->assertEquals('+5511999999999', Crypt::decryptString($result));
    }

    #[Test]
    public function it_decrypts_on_get(): void
    {
        $encrypted = Crypt::encryptString('+5511999999999');

        $result = $this->cast->get(null, 'whatsapp', $encrypted, []);

        $this->assertEquals('+5511999999999', $result);
    }

    #[Test]
    public function it_returns_null_on_set_when_null(): void
    {
        $result = $this->cast->set(null, 'whatsapp', null, []);

        $this->assertNull($result);
    }

    #[Test]
    public function it_returns_null_on_get_when_null(): void
    {
        $result = $this->cast->get(null, 'whatsapp', null, []);

        $this->assertNull($result);
    }
}
