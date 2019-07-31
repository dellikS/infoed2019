<?php

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
	$Countries = [
		[	
			'code' => 'ar','name' => "Argentina",'phonecode' => 54, 'translated' => false
		],
		[			
			'code' => 'au','name' => "Australia",'phonecode' => 61, 'translated' => false
		],
		[					
			'code' => 'at','name' => "Austria",'phonecode' => 43, 'translated' => false
		],
		[
			'code' => 'bd','name' => "Bangladesh",'phonecode' => 880, 'translated' => false
		],
		[
			'code' => 'by','name' => "Belarus",'phonecode' => 375, 'translated' => false
		],
		[
			'code' => 'be','name' => "Belgium",'phonecode' => 32, 'translated' => false
		],
		[
			'code' => 'bo','name' => "Bolivia",'phonecode' => 591, 'translated' => false
		],
		[
			'code' => 'bw','name' => "Botswana",'phonecode' => 267, 'translated' => false
		],
		[
			
			'code' => 'br','name' => "Brazil",'phonecode' => 55, 'translated' => false
		],
		[
			'code' => 'bg','name' => "Bulgaria",'phonecode' => 359, 'translated' => false
		],
		[
			'code' => 'ca','name' => "Canada",'phonecode' => 1, 'translated' => false
		],
		[
			'code' => 'td','name' => "Chad",'phonecode' => 235, 'translated' => false
		],
		[
			'code' => 'cl','name' => "Chile",'phonecode' => 56, 'translated' => false
		],
		[
			'code' => 'cn','name' => "China",'phonecode' => 86, 'translated' => false
		],
		[
			'code' => 'co','name' => "Colombia",'phonecode' => 57, 'translated' => false
		],
		[
			'code' => 'cr','name' => "Costa Rica",'phonecode' => 506, 'translated' => false
		],
		[
			'code' => 'hr','name' => "Croatia (Hrvatska]",'phonecode' => 385, 'translated' => false
		],
		[
			'code' => 'cu','name' => "Cuba",'phonecode' => 53, 'translated' => false
		],
		[
			'code' => 'cy','name' => "Cyprus",'phonecode' => 357, 'translated' => false
		],
		[
			'code' => 'cz','name' => "Czech Republic",'phonecode' => 420, 'translated' => false
		],
		[
			'code' => 'dk','name' => "Denmark",'phonecode' => 45, 'translated' => false
		],
		[
			'code' => 'do','name' => "Dominican Republic",'phonecode' => 1809, 'translated' => false
		],
		[
			'code' => 'eg','name' => "Egypt",'phonecode' => 20, 'translated' => false
		],
		[
			'code' => 'ee','name' => "Estonia",'phonecode' => 372, 'translated' => false
		],
		[
			'code' => 'fi','name' => "Finland",'phonecode' => 358, 'translated' => false
		],
		[
			'code' => 'fr','name' => "France",'phonecode' => 33, 'translated' => false
		],
		[
			'code' => 'ge','name' => "Georgia",'phonecode' => 995, 'translated' => false
		],
		[
			'code' => 'de','name' => "Germany",'phonecode' => 49, 'translated' => false
		],
		[
			'code' => 'gr','name' => "Greece",'phonecode' => 30, 'translated' => false
		],
		[
			'code' => 'gl','name' => "Greenland",'phonecode' => 299, 'translated' => false
		],
		[		
			'code' => 'gu','name' => "Guam",'phonecode' => 1671, 'translated' => false
		],
		[		
			'code' => 'gn','name' => "Guinea",'phonecode' => 224, 'translated' => false
		],
		[		
			'code' => 'hk','name' => "Hong Kong S.A.R.",'phonecode' => 852, 'translated' => false
		],
		[		
			'code' => 'hu','name' => "Hungary",'phonecode' => 36, 'translated' => false
		],
		[		
			'code' => 'is','name' => "Iceland",'phonecode' => 354, 'translated' => false
		],
		[		
			'code' => 'in','name' => "India",'phonecode' => 91, 'translated' => false
		],
		[		
			'code' => 'id','name' => "Indonesia",'phonecode' => 62, 'translated' => false
		],
		[		
			'code' => 'ir','name' => "Iran",'phonecode' => 98, 'translated' => false
		],
		[		
			'code' => 'iq','name' => "Iraq",'phonecode' => 964, 'translated' => false
		],
		[
			'code' => 'ie','name' => "Ireland",'phonecode' => 353, 'translated' => false
		],
		[
			'code' => 'il','name' => "Israel",'phonecode' => 972, 'translated' => false
		],
		[
			'code' => 'it','name' => "Italy",'phonecode' => 39, 'translated' => false
		],
		[
			'code' => 'jm','name' => "Jamaica",'phonecode' => 1876, 'translated' => false
		],
		[
			'code' => 'jp','name' => "Japan",'phonecode' => 81, 'translated' => false
		],
		[
			'code' => 'kz','name' => "Kazakhstan",'phonecode' => 7, 'translated' => false
		],
		[
			'code' => 'kr','name' => "Korea South",'phonecode' => 82, 'translated' => false
		],
		[
			'code' => 'ly','name' => "Libya",'phonecode' => 218, 'translated' => false
		],
		[
			'code' => 'lt','name' => "Lithuania",'phonecode' => 370, 'translated' => false
		],
		[
			'code' => 'lu','name' => "Luxembourg",'phonecode' => 352, 'translated' => false
		],
		[
			'code' => 'mk','name' => "Macedonia",'phonecode' => 389, 'translated' => false
		],
		[
			'code' => 'mg','name' => "Madagascar",'phonecode' => 261, 'translated' => false
		],
		[
			'code' => 'mw','name' => "Malawi",'phonecode' => 265, 'translated' => false
		],
		[
			'code' => 'my','name' => "Malaysia",'phonecode' => 60, 'translated' => false
		],
		[
			'code' => 'mv','name' => "Maldives",'phonecode' => 960, 'translated' => false
		],
		[
			'code' => 'mt','name' => "Malta",'phonecode' => 356, 'translated' => false
		],
		[
			'code' => 'mx','name' => "Mexico",'phonecode' => 52, 'translated' => false
		],
		[
			'code' => 'fm','name' => "Micronesia",'phonecode' => 691, 'translated' => false
		],
		[
			'code' => 'md','name' => "Moldova",'phonecode' => 373, 'translated' => false
		],
		[
			'code' => 'mc','name' => "Monaco",'phonecode' => 377, 'translated' => false
		],
		[
			'code' => 'np','name' => "Nepal",'phonecode' => 977, 'translated' => false
		],
		[
			'code' => 'an','name' => "Netherlands Antilles",'phonecode' => 599, 'translated' => false
		],
		[
			'code' => 'nz','name' => "New Zealand",'phonecode' => 64, 'translated' => false
		],
		[
			'code' => 'ng','name' => "Nigeria",'phonecode' => 234, 'translated' => false
		],
		[
			'code' => 'nu','name' => "Niue",'phonecode' => 683, 'translated' => false
		],
		[
			'code' => 'nf','name' => "Norfolk Island",'phonecode' => 672, 'translated' => false
		],
		[
			'code' => 'mp','name' => "Northern Mariana Islands",'phonecode' => 1670, 'translated' => false
		],
		[
			'code' => 'no','name' => "Norway",'phonecode' => 47, 'translated' => false
		],
		[
			'code' => 'om','name' => "Oman",'phonecode' => 968, 'translated' => false
		],
		[
			'code' => 'pk','name' => "Pakistan",'phonecode' => 92, 'translated' => false
		],
		[
			'code' => 'pw','name' => "Palau",'phonecode' => 680, 'translated' => false
		],
		[
			'code' => 'pa','name' => "Panama",'phonecode' => 507, 'translated' => false
		],
		[
			'code' => 'pg','name' => "Papua new Guinea",'phonecode' => 675, 'translated' => false
		],
		[
			'code' => 'py','name' => "Paraguay",'phonecode' => 595, 'translated' => false
		],
		[
			'code' => 'pe','name' => "Peru",'phonecode' => 51, 'translated' => false
		],
		[
			'code' => 'ph','name' => "Philippines",'phonecode' => 63, 'translated' => false
		],
		[
			'code' => 'pn','name' => "Pitcairn Island",'phonecode' => 0, 'translated' => false
		],
		[
			'code' => 'pl','name' => "Poland",'phonecode' => 48, 'translated' => false
		],
		[
			'code' => 'pt','name' => "Portugal",'phonecode' => 351, 'translated' => false
		],
		[
			'code' => 'pr','name' => "Puerto Rico",'phonecode' => 1787, 'translated' => false
		],
		[
			'code' => 'qa','name' => "Qatar",'phonecode' => 974, 'translated' => false
		],
		[
			'code' => 're','name' => "Reunion",'phonecode' => 262, 'translated' => false
		],
		[
			'code' => 'ro','name' => "Romania",'phonecode' => 40, 'translated' => true
		],
		[
			'code' => 'ru','name' => "Russia",'phonecode' => 70, 'translated' => false
		],
		[
			'code' => 'rw','name' => "Rwanda",'phonecode' => 250, 'translated' => false
		],
		[
			'code' => 'sm','name' => "San Marino",'phonecode' => 378, 'translated' => false
		],
		[
			'code' => 'sn','name' => "Senegal",'phonecode' => 221, 'translated' => false
		],
		[
			'code' => 'rs','name' => "Serbia",'phonecode' => 381, 'translated' => false
		],
		[
			'code' => 'sg','name' => "Singapore",'phonecode' => 65, 'translated' => false
		],
		[
			'code' => 'sk','name' => "Slovakia",'phonecode' => 421, 'translated' => false
		],
		[
			'code' => 'si','name' => "Slovenia",'phonecode' => 386, 'translated' => false
		],
		[
			'code' => 'so','name' => "Somalia",'phonecode' => 252, 'translated' => false
		],
		[
			'code' => 'za','name' => "South Africa",'phonecode' => 27, 'translated' => false
		],
		[
			'code' => 'es','name' => "Spain",'phonecode' => 34, 'translated' => false
		],
		[
			'code' => 'se','name' => "Sweden",'phonecode' => 46, 'translated' => false
		],
		[
			'code' => 'tw','name' => "Taiwan",'phonecode' => 886, 'translated' => false
		],
		[
			'code' => 'tz','name' => "Tanzania",'phonecode' => 255, 'translated' => false
		],
		[
			'code' => 'th','name' => "Thailand",'phonecode' => 66, 'translated' => false
		],
		[
			'code' => 'tn','name' => "Tunisia",'phonecode' => 216, 'translated' => false
		],
		[
			'code' => 'tr','name' => "Turkey",'phonecode' => 90, 'translated' => false
		],
		[
			'code' => 'ug','name' => "Uganda",'phonecode' => 256, 'translated' => false
		],
		[
			'code' => 'ua','name' => "Ukraine",'phonecode' => 380, 'translated' => false
		],
		[
			'code' => 'ae','name' => "United Arab Emirates",'phonecode' => 971, 'translated' => false
		],
		[
			'code' => 'en','name' => "United Kingdom",'phonecode' => 44, 'translated' => true
		],
		[
			'code' => 'us','name' => "United States",'phonecode' => 1, 'translated' => false
		],
		[
			'code' => 'uy','name' => "Uruguay",'phonecode' => 598, 'translated' => false
		],
		[
			'code' => 'uz','name' => "Uzbekistan",'phonecode' => 998, 'translated' => false
		],
		[
			'code' => 've','name' => "Venezuela",'phonecode' => 58, 'translated' => false
		],
		[
			'code' => 'vn','name' => "Vietnam",'phonecode' => 84, 'translated' => false
		],
		[
			'code' => 'yu','name' => "Yugoslavia",'phonecode' => 38, 'translated' => false
		],
		[
			'code' => 'zw','name' => "Zimbabwe",'phonecode' => 263, 'translated' => false
		],
		];
		foreach ($Countries as $Country) {
			$newCountry = Country::create([
				'code'      => $Country['code'],
				'name'      => $Country['name'],
				'phonecode' => $Country['phonecode'],
				'translated' => $Country['translated'],
			]);
		}
	}
}
