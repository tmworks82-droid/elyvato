<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
   

  </head>
  <body>
    
      <div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
        <table style="width: 100%;">
            <tr>
                <td bgcolor="#FFF">
                    <div style="padding: 5px; max-width: 800px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid #000000;">
                        <table style="width: 100%; background: #fff; margin-bottom:30px">
                            <tr>
                                <td style="text-align:left; padding:0px;">
                                    <img style="float:left;" width="80" height="80" src="https://hmdindia.in/assets/logo192.png" alt="HMD INDIA"/> 
                                </td>
                                <td></td>
                                <td style="text-align:right; padding:10px; color: #000;">
                                    Tax Invoice #<b>{{ $param['order_id'] }}</b>
                                </td>
                            </tr>
                        </table>
                        
                        <table style="width: 100%;background: #fff;border-bottom: 1px solid #000000; border-top: 1px solid #000000;">
                            
                            <tr>
                                <td style="text-align:left;padding:10px;color: #000;">
                                    Order No - <b>{{ $param['order_id'] }}</b>
                                </td>
                                <td style="text-align:right;padding:10px;color: #000000;">
                                    Date - <b>{{ $param['date'] }}</b>
                                </td>
                            </tr>
                            <tr style="width: 100%;background: #fff;border-top: 1px solid #000000;">
                                <td style="text-align:left;padding:10px;color: #000;">
                                    To - <strong>{{ $param['name'] }}</strong><br>
                                    {{ $param['address']['flat_house_no'] }}<br>
                                    {{ $param['address']['address1'] }}<br>
                                    {{ $param['address']['street'] }}<br>
                                    {{ $param['address']['city'] }} {{ $param['address']['state'] }} {{ $param['address']['country'] }}<br>
                                    {{ $param['address']['zip'] }}<br>
                                </td>
                                <td style="text-align:right;padding:10px;color: #000000;">
                                    From - <strong>HMD INDIA</strong><br>
                                            FF-455, Karim Chak Khanuwa<br>
                                            Chapra, Saran Bihar<br>
                                            841301<br>
                                </td>
                            </tr>
                            <tr style="width: 100%;background: #fff;border-top: 4px solid #000000;">
                                <td style="text-align:left;padding:10px;color: #000;">
                                    Payment Mode - <b>{{ $param['pay_mode'] == 'cod' ? 'Cash on delivery' : 'Online' }}</b>
                                </td>
                                <td style="text-align:right;padding:10px;color: #000000;">
                                    
                                </td>
                            </tr>
                        </table>
                        <table style="padding: 10px;font-size:14px; width:100%; background-color: #FFF;">
                            
                        </table>
                        <table style="width: 100%;background: #fff;border-bottom: 1px solid #000000;">
                                <tr>
                                    <th style="text-align:left;padding:10px;color: #000;">
                                        Item Name
                                    </th>
                                    <th style="text-align:right;padding:10px;color: #000000;">
                                        Size
                                    </th>
                                    <th style="text-align:right;padding:10px;color: #000000;">
                                        Qnty
                                    </th>
                                    <th style="text-align:right;padding:10px;color: #000000;">
                                        Amount
                                    </th>
                                    <th style="text-align:right;padding:10px;color: #000000;">
                                        Total
                                    </th>
                                </tr>
                            @foreach($param['orderDetails'] as $key => $val)

                                <tr>
                                    <td style="text-align:center;padding:10px;color: #000;">
                                        {{ $val['name'] }}
                                    </td>
                                    <td><b>{{ $val['sku_name'] }}</b></td>
                                    <td style="text-align:center;padding:10px;color: #000000;">
                                        {{ $val['count'] }}
                                    </td>
                                    <td style="text-align:center;padding:10px;color: #000000;">
                                        {{ $val['amount'] }}
                                    </td>
                                    <td style="text-align:center;padding:10px;color: #000000;">
                                        {{ $val['total_amount'] }}
                                    </td>
                                </tr>

                            @endforeach   
                        </table>
                        <table style="width: 100%;background: #fff;border-bottom: 1px solid #000000;">
                            <tr style="border-bottom: 1px solid #000000;">
                                <td style="text-align:left;padding:10px;color: #000;">
                                    Sub Total
                                </td>
                                <td style="text-align:right;padding:10px;color: #000000;">
                                    <b>{{ $param['sub_total'] }}</b>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #000000;">
                                <td style="text-align:left;padding:10px;color: #000;">
                                    Discount
                                </td>
                                <td style="text-align:right;padding:10px;color: #000000;">
                                    <b>{{ $param['discount'] }}</b>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #000000;">
                                <td style="text-align:left;padding:10px;color: #000;">
                                    Tax
                                </td>
                                <td style="text-align:right;padding:10px;color: #000000;">
                                    <b>{{ $param['tax'] }}</b>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #000000;">
                                <td style="text-align:left;padding:10px;color: #000;">
                                    Total Amount
                                </td>
                                <td style="text-align:right;padding:10px;color: #000000;">
                                    <b>{{ $param['total_amount'] }}</b>
                                </td>
                            </tr>
                        </table>
                        <!-- @if($param['is_annas_used'])
                            <table style="width: 100%;background: #fff;border-bottom: 1px solid #000000;">
                                <tr>
                                    <td style="text-align:left;padding:10px;color: #000;">
                                        Annas Used
                                    </td>
                                    <td style="text-align:right;padding:10px;color: #000000;">
                                        <b>{{ $param['annas_amount'] }}</b>
                                    </td>
                                </tr>                                                      
                            </table>
                        @endif

                        @if($param['is_coupon'])
                            <table style="width: 100%;background: #fff;border-bottom: 1px solid #000000;">
                                <tr>
                                    <td style="text-align:left;padding:10px;color: #000;">
                                        Coupon Code
                                    </td>
                                    <td style="text-align:right;padding:10px;color: #000000;">
                                        <b>{{ $param['coupon']['coupon_code'] }}</b>
                                    </td>
                                </tr>                                                      
                            </table>
                        @endif -->

                        <table style="width: 100%;background: #fff;">
                            <tr>
                                <td style="text-align:left;padding:10px;color: #000;">
                                    Total Paid Amount
                                </td>
                                <td style="text-align:right;padding:10px;color: #000000;">
                                    <b>{{ $param['paid_amount'] }}</b>
                                </td>
                            </tr>    
                        </table>                                                        
                        <table style="width: 100%;background: #fff;">
                            <tr>
                                <td style="text-align:left;padding:10px;color: #000;">
                                    Amount In Words
                                </td>
                                <td style="text-align:right;padding:10px;color: #000000;">
                                    <b>{{ $param['amount_in_word'] }}</b>
                                </td>
                            </tr>    
                        </table>                                                        
                        <table style="width: 100%;background: #fff;">
                            <tr>
                                <td style="text-align:center;padding:10px;color: #000; font-size:10px;">
                                    <b>Note</b> - This is auto generated, no signature required. Also this invoice is not a demand for payment.
                                </td>
                            </tr>                                                            
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>





  </body>
</html>