<?php
function tgl_indo($dateTime, $format = 'lengkap', $singkat = false, $waktu = false)
{
    if (is_string($dateTime)) {
        $dateTime = new \DateTime($dateTime);
    }
    $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $monthsFull = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $monthsAbbrev = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    $dayName = $days[$dateTime->format('w')];
    $monthName = $singkat ? $monthsAbbrev[$dateTime->format('n') - 1] : $monthsFull[$dateTime->format('n') - 1];
    $result = '';
    switch ($format) {
        case 'tgl':
            $result = "{$dateTime->format('d')} {$monthName} {$dateTime->format('Y')}";
            break;
        case 'tgl_hari':
            $result = "{$dayName}, {$dateTime->format('d')} {$monthName} {$dateTime->format('Y')}";
            break;
        case 'lengkap':
        default:
            $result = "{$dayName}, {$dateTime->format('d')} {$monthName} {$dateTime->format('Y')}";
    }
    if ($waktu) {
        $result .= ' ' . $dateTime->format('H:i:s');
    }
    return $result;
}
if (!function_exists('setActive')) {
    function setActive($url)
    {
        return request()->routeIs($url) ? 'active' : '';
    }
}
