[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{ if $readonly }]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]
[{if $notified}]<div class="messagebox" style="margin-bottom:15px;"><b>Hinweis:</b> [{$notified}]</div>[{/if}]
<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="sox_admin_shop">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>
<form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
	[{ $oViewConf->getHiddenSid() }]
	<input type="hidden" name="cl" value="sox_admin_shop">
	<input type="hidden" name="fnc" value="">
	<input type="hidden" name="oxid" value="[{ $oxid }]">
	<input type="hidden" name="editval[oxshops__oxid]" value="[{ $oxid }]">

<strong>[{ oxmultilang ident="SOX_SHOP_TECH_CONFIG" }]</strong>	
<div style="border: 1px #BDBDBD dotted; margin-bottom: 15px; padding: 5px 0;">
	<table border="0" class="edittext" valign="top">
		<tr>
		<td>
			<select name="confstrs[iSoxEmbedding]" [{ $readonly }]>
				<option value="0" [{if !($confstrs.iSoxEmbedding)}]selected[{/if}]>[{ oxmultilang ident="GENERAL_OFF" }]</option>
				<option value="1" [{if ($confstrs.iSoxEmbedding eq 1)}]selected[{/if}]>[{ oxmultilang ident="GENERAL_AUTO" }]</option>
			</select>
		</td>
			<td class="edittext">
				[{ oxmultilang ident="SOX_SHOP_EMBEDDING" }]
			</td>
		</tr>
	</table>
	<br>
	<table border="0" valign="top">
		<tr>
			<td class="edittext">
				[{ oxmultilang ident="SOX_SHOP_AUTO_EMBEDDING" }]:
			</td>
		</tr>
	</table>
	<table border="0" class="edittext" valign="top">
		<tr>
			<td class="edittext">
				<select name="confstrs[sSoxBusinessEntityLoc]" [{ $readonly }]>
					[{foreach key=key item=item from=$contents}]
					<option value="[{$item->oxcontents__oxloadid->value}]" [{if ($confstrs.sSoxBusinessEntityLoc == $item->oxcontents__oxloadid->value)}]selected[{/if}]>[{$item->oxcontents__oxtitle->value}]</option>
					[{/foreach}]
				</select>
			</td>
			<td>
				[{ oxmultilang ident="SOX_SHOP_CONTENT_OFFERER" }]
			</td>
		</tr>
		<tr>
			<td class="edittext">
				<select name="confstrs[sSoxPaymentChargeSpecLoc]" [{ $readonly }]>
					[{foreach key=key item=item from=$contents}]
					<option value="[{$item->oxcontents__oxloadid->value}]" [{if ($confstrs.sSoxPaymentChargeSpecLoc == $item->oxcontents__oxloadid->value)}]selected[{/if}]>[{$item->oxcontents__oxtitle->value}]</option>
					[{/foreach}]
				</select>
			</td>
			<td>
				[{ oxmultilang ident="SOX_SHOP_CONTENT_PAYMENT" }]
			</td>
		</tr>
		<tr>
			<td class="edittext">
				<select name="confstrs[sSoxDeliveryChargeSpecLoc]" [{ $readonly }]>
					[{foreach key=key item=item from=$contents}]
					<option value="[{$item->oxcontents__oxloadid->value}]" [{if ($confstrs.sSoxDeliveryChargeSpecLoc == $item->oxcontents__oxloadid->value)}]selected[{/if}]>[{$item->oxcontents__oxtitle->value}]</option>
					[{/foreach}]
				</select>
			</td>
			<td>
				[{ oxmultilang ident="SOX_SHOP_CONTENT_DELIVERY" }]
			</td>
		</tr>
	</table>
	<br>
	<table border="0" valign="top">
		<tr>
			<td class="edittext">
				[{ oxmultilang ident="SOX_SHOP_RATING" }]
			</td>
		</tr>
	</table>
	<table border="0" valign="top">
		<tr>
			<td class="edittext">[{ oxmultilang ident="SOX_SHOP_RATING_MIN" }]:
			</td>
			<td class="edittext">
				<input type="text" size="3" name="confstrs[iSoxMinRating]" class="edittext" value="[{$confstrs.iSoxMinRating}]" [{ $readonly }]>
			</td>
			<td width="50px">
			</td>
			<td class="edittext">[{ oxmultilang ident="SOX_SHOP_RATING_MAX" }]:
			</td>
			<td class="edittext">
				<input type="text" size="3" name="confstrs[iSoxMaxRating]" class="edittext" value="[{$confstrs.iSoxMaxRating}]" [{ $readonly }]>
			</td>
		</tr>
	</table>
