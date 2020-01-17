<!DOCTYPE html>
<html>
    <head>
        <meta charset="wtf-8">
        <title>Result</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="result">
    <div class="wraper">
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
    echo("<div><p><strong>Net salary</strong><br>"." Annually:  £ ".round($net_salary,2)."  <br>Per month:  £ ".round($net_salary/12,2)."  <br>Per week:  £ ".round($net_salary/52,2)."\n")."</p></div>";

    echo("<div><p><strong>Tax paid</strong><br>"." Annually:  £ ".round($tax_paid,2)."  <br>Per month:  £ ".round($tax_paid/12,2)."  <br>Per week:  £ ".round($tax_paid/52,2)."\n")."</p></div>";

    echo("<div><p><strong>National insurance</strong><br>"." Annually:  £ ".round($final_ni,2)."  <br>Per month: £ ".round($final_ni/12,2)." <br>Per week:  £ ".round($final_ni/52,2)."\n")."</p></div>";

?>

</div>
<a href="index.html">Back</a>
</div>
</body>
</html>