<?php
/*
 * TFormat
 *
 * класс формирующий вывод текста
 */

class TFormat {

    /**
     * Форматирует число. Предполагается, что вводятся секунды
     * @param int $fNumber Количество цифр после запятой
     * @param string $timing В каком виде 's' - секунды, 'ms' - милисекунды
     */
    public static function timer($value, $fNumber = 2) {
        $result = '';
        $timing = 's';
        if ($value < 1) {
            $value *= 1000;
            $timing = 'ms';
        } else if ($value >= 60 ) {
            $min = (int) $value / 60;
            $result .= $min . ' min ';
            $value -= $min * 60;
        }

        $result .= sprintf('%01.' . $fNumber . 'f', $value);
        return $result . ' ' . $timing;
    }

    /**
     * Формутирует вывод времени
     * @param int $time
     * @return string
     */
    public static function fullTime($time = null) {
        return ($time) ? date("Y.m.d H:i:s", $time): date("Y.m.d H:i:s");
    }

   /**
     * Формутирует вывод времени
     * @param int $time
     * @return string
     */
    public static function time($time = null) {
        return ($time) ? date("H:i:s", $time): date("H:i:s");
    }
    /**
     * Формутирует вывод даты
     * @param int $time
     * @return string
     */
    public static function date($time = null) {
        return ($time) ? date("Y.m.d", $time): date("Y.m.d");
    }

    /**
     * форматирует вывод лог файла для HTML
     * @param string $title
     * @param string $text
     * @param boolean $block
     * @param string $color
     * @return string
     */
    public static function htmlMessageLog($title, $descr, $block, $color) {

        if ($block) {
            $text = '<fieldset style="border: 1px solid ' . $color . ';"><legend style="color: ' . $color . '; font-weight: bold;"> '
            . $title. '  </legend><pre style="color: #333;">'.  $descr
            . '</pre></fieldset>';
        } else {
            $text = '<span style="color: ' . $color . ';">['. $title . ']</span> ' . '<span style="color: #333;">'.  $descr . '</span><br />';
        }
        return $text;

    }


     /**
     * форматирует вывод лог файла для HTML
     * @param string $title
     * @param string $text
     * @return string
     */
    public static function txtMessageLog($title, $descr) {
        return    $text = '[' . self::time() . '] ' . $title . ': ' . $text;
    }

    /**
     * Обрезает текст до определенной длины
     * @param string $str строка
     * @param int $len сколько текст оставить, не считая строки замены
     * @param string $symb строка, заменяющая остальной текст
     */
    public static function cutCenter($str, $len, $symb = '...') {
        $halfLen = round($len / 2);
        if (is_string($str) && StringUtf8::strlen($str) > $len) {
            $str = StringUtf8::substr($str, 0 , $halfLen) . $symb . StringUtf8::substr($str, -$halfLen);
        }
        return $str;
    }

    /**
     * Обрезает текст слева до определенной длины
     * @param string $str строка
     * @param int $len сколько текст оставить, не считая строки замены
     * @param string $symb строка, заменяющая остальной текст
     */
    public static function cutLeft($str, $len, $symb = '...') {
        if (is_string($str) && StringUtf8::strlen($str) > $len) {
            $str =  $symb . StringUtf8::substr($str, -$len);
        }
        return $str;
    }
    
    /**
     * Обрезает текст справа до определенной длины
     * @param string $str строка
     * @param int $len сколько текст оставить, не считая строки замены
     * @param string $symb строка, заменяющая остальной текст
     */
    public static function cutRight($str, $len, $symb = '...') {
        if (is_string($str) && StringUtf8::strlen($str) > $len) {
            $str = StringUtf8::substr($str, 0 , $len) . $symb;
        }
        return $str;
    }

    public static function highlight($code)  {
       ini_set('highlight.string', '#DD0000');
       ini_set('highlight.comment', '#BCBCBC');
       ini_set('highlight.keyword', '#00AF49');
       ini_set('highlight.bg', '#FFFFFF');
       ini_set('highlight.default', '#006F49');
       ini_set('highlight.html', '#000000');

      $code = stripslashes($code);
      if(!strpos($code,"<?") && StringUtf8::substr($code,0,2)!="<?") {

        $code="<?php\n".trim($code)."\n?>";

      }
      $code = highlight_string(trim($code),true);
      return $code;
    }

}

