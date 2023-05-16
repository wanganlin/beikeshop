<?php
/**
 * BrandsSeeder.php
 *
 * @copyright  2022 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     Edward Yang <yangjin@guangda.work>
 * @created    2022-09-05 19:42:42
 * @modified   2022-09-05 19:42:42
 */

namespace Database\Seeders;

use Beike\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = $this->getItems();

        if ($items) {
            Brand::query()->truncate();
            foreach ($items as $item) {
                Brand::query()->create($item);
            }
        }
    }


    public function getItems()
    {
        return [
            [
                "id" => 1,
                "name" => "New Balance",
                "first" => "B",
                "logo" => "Catalog/demo/brands/1.png",
                "sort_order" => 1,
                "status" => 1,
            ],
            [
                "id" => 2,
                "name" => "BROOKS",
                "first" => "B",
                "logo" => "Catalog/demo/brands/10.png",
                "sort_order" => 2,
                "status" => 1,
            ],
            [
                "id" => 3,
                "name" => "Columbia",
                "first" => "C",
                "logo" => "Catalog/demo/brands/11.png",
                "sort_order" => 3,
                "status" => 1,
            ],
            [
                "id" => 4,
                "name" => "RayBan",
                "first" => "R",
                "logo" => "Catalog/demo/brands/12.png",
                "sort_order" => 4,
                "status" => 1,
            ],
            [
                "id" => 5,
                "name" => "PUMA",
                "first" => "P",
                "logo" => "Catalog/demo/brands/2.png",
                "sort_order" => 5,
                "status" => 1,
            ],
            [
                "id" => 6,
                "name" => "HERMES",
                "first" => "H",
                "logo" => "Catalog/demo/brands/3.png",
                "sort_order" => 6,
                "status" => 1,
            ],
            [
                "id" => 7,
                "name" => "Dior",
                "first" => "D",
                "logo" => "Catalog/demo/brands/4.png",
                "sort_order" => 7,
                "status" => 1,
            ],
            [
                "id" => 8,
                "name" => "NIKE",
                "first" => "N",
                "logo" => "Catalog/demo/brands/5.png",
                "sort_order" => 8,
                "status" => 1,
            ],
            [
                "id" => 9,
                "name" => "FILA",
                "first" => "F",
                "logo" => "Catalog/demo/brands/7.png",
                "sort_order" => 9,
                "status" => 1,
            ],
            [
                "id" => 10,
                "name" => "Adidas",
                "first" => "A",
                "logo" => "Catalog/demo/brands/9.png",
                "sort_order" => 10,
                "status" => 1,
            ],
            [
                "id" => 11,
                "name" => "American Eagle",
                "first" => "A",
                "logo" => "Catalog/demo/brands/8.png",
                "sort_order" => 11,
                "status" => 1,
            ],
            [
                "id" => 12,
                "name" => "Tommy Hilfiger",
                "first" => "T",
                "logo" => "Catalog/demo/brands/6.png",
                "sort_order" => 12,
                "status" => 1,
            ]
        ];
    }

}
