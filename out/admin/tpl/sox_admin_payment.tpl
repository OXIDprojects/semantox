[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{ if $readonly }]
    [{assign var="readonly" value="disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="sox_admin_payment">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

<form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
[{ $oViewConf->getHiddenSid() }]
<input type="hidden" name="cl" value="sox_admin_payment">
<input type="hidden" name="fnc" value="">
<input type="hidden" name="oxid" value="[{ $oxid }]">
<input type="hidden" name="editval[oxobject2payment__oxpaymentid]" value="[{ $oxid }]">
<input type="hidden" name="editval[oxobject2payment__oxtype]" value="sox_oxpayment">

<strong>[{ oxmultilang ident="SOX_PAYMENT_ASIGN_PAYMENT" }]</strong>	
<div style="border: 1px #BDBDBD dotted; margin-bottom: 15px; padding: 5px 0;">
	<table>
		<tr>
			<td style="padding: 0 3px;">
				[{ oxmultilang ident="SOX_PAYMENT_ADVICE_START" }] <b>[{$edit->oxpayments__oxdesc->value}]</b>  [{ oxmultilang ident="SOX_PAYMENT_ADVICE_END" }].
			</td>
		</tr>
	</table><br>
	<table border="0">
		<tr>
			<td valign="top">
				<table border="0">
					<tr>
						<td><b>[{ oxmultilang ident="SOX_PAYMENT_GENERAL" }]</b></td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_CASH" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:Cash" [{if $sox.Cash == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_GOOGLECHECKOUT" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:GoogleCheckout" [{if $sox.GoogleCheckout == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_DIRECTDEBIT" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:DirectDebit" [{if $sox.DirectDebit == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_COD" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:COD" [{if $sox.COD == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_PAYPAL" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:PayPal" [{if $sox.PayPal == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_PAYSWARM" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:PaySwarm" [{if $sox.PaySwarm == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_INVOICE" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:ByInvoice" [{if $sox.ByInvoice == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_CHECKIA" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:CheckInAdvance" [{if $sox.CheckInAdvance == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_BANKTRANSFERIA" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:ByBankTransferInAdvance" [{if $sox.ByBankTransferInAdvance == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
				</table>
			</td>
			<td width="50px">
			</td>
			<td valign="top">
				<table border="0">
					<tr>
						<td><b>[{ oxmultilang ident="SOX_PAYMENT_CREDITCARD" }]</b></td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_AMERICANEXPRESS }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:AmericanExpress" [{if $sox.AmericanExpress == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_DINERSCLUB }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:DinersClub" [{if $sox.DinersClub == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_DISCOVER }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:Discover" [{if $sox.Discover == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_JCB }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:JCB" [{if $sox.JCB == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_MASTERCARD }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:MasterCard" [{if $sox.MasterCard == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_PAYMENT_VISA }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="edittext" name="soxobjectid[]" value="gr:VISA" [{if $sox.VISA == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'" [{ $readonly }]>

</form>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]