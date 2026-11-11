<?php

namespace NextDeveloper\Commons\Tests\Database\Casts;

use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Database\Casts\TextArray;
use PHPUnit\Framework\TestCase;

class TextArrayTest extends TestCase
{
    public function test_quoted_element_with_commas_is_one_value(): void
    {
        self::assertSame(
            ['Cloud Services (Modernization, Architecture, Migration)', 'AWS'],
            TextArray::parse('{"Cloud Services (Modernization, Architecture, Migration)",AWS}')
        );
    }

    public function test_escapes_braces_and_nulls(): void
    {
        self::assertSame(
            ['say "hi"', 'back\\slash', null, 'NULL', '{x}', ''],
            TextArray::parse('{"say \"hi\"","back\\\\slash",NULL,"NULL","{x}",""}')
        );
    }

    public function test_empty_array(): void
    {
        self::assertSame([], TextArray::parse('{}'));
    }

    public function test_set_then_get_round_trips(): void
    {
        $cast = new TextArray;
        $model = new class extends Model {};
        $values = ['a, b', 'c"d', 'x\\y', 'Kamu İdareleri', 'plain'];

        $stored = $cast->set($model, 'keywords', $values, []);

        self::assertSame($values, $cast->get($model, 'keywords', $stored, []));
    }
}
