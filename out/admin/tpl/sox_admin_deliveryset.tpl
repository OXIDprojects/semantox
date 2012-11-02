[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{ if $readonly }]
    [{assign var="readonly" value="disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="sox_admin_deliveryset">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

<form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
[{ $oViewConf->getHiddenSid() }]
<input type="hidden" name="cl" value="sox_admin_deliveryset">
<input type="hidden" name="fnc" value="">
<input type="hidden" name="oxid" value="[{ $oxid }]">
<input type="hidden" name="editval[oxobject2delivery__oxdeliveryid]" value="[{ $oxid }]">
<input type="hidden" name="editval[oxobject2delivery__oxtype]" value="sox_oxdeliveryset">

<strong>[{ oxmultilang ident="SOX_DELIVERY_ASIGN_DELIVERY" }]</strong>	
<div style="border: 1px #BDBDBD dotted; margin-bottom: 15px; padding: 5px 0;">
	<table>
		<tr>
			<td style="padding: 0 3px;">
				[{ oxmultilang ident="SOX_DELIVERY_ADVICE_START" }] <b>[{ $edit->oxdeliveryset__oxtitle->value }]</b> [{ oxmultilang ident="SOX_DELIVERY_ADVICE_END" }].
			</td>
		</tr>
	</table><br>
	<table border="0">
		<tr>
			<td valign="top">
				<table border="0">
					<tr>
						<td><b>[{ oxmultilang ident="SOX_DELIVERY_GENERAL" }]</b></td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_DELIVERY_DOWNLOAD" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="editinput" name="soxobjectid[]" value="gr:DeliveryModeDirectDownload" [{if $sox.DeliveryModeDirectDownload == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_DELIVERY_OWNFLEET" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="editinput" name="soxobjectid[]" value="gr:DeliveryModeOwnFleet" [{if $sox.DeliveryModeOwnFleet == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_DELIVERY_MAIL" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="editinput" name="soxobjectid[]" value="gr:DeliveryModeMail" [{if $sox.DeliveryModeMail == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_DELIVERY_PICKUP" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="editinput" name="soxobjectid[]" value="gr:DeliveryModePickUp" [{if $sox.DeliveryModePickUp == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_DELIVERY_FREIGHT" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="editinput" name="soxobjectid[]" value="gr:DeliveryModeFreight" [{if $sox.DeliveryModeFreight == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
				</table>
			</td>
			<td width="50px">
			</td>
			<td valign="top">
				<table border="0">
					<tr>
						<td><b>[{ oxmultilang ident="SOX_DELIVERY_PARCELSERVICE" }]</b></td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_DELIVERY_DHL" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="editinput" name="soxobjectid[]" value="gr:DHL" [{if $sox.DHL == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_DELIVERY_FEDEX" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="editinput" name="soxobjectid[]" value="gr:FederalExpress" [{if $sox.FederalExpress == 1}]checked[{/if}] [{ $readonly }]>
						</td>
					</tr>
					<tr>
						<td class="edittext">
							[{ oxmultilang ident="SOX_DELIVERY_UPS" }]
						</td>
						<td class="edittext">
							<input type="checkbox" class="editinput" name="soxobjectid[]" value="gr:UPS" [{if $sox.UPS == 1}]checked[{/if}] [{ $readonly }]>
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