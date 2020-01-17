<!DOCTYPE html>
<html>
    <head>
        <meta charset="wtf-8">
        <title>Result</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="result">
<?php

    $gross_salary=$_POST['salary'];
    $personal_allowance=12509;
    $basic_rate=50000;
    $higher_rate=150000;
    $initial_salary=0;
    $net_salary=0;
    $tax_paid=0;
    $first_bracket=0;
    $second_bracket=0;
    $third_bracket=0;
    $first_ni_bracket=0;
    $second_ni_bracket=0;
    $national_insurance=0;
    $weekly_salary=$gross_salary/52;

    if($gross_salary>8632){
        if($gross_salary<=50024){
        $first_ni_bracket=$gross_salary-8632;
        }
        if($gross_salary>50024){
            $first_ni_bracket=50024-8632;
        }
    }
    if($gross_salary>50024){
        $second_ni_bracket=$gross_salary-50024;
    }


    if($gross_salary>$personal_allowance ){
        if($gross_salary<=$basic_rate){
            $first_bracket=$gross_salary-$personal_allowance;
        }
        if($gross_salary>$basic_rate){
            $first_bracket=$basic_rate-$personal_allowance;
        } 
    }
    if($gross_salary>$basic_rate){
        if($gross_salary<=$higher_rate){
            $second_bracket=$gross_salary-$basic_rate;
        }
        if($gross_salary>$higher_rate){
            $second_bracket=$higher_rate-$basic_rate;
        }
    }
    if($gross_salary>$higher_rate){
        $third_bracket=$gross_salary-$higher_rate;
    }

    function percentageOf( $number, $percentage, $decimals = 2 ){
        return round( $number * $percentage / 100, $decimals );
    }

    $first_ni=percentageOf($first_ni_bracket,12);
    $second_ni=percentageOf($second_ni_bracket,2);

    $national_insurance=$first_ni+$second_ni;

    $first_tax=percentageOf($first_bracket,20);
    $second_tax=percentageOf($second_bracket,40);
    $third_tax=percentageOf($third_bracket,45);

    $tax_paid=$first_tax+$second_tax+$third_tax;

    $final_ni=$national_insurance;

    $net_salary=$gross_salary-$tax_paid-$final_ni;
    echo("<h2><u>Net salary:</u></h2>"."<h1>Annually:  </h1>£ ".round($net_salary,2)."<h1>  Per month:  </h1>£ ".round($net_salary/12,2)."<h1>  Per week:  </h1>£ ".round($net_salary/52,2)."\n");
    echo("\r\n");
    echo("<h2><u>Tax paid:</u></h2>"."<h1>Annually:  </h1>£ ".round($tax_paid,2)."<h1>  Per month:  </h1>£ ".round($tax_paid/12,2)."<h1>  Per week:  </h1>£ ".round($tax_paid/52,2)."\n");
    echo("\r\n");
    echo("<h2><u>National insurance:</u></h2>"."<h1>Annually:  </h1>£ ".round($final_ni,2)."<h1>  Per month:  </h1>£ ".round($final_ni/12,2)."<h1>  Per week:  </h1>£ ".round($final_ni/52,2)."\n");
    echo("\r\n");
?>

</div>
</body>
</html>