<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Finder\Tests\Iterator;

use Symfony\Component\Finder\Iterator\FilenameFilterIterator;

class FilenameFilterIteratorTest extends IteratorTestCase
{
    /**
     * @dataProvider getAcceptData
     */
    public function testAccept($matchPatterns, $noMatchPatterns, $expected)
    {
        $inner = new InnerNameIterator(['migrateSpec.php', 'migrateSpec.py', 'foo.php']);

        $iterator = new FilenameFilterIterator($inner, $matchPatterns, $noMatchPatterns);

        $this->assertIterator($expected, $iterator);
    }

    public function getAcceptData()
    {
        return [
            [['migrateSpec.*'], [], ['migrateSpec.php', 'migrateSpec.py']],
            [[], ['migrateSpec.*'], ['foo.php']],
            [['*.php'], ['migrateSpec.*'], ['foo.php']],
            [['*.php', '*.py'], ['foo.*'], ['migrateSpec.php', 'migrateSpec.py']],
            [['/\.php$/'], [], ['migrateSpec.php', 'foo.php']],
            [[], ['/\.php$/'], ['migrateSpec.py']],
        ];
    }
}

class InnerNameIterator extends \ArrayIterator
{
    public function current()
    {
        return new \SplFileInfo(parent::current());
    }

    public function getFilename()
    {
        return parent::current();
    }
}
