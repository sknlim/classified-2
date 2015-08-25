<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/transaction.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";

$objuser=new user;
$objuser->checkLoginAjax();
?>

<h1 align="center">Deposit Money</h1><br>
<h3>Select Mode</h3><br>
<input type="radio" value="paypal" name="depositmode" onClick="showDiv('div_depositpaypal'); hideDiv('div_depositcreditcard'); hideDiv('div_depositbankwire'); "> Deposit Through Paypal <br><br>

<input type="radio" value="creditcard" name="depositmode" onClick="showDiv('div_depositcreditcard'); hideDiv('div_depositpaypal'); hideDiv('div_depositbankwire'); "> Deposit Through Credit Card <br><br>

<input type="radio" value="bankwire" name="depositmode" onClick="showDiv('div_depositbankwire'); hideDiv('div_depositcreditcard'); hideDiv('div_depositpaypal'); "> Deposit Through Bankwire <br><br>
	
<div id="div_depositpaypal"  style="display:none;">
    <h1 align="center">Deposit Money through Paypal</h1>
    <br>
    <h3>Select Mode</h3>
   
    <input type="radio" value="paypal" name="depositpaypalmode" onClick="showDiv('div_depositpaypaldirect'); hideDiv('div_depositpaypalexpress');">Direct Payment 
    
    <input type="radio" value="creditcard" name="depositpaypalmode" onClick="showDiv('div_depositpaypalexpress'); hideDiv('div_depositpaypaldirect'); ">Express Payment

    <div id="div_depositpaypaldirect" style="display:none;">
    <h3>Paypal Direct Payment</h3>
    </div>

    <div id="div_depositpaypalexpress" style="display:none;">
     <h3>Paypal Express Payment</h3>
     <form action="ReviewOrder.php" method="POST">
<input type="hidden" name="paymentType" value="<?=$paymentType?>">
<span id=apiheader>SetExpressCheckout</span>
<table class="api">
  <tr>
    <td colspan="2"><center>
        </br>
        You must be logged into <a href="https://developer.paypal.com" id="PayPalDeveloperCentralLink"  target="_blank">Developer
        Central<br />
        </a> </br>
      </center></td>
  </tr>
  <tr>
    <td class="field"> Amount:</td>
    <td><input type="text" name="paymentAmount" size="5" maxlength="7" value="1.00" />
      <select name="currencyCodeType">
        <option value="USD">USD</option>
        <option value="GBP">GBP</option>
        <option value="EUR">EUR</option>
        <option value="JPY">JPY</option>
        <option value="CAD">CAD</option>
        <option value="AUD">AUD</option>
      </select>
      (Required)</td>
  </tr>
  <tr>
    <td></br>
      </br>
      <input type="image" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" />
    </td>
    <td> Save time. Pay securely without sharing your financial information. </td>
  </tr>
</table>
</form>
    </div>


</div>

