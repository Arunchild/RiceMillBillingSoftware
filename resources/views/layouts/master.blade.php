<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>INVOICE</title>
<!-- Style sheet and Js Files -->
{!! Html::style('css/bootstrap.min.css') !!}
{!! Html::style('css/style.css') !!}
{!! Html::style('css/style_print.css', array('media' => 'print')) !!}
{!! Html::style('css/jquery-ui.css') !!}

{!! Html::script('js/jquery-1.10.2.min.js') !!}
{!! Html::script('js/jquery-ui.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}

</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Billing</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings<span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="{{ route('company.index') }}">Company Name and Address</a></li>
                  <li><a href="{{ route('Settings.index') }}">Other Settings</a></li>
              </ul>
          </li>
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">மாஸ்டர்<span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="{{ route('ProductMaster.index') }}">அனைத்து பொருள் பார்</a></li>
                  <li><a href="{{ route('ProductMasterKurunai.index') }}">அனைத்து பொருள் பார் குருணை </a></li>
                  <li><a href="{{ route('ProductMasterOthers.index') }}">அனைத்து பொருள் பார் - Others</a></li>
                  <li><a href="{{ route('ProductMaster.create') }}">சேர்</a></li>
                  <li><a href="{{ route('ProductMasterKurunai.create') }}">சேர் குருணை </a></li>
                  <li><a href="{{ route('ProductMasterOthers.create') }}">சேர் - Others</a></li>
              </ul>
          </li>

          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">வாங்குதல்<span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="#"><a href="{{ route('PurchaseFinal.index') }}">வாங்கிய அனைத்தும் பார்</a></li>
                  <li><a href="#"><a href="{{ route('PurchaseFinalKurunai.index') }}">வாங்கிய அனைத்தும் பார் குருணை </a></li>
                  <li><a href="#"><a href="{{ route('PurchaseFinalOthers.index') }}">வாங்கிய அனைத்தும் பார் - Others</a></li>
                  <li><a href="{{ route('Purchase.create') }}">வாங்கு</a></li>
                  <li><a href="{{ route('PurchaseKurunai.create') }}">வாங்கு குருணை </a></li>
                  <li><a href="{{ route('PurchaseOthers.create') }}">வாங்கு- Others</a></li>
              </ul>
          </li>

          <li class="dropdown">
              <a href="{{ route('Billing.create') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">பில்<span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="{{ route('BillingFinal.index') }}">அனைத்து பில் பார்</a></li>
                  <li><a href="{{ route('BillingFinalKurunai.index') }}">அனைத்து பில் பார் குருணை </a></li>
                  <li><a href="{{ route('BillingFinalOthers.index') }}">அனைத்து பில் பார் - Others</a></li>
                  <!--<li><a href="#"><a href="{{ route('Billing.index') }}">View All</a></li>-->
                  <li><a href="{{ route('Billing.create') }}">பில் சேர்</a></li>
                  <li><a href="{{ route('BillingKurunai.create') }}">பில் சேர் குருணை </a></li>
                  <li><a href="{{ route('BillingOthers.create') }}">பில் சேர் - Others</a></li>
              </ul>
          </li>

          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports<span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="{{ route('Reports.index') }}">Summary</a></li>
                  <li><a href="{{ route('ReportsKurunai.index') }}">Summary குருணை</a></li>
                  <li><a href="{{ route('ReportsOthers.index') }}">Summary - Others</a></li>
              </ul>
          </li>

          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stock<span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="{{ route('Stock.index') }}">Single Item</a></li>
                  <li><a href="{{ route('StockOthers.index') }}">Single Item - Others</a></li>
                  <li><a href="{{ route('Stock.create') }}">Brand - Wise</a></li>
                  <li><a href="{{ route('StockKurunai.create') }}">Brand - Wise - குருணை </a></li>
                  <li><a href="{{ route('StockOthers.create') }}">Brand - Wise - Others</a></li>
              </ul>
          </li>

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li>@if(Session::has('flash_message'))
              <span class="alert alert-success">
                      {{ Session::get('flash_message') }}
                  </span>
          @endif
        </li>
        <!--<li><button type="button" style="margin-top: 10px;" class="btn btn-danger" onClick="window.print()">Print</button></li>-->
        <li></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        
<main>
    <div class="container-fluid">
        @yield('content')
    </div>
</main>

</body>


{!! Html::script('js/app.js') !!}
{!! Html::script('js/billing.js') !!}
{!! Html::script('js/reports.js') !!}
{!! Html::script('js/shortcut.js') !!}

	<script>


       $(document).on("keypress", ".TabOnEnter" , function(event)
	  {
		//Only do something when the user presses enter
		if( event.keyCode ==  13 )
		{
		   var nextIndex = this.tabIndex + 1;
		   var nextElement = $('[tabindex="' + nextIndex  + '"]');
		   console.log( this , nextElement );

		   while(!nextElement.length){
			   nextIndex++;
			   if(nextIndex>500){
				   break;
			   }else{
				   nextElement = $('[tabindex="' + nextIndex + '"]');
			   }
		  }
		  nextElement.focus();
		}
	  });

</script>

</html>