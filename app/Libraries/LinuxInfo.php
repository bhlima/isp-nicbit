<?php

/**
 * nicbit isp
 *
 * An open source application management for isp - Radius / Mikrotik
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2021-2021 - nicbit 
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    ISP - Nicbit 
 * @author     nicbit dev team @ Flavio Lima
 * @copyright  2021-2021 Nicbit.com 
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @since      Version 1.1.0
 * @filesource
 */


class LinuxInfo
{

    public function uptime() {
        $file_name = "/proc/uptime";
    
        $fopen_file = fopen($file_name, 'r');
        $buffer = explode(' ', fgets($fopen_file, 4096));
        fclose($fopen_file);
    
        $sys_ticks = trim($buffer[0]);
        $min = $sys_ticks / 60;
        $hours = $min / 60;
        $days = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min = floor($min - ($days * 60 * 24) - ($hours * 60));
        $result = "";
    
        if ($days != 0) {
            if ($days > 1)
                $result = "$days " . " dias ";
            else
                $result = "$days " . " dia ";
        }
    
        if ($hours != 0) {
            if ($hours > 1)
                $result .= "$hours " . " horas ";
            else
                $result .= "$hours " . " hora ";
        }
    
        if ($min > 1 || $min == 0)
            $result .= "$min " . " minutos ";
        elseif ($min == 1)
            $result .= "$min " . " minuto ";
    
        return $result;
    }
    


// Display hostname system
// @return string System hostname or none
function get_hostname() {
	$file_name = "/proc/sys/kernel/hostname";

	if ($fopen_file = fopen($file_name, 'r')) {
		$result = trim(fgets($fopen_file, 4096));
		fclose($fopen_file);
	} else {
		$result = "(none)";
	}

	return $result;
}


// Display currenty date/time
// @return string Current system date/time or none
function get_datetime() {
	if ($today = date("F j, Y, g:i a")) {
		$result = $today;
	} else {
		$result = "(none)";
	}

	return $result;
}


// Get System Load Average
// @return array System Load Average
function get_system_load() {
	$file_name = "/proc/loadavg";
	$result = "";
	$output = "";

	// get the /proc/loadavg information
	if ($fopen_file = fopen($file_name, 'r')) {
		$result = trim(fgets($fopen_file, 256));
		fclose($fopen_file);
	} else {
		$result = "(none)";
	}

	$loadavg = explode(" ", $result);
	$output .= $loadavg[0] . " " . $loadavg[1] . " " . $loadavg[2] . "<br/>";


	// get information the 'top' program
	$file_name = "top -b -n1 | grep \"Tasks:\" -A1";
	$result = "";

	if ($popen_file = popen($file_name, 'r')) {
		$result = trim(fread($popen_file, 2048));
		pclose($popen_file);
	} else {
		$result = "(none)";
	}

	$result = str_replace("\n", "<br/>", $result);
	$output .= $result;

	return $output;
}





// Get Memory System MemTotal|MemFree
// @return array Memory System MemTotal|MemFree
function get_memory() {
	$file_name = "/proc/meminfo";
	$mem_array = array();

	$this->buffer = file($file_name);

	foreach ($this->buffer as $key => $value) 
     {
		if (strpos($value, ':') !== false) {
			$match_line = explode(':', $value);
			$match_value = explode(' ', trim($match_line[1]));
			if (is_numeric($match_value[0])) {
				$mem_array[trim($match_line[0])] = trim($match_value[0]);
			}
		}
	}

	return $mem_array;
}


//Get FreeDiskSpace
function get_hdd_freespace() {
$df = disk_free_space("/");
return $df;
}


// Convert value to MB
// @param decimal $value
// @return int Memory MB
function convert_ToMB($value) {
	return round($value / 1024) . " MB\n";
}



// Get all network names devices (eth[0-9])
// @return array Get list network name interfaces
function get_interface_list() {
	$devices = array();
	$file_name = "/proc/net/dev";

	if ($fopen_file = fopen($file_name, 'r')) {
		while ($buffer = fgets($fopen_file, 4096)) {
			if (preg_match("/eth[0-9][0-9]*/i", trim($buffer), $match)) {
				$devices[] = $match[0];
			}
		}
		$devices = array_unique($devices);
		sort($devices);
		fclose ($fopen_file);
	}
	return $devices;
}



// Get ip address
// @param string $ifname
// @return string Ip address or (none)
function get_ip_addr($ifname) {
	$command_name = "/sbin/ifconfig $ifname";
	$ifip = "";

	exec($command_name , $command_result);

	$ifip = implode($command_result, "\n");
	if (preg_match("/inet addr:[0-9\.]*/i", $ifip, $match)) {
		$match = explode(":", $match[0]);
		return $match[1];
	} elseif (preg_match("/inet [0-9\.]*/i", $ifip, $match)) {
		$match = explode(" ", $match[0]);
		return $match[1];
	} else {
		return "(none)";
	}
}

// Get mac address
// @param string $ifname
// @return string Mac address or (none)
function get_mac_addr($ifname) {
	$command_name = "/sbin/ifconfig $ifname";
	$ifip = "";

	exec($command_name , $command_result);

	$ifmac = implode($command_result, "\n");
	if (preg_match("/hwaddr [0-9A-F:]*/i", $ifmac, $match)) {
		$match = explode(" ", $match[0]);
		return $match[1];
	} elseif (preg_match("/ether [0-9A-F:]*/i", $ifmac, $match)) {
		$match = explode(" ", $match[0]);
		return $match[1];
	} else {
		return "(none)";
	}
}

// Get netmask address
// @param string $ifname
// @return string Netmask address or (none)
function get_mask_addr($ifname) {
	$command_name = "/sbin/ifconfig $ifname";
	$ifmask = "";

	exec($command_name , $command_result);

	$ifmask = implode($command_result, "\n");
	if (preg_match("/mask:[0-9\.]*/i", $ifmask, $match)) {
		$match = explode(":", $match[0]);
		return $match[1];
	} elseif (preg_match("/netmask [0-9\.]*/i", $ifmask, $match)) {
		$match = explode(" ", $match[0]);
		return $match[1];
	} else {
		return "(none)";
	}
}
















}
