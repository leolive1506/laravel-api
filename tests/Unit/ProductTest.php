<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * verbo_de_acao quem_oq_fazer resultado_esperado
     */
    public function test_check_if_columns_is_correct()
    {
        $product = new Product();

        $expected = [ 'name', 'price', 'description', 'slug' ];
        $diffOne = array_diff($expected, $product->getFillable());
        $diffTwo = array_diff($product->getFillable(), $expected);

        $this->assertEquals(0, count($diffOne));
        $this->assertEquals(0, count($diffTwo));
    }
}
