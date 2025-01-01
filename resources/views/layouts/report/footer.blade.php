<!DOCTYPE html>
<html>
<head>
    <script>
        $nepali_numbers = ["०", "१", "२", "३", "४", "५", "६", "७", "८", "९", ".", ","];
        var locale = '{!! app()->getLocale() !!}';

        function convertToUnicodeNumber($number) {
            return $number;
            if (locale == 'np') {
                $number = Number($number).toFixed(2);
                $numberstring = $number.toString();
                var $fractionpart = $numberstring.substring($numberstring.lastIndexOf('.') + 1);
                if ($fractionpart.length != $numberstring.length) {
                    var $unformattedintpart = $numberstring.substring(0, $numberstring.lastIndexOf('.'));
                } else {
                    $unformattedintpart = $numberstring;
                }
                $fractionpartnepali = '';
                if ($fractionpart.length == 1) {
                    $fractionpartnepali = '.' + $nepali_numbers[$fractionpart.substr(0, 1)];
                } else if ($fractionpart.length == 2) {
                    $fractionpartnepali = '.' + $nepali_numbers[$fractionpart.substr(0, 1)] + $nepali_numbers[$fractionpart.substr(1, 1)]
                } else {
                    $fractionpartnepali = '';
                }

                $len = $unformattedintpart.length;
                var $count = 1;
                var $nepalinumberstring = '';
                for ($index = $len - 1; $index >= 0; $index--) {
                    $nepalinumberstring = $nepali_numbers[$unformattedintpart.substr($index, 1)] + $nepalinumberstring;
                    if ($count % 3 == 0 && $index != 0) {
                        $nepalinumberstring = ',' + $nepalinumberstring;
                    }
                    $count++;
                }
                return $nepalinumberstring;
            } else {
                return $number;
            }
        }

        function subst() {
            var vars = {};
            var query_strings_from_url = document.location.search.substring(1).split('&');
            for (var query_string in query_strings_from_url) {
                if (query_strings_from_url.hasOwnProperty(query_string)) {
                    var temp_var = query_strings_from_url[query_string].split('=', 2);
                    vars[temp_var[0]] = decodeURI(temp_var[1]);
                }
            }
            var css_selector_classes = ['page', 'frompage', 'topage', 'webpage', 'section', 'subsection', 'date', 'isodate', 'time', 'title', 'doctitle', 'sitepage', 'sitepages'];
            for (var css_class in css_selector_classes) {
                if (css_selector_classes.hasOwnProperty(css_class)) {
                    var element = document.getElementsByClassName(css_selector_classes[css_class]);
                    for (var j = 0; j < element.length; ++j) {
                        element[j].textContent = convertToUnicodeNumber(vars[css_selector_classes[css_class]]);
                    }
                }
            }
        }
    </script>
</head>
<body style="border:0; margin: 0; font-size: 12px;" onload="subst()">
<table style="border-top: 1px solid #000000; width: 100%">
    <tr>
        <td style="text-align:right">
            {!! __('labels.page-no') !!}
        </td>
    </tr>
</table>
</body>
</html>
