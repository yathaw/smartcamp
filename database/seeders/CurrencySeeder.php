<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;
use App\Models\Country;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currecnyLists = [
            array('Leke', 'ALL', 'Lek'),
            array('Dollars', 'USD', '$'),
            array('Afghanistan', 'AFN', '؋'),
            array('Pesos', 'ARS', '$'),
            array('Guilders', 'AWG', 'ƒ'),
            array('Dollars', 'AUD', '$'),
            array('New Manats', 'AZN', 'ман'),
            array('Dollars', 'BSD', '$'),
            array('Dollars', 'BBD', '$'),
            array('Rubles', 'BYR', 'p.'),
            array('Euro', 'EUR', '€'),
            array('Dollars', 'BZD', 'BZ$'),
            array('Dollars', 'BMD', '$'),
            array('Bolivianos', 'BOB', '$b'),
            array('Convertible Marka', 'BAM', 'KM'),
            array('Pula', 'BWP', 'P'),
            array('Leva', 'BGN', 'лв'),
            array('Reais', 'BRL', 'R$'),
            array('Pounds', 'GBP', '£'),
            array('Dollars', 'BND', '$'),
            array('Riels', 'KHR', '៛'),
            array('Dollars', 'CAD', '$'),
            array('Dollars', 'KYD', '$'),
            array('Pesos', 'CLP', '$'),
            array('Yuan Renminbi', 'CNY', '¥'),
            array('Pesos', 'COP', '$'),
            array('Colón', 'CRC', '₡'),
            array('Kuna', 'HRK', 'kn'),
            array('Pesos', 'CUP', '₱'),
            array('Koruny', 'CZK', 'Kč'),
            array('Kroner', 'DKK', 'kr'),
            array('Dollars', 'XCD', '$'),
            array('Pounds', 'EGP', '£'),
            array('Colones', 'SVC', '$'),
            array('Pounds', 'FKP', '£'),
            array('Dollars', 'FJD', '$'),
            array('Cedis', 'GHC', '¢'),
            array('Pounds', 'GIP', '£'),
            array('Quetzales', 'GTQ', 'Q'),
            array('Pounds', 'GGP', '£'),
            array('Dollars', 'GYD', '$'),
            array('Lempiras', 'HNL', 'L'),
            array('Dollars', 'HKD', '$'),
            array('Forint', 'HUF', 'Ft'),
            array('Kronur', 'ISK', 'kr'),
            array('Rupees', 'INR', '₹'),
            array('Rupiahs', 'IDR', 'Rp'),
            array('Rials', 'IRR', '﷼'),
            array('Pounds', 'IMP', '£'),
            array('New Shekels', 'ILS', '₪'),
            array('Dollars', 'JMD', 'J$'),
            array('Yen', 'JPY', '¥'),
            array('Pounds', 'JEP', '£'),
            array('Tenge', 'KZT', 'лв'),
            array('Won', 'KPW', '₩'),
            array('Won', 'KRW', '₩'),
            array('Soms', 'KGS', 'лв'),
            array('Kips', 'LAK', '₭'),
            array('Lati', 'LVL', 'Ls'),
            array('Pounds', 'LBP', '£'),
            array('Dollars', 'LRD', '$'),
            array('Switzerland Francs', 'CHF', 'CHF'),
            array('Litai', 'LTL', 'Lt'),
            array('Denars', 'MKD', 'ден'),
            array('Ringgits', 'MYR', 'RM'),
            array('Rupees', 'MUR', '₨'),
            array('Pesos', 'MXN', '$'),
            array('Tugriks', 'MNT', '₮'),
            array('Meticais', 'MZN', 'MT'),
            array('Dollars', 'NAD', '$'),
            array('Rupees', 'NPR', '₨'),
            array('Guilders', 'ANG', 'ƒ'),
            array('Dollars', 'NZD', '$'),
            array('Cordobas', 'NIO', 'C$'),
            array('Nairas', 'NGN', '₦'),
            array('Krone', 'NOK', 'kr'),
            array('Rials', 'OMR', '﷼'),
            array('Rupees', 'PKR', '₨'),
            array('Balboa', 'PAB', 'B/.'),
            array('Guarani', 'PYG', 'Gs'),
            array('Nuevos Soles', 'PEN', 'S/.'),
            array('Pesos', 'PHP', 'Php'),
            array('Zlotych', 'PLN', 'zł'),
            array('Rials', 'QAR', '﷼'),
            array('New Lei', 'RON', 'lei'),
            array('Rubles', 'RUB', 'руб'),
            array('Pounds', 'SHP', '£'),
            array('Riyals', 'SAR', '﷼'),
            array('Dinars', 'RSD', 'Дин.'),
            array('Rupees', 'SCR', '₨'),
            array('Dollars', 'SGD', '$'),
            array('Dollars', 'SBD', '$'),
            array('Shillings', 'SOS', 'S'),
            array('Rand', 'ZAR', 'R'),
            array('Rupees', 'LKR', '₨'),
            array('Kronor', 'SEK', 'kr'),
            array('Dollars', 'SRD', '$'),
            array('Pounds', 'SYP', '£'),
            array('New Dollars', 'TWD', 'NT$'),
            array('Baht', 'THB', '฿'),
            array('Dollars', 'TTD', 'TT$'),
            array('Lira', 'TRY', '₺'),
            array('Liras', 'TRL', '£'),
            array('Dollars', 'TVD', '$'),
            array('Hryvnia', 'UAH', '₴'),
            array('Pesos', 'UYU', '$U'),
            array('Sums', 'UZS', 'лв'),
            array('Bolivares Fuertes', 'VEF', 'Bs'),
            array('Dong', 'VND', '₫'),
            array('Rials', 'YER', '﷼'),
            array('Zimbabwe Dollars', 'ZWD', 'Z$'),
            array('Algerian dinar', 'DZD', 'DA'),
            array('Angolan kwanza', 'AOA', 'Kz'),
            array('Armenian dram', 'AMD', '֏'),
            array('Bahraini dinar', 'BHD', 'BD'),
            array('Bangladeshi taka', 'BDT', '৳'),
            array('West African CFA franc', 'XOF', 'CFA'),
            array('Burundian franc', 'BIF', 'FBu'),
            array('Central African CFA franc', 'XAF', 'FCFA'),
            array('Cape Verdean escudo', 'CVE', 'Esc'),
            array('Comorian franc', 'KMF', 'CF'),
            array('Djiboutian franc', 'DJF', 'Fdj'),
            array('Dominican peso', 'DOP', 'RD$'),
            array('Eritrean nakfa', 'ERN', 'Nkf'),
            array('Ethiopian birr', 'ETB', 'Br'),
            array('CFP franc', 'XPF', '₣'),
            array('Gambian dalasi', 'GMD', 'D'),
            array('Georgian lari', 'GEL', 'ლ'),
            array('Ghanaian cedi', 'GHS', 'GH₵'),
            array('Guinean franc', 'GNF', 'FG'),
            array('Iraqi dinar', 'IQD', 'ع.د'),
            array('Jordanian dinar', 'JOD', 'د.ا'),
            array('Kenyan shilling', 'KES', 'Ksh'),
            array('Kuwaiti dinar', 'KWD', 'د.ك'),
            array('Libyan dinar', 'LYD', 'ل.د'),
            array('Macanese pataca', 'MOP', 'MOP$'),
            array('Malagasy ariary', 'MGA', 'Ar'),
            array('Malawian kwacha', 'MWK', 'MK'),
            array('Maldivian rufiyaa', 'MVR', 'Rf'),
            array('Mauritanian ouguiya', 'MRO', 'UM'),
            array('Moldovan leu', 'MDL', 'L'),
            array('Moroccan dirham', 'MAD', 'MAD'),
            array('Myanmar kyat', 'MMK', 'K'),
            array('Papua New Guinean kina', 'PGK', 'K'),
            array('Rwandan franc', 'RWF', 'R₣'),
            array('Samoan tālā', 'WST', 'WS$'),
            array('São Tomé and Príncipe dobra', 'STD', 'Db'),
            array('Sierra Leonean leone', 'SLL', 'Le'),
            array('South Sudanese pound', 'SSP', '£'),
            array('Sudanese pound', 'SDG', 'ج.س'),
            array('Swazi lilangeni', 'SZL', 'L'),
            array('Tajikistani somoni', 'TJS', 'ЅM'),
            array('Tanzanian shilling', 'TZS', 'TSh'),
            array('Tongan paʻanga', 'TOP', 'T$'),
            array('Tunisian dinar', 'TND', 'DT'),
            array('Turkmenistani manat', 'TMT', 'T'),
            array('Ugandan shilling', 'UGX', 'USh'),
            array('United Arab Emirates dirham', 'AED', 'د.إ'),
            array('Vanuatu vatu', 'VUV', 'VT'),
            array('Zambian kwacha', 'ZMW', 'ZK'),
            array('Zimbabwean dollar', 'ZWL', '$')
        ]; 

        foreach ($currecnyLists as $currecnyList) {
            $currency = new Currency;
            $currency->name = $currecnyList[0];
            $currency->code = $currecnyList[1];
            $currency->symbol = $currecnyList[2];
            $currency->save();
        }

        $countryflags = [
            '/storage/flag/111-afghanistan.png',
            '/storage/flag/099-albania.png',
            '/storage/flag/144-algeria.png',
            '/storage/flag/027-american-samoa.png',
            '/storage/flag/045-andorra.png',
            '/storage/flag/117-angola.png',
            '/storage/flag/025-anguilla.png',
            '/storage/flag/antarctica.png',
            '/storage/flag/075-antigua-and-barbuda.png',
            '/storage/flag/198-argentina.png',
            '/storage/flag/108-armenia.png',
            '/storage/flag/042-aruba.png',
            '/storage/flag/234-australia.png',
            '/storage/flag/003-austria.png',
            '/storage/flag/141-azerbaijan.png',
            '/storage/flag/120-bahamas.png',
            '/storage/flag/138-bahrain.png',
            '/storage/flag/147-bangladesh.png',
            '/storage/flag/084-barbados.png',
            '/storage/flag/135-belarus.png',
            '/storage/flag/165-belgium.png',
            '/storage/flag/078-belize.png',
            '/storage/flag/060-benin.png',
            '/storage/flag/081-bermuda.png',
            '/storage/flag/040-bhutan.png',
            '/storage/flag/150-bolivia.png',
            '/storage/flag/132-bosnia-and-herzegovina.png',
            '/storage/flag/126-botswana.png',
            '/storage/flag/143-norway.png',
            '/storage/flag/255-brazil.png',
            '/storage/flag/069-british-indian-ocean-territory.png',
            '/storage/flag/119-brunei.png',
            '/storage/flag/168-bulgaria.png',
            '/storage/flag/090-burkina-faso.png',
            '/storage/flag/057-burundi.png',
            '/storage/flag/159-cambodia.png',
            '/storage/flag/105-cameroon.png',
            '/storage/flag/243-canada.png',
            '/storage/flag/038-cape-verde.png',
            '/storage/flag/051-cayman-islands.png',
            '/storage/flag/036-central-african-republic.png',
            '/storage/flag/066-chad.png',
            '/storage/flag/131-chile.png',
            '/storage/flag/034-china.png',
            '/storage/flag/017-christmas-island.png',
            '/storage/flag/023-cocos-island.png',
            '/storage/flag/177-colombia.png',
            '/storage/flag/029-comoros.png',
            '/storage/flag/157-republic-of-the-congo.png',
            '/storage/flag/249-democratic-republic-of-congo.png',
            '/storage/flag/021-cook-islands.png',
            '/storage/flag/156-costa-rica.png',
            '/storage/flag/161-ivory-coast.png',
            '/storage/flag/164-croatia.png',
            '/storage/flag/153-cuba.png',
            '/storage/flag/101-northern-cyprus.png',
            '/storage/flag/149-czech-republic.png',
            '/storage/flag/174-denmark.png',
            '/storage/flag/068-djibouti.png',
            '/storage/flag/186-dominica.png',
            '/storage/flag/047-dominican-republic.png',
            '/storage/flag/140-east-timor.png',
            '/storage/flag/104-ecuador.png',
            '/storage/flag/158-egypt.png',
            '/storage/flag/015-el-salvador.png',
            '/storage/flag/189-equatorial-guinea.png',
            '/storage/flag/065-eritrea.png',
            '/storage/flag/008-estonia.png',
            '/storage/flag/005-ethiopia.png',
            '/storage/flag/193-norfolk-island.png',
            '/storage/flag/215-falkland-islands.png',
            '/storage/flag/122-faroe-islands.png',
            '/storage/flag/137-fiji.png',
            '/storage/flag/125-finland.png',
            '/storage/flag/195-france.png',
            '/storage/flag/french-guiana.png',
            '/storage/flag/180-french-polynesia.png',
            '/storage/flag/frecnh_southern_territories.png',
            '/storage/flag/059-gabon.png',
            '/storage/flag/146-gambia.png',
            '/storage/flag/256-georgia.png',
            '/storage/flag/162-germany.png',
            '/storage/flag/053-ghana.png',
            '/storage/flag/213-gibraltar.png',
            '/storage/flag/170-greece.png',
            '/storage/flag/113-greenland.png',
            '/storage/flag/210-grenada.png',
            '/storage/flag/guadeloupe.gif',
            '/storage/flag/207-guam.png',
            '/storage/flag/098-guatemala.png',
            '/storage/flag/204-guernsey.png',
            '/storage/flag/110-guinea.png',
            '/storage/flag/056-guinea-bissau.png',
            '/storage/flag/guyana.png',
            '/storage/flag/185-haiti.png',
            '/storage/flag/234-australia.png',
            '/storage/flag/024-honduras.png',
            '/storage/flag/183-hong-kong.png',
            '/storage/flag/115-hungary.png',
            '/storage/flag/080-iceland.png',
            '/storage/flag/246-india.png',
            '/storage/flag/209-indonesia.png',
            '/storage/flag/136-iran.png',
            '/storage/flag/020-iraq.png',
            '/storage/flag/179-ireland.png',
            '/storage/flag/155-israel.png',
            '/storage/flag/013-italy.png',
            '/storage/flag/037-jamaica.png',
            '/storage/flag/063-japan.png',
            '/storage/flag/245-jersey.png',
            '/storage/flag/077-jordan.png',
            '/storage/flag/074-kazakhstan.png',
            '/storage/flag/067-kenya.png',
            '/storage/flag/261-kiribati.png',
            '/storage/flag/030-north-korea.png',
            '/storage/flag/094-south-korea.png',
            '/storage/flag/107-kwait.png',
            '/storage/flag/152-kyrgyzstan.png',
            '/storage/flag/112-laos.png',
            '/storage/flag/044-latvia.png',
            '/storage/flag/018-lebanon.png',
            '/storage/flag/176-lesotho.png',
            '/storage/flag/169-liberia.png',
            '/storage/flag/231-libya.png',
            '/storage/flag/134-liechtenstein.png',
            '/storage/flag/064-lithuania.png',
            '/storage/flag/035-luxembourg.png',
            '/storage/flag/macau.png',
            '/storage/flag/236-republic-of-macedonia.png',
            '/storage/flag/242-madagascar.png',
            '/storage/flag/214-malawi.png',
            '/storage/flag/118-malasya.png',
            '/storage/flag/225-maldives.png',
            '/storage/flag/173-mali.png',
            '/storage/flag/194-malta.png',
            '/storage/flag/219-isle-of-man.png',
            '/storage/flag/103-marshall-island.png',
            '/storage/flag/201-martinique.png',
            '/storage/flag/050-mauritania.png',
            '/storage/flag/001-mauritius.png',
            '/storage/flag/195-france.png',
            '/storage/flag/252-mexico.png',
            '/storage/flag/046-micronesia.png',
            '/storage/flag/212-moldova.png',
            '/storage/flag/039-monaco.png',
            '/storage/flag/258-mongolia.png',
            '/storage/flag/043-montserrat.png',
            '/storage/flag/166-morocco.png',
            '/storage/flag/096-mozambique.png',
            '/storage/flag/058-myanmar.png',
            '/storage/flag/062-namibia.png',
            '/storage/flag/228-nauru.png',
            '/storage/flag/016-nepal.png',
            '/storage/flag/netherlands-antilles.png',
            '/storage/flag/237-netherlands.png',
            '/storage/flag/Nouvelle-caledonie_Drapeau_Flag_Bandiera.jpeg',
            '/storage/flag/121-new-zealand.png',
            '/storage/flag/007-nicaragua.png',
            '/storage/flag/086-nigeria.png',
            '/storage/flag/086-nigeria.png',
            '/storage/flag/182-niue.png',
            '/storage/flag/193-norfolk-island.png',
            '/storage/flag/160-northern-marianas-islands.png',
            '/storage/flag/143-norway.png',
            '/storage/flag/004-oman.png',
            '/storage/flag/100-pakistan.png',
            '/storage/flag/178-palau.png',
            '/storage/flag/palestinian.png',
            '/storage/flag/106-panama.png',
            '/storage/flag/163-papua-new-guinea.png',
            '/storage/flag/041-paraguay.png',
            '/storage/flag/188-peru.png',
            '/storage/flag/192-philippines.png',
            '/storage/flag/095-pitcairn-islands.png',
            '/storage/flag/211-poland.png',
            '/storage/flag/224-portugal.png',
            '/storage/flag/028-puerto-rico.png',
            '/storage/flag/qatar.png',
            '/storage/flag/Reunion.jpeg',
            '/storage/flag/109-romania.png',
            '/storage/flag/248-russia.png',
            '/storage/flag/206-rwanda.png',
            '/storage/flag/saint.png',
            '/storage/flag/033-saint-kitts-and-nevis.png',
            '/storage/flag/172-st-lucia.png',
            '/storage/flag/saint_pierre_and_miquelon.png',
            '/storage/flag/241-st-vincent-and-the-grenadines.png',
            '/storage/flag/251-samoa.png',
            '/storage/flag/097-san-marino.png',
            '/storage/flag/012-sao-tome-and-prince.png',
            '/storage/flag/133-saudi-arabia.png',
            '/storage/flag/227-senegal.png',
            '/storage/flag/071-serbia.png',
            '/storage/flag/253-seychelles.png',
            '/storage/flag/092-sierra-leone.png',
            '/storage/flag/230-singapore.png',
            '/storage/flag/091-slovakia.png',
            '/storage/flag/010-slovenia.png',
            '/storage/flag/260-united-kingdom.png',
            '/storage/flag/085-solomon-islands.png',
            '/storage/flag/083-somalia.png',
            '/storage/flag/200-south-africa.png',
            '/storage/flag/south_georgia.png',
            '/storage/flag/244-south-sudan.png',
            '/storage/flag/128-spain.png',
            '/storage/flag/127-sri-lanka.png',
            '/storage/flag/199-sudan.png',
            '/storage/flag/076-suriname.png',
            '/storage/flag/143-norway.png',
            '/storage/flag/154-swaziland.png',
            '/storage/flag/184-sweden.png',
            '/storage/flag/205-switzerland.png',
            '/storage/flag/022-syria.png',
            '/storage/flag/202-taiwan.png',
            '/storage/flag/196-tajikistan.png',
            '/storage/flag/006-tanzania.png',
            '/storage/flag/238-thailand.png',
            '/storage/flag/073-togo.png',
            '/storage/flag/235-tokelau.png',
            '/storage/flag/191-tonga.png',
            '/storage/flag/181-trinidad-and-tobago.png',
            '/storage/flag/049-tunisia.png',
            '/storage/flag/218-turkey.png',
            '/storage/flag/229-turkmenistan.png',
            '/storage/flag/223-turks-and-caicos.png',
            '/storage/flag/070-tuvalu-1.png',
            '/storage/flag/009-uganda.png',
            '/storage/flag/145-ukraine.png',
            '/storage/flag/151-united-arab-emirates.png',
            '/storage/flag/260-united-kingdom.png',
            '/storage/flag/united-states.png',
            '/storage/flag/united-states.png',
            '/storage/flag/088-uruguay.png',
            '/storage/flag/190-uzbekistn.png',
            '/storage/flag/187-vanuatu.png',
            '/storage/flag/124-vatican-city.png',
            '/storage/flag/139-venezuela.png',
            '/storage/flag/220-vietnam.png',
            '/storage/flag/114-british-virgin-islands.png',
            '/storage/flag/217-virgin-islands.png',
            '/storage/flag/Flag_of_Wallis_and_Futuna.png',
            '/storage/flag/western.png',
            '/storage/flag/232-yemen.png',
            '/storage/flag/yugoslavia.png',
            '/storage/flag/032-zambia.png',
            '/storage/flag/011-zimbabwe.png',
        ];

        $countries = Country::all();

        foreach ($countries as $key => $country) {

            $data = array(
                'flag'  =>  $countryflags[$key],
            );

            Country::where('id',$country->id)->update($data);

            
        }
    }
}
