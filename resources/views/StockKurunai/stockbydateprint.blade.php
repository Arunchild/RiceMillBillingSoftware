<?php 
$purchase_qty_grand_total = 0; 
$sales_qty_grand_total = 0; 
$opening_grandtotal = 0;
$purchase_qty_grand_total_op = 0;
$sales_qty_grand_total_op = 0;
$item_count = 0;
$linecount = 0;
$purchase_kgs_grand_total = 0;
$sales_kgs_grand_total = 0;
$balance_qty = 0;
$opening_kgs_grand_total = 0;


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

$companyname = $company->companyname;

printer_write($handle, $bighon.$bigwidth.str_pad($company->companyname, 40, " ", STR_PAD_BOTH));
printer_write($handle, "\n");
printer_write($handle, "\n");
printer_write($handle, "\n");
printer_write($handle, $bigoff.$bighoff.str_pad("Stock    From: ".date("d-m-Y", strtotime($from_date))."   To:".date("d-m-Y", strtotime($to_date)), 80, " ", STR_PAD_BOTH));
printer_write($handle, "\n");


printer_write($handle, $bigoff.$bighoff.str_pad("-", 80, "-", STR_PAD_LEFT));
printer_write($handle, "\n");
printer_write($handle, str_pad("", 30, " ", STR_PAD_RIGHT));
printer_write($handle, " ");
printer_write($handle, str_pad("", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Pur", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Pur", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Sal", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Sal", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Bal", 6, " ", STR_PAD_LEFT));
printer_write($handle, str_pad("Bal", 6, " ", STR_PAD_LEFT));
printer_write($handle, "\n");

printer_write($handle, str_pad("Item Name", 30, " ", STR_PAD_RIGHT));
printer_write($handle, " ");
printer_write($handle, str_pad("KG", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Openi", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Qty", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Kgs", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Qty", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Kgs", 5, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Qty", 6, " ", STR_PAD_LEFT));
printer_write($handle, " ");
printer_write($handle, str_pad("Kgs", 6, " ", STR_PAD_LEFT));
printer_write($handle, "\n");
printer_write($handle, str_pad("-", 80, "-", STR_PAD_LEFT));
printer_write($handle, "\n");

$item_count = $item_count + 7;
$linecount = $linecount + 7;

?>
        <?php

        foreach ($products as $product) {
            $product_code = $product->id;
            $matchThese = ['product_code' => $product_code];


            //calculate previous days closing ie., todays opening

            $purchaseditems_op = DB::table('purchases')
                    ->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
                    ->where($matchThese)
                    ->where('sale_date', '<', $from_date)
                    ->orderby('id')
                    ->get();

            $saleitems_op = DB::table('billings')
                    ->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
                    ->where($matchThese)
                    ->where('sale_date', '<', $from_date)
                    ->orderby('id')
                    ->get();

            foreach ($purchaseditems_op as $purchased) {
                $purchase_qty_op = $purchased->quantity;
                $purchase_qty_grand_total_op = $purchase_qty_grand_total_op + $purchased->quantity;
            }
            foreach ($saleitems_op as $sale) {
                $sale_qty_op = $sale->quantity;
                $sales_qty_grand_total_op = $sales_qty_grand_total_op + $sale->quantity;
            }


            $opening = $purchase_qty_op - $sale_qty_op;
            $opening_grandtotal = $opening_grandtotal + $opening;


            $purchaseditems = DB::table('purchases')
                    ->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
                    ->where($matchThese)
                    ->whereBetween('sale_date',array($from_date,$to_date))
                    ->orderby('id')
                    ->get();

            $saleitems = DB::table('billings')
                    ->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
                    ->where($matchThese)
                    ->whereBetween('sale_date',array($from_date,$to_date))
                    ->orderby('id')
                    ->get();
					
					$kg = $product->kg;

					$opening_kgs_grand_total = $opening_kgs_grand_total + ($product->kg * $opening);

            printer_write($handle, $underline.str_pad($product->product_name, 30, " ", STR_PAD_RIGHT));
            printer_write($handle, " ");
            printer_write($handle, str_pad($product->kg, 5, " ", STR_PAD_LEFT));
            printer_write($handle, " ");
            printer_write($handle, str_pad($opening, 5, " ", STR_PAD_LEFT));
            printer_write($handle, " ");

            foreach ($purchaseditems as $purchased) {
                $purchase_qty = $purchased->quantity;
                $purchase_qty_grand_total = $purchase_qty_grand_total + $purchased->quantity;
				
				 $purchase_kgs_grand_total = $purchase_kgs_grand_total + ($product->kg * $purchased->quantity);

                printer_write($handle, str_pad($purchased->quantity, 5, " ", STR_PAD_LEFT));
                printer_write($handle, " ");
                printer_write($handle, str_pad(($product->kg * $purchased->quantity), 5, " ", STR_PAD_LEFT));
                printer_write($handle, " ");
            }

            foreach ($saleitems as $sale) {
                $sale_qty = $sale->quantity;
                $sales_qty_grand_total = $sales_qty_grand_total + $sale->quantity;
				
				$sales_kgs_grand_total = $sales_kgs_grand_total + ($product->kg * $sale->quantity);

                printer_write($handle, str_pad($sale->quantity, 5, " ", STR_PAD_LEFT));
                printer_write($handle, " ");
                printer_write($handle, str_pad($product->kg * $sale->quantity, 5, " ", STR_PAD_LEFT));
                printer_write($handle, " ");
            }

			$balance_qty = $opening + $purchase_qty - $sale_qty;
            printer_write($handle, str_pad(($opening + $purchase_qty - $sale_qty), 6, " ", STR_PAD_LEFT));
            printer_write($handle, " ");
            printer_write($handle, str_pad($kg * $balance_qty, 6, " ", STR_PAD_LEFT));
            printer_write($handle, "\n");
			
			$item_count = $item_count + 1;
			$linecount = $linecount + 1; 
			
			$linecount = NextPage($handle, $linecount, $company->companyname, $from_date, $to_date, $opening_grandtotal, $purchase_qty_grand_total, $purchase_kgs_grand_total, $sales_qty_grand_total, $sales_kgs_grand_total, $opening_kgs_grand_total);
			
            printer_write($handle, $underlineoff."\n");
            $item_count = $item_count + 1;
			$linecount = $linecount + 1; 
			
			$linecount = NextPage($handle, $linecount, $company->companyname, $from_date, $to_date, $opening_grandtotal, $purchase_qty_grand_total, $purchase_kgs_grand_total, $sales_qty_grand_total, $sales_kgs_grand_total, $opening_kgs_grand_total);
        }

        printer_write($handle, str_pad("-", 80, "-", STR_PAD_LEFT));
        printer_write($handle, "\n");

        printer_write($handle, str_pad("Total: ", 37, " ", STR_PAD_LEFT));
        printer_write($handle, str_pad($opening_grandtotal, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($purchase_qty_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($purchase_kgs_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($sales_qty_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($sales_kgs_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($opening_grandtotal + $purchase_qty_grand_total - $sales_qty_grand_total, 6, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($purchase_kgs_grand_total + $opening_kgs_grand_total - $sales_kgs_grand_total, 6, " ", STR_PAD_LEFT));
		
        printer_write($handle, "\n");
		 printer_write($handle, str_pad("-", 80, "-", STR_PAD_LEFT));
        printer_write($handle, "\n");
        printer_write($handle, "\n");
        printer_write($handle, "\n");
$item_count = $item_count + 3;

$item_count_remaining = 72 - $item_count;

for($i=0; $i<$item_count_remaining; $i++){
    printer_write($handle, "\n");
}
printer_close($handle);




function NextPage($handle, $linecount, $companyname, $from_date, $to_date, $opening_grandtotal, $purchase_qty_grand_total, $purchase_kgs_grand_total, $sales_qty_grand_total, $sales_kgs_grand_total, $opening_kgs_grand_total){

    if(is_int($linecount/65)){
		
		 //double width printing on and off
		$bigwidth = chr(27)."W".chr(1);
		$bigoff = chr(27)."W".chr(0);

		//double height printing on and off
		$bighon = chr(27)."w".chr(1);
		$bighoff = chr(27)."w".chr(0);
		
		//underline
    $underline      =   chr(27)."-".chr(1);
    $underlineoff   =   chr(27)."-".chr(0);
		
		printer_write($handle, "\n");
		printer_write($handle, $underlineoff.str_pad("CF: ", 37, " ", STR_PAD_LEFT));
        printer_write($handle, str_pad($opening_grandtotal, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($purchase_qty_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($purchase_kgs_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($sales_qty_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($sales_kgs_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($opening_grandtotal + $purchase_qty_grand_total - $sales_qty_grand_total, 6, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($purchase_kgs_grand_total + $opening_kgs_grand_total - $sales_kgs_grand_total, 6, " ", STR_PAD_LEFT));
		printer_write($handle, "\n");
		
		$linecount = $linecount + 1;
		$linecount_remaining = 72 - $linecount;

        for($j=0; $j<$linecount_remaining; $j++){
            printer_write($handle, "\n");
        }

        //RESETTING
        $linecount = 0;
		
		
        printer_write($handle, $bighon.$bigwidth.str_pad($companyname, 40, " ", STR_PAD_BOTH));
		printer_write($handle, "\n");
		printer_write($handle, "\n");
		printer_write($handle, "\n");
		printer_write($handle, $bigoff.$bighoff.str_pad("Stock    From: ".date("d-m-Y", strtotime($from_date))."   To:".date("d-m-Y", strtotime($to_date)), 80, " ", STR_PAD_BOTH));
		printer_write($handle, "\n");


		printer_write($handle, $bigoff.$bighoff.str_pad("-", 80, "-", STR_PAD_LEFT));
		printer_write($handle, "\n");
        printer_write($handle, str_pad("", 30, " ", STR_PAD_RIGHT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Pur", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Pur", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Sal", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Sal", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Bal", 6, " ", STR_PAD_LEFT));
        printer_write($handle, str_pad("Bal", 6, " ", STR_PAD_LEFT));
        printer_write($handle, "\n");

        printer_write($handle, str_pad("Item Name", 30, " ", STR_PAD_RIGHT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("KG", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Openi", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Qty", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Kgs", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Qty", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Kgs", 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Qty", 6, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad("Kgs", 6, " ", STR_PAD_LEFT));
		printer_write($handle, "\n");
		printer_write($handle, str_pad("-", 80, "-", STR_PAD_LEFT));
		printer_write($handle, "\n");

        printer_write($handle, str_pad("PF: ", 37, " ", STR_PAD_LEFT));
        printer_write($handle, str_pad($opening_grandtotal, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($purchase_qty_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($purchase_kgs_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($sales_qty_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($sales_kgs_grand_total, 5, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($opening_grandtotal + $purchase_qty_grand_total - $sales_qty_grand_total, 6, " ", STR_PAD_LEFT));
        printer_write($handle, " ");
        printer_write($handle, str_pad($purchase_kgs_grand_total + $opening_kgs_grand_total - $sales_kgs_grand_total, 6, " ", STR_PAD_LEFT));
		printer_write($handle, "\n");
		
		$linecount = $linecount + 12;

		
        return $linecount;
    }else{
		return $linecount;
	}
}

?>