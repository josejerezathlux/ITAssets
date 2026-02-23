<?php

namespace Database\Seeders;

use App\Models\AssetCategory;
use App\Models\AssetField;
use Illuminate\Database\Seeder;

class DefaultAssetFieldsSeeder extends Seeder
{
    public function run(): void
    {
        $computer = AssetCategory::where('slug', 'computer')->first();
        if ($computer) {
            $this->addFields($computer->id, [
                ['name' => 'CPU', 'key' => 'cpu', 'input_type' => 'text', 'sort_order' => 0],
                ['name' => 'RAM', 'key' => 'ram', 'input_type' => 'text', 'sort_order' => 1],
                ['name' => 'Storage', 'key' => 'storage', 'input_type' => 'text', 'sort_order' => 2],
                ['name' => 'OS', 'key' => 'os', 'input_type' => 'text', 'sort_order' => 3],
                ['name' => 'IP Address', 'key' => 'ip', 'input_type' => 'text', 'sort_order' => 4],
                ['name' => 'MAC Address', 'key' => 'mac', 'input_type' => 'text', 'sort_order' => 5],
            ]);
        }

        $laptop = AssetCategory::where('slug', 'laptop')->first();
        if ($laptop) {
            $this->addFields($laptop->id, [
                ['name' => 'CPU', 'key' => 'cpu', 'input_type' => 'text', 'sort_order' => 0],
                ['name' => 'RAM', 'key' => 'ram', 'input_type' => 'text', 'sort_order' => 1],
                ['name' => 'Storage', 'key' => 'storage', 'input_type' => 'text', 'sort_order' => 2],
                ['name' => 'OS', 'key' => 'os', 'input_type' => 'text', 'sort_order' => 3],
            ]);
        }

        $printer = AssetCategory::where('slug', 'printer')->first();
        if ($printer) {
            $this->addFields($printer->id, [
                ['name' => 'IP Address', 'key' => 'ip', 'input_type' => 'text', 'sort_order' => 0],
                ['name' => 'Toner model', 'key' => 'toner_model', 'input_type' => 'text', 'sort_order' => 1],
                ['name' => 'Type', 'key' => 'type', 'input_type' => 'select', 'options' => ['Laser', 'Inkjet', 'Multifunction'], 'sort_order' => 2],
            ]);
        }

        $tv = AssetCategory::where('slug', 'tv')->first();
        if ($tv) {
            $this->addFields($tv->id, [
                ['name' => 'Size (inches)', 'key' => 'size', 'input_type' => 'number', 'sort_order' => 0],
                ['name' => 'HDMI ports', 'key' => 'hdmi_ports', 'input_type' => 'number', 'sort_order' => 1],
            ]);
        }

        $speaker = AssetCategory::where('slug', 'speaker')->first();
        if ($speaker) {
            $this->addFields($speaker->id, [
                ['name' => 'Wattage', 'key' => 'wattage', 'input_type' => 'text', 'sort_order' => 0],
            ]);
        }

        $monitor = AssetCategory::where('slug', 'monitor')->first();
        if ($monitor) {
            $this->addFields($monitor->id, [
                ['name' => 'Size (inches)', 'key' => 'size', 'input_type' => 'number', 'sort_order' => 0],
                ['name' => 'Panel type', 'key' => 'panel_type', 'input_type' => 'text', 'sort_order' => 1],
                ['name' => 'Resolution', 'key' => 'resolution', 'input_type' => 'text', 'sort_order' => 2],
            ]);
        }

        $tablet = AssetCategory::where('slug', 'tablet')->first();
        if ($tablet) {
            $this->addFields($tablet->id, [
                ['name' => 'Screen size (inches)', 'key' => 'screen_size', 'input_type' => 'number', 'sort_order' => 0],
                ['name' => 'OS', 'key' => 'os', 'input_type' => 'text', 'sort_order' => 1],
            ]);
        }
    }

    private function addFields(int $categoryId, array $fields): void
    {
        foreach ($fields as $f) {
            AssetField::firstOrCreate(
                ['asset_category_id' => $categoryId, 'key' => $f['key']],
                [
                    'asset_category_id' => $categoryId,
                    'name' => $f['name'],
                    'key' => $f['key'],
                    'input_type' => $f['input_type'] ?? 'text',
                    'options' => $f['options'] ?? null,
                    'sort_order' => $f['sort_order'] ?? 0,
                ]
            );
        }
    }
}
