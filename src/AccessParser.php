<?php

declare(strict_types=1);

namespace Munovv\LogParser;

use Munovv\LogParser\AccessParserInterface;

class AccessParser implements AccessParserInterface
{

        public $pattern;
        public static $errors = [
          "400", "401", "402", "403", "404",
          "500", "501", "502", "503", "504"
        ];

        public function __construct()
        {
          ini_set('memory_limit', '512M');
          $this->pattern = require __DIR__ . "/pattern.php";
        }

        public function parse(string $line, float $access, float $timeout): void
        {
          if (preg_match($this->pattern['tech_regex'], $line, $lineParts)) {
            $log_unit = $this->keyToHumanSee($lineParts);
            if ($log_unit['timeout'] >= $timeout || in_array($log_unit['status'], self::$errors)) {
              print_r($lineParts);
            }
          }
        }

        public function keyToHumanSee(array $group_logs): array
        {
          foreach ($group_logs as $key => $value) {
            switch ($key) {
              case '1':
                $log_units['date'] = $value;
                break;

              case '2':
                $log_units['time'] = $value;
                break;

              case '7':
                $log_units['status'] = $value;
                break;

              case '9':
                $log_units['timeout'] = $value;
                break;

              case '11':
                $log_units['userAgent'] = $value;
                break;

              default:
                break;
            }
          }
          return $log_units;
        }

        public function run(string $file_dir, float $access, float $timeout): void
        {
          $file_handler = fopen($file_dir, "r");
          if ($file_handler) {
            while (($line = fgets($file_handler)) !== false) {
              $this->parse($line, $access, $timeout);
            }
            fclose($file_handler);
          } else {
            exit("Fatal error: unable to open the file!\n");
          }
        }

}

 ?>
