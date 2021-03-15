<?php

namespace Munovv\LogParser;


interface AccessParserInterface
{

        /**
        * Function parse()
        *
        *
        * Парсит apache_access.log на необходимые фрагменты.
        * На данный момент принимает только тестовый access.log
        * Для реального случая функция keyToHumanSee не будет актуальна
        *
        * @param string $line     Линия, которая парсится в данный момент
        * @param float  $access   Минимально допустимый уровень доступности в %
        * @param float  $time     Приемлимое время ответа (Таймаут)
        *
        *
        */

        public function parse(string $line, float $access, float $timeout): void;

        /**
        * Function keyToHumanSee()
        *
        *
        * Приводит ключи массива к человекочитаемому виду (По факту не особо важна,
        * только для тестов и код-ревью)
        *
        * @param array $group_logs   Массив с отфильтрованными кусками access.log
        *                            Имеет не читабельный вид. К примеру [7] будет
        *                            выглядеть как 500 <= ErrorCode
        *
        * @return array $log_units  Тот же самый массив, но с человекопонятными ключами
        */

        public function keyToHumanSee(array $group_logs): array;

        /**
        * Function run()
        *
        *
        * Запуск бизнес-логики класса AccessParser. Чтение файла, запуск самого парсера
        *
        * @param string $file_dir Путь к файлу журнала apache_access.log
        * @param float  $access   Минимально допустимый уровень доступности в %
        * @param float  $time     Приемлимое время ответа (Таймаут)
        *
        */

        public function run(string $file_dir, float $access, float $timeout): void;

}

 ?>