</div>

<strong>[{ oxmultilang ident="SOX_SHOP_DATA_OFFERER" }]</strong>	
<div style="border: 1px #BDBDBD dotted; margin-bottom: 15px; padding: 5px 0;">
	<table border="0">
		<tr>
			<td class="edittext">
				[{ oxmultilang ident="SOX_SHOP_DATA_MASTER" }]:
			</td>
			<td width="50px">
			</td>
			<td lcass="edittext">
				[{ oxmultilang ident="SOX_SHOP_DATA_EXTENDED" }]:
			</td>
		</tr>
		<tr>
			<td valign="top">
				<table border="0">
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SHOP_MAIN_COMPANY" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="35" maxlength="128" value="[{$edit->oxshops__oxcompany->value}]" style="color: #777777;" readonly>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="GENERAL_STREETNUM" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="35" maxlength="255" value="[{$edit->oxshops__oxstreet->value}]" style="color: #777777;" readonly>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="GENERAL_ZIPCITY" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="5" maxlength="255" value="[{$edit->oxshops__oxzip->value}]" style="color: #777777;" readonly>
							<input type="text" class="editinput" size="26" maxlength="255" value="[{$edit->oxshops__oxcity->value}]" style="color: #777777;" readonly>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="GENERAL_COUNTRY" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="35" maxlength="255" value="[{$edit->oxshops__oxcountry->value}]" style="color: #777777;" readonly>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="GENERAL_TELEPHONE" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="35" maxlength="255" value="[{$edit->oxshops__oxtelefon->value}]"  style="color: #777777;"readonly>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="GENERAL_FAX" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="35" maxlength="255" value="[{$edit->oxshops__oxtelefax->value}]" style="color: #777777;" readonly>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="GENERAL_URL" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="35" maxlength="255" value="[{$edit->oxshops__oxurl->value}]" style="color: #777777;" readonly>
						</td>
					</tr>
				</table>
			</td>
			<td>
			</td>
			<td valign="top">
				<table border="0">
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_SHOP_LOGO_URL" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="40" maxlength="256" name="confstrs[sSoxLogoUrl]" value="[{$confstrs.sSoxLogoUrl}]" [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_SHOP_GEO" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="10" maxlength="255" name="confstrs[sSoxLongitude]" value="[{$confstrs.sSoxLongitude}]" [{ $readonly }]> ([{ oxmultilang ident="SOX_SHOP_LONGITUDE" }])<br> 
							<input type="text" class="editinput" size="10" maxlength="255" name="confstrs[sSoxLatitude]" value="[{$confstrs.sSoxLatitude}]" [{ $readonly }]> ([{ oxmultilang ident="SOX_SHOP_LATITUDE" }])
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_SHOP_GLN" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="15" maxlength="13" name="confstrs[sSoxGLN]" value="[{$confstrs.sSoxGLN}]" [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_SHOP_NAICS" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="15" maxlength="6" name="confstrs[iSoxNAICS]" value="[{$confstrs.iSoxNAICS}]" [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_SHOP_ISIC" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="15" maxlength="4" name="confstrs[iSoxISIC]" value="[{$confstrs.iSoxISIC}]" [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_SHOP_DUNS" }]
						</td>
						<td class="edittext">
							<input type="text" class="editinput" size="15" maxlength="9" name="confstrs[sSoxDUNS]" value="[{$confstrs.sSoxDUNS}]" [{ $readonly }]>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>

