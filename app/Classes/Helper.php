<?php

namespace App\Classes;

class Helper
{
    public function getPreviousFiscalYear()
    {
        return auth()->user() ? auth()->user()->previous_year : '';
    }

    public function getCurrentFiscalYear()
    {
        return '2081/82';
//        return auth()->user() ? auth()->user()->current_year : '';
    }

    public function getNextFiscalYear()
    {
        return '2081/82';

//        return auth()->user() ? auth()->user()->next_year : '';
    }

    public function userObject()
    {
        return auth()->user();
    }

    public function fiscalProvinceObject()
    {
        $data['budget_year'] = userObject()->bud_year;
        $data['office_code'] = userObject()->office_code;

        return (object) $data;
    }

    public function getNextYearBudgetOpenFlag()
    {
        return session()->get('budget_settings.is_next_year_demand_opened');
    }

    public function getCurrentYearDemandCloseFlag()
    {
        return session()->get('budget_settings.is_current_year_demand_closed');
    }

    public function getCurrentYearBudgetCloseFlag()
    {
        return session()->get('budget_settings.is_current_year_budget_closed');
    }

    public function getActiveBudgetFiscalYear()
    {
        if ($this->getNextYearBudgetOpenFlag()) {
            return auth()->user()->next_year;
        }

        return auth()->user()->current_year;
    }

    public function getRelativePreviousFiscalYearOfFiscalYear($fiscalYear)
    {
        $firstPart = substr($fiscalYear, 0, 4);
        $lastPart = substr($fiscalYear, -2);

        return ($firstPart - 1).'/'.($lastPart - 1);
    }

    public function canAddBudgetDemand()
    {
        return ! getCurrentYearBudgetCloseFlag() || (getCurrentYearDemandCloseFlag() && getNextYearBudgetOpenFlag());
    }

    public function canAddStageBudget()
    {
        return ! getCurrentYearBudgetCloseFlag() || (getCurrentYearDemandCloseFlag() && getNextYearBudgetOpenFlag());
    }

    public function changeNumberUnicode($value = null, $mode = 0)
    {
        $length = strlen($value);
        $arrayNumber = [
            '-' => '&#45;',
            '(' => '&#40;',
            ')' => '&#41;',
            '0' => '&#2406;',
            '1' => '&#2407;',
            '2' => '&#2408;',
            '3' => '&#2409;',
            '4' => '&#2410;',
            '5' => '&#2411;',
            '6' => '&#2412;',
            '7' => '&#2413;',
            '8' => '&#2414;',
            '9' => '&#2415;',
            '/' => '&#47;',
            '\\' => '&#92;',
        ];
        if ($mode == 1) {
            $length = mb_strlen($value, 'utf-8');
            foreach ($arrayNumber as $key => $val) {
                $newArrayNumber[asciiToUtf8($val)] = $key;
            }
        }

        $newStr = null;
        for ($i = 0; $i < $length; $i++) {
            if ($mode == '1') {
                if (isset($newArrayNumber[mb_substr($value, $i, 1, 'utf-8')])) {
                    $newStr .= $newArrayNumber[mb_substr($value, $i, 1, 'utf-8')];
                } else {
                    $newStr .= mb_substr($value, $i, 1, 'utf-8');
                }
            } else {
                if ($arrayNumber[substr($value, $i, 1)]) {
                    $newStr .= $arrayNumber[substr($value, $i, 1)];
                } else {
                    $newStr .= substr($value, $i, 1);
                }
            }
        }

        return $newStr;
    }

    public function removeCommaFromInputs($inputs)
    {
        $output = [];
        foreach ($inputs as $key => $value) {
            if (! is_array($value)) {
                $value = str_replace(',', '', $value);
            }
            $output[$key] = $value;
        }

        return $output;
    }

    public function number_formatting($amount)
    {
        if ($amount) {
            $amount = round($amount);
            $returnAmount = (string) $amount;
            if ($amount < 0) {
                $returnAmount = str_replace('-', '', $returnAmount);
            }
            $returnAmount = strrev($returnAmount);
            $arr = str_split($returnAmount, '2');
            $returnAmount = implode(',', $arr);
            $returnAmount = strrev($returnAmount);
            if ($amount < 0) {
                $returnAmount = '-'.$returnAmount;
            }
        } else {
            $returnAmount = 0;
        }

        return $returnAmount;
    }

    public function float_number_formatting($amount)
    {
        if ($amount) {
            $amount = round($amount, 3);
            $explode_amount = explode('.', $amount);

            $amount = round($explode_amount[0]);
            $returnAmount = (string) $amount;
            if ($amount < 0) {
                $returnAmount = str_replace('-', '', $returnAmount);
                if (isset($explode_amount[1])) {
                    $returnAmount = $returnAmount.'.'.$explode_amount[1];
                }
            }
            $returnAmount = strrev($returnAmount);
            $arr = str_split($returnAmount, '2');
            $returnAmount = implode(',', $arr);
            $returnAmount = strrev($returnAmount);
            if (isset($explode_amount[1])) {
                $returnAmount = $returnAmount.'.'.$explode_amount[1];
            }
        } else {
            $returnAmount = 0;
        }

        return $returnAmount;
    }

    public function convertToEnglishNumber($input)
    {
        if (is_null($input)) {
            return $input;
        }

        $standard_numsets = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $devanagari_numsets = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

        return str_replace($devanagari_numsets, $standard_numsets, $input);
    }

    public function convertToUnicodeNumber($input)
    {
        if (is_null($input)) {
            return $input;
        }
        $standard_numsets = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $devanagari_numsets = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        if (app()->getLocale() == 'np') {
            return str_replace($standard_numsets, $devanagari_numsets, $input);
        }

        return $input;
    }

    public function unicodeNumber($input)
    {
        if (is_null($input)) {
            return $input;
        }
        $standard_numsets = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $devanagari_numsets = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

        return str_replace($standard_numsets, $devanagari_numsets, $input);
    }

    public function convertToNepaliMoneyFormat($number)
    {
        $number = number_format($number, 2, '.', '');

        return preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", '$1,', $number);
    }

    public static function label($key)
    {
        return __('label.'.trim($key));
    }

    public function forceDownload($htmlString, $fileName)
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');

        return $htmlString;

        /**
         * $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
         * $spreadsheet = $reader->loadFromString($htmlString);
         * $spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setAutoSize(true);
         * $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);
         * $reader->setSheetIndex(1);
         *
         * $fileName = $fileName.'.xlsx';
         * header('Content-Type: application/vnd.ms-excel');
         * header('Content-Disposition: attachment; filename="'. $fileName .'"');
         * header('Cache-Control: max-age=0');
         * header('Cache-Control: max-age=1');
         * header('Cache-Control: cache, must-revalidate');
         * header('Pragma: public');
         * $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
         * $writer->save('php://output');
         * exit(); **/
    }

    public static function slugify($text, string $divider = '_')
    {
        $exp = '~[^\pL\d]+~u';
        $text = preg_replace($exp, $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $exp = '~[^-\w]+~';
        $text = preg_replace($exp, '', $text);
        $text = trim($text, $divider);
        $exp = '~-+~';
        $text = preg_replace($exp, $divider, $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
