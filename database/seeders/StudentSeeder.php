<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;
use App\Models\Permission;
use App\Models\Blood;
use App\Models\Religion;
use App\Models\Guardian;
use App\Models\Sport;
use App\Models\User;
use App\Models\Student;
use App\Models\School;

use Hashids\Hashids;

use App\Models\VerifyUser;

use Illuminate\Support\Facades\Hash;
use Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $now = Carbon::now();

        $userLists = [
            
        ];

        $batches = Batch::all();

        $studentLists = [
            array("Phyoe Thu Myo Zeya", "ဖြိုးသူရမျိုးဇေယျ", "Male"),
            array("New U Aeindra", "နော်ဦးအိန္ဒြာ", "Female"),
            array("Wunna Ko Arkar", "၀ဏကိုအာကာ", "Male"),
            array("Thuzar Thida Eka Ag", "သူဇာသီဓာအိမ့်အောင်", "Female"),
            array("Myat Pyay Aung Khant", "မြတ်ပြည့်အောင်ခန့်", "Male"),
            array("Mon Aung Yuzana", "မွန်အောင်ယုဇန", "Female"),
            array("Zeyar Nyan", "ဇေယျဥာဏ်", "Male"),
            array("Hline Nwe", "လှိုင်နွေး", "Female"),
            array("Tun Soe", "ထွန်းစိုး", "Male"),
            array("Thandar Thiri", "သန္တာသီရိ", "Female"),
            array("Min Pyae", "မင်းပြည့်", "Male"),
            array("Phyo Nila Sandar", "ဖြိုးနီလာစန္ဒ", "Female"),
            array("Zarni Hein", "ဇာနည်ဟိန်း", "Male"),
            array("Phyu Aung Phyu", "ဖြူအောင်ဖြူ", "Female"),
            array("Thet Yaza", "သက်ဇေယျ", "Male"),
            array("Phone Win", "ဘုန်း၀င်း", "Female"),
            array("Khine Ye Arkar", "ခိုင်ဇေယျအာကာ", "Male"),
            array("Nila Thandar", "နီလာသန္တာ", "Female"),
            array("Thura Maung Win", "သူရမောင်၀င်း", "Male"),
            array("Hlaing Thu Phyo Nhin", "လှိုင်သူဖြိုးနှင်း", "Female"),
            array("Myat Khaing Min", "မြတ်ခိုင်မင်း", "Male"),
            array("Thinza Naing Thiri", "သင်ဇာနိုင်သီရိ", "Female"),
            array("Thant Zin Mg Win", "သန့်ဇင်မောင်၀င်း", "Male"),
            array("Hayma Hayma", "နှင်းမြနှင်းမြ", "Female"),
            array("Htut Soe Phyo Sein", "ထွဋ်စိုးဖြိုးစိန်", "Male"),
            array("Hline Yi Khaing Yadana", "လျှံရီခိုင်ရတနာ", "Female"),
            array("Khaing Kan Thurein Sein", "ခိုင်ခန့်သူရိန်ရှိန်း", "Male"),
            array("Eindra Khaing", "အိန္ဒြာခိုင်", "Female"),
            array("Lin Khine Kyaw Thiha", "လင်းခိုင်ကျော်သိဟ", "Male"),
            array("Ag Phyu", "အောင်ဖြူ", "Female"),
            array("Htut Phone Thant", "ထွဋ်ဘုန်းသန့်", "Male"),
            array("Thuzar Aye", "သူဇာအေး", "Female"),
            array("Htun Sein", "ထွဋ်စိန်", "Male"),
            array("Khine Tun", "ခိုင်ထွန်း", "Female"),
            array("Zeyar Htun Bo Phyo", "ဇေယျထွန်ဘိုဖြိုး", "Male"),
            array("Htay Win", "ဌေး၀င်း", "Female"),
            array("Pyae Lin", "ပြည့်လင်း", "Male"),
            array("Yati Myint Mon", "ရတီမြင့်မွန်", "Female"),
            array("Hein Zeya Ko", "ဟိန်းဇေယျကို", "Male"),
            array("Marlar Nine Htay", "မာလာနိုင်းဌေး", "Female"),
            array("Thuta Nyan Lin Wunna", "သုတဥာဏ်လင်း၀ဏ", "Male"),
            array("Yin Nine", "ရင်နိုင်း", "Female"),
            array("Kaung Mg", "ကောင်းမောင်", "Male"),
            array("Thandar Thawdar Haymar Phone", "သန္တာသော်ဓာဟေမာဘုန်း", "Female"),
            array("Khine Thet Wai Myo", "ခိုင်သက်၀ေမျိုး", "Male"),
            array("May Zin", "မေဇင်", "Female"),
            array("Zeya Phone", "ဇေယျဘုန်း", "Male"),
            array("Myint Nila Thawdar Haymar", "မြင့်နီလာသော်ဓာဟေမာ", "Female"),
            array("Yarzar Win", "ရာဇာ၀င်း", "Male"),
            array("Myint Aye Yin", "မြင့်အေးယဥ်", "Female"),
            array("Thiha Ye Thiha", "သီဟရဲသီဟ", "Male"),
            array("Pwint Kay", "ပွင့်ကေ", "Female"),
            array("Thura Naing", "သူရနိုင်", "Male"),
            array("Htun Hline Khine Yi", "ထွန်းလှိုင်ခိုင်ရီ", "Female"),
            array("Linn Hein Zarni Zin", "လင်းဟိန်းဇာနည်ဇင်", "Male"),
            array("Yin Haymar", "ယင်းဟေမာ", "Female"),
            array("Wai Zeyar Phyoe Zaw", "၀ေဇေယျာဘုန်းဇော်", "Male"),
            array("Thawdar May", "သော်ဓာမေ", "Female"),
            array("Thurein Sein", "သူရှိန်စိန်း", "Male"),
            array("Win Haymar Thawda San", "၀င်းဟေမာသော်ဓာစန်း", "Female"),
            array("Pyay U", "ပြည့်ဦး", "Male"),
            array("Thanda Eka Zar", "သန္တာအိမ့်ဇာ", "Female"),
            array("Phone Mg", "ဘုန်းမောင်", "Male"),
            array("Yu Phone", "ယုဘုန်း", "Female"),
            array("Thawda Khine Phone Lin", "သော်ဓာခိုင်ဘုန်းလင်း", "Male"),
            array("San Htet", "စန်းထက်", "Female"),
            array("Thiha Ko", "သီဟကို", "Male"),
            array("Yee Thet Su Eka", "ရီသက်ဆုအိမ်", "Female"),
            array("Thurein Zaw Wunna", "သူရှိန်ဇော်၀ဏ", "Male"),
            array("Zin Zar", "ဇင်ဇာ", "Female"),
            array("Wai Mg", "၀ေမောင်", "Male"),
            array("Haymar Hline May Yadanar", "ဟေမာလှိုင်မေရတနာ", "Female"),
            array("Kaung Zarni Khine", "ကောင်းဇာနည်ခိုင်", "Male"),
            array("Thet U Thidar Nine", "သက်ဦးသီတာနိုင်း", "Female"),
            array("Myat Tun", "မြတ်ထွန်း", "Male"),
            array("Thandar Yi", "သန္တာရီ", "Female"),
            array("Yaza Phone Kyaw Maung", "ဇေယျာဘုန်းဇော်မောင်", "Male"),
            array("Yu Ommar", "ယုဥမ္မာ", "Female"),
            array("Sein Tun", "စိန်ထွန်း", "Male"),
            array("Zar Zaw", "ဇာဇော်", "Female"),
            array("Myat Htun Myo", "မြတ်ထွန်းမျိုး", "Male"),
            array("Thiri Kay Aye Le", "သီရီကေအေးလဲ့", "Female"),
            array("Thawda Lin", "သော်ဓာလင်း", "Male"),
            array("Yuzana Myitzu", "ယုဇနမြင့်ဇူ", "Female"),
            array("Bo Phone Zeyar U", "ဘိုဘုန်းဇေယျာ", "Male"),
            array("San Thu Thanda", "စန်းသု့သန္တာ", "Female"),
            array("Thawda Thura Win Lin", "သော်ဓာသူရ၀ေလင်း", "Male"),
            array("Zin Thawda", "ဇင်သော်တာ", "Female"),
            array("Wai Htet Kan", "၀ေထက်ခန့်", "Male"),
            array("Thinzar Yuzana Ag Phone", "သင်ဇာရတနာအောင်ဘုန်း", "Female"),
            array("Zin Ye", "ဇင်ရဲ", "Male"),
            array("Nine Theingi", "နိုင်းသိင်္ဂီ", "Female"),
            array("Thu Htut Aung Bo", "ထွန်းထွဋ်အောင်ဘို", "Male"),
            array("Zin Yu Myint Mon", "ဇင်ယုမြင့်မွန်", "Female"),
            array("Thet Zarni Htun", "သက်ဇာနည်ထွန်း", "Male"),
            array("Cho Pwint Nanda", "ချိုပွင့်နန္ဒ", "Female"),
            array("Nyan Ag Phyoe", "ဥာဏ်အောင်ဖြိုး", "Male"),
            array("Zar Thin Myat Kay", "ဇာသင်းမြတ်ခင်", "Female"),
            array("Ye Arkar Khaing Kaung", "ရဲအာကာခိုင်ကောင်း", "Male"),
            array("Nwe Win", "နွေ၀င်း", "Female"),
            array("Tun Arkar", "ထွန်းအာကာ", "Male"),
            array("Thawka Tun Yu Kyaw", "သော်ခထွန်းယုကျော်", "Female"),
            array("Pyae Thurein", "ပြည့်သူရှိန်", "Male"),
            array("Pwint Kay", "ပွင့်ခေ", "Female"),
            array("Wunna Pyae Thu Myat", "၀ဏပြည့်သူမြတ်", "Male"),
            array("Myint Thawka Thawdar Hnin", "မြင့်သောကသော်ဓာနှင့်", "Female"),
            array("Ko Thet Maung", "ကိုသက်မောင်", "Male"),
            array("Myint Yee Yi Aung", "မြင့်ရီရီအောင်", "Female"),
            array("Ye Bo Pyae", "ရဲဘိုပြည့်", "Male"),
            array("Eka Nanda", "အိမ့်နန္ဒ", "Female"),
            array("Phone Arkar U", "ဘုန်းအာကာဦး", "Male"),
            array("Htun Sandar", "ထွန်းစန္ဒ", "Female"),
            array("Naing Min", "နိုင်မင်း", "Male"),
            array("Inzali Thu Nwe Mon", "အဥ္ဇလီသုနွေမွန်", "Female"),
            array("Khine Aung Phyoe", "ခိုင်အောင်ဖြိုး", "Male"),
            array("Htay Ag", "ထွေးအောင်", "Female"),
            array("Kan Arkar", "ခန့်အာကာ", "Male"),
            array("Thawdar Kay Sandar", "သော်ဓာကေးစန္ဒ", "Female"),
            array("Thawda Myat Yaza Thura", "သော်ဓာမြတ်ဇေယျသူရ", "Male"),
            array("Eindra Hsu Thidar Marlar", "အိန္ဒြာစုသီဓာမာလာ", "Female"),
            array("Ag Khine Ko", "အောင်ခိုင်ကို", "Male"),
            array("Yi Sandaမ", "ရီစန္ဒ", "Female"),
            array("Kyaw Pyay Kaung Soe", "ကျော်ပြည့်ခိုင်စိုး", "Male"),
            array("Yi Theingi Thu Thinza", "ရီသိင်္ဂီသုသင်ဇာ", "Female"),
            array("Thanda Eka Zar", "သန္တအိမ့်ဇာ", "Female"),
            array("Pyay Kaung", "ပြည့်ကောင်း", "Male"),
            array("Myitzu U Mon Khaing", "မြင့်ဇူဦးမွန်ခိုင်", "Female"),
            array("Thu Htet", "သူထက်", "Male"),
            array("Thet Nwe Khine Myat", "သက်နွေခိုင်မြတ်", "Female"),
            array("Khine Tun Htet", "ခိုင်ထွန်းမြတ်", "Male"),
            array("Zin Nine Khaing", "ဇင်နိုင်ခိုင်", "Female"),
            array("Pyay Myint Myat", "ပြည့်မြင့်မြတ်", "Male"),
            array("Nilar Thinza", "နီလာသင်ဇာ", "Female"),
            array("Khine Tun Htet", "ခိုင်ထွန်းထက်", "Male"),
            array("Thida Phyu Theingi Yuzana", "သီဓာဖြူသိင်္ဂီယုဇန", "Female"),
            array("Arkar Ko Wai Myat", "အာကာကို၀ေမြတ်", "Male"),
            array("Hlaing Yati", "လှိုင်ရတီ", "Female"),
            array("Phyoe Lin Mg", "ဘုန်းလင်းမောင်", "Male"),
            array("Thiri Zaw", "သီရိဇော်", "Female"),
            array("Ye Zeya", "ရဲဇေယျ", "Male"),
            array("Thu Htet Myitzu", "သုထက်မြင့်ဇူ", "Female"),
            array("Pyae Khaing", "ပြည့်ခိုင်", "Male"),
            array("Hayma Phyo", "ဟေမာန်ဖြိုး", "Female"),
            array("Htut Myint Khine Zeyar", "ထွဋ်မြတ်ခိုင်ဇေယျာ", "Male"),
            array("Haymar Sandar Nilar", "ဟေမာစန္ဒနီလာ", "Female"),
            array("Min Pyay Zeyar Pyay", "မင်းပြည့်ဇေယျာ", "Male"),
            array("May Yee Yadanar", "မေရီရတနာ", "Female"),
            array("Linn Khant", "လင်းခန့်", "Male"),
            array("Thida Ohmar", "သီဓာဥမ္မာ", "Female"),
            array("Thurein Zeyar Pyae Arkar", "သူရှိန်ဇေယျပြည့်အာကာ", "Male"),
            array("Pwint Thidar Thandar", "ပွင့်သီဓာသန္တာ", "Female"),
            array("Linn U", "လင်းဦး", "Male"),
            array("Tun Tun Nway", "ထွန်းထွန်းနွေ", "Female"),
            array("Thurein Thu Khine Ye", "သူရှိန်သူခိုင်ရဲ", "Male"),
            array("Thu Yi", "သုရီ", "Female"),
            array("Thiha Ko", "သူရှိန်ကို", "Male"),
            array("Phyu New Sandar", "ဖြူနွေးစန္ဒ", "Female"),
            array("Thet Thet", "သက်သက်", "Male"),
            array("Myat Cho", "မြတ်ချို", "Female"),
            array("Zeyar Kyaw Arkar Pyay", "ဇေယျာကျော်အာကာပြည့်", "Male"),
            array("Theingi Thi Ommar Myint", "သိင်္ဂီသိဥမ္မာမြင့်", "Female"),
            array("Naing Zeya Khine Win", "နိုင်းဇေယျာခိုင်၀င်း", "Male"),
            array("Thawka Su", "သောကစု", "Female"),
            array("Htun Zeya Khaing Kyaw", "ထွန်းဇေယျာခိုင်ကျော်", "Male"),
            array("Yi Thu", "ရီသု", "Female"),
            array("Thu Phyoe Htut Myint", "သူဖြိုးထွဋ်မြင့်", "Male"),
            array("Nandar Ag", "နန္ဒအောင်", "Female"),
            array("Khant Thawda", "ခန့်သော်ဓာ", "Male"),
            array("Htay Sandar", "ဌေးစန္ဒ", "Female"),
            array("Phyo Naing Tun", "ဖြိုးနိုင်ထွန်း", "Male"),
            array("Nine Yadanar Phyo", "နိုင်းရတနာဖြိုး", "Female"),
            array("Ko Khant Hein", "ကိုခန့်ဟိန်း", "Male"),
            array("Yadanar Su Eka Sandar", "ရတနာစုအိမ့်စန္ဒ", "Female"),
            array("Myo Win Khant", "မျိုး၀င်းခန့်", "Male"),
            array("Cho Myitzu", "ချိုမြင့်ဇူ", "Female"),
            array("Hein Thawda", "ဟိန်းသော်ဓာ", "Male"),
            array("Phone Zaw Cho", "ဘုန်းဇော်ချို", "Female"),
            array("Yaza Zin Kyaw", "ရဲဇေယျဇင်ကျော်", "Male"),
            array("Yu Eka Thin Ei", "ယုအိမ့်သင်းအိ", "Female"),
            array("Thant Zarni", "သန့်ဇာနည်", "Male"),
            array("Thu Ag Sandar Zar", "သုအောင်စန္ဒဇေယျာ", "Female"),
            array("Khant Myint", "ခန့်မြင့်", "Male"),
            array("Thu Nwe", "နုနွယ်", "Female"),
            array("Zin Pyay Naing", "ဇင်ပြည့်နိုင်", "Male"),
            array("Myint Mon", "မြင့်မွန်", "Female"),
            array("Htut Win", "ထွဋ်၀င်း", "Male"),
            array("Phone Thandar U", "ဘုန်းသန္တာဦး", "Female"),
            array("Zin Zaya", "ဇင်ဇေရ", "Male"),
            array("Naing Ommar Htay", "နိုင်းဥမ္မာဌေး", "Female"),
            array("Zaw Yaza Htet", "ဇော်ရဲဇာထက်", "Male"),
            array("Nila Thinzar", "နီလာသင်ဇာ", "Female"),
            array("Win Thura Khant Myat", "၀င်းသူရခန့်မြတ်", "Male"),
            array("Yin Mon Inzali", "ရီမွန်အဥ္ဇလီ", "Female"),
            array("Kaung Thura Ye Khant", "ကောင်းသူရရဲခန့်", "Male"),
            array("Thi Nandar Myint Yuzana", "သိနန္ဒမြင့်ယုဇန", "Female"),
            array("Naing Lin", "နိုင်လင်း", "Male"),
            array("Ohmar Hlaing Nandar Yu", "ဥမ္မာလှိုင်နန္ဒယု", "Female"),
            array("Yaza Zarni Naing Zaw", "ရာဇဇာနည်နိုင်ဇော်", "Male"),
            array("Ei Phyu Thin Aye", "အိဖြူသင်းအေး", "Female"),
            array("Soe Kyaw U", "စိုးကျော်ဦး", "Male"),
            array("Nine Thu", "နိုင်းသူ", "Female"),
            array("Tun Tun", "ထွန်းထွန်း", "Male"),
            array("Win Htun Hsu", "၀င်းထွဋ်စု", "Female"),
            array("Thurein Naing", "သူရှိန်နိုင်", "Male"),
            array("Sandar Thin Aeindra Thida", "စန္ဒသင်းအိန္ဒြာသီဓ", "Female"),
            array("Phone Pyae", "ဘုန်းပြည့်", "Male"),
            array("Theingi Ei May Myat", "သိင်္ဂီအိမေမြတ်", "Female"),
            array("Arkar Htet", "အာကာထက်", "Male"),
            array("Yee May Pwint Yati", "ရီမေပွင့်ရတီ", "Female"),
            array("Thet Tun", "သက်ထွန်း", "Male"),
            array("Le Yadanar Su Le", "လဲ့ရတနာစုလဲ့", "Female"),
            array("Thurein Phyo", "သူရိန်ဖြိုး", "Male"),
            array("Haymar U", "ဟေမာဦး", "Female"),
            array("Nyan Kyaw Thuta Kaung", "ဥာဏ်ကျော်သုတကောင်း", "Male"),
            array("Aung Naing New", "အောင်နိုင်နွေ", "Female"),
            array("Hein Phyoe", "ဟိန်းဖြိုး", "Male"),
            array("Hayma Nandar Win Yadanar", "ဟေမာနန္ဒ၀င်းရတနာ", "Female"),
            array("Zin Pyae Zeyar Thurein", "ဇင်ပြည့်ဇေယျာသူရှိန်", "Male"),
            array("Aye Thidar Mon", "အေးသီတာမွန်", "Female"),
            array("Naing Min", "နိုင်မင်း", "Male"),
            array("Su Thu", "စုသူ", "Female"),
            array("Khine Zarni Thurein", "ခိုင်ဇာနည်သူရှိန်", "Male"),
            array("Myitzu Aye", "မြင့်ဇူအေး", "Female"),
            array("Khine Kyaw", "ခိုင်ကျော်", "Male"),
            array("Thi Thet", "သိမ့်သက်", "Female"),
            array("Phone Yaza Aung", "ဘုန်းဇေယျအောင်", "Male"),
            array("Thin Zar", "သင်ဇာ", "Female"),
            array("Khaing Thet Zin", "ခိုင်သက်ဇင်", "Male"),
            array("Haymar Nwe", "ဟေမာနွယ်", "Female"),
            array("Thurein Soe Win", "သူရှိန်စိုး၀င်း", "Male"),
            array("Htay Sandar", "ဌေးစန္ဒ", "Female"),
            array("Naing Pyae", "နိုင်ပြည့်", "Male"),
            array("Thinzar Haymar Thawda New", "သင်ဇာဟေမာသော်ဓာနွေ", "Female"),
            array("Myat Wunna", "မြတ်၀ဏ", "Male"),
            array("Thet Yu Yati Hlaing", "သက်ယုရတီလှိုင်", "Female"),
            array("Zin Thu", "ဇင်သူ", "Male"),
            array("Khin Yin", "ခင်ရီ", "Female"),
            array("Htun Khant", "ထွန်းခန့်", "Male"),
            array("Aye Thinza Aye Su", "အေးသင်ဇာအေးစု", "Female"),
            array("Thawda Khine Naing", "သော်ဓာခိုင်နိုင်", "Male"),
            array("Nilar Tun Myitzu", "နီလာထွန်းမြင့်ဇူ", "Female"),
            array("Ye Thu Thuta", "ရဲသူသုတ", "Male"),

        ];

        $schools = ["BEHS 3 Ahlon", "BEHS 2 Bahan", "BEHS 4 Botataung", "BEHS 1 Dagon", "BEHS 1 Insein", "BEHS 1 Kamayut", 
        "BEHS 2 Lanmadaw", "BEHS 1 Latha", "BEHS 2 Pabedan", "BEHS 2 Shwepyitha"];

        $school = School::find(1);

        $stu = 0; $stuadmino = 1;
        foreach($batches as $batch){
            $randomNumber = $faker->numberBetween(3, 7);

            $stuno = 1;
            for ($i=0; $i < $randomNumber; $i++) { 
                $registerdate = $faker->dateTimeBetween('-1 year', '-1 year');

                $gradeid = $batch->section->grade()->pluck('id')->first();

                if($gradeid == 1){
                    $psn = NULL;
                }else{
                    $psn = $schools[$faker->randomDigit()];
                }

                $studentList = $studentLists[$stu++];

                if ($gradeid == 1) {
                    $dob = $faker->dateTimeBetween('-5 years', '-5 years');
                }
                else if ($gradeid == 2) {
                    $dob = $faker->dateTimeBetween('-6 years', '-6 years');
                }
                else if ($gradeid == 3) {
                    $dob = $faker->dateTimeBetween('-7 years', '-7 years');
                }
                else if ($gradeid == 4) {
                    $dob = $faker->dateTimeBetween('-8 years', '-8 years');
                }
                else if ($gradeid == 5) {
                    $dob = $faker->dateTimeBetween('-9 years', '-9 years');
                }
                else if ($gradeid == 6) {
                    $dob = $faker->dateTimeBetween('-10 years', '-10 years');
                }
                else if ($gradeid == 7) {
                    $dob = $faker->dateTimeBetween('-11 years', '-11 years');
                }
                else if ($gradeid == 8) {
                    $dob = $faker->dateTimeBetween('-12 years', '-12 years');
                }
                else if ($gradeid == 9) {
                    $dob = $faker->dateTimeBetween('-13 years', '-13 years');
                }
                else if ($gradeid == 10) {
                    $dob = $faker->dateTimeBetween('-14 years', '-14 years');
                }
                else if ($gradeid == 11) {
                    $dob = $faker->dateTimeBetween('-15 years', '-15 years');
                }
                else if ($gradeid == 12) {
                    $dob = $faker->dateTimeBetween('-16 years', '-16 years');
                }
                else{
                    $dob = $faker->dateTimeBetween('-17 years', '-17 years');
                }

                $medicalproblem = ["Common Cold", "Food Poisoning", "Influenza", NULL, "Bleeding Nose", "Meningitis", "Skin (cutaneous) allergy"];
                $foodallergy = ["peanuts and other nuts", "seafood", "milk products", "eggs", NULL, "soy", "wheat"];
                $medicalallergy = ["Penicillin", "sulfonamides", NULL, "Anticonvulsants", "Aspirin", "Chemotherapy"];

                $address = $faker->address();
                $status = 'Active';

                $bio = $faker->realText($maxNbChars = 200, $indexSize = 2);

                $blood = Blood::find($faker->numberBetween(1, 6));
                $religion = Religion::find($faker->numberBetween(1, 5));
                $country = 150;

                $sport = Sport::find($faker->numberBetween(1,28));
                $schoolid = 1;
                $staff = 1;

                $fld = ["Yes", "No"];

                $name = $studentList[0];
                $emailhashids = new Hashids($faker->randomNumber(5, true));
                $generateEmail = $faker->regexify('[A-Z]{5}[0-4]{3}');; // gPUasb

                $randomNumber2 = $faker->numberBetween(0, 50);
                if($randomNumber2 <= 9){
                    $profileno = "0".$randomNumber2."-kid.png";
                }else{
                    $profileno = $randomNumber2."-kid.png";
                }

                $user = new User();
                $user->name = $name;
                $user->email = $generateEmail.'.smartcamp.com';
                $user->profile_photo_path = "storage/profile/".$profileno;
                $user->school_id = 1;
                $user->email_verified_at = $now;
                $user->password = Hash::make('123456789');
                $user->save();

                $verifyUser = VerifyUser::create([
                    'user_id' => $user->id,
                    'token' => sha1(time())
                ]);
                $user->assignRole('Student');

                $student = new Student();
                $student->registerdate = $registerdate;
                $student->medicalproblem = $medicalproblem[$faker->numberBetween(0,5)];
                $student->foodallergy = $foodallergy[$faker->numberBetween(0,6)];
                $student->medicalallergy = $medicalallergy[$faker->numberBetween(0,5)];
                $student->ferry = $fld[$faker->numberBetween(0,1)];
                $student->lunchbox = $fld[$faker->numberBetween(0,1)];
                $student->dormitory = $fld[$faker->numberBetween(0,1)];


                $student->psn = $psn;
                $student->nativename = $studentList[1];
                $student->gender = $studentList[2];
                $student->dob = $dob;
                $student->address = $address;
                $student->status = $status;
                $student->bio = $bio;
                $student->religion_id = $religion->id;
                $student->grade_id = $gradeid;
                $student->country_id = $country;
                $student->blood_id = $blood->id;
                $student->sport_id = $sport->id;
                $student->school_id = $schoolid;
                $student->staff_id = $staff;
                $student->lmir = 'storage/studentfile/medical.jpg';
                $student->tc = 'storage/studentfile/tc.jpg';
                $student->pcm = 'storage/studentfile/marksheet.jpeg';
                $student->idb = 'storage/studentfile/id_back.jpeg';
                $student->idf = 'storage/studentfile/id_front.png';
                $student->gbc = 'storage/studentfile/household.jpeg';
                $student->user_id = $user->id;
                $student->save();

                if($stuno <= 9){
                    $rollno = 'ES4E0000'.$stuno++;
                }else if($stuno <= 99 ){
                    $rollno = 'ES4E000'.$stuno++;
                }
                else{
                    $rollno = 'ES4E00'.$stuno++;
                }
                $type = 'new';

                DB::table('studentsegments')->insert([
                    'rollno' => $rollno,
                    'type' => $type,
                    'student_id' => $student->id,
                    'batch_id' => $batch->id
                ]);

                $jobs = [
                    "Paramedic",
                    "Dentist",
                    "Train conductor",
                    "Nurse",
                    "Electrician",
                    "Doctor",
                    "Businessman",
                    "American football player",
                    "Student",
                    "Surgeon",
                    "Doorman",
                    "Secretary",
                    "Soldier",
                    "Repairman",
                    "Scientist",
                    "Reporter",
                    "Construction worker",
                    "Professor",
                    "Police officer",
                    "Postman",
                    "Photographer",
                    "Pilot",
                    "Catholic nun",
                    "Painter",
                    "Mechanic",
                    "Magician",
                    "Lifeguard",
                    "Lunchroom supervisor",
                    "Clown",
                    "Housekeeper",
                    "Gardener",
                    "Geisha",
                    "Footballer",
                    "Forest ranger",
                    "Builder",
                    "Foreman",
                    "Farmer",
                    "Flight attendant",
                    "Fireman",
                    "Engineer",
                    "Carpenter",
                    "Architect",
                    "Boxer",
                    "Cameraman",
                    "Detective",
                    "Journalist",
                    "Housewife",
                    "Diver",
                    "Pope",
                    "Priest",
                    "Salesman",
                    "Librarian",
                    "Pirate",
                    "Singer"
                ];
                
                $g1_name = $faker->name();
                $g1_emailhashids = new Hashids($g1_name);
                $g1_generateEmail = $g1_emailhashids->encode(1, 2, 3); 
                $g1_profile = "man-".$faker->numberBetween(0,4).".png";

                $g1user = new User();
                $g1user->name = $g1_name;
                $g1user->email = $g1_generateEmail.'.smartcamp.com';
                $g1user->profile_photo_path = "storage/profile/".$g1_profile;
                $g1user->school_id = 1;
                $g1user->email_verified_at = $now;
                $g1user->password = Hash::make('123456789');
                $g1user->save();

                VerifyUser::create([
                    'user_id' => $g1user->id,
                    'token' => sha1(time())
                ]);
                $g1user->assignRole('Guardian');

                $g1 = new Guardian();
                $g1->workemail = $faker->email();
                $g1->relatiionship = "Father" ;
                $g1->phone = $faker->phoneNumber();
                $g1->occupation = $jobs[$faker->numberBetween(0,53)];
                $g1->user_id = $g1user->id;
                $g1->staff_id = 1;
                $g1->save();

                DB::table('guardian_student')->insert([
                    'guardian_id' => $g1->id,
                    'student_id' => $student->id,
                ]);

                $g2_name = $faker->name();
                $g2_emailhashids = new Hashids($g2_name);
                $g2_generateEmail = $g2_emailhashids->encode(1, 2, 3); 
                $g2_profile = "man-".$faker->numberBetween(0,4).".png";

                $g2user = new User();
                $g2user->name = $g2_name;
                $g2user->email = $g2_generateEmail.'.smartcamp.com';
                $g2user->profile_photo_path = "storage/profile/".$g2_profile;
                $g2user->school_id = 1;
                $g2user->email_verified_at = $now;
                $g2user->password = Hash::make('123456789');
                $g2user->save();

                VerifyUser::create([
                    'user_id' => $g2user->id,
                    'token' => sha1(time())
                ]);
                $g2user->assignRole('Guardian');

                $g2 = new Guardian();
                $g2->workemail = $faker->email();
                $g2->relatiionship = "Mother" ;
                $g2->phone = $faker->phoneNumber();
                $g2->occupation = $jobs[$faker->numberBetween(0,53)];
                $g2->user_id = $g2user->id;
                $g2->staff_id = 1;
                $g2->save();

                DB::table('guardian_student')->insert([
                    'guardian_id' => $g2->id,
                    'student_id' => $student->id,
                ]);


            }

        }


    }
}
