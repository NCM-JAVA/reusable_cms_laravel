<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinisterInfoCategorySeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('minister_info_categories')->insert([
            [
                'category_name' => 'Minister for Consumer Affairs, Food & Public Distribution',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Minister of State for Consumer Affairs, Food & Public Distribution',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Minister of State for Consumer Affairs, Food & Public Distribution.',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Additional Secretary & Financial Advisor (AS&FA)',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Additional Secretary (Consumer Affairs)',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Senior Economic Adviser (Consumer Affairs)',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Joint Secretary, Economic Advisor and Chief Controller of Accounts',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Director',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Deputy Secretary / Joint Director',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Under Secretary and Deputy Director',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Assistant Director',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Section Officer',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Pay and Accounts Officers and Assistant Account Officers',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'NIC Unit',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'Other Utility Services',
                'language' => 1,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'उपभोक्ता मामले, खाद्य और सार्वजनिक वितरण मंत्री',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'उपभोक्ता मामले, खाद्य और सार्वजनिक वितरण राज्य मंत्री',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'उपभोक्ता मामले, खाद्य और सार्वजनिक वितरण राज्य मंत्री|',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'सचिव (उपभोक्ता मामले)',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'अपर सचिव और वित्तीय सलाहकार (एएस एंड एफए)',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'अपर सचिव (उपभोक्ता मामले)',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'वरिष्ठ आर्थिक सलाहकार (उपभोक्ता मामले)',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'संयुक्त सचिव, आर्थिक सलाहकार और मुख्य नियंत्रक लेखा',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'निर्देशक',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'उप सचिव',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'अवर सचिव और उप निदेशक',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'सहायक निदेशक',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'अनुभाग अधिकारी',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'भुगतान और लेखा अधिकारी और सहायक लेखा अधिकारी',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'एनआईसी इकाई',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
            [
                'category_name' => 'अन्य उपयोगिता सेवाएं',
                'language' => 2,
                'txtstatus' => 1,
                'flag_id' => 0
            ],
        ]);
    }
}