<div id="div_depositcreditcard"  style="display:none;">
    <h1 align="center">Deposit Money through Credit Card</h1>
    <br>
    <h3>Select Mode</h3>
     <input type="radio" value="paypal" name="depositcreditcardmode" onClick="showDiv('div_depositcreditcarddirect'); hideDiv('div_depositcreditcardexpress');">Direct Payment 
    
    <input type="radio" value="creditcard" name="depositcreditcardmode" onClick="showDiv('div_depositcreditcardexpress'); hideDiv('div_depositcreditcarddirect'); ">Express Payment

    <div id="div_depositcreditcarddirect" style="display:none;">
     <h3>Credit Card Direct Payment</h3>
         <form action="DoDirectPaymentReceipt.php" method="POST" >
	<input type=hidden name=paymentType value="<?=$paymentType?>" />
        <center>
        <table class="api">
            <tr>
                <td class="thinfield"> First Name:</td>
                <td align=left><input type="text" size="30" maxlength="32" name="firstName" value="John" /></td>
            </tr>
            <tr>
                <td class="thinfield">
                    Last Name:</td>
                <td>
                    <input type="text" size="30" maxlength="32" name="lastName" value="Doe" /></td>
            </tr>
            <tr>
                <td class="thinfield">
                    Card Type:</td>
                <td>
                    <select name="creditCardType">
                    <option></option>
                    <option value="Visa" selected="selected">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="Discover">Discover</option>
                    <option value="Amex">American Express</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="thinfield">
                    Card Number:</td>
                <td>
                    <input type="text" size="19" maxlength="19" name="creditCardNumber" value="4059042064101342" /></td>
            </tr>
            <tr>
                <td class="thinfield">
                    Expiration Date:</td>
                <td>
                    <select name="expDateMonth">
                    <option value="1">01</option>
                    <option value="2">02</option>
                    <option value="3">03</option>
                    <option value="4">04</option>
                    <option value="5">05</option>
                    <option value="6">06</option>
                    <option value="7">07</option>
                    <option value="8">08</option>
                    <option value="9">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    </select>
                    <select name="expDateYear">
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010" selected>2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="thinfield">
                    Card Verification Number:</td>
                <td>
                    <input type="text" size="3" maxlength="4" name="cvv2Number" value="962" /></td>
            </tr>
            <tr>
                <td class="header">
                    Billing Address:
                </td>
            </tr>
            <tr>
                <td class="thinfield">
                    Address 1:
                </td>
                <td>
                    <input type="text" size="25" maxlength="100" name="address1" value="123 Fake St" /></td>
            </tr>
            <tr>
                <td class="thinfield">
                    Address 2:
                </td>
                <td>
                    <input type="text" size="25" maxlength="100" name="address2" />(optional)</td>
            </tr>
            <tr>
                <td class="thinfield">
                    City:
                </td>
                <td>
                    <input type="text" size="25" maxlength="40" name="city" value="San Jose" /></td>
            </tr>
            <tr>
                <td class="thinfield">
                    State:
                </td>
                <td>
                    <select name="state">
                    <option></option>
                    <option value="AK">AK</option>
                    <option value="AL">AL</option>
                    <option value="AR">AR</option>
                    <option value="AZ">AZ</option>
                    <option value="CA" selected>CA</option>
                    <option value="CO">CO</option>
                    <option value="CT">CT</option>
                    <option value="DC">DC</option>
                    <option value="DE">DE</option>
                    <option value="FL">FL</option>
                    <option value="GA">GA</option>
                    <option value="HI">HI</option>
                    <option value="IA">IA</option>
                    <option value="ID">ID</option>
                    <option value="IL">IL</option>
                    <option value="IN">IN</option>
                    <option value="KS">KS</option>
                    <option value="KY">KY</option>
                    <option value="LA">LA</option>
                    <option value="MA">MA</option>
                    <option value="MD">MD</option>
                    <option value="ME">ME</option>
                    <option value="MI">MI</option>
                    <option value="MN">MN</option>
                    <option value="MO">MO</option>
                    <option value="MS">MS</option>
                    <option value="MT">MT</option>
                    <option value="NC">NC</option>
                    <option value="ND">ND</option>
                    <option value="NE">NE</option>
                    <option value="NH">NH</option>
                    <option value="NJ">NJ</option>
                    <option value="NM">NM</option>
                    <option value="NV">NV</option>
                    <option value="NY">NY</option>
                    <option value="OH">OH</option>
                    <option value="OK">OK</option>
                    <option value="OR">OR</option>
                    <option value="PA">PA</option>
                    <option value="RI">RI</option>
                    <option value="SC">SC</option>
                    <option value="SD">SD</option>
                    <option value="TN">TN</option>
                    <option value="TX">TX</option>
                    <option value="UT">UT</option>
                    <option value="VA">VA</option>
                    <option value="VT">VT</option>
                    <option value="WA">WA</option>
                    <option value="WI">WI</option>
                    <option value="WV">WV</option>
                    <option value="WY">WY</option>
                    <option value="AA">AA</option>
                    <option value="AE">AE</option>
                    <option value="AP">AP</option>
                    <option value="AS">AS</option>
                    <option value="FM">FM</option>
                    <option value="GU">GU</option>
                    <option value="MH">MH</option>
                    <option value="MP">MP</option>
                    <option value="PR">PR</option>
                    <option value="PW">PW</option>
                    <option value="VI">VI</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="thinfield">
                    ZIP Code:
                </td>
                <td>
                    <input type="text" size="10" maxlength="10" name="zip" value="95131" />(5 or 9 digits)
                </td>
            </tr>
            <tr>
                <td class="thinfield">
                    Country:
                </td>
                <td>
                    United States
                </td>
            </tr>
            <tr>
                <td class="thinfield">
                    Amount:</td>
                <td>
                    <input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	
                                                            
                </td>
            </tr>
			<tr>
			<td/>
			<td align=left><b>(DoDirectPayment only supports USD at this time)</b></td>
			</tr>
            <tr>
                <td class="field">
                </td>
                <td>
                    <input type="Submit" value="Submit" /></td>
            </tr>
        </table>
        </center></center>
        <a class="home" id="CallsLink" href="index.html">Home</a>
    </form>
     </div>

    <div id="div_depositcreditcardexpress" style="display:none;">
     <h3>Credit Card Express Payment</h3>
     
     
    </div>
    
</div>



<div id="div_depositbankwire"  style="display:none;">
<h1 align="center">Deposit Money through Bank Wire</h1>
<form method="post" action="depositbankwire.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<table width="100%">
<tr>
<td width="30%"></td>
<td width="70%"></td>
</tr>
   

<tr>
<td><strong>Text Message</strong></td>
<td><textarea name="message" value="" class="vldnoblank" rows="4" cols="40"></textarea>
<span class="checkStatus"></span> 
</td>
</tr>


<tr>
<td colspan="2" align="center">
<input value="Submit" name="submit" type="submit">
</td>
</tr>
</table>

</form>
</div>

