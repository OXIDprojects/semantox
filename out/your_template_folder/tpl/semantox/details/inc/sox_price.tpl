[{capture name="SoxPriceStart"}]
	<div rel="gr:hasPriceSpecification">
		<div typeof="gr:UnitPriceSpecification">
[{if $oView->soxGetPriceValidity()}]
[{assign var="aSoxPValidity" value=$oView->soxGetPriceValidity()}]
			<div property="gr:validFrom" content="[{$aSoxPValidity.from}]" datatype="xsd:dateTime"></div>
			<div property="gr:validThrough" content="[{$aSoxPValidity.through}]" datatype="xsd:dateTime"></div>
[{/if}]
[{if $oView->soxGetVAT() > 0}]
			<div property="gr:valueAddedTaxIncluded" content="[{if $oView->soxGetVAT() == 1}]true[{else}]false[{/if}]" datatype="xsd:boolean"></div>
[{/if}]
			<div property="gr:hasUnitOfMeasurement" content="C62" datatype="xsd:string"></div>
			<div property="gr:hasCurrency" content="[{$oSoxCurrency->name}]" datatype="xsd:string"></div>
[{/capture}]
[{if $oProduct->loadAmountPriceInfo() }]
	[{foreach from=$oProduct->loadAmountPriceInfo() item=priceItem name=amountPrice}]
		[{if $smarty.foreach.amountPrice.first}]
			[{assign var="iSoxMinAmount" value=$priceItem->oxprice2article__oxamount->value}]
		[{/if}]
[{$smarty.capture.SoxPriceStart}]
			<div property="gr:hasCurrencyValue" content="[{$oView->soxStringToFloat($priceItem->fbrutprice)}]" datatype="xsd:float"></div>
			<div rel="gr:hasEligibleQuantity">
				<div typeof="gr:QuantitativeValue">
					<div property="gr:hasMinValue" content="[{$priceItem->oxprice2article__oxamount->value}]" datatype="xsd:float"></div>
					<div property="gr:hasMaxValue" content="[{$priceItem->oxprice2article__oxamountto->value}]" datatype="xsd:float"></div>
					<div property="gr:hasUnitOfMeasurement" content="C62" datatype="xsd:string"></div>
				</div>
			</div>	
		</div>
	</div>
	[{/foreach}]
[{/if}]
[{if $oProduct->getFPrice()}]
[{$smarty.capture.SoxPriceStart}]
			<div property="gr:hasCurrencyValue" content="[{$oView->soxStringToFloat($oProduct->getFPrice())}]" datatype="xsd:float"></div>
[{if isset($iSoxMinAmount)}]
			<div rel="gr:hasEligibleQuantity">
				<div typeof="gr:QuantitativeValue">
					<div property="gr:hasMinValue" content="1" datatype="xsd:float"></div>
					<div property="gr:hasMaxValue" content="[{math equation='x-y' x=$iSoxMinAmount y=1}]" datatype="xsd:float"></div>
					<div property="gr:hasUnitOfMeasurement" content="C62" datatype="xsd:string"></div>
				</div>
			</div>
[{/if}]
		</div>
	</div>
[{/if}]