<strong>[{ oxmultilang ident="SOX_SHOP_GLOBAL_OFFERING_DATA" }]</strong>	
<div style="border: 1px #BDBDBD dotted; margin-bottom: 15px; padding: 5px 0;">
	<table border="0">
		<tr>
			<td>
				<select name="confstrs[iSoxVAT]" style="width:120px" [{ $readonly }]>
					<option value="0" [{if ($confstrs.iSoxVAT == 0)}]selected[{/if}]>-</option>
					<option value="1" [{if ($confstrs.iSoxVAT == 1)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_VAT_INC" }]</option>
					<option value="2" [{if ($confstrs.iSoxVAT == 2)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_VAT_EX" }]</option>
				</select>
			</td>
			<td class="edittext">
				[{ oxmultilang ident="SOX_SHOP_VAT" }]
			</td>
		<tr>
		<tr>
			<td>
				<select name="confstrs[iSoxCondition]" style="width:120px" [{ $readonly }]>
					<option value="0" [{if ($confstrs.iSoxCondition == 0)}]selected[{/if}]>-</option>
					<option value="1" [{if ($confstrs.iSoxCondition == 1)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_COND_NEW" }]</option>
					<option value="2" [{if ($confstrs.iSoxCondition == 2)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_COND_USED" }]</option>
					<option value="3" [{if ($confstrs.iSoxCondition == 3)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_COND_REFURBISHED" }]</option>
				</select>
			</td>
			<td class="edittext">
				[{ oxmultilang ident="SOX_SHOP_COND" }]
			</td>
		</tr>
	</table>
	<br>
	<table border="0">
		<tr>
			<td class="edittext">
				[{ oxmultilang ident="SOX_SHOP_FNC" }]
			</td>
		</tr>
		<tr>
			<td>
				<table border="0">
					<tr>
						<td>
							<input type="radio" name="confstrs[sSoxBusinessFnc]" value="Sell" [{if ($confstrs.sSoxBusinessFnc == "Sell")}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_FNC_SELL" }]<br>
							<input type="radio" name="confstrs[sSoxBusinessFnc]" value="LeaseOut" [{if ($confstrs.sSoxBusinessFnc == "LeaseOut")}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_FNC_LEASEOUT" }]
						</td>
						<td>
							<input type="radio" name="confstrs[sSoxBusinessFnc]" value="Repair" [{if ($confstrs.sSoxBusinessFnc == "Repair")}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_FNC_REPAIR" }]<br>
							<input type="radio" name="confstrs[sSoxBusinessFnc]" value="Maintain" [{if ($confstrs.sSoxBusinessFnc == "Maintain")}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_FNC_MAINTAIN" }]
						</td>
						<td>
							<input type="radio" name="confstrs[sSoxBusinessFnc]" value="ConstructionInstallation" [{if ($confstrs.sSoxBusinessFnc == "ConstructionInstallation")}]checked[{/if}]> [{ oxmultilang ident="SOX_SHOP_FNC_CONSTINST" }]<br>
							<input type="radio" name="confstrs[sSoxBusinessFnc]" value="ProvideService" [{if ($confstrs.sSoxBusinessFnc == "ProvideService")}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_FNC_SERVICE" }]
						</td>
						<td>
							<input type="radio" name="confstrs[sSoxBusinessFnc]" value="Dispose" [{if ($confstrs.sSoxBusinessFnc == "Dispose")}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_FNC_DISPOSE" }]<br>
							<input type="radio" name="confstrs[sSoxBusinessFnc]" value="" [{if ($confstrs.sSoxBusinessFnc == "")}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_FNC_NONE" }]
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table><br>
	<table border="0">
		<tr>
			<td class="edittext">
				[{ oxmultilang ident="SOX_SHOP_COSTUMER" }]
			</td>
		</tr>
		<tr>
			<td>
				<table border="0">
					<tr>
						<td>
							<input type="hidden" name="confarrs[aSoxCustomers]" value="">
							<input type="checkbox" name="confarrs[aSoxCustomers][]" value="Enduser" [{if $customers.Enduser == 1}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_COSTUMER_ENDUSER" }] <br>
							<input type="checkbox" name="confarrs[aSoxCustomers][]" value="Reseller" [{if $customers.Reseller == 1}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_COSTUMER_RESELLER" }]
						</td>
						<td>
							<input type="checkbox" name="confarrs[aSoxCustomers][]" value="Business" [{if $customers.Business == 1}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_COSTUMER_BUSINESS" }] <br>
							<input type="checkbox" name="confarrs[aSoxCustomers][]" value="PublicInstitution" [{if $customers.PublicInstitution == 1}]checked[{/if}] [{ $readonly }]> [{ oxmultilang ident="SOX_SHOP_COSTUMER_PUBLIC" }]
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table><br>
	<table border="0">
		<tr>
			<td class="edittext">
				[{ oxmultilang ident="SOX_SHOP_DURATION }]
			</td>
		</tr>
		<tr>
			<td>
				<table border="0">
					<tr>
						<td>
							[{ oxmultilang ident="SOX_SHOP_OFFERINGS" }]:
						</td>
						<td>
							<select name="confstrs[iSoxOfferingValidity]" [{ $readonly }]>
								<option value="0" [{if ($confstrs.iSoxOfferingValidity == 0)}]selected[{/if}]>-</option>
								<option value="1" [{if ($confstrs.iSoxOfferingValidity == 1)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_1_DAY" }]</option>
								<option value="3" [{if ($confstrs.iSoxPriceValidity == 3)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_3_DAYS" }]</option>
								<option value="7" [{if ($confstrs.iSoxOfferingValidity == 7)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_7_DAYS" }]</option>
								<option value="14" [{if ($confstrs.iSoxOfferingValidity == 14)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_14_DAYS" }]</option>
								<option value="30" [{if ($confstrs.iSoxOfferingValidity == 30)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_30_DAYS" }]</option>
								<option value="178" [{if ($confstrs.iSoxOfferingValidity == 178)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_178_DAYS" }]</option>
								<option value="356" [{if ($confstrs.iSoxOfferingValidity == 356)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_356_DAYS" }]</option>
							</select>
						</td>
						<td width="20px"></td>
						<td>
							[{ oxmultilang ident="SOX_SHOP_PRICES" }]:
						</td>
						<td>
							<select name="confstrs[iSoxPriceValidity]" [{ $readonly }]>
								<option value="0" [{if ($confstrs.iSoxPriceValidity == 0)}]selected[{/if}]>-</option>
								<option value="1" [{if ($confstrs.iSoxPriceValidity == 1)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_1_DAY" }]</option>
								<option value="3" [{if ($confstrs.iSoxPriceValidity == 3)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_3_DAYS" }]</option>
								<option value="7" [{if ($confstrs.iSoxPriceValidity == 7)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_7_DAYS" }]</option>
								<option value="14" [{if ($confstrs.iSoxPriceValidity == 14)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_14_DAYS" }]</option>
								<option value="30" [{if ($confstrs.iSoxPriceValidity == 30)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_30_DAYS" }]</option>
								<option value="178" [{if ($confstrs.iSoxPriceValidity == 178)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_178_DAYS" }]</option>
								<option value="356" [{if ($confstrs.iSoxPriceValidity == 356)}]selected[{/if}]>[{ oxmultilang ident="SOX_SHOP_356_DAYS" }]</option>
							</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<strong>[{ oxmultilang ident="SOX_SHOP_NOTIFY_SW" }]</strong>	
<div style="border: 1px #BDBDBD dotted; margin-bottom: 15px; padding: 5px 0;">
	<table>
		<tr>
			<td class="edittext">
				[{ oxmultilang ident="SOX_SHOP_NOTIFY_SITEMAP_URL" }]
			</td>
			<td>
				<input type="text" name="confstrs[sSoxSitemapUrl]" value="[{$confstrs.sSoxSitemapUrl}]" size="50"> <input type="submit" class="edittext" name="notify" value="[{ oxmultilang ident="SOX_SHOP_NOTIFY_SEND" }]" onClick="Javascript:document.myedit.fnc.value='notify'" [{if !$notify}]disabled[{/if}]>
			</td>
		</tr>
	</table>
</div>
<input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'" [{ $readonly }]>

</form>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]