<?php

namespace App\Http\Controllers;

use App\Number;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\User;
use App\SendLog;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class CreateDataController extends Controller
{

    // set the records number you wish to create
    protected $users = 10;
    protected $numbers = 20;
    protected $countries = 10;
    protected $logs = 500;

    public function create() {

        $users_created = $this->createFakeUsers($this->users);

        $countries_created = $this->createCountries();

        $numbers_created = $this->createFakeNumbers($this->numbers);

        $logs_created = $this->createFakeLogs($this->logs);

        return view('create_data', [
            'users' => $users_created ?? 0,
            'countries' => $countries_created ?? 0,
            'numbers' => $numbers_created ?? 0,
            'logs' => $logs_created ?? 0
        ]);

    }

    /**
     * @param $max
     * @return int
     */
    public function createFakeLogs($max) {

        $faker = Factory::create();

        for($i=0; $i<$max; $i++) {
            $log = new SendLog();

            $log->usr_id = $faker->numberBetween(1, $this->users);
            $log->num_id = $faker->numberBetween(1, $this->numbers);
            $log->log_message = $faker->text(200);
            $log->log_success = $faker->boolean(50);
            $log->log_created = $faker->dateTimeBetween('-10 days','now', null)->format('Y-m-d H:i:s');

            $log->save();
        }
        return $i;

    }

    /**
     * @param $max
     * @return int
     */
    public function createFakeNumbers($max) {

        $faker = Factory::create();

        for($i=0; $i<$max; $i++) {
            $number = new Number();
            $number->num_number = $faker->phoneNumber;
            $number->cnt_id = $faker->numberBetween(1, $this->countries);
            $number->save();
        }
        return $i;
    }

    /**
     * @param $max
     * @return int
     */
    public function createFakeUsers($max) {

        $faker = Factory::create();

        for($i=0; $i<$max; $i++) {
            $user = new User();
            $user->usr_name = $faker->name;
            $user->usr_active = $faker->boolean(90);
            $user->usr_created = $faker->dateTimeBetween('-10 days', 'now');
            $user->save();
        }
        return $i;
    }

    public function createCountries() {
        DB::table('countries')->insert([
            ['cnt_code' => 'AF', 'cnt_title' => 'Afghanistan'],
            ['cnt_code' => 'AL', 'cnt_title' => 'Albania'],
            ['cnt_code' => 'DZ', 'cnt_title' => 'Algeria'],
            ['cnt_code' => 'DS', 'cnt_title' => 'American Samoa'],
            ['cnt_code' => 'AD', 'cnt_title' => 'Andorra'],
            ['cnt_code' => 'AO', 'cnt_title' => 'Angola'],
            ['cnt_code' => 'AI', 'cnt_title' => 'Anguilla'],
            ['cnt_code' => 'AQ', 'cnt_title' => 'Antarctica'],
            ['cnt_code' => 'AG', 'cnt_title' => 'Antigua and Barbuda'],
            ['cnt_code' => 'AR', 'cnt_title' => 'Argentina'],
//            ['cnt_code' => 'AM', 'cnt_title' => 'Armenia'],
//            ['cnt_code' => 'AW', 'cnt_title' => 'Aruba'],
//            ['cnt_code' => 'AU', 'cnt_title' => 'Australia'],
//            ['cnt_code' => 'AT', 'cnt_title' => 'Austria'],
//            ['cnt_code' => 'AZ', 'cnt_title' => 'Azerbaijan'],
//            ['cnt_code' => 'BS', 'cnt_title' => 'Bahamas'],
//            ['cnt_code' => 'BH', 'cnt_title' => 'Bahrain'],
//            ['cnt_code' => 'BD', 'cnt_title' => 'Bangladesh'],
//            ['cnt_code' => 'BB', 'cnt_title' => 'Barbados'],
//            ['cnt_code' => 'BY', 'cnt_title' => 'Belarus'],
//            ['cnt_code' => 'BE', 'cnt_title' => 'Belgium'],
//            ['cnt_code' => 'BZ', 'cnt_title' => 'Belize'],
//            ['cnt_code' => 'BJ', 'cnt_title' => 'Benin'],
//            ['cnt_code' => 'BM', 'cnt_title' => 'Bermuda'],
//            ['cnt_code' => 'BT', 'cnt_title' => 'Bhutan'],
//            ['cnt_code' => 'BO', 'cnt_title' => 'Bolivia'],
//            ['cnt_code' => 'BA', 'cnt_title' => 'Bosnia and Herzegovina'],
//            ['cnt_code' => 'BW', 'cnt_title' => 'Botswana'],
//            ['cnt_code' => 'BV', 'cnt_title' => 'Bouvet Island'],
//            ['cnt_code' => 'BR', 'cnt_title' => 'Brazil'],
//            ['cnt_code' => 'IO', 'cnt_title' => 'British Indian Ocean Territory'],
//            ['cnt_code' => 'BN', 'cnt_title' => 'Brunei Darussalam'],
//            ['cnt_code' => 'BG', 'cnt_title' => 'Bulgaria'],
//            ['cnt_code' => 'BF', 'cnt_title' => 'Burkina Faso'],
//            ['cnt_code' => 'BI', 'cnt_title' => 'Burundi'],
//            ['cnt_code' => 'KH', 'cnt_title' => 'Cambodia'],
//            ['cnt_code' => 'CM', 'cnt_title' => 'Cameroon'],
//            ['cnt_code' => 'CA', 'cnt_title' => 'Canada'],
//            ['cnt_code' => 'CV', 'cnt_title' => 'Cape Verde'],
//            ['cnt_code' => 'KY', 'cnt_title' => 'Cayman Islands'],
//            ['cnt_code' => 'CF', 'cnt_title' => 'Central African Republic'],
//            ['cnt_code' => 'TD', 'cnt_title' => 'Chad'],
//            ['cnt_code' => 'CL', 'cnt_title' => 'Chile'],
//            ['cnt_code' => 'CN', 'cnt_title' => 'China'],
//            ['cnt_code' => 'CX', 'cnt_title' => 'Christmas Island'],
//            ['cnt_code' => 'CC', 'cnt_title' => 'Cocos (Keeling) Islands'],
//            ['cnt_code' => 'CO', 'cnt_title' => 'Colombia'],
//            ['cnt_code' => 'KM', 'cnt_title' => 'Comoros'],
//            ['cnt_code' => 'CG', 'cnt_title' => 'Congo'],
//            ['cnt_code' => 'CK', 'cnt_title' => 'Cook Islands'],
//            ['cnt_code' => 'CR', 'cnt_title' => 'Costa Rica'],
//            ['cnt_code' => 'HR', 'cnt_title' => 'Croatia (Hrvatska)'],
//            ['cnt_code' => 'CU', 'cnt_title' => 'Cuba'],
//            ['cnt_code' => 'CY', 'cnt_title' => 'Cyprus'],
//            ['cnt_code' => 'CZ', 'cnt_title' => 'Czech Republic'],
//            ['cnt_code' => 'DK', 'cnt_title' => 'Denmark'],
//            ['cnt_code' => 'DJ', 'cnt_title' => 'Djibouti'],
//            ['cnt_code' => 'DM', 'cnt_title' => 'Dominica'],
//            ['cnt_code' => 'DO', 'cnt_title' => 'Dominican Republic'],
//            ['cnt_code' => 'TP', 'cnt_title' => 'East Timor'],
//            ['cnt_code' => 'EC', 'cnt_title' => 'Ecuador'],
//            ['cnt_code' => 'EG', 'cnt_title' => 'Egypt'],
//            ['cnt_code' => 'SV', 'cnt_title' => 'El Salvador'],
//            ['cnt_code' => 'GQ', 'cnt_title' => 'Equatorial Guinea'],
//            ['cnt_code' => 'ER', 'cnt_title' => 'Eritrea'],
//            ['cnt_code' => 'EE', 'cnt_title' => 'Estonia'],
//            ['cnt_code' => 'ET', 'cnt_title' => 'Ethiopia'],
//            ['cnt_code' => 'FK', 'cnt_title' => 'Falkland Islands (Malvinas)'],
//            ['cnt_code' => 'FO', 'cnt_title' => 'Faroe Islands'],
//            ['cnt_code' => 'FJ', 'cnt_title' => 'Fiji'],
//            ['cnt_code' => 'FI', 'cnt_title' => 'Finland'],
//            ['cnt_code' => 'FR', 'cnt_title' => 'France'],
//            ['cnt_code' => 'FX', 'cnt_title' => 'France, Metropolitan'],
//            ['cnt_code' => 'GF', 'cnt_title' => 'French Guiana'],
//            ['cnt_code' => 'PF', 'cnt_title' => 'French Polynesia'],
//            ['cnt_code' => 'TF', 'cnt_title' => 'French Southern Territories'],
//            ['cnt_code' => 'GA', 'cnt_title' => 'Gabon'],
//            ['cnt_code' => 'GM', 'cnt_title' => 'Gambia'],
//            ['cnt_code' => 'GE', 'cnt_title' => 'Georgia'],
//            ['cnt_code' => 'DE', 'cnt_title' => 'Germany'],
//            ['cnt_code' => 'GH', 'cnt_title' => 'Ghana'],
//            ['cnt_code' => 'GI', 'cnt_title' => 'Gibraltar'],
//            ['cnt_code' => 'GK', 'cnt_title' => 'Guernsey'],
//            ['cnt_code' => 'GR', 'cnt_title' => 'Greece'],
//            ['cnt_code' => 'GL', 'cnt_title' => 'Greenland'],
//            ['cnt_code' => 'GD', 'cnt_title' => 'Grenada'],
//            ['cnt_code' => 'GP', 'cnt_title' => 'Guadeloupe'],
//            ['cnt_code' => 'GU', 'cnt_title' => 'Guam'],
//            ['cnt_code' => 'GT', 'cnt_title' => 'Guatemala'],
//            ['cnt_code' => 'GN', 'cnt_title' => 'Guinea'],
//            ['cnt_code' => 'GW', 'cnt_title' => 'Guinea-Bissau'],
//            ['cnt_code' => 'GY', 'cnt_title' => 'Guyana'],
//            ['cnt_code' => 'HT', 'cnt_title' => 'Haiti'],
//            ['cnt_code' => 'HM', 'cnt_title' => 'Heard and Mc Donald Islands'],
//            ['cnt_code' => 'HN', 'cnt_title' => 'Honduras'],
//            ['cnt_code' => 'HK', 'cnt_title' => 'Hong Kong'],
//            ['cnt_code' => 'HU', 'cnt_title' => 'Hungary'],
//            ['cnt_code' => 'IS', 'cnt_title' => 'Iceland'],
//            ['cnt_code' => 'IN', 'cnt_title' => 'India'],
//            ['cnt_code' => 'IM', 'cnt_title' => 'Isle of Man'],
//            ['cnt_code' => 'ID', 'cnt_title' => 'Indonesia'],
//            ['cnt_code' => 'IR', 'cnt_title' => 'Iran (Islamic Republic of)'],
//            ['cnt_code' => 'IQ', 'cnt_title' => 'Iraq'],
//            ['cnt_code' => 'IE', 'cnt_title' => 'Ireland'],
//            ['cnt_code' => 'IL', 'cnt_title' => 'Israel'],
//            ['cnt_code' => 'IT', 'cnt_title' => 'Italy'],
//            ['cnt_code' => 'CI', 'cnt_title' => 'Ivory Coast'],
//            ['cnt_code' => 'JE', 'cnt_title' => 'Jersey'],
//            ['cnt_code' => 'JM', 'cnt_title' => 'Jamaica'],
//            ['cnt_code' => 'JP', 'cnt_title' => 'Japan'],
//            ['cnt_code' => 'JO', 'cnt_title' => 'Jordan'],
//            ['cnt_code' => 'KZ', 'cnt_title' => 'Kazakhstan'],
//            ['cnt_code' => 'KE', 'cnt_title' => 'Kenya'],
//            ['cnt_code' => 'KI', 'cnt_title' => 'Kiribati'],
//            ['cnt_code' => 'KP', 'cnt_title' => 'Korea, Democratic Peoples Republic of'],
//             ['cnt_code' => 'KR', 'cnt_title' => 'Korea, Republic of'],
//             ['cnt_code' => 'XK', 'cnt_title' => 'Kosovo'],
//             ['cnt_code' => 'KW', 'cnt_title' => 'Kuwait'],
//             ['cnt_code' => 'KG', 'cnt_title' => 'Kyrgyzstan'],
//             ['cnt_code' => 'LA', 'cnt_title' => 'Lao Peoples Democratic Republic'],
//             ['cnt_code' => 'LV', 'cnt_title' => 'Latvia'],
//             ['cnt_code' => 'LB', 'cnt_title' => 'Lebanon'],
//             ['cnt_code' => 'LS', 'cnt_title' => 'Lesotho'],
//             ['cnt_code' => 'LR', 'cnt_title' => 'Liberia'],
//             ['cnt_code' => 'LY', 'cnt_title' => 'Libyan Arab Jamahiriya'],
//             ['cnt_code' => 'LI', 'cnt_title' => 'Liechtenstein'],
//             ['cnt_code' => 'LT', 'cnt_title' => 'Lithuania'],
//             ['cnt_code' => 'LU', 'cnt_title' => 'Luxembourg'],
//             ['cnt_code' => 'MO', 'cnt_title' => 'Macau'],
//             ['cnt_code' => 'MK', 'cnt_title' => 'Macedonia'],
//             ['cnt_code' => 'MG', 'cnt_title' => 'Madagascar'],
//             ['cnt_code' => 'MW', 'cnt_title' => 'Malawi'],
//             ['cnt_code' => 'MY', 'cnt_title' => 'Malaysia'],
//             ['cnt_code' => 'MV', 'cnt_title' => 'Maldives'],
//             ['cnt_code' => 'ML', 'cnt_title' => 'Mali'],
//             ['cnt_code' => 'MT', 'cnt_title' => 'Malta'],
//             ['cnt_code' => 'MH', 'cnt_title' => 'Marshall Islands'],
//             ['cnt_code' => 'MQ', 'cnt_title' => 'Martinique'],
//             ['cnt_code' => 'MR', 'cnt_title' => 'Mauritania'],
//             ['cnt_code' => 'MU', 'cnt_title' => 'Mauritius'],
//             ['cnt_code' => 'TY', 'cnt_title' => 'Mayotte'],
//             ['cnt_code' => 'MX', 'cnt_title' => 'Mexico'],
//             ['cnt_code' => 'FM', 'cnt_title' => 'Micronesia, Federated States of'],
//             ['cnt_code' => 'MD', 'cnt_title' => 'Moldova, Republic of'],
//             ['cnt_code' => 'MC', 'cnt_title' => 'Monaco'],
//             ['cnt_code' => 'MN', 'cnt_title' => 'Mongolia'],
//             ['cnt_code' => 'ME', 'cnt_title' => 'Montenegro'],
//             ['cnt_code' => 'MS', 'cnt_title' => 'Montserrat'],
//             ['cnt_code' => 'MA', 'cnt_title' => 'Morocco'],
//             ['cnt_code' => 'MZ', 'cnt_title' => 'Mozambique'],
//             ['cnt_code' => 'MM', 'cnt_title' => 'Myanmar'],
//             ['cnt_code' => 'NA', 'cnt_title' => 'Namibia'],
//             ['cnt_code' => 'NR', 'cnt_title' => 'Nauru'],
//             ['cnt_code' => 'NP', 'cnt_title' => 'Nepal'],
//             ['cnt_code' => 'NL', 'cnt_title' => 'Netherlands'],
//             ['cnt_code' => 'AN', 'cnt_title' => 'Netherlands Antilles'],
//             ['cnt_code' => 'NC', 'cnt_title' => 'New Caledonia'],
//             ['cnt_code' => 'NZ', 'cnt_title' => 'New Zealand'],
//             ['cnt_code' => 'NI', 'cnt_title' => 'Nicaragua'],
//             ['cnt_code' => 'NE', 'cnt_title' => 'Niger'],
//             ['cnt_code' => 'NG', 'cnt_title' => 'Nigeria'],
//             ['cnt_code' => 'NU', 'cnt_title' => 'Niue'],
//             ['cnt_code' => 'NF', 'cnt_title' => 'Norfolk Island'],
//             ['cnt_code' => 'MP', 'cnt_title' => 'Northern Mariana Islands'],
//             ['cnt_code' => 'NO', 'cnt_title' => 'Norway'],
//             ['cnt_code' => 'OM', 'cnt_title' => 'Oman'],
//             ['cnt_code' => 'PK', 'cnt_title' => 'Pakistan'],
//             ['cnt_code' => 'PW', 'cnt_title' => 'Palau'],
//             ['cnt_code' => 'PS', 'cnt_title' => 'Palestine'],
//             ['cnt_code' => 'PA', 'cnt_title' => 'Panama'],
//             ['cnt_code' => 'PG', 'cnt_title' => 'Papua New Guinea'],
//             ['cnt_code' => 'PY', 'cnt_title' => 'Paraguay'],
//             ['cnt_code' => 'PE', 'cnt_title' => 'Peru'],
//             ['cnt_code' => 'PH', 'cnt_title' => 'Philippines'],
//             ['cnt_code' => 'PN', 'cnt_title' => 'Pitcairn'],
//             ['cnt_code' => 'PL', 'cnt_title' => 'Poland'],
//             ['cnt_code' => 'PT', 'cnt_title' => 'Portugal'],
//             ['cnt_code' => 'PR', 'cnt_title' => 'Puerto Rico'],
//             ['cnt_code' => 'QA', 'cnt_title' => 'Qatar'],
//             ['cnt_code' => 'RE', 'cnt_title' => 'Reunion'],
//             ['cnt_code' => 'RO', 'cnt_title' => 'Romania'],
//             ['cnt_code' => 'RU', 'cnt_title' => 'Russian Federation'],
//             ['cnt_code' => 'RW', 'cnt_title' => 'Rwanda'],
//             ['cnt_code' => 'KN', 'cnt_title' => 'Saint Kitts and Nevis'],
//             ['cnt_code' => 'LC', 'cnt_title' => 'Saint Lucia'],
//             ['cnt_code' => 'VC', 'cnt_title' => 'Saint Vincent and the Grenadines'],
//             ['cnt_code' => 'WS', 'cnt_title' => 'Samoa'],
//             ['cnt_code' => 'SM', 'cnt_title' => 'San Marino'],
//             ['cnt_code' => 'ST', 'cnt_title' => 'Sao Tome and Principe'],
//             ['cnt_code' => 'SA', 'cnt_title' => 'Saudi Arabia'],
//             ['cnt_code' => 'SN', 'cnt_title' => 'Senegal'],
//             ['cnt_code' => 'RS', 'cnt_title' => 'Serbia'],
//             ['cnt_code' => 'SC', 'cnt_title' => 'Seychelles'],
//             ['cnt_code' => 'SL', 'cnt_title' => 'Sierra Leone'],
//             ['cnt_code' => 'SG', 'cnt_title' => 'Singapore'],
//             ['cnt_code' => 'SK', 'cnt_title' => 'Slovakia'],
//             ['cnt_code' => 'SI', 'cnt_title' => 'Slovenia'],
//             ['cnt_code' => 'SB', 'cnt_title' => 'Solomon Islands'],
//             ['cnt_code' => 'SO', 'cnt_title' => 'Somalia'],
//             ['cnt_code' => 'ZA', 'cnt_title' => 'South Africa'],
//             ['cnt_code' => 'GS', 'cnt_title' => 'South Georgia South Sandwich Islands'],
//             ['cnt_code' => 'SS', 'cnt_title' => 'South Sudan'],
//             ['cnt_code' => 'ES', 'cnt_title' => 'Spain'],
//             ['cnt_code' => 'LK', 'cnt_title' => 'Sri Lanka'],
//             ['cnt_code' => 'SH', 'cnt_title' => 'St. Helena'],
//             ['cnt_code' => 'PM', 'cnt_title' => 'St. Pierre and Miquelon'],
//             ['cnt_code' => 'SD', 'cnt_title' => 'Sudan'],
//             ['cnt_code' => 'SR', 'cnt_title' => 'Suriname'],
//             ['cnt_code' => 'SJ', 'cnt_title' => 'Svalbard and Jan Mayen Islands'],
//             ['cnt_code' => 'SZ', 'cnt_title' => 'Swaziland'],
//             ['cnt_code' => 'SE', 'cnt_title' => 'Sweden'],
//             ['cnt_code' => 'CH', 'cnt_title' => 'Switzerland'],
//             ['cnt_code' => 'SY', 'cnt_title' => 'Syrian Arab Republic'],
//             ['cnt_code' => 'TW', 'cnt_title' => 'Taiwan'],
//             ['cnt_code' => 'TJ', 'cnt_title' => 'Tajikistan'],
//             ['cnt_code' => 'TZ', 'cnt_title' => 'Tanzania, United Republic of'],
//             ['cnt_code' => 'TH', 'cnt_title' => 'Thailand'],
//             ['cnt_code' => 'TG', 'cnt_title' => 'Togo'],
//             ['cnt_code' => 'TK', 'cnt_title' => 'Tokelau'],
//             ['cnt_code' => 'TO', 'cnt_title' => 'Tonga'],
//             ['cnt_code' => 'TT', 'cnt_title' => 'Trinidad and Tobago'],
//             ['cnt_code' => 'TN', 'cnt_title' => 'Tunisia'],
//             ['cnt_code' => 'TR', 'cnt_title' => 'Turkey'],
//             ['cnt_code' => 'TM', 'cnt_title' => 'Turkmenistan'],
//             ['cnt_code' => 'TC', 'cnt_title' => 'Turks and Caicos Islands'],
//             ['cnt_code' => 'TV', 'cnt_title' => 'Tuvalu'],
//             ['cnt_code' => 'UG', 'cnt_title' => 'Uganda'],
//             ['cnt_code' => 'UA', 'cnt_title' => 'Ukraine'],
//             ['cnt_code' => 'AE', 'cnt_title' => 'United Arab Emirates'],
//             ['cnt_code' => 'GB', 'cnt_title' => 'United Kingdom'],
//             ['cnt_code' => 'US', 'cnt_title' => 'United States'],
//             ['cnt_code' => 'UM', 'cnt_title' => 'United States minor outlying islands'],
//             ['cnt_code' => 'UY', 'cnt_title' => 'Uruguay'],
//             ['cnt_code' => 'UZ', 'cnt_title' => 'Uzbekistan'],
//             ['cnt_code' => 'VU', 'cnt_title' => 'Vanuatu'],
//             ['cnt_code' => 'VA', 'cnt_title' => 'Vatican City State'],
//             ['cnt_code' => 'VE', 'cnt_title' => 'Venezuela'],
//             ['cnt_code' => 'VN', 'cnt_title' => 'Vietnam'],
//             ['cnt_code' => 'VG', 'cnt_title' => 'Virgin Islands (British)'],
//             ['cnt_code' => 'VI', 'cnt_title' => 'Virgin Islands (U.S.)'],
//             ['cnt_code' => 'WF', 'cnt_title' => 'Wallis and Futuna Islands'],
//             ['cnt_code' => 'EH', 'cnt_title' => 'Western Sahara'],
//             ['cnt_code' => 'YE', 'cnt_title' => 'Yemen'],
//             ['cnt_code' => 'ZR', 'cnt_title' => 'Zaire'],
//             ['cnt_code' => 'ZM', 'cnt_title' => 'Zambia'],
//             ['cnt_code' => 'ZW', 'cnt_title' => 'Zimbabwe']

        ]);
    }

}

