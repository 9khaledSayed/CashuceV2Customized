<html dir="rtl">
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Vin | Dashboard</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Fonts -->
    {{--    <link href="{{asset('assets/css/style.bundle' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />--}}

</head>
<style>
    @media print {
        @page {
            size: 30mm 21mm;
            margin: 0;
            padding: 0;
        }
        html, body {
            position: relative;
            width: 100%;
            height: 100%;
            max-width: 100%;
            max-height: 100%;
            margin: 0;
            padding: 0;
        }
        svg {
            width: 100%;
            height: 100%;
            max-width: 100%;
            max-height: 100%;
        }
    }
</style>
<body style="width: 100%; height: fit-content">

<div id='DivIdToPrint'>
    <p>This is a sample text for printing purpose.</p>
</div>
<p>Do not print.</p>
<input type='button' id='btn' value='Print' onclick='printDiv();'>
{{--<svg id="code128"--}}
{{--     jsbarcode-value="123456789012"></svg>--}}
{{--<script src="https://cdn.jsdelivr.net/jsbarcode/3.3.16/barcodes/JsBarcode.code128.min.js"></script>--}}

<script>
    {{--(function() {--}}
    {{--    JsBarcode("#code128", "{{$barcode}}", {--}}
    {{--        format: "CODE128",--}}
    {{--        displayValue: true--}}
    {{--    });--}}
    {{--    window.print();--}}
    {{--})();--}}

    function printDiv()
    {

        var divToPrint=document.getElementById('DivIdToPrint');

        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);

    }
</script>
</body>
</html>


