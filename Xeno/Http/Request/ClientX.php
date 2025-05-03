<?php //*** ClientX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Http\Request;

use Illuminate\Support\Facades\Http;

class ClientX
{
	// • === ip » get or check against
	public static function ip($ip = null)
	{
		$clientIP = app('request')->ip();

		if (!$ip) {
			return $clientIP;
		}

		if ($ip && $clientIP) {
			return ((string) $ip === (string) $clientIP);
		}

		return false;
	}




	// • === localhost » check if host is local
	public static function localhost($host)
	{
		return ($host === 'localhost' || (string) $host === '127.0.0.1');
	}




	// • === data » get data from IP
	public static function data($ip = null)
	{
		if (self::localhost($ip)) {
			return ['isp' => 'localhost', 'query' => '127.0.0.1'];
		}

		$param = '
		as,
		city,
		continent,
		country,
		countryCode,
		currency,
		district,
		isp,
		lat,
		lon,
		message,
		query,
		regionName,
		status,
		timezone,
		zip';

		$ip = empty($ip) ? self::ip() : $ip;
		$url = 'http://ip-api.com/json/' . $ip . '?fields' . $param;
		$resp = Http::get($url);
		if ($resp->successful()) {
			return $resp->json();
		}

		return false;
	}

} //> end of class ~ ClientX