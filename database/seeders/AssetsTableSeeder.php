<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetField;
use App\Models\AssetFieldValue;
use App\Models\Employee;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AssetsTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = AssetCategory::all()->keyBy('slug');
        $roomIds = Room::pluck('id')->all();
        $employeeIds = Employee::pluck('id')->all();
        if (empty($roomIds) || empty($employeeIds)) {
            return;
        }

        $statuses = ['in_use', 'in_use', 'in_use', 'in_stock', 'in_stock', 'in_stock', 'in_repair', 'retired', 'lost'];
        $conditions = ['Excellent', 'Good', 'Fair', 'Good', 'Excellent'];
        $vendors = ['CDW', 'Dell Direct', 'HP Store', 'Amazon Business', 'Insight', 'SHI'];

        $computers = [
            ['make' => 'Dell', 'model' => 'OptiPlex 7090', 'serial_prefix' => 'CN0'],
            ['make' => 'Dell', 'model' => 'OptiPlex 7080', 'serial_prefix' => 'CN0'],
            ['make' => 'HP', 'model' => 'ProDesk 400 G7', 'serial_prefix' => '5CD'],
            ['make' => 'HP', 'model' => 'EliteDesk 800 G6', 'serial_prefix' => '5CD'],
            ['make' => 'Lenovo', 'model' => 'ThinkCentre M90q', 'serial_prefix' => 'PF'],
            ['make' => 'Lenovo', 'model' => 'ThinkCentre M720q', 'serial_prefix' => 'PF'],
            ['make' => 'Apple', 'model' => 'Mac mini M2', 'serial_prefix' => 'C02'],
        ];
        $laptops = [
            ['make' => 'Dell', 'model' => 'Latitude 5520', 'serial_prefix' => '8VB'],
            ['make' => 'Dell', 'model' => 'XPS 15 9510', 'serial_prefix' => '9VB'],
            ['make' => 'HP', 'model' => 'EliteBook 840 G8', 'serial_prefix' => '5CD'],
            ['make' => 'Lenovo', 'model' => 'ThinkPad T14 Gen 2', 'serial_prefix' => 'PF'],
            ['make' => 'Lenovo', 'model' => 'ThinkPad X1 Carbon Gen 9', 'serial_prefix' => 'PF'],
            ['make' => 'Apple', 'model' => 'MacBook Pro 14" M1 Pro', 'serial_prefix' => 'C02'],
            ['make' => 'Apple', 'model' => 'MacBook Air M2', 'serial_prefix' => 'C02'],
        ];
        $monitors = [
            ['make' => 'Dell', 'model' => 'P2422H', 'serial_prefix' => 'CN0'],
            ['make' => 'Dell', 'model' => 'U2720Q', 'serial_prefix' => 'CN0'],
            ['make' => 'HP', 'model' => 'E24 G4', 'serial_prefix' => '5CD'],
            ['make' => 'LG', 'model' => '24MP88HV-S', 'serial_prefix' => 'LG'],
            ['make' => 'BenQ', 'model' => 'GW2480', 'serial_prefix' => 'BNQ'],
        ];
        $printers = [
            ['make' => 'HP', 'model' => 'LaserJet Pro M404dn', 'serial_prefix' => 'VNB'],
            ['make' => 'HP', 'model' => 'OfficeJet Pro 9015e', 'serial_prefix' => 'VNB'],
            ['make' => 'Brother', 'model' => 'HL-L2350DW', 'serial_prefix' => 'E6J'],
            ['make' => 'Canon', 'model' => 'imageCLASS MF445dw', 'serial_prefix' => 'GAR'],
        ];
        $tvs = [
            ['make' => 'Samsung', 'model' => '65" QLED Q60A', 'serial_prefix' => 'Z4A'],
            ['make' => 'LG', 'model' => '55" 4K UHD', 'serial_prefix' => 'LG'],
        ];
        $phones = [
            ['make' => 'Cisco', 'model' => 'IP Phone 8845', 'serial_prefix' => 'FCW'],
            ['make' => 'Poly', 'model' => 'VVX 401', 'serial_prefix' => 'POL'],
            ['make' => 'Yealink', 'model' => 'T54W', 'serial_prefix' => 'YEA'],
        ];
        $tablets = [
            ['make' => 'Apple', 'model' => 'iPad Pro 11"', 'serial_prefix' => 'DMP'],
            ['make' => 'Samsung', 'model' => 'Galaxy Tab S8', 'serial_prefix' => 'R5C'],
            ['make' => 'Microsoft', 'model' => 'Surface Go 3', 'serial_prefix' => 'SFG'],
        ];
        $networking = [
            ['make' => 'Cisco', 'model' => 'Catalyst 2960', 'serial_prefix' => 'FCW'],
            ['make' => 'Ubiquiti', 'model' => 'UniFi Switch 24', 'serial_prefix' => 'UBNT'],
            ['make' => 'Netgear', 'model' => 'GS324TP', 'serial_prefix' => 'NG'],
        ];
        $peripherals = [
            ['make' => 'Logitech', 'model' => 'MX Master 3', 'serial_prefix' => 'LOG'],
            ['make' => 'Microsoft', 'model' => 'Surface Keyboard', 'serial_prefix' => 'MS'],
            ['make' => 'Dell', 'model' => 'KB216', 'serial_prefix' => 'CN0'],
        ];
        $speakers = [
            ['make' => 'Logitech', 'model' => 'Z207', 'serial_prefix' => 'LOG'],
            ['make' => 'JBL', 'model' => 'Professional 305P', 'serial_prefix' => 'JBL'],
        ];

        $assetNum = 1;
        $createAsset = function (array $spec, int $categoryId, string $tagPrefix, ?Carbon $purchaseDate = null, ?Carbon $warrantyExpiry = null) use (&$assetNum, $roomIds, $employeeIds, $statuses, $conditions, $vendors) {
            $status = $statuses[array_rand($statuses)];
            $assigned = ($status === 'in_use' && !empty($employeeIds)) ? $employeeIds[array_rand($employeeIds)] : null;
            $roomId = ($status === 'in_stock' || $status === 'in_repair') ? $roomIds[array_rand($roomIds)] : ($status === 'in_use' ? ($roomIds[array_rand($roomIds)] ?? null) : null);
            $purchaseDate = $purchaseDate ?? Carbon::now()->subYears(rand(1, 4))->subDays(rand(0, 364));
            $warrantyExpiry = $warrantyExpiry ?? $purchaseDate->copy()->addYears(rand(1, 3))->addDays(rand(0, 180));
            $cost = rand(300, 2500) + (rand(0, 99) / 100);
            $tag = $tagPrefix . str_pad((string) $assetNum++, 3, '0', STR_PAD_LEFT);
            $serial = ($spec['serial_prefix'] ?? 'SN') . strtoupper(bin2hex(random_bytes(4)));

            Asset::firstOrCreate(
                ['asset_tag' => $tag],
                [
                    'asset_category_id' => $categoryId,
                    'asset_tag' => $tag,
                    'serial_number' => $serial,
                    'make' => $spec['make'],
                    'model' => $spec['model'],
                    'purchase_date' => $purchaseDate,
                    'vendor' => $vendors[array_rand($vendors)],
                    'cost' => $cost,
                    'warranty_expiry' => $warrantyExpiry,
                    'status' => $status,
                    'condition' => $conditions[array_rand($conditions)],
                    'room_id' => $roomId,
                    'assigned_employee_id' => $assigned,
                    'notes' => rand(0, 10) > 8 ? 'Minor wear. ' : null,
                ]
            );
        };

        $cat = $categories->get('computer');
        if ($cat) {
            for ($i = 0; $i < 12; $i++) {
                $spec = $computers[array_rand($computers)];
                $purchaseDate = Carbon::now()->subYears(rand(1, 3))->subDays(rand(0, 300));
                $warrantyExpiry = (rand(0, 10) > 7) ? Carbon::now()->addDays(rand(30, 400)) : Carbon::now()->subDays(rand(10, 400));
                $createAsset($spec, $cat->id, 'PC-', $purchaseDate, $warrantyExpiry);
            }
        }

        $cat = $categories->get('laptop');
        if ($cat) {
            for ($i = 0; $i < 14; $i++) {
                $spec = $laptops[array_rand($laptops)];
                $purchaseDate = Carbon::now()->subYears(rand(0, 3))->subDays(rand(0, 300));
                $warrantyExpiry = (rand(0, 10) > 6) ? Carbon::now()->addDays(rand(45, 500)) : Carbon::now()->subDays(rand(20, 200));
                $createAsset($spec, $cat->id, 'LAP-', $purchaseDate, $warrantyExpiry);
            }
        }

        $cat = $categories->get('monitor');
        if ($cat) {
            for ($i = 0; $i < 15; $i++) {
                $spec = $monitors[array_rand($monitors)];
                $createAsset($spec, $cat->id, 'MON-');
            }
        }

        $cat = $categories->get('printer');
        if ($cat) {
            for ($i = 0; $i < 6; $i++) {
                $spec = $printers[array_rand($printers)];
                $createAsset($spec, $cat->id, 'PRN-');
            }
        }

        $cat = $categories->get('tv');
        if ($cat) {
            for ($i = 0; $i < 4; $i++) {
                $spec = $tvs[array_rand($tvs)];
                $createAsset($spec, $cat->id, 'TV-');
            }
        }

        $cat = $categories->get('phone');
        if ($cat) {
            for ($i = 0; $i < 10; $i++) {
                $spec = $phones[array_rand($phones)];
                $createAsset($spec, $cat->id, 'PHN-');
            }
        }

        $cat = $categories->get('tablet');
        if ($cat) {
            for ($i = 0; $i < 5; $i++) {
                $spec = $tablets[array_rand($tablets)];
                $createAsset($spec, $cat->id, 'TAB-');
            }
        }

        $cat = $categories->get('networking');
        if ($cat) {
            for ($i = 0; $i < 4; $i++) {
                $spec = $networking[array_rand($networking)];
                $createAsset($spec, $cat->id, 'NET-');
            }
        }

        $cat = $categories->get('peripheral');
        if ($cat) {
            for ($i = 0; $i < 8; $i++) {
                $spec = $peripherals[array_rand($peripherals)];
                $createAsset($spec, $cat->id, 'PER-');
            }
        }

        $cat = $categories->get('speaker');
        if ($cat) {
            for ($i = 0; $i < 4; $i++) {
                $spec = $speakers[array_rand($speakers)];
                $createAsset($spec, $cat->id, 'SPK-');
            }
        }

        $this->seedFieldValues();
    }

    private function seedFieldValues(): void
    {
        $cpus = ['Intel Core i5-12500', 'Intel Core i7-12700', 'AMD Ryzen 5 5600G', 'Apple M2', 'Intel Core i5-10400'];
        $ram = ['8 GB', '16 GB', '32 GB', '64 GB'];
        $storage = ['256 GB SSD', '512 GB SSD', '1 TB SSD', '256 GB NVMe', '512 GB NVMe'];
        $os = ['Windows 11 Pro', 'Windows 10 Pro', 'macOS Ventura', 'macOS Sonoma'];

        foreach (Asset::with('category')->whereHas('category', fn ($q) => $q->whereIn('slug', ['computer', 'laptop']))->limit(20)->get() as $asset) {
            $category = $asset->category;
            if (!$category) {
                continue;
            }
            foreach (AssetField::where('asset_category_id', $category->id)->get() as $field) {
                $value = match ($field->key) {
                    'cpu' => $cpus[array_rand($cpus)],
                    'ram' => $ram[array_rand($ram)],
                    'storage' => $storage[array_rand($storage)],
                    'os' => $os[array_rand($os)],
                    'ip' => '10.0.' . rand(1, 50) . '.' . rand(2, 254),
                    'mac' => implode(':', array_map(fn () => str_pad(dechex(rand(0, 255)), 2, '0', STR_PAD_LEFT), range(1, 6))),
                    default => null,
                };
                if ($value !== null) {
                    AssetFieldValue::firstOrCreate(
                        ['asset_id' => $asset->id, 'asset_field_id' => $field->id],
                        ['value' => $value]
                    );
                }
            }
        }

        foreach (Asset::with('category')->whereHas('category', fn ($q) => $q->where('slug', 'printer'))->limit(4)->get() as $asset) {
            foreach (AssetField::where('asset_category_id', $asset->category->id)->get() as $field) {
                $value = match ($field->key) {
                    'ip' => '10.0.' . rand(1, 50) . '.' . rand(2, 254),
                    'toner_model' => ['CE278A', 'CE411', 'TN660'][array_rand(['CE278A', 'CE411', 'TN660'])],
                    'type' => 'Multifunction',
                    default => null,
                };
                if ($value !== null) {
                    AssetFieldValue::firstOrCreate(
                        ['asset_id' => $asset->id, 'asset_field_id' => $field->id],
                        ['value' => $value]
                    );
                }
            }
        }

        foreach (Asset::with('category')->whereHas('category', fn ($q) => $q->where('slug', 'monitor'))->limit(6)->get() as $asset) {
            foreach (AssetField::where('asset_category_id', $asset->category->id)->get() as $field) {
                $value = match ($field->key) {
                    'size' => (string) [24, 27, 32][array_rand([24, 27, 32])],
                    'panel_type' => 'IPS',
                    'resolution' => '1920x1080',
                    default => null,
                };
                if ($value !== null) {
                    AssetFieldValue::firstOrCreate(
                        ['asset_id' => $asset->id, 'asset_field_id' => $field->id],
                        ['value' => $value]
                    );
                }
            }
        }
    }
}
