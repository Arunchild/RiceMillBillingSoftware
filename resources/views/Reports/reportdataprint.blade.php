<?php
//Printing here

$item_count = 0;
$linecount = 0;
$kgs_grand_total = 0;
$quantity_grand_total = 0;

//printer font, other settings

//bold text on and off
$boldon = chr(27)."E".chr(1);
$boldoff = chr(27)."F".chr(0);

//15pt size
$fifteen = chr(27)."g";

//12pt size
$twlve = chr(27)."M".chr(1);
//10pt size
$ten = chr(27)."P".chr(1);

//double width printing on and off
$bigwidth = chr(27)."W".chr(1);
$bigoff = chr(27)."W".chr(0);

//double height printing on and off
$bighon = chr(27)."w".chr(1);
$bighoff = chr(27)."w".chr(0);

//center
$center =   chr(27)."a".chr(1);
//double line
$doubleline =   chr(27)."("."-".chr(3).chr(0).chr(1).chr(1).chr(2);
$doublelineoff =   chr(27)."("."-".chr(3).chr(0).chr(1).chr(1).chr(0);
//underline
$underline      =   chr(27)."-".chr(1);
$underlineoff   =   chr(27)."-".chr(0);

$handle = printer_open($settings->printer_name);

printer_set_option($handle,PRINTER_PAPER_FORMAT,PRINTER_FORMAT_CUSTOM);
printer_set_option($handle,PRINTER_PAPER_LENGTH,153);
printer_set_option($handle,PRINTER_PAPER_WIDTH,254);


// Set print mode to RAW and send PDF to printer
printer_set_option($handle, PRINTER_MODE, "RAW");


printer_write($handle, $boldon.$bighon.$bigwidth.str_pad($company->companyname, 40, " ", STR_PAD_BOTH));
printer_write($handle, "\n");
printer_write($handle, "\n");
printer_write($handle, "\n");
printer_write($handle, $bigoff.$bighoff.str_pad("Summary    From: ".date("d-m-Y", strtotime($from_date))."   To:".date("d-m-Y", strtotime($to_date)), 80, " ", STR_PAD_BOTH));
printer_write($handle, "\n");


