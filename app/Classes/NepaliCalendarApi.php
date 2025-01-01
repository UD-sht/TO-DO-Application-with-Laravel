<?php

namespace App\Classes;

class NepaliCalendarApi
{

    protected $_dateSeparator = '-';

    protected static $instance = null;

    protected $bs = array(
        0 => array(2000, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        1 => array(2001, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        2 => array(2002, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        3 => array(2003, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        4 => array(2004, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        5 => array(2005, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        6 => array(2006, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        7 => array(2007, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        8 => array(2008, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31),
        9 => array(2009, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        10 => array(2010, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        11 => array(2011, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        12 => array(2012, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        13 => array(2013, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        14 => array(2014, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        15 => array(2015, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        16 => array(2016, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        17 => array(2017, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        18 => array(2018, 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        19 => array(2019, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        20 => array(2020, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        21 => array(2021, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        22 => array(2022, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        23 => array(2023, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        24 => array(2024, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        25 => array(2025, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        26 => array(2026, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        27 => array(2027, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        28 => array(2028, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        29 => array(2029, 31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30),
        30 => array(2030, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        31 => array(2031, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        32 => array(2032, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        33 => array(2033, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        34 => array(2034, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        35 => array(2035, 30, 32, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31),
        36 => array(2036, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        37 => array(2037, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        38 => array(2038, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        39 => array(2039, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        40 => array(2040, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        41 => array(2041, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        42 => array(2042, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        43 => array(2043, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        44 => array(2044, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        45 => array(2045, 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        46 => array(2046, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        47 => array(2047, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        48 => array(2048, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        49 => array(2049, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        50 => array(2050, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        51 => array(2051, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        52 => array(2052, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        53 => array(2053, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        54 => array(2054, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        55 => array(2055, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        56 => array(2056, 31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30),
        57 => array(2057, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        58 => array(2058, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        59 => array(2059, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        60 => array(2060, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        61 => array(2061, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        62 => array(2062, 30, 32, 31, 32, 31, 31, 29, 30, 29, 30, 29, 31),
        63 => array(2063, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        64 => array(2064, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        65 => array(2065, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        66 => array(2066, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31),
        67 => array(2067, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        68 => array(2068, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        69 => array(2069, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        70 => array(2070, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        71 => array(2071, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        72 => array(2072, 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        73 => array(2073, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        74 => array(2074, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        75 => array(2075, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        76 => array(2076, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        77 => array(2077, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        78 => array(2078, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        79 => array(2079, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        80 => array(2080, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        81 => array(2081, 31, 31, 32, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        82 => array(2082, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        83 => array(2083, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
        84 => array(2084, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
        85 => array(2085, 31, 32, 31, 32, 30, 31, 30, 30, 29, 30, 30, 30),
        86 => array(2086, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        87 => array(2087, 31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30),
        88 => array(2088, 30, 31, 32, 32, 30, 31, 30, 30, 29, 30, 30, 30),
        89 => array(2089, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        90 => array(2090, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30)
    );

    protected $bsYearMonth = array(
        2000=>array(2000,30,32,31,32,31,30,30,30,29,30,29,31),
        2001=>array(2001,31,31,32,31,31,31,30,29,30,29,30,30),
        2002=>array(2002,31,31,32,32,31,30,30,29,30,29,30,30),
        2003=>array(2003,31,32,31,32,31,30,30,30,29,29,30,31),
        2004=>array(2004,30,32,31,32,31,30,30,30,29,30,29,31),
        2005=>array(2005,31,31,32,31,31,31,30,29,30,29,30,30),
        2006=>array(2006,31,31,32,32,31,30,30,29,30,29,30,30),
        2007=>array(2007,31,32,31,32,31,30,30,30,29,29,30,31),
        2008=>array(2008,31,31,31,32,31,31,29,30,30,29,29,31),
        2009=>array(2009,31,31,32,31,31,31,30,29,30,29,30,30),
        2010=>array(2010,31,31,32,32,31,30,30,29,30,29,30,30),
        2011=>array(2011,31,32,31,32,31,30,30,30,29,29,30,31),
        2012=>array(2012,31,31,31,32,31,31,29,30,30,29,30,30),
        2013=>array(2013,31,31,32,31,31,31,30,29,30,29,30,30),
        2014=>array(2014,31,31,32,32,31,30,30,29,30,29,30,30),
        2015=>array(2015,31,32,31,32,31,30,30,30,29,29,30,31),
        2016=>array(2016,31,31,31,32,31,31,29,30,30,29,30,30),
        2017=>array(2017,31,31,32,31,31,31,30,29,30,29,30,30),
        2018=>array(2018,31,32,31,32,31,30,30,29,30,29,30,30),
        2019=>array(2019,31,32,31,32,31,30,30,30,29,30,29,31),
        2020=>array(2020,31,31,31,32,31,31,30,29,30,29,30,30),
        2021=>array(2021,31,31,32,31,31,31,30,29,30,29,30,30),
        2022=>array(2022,31,32,31,32,31,30,30,30,29,29,30,30),
        2023=>array(2023,31,32,31,32,31,30,30,30,29,30,29,31),
        2024=>array(2024,31,31,31,32,31,31,30,29,30,29,30,30),
        2025=>array(2025,31,31,32,31,31,31,30,29,30,29,30,30),
        2026=>array(2026,31,32,31,32,31,30,30,30,29,29,30,31),
        2027=>array(2027,30,32,31,32,31,30,30,30,29,30,29,31),
        2028=>array(2028,31,31,32,31,31,31,30,29,30,29,30,30),
        2029=>array(2029,31,31,32,31,32,30,30,29,30,29,30,30),
        2030=>array(2030,31,32,31,32,31,30,30,30,29,29,30,31),
        2031=>array(2031,30,32,31,32,31,30,30,30,29,30,29,31),
        2032=>array(2032,31,31,32,31,31,31,30,29,30,29,30,30),
        2033=>array(2033,31,31,32,32,31,30,30,29,30,29,30,30),
        2034=>array(2034,31,32,31,32,31,30,30,30,29,29,30,31),
        2035=>array(2035,30,32,31,32,31,31,29,30,30,29,29,31),
        2036=>array(2036,31,31,32,31,31,31,30,29,30,29,30,30),
        2037=>array(2037,31,31,32,32,31,30,30,29,30,29,30,30),
        2038=>array(2038,31,32,31,32,31,30,30,30,29,29,30,31),
        2039=>array(2039,31,31,31,32,31,31,29,30,30,29,30,30),
        2040=>array(2040,31,31,32,31,31,31,30,29,30,29,30,30),
        2041=>array(2041,31,31,32,32,31,30,30,29,30,29,30,30),
        2042=>array(2042,31,32,31,32,31,30,30,30,29,29,30,31),
        2043=>array(2043,31,31,31,32,31,31,29,30,30,29,30,30),
        2044=>array(2044,31,31,32,31,31,31,30,29,30,29,30,30),
        2045=>array(2045,31,32,31,32,31,30,30,29,30,29,30,30),
        2046=>array(2046,31,32,31,32,31,30,30,30,29,29,30,31),
        2047=>array(2047,31,31,31,32,31,31,30,29,30,29,30,30),
        2048=>array(2048,31,31,32,31,31,31,30,29,30,29,30,30),
        2049=>array(2049,31,32,31,32,31,30,30,30,29,29,30,30),
        2050=>array(2050,31,32,31,32,31,30,30,30,29,30,29,31),
        2051=>array(2051,31,31,31,32,31,31,30,29,30,29,30,30),
        2052=>array(2052,31,31,32,31,31,31,30,29,30,29,30,30),
        2053=>array(2053,31,32,31,32,31,30,30,30,29,29,30,30),
        2054=>array(2054,31,32,31,32,31,30,30,30,29,30,29,31),
        2055=>array(2055,31,31,32,31,31,31,30,29,30,29,30,30),
        2056=>array(2056,31,31,32,31,32,30,30,29,30,29,30,30),
        2057=>array(2057,31,32,31,32,31,30,30,30,29,29,30,31),
        2058=>array(2058,30,32,31,32,31,30,30,30,29,30,29,31),
        2059=>array(2059,31,31,32,31,31,31,30,29,30,29,30,30),
        2060=>array(2060,31,31,32,32,31,30,30,29,30,29,30,30),
        2061=>array(2061,31,32,31,32,31,30,30,30,29,29,30,31),
        2062=>array(2062,30,32,31,32,31,31,29,30,29,30,29,31),
        2063=>array(2063,31,31,32,31,31,31,30,29,30,29,30,30),
        2064=>array(2064,31,31,32,32,31,30,30,29,30,29,30,30),
        2065=>array(2065,31,32,31,32,31,30,30,30,29,29,30,31),
        2066=>array(2066,31,31,31,32,31,31,29,30,30,29,29,31),
        2067=>array(2067,31,31,32,31,31,31,30,29,30,29,30,30),
        2068=>array(2068,31,31,32,32,31,30,30,29,30,29,30,30),
        2069=>array(2069,31,32,31,32,31,30,30,30,29,29,30,31),
        2070=>array(2070,31,31,31,32,31,31,29,30,30,29,30,30),
        2071=>array(2071,31,31,32,31,31,31,30,29,30,29,30,30),
        2072=>array(2072,31,32,31,32,31,30,30,29,30,29,30,30),
        2073=>array(2073,31,32,31,32,31,30,30,30,29,29,30,31),
        2074=>array(2074,31,31,31,32,31,31,30,29,30,29,30,30),
        2075=>array(2075,31,31,32,31,31,31,30,29,30,29,30,30),
        2076=>array(2076,31,32,31,32,31,30,30,30,29,29,30,30),
        2077=>array(2077,31,32,31,32,31,30,30,30,29,30,29,31),
        2078=>array(2078,31,31,31,32,31,31,30,29,30,29,30,30),
        2079=>array(2079,31,31,32,31,31,31,30,29,30,29,30,30),
        2080=>array(2080,31,32,31,32,31,30,30,30,29,29,30,30),
        2081=>array(2081, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        2082=>array(2082, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        2083=>array(2083, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
        2084=>array(2084, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
        2085=>array(2085, 31, 32, 31, 32, 30, 31, 30, 30, 29, 30, 30, 30),
        2086=>array(2086, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        2087=>array(2087, 31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30),
        2088=>array(2088, 30, 31, 32, 32, 30, 31, 30, 30, 29, 30, 30, 30),
        2089=>array(2089, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        2090=>array(2090, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),

    );

    private $nep_date = array('year' => '', 'month' => '', 'date' => '', 'day' => '', 'nmonth' => '', 'num_day' => '');
    private $eng_date = array('year' => '', 'month' => '', 'date' => '', 'day' => '', 'emonth' => '', 'num_day' => '');
    public $debug_info = "";

    public $nep_tithis = array(
        'प्रतिपदा' => 'प्रतिपदा',
        'द्वितीया' => 'द्वितीया',
        'तृतिया' => 'तृतिया',
        'चतुर्थी' => 'चतुर्थी',
        'पञ्चमी' => 'पञ्चमी',
        'षष्ठी' => 'षष्ठी',
        'सप्तमी' => 'सप्तमी',
        'अष्टमी' => 'अष्टमी',
        'नवमी' => 'नवमी',
        'दशमी' => 'दशमी',
        'एकादशी' => 'एकादशी',
        'द्वादशी' => 'द्वादशी',
        'त्रयोदशी' => 'त्रयोदशी',
        'चतुर्दशी' => 'चतुर्दशी',
        'औंसी' => 'औंसी',
        'पूर्णिमा' => 'पूर्णिमा'
    );

    public function getInstance()
    {
        if (NepaliCalendarApi::$instance == null) {
            NepaliCalendarApi::$instance = new NepaliCalendarApi();
        }
        return NepaliCalendarApi::$instance;
    }

    public function nep_years(){
        return array(
            "1975" => "१९७५","1976" => "१९७६","1977" => "१९७७","1978" => "१९७८","1979" => "१९७९","1980" => "१९८०","1981" => "१९८१","1982" => "१९८२","1983" => "१९८३","1984" => "१९८४","1985" => "१९८५","1986" => "१९८६","1987" => "१९८७","1988" => "१९८८","1989" => "१९८९","1990" => "१९९०","1991" => "१९९१","1992" => "१९९२","1993" => "१९९३","1994" => "१९९४","1995" => "१९९५","1996" => "१९९६","1997" => "१९९७","1998" => "१९९८","1999" => "१९९९",
            "2000" => "२०००","2001" => "२००१","2002" => "२००२","2003" => "२००३","2004" => "२००४","2005" => "२००५","2006" => "२००६","2007" => "२००७","2008" => "२००८","2009" => "२००९","2010" => "२०१०","2011" => "२०११","2012" => "२०१२","2013" => "२०१३","2014" => "२०१४","2015" => "२०१५","2016" => "२०१६","2017" => "२०१७","2018" => "२०१८","2019" => "२०१९","2020" => "२०२०","2021" => "२०२१","2022" => "२०२२","2023" => "२०२३","2024" => "२०२४","2025" => "२०२५","2026" => "२०२६","2027" => "२०२७","2028" => "२०२८","2029" => "२०२९","2030" => "२०३०","2031" => "२०३१","2032" => "२०३२","2033" => "२०३३","2034" => "२०३४","2035" => "२०३५","2036" => "२०३६","2037" => "२०३७","2038" => "२०३८","2039" => "२०३९","2040" => "२०४०","2041" => "२०४१","2042" => "२०४२","2043" => "२०४३","2044" => "२०४४","2045" => "२०४५","2046" => "२०४६","2047" => "२०४७","2048" => "२०४८","2049" => "२०४९","2050" => "२०५०","2051" => "२०५१","2052" => "२०५२","2053" => "२०५३","2054" => "२०५४","2055" => "२०५५","2056" => "२०५६","2057" => "२०५७","2058" => "२०५८","2059" => "२०५९","2060" => "२०६०","2061" => "२०६१","2062" => "२०६२","2063" => "२०६३","2064" => "२०६४","2065" => "२०६५","2066" => "२०६६","2067" => "२०६७","2068" => "२०६८","2069" => "२०६९","2070" => "२०७०","2071" => "२०७१","2072" => "२०७२","2073" => "२०७३","2074" => "२०७४","2075" => "२०७५","2076" => "२०७६","2077" => "२०७७","2078" => "२०७८","2079" => "२०७९","2080" => "२०८०","2081" => "२०८१","2082" => "२०८२","2083" => "२०८३","2084" => "२०८४","2085" => "२०८५","2086" => "२०८६","2087" => "२०८७","2088" => "२०८८","2089" => "२०८९","2090" => "२०९०","2091" => "२०९१","2092" => "२०९२","2093" => "२०९३","2094" => "२०९४","2095" => "२०९५","2096" => "२०९६","2097" => "२०९७","2098" => "२०९८","2099" => "२०९९","2100" => "२१००"
        );
    }
    public function nep_months(){
        return array(
            "01" => "बैशाख","02" => "जेठ","03" => "आषाढ","04" => "साउन","05" => "भाद्र","06" => "आश्विन","07" => "कार्तिक","08" => "मंसिर","09" => "पौष","10" => "माघ","11" => "फाल्गुण","12" => "चैत्र"
        );
    }

    public function nep_dates(){
        return array(
            "01" => "०१",
            "02" => "०२",
            "03" => "०३",
            "04" => "०४",
            "05" => "०५",
            "06" => "०६",
            "07" => "०७",
            "08" => "०८",
            "09" => "०९",
            "10" => "१०",
            "11" => "११",
            "12" => "१२",
            "13" => "१३",
            "14" => "१४",
            "15" => "१५",
            "16" => "१६",
            "17" => "१७",
            "18" => "१८",
            "19" => "१९",
            "20" => "२०",
            "21" => "२१",
            "22" => "२२",
            "23" => "२३",
            "24" => "२४",
            "25" => "२५",
            "26" => "२६",
            "27" => "२७",
            "28" => "२८",
            "29" => "२९",
            "30" => "३०",
            "31" => "३१",
            "32" => "३२"
        );
    }

    protected function nep_days(){
        return array(
            "01" => "आइतवार",
            "02" => "सोमवार",
            "03" => "मंगलबार",
            "04" => "बुधवार",
            "05" => "बिहिवार",
            "06" => "शुक्रवार",
            "07" => "शनिवार"
        );
    }

    /**
     * Calculates wheather english year is leap year or not
     *
     * @param integer $year
     * @return boolean
     */
    protected function is_leap_year($year)
    {
        $a = $year;
        if ($a % 100 == 0) {
            if ($a % 400 == 0) {
                return true;
            } else {
                return false;
            }

        } else {
            if ($a % 4 == 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    protected function get_nepali_month($m)
    {
        $n_month = false;

        switch ($m) {
            case 1:
                $n_month = "Baishak";
                break;

            case 2:
                $n_month = "Jestha";
                break;

            case 3:
                $n_month = "Ashad";
                break;

            case 4:
                $n_month = "Shrawan";
                break;

            case 5:
                $n_month = "Bhadra";
                break;

            case 6:
                $n_month = "Ashwin";
                break;

            case 7:
                $n_month = "Kartik";
                break;

            case 8:
                $n_month = "Mangshir";
                break;

            case 9:
                $n_month = "Poush";
                break;

            case 10:
                $n_month = "Magh";
                break;

            case 11:
                $n_month = "Falgun";
                break;

            case 12:
                $n_month = "Chaitra";
                break;
        }
        return $n_month;
    }

    protected function get_nepali_month_nepali($m){
        $n_month = false;

        switch($m){
            case 1:
                $n_month = "बैशाख";
                break;

            case 2:
                $n_month = "जेष्ठ";
                break;

            case 3:
                $n_month = "आषाढ";
                break;

            case 4:
                $n_month = "श्रावण";
                break;

            case 5:
                $n_month = "भाद्र";
                break;

            case 6:
                $n_month = "आश्विन";
                break;

            case 7:
                $n_month = "कार्तिक";
                break;

            case 8:
                $n_month = "मंसिर";
                break;

            case 9:
                $n_month = "पौष";
                break;

            case 10:
                $n_month = "माघ";
                break;

            case 11:
                $n_month = "फाल्गुन";
                break;

            case 12:
                $n_month = "चैत्र";
                break;
        }
        return  $n_month;
    }

    protected function get_english_month($m)
    {
        $eMonth = false;
        switch ($m) {
            case 1:
                $eMonth = "January";
                break;
            case 2:
                $eMonth = "February";
                break;
            case 3:
                $eMonth = "March";
                break;
            case 4:
                $eMonth = "April";
                break;
            case 5:
                $eMonth = "May";
                break;
            case 6:
                $eMonth = "June";
                break;
            case 7:
                $eMonth = "July";
                break;
            case 8:
                $eMonth = "August";
                break;
            case 9:
                $eMonth = "September";
                break;
            case 10:
                $eMonth = "October";
                break;
            case 11:
                $eMonth = "November";
                break;
            case 12:
                $eMonth = "December";
        }
        return $eMonth;
    }

    protected function get_day_of_week($day)
    {
        switch ($day) {
            case 1:
                $day = "Sunday";
                break;

            case 2:
                $day = "Monday";
                break;

            case 3:
                $day = "Tuesday";
                break;

            case 4:
                $day = "Wednesday";
                break;

            case 5:
                $day = "Thursday";
                break;

            case 6:
                $day = "Friday";
                break;

            case 7:
                $day = "Saturday";
                break;
        }
        return $day;
    }


    protected function is_range_eng($yy, $mm, $dd)
    {
        if ($yy < 1944 || $yy > 2033) {
            $this->debug_info = "Supported only between 1944-2022";
            return false;
        }

        if ($mm < 1 || $mm > 12) {
            $this->debug_info = "Error! value 1-12 only";
            return false;
        }

        if ($dd < 1 || $dd > 31) {
            $this->debug_info = "Error! value 1-31 only";
            return false;
        }

        return true;
    }

    protected function is_range_nep($yy, $mm, $dd)
    {
        if ($yy < 2000 || $yy > 2089) {
            $this->debug_info = "Supported only between 2000-2089";
            return false;
        }

        if ($mm < 1 || $mm > 12) {
            $this->debug_info = "Error! value 1-12 only";
            return false;
        }

        if ($dd < 1 || $dd > 32) {
            $this->debug_info = "Error! value 1-31 only";
            return false;
        }

        return true;
    }


    /**
     * currently can only calculate the date between AD 1944-2033...
     *
     * @param $yy
     * @param $mm
     * @param $dd
     * @param string $proper_format
     * @return bool|string[]
     */
    public function eng_to_nep($yy, $mm, $dd, $proper_format = "1")
    {
        if ($this->is_range_eng($yy, $mm, $dd) == false) {
            return false;
        } else {

            // english month data.
            $month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
            $lmonth = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

            $def_eyy = 1944;                                    //spear head english date...
            $def_nyy = 2000;
            $def_nmm = 9;
            $def_ndd = 17 - 1;        //spear head nepali date...
            $total_eDays = 0;
            $total_nDays = 0;
            $a = 0;
            $day = 7 - 1;        //all the initializations...
            $m = 0;
            $y = 0;
            $i = 0;
            $j = 0;
            $numDay = 0;

            // count total no. of days in-terms of year
            for ($i = 0; $i < ($yy - $def_eyy); $i++) {    //total days for month calculation...(english)
                if ($this->is_leap_year($def_eyy + $i) == 1)
                    for ($j = 0; $j < 12; $j++)
                        $total_eDays += $lmonth[$j];
                else
                    for ($j = 0; $j < 12; $j++)
                        $total_eDays += $month[$j];
            }

            // count total no. of days in-terms of month
            for ($i = 0; $i < ($mm - 1); $i++) {
                if ($this->is_leap_year($yy) == 1)
                    $total_eDays += $lmonth[$i];
                else
                    $total_eDays += $month[$i];
            }

            /*
             *   Added (int) typecasting because of non-numeric value error in php 7.1 @ Amit Shrestha.
             */

            $total_eDays += (int)$dd;


            $i = 0;
            $j = $def_nmm;
            $total_nDays = $def_ndd;
            $m = $def_nmm;
            $y = $def_nyy;

            // count nepali date from array
            while ($total_eDays != 0) {
                $a = $this->bs[$i][$j];
                $total_nDays++;                        //count the days
                $day++;                                //count the days interms of 7 days
                if ($total_nDays > $a) {
                    $m++;
                    $total_nDays = 1;
                    $j++;
                }
                if ($day > 7)
                    $day = 1;
                if ($m > 12) {
                    $y++;
                    $m = 1;
                }
                if ($j > 12) {
                    $j = 1;
                    $i++;
                }
                $total_eDays--;
            }

            $numDay = $day;

            if (strlen($m) == "1" && $proper_format)
                $m = "0" . $m;

            if (strlen($total_nDays) == "1" && $proper_format)
                $total_nDays = "0" . $total_nDays;

            $this->nep_date["year"] = $y;
            $this->nep_date["month"] = $m;
            $this->nep_date["date"] = $total_nDays;
            $this->nep_date["day"] = $this->get_day_of_week($day);
            $this->nep_date["nmonth"] = $this->get_nepali_month($m);
            $this->nep_date["num_day"] = $numDay;
            return $this->nep_date;
        }
    }


    /**
     * currently can only calculate the date between BS 2000-2089
     *
     * @param $yy
     * @param $mm
     * @param $dd
     * @return bool|string[]
     */
    public function nep_to_eng($yy, $mm, $dd)
    {
        $def_eyy = 1943;
        $def_emm = 4;
        $def_edd = 14 - 1;        // init english date.
        $def_nyy = 2000;
        $def_nmm = 1;
        $def_ndd = 1;        // equivalent nepali date.
        $total_eDays = 0;
        $total_nDays = 0;
        $a = 0;
        $day = 4 - 1;        // initializations...
        $m = 0;
        $y = 0;
        $i = 0;
        $k = 0;
        $numDay = 0;

        $month = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $lmonth = array(0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        if ($this->is_range_nep($yy, $mm, $dd) === false) {
            return false;

        } else {

            // count total days in-terms of year
            for ($i = 0; $i < ($yy - $def_nyy); $i++) {
                for ($j = 1; $j <= 12; $j++) {
                    $total_nDays += $this->bs[$k][$j];
                }
                $k++;
            }

            // count total days in-terms of month
            for ($j = 1; $j < $mm; $j++) {
                $total_nDays += $this->bs[$k][$j];
            }

            // count total days in-terms of dat
            $total_nDays += $dd;

            //calculation of equivalent english date...
            $total_eDays = $def_edd;
            $m = $def_emm;
            $y = $def_eyy;
            while ($total_nDays != 0) {
                if ($this->is_leap_year($y)) {
                    $a = $lmonth[$m];
                } else {
                    $a = $month[$m];
                }
                $total_eDays++;
                $day++;
                if ($total_eDays > $a) {
                    $m++;
                    $total_eDays = 1;
                    if ($m > 12) {
                        $y++;
                        $m = 1;
                    }
                }
                if ($day > 7)
                    $day = 1;
                $total_nDays--;
            }
            $numDay = $day;

            if (strlen($m) == '1')
                $m = "0" . $m;

            if (strlen($total_eDays) == '1')
                $total_eDays = "0" . $total_eDays;

            $this->eng_date["year"] = $y;
            $this->eng_date["month"] = $m;
            $this->eng_date["date"] = $total_eDays;
            $this->eng_date["day"] = $this->get_day_of_week($day);
            $this->eng_date["emonth"] = $this->get_english_month($m);
            $this->eng_date["num_day"] = $numDay;

            return $this->eng_date;
        }
    }

    public function nepaliToEnglish($yy, $mm = null, $dd = null)
    {
        if (strpos($yy, $this->_dateSeparator)) {
            list($yy, $mm, $dd) = explode($this->_dateSeparator, $yy);
        }
        $englishDateArray = $this->nep_to_eng($yy, $mm, $dd);
        if (!empty($englishDateArray)) {
            array_splice($englishDateArray, 3);
            return implode($this->_dateSeparator, $englishDateArray);
        } else {
            return null;
        }
    }

    /**
     * Should eventually make this static class
     *
     * @param $yy
     * @param null $mm
     * @param null $dd
     * @return mixed|string|null
     */
    public function englishToNepali($yy, $mm = null, $dd = null)
    {
        static $dateCache = array();

        if (strpos($yy, $this->_dateSeparator)) {
            list($yy, $mm, $dd) = explode($this->_dateSeparator, $yy);
        }

        if (!empty($dateCache[$yy . $mm . $dd])) {
            return $dateCache[$yy . $mm . $dd];
        } else {
            $nepaliDateArray = $this->eng_to_nep($yy, $mm, $dd);
            if (!empty($nepaliDateArray)) {
                array_splice($nepaliDateArray, 3);
                $nepaliDate = implode($this->_dateSeparator, $nepaliDateArray);
                $dateCache[$yy . $mm . $dd] = $nepaliDate;
                return $nepaliDate;
            } else {
                return null;
            }
        }
    }

    public function getNepaliMonth()
    {
        $nepaliDate = $this->eng_to_nep(date('Y'), date('m'), date('d'));
        return $nepaliDate['month'];
    }

    public function getCurrentNepaliDate($seconds = false)
    {
        $nepaliDate = $this->eng_to_nep(date('Y'), date('m'), date('d'));
        $date = $nepaliDate['year'].'-'.$nepaliDate['month'].'-'.$nepaliDate['date'];
        if ($seconds) {
            $date = $date . ' ' . date('H:i:s');
        }
        return $date;
    }

    public function nepaliToEnglishDate($date)
    {
        $return_date = '';
        if ($date) {
            $explode_date = explode('-', $date);
            if (count($explode_date) == '3') {
                $engDate = $this->nep_to_eng($explode_date[0], $explode_date[1], $explode_date[2]);
                $return_date = $engDate['year'] . '-' . $engDate['month'] . '-' . $engDate['date'];
            }
        }
        return $return_date;
    }

    public function englishToNepaliDate($date)
    {
        $return_date = '';
        if ($date) {
            $explode_date = explode('-', $date);
            if (count($explode_date) == '3') {
                $nepDate = $this->eng_to_nep($explode_date[0], $explode_date[1], $explode_date[2]);
                $return_date = $nepDate['year'] . '-' . $nepDate['month'] . '-' . $nepDate['date'];
            }
        }
        return $return_date;
    }

    public function getLastDayOfNepaliMonth($year, $month)
    {
        return $this->bsYearMonth[$year][$month];
    }

    public function getNepaliMonthName($m)
    {
        return $this->get_nepali_month($m);
    }
}