printer_write($handle,  $bigoff.$bighoff.str_pad("-", 75, "-", STR_PAD_RIGHT));
printer_write($handle, "\n");
printer_write($handle,  $bigoff.$bighoff.str_pad("Sale date", 15, " ", STR_PAD_RIGHT));
printer_write($handle, " ");
printer_write($handle, str_pad("Bill Number", 15, " ", STR_PAD_BOTH));
printer_write($handle, " ");
printer_write($handle, str_pad("Total Kg", 10, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Total Amt", 10, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Discount", 10, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Net Total", 10, " ", STR_PAD_LEFT));
printer_write($handle, "\n");
printer_write($handle, str_pad("-", 75, "-", STR_PAD_RIGHT));
printer_write($handle, "\n");

$item_count = $item_count + 7;

?>


@foreach($items as $item)
    @if($item->trashed())
        <?php
        printer_write($handle, str_pad($item->sale_date->format('d-m-Y'), 15, " ", STR_PAD_RIGHT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($item->bill_number, 15, " ", STR_PAD_BOTH));
        printer_write($handle, " ");
        printer_write($handle, str_pad("-", 15, "-", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad(" ----    (CANCELLED BILL)", 15, " ", STR_PAD_LEFT));
        printer_write($handle, "\n");
        $item_count = $item_count + 1;
        $linecount = $linecount + 1;
        ?>
    @else
        <?php
        printer_write($handle, str_pad($item->sale_date->format('d-m-Y'), 15, " ", STR_PAD_RIGHT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($item->bill_number, 15, " ", STR_PAD_BOTH));
        printer_write($handle, " ");
        printer_write($handle, str_pad($item->total_kg, 10, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($item->grand_total, 10, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($item->discount, 10, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad(number_format($item->grand_total - $item->discount, 2, '.', ''), 10, " ", STR_PAD_LEFT));
        printer_write($handle, "\n");
        $item_count = $item_count + 1;
        $linecount = $linecount + 1;

        if(is_int($linecount/45)){
            printer_write($handle, str_pad("-", 75, "-", STR_PAD_RIGHT));
            printer_write($handle, "\n");
            $linecount = $linecount + 1;

            $linecount_remainingstarting = 72 - $linecount;

            for($j=0; $j<$linecount_remainingstarting; $j++){
                printer_write($handle, "\n");
            }

            printer_write($handle, $boldon.$bighon.$bigwidth.str_pad($company->companyname, 40, " ", STR_PAD_BOTH));
            printer_write($handle, "\n");
            printer_write($handle, "\n");
            printer_write($handle, "\n");
            printer_write($handle, $bigoff.$bighoff.str_pad("Summary    From: ".date("d-m-Y", strtotime($from_date))."   To:".date("d-m-Y", strtotime($to_date)), 80, " ", STR_PAD_BOTH));
            printer_write($handle, "\n");


            printer_write($handle,  $bigoff.$bighoff.str_pad("-", 75, "-", STR_PAD_RIGHT));
            printer_write($handle, "\n");
            printer_write($handle,  $bigoff.$bighoff.str_pad("Sale date", 15, " ", STR_PAD_RIGHT));
            printer_write($handle, " ");
            printer_write($handle, str_pad("Bill Number", 15, " ", STR_PAD_BOTH));
            printer_write($handle, " ");
            printer_write($handle, str_pad("Total Kg", 10, " ", STR_PAD_LEFT));
            printer_write($handle, " ");
            printer_write($handle, str_pad("Total Amt", 10, " ", STR_PAD_LEFT));
            printer_write($handle, " ");
            printer_write($handle, str_pad("Discount", 10, " ", STR_PAD_LEFT));
            printer_write($handle, " ");
            printer_write($handle, str_pad("Net Total", 10, " ", STR_PAD_LEFT));
            printer_write($handle, "\n");
            printer_write($handle, str_pad("-", 75, "-", STR_PAD_RIGHT));
            printer_write($handle, "\n");

            $item_count = $item_count + 7;
        }

        ?>
    @endif

@endforeach

@foreach($totals as $total)
    <?php
    $grand_total = $total->grand_total;

    printer_write($handle, str_pad("-", 75, "-", STR_PAD_RIGHT));
    printer_write($handle, "\n");
    printer_write($handle, str_pad(" ", 15, " ", STR_PAD_RIGHT));
    printer_write($handle, " ");
    printer_write($handle, str_pad("Total : ", 15, " ", STR_PAD_BOTH));
    printer_write($handle, " ");
    printer_write($handle, str_pad($total->total_kg, 10, " ", STR_PAD_LEFT));
    printer_write($handle, " ");
    printer_write($handle, str_pad($total->grand_total, 10, " ", STR_PAD_LEFT));
    printer_write($handle, " ");
    printer_write($handle, str_pad($total->discount, 10, " ", STR_PAD_LEFT));
    printer_write($handle, " ");
    printer_write($handle, str_pad(number_format($total->grand_total - $total->discount, 2, '.', ''), 10, " ", STR_PAD_LEFT));
    printer_write($handle, "\n");
    printer_write($handle, str_pad("-", 75, "-", STR_PAD_RIGHT));
    printer_write($handle, "\n");

    $item_count = $item_count + 1;
    ?>
@endforeach

<?php
printer_write($handle, "\n\n\n\n");
$item_count = $item_count + 4;
?>
@foreach($products as $product)
    <?php
    $kgs_grand_total = $kgs_grand_total + $product->kg * $product->quantity;  $quantity_grand_total = $quantity_grand_total + $product->quantity;

    printer_write($handle, str_pad($product->product_name, 30, " ", STR_PAD_RIGHT)." ".str_pad($product->kg." kg", 6, " ", STR_PAD_LEFT)."    ".str_pad($product->selling_price, 10, " ", STR_PAD_LEFT)." x ". str_pad($product->quantity, 4, " ", STR_PAD_LEFT)." ".str_pad($product->kg * $product->quantity." kg", 7, " ", STR_PAD_LEFT)." = ".str_pad($product->total, 10, " ", STR_PAD_LEFT));
    printer_write($handle, "\n");
    ?>
    <?php $item_count = $item_count + 1; ?>
@endforeach

<?php
printer_write($handle, str_pad(" ", 54, " ", STR_PAD_LEFT).str_pad("-", 25, "-", STR_PAD_LEFT));
printer_write($handle, "\n");
printer_write($handle, str_pad(" Total:  ", 54, " ", STR_PAD_LEFT).str_pad($quantity_grand_total, 4, " ", STR_PAD_LEFT)." ".str_pad($kgs_grand_total." kg", 7, " ", STR_PAD_LEFT)."   ".str_pad($grand_total, 10, " ", STR_PAD_LEFT));
printer_write($handle, "\n");
printer_write($handle, str_pad(" ", 54, " ", STR_PAD_LEFT).str_pad("-", 25, "-", STR_PAD_LEFT));
printer_write($handle, "\n");
$item_count = $item_count + 2;

$item_count_remaining = 72 - $item_count;

for($i=0; $i<$item_count_remaining; $i++){
    printer_write($handle, "\n");
}

printer_close($handle);

?